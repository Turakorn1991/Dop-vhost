<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

class Monitordata extends MX_Controller {

	function __construct() {
		parent::__construct();

		$this->load->database();

		chkUserLogin();

	}
	function __deconstruct() {
		$this->db->close();
	}

	function index() {
			echo "123";
	}

	public function template($view='',$data=array()){
		$this->load->view("back-end/template_header");
		$this->load->view($view, $data);
		$this->load->view("back-end/template_footer");
	}

  public function chkNPID($pid='') {
    $str_tmp = str_replace('-','',$pid);
    if(strlen($str_tmp) == 13 && is_numeric($str_tmp) && $str_tmp[0] >0 ) {
      $sum = 0;
      for($i=0;$i<12;$i++) {
        $sum += $str_tmp[$i]*(13-$i);
      }
      $rs = '';
      if($sum%11 <= 1) {
        $rs = 1-($sum%11);
      }else {
        $rs = 11-($sum%11);
      }

      if($str_tmp[12]==$rs){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  function check_pid(){
      $this->load->model(array('monitordata_model'));
      $list_personal = $this->monitordata_model->_get_diff_query();
      $intRow = 0;
      echo '<table border="1">';
      echo "<tr>
              <td>date_of_req</td>
              <td>req_pid</td>
              <td>req_prename_th</td>
              <td>req_pers_firstname_th</td>
              <td>req_pers_lastname_th</td>
              <td>req_gender_code</td>
              <td>req_date_of_birth</td>
              <td>req_older_addr_detail</td>
              <td>pid</td>
              <td>prename_th</td>
              <td>pers_firstname_th</td>
              <td>pers_lastname_th</td>
              <td>gender_code</td>
              <td>date_of_birth</td>
              <td>older_addr_detail</td>
              <td>date_of_visit</td>
              <td>visit_place</td>
              <td>visit_place_identify</td>
              <td>date_of_pay</td>
              <td>pay_amount</td>
              <td>payee_type</td>
            </tr>";
      echo "<tr>
              <td>วันที่แจ้งเรื่อง</td>
              <td>เลข ปปช.ผู้ยื่นคำขอ (13 หลัก)</td>
              <td>คำนำหน้าชื่อ : 'นาย', 'นาง', 'นางสาว'</td>
              <td>ชื่อตัว</td>
              <td>ชื่อสกุล</td>
              <td>เพศ : 'ไม่ทราบ', 'ชาย', 'หญิง', 'ไม่สามารถระบุได้'</td>
              <td>req_date_of_birth</td>
              <td>ที่อยู่ผู้ยื่นคำขอ</td>
              <td>เลข ปปช.ผู้สูงอายุ</td>
              <td>คำนำหน้าชื่อ : 'นาย', 'นาง', 'นางสาว'</td>
              <td>ชื่อตัว</td>
              <td>ชื่อสกุล</td>
              <td>เพศ : 'ไม่ทราบ', 'ชาย', 'หญิง', 'ไม่สามารถระบุได้'</td>
              <td>วันเดือนปีเกิด</td>
              <td>ที่อยู่ผู้ยื่นคำขอผู้สูงอายุ</td>
              <td>วันที่ตรวจเยี่ยม</td>
              <td>สถานที่ตรวจเยี่ยม : 'ที่พักอาศัย','โรงพยาบาล','สถานีตำรวจ','อื่น ๆ'</td>
              <td>สถานที่ตรวจเยี่ยม อื่น ๆ (ระบุ)</td>
              <td>วันที่รับเงิน</td>
              <td>จำนวนเงินที่สงเคราะห์ (บาท)</td>
              <td>ผู้รับเงิน : 'รับด้วยตนเอง','ผู้รับมอบอำนาจ'</td>
            </tr>";
      foreach ($list_personal as $key => $personal) {
          $intRow++;
          if(!$this->chkNPID($personal['pid'])){
              //echo '<span style="color:#00FF00;">'.$intRow.' = '.$personal['pid']." กูกต้องตามกรมการปกครอง</span><br />";
              $date_of_req = ($personal['date_of_req']=='0000-00-00')?'':$personal['date_of_req'];
              if($personal['req_gender_code'] == '1'){
                  $req_gender = 'ชาย';
              }else if($personal['req_gender_code'] == '2'){
                  $req_gender = 'หญิง';
              }else{
                  $req_gender = '';
              }
              $req_date_of_birth = ($personal['req_date_of_birth']=='0000-00-00')?'':$personal['req_date_of_birth'];
              if($personal['gender_code'] == '1'){
                  $gender = 'ชาย';
              }else if($personal['gender_code'] == '2'){
                  $gender = 'หญิง';
              }else{
                  $gender = '';
              }
              $req_date_of_birth = ($personal['req_date_of_birth']=='0000-00-00')?'':$personal['req_date_of_birth'];
              $date_of_birth = ($personal['date_of_birth']=='0000-00-00')?'':$personal['date_of_birth'];
              $date_of_visit = ($personal['date_of_visit']=='0000-00-00')?'':$personal['date_of_visit'];
              $date_of_pay = ($personal['date_of_pay']=='0000-00-00')?'':$personal['date_of_pay'];
              $pre_address1 = $this->monitordata_model->getAddress1($personal['pre_addr_id']);
              $pre_address2 = $this->monitordata_model->getAddress2($personal['pre_addr_id']);
              echo "<tr>
                      <td>".$date_of_req."</td>
                      <td>".$personal['req_pid']."</td>
                      <td>".$personal['req_prename_th']."</td>
                      <td>".$personal['req_pers_firstname_th']."</td>
                      <td>".$personal['req_pers_lastname_th']."</td>
                      <td>".$req_gender."</td>
                      <td>".$req_date_of_birth."</td>
                      <td>".$personal['req_older_addr_detail']."</td>
                      <td>".$personal['pid']."</td>
                      <td>".$personal['prename_th']."</td>
                      <td>".$personal['pers_firstname_th']."</td>
                      <td>".$personal['pers_lastname_th']."</td>
                      <td>".$gender."</td>
                      <td>".$date_of_birth."</td>
                      <td>".$pre_address1.$pre_address2."</td>
                      <td>".$date_of_visit."</td>
                      <td>".$personal['visit_place']."</td>
                      <td>".$personal['visit_place_identify']."</td>
                      <td>".$date_of_pay."</td>
                      <td>".$personal['pay_amount']."</td>
                      <td>".$personal['payee_type']."</td>
                    </tr>";
          }else{
              //echo '<span style="color:#FF0000;">'.$intRow.' = '.$personal['pid']." ไม่กูกต้องตามกรมการปกครอง</span><br />";
          }
      }
      echo "</table>";
      exit();
  }

  function individual_list(){
      $this->load->model(array('monitordata_model'));
      $list_personal = $this->monitordata_model->get_pers_info_list();
      $intRow = 0;
      echo '<table border="1">';
      echo "<tr>
              <td>pid</td>
              <td>pers_prename_th</td>
              <td>pers_firstname_th</td>
              <td>pers_lastname_th</td>
              <td>gender_code</td>
              <td>req_date_of_birth</td>
              <td>address</td>
            </tr>";
      /*
      <td>diff_info</td>
      <td>fnrl_info</td>
      <td>impv_home_info</td>
      <td>impv_place_info</td>
      <td>volt_info</td>
      <td>wisd_info</td>
      <td>adm_info</td>
      <td>edoe_older</td>
      */
      echo "<tr>
              <td>เลข ปปช.ผู้ยื่นคำขอ (13 หลัก)</td>
              <td>คำนำหน้าชื่อ : 'นาย', 'นาง', 'นางสาว'</td>
              <td>ชื่อตัว</td>
              <td>ชื่อสกุล</td>
              <td>เพศ : 'ไม่ทราบ', 'ชาย', 'หญิง', 'ไม่สามารถระบุได้'</td>
              <td>วันเดือนปีเกิด</td>
              <td>ที่อยู่</td>

            </tr>";
      /*
      <td>ยากลำบาก</td>
      <td>จัดการงานศพ</td>
      <td>ปรับสภาพบ้าน</td>
      <td>ปรับสภาพสถานที่</td>
      <td>อาสาสมัครผู้ดูแลผู้สูงอายุ</td>
      <td>คลังปัญญา</td>
      <td>ศูนย์พัฒนาการ</td>
      <td>ส่งเสริมการจ้างงาน</td>
      */
      foreach ($list_personal as $key => $personal) {
          $intRow++;
          //if(!$this->chkNPID($personal['pid'])){//$this->chkNPID($personal['pid'])
              //$individual_list = $this->monitordata_model->get_individual_list($personal['pid']);

              if($personal['gender_code'] == '1'){
                  $gender = 'ชาย';
              }else if($personal['gender_code'] == '2'){
                  $gender = 'หญิง';
              }else{
                  $gender = '';
              }
              $date_of_birth = ($personal['date_of_birth']=='0000-00-00')?'':$personal['date_of_birth'];
              $pre_address1 = $this->monitordata_model->getAddress1($personal['pre_addr_id']);
              $pre_address2 = $this->monitordata_model->getAddress2($personal['pre_addr_id']);
              /*
              $diff_info = ($individual_list['diff_info_pers_id']!='')?'/':'';
              $fnrl_info = ($individual_list['fnrl_info_pers_id']!='')?'/':'';
              $impv_home_info = ($individual_list['impv_home_info_pers_id']!='')?'/':'';
              $impv_place_info = ($individual_list['impv_place_info_pers_id']!='')?'/':'';
              $volt_info = ($individual_list['volt_info_elderly_care_pers_id']!='')?'/':'';
              $wisd_info = ($individual_list['wisd_info_pers_id']!='')?'/':'';
              $adm_info = ($individual_list['adm_info_pers_id']!='')?'/':'';
              $edoe_older = ($individual_list['edoe_older_emp_reg_pers_id']!='')?'/':'';*/
              /*if(
                $diff_info != '' || $fnrl_info != '' ||
                $impv_home_info != '' || $impv_place_info != '' ||
                $volt_info != '' || $wisd_info != '' ||
                $adm_info != '' || $edoe_older != ''
              ){*/
                  echo "<tr>
                          <td>".$personal['pid']."</td>
                          <td>".$personal['prename_th']."</td>
                          <td>".$personal['pers_firstname_th']."</td>
                          <td>".$personal['pers_lastname_th']."</td>
                          <td>".$gender."</td>
                          <td>".$date_of_birth."</td>
                          <td>".$pre_address1.$pre_address2."</td>
                        </tr>";
                    /*
                    <td>".$diff_info."</td>
                    <td>".$fnrl_info."</td>
                    <td>".$impv_home_info."</td>
                    <td>".$impv_place_info."</td>
                    <td>".$volt_info."</td>
                    <td>".$wisd_info."</td>
                    <td>".$adm_info."</td>
                    <td>".$edoe_older."</td>
                    */
            //}
          //}else{
              //echo '<span style="color:#FF0000;">'.$intRow.' = '.$personal['pid']." ไม่กูกต้องตามกรมการปกครอง</span><br />";
          //}
      }
      echo "</table>";
      exit();
  }
	public function data_summary(){
			//$data = array('1','2');
			$this->load->model(array('monitordata_model'));
			#รวมทั้งหมด
			$sum_personal = $this->monitordata_model->get_sum_personal();
			$data['sum_personal'] = $sum_personal['count_pers'];
			#ไม่มีเลขบัตรประจำตัวประชาชน
			$sum_idcard_null = $this->monitordata_model->get_sum_idcard_null();
			$data['sum_idcard_null'] = $sum_idcard_null['count_pers'];
			#ไม่มีคำหน้าชื่อและไม่ถูกต้อง
			$sum_prename_null = $this->monitordata_model->get_sum_prename_null();
			$data['sum_prename_null'] = $sum_prename_null['count_pers'];
			#ไม่มีชื่อหรือนามสกุล
			$sum_name_null = $this->monitordata_model->get_sum_name_null();
			$data['sum_name_null'] = $sum_name_null['count_pers'];
			#ไม่มีเพศและไม่ถูกต้อง
			$sum_gender_null = $this->monitordata_model->get_sum_gender_null();
			$data['sum_gender_null'] = $sum_gender_null['count_pers'];
			#ไม่มีวัน เดือน ปีเกิด
			$sum_date_of_birth_null = $this->monitordata_model->get_sum_date_of_birth_null();
			$data['sum_date_of_birth_null'] = $sum_date_of_birth_null['count_pers'];
			#ไม่มีอยู่ตามทะเบียนบ้าน
			$sum_reg_addr_null = $this->monitordata_model->get_sum_reg_addr_null();
			$data['sum_reg_addr_null'] = $sum_reg_addr_null['count_pers'];
			#ไม่มีที่อยู่ปัจจุบัน
			$sum_pre_addr_null = $this->monitordata_model->get_sum_pre_addr_null();
			$data['sum_pre_addr_null'] = $sum_pre_addr_null['count_pers'];
			#เลขบัตรประจำตัวประชาชนซ้ำกัน
			$sum_idcard_double = $this->monitordata_model->get_sum_idcard_double();
			$data['sum_idcard_double'] = $sum_idcard_double;
			#ชื่อ-นามสกุลซ้ำกันซ้ำกัน
			$sum_name_double = $this->monitordata_model->get_sum_name_double();
			$data['sum_name_double'] = $sum_name_double;

			#การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
			#รวมทั้งหมด
			$sum_diff = 0;
			$sum_diff_personal = $this->monitordata_model->get_diff_sum_personal();
			$data['sum_diff_personal'] = $sum_diff_personal['count_pers'];
			#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) เลขประจำตัวประชาชน
			$sum_diff_req_pers_idcard_null = $this->monitordata_model->get_diff_sum_req_pers_idcard_null();
			$data['sum_diff_req_pers_idcard_null'] = $sum_diff_req_pers_idcard_null['count_pers'];
			#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) วันที่แจ้งเรื่อง
			$sum_diff_sum_date_of_req_null = $this->monitordata_model->get_diff_sum_date_of_req_null();
			$data['sum_diff_sum_date_of_req_null'] = $sum_diff_sum_date_of_req_null['count_pers'];
			#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ช่องทางการแจ้งเรื่อง
			$sum_diff_sum_chn_code_null = $this->monitordata_model->get_diff_sum_chn_code_null();
			$data['sum_diff_sum_chn_code_null'] = $sum_diff_sum_chn_code_null['count_pers'];
			#ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) เลขประจำตัวประชาชน
			$sum_diff_pers_idcard_null = $this->monitordata_model->get_diff_sum_pers_idcard_null();
			$data['sum_diff_pers_idcard_null'] = $sum_diff_pers_idcard_null['count_pers'];
      #ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) เลขบัตรประจำตัวประชาชนซ้ำกัน
      $sum_diff_pers_idcard_double = $this->monitordata_model->get_diff_sum_pers_idcard_double();
      $data['sum_diff_pers_idcard_double'] = $sum_diff_pers_idcard_double['count_pers'];
			#วันที่ตรวจเยี่ยม
			$sum_diff_date_of_visit_null = $this->monitordata_model->get_diff_sum_date_of_visit_null();
			$data['sum_diff_date_of_visit_null'] = $sum_diff_date_of_visit_null['count_pers'];
			#วันที่รับเงิน
			$sum_diff_date_of_pay_null = $this->monitordata_model->get_diff_sum_date_of_pay_null();
			$data['sum_diff_date_of_pay_null'] = $sum_diff_date_of_pay_null['count_pers'];
			#จำนวนเงินที่สงเคราะห์ (บาท)
			$sum_diff_pay_amount_null = $this->monitordata_model->get_diff_sum_pay_amount_null();
			$data['sum_diff_pay_amount_null'] = $sum_diff_pay_amount_null['count_pers'];
			#ผู้รับเงิน
			$sum_diff_sum_payee_type_null = $this->monitordata_model->get_diff_sum_payee_type_null();
			$data['sum_diff_sum_payee_type_null'] = $sum_diff_sum_payee_type_null['count_pers'];

			#การสงเคราะห์ในการจัดงานศพผู้สูงอายุตามประเพณี
			#รวมทั้งหมด
			$sum_fnrl = 0;
			$sum_fnrl_personal = $this->monitordata_model->get_fnrl_sum_personal();
			$data['sum_fnrl_personal'] = $sum_fnrl_personal['count_pers'];
			#ข้อมูลผู้ยืนคำขอ (ผู้ยื่นขอรับเงินสงเคราะห์ในการจัดงานศพผู้สูงอายุตามประเพณี) เลขประจำตัวประชาชน
			$sum_fnrl_req_pers_idcard_null = $this->monitordata_model->get_fnrl_sum_req_pers_idcard_null();
			$data['sum_fnrl_req_pers_idcard_null'] = $sum_fnrl_req_pers_idcard_null['count_pers'];
			#ข้อมูลผู้ยืนคำขอ (ผู้ยื่นขอรับเงินสงเคราะห์ในการจัดงานศพผู้สูงอายุตามประเพณี) วันที่แจ้งเรื่อง
			$sum_fnrl_date_of_req_null = $this->monitordata_model->get_fnrl_sum_date_of_req_null();
			$data['sum_fnrl_date_of_req_null'] = $sum_fnrl_date_of_req_null['count_pers'];
			#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) เลขประจำตัวประชาชน
			$sum_fnrl_pers_idcard_null = $this->monitordata_model->get_fnrl_sum_pers_idcard_null();
			$data['sum_fnrl_pers_idcard_null'] = $sum_fnrl_pers_idcard_null['count_pers'];
			#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) วันที่เสียชีวิต
			$sum_fnrl_date_of_death_null = $this->monitordata_model->get_fnrl_sum_date_of_death_null();
			$data['sum_fnrl_date_of_death_null'] = $sum_fnrl_date_of_death_null['count_pers'];
			#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) วันที่ออกใบมรณบัตร
			$sum_fnrl_date_of_death_certificate_null = $this->monitordata_model->get_fnrl_sum_date_of_death_certificate_null();
			$data['sum_fnrl_date_of_death_certificate_null'] = $sum_fnrl_date_of_death_certificate_null['count_pers'];
			#ข้อมูลการสงเคราะห์ วันที่รับเงิน
			$sum_fnrl_date_of_pay_null = $this->monitordata_model->get_fnrl_sum_date_of_pay_null();
			$data['sum_fnrl_date_of_pay_null'] = $sum_fnrl_date_of_pay_null['count_pers'];
			#ข้อมูลการสงเคราะห์ จำนวนเงินที่สงเคราะห์ (บาท)
			$sum_fnrl_pay_amount_null = $this->monitordata_model->get_fnrl_sum_pay_amount_null();
			$data['sum_fnrl_pay_amount_null'] = $sum_fnrl_pay_amount_null['count_pers'];
			#ข้อมูลการสงเคราะห์ ผู้รับเงิน
			$sum_fnrl_payee_type_null = $this->monitordata_model->get_fnrl_sum_payee_type_null();
			$data['sum_fnrl_payee_type_null'] = $sum_fnrl_payee_type_null['count_pers'];

			#การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ ปรับปรุงบ้าน
			#รวมทั้งหมด
			$sum_impv_home = 0;
			$sum_impv_home_personal = $this->monitordata_model->get_impv_home_sum_personal();
			$data['sum_impv_home_personal'] = $sum_impv_home_personal['count_pers'];
			#ข้อมูลผู้สูงอายุ เลขประจำตัวประชาชน
			$sum_impv_home_pers_idcard_null = $this->monitordata_model->get_impv_home_sum_pers_idcard_null();
			$data['sum_impv_home_pers_idcard_null'] = $sum_impv_home_pers_idcard_null['count_pers'];
			#ข้อมูลผู้สูงอายุ วันที่สอบถาม
			$sum_impv_home_date_of_svy_null = $this->monitordata_model->get_impv_home_sum_date_of_svy_null();
			$data['sum_impv_home_date_of_svy_null'] = $sum_impv_home_date_of_svy_null['count_pers'];
			#ข้อมูลผู้ยินยอม เลขประจำตัวประชาชน
			$sum_impv_home_cns_pers_null = $this->monitordata_model->get_impv_home_sum_cns_pers_null();
			$data['sum_impv_home_cns_pers_null'] = $sum_impv_home_cns_pers_null['count_pers'];
			#ผลการสงเคราะห์ วันที่ดำเนินการเสร็จสิ้น
			$sum_impv_home_date_of_finish_null = $this->monitordata_model->get_impv_home_sum_date_of_finish_null();
			$data['sum_impv_home_date_of_finish_null'] = $sum_impv_home_date_of_finish_null['count_pers'];

      #การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ สถานที่
      #รวมทั้งหมด
      $sum_impv_place = 0;
      $sum_impv_place_personal = $this->monitordata_model->get_impv_place_sum_personal();
      $data['sum_impv_place_personal'] = $sum_impv_place_personal['count_pers'];
      #ข้อมูลผู้สูงอายุ เลขประจำตัวประชาชน
      $sum_impv_place_pers_idcard_null = $this->monitordata_model->get_impv_place_sum_pers_idcard_null();
      $data['sum_impv_place_pers_idcard_null'] = $sum_impv_place_pers_idcard_null['count_pers'];
      #ข้อมูลผู้สูงอายุ วันที่สอบถาม
      $sum_impv_place_date_of_svy_null = $this->monitordata_model->get_impv_place_sum_date_of_svy_null();
      $data['sum_impv_place_date_of_svy_null'] = $sum_impv_place_date_of_svy_null['count_pers'];
      #ข้อมูลผู้ยินยอม เลขประจำตัวประชาชน
      $sum_impv_place_cns_pers_null = $this->monitordata_model->get_impv_place_sum_cns_pers_null();
      $data['sum_impv_place_cns_pers_null'] = $sum_impv_place_cns_pers_null['count_pers'];
      #ผลการสงเคราะห์ วันที่ดำเนินการเสร็จสิ้น
      $sum_impv_place_date_of_finish_null = $this->monitordata_model->get_impv_place_sum_date_of_finish_null();
      $data['sum_impv_place_date_of_finish_null'] = $sum_impv_place_date_of_finish_null['count_pers'];

			$this->template("back-end/main", $data);
	}
	#การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
	public function diff_list_ajax($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		ini_set('max_execution_time', 300);
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 2;
		/*--END Inizial Data for Check User Permission--*/
		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			echo json_encode(array());
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;
			$this->load->model(array('monitordata_model'));
			$case = $_POST['request_case'];
			$list = $this->monitordata_model->get_diff_datatables($case);
			$data = array();
			$no = $_POST['start'];
			foreach ($list as $i=>$monitordata) {
				$no++;
				$row = array();
				$row[] = "<center>".$no."</center>";
				$row[] = $monitordata->pid;
				$row[] = $monitordata->prename_th." ".$monitordata->name;
				$row[] = $monitordata->gender_name;
				if($monitordata->date_of_birth!='' && $monitordata->date_of_birth!='0000-00-00'){
						$arr_date = explode("-", $monitordata->date_of_birth);
						$date_of_birth = $arr_date[2].'/'.$arr_date[1].'/'.($arr_date[0]+543);
				}else{
						$date_of_birth = '';
				}
				$row[] = "<center>".$date_of_birth."</center>";

				$date_of_req = '';
				if($monitordata->date_of_req!='' && $monitordata->date_of_req!='0000-00-00') {
						$date_of_req = '<font class="text-sucsess" color="#18bd15">'.dateChange($monitordata->date_of_req,5).'</font>';
				}else {
						$date_of_req = '<font class="text-sucsess" color="#B9B9B9">ยังไม่ได้แจ้งเรื่อง</font>';
				}
				$row[] = "<center>".$date_of_req."</center>";

				$date_of_visit = '';
				if($monitordata->date_of_visit!='' && $monitordata->date_of_visit!='0000-00-00') {
							$date_of_visit = '<font class="text-sucsess" color="#18bd15">'.dateChange($monitordata->date_of_visit,5).'</font>';
				}else{
							$date_of_visit = '<font class="text-sucsess" color="#B9B9B9">รอตรวจเยี่ยม</font>';
				}
				$row[] = "<center>".$date_of_visit."</center>";

				$date_of_pay = '';
				if($monitordata->date_of_pay!='' && $monitordata->date_of_pay!='0000-00-00') {
						$date_of_pay = '<font class="text-sucsess" color="#18bd15">'.dateChange($monitordata->date_of_pay,5).'</font>';
				}else{
						$date_of_pay = '<font class="text-sucsess" color="#B9B9B9">รอช่วยเหลือ</font>';
				}
				$row[] = "<center>".$date_of_pay."</center>";
				$row[] = "<div style='width:100%;text-align:right;'>".number_format($monitordata->pay_amount,2)."</div>";
				$row[] = '<center><a href="'.site_url("difficult/sufferer_form1/Edit/".$monitordata->diff_id).'" target="_blank">แก้ไขรายการ</a></center>';
				$data[] = $row;
			}
			$output = array(
							"draw" => $_POST['draw'],
							"recordsTotal" => $this->monitordata_model->count_diff_all(),
							"recordsFiltered" => $this->monitordata_model->count_diff_filtered($case),
							"data" => $data,
			);
			echo json_encode($output);
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}

	public function diff_list($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		ini_set('max_execution_time', 300);
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 2;
		$process_path = 'monitordata/diff_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$this->load->library('template',
				array('name'=>'admin_template1',
						'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			/*-- datepicker custom --*/
			set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
			set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
			set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
			/*-- End datepicker custom--*/

			//set_js_asset_footer('assist_list.js','difficult'); //Set JS Index.js
			set_js_asset_footer('diff_list_ajax.js','monitordata'); //Set JS Index.js
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'diff_list_ajax';
			//exit();
			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			$this->template->load('index_page',$data,'monitordata');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}
	#การสงเคราะห์ในการจัดการศพผู้สูงอายุตามประเพณี
	public function funeral_list_ajax($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		//ini_set('max_execution_time', 300);
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 21;
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			echo json_encode(array());
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;
			$this->load->model(array('monitordata_model'));
			$case = $_POST['request_case'];

			$list = $this->monitordata_model->get_funeral_datatables($case);
			$data = array();
			$no = $_POST['start'];
			// dieArray($list);
			foreach ($list as $i=>$funeral) {

				$no++;
				$row = array();

					$pers_info = $this->personal_model->getOnce_PersonalInfo($funeral->pers_id);
					$req_pers_info = $this->personal_model->getOnce_PersonalInfo($funeral->req_pers_id);

								$row[] = "<center>".$no."|".$case."</center>";
								$row[] = $pers_info['pid'];
								$row[] = $pers_info['prename_th'].$pers_info['name'];

								$age = '';
								if($pers_info['date_of_birth']!='') {
									$date = new DateTime($pers_info['date_of_birth']);
									$now = new DateTime($pers_info['date_of_death']);
									$interval = $now->diff($date);
									$age = $interval->y;
								}

								$row[] = "<center>".$age."</center>";
								$date_of_req = '-';
								if($funeral->date_of_req!='') {
										$date_of_req = '<font class="text-sucsess" color="#18bd15">'.dateChange($funeral->date_of_req,5).'</font>';
								}
								$row[] = "<center>".$date_of_req."</center>";

								$date_of_pay = '-';
								if($funeral->date_of_pay!='') {
										$date_of_pay = '<font class="text-sucsess" color="#18bd15">'.dateChange($funeral->date_of_pay,5).'</font>';
								}
								$row[] = "<center>".$date_of_pay."</center>";
								$row[] ="<div style='width:100%;text-align:right;'>".number_format($funeral->pay_amount,2)."</div>";
								$row[] = '<center><a href="'.site_url("funeral/inform1/Edit/".$funeral->fnrl_id).'" target="_blank">แก้ไขรายการ</a></center>';

								$data[] = $row;
						}

				$output = array(
								"draw" => $_POST['draw'],
								"recordsTotal" => $this->monitordata_model->count_funeral_all(),
								"recordsFiltered" => $this->monitordata_model->count_funeral_filtered($case),
								"data" => $data,
						);
			//output to json format
			echo json_encode($output);
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}

	public function funeral_list($process_action='View') { // ตารางข้อมูล
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 21;
		$process_path = 'monitordata/funeral_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$this->load->library('template',
				array('name'=>'admin_template1',
						'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			//set_js_asset_footer('funeral_list.js','funeral'); //Set JS Index.js
			set_js_asset_footer('funeral_list_ajax.js','monitordata'); //Set JS Index.js
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'funeral_list_ajax';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];
			$this->template->load('index_page',$data,'monitordata');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}
	#การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ
	public function adaptenvir_list_ajax($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 21;
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			echo json_encode(array());
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$this->load->model(array('monitordata_model'));
			$case = $_POST['request_case'];
			$list = $this->monitordata_model->get_impv_home_datatables($case);
			$data = array();
			$no = $_POST['start'];
			// dieArray($list);
			foreach ($list as $i=>$adaptenvir) {
				$no++;
				$row = array();

				$pers_info = $this->personal_model->getOnce_PersonalInfo($adaptenvir->pers_id);
				$row[] = "<center>".$no."</center>";
				$row[] = $pers_info['pid'];
				$row[] = $pers_info['prename_th'].$pers_info['name'];

				$age = '';
				if($pers_info['date_of_birth']!='') {
					$date = new DateTime($pers_info['date_of_birth']);
					if($pers_info['date_of_death'] != '0000-00-00'){
						$now = new DateTime($pers_info['date_of_death']);
					}else{
						$now = new DateTime();
					}
					$interval = $now->diff($date);
					$age = $interval->y;
				}
				$row[] = "<center>".$age."</center>";

				$date_of_svy = '-';
				if($adaptenvir->date_of_svy!='') {
					$date_of_svy = '<font class="text-sucsess" color="#18bd15">'.dateChange($adaptenvir->date_of_svy,5).'</font>';
				}
				$row[] = "<center>".$date_of_svy."</center>";

				$date_of_consi = '-';
				if($adaptenvir->date_of_consi!='') {
					$date_of_consi = '<font class="text-sucsess" color="#18bd15">'.dateChange($adaptenvir->date_of_consi,5).'</font>';
				}
				$row[] = "<center>".$date_of_consi."</center>";

				$date_of_finish = '-';
				if($adaptenvir->date_of_finish!='') {
					$date_of_finish = '<font class="text-sucsess" color="#18bd15">'.dateChange($adaptenvir->date_of_finish,5).'</font>';
				}
				$row[] = "<center>".$date_of_finish."<center>";
				$row[] ="<div style='width:100%;text-align:right;'>".number_format($adaptenvir->case_budget,2)."</div>";
				$row[] = '<center><a href="'.site_url("adaptenvir/inquire1/Edit/".$adaptenvir->imp_home_id).'" target="_blank">แก้ไขรายการ</a></center>';
				$data[] = $row;
			}
			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->monitordata_model->count_impv_home_all(),
				"recordsFiltered" => $this->monitordata_model->count_impv_home_filtered($case),
				"data" => $data,
			);
			//output to json format
			echo json_encode($output);
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}

	public function adaptenvir_list($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		// ini_set('mex_execution_time',300);
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 29;
		$process_path = 'monitordata/adaptenvir_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$this->load->library('template',
				array('name'=>'admin_template1',
						'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/
				/*-- Toastr style --*/
				set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
				set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
				/*-- End Toastr style --*/

			set_js_asset_footer('adaptenvir_list_ajax.js','monitordata'); //Set JS Index.js
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js

			$data['process_action'] = $process_action;
			$data['content_view'] = 'adaptenvir_list_ajax';

			//$data['impv_home_info'] = $this->adaptenvir_model->getAll_impvHome();
			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] = $usrpm['app_name'];

			// dieArray($data);
			$this->template->load('index_page',$data,'monitordata');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}
  public function activity_list_ajax($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
    // ini_set('max_execution_time', 300);
    $data = array(); //Set Initial Variable to Views
    /*-- Initial Data for Check User Permission --*/
    $user_id = get_session('user_id');
    $app_id = 36;
    /*--END Inizial Data for Check User Permission--*/

    $this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
    $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

    if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
      echo json_encode(array());
      $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
    }else {
      $app_name = $usrpm['app_name'];
      $data['usrpm'] = $usrpm;
      $data['user_id'] = $user_id;

      $this->load->model(array('monitordata_model'));
      $case = $_POST['request_case'];
      $list = $this->monitordata_model->get_impv_place_datatables($case);
      $data = array();
      $no = $_POST['start'];
      // dieArray($list);

      foreach ($list as $i=>$adaptenvir) {
        $no++;
        $row = array();

            $row[] = "<center>".$no."</center>";
            $row[] = $adaptenvir->ptype_code_remark;
            $date_of_svy = '-';
            if($adaptenvir->date_of_svy!='') {
              $date_of_svy = '<font class="text-sucsess" color="#18bd15">'.dateChange($adaptenvir->date_of_svy,5).'</font>';
            }
            $row[] = "<center>".$date_of_svy."</center>";
            $consi_result = '-';
            if($adaptenvir->consi_result=='อนุมัติ') {
              $consi_result = '<font class="text-sucsess" color="#18bd15">'.$adaptenvir->consi_result.'</font>';
            }else if($adaptenvir->consi_result=='ไม่อนุมัติ'){
                  $consi_result = '<font class="text-sucsess" color="red">'.$adaptenvir->consi_result.'</font>';
            }
            $row[] = "<center>".$consi_result."</center>";
            $date_of_finish = '-';
            if($adaptenvir->date_of_finish!='') {
              $date_of_finish = '<font class="text-sucsess" color="#18bd15">'.dateChange($adaptenvir->date_of_finish,5).'</font>';
            }
            $row[] = "<center>".$date_of_finish."<center>";
            $row[] ="<div style='width:100%;text-align:right;'>".number_format($adaptenvir->case_budget,2)."</div>";
            $row[] = '<center><a href="'.site_url("adaptenvir/inquire1/Edit/".$adaptenvir->impv_place_id).'" target="_blank">แก้ไขรายการ</a></center>';
            $data[] = $row;
      }

            // dieArray($data);
      $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => $this->monitordata_model->count_impv_place_all(),
        "recordsFiltered" => $this->monitordata_model->count_impv_place_filtered($case),
        "data" => $data,
      );
      //output to json format
      echo json_encode($output);
      $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
    }

  }

  public function activity_list($process_action='View') { // รายการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
    $data = array(); //Set Initial Variable to Views
    /*-- Initial Data for Check User Permission --*/
    $user_id = get_session('user_id');
    $app_id = 36;
    $process_path = 'monitordata/activity_list';
    /*--END Inizial Data for Check User Permission--*/

    $this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
    $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

    if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
      page500();
      $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
    }else {
      $app_name = $usrpm['app_name'];
      $data['usrpm'] = $usrpm;
      $data['user_id'] = $user_id;

      //$data['impv_place_info'] = $this->adaptenvir_model->getAll_impvPlace();

      $this->load->library('template',
        array('name'=>'admin_template1',
            'setting'=>array('data_output'=>''))
      ); // Set Template

      $data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );

      /*-- Load Datatables for Theme --*/
      set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
      set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
      /*-- End Load Datatables for Theme --*/

      /*-- Toastr style --*/
      set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
      set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
      /*-- End Toastr style --*/

      set_js_asset_footer('activity_list_ajax.js','monitordata'); //Set JS Index.js

      set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js


      $data['process_action'] = $process_action;
      $data['content_view'] = 'activity_list_ajax';

      $tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
      $data['head_title'] = $tmp['app_name'];
      $data['title'] = $usrpm['app_name'];
      // dieArray($data);
      $this->template->load('index_page',$data,'adaptenvir');
      $this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
    }

  }

}
