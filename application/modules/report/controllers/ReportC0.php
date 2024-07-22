<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once("Main.php");
class ReportC0 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $filter= $this->getFilter();
        $data['rows']=$this->report_mock->reportC0($filter);
        $data['headers']=array(
            'ข้อมูลการสงเคราะห์ในการจัดการงานศพผู้สูงอายุตามประเพณี' ,
            'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์' ,
            'ข้อมูล ณ วันที่ '.dateTH(date('Y-m-d')).' (จำนวน '.count($data['rows']).' รายการ)',
            ' '
        );
        if(!$data['rows']){
            $this->dataempty();
        }

        $this->data = array(
            'content_view'=>'reportC0',
            'title'=>'ข้อมูลการสงเคราะห์ในการจัดการงานศพผู้สูงอายุตามประเพณี',
            'res'=>$data);
    }
    function index(){
        $this->template->load('index_xls',$this->data);
    }
    function xls(){
        $this->excel(APPPATH . '/../assets/modules/report/static/3.1.xls',$this->data,'D','report_C0',array(),7);

    }

}