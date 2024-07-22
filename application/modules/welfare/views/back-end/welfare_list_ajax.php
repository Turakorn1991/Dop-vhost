<script>
  var dtable_url = '<?php echo site_url('welfare/welfare_list_ajax');?>';
  var export_url = '<?php echo site_url('report/B0/xls');?>';
  var csrf_hash='<?php echo @$csrf['hash'];?>';
</script>

     <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(13);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('welfare/inform1');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" href="javascript:showChart();"><i class="fa fa-area-chart" style='font-size:14px;' aria-hidden="true"></i> ภาพรวม</a>


    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" href="javascript:showFilter();" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fa fa-search" style='font-size:14px;' aria-hidden="true"></i> ค้นหา</a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(16);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(16,$user_id); //Check User Permission
    ?>
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" data-toggle="modal" data-target="#excel"
     title="<?php echo $filter_result[0] ?>"><i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>   

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
      window.open('/assets/modules/welfare/guide/Adm_Manual.pdf', '_blank');
    });
  </script>

  <?php
    //summary
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/welfare_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/welfare_list_filter.php');
  ?>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
      <thead style="font-size: 15px;">
      <tr>
      <th style="width:2% !important;" rowspan="2" class="text-center">#</th>
          <th style="width:12% !important;" rowspan="2" class="text-center">เลขประจำตัว ปชช.</th>
          <th style="width:15% !important;" rowspan="2" class="text-center">(คำนำหน้า) ชื่อตัว-ชื่อสกุล</th>
          <th rowspan="2">เพศ</th>
          <th style="width:4% !important;" rowspan="2" class="text-center">อายุ (ปี)</th>  
          <th style="width:10% !important;" rowspan="2" class="text-center">แจ้งความประสงค์</th>
          <th style="width:10% !important;" rowspan="2" class="text-center">รับเข้า (วัน)</th>
          <th style="width:10% !important;" rowspan="2" class="text-center">จำหน่าย</th>
          <th colspan="2" class="text-center">ผลการประเมินสมรรถนะรายบุคคล</th>
          <th style="width:10% !important;" rowspan="2" class="text-center">ช่องทางการแจ้งเรื่อง</th>
          <th style="width:10% !important;" rowspan="2" class="text-center">ศูนย์ที่รับเข้า<br>(จังหวัด)</th>
          <th style="width:1% !important;" rowspan="2" >&nbsp;</th>
         
      </tr>
      <tr>
          <th style="width:10% !important;border-top-color: #2f4050;" class="text-center">วันที่</th>
          <th style="width:10% !important;border-top-color: #2f4050;"  class="text-center">ผล (ล่าสุด)</th>
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
	    <!-- Excel Modal -->
        <!-- Modal -->
        <div class="modal fade" id="excel" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header text-left">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #333; font-size: 16px;">ส่งออกไฟล์</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;">
                    <?php
                      $tmp = $this->admin_model->getOnce_Application(16);
                      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(16,$user_id); //Check User Permission
                    // $filter_result = get_session('filter_diff_id');
                    ?>
                        <a style="color: #333; font-size: 16px;" class="navbar"  
                        <?php if(!isset($tmp1['perm_status'])) {?>
                        readonly
                        <?php }else{?> href="#" onclick="exportExcel();" <?php }?> title="ตารางแสดงสถิติผู้รับบริการในศูนย์พัฒนาการจัดสวัสดิการผู้สูงอายุ" >
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> ตารางแสดงสถิติผู้รับบริการในศูนย์พัฒนาการจัดสวัสดิการผู้สูงอายุ
                        </a>
                    </div>   
  
                  </div>     <!-- End row -->                   
              </div>     <!-- End body --> 
             
            </div>
            
          </div>
        </div>
     
      <!-- End Excel Modal -->
