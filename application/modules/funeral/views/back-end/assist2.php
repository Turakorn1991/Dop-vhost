<div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                          <li >
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(22);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(22,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('funeral/inform1/Edit/'.$fnrl_info['fnrl_id']);?>" <?php }?> <?php if($usrpm['app_id']==22){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) แจ้งเรื่อง</a>
                          </li>

                          <li class="active">
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(23);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(23,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('funeral/assist2/Edit/'.$fnrl_info['fnrl_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==23){?>aria-expanded="true" <?php }?>>(2) สงเคราะห์</a>
                          </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==22){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <strong>Tab-1</strong>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==23){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                    <!--
                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d"></h2>
                                            <div class="col-lg-12 text-right  border-bottom">

                                                  <a data-toggle="modal" data-target="#myPrint" style="color: #000; padding-left: 20px; padding-right: 20px;" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                      <i class="fa fa-file-text" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(23);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(23,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(23);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(23,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('funeral/inform1');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(23);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(23,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id='<?php echo $fnrl_info['fnrl_id'];?>' onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ลบข้อมูล" class="btn btn-default">
                                                      <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                  </a>

                                            </div>
                                        </div>
                                    </div>
                                    -->

                                       <div id="tmp_menu" hidden='hidden'>
                                       <!--
                                        <?php
                                         if($process_action=='Edit') {
                                        ?>
                                          <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#myPrint">
                                          <i class="fa fa-file-text" aria-hidden="true"></i> </a>
                                        <?php }?>

                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(6);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
                                        ?>
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                        <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?> onclick="return opnCnfrom()"
                                        <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> </a>
                                        -->
                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(6);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
                                        ?>

                                        <!--
                                        <?php
                                         if($process_action=='Edit') {
                                          $tmp = $this->admin_model->getOnce_Application(6);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
                                        ?>
                                        <a data-id=<?php echo $fnrl_info['fnrl_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                        <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?>
                                        <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                        <?php } ?>

                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                        -->
                                    </div>
                                    <script>
                                      setTimeout(function(){
                                        $("#menu_topright").html($("#tmp_menu").html());
                                      },300);
                                    </script>

                                    <div class="form-group row">

                                    <?php
                                    $fnrl_id = '';

                                    if($process_action=='Add')$process_action = 'Added';
                                    if($process_action=='Edit'){$process_action = 'Edited'; $fnrl_id = '/'.@$fnrl_info['fnrl_id'];}

                                    echo form_open_multipart('funeral/assist2/'.$process_action.$fnrl_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                                    <input value="false" name="sms" hidden="hidden">

                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <div class="panel-group" style="margin-bottom: 0px;">
                                          <div class="panel panel-default" style="border: 0;">
                                              <div class="panel-heading"><h4>ข้อมูลการสงเคราะห์ </div>
                                              <div class="panel-body" style="border: 0;padding: 20px;">
                                                  <div class="form-group row">
                                                   <div class="col-xs-12 col-sm-12">
                                                          <label for="datetimepicker1" class="col-2 col-form-label" style="color:red;">ผลการพิจารณาอนุมัติเงินช่วยเหลือ </label>    
                                                    </div>
                                                  </div><!--end from group row-->
                                                  <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-3"> 
                                                    <div class="checkbox-inline i-checks"><label><input type="radio" id="confirm" name="fnrl_info[cond_status]" value="อนุมัติ" <?php if($fnrl_info['cond_status'] == "อนุมัติ") { echo "checked";} ?> required> อนุมัติ</label></div>
                                                  </div>
                                                </div><!--end from group row-->
                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-3">
                                                     <div class="checkbox-inline i-checks"><label><input  type="radio" id="refuse" name="fnrl_info[cond_status]" value="ปฎิเสธ" <?php if($fnrl_info['cond_status'] == "ปฎิเสธ") { echo "checked";} ?> required> ปฎิเสธ</label></div>
                                                   </div>
                                                     <div class="col-xs-12 col-sm-6"><input type="text" id="refuse_resason" disabled="disabled" placeholder="ระบุ" onkeyup="numberandth(this)" class="form-control" name="fnrl_info[cond_remark]" value="<?php echo $fnrl_info['cond_remark']; ?>"></div>
                                                </div><!--end from group row-->
                                                <script type="text/javascript">
                                                  $("input[name='fnrl_info[cond_status]").on('ifChanged',function(){    
                                                    if($('#refuse').prop('checked')){
                                                        $("#refuse_resason").prop('disabled', false ).focus();
                                                        // $("#date_of_pay").prop('required', false );
                                                        // $("#pay_amount").prop('required', false );
                                                       
                                                    }else{
                                                        $("#refuse_resason").val('');
                                                        $("#refuse_resason").prop('disabled', true );
                                                        // $("#date_of_pay").prop('required', true );
                                                        // $("#pay_amount").prop('required', true );
                                                      
                                                    }
                                                  });
                                                  
                                              
                                                </script>
                                                
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-4">
                                                        <label for="datetimepicker1" class="col-2 col-form-label">วันที่รับเงิน </label>
                                                        <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                            <input title="วันที่รับเงิน" placeholder="เลือกวันที่" class="form-control" id="date_of_pay" type="text" name="fnrl_info[date_of_pay]" />
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div><!--close datetimepicker-->
                                                          <script type="text/javascript">
                                                          <?php
                                                          $tmp = explode('-',@$fnrl_info['date_of_pay']);
                                                          ?>
                                                          $(function () {
                                                          $("#datetimepicker1").datepicker({
                                                            autoclose: true,
                                                            todayHighlight: true,
                                                            format: 'dd/mm/yyyy',
                                                             todayBtn: true,
                                                             language: 'th',
                                                             thaiyear: true
                                                          })<?php if(count($tmp)==3){?>.datepicker('update', new Date(Date.UTC(<?php echo $tmp[2];?>,<?php echo $tmp[1];?>-1,<?php echo $tmp[0];?>)));<?php }?>
                                                          });
                                                          </script>
                                                    </div><!--close col-sm-3-->

                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">จำนวนเงินที่สงเคราะห์ (บาท) </label>
                                                              <input title="ระบุ" placeholder="ระบุจำนวนเงิน (บาท)" class="form-control" onkeyup="numberndot(this)" type="text" id="pay_amount" name="fnrl_info[pay_amount]" value="<?php echo @$fnrl_info['pay_amount']; ?>"  />
                                                          </div><!--close sm-3-->
                                                          
                                                  </div><!--close row-->
                                                  <div class="form-group row">
                                                          <div class="col-xs-12 col-sm-4 ">
                                                              <label for="" class="col-2 col-form-label">ผู้รับเงิน </label><br>
                                                              <div style="margin-top: 6px;">
                                                                  <div class="checkbox-inline i-checks"><label><input type="radio" name="fnrl_info[payee_type]" value="ผู้สูงอายุ" <?php if(@$fnrl_info['payee_type'] == "ผู้สูงอายุ") { echo "checked";} ?> > ผู้สูงอายุ</label></div>
                                                                  <div class="checkbox-inline i-checks"><label><input type="radio" name="fnrl_info[payee_type]" value="ผู้แจ้งเรื่อง" <?php if(@$fnrl_info['payee_type'] == 'ผู้แจ้งเรื่อง') { echo "checked"; } ?>> ผู้แจ้งเรื่อง</label></div>
                                                                  <div class="checkbox-inline i-checks"><label><input type="radio" name="fnrl_info[payee_type]" value="ผู้รับมอบอำนาจ" <?php if(@$fnrl_info['payee_type'] == 'ผู้รับมอบอำนาจ') { echo "checked"; } ?>> ผู้รับมอบอำนาจ</label></div>

                                                              </div><!-- close margin-top-->
                                                          </div><!-- close col-sm-4 -->
                                                          <div class="col-xs-12 col-sm-6">
                                                              <label for="" class="col-2 col-form-label">การรับเงิน </label><br>
                                                              <div class="checkbox-inline i-checks"><label><input type="radio" name="fnrl_info[pay_channel]" value="เงินสด" <?php if($fnrl_info['pay_channel'] == "เงินสด") { echo "checked";} ?> > เงินสด</label></div>
                                                              <div class="checkbox-inline i-checks"><label><input type="radio" name="fnrl_info[pay_channel]" value="เช็คเงินสด" <?php if($fnrl_info['pay_channel'] == "เช็คเงินสด") { echo "checked";} ?> > เช็คเงินสด</label></div>
                                                              <div class="checkbox-inline i-checks"><label><input type="radio" name="fnrl_info[pay_channel]" value="KTB Online" <?php if($fnrl_info['pay_channel'] == "KTB Online") { echo "checked";} ?> > KTB Online</label></div>
                                                          </div><!--close การรับเงิน-->
                                                  <div><!--close row-->


                                              </div>
                                          </div>
                                      </div>

                                      <?php
                                      echo form_close();
                                      ?>

                                    </div>


                                    <hr style="margin-top: 0px;">
                                    <div class="row">
                                     <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                     <div class="col-xs-12 col-sm-2">
                                      <!-- <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button> -->
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" ><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('funeral/inform1/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                    </div>
                                  </div><!-- close class row-->

                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

            <script type="text/javascript">
              $(document).ready(function () {
                $('.i-checks').iCheck({
                  checkboxClass: 'icheckbox_square-green',
                  radioClass: 'iradio_square-green',
                  increaseArea: '20%'
                });
              });
            </script>

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
        <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->

<!-- Modal sms -->
        <!-- Modal -->
        <div id="sms" class="modal fade" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
             <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
             </div>
             
              <div class= "modal-body">
           
                      <div class="modal-title" >ท่านต้องการส่ง SMS แจ้งสถานะคำขอหรือไม่</div>
                  
                 
              </div>     <!-- End body --> 
              <div class="modal-footer">
                      <button  type="button" class="btn btn-success savbtnYes sms"  data-dismiss="modal">ต้องการ</button>
                      <button  type="button" class="btn btn-default savbtnYes"  style="margin-bottom: 5px;"  data-dismiss="modal">ไม่ต้องการ</button>
              </div>           
            </div>
            
          </div>
        </div>
     
      <!-- End sms Modal -->

<!-- Confirm Save Form  Modal -->
<div id="sbmCnfrm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('054');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="savbtnYes" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
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
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
         <h4 class="modal-title" style="color: #333; font-size: 20px;">พิมพ์แบบฟอร์ม</h4>
       </div>
      <div class="modal-body">
        <div class="row">
          <?php
          $tmp = $this->admin_model->getOnce_Application(25);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(25,get_session('user_id')); //Check User Permission
          ?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
              class="disabled"
          <?php
        }else if($usrpm['app_id']==25) {
          ?>
              class="active"
          <?php
            }
          ?>
           >
            <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

          <?php
          $tmp = $this->admin_model->getOnce_Application(26);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(26,get_session('user_id')); //Check User Permission
          ?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
              class="disabled"
          <?php
        }else if($usrpm['app_id']==26) {
          ?>
              class="active"
          <?php
            }
          ?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

          <?php
          $tmp = $this->admin_model->getOnce_Application(27);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(27,get_session('user_id')); //Check User Permission
          ?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
              class="disabled"
          <?php
        }else if($usrpm['app_id']==27) {
          ?>
              class="active"
          <?php
            }
          ?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>



         </div>
         <br/>

      </div>
    </div>

  </div>
 </div>
 <script type="text/javascript">
$(".btn-save").click(function(){ 
 // Befor save
 var ansCheck = false;
 if($("#confirm").is(":checked"))
  {
    if($("[name='fnrl_info[date_of_pay]']").val() == null || $("[name='fnrl_info[date_of_pay]']").val()=='')// วันที่รับเงิน
    {
      toastr.error("โปรดระบุวันที่รับเงิน", "หน้าต่างแจ้งเตือน");
      ansCheck = true;
    }
    if($("[name='fnrl_info[pay_amount]']").val() == null || $("[name='fnrl_info[pay_amount]']").val() == '')// จำนวนเงินที่สงเคราะห์
    {
      toastr.error("โปรดระบุจำนวนเงินที่สงเคราะห์", "หน้าต่างแจ้งเตือน");
      ansCheck = true;
    }
    if(!$("[name='fnrl_info[payee_type]']").is(":checked"))// ผู้รับเงิน
    {
      toastr.error("โปรดระบุผู้รับเงิน", "หน้าต่างแจ้งเตือน");
      ansCheck = true;
    }
    if(!$("[name='fnrl_info[pay_channel]']").is(":checked"))// การรับเงิน
    {
      toastr.error("โปรดระบุการรับเงิน", "หน้าต่างแจ้งเตือน");
      ansCheck = true;
    }
 }
//  else
//  {
//  if ($("[name='fnrl_info[payment_status_reason]']").val() == null || $("[name='fnrl_info[payment_status_reason]']").val() == '')
//  {
//  toastr.error("โปรดระบุเหตุผล", "หน้าต่างแจ้งเตือน");
//       ansCheck = true;
//  }
//  }
 
 if(ansCheck)
 {
 return;
 }
 opnCnfrom();
  // End befor save
 // <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
});
</script>
 <!-- End Print Modal -->
