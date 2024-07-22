<?php

/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 14:54
 */
include_once("Main.php");
class ReportE1 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $param= $this->getParam();
        $this->data = array(
            'content_view'=>'reportE1',
            'title'=>'แบบประวัติคลังปัญญาผู้สูงอายุ (E1)',
            'res'=>$this->report_mock->reportE1($param['id'])
        );
        if(!$this->data['res']){
            $this->dataempty();
        }
    }
    function index(){
        $this->template->load('index_page',$this->data);
    }
    function pdf(){
        $this->generate('report_template/index_pdf',$this->data,$this->preview,'report_e1.pdf');
    }
}