<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once("Main.php");
class ReportH0 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $param= $this->getParam();
        $result=$this->report_mock->reportH0($param['m'],$param['y']);
        $data['rows']=$result['row'];
        $data['headers']=array(
            'ข้อมูลสถิติประชากรไทยจากการทะเบียน' ,
            'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์' ,
            'ข้อมูล ณ  '.$param['m']."/".$param['y'].' (จำนวน '.$result['total'].' คน)',
            ' '
        );
        if(!$data['rows']){
            $this->dataempty();
        }

        $this->data = array(
            'content_view'=>'reportH0',
            'title'=>'ข้อมูลสถิติประชากรไทยจากการทะเบียน',
            'res'=>$data);
    }
    function index(){
        $this->template->load('index_xls',$this->data);
    }
    function xls(){
        $this->excel(APPPATH . '/../assets/modules/report/static/7.1.xls',$this->data,'D','report_H0',array(),9);


    }

}