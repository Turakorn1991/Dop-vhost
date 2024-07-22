<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 16:17
 */?>
<div class="page" size="A4" <?php echo (@$layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large" style="line-height: 33px;padding-bottom: 0 !important;">
    <div class="row">
      <div class="col col-xs-12 caption text-center">
        หนังสือให้ความยินยอมในการปรับปรุงสถานที่จัดกิจกรรมของผู้สูงอายุ (หน่วยงาน)
      </div>
    </div>
    <div class="row">
      <div class="col col-xs-12  text-right">
        ทำที่<span class="_input _40 text-left"><?php echo $res->org?></span>
      </div>
      <div class="col col-xs-6 col-xs-offset-6">
        วันที่<span class="_input _20 text-center"><?php echo $res->date->day?></span>เดือน<span class="_input _20 text-center"><?php echo $res->date->month?></span>พ.ศ.<span class="_input _20 text-center"><?php echo $res->date->year?></span>
      </div>
    </div>
    <div class="row">
      <div style="text-indent: 30px">
        ข้าพเจ้า <span class="_input _inline"><?php echo makeText($res->staff->name."".$res->staff->surname,80)?></span> อายุ <span class="_input _inline"><?php echo makeText($res->age,20)?></span> ปี
      </div>
      <div>
      เลขที่บัตรประจำตัวราชการ/เลขที่บัตรประจำตัวประชาชน/เลขที่สุทธิพระภิกษุ  <span class="_input _inline"><?php echo makeText($res->staff->idcard,40)?></span>
      </div>
      <div>
        เป็นตัวแทนของ   <span class="_input _inline"><?php echo makeText($res->name."".$res->surname,120)?></span>
      </div>
      <div style="text-indent: 30px">ขอทำหนังสือฉบับนี้ไว้เพื่อเป็นหลักฐานแสดงว่า</div>
      <div style="text-indent: 30px">1. ข้าพเจ้าและคณะกรรมการและสมาชิกได้ทราบและเข้าใจวัตถุประสงค์ของการปรับปรุงอาคาร/ลานกิจกรรมสำหรับผู้สูงอายุตามโครงการฯ ของกรมกิจการผู้สูงอายุเป็นอย่างดี</div>
      <div style="text-indent: 30px">2. ข้าพเจ้าและคณะกรรมการและสมาชิกที่มีความประสงค์และยินยอมให้มีการปรับปรุง อาคาร/ลานกิจกรรมสำหรับผู้สูงอายุตามรายการและระยะเวลาที่คณะทำงานของโครงการกำหนดทุกประการ</div>
      <div style="text-indent: 30px">3. เพื่อให้การดำเนินการปรับปรุงอาคาร/ลานกิจกรรมสำหรับผู้สูงอายุนี้เป็นไปด้วยความเรียบร้อยด้วยดี ข้าพเจ้าและคณะกรรมการและสมาชิกหรือตัวแทนของข้าพเจ้า ชื่อ<span class="_input _inline"><?php echo makeText($res->delegate,60)?></span> จะอยู่ร่วมมือร่วมแรงและช่วยอำนวยความสะดวกทุกด้านอย่างเต็มกำลังความสามารถแก่คณะกรรมการ ตลอดระยะเวลาของการปรับปรุงอาคาร/ลานกิจกรรมสำหรับผู้สูงอายุนี้โดยไม่เรียกร้องค่าตอบแทนใดๆ ทั้งสิ้น</div>
      <div style="text-indent: 30px">4. ในกรณีที่มีเหตุผลสุดวิสัยหรือความเสียหายใดๆ เกิดขึ้นในระหว่างการปรับปรุงสถานที่จัดกิจกรรมแห่งนี้โดยที่ข้าพเจ้าหรือตัวแทนของข้าพเจ้าได้รับรู้ด้วยแล้ว ข้าพเจ้าและคณะกรรมการและสมาชิกจะไม่เรียกร้องค่าเสียหายและสิทธิใดๆ ทั้งสิ้นจากกรมพัฒนาสังคมและสวัสดิการแต่อย่างใด</div>
      <div style="text-indent: 30px">5. ข้าพเจ้ายินยอมให้ใช้ประโยชน์จากสถานที่ในการจัดกิจกรรมสำหรับกลุ่มผู้สูงอายุภายหลังจากการปรับปรุงแล้ว</div>
      <div style="text-indent: 30px">เพื่อเป็นหลักฐานในการนี้ ข้าพเจ้าจึงได้ลงลายมือชื่อไว้เป็นสำคัญต่อหน้าพยาน</div>
    </div>
    <div class="row" style="margin-top: 20px">
      <div class="col col-xs-6 col-xs-offset-6">
        <div>(ลงชื่อ) <span class="_input _50"><?php echo ''?></span> ผู้ให้ความยินยอม</div>
        <div style="padding-left: 30px">( <span class="_input _60">&nbsp;</span> )</div>
        <div>(ลงชื่อ)  <span class="_input _50"><?php echo $res->staff->name." ".$res->staff->surname?>&nbsp;</span> คณะกรรมการ</div>
        <div style="padding-left: 30px">( <span class="_input _60">&nbsp;</span>)</div>
        <div>(ลงชื่อ)  <span class="_input _50">&nbsp;</span> พยาน</div>
        <div style="padding-left: 30px">( <span class="_input _60">&nbsp;</span>)</div>
      </div>
    </div>
    <div class="row">
      <div>หมายเหตุ แนบเอกสารประกอบ ได้แก่ สำเนาบัตรประจำตัวประชาชน และสำเนาทะเบียนบ้านของเจ้าของสถานที่จัดกิจกรรม</div>
    </div>
  </div>
</div>
