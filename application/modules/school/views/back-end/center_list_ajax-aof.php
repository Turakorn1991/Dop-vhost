<script>
  var dtable_url = '<?php echo site_url('school/center_list_ajax');?>';
  var csrf_hash='<?php echo @$csrf['hash'];?>';
  var export_url = '<?php echo site_url('report/F10/xls');?>'; //opy

</script>

     <div id="tmp_menu" hidden='hidden'>
      <?php
        $tmp = $this->admin_model->getOnce_Application(59);
        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
      ?>
      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add"style="width:114px; margin-left: 0px; background-color: #e8152b; border: 0;font-size: 16px; padding: 4px 0 4px 0;"
       href="<?php echo site_url('school/center_info');?>" 
       title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>"> 
      <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>

      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" type="button" href="javascript:showFilter();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

      <?php
        $tmp = $this->admin_model->getOnce_Application(6);
        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
      ?>
      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
      <?php if(!isset($tmp1['perm_status'])) {?>
              readonly
            <?php }else{?> href="<?php echo site_url('report/F10/xls/dasdasd'); //report/C0/xls ?>"
      <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
      <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>

      <!--
      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
      -->

      <!-- ===== opy - test export excel ===== -->

      <button id="filterexport" class="btn btn-primary btn-save" type="button" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;">
      <!-- <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i>  -->
      ส่งออกไฟล์2</button>

      <!-- ============================= -->

  </div>
  <script>
    setTimeout(function(){
      $("#menu_topright").html($("#tmp_menu").html());
    },300);

    function showChart(){
      $('#collapseExample').removeClass("in");
      $("#chart_display").slideToggle();
    }
    function showFilter(){
      $("#chart_display").hide();
    }
  </script>

  <?php
    // //summary
     $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/center_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/center_list_filter.php');
  ?>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;" class="text-center">#</th>
            <th style="width:8% !important;" class="text-center">ภาค</th>
            <th style="width:8% !important;" class="text-center">จังหวัด</th>
            <th class="text-center" style="width:15% !important;" class="text-center">ชื่อหน่วยงาน ศพอส.</th>
            <!--<th style="width:12% !important;" class="text-center">ที่ตั้ง</th>-->
            <!--<th style="width:10% !important;" class="text-center">เบอร์โทรศัพท์</th>-->
            <th style="width:4% !important;" class="text-center">ปีที่ประเมินล่าสุด</th>
            <th style="width:3% !important;" class="text-center">เกรด</th>
            <th style="width:8% !important;" class="text-center">อำเภอ</th>
            <th style="width:4% !important;" class="text-center">ปีที่ได้รับงบประมาณเป็นครั้งแรก</th>
            <!--<th style="width:4% !important;" class="text-center">จำนวนครั้งที่ได้รับงบประมาณ</th>-->
            <th style="width:4% !important;" class="text-center">จำนวนกิจกรรมปีปัจจุบัน</th>
            <th style="width:4% !important;" class="text-center">จำนวนโรงเรียน</th>
            <!--<th style="width:10% !important;" class="text-center">ผลการตรวจมาตรฐาน/ตัวชี้วัด(คะแนน)</th>-->
            <th style="width:1% !important;" class="text-center">&nbsp;</th>
        </tr>
      </thead>
      <tbody>

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
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->
