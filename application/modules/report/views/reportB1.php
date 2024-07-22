<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/8/2017 AD
 * Time: 23:36
 */
?>
<div class="page" size="A4" style="height: auto" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body smalled full">
    <div class="row">
      <table class="table table-small table-bordered table-result" style="width:100%;">
        <tr>
          <td style="padding: 5px">
            <div class="row">
              <div class="col-xs-10">
                <div><strong>ผู้แจ้งเรื่อง</strong></div>
                <div>
                  ชื่อ<span class="_input _25"><?php echo $res->prename . $res->name ?>&nbsp;</span>
                  นามสกุล<span class="_input _25"><?php echo $res->surname ?>&nbsp;</span>
                  เลขที่บัตรประชาชน <span class="_input _25"><?php echo $res->idcard ?>&nbsp;</span>
                </div>
                <div>
                  วันเดือนปีเกิด<span class="_input _25">&nbsp;<?php echo $res->birth ?></span>
                  อายุ<span class="_input _10">&nbsp;<?php echo $res->age ?></span>ปี
                  สัญชาติ<span class="_input _20">&nbsp;<?php echo $res->citizenship ?></span>
                  ศาสนา<span class="_input _15">&nbsp;<?php echo $res->religion ?></span>
                </div>
                <div>
                  ตำแหน่ง<span class="_input _40">&nbsp;<?php echo $res->position ?></span>
                  หน่วยงาน<span class="_input _45">&nbsp;<?php echo $res->org ?></span>

                </div>
                <div>
                  บ้านเลขที่ <span class="_input _15"><?php echo $res->addr->no ?>&nbsp;</span>
                  หมู่ที่<span class="_input _15"><?php echo $res->addr->moo ?>&nbsp;</span>
                  ตรอก<span class="_input _15"><?php echo $res->addr->lane ?>&nbsp;</span>
                  ซอย<span class="_input _15"><?php echo $res->addr->side_street ?>&nbsp;</span>
                  ถนน<span class="_input _15"><?php echo $res->addr->street ?>&nbsp;</span>
                </div>
                <div>ตำบล/แขวง<span class="_input _20"><?php echo $res->addr->locality ?>&nbsp;</span>
                  อำเภอ/เขต<span class="_input _15"><?php echo $res->addr->district ?>&nbsp;</span>
                  จังหวัด<span class="_input _20"><?php echo $res->addr->province ?>&nbsp;</span>
                  รหัสไปรษณีย์<span class="_input _10"><?php echo $res->addr->postcode ?>&nbsp;</span>
                </div>
                <div>
                  เบอร์โทรศัพท์ (ที่ติดต่อได้)<span class="_input _20"><?php echo $res->phone ?>&nbsp;</span>
                </div>
                <div>
                  ช่องทางการแจ้ง<span class="_input _80"><?php echo $res->visit_channel ?>&nbsp;</span>

                </div>
              </div>
              <div class=" col-xs-2">
                  <?php
                  // if ($res->image != '') {
               
                  //     echo "<img src='".base_url().$res->image."' style='margin-right:15px; border: 1px solid #000000;width: 100%;;height: 120px'>";
                  // } else {
                  //     echo '<div style="margin-right:15px; border: 1px solid #000000;width: 100%;height: 120px"></div>';
                  // }
                  ?>

                  <?php if($res->image != '') {?>
                               
                               <img src="<?php echo 'https://center.dop.go.th//'.$res->image ;?>" alt="..." class="image"  style='margin-right:15px; border: 1px solid #000000;width: 100%;height: 120px'>                              
                                     
                  <?php }else{ ?>
                  			
                               <div style="margin-right:15px; border: 1px solid #000000;width: 100%;height: 120px"></div>                                                               
                                   
                  <?php } ?>

              </div>
            </div>
          </td>
        </tr>
      </table>
      <table class="table table-small table-bordered table-result" style="width:100%;margin-top: 15px">
        <tr>
          <td style="padding: 5px">
            <div class="row">
              <div class="col-xs-10">
                <div><strong>ข้อมูลผู้สูงอายุ</strong></div>
                <div>
                  ชื่อ<span class="_input _25"><?php echo $res->req->prename . $res->req->name ?>&nbsp;</span>
                  นามสกุล<span class="_input _25"><?php echo $res->req->surname ?>&nbsp;</span>
                  เลขที่บัตรประชาชน <span class="_input _25"><?php echo $res->req->idcard ?>&nbsp;</span>
                </div>
                <div>วันเดือนปีเกิด<span class="_input _25"><?php echo $res->req->birth ?>&nbsp;</span>
                  อายุ<span class="_input _10"><?php echo $res->req->age ?>&nbsp;</span>ปี
                  สัญชาติ<span class="_input _20"><?php echo $res->req->citizenship ?>&nbsp;</span>
                  ศาสนา<span class="_input _15"><?php echo $res->req->religion ?>&nbsp;</span>
                </div>
                <div>
                  <div class="row">
                    <div class="col-xs-2">สถานภาพ</div>
                    <div class="col-xs-3">
                      <div class="checkbox <?php echo ($res->req->status == 'โสด') ? "checked" : ""; ?>"></div>
                      โสด
                    </div>
                    <div class="col-xs-3">
                      <div class="checkbox <?php echo ($res->req->status == 'สมรส อยู่ด้วยกัน') ? "checked" : ""; ?>"></div>
                      สมรสอยู่ด้วยกัน
                    </div>
                    <div class="col-xs-3">
                      <div class="checkbox <?php echo ($res->req->status == 'สมรส แยกกันอยู่') ? "checked" : ""; ?>"></div>
                      สมรสแยกกันอยู่
                    </div>
                    <div class="col-xs-2"></div>
                    <div class="col-xs-3">
                      <div class="checkbox <?php echo ($res->req->status == 'หย่าร้าง') ? "checked" : ""; ?>"></div>
                      หย่าร้าง
                    </div>
                    <div class="col-xs-3">
                      <div class="checkbox <?php echo ($res->req->status == 'ไม่ได้สมรส แต่อยู่ด้วยกัน') ? "checked" : ""; ?>"></div>
                      ไม่ได้สมรสแต่อยู่ด้วยกัน
                    </div>
                    <div class="col-xs-3">
                      <div class="checkbox <?php echo ($res->req->status == 'หม้าย (คู่สมรสเสียชีวิต)') ? "checked" : ""; ?>"></div>
                      หม้าย(คู่สมรสเสียชีวิต)
                    </div>
                  </div>
                </div>
                <div>
                  ระดับการศึกษา<span class="_input _20"><?php echo $res->req->edu ?>&nbsp;</span>
                  อาชีพ<span class="_input _20"><?php echo $res->req->job ?>&nbsp;</span>
                  รายได้เฉลี่ยต่อเดือน<span class="_input _20"><?php echo $res->req->income ?>&nbsp;</span>บาท
                </div>
                <div>
                  <div class="row">
                    <div class="col-xs-2">ที่มาของรายได้</div>
                    <div class="col-xs-3">
                      <div class=" checkbox <?php echo ($res->req->income_type == 'ด้วยตนเอง') ? "checked" : ""; ?>"></div>
                      ด้วยตนเอง
                    </div>
                    <div class="col-xs-7">
                      <div class="checkbox <?php echo ($res->req->income_type == 'ผู้อื่นให้') ? "checked" : ""; ?>"></div>
                      ผู้อื่นให้ (ระบุ)<span class="_input _60"><?php echo $res->req->income_desc ?>&nbsp;</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class=" col-xs-2">
                  <?php
                  // if ($res->req->image != '') {
                  //     echo "<img src='".base_url().$res->req->image."' style='margin-right:15px; border: 1px solid #000000;width: 100%;;height: 120px'>";
                  // } else {
                  //     echo '<div style="margin-right:15px; border: 1px solid #000000;width: 100%;height: 120px"></div>';
                  // }
                  ?>
                
                   <?php if($res->req->image != '') {?>
 
                              <!-- <img src="<?php //echo 'https://center.dop.go.th//'.$res->req->image ;?>" alt="..." class="image"  style='margin-right:15px; border: 1px solid #000000;width: 100%;height: 120px'>    -->
                               <!-- <?php //$this->Image(base_url().$res->req->image)?> -->
                               <!-- <img src="<?php //echo $res->req->image ;?>" style='margin-right:15px; border: 1px solid #000000;width: 100%;height: 120px'>                               -->
                                     
                  <?php }else{ ?>
                  			
                               <div style="margin-right:15px; border: 1px solid #000000;width: 100%;height: 120px"></div>                                                               
                                   
                  <?php } ?>
              </div>
              <div class="col-xs-12">
                <div><strong>ที่อยู่ตามทะเบียนบ้าน</strong></div>
                  <?php $this->load->view('components/address2', array('addr' => $res->req->addr)) ?>
                <div><strong>ที่อยู่ปัจจุบัน</strong>
                  <div class="checkbox  <?php echo ($res->req->addr->type == 1) ? "checked" : ""; ?>"></div>
                  ตรงกับที่อยู่ตามทะเบียนบ้าน
                </div>
                  <?php $this->load->view('components/address3', array('addr' => $res->req->addr2)) ?>
                <div>
                  <div class="row">
                    <div class="col-xs-2">
                      ข้อมูลทางกายภาพ
                    </div>
                    <div class="col col-xs-10">
                      <div class="row">
                          <?php
                          foreach ($res->disability as $item) {
                              ?>
                            <div class="col-xs-4">
                              <div class="checkbox <?php echo ($item->check == 1) ? "checked" : ""; ?>"></div> <?php echo $item->title ?>
                              <br>
                            </div>
                              <?php
                          }
                          ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div>
                  โรคประจําตัว <span class="_input _80"><?php echo $res->req->pers_congenital_disease?>&nbsp;</span>
                </div>
                <div>
                  ประวัติการแพ้ยา <span class="_input _80"><?php echo $res->req->pers_drug_allergy ?>&nbsp;</span>
                </div>
              </div>
            </div>
          </td>
        </tr>
      </table>
      <div class="col-xs-12" style="padding: 0;margin-top: 15px">
        <div style="padding-left: 5px">
          <strong>สมาชิกในครอบครัว <?php echo (count($res->family)) ? "(" . count($res->family) . ")" : "" ?></strong>
        </div>
        <table class="table table-small table-bordered table-result" style="width: 100%">
          <tbody>
          <tr>
            <td class="text-center" style="width: 5%">ที่</td>
            <td class="text-center" style="width: 10%">เลขประจำตัว<br>ประชาชน</td>
            <td class="text-center" style="width: 15%">ชื่อ-นามสกุล</td>
            <td class="text-center" style="width: 5%">อายุ</td>
            <td class="text-center" style="width: 10%">เกี่ยวข้องเป็น</td>
            <td class="text-center" style="width: 8%">อาชีพ</td>
            <td class="text-center" style="width: 8%">รายได้<br>ต่อเดือน</td>
            <td class="text-center" style="width: 8%">การศึกษา</td>
            <td class="text-center" style="width: 8%">สุขภาพ</td>
            <td class="text-center" style="width: 8%">ช่วยเหลือ<br>ตัวเอง</td>
          </tr>
          <?php
          $num = count($res->family);
          $num = ($num > 8) ? $num : 8;
          for ($i = 0; $i < $num; $i++) {
              $row = @$res->family[$i];
              ?>
            <tr>
              <td class="text-center"><?php echo $i + 1 ?></td>
              <td>
                  <?php echo @$row->idcard ?>
              </td>
              <td>
                  <?php echo @$row->name ?>&nbsp;
              </td>

              <td class="text-center"><?php echo @$row->age ?></td>
              <td><?php echo @$row->relation ?></td>
              <td><?php echo @$row->job ?></td>
              <td><?php echo @$row->income ?></td>
              <td><?php echo @$row->edu_title ?></td>
              <td><?php echo @$row->health ?></td>
              <td><?php echo @$row->self ?></td>
            </tr>
              <?php
          }
          ?>
          </tbody>
        </table>
      </div>

    </div>
    <div class="row">

      <div class="col-xs-6 col" style="padding-right: 15px;padding-top: 20px">
        <table class="table table-small table-bordered table-result" style="width: 100%;">
          <tr>
            <td style="padding: 10px 0">
              <div><strong>ข้อมูลการรับเข้า</strong></div>
              <div>วันที่รับเข้า <span class="_input _80"><?php echo $res->adm_date ?>&nbsp;</span></div>
              <div>สาเหตุการรับเข้า <span class="_input _inline"><?php echo makeText($res->adm_reason, 75) ?>
                  &nbsp;</span></div>
              <div>ประวัติความเป็นมา <span class="_input _inline"><?php echo makeText($res->case_history, 170) ?>
                  &nbsp;</span></div>
              <div>สิ่งที่นําติดตัวมาด้วย <span class="_input _inline"><?php echo makeText($res->belonging_with, 165) ?>
                  &nbsp;</span></div>
            </td>
          </tr>
        </table>
      </div>
      <div class="col-xs-6 col" style="padding-left: 15px;padding-top: 20px">
        <table class="table table-small table-bordered table-result" style="width: 100%;">
          <tr>
            <td style="padding: 10px 0">
              <div><strong>ข้อมูลการจำหน่าย</strong></div>
              <div>วันที่จำหน่าย <span class="_input _80"><?php echo $res->dis_date ?>&nbsp;</span></div>
              <div>สาเหตุการรจำหน่าย <span class="_input _inline"><?php echo makeText($res->dis_reason, 480) ?>
                  &nbsp;</span></div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>



