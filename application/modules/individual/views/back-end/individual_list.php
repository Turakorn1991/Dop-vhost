
<script>
  var dtable_url = '<?php echo site_url('individual/individual_list_ajax');?>';
  var csrf_hash='<?php echo @$csrf['hash'];?>';
</script>

   <div id="tmp_menu" hidden='hidden'>
    <!-- <?php
      $tmp = $this->admin_model->getOnce_Application(72);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(72,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('individual/individual_info');?>"
    <?php }?> title="บันทึก <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a> -->

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>

    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" id="filter" href="javascript:showFilter();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>


    <?php
      $tmp = $this->admin_model->getOnce_Application(73);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(73,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/J0/xls');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>

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
    }
    function showFilter(){
      $("#chart_display").hide();
    }
  </script>

  <?php
    //summary
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/individual_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/individual_list_filter.php');
  ?>

<div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
		<thead style="font-size: 15px;">
			<tr>
				<th style="text-align: center; width:2% !important;">#</th>
				<th style=" width:18% !important;">เลขประจำตัว ปชช.</th>
				<th style=" width:20% !important;">(คำนำหน้า)ชื่อตัว-ชื่อสกุล </th>
				<th style="text-align: center; width:7% !important;">อายุ (ปี)</th>
				<th style="text-align: center; width:30% !important;">ที่อยู่ (ปัจจุบัน)</th>
				<th style="width:15% !important;">ผลการประเมิน</th>
				<th style="width:2% !important;">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>
