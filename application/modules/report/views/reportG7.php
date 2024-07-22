<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/20/2017 AD
 * Time: 20:57
 */?>
<div class="page" size="A4" <?=@($layout) ? "layout=\"{$layout}\"" : ""?>>
  <div class="body large" style="font-size: 30px;line-height: 40px">
    <div class="row">
      <div class="text-center">
        <div>
          <div class="logo-dop-big" ></div>

        </div>
        <div style="font-size:35px">กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์</div>
        <div>มอบวุฒิบัตรไว้เพื่อแสดงว่า</div>
        <div style="margin: 30px 0">
          <div style='font-size:40px;font-style:oblique;'><?=$res['schl']['schl_name']?></div>
        </div>
        <div>เป็นผู้นำการบริหาร และส่งเสริมการนำหลักสูตร</div>
        <div>สู่การปฏิบัติอย่างมีประสิทธิภาพ</div>
        <div style="margin: 30px 0">ให้ไว้ ณ วันที่ <?=$res['date']?></div>
        <div class="row" style="margin: 30px 0">
          <div class="col-xs-7 col-xs-offset-2">
            <div class="col-xs-5 text-right">พลตำรวจเอก</div>
            <div class="col-xs-7 col-xs-offset-5 text-left">(อนันตพร กาญจนรัตน์)</div>
          </div>
          <div class="col-xs-12">รัฐมนตรีว่าการกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์</div>
        </div>
      </div>
    </div>
  </div>
</div>