<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prepare extends MX_Controller {

	function __construct() {
		parent::__construct();

		chkUserLogin();

	}
	function __deconstruct() {
		$this->db->close();
	}

	public function download($file_id=0){
		$temp = rowArray($this->common_model->custom_query("SELECT * FROM prep_dkm_info_file WHERE dkm_file_id = {$file_id}"));
		if(!empty($temp)){
			$this->load->helper('download');
			$arr = @explode('.',$temp['dkm_file']);
			$file = rawurlencode($temp['dkm_file']);
			$file = str_replace("%2F","/",$file);
			$pth = file_get_contents(base_url('assets/modules/prepare/uploads/'.$file));
			// dieFont(base_url('assets/modules/news/uploads/'.rawurlencode($temp['dkm_file'])));
			$nme = downloadName($temp['dkm_file_label']).'.'.$arr[count($arr)-1];
			force_download($nme, $pth);
		}
	}

	public function prepare_list($process_action='View') { // ตารางข้อมูล
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 54;
		$process_path = 'prepare/prepare_list';
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

			$data['prep_dkm_info'] = $this->common_model->custom_query("
				SELECT * FROM prep_dkm_info
				WHERE delete_user_id IS NULL 
                AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
                ORDER BY update_datetime DESC,insert_datetime DESC
			");

			// dieArray($data);

			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			// set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			// set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/
    		/*-- Toastr style --*/
    		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
    		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
    		/*-- End Toastr style --*/

			set_js_asset_footer('prepare_list.js','prepare'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'prepare_list';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'prepare');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}

	}

	public function date_check($str) {
    //$str = str_replace("-","",$str);
		if(strlen($str)==10) {
      $year = iconv_substr($str,6,4,'utf-8');
      //settype("integer",$year);
      $year = $year-543;
			if(checkdate(iconv_substr($str,3,2,'utf-8'),iconv_substr($str,0,2,'utf-8'),$year)){	
				return true;
			}
			else{
				return false;
			}
		}else return false;
	}

	private function clr_diffInfo_form1() {
		return array(
					'date_of_req' => date('d-m-Y'),
					'req_pers_id' => '',
					'req_pid' => '',
					'req_name' => ' - ',
					'req_date_of_birth' => ' - ',
					'req_gender_name' => ' - ',
					'req_nation_name_th' => ' - ',
					'req_relg_title' => ' - ',
					'req_position' => '',
					'req_org' => '',
					'req_relation' => '',
					'req_tel_no_home' => '',
					'req_tel_no_mobile' => '',
					'req_fax_no' => '',
					'req_email_addr' => '',
					'chn_code' => '',

					'pid' => '',
					'pers_id' => '',
					'name' => ' - ',
					'date_of_birth' => ' - ',
					'gender_name' => ' - ',
					'nation_name_th' => ' - ',
					'relg_title' => ' - ',
					'tel_no_home' => '',
					'tel_no_mobile' => '',
					'fax_no' => '',
					'email_addr' => '',
					'reg_addr_id' => '',
					'pre_addr_id' => ''
		);
	}

	public function get_option(){
		$code = get_inpost('code');
		$type = get_inpost('type');
		// dieArray($_POST);
		$opRows = array();
		if($type == 'sub1'){
			$subCode = substr($code,0,2);
		}else if($type == 'sub2'){
			$subCode = substr($code,0,4);
		}
		$tmp = rowArray($this->common_model->custom_query("SELECT * FROM std_dkm_cate WHERE dkm_cate_code = '{$code}' "));
		if(!empty($tmp)){
			$opRows = $this->common_model->custom_query("
				SELECT dkm_cate_code,dkm_cate_name FROM std_dkm_cate 
				WHERE dkm_cate_parent_id = {$tmp['dkm_cate_id']}
				AND dkm_cate_code LIKE '{$subCode}%'
				ORDER BY dkm_cate_code ASC
			");
		}

		echo json_encode($opRows);
		// dieArray($opRows);
	}

	private function getInputCate($input=array()){
		$tmp = $input;
		foreach ($input as $i => $value) {
			if($value == ''){
				unset($tmp[$i]);
			}
		}
		return end($tmp);
	}

	public function prepare_info($process_action='Add',$dkm_id=0) { 
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');

		$app_id = 54;
		$process_path = 'prepare/prepare_info';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;


			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

      /*-- datepicker --*/
      //set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
      //set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
      /*-- End datepicker --*/
      
      /*-- datepicker custom --*/
      set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
      /*-- End datepicker custom--*/

  		/*-- Toastr style --*/
  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
  		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
  		/*-- End Toastr style --*/

  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/switchery/switchery.css');
  		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/switchery/switchery.js');

  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/jasny/jasny-bootstrap.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/jasny/jasny-bootstrap.min.js');

  		set_js_asset_footer('prepare_info.js','prepare'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'prepare_info';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			if($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {

				$data['prep_dkm_info'] = array(
					'dkm_cate_code' => '',
					'dkm_title' => '',
					'dkm_describe' => '',
					'dkm_provider' => '',
					'public_status' => 'ไม่เผยแพร่',

					'stat_views' => '0',
					'stat_tests' => '0',
					'stat_comments' => '0',
				);

				$this->template->load('index_page',$data,'prepare');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
			}else if($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes'){ //Add && Submit Form

				$_POST['prep_dkm_info']['dkm_cate_code'] = $this->getInputCate(get_inpost_arr('dkm_cate_code'));

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('prep_dkm_info[dkm_title]','ชื่อองค์ความรู้','required');
				$frm->set_rules('prep_dkm_info[dkm_cate_code]','ประเภทองค์ความรู้','required');
				// $frm->set_rules('prep_dkm_info[pers_id]','เลขประจำตัวประชาชน (ผู้สูงอายุ)','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				if($frm->run($this)){//Valid Data
					$data_insert = array();
					$data_insert = get_inpost_arr('prep_dkm_info');

					$data_insert['insert_user_id'] = getUser();
					$data_insert['insert_org_id'] = get_session('org_id');
					$data_insert['insert_datetime'] = getDatetime();

					$att_tmb_file = $this->files_model->getOnceImg('att_tmb_file',"assets/modules/prepare/images");
					if($att_tmb_file != ''){
						$data_insert['att_tmb_file'] = $att_tmb_file;
						$data_insert['att_tmb_label'] = $_FILES['att_tmb_file']['name'];
						$data_insert['att_tmb_size'] = $_FILES['att_tmb_file']['size'];
					}

					// dieArray($data_insert);
					$id = $this->common_model->insert('prep_dkm_info',$data_insert);
					$count_files = count($_FILES['fileAtt']['size']);
					foreach ($_FILES['fileAtt']['size'] as $i => $value) {
						$_FILES['tempFile']['name'] 		= $_FILES['fileAtt']['name'][$i];
						$_FILES['tempFile']['type']     = $_FILES['fileAtt']['type'][$i];
            $_FILES['tempFile']['tmp_name'] = $_FILES['fileAtt']['tmp_name'][$i];
            $_FILES['tempFile']['error']    = $_FILES['fileAtt']['error'][$i];
            $_FILES['tempFile']['size']     = $_FILES['fileAtt']['size'][$i];
            

            $att_files = $this->files_model->do_upload('tempFile',"assets/modules/prepare/uploads");

            $data_files = array(
            	'dkm_id' => $id,
            	'dkm_file' => $att_files,
            	// 'dkm_file_label' => $_FILES['tempFile']['name'],
            	'dkm_file_label' => get_inpost("fileDes[{$i}]"),
            	'dkm_file_size' => $_FILES['tempFile']['size'],
            );

            $this->common_model->insert('prep_dkm_info_file',$data_files);
					}

					$this->session->set_flashdata('msg',setMsg('011')); //Set Message code 011

					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

					redirect('prepare/prepare_info/Edit/'.$id,'refresh');
				}else {
					$data['prep_dkm_info'] = get_inpost_arr('prep_dkm_info');
					$data['stat_views'] = 0;
					$data['stat_tests'] = 0;
					$data['stat_comments'] = 0;

					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 012

					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$row = rowArray($this->common_model->custom_query("
					SELECT * FROM prep_dkm_info
					WHERE dkm_id = {$dkm_id}
					AND delete_user_id IS NULL 
					AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
					ORDER BY update_datetime DESC,insert_datetime DESC
				"));

				if(isset($row['dkm_id'])) {
					$data['prep_dkm_info'] = $row;
					$data['prep_dkm_info_file'] = $this->common_model->custom_query("SELECT * FROM prep_dkm_info_file WHERE dkm_id = {$dkm_id}");

					// dieArray($data);
					$this->template->load('index_page',$data,'prepare');
				}else {
					page500();
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') { //Edit && Submit Form
				$process_action='Edited';
				$_POST['prep_dkm_info']['dkm_cate_code'] = $this->getInputCate(get_inpost_arr('dkm_cate_code'));

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('prep_dkm_info[dkm_title]','ชื่อองค์ความรู้','required');
				$frm->set_rules('prep_dkm_info[dkm_cate_code]','ประเภทองค์ความรู้','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				$tmp = rowArray($this->common_model->custom_query("
					SELECT * FROM prep_dkm_info
					WHERE dkm_id = {$dkm_id}
					AND delete_user_id IS NULL 
					AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
					ORDER BY update_datetime DESC,insert_datetime DESC
				"));

				if($frm->run($this)){//Valid Data

					$data_update = array();
					$data_update = get_inpost_arr('prep_dkm_info');

					$data_update['insert_user_id'] = getUser();
					$data_update['insert_org_id'] = get_session('org_id');
					$data_update['insert_datetime'] = getDatetime();

					$att_tmb_file = $this->files_model->getOnceImg('att_tmb_file',"assets/modules/prepare/images");
					if($att_tmb_file != ''){

						@unlink("assets/modules/prepare/images/{$tmp['att_tmb_file']}");

						$data_update['att_tmb_file'] = $att_tmb_file;
						$data_update['att_tmb_label'] = $_FILES['att_tmb_file']['name'];
						$data_update['att_tmb_size'] = $_FILES['att_tmb_file']['size'];
					}

					// dieArray($data_update);
					$this->common_model->update('prep_dkm_info',$data_update,array('dkm_id'=>$dkm_id));


					$count_files = count($_FILES['fileAtt']['size']);
					foreach ($_FILES['fileAtt']['size'] as $i => $value) {
						$_FILES['tempFile']['name'] 		= $_FILES['fileAtt']['name'][$i];
						$_FILES['tempFile']['type']     = $_FILES['fileAtt']['type'][$i];
            $_FILES['tempFile']['tmp_name'] = $_FILES['fileAtt']['tmp_name'][$i];
            $_FILES['tempFile']['error']    = $_FILES['fileAtt']['error'][$i];
            $_FILES['tempFile']['size']     = $_FILES['fileAtt']['size'][$i];
            

            $att_files = $this->files_model->do_upload('tempFile',"assets/modules/prepare/uploads");

            $data_files = array(
            	'dkm_id' => $id,
            	'dkm_file' => $att_files,
            	// 'dkm_file_label' => $_FILES['tempFile']['name'],
            	'dkm_file_label' => get_inpost("fileDes[{$i}]"),
            	'dkm_file_size' => $_FILES['tempFile']['size'],
            );

            $this->common_model->insert('prep_dkm_info_file',$data_files);
          }

					$this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021

					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

					redirect('prepare/prepare_info/Edit/'.$dkm_id,'refresh');


				}else {
					$data['prep_dkm_info'] = $_POST['prep_dkm_info'];
					$data['rd_pers_id'] = set_value('rd_pers_id');
					$data['rd_req_pers_id'] = set_value('rd_req_pers_id');
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 022
					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Delete' && $usrpm['perm_status']=='Yes') { //Delete process
				$data_update = array();
				$data_update['delete_user_id'] = getUser();
				$data_update['delete_datetime'] = getDatetime();

				$this->common_model->update('prep_dkm_info',$data_update,array('dkm_id'=>$dkm_id));
				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect('prepare/assist_list','refresh');
			}else {

				page500();
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}

	public function quiz_info($process_action='Add',$dkm_id=0){

		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$org_id = get_session('org_id');
		$app_id = 55;
		$process_path = 'prepare/quiz_info';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- datepicker --*/
			// set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
			// set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
			/*-- End datepicker --*/

  		/*-- Toastr style --*/
  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
  		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
  		/*-- End Toastr style --*/

  		set_js_asset_footer('quiz_info.js','prepare'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'quiz_info';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			if($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {

				$data['prep_dkm_exr'] = $this->common_model->custom_query("SELECT * FROM prep_dkm_exr WHERE  dkm_id = NULL ");


				$this->template->load('index_page',$data,'prepare');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				
			}else if($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes'){ //Add && Submit Form
				//dieArray($_POST);
				$this->load->library('form_validation');
				$frm=$this->form_validation;

			//	$frm->set_rules('prep_dkm_exr[start_date]','วันที่','required|callback_date_check');
				$frm->set_rules('prep_dkm_exr[qstn_title]','หัวข้อการจัดอบรม','required');
				$frm->set_rules('q[]','คำถาม','required');
			//	$frm->set_rules('prep_dkm_exr[trn_org]','หน่วยงานดำเนินการ','required');
			//	$frm->set_rules('prep_dkm_exr[trn_place]','สถานที่จัดอบรม','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				if($frm->run($this)){//Valid Data

					$title = @get_inpost_arr('prep_dkm_exr');
					$question = @get_inpost_arr('q');
					if (!empty($question)) {
						$cout = $this->common_model->custom_query("SELECT qstn_seq as num FROM prep_dkm_exr WHERE  dkm_id = {$org_id} GROUP BY dkm_id ");
						if ($cout[0]['num'] != '' && !empty($cout[0]['num'])){
							$cout[0]['num']++;
						}
						else{
							$cout[0]['num'] = 1;
						}
						// echo $cout[0]['num'];
						// die();
						//$this->common_model->delete_where('prep_dkm_exr','dkm_id',$dkm_id);
						foreach ($question as $qkey => $qRow) {
							$data_question = array(
								'qstn_pid' => 0,
								'dkm_id'=> get_session('org_id'),
								'qstn_seq' => $cout[0]['num'],
								'qstn_type' => 'Question',
								'qstn_title' => $qRow,
								'qstn_msg' =>$title['qstn_title']
							);
							$q_id = $this->common_model->insert('prep_dkm_exr',$data_question);
							$ans = @get_inpost_arr("a[{$qkey}]");
							if(!empty($ans)){
								foreach ($ans as $akey => $aRow) {
									
									$data_answer = array(
										'qstn_pid' => $q_id,
										'dkm_id'=> get_session('org_id'),
										'qstn_seq' => $cout[0]['num'],
										'qstn_type' => 'Answer',
										'qstn_title' => $aRow,
										'ans_full_score' => get_inpost("p[{$qkey}][{$akey}]"),
										'qstn_msg' =>$title['qstn_title']
									);
									$this->common_model->insert('prep_dkm_exr',$data_answer);
								}
							}
						}
					}
					
					$this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
					redirect('prepare/quiz_list/','refresh');

				}else {
					$data['prep_trn_info'] = get_inpost_arr('prep_trn_info');

					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 012

					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$dkm_id  = explode('-', $dkm_id);
				//dieArray($dkm_id);
				$row = rowArray($this->common_model->custom_query("
					SELECT * FROM prep_dkm_info
					WHERE dkm_id = {$dkm_id[0]}
					AND delete_user_id IS NULL 
					AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
					ORDER BY update_datetime DESC,insert_datetime DESC
				"));

				if(isset($dkm_id)) {
					$data['prep_dkm_info'] = $row;	// dieArray($data);
					//dieArray($data['prep_dkm_info']);
					$data['prep_dkm_exr'] = $this->common_model->custom_query("SELECT * FROM prep_dkm_exr WHERE qstn_type = 'Question' AND dkm_id = {$dkm_id[0]} AND qstn_seq = {$dkm_id[1]}");


					$this->template->load('index_page',$data,'prepare');
				}else {
					page500();
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') { //Edit && Submit Form
				$process_action='Edited';

				$dkm_id  = explode('-', $dkm_id);

				$data['prep_dkm_info'] = rowArray($this->common_model->custom_query("
					SELECT * FROM prep_dkm_info
					WHERE dkm_id = {$dkm_id[0]}
					AND delete_user_id IS NULL 
					AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
					ORDER BY update_datetime DESC,insert_datetime DESC
				"));

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('q[]','คำถาม','required');
				// $frm->set_rules('prep_dkm_info[req_pid]','เลขประจำตัวประชาชน (ผู้แจ้งเรื่อง)','required');
				// $frm->set_rules('prep_dkm_info[pid]','เลขประจำตัวประชาชน (ผู้สูงอายุ)','required');

				//if(get_inpost('rd_pers_id')==1) {
				//	$frm->set_rules('prep_dkm_info[pers_id]','เลขประจำตัวประชาชน','required');
				//}

				//$frm->set_rules('prep_dkm_info[elder_firstname]','ชื่อตัว','required');
				//$frm->set_rules('prep_dkm_info[elder_lastname]','ชื่อสกุล','required');

				//if(get_inpost('rd_req_pers_id')==1) {
				//	$frm->set_rules('prep_dkm_info[req_pers_id]','เลขประจำตัวประชาชนข้อมูลผู้ยื่นคำขอ','required');
				//}

				//$frm->set_rules('prep_dkm_info[req_firstname]','ชื่อสกุลผู้ยื่นคำขอ','required');
				//$frm->set_rules('prep_dkm_info[req_channel]','ช่องทางการรับแจ้ง','required');

				//$frm->set_rules('prep_dkm_info[date_of_visit]','วันที่ตรวจเยี่ยม','required|callback_date_check');
				//$frm->set_rules('prep_dkm_info[visitor_name]','เจ้าหน้าที่ผู้ตรวจเยี่ยม','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				if($frm->run($this)){//Valid Data
					$title = @get_inpost_arr('prep_dkm_exr');
					$question = @get_inpost_arr('q');
					if (!empty($question)) {
						$this->common_model->delete_where('prep_dkm_exr','qstn_seq',$dkm_id[1]);

						foreach ($question as $qkey => $qRow) {
							$data_question = array(
								'qstn_pid' => 0,
								'dkm_id'=> get_session('org_id'),
								'qstn_seq' => $dkm_id[1],
								'qstn_type' => 'Question',
								'qstn_title' => $qRow,
								'qstn_msg' =>$title['qstn_title']
							);
							$q_id = $this->common_model->insert('prep_dkm_exr',$data_question);
							$ans = @get_inpost_arr("a[{$qkey}]");
							if(!empty($ans)){
								foreach ($ans as $akey => $aRow) {
									
									$data_answer = array(
										'qstn_pid' => $q_id,
										'dkm_id'=> get_session('org_id'),
										'qstn_seq' => $dkm_id[1],
										'qstn_type' => 'Answer',
										'qstn_title' => $aRow,
										'ans_full_score' => get_inpost("p[{$qkey}][{$akey}]"),
										'qstn_msg' =>$title['qstn_title']
									);
									$this->common_model->insert('prep_dkm_exr',$data_answer);
								}
							}
						}
					}
									
					$this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
					redirect('prepare/quiz_info/Edit/'.$dkm_id[0].'-'.$dkm_id[1],'refresh');

				}else {
					// $data['prep_dkm_info'] = $_POST['prep_dkm_info'];
					// $data['rd_pers_id'] = set_value('rd_pers_id');
					// $data['rd_req_pers_id'] = set_value('rd_req_pers_id');
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 022
					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Delete' && $usrpm['perm_status']=='Yes') { //Delete process
				$this->common_model->delete_where('prep_dkm_exr','qstn_seq',$dkm_id);


				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect('prepare/quiz_list','refresh');
			}
			else {
				page500();
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}


	public function quiz_list($process_action='View'){
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$org_id = get_session('org_id');
	
		$app_id = 55;
		$process_path = 'prepare/quiz_list';
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

			$data['prep_dkm_exr'] = $this->common_model->custom_query("
				SELECT * FROM prep_dkm_exr 
				WHERE qstn_pid IS NOT NULL 
				AND (qstn_title IS NOT NULL)
				AND dkm_id = {$org_id}
				AND qstn_pid = 0
				GROUP BY qstn_seq
				ORDER BY qstn_id DESC
			
			");

			// dieArray($data);

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

			set_js_asset_footer('quiz_list.js','prepare'); //Set JS Index.js
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'quiz_list';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'prepare');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}

	public function training_list($process_action='View'){
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 56;
		$process_path = 'prepare/training_list';
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

			$data['prep_trn_info'] = $this->common_model->custom_query("
				SELECT * FROM prep_trn_info 
				WHERE delete_user_id IS NULL 
				AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
				ORDER BY update_datetime DESC,insert_datetime DESC
			");

			// dieArray($data);

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

			set_js_asset_footer('training_list.js','prepare'); //Set JS Index.js
				set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'training_list';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'prepare');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}

	public function training_info($process_action='Add',$trn_id=0) { 
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 56;
		$process_path = 'prepare/training_info';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

      /*-- datepicker --*/
      //set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
      //set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
      /*-- End datepicker --*/
      
      /*-- datepicker custom --*/
      set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
      /*-- End datepicker custom--*/

			/*-- datetimepicker --*/
			set_css_asset_head('../plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css');
			set_js_asset_head('../plugins/bootstrap-datetimepicker/js/moment.min.js');
			set_js_asset_head('../plugins/bootstrap-datetimepicker/js/th.js');
			set_js_asset_head('../plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js');
			/*-- End datetimepicker --*/

	  		/*-- Toastr style --*/
	  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
	  		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
	  		/*-- End Toastr style --*/

	  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/switchery/switchery.css');
	  		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/switchery/switchery.js');

	  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/jasny/jasny-bootstrap.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/jasny/jasny-bootstrap.min.js');

	  		set_js_asset_footer('training_info.js','prepare'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'training_info';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			if($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {

				$data['prep_trn_info'] = array(
            'trn_title' => '',
            'budget_year' => '',
            'trn_org' => '',
            'trn_place' => '',
            'start_date' => '',
            'end_date' => '',
            'start_time' => '',
            'end_time' => '',
            'trn_describe' => '',
        );

				$this->template->load('index_page',$data,'prepare');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
			}else if($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes'){ //Add && Submit Form
				// dieArray($_POST);
				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('prep_trn_info[start_date]','วันที่','required|callback_date_check');
				$frm->set_rules('prep_trn_info[trn_title]','หัวข้อการจัดอบรม','required');
				$frm->set_rules('prep_trn_info[trn_org]','หน่วยงานดำเนินการ','required');
				$frm->set_rules('prep_trn_info[trn_place]','สถานที่จัดอบรม','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				if($frm->run($this)){//Valid Data

					$data_insert = array();
					$data_insert = get_inpost_arr('prep_trn_info');
					$data_insert['start_date'] = dateChange($data_insert['start_date']);
					$data_insert['end_date'] = dateChange($data_insert['end_date']);
					$data_insert['insert_user_id'] = getUser();
					$data_insert['insert_org_id'] = get_session('org_id');
					$data_insert['insert_datetime'] = getDatetime();

					// file upload //////////////////////
					$fileUL = $this->files_model->do_upload('att_trn_file','assets/modules/prepare/uploads');
					if($fileUL != ''){
						$data_insert['att_trn_file'] = $fileUL;
						$data_insert['att_trn_label'] = $_FILES['att_trn_file']['name'];
						$data_insert['att_trn_size'] = $_FILES['att_trn_file']['size'];
					}
					/////////////////////////////////////

					// dieArray($data_insert);
					$id = $this->common_model->insert('prep_trn_info',$data_insert);

					$this->session->set_flashdata('msg',setMsg('011')); //Set Message code 011

					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

					redirect('prepare/training_info/Edit/'.$id,'refresh');

				}else {
					$data['prep_trn_info'] = get_inpost_arr('prep_trn_info');

					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 012

					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$row = rowArray($this->common_model->custom_query("
					SELECT * FROM prep_trn_info 
					WHERE trn_id = {$trn_id}
					AND delete_user_id IS NULL 
					AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
					ORDER BY update_datetime DESC,insert_datetime DESC
				"));

				if(isset($row['trn_id'])) {
					$data['prep_trn_info'] = $row;

					if($row['start_date']!='' && $row['start_date'] != '0000-00-00') {
						$tmp = explode('-',$row['start_date']);
						$data['prep_trn_info']['start_date'] = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
					}
					if($row['end_date']!='' && $row['end_date'] != '0000-00-00' ) {
						$tmp = explode('-',$row['end_date']);
						$data['prep_trn_info']['end_date'] = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
					}

					// dieArray($data);
					$this->template->load('index_page',$data,'prepare');
				}else {
					page500();
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') { //Edit && Submit Form
				$process_action='Edited';

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('prep_trn_info[start_date]','วันที่','required|callback_date_check');
				$frm->set_rules('prep_trn_info[trn_title]','หัวข้อการจัดอบรม','required');
				$frm->set_rules('prep_trn_info[trn_org]','หน่วยงานดำเนินการ','required');
				$frm->set_rules('prep_trn_info[trn_place]','สถานที่จัดอบรม','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				if($frm->run($this)){//Valid Data

					$row = rowArray($this->common_model->custom_query("
						SELECT * FROM prep_trn_info 
						WHERE trn_id = {$trn_id}
						AND delete_user_id IS NULL 
						AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
						ORDER BY update_datetime DESC,insert_datetime DESC
					"));

					$data_update = array();
					$data_update = get_inpost_arr('prep_trn_info');
					$data_update['start_date'] = dateChange($data_update['start_date']);
					$data_update['end_date'] = dateChange($data_update['end_date']);
					$data_update['update_user_id'] = getUser();
					$data_update['update_org_id'] = get_session('org_id');
					$data_update['update_datetime'] = getDatetime();

					// file upload //////////////////////
					$fileUL = $this->files_model->do_upload('att_trn_file','assets/modules/prepare/uploads');
					if($fileUL != ''){

						@unlink("./assets/modules/prepare/uploads/{$row['att_trn_file']}");
						
						$data_update['att_trn_file'] = $fileUL;
						$data_update['att_trn_label'] = $_FILES['att_trn_file']['name'];
						$data_update['att_trn_size'] = $_FILES['att_trn_file']['size'];
					}
					/////////////////////////////////////

					// dieArray($data_update);
					$this->common_model->update("prep_trn_info",$data_update,array('trn_id'=>$trn_id));

					$this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
					redirect('prepare/training_info/Edit/'.$trn_id,'refresh');
				}else {
					$data['prep_trn_info'] = get_inpost_arr('prep_trn_info');
					
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 022
					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Delete' && $usrpm['perm_status']=='Yes') { //Delete process
				$data_update = array();
				$data_update['delete_user_id'] = getUser();
				$data_update['delete_org_id'] = get_session('org_id');
				$data_update['delete_datetime'] = getDatetime();
				$this->common_model->update('prep_trn_info',$data_update,array('trn_id'=>$trn_id));

				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect('prepare/training_list','refresh');
			}else {
				page500();
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}

	public function trainee_list($process_action='View',$trn_id=''){
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 56;
		$process_path = 'prepare/trainee_list';
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

			$data['trn_id'] = $trn_id;

			$data['prep_trn_trainee'] = $this->common_model->custom_query("
				SELECT * FROM prep_trn_trainee WHERE trn_id = {$trn_id}
			");

			// dieArray($data);

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

			set_js_asset_footer('trainee_list.js','prepare'); //Set JS Index.js
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'trainee_list';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			// dieArray($data);
			$this->template->load('index_page',$data,'prepare');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}

	public function trainee_regis($process_action='Add',$trn_id='',$trainee_id=''){

		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/

		$user_id = get_session('user_id');
		$app_id = 56;
		$process_path = 'prepare/trainee_regis';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

      /*-- datepicker --*/
      //set_css_asset_head('../plugins/bootstrap-datepicker1.3.0/css/datepicker.css');
      //set_js_asset_head('../plugins/bootstrap-datepicker1.3.0/js/bootstrap-datepicker.js');
      /*-- End datepicker --*/
      
      /*-- datepicker custom --*/
      set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
      set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
      /*-- End datepicker custom--*/

	  		/*-- Toastr style --*/
	  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
	  		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
	  		/*-- End Toastr style --*/

	  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/switchery/switchery.css');
	  		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/switchery/switchery.js');

	  		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/jasny/jasny-bootstrap.min.css');
				set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/jasny/jasny-bootstrap.min.js');

	  		set_js_asset_footer('webservice.js','personals'); //Set JS Index.js
	  		set_js_asset_footer('trainee_regis.js','prepare'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'trainee_regis';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$data['trn_id'] = $trn_id;

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			if($process_action=='Add' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {

				$data['prep_trn_trainee'] = array(
					'pers_id' => '',
					'gender_code'=>'',
					'req_org' => '',
					'req_position' => '',
					'emrc_name' => '',
					'emrc_tel_no_mobile' => '',
					'trainee_remark' => '',
					'attd_status' => '',
					'reg_code' => '',
					'reg_channel' => '',

					'pers_firstname_th' => '',
					'pers_lastname_th' => '',
				);

				$data['trn_id'] = $trn_id;

				$this->template->load('index_page',$data,'prepare');
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
			}else if($process_action=='Added' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes'){ //Add && Submit Form
				// dieArray($_POST);

				$data['trn_id'] = $trn_id;

				$this->load->library('form_validation');
				$frm=$this->form_validation;

				$frm->set_rules('prep_trn_trainee[pers_id]','เลขประจำตัวประชาชน','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				if($frm->run($this)){//Valid Data
				// if(1){//Valid Data

					$pers_updates = @get_inpost_arr('pers_info');
					//dieArray($pers_updates);
					$pers_update['pren_code'] = $pers_updates['pren_code'];
					$pers_update['tel_no'] = $pers_updates['tel_no_mobile'];
					$pers_update['healthy_congenital_disease']  =  $pers_updates['healthy_congenital_disease'];
					$pers_update['update_user_id'] = getUser();
					$pers_update['update_org_id'] = get_session("org_id");
					$pers_update['update_datetime'] = getDatetime();

					$this->common_model->update('pers_info',$pers_update,array('pers_id'=>get_inpost('prep_trn_trainee[pers_id]')));

					$data_insert = array();
					$data_insert = @get_inpost_arr("prep_trn_trainee");
				//	dieArray($data_insert);
					$data_insert['trn_id'] = $trn_id;
					$data_insert['emrc_tel_no_mobile'] = $pers_updates['tel_no_mobile'];
					$data_insert['reg_channel'] = 'หน่วยงานดำเนินการรับลงทะเบียน';

					$id = $this->common_model->insert("prep_trn_trainee",$data_insert);



					$this->session->set_flashdata('msg',setMsg('011')); //Set Message code 011
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
					//redirect('prepare/trainee_regis/Edit/'.$id,'refresh');
					 redirect('prepare/trainee_list/View/'.$trn_id,'refresh');

				}else {
					$data['trn_id'] = $trn_id;
					$data['prep_trn_trainee'] = array(
						'pers_id' => '',
						'gender_code'=>'',
						'req_org' => '',
						'req_position' => '',
						'emrc_name' => '',
						'emrc_tel_no_mobile' => '',
						'trainee_remark' => '',
						'attd_status' => '',
						'reg_code' => '',
						'reg_channel' => '',
						'pers_firstname_th' => '',
						'pers_lastname_th' => '',
					);

					$data['prep_trn_trainee'] = get_inpost_arr('prep_trn_trainee');
					$data['pers_info'] = get_inpost_arr('pers_info');


					$this->session->set_flashdata('msg',setMsg('012')); //Set Message code 012

					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edit' && get_inpost('bt_submit')=='' && $usrpm['perm_status']=='Yes') {
				$row = rowArray($this->common_model->custom_query("SELECT * FROM prep_trn_trainee WHERE trainee_id = {$trainee_id}"));
				$data['trainee_id'] = $trainee_id;
				if(isset($row['trainee_id'])) {
					// $data['prep_trn_trainee'] = array_merge($row,$this->personal_model->getPersonalInfo($row['pers_id']));
					$data['prep_trn_trainee'] = $row;
					$data['pers_info'] = $this->personal_model->getPersonalInfo($row['pers_id']);
					// dieArray($data);
					$this->template->load('index_page',$data,'prepare');
				}else {
					page500();
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Edited' && get_inpost('bt_submit')!='' && $usrpm['perm_status']=='Yes') { //Edit && Submit Form
				$process_action='Edited';

			//	dieArray($_POST);
				$this->load->library('form_validation');
				$frm=$this->form_validation;

				//$frm->set_rules('pers_info[pers_firstname_th]','เลขประจำตัวประชาชน','callback_date_check');
				 $frm->set_rules('pers_info[pers_firstname_th]','ชื่อตัว (ผู้แจ้งเรื่อง)','required');
				// $frm->set_rules('prep_dkm_info[pid]','เลขประจำตัวประชาชน (ผู้สูงอายุ)','required');

				//if(get_inpost('rd_pers_id')==1) {
				//	$frm->set_rules('prep_dkm_info[pers_id]','เลขประจำตัวประชาชน','required');
				//}

				//$frm->set_rules('prep_dkm_info[elder_firstname]','ชื่อตัว','required');
				//$frm->set_rules('prep_dkm_info[elder_lastname]','ชื่อสกุล','required');

				//if(get_inpost('rd_req_pers_id')==1) {
				//	$frm->set_rules('prep_dkm_info[req_pers_id]','เลขประจำตัวประชาชนข้อมูลผู้ยื่นคำขอ','required');
				//}

				//$frm->set_rules('prep_dkm_info[req_firstname]','ชื่อสกุลผู้ยื่นคำขอ','required');
				//$frm->set_rules('prep_dkm_info[req_channel]','ช่องทางการรับแจ้ง','required');

				//$frm->set_rules('prep_dkm_info[date_of_visit]','วันที่ตรวจเยี่ยม','required|callback_date_check');
				//$frm->set_rules('prep_dkm_info[visitor_name]','เจ้าหน้าที่ผู้ตรวจเยี่ยม','required');

				$frm->set_message("required","กรุณากรอกข้อมูล %s");
				$frm->set_message("numeric","%s ต้องเป็นตัวเลข");
				$frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");

				if($frm->run($this)){//Valid Data

					$data_update = array();
					$pers_updates = @get_inpost_arr('pers_info');
					$data_update = @get_inpost_arr("prep_trn_trainee");
					$aa = get_inpost('prep_trn_trainee[pers_id]');
				//	die($aa);
					//dieArray($pers_updates);
					$pers_update['pren_code'] = $pers_updates['pren_code'];
					$pers_update['tel_no'] = $pers_updates['tel_no_mobile'];
					$pers_update['healthy_congenital_disease']  =  $pers_updates['healthy_congenital_disease'];
					$pers_update['update_datetime'] = getDatetime();

					$this->common_model->update('pers_info',$pers_update,array('pers_id'=>$aa));

			
					//$data_update['date_of_req'] = dateChange($_POST['prep_dkm_info']['date_of_req']);
				//	$data_update['update_user_id'] = getUser();
					//$data_update['update_datetime'] = getDatetime();
				//	$data_update['req_pers_id'] = $_POST['prep_dkm_info']['req_pers_id'];

					// $data_update['req_position'] = $_POST['prep_trn_trainee']['req_position'];
					// $data_update['req_org'] = $_POST['prep_trn_trainee']['req_org'];
					// $data_update['attd_status'] = $_POST['prep_trn_trainee']['attd_status'];
					// $data_update['emrc_tel_no_mobile'] = $_POST['prep_trn_trainee']['emrc_tel_no_mobile'];
					// $data_update['pers_id'] = $_POST['prep_trn_trainee']['pers_id'];
				//	$data_insert['chn_code'] = $_POST['prep_dkm_info']['chn_code'];
//
					if(get_inpost('elder_addr_chk')!='on') {
						//add new addr
					}

					//$data_update['date_of_visit'] = dateChange($data_update['date_of_visit'],4);

					$this->common_model->update('prep_trn_trainee',$data_update,array('trainee_id'=>$trainee_id));
					$this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021

					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log

					redirect('prepare/trainee_list/View/'.$trn_id,'refresh');


				}else {
					$data['prep_dkm_info'] = $_POST['prep_dkm_info'];
					$data['rd_pers_id'] = set_value('rd_pers_id');
					$data['rd_req_pers_id'] = set_value('rd_req_pers_id');
					$this->session->set_flashdata('msg',setMsg('022')); //Set Message code 022
					$this->template->load('index_page',$data,'prepare');
					$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
				}

			}else if($process_action=='Delete' && $usrpm['perm_status']=='Yes') { //Delete process
				$data_update = array();
				// $data_update['delete_user_id'] = getUser();
				// $data_update['delete_datetime'] = getDatetime();

				$this->common_model->delete_where('prep_trn_trainee','trainee_id',$trainee_id);
				$this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
				redirect('prepare/trainee_list/View/'.$trn_id,'refresh');
			}else {
				page500();
				$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign Out Log
			}
		}
	}
}
