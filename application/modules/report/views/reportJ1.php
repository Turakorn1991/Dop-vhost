<?php
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 8/1/2017 AD
 * Time: 22:30
 */
?>
<div class="page" style="height: auto" size="A4" <?php echo @($layout) ? "layout=\"{$layout}\"" : "" ?>>
  <div class="body smalled full">
    <div class="row">
      <div class="col col-xs-12">
        <div><h3 style="margin-top: 1px"><strong>ประวัติส่วนตัว</strong></h3></div>
        <table class="table table-bordered table-small table-result" style="width: 100%;">
          <tr>
            <td width="25%"> เลขประจาตัวประชาชน</td>
            <td width="50%" colspan="2">
                <?php
                echo "<strong>{$res->idcard}</strong>";
                echo ($res->father_pin) ? "<br><span class='hilight'>{$res->father_pin} (บิดา)</span>" : "";
                echo ($res->father_pin) ? "<br><span class='hilight'>{$res->mother_pin} (มารดา)</span>" : "";

                ?>
            </td>
            <td width="25%" rowspan="4" style="vertical-align: middle">
                <?php
                if ($res->image) {
                    echo "<img src='{$res->image}' style='width: 150px;margin:  auto'>";
                } else {
                    ?>
                  <div style="width: 150px;height: 200px;margin:  auto"></div>
                    <?php
                }
                ?>

            </td>
          </tr>
          <tr>
            <td>(คำนำหน้า) ชื่อตัว - ชื่อสกุล</td>
            <td colspan="2">
                <?php
                echo $res->prename . $res->name . " " . $res->surname . "<br>";
                echo "เพศ {$res->gender}   สัญชาติ {$res->citizenship}   ศาสนา {$res->religion}";
                ?>
            </td>
          </tr>
          <tr>
            <td>วันเดือนปีเกิด</td>
            <td colspan="2">
                <?php
                echo "{$res->birth} (อายุ $res->age ปี)";
                ?>
            </td>
          </tr>
          <tr>
            <td>ที่อยู่ (ตามทะเบียนบ้าน)</td>
            <td colspan="2">
                <?php
                echo "เลขรหัสประจำบ้าน {$res->addr->code}<br>
                                บ้านเลขที่ {$res->addr->no} หมู่ที่ {$res->addr->moo} ตรอก {$res->addr->lane} ซอย {$res->addr->side_street} ถนน {$res->addr->street}<br>
                                ตำบล/แขวง {$res->addr->locality} อำเภอ/เขต {$res->addr->district} จังหวัด {$res->addr->province}<br>
                                รหัสไปรษณีย์ {$res->addr->postcode}<br>";
                echo "<span class='hilight'>(จำนวนพื้นที่อยู่อาศัยตาม พ.ร.บ. สาธารณสุข {$res->addr->land_size} ลูกบาศก์เมตร)<br>
                                   (เลขที่เอกสารถือครองที่ดิน {$res->addr->land_holding_no})<br>
                                   (ตำแหน่งพิกัดภูมิศาสตร์ {$res->addr->land_gps})</span>";
                ?>
            </td>
          </tr>
          <tr>
            <td rowspan="3">ที่อยู่ (ปัจจุบัน)</td>
            <td colspan="3">
                <?php
                echo "เลขรหัสประจำบ้าน {$res->addr2->code}<br>
                                บ้านเลขที่ {$res->addr2->no} หมู่ที่ {$res->addr2->moo} ตรอก {$res->addr2->lane} ซอย {$res->addr2->side_street} ถนน {$res->addr2->street}<br>
                                ตำบล/แขวง {$res->addr2->locality} อำเภอ/เขต {$res->addr2->district} จังหวัด {$res->addr2->province}<br>
                                รหัสไปรษณีย์ {$res->addr2->postcode}<br>";
                echo "<span class='hilight'>(จำนวนพื้นที่อยู่อาศัยตาม พ.ร.บ. สาธารณสุข {$res->addr2->land_size} ลูกบาศก์เมตร)<br>
                                   (เลขที่เอกสารถือครองที่ดิน {$res->addr2->land_holding_no})<br>
                                   (ตำแหน่งพิกัดภูมิศาสตร์ {$res->addr2->land_gps})</span>";
                ?>
            </td>
          </tr>
          <tr>
            <td width="25%">ลักษณะการพักอาศัย</td>
            <td colspan="2">
                <?php
                echo $res->pre_addr_status;
                ?>
            </td>
          </tr>
          <tr>
            <td width="25%">ลักษณะการถือครองที่ดิน</td>
            <td colspan="2">
                <?php
                echo $res->pre_addr_estate;
                ?>
            </td>
          </tr>
          <tr>
            <td>ช่องทางการติดต่อ</td>
            <td>เบอร์โทรศัพท์ (ที่ติดต่อได้)</td>
            <td colspan="2">
                <?php
                echo $res->phone;
                ?>
            </td>
          </tr>

          <tr>
            <td>สถานะการสมรส</td>
            <td>
                <?php
                echo $res->status;
                ?>
            </td>
            <td>ระดับการศึกษา</td>
            <td> <?php
                echo $res->edu;
                ?></td>
          </tr>
          <tr>
            <td>อาชีพ (ปัจจุบัน)</td>
            <td><?php
                echo $res->job;
                ?></td>
            <td>รายได้เฉลี่ย/เดือน (บาท)</td>
            <td><?php
                echo $res->income;
                ?></td>
          </tr>
          <tr>
            <td>ที่มาของรายได้</td>
            <td><?php
                echo $res->incomefrom;
                ?></td>
            <td>รายได้เฉลี่ยครอบครัว/ปี (บาท)</td>
            <td>
                <?php
                echo $res->incomefamiry;
                ?>
            </td>
          </tr>
          <tr>
            <td rowspan="4">สถานะทางร่างกาย</td>
            <td>ปัญหาสุขภาพ</td>
            <td colspan="2"><?php
                echo $res->healthy;
                ?></td>
          </tr>
          <tr>
            <td>การช่วยเหลือตนเอง</td>
            <td colspan="2"><?php
                echo $res->healthy_self_help;
                ?></td>
          </tr>
          <tr>
            <td>โรคประจำตัว</td>
            <td colspan="2"><?php
                echo $res->healthy_congenital_disease;
                ?></td>
          </tr>
          <tr>
            <td>ประวัติการแพ้ยา</td>
            <td colspan="2"><?php
                echo $res->healthy_drug_allergy;
                ?></td>
          </tr>
          <tr>
            <td>สถานะหนี้สิน</td>
            <td><?php
                echo $res->dept_status;
                ?></td>
            <td colspan="2">
                <?php
                echo "เงินกู้ในระบบ {$res->dept_loan_system} บาท<br>
                            เงินกู้นอกระบบ {$res->dept_loan_shark} บาท";
                ?>

            </td>
          </tr>
          <tr>
            <td>สถานะการปรับปรุงข้อมูล (ล่าสุด)</td>
            <td colspan="3">
                <?php echo "{$res->update_time}<br>{$res->update_by}"; ?>
            </td>
          </tr>
        </table>
        <div class="break-inside">
          <div><h3><strong>สมาชิกในครอบครัว</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>

              <td class="text-center" style="width: 15%">เลขประจำตัวประชาชน</td>
              <td class="text-center" style="width: 35%">(คำนำหน้า) ชื่อตัว - ชื่อสกุล</td>
              <td class="text-center" style="width: 10%">อายุ (ปี)</td>
              <td class="text-center" style="width: 20%">ความสัมพันธ์</td>
              <td class="text-center" style="width: 20%">การช่วยเหลือตนเอง</td>
            </tr>
            <?php
            if (count($res->family)) {
                foreach ($res->family as $row) {

                    ?>
                  <tr>
                    <td>
                        <?php echo @$row->idcard ?>
                    </td>
                    <td>
                        <?php echo @$row->name ?>
                    </td>

                    <td class="text-center"><?php echo @$row->age ?></td>
                    <td><?php echo @$row->relation ?></td>

                    <td><?php echo @$row->self ?></td>
                  </tr>
                    <?php
                }
            } else{ ?> <tr>
                <td colspan="5" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการได้รับการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">วันที่แจ้งเรื่อง</td>
              <td class="text-center" style="width: 15%">วันที่ตรวจเยี่ยม</td>
              <td class="text-center" style="width: 15%">วันที่รับเงิน</td>
              <td class="text-center" style="width: 40%">หน่วยงาน</td>
              <td class="text-center" style="width: 15%">จำนวนเงิน (บาท)</td>
            </tr>
            <?php
            if (count($res->hisdiffs)) {
            foreach ($res->hisdiffs as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date ?></td>
                <td class="text-center"><?php echo $row->date_servey ?></td>
                <td class="text-center"><?php echo $row->date_recive ?></td>
                <?php 
                  $id = $row->org;
                  //$title = $this->Common_model->custom_query("select org_title from usrm_org where org_id = {$id}");
                ?>
                <td><?php echo $id ?></td>
                <td style="text-align: right;padding-right: 10px"><?php echo $row->pay ?></td>
              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="5" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการเข้ารับการสงเคราะห์ในศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">วันที่แจ้งเรื่อง</td>
              <td class="text-center" style="width: 40%">หน่วยงาน</td>
              <td class="text-center" style="width: 15%">วันที่รับเข้า</td>
              <td class="text-center" style="width: 15%">วันที่จำหน่าย</td>
              <td class="text-center" style="width: 15%">ผลการประเมิน</td>
            </tr>
            <?php
            if (count($res->adms)) {
            foreach ($res->adms as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date; ?></td>
                <td><?php echo $row->org ;?></td>
                <td class="text-center"><?php echo $row->date_chkin ;?></td>
                <td class="text-center"><?php echo $row->date_chkout ;?></td>
                <td class="text-center"><?php echo $row->score ;?></td>
              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="5" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการได้รับการสงเคราะห์ในการจัดการงานศพผู้สูงอายุตามประเพณี</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">วันที่แจ้งเรื่อง</td>
              <td class="text-center" style="width: 15%">ผู้ยื่นคำขอ</td>
              <td class="text-center" style="width: 15%">วันที่ได้รับสงเคราะห์</td>
              <td class="text-center" style="width: 40%">หน่วยงาน</td>
              <td class="text-center" style="width: 15%">จำนวนเงิน (บาท)</td>
            </tr>
            <?php
            if (count($res->fnrls)) {
            foreach ($res->fnrls as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date ?></td>
                <td><?php echo $row->name ?></td>
                <td class="text-center"><?php echo $row->date_recive ?></td>
                <td><?php echo $row->org ?></td>
                <td style="text-align: right;padding-right: 10px"><?php echo $row->pay ?></td>
              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="5" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการได้รับการสงเคราะห์ในการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวก</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">วันที่สอบถาม</td>
              <td class="text-center" style="width: 15%">ผลการพิจารณา</td>
              <td class="text-center" style="width: 15%;padding-left: 0!important;" >วันที่ดำเนินการแล้วเสร็จ</td>
              <td class="text-center" style="width: 40%">หน่วยงาน</td>
              <td class="text-center" style="width: 15%">จำนวนเงิน (บาท)</td>
            </tr>
            <?php
            if (count($res->hismpvs)) {
            foreach ($res->hismpvs as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date ?></td>
                <td class="text-center"><?php echo $row->result ?></td>
                <td class="text-center"><?php echo $row->date_finish ?></td>
                <td><?php echo $row->org ?></td>
                <td style="text-align: right;padding-right: 10px"><?php echo $row->pay ?></td>
              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="5" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการขึ้นทะเบียนคลังปัญญาผู้สูงอายุ</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">วันที่แจ้งเรื่อง</td>
              <td class="text-center" style="width: 35%">สาขาภูมิปัญญา</td>
              <td class="text-center" style="width: 50%">เชี่ยวชาญเรื่อง</td>
            </tr>
            <?php
            if (count($res->hiswisds)) {
            foreach ($res->hiswisds as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date ?></td>
                <td><?php echo $row->branch ?></td>
                <td><?php echo $row->expert ?></td>

              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="3" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการขึ้นทะเบียนอาสาสมัครดูแลผู้สูงอายุ (อผส.)</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" rowspan="2" style="width: 15%">วันที่ขึ้นทะเบียน</td>
              <td class="text-center" colspan="3" style="width: 70%">ได้รับการอบรมเรื่องการดูแลผู้สูงอายุ</td>
              <td class="text-center" rowspan="2" style="width: 15%">ผู้สูงอายุที่ดูแล (คน</td>
            </tr>
            <tr>
              <td class="text-center" style="width: 15%">สถานะ</td>
              <td class="text-center" style="width: 15%">วันที่</td>
              <td class="text-center" style="width: 40%">หลักสูตร</td>
            </tr>
            <?php
            if (count($res->hisvolts)) {
            foreach ($res->hisvolts as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date_reg ?></td>
                <td class="text-center"><?php echo $row->status ?></td>
                <td class="text-center"><?php echo $row->date ?></td>
                <td><?php echo $row->name ?></td>
                <td style="text-align: right;padding-right: 10px"><?php echo $row->count ?></td>
              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="5" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติเข้ารับการฝึกอบรมด้านการเตรียมความพร้อมสู่วัยสูงอายุ
                (การให้ความรู้ก่อนวัยเกษียณ)</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">วันที่จัดฝึกอบรม</td>
              <td class="text-center" style="width: 50%">หัวข้อการจัดฝึกอบรม</td>
              <td class="text-center" style="width: 35%">หน่วยงานดำเนินการ</td>
            </tr>
            <?php
            if (count($res->histrns)) {
            foreach ($res->histrns as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date ?></td>
                <td><?php echo $row->title ?></td>
                <td><?php echo $row->org ?></td>
              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="3" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการศึกษาในโรงเรียนผู้สูงอายุ</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">ปีที่เปิดเรียน</td>
              <td class="text-center" style="width: 20%">รุ่นที่</td>
              <td class="text-center" style="width: 65%">โรงเรียนผู้สูงอายุ</td>
            </tr>
            <?php
            if (count($res->hisschs)) {
            foreach ($res->hisschs as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->year ?></td>
                <td class="text-center"><?php echo $row->no ?></td>
                <td><?php echo $row->sch ?></td>

              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="3" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <div class="break-inside">
          <div><h3><strong>ประวัติการขึ้นทะเบียนจัดหางาน</strong></h3></div>
          <table class="table table-small table-bordered table-result" style="width: 100%">
            <tbody>
            <tr>
              <td class="text-center" style="width: 15%">วันที่ขึ้นทะเบียน</td>
              <td class="text-center" style="width: 35%">สาขาความเชี่ยวชาญ</td>
              <td class="text-center" style="width: 35%">ประเภทกิจการ</td>
              <td class="text-center" style="width: 15%">สถานะการได้รับงาน</td>
            </tr>
            <?php
            if (count($res->hisjobs)) {
            foreach ($res->hisjobs as $row) {
                ?>
              <tr>
                <td class="text-center"><?php echo $row->date ?></td>
                <td><?php echo $row->job_sp ?></td>
                <td><?php echo $row->type_comp ?></td>
                <td><?php echo $row->status ?></td>

              </tr>
                <?php
            }
            } else{ ?> <tr>
              <td colspan="4" style="text-align: center">ไม่มีข้อมูล</td></tr><?php
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
