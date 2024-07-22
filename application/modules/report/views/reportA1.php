<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/15/2017 AD
 * Time: 19:18
 */
?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body">
    <div class="row">
      <div class="col col-xs-3 text-left">
        <div>
          <div class="checkbox <?php echo ($res->no=='1')?"checked":""?>"></div>
          ครั้งที่ 1 ปี <span class="_input _25"><?php echo ($res->no=='1')?"$res->year":""?>&nbsp;</span>
        </div>
        <div>
          <div class="checkbox <?php echo ($res->no=='2')?"checked":""?>"></div>
          ครั้งที่ 2 ปี <span class="_input _25"><?php echo ($res->no=='2')?"$res->year":""?>&nbsp;</span>
        </div>
        <div>
          <div class="checkbox <?php echo ($res->no=='3')?"checked":""?>"></div>
          ครั้งที่ 3 ปี <span class="_input _25"><?php echo ($res->no=='3')?"$res->year":""?>&nbsp;</span>
        </div>
      </div>
      <div class="col col-xs-6 text-center">
        <div class="logo-dop"></div>
      </div>
      <div class="col col-xs-3 text-right"><span class="label-code">แบบ สคส.01</span></div>
    </div>
    <div class="row">
      <div class="col col-xs-12 caption text-center">
        แบบขอรับบริการผู้ประสบปัญหาตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์
        มาตรา 11 (8) (9) (10)
      </div>
    </div>
    <div class="row">
      <div class="text-right"><span class="label-box">วันที่แจ้งเรื่อง<span class="_input _20"><?php echo $res->inform_date ?>&nbsp;</span></span>
      </div>
      <div class="box-line">ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง)</div>
    </div>
    <div class="row">
      <div class="col col-xs-12 section">
        <div>คำนำหน้าชื่อ
          <span class="_input _15"><?php echo $res->prename ?>&nbsp;</span>
          ชื่อ<span class="_input _30"><?php echo $res->name ?>&nbsp;</span>นามสกุล<span class="_input _30"><?php echo $res->surname ?>&nbsp;</span>
        </div>
        <div>เลขที่บัตรประชาชน
            <?php $this->load->view('components/idcard',array('idcard'=>$res->idcard))?>
        </div>
        <div>
          ตำแหน่ง<span class="_input _40"><?php echo $res->position ?>&nbsp;</span>หน่วยงาน<span class="_input _40"><?php echo $res->org ?>&nbsp;</span>
        </div>
        <div>
          บ้านเลขที่ <span class="_input _10"><?php echo $res->addr->no ?>&nbsp;</span>
          หมู่ที่<span class="_input _15"><?php echo $res->addr->moo ?>&nbsp;</span>
          ตรอก<span class="_input _15"><?php echo $res->addr->lane ?>&nbsp;</span>
          ซอย<span class="_input _15"><?php echo $res->addr->side_street ?>&nbsp;</span>
          ถนน<span class="_input _15"><?php echo $res->addr->street ?>&nbsp;</span>
        </div>
        <div>ตำบล/แขวง<span class="_input _15"><?php echo $res->addr->locality ?>&nbsp;</span>
          อำเภอ/เขต<span class="_input _15"><?php echo $res->addr->district ?>&nbsp;</span>
          จังหวัด<span class="_input _15"><?php echo $res->addr->province ?>&nbsp;</span>
          รหัสไปรษณีย์<span class="_input _10"><?php echo $res->addr->postcode ?>&nbsp;</span>
        </div>
        <div>
          เบอร์โทรศัพท์ (ที่ติดต่อได้)<span class="_input _20"><?php echo $res->phone ?>&nbsp;</span>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="text-right"><span
              class="label-box">ตรวจเยี่ยมบ้านวันที่<span class="_input _20"><?php echo $res->survey_date ?>&nbsp;</span></span>
      </div>
      <div class="box-line">ประวัติผู้สูงอายุที่ขอรับบริการ</div>
    </div>
    <div class="row">
      <div class="col col-xs-12 section">
        <div>คำนำหน้าชื่อ  <span class="_input _15"><?php echo $res->req->prename ?>&nbsp;</span>
          ชื่อ<span class="_input _30"><?php echo $res->req->name ?>&nbsp;</span>นามสกุล<span class="_input _30"><?php echo $res->req->surname ?>&nbsp;</span>
        </div>
        <div>เลขที่บัตรประชาชน
          <?php $this->load->view('components/idcard',array('idcard'=>$res->req->idcard))?>
          กรณีไม่มีเนื่องจาก<span class="_input _25"><?php echo $res->req->idcard_ext ?>&nbsp;</span>
        </div>
        <div>วัน/เดือน/ปีเกิด<span class="_input _10"><?php echo $res->req->birth ?>&nbsp;</span>
          อายุ<span class="_input _5"><?php echo $res->req->age ?>&nbsp;</span>ปี
          เพศ<span class="_input _10"><?php echo $res->req->sex ?>&nbsp;</span>
          เชื้อชาติ<span class="_input _10"><?php echo $res->req->nationality ?>&nbsp;</span>
          สัญชาติ<span class="_input _10"><?php echo $res->req->citizenship ?>&nbsp;</span>
          ศาสนา<span class="_input _10"><?php echo $res->req->religion ?>&nbsp;</span>
        </div>
        <div>สถานภาพ
          <div class="checkbox <?php echo ($res->req->status=='โสด')?"checked":"";?>"></div>
          โสด
          <div class="checkbox <?php echo ($res->req->status=='สมรส อยู่ด้วยกัน')?"checked":"";?>"></div>
          สมรสอยู่ด้วยกัน
          <div class="checkbox <?php echo ($res->req->status=='สมรส แยกกันอยู่')?"checked":"";?>"></div>
          สมรสแยกกันอยู่
          <div class="checkbox <?php echo ($res->req->status=='หย่าร้าง')?"checked":"";?>"></div>
          หย่าร้าง
          <div class="checkbox <?php echo ($res->req->status=='ไม่ได้สมรส แต่อยู่ด้วยกัน')?"checked":"";?>"></div>
          ไม่ได้สมรสแต่อยู่ด้วยกัน
          <div class="checkbox <?php echo ($res->req->status=='หม้าย (คู่สมรสเสียชีวิต)')?"checked":"";?>"></div>
          หม้าย(คู่สมรสเสียชีวิต)
        </div>
        <div>
          <div>อาชีพ<span class="_input _30"><?php echo $res->req->job ?>&nbsp;</span>
            รายได้เฉลี่ยต่อเดือน<span class="_input _30"><?php echo $res->req->income ?>&nbsp;</span>บาท</div>
          <div>ที่มาของรายได้
            <div class="checkbox <?php echo ($res->req->income_type=='ด้วยตนเอง')?"checked":"";?>"></div>
            ด้วยตนเอง
            <div class="checkbox <?php echo ($res->req->income_type=='ผู้อื่นให้')?"checked":"";?>"></div>
            ผู้อื่นให้ (ระบุ)<span class="_input _50"><?php echo $res->req->income_desc ?></span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 section border">
        <div><strong>ที่อยู่ตามทะเบียนบ้าน</strong></div>
          <?php $this->load->view('components/address',array('addr'=>$res->req->addr)) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 section border">
        <div style="padding-top: 5px">ที่อยู่ปัจจุบัน
          <div class="checkbox <?php echo ($res->req->addr->type=='บ้านตนเอง')?"checked":"";?>"></div>
          บ้านตนเอง
          <div class="checkbox <?php echo ($res->req->addr->type=='อาศัยผู้อื่นอยู่')?"checked":"";?>"></div>
          อาศัยผู้อื่นอยู่
          <div class="checkbox <?php echo ($res->req->addr->type=='บ้านเช่า')?"checked":"";?>"></div>
          บ้านเช่า
          <div class="checkbox <?php echo ($res->req->addr->type=='อยู่กับผู้จ้าง')?"checked":"";?>"></div>
          อยู่กับผู้จ้าง
          <div class="checkbox <?php echo ($res->req->addr->type=='ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง')?"checked":"";?>"></div>
          ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง
        </div>
        <div>
          <div class="checkbox  <?php echo ($res->req->addr->addr_status=='1')?"checked":"";?>"></div>
          ที่อยู่ปัจจุบันเป็นที่อยู่เดียวกับที่อยู่ตามทะเบียนบ้าน (กรณีเป็นที่อยู่อาศัยตามทะเบียนบ้าน ขอให้ทำเครื่องหมาย
          <div class="checked"></div>
          ใน
          <div class="checkbox"></div>
          และข้ามในการกรอกข้อมูลอื่น)
        </div>
        <?php $this->load->view('components/address',array('addr'=>$res->req->addr2)) ?>
      </div>
    </div>
  </div>
</div>
<p class="page-break"></p>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body">
    <div class="row page-header">

      <strong>สมาชิกในครอบครัว</strong>

    </div>
    <div class="row">
      <div class="section">
        <table class="table table-bordered" style="width: 100%">
          <tbody>
          <tr>
            <td class="text-center" style="width: 5%">ที่</td>
            <td class="text-center" style="width: 40%">ชื่อ-นามสกุล<br>เลขที่บัตรประชาชน</td>
            <td class="text-center" style="width: 5%">อายุ<br>(ปี)</td>
            <td class="text-center" style="width: 10%">เกี่ยวข้องเป็น</td>
            <td class="text-center" style="width: 10%">อาชีพ</td>
            <td class="text-center" style="width: 10%">รายได้<br>ต่อเดือน</td>
            <td class="text-center" style="width: 10%">สุขภาพ</td>
          </tr>
          <?php
          for ($i = 0; $i < 10; $i++) {
            $row=@$res->family[$i];
              ?>
            <tr>
              <td class="text-center"><?php echo $i + 1 ?></td>
              <td >
                <div><?php echo @$row->name?>&nbsp; </div>
                <div>
                  <?php
                  if($row){
                      $this->load->view('components/idcard',array('idcard'=>$row->idcard));
                  }else{
                      $this->load->view('components/idcard',array('idcard'=>""));
                  }

                  ?>
                </div>
              </td>
              <td class="text-center"><?php echo @$row->age?></td>
              <td><?php echo @$row->relation?></td>
              <td><?php echo @$row->job?></td>
              <td><?php echo @$row->income?></td>
              <td><?php echo @$row->health?></td>
            </tr>
              <?php
          }
          ?>
          </tbody>
        </table>
      </div>
      <div>
        <div class="row">
          <div class="section">
            <div>สถานที่ตรวจเยี่ยม
              <div class="checkbox <?php echo ($res->visit=='ที่พักอาศัย')?"checked":"";?>"></div>
              ที่พักอาศัย
              <div class="checkbox <?php echo ($res->visit=='โรงพยาบาล')?"checked":"";?>"></div>
              โรงพยาบาล
              <div class="checkbox <?php echo ($res->visit=='สถานีตำรวจ')?"checked":"";?>"></div>
              สถานีตำรวจ
              <div class="checkbox <?php echo ($res->visit=='อื่น ๆ')?"checked":"";?>"></div>
              อื่นๆ (ระบุ) <span class="_input _inline _30"><?php echo makeText($res->visit_desc,50) ?>&nbsp;</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<p class="page-break"></p>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body">
    <div class="row page-header">
      <div class="text-right"><span class="label-code">สำหรับเจ้าหน้าที่กรอกข้อมูล</span></div>
    </div>
    <div class="row">
      <div>
        สภาพปัญหาและความคิดเห็นของนักสังคมสงเคราะห์
      </div>
      <div style="min-height: 200px;padding-left: 30px">
          <?php $this->load->view('components/choice',array('choices'=>$res->opinion)) ?>
      </div>
    </div>
    <div class="row">
      <div>
        ผลการให้ความช่วยเหลือ
      </div>
      <div style="min-height: 200px;padding-left: 30px">
          <?php $this->load->view('components/choice',array('choices'=>$res->helpresult)) ?>
      </div>
    </div>
    <div class="row">
      <div>แนวทางการช่วยเหลือต่อไป</div>
      <div style="min-height: 200px;padding-left: 30px">
          <?php $this->load->view('components/choice',array('choices'=>$res->nexthelpdesk)) ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-xs-offset-5">
      <div class="section contact">
        <div>ลงชื่อ<span class="_input _50"><?php echo $res->staffname ?>&nbsp;</span>เจ้าหน้าที่ผู้ตรวจเยี่ยมบ้าน</div>
        <div style="padding-left: 30px">(<span class="_input _50"></span>)</div>
        <div>ตำแหน่ง<span class="_input _50"><?php echo $res->staffposition ?>&nbsp;</span></div>
      </div>
    </div>
  </div>
</div>
<p class="page-break"></p>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body">
    <div class="row page-header">
      <div><strong>หนี้สิน</strong></div>
    </div>
    <div class="row line-height-big"  >
      <div><div class="checkbox <?php echo ($res->debt=='ไม่มีหนี้สิน')?"checked":"";?>"></div> ไม่มีหนี้สิน</div>
      <div><div class="checkbox <?php echo ($res->debt=='มีหนี้สิน')?"checked":"";?>"></div> มีหนี้สิน</div>
      <div style="padding-left: 30px"><div class="checkbox <?php echo ($res->debt1)?"checked":"";?>"></div> เงินกู้ในระบบ	จำนวน<span class="_input _30"><?php echo $res->debt1 ?>&nbsp;</span>บาท</div>
      <div style="padding-left: 30px"><div class="checkbox <?php echo ($res->debt2)?"checked":"";?>"></div> เงินกู้นอกระบบ 	จำนวน<span class="_input _30"><?php echo $res->debt2 ?>&nbsp;</span>บาท</div>
    </div>
  </div>
</div>