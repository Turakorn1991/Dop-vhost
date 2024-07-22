            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(3); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1/Edit/'.$diff_info['diff_id']);?>" <?php }?> style="border: 1px #eee solid;background-color: #fff; color: #333; padding-left: 30px; padding-right: 30px; font-size: 14px;" <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }?>> (1) แจ้งเรื่อง</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(4); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(4,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form2/Edit/'.$diff_info['diff_id']);?>" <?php }?> style="border: 1px #eee solid;background-color: #fff; color: #333; padding-left: 30px; padding-right: 30px; font-size: 14px;" <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }?>>(2) ตรวจเยี่ยม</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(5); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(5,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form3/Edit/'.$diff_info['diff_id']);?>" <?php }?> style="border: 1px #eee solid;background-color: #3D5263; color: #fff; padding-left: 30px; padding-right: 30px; font-size: 14px;" data-toggle="tab" href="#tab-3" <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) สงเคราะห์</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-1</strong>                          
                                </div>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==4){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-2</strong>
                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==5){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d">ระบบฐานข้อมูลยากลำบาก</h2>
                                            <div class="col-lg-12 text-right  border-bottom">

                                                  <a data-toggle="modal" data-target="#myPrint" style="color: #000; padding-left: 20px; padding-right: 20px;" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                      <i class="fa fa-file-text" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(3); 
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(3); 
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }else{?> href="<?php echo site_url('difficult/assist_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(3); 
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id=111 onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ลบข้อมูล" class="btn btn-default">
                                                      <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                  </a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                    <?php
                                    $diff_id = '';

                                    if($process_action=='Add')$process_action = 'Added';
                                    if($process_action=='Edit'){$process_action = 'Edited'; $diff_id = '/'.$diff_info['diff_id'];}

                                    echo form_open_multipart('difficult/sufferer_form3/'.$process_action.$diff_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                                    <p class="text-danger"><font color=red><?php echo validation_errors();?></font></p>

                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0;">
                                              <!-- <div class="panel-heading"><h4>ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) (<label><input type="checkbox" name=""> บุคคลเดียวกับผู้ยื่นคำขอ</label>) <button class="btn btn-default" style="float: right;">ข้อมูลบูรณาการ</button></h4></div> -->
                                              <div class="panel-body" style="border: 0;padding: 20px;">
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3">
                                                          <label for="datetimepicker1" class="col-2 col-form-label">วันที่รับเงิน <font color="red">*</font></label>
                                                          <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                              <input title="วันที่รับเงิน" placeholder="เลือกวันที่" class="form-control" type="text" name="diff_info[date_of_pay]" value="<?php echo $diff_info['date_of_pay']; ?>" required/>
                                                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                          </div>                      
                                                          <script type="text/javascript">
                                                              $("#datetimepicker1").datepicker({ 
                                                                  autoclose: true, 
                                                                  todayHighlight: true
                                                              });
                                                          </script>
                                                      </div>
                                                      <div class="col-xs-12 col-sm-3">
                                                        <label for="datetimepicker2" class="col-2 col-form-label">วันที่ออกใบสำคัญรับเงิน <font color="red">*</font></label>
                                              <div id="datetimepicker2" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                  <input title="วันที่ออกใบสำคัญรับเงิน" placeholder="เลือกวันที่" class="form-control" type="text" name="diff_info[date_of_receipt]" value="<?php echo $diff_info['date_of_receipt']; ?>" required/>
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                              </div>                    
                                                <script type="text/javascript">
                                                $("#datetimepicker2").datepicker({ 
                                                    autoclose: true, 
                                                    todayHighlight: true
                                                });
                                                </script>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                          <label for="" class="col-2 col-form-label">จำนวนเงินที่สงเคราะห์ (บาท) <font color="red">*</font></label>
                                                          <input title="ระบุ" placeholder="ระบุ" class="form-control numberonly" type="text" name="diff_info[pay_amount]" value="<?php echo $diff_info['pay_amount']; ?>"/>                       
                                                      </div>

                                                      <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">ผู้รับเงิน <font color="red">*</font></label><br>
                                                          <label><input type="radio" name="diff_info[payee_type]" value="รับด้วยตนเอง" <?php if($diff_info['payee_type'] == "รับด้วยตนเอง") { echo "checked";} ?>> รับด้วยตนเอง</label>                   
                                                          <label><input type="radio" name="diff_info[payee_type]" value="ผู้รับมอบอำนวจ" <?php if($diff_info['payee_type'] == "ผู้รับมอบอำนวจ") { echo "checked";} ?>> ผู้รับมอบอำนวจ</label>                 
                                                    </div>
                                                  </div>

                                              </div>
                                          </div>
                                      </div>

                                    <?php
                                    echo form_close();
                                    ?>

                                    </div>

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

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
        <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->

<!-- Confirm Save Form  Modal -->
<div id="dltCnfrm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('054');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="savbtnYes" type="button" class="btn btn-success">ตกลง</button>
        <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Confirm Save Form  Modal -->

<!-- Confirm Back Modal -->
<div id="bckCnfrm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('061');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="bckbtnYes" type="button" class="btn btn-warning">ตกลง</button>
        <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Confirm Back Modal -->

<!-- Print Modal -->
<div class="modal fade" id="myPrint" role="dialog">
  <div class="modal-dialog">
    
     <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" style="color: #333; font-size: 15px;">พิมพ์แบบฟอร์ม</h4>
       </div>
      <div class="modal-body">
        <div class="row">         
          <?php
          $tmp = $this->admin_model->getOnce_Application(7);   
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(7,get_session('user_id')); //Check User Permission
          ?>      
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" 
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
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" 
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
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" 
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
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" 
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
         <br/>

      </div>
    </div>
      
  </div>
 </div>
 <!-- End Print Modal -->
