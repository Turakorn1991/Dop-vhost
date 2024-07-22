<script>
  var dtable_url = '<?php echo site_url('volunteer/volunteer_list_ajax');?>';
  var csrf_hash='<?php echo @$csrf['hash'];?>';
  var filter_where = <?php echo json_encode($filter_where);?>;
</script>

   <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(52);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('volunteer/info/create');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>


    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" type="button" href="javascript:showFilter();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(146);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(146,$user_id); //Check User Permission
    ?>
    <a id='getExcel' title="<?=$tmp['app_name']?>"
      class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export"
      style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php echo !isset($tmp1['perm_status']) ? "readonly" : "target=\"_blank\"";?>
    >
      <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์
    </a>
    <script>
    $(function() {
      $('#getExcel').click(function() {
        var data = $('#voltFilterBox')
          .trigger('generate_filterOptions')
          .data('filter_options');
        delete data.csrf_dop;

        data = $.map(data, function(val, key) {
          if(key == 'pid'){
            return key + '=' + val.replace(new RegExp('-', 'g'), '');
          }else{
            return key + '=' + val;

          }
        }).join('&');
        $(this).attr('href', "<?php echo site_url('report/F0/xls');?>" + '?' + data);
      });
    });
    </script>
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
    $("#guide-book").click(function(){
      window.open('/assets/modules/volunteer/guide/Vol_Manual.pdf', '_blank');
    }); 
  </script>



  <?php
    //summary
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/volunteer_info_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/volunteer_info_filter.php');
  ?>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important;">
      <thead style="font-size: 15px;">
        <tr>
            <th class="text-center">ลำดับ</th>
            <th class="text-center">เลขประจำตัว ปชช.</th>
            <th class="text-center">ชื่อตัว-ชื่อสกุล</th>
            <th class="text-center">อายุ (ปี)</th>
            <th class="text-center">วันที่ขึ้นทะเบียน</th>
            <th class="text-center">เบอร์โทรศัพท์<br>(ที่ติดต่อได้)</th>
            <th class="text-center">พื้นที่ดำเนินการ</th>
            <th class="text-center">สถานะ</th>
            <th class="text-center">ดูแลผู้สูงอายุ (คน)</th>
            <th>&nbsp;</th>
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
