<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/18/2017 AD
 * Time: 08:41
 */

?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
    <div class="body large">
        <div class="row">
            <div class="col col-xs-3 text-left">

            </div>
            <div class="col col-xs-6 text-center">
                <div class="logo-dop"></div>
            </div>
            <div class="col col-xs-3 text-right"><span class="label-code">แบบ สคส.02</span></div>
        </div>
        <div class="row">
            <div class="col col-xs-12 caption text-center">
                แบบใบสำคัญรับเงินตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ มาตรา 11 (8) (9) (10)
            </div>
        </div>
        <div class="row">
            <div class="text-right"><span class="">หน่วยงาน<span class="_input _20 text-left"><?php echo $res->org ?>&nbsp;</span></span></div>
            <div class="text-right"><span class="">วันที่แจ้งเรื่อง<span class="_input _20 text-left"><?php  echo $res->date?>&nbsp;</span></span></div>
        </div>
        <div class="row">
            <div class="col col-xs-12 section">
                <div>คำนำหน้าชื่อ
                  <span class="_input _15"><?php echo $res->prename ?>&nbsp;</span>
                    ชื่อ<span class="_input _30"><?php echo $res->name ?>&nbsp;</span>นามสกุล<span class="_input _30"><?php echo $res->surname ?>&nbsp;</span>
                </div>
                <div>
                    บ้านเลขที่ <span class="_input _10"><?php echo $res->addr->no ?>&nbsp;</span>
                    หมู่ที่<span class="_input _15"><?php echo $res->addr->moo ?>&nbsp;</span>.
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
                  เบอร์โทรศัพท์ (ที่ติดต่อได้)<span class="_input _15"><?php echo $res->phone ?>&nbsp;</span>
                </div>
                <div>
                    ได้รับเงินตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ (8) (9) (10) จำนวนเงิน<span class="_input _10"><?php echo $res->amount ?>&nbsp;</span>บาท
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-offset-7 col-xs-5 section text-center">
                <div class="">(ลงนาม)<span class="_input _60">&nbsp;</span>ผู้รับเงิน</div>
                <div class="">(<span class="_input _60"><?php echo $res->sign1 ?></span>)</div>
            </div>
            <div class="col col-xs-offset-7 col-xs-5 section text-center">
                <div class="">(ลงนาม)<span class="_input _60"><?php $res->sign2 ?>&nbsp;</span>ผู้จ่ายเงิน</div>
                <div class="">(<span class="_input _60">&nbsp;</span>)</div>
            </div>
            <div class="col col-xs-offset-7 col-xs-5 section text-center">
                <div class="">(ลงนาม)<span class="_input _60"><?php echo $res->sign3 ?>&nbsp;</span>พยาน</div>
                <div class="">(<span class="_input _60">&nbsp;</span>)</div>
            </div>
            <div class="col col-xs-offset-7 col-xs-5 section text-center">
                <div class="">(ลงนาม)<span class="_input _60"><?php echo $res->sign4 ?>&nbsp;</span>พยาน</div>
                <div class="">(<span class="_input _60">&nbsp;</span>)</div>
            </div>
        </div>
    </div>
</div>
