<?php

/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 14:54
 */
include_once("Main.php");
class ReportB1 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $param= $this->getParam();
        $this->data = array(
            'content_view'=>'reportB1',
            'title'=>'ทะเบียนประวัติผู้สูงอายุ ',
            'res'=>$this->report_mock->reportB1($param['id'])
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
                'title'=>'แบบคําขอรับบริการ',
                'subtitle'=>'ตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ มาตรา 11 (8) (9) (10)',
                'datelabel'=>'วันที่แจ้งเรื่อง',
                'date'=>$this->data['res']->inform_date
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
            'report_b3.pdf',
            array(),
            $header
        );
    }
}