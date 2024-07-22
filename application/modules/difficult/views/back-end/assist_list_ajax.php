<script>
  var dtable_url = '<?php echo site_url('difficult/assist_list_ajax');?>';
  var export_url = '<?php echo site_url('report/A0/xls');?>';
  var export_url_ktb = '<?php echo site_url('report/A0_ktb/xls');?>';
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
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>

    <!-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch"><i class="fa fa-filter" aria-hidden="true"></i> </a> -->

    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" type="button" id="filter" href="javascript:showFilter();" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>


    <?php
      $tmp = $this->admin_model->getOnce_Application(6);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
     // $filter_result = get_session('filter_diff_id');
    ?>
     <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" data-toggle="modal" data-target="#excel"
     title="ส่งออกไฟล์"><i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>   
        
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
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/assist_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/assist_list_filter.php');
  ?>


  <div class="table-responsive">
    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;">
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;">#</th>
            <th style="width:12% !important;">เลขประจำตัว ปชช.</th>
            <th style="width:38% !important;">ชื่อตัว-ชื่อสกุล</th>
            <th >เพศ</th>
            <th style="width:7% !important;">อายุ (ปี)</th>
            <th style="width:10% !important;">แจ้งเรื่อง</th>
            <th style="width:10% !important;">ตรวจเยี่ยม</th>
            <th style="width:10% !important;">การช่วยเหลือ</th>
            <th style="width:10% !important;">ช่องทางการแจ้งเรื่อง</th>
            <th style="width:10% !important;">หน่วยงาน</th>
            <th style="width:10% !important;">จำนวน (บาท)</th>
            <th style="width:1% !important;">&nbsp;</th>
            <th></th>
            
            
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
                      $tmp = $this->admin_model->getOnce_Application(6);
                      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
                    // $filter_result = get_session('filter_diff_id');
                    ?>
                        <a style="color: #333; font-size: 16px;" class="navbar"  
                        <?php if(!isset($tmp1['perm_status'])) {?>
                        readonly
                        <?php }else{?> href="#" onclick="exportExcel(0);" <?php }?> title="แบบรายงานผลการดำเนินงานตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์มาตรา 11(8) (9) (10)" >
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> แบบรายงานผลการดำเนินงานตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์มาตรา 11(8) (9) (10)
                        </a>
                    </div>   
                    <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;">
                        <a style="color: #333; font-size: 16px;" class="navbar"  
                        <?php if(!isset($tmp1['perm_status'])) {?>
                        readonly
                        <?php }else{?> href="#" onclick="exportExcel(1);" <?php }?> title="แบบรายงานตามรูปแบบ KTB corporate online" >
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> แบบรายงานตามรูปแบบ KTB corporate online
                        </a>
                    </div>       
                  </div>     <!-- End row -->                   
              </div>     <!-- End body --> 
             
            </div>
            
          </div>
        </div>
     
      <!-- End Excel Modal -->
