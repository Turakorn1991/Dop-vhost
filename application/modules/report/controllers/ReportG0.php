<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once "Main.php";
class ReportG0 extends Main_Controller
{
    private $data = null;
    public function __construct()
    {
        parent::__construct();
        $param = $this->getParam();

        $this->load->model('../../modules/school/models/school_model');
        foreach ($this->school_model->get_filteredSchoolList() as $i => $school) {
            $data['rows'][] = [
                ($i + 1) . '.',
                $school['schl_name'],
                (empty($school['last_update']) ? 'ยังไม่มีการอัพเดท' : "{$school['last_update']} วันก่อน"),
                $school['schl_status'],
                $school['province'],
                $school['year_of_established'] + 543,
                $school['gens_count'],
                $school['students_count'],
            ];
        }
        $data['headers'] = array(
            'ข้อมูลโรงเรียนผู้สูงอายุ',
            'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์',
            'ข้อมูล ณ วันที่ ' . dateTH(date('Y-m-d')) . ' (จำนวน ' . count($data['rows']) . ' รายการ)',
            ' ',
        );

        if (!$data['rows']) {
            $this->dataempty();
        }
        $this->data = array(
            'content_view' => 'reportG0',
            'title' => 'ข้อมูลโรงเรียนผู้สูงอายุ',
            'res' => $data,
        );
    }

    public function index()
    {
        $this->template->load('index_xls', $this->data);
    }

    public function xls()
    {
        $this->excelWithSmallFont(APPPATH . '/../assets/modules/report/static/school_list.xlsx', $this->data, 'D', 'report_G0', array(), 6);
    }

}
