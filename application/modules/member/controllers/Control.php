<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

	function __construct() {
		parent::__construct();

		//$this->load->database();

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		);
	}
	function __deconstruct() {
		$this->db->close();
	}	

	public function main_module(){
		$data = array(
			'content_view'=>'main',
			'title'=>'Welcome to administrator',
			'content'=>'ตัวอย่างการใช้งาน css template'
		);
		$this->template->load('index_page',$data);
	}


	/*
	public function main_template(){
		$data = array(
			'content_view'=>'main_template',
			'title'=>'Welcome to administrator',
			'content'=>'ตัวอย่างการใช้งาน css template'
		);
		$this->template->load('index_page',$data);
	}

	
	public function index(){
		$data=array(
			'content_view'=>'main',
			'title'=>'Template Convertor',
			'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id illo excepturi, sint odio, adipisci saepe maiores minima in. Quo enim velit corporis illum 
						sint accusamus esse nostrum eaque ullam, eligendi!',
		);

		set_js_asset_head('jquery_header1.js');
		set_js_asset_head('jquery_header2.js','news');
		set_js_asset_head('jquery_header3.js');
		set_js_asset_head('jquery_header4.js');

		set_js_asset_head(array('jquery_header5.js','jquery_header6.js'));
		set_js_asset_head(array('jquery_header7.js','jquery_header8.js'),'news');

		set_js_asset_footer('jquery_footer1.js');
		set_js_asset_footer('jquery_footer2.js');
		set_js_asset_footer('jquery_footer3.js','login');
		set_js_asset_footer('jquery_footer4.js');


		set_css_asset_head('css_header1.css','news');
		set_css_asset_head('css_header2.css');
		set_css_asset_head('css_header3.css');
		set_css_asset_head('css_header4.css');

		set_css_asset_footer('css_footer1.css','login');
		set_css_asset_footer('css_footer2.css');
		set_css_asset_footer('css_footer3.css');
		set_css_asset_footer('css_footer4.css');                                                                                                                                                      

		$this->template->load('index_page',$data);
		//$this->load->view('admin/index_admin',$data);
	}
	*/

}
