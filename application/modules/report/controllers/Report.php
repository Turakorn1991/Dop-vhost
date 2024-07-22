<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/15/2017 AD
 * Time: 18:39
 */
include_once("Main.php");
class Report extends Main_Controller {
    public function __construct(){
        parent::__construct();
    }
    function index(){
        $data = array(
            'content_view'=>'index',
           // 'layout'=>'landscape',
            'title'=>'หน้ารวมรายงาน',
            'report_list'=>array(
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบขอรับบริการผู้ประสบปัญหา (สคส.01)",'code'=>"A1",'url'=>"../report/A1",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"ใบสำคัญรับเงิน (สคส.02)",'code'=>"A2",'url'=>"../report/A2",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"หนังสือมอบอำนาจรับเงินสงเคราะห์ฯ ",'code'=>"A3",'url'=>"../report/A3",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบประเมินผลการให้บริการ (สคส.03)",'code'=>"A4",'url'=>"../report/A4",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบขอรับเงินสงเคราะห์ฯ (ศผส.01)",'code'=>"C1",'url'=>"../report/C1",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบรับรองการจัดการงานศพผู้สูงอายุฯ (กรณีตกสำรวจ จปฐ.) (ศผส.02)",'code'=>"C2",'url'=>"../report/C2",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"ใบสำคัญรับเงิน (ศผส.03)",'code'=>"C3",'url'=>"../report/C3",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบสอบถามความต้องการฯ (D1)",'code'=>"D1",'url'=>"../report/D1",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"หนังสือให้ความยินยอมฯ (D2)",'code'=>"D2",'url'=>"../report/D2",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบสอบถามความต้องการฯ (D3)",'code'=>"D3",'url'=>"../report/D3",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"หนังสือให้ความยินยอมฯ (D4)",'code'=>"D4",'url'=>"../report/D4",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"หนังสือให้ความยินยอมฯ (D5)",'code'=>"D5",'url'=>"../report/D5",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบประวัติคลังปัญญาผู้สูงอายุ (E1)",'code'=>"E1",'url'=>"../report/E1",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"แบบสอบถามสำหรับผู้ที่เป็นอาสาสมัครดูแลผู้สูงอายุ (F2)",'code'=>"F2",'url'=>"../report/F2",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"สำเร็จการศึกษาหลักสูตรโรงเรียนผู้สูงอายุ (G6)",'code'=>"G6",'url'=>"../report/G6",'params'=>''),
                (object) array('mock'=>'1','type'=>'pdf','title'=>"ป็นผู้นำการบริหารโรงเรียนผู้สูงอายุ (G7)",'code'=>"G7",'url'=>"../report/G7",'params'=>''),
            )
        );
        $this->template->load('index_page',$data);
    }


}