
    <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(55); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style="width:114px; margin-left: 0px; background-color: #e8152b; border: 0;font-size: 16px; padding: 4px 0 4px 0;" 
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('prepare/quiz_info');?>" 
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>

    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>
<!--     <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
    <i class="fa fa-filter" aria-hidden="true"></i> </a> -->

    <?php
      $tmp = $this->admin_model->getOnce_Application(55); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" 
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('report/excel');?>" 
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>

    <!--
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
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
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/prepare_list_filter.php');
?>
  <div class="table">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;" class="text-center">#</th>
            <th style="width:10% !important;" class="text-center">หัวข้อแบบทดสอบ</th>
            <th style="width:10% !important;" class="text-center">หน่วยงานดำเนินการ</th>
            <th style="width:10% !important;" class="text-center">วันที่สร้าง</th>
            <th style="width:1% !important;" class="text-center">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $number = 1;

      foreach ($prep_dkm_exr as $key => $value) { ?>
        <tr>
            <td class="lnk"><?php echo $number;?></td>
            <td class="lnk"><?php echo $value['qstn_msg'];?></td>
            <?php $org =  $this->common_model->get_where_custom('usrm_org','org_id',$value['dkm_id']); ?>
            <td class="lnk"><?php echo $org[0]['org_title']; ?></td>
              
  
            <td class="lnk"><?php echo " ".dateChange($value['start_date'],5)." - ".dateChange($value['end_date'],5); ?></td>
     <!--        <td class="lnk"><?php echo count($this->common_model->get_where_custom('prep_trn_trainee','trn_id',$value['trn_id'])); ?></td> -->
  <!--           <td class="lnk"><?php echo ''; ?></td> -->

           <td>
            <center><!-- Single button -->
                <div class="btn-group" style="cursor: pointer;">
                    <i data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>

                    <ul class="dropdown-menu" style="position: absolute;left: -190px;"> 
                      <li>
                        <a style="font-size:16px;" data-toggle="modal" data-target="#prt" title="พิมพ์แบบฟอร์ม">
                         <i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> พิมพ์แบบฟอร์ม (.PDF)
                     </a>
                   </li>
                     <li><a style="font-size:16px;" href="<?php echo site_url('prepare/quiz_info/Edit/'.@$value['dkm_id'].'-'.@$value['qstn_seq']);?>"> 
                      <i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ</a>
                     </li>
                     <li><a style="font-size:16px;" data-id="<?php  echo $value['qstn_seq']?>" onclick="opn(this)" title="ลบ">
                               <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                            </a>
                    </li>
                    </ul>
                  </div><!-- Print Modal -->
                   <div class="modal fade" id="prt" role="dialog">
                     <div class="modal-dialog">

                        <!-- Modal content-->
                       <div class="modal-content">
                         <div class="modal-header text-left">
                           <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
                          </div>
                         <div class="modal-body">
                           <div class="row"><div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;">
                                 <a style="color: #333; font-size: 16px;" target="_blank" href="/report/D1/pdf?id=514"><i class="fa fa-print" aria-hidden="true"></i> บ้านของผู้สูงอายุ ส่งออกไฟล์ แบบสอบถามความต้องการฯ (D1) (PDF)  </a>
                             </div><div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"><a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="/report/D2/pdf?id=514"><i class="fa fa-print" aria-hidden="true"></i> บ้านของผู้สูงอายุ ส่งออกไฟล์ หนังสือให้ความยินยอมฯ (D2) (PDF)
                            </a>
                          </div>
                           </div>
                           <br>

                        </div>
                      </div>

                    </div>
                   </div>
            <!-- End Print Modal -->
          </center>
          </td>

            
        </tr>
      <?php $number++; } ?>
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
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('034');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="dltbtnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->

