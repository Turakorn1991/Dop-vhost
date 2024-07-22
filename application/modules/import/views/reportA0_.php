<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 14:04
 */

$col_all=37;

?>
<table  cellspacing="0" cellpadding="0" >
<?php foreach ($res['headers'] as $header) {
  ?>
  <tr>
    <td  colspan="<?php echo $col_all ?>"><?php echo $header?></td>
  </tr>
<?php
}?>

 <tr  <?php echo $dimen ?> _excel-styles='{"border":{"style":"PHPExcel_Style_Border::BORDER_DASHDOT","color":{"rgb":"FF0000"}}}'>
    <td  colspan="30">แจ้งเรื่อง</td>
    <td  colspan="3">ตรวจเยี่ยม</td>
    <td  colspan="4">สงเคราะห์</td>
  </tr>
 <tr <?php echo $dimen ?> _excel-styles='{"alignment":{"horizontal":"PHPExcel_Style_Alignment::HORIZONTAL_CENTER"}}'>
    <td  colspan="10">ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง)</td>
    <td  colspan="20">ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์)</td>
    <td  rowspan="3">วันที่ตรวจเยี่ยม</td>
    <td  rowspan="3">สถานที่ตรวจเยี่ยม</td>
    <td  rowspan="3">ผลการให้ความช่วยเหลือ</td>
    <td  rowspan="3">วันที่รับเงิน</td>
    <td  rowspan="3">วันที่ออกใบสำคัญรับเงิน</td>
    <td  rowspan="3">จำนวนเงินที่สงเคราะห์ (บาท)</td>
    <td  rowspan="3">ผู้รับเงิน</td>
  </tr>
 <tr <?php echo $dimen ?> _excel-styles='{"alignment":{"horizontal":"PHPExcel_Style_Alignment::HORIZONTAL_CENTER"}}'>
    <td  rowspan="2">เลขประจำตัวประชาชน</td>
    <td  rowspan="2">ชื่อตัว/ชื่อสกุล</td>
    <td  rowspan="2">วันเดือนปีเกิด</td>
    <td  rowspan="2">เพศ</td>
    <td  rowspan="2">วันที่แจ้งเรื่อง</td>
    <td  rowspan="2">ตำแหน่ง</td>
    <td  rowspan="2">หน่วยงาน</td>
    <td  rowspan="2">เกี่ยวข้องเป็น</td>
    <td  rowspan="2">เบอร์โทรศัพท์ (มือถือ)</td>
    <td  rowspan="2">ช่องทางการแจ้ง</td>
    <td  rowspan="2">เลขประจำตัวประชาชน</td>
    <td  rowspan="2">ชื่อตัว/ชื่อสกุล</td>
    <td  rowspan="2">วันเดือนปีเกิด</td>
    <td  rowspan="2">เพศ</td>
    <td  colspan="8">ที่อยู่ (ปัจจุบัน)</td>
    <td  rowspan="2">เบอร์โทรศัพท์ (มือถือ)</td>
    <td  rowspan="2">สถานะการสมรส</td>
    <td  rowspan="2">ระดับการศึกษา</td>
    <td  rowspan="2">อาชีพ (ปัจจุบัน)</td>
    <td  rowspan="2">รายได้เฉลี่ย/เดือน (บาท)</td>
    <td  rowspan="2">ที่มาของรายได้</td>
    <td  rowspan="2">สถานะหนี้สิน</td>
    <td  rowspan="2">สมาชิกในครอบครัว (คน)</td>
  </tr>
 <tr <?php echo $dimen ?> _excel-styles='{"alignment":{"horizontal":"PHPExcel_Style_Alignment::HORIZONTAL_CENTER"}}'>
   <td colspan="14"></td>
    <td>บ้านเลขที่</td>
    <td>หมู่ที่</td>
    <td>ตรอก</td>
    <td>ซอย</td>
    <td>ถนน</td>
    <td>ตำบล</td>
    <td>อำเภอ</td>
    <td>จังหวัด</td>
  </tr>
  <tr <?php echo $dimen ?>>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
    <td>1</td>
  </tr>

</table>




