<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once "Main.php";
class ReportF10 extends Main_Controller
{
    private $data = null;
    public function __construct()
    {
        parent::__construct();
        $param = $this->getParam();
        $this->load->model('../../modules/school/models/center_model');
        foreach ($_POST['columns'] as $i => $val) {
            $_POST['columns'][$i] = array('search' => array('value' => $val));
        }
        foreach ($this->center_model->get_filteredCenters() as $i => $center) {
            if (empty($center['score'])) {
                $qlc_kpi_grade = '-';
            } else {
                $center['score'] = $center['score'] === 0 ? '-' :
                ($center['score'] < 50 ? 'D' :
                    ($center['score'] < 60 ? 'C' :
                        ($center['score'] < 80 ? 'B' : 'A')));
            }
            $data['rows'][] = [
                ($i + 1) . '.',
                $center['region'],
                $center['province'],
                $center['qlc_name'],
                $center['latest_assess_year'],
                $center['score'],
                $center['amphur'],
                $center['year_of_sponsorship'],
                'N/A',
                $center['school_count'],
            ];
        }
        $data['headers'] = array(
            'รายชื่อศูนย์พัฒนาคุณภาพชีวิตและส่งเสริมอาชีพผู้สูงอายุ',
            'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์',
            'ข้อมูล ณ วันที่ ' . dateTH(date('Y-m-d')) . ' (จำนวน ' . count($data['rows']) . ' รายการ)',
            ' ',
        );
        if (!$data['rows']) {
            $this->dataempty();
        }

        $this->data = array(
            'content_view' => 'reportF10',
            'title' => 'ข้อมูลการสงเคราะห์ในการจัดการงานศพผู้สูงอายุตามประเพณี',
            'res' => $data);
    }

    public function index()
    {
        $this->template->load('index_xls', $this->data);
    }

    public function xls()
    {
        $this->excelWithSmallFont(APPPATH . '/../assets/modules/report/static/center_list.xlsx', $this->data, 'D', 'report_F10', array(), 6);
    }

}
