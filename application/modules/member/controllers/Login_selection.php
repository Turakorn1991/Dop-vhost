<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_selection extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		);
	}
	function __deconstruct() {
		$this->db->close();
	}

	//TODO: Should be move to common
	private function setUserSession($row) {
		set_session('user_id',$row['user_id']);
		set_session('pid',$row['pid']);
		set_session('user_firstname',$row['user_firstname']);
		set_session('user_lastname',$row['user_lastname']);
		set_session('user_position',$row['user_position']);
		set_session('org_id',$row['org_id']);

		$tmp = rowArray($this->common_model->get_where_custom_and('usrm_org',array('org_id'=>$row['org_id'])));

		if(isset($tmp['org_title'])) {
			set_session('org_title',$tmp['org_title']);
		} else {
			set_session('org_title','Not affiliated');
		}

		if($row['user_photo_file']!='') {
			set_session('user_photo_file',$row['user_photo_file']);
			set_session('user_photo_label',$row['user_photo_label']);
		}
		else {
			set_session('user_photo_file','assets/modules/member/images/noProfilePic.jpg');
		}

		$this->common_model->insert('usrm_log',
			array(
				'app_id'=> 0,
				'process_action'=>'Authen',
				'log_action'=>'Sign In',
				'user_id'=>$row['user_id'],
				'org_id'=>$row['org_id'],
				'log_datetime'=> getDatetime(),
				'log_status'=>'Success'
			)
		);	
	}
		
	public function index(){
        $this->template->load("login_select");
	}

	public function login() {
		$fingerprint_key = get_inpost('fingerprint_key');

		if($fingerprint_key !='') {
			$row = $this->admin_model->getUserByFingerprintKey($fingerprint_key);

			if(isset($row['pid'])) { 
				$this->setUserSession($row);

				//Redirect success login
				redirect('member/admin_access','refresh');
			}
		} else {
			//Redirect error login

		}
	}
}