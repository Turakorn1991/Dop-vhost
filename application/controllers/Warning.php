<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Warning extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form','general','file','html','asset'));
		$this->load->library(array('session','encrypt'));
	//	$this->load->model(array('member/admin_model','member/member_model','common_model','useful_model','webconfig/webinfo_model'));
    }
	
	function __deconstruct() {
		$this->db->close();
	}
	
	public function index() {
		//$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		//$data = rowArray($result);
		$data['content_view'] = "web_template1/content/main";
		$this->load->view("warning", $data);
	}
	
	
	
}