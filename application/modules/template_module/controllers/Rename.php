<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rename extends MX_Controller {

	function __construct() {
		parent::__construct();
		
		chkUserLogin();

	}

	function __deconstruct() {
		$this->db->close();
	}

	public function index(){
		echo 'for list or index';
	}

	public function create(){
		echo 'for show form create';


	}

	public function update(){
		echo 'for show form update';
		
	}

	public function store(){
		echo 'for save date to DB';
	}
}
?>