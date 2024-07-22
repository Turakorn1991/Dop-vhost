<?php 
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 6/18/2017 AD
 * Time: 22:49
 */ ?>
<div class="page" style="font-size: 18px;line-height: 25px;" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body">
        <div class="row">
            <div class="col col-xs-4"></div>
            <div class="col col-xs-4 text-center">
                <div class="logo-krut-small"></div>
            </div>
            <div class="col col-xs-4 text-right"><span class="label-code">แบบ ศผส.01</span></div>
        </div><!--end logo-->

        <div class="row">
            <div class="col col-xs-12 text-center" style="font-size: 20px;">
               <strong> แบบคำขอรับเงินสงเคราะห์ และรับรองผู้รับผิดชอบในการจัดการศพผู้สูงอายุตามประเพณี  </strong>   
            </div>
            <div class="text-right">เขียนที่<span class="_input _20 text-left"><?php echo $res->org_title ?></span></div>
            <div class="text-right">
                วัน<span class="_input _5 text-center"><?php echo $res->date->day ?></span>
                เดือน<span class="_input _10 text-center"><?php echo $res->date->month ?></span>
                พ.ศ.<span class="_input _10 text-center"><?php echo $res->date->year ?></span>
            </div>
        </div><!--end topic-->

        <!-- <div class="row section">
            <div class="text-right">เขียนที่<span class="_input _20 text-left"><?php echo $res->org_title ?></span></div>
            <div class="text-right">
                วัน<span class="_input _5 text-center"><?php echo $res->date->day ?></span>
                เดือน<span class="_input _10 text-center"><?php echo $res->date->month ?></span>
                พ.ศ.<span class="_input _10 text-center"><?php echo $res->date->year ?></span>
            </div>
        </div> -->

      <div class="row" style="font-size: 18px;line-height: 25px;" >
      <!--<div class="border" style="padding: 3px">-->
        <div><strong><u>ส่วนที่ 1</u>: สำหรับผู้ยื่นขอรับเงินสงเคราะห์ค่าจัดการศพผู้สูงอายุตามประเพณี</strong></div>

            <div style="text-indent: 30px">ข้าพเจ้า<span class="_input _60 "><?php echo " {$res->prename} {$res->name} {$res->surname}" ?></span>
			          อายุ<span class="_input _20 "><?php echo $res->age ?></span>ปี
            </div>

            <div>เลขบัตรประจำตัวประชาชน<span class="_input _20 "><?php echo $res->idcard ?></span>
			        	 ออกให้โดย<span class="_input _15 "><?php  ?></span>
                 วันออกบัตร<span class="_input _15 "><?php  ?></span>
            </div>

            <div>วันหมดอายุ<span class="_input _15 "><?php ?></span>
			        	 อาชีพ<span class="_input _15 "><?php echo $res->job ?></span>
                 อยู่บ้านเลขที่<span class="_input _10 "><?php echo $res->addr->no  ?></span>
                 หมู่ที่<span class="_input _5"><?php echo $res->addr->moo ?></span>
                 ตรอก/ซอย<span class="_input _10 "><?php echo $res->addr->side_street ?></span>
            </div>

            <div>ถนน<span class="_input _15 "><?php echo  $res->addr->street ?></span>
			        	 ตำบล/แขวง<span class="_input _15 "><?php echo $res->addr->locality ?></span>
                 อำเภอ/เขต<span class="_input _15 "><?php echo $res->addr->district  ?></span>
                 จังหวัด<span class="_input _20"><?php echo $res->addr->province ?></span>
             </div>

             <div>รหัสไปรษณีย์<span class="_input _15 "><?php echo  $res->addr->postcode ?></span>
			        	 โทรศัพท์<span class="_input _15 "><?php echo $res->phone ?></span>
                 โทรศัพท์มือถือ<span class="_input _30 "><?php echo $res->mobile  ?></span>
             </div>

              <div style="text-indent: 30px"><strong>มีความเกี่ยวข้องกับผู้สูงอายุที่ตายในฐานะเป็น</strong><span class="_input _10 "><?php echo $res->relation ?></span>
              <strong>และเป็นผู้รับผิดชอบในการจัดงานศพผู้สูงอายุ</strong>
              </div>

              <div><strong>โดยได้รับความยินยอมจากบิดา/มารดา/บุตร/พี่น้อง/เครือญาติ/ของผู้สูงอายุที่ตายให้เป็นผู้รับเงินสงเคราะห์ค่า
              </strong></div>
			        <div><strong>จัดการศพของผู้สูงอายุที่ตาย</strong>
                ชื่อ<span class="_input _50 "><?php echo " {$res->dead->prename} {$res->dead->name} {$res->dead->surname}" ?></span>
			          อายุ<span class="_input _10 "><?php echo $res->dead->age ?></span>ปี
              </div>

			        <div>เลขบัตรประจำตัวประชาชน<span class="_input _20 "><?php echo $res->dead->idcard ?></span>
			        	ออกให้โดย<span class="_input _15 "><?php  ?></span>
                วันออกบัตร<span class="_input _15 "><?php  ?></span>
              </div>
              <!---->
              <div>วันหมดอายุ<span class="_input _15 "><?php ?></span>
                 อยู่บ้านเลขที่<span class="_input _10 "><?php echo $res->dead->pre_addr->no  ?></span>
                 หมู่ที่<span class="_input _5"><?php echo $res->dead->pre_addr->moo ?></span>
                 ตรอก/ซอย<span class="_input _10 "><?php echo $res->dead->pre_addr->side_street ?></span>
                 ถนน<span class="_input _15 "><?php echo $res->dead->pre_addr->street ?></span>
              </div>

              <div>ตำบล/แขวง<span class="_input _15 "><?php echo $res->dead->pre_addr->locality ?></span>
                 อำเภอ/เขต<span class="_input _15 "><?php echo $res->dead->pre_addr->district ?></span>
                 จังหวัด<span class="_input _20"><?php echo $res->dead->pre_addr->province ?></span>
                 รหัสไปรษณีย์<span class="_input _10"><?php echo $res->dead->pre_addr->postcode ?></span>
              </div>

              <div>โทรศัพท์<span class="_input _25 "><?php echo $res->dead->phone ?></span>
                 โทรศัพท์มือถือ<span class="_input _25 "><?php echo $res->dead->mobile ?></span>
              </div>
              <!---->
              <div>ถึงแก่กรรมด้วยสาเหตุ<span class="_input _30 "><?php echo $res->dead->desc ?></span>
                  เมื่อวันที่<span class="_input _10 "><?php echo $res->dead->day ?></span>
                  เดือน<span class="_input _10 "><?php echo $res->dead->month ?></span>
                  พ.ศ.<span class="_input _10 "><?php echo $res->dead->year ?></span>
              </div>

              <div>ตามใบมรณบัตรเลขที่<span class="_input _10 "><?php echo $res->dead->doc_no ?></span>
                  ออกให้โดย<span class="_input _15 "><?php echo $res->dead->doc_by ?></span>
                  เมื่อวันที่<span class="_input _5 "><?php echo $res->dead->doc->day ?></span>
                  เดือน<span class="_input _10 "><?php echo $res->dead->doc->month ?></span>
                  พ.ศ.<span class="_input _10 "><?php echo $res->dead->doc->year ?></span>
              </div>
              <div style="text-indent: 30px;text-align: justify" ><strong>
                ข้าพเจ้าขอรับรองว่าข้อความและเอกสารที่ได้ยื่นนี้เป็นความจริงทุกประการ และข้าพเจ้าไม่เคยได้รับเงิน
                สงเคราะห์ในการจัดการศพผู้สูงอายุรายนี้มาก่อน หากข้อความและเอกสารที่ยื่นเรื่องนี้เป็นเท็จ ข้าพเจ้ายินยอมให้ดำเนินการตามกฏหมาย
                </strong>      
              </div>

            <div class="text-right">(ลงชื่อ)<span class="_input _30 text-left"></span>ผู้ยื่นคำขอ&emsp;&emsp;&ensp;</div>
            <div class="text-right">(<span class="_input _30 text-center"><?php echo " {$res->prename} {$res->name} {$res->surname}" ?></span>)&emsp;&emsp;&ensp;&emsp;&emsp;&ensp;</div>
			<div class="text-right">
				วัน<span class="_input _5 text-center"></span>
				/<span class="_input _10 text-center"></span>
				/<span class="_input _10 text-center"></span>&emsp;&emsp;&ensp;&emsp;&emsp;&ensp;&ensp;
            </div>
            <div><span class="_input _100 "></span></div>

       </div><!--end row-->

       <!-- <div class="row">
            <div style="text-indent: 30px;text-align: justify" class="section"><strong>
                ข้าพเจ้าขอรับรองว่าข้อความและเอกสารที่ได้ยื่นนี้เป็นความจริงทุกประการ และข้าพเจ้าไม่เคยได้รับเงิน
                สงเคราะห์ในการจัดการศพผู้สูงอายุรายนี้มาก่อน หากข้อความและเอกสารที่ยื่นเรื่องนี้เป็นเท็จ ข้าพเจ้ายินยอมให้ดำเนินการตามกฏหมาย
                </strong>
            </div>
        </div> -->

        
        <!-- <div class="row section">
            <div class="text-right">(ลงชื่อ)<span class="_input _30 text-left"></span>ผู้ยื่นคำขอ&emsp;&emsp;&ensp;</div>
            <div class="text-right">(<span class="_input _30 text-center"><?php echo " {$res->prename} {$res->name} {$res->surname}" ?></span>)&emsp;&emsp;&ensp;&emsp;&emsp;&ensp;</div>
			<div class="text-right">
				วัน<span class="_input _5 text-center"></span>
				/<span class="_input _10 text-center"></span>
				/<span class="_input _10 text-center"></span>&emsp;&emsp;&ensp;&emsp;&emsp;&ensp;&ensp;
            </div>
        </div> -->

        <div class="row" style="font-size: 18px;line-height: 25px;" >
                <div><u>ส่วนที่ 2: ข้อมูลผู้ให้การรับรองผู้รับผิดชอบในการจัดการศพผู้สูงอายุตามประเพณี</u></div>
                <div class="text-right">เขียนที่<span class="_input _20 text-left"><?php echo $res->org_title ?></span></div>
                <div class="text-right">
                    วัน<span class="_input _5 text-center"><?php echo $res->accept->doc->day ?></span>
                    เดือน<span class="_input _10 text-center"><?php echo $res->accept->doc->month ?></span>
                    พ.ศ.<span class="_input _10 text-center"><?php echo $res->accept->doc->year ?></span>
                </div>

                <div>ข้าพเจ้า<span class="_input _60 "><?php echo " {$res->aprv->prename} {$res->aprv->name} {$res->aprv->surname}" ?></span>
                     ตำแหน่ง<span class="_input _20 "><?php echo $res->aprv->position ?></span>
                </div>

                <div>สังกัดหน่วยงาน<span class="_input _30 "><?php echo $res->aprv->org ?></span>
                    เลขบัตรประจำตัวประชาชน<span class="_input _20 "><?php echo $res->aprv->idcard ?></span>
                </div>

                <div>ออกให้โดย<span class="_input _20 "></span>
                    วันออกบัตร<span class="_input _20 "></span>
                    วันหมดอายุ<span class="_input _20 "></span>
                </div>

                <div>อยู่บ้านเลขที่<span class="_input _10 "><?php echo $res->aprv->addr->no  ?></span>
                 หมู่ที่<span class="_input _5"><?php echo $res->aprv->addr->moo ?></span>
                 ตรอก/ซอย<span class="_input _10 "><?php echo $res->aprv->addr->side_street ?></span>
                 ถนน<span class="_input _15 "><?php echo $res->aprv->addr->street ?></span>
                 ตำบล/แขวง<span class="_input _15 "><?php echo $res->aprv->addr->locality ?></span>
                </div>

                <div>อำเภอ/เขต<span class="_input _15 "><?php echo $res->aprv->addr->district ?></span>
                 จังหวัด<span class="_input _20"><?php echo $res->aprv->addr->province ?></span>
                 รหัสไปรษณีย์<span class="_input _10"><?php echo $res->aprv->addr->postcode ?></span>
                 โทรศัพท์<span class="_input _10"><?php echo $res->aprv->mobile ?></span>
                </div>
                
                <div>
                ขอรับรองว่าผู้ยื่นคำขอดังกล่าวเป็นผู้รับผิดชอบในการจัดการศพผู้สูงอายุรายนี้จริง
                </div>

                 <div class="text-right">(ลงชื่อ)<span class="_input _30 text-left"></span>ผู้รับรอง&emsp;&emsp;&ensp;</div>
                <div class="text-right">(<span class="_input _30 text-center"><?php echo " {$res->aprv->prename} {$res->aprv->name} {$res->aprv->surname}" ?></span>)&emsp;&emsp;&ensp;&emsp;&emsp;</div>
                <div class="text-right">ตำแหน่ง<span class="_input _30 text-left"><?php echo $res->aprv->position ?></span>&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;</div>
                <div class="text-right">
                    วัน<span class="_input _5 text-center"></span>
                    /<span class="_input _10 text-center"></span>
                    /<span class="_input _10 text-center"></span>&emsp;&emsp;&ensp;&emsp;&emsp;&ensp;
                </div>
                

        </div><!--row-->

        <!-- <div class="row section">
            <div class="text-right">(ลงชื่อ)<span class="_input _30 text-left"></span>ผู้รับรอง&emsp;&emsp;&ensp;</div>
            <div class="text-right">(<span class="_input _30 text-center"><?php echo " {$res->aprv->prename} {$res->aprv->name} {$res->aprv->surname}" ?></span>)&emsp;&emsp;&ensp;&emsp;&emsp;</div>
            <div class="text-right">ตำแหน่ง<span class="_input _30 text-left"><?php echo $res->aprv->position ?></span>&emsp;&emsp;&ensp;&ensp;&ensp;&ensp;</div>
            <div class="text-right">
				วัน<span class="_input _5 text-center"></span>
				/<span class="_input _10 text-center"></span>
				/<span class="_input _10 text-center"></span>&emsp;&emsp;&ensp;&emsp;&emsp;&ensp;
            </div>
            <div>&nbsp;</div>
            <div class="text-right">(ข้อมูลชี้แจงด้านล่าง)</div>
        </div> -->
 
      </div><!--body-->
  </div><!--page-->

<p class="page-break"></p>
<div class="page" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
    <div class="body">
        <div class="row page-header">
            <div class="text-right"><span class="label-code">แบบ ศผส.01</span></div>
        </div><!--end form no.-->

        <div class="row">
            <div align="center">
                (ด้านหลัง แบบ ศผส. 01)       
            </div>
        </div><!--end -->

        <div class="row">
            <div align="center"> 
                <strong>คำชี้แจง</strong>
            </div>
            <div> 1. ผู้ยื่นคําขอรับเงินสงเคราะห์ค่าจัดการศพผู้สูงอายุ หมายถึง ผู้รับผิดชอบในการจัดการศพผู้สูงอายุที่ถึงแก่กรรม ซึ่งได้แก่ บิดา มารดา สามี ภรรยา บุตร ญาติพี่น้องของผู้สูงอายุที่ถึงแก่กรรม ในกรณีที่ผู้สูงอายุไม่มีญาติ บุคคลที่รับผิดชอบในการจัดการศพผู้สูงอายุเป็นผู้ยื่นคําขอรับเงิน 
            ค่าจัดการศพ เช่น ผู้ให้การดูแล ผู้นําชุมชน กํานัน ผู้ใหญ่บ้าน เป็นต้น </div>

            <div> 2. ผู้ให้คํารับรองผู้รับผิดชอบในการจัดการศพผู้สูงอายุตามประเพณี หมายถึง นายกเทศมนตรี หรือนายกองค์การบริหารส่วนตําบล หรือกํานัน 
             หรือผู้ใหญ่บ้าน หรือประธานชุมชน หรือผู้อํานวยการสํานักงานเขต หรือนายอําเภอ หรือนายกเมืองพัทยา </div>

            <div> 3. คุณสมบัติผู้สูงอายุ  </div>
                <div style="text-indent: 30px"> (1) มีอายุเกินหกสิบปีบริบูรณ์ขึ้นไป </div>
                <div style="text-indent: 30px"> (2) มีสัญชาติไทย </div>
                <div style="text-indent: 30px"> (3) ผู้สูงอายุอยู่ในครอบครัวที่ยากจนตามข้อมูลความจําเป็นพื้นฐาน (จปฐ.) กรมการพัฒนาชุมชน กระทรวงมหาดไทย หรือ กรุงเทพมหานคร หรือเมืองพัทยา </div>
                <div style="text-indent: 30px"> (4) ไม่มีญาติ หรือมีญาติแต่มีฐานะยากจนไม่สามารถจัดการศพตามประเพณีได้ผู้สูงอายุยากจนและไม่ได้รับการสํารวจข้อมูลความจําเป็นพื้นฐาน (จปฐ.) กรมการพัฒนาชุมชน กระทรวงมหาดไทย หรือกรุงเทพมหานคร หรือเมืองพัทยา </div>
            <div> 4. หลักฐานการยื่นคําขอ </div>
                <div style="text-indent: 30px"> (1) ใบมรณบัตรของผู้สูงอายุพร้อมสำเนาจำนวนหนึ่งฉบับ </div>
                <div style="text-indent: 30px"> (2) บัตรประจํา ตัวประชาชนหรือบัตรอื่นที่ออกโดยหน่วยงานของรัฐที่มีรูปถ่ายและเลขประจําตัวประชาชนของผู้ยื่นคําขอพร้อมสําเนาจํานวนหนึ่งฉบับ </div>
                <div style="text-indent: 30px"> (3) หนังสือรับรองว่าผู้ยื่นคำขอเป็นผู้รับผิดชอบในการจัดการศพตามประเพณี </div>
            <div> 5. การยื่นคำขอ (ภายใน 30 วัน นับตั้งแต่วันออกใบมรณบัตร) ยื่นคำขอในท้องที่ที่ผู้สูงอายุมีชื่ออยู่ในทะเบียนบ้านหรือภูมิลำเนาที่ถึงแก่ความตายในขณะถึงแก่ความตาย ดังต่อไปนี้ </div>
                <div style="text-indent: 30px"> (1) ในกรุงเทพมหานคร ให้ยื่นคำขอที่สำนักงานเขต สังกัดกรุงเทพมหานคร </div>
                <div style="text-indent: 30px"> (2) ในจังหวัดอื่น ให้ยื่นคำขอต่อสำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด หรือที่ว่าการอำเภอ หรือเมืองพัทยา หรือเทศบาล หรือองค์การบริหารส่วนตำบล </div>
            <div> 6. ผู้ยื่นคำขอและผู้รับรองต้องไม่เป็นบุคคลเดียวกัน </div>
        </div><!--end -->

    </div><!--end body-->
</div><!--end page-->
