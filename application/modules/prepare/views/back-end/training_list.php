
    <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(56); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style="width:114px; margin-left: 0px; background-color: #e8152b; border: 0;font-size: 16px; padding: 4px 0 4px 0;" 
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('prepare/training_info');?>" 
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

<!--     <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i class="fa fa-area-chart" aria-hidden="true"></i> </a> -->

 <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>
    
    <?php
      $tmp = $this->admin_model->getOnce_Application(56); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
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
    //summary

    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/training_list_filter.php');
  ?>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" >
      <thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
        <tr>
            <th>#</th>
            <th>วันที่จัดอบรม</th>
            <th>หัวข้อการจัดอบรม</th>
            <th>หน่วยงานดำเนินการ</th>
            <th>ผู้เข้าร่วม (ราย)</th>
            <th>สถานะ</th>
            <th>&nbsp;</th>
        </tr>
			</thead>
      <tbody>
      <?php
      $number = 1;
      foreach ($prep_trn_info as $key => $value) { ?>
        <tr>
            <td class="lnk"><?php echo $number;?></td>
            <td class="lnk"><?php echo dateChange($value['start_date'],5);?></td>
            <td class="lnk">
              <?php echo $value['trn_title']; if($value['budget_year'] != '' && $value['budget_year'] != '0000'){ echo " (ปีงบประมาณ {$value['budget_year']})";} ?>
              <br>
              <?php echo "สถานที่: {$value['trn_place']}"; ?>
              <br>
              <?php echo "วันและเวลา: ".dateChange($value['start_date'],5)." - ".dateChange($value['end_date'],5); ?>
            </td>
            <td class="lnk"><?php echo $value['trn_org']; ?></td>
            <td class="lnk"><?php echo count($this->common_model->get_where_custom('prep_trn_trainee','trn_id',$value['trn_id'])); ?></td>
            <td class="lnk"><?php echo 'เผยแพร่'; ?></td>

            <td><center><!-- Single button -->
                <div class="btn-group" style="cursor: pointer;">
                  <i data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>

                  <ul class="dropdown-menu" style="position: absolute;left: -190px;"> 
                    <li>

                      <a style="font-size:16px;" data-toggle="modal" data-target="#prt<?php echo @$value['pid'];?>" title="พิมพ์แบบฟอร์ม">
                       <i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> พิมพ์แบบฟอร์ม (.PDF)
                   </a>
                 </li>
                   <li><a style="font-size:16px;" href="<?php echo site_url('prepare/training_info/Edit/'.@$value['trn_id']);?>">
                    <i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ</a>
                   </li>
                   <li>
                          <?php
                    $tmp = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                    if(isset($tmp['perm_status'])) {
                        if($tmp['perm_status']=='Yes') {
                   ?>
                   <a style="font-size:16px;" data-id="<?php  echo $value['trn_id']?>" onclick="opn(this)" title="ลบ">
                                 <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                              </a>

                    <?php }
                    }
                ?>
                  </li>
                  </ul>
                              </div><!-- Print Modal -->
 <!-- Print Modal -->
              <div class="modal fade" id="prt<?php echo @$value['pid'];?>" role="dialog">
                <div class="modal-dialog">

                   <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header text-left">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title" style="color: #333; font-size: 15px;">พิมพ์แบบฟอร์ม</h4>
                     </div>
                    <div class="modal-body">
                      <div class="row">
                        <?php
                        $tmp = $this->admin_model->getOnce_Application(7);
                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(7,get_session('user_id')); //Check User Permission
                        ?>
                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                        <?php
                        if(!isset($tmp1['perm_status'])) { ?>
                            class="disabled"
                        <?php
                          }else if($usrpm['app_id']==7) {
                        ?>
                            class="active"
                        <?php
                          }
                        ?>
                         >
                          <a style="color: #333; font-size: 15px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                          </a>
                        </div>

                        <?php
                        $tmp = $this->admin_model->getOnce_Application(8);
                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(8,get_session('user_id')); //Check User Permission
                        ?>
                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                        <?php
                        if(!isset($tmp1['perm_status'])) { ?>
                            class="disabled"
                        <?php
                          }else if($usrpm['app_id']==8) {
                        ?>
                            class="active"
                        <?php
                          }
                        ?>
                         >
                          <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                          </a>
                        </div>

                        <?php
                        $tmp = $this->admin_model->getOnce_Application(9);
                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(9,get_session('user_id')); //Check User Permission
                        ?>
                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                        <?php
                        if(!isset($tmp1['perm_status'])) { ?>
                            class="disabled"
                        <?php
                          }else if($usrpm['app_id']==9) {
                        ?>
                            class="active"
                        <?php
                          }
                        ?>
                         >
                          <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                          </a>
                        </div>

                        <?php
                        $tmp = $this->admin_model->getOnce_Application(10);
                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(10,get_session('user_id')); //Check User Permission
                        ?>
                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                        <?php
                        if(!isset($tmp1['perm_status'])) { ?>
                            class="disabled"
                        <?php
                          }else if($usrpm['app_id']==10) {
                        ?>
                            class="active"
                        <?php
                          }
                        ?>
                         >
                          <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                          </a>
                        </div>

                       </div>
                       <br />

                    </div>
                  </div>

                </div>
               </div>
               <!-- End Print Modal -->

                   <!-- End Print Modal --></center></td>


          
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
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->


