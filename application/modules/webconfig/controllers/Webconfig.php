<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webconfig extends MX_Controller {

	function __construct() {
		parent::__construct();

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		);

	}
	
	function __deconstruct() {
		$this->db->close();
	}	
	
	public function main($process_action='View'){
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 74;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();
			$data['news_list'] = $this->webinfo_model->newsList();
			//dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_js_asset_footer('webconfig.js','webconfig'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'webconfig';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'webconfig');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}
	
	
	public function webconfig_about($process_action='View') {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 76;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();
			$data['about_list'] = $this->webinfo_model->aboutList();
			//dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_js_asset_footer('webconfig_about.js','webconfig'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'webconfig_about';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'webconfig');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}
	
	public function infrm2($process_action='Add', $about_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 76;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			
			//dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/
			
			// style.css
			set_css_asset_head('style.css', 'webconfig');
			set_js_asset_footer('infrm2.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'inform2';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			if ($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				
				
			} else if ($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				
				$frm->set_rules("about_title", "ชื่อเกี่ยวกับเรา", "required");
				$frm->set_rules("about_detail", "รายละเอียดเกี่ยวกับเรา", "required");
				
				if ($frm->run($this)) {
					$data_insert = array();
					
					$data_insert["about_title"] = get_inpost("about_title");
					$data_insert["about_detail"] = get_inpost("about_detail");
					$data_insert["insert_user_id"] = get_session('user_id');
					$data_insert["insert_datetime"] = date("Y-m-d H:i:s");
					
					$this->common_model->insert("web_about", $data_insert);
					$this->session->set_flashdata('msg',setMsg('011'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/webconfig_about", "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$result = $this->webinfo_model->getDataAbout($about_id);
				$data['about_title'] = $result['about_title'];
				$data['about_detail'] = $result['about_detail'];
				$data['about_id'] = $result['about_id'];
				//dieArray($data['news_images']);
				$this->template->load('index_page',$data,'webconfig');
			} else if ($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				//dieArray($this->input->post());
				$this->load->library('form_validation');
				$result = $this->webinfo_model->getDataAbout($about_id);
				$frm=$this->form_validation;
				
				$frm->set_rules("about_title", "ชื่อเกี่ยวกับเรา", "required");
				$frm->set_rules("about_detail", "รายละเอียดเกี่ยวกับเรา", "required");
				
				if ($frm->run($this)) {
					$data_update = array();
					$data_update["about_title"] = get_inpost("about_title");
					$data_update["about_detail"] = get_inpost("about_detail");
					$data_update["update_user_id"] = get_session('user_id');
					$data_update["update_datetime"] = date("Y-m-d H:i:s");
					
					$this->common_model->update("web_about", $data_update, array('about_id'=>$about_id));
					$this->session->set_flashdata('msg',setMsg('021'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/infrm2/Edit/".$about_id, "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Delete' && $usrpm['perm_status']=='Yes') {
				$data_update = array();
				$data_update['delete_user_id'] 	= getUser();
				$data_update['delete_datetime'] = getDatetime();

				$this->common_model->update('web_about',$data_update,array('about_id'=>$about_id));
				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect("webconfig/webconfig_about", "refresh");
			} else {
				page500();
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}
	
	public function webconfig_news($process_action='View') {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 77;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();
			$data['news_list'] = $this->webinfo_model->newsList();
			//dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/
			
			set_css_asset_head('style.css','webconfig'); 
			set_js_asset_footer('webconfig_news.js','webconfig'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'webconfig_news';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'webconfig');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}
	
	public function infrm1($process_action='Add', $news_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 77;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			
			//dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/
			
			set_css_asset_head('style.css','webconfig'); 
			set_js_asset_footer('infrm1.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'inform1';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			if ($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				
				
			} else if ($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				
				$frm->set_rules("news_name", "ชื่อข่าวประสัมพันธ์", "required");
				$frm->set_rules("news_detail", "ชื่อข่าวประสัมพันธ์", "required");
				
				if ($frm->run($this)) {
					$data_insert = array();
					$data_insert["news_image_title"] = $this->files_model->getOnceImg("news_images", "assets/modules/webconfig/images");
					if ($_FILES['images']['name'][0] != "") {
						$data_insert["news_images"] = serialize($this->files_model->getMultiImg("images", "assets/modules/webconfig/images"));
					}
					
					if ($_FILES['files']['name'][0] != "") {
						$data_insert["news_document"] = serialize($this->files_model->do_multi_upload("files", "assets/modules/webconfig/uploads"));
					}
					
					
					$data_insert["news_name"] = trim($this->input->post("news_name"));
					$data_insert["news_detail"] = $this->input->post("news_detail");
					$data_insert["news_announcer"] = $this->input->post("news_announcer");
					$data_insert["news_post"] = dateChange($this->input->post('news_post'), 2);
					$data_insert["insert_user_id"] = get_session('user_id');
					$data_insert["insert_datetime"] = date("Y-m-d H:i:s");
					
					$this->common_model->insert("web_news", $data_insert);
					$this->session->set_flashdata('msg',setMsg('011'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/webconfig_news", "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$result = $this->webinfo_model->getDataNews($news_id);
				$data['news_image_title'] = $result['news_image_title'];
				$data['news_name'] = $result['news_name'];
				$data['news_detail'] = $result['news_detail'];
				$data['news_images'] = unserialize($result['news_images']);
				$data['news_announcer'] = $result['news_announcer'];
				$data['news_document'] = $result['news_document'];
				$data['news_post'] = $result['news_post'];
				$data['news_view'] = $result['news_view'];
				$data['news_id'] = $result['news_id'];
				//dieArray($data['news_images']);
				$this->template->load('index_page',$data,'webconfig');
			} else if ($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				//dieArray($this->input->post());
				$this->load->library('form_validation');
				$result = $this->webinfo_model->getDataNews($news_id);
				$frm=$this->form_validation;
				
				$frm->set_rules("news_name", "ชื่อข่าวประสัมพันธ์", "required");
				$frm->set_rules("news_detail", "ชื่อข่าวประสัมพันธ์", "required");
				
				if ($frm->run($this)) {
					$data_update = array();
					if ($_FILES['news_images']['name'] != "") {
						$data_update["news_image_title"] = $this->files_model->getOnceImg("news_images", "assets/modules/webconfig/images");
					}
					
					if ($_FILES['images']['name'][0] != "") {
						if ($result['news_images'] != "") {
							$imageOld = unserialize($result['news_images']);
							$imageNew = $this->files_model->getMultiImg("images", "assets/modules/webconfig/images");
							$merge	= array_merge($imageOld, $imageNew);
							$allImage = array_values($merge);
							$data_update["news_images"] = serialize($allImage);
						} else {
							$data_update["news_images"] = serialize($this->files_model->getMultiImg("images", "assets/modules/webconfig/images"));
						}	
					}
					
					if ($_FILES['files']['name'][0] != "") {
						if ($result['news_document'] != "") {
							$imageOld = unserialize($result['news_document']);
							$imageNew = $this->files_model->do_multi_upload("files", "assets/modules/webconfig/uploads");
							$merge	= array_merge($imageOld, $imageNew);
							$allImage = array_values($merge);
							$data_update["news_document"] = serialize($allImage);
						} else {
							$data_update["news_document"] = serialize($this->files_model->do_multi_upload("files", "assets/modules/webconfig/uploads"));
						}	
					}
					
					$data_update["news_name"] = trim($this->input->post("news_name"));
					$data_update["news_detail"] = $this->input->post("news_detail");
					$data_update["news_announcer"] = $this->input->post("news_announcer");
					$data_update["news_post"] = dateChange($this->input->post('news_post'), 2);
					$data_update["update_user_id"] = get_session('user_id');
					$data_update["update_datetime"] = date("Y-m-d H:i:s");
					
					$this->common_model->update("web_news", $data_update, array('news_id'=>$news_id));
					$this->session->set_flashdata('msg',setMsg('021'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/infrm1/Edit/".$news_id, "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Delete' && $usrpm['perm_status']=='Yes') {
				$data_update = array();
				$data_update['delete_user_id'] 	= getUser();
				$data_update['delete_datetime'] = getDatetime();

				$this->common_model->update('web_news',$data_update,array('news_id'=>$news_id));
				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect("webconfig/webconfig_news", "refresh");
			} else {
				page500();
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}

	public function deleteNewsImage($news_id=0) {
		$result = $this->webinfo_model->getDataNews($news_id);
		if (COUNT($result) > 0) {
			$data_update['news_image_title'] = "";
			$this->common_model->update("web_news", $data_update, "news_id = '$news_id'");
			$this->session->set_flashdata('msg',setMsg('021'));
			redirect("webconfig/infrm1/Edit/".$news_id, "refresh");	
		} else {
			page500();
			$this->template->load('index_page',$data,'webconfig');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
		}
		
	}
	
	public function delete_news_document($id) {
		$arr = explode('-', $id);
		$news_id = $arr[1];
		$index = $arr[0];
		$result = $this->webinfo_model->getDataNews($news_id);
		//dieArray($result);
		$document = unserialize($result['news_document']);
		unset($document[$index]);
		$newsAll = array_values($document);
		$data_update['news_document'] = serialize($newsAll); 
		$this->common_model->update("web_news", $data_update, "news_id = '$news_id'");
		$this->session->set_flashdata('msg',setMsg('021'));
		redirect("webconfig/infrm1/Edit/".$news_id, "refresh");
	}
	
	public function delete_image($news_id=0, $image=0) {
		$result = $this->webinfo_model->getDataNews($news_id);
		$images = unserialize($result['news_images']);
		unset($images[$image]);
		$newsAll = array_values($images);
		
		$data_update["news_images"] = serialize($newsAll);
		$this->common_model->update("web_news", $data_update, "news_id = '$news_id'");
		$this->session->set_flashdata('msg',setMsg('021'));
		redirect("webconfig/infrm1/Edit/".$news_id, "refresh");
	}
	
	public function webconfig_detail($process_action='Edit', $web_id=1) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 75;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/
		
		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_js_asset_footer('web_detail.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'webconfig_detail';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];
			//dieArray($this->input->post("bt_submit"));
			if ($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				
				$web = $this->webinfo_model->getDataWebDetail();
				$data['web_title'] = $web['web_title'];
				$data['web_icon'] = $web['web_icon'];
				$data['web_logo'] = $web['web_logo'];
				$data['web_background_image'] = $web['web_background_image'];
				$data['web_address'] = $web['web_address'];
				$data['web_phone'] = $web['web_phone'];
				$data['web_fax'] = $web['web_fax'];
				$data['web_email'] = $web['web_email'];
				$data['web_keyword'] = $web['web_keyword'];
				$data['web_description'] = $web['web_description'];
				$data['web_author'] = $web['web_author'];
				$data['web_condition_link'] = $web['web_condition_link'];
				$data['web_policy_link'] = $web['web_policy_link'];
				$data['web_privacy_policy_link'] = $web['web_privacy_policy_link'];
				$data['web_security_policy_link'] = $web['web_security_policy_link'];
				$data['slide'] = $this->webinfo_model->getDataSlide();
				$this->template->load('index_page',$data,'webconfig');
			} else if ($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				//dieArray($data);
				$this->load->library('form_validation');
				$result = $this->webinfo_model->getDataWebDetail($web_id);
				$frm=$this->form_validation;
				
				$frm->set_rules("web_title", "ชื่อเว็บไซต์", "required");
				$frm->set_rules("web_address", "ที่อยู่", "required");
				
				if ($frm->run($this)) {
					$data_update = array();
					
					if (@$_FILES['web_icon']['name'] != "") {
						$data_update["web_icon"] = $this->files_model->getOnceImg("web_icon", "assets/modules/webconfig/images");
					}
					
					if (@$_FILES['web_logo']['name'] != "") {
						$data_update["web_logo"] = $this->files_model->getOnceImg("web_logo", "assets/modules/webconfig/images");
					}
					
					$data_update["web_title"] = trim($this->input->post("web_title"));
					$data_update["web_address"] = $this->input->post("web_address");
					$data_update["web_phone"] = $this->input->post("web_phone");
					$data_update["web_fax"] = $this->input->post("web_fax");
					$data_update["web_email"] = $this->input->post("web_email");
					$data_update["web_keyword"] = $this->input->post("web_keyword");
					$data_update["web_description"] = $this->input->post("web_description");
					$data_update["web_author"] = $this->input->post("web_author");
					$data_update["web_condition_link"] = $this->input->post("web_condition_link");
					$data_update["web_policy_link"] = $this->input->post("web_policy_link");
					$data_update["web_privacy_policy_link"] = $this->input->post("web_privacy_policy_link");
					$data_update["web_security_policy_link"] = $this->input->post("web_security_policy_link");
					
					$this->common_model->update("web_detail", $data_update, array('web_id'=>$web_id));
					$this->session->set_flashdata('msg',setMsg('021'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/webconfig_detail/Edit/".$web_id, "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			}  else {
				page500();
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
		
	}
	
	public function delete_icon() {
		$result = $this->webinfo_model->getDataWebDetail(1);
		$data_update["web_icon"] = NULL;
		
		$this->common_model->update("web_detail", $data_update, "web_id = '1'");
		$this->session->set_flashdata('msg',setMsg('021'));
		redirect("webconfig/webconfig_detail/Edit/1", "refresh");
	}
	
	public function delete_logo() {
		$result = $this->webinfo_model->getDataWebDetail(1);
		$data_update["web_logo"] = NULL;
		
		$this->common_model->update("web_detail", $data_update, "web_id = '1'");
		$this->session->set_flashdata('msg',setMsg('021'));
		redirect("webconfig/webconfig_detail/Edit/1", "refresh");
	}
	
	public function webconfig_slide($process_action='View', $web_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 77;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/
		
		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_js_asset_footer('web_slide.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'webconfig_slide';
			$data['slide'] = $this->webinfo_model->getDataSlide();
			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];
			$this->template->load('index_page',$data,'webconfig');
		}
	}
	
	public function infrm3($process_action='Add', $slide_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 78;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			
			//dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_js_asset_footer('infrm3.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'inform3';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			if ($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				
			} else if ($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				
				$frm->set_rules("slide_name", "ชื่อข่าวประสัมพันธ์", "required");
				
				if ($frm->run($this)) {
					$data_insert = array();
					$data_insert["slide_image"] = $this->files_model->getOnceImg("slide_image", "assets/modules/webconfig/images");
					
					
					$data_insert["slide_name"] = trim($this->input->post("slide_name"));
					$data_insert["slide_link"] = $this->input->post("slide_link");
					$data_insert["slide_status"] = (int)$this->input->post("slide_status");
					$data_insert["insert_user_id"] = get_session('user_id');
					$data_insert["insert_datetime"] = date("Y-m-d H:i:s");
					
					$this->common_model->insert("web_slide", $data_insert);
					$this->session->set_flashdata('msg',setMsg('011'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/webconfig_detail", "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$result = $this->webinfo_model->getDataSlideRow($slide_id);
				$data['slide_name'] = $result['slide_name'];
				$data['slide_image'] = $result['slide_image'];
				$data['slide_link'] = $result['slide_link'];
				$data['slide_status'] = $result['slide_status'];
				$data['slide_id'] = $result['slide_id'];
				//dieArray($data['news_images']);
				$this->template->load('index_page',$data,'webconfig');
			} else if ($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				
				$frm->set_rules("slide_name", "ชื่อข่าวประสัมพันธ์", "required");
				
				if ($frm->run($this)) {
					$data_update = array();
					if (@$_FILES['slide_image']['name'] != "") {
						$data_update["slide_image"] = $this->files_model->getOnceImg("slide_image", "assets/modules/webconfig/images");
					}
					
					
					$data_update["slide_name"] = trim($this->input->post("slide_name"));
					$data_update["slide_link"] = $this->input->post("slide_link");
					$data_update["slide_status"] = (int)$this->input->post("slide_status");
					$data_update["update_user_id"] = get_session('user_id');
					$data_update["update_datetime"] = date("Y-m-d H:i:s");
					
					$this->common_model->update("web_slide", $data_update, array('slide_id'=>$slide_id));
					$this->session->set_flashdata('msg',setMsg('021'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/infrm3/Edit/".$slide_id, "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Delete' && $usrpm['perm_status']=='Yes') {
				$data_update = array();
				$data_update['delete_user_id'] 	= getUser();
				$data_update['dalete_datetime'] = getDatetime();

				$this->common_model->update('web_slide',$data_update,array('slide_id'=>$slide_id));
				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect("webconfig", "refresh");
			} else {
				page500();
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}
	
	public function delete_image_slide($slide_id = 0) {
		$result = $this->webinfo_model->getDataWebDetail(1);
		$data_update["slide_image"] = NULL;
		
		$this->common_model->update("web_slide", $data_update, "slide_id = '$slide_id'");
		$this->session->set_flashdata('msg',setMsg('021'));
		redirect("webconfig/infrm3/Edit/".$slide_id, "refresh");
	}
	
	public function webconfig_event($process_action='View', $web_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 78;
		$process_path = 'welfare/welfare_list';
		/*--END Inizial Data for Check User Permission--*/
		
		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_css_asset_head('style.css', 'webconfig');
			set_js_asset_footer('web_event.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'webconfig_event';
			$data['event'] = $this->webinfo_model->getDataEvent();
			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];
			$this->template->load('index_page',$data,'webconfig');
		}
	}
	
	public function infrm4($process_action='Add', $event_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 78;
		$process_path = 'webconfig/webconfig_event';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;
			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();
			//dieArray($data);
			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/
			set_css_asset_head('style.css', 'webconfig');
			set_js_asset_footer('infrm4.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'inform4';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			if ($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				
			} else if ($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				
				$frm->set_rules("event_name", "ชื่อกิจกรรม", "required");
				$frm->set_rules("event_date_start", "วันที่เริ่มกิจกรรม", "required");
				$frm->set_rules("event_date_end", "วันที่สิ้นสุดกิจกรรม", "required");
				
				if ($frm->run($this)) {
					$data_insert = array();
					//dieArray($_FILES['event_files']);
					if ($_FILES['event_files']['name'][0] != "") {
						$data_insert["event_files"] = serialize($this->files_model->do_multi_upload("event_files", "assets/modules/webconfig/uploads"));
					}
					$data_insert['event_name'] = trim($this->input->post('event_name'));
					$data_insert['event_detail'] = $this->input->post('event_detail');
					$data_insert['event_date_start'] = dateChange($this->input->post('event_date_start'), 2);
					$data_insert['event_date_end'] = dateChange($this->input->post('event_date_end'), 2);
					$data_update['event_time'] = $this->input->post('event_time');
					$data_update['event_post'] = $this->input->post('event_post');
					$data_insert["insert_user_id"] = get_session('user_id');
					$data_insert["insert_datetime"] = date("Y-m-d H:i:s");
					//dieArray($data_insert);
					$this->common_model->insert("web_event", $data_insert);
					$this->session->set_flashdata('msg',setMsg('011'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/webconfig_event", "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$result = $this->webinfo_model->getDataEventRow($event_id);
				$data['event_name'] = $result['event_name'];
				$data['event_detail'] = $result['event_detail'];
				$data['event_date_start'] = $result['event_date_start'];
				$data['event_date_end'] = $result['event_date_end'];
				$data['event_time'] = $result['event_time'];
				$data['event_post'] = $result['event_post'];
				$data['event_files'] = $result['event_files'];
				$data['event_id'] = $result['event_id'];
				//dieArray($data['news_images']);
				$this->template->load('index_page',$data,'webconfig');
			} else if ($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				$result = $this->webinfo_model->getDataEventRow($event_id);
				$frm->set_rules("event_name", "ชื่อกิจกรรม", "required");
				
				if ($frm->run($this)) {
					$data_update = array();
					$data_update['event_name'] = trim($this->input->post('event_name'));
					$data_update['event_detail'] = $this->input->post('event_detail');
					
					$data_update['event_date_start'] = dateChange($this->input->post('event_date_start'), 2);
					$data_update['event_date_end'] = dateChange($this->input->post('event_date_end'), 2);
					$data_update['event_time'] = $this->input->post('event_time');
					$data_update['event_post'] = $this->input->post('event_post');
					
					if ($_FILES['event_files']['name'][0] != "") {
						if ($result['event_files'] != "") {
							$imageOld = unserialize($result['event_files']);
							$imageNew = $this->files_model->do_multi_upload("event_files", "assets/modules/webconfig/uploads");
							$merge	= array_merge($imageOld, $imageNew);
							$allImage = array_values($merge);
							$data_update["event_files"] = serialize($allImage);
						} else {
							$data_update["event_files"] = serialize($this->files_model->do_multi_upload("event_files", "assets/modules/webconfig/uploads"));
						}	
					}
					//$data_update['event_files'] = $this->input->post('event_detail');
					
					$data_update["update_user_id"] = get_session('user_id');
					$data_update["update_datetime"] = date("Y-m-d H:i:s");
					//dieArray($data_update);
					$this->common_model->update("web_event", $data_update, array('event_id'=>$event_id));
					$this->session->set_flashdata('msg',setMsg('021'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/infrm4/Edit/".$event_id, "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Delete' && $usrpm['perm_status']=='Yes') {
				$data_update = array();
				$data_update['delete_user_id'] 	= getUser();
				$data_update['delete_datetime'] = getDatetime();

				$this->common_model->update('web_event',$data_update,array('event_id'=>$event_id));
				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect("webconfig/webconfig_event", "refresh");
			} else {
				page500();
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}
	
	public function delete_file_event($id=0) {
		$arr = explode('-', $id);
		$event_id = $arr[1];
		$fileIndex = $arr[0];
		$resultFile = rowArray($this->common_model->get_where_custom_and("web_event", "event_id = '$event_id'"));
		$files = unserialize($resultFile['event_files']);
		unset($files[$fileIndex]);
		$data_update['event_files'] = serialize($files);
		
		$this->common_model->update("web_event", $data_update, array('event_id'=>$event_id));
		$this->session->set_flashdata('msg',setMsg('021'));
		redirect("webconfig/infrm4/Edit/".$event_id, "refresh");
	}
	
	public function webconfig_article($process_action='View', $web_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 77;
		$process_path = 'webconfig/webconfig_article';
		/*--END Inizial Data for Check User Permission--*/
		
		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_js_asset_footer('web_article.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'webconfig_article';
			$data['article'] = $this->webinfo_model->getDataArticle();
			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];
			$this->template->load('index_page',$data,'webconfig');
		}
	}
	
	public function infrm5($process_action='Add', $article_id=0) {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 77;
		$process_path = 'webconfig/webconfig_event';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission
		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			//$data['welfare_info'] = $this->welfare_model->getAll_admInfo();

			
			//dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/
			
			/*-- Style --*/
			set_css_asset_head('style.css', 'webconfig');
			set_js_asset_footer('infrm5.js','webconfig'); //Set JS Index.js
			$data['process_action'] = $process_action;
			$data['content_view'] = 'inform5';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			if ($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				
			} else if ($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				
				$frm->set_rules("article_name", "ชื่อบทความ", "required");
				
				if ($frm->run($this)) {
					$data_insert = array();
					$data_insert['article_name'] = trim($this->input->post('article_name'));
					$data_insert['article_detail'] = $this->input->post('article_detail');
					$data_insert['article_view'] = 0;
					$data_insert['insert_user_id'] = get_session('user_id');
					$data_insert['insert_datetime'] = date("Y-m-d H:i:s");
					$this->common_model->insert("web_article", $data_insert);
					$this->session->set_flashdata('msg',setMsg('011'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/webconfig_article", "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$result = $this->webinfo_model->getDataArticleRow($article_id);
				$data['article_name'] = $result['article_name'];
				$data['article_detail'] = $result['article_detail'];
				$data['article_id'] = $result['article_id'];
				$this->template->load('index_page',$data,'webconfig');
			} else if ($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') {
				$this->load->library('form_validation');
				$frm=$this->form_validation;
				
				$frm->set_rules("article_name", "ชื่อบทความ", "required");
				
				if ($frm->run($this)) {
					$data_update = array();
					$data_update['article_name'] = trim($this->input->post('article_name'));
					$data_update['article_detail'] = $this->input->post('article_detail');
					$data_update['update_user_id'] = get_session('user_id');
					$data_update['update_datetime'] = date("Y-m-d H:i:s");
					$this->common_model->update("web_article", $data_update, array('article_id'=>$article_id));
					$this->session->set_flashdata('msg',setMsg('021'));
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success');
					redirect("webconfig/infrm5/Edit/".$article_id, "refresh");
				} else {
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 01
					$this->template->load('index_page',$data,'webconfig');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}
			} else if ($process_action=='Delete' && $usrpm['perm_status']=='Yes') {
				$data_update = array();
				$data_update['delete_user_id'] 	= getUser();
				$data_update['delete_datetime'] = getDatetime();

				$this->common_model->update('web_article',$data_update,array('article_id'=>$article_id));
				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect("webconfig/webconfig_article", "refresh");
			} else {
				page500();
				$this->template->load('index_page',$data,'webconfig');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}
}
