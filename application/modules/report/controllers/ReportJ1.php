<?php

/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 14:54
 */
include_once("Main.php");
class ReportJ1 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $param= $this->getParam();
        $this->data = array(
            'content_view'=>'reportJ1',
            'title'=>'ทะเบียนประวัติผู้สูงอายุ ',
            'res'=>$this->report_mock->reportJ1($param['id'])
        );
        if(!$this->data['res']){
            $this->dataempty();
        }
    }
    function index(){
        $this->template->load('index_page',$this->data);
    }
    function pdf(){
        $data= array(
            'content_view'=>'header',
            'title'=>' ',
            'res'=>(object) array(
                'title'=>'ทะเบียนประวัติผู้สูงอายุ (รายบุคคล)',
                'subtitle'=>'ตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ มาตรา 11 (8) (9) (10)',
                'datelabel'=>'ข้อมูล ณ วันที่',
                'date'=>$this->data['res']->date
            )
        );


        $header= array(
            'html'=>$this->load->view('report_template/index_pdf', $data, TRUE),
            'top'=>30,
            'bottom'=>10,
        );
        $this->generate(
            'report_template/index_pdf',
            $this->data,$this->preview,
            'report_j1.pdf',
            array(),
            $header
        );
       // $this->generate('report_template/index_pdf',$this->data,$this->preview,'report_j1.pdf');
    }
}