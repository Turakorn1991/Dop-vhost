<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/18/2017 AD
 * Time: 08:41
 */?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
    <div class="body large">

        <div class="row">
            <div class="col col-xs-12 caption text-center">
              หนังสือมอบอำนาจรับเงินสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
            </div>
        </div>
        <div class="row">
            <div class="text-right"><span class="">เขียนที่<span class="_input _20 text-left"><?php echo $res->org ?>&nbsp;</span></span></div>
            <div class="text-right"><span class="">วันที่แจ้งเรื่อง<span class="_input _20 text-left"><?php  echo $res->date?>&nbsp;</span></span></div>
        </div>
        <div class="row">
            <div class="col col-xs-12 section">
                <div style="text-indent: 30px">โดยหนังสือฉบับนี้ข้าพเจ้า
                  <span class="_input _10"><?php echo $res->prename ?>&nbsp;</span>
                    ชื่อ<span class="_input _40"><?php echo $res->name.' '.$res->surname ?>&nbsp;</span>
                </div>
              <div>
                เลขที่บัตรประชาชน <span class="_input _30"><?php echo $res->idcard?>&nbsp;</span>
                วัน/เดือน/ปีเกิด<span class="_input _20"><?php echo $res->birth?>&nbsp;</span>
                อายุ<span class="_input _10"><?php echo $res->age?>&nbsp;</span>ปี
              </div>
                <div>
                   อยู่บ้านเลขที่ <span class="_input _20"><?php echo $res->addr->no ?>&nbsp;</span>
                    หมู่ที่<span class="_input _20"><?php echo $res->addr->moo ?>&nbsp;</span>
                    ตรอก/ซอย<span class="_input _30"><?php echo $res->addr->side_street ?>&nbsp;</span>
                </div>
              <div>
                    ถนน<span class="_input _40"><?php echo $res->addr->street ?>&nbsp;</span>
                  แขวง/ตำบล<span class="_input _40"><?php echo $res->addr->locality ?>&nbsp;</span>
                </div>
                <div>
                  เขต/อำเภอ<span class="_input _40"><?php echo $res->addr->district ?>&nbsp;</span>
                    จังหวัด<span class="_input _40"><?php echo $res->addr->province ?>&nbsp;</span>
                </div>
                <div style="padding-left: 30px">
                  ขอมอบอำนาจให้ (นาย/นาง/นางสาว)<span class="_input _30"><?php echo $res->to->name.' '.$res->to->surname ?>&nbsp;</span>
                  ตำแหน่ง<span class="_input _20"><?php echo $res->to->position ?>&nbsp;</span>
                </div>
              <div>
                ที่อยู่<span class="_input _20"><?php echo $res->to->addr->text ?>&nbsp;</span>
                เลขที่<span class="_input _10"><?php echo $res->to->addr->no ?>&nbsp;</span>
                ถนน<span class="_input _20"><?php echo $res->to->addr->street ?>&nbsp;</span>
                แขวง/ตำบล<span class="_input _20"><?php echo $res->to->addr->locality ?>&nbsp;</span>
              </div>
                <div>
                  เขต/อำเภอ<span class="_input _40"><?php echo $res->to->addr->district ?>&nbsp;</span>
                  จังหวัด<span class="_input _40"><?php echo $res->to->addr->province ?>&nbsp;</span>
                </div>
              <div style="text-indent: 30px">
                เป็นผู้มีอำนาจรับเช็คเงินสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก เป็นจำนวนเงิน<span class="_input _20 "><?php echo $res->amount ?>&nbsp;</span>บาท
              </div>
              <div>
                (<span class="_input _20"><?php echo $res->amounttext ?>&nbsp;</span>) จาก <span class="_input"><?php echo $res->org ?>&nbsp;</span>
              </div>
              <div style="text-indent: 30px">
                ข้าพเจ้าขอรับผิดชอบในการที่ผู้รับมอบอำนาจได้กระทำไปตามหนังสือมอบอำนาจนี้ เสมือนข้าพเจ้าได้กระทำด้วยตนเอง
              </div>
              <div class="text-center">
                เพื่อเป็นหลักฐานข้าพเจ้าได้ลงลายมือชื่อหรือลายพิมพ์นิ้วมือ ไว้เป็นหลักฐานสำคัญต่อหน้าพยานแล้ว
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-offset-7 col-xs-5 section text-center">
                <div class="">(ลงนาม)<span class="_input _50">&nbsp;</span>ผู้มอบอำนาจ</div>
                <div class="">(<span class="_input _60"><?php echo $res->sign1 ?></span>)</div>
            </div>
            <div class="col col-xs-offset-7 col-xs-5 section text-center">
                <div class="">(ลงนาม)<span class="_input _50"><?php $res->sign2 ?>&nbsp;</span>ผู้รับมอบอำนาจ</div>
                <div class="">(<span class="_input _60"></span>)</div>
            </div>
            <div class="col col-xs-offset-7 col-xs-5 section text-center">
                <div class="">(ลงนาม)<span class="_input _50"><?php echo $res->sign3 ?>&nbsp;</span>พยาน</div>
                <div class="">(<span class="_input _60"></span>)</div>
            </div>

        </div>
    </div>
</div>
