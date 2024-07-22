<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/20/2017 AD
 * Time: 20:57
 */ ?>
<div class="page" size="A4" <?php echo (@$layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large" style="padding-top: 1cm!important;">
    <div class="row">
      <div class="col col-xs-12  text-right">
       <div>แบบ คปญ.1</div>
       <div style="border: 1px solid #000000;padding: 5px;display: inline-block">วัน/เดือน/ปีขึ้นทะเบียน <span class="_input 20"><?php echo $res->date?></span></div>
      </div>
    </div>
    <div class="row">
      <div class="col col-xs-9 caption text-right">
        แบบประวัติคลังปัญญาผู้สูงอายุ  จังหวัด <span class="_input _30 text-left"><?php echo $res->province ?></span>
      </div>
      <div class="col col-xs-3  text-right">
        <div style="padding:5px;margin: 10px;border: 1px solid #000000;width: 2.5cm;height:3cm;display: inline-block;overflow: hidden">
          <?php
          if($res->img){
            echo "<img style='width:100%' src='{$res->img}'>";
          }
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div>๑.
         (ชื่อ – สกุล) <span class="_input _40"><?php echo $res->name.' '.$res->surname ?></span></div>
      <div>๒. วัน/เดือน/ปีเกิด <span class="_input _40"><?php echo $res->birth ?></span> อายุ <span class="_input _20"><?php echo $res->age ?></span> ปี</div>
      <div>
        ๓. เลขประจำตัวประชาชน <?php $this->load->view('components/idcard',array('idcard'=>$res->idcard))?><br>
        &nbsp;&nbsp;&nbsp;&nbsp;วันที่ออกบัตร <span class="_input _30"><?php echo $res->idcard_date ?></span> วันที่บัตรหมดอายุ <span class="_input _30"><?php echo $res->idcard_exp ?></span><br>
        &nbsp;&nbsp;&nbsp;&nbsp;สถานที่ออกบัตร <span class="_input _40"><?php echo $res->idcard_addr ?></span>
      </div>
      <div>๔. เชื้อชาติ <span class="_input _20"><?php echo $res->nationality ?></span>
        &nbsp;&nbsp;&nbsp;&nbsp;สัญชาติ <span class="_input _20"><?php echo $res->citizenship ?></span>
        &nbsp;&nbsp;&nbsp;&nbsp;ศาสนา <span class="_input _30"><?php echo $res->religion ?></span>
      </div>
      <div>๕. โทรศัพท์ <span class="_input _20"><?php echo $res->phone ?></span>
        &nbsp;&nbsp;&nbsp;&nbsp;โทรสาร (ถ้ามี) <span class="_input _15"><?php echo $res->fax ?></span>
        &nbsp;&nbsp;&nbsp;&nbsp;โทรศัพท์มือถือ <span class="_input _20"><?php echo $res->mobile ?></span><br>
        &nbsp;&nbsp;&nbsp;&nbsp;e-mail <span class="_input _40"><?php echo $res->email ?></span>
      </div>
      <div>๖. ที่อยู่ตามทะเบียนบ้าน<br>

        &nbsp;&nbsp;&nbsp;&nbsp;บ้านเลขที่ <span class="_input _20"><?php echo $res->addr->no ?></span>
          หมู่ที่ <span class="_input _10"><?php echo $res->addr->moo ?> </span>
          ซอย <span class="_input _20"><?php echo $res->addr->lane ?> </span>
          ตำบล <span class="_input _20"><?php echo $res->addr->locality ?> </span><br>
        &nbsp;&nbsp;&nbsp;&nbsp;อำเภอ <span class="_input _30"><?php echo $res->addr->district ?> </span>
          จังหวัด <span class="_input _20"><?php echo $res->addr->province ?> </span>
          รหัสไปรษณีย์ <span class="_input _20"><?php echo $res->addr->postcode ?> </span>
      </div>
      <div>
        ๗. ที่อยู่ปัจจุบัน<br>
        &nbsp;&nbsp;&nbsp;&nbsp;บ้านเลขที่ <span class="_input _20"><?php echo $res->addr2->no ?></span>
        หมู่ที่ <span class="_input _10"><?php echo $res->addr2->moo ?> </span>
        ซอย <span class="_input _20"><?php echo $res->addr2->lane ?> </span>
        ตำบล <span class="_input _20"><?php echo $res->addr2->locality ?> </span><br>
        &nbsp;&nbsp;&nbsp;&nbsp;อำเภอ <span class="_input _30"><?php echo $res->addr2->district ?> </span>
        จังหวัด <span class="_input _20"><?php echo $res->addr2->province ?> </span>
        รหัสไปรษณีย์ <span class="_input _20"><?php echo $res->addr2->postcode ?> </span>
      </div>
      <div>
        <div class="row">
          <div class="col-xs-2">๘. สถานภาพ</div>
          <div class="col-xs-10">
            <div class="_30 _inline-blog"><div class="checkbox <?php echo ($res->status=='โสด')?"checked":"";?>"></div> โสด</div>
            <div class="_30 _inline-blog"><div class="checkbox <?php echo ($res->status=='สมรส อยู่ด้วยกัน')?"checked":"";?>"></div> สมรสอยู่ด้วยกัน</div>
            <div class="_30 _inline-blog"><div class="checkbox <?php echo ($res->status=='สมรส แยกกันอยู่')?"checked":"";?>"></div> สมรสแยกกันอยู่</div>
            <div class="_30 _inline-blog"><div class="checkbox <?php echo ($res->status=='หย่าร้าง')?"checked":"";?>"></div> หม้าย / แยกกันอยู่</div>
            <div class="_30 _inline-blog"><div class="checkbox <?php echo ($res->status=='หม้าย (คู่สมรสเสียชีวิต)')?"checked":"";?>"></div> หม้ายคู่สมรสเสียชีวิต</div>
            <div class="_30 _inline-blog"><div class="checkbox <?php echo ($res->status=='ไม่ได้สมรส แต่อยู่ด้วยกัน')?"checked":"";?>"></div> อยู่ด้วยกันโดยไม่สมรส</div>
<!--            <div class="_70 _inline-blog"><div class="checkbox --><?php //echo ($res->status=='7')?"checked":"";?><!--"></div> อื่น ๆ <span class="_input _20">--><?php //echo $res->status_other ?><!-- </span></div>-->
          </div>
        </div>
      </div>
      <div>
        <div class="row">
          <div class="col-xs-2">๙. การศึกษา</div>
          <div class="col-xs-10">
            <?php
            foreach ($res->edu as $edu){

              ?>
              <div class="_30 _inline-blog">
                <div class="checkbox <?php echo ($edu->check)?"checked":"";?>"></div>
                  <?php echo $edu->title?>
                 <?php if($edu->remark){ ?>
                  <span class="_input _20"><?php echo $edu->remark ?> </span>
                  <?php }?>
              </div>
                <?php
            }
            ?>
           </div>
        </div>
      </div>
      <div>๑๐. อาชีพปัจจุบัน <span class="_input _20"><?php echo $res->job ?> </span> รายละเอียด (ถ้ามี) <span class="_input _inline"><?php echo makeText( $res->job_desc,60) ?> </span></div>
      <div>๑๑. อาชีพเดิม <span class="_input _20"><?php echo $res->job_old ?> </span> รายละเอียด (ถ้ามี) <span class="_input _inline"><?php echo makeText($res->job_old_desc,60) ?> </span></div>
    </div>
  </div>
</div>
<p class="page-break"></p>
<div class="page" size="A4" <?php echo (@$layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large" style="padding-top: 1cm!important;">
    <div class="row">
      <div>๑๒. ท่านเป็นภูมิปัญญาในสาขา (ตอบได้มากกว่า 1 ข้อ)</div>
      <div class="left-padding">๑ โปรดการ <div class="checked"></div> ใน <div class="checkbox"></div> ที่ท่านเป็นภูมิปัญญา</div>
      <div class="left-padding">๒ โปรดระบุเรื่องที่ท่านเชี่ยวชาญ <span class="_input _20">&nbsp</span></div>
      <div>
        <?php foreach ($res->experts as$index=> $expert){?>
        <div class="_40 _inline-blog">
          <?php
          $checked=($expert->check)?"checked":"";
          if(@$expert->other=="1"){
              echo "<div>  <div class='checkbox {$checked}'></div> ".($index+1).". {$expert->title} <span class='_inline _input'>".makeText($expert->desc,30) ."</span></div>";
          }
          else{
              echo "<div> <div class='checkbox {$checked}'></div> ".($index+1).". {$expert->title}</div>";
              echo "<div class='left-padding' style='line-height:25px'>เชี่ยวชาญเรื่อง<span class='_inline _input'>".makeText($expert->desc,30) ."</span></div>";
          }
          ?>
        </div>
        <?php } ?>
        <div style="margin-top: 10px">(ทั้งนี้ขอให้ถ่ายรูปผู้เป็นภูมิปัญญา และภาพกิจกรรมเป็น file jpec. เพื่อบันทึกในระบบฐานข้อมูล</div>
      </div>
    </div>
  </div>
</div>
