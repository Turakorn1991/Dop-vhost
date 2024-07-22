
  <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(52);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('prepare/prepare_info');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>


    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(146);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(146,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/H0/xls?m='.date("m").'&y='.date("Y"));?>"
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
      $("#chart_display").slideToggle();
    }
  </script>
  <?php
    //summary
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/prepare_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/prepare_list_filter.php');
  ?>
   <div class="row">
   <?php $count = 1; foreach ($prep_dkm_info as $i => $value) { ?>
       <?php if($count == 1){  ?>
        <div class="row">
       <?php } ?>
        <div class="col-md-3">
            <div class="ibox">
                <div class="ibox-content product-box" style="border-top: 1px #e7eaec solid !important">

                    <div class="product-imitation" style="height: 210px;overflow: hidden; padding-top: 0px;padding-bottom: 0px;">
                      <img class="img-responsive preview" width="100%" src="<?php echo base_url("assets/modules/prepare/images/{$value['att_tmb_file']}");?>" onerror="imgError($(this),'../assets/modules/prepare/images/default_image.png');">
                      <script type="text/javascript">
                        function imgError(img,default_image){
                          img.attr('src', default_image);
                        }
                      </script>
                    </div>
                    <div class="product-desc">
                        <span class="product-price" style="background-color: #E1E1E1 !important;">
                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                        </span>
                        <!-- <small class="text-muted">Category</small> -->
                        <a data-toggle="modal" data-target="#fileAtt-<?php echo $value['dkm_id'];?>" class="product-name" title="<?php echo $value['dkm_title']; ?>" style="font-size: 20px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;"><?php echo $value['dkm_title']; ?></a>
                        <div class="small m-t-xs" style="text-indent: 10px;font-size: 18px; height: 50px; text-overflow: ellipsis;overflow: hidden;">
                            <?php echo $value['dkm_describe']; ?>
                        </div>
                        <div class="m-t text-righ" style="text-align: right;">
                            <a href="<?php echo site_url("prepare/prepare_info/Edit/{$value['dkm_id']}"); ?>" class="btn btn-xs btn-outline btn-primary" style="width: 40px;"><i class="fa fa-pencil-square" aria-hidden="true"></i> </a>
                            <a href="<?php echo site_url("prepare/prepare_info/Delete/{$value['dkm_id']}"); ?>" class="btn btn-xs btn-outline btn-primary" style="width: 40px;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <?php if($count == 4){ $count = 0;?>
        </div>
       <?php } ?>

        <!-- Modal -->
        <div class="modal fade" id="fileAtt-<?php echo $value['dkm_id'];?>" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">เอกสารแนบ</h4>
              </div>
              <div class="modal-body">
                <ul style="list-style: none;">
                <?php $fileatt = $this->common_model->custom_query("SELECT * FROM prep_dkm_info_file WHERE dkm_id = {$value['dkm_id']}"); ?>
                <?php if(!empty($fileatt)){ ?>
                  <?php foreach ($fileatt as $key => $fRow) {?>
                  <li>
                    <a target="_blank" href="<?php echo site_url("prepare/download/{$fRow['dkm_file_id']}");?>"><i class="fa fa-download" aria-hidden="true"></i> <?php echo $fRow['dkm_file_label']; ?></a>
                  </li>
                  <?php } ?>
                <?php }else{ ?>
                  <li>ไม่พบเอกสารแนบ</li>
                <?php } ?>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
   <?php $count++; } ?>
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
