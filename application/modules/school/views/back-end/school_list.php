<!--
<h3 style="color: #4e5f4d"><?php echo $title; ?></h3>
<hr/>

   <div class="row">
	   <div class="col-xs-12 col-sm-12 text-right">

          <?php
$tmp = $this->admin_model->getOnce_Application(58);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(58, $user_id); //Check User Permission
?>
          <a <?php if (!isset($tmp1['perm_status'])) {?>
            readonly
          <?php } else {?> href="<?php echo site_url('school/school1'); ?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกแบบขึ้นทะเบียน<?php if (isset($tmp['app_name'])) {echo $tmp['app_name'];}?>" class="btn btn-default">
              <i class="fa fa-plus" aria-hidden="true"></i>
          </a>

          <?php
$tmp = $this->admin_model->getOnce_Application(6);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(6, $user_id); //Check User Permission
?>
          <a <?php if (!isset($tmp1['perm_status'])) {?>
            readonly
          <?php } else {?> href="<?php echo site_url('report/excel'); ?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="<?php if (isset($tmp['app_name'])) {echo $tmp['app_name'];}?>" class="btn btn-default">
              <i class="fa fa-file-excel-o" aria-hidden="true"></i>
          </a>

          &nbsp;
          <a style="color: #000; padding-left: 20px; padding-right: 20px;" title="ค้นหา" class="btn btn-default" data-toggle="modal" data-target="#mySearch">
              <i class="fa fa-filter" aria-hidden="true"></i>
		      </a>

	   </div>
   </div>
   -->

      <div id="tmp_menu" hidden='hidden'>
    <?php
$tmp = $this->admin_model->getOnce_Application(59);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(59, $user_id); //Check User Permission
?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if (!isset($tmp1['perm_status'])) {?>
            readonly
          <?php } else {?> href="<?php echo site_url('school/school1'); ?>"
    <?php }?> title="<?php if (isset($tmp['app_name'])) {echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม </a>


    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" type="button" id="filter" href="javascript:showFilter();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
$tmp = $this->admin_model->getOnce_Application(62);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(62, $user_id); //Check User Permission
?>
    <a
      class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export school-list-xls-export"
      style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
      <?php if (!isset($tmp1['perm_status'])) {?>
      readonly
      <?php }?>
      title="<?php if (isset($tmp['app_name'])) {echo $tmp['app_name'];}?>"
    >
      <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i>
      ส่งออกไฟล์
    </a>
    <form class='school-list-xls-form' method='post' action="<?=site_url('report/G0/xls')?>">
      <input type="hidden" name='schl_name'>
      <input type="hidden" name='addr_province'>
      <input type="hidden" name='year_of_established_from'>
      <input type="hidden" name='year_of_established_to'>
      <input type="hidden" name='models_count'>
      <input type="hidden" name='schl_status'>
      <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>" />
    </form>

    <!--
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module'); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
    -->
  </div>
  <script>
    $("#guide-book").click(function(){
      window.open('/assets/modules/school/guide/Sch_Manual.pdf', '_blank');
    }); 
    setTimeout(function(){
      $("#menu_topright").html($("#tmp_menu").html());
    },300);

    function showChart(){
      $("#chart_display").slideToggle();
    }

    // export filtered excel
    $('body').on('click', '.school-list-xls-export', e => {
      $('.school-list-filter-form .column_filter').each((i, ele) =>
        $('.school-list-xls-form [name=' + $(ele).attr('name') +']').val($(ele).val())
      );
      $('.school-list-xls-form:first').submit();
    });
  </script>

  <?php
//summary
$this->load->file(APPPATH . 'modules/' . uri_seg(1) . '/views/back-end/school_list_summary.php');
//search
$this->load->file(APPPATH . 'modules/' . uri_seg(1) . '/views/back-end/school_list_filter.php');
?>

  <style>
    i.fa.fa-star-o, i.fa.fa-star {font-size: 16px;}
    i.fa.fa-star-o {color: #909090;}
    i.fa.fa-star {color: #FF9800;}
    .inactive-school-last-update i {color:#4cc0c1}
    .inactive-school-last-update span {color:#009294}
    .active-school-last-update i {color:#ffc333}
    .active-school-last-update span {color:darkorange}
    .inactive-school-status i {color:#fb6b5b}
    .inactive-school-status span {color:red}
    .active-school-status i {color:#8ec165}
    .active-school-status span {color:green}
  </style>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
      <thead style="font-size: 15px;">
        <tr>
            <th rowspan="2" style="width:2% !important;" class="text-center">#</th>
            <th rowspan="2" class="text-center" style="" class="text-center">ชื่อโรงเรียน</th><!--ชื่อโรงเรียนxxx width:23% !important;-->
            <th colspan="2" style="width:200px !important;" class="text-center">สถานะการอัปเดตรุ่นล่าสุด<br />(ระยะเวลา)</th>
            <th rowspan="2" style="width:10% !important;" class="text-center">จังหวัด</th>
            <th rowspan="2" style="width:5% !important;" class="text-center">ปีที่จัดตั้ง</th>
            <th rowspan="2" style="width:5% !important;" class="text-center">จำนวน (รุ่น)</th>
            <th rowspan="2" style="width:5% !important;" class="text-center">ผู้เข้าร่วม (คน)</th>
            <th rowspan="2" style="width:1% !important;" class="text-center">&nbsp;</th>
        </tr>
        <tr>
            <th style="width: 100px !important;" class="text-center">ระยะเวลา</th><!-- width:5% -->
            <th style="width: 100px !important;" class="text-center">สถานะ</th><!-- width:5% -->
        </tr>
			</thead>
      <tbody>
        <?php
$number = 1;

foreach ($schl_info as $schl) {
    $schoolIsActive = $schl['last_update'] !== null && $schl['last_update'] <= 365;
    ?>
                <tr>
                    <td class="lnk text-center"><?php echo $number; ?></td>

                    <td class="lnk">
                      <i class='fa fa-star<?=$schl['models_count'] > 0 ? '' : '-o'?>'></i>
                      <i class='fa fa-star<?=$schl['models_count'] > 9 ? '' : '-o'?>'></i>
                      <i class='fa fa-star<?=$schl['models_count'] > 12 ? '' : '-o'?>'></i>
                      <i class='fa fa-star<?=$schl['models_count'] > 15 ? '' : '-o'?>'></i>
                      &nbsp;
                      <?=$schl['schl_name']?>
                    </td>

                    <!-- สถานะ --><!-- blue #4cc0c1, red #fb6b5b, green #8ec165, yellow #ffc333 -->
                    <td
                      class="lnk text-center <?=($schoolIsActive ? 'active' : 'inactive') . '-school-last-update'?>"
                      style="font-size:24px;"
                    >
                      <?php if ($schoolIsActive): ?>
                        <i class="fa fa-history"></i>
                        <span><?="{$schl['last_update']} วันก่อน"?></span>
                      <?php else: ?>
                        <i class="fa fa-exclamation-circle"></i>
                        <span>
                        <?=$schl['last_update'] === null ? 'ยังไม่มีการอัพเดท' : "{$schl['last_update']} วันก่อน"?>
                        </span>
                      <?php endif;?>
                    </td>

                    <td
                      class="lnk text-center <?=lcfirst($schl['schl_status']) . '-school-status'?>"
                      style="font-size:24px;"
                    >
                      <?php if ($schl['schl_status'] !== 'Active'): ?>
                        <i class="fa fa-times-circle"></i>
                        <span>Inactive</span>
                      <?php else: ?>
                        <i class="fa fa-check-circle"></i>
                        <span>Active</span>
                      <?php endif;?>
                    </td>

                    <!-- จังหวัด -->
                    <td class="lnk">
                      <?=$schl['province'] ? $schl['province'] : '-'?>
                    </td>

                    <!-- ปีที่จัดตั้ง-->
                    <td class="lnk text-center">
                      <?=empty($schl['year_of_established']) ? '-' : $schl['year_of_established'] + 543?>
                    </td>

                    <!-- จำนวนรุ่นตามโรงเรียน-->
                    <td class="lnk text-center">
                      <a href="<?php echo base_url('school/generation3/Edit/' . $schl['schl_id']); ?>">
                        <?=$schl['gens_count']?>
                      </a>
                    </td>

                    <!-- จำนวนนักเรียน-->
                    <td class="lnk text-center">
                      <a href="<?php echo base_url('school/generation3/Edit/' . $schl['schl_id']); ?>">
                        <!-- <a <?php //if(isset($amout_schl[0]['gen_id'])){?>
                        href="<?php //echo base_url('school/participant/Add/'.$schl['schl_id'].'/'.$amout_schl[0]['gen_id']);?>" <?php //}?>> -->
                        <?=$schl['students_count']?>
                      </a>
                    </td>

                    <td align="right">

                      <div class="btn-group" style="cursor: pointer;">
                        <i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>
                        <ul class="dropdown-menu" style="position: absolute;left: -210px;">

                          <li>
                           <a style="font-size:16px;" data-toggle="modal" data-target="#prt<?php echo $schl['schl_id']; ?>" title="พิมพ์แบบฟอร์ม" >
                             <i class="fa fa-file-text" aria-hidden="true" style="color: #000"></i>  พิมพ์แบบฟอร์ม (.PDF)
                           </a>
                          </li>

                           <li>
                            <?php
$tmp = $this->admin_model->getOnce_Application(59); //แก้ไข permission จาก 3 เป็น 59 = 'แบบขึ้นทะเบียน (โรงเรียน)' ของ parent 57 โรงเรียน ผส
    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59, $user_id); //Check User Permission
    ?>
                            <a style="font-size:16px;" <?php if (!isset($tmp1['perm_status'])) {?>
                              readonly
                              <?php } else {?> href="<?php echo site_url('school/school1/Edit/' . $schl['schl_id']); ?>" <?php }?> title="<?php if (isset($tmp['app_name'])) {echo $tmp['app_name'];}?>" >
                              <i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ
                            </a>
                          </li>

                        <li>
                                <?php
$tmp = $this->admin_model->chkOnce_usrmPermiss(58, $user_id); //Check User Permission //แก้ไข permission จาก 3 เป็น 58 = 'ตารางข้อมูล' ของ parent 57 โรงเรียน ผส
    if (isset($tmp['perm_status'])) {
        if ($tmp['perm_status'] == 'Yes') {
            ?>
                                <a style="font-size:16px;" data-id=<?php echo $schl['schl_id']; ?> onclick="modalActive(this)" title="แก้ไขสถานะการดำเนินการ"  >
                                  <i class="fa fa-pencil" style="color: #000"></i> แก้ไขสถานะการดำเนินการ
                                </a>
                                <?php
}
    }
    ?>
                        </li>

                          <li>
                                   <?php
$tmp = $this->admin_model->chkOnce_usrmPermiss(58, $user_id); //Check User Permission //แก้ไข permission จาก 3 เป็น 58 = 'ตารางข้อมูล' ของ parent 57 โรงเรียน ผส
    if (isset($tmp['perm_status'])) {
        if ($tmp['perm_status'] == 'Yes') {
            ?>
                                  <a style="font-size:16px;" data-id=<?php echo $schl['schl_id']; ?> onclick="opn(this)" title="ลบ"  >
                                    <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                                  </a>
                                  <?php
}
    }
    ?>
                          </li>
                        </ul>
                      </div>




                          <!-- Print Modal -->
            <div class="modal fade" id="prt<?php echo $schl['schl_id']; ?>" role="dialog">
              <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
              <div class="modal-header text-left">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
              </div>
              <div class="modal-body">
              <div class="row ">
              <!--
              <?php
$tmp = $this->admin_model->getOnce_Application(150); //แก้ไข permission จาก 49 เป็น 150 = 'ส่งออกไฟล์ ประกาศนียบัตรการเป็นผู้นำบริหารโรงเรียน (G7) (PDF)' ของ parent 57 โรงเรียน ผส
    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(150, get_session('user_id')); //Check User Permission
    ?>
                                                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                            <?php
if (!isset($tmp1['perm_status'])) {?>
                                                            class="disabled"
                                                            <?php
} else if ($usrpm['app_id'] == 150) {
        ?>
                                                            class="active"
                                                            <?php
}
    ?>
              >
              -->
              <div class="col-xs-12 col-sm-12 text-left">
              <a style="color: #333; font-size: 16px;" target="_blank"
              href="<?php echo site_url('report/G7/pdf?id=' . $schl['schl_id']); ?>"><i class="fa fa-print"
              aria-hidden="true"></i> ส่งออกไฟล์ ประกาศนียบัตรการเป็นผู้นำบริหารโรงเรียน (G7) (PDF)
               <!--<?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>-->
              </a>
              </div>
              </div>

              </div>

              </div>
              <br />

              </div>
              </div>

              </div>
              </div>
              <!-- End Print Modal -->


                    </td>
                </tr>



          <?php
$number++;
} //close foreach
?>

      </tbody>
		</table>

  </div>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Delete Modal -->
<div id="dltModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('034');?>
        <p><?php echo $str; ?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Modal -->


<!-- start opal Modal -->
<!-- Active / Inactive  -->
<div id="mdActive" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 20px;">แก้ไขสถานะการดำเนินการ</h4>
      </div>
      <div class="modal-body">
        <p></p>

        <div class="form-group row">
          <div class="col-xs-12 col-sm-6 text-right" style="padding-top: 12px;" >

            <h3><label for="col8_filter">ปรับเปลี่ยนสถานะของโรงเรียน:</label></h3> <!-- do new filter : for="col11_filter" / for="col8_filter" -->

          </div>
          <div class="col-xs-12 col-sm-5" style="padding-top: 12px;">
            <form id='update-schl-status-form' action="<?=site_url('school/update_status')?>" method='post'>

              <select title="เรียงลำดับข้อมูล" placeholder="เลือกหัวข้อ" class="form-control elder_addr_pre" id="obf" name="schl_status">
                  <option value="">เลือกสถานะ</option>
                  <option value="Active">ดำเนินการ (Active)</option>
                  <option value="Inactive">ไม่ดำเนินการ (Inactive)</option>
              </select>
              <input type="hidden" name='schl_id'>
              <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>" />

            </form>

          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button id="update-schl-status" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<script>
var modalActive = function(node) {
  var id = $(node).data("id");
  $('#update-schl-status-form [name=schl_id]').val(id);
  $("#mdActive")
    .data("id", id)
    .modal("show");
};
$('#update-schl-status').click(e=>$('#update-schl-status-form').submit());
</script>
<!-- end opal Modal -->

