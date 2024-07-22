<?php

function progress($percent=0){
  $css_color = 'percent_l';
  if($percent > 66.66){
    $css_color = 'percent_h';
  }else if($percent > 33.33){
    $css_color = 'percent_m';
  }else{
    $css_color = 'percent_l';
  }
  return $css_color;
}
?>
<div class="col-sm-12">
    <table width="100%" class="report-table">
      <tr>
        <td class="report-th" colspan="5" style="text-align: left !important;">ฐานข้อมูลกลาง</td>
      </tr>
      <tr>
        <td class="report-th">รายการ</td>
        <td class="report-th" width="12%">ไม่ถูกต้อง</td>
        <td class="report-th" width="12%">ถูกต้อง</td>
        <td class="report-th" width="12%">รวม</td>
        <td class="report-th" width="12%">ถูกต้อง (ร้อยละ)</td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_idcard_null_percent = (($sum_personal-$sum_idcard_null)*100)/$sum_personal;
      $css_progress = progress($sum_idcard_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่มีเลขบัตรประจำตัวประชาชน</td>
        <td class="report-td-a right"><?php echo number_format($sum_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_idcard_null_percent, 2); ?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_prename_null_percent = (($sum_personal-$sum_prename_null)*100)/$sum_personal;
      $css_progress = progress($sum_prename_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่มีคำหน้าชื่อและไม่ถูกต้อง</td>
        <td class="report-td-a right"><?php echo number_format($sum_prename_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_prename_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_prename_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_name_null_percent = (($sum_personal-$sum_name_null)*100)/$sum_personal;
      $css_progress = progress($sum_name_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่มีชื่อหรือนามสกุล</td>
        <td class="report-td-a right"><?php echo number_format($sum_name_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_name_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_name_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_gender_null_percent = (($sum_personal-$sum_gender_null)*100)/$sum_personal;
      $css_progress = progress($sum_gender_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่มีเพศและไม่ถูกต้อง</td>
        <td class="report-td-a right"><?php echo number_format($sum_gender_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_gender_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_gender_null_percent,2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_date_of_birth_null_percent = (($sum_personal-$sum_date_of_birth_null)*100)/$sum_personal;
      $css_progress = progress($sum_date_of_birth_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่มีวัน เดือน ปีเกิด</td>
        <td class="report-td-a right"><?php echo number_format($sum_date_of_birth_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_date_of_birth_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_date_of_birth_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_reg_addr_null_percent = (($sum_personal-$sum_reg_addr_null)*100)/$sum_personal;
      $css_progress = progress($sum_reg_addr_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่มีอยู่ตามทะเบียนบ้าน</td>
        <td class="report-td-a right"><?php echo number_format($sum_reg_addr_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_reg_addr_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_reg_addr_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_pre_addr_null_percent = (($sum_personal-$sum_pre_addr_null)*100)/$sum_personal;
      $css_progress = progress($sum_pre_addr_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่มีที่อยู่ปัจจุบัน</td>
        <td class="report-td-a right"><?php echo number_format($sum_pre_addr_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_pre_addr_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_pre_addr_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_idcard_double_percent = (($sum_personal-$sum_idcard_double)*100)/$sum_personal;
      $css_progress = progress($sum_idcard_double_percent);
      ?>
      <tr>
        <td class="report-td-a">เลขบัตรประจำตัวประชาชนซ้ำกัน</td>
        <td class="report-td-a right"><?php echo number_format($sum_idcard_double);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_idcard_double);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_idcard_double_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_name_double_percent = (($sum_personal-$sum_name_double)*100)/$sum_personal;
      $css_progress = progress($sum_name_double_percent);
      ?>
      <tr>
        <td class="report-td-a">ชื่อ-นามสกุลซ้ำกัน</td>
        <td class="report-td-a right"><?php echo number_format($sum_name_double);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal-$sum_name_double);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_name_double_percent, 2);?>
        </td>
      </tr>
    </table>
    &nbsp;
    <br />
    <table width="100%" class="report-table">
      <tr>
        <td class="report-th" colspan="5" style="text-align: left !important;">การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก</td>
      </tr>
      <tr>
        <td class="report-th">รายการ</td>
        <td class="report-th" width="12%">ไม่ถูกต้อง</td>
        <td class="report-th" width="12%">ถูกต้อง</td>
        <td class="report-th" width="12%">รวม</td>
        <td class="report-th" width="12%">ถูกต้อง (ร้อยละ)</td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_req_pers_idcard_null_percent = (($sum_diff_personal-$sum_diff_req_pers_idcard_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_req_pers_idcard_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/1");?>" target="_blank">
          <?php echo number_format($sum_diff_req_pers_idcard_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_req_pers_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_diff_req_pers_idcard_null_percent,2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_sum_date_of_req_null_percent = (($sum_diff_personal-$sum_diff_sum_date_of_req_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_sum_date_of_req_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ไม่กรอกวันที่แจ้งเรื่อง</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/2");?>" target="_blank">
          <?php echo number_format($sum_diff_sum_date_of_req_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_sum_date_of_req_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_diff_sum_date_of_req_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_sum_chn_code_null_percent = (($sum_diff_personal-$sum_diff_sum_chn_code_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_sum_chn_code_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ไม่กรอกช่องทางการแจ้งเรื่อง</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/3");?>" target="_blank">
          <?php echo number_format($sum_diff_sum_chn_code_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_sum_chn_code_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_diff_sum_chn_code_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_pers_idcard_null_percent = (($sum_diff_personal-$sum_diff_pers_idcard_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_pers_idcard_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/4");?>" target="_blank">
          <?php echo number_format($sum_diff_pers_idcard_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_pers_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_diff_pers_idcard_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_date_of_visit_null_percent = (($sum_diff_personal-$sum_diff_date_of_visit_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_date_of_visit_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่กรอกวันที่ตรวจเยี่ยม</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/5");?>" target="_blank">
          <?php echo number_format($sum_diff_date_of_visit_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_date_of_visit_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_diff_date_of_visit_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_date_of_pay_null_percent = (($sum_diff_personal-$sum_diff_date_of_pay_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_date_of_pay_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่กรอกวันที่รับเงิน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/6");?>" target="_blank">
          <?php echo number_format($sum_diff_date_of_pay_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_date_of_pay_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>"><?php echo number_format($sum_diff_date_of_pay_null_percent, 2);?></td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_pay_amount_null_percent = (($sum_diff_personal-$sum_diff_pay_amount_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_pay_amount_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่กรอกจำนวนเงินที่สงเคราะห์ (บาท)</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/7");?>" target="_blank">
          <?php echo number_format($sum_diff_pay_amount_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_pay_amount_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>"><?php echo number_format($sum_diff_pay_amount_null_percent, 2);?></td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_diff_sum_payee_type_null_percent = (($sum_diff_personal-$sum_diff_sum_payee_type_null)*100)/$sum_diff_personal;
      $css_progress = progress($sum_diff_sum_payee_type_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ไม่กรอกผู้รับเงิน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/diff_list/8");?>" target="_blank">
          <?php echo number_format($sum_diff_sum_payee_type_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal-$sum_diff_sum_payee_type_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_diff_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>"><?php echo number_format($sum_diff_sum_payee_type_null_percent, 2);?></td>
      </tr>
    </table>
    &nbsp;
    <br />
    <table width="100%" class="report-table">
      <tr>
        <td class="report-th" colspan="5" style="text-align: left !important;">การสงเคราะห์ในการจัดการศพผู้สูงอายุตามประเพณี</td>
      </tr>
      <tr>
        <td class="report-th">รายการ</td>
        <td class="report-th" width="12%">ไม่ถูกต้อง</td>
        <td class="report-th" width="12%">ถูกต้อง</td>
        <td class="report-th" width="12%">รวม</td>
        <td class="report-th" width="12%">ถูกต้อง (ร้อยละ)</td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_req_pers_idcard_null_percent = (($sum_fnrl_personal-$sum_fnrl_req_pers_idcard_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_req_pers_idcard_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้ยืนคำขอ (ผู้ยื่นขอรับเงินสงเคราะห์) <br />ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/1");?>" target="_blank">
          <?php echo number_format($sum_fnrl_req_pers_idcard_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_req_pers_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_req_pers_idcard_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_date_of_req_null_percent = (($sum_fnrl_personal-$sum_fnrl_date_of_req_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_date_of_req_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้ยืนคำขอ (ผู้ยื่นขอรับเงินสงเคราะห์) <br />ไม่กรอกวันที่แจ้งเรื่อง</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/2");?>" target="_blank">
          <?php echo number_format($sum_fnrl_date_of_req_null);?>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_date_of_req_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_date_of_req_null_percent,2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_pers_idcard_null_percent = (($sum_fnrl_personal-$sum_fnrl_pers_idcard_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_pers_idcard_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) <br />ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/3");?>" target="_blank">
          <?php echo number_format($sum_fnrl_pers_idcard_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_pers_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_pers_idcard_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_date_of_death_null_percent = (($sum_fnrl_personal-$sum_fnrl_date_of_death_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_date_of_death_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) <br />ไม่กรอกวันที่เสียชีวิต</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/4");?>" target="_blank">
          <?php echo number_format($sum_fnrl_date_of_death_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_date_of_death_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_date_of_death_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_date_of_death_certificate_null_percent = (($sum_fnrl_personal-$sum_fnrl_date_of_death_certificate_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_date_of_death_certificate_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) <br />ไม่กรอกวันที่ออกใบมรณบัตร</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/5");?>" target="_blank">
          <?php echo number_format($sum_fnrl_date_of_death_certificate_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_date_of_death_certificate_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_date_of_death_certificate_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_percent = (($sum_fnrl_personal-$sum_fnrl)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_percent);
      ?>
      <tr style="display:none;">
        <td class="report-td-a">ข้อมูลผู้รับรอง (กรณีไม่ได้รับการสำรวจข้อมูล จปฐ. ในปีที่เสียชีวิต) <br />ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/6");?>" target="_blank">
          <?php echo number_format($sum_fnrl);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_fnrl_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_percent = (($sum_fnrl_personal-$sum_fnrl)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_percent);
      ?>
      <tr style="display:none;">
        <td class="report-td-a">ข้อมูลผู้รับรอง (กรณีไม่ได้รับการสำรวจข้อมูล จปฐ. ในปีที่เสียชีวิต) <br />ไม่กรอกวันที่รับรอง</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/7");?>" target="_blank">
          <?php echo number_format($sum_fnrl);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_date_of_pay_null_percent = (($sum_fnrl_personal-$sum_fnrl_date_of_pay_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_date_of_pay_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลการสงเคราะห์ ไม่กรอกวันที่รับเงิน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/8");?>" target="_blank">
          <?php echo number_format($sum_fnrl_date_of_pay_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_date_of_pay_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
        <?php echo number_format($sum_fnrl_date_of_pay_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_pay_amount_null_percent = (($sum_fnrl_personal-$sum_fnrl_pay_amount_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_pay_amount_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลการสงเคราะห์ ไม่กรอกจำนวนเงินที่สงเคราะห์ (บาท)</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/9");?>" target="_blank">
          <?php echo number_format($sum_fnrl_pay_amount_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_pay_amount_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_pay_amount_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_fnrl_payee_type_null_percent = (($sum_fnrl_personal-$sum_fnrl_payee_type_null)*100)/$sum_fnrl_personal;
      $css_progress = progress($sum_fnrl_payee_type_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลการสงเคราะห์ ไม่กรอกผู้รับเงิน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/funeral_list/10");?>" target="_blank">
          <?php echo number_format($sum_fnrl_payee_type_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal-$sum_fnrl_payee_type_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_fnrl_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_fnrl_payee_type_null_percent, 2);?>
        </td>
      </tr>
    </table>
    &nbsp;
    <br />
    <table width="100%" class="report-table">
      <tr>
        <td class="report-th" colspan="5" style="text-align: left !important;">การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ ปรับปรุงบ้าน</td>
      </tr>
      <tr>
        <td class="report-th">รายการ</td>
        <td class="report-th" width="12%">ไม่ถูกต้อง</td>
        <td class="report-th" width="12%">ถูกต้อง</td>
        <td class="report-th" width="12%">รวม</td>
        <td class="report-th" width="12%">ถูกต้อง (ร้อยละ)</td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_home_pers_idcard_null_percent = (($sum_impv_home_personal-$sum_impv_home_pers_idcard_null)*100)/$sum_impv_home_personal;
      $css_progress = progress($sum_impv_home_pers_idcard_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/adaptenvir_list/1");?>" target="_blank">
          <?php echo number_format($sum_impv_home_pers_idcard_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal-$sum_impv_home_pers_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_impv_home_pers_idcard_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_home_date_of_svy_null_percent = (($sum_impv_home_personal-$sum_impv_home_date_of_svy_null)*100)/$sum_impv_home_personal;
      $css_progress = progress($sum_impv_home_date_of_svy_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ ไม่กรอกวันที่สอบถาม</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/adaptenvir_list/2");?>" target="_blank">
          <?php echo number_format($sum_impv_home_date_of_svy_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal-$sum_impv_home_date_of_svy_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_impv_home_date_of_svy_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_home_cns_pers_null_percent = (($sum_impv_home_personal-$sum_impv_home_cns_pers_null)*100)/$sum_impv_home_personal;
      $css_progress = progress($sum_impv_home_cns_pers_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้ยินยอม ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/adaptenvir_list/3");?>" target="_blank">
          <?php echo number_format($sum_impv_home_cns_pers_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal-$sum_impv_home_cns_pers_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>"><?php echo number_format($sum_impv_home_cns_pers_null_percent, 2);?></td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_home_date_of_finish_null_percent = (($sum_impv_home_personal-$sum_impv_home_date_of_finish_null)*100)/$sum_impv_home_personal;
      $css_progress = progress($sum_impv_home_date_of_finish_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ผลการสงเคราะห์ ไม่กรอกวันที่ดำเนินการเสร็จสิ้น</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/adaptenvir_list/4");?>" target="_blank">
          <?php echo number_format($sum_impv_home_date_of_finish_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal-$sum_impv_home_date_of_finish_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_home_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_impv_home_date_of_finish_null_percent, 2);?>
        </td>
      </tr>
    </table>
    &nbsp;
    <br />
    <table width="100%" class="report-table">
      <tr>
        <td class="report-th" colspan="5" style="text-align: left !important;">การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ สถานที่</td>
      </tr>
      <tr>
        <td class="report-th">รายการ</td>
        <td class="report-th" width="12%">ไม่กรอก</td>
        <td class="report-th" width="12%">กรอก</td>
        <td class="report-th" width="12%">รวม</td>
        <td class="report-th" width="12%">กรอก (ร้อยละ)</td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_place_pers_idcard_null_percent = (($sum_impv_place_personal-$sum_impv_place_pers_idcard_null)*100)/$sum_impv_place_personal;
      $css_progress = progress($sum_impv_place_pers_idcard_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/activity_list/1");?>" target="_blank">
          <?php echo number_format($sum_impv_place_pers_idcard_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal-$sum_impv_place_pers_idcard_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_impv_place_pers_idcard_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_place_date_of_svy_null_percent = (($sum_impv_place_personal-$sum_impv_place_date_of_svy_null)*100)/$sum_impv_place_personal;
      $css_progress = progress($sum_impv_place_date_of_svy_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้สูงอายุ ไม่กรอกวันที่สอบถาม</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/activity_list/2");?>" target="_blank">
          <?php echo number_format($sum_impv_place_date_of_svy_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal-$sum_impv_place_date_of_svy_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_impv_place_date_of_svy_null_percent, 2);?>
        </td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_place_cns_pers_null_percent = (($sum_impv_place_personal-$sum_impv_place_cns_pers_null)*100)/$sum_impv_place_personal;
      $css_progress = progress($sum_impv_place_cns_pers_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ข้อมูลผู้ยินยอม ไม่กรอกเลขประจำตัวประชาชน</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/activity_list/3");?>" target="_blank">
          <?php echo number_format($sum_impv_place_cns_pers_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal-$sum_impv_place_cns_pers_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>"><?php echo number_format($sum_impv_place_cns_pers_null_percent, 2);?></td>
      </tr>
      <?php
      #ถูกต้อง (ร้อยละ)
      $sum_impv_place_date_of_finish_null_percent = (($sum_impv_place_personal-$sum_impv_place_date_of_finish_null)*100)/$sum_impv_place_personal;
      $css_progress = progress($sum_impv_place_date_of_finish_null_percent);
      ?>
      <tr>
        <td class="report-td-a">ผลการสงเคราะห์ ไม่กรอกวันที่ดำเนินการเสร็จสิ้น</td>
        <td class="report-td-a right">
        <a href="<?php echo site_url("monitordata/activity_list/4");?>" target="_blank">
          <?php echo number_format($sum_impv_place_date_of_finish_null);?>
        </a>
        </td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal-$sum_impv_place_date_of_finish_null);?></td>
        <td class="report-td-a right"><?php echo number_format($sum_impv_place_personal);?></td>
        <td class="report-td-a right <?php echo $css_progress;?>">
          <?php echo number_format($sum_impv_place_date_of_finish_null_percent, 2);?>
        </td>
      </tr>
    </table>
</div>
&nbsp;
</p>
<style>
.percent_h{
  color: #038603 !important;
}
.percent_m{
  color: #ED6505 !important;
}
.percent_l{
  color: #D80202 !important;
}
.report-table{
  border-radius: 5px !important;
  border: 1px solid #a3c3db !important;
}
.report-th{
  background-color: #1675bb !important;
  text-align: center !important;
  border: 1px solid #a3c3db !important;
  color: #FFF;
  padding: 5px;
  font-size: 18px;
  font-weight: 100 !important;
}
.report-td-a{
  font-size: 18px;
  background-color: #ffffff !important;
  border: 1px solid #a3c3db !important;
  font-weight: 100 !important;
  padding: 5px;
  color: #333;
}
.report-td-b{
  font-size: 18px;
  background-color: #f9f9f9 !important;
  border: 1px solid #a3c3db !important;
  font-weight: 100 !important;
  padding: 5px;
  color: #333;
}
.report-td-sum{
  background-color: #92CFFB !important;
  border: 1px solid #a3c3db !important;
  color: #333;
  padding: 5px;
  font-size: 18px;
  font-weight: 100 !important;
}
.center{
  text-align: center;
}
.left{
  text-align: left;
}
.right{
  text-align:right;
}
</style>
