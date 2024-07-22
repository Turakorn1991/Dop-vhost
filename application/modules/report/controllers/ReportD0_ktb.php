<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once("Main.php");
class ReportD0_ktb extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $filter= $this->getFilter();
        $data['rows']=$this->report_mock->reportD0_ktb($filter);

        if(!$data['rows']){
            $this->dataempty();
        }
        $this->data = array(
            'content_view'=>'reportD0_ktb',
            'title'=>'ktb',
            'res'=>$data);
    }
    function index(){
        $this->template->load('index_xls',$this->data);
    }
    
    function xls(){  
        // header('Content-Type: application/json');
        // echo json_encode($this->data);
        $this->excel(APPPATH . '/../assets/modules/report/static/1.2.xls',$this->data,'D','report_D0_ktb',array(),3);
    }

}