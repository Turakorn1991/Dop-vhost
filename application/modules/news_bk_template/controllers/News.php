<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MX_Controller {

	function __construct() {
		parent::__construct();

		$lang = getLang()=='TH'?'thailand':'english';
		$this->lang->load($lang, $lang);

	}
	function __deconstruct() {
		$this->db->close();
	}	

	public function cate_newsview($cate_id=0,$page=1) {
		echo Modules::run('statistics/visited');
		$this->load->library('template',
			array('name'=>'web_template1',
				  'setting'=>array('data_output'=>''))
		);
		set_css_asset_head('news.css');

		$data['cNews'] = rowArray($this->news_model->getOneCategory($cate_id));
		if(count($data['cNews']) <1) {
			dieFont('Category not found.!');
		}
		$data['cNews']['CN_Name'] = uns($data['cNews']['CN_Name']);
		$data['cNews']['CN_Descript'] = uns($data['cNews']['CN_Descript']);
		$data['content_view'] = 'news_list';

		if(get_inpost('bt_submit')){
			$search = $from = $to = "" ;
			$key 		= get_inpost('search');
			$dateFrom 	= get_inpost('fromdate');
			$dateTo 	= get_inpost('todate');
			if($key != ''){
				$search = "AND (N_Head LIKE '%{$key}%' OR N_Keyword LIKE '%{$key}%')";
			}
			if($dateFrom != ''){
				$from = "AND DATE(N_DateTimeAdd) >= '{$dateFrom}'";
			}
			if($dateTo != ''){
				$to = "AND DATE(N_DateTimeAdd) <= '{$dateTo}'";
			}
			$sResult = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND CN_ID = {$cate_id} {$from} {$to} {$search}  ORDER BY N_DateTimeUpdate DESC");
			$data['sResult'] = $sResult;
			$data['skey'] = $key;
			$data['from'] = $dateFrom;
			$data['to']	  = $dateTo;	
			$data['content_view'] = 'news_search';
			// dieArray($this->db);
		}

		$data['title'] 	= $data['cNews']['CN_Name'][getLang()];
		$data['SUB_ID'] = $cate_id;
		$data['page']	= $page;
		$this->template->load('index_page',$data,'news');	
	}

	public function view($cate_id=0,$id=0){
		echo Modules::run('statistics/visited');
		$this->load->library('template',
			array('name'=>'web_template1',
				  'setting'=>array('data_output'=>''))
		);
		set_css_asset_head('news.css');

		

		$data['cNews'] = rowArray($this->news_model->getOneCategory($cate_id));
		if(count($data['cNews']) <1) {
			dieFont('Category not found.!');
		}
		$data['SUB_ID']					= $cate_id;
		$data['title'] 					= lang($data['cNews']['CN_Name']);

		$data['news'] 					= rowArray($this->news_model->getOneNews($id));
		if(count($data['news']) <1) {
			dieFont('Data not found.!');
		}
		$ip = $this->admin_model->kh_getUserIP();
		$viewed = $this->db->select('ID')->where('NVD_IP',$ip)->where('NVD_Type','1')->where('ID',$id)->from('news_views_downloads')->get()->result_array();
		//dieArray($viewed);
		if(empty($viewed)){
			$view_stat = array(
				'ID'				=> $id,
				'NVD_IP'			=> $this->admin_model->kh_getUserIP(),
				'NVD_UserAgent'		=> $this->admin_model->get_http_user_agent(),
				'NVD_URL'			=> current_url(),
				'NVD_Type'			=> '1',
			);
			$this->common_model->insert('news_views_downloads',$view_stat);
		}
		

		$data['countView'] = $this->db->select('ID')->where('NVD_Type','1')->where('ID',$id)->count_all_results('news_views_downloads');
		$data['topic'] 	= nameTitle(lang($data['news']['N_Head']),50);
		$data['nFiles'] = $this->news_model->getAllNewsFiles($id);
		$data['content_view'] = 'news_view';
		$this->template->load('index_page',$data,'news');
	}

    public function category($mode='',$id=''){
		$GP_Value = 7;
		$this->admin_model->get_permiss_iniz($GM_ID,$GP_Value,$P_Process,$data);

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		);
		set_css_asset_head('news.css','news');
		set_css_asset_head('../admin/css/datatables.css');

		$data['content_view']	= 'category';
		$data['P_Name']			= uns($data['Permission']['P_Name']);
		$data['title']			= $data['P_Name']['TH'];
		$data['mode']			= $mode;

		switch ($mode) {
			case 'add':
				$data['cNews']['CNI_ID'] 			= '';
				$data['cNews']['CN_Name']['TH'] 	= '';
				$data['cNews']['CN_Name']['EN'] 	= '';
				$data['cNews']['CN_Descript']['TH'] = '';
				$data['cNews']['CN_Descript']['EN'] = '';
				$data['cNews']['CN_DisplayConfig'] 	= '1';
				$data['cNews']['CN_ActivityCheck'] 	= '1';
				$data['cNews']['CN_Allow'] 			= '1';

				$data['nIcons']	= $this->news_model->getAllCategoryIcons();
				
				if(get_inpost('bt_submit')!=''){
					$this->load->library('form_validation');
					$frm=$this->form_validation;

					$frm->set_rules('CNI_ID','ไอคอนสัญลักษณ์','trim');
					$frm->set_rules('CN_Name[TH]','ชื่อหมวดหมู่ข่าวสาร ไทย','required');
					$frm->set_rules('CN_Name[EN]','ชื่อหมวดหมู่ข่าวสาร อังกฤษ','trim');
					$frm->set_rules('CN_Descript[TH]','รายละเอียด ไทย','trim');
					$frm->set_rules('CN_Descript[EN]','รายละเอียด อังกฤษ','trim');
					$frm->set_rules('CN_DisplayConfig','การเรียงของหมวดหมู่','required');
					$frm->set_rules('CN_ActivityCheck','การเผยแพร่ที่ปฏิทินกิจกรรม','required');
					$frm->set_rules('CN_Allow','สถานะ','required');
					
					$frm->set_message("required","กรุณากรอกข้อมูล %s");
					if($frm->run()){
						
						$data_insert = array(
							'CNI_ID' 			=> get_inpost('CNI_ID'),
							'CN_Name' 			=> ens(get_inpost_arr('CN_Name')),
							'CN_Descript' 		=> ens(get_inpost_arr('CN_Descript')),
							'CN_DisplayConfig' 	=> get_inpost('CN_DisplayConfig'),
							'CN_ActivityCheck' 	=> get_inpost('CN_ActivityCheck'),
							'CN_Order' 			=> $this->ordering_model->getMaxOrder_and_Add('category_news','CN_Order','CN_Allow != "3"'),
							'CN_DateTimeAdd' 	=> getDatetime(),
							'CN_UserAdd'		=> getUser(),
							'CN_UserUpdate' 	=> getUser(),
							'CN_DateTimeUpdate' => getDatetime(),
							'CN_Allow' 			=> get_inpost('CN_Allow'),
						); 
						$pk = $this->common_model->insert('category_news',$data_insert);
						
						$data_insert = array(
							'P_Name' 			=> ens(get_inpost_arr('CN_Name')),
							'P_FontAweIcon' 	=> "fa-caret-square-o-down",
							'P_Process' 		=> "news/news{$pk}",
							'P_Order' 			=> $this->ordering_model->getMaxOrder_and_Add('permissions','P_Order','P_Allow != "3" and Parent_ID = "5"'),
							'Parent_ID' 		=> '5',
							'P_UserAdd' 		=> getUser(),
							'P_DateTimeAdd' 	=> getDatetime(),
							'P_UserUpdate' 		=> getUser(),
							'P_DateTimeUpdate' 	=> getDatetime(),
							'P_Allow' 			=> '1',
						);
						$newP_id = $this->common_model->insert('permissions',$data_insert);
						
						$sql = "SELECT  GM_ID  FROM group_permissions WHERE P_ID = '5' AND GP_Allow != '3' ";
						$GMP = $this->common_model->custom_query($sql);
						foreach ($GMP as $row) {
							$data_insert = array(
								'GP_Value' => '7',
								'GM_ID' => $row['GM_ID'],
								'P_ID' => $newP_id,
								'GP_UserAdd' => getUser(),
								'GP_DateTimeAdd' => getDatetime(),
								'GP_Allow' => '1',
							);
							$this->common_model->insert('group_permissions',$data_insert);
						}
						
						echo "<script>alert('เพิ่มข้อมูลเสร็จสิ้น');</script>";
						redirect('news/category','refresh');
					}else{
						$data['cNews']['CNI_ID'] 			= get_inpost('CNI_ID');
						$data['cNews']['CN_Name']['TH']		= trim(set_value('CN_Name[TH]'));
						$data['cNews']['CN_Name']['EN'] 	= trim(set_value('CN_Name[EN]'));
						$data['cNews']['CN_Descript']['TH']	= trim(set_value('CN_Descript[TH]'));
						$data['cNews']['CN_Descript']['EN']	= trim(set_value('CN_Descript[EN]'));
						$data['cNews']['CN_DisplayConfig']	= get_inpost('CN_DisplayConfig');
						$data['cNews']['CN_ActivityCheck']	= get_inpost('CN_ActivityCheck');
						$data['cNews']['CN_Allow'] 			= get_inpost('CN_Allow');
					}
				}
				break;
			case 'edit':
				$data['cNews'] = rowArray($this->news_model->getOneCategory($id));
				$data['cNews']['CN_Name'] = uns($data['cNews']['CN_Name']);
				$data['cNews']['CN_Descript'] = uns($data['cNews']['CN_Descript']);
				$data['nIcons']	= $this->news_model->getAllCategoryIcons();

				if(get_inpost('bt_submit')!=''){
					$this->load->library('form_validation');
					$frm=$this->form_validation;

					$frm->set_rules('CNI_ID','ไอคอนสัญลักษณ์','trim');
					$frm->set_rules('CN_Name[TH]','ชื่อหมวดหมู่ข่าวสาร ไทย','required');
					$frm->set_rules('CN_Name[EN]','ชื่อหมวดหมู่ข่าวสาร อังกฤษ','trim');
					$frm->set_rules('CN_Descript[TH]','รายละเอียด ไทย','trim');
					$frm->set_rules('CN_Descript[EN]','รายละเอียด อังกฤษ','trim');
					$frm->set_rules('CN_DisplayConfig','การเรียงของหมวดหมู่','required');
					$frm->set_rules('CN_ActivityCheck','การเผยแพร่ที่ปฏิทินกิจกรรม','required');
					$frm->set_rules('CN_Allow','สถานะ','required');

					$frm->set_message("required","กรุณากรอกข้อมูล %s");
					if($frm->run()){
						
						$data_update = array(
							'CNI_ID' 			=> get_inpost('CNI_ID'),
							'CN_Name' 			=> ens(get_inpost_arr('CN_Name')),
							'CN_Descript' 		=> ens(get_inpost_arr('CN_Descript')),
							'CN_DisplayConfig' 	=> get_inpost('CN_DisplayConfig'),
							'CN_ActivityCheck' 	=> get_inpost('CN_ActivityCheck'),
							'CN_UserUpdate' 	=> getUser(),
							'CN_DateTimeUpdate' => getDatetime(),
							'CN_Allow' 			=> get_inpost('CN_Allow'),
						);
						$this->common_model->update('category_news',$data_update,array('CN_ID'=>$id));

						$data_update = array(
							'P_Name' 			=> ens(get_inpost_arr('CN_Name')),
							'P_UserUpdate' 		=> getUser(),
							'P_DateTimeUpdate' 	=> getDatetime(),
						);
						$sql = "UPDATE permissions SET P_Name = '{$data_update['P_Name']}',P_UserUpdate = '{$data_update['P_UserUpdate']}',P_DateTimeUpdate = '{$data_update['P_DateTimeUpdate']}' WHERE P_Process LIKE '%news{$id}%'";
						$this->common_model->query($sql);

						echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น');</script>";
						redirect('news/category','refresh');

					}else{
						$data['cNews']['CNI_ID'] 			= get_inpost('CNI_ID');
						$data['cNews']['CN_Name']['TH']		= trim(set_value('CN_Name[TH]'));
						$data['cNews']['CN_Name']['EN'] 	= trim(set_value('CN_Name[EN]'));
						$data['cNews']['CN_Descript']['TH']	= trim(set_value('CN_Descript[TH]'));
						$data['cNews']['CN_Descript']['EN']	= trim(set_value('CN_Descript[EN]'));
						$data['cNews']['CN_DisplayConfig']	= get_inpost('CN_DisplayConfig');
						$data['cNews']['CN_ActivityCheck']	= get_inpost('CN_ActivityCheck');
					}
				}
				break;
			case 'del':
				if($id == 3){
					redirect('news/category','refresh');
				}
				$this->common_model->update('category_news',array('CN_Allow' => '3','CN_UserUpdate' => getUser(),'CN_DateTimeUpdate' => getDatetime()),array('CN_ID' => $id));

				$sql = "SELECT P_ID FROM permissions WHERE P_Process LIKE '%news{$id}%'";
				$P = rowArray($this->common_model->custom_query($sql));
				$this->common_model->update('permissions',array('P_Allow' => '3','P_UserUpdate' => getUser(),'P_DateTimeUpdate' => getDatetime()),array('P_ID' => $P['P_ID']));
				//$this->common_model->update('group_permissions',array('GP_Allow' => '3'),array('P_ID' => $P['P_ID']));

				$this->ordering_model->afterDeleteOrder('category_news','CN_Order','CN_ID',"CN_Allow != '3'");

				$rows = $this->common_model->custom_query("SELECT P_ID FROM permissions WHERE P_Allow = '1' AND Parent_ID = '5' AND P_Process LIKE '%news/news%' ORDER BY P_Order ASC ");
				$i=3;
				foreach ($rows as $k => $row) {
					//if($k>2){
						$this->common_model->update('permissions',array('P_Order' => $i),array('P_ID' => $row['P_ID']));
						$i++;
					//}
				}

				//$this->ordering_model->afterDeleteOrder('permissions','P_Order','P_ID',"P_Allow != '3' AND ");

				
				echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
				redirect('news/category','refresh');
				break;
			case 'up':
				$temp=0;
				$row=rowArray($this->common_model->get_where_custom_field('category_news','CN_ID',$id,'CN_Order'));
				$CN_Order=(int)$row['CN_Order'];
				if(($CN_Order-1)==0){
					$CN_OrderMax=$this->ordering_model->getMaxOrder('category_news','CN_Order',"CN_Allow!='3'");	
					$CN_Order=$CN_OrderMax;
					$temp=$CN_Order;
				}else
					$CN_Order=$CN_Order-1;

				$row=rowArray($this->common_model->get_where_custom_and('category_news',array('CN_Order'=>$CN_Order,"CN_Allow!="=>'3')));
				$id1=$row['CN_ID'];
				$CN_Order1=1;
				if($temp==0)
					$CN_Order1=$CN_Order+1;

				$this->common_model->update('category_news',array('CN_Order' => $CN_Order,'CN_UserUpdate' => getUser(),'CN_DateTimeUpdate' => getDatetime()),array('CN_ID' => $id)); 
				$this->common_model->update('category_news',array('CN_Order' => $CN_Order1,'CN_UserUpdate' => getUser(),'CN_DateTimeUpdate' => getDatetime()),array('CN_ID' => $id1));
				redirect('news/category','refresh');
				break;
			case 'down':
				$temp=0;
				$row=rowArray($this->common_model->get_where_custom_field('category_news','CN_ID',$id,'CN_Order'));
				$CN_Order=(int)$row['CN_Order'];

				$CN_OrderMax=$this->ordering_model->getMaxOrder('category_news','CN_Order',"CN_Allow!='3'");	
				if(($CN_Order+1)>$CN_OrderMax){
					$CN_Order=1;
					$temp=$CN_OrderMax;
				}else
					$CN_Order=$CN_Order+1;

				$row=rowArray($this->common_model->get_where_custom_and('category_news',array('CN_Order'=>$CN_Order,"CN_Allow!="=>'3')));
				$id1=$row['CN_ID'];
				$CN_Order1=$temp;
				if($temp==0)
					$CN_Order1=$CN_Order-1;

				$this->common_model->update('category_news',array('CN_Order' => $CN_Order1,'CN_UserUpdate' => getUser(),'CN_DateTimeUpdate' => getDatetime()),array('CN_ID' => $id1));
				$this->common_model->update('category_news',array('CN_Order' => $CN_Order,'CN_UserUpdate' => getUser(),'CN_DateTimeUpdate' => getDatetime()),array('CN_ID' => $id)); 
				redirect('news/category','refresh');
				break;
			default:
				$data['cnRows'] = $this->news_model->getAllCategory();
				break;
		}

		$this->template->load('index_page',$data,'news');
	}
	public function category_icon($mode='',$id=''){
		$GP_Value = 7;
		$this->admin_model->get_permiss_iniz($GM_ID,$GP_Value,$P_Process,$data);

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		);
		set_css_asset_head('news.css','news');
		set_css_asset_head('../admin/css/datatables.css');

		$data['content_view'] 	= 'category';
		$data['P_Name']			= uns($data['Permission']['P_Name']);
		$data['title'] 			= $data['P_Name']['TH'];
		$data['mode']			= $mode;

		switch ($mode) {
			case 'add':
				$data['nIcons']['CNI_Img']			= '';
				$data['nIcons']['CNI_Name']['TH']	= '';
				$data['nIcons']['CNI_Name']['EN']	= '';
				$data['nIcons']['CNI_Allow']		= '1';

				if(get_inpost('bt_submit') != ''){
					//dieArray($_POST);
					$this->load->library('form_validation');
					$frm=$this->form_validation;

					
					if(isset($_FILES['CNI_Img']['name'])){
						$frm->set_rules('CNI_Img','ไอคอนสัญลักษณ์','trim');
					}else{
						$frm->set_rules('CNI_Img','ไอคอนสัญลักษณ์','required');
					}
					$frm->set_rules('CNI_Name[TH]','ชื่อไอคอน ไทย','required');
					$frm->set_rules('CNI_Name[EN]','ชื่อไอคอน อังกฤษ','trim');
					$frm->set_rules('CNI_Allow','สถานะ','required');

					$frm->set_message("required","กรุณากรอกข้อมูล %s");
					if($frm->run()){
						
						$data_insert = array(
							'CNI_Img'	=> '',
							'CNI_Name' 	=> ens(get_inpost_arr('CNI_Name')),
							'CNI_Order' => $this->ordering_model->getMaxOrder_and_Add('category_news_icons','CNI_Order','CNI_Allow != "3"'),
							'CNI_UserAdd' => getUser(),
							'CNI_DateTimeAdd' => getDatetime(),
							'CNI_UserUpdate' => getUser(),
							'CNI_DateTimeUpdate' => getDatetime(),
							'CNI_Allow' => get_inpost('CNI_Allow'),
						);
						$imgTitle = $this->file_model->getOnceImg('CNI_Img','assets/modules/news/images');
						if($imgTitle == ''){
							$imgTitle = rowArray2(json_decode($this->input->post('CNI_Img',true)));
						}
						if($imgTitle !== ''){
							$data_insert['CNI_Img'] = $imgTitle;
						}
						//dieArray($data_insert);
						$this->common_model->insert('category_news_icons',$data_insert);
						echo "<script>alert('เพิ่มข้อมูลเสร็จสิ้น');</script>";
						redirect('news/category_icon','refresh');
					}else{
						$data['nIcons']['CNI_Img']			= get_inpost('CNI_Img');
						$data['nIcons']['CNI_Name']['TH']	= trim(set_value('CNI_Name[TH]'));
						$data['nIcons']['CNI_Name']['EN']	= trim(set_value('CNI_Name[EN]'));
						$data['nIcons']['CNI_Allow']		= get_inpost('CNI_Allow');
					}
				}
				break;
			case 'edit':
				$data['nIcons'] = rowArray($this->news_model->getOneCategoryIcons($id));
				$data['nIcons']['CNI_Name'] = uns($data['nIcons']['CNI_Name']);

				if(get_inpost('bt_submit') != ''){
					//dieArray($_POST);
					$this->load->library('form_validation');
					$frm=$this->form_validation;

					if(isset($_FILES['CNI_Img']['name'])){
						$frm->set_rules('CNI_Img','ไอคอนสัญลักษณ์','trim');
					}else{
						$frm->set_rules('CNI_Img','ไอคอนสัญลักษณ์','required');
					}
					$frm->set_rules('CNI_Name[TH]','ชื่อไอคอน ไทย','required');
					$frm->set_rules('CNI_Name[EN]','ชื่อไอคอน อังกฤษ','trim');
					$frm->set_rules('CNI_Allow','สถานะ','required');

					$frm->set_message("required","กรุณากรอกข้อมูล %s");
					if($frm->run()){
						$data_update = array(
							//'CNI_Img'	=> $CNI_Img,
							'CNI_Name' 	=> ens(get_inpost_arr('CNI_Name')),
							'CNI_UserUpdate' => getUser(),
							'CNI_DateTimeUpdate' => getDatetime(),
							'CNI_Allow' => get_inpost('CNI_Allow'),
						);

						$imgTitle = $this->file_model->getOnceImg('CNI_Img','assets/modules/news/images');
						if($imgTitle == ''){
							$imgTitle = rowArray2(json_decode($this->input->post('CNI_Img',true)));
						}
						if($imgTitle !== ''){
							$data_update['CNI_Img'] = $imgTitle;
						}

						// $CNI_Img = rowArray2(json_decode($this->input->post('CNI_Img',true)));
						// if(!$CNI_Img == ''){
						// 	// $path=".assets/modules/news/images/{$data['nIcons']['CNI_Img']}";
						// 	// @unlink($path);
						// 	$data_update['CNI_Img']=$CNI_Img;
						// }

						$this->common_model->update('category_news_icons',$data_update,array('CNI_ID'=>$id));

						echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น');</script>";
						redirect('news/category_icon','refresh');
					}else{
						$data['nIcons']['CNI_Img']			= get_inpost('CNI_Img');
						$data['nIcons']['CNI_Name']['TH']	= trim(set_value('CNI_Name[TH]'));
						$data['nIcons']['CNI_Name']['EN']	= trim(set_value('CNI_Name[EN]'));
						$data['nIcons']['CNI_Allow']		= get_inpost('CNI_Allow');
					}
				}

				break;
			case 'del':
				$data['nIcons'] = rowArray($this->news_model->getOneCategoryIcons($id));
				$data_update = array(
					'CNI_UserUpdate' => getUser(),
					'CNI_DateTimeUpdate' => getDatetime(),
					'CNI_Allow' => '3',
				);

				// $path="./assets/modules/news/images/{$data['nIcons']['CNI_Img']}";
				// @unlink($path);

				$this->common_model->update('category_news_icons',$data_update,array('CNI_ID'=>$id));

				echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
				redirect('news/category_icon','refresh');

				break;
			case 'up':
				$temp=0;
				$row=rowArray($this->common_model->get_where_custom_field('category_news_icons','CNI_ID',$id,'CNI_Order'));
				$CNI_Order=(int)$row['CNI_Order'];
				if(($CNI_Order-1)==0){
					$CNI_OrderMax=$this->ordering_model->getMaxOrder('category_news_icons','CNI_Order',"CNI_Allow!='3'");	
					$CNI_Order=$CNI_OrderMax;
					$temp=$CNI_Order;
				}else
					$CNI_Order=$CNI_Order-1;

				$row=rowArray($this->common_model->get_where_custom_and('category_news_icons',array('CNI_Order'=>$CNI_Order,"CNI_Allow!="=>'3')));
				$id1=$row['CNI_ID'];
				$CNI_Order1=1;
				if($temp==0)
					$CNI_Order1=$CNI_Order+1;

				$this->common_model->update('category_news_icons',array('CNI_Order' => $CNI_Order,'CNI_UserUpdate'=>get_session('M_ID'),'CNI_DateTimeUpdate'=>date("Y-m-d H:i:s")),array('CNI_ID' => $id)); 
				$this->common_model->update('category_news_icons',array('CNI_Order' => $CNI_Order1,'CNI_UserUpdate'=>get_session('M_ID'),'CNI_DateTimeUpdate'=>date("Y-m-d H:i:s")),array('CNI_ID' => $id1));

				redirect('news/category_icon','refresh');
				break;
			case 'down':
				$temp=0;
				$row=rowArray($this->common_model->get_where_custom_field('category_news_icons','CNI_ID',$id,'CNI_Order'));
				$CNI_Order=(int)$row['CNI_Order'];
				$CNI_OrderMax=$this->ordering_model->getMaxOrder('category_news_icons','CNI_Order',"CNI_Allow!='3'");	
				if(($CNI_Order+1)>$CNI_OrderMax){
					$CNI_Order=1;
					$temp=$CNI_OrderMax;
				}else
					$CNI_Order=$CNI_Order+1;
					
				$row=rowArray($this->common_model->get_where_custom_and('category_news_icons',array('CNI_Order'=>$CNI_Order,"CNI_Allow!="=>'3')));
				$id1=$row['CNI_ID'];
				$CNI_Order1=$temp;
				if($temp==0)
					$CNI_Order1=$CNI_Order-1;

				$this->common_model->update('category_news_icons',array('CNI_Order' => $CNI_Order1,'CNI_UserUpdate'=>get_session('M_ID'),'CNI_DateTimeUpdate'=>date("Y-m-d H:i:s")),array('CNI_ID' => $id1));
				$this->common_model->update('category_news_icons',array('CNI_Order' => $CNI_Order,'CNI_UserUpdate'=>get_session('M_ID'),'CNI_DateTimeUpdate'=>date("Y-m-d H:i:s")),array('CNI_ID' => $id)); 
	  			
	  			redirect('news/category_icon','refresh');
				break;
			default:
				$data['cnIcon'] = $this->news_model->getAllCategoryIcons();
				break;
		}

		$this->template->load('index_page',$data,'news');
	}

	public function news($CN_ID='',$mode='',$id=''){
		$GP_Value = 7;
		$this->admin_model->get_permiss_iniz($GM_ID,$GP_Value,$P_Process,$data);

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		);
		set_css_asset_head('news.css','news');
		set_css_asset_head('../admin/css/datatables.css');

		set_css_asset_head('../plugin/jquery-ui-1.11.4.custom/jquery-ui.min.css');
		set_js_asset_head('../plugin/jquery-ui-1.11.4.custom/jquery-ui.min.js');

		$data['content_view'] 	= 'news';
		$data['P_Name']			= uns($data['Permission']['P_Name']);
		$data['title'] 			= $data['P_Name']['TH'];

		$data['CN_ID'] = $CN_ID;
		$data['mode'] = $mode;

		$data['cnRow'] = rowArray($this->news_model->getOneCategory($CN_ID));
		switch ($mode) {
			case 'add':
				$data['news']['N_Head']['TH'] = '';
				$data['news']['N_Head']['EN'] = '';
				$data['news']['N_Title']['TH'] = '';
				$data['news']['N_Title']['EN'] = '';
				$data['news']['N_ImgTitle'] = '';
				$data['news']['N_Descript']['TH'] = '';
				$data['news']['N_Descript']['EN'] = '';
				$data['news']['N_Keyword']['TH'] = '';
				$data['news']['N_Keyword']['EN'] = '';
				$data['news']['N_Owner_info']['TH'] = '';
				$data['news']['N_Owner_info']['EN'] = '';
				$data['news']['N_HotNumDisplay'] = '500';
				$data['news']['N_StartDate'] = date("Y-m-d");
				$data['news']['N_EndDate'] = date("Y-m-d",strtotime("+1 day"));
				// $data['news']['N_StartActivity'] = date("Y-m-d");
				// $data['news']['N_EndActivity'] = date("Y-m-d",strtotime("+1 day"));
				$data['news']['N_StartActivity'] = '';
				$data['news']['N_EndActivity'] = '';
				$data['news']['N_Type'] = '1';
				$data['news']['N_Allow'] = '1';

				if(get_inpost('bt_submit') !=''){
					$this->load->library('form_validation');
					$frm=$this->form_validation;

					$frm->set_rules('N_ImgTitle','ภาพไตเติ้ล','trim');
					$frm->set_rules('N_Head[TH]','หัวข้อข่าวสาร ไทย','required');
					$frm->set_rules('N_Head[EN]','หัวข้อข่าวสาร อังกฤษ','trim');
					$frm->set_rules('N_Title[TH]','เรื่องย่อ ไทย','required');
					$frm->set_rules('N_Title[EN]','เรื่องย่อ อังกฤษ','trim');
					$frm->set_rules('N_Descript[TH]','เนื้อเรื่อง ไทย','required');
					$frm->set_rules('N_Descript[EN]','เนื้อเรื่อง อังกฤษ','trim');
					$frm->set_rules('N_Keyword[TH]','คีย์เวิร์ด ไทย','required');
					$frm->set_rules('N_Keyword[EN]','คีย์เวิร์ด อังกฤษ','trim');
					$frm->set_rules('N_Owner_info[TH]','ข้อมูลเจ้าของข่าวและช่องทางติดต่ ไทย','trim');
					$frm->set_rules('N_Owner_info[EN]','ข้อมูลเจ้าของข่าวและช่องทางติดต่ อังกฤษ','trim');

					if($data['cnRow']['CN_ActivityCheck'] == '1'){
						$frm->set_rules('N_StartActivity','กิจกรรมเริ่มต้นวันที่','trim|callback_date_valid');
						$frm->set_rules('N_EndActivity','กิจกรรมสิ้นสุดวันที่','trim|callback_date_valid|callback_dateEnd_valid['.get_inpost('N_StartActivity').']');
					}
										
					$frm->set_rules('N_StartDate','วันที่เริ่มแสดงสถานะ New','callback_date_valid');
					$frm->set_rules('N_EndDate','วันที่สิ้นสุดแสดงสถานะ New','callback_date_valid|callback_dateEnd_valid['.get_inpost('N_StartDate').']');

					$frm->set_rules('N_HotNumDisplay','จำนวนวิวที่จะขึ้นสถานะ Hot','numeric');
					if($CN_ID == 3){
						$frm->set_rules('N_Type','ประเภท','required');
					}
					$frm->set_rules('N_Allow','สถานะ','required');
					
					$frm->set_message("required","กรุณากรอกข้อมูล %s");
					$frm->set_message("numeric","%s กรุณากรอกข้อมูลเป็นตัวเลข");
					$frm->set_message("date_valid","วัน/เดือน/ปี %s นี้ไม่ถูกต้อง");
					$frm->set_message("dateEnd_valid","วันที่สิ้นสุดต้องมากกว่าวันที่เริ่มต้น");
					$frm->set_message("valid_email","รูปแบบอีเมล์ต้องถูกต้อง");
					
					if($frm->run($this)){
						$data_insert = array(
							'CN_ID'				=> $CN_ID,
							'N_Head' 			=> ens(get_inpost_arr('N_Head')),
							'N_Title'			=> ens(get_inpost_arr('N_Title')),
							'N_Descript'		=> ens(get_inpost_arr('N_Descript')),
							'N_Keyword'			=> ens(get_inpost_arr('N_Keyword')),
							'N_Owner_info'		=> ens(get_inpost_arr('N_Owner_info')),
							'N_StartActivity'	=> '',
							'N_EndActivity'		=> '',
							'N_HotNumDisplay'	=> get_inpost('N_HotNumDisplay'),
							'N_StartDate'		=> dateChange(get_inpost('N_StartDate'),2),
							'N_EndDate'			=> dateChange(get_inpost('N_EndDate'),2),
							'N_Type'			=> '',
							'N_Allow'			=> get_inpost('N_Allow'),
							'N_UserAdd'			=> getUser(),
							'N_DateTimeAdd'		=> getDatetime(),
							'N_UserUpdate'		=> getUser(),
							'N_DateTimeUpdate'	=> getDatetime(),
						);

						if($CN_ID == 3){
							$data_insert['N_Type'] = get_inpost('N_Type');
						}

						$N_ImgTitle = $this->files_model->getOnceImg('N_ImgTitle','assets/modules/news/images');
						if($N_ImgTitle == ''){
							$N_ImgTitle = rowArray2(json_decode($this->input->post('N_ImgTitle',true)));
						}
						if($N_ImgTitle !== ''){
							$data_insert['N_ImgTitle'] = $N_ImgTitle;
						}
						
						if($data['cnRow']['CN_ActivityCheck'] == '1'){
							$data_insert['N_StartActivity'] = dateChange(get_inpost('N_StartActivity'),2);
							$data_insert['N_EndActivity']	= dateChange(get_inpost('N_EndActivity'),2);
						}
						$pk = $this->common_model->insert('news',$data_insert);
						
						$N_FileUL = $this->files_model->do_multi_upload('N_File','assets/modules/news/uploads');
						if(!empty($N_FileUL)){
							foreach ($N_FileUL as $key => $file) {
								$ND_Name 		= $this->input->post('ND_NameUL',true);
								$ND_Descript 	= $this->input->post('ND_DescriptUL',true);
								$insert_batch = array(
									'N_ID' 				=> $pk,
									'ND_Name' 			=> ens($ND_Name[$key]),
									'ND_File'			=> $file['file'],
									'ND_Descript' 		=> ens($ND_Descript[$key]),
									'ND_UserAdd'		=> getUser(),
									'ND_DateTimeAdd'	=> getDatetime(),
									'ND_UserUpdate'		=> getUser(),
									'ND_DateTimeUpdate'	=> getDatetime(),
									'ND_Type' 			=> '1',
									'ND_Allow' 			=> '1',
								);
								$this->common_model->insert('news_document',$insert_batch);
							}
							
						}
						$N_File = json_decode($this->input->post('N_File',true));
						if(!empty($N_File)){
							foreach ($N_File as $key => $file) {
								$ND_Name 		= $this->input->post('ND_Name',true);
								$ND_Descript 	= $this->input->post('ND_Descript',true);
								$insert_batch = array(
									'N_ID' 				=> $pk,
									'ND_Name' 			=> ens($ND_Name[$key]),
									'ND_File'			=> $file,
									'ND_Descript' 		=> ens($ND_Descript[$key]),
									'ND_UserAdd'		=> getUser(),
									'ND_DateTimeAdd'	=> getDatetime(),
									'ND_UserUpdate'		=> getUser(),
									'ND_DateTimeUpdate'	=> getDatetime(),
									'ND_Type' 			=> '1',
									'ND_Allow' 			=> '1',
								);
								$this->common_model->insert('news_document',$insert_batch);
							}
							
						}
						
						//dieArray($insert_batch);
						echo "<script>alert('เพิ่มข้อมูลเสร็จสิ้น');</script>";
						redirect("news/news{$CN_ID}",'refresh');
					}else{
						error_log("validation_errors: ".validation_errors());
						$data['news']['N_ImgTitle'] 		= '';
						$data['news']['N_Head']['TH'] 		= trim(set_value('N_Head[TH]'));
						$data['news']['N_Head']['EN'] 		= trim(set_value('N_Head[EN]'));
						$data['news']['N_Title']['TH'] 		= trim(set_value('N_Title[TH]'));
						$data['news']['N_Title']['EN'] 		= trim(set_value('N_Title[EN]'));				
						$data['news']['N_Descript']['TH'] 	= trim(set_value('N_Descript[TH]'));
						$data['news']['N_Descript']['EN'] 	= trim(set_value('N_Descript[EN]'));
						$data['news']['N_Keyword']['TH'] 	= trim(set_value('N_Keyword[TH]'));
						$data['news']['N_Keyword']['EN'] 	= trim(set_value('N_Keyword[EN]'));
						$data['news']['N_Owner_info']['TH'] = trim(set_value('N_Owner_info[TH]'));
						$data['news']['N_Owner_info']['EN'] = trim(set_value('N_Owner_info[EN]'));

						$data['news']['N_HotNumDisplay'] 	= trim(set_value('N_HotNumDisplay'));
						$data['news']['N_StartDate'] 		= dateChange(set_value('N_StartDate'),2);
						$data['news']['N_EndDate'] 			= dateChange(set_value('N_EndDate'),2);
						$data['news']['N_StartActivity'] 	= dateChange(set_value('N_StartActivity'),2);
						$data['news']['N_EndActivity'] 		= dateChange(set_value('N_EndActivity'),2);

						$data['news']['N_Type'] 			= get_inpost('N_Type');
						$data['news']['N_Allow'] 			= get_inpost('N_Allow');
					}
				}
				break;
			case 'edit':
				$data['newsFiles'] 				= $this->news_model->getAllNewsFiles($id);
				//dieArray($data['newsFiles']);
				$data['news'] 					= rowArray($this->news_model->getOneNews($id));
				$data['news']['N_Head'] 		= uns($data['news']['N_Head']);
				$data['news']['N_Title'] 		= uns($data['news']['N_Title']);
				$data['news']['N_Descript'] 	= uns($data['news']['N_Descript']);
				$data['news']['N_Keyword'] 		= uns($data['news']['N_Keyword']);
				$data['news']['N_Owner_info'] 	= uns($data['news']['N_Owner_info']);
				//dieArray($data['news']);

				if(get_inpost('bt_submit') !=''){
					$this->load->library('form_validation');
					$frm=$this->form_validation;

					$frm->set_rules('N_ImgTitle','ภาพไตเติ้ล','trim');
					$frm->set_rules('N_Head[TH]','หัวข้อข่าวสาร ไทย','required');
					$frm->set_rules('N_Head[EN]','หัวข้อข่าวสาร อังกฤษ','trim');
					$frm->set_rules('N_Title[TH]','เรื่องย่อ ไทย','required');
					$frm->set_rules('N_Title[EN]','เรื่องย่อ อังกฤษ','trim');
					$frm->set_rules('N_Descript[TH]','เนื้อเรื่อง ไทย','required');
					$frm->set_rules('N_Descript[EN]','เนื้อเรื่อง อังกฤษ','trim');
					$frm->set_rules('N_Keyword[TH]','คีย์เวิร์ด ไทย','required');
					$frm->set_rules('N_Keyword[EN]','คีย์เวิร์ด อังกฤษ','trim');
					$frm->set_rules('N_Owner_info[TH]','ข้อมูลเจ้าของข่าวและช่องทางติดต่ ไทย','trim');
					$frm->set_rules('N_Owner_info[EN]','ข้อมูลเจ้าของข่าวและช่องทางติดต่ อังกฤษ','trim');

					if($data['cnRow']['CN_ActivityCheck'] == '1'){
						$frm->set_rules('N_StartActivity','กิจกรรมเริ่มต้นวันที่','trim|callback_date_valid');
						$frm->set_rules('N_EndActivity','กิจกรรมสิ้นสุดวันที่','trim|callback_date_valid|callback_dateEnd_valid['.get_inpost('N_StartActivity').']');
					}

					$frm->set_rules('N_StartDate','วันที่เริ่มแสดงสถานะ New','callback_date_valid');
					$frm->set_rules('N_EndDate','วันที่สิ้นสุดแสดงสถานะ New','callback_date_valid|callback_dateEnd_valid');

					$frm->set_rules('N_HotNumDisplay','จำนวนวิวที่จะขึ้นสถานะ Hot','numeric');
					if($CN_ID == 3){
						$frm->set_rules('N_Type','ประเภท','required');
					}
					$frm->set_rules('N_Allow','สถานะ','required');
					
					$frm->set_message("required","กรุณากรอกข้อมูล %s");
					$frm->set_message("numeric","%s กรุณากรอกข้อมูลเป็นตัวเลข");
					$frm->set_message("date_valid","วัน/เดือน/ปี %s นี้ไม่ถูกต้อง");
					$frm->set_message("dateEnd_valid","วันที่สิ้นสุดต้องมากกว่าวันที่เริ่มต้น");
					$frm->set_message("valid_email","รูปแบบอีเมล์ต้องถูกต้อง");
					if($frm->run($this)){
						$data_update = array(
							'N_Head' 			=> ens(get_inpost_arr('N_Head')),
							'N_Title'			=> ens(get_inpost_arr('N_Title')),
							'N_Descript'		=> ens(get_inpost_arr('N_Descript')),
							'N_Keyword'			=> ens(get_inpost_arr('N_Keyword')),
							'N_Owner_info'		=> ens(get_inpost_arr('N_Owner_info')),
							'N_StartActivity'	=> '',
							'N_EndActivity'		=> '',
							'N_HotNumDisplay'	=> get_inpost('N_HotNumDisplay'),
							'N_StartDate'		=> dateChange(get_inpost('N_StartDate'),2),
							'N_EndDate'			=> dateChange(get_inpost('N_EndDate'),2),
							'N_Allow'			=> get_inpost('N_Allow'),

							'N_UserUpdate'		=> getUser(),
							'N_DateTimeUpdate'	=> getDatetime(),
						);

						if($CN_ID == 3){
							$data_update['N_Type'] = get_inpost('N_Type');
						}

						// $N_ImgTitle = rowArray2(json_decode($this->input->post('N_ImgTitle',true)));
						// if(!$N_ImgTitle == ''){
						// 	// $path="./assets/modules/news/images/{$data['news']['N_ImgTitle']}";
						// 	// @unlink($path);
						// 	$data_update['N_ImgTitle']=$N_ImgTitle;
						// }

						$N_ImgTitle = $this->files_model->getOnceImg('N_ImgTitle','assets/modules/news/images');
						if($N_ImgTitle == ''){
							$N_ImgTitle = rowArray2(json_decode($this->input->post('N_ImgTitle',true)));
						}
						if($N_ImgTitle !== ''){
							$data_update['N_ImgTitle'] = $N_ImgTitle;
						}

						//$data_update['N_ImgTitle'] = $N_ImgTitle;

						if($data['cnRow']['CN_ActivityCheck'] == '1'){
							$data_update['N_StartActivity'] = dateChange(get_inpost('N_StartActivity'),2);
							$data_update['N_EndActivity']	= dateChange(get_inpost('N_EndActivity'),2);
						}

						$this->common_model->update('news',$data_update,array('N_ID' => $id));

						$N_FileUL = $this->files_model->do_multi_upload('N_File','assets/modules/news/uploads');
						if(!empty($N_FileUL)){
							foreach ($N_FileUL as $key => $file) {
								$ND_Name 		= $this->input->post('ND_NameUL',true);
								$ND_Descript 	= $this->input->post('ND_DescriptUL',true);
								$insert_batch = array(
									'N_ID' 				=> $id,
									'ND_Name' 			=> ens($ND_Name[$key]),
									'ND_File'			=> $file['file'],
									'ND_Descript' 		=> ens($ND_Descript[$key]),
									'ND_UserAdd'		=> getUser(),
									'ND_DateTimeAdd'	=> getDatetime(),
									'ND_UserUpdate'		=> getUser(),
									'ND_DateTimeUpdate'	=> getDatetime(),
									'ND_Type' 			=> '1',
									'ND_Allow' 			=> '1',
								);
								$this->common_model->insert('news_document',$insert_batch);
							}
							
						}

						$N_File = json_decode($this->input->post('N_File',true));
						if(!empty($N_File)){
							foreach ($N_File as $key => $file) {
								$ND_Name 		= $this->input->post('ND_Name',true);
								$ND_Descript 	= $this->input->post('ND_Descript',true);
								$insert_batch = array(
									'N_ID' 				=> $id,
									'ND_Name' 			=> ens($ND_Name[$key]),
									'ND_File'			=> $file,
									'ND_Descript' 		=> ens($ND_Descript[$key]),
									'ND_UserAdd'		=> getUser(),
									'ND_DateTimeAdd'	=> getDatetime(),
									'ND_UserUpdate'		=> getUser(),
									'ND_DateTimeUpdate'	=> getDatetime(),
									'ND_Type' 			=> '1',
									'ND_Allow' 			=> '1',
								);
								$this->common_model->insert('news_document',$insert_batch);
							}
							
						}
						echo "<script>alert('แก้ไขข้อมูลเสร็จสิ้น');</script>";
						redirect("news/news{$CN_ID}",'refresh');
						dieArray($data_update);
					}else{
						$data['news']['N_ImgTitle'] 		= '';
						$data['news']['N_Head']['TH'] 		= trim(set_value('N_Head[TH]'));
						$data['news']['N_Head']['EN'] 		= trim(set_value('N_Head[EN]'));
						$data['news']['N_Title']['TH'] 		= trim(set_value('N_Title[TH]'));
						$data['news']['N_Title']['EN'] 		= trim(set_value('N_Title[EN]'));				
						$data['news']['N_Descript']['TH'] 	= trim(set_value('N_Descript[TH]'));
						$data['news']['N_Descript']['EN'] 	= trim(set_value('N_Descript[EN]'));
						$data['news']['N_Keyword']['TH'] 	= trim(set_value('N_Keyword[TH]'));
						$data['news']['N_Keyword']['EN'] 	= trim(set_value('N_Keyword[EN]'));
						$data['news']['N_Owner_info']['TH'] = trim(set_value('N_Owner_info[TH]'));
						$data['news']['N_Owner_info']['EN'] = trim(set_value('N_Owner_info[EN]'));

						$data['news']['N_HotNumDisplay'] 	= trim(set_value('N_HotNumDisplay'));
						$data['news']['N_StartDate'] 		= trim(dateChange(set_value('N_StartDate'),2));
						$data['news']['N_EndDate'] 			= trim(dateChange(set_value('N_EndDate'),2));
						$data['news']['N_StartActivity'] 	= trim(dateChange(set_value('N_StartActivity'),2));
						$data['news']['N_EndActivity'] 		= trim(dateChange(set_value('N_EndActivity'),2));

						$data['news']['N_Type'] 			= get_inpost('N_Type');
						$data['news']['N_Allow'] 			= get_inpost('N_Allow');
					}
				}
				break;
			case 'del':
				$file = $this->news_model->getAllNewsFiles($id);
				foreach ($file as $row) {
					// $path="./assets/modules/news/uploads/news_files/{$row['ND_Name']}";
					// @unlink($path);
					$this->common_model->update('news_document',array('ND_Allow'=>'3','ND_UserUpdate'=>getUser(),'ND_DateTimeUpdate'=>getDatetime()),array('ND_ID'=>$row['ND_ID'],'N_ID'=>$id));
				}
				$nn = rowArray($this->news_model->getOneNews($id));
				// $path="./assets/modules/news/images/{$nn['N_ImgTitle']}";
				// @unlink($path);
				$this->common_model->update('news',array('N_Allow'=>'3','N_UserUpdate'=>getUser(),'N_DateTimeUpdate'=>getDatetime()),array('N_ID'=>$id));

				echo "<script>alert('ลบข้อมูลเสร็จสิ้น');</script>";
				redirect("news/news{$CN_ID}",'refresh');
				break;
			default:
				$data['nRows'] = $this->news_model->getAllNews($CN_ID);
				break;
		}

		$this->template->load('index_page',$data,'news');
	}
	public function date_valid($date){
		if($date == ''){ return true;}
	    $arr=explode('/',$date);
	    if(count($arr) == 3)
	    	return checkdate($arr[1], $arr[0],$arr[2]);
	    else
	    	return false;
	}
    public	function dateEnd_valid($eDate,$sDate){
    	if($eDate == ''){ return true;}
		$tempMax=strtotime(dateChange($eDate,2));
	    $tempMin=strtotime(dateChange($sDate,2));
	    if($tempMax<$tempMin)return false;
	    else return true;
	}

	public function fileDownload($id=''){
		$temp = rowArray($this->common_model->custom_query("SELECT * FROM news_document WHERE ND_ID = {$id}"));
		if(empty($temp)){
			dieFont("File not found.!!");
		}
		$this->load->helper('download');
		$arr = @explode('.',$temp['ND_File']);
		$file = rawurlencode($temp['ND_File']);
		$file = str_replace("%2F","/",$file);
		$pth = file_get_contents(base_url('assets/modules/news/uploads/'.$file));
		// dieFont(base_url('assets/modules/news/uploads/'.rawurlencode($temp['ND_File'])));
		$nme = downloadName(lang($temp['ND_Name'])).'.'.$arr[count($arr)-1];
		force_download($nme, $pth);  
	}

	public function download($id=''){
		$temp = rowArray($this->common_model->custom_query("SELECT * FROM news_document WHERE ND_ID = {$id}"));

		if(empty($temp)){
			dieFont("File not found.!!");
		}

		$DL_data = array(
			'ID'				=> $temp['ND_ID'],
			'NVD_IP'			=> $this->admin_model->kh_getUserIP(),
			'NVD_UserAgent'		=> $this->admin_model->get_http_user_agent(),
			'NVD_URL'			=> current_url(),
			'NVD_Type'			=> '2',
		);
		$this->common_model->insert('news_views_downloads',$DL_data);

		$this->load->helper('download');
		$arr = @explode('.',$temp['ND_File']);
		$file = rawurlencode($temp['ND_File']);
		$file = str_replace("%2F","/",$file);
		$pth = file_get_contents(base_url('assets/modules/news/uploads/'.$file));
		// dieFont(base_url('assets/modules/news/uploads/'.rawurlencode($temp['ND_File'])));
		$nme = downloadName(lang($temp['ND_Name'])).'.'.$arr[count($arr)-1];
		force_download($nme, $pth);  
	}
	
	public function del_file(){
		$row=rowArray($this->common_model->get_where_custom(get_inpost('method'),get_inpost('idn'),get_inpost('ID')));

		if(isset($row[get_inpost('fn')])){
			// @unlink('./assets/modules/news/uploads/'.get_inpost('fd').'/'.$row[get_inpost('fn')]);
			if(get_inpost('method')=='news_document'){
				$this->common_model->update(get_inpost('method'),
					array(
						'ND_UserUpdate'=>getUser(),
						'ND_DateTimeUpdate'=>getDatetime(),
						'ND_Allow'=>'3',
					)
				,array(get_inpost('idn')=>get_inpost('ID')));
			}
			echo json_encode(array('result'=>'true'));
		}
	}

	public function main_renderHTML() {	
		if(get_inpost('first')!='' && get_inpost('id')!='') {
			$cRow = rowArray($this->common_model->get_where_custom_and('category_news',array('CN_ID'=>get_inpost('id'))));
			if(isset($cRow['CN_ID'])) {
				$nCount = $this->db->select('N_ID')->where('N_Allow','1')->where('CN_ID',$cRow['CN_ID'])->count_all_results('news');
				$disMode = array(1=>'NEWS_NEW',2=>'HOT_NEWS',3=>'UPDATE_NEWS');
				switch ($cRow['CN_DisplayConfig']) {
					case '2': // hot news 
						$limit=get_inpost('first')=='0'?9:8;
						$count = 0;
						$dateThis = date("Y-m-d");
						$temp_topNews    = $this->common_model->custom_query("SELECT A.*,count(B.ID) AS view  FROM news AS A LEFT JOIN news_views_downloads AS B ON A.N_ID = B.ID WHERE A.N_Allow = '1' AND B.NVD_Type ='1' AND A.CN_ID = {$cRow['CN_ID']} GROUP BY B.ID ORDER BY view DESC,N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
						$topNews = array();$bottomNews = array();$rightNews = array();

						if(count($temp_topNews)>0) {
							foreach($temp_topNews as $key=>$row) {
								if($row['view'] >= $row['N_HotNumDisplay']) { 
									if(count($topNews) < 1) {
										$row['CN_Status'] = 2;
										$topNews[$row['N_ID']] = $row;
									}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 2;
										$bottomNews[$row['N_ID']] = $row;
									}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 2;
										$rightNews[$row['N_ID']] = $row;
									}
									$count++;
								}
								if($count>=$limit) break;
							}
						}

						if($count<$limit) {
							$temp_bottomNews = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND (('$dateThis'=N_StartDate OR '$dateThis'=N_EndDate) OR ('$dateThis'>=N_StartDate AND '$dateThis'<=N_EndDate)) AND CN_ID = {$cRow['CN_ID']} ORDER BY N_StartDate DESC,N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
							if(count($temp_bottomNews) > 0) {
								foreach($temp_bottomNews as $key=>$row) {
									if(count($topNews) < 1) {
										$row['CN_Status'] = 1;
										$topNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 1;
										$bottomNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 1;
										$rightNews[$row['N_ID']] = $row;
										$count++;
									}
									if($count>=$limit) break;
								}
							}
						}

						if($count<$limit) {
							$temp_rightNews  = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND CN_ID = {$cRow['CN_ID']} ORDER BY N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
							// $temp_rightNews  = array();
							if(count($temp_rightNews) > 0) {
								foreach ($temp_rightNews as $key=>$row) {
									if(count($topNews) < 1) {
										$row['CN_Status'] = 3;
										$topNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 3;
										$bottomNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 3;
										$rightNews[$row['N_ID']] = $row;
										$count++;
									} 
									if($count>=$limit) break;
								}
							}
						}

						if(count($topNews)>0) {
							$topNews = $topNews[key($topNews)];
						}

						break;
					case '3': // update news
						$limit=get_inpost('first')=='0'?9:8;
						$count = 0;
						$dateThis = date("Y-m-d");
						$temp_topNews    = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND CN_ID = {$cRow['CN_ID']} ORDER BY N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
						$topNews = array();
						$bottomNews = array();
						$rightNews = array();
						if(count($temp_topNews) > 0) {
							foreach ($temp_topNews as $key=>$row) {
								if(count($topNews) < 1) {
									$row['CN_Status'] = 3;
									$topNews[$row['N_ID']] = $row;
								}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
									$row['CN_Status'] = 3;
									$bottomNews[$row['N_ID']] = $row;
								}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
									$row['CN_Status'] = 3;
									$rightNews[$row['N_ID']] = $row;
								}
								$count++;
								if($count>=$limit) break;  
							}
						}

						if($count<$limit) {
							$temp_bottomNews = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND (('$dateThis'=N_StartDate OR '$dateThis'=N_EndDate) OR ('$dateThis'>=N_StartDate AND '$dateThis'<=N_EndDate)) AND CN_ID = {$cRow['CN_ID']} ORDER BY N_StartDate DESC,N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
							if(count($temp_bottomNews) > 0) {
								foreach($temp_bottomNews as $key=>$row) {
									if(count($topNews) < 1) {
										$row['CN_Status'] = 1;
										$topNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 1;
										$bottomNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 1;
										$rightNews[$row['N_ID']] = $row;
										$count++;
									} 
									if($count>=$limit) break;
								}
							}
						}

						if($count<$limit) {
							$temp_rightNews  = $this->common_model->custom_query("SELECT A.*,count(B.ID) AS view  FROM news AS A LEFT JOIN news_views_downloads AS B ON A.N_ID = B.ID WHERE A.N_Allow = '1' AND B.NVD_Type ='1' AND A.CN_ID = {$cRow['CN_ID']} GROUP BY B.ID ORDER BY view DESC,N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
							// $temp_rightNews  = array();
							if(count($temp_rightNews) > 0) {
								foreach($temp_rightNews as $key=>$row) {
									if($row['view'] >= $row['N_HotNumDisplay']) { 
										if(count($topNews) < 1) {
											$row['CN_Status'] = 2;
											$topNews[$row['N_ID']] = $row;
											$count++;
										}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
											$row['CN_Status'] = 2;
											$bottomNews[$row['N_ID']] = $row;
											$count++;
										}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
											$row['CN_Status'] = 2;
											$rightNews[$row['N_ID']] = $row;
											$count++;
										}
										if($count>=$limit) break;
									}
								}
							}
						}
						if(count($topNews)>0) {
							$topNews = $topNews[key($topNews)];
						}
						break;
					default: // new news
						$limit=get_inpost('first')=='0'?9:8;
						$count = 0;

						$dateThis = date("Y-m-d");
						$temp_topNews    = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND (('$dateThis'=N_StartDate OR '$dateThis'=N_EndDate) OR ('$dateThis'>=N_StartDate AND '$dateThis'<=N_EndDate)) AND CN_ID = {$cRow['CN_ID']} ORDER BY N_StartDate DESC ,N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
						$topNews = array();
						$bottomNews = array();
						$rightNews = array();
						if(count($temp_topNews) > 0) {
							foreach($temp_topNews as $key=>$row) {
								if(count($topNews) < 1) {
									$row['CN_Status'] = 1;
									$topNews[$row['N_ID']] = $row;
								}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
									$row['CN_Status'] = 1;
									$bottomNews[$row['N_ID']] = $row;
								}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
									$row['CN_Status'] = 1;
									$rightNews[$row['N_ID']] = $row;
								} 
								$count++; 
								if($count>=$limit) break;
							}
						}

						if($count<$limit) {
							$temp_bottomNews = $this->common_model->custom_query("SELECT A.*,count(B.ID) AS view  FROM news AS A LEFT JOIN news_views_downloads AS B ON A.N_ID = B.ID WHERE A.N_Allow = '1' AND B.NVD_Type ='1' AND A.CN_ID = {$cRow['CN_ID']} GROUP BY B.ID ORDER BY view DESC,N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");
							if(count($temp_bottomNews) > 0) {
								foreach($temp_bottomNews as $key=>$row) {
									if($row['view'] >= $row['N_HotNumDisplay']) { 
										if(count($topNews) < 1) {
											$row['CN_Status'] = 2;
											$topNews[$row['N_ID']] = $row;
											$count++;
										}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
											$row['CN_Status'] = 2;
											$bottomNews[$row['N_ID']] = $row;
											$count++;
										}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
											$row['CN_Status'] = 2;
											$rightNews[$row['N_ID']] = $row;
											$count++;
										}
									}
									if($count>=$limit) break;    
								}
							}
						}

						if($count<$limit) {
							$temp_rightNews  = $this->common_model->custom_query("SELECT * FROM news WHERE N_Allow = '1' AND CN_ID = {$cRow['CN_ID']} ORDER BY N_DateTimeUpdate DESC,N_ID DESC limit {$limit}");

							// $temp_rightNews  = array();
							if(count($temp_rightNews) > 0) {
								foreach ($temp_rightNews as $key=>$row) {
									if(count($topNews) < 1) {
										$row['CN_Status'] = 3;
										$topNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($bottomNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 3;
										$bottomNews[$row['N_ID']] = $row;
										$count++;
									}else if(count($rightNews)<4 && !isset($topNews[$row['N_ID']]) && !isset($bottomNews[$row['N_ID']]) && !isset($rightNews[$row['N_ID']])) {
										$row['CN_Status'] = 3;
										$rightNews[$row['N_ID']] = $row;
										$count++;
									} 
									if($count>=$limit) break;
								}
							}
						}

						if(count($topNews)>0) {
							$topNews = $topNews[key($topNews)];
						}
						break;
				}
				
				///// News Tabs /////
				if(!empty($topNews)||!empty($bottomNews)||!empty($rightNews)){
					$data = array('topNews'=>$topNews,
						'bottomNews'=>$bottomNews,
						'rightNews'=>$rightNews,
						'cRow'=>$cRow,
						'disMode'=>$disMode,
						'nCount'=>$nCount
					);
								
					if(get_inpost('first')=='0') {
						$response = $this->load->view('web_template1/content/tabsNews/tab_data',$data,TRUE);
						echo $response;                            
					}else {
						$response = $this->load->view('web_template1/content/tabsNews/tab_data1',$data,TRUE);
						echo $response; 
					}
				}else{
					$response = $this->load->view('web_template1/content/tabsNews/tab_no_data','',TRUE);
					echo $response;
				}
			}else {
				$response = $this->load->view('web_template1/content/tabsNews/tab_no_data','',TRUE);
				echo $response;
			}
		}else {
			$response = $this->load->view('web_template1/content/tabsNews/tab_no_data','',TRUE);
			echo $response;
		}
		$this->db->close();
	}
}