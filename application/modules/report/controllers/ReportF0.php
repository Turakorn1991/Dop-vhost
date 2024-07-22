<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 13:44
 */
include_once("Main.php");
class ReportF0 extends Main_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->model('volunteer_list_excel_model', 'excel');
    }

    function index() {
      $this->template->load('index_xls',$this->get_reportData());
    }

    function xls() {
      $this->excel(APPPATH . '/../assets/modules/report/static/volunteer_list.xlsx',$this->get_reportData(),'D','report_F0',array(),6);
    }

    private function get_reportData() {
      $data = array();
      $param = $this->getParam();
      $data['rows'] = $this->handle_rawVolunteerData($this->excel->get_volunteerList($param));
      $data['headers'] = array(
        'รายงานอาสาสมัครผู้สูงอายุ',
        'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์',
        'ข้อมูล ณ วันที่ '.dateTH(date('Y-m-d')).' (จำนวน '.count($data['rows']).' รายการ)',
        ' '
      );
      if(!$data['rows'])
          $this->dataempty();
      return array(
        'content_view' => 'reportF0',
        'title' => 'ข้อมูลอาสาสมัครดูแลผู้สูงอายุ (อผส.)',
        'res' => $data
      );
    }

    private function handle_rawVolunteerData($rows) {
      $data = array();
      foreach ($rows as $index => $result) {
        $new = array();
        $addr = $this->excel->get_address($result->pre_addr_id);
        $vpos = $this->excel->get_villagePosition($result->volt_id);
        $oo4 = false;
        $oo5 = false;
        $oo9 = null;
        foreach ($vpos as $pos) {
            if ($pos['vpos_code'] == '004')
                $oo4 = true;
            if ($pos['vpos_code'] == '005')
                $oo5 = true;
            if ($pos['vpos_code'] == '009')
                $oo9 = $pos['vpos_identify'];
        }

        $new[] = $index + 1 . '.';
        $new[] = $addr['province'];
        $new[] = $addr['district'];
        $new[] = $addr['locality'];
        $new[] = $result->la_org_title ? $result->la_org_title : 'ไม่ได้ระบุ';
        $new[] = $result->prename_th.$result->pers_firstname_th." ".$result->pers_lastname_th;
        $new[] = $result->pid;
        $new[] = ($result) ? age($result->date_of_birth) : "";
        $new[] = $addr['addr_home_no'];
        $new[] = $addr['addr_moo'];
        $new[] = $oo4 ? 'เป็น' : 'ไม่เป็น';
        $new[] = $oo5 ? 'เป็น' : 'ไม่เป็น';
        $new[] = $oo9;
        $new[] = $result->older_care_training.' '.$result->older_care_training_identify;
        $care = $this->report_model->getElderlyCare($result->volt_id);
        $new[] = count($care);

        // $new[] = dateTH($result->date_of_reg);
        // $new[] = dateTH($result->date_of_birth);
        // $new[] = dateTH($result->date_of_death);
        // $gender = "";
        // if ($result) {
        //   if ($result->gender_code == 0) {
        //       $gender = "ไม่ทราบ";
        //   } elseif ($result->gender_code == 1) {
        //       $gender = "ชาย";
        //   } elseif ($result->gender_code == 2) {
        //       $gender = "หญิง";
        //   } elseif ($result->gender_code == 9) {
        //       $gender = "ไม่สามารถระบุได้";
        //   }
        // }
        // $new[] = $gender;
        // $new[] = $addr['alley'];
        // $new[] = $addr['addr_lane'];
        // $new[] = $addr['addr_road'];
        // $new[] = $result->tel_no_mobile;
        // $edu = $result->edu;
        // if ($result->edu_identify)
        //     $edu .= " " . $result->edu_identify;
        // $new[] = $edu;
        // $new[] = dateTH($result->date_of_training);
        // $new[] = $result->older_care_training_org;
        // $new[] = $result->older_care_training_course;

        array_push($data, $new);
      }
      return $data;
    }

}
