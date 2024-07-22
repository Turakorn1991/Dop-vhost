<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 16:17
 */ ?>
<div class="page" size="A4" <?php echo (@$layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large">
    <div class="row">
      <div class="col col-xs-12 caption text-center">
        แบบสอบถามความต้องการของผู้สูงอายุในการปรับปรุงบ้านของผู้สูงอายุ
      </div>
    </div>
    <div class="row">
      <div>1. ชื่อ <span class="_input _30"><?php echo $res->prename.$res->name?></span>นามสกุล<span class="_input _30"><?php echo $res->surname?></span></div>
      <div style="padding-left: 20px">
        อายุ<span class="_input _10"><?php echo $res->age?></span>ปี
        อาชีพ<span class="_input _20"><?php echo $res->job?></span>
        รายได้<span class="_input _10"><?php echo $res->salary?></span>บาทต่อเดือน/ปี</div>
      <div>
        2. ที่อยู่ปัจจุบัน บ้านเลขที่<span class="_input _10"><?php echo $res->addr->no?></span></span>
        หมู่ที่<span class="_input _10"><?php echo $res->addr->moo?></span>
        ตำบล<span class="_input _20"><?php echo $res->addr->locality?></span>
        อำเภอ<span class="_input _20"><?php echo $res->addr->district?></span>
      </div>
      <div style="padding-left: 20px">
        จังหวัด<span class="_input _20"><?php echo $res->addr->province?></span>
        โทรศัพท์<span class="_input _20"><?php echo $res->addr->phone?></span>
      </div>
      <div>3.เลขบัตรประจำตัวประชาชน/เลขที่บัตรผู้สูงอายุ<span class="_input _30"><?php echo $res->idcard?></span></div>
      <div>4. สมาชิกในครอบครัว ประกอบด้วย</div>
      <div>
        <table class="table table-bordered table-normal" width="100%">
          <thead>
          <tr>
            <th style="width: 5%">ที่</th>
            <th style="width: 23%">ชื่อ – สกุล</th>
            <th style="width: 10%">อายุ</th>
            <th style="width: 15%">อาชีพ</th>
            <th style="width: 10%">การศึกษา</th>
            <th style="width: 10%">สุขภาพ</th>
            <th style="width: 17%">รายได้(บาท/เดือน)</th>
            <th style="width: 10%">หมายเหตุ</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach($res->familys as $family) {?>
          <tr>
            <td class="text-center"><?php echo $family->no?></td>
            <td><?php echo $family->name?></td>
            <td class="text-center"><?php echo $family->age?></td>
            <td><?php echo $family->job?></td>
            <td><?php echo $family->educate?></td>
            <td><?php echo $family->health?></td>
            <td><?php echo $family->income?></td>
            <td><?php echo $family->comment?></td>
          </tr>
          <?php }?>
          </tbody>
        </table>
      </div>
      <div>
        5. ลักษณะที่อยู่อาศัย
        <div class="checkbox <?php echo ($res->addr->type=='เจ้าของบ้าน')?"checked":"";?>"></div> ของตนเอง
        <div class="checkbox <?php echo ($res->addr->type=='สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน')?"checked":"";?>"></div> อาศัยผู้อื่นอยู่
        ระบุ <span class="_input _20"><?php echo $res->addr->other?></span>
      </div>
      <div>สภาพบ้านที่ต้องการปรับปรุง</div>
      <div class="left-padding">
        <?php
        foreach ($res->conditions as $condition){
          ?>
          <div class="checkbox <?php echo ($condition->check==1)?"checked":"";?>"></div> <?php echo $condition->title ?> <?php echo ($condition->remark)?"<span class=\"_input _inline\">{$condition->remark}</span>":"" ?><br>

            <?php
        }
        ?>

      </div>
      <div>6. ลักษณะการครอบครองที่ดิน
        <div class="checkbox <?php echo ($res->land_own=='ที่ดินของตนเอง')?"checked":"";?>"></div> ที่ดินของตนเอง
        <div class="checkbox <?php echo ($res->land_own=='ที่ดินเช่า')?"checked":"";?>"></div> ที่ดินเช่าจาก (ระบุ)<span class="_input _20"><?php echo $res->land?></span></div>
      <div>7. ความคิดเห็นเจ้าหน้าที่</div>
      <div class="left-padding">
        <div class="checkbox <?php echo ($res->comment_type=='เห็นควรให้ความช่วยเหลือ')?"checked":"";?>"></div> เห็นควรให้ความช่วยเหลือ<span class="_input _20"><?php echo $res->comment_type1?></span><br>
        <div class="checkbox <?php echo ($res->comment_type=='เห็นควรให้ความช่วยเหลืออย่างเร่งด่วน')?"checked":"";?>"></div> เห็นควรให้ความช่วยเหลืออย่างด่วน<span class="_input _20"><?php echo $res->comment_type2?></span>
      </div>
    </div>
    <div class="row " style="margin-top:40px;">
      <div class="col col-xs-6 col-xs-offset-6 text-right">
        <table style="width: 100%">
          <tr><td class="text-right" style="width: 40%">ลงชื่อผู้สอบข้อเท็จจริง</td><td class="text-center"><span class="_input _100"><?php echo $res->staff->name." ".$res->staff->surname?></span></td></tr>
          <tr><td></td><td  class="text-center">(<span class="_input _90"></span>)</td></tr>
          <tr><td class="text-right">ตำแหน่ง</td><td  class="text-center"><span class="_input _100"><?php echo $res->staff->position?></span></td></tr>
          <tr><td></td><td  class="text-center"><span class="_input _100"><?php echo $res->date?></span></td></tr>
        </table>
      </div>
    </div>
  </div>
</div>
