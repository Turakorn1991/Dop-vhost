<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once("Main.php");
class ReportL1 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $param= $this->getParam();
        $data['rows']=$this->report_mock->reportL1(@$param['id']);
        $data['headers']=array(
            'ข้อมูลการส่งเสริมการจ้างงานผู้สูงอายุ (ผู้สูงอายุที่ขึ้นทะเบียนจัดหางาน)' ,
            'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์' ,
            'ข้อมูล ณ วันที่ '.dateTH(date('Y-m-d')).' (จำนวน '.count($data['rows']).' รายการ)',
            ' '
        );
        if(!$data['rows']){
            $this->dataempty();
        }

        $this->data = array(
            'content_view'=>'reportL1',
            'title'=>'ข้อมูลการส่งเสริมการจ้างงานผู้สูงอายุ (ผู้สูงอายุที่ขึ้นทะเบียนจัดหางาน)',
            'res'=>$data);
    }
    function index(){
        $this->template->load('index_xls',$this->data);
    }
    function xls(){
        $this->excel(APPPATH . '/../assets/modules/report/static/9.2.xls',$this->data,'D','report_L1',array(),8);


    }

}