<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Design extends MX_Controller {

	function __construct() {
		parent::__construct();
		
		chkUserLogin();

	}
	function __deconstruct() {
		$this->db->close();
	}

	public function sufferer_form1($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 3;
		$process_path = 'difficult/assist_list';
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

			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

    		/*-- Toastr style --*/
    		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
    		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
    		/*-- End Toastr style --*/
	
			set_js_asset_footer('sufferer_form1.js','difficult'); //Set JS Sufferer_form1.js 

			$data['process_action'] = $process_action;	
			$data['content_view'] = 'design_sufferer_form1'; //

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application 
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];
		
			$this->template->load('index_page',$data,'difficult');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
		
	}



}