<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once("Main.php");
class ReportD0 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $filter= $this->getFilter();
        $data['rows']=$this->report_mock->reportD0($filter);
        $data['headers']=array(
            'ข้อมูลการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกที่เอื้อเฟื้อต่อคนทุกวัย (ปรับปรุงบ้านของผู้สูงอายุ)' ,
            'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์' ,
            'ข้อมูล ณ วันที่ '.dateTH(date('Y-m-d')).' (จำนวน '.count($data['rows']).' รายการ)',
            ' '
        );
        if(!$data['rows']){
            $this->dataempty();
        }

        $this->data = array(
            'content_view'=>'reportD0',
            'title'=>'ข้อมูลการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกที่เอื้อเฟื้อต่อคนทุกวัย (ปรับปรุงบ้านของผู้สูงอายุ)',
            'res'=>$data);
    }
    function index(){
        $this->template->load('index_xls',$this->data);
    }
    function xls(){
        // header('Content-Type: application/json');
        // echo json_encode($this->data);
        $this->excel(APPPATH . '/../assets/modules/report/static/4.1.xls',$this->data,'D','report_D0',array(),7);


    }

}