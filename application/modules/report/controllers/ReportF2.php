<?php

/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 14:54
 */
 
include_once("Main.php");

class ReportF2 extends Main_Controller {

    private $data = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('volunteer_form_pdf_model', 'pdf_model');
        $param = $this->getParam();
        $this->data = array_merge(array(
            'content_view' => 'reportF2',
            'title' => 'แบบสอบถามสำหรับผู้ที่เป็นอาสาสมัครดูแลผู้สูงอายุ (F2)'
        ), $this->pdf_model->reportF2($param['id']));
    }

    function index() {
        $this->template->load('index_page', $this->data);
    }

    function pdf() {
        $this->generate('report_template/index_pdf.php', $this->data, 1, 'report_f2.pdf');
    }

}
