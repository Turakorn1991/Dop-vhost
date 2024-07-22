<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/15/2017 AD
 * Time: 19:18
 */
include_once("Main.php");
class ReportC1 extends Main_Controller {
    private $data=null;
    public function __construct(){
        parent::__construct();
        $param= $this->getParam();
        $this->data = array(
            'content_view'=>'reportC1',
            'title'=>'แบบขอรับเงินสงเคราะห์ฯ (ศผส.01)',
            'res'=>$this->report_mock->reportC1($param['id'])
        );
        if(!$this->data['res']){
            $this->dataempty();
        }
    }
    function index(){
        $this->template->load('index_page',$this->data);
    }
    function pdf(){
        $this->generate('report_template/index_pdf',$this->data,$this->preview,'report_c1.pdf');
    }
}