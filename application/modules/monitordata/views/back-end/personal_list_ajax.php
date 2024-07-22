<script>
  var dtable_url = '<?php echo site_url('monitordata/assist_list_ajax');?>';
  var csrf_hash='<?php echo @$csrf['hash'];?>';
</script>

   <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(3);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style="width:114px; margin-left: 0px; background-color: #e8152b; border: 0;font-size: 16px; padding: 4px 0 4px 0;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>"><i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>

    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" type="button" id="filter" href="javascript:showFilter();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(6);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/A0/xls');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>"><i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>

  </div>
  <div class="table-responsive">
    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;">
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;">#</th>
            <th style="width:12% !important;">เลขประจำตัว ปชช.</th>
            <th style="width:38% !important;">ชื่อตัว-ชื่อสกุล</th>
            <th >เพศ</th>
            <th style="width:7% !important;">วัน เดือน ปีเกิด</th>
            <th style="width:10% !important;">แจ้งเรื่อง</th>
            <th style="width:10% !important;">ตรวจเยี่ยม</th>
            <th style="width:1% !important;">&nbsp;</th>
        </tr>
			</thead>
      <tbody>

      </tbody>
		</table>

  </div>
