<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 16:17
 */?>
<div class="page" size="A4" <?php echo (@$layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large">
    <div class="row">
      <div class="col col-xs-12  caption text-center">
        หนังสือให้ความยินยอมในการปรับปรุงบ้านพักอาศัยของผู้สูงอายุ
      </div>
    </div>
    <div class="row">
      <div class="col col-xs-12  text-right">
        ทำที่<span class="_input _40 text-left"><?php echo $res->org_title?></span>
      </div>
      <div class="col col-xs-6 col-xs-offset-6">
        วันที่<span class="_input _20 text-center"><?php echo $res->date->day?></span>เดือน<span class="_input _20 text-center"><?php echo $res->date->month?></span>พ.ศ.<span class="_input _20 text-center"><?php echo $res->date->year?></span>
      </div>
    </div>
    <div class="row">
      <div style="text-indent: 30px">
        ข้าพเจ้า <span class="_input _inline"><?php echo makeText($res->name." ".$res->surname,60)?></span>
        อายุ <span class="_input _inline"><?php echo makeText($res->age,20)?></span> ปี เป็น
        <div class="checkbox <?php echo ($res->owner=='เจ้าของบ้าน')?"checked":"";?>"></div> เจ้าของบ้านหรือ
        <div class="checkbox <?php echo ($res->owner=='สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน')?"checked":"";?>"></div>
        สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้านพักอาศัยเลขที่<span class="_input _inline"><?php echo makeText($res->addr->no,15)?></span>
        ตรอก/ซอย<span class="_input _inline"><?php echo makeText($res->addr->side_street,25)?></span>
        <br>ถนน<span class="_input _inline"><?php echo makeText($res->addr->street,25)?></span>
        ตำบล/แขวง<span class="_input _inline"><?php echo makeText($res->addr->locality,50)?></span>
        อำเภอ/เขต<span class="_input _inline"><?php echo makeText($res->addr->district,50)?></span>
        จังหวัด<span class="_input _inline"><?php echo makeText($res->addr->province,50)?></span>
        ซึ่งเกี่ยวพันเป็น
         <span class="_input _inline"><?php echo makeText($res->relation,25)?></span>
        ของผู้สูงอายุ ชื่อ <span class="_input _inline"><?php echo makeText($res->oldman,50)?> </span>
      </div>
      <div style="text-indent: 30px">ขอทำหนังสือฉบับนี้ไว้เพื่อเป็นหลักฐานแสดงว่า</div>
      <div style="text-indent: 30px">1. ข้าพเจ้าและผู้เกี่ยวข้อง ได้ทราบและเข้าใจวัตถุประสงค์ของการปรับปรุงบ้านพักอาศัยให้แก่ผู้สูงอายุตามโครงการฯ ของกรมกิจการผู้สูงอายุเป็นอย่างดี</div>
      <div style="text-indent: 30px">2. ข้าพเจ้าและผู้เกี่ยวข้องที่มีความประสงค์และยินยอมให้มีการปรับปรุงบ้านพักอาศัยหลังนี้ตามรายการและระยะเวลาที่คณะทำงานของโครงการกำหนดทุกประการ</div>
      <div style="text-indent: 30px">3. เพื่อให้การดำเนินการปรับปรุงบ้านพักอาศัยหลังนี้เป็นไปด้วยความเรียบร้อยด้วยดี ข้าพเจ้าและผู้เกี่ยวข้องหรือตัวแทนของข้าพเจ้าชื่อ <span class="_input _inline"><?php echo makeText($res->delegate,60)?></span> จะอยู่ร่วมมือร่วมแรงและช่วยอำนวยความสะดวกทุกด้านอย่างเต็มกำลังความสามารถแก่คณะทำงานฯ ตลอดเวลาของการปรับปรุงบ้านพักอาศัยหลังนี้โดยไม่เรียกร้องค่าตอบแทนใดๆ ทั้งสิ้น</div>
      <div style="text-indent: 30px">4. ในกรณีที่มีเหตุสุดวิสัยหรือความเสียหายใดๆ เกิดขึ้นในระหว่างการปรับปรุงบ้านพักอาศัยหลังนี้โดยที่ข้าพเจ้าหรือตัวแทนของข้าพเจ้าได้รับรู้ด้วยแล้ว ข้าพเจ้าและผู้เกี่ยวข้องจะไม่เรียกร้องค่าเสียหายและสิทธิใดๆ ทั้งสิ้นจากกรมกิจการผู้สูงอายุแต่อย่างใด</div>
      <div style="text-indent: 30px">เพื่อเป็นหลักฐานในการนี้ ข้าพเจ้าจึงได้ลงลายมือชื่อไว้เป็นสำคัญต่อหน้าพยาน</div>
    </div>
    <div class="row">
      <div class="col col-xs-6 col-xs-offset-6">
        <div>(ลงชื่อ)  <span class="_input _50">&nbsp;</span> ผู้ให้ความยินยอม</div>
        <div style="padding-left: 30px">( <span class="_input _60"><?php echo $res->name." ".$res->surname?></span> )</div>
        <div>(ลงชื่อ)  <span class="_input _50">&nbsp;</span> พยาน</div>
        <div style="padding-left: 30px">( <span class="_input _60">&nbsp;</span>)</div>
        <div>(ลงชื่อ)  <span class="_input _50">&nbsp;</span> พยาน</div>
        <div style="padding-left: 30px">( <span class="_input _60">&nbsp;</span>)</div>
      </div>
    </div>
    <div class="row">
      <div>หมายเหตุ แนบเอกสารประกอบ ได้แก่ สำเนาบัตรประจำตัวประชาชน และสำเนาทะเบียนบ้านของเจ้าของบ้านพักอาศัยและผู้สูงอายุในครอบครัว</div>
    </div>
  </div>
</div>
