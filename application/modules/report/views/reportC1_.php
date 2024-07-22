<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/18/2017 AD
 * Time: 22:49
 */ ?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body small">
    <div class="row">
      <div class="col col-xs-4"></div>
      <div class="col col-xs-4 text-center">
        <div class="logo-krut-small"></div>
      </div>
      <div class="col col-xs-4 text-right"><span class="label-code">แบบ ศผศ.01</span></div>
    </div>
    <div class="row">
      <div class="col col-xs-12 caption text-center">
        แบบคำขอรับเงินสงเคราะห์ และรับรองผู้รับผิดชอบในการจัดการศพผู้สูงอายุตามประเพณี
      </div>
    </div>
    <div class="row">
      <div class="text-right">เขียนที่<span class="_input _20 text-left"><?php echo $res->org ?></span></div>
      <div class="text-right">
        วัน<span class="_input _5 text-center"><?php echo $res->date->day ?></span>
        เดือน<span class="_input _10 text-center"><?php echo $res->date->month ?></span>
        พ.ศ.<span class="_input _10 text-center"><?php echo $res->date->year ?></span>
      </div>
    </div>
    <div class="row">
      <div><strong>ส่วนที่ 1 : สำหรับผู้ยื่นขอรับเงินสงเคราะห์ค่าจัดการศพผู้สูงอายุตามประเพณี</strong></div>
      <div style="text-indent: 20px">ข้าพเจ้า <span class="_input _50 "><?php echo "{$res->prename}{$res->name} {$res->surname}" ?></span>
        อายุ<span class="_input _15 "><?php echo $res->age ?></span> ปี
      </div>
      <div>
        เลขบัตรประจำตัวประชาชน<span class="_input _20 "><?php echo $res->idcard ?></span>
        ออกให้โดย<span class="_input _20 "><?php echo $res->idcard_by ?></span>
        วันออกบัตร<span class="_input _15 "><?php echo $res->idcard_date ?></span></div>
      <div>
        วันหมดอายุ<span class="_input _15 "><?php echo  $res->idcard_exp ?></span>
        อาชีพ<span class="_input _20"><?php echo $res->job ?></span>
        อยู่บ้านเลขที่<span class="_input _5"><?php echo $res->addr->no ?></span>
        หมู่ที่<span class="_input _5 "><?php echo $res->addr->moo ?></span>
        ตรอก/ซอย<span class="_input _10 "><?php echo $res->addr->lane ?></span>
      </div>
      <div>
        ถนน<span class="_input _10 "><?php echo $res->addr->street ?></span>
        ตำบล/แขวง<span class="_input _20"><?php echo $res->addr->locality ?></span>
        อำเภอ/เขต<span class="_input _20"><?php echo $res->addr->district ?></span>
        จังหวัด<span class="_input _20"><?php echo $res->addr->province ?></span>
      </div>
      <div>
        รหัสไปรษณีย์<span class="_input _20"><?php echo $res->addr->postcode ?></span>
        โทรศัพท์<span class="_input _20"><?php echo $res->phone ?></span>
        โทรศัพท์มือถือ<span class="_input _20"><?php echo $res->mobile ?></span>
      </div>
    </div>
    <div class="row">
      <div style="text-indent: 20px">
        มีความเกี่ยวข้องกับผู้สูงอายุที่ตายในฐานะเป็น<span class="_input _20"><?php echo $res->relation ?></span>และเป็นผู้รับผิดชอบในการจัดการศพผู้สูงอายุ<br>
        โดยได้รับความยินยอมจากบิดา/มารดา/บุตร/พี่น้อง/เครือญาติ/ของผู้สูงอายุที่ตายให้เป็นผู้รับเงินสงเคราะห์ค่าจัดการศพ<br>ของผู้สูงอายุทีตาย
        ชื่อ<span class="_input _40"><?php echo "{$res->dead->prename}{$res->dead->name} {$res->dead->surname}" ?></span>อายุ<span class="_input _10"><?php echo $res->age ?></span>ปี
      </div>
      <div>
        เลขบัตรประจำตัวประชาชน<span class="_input _20"><?php echo $res->dead->idcard ?></span>
        ออกให้โดย<span class="_input _20"><?php echo $res->dead->idcard_by ?></span>
        วันออกบัตร<span class="_input _15"><?php echo $res->dead->idcard_date ?></span>
      </div>
      <div>
        วันหมดอายุ<span class="_input _10"><?php echo $res->dead->idcard_exp ?></span>
        อาศัยอยู่บ้านเลขที่<span class="_input _5"><?php echo $res->dead->addr->no ?></span>
        หมู่ที่<span class="_input _5"><?php echo $res->dead->addr->moo ?></span>
        ตรอก/ซอย<span class="_input _20"><?php echo $res->dead->addr->lane ?></span>
        ถนน<span class="_input _10"><?php echo $res->dead->addr->street ?></span>
      </div>
      <div>
        ตำบล/แขวง<span class="_input _15"><?php echo $res->dead->addr->locality ?></span>
        อำเภอ/เขต<span class="_input _15"><?php echo $res->dead->addr->district ?></span>
        จังหวัด<span class="_input _15"><?php echo $res->dead->addr->province ?></span>
        รหัสไปรษณีย์<span class="_input _15"><?php echo $res->dead->addr->postcode ?></span>
      </div>
      <div>
        โทรศัพท์<span class="_input _30"><?php  echo $res->dead->phone ?></span>
        โทรศัพท์มือถือ<span class="_input _30"><?php  echo $res->dead->mobile ?></span>
      </div>
      <div>
        ถึงแก่กรรมด้วยสาเหตุ<span class="_input _30"><?php echo $res->dead->desc ?></span>
        เมื่อวันที่<span class="_input _10"><?php echo $res->dead->day ?></span>
        เดือน<span class="_input _10"><?php echo $res->dead->month ?></span>
        พ.ศ.<span class="_input _10"><?php echo $res->dead->year ?></span>
      </div>
      <div>
        ตามใบมรณบัตรเลขที่<span class="_input _10"><?php echo $res->dead->doc_no ?></span>
        ออกให้โดย<span class="_input _10"><?php echo $res->dead->doc_by ?></span>
        เมื่อวันที่<span class="_input _10"><?php echo $res->dead->doc_day ?></span>
        เดือน<span class="_input _10"><?php echo $res->dead->doc_month ?></span>
        พ.ศ.<span class="_input _10"><?php echo $res->dead->doc_year ?></span>
      </div>
      <div style="text-indent: 20px">ข้าพเจ้าขอรับรองว่าข้อความและเอกสารที่ได้ยื่นนี้เป็นความจริงทุกประการ
          และข้าพเจ้าไม่เคยได้รับเงินสงเคราะห์ในการ จัดการศพผู้สูงอายุรายนี้มาก่อน
          หากข้อความและเอกสารที่ยื่นเรื่องนี้เป็นเท็จ ข้าพเจ้ายินยอมให้ดำเนินการตามกฎหมาย</div>
      <div class="col col-xs-5 col-xs-offset-7 text-center">
        <div style="line-height: 22px">
          <div>(ลงชื่อ)<span class="_input _50"><?php echo "{$res->name} {$res->surname}" ?></span>ผู้ยื่นคำขอ</div>
          <div>(<span class="_input _60">&nbsp</span>)</div>
          <div>วันที่ <span class="_input _50"><?php echo "{$res->date->day}/{$res->date->month}/{$res->date->year}" ?></span></div>
        </div>

      </div>
    </div>
    <div class="row">
      <hr style="border-top: 1px dashed #8c8b8b;margin: 3px">
    </div>
    <div class="row">
      <div><strong>ส่วนที่ 2 ข้อมูลผู้ให้การรับรองผู้รับผิดชอบในการจัดการศพผู้สูงอายุตามประเพณี</strong></div>
    </div>
    <div class="row">
      <div class="text-right"><span class="">เขียนที่<span
                class="_input _20 text-left"><?php echo $res->org ?></span></span></div>
      <div class="text-right">
        วัน<span class="_input _5 text-center"><?php echo $res->date->day ?></span>
        เดือน<span class="_input _10 text-center"><?php echo $res->date->month ?></span>
        พ.ศ.<span class="_input _10 text-center"><?php echo $res->date->year ?></span>
      </div>
    </div>
    <div class="row">
      <div>ข้าพเจ้า  <span class="_input _30"><?php echo "{$res->aprv->prename}{$res->aprv->name} {$res->aprv->surname}" ?></span>ตำแหน่ง<span class="_input _30"><?php echo $res->aprv->position ?></span></div>
      <div>
        สังกัดหน่วยงาน<span class="_input _30"><?php echo $res->aprv->org ?></span>
        เลขบัตรประจำตัวประชาชน<span class="_input _30"><?php echo $res->aprv->idcard ?></span>
      </div>
      <div>
        ออกให้โดย<span class="_input _20"><?php echo $res->aprv->idcard_by ?></span>
        วันออกบัตร<span class="_input _20"><?php echo $res->aprv->idcard_date ?></span>
        วันหมดอายุ<span class="_input _20"><?php echo $res->aprv->idcard_exp ?></span>
      </div>
      <div>
        อยู่บ้านเลขที่<span class="_input _10"><?php echo $res->aprv->addr->no ?></span>
        หมู่ที่<span class="_input _10"><?php echo $res->aprv->addr->moo ?></span>
        ตรอก/ซอย<span class="_input _20"><?php echo $res->aprv->addr->lane ?></span>
        ถนน<span class="_input _15"><?php echo $res->aprv->addr->street?></span>
      </div>
      <div>
        ตำบล/แขวง<span class="_input _15"><?php echo $res->aprv->addr->locality ?></span>
        อำเภอ/เขต<span class="_input _15"><?php echo $res->aprv->addr->district ?></span>
        จังหวัด<span class="_input _15"><?php echo $res->aprv->addr->province ?></span>
        รหัสไปรษณีย์<span class="_input _15"><?php echo $res->aprv->addr->postcode ?></span>
      </div>
      <div>
        โทรศัพท์<span class="_input _30"><?php echo $res->aprv->phone ?></span>
        โทรศัพท์มือถือ<span class="_input _30"><?php echo $res->aprv->mobile ?></span>
      </div>
      <div>ขอรับรองว่าผู้ยื่นคำขอดังกล่าวเป็นผู้รับผิดชอบในการจัดการศพผู้สูงอายุรายนี้จริง</div>
      <div class="col col-xs-5 col-xs-offset-7 text-center">
        <div style="line-height: 22px">
        <div>(ลงชื่อ)<span class="_input _50"><?php echo "{$res->aprv->name} {$res->aprv->surname}" ?></span>ผู้รับรอง</div>
        <div>(<span class="_input _60">&nbsp</span>)</div>
        <div>ตำแหน่ง<span class="_input _60"><?php echo $res->aprv->position ?></span></div>
        <div>วันที่ <span class="_input _50"><?php echo "{$res->date->day}/{$res->date->month}/{$res->date->year}"?></span></div>
      </div>
      </div>
    </div>

  </div>

</div>
