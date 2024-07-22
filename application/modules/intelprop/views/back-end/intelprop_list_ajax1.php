<script>
  var dtable_url = '<?php echo site_url('intelprop/intelprop_list_ajax1');?>';
  var csrf_hash='<?php echo @$csrf['hash'];?>';
</script>

   <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(46);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(46,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('intelprop/intelprop_info');?>"
    <?php }?> title="เพิ่มรายการ <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>

    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" type="button" id="filter" href="javascript:showFilter();"   data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(48);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(48,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/E0/xls');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>

    <!--
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
    -->
  </div>
  <script>
    setTimeout(function(){
      $("#menu_topright").html($("#tmp_menu").html());
    },300);
    function showChart(){
      $('#collapseExample').removeClass("in");
      $("#chart_display").slideToggle();
      //$(".collapse").hide();
      //$(".collapse").slideToggle();
    }
    function showFilter(){
      $("#chart_display").hide();
    }
  </script>

  <?php
    //summary
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/intelprop_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/intelprop_list_filter.php');
  ?>

<div class="table-responsive">

	<table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;"  >
		<thead style="font-size: 15px;">
			<tr>
        <th style="width:2% !important;text-align: center;"    rowspan="2">#</th>
        <th style="width:23.5% !important;text-align: center;" rowspan="2">โครงการ/กิจกรรม</th>
        <th style="width:12.5% !important;text-align: center;" rowspan="2">(คำนำหน้า)ชื่อตัว-ชื่อสกุล <br> (วิทยากรภูมิปัญญา) </th>
        <th style="width:12.5% !important;text-align: center;" colspan="2">กลุ่มเป้าหมาย (ราย)</th>
        <th style="width:25% !important;text-align: center;"   rowspan="2">พื้นที่ดำเนินการ</th>
        <th style="width:10% !important;text-align: center;"   rowspan="2">วันที่<br>ดำเนินการ</th>
        <th style="width:12.5% !important;text-align: center;" rowspan="2">งบประมาณ<br>(บาท)</th>
        <th style="width:2% !important;" rowspan="2">&nbsp;</th>
      </tr>
      <tr>
        <th style="border-top-color: #2f4050;">ชาย</th>
        <th style="border-top-color: #2f4050;">หญิง</th>
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
					<p><?php echo $str; ?></p>
					<!--<p>ยืนยันการลบ?</p>-->
				</div>
				<div class="modal-footer">
					<button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
					<button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default"       data-dismiss="modal">ยกเลิก</button>
				</div>
			</div>
		</div>
	</div>
	<!-- End Delete Model -->
