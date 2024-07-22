<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/20/2017 AD
 * Time: 20:57
 */?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body large" style="font-size: 30px;">
    <div class="row">
      <div class="text-center">
        <div>
        <div class="logo-dop" style="display: inline-block"></div>
        <div class="logo-blank" style="display: inline-block"></div>
        </div>
        <div>กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์  และโรงเรียนผู้สูงอายุ <span class="_input _inline "><?php echo makeText($res->school,10) ?></span></div>
        <div>มอบวุฒิบัตรไว้เพื่อแสดงว่า</div>
        <div style="margin: 30px 0"><span class="_input _40 text-center"><?php echo $res->name ?></span></div>
        <div>ได้สำเร็จการศึกษาหลักสูตรโรงเรียนผู้สูงอายุ <span class="_input _20 text-center"><?php echo $res->cer_name?></span> รุ่นที่ <span class="_input _10 text-center"><?php echo $res->cer_no ?></span> ปี <span class="_input _10 text-center"><?php echo $res->cer_year ?></span></div>
        <div>ให้ไว้ ณ วันที่ <span class="_input _10 text-center"><?php echo $res->date->day ?></span> เดือน <span class="_input _20 text-center"><?php echo $res->date->month ?></span> พ.ศ. <span class="_input _10 text-center"><?php echo $res->date->year ?></span></div>
        <div>ขอชื่นชมในความวิริยะ อุตสาหะในการศึกษาหลักสูตรโรงเรียนผู้สูงอายุ</div>
        <div>ขอให้เจริญด้วย อายุ วรรณะ สุขะ พละ และดำรงไว้ซึ่งคุณภาพความดีของผู้สูงอายุต่อไป</div>
        <div style="margin-top: 100px">
        <div class="col-xs-5">
          <div><?php echo $res->sing1 ?></div>
          <div>(<span class="_input _50">&nbsp</span>)</div>
          <div>อธิบดีกรมกิจการผู้สูงอายุ</div>
        </div>
        <div class="col-xs-2">

        </div>
        <div class="col-xs-5">
          <div><?php echo $res->sing2 ?></div>
          <div>(<span class="_input _50">&nbsp</span>)</div>
          <div>ผู้อำนวยการโรงเรียนผู้สูงอายุ <?php echo $res->school ?></div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>