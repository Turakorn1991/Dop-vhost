<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once("Main.php");
class ReportA0 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
    }
    function index(){
        $this->template->load('index_xls',$this->data);
    }
    function import(){
    }

}