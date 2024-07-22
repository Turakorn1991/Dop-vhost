<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/19/2017 AD
 * Time: 15:00
 */
?>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
    <div class="body">
        <div class="row">
            <div class="col col-xs-4"></div>
            <div class="col col-xs-4 text-center">
                <div class="logo-krut"></div>
            </div>
            <div class="col col-xs-4 text-right"><span class="label-code">แบบ ศผส.02</span></div>
        </div>
        <div class="row">
            <div class="col col-xs-12 caption text-center">
                แบบรับรองการจัดการศพผู้สูงอายุ กรณีไม่ได้รับการสำรวจข้อมูลความจำเป็นพื้นฐาน (จปฐ.) ในปีที่ตายและผู้สูงอายุในครัวเรือนยากจนตามเกณฑ์ข้อมูลความจำเป็นพื้นฐาน (จปฐ.)
            </div>
        </div>
        <div class="row section">
            <div class="text-right">เขียนที่<span class="_input _20 text-left"><?php echo $res->org ?></span></div>
            <div class="text-right">
                วัน<span class="_input _5 text-center"><?php echo $res->date->day ?></span>
                เดือน<span class="_input _10 text-center"><?php echo $res->date->month ?></span>
                พ.ศ.<span class="_input _10 text-center"><?php echo $res->date->year ?></span>
            </div>
        </div>
        <div class="row">
            <div style="text-indent: 30px">ข้าพเจ้า<span class="_input _30 "><?php echo " {$res->prename} {$res->name} {$res->surname}" ?></span>
                ตำแหน่ง<span class="_input _30 "><?php echo $res->position ?></span>
            </div>
            <div>สังกัดหน่วยงาน<span class="_input _60 "><?php echo "{$res->org}" ?></span>
                อายุ<span class="_input _20 "><?php echo $res->age ?></span>ปี
            </div>
            <div>
                เลขบัตรประจำตัวประชาชน<span class="_input _30 "><?php echo $res->idcard ?></span>
                ออกให้โดย<span class="_input _30 "><?php echo $res->idcard_by ?></span>
            </div>
            <div>
                วันออกบัตร<span class="_input _20 "><?php echo $res->idcard_date ?></span>
                วันหมดอายุ<span class="_input _20 "><?php echo  $res->idcard_exp ?></span>
                อยู่บ้านเลขที่<span class="_input _10"><?php echo $res->addr->no ?></span>
                หมู่ที่<span class="_input _5 "><?php echo $res->addr->moo ?></span>

            </div>
            <div>
                หมู่บ้าน<span class="_input _15 "><?php echo $res->addr->village ?></span>
                ตรอก/ซอย<span class="_input _15 "><?php echo $res->addr->side_street ?></span>
                ถนน<span class="_input _15 "><?php echo $res->addr->street ?></span>
                ตำบล/แขวง<span class="_input _20"><?php echo $res->addr->locality ?></span>
            </div>
            <div>
                อำเภอ/เขต<span class="_input _20"><?php echo $res->addr->district ?></span>
                 จังหวัด<span class="_input _20"><?php echo $res->addr->province ?></span>
                รหัสไปรษณีย์<span class="_input _20"><?php echo $res->addr->postcode ?></span>
            </div>
            <div>
                โทรศัพท์<span class="_input _20"><?php echo $res->phone ?></span>
                โทรศัพท์มือถือ<span class="_input _20"><?php echo $res->mobile ?></span>
            </div>

        </div>
        <div class="row">
        <div style="text-indent: 30px;margin-top: 20px;text-align: justify" class="section">
            ข้าพเจ้าขอรับรองว่า ผู้สูงอายุที่ตายอยู่ในครัวเรือนยากจนและไม่ได้รับการสำรวจข้อมูลความจำเป็นพื้นฐาน (จปฐ.)
            กรมการพัฒนาชุมชน กระทรวงมหาดไทย หรือกรุงเทพมหานคร หรือเมืองพัทยาโดยได้ตรวจสอบรายชื่อผู้สูงอายุแล้ว
            ไม่ ปรากฏรายชื่ออยู่ในการสำรวจข้อมูลความจำเป็นพื้นฐาน (จปฐ.) และผู้สูงอายุที่ตายอยู่ในครัวเรือนยากจน
            โดยมีรายได้ ในครัวเรือนเฉลี่ยต่อปีตามเกณฑ์รายได้ข้อมูลความจำเป็นพื้นฐาน (จปฐ.) ในปีที่ตายจริง
        </div>

        </div>
        <div class="row">
            <div class="col col-xs-5 col-xs-offset-7 text-center">
                <div style="margin-top: 80px">
                    <div>(ลงชื่อ)<span class="_input _50">&nbsp;</span></div>
                    <div>(<span class="_input _60"><?php echo "{$res->name} {$res->surname}" ?></span>)</div>
                    <div>ตำแหน่ง<span class="_input _60"><?php echo $res->position ?></span></div>
                    <div>วันที่ <span class="_input _50"><?php echo "{$res->date->day}/{$res->date->month}/{$res->date->year}"?></span></div>
                </div>
            </div>
        </div>
        <div class="row">

                <div style="margin-top: 80px;text-align: justify">
                    หมายเหตุ: ผู้ให้การรับรองผู้สูงอายุที่ตายเป็นผู้ที่อยู่ในครัวเรือนยากจนตามเกณฑ์ข้อมูลความจำเป็นพื้นฐาน (จปฐ.)และไม่ได้รับ การสำรวจข้อมูลความจำเป็นพื้นฐาน (จปฐ.) ในปีที่ตาย รับรองโดย นายกเทศมนตรี หรือนายกองค์การบริหารส่วนตำบล
                    หรือกำนัน หรือผู้ใหญ่บ้าน หรือประธานชุมชน หรือผู้อำนวยการสำนักงานเขต หรือนายอำเภอ หรือนายกเมืองพัทยา <span style="text-decoration: underline">โดยผู้ยื่นคำขอและ ผู้รับรองต้องไม่เป็นบุคคลเดียวกัน</span>
                </div>

        </div>
    </div>
</div>
