<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form','general','file','html','asset'));
		$this->load->library(array('session','encrypt'));
		$this->load->model(array('member/admin_model','member/member_model','common_model','useful_model','webconfig/webinfo_model'));
    }
	
	function __deconstruct() {
		$this->db->close();
	}
	
	public function index() {		
		$data['csrf'] = array(
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash(),
        );
		$data['content_view'] = "web_template1/content/demo_fingerprint";
		$this->load->view("web_template1/demo_fingerprint", $data);
	}

	public function getfingerprint(){
		 $data['value'] = $this->common_model->custom_query("SELECT * FROM tbl_fingerprint JOIN tbl_user ON tbl_user.user_id = tbl_fingerprint.fp_user_id");
		 
        // $data['value'] = $this->main_model->getFingerPrint();
        $max = 0;

        foreach ($data['value'] as $key => $value) {
            if ($value['value'] > $max){
                $max = $value['value'];
                $index = $key;
            }
            
        }
        
        $data['max'] = $index;
       // echo json_encode($data);
         $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
	
	
}