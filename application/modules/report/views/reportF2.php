<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/20/2017 AD
 * Time: 20:57
 */
?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large" style="line-height: 30px;">
    <div class="row">
      <div class="col col-xs-4 text-left">
      </div>
      <div class="col col-xs-4 text-center">
        <div class="logo-dop"></div>
      </div>
      <div class="col col-xs-4 text-right">
        <div>แบบสอบถามหมายเลข <span class="_inline _input"><?php echo makeText(null, 10)?></span></div>
        <div>แบบฟอร์ม อผส.02</div>
      </div>
    </div>
    <div class="row">
      <div class="text-center caption">
        กรมกิจการผู้สูงอายุ
        <br>
        แบบสอบถามสำหรับผู้ที่เป็นอาสาสมัครดูแลผู้สูงอายุ (อผส.)
      </div>
    </div>
    <div class="row">
      <div style="border: 1px solid #000000; padding: 10px">
        <div><span style="text-decoration: underline">ส่วนที่ 1</span> ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม</div>
        <div>จงทำเครื่องหมาย <div class="checked"></div> ลงในช่อง <div class="checkbox"></div> หรือเติมคำในช่องว่างที่ตรงกับความคิดเห็นของท่านมากที่สุด</div>
        <div>
            1. เพศ
            <div class="checkbox <?php echo $person['gender_code']==1?"checked":"";?>"></div> ชาย
            <div class="checkbox <?php echo $person['gender_code']==2?"checked":"";?>"></div> หญิง
            ชื่อ – นามสกุล (อผส.)
            <span class="_input _30">
                <?php
                $row = filterRow($std_prename, 'pren_code', $person['pren_code']);
                echo "{$row['prename_th']}{$person['pers_firstname_th']} {$person['pers_lastname_th']}";
                ?>
            </span>
        </div>
        <div>
            2.
            หมายเลขบัตรประชาชน <span class="_input _20"><?=$person['pid']?></span>
            วัน/เดือน/ปี เกิด <span class="_input _10"><?=$person['date_of_birth_th']?></span>
            อายุ <span class="_input _5"><?php echo age($person['date_of_birth']);?></span> ปี
        </div>
        <div>
            3.
            บ้านเลขที่ <span class="_input _10"><?=$person['addr_home_no']?></span>
            หมู่ <span class="_input _5"><?=$person['addr_moo']?></span>
            ตำบล <span class="_input _15"><?=$person['amphur']?></span>
            อำเภอ <span class="_input _15"><?=$person['tambon']?></span>
            จังหวัด <span class="_input _15"><?=$person['province']?></span>
        </div>
        <div>
            4.
            อบต./เทศบาล <span class="_input _30"></span>
            จังหวัด <span class="_input _30"><?=$person['province']?></span>
        </div>

        <div>5. ระดับการศึกษา
            <div style="padding-left: 20px">
                <?php foreach ($std_education as $edu) { ?>
                <div class="_30 _inline-blog">
                    <div class="checkbox <?php echo ($person['edu_code']==$edu['edu_code'])?"checked":"";?>"></div>
                    <?=$edu['edu_title']?>
                    <?php if ($person['edu_identify']){ ?>
                      <span class="_input _20"><?=$person['edu_identify']?></span>
                    <?php }?>
                </div>
                <?php } ?>
            </div>
        </div>
        <div>6. อาชีพ
            <?php $jobInList = false; ?>
            <div style="padding-left: 20px">
                <div class="_40 _inline-blog">
                    <div class="checkbox <?php echo ($jobInList = $person['occupation']=='เกษตรกรรม')?"checked":"";?>"></div>
                    เกษตรกรรม
                </div>
                <div class="_20 _inline-blog">
                    <div class="checkbox <?php echo ($jobInList = $person['occupation']=='รับจ้างทั่วไป')?"checked":"";?>"></div>
                    รับจ้างทั่วไป
                </div>
                <div class="_20 _inline-blog">
                    <div class="checkbox <?php echo ($jobInList = $person['occupation']=='รับราชการ')?"checked":"";?>"></div>
                    รับราชการ
                </div>
                <div class="_40 _inline-blog">
                    <div class="checkbox <?php echo ($jobInList = $person['occupation']=='ค้าขาย/ธุรกิจส่วนตัว')?"checked":"";?>"></div>
                    ค้าขาย/ธุรกิจส่วนตัว
                </div>
                <div class="_50 _inline-blog">
                    <div class="checkbox <?php echo $jobInList?"":"checked";?>"></div>
                    อื่น ๆ (ระบุ)
                    <span class="_input _30"><?php echo $jobInList?$person['occupation']:'';?></span>
                </div>
            </div>
        </div>
        <div>
            7. ปัจจุบันท่านดำรงตำแหน่งใดบ้างในหมู่บ้าน/ตำบล (ตอบได้มากกว่า 1 ข้อ)
            <div style="padding-left: 20px">
                <?php
                foreach ($std_position as $position) {
                    $row = filterRow($exp_position, 'vpos_code', $position['vpos_code']);
                ?>
                <div class="_30 _inline-blog">
                    <div class="checkbox <?php echo empty($row)?"":"checked";?>"></div>
                    <?=$position['vpos_title']?>
                    <?php if ($position['vpos_code']=='009'&&!empty($row)) { ?>
                        <span class="_input _20"><?=$row['vpos_identify']?></span>
                    <?php }?>
                </div>
                <?php } ?>
            </div>
        </div>
        <div>
          <span style="text-decoration: underline">ส่วนที่ 2</span> การปฏิบัติงานของ อผส.
        </div>
        <div>1. ท่านเป็น อผส. มาแล้วกี่ปี (ระบุ) <span class="_input _30"><?php echo age($person['date_of_reg']); ?></span> ปี</div>
        <div>2. ก่อนปฏิบัติหน้าที่ อผส. ท่านเคยได้รับการอบรมการดูแลผู้สูงอายุหรือไม่
          <div style="padding-left: 20px">
            <div class="_100 _inline-blog">
                <div class="checkbox <?php echo ($person['older_care_training']=='เคยได้รับการอบรม')?"checked":"";?>"></div> เคย
                <div class="checkbox <?php echo ($person['older_care_training']=='ไม่เคยได้รับการอบรม')?"checked":"";?>"></div> ไม่เคย
                <div>
                    จากหน่วยงาน (ระบุ)
                    <span class="_input _30">
                        <?php echo $person['older_care_training_org']; ?>
                    </span>
                    <br>
                    หลักสูตร เรื่อง (ระบุ)
                    <span class="_input _30">
                        <?php echo $person['older_care_training_course']; ?>
                    </span>
                </div>
             </div>
          </div>
        </div>
        <div>
            3. ท่านได้รับการอบรมเรื่องการดูแลผู้สูงอายุครั้งสุดท้ายเมื่อไหร่ (ระบุ)
            <span class="_input _10"><?=$person['date_of_training']?></span>
            <br>
            <table class="table-bordered table table-normal" style="width: 100%">
                <thead>
                    <tr>
                        <th width="50%">รายชื่อผู้สูงอายุในความดูแล</th>
                        <th width="20%">หมายเลขบัตรประชาชน</th>
                        <th width="10%">อายุ</th>
                        <th width="20%">อผส.ดูแลผู้สูงอายุ<br>(ครั้ง/สัปดาห์/เดือน)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i=0;$i<max(count($exp_elders_in_charge),10);$i++) {
                        $elder = $exp_elders_in_charge[$i] ? $exp_elders_in_charge[$i] : array();
                        $row = filterRow($std_prename, 'pren_code', $elder['pren_code']);
                    ?>
                    <tr>
                        <td><?php echo "{$row['prename_th']}{$elder['pers_firstname_th']} {$elder['pers_lastname_th']}";?></td>
                        <td><?=$elder['pid']?></td>
                        <td><?php echo age($elder['date_of_birth']);?></td>
                        <td><?php echo "{$elder['care_freq']} {$elder['care_freq_per']}";?>&nbsp;</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large" style="line-height: 30px;">

    <div class="row">
      <div style="border: 1px solid #000000; padding: 10px">
        <div>
          4. ในช่วงที่ผ่านมา ท่านให้การดูแล/ช่วยเหลือผู้สูงอายุในเรื่องใดบ้าง
          <table class="table-bordered table table-normal" style="width: 100%">
            <thead>
            <tr>
              <th width="5%">ข้อ</th>
              <th width="50%">กิจกรรม</th>
              <th width="10%">ทำ</th>
              <th width="10%">ไม่ได้ทำ</th>
              <th width="25%">หมายเหตุ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($std_activity as $i => $activity) { ?>
              <tr>
                <td><?php echo ($i+1).'.' ?></td>
                <td><?=$activity['care_acti_title']?></td>
                <td class="text-center">
                <?php if ($didIt = in_array($activity['care_acti_id'], $person['done_activities'])) { ?>
                    <div class='checked'></div>
                <?php } ?>
                </td>
                <td class="text-center">
                <?php if (!$didIt) { ?><div class='checked'></div><?php } ?>
                </td>
                <td></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <div style="padding-top: 10px">5. ข้อเสนอแนะอื่นๆ</div>
        <div>
          <span class="_inline _input"><?php echo makeText(null, 800)?></span>
        </div>
        <br>
      </div>
      <br>
      <p><strong>หมายเหตุ: </strong>กรุณาส่งแบบรายงานผลการดำเนินงานให้กับกรมฯ ทุกเดือน (ภายในวันที่ 5 ของทุกเดือน)</p>
    </div>
  </div>
</div>
