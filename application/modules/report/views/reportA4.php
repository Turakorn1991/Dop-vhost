<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/18/2017 AD
 * Time: 08:41
 */ ?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large">


    <div class="row">
      <div class="col col-xs-12 text-right"><span class="label-code">แบบ สคส.03</span></div>
    </div>
    <div class="row">
      <div class="col col-xs-12 caption text-center">
        แบบประเมินผลการให้บริการตามประกาศตามกระทรวงการพัฒนาสังคม
          และความมั่นคงของมนุษย์ (8) (9) (10)
      </div>
    </div>
    <div class="row">
      <div class="text-right"><span class="">เขียนที่<span
                class="_input _20 text-left"><?php echo $res->org ?></span></span></div>
      <div><span class="">
          วันที่กรอกแบบสอบถาม<span class="_input _15 text-center"><?php echo $res->date->day?></span>
          เดือน<span class="_input _25 text-center"><?php echo $res->date->month?></span>
          พ.ศ. <span class="_input _15 text-center"><?php echo $res->date->year?></span></div>
    </div>
    <div class="row">
      <div class="col col-xs-12 section">
        <div>1. ชื่อผู้สูงอายุ

          <span class="_input _70"><?php echo $res->prename.$res->name." ".$res->surname?></span></div>
        <div>2. ที่อยู่บ้านเลขที่<span class="_input _10"><?php echo $res->addr->no ?></span>
          หมู่<span class="_input _10"><?php echo $res->addr->moo ?></span>
          ตรอก/ซอย<span class="_input _20"><?php echo $res->addr->side_street ?></span>
          ตำบล/แขวง<span class="_input _20"><?php echo $res->addr->locality ?></span>
        </div>
        <div>อำเภอ/เขต<span class="_input _20"><?php echo $res->addr->district ?></span>
          จังหวัด<span class="_input _20"><?php echo $res->addr->province ?></span>
          โทรศัพท์<span class="_input _20"><?php echo $res->phone ?></span>
        </div>
        <div>3. อาชีพ</div>
        <div class="left-padding">
          <div class="row">
            <div class="col-xs-3"><div class="checkbox <?php echo ($res->job == 'ค้าขาย') ? "checked" : ""; ?>"></div>
              ค้าขาย</div>
            <div class="col-xs-3"> <div class="checkbox <?php echo ($res->job == 'รับจ้าง') ? "checked" : ""; ?>"></div>
              รับจ้าง</div>
            <div class="col-xs-3"> <div class="checkbox <?php echo ($res->job == 'แม่บ้าน') ? "checked" : ""; ?>"></div>
              แม่บ้าน</div>
            <div class="col-xs-3"> <div class="checkbox <?php echo ($res->job == 'เกษตรกรรม') ? "checked" : ""; ?>"></div>
              เกษตรกรรม<br></div>
          </div>
          <div class="row">
            <div class="col-xs-3">
              <div class="checkbox <?php echo ($res->job == 'ไม่ได้ทำงาน') ? "checked" : ""; ?>"></div>
              ไม่ได้ทำงาน
            </div>
            <div class="col-xs-9">
              <div class="checkbox <?php echo ($res->job == 'อื่นๆ') ? "checked" : ""; ?>"></div>
              อื่นๆ (ระบุ)
              <span class="_input _70"><?php echo $res->job_other?></span>
            </div>
          </div>
        </div>
        <div>4. รายได้ <span class="_input _40"> <?php echo $res->money?></span>บาท/เดือน</div>
        <div>5. ท่านเคยได้รับเงินสงเคราะห์ผู้สูงอายุจากหน่วยงานใดบ้าง (ตอบตามความเป็นจริง)</div>
        <div class="left-padding">
          <div><div class="checkbox <?php echo ($res->recived == 1) ? "checked" : ""; ?>"></div> เคย ชื่อหน่วยงาน <span class="_input _40"><?php echo $res->recived_org?></span></div>
          <div><div class="checkbox <?php echo ($res->recived == 2) ? "checked" : ""; ?>"></div> ไม่เคย</div>
        </div>
        <div>6. หลังเข้ารับบริการเงินสงเคราะห์ผู้สูงอายุ ท่านได้รับความพึงพอใจมากน้อยเพียงได</div>
        <div class="left-padding">
          <div>
            <div class="row">
              <div class="col-xs-3"><div class="checkbox <?php echo ($res->like == 3) ? "checked" : ""; ?>"></div>
                มาก</div>
              <div class="col-xs-3"> <div class="checkbox <?php echo ($res->like == 2) ? "checked" : ""; ?>"></div>
                ปานกลาง</div>
              <div class="col-xs-3"> <div class="checkbox <?php echo ($res->like == 1) ? "checked" : ""; ?>"></div>
                น้อย</div>
            </div>
          </div>
        </div>
        <div>7. ท่านมีความไม่พึงพอใจในเรื่องใด</div>
        <div class="left-padding">
          <div><div class="checkbox <?php echo ($res->notlike == 1) ? "checked" : ""; ?>"></div> วงเงินให้การช่วยเหลือ อย่างไร (โปรดระบุ) <span class="_input _50"><?php echo $res->notlike_desc[0]?></span></div>
          <div><div class="checkbox <?php echo ($res->notlike == 2) ? "checked" : ""; ?>"></div> กระบวนการ/ขั้นตอนการให้บริการ อย่างไร (โปรดระบุ) <span class="_input _40"><?php echo $res->notlike_desc[1]?></span></div>
          <div><div class="checkbox <?php echo ($res->notlike == 3) ? "checked" : ""; ?>"></div> เจ้าหน้าที่หรือบุคลากรที่ให้บริการ อย่างไร (โปรดระบุ) <span class="_input _40"><?php echo $res->notlike_desc[2]?></span></div>
          <div><div class="checkbox <?php echo ($res->notlike == 4) ? "checked" : ""; ?>"></div> ด้านคุณภาพการให้บริการ อย่างไร (โปรดระบุ) <span class="_input _50"><?php echo $res->notlike_desc[3]?></span></div>
        </div>
        <div>8. ข้อเสนอแนะ<span class="_input _inline"><?php echo makeText($res->comment,450) ?></span></div>
      </div>
    </div>
    <div class="row">
      <div class="col col-xs-12 section">
        <div class="text-center">.....ขอบคุณที่ให้ความร่วมมือค่ะ.....</div>
      </div>
    </div>
  </div>
</div>
