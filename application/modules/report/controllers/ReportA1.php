<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/15/2017 AD
 * Time: 19:18
 */
include_once("Main.php");
// /report/A1?id=4
class ReportA1 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $param= $this->getParam();
        $this->data=$this->report_mock->reportA1($param['id']);
        if(!$this->data){
            $this->dataempty();
        }
    }

    function index(){
        $data = array(
            'content_view'=>'reportA1',
            'title'=>'แบบขอรับบริการผู้ประสบปัญหา (สคส.01)',
            'res'=> $this->data
        );
        $this->template->load('index_page',$data);
    }
    function pdf(){
        $data = array(
            'content_view'=>'reportA1',
            'title'=>'แบบขอรับบริการผู้ประสบปัญหา (สคส.01)',
            'res'=> $this->data
        );
        $this->generate('report_template/index_pdf',$data,$this->preview,'report_a1.pdf');
    }
}