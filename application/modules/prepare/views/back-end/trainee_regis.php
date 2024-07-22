<?php
set_session('pers_authen',array('authen_log_id'=>1,'pid'=>'1550700081881','cid'=>'k32kjk324j234','random_string'=>'3239663864316539316431313939353933356334663834636130396234353366')); //for Test
?>
<script>
  //Declear Info Reader PID
  var user_id = '<?php echo get_session('user_id');?>';
  var org_id = '<?php echo get_session('org_id');?>';
  var pers_authen = JSON.parse('<?php echo json_encode(get_session('pers_authen'));?>');
  console.log(pers_authen);
  var reader_status = false;
  var authen_log_id = 0;
  //End Declear Info Reader PID
  var csrf_hash='<?php echo @$csrf['hash'];?>';
</script>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                        <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(55); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/training_list/Edit/'.$trn_id);?>" <?php }?>  <?php if($usrpm['app_id']==55){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> การอบรม</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(56); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/trainee_list/Edit/'.$trn_id);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==56){?>aria-expanded="true" <?php }?>> ผุ้เข้าร่วม</a>
                            </li>
                      </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==55){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-1</strong>
                                </div>
                              </div>

                           
                            <div id="tab-2" <?php if($usrpm['app_id']==56){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php } ?>>
                                <div class="panel-body">
<!--                                   <div id="tmp_menu" hidden='hidden'>
                                            
                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(56); 
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
                                            ?>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }else{?> href="<?php echo site_url('prepare/trainee_list/View/'.$trn_id); ?>" 
                                            <?php }?> title="ย้อนกลับ">
                                            <i class="fa fa-caret-left" aria-hidden="true"></i> </a>

                                          </div> -->
                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);
                                          </script>

                                  <div class="form-group row">

                                      <?php
                                      $dkm_id = '';
                                      $trainee = '';
                                      if($process_action=='Add'){$process_action = 'Added';$dkm_id = '/'.$trn_id;
                                      
                                      }

                                      if($process_action=='Edit'){$process_action = 'Edited'; $dkm_id = '/'.$trn_id;  $trainee = '/'.$trainee_id;}

                                      echo form_open_multipart('prepare/trainee_regis/'.$process_action.$dkm_id.$trainee,array('id'=>'form1'));
                                      ?>

                                      <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                      <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                      <p class="text-danger"><font color=red><?php echo validation_errors();?></font></p>
                                    <div class="panel-group">
                                      <div class="panel panel-default" style="border: 0">
                                        <!-- <div class="panel-heading">
                                          <h4>ข้อมูลผู้สูงอายุ <label>&nbsp;</label></h4>
                                        </div> -->

                                        <div class="panel-body" style="border:0; padding: 20px;">
                                          <div class="form-group row ">
                                            <div class="col-xs-12 col-sm-3 has-error">
                                              <label class="col-2 control-label">เลขประจำตัวประชาชน</label>
                                              <input style="width: 70%;display: inline-block;" id="pid" title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text" value="<?php echo @$pers_info['pid']; ?>" />
                                              <input type="hidden" id="pers_id" name="prep_trn_trainee[pers_id]" value="<?php echo $prep_trn_trainee['pers_id']; ?>">
                                              <button style="display: inline-block;" title="ตรวจสอบ" class="btn btn-default" id="bt_pid">ตรวจสอบ</button>
                                              <script>
                                                var inputpid = "#pid";
                                                var bt_spid = "#bt_pid";
                                                var setData = "reqData"; //Declear Name 
                                                var reqData = function(value) { //Set Structure Display Data
                                                  console.log(value);
                                                  $("#pers_id").val(value.pers_id);
                                                  $("#pren_code").val(value.pren_code);
                                                  $("#pers_firstname_th").val(value.pers_firstname_th);
                                                  $("#pers_lastname_th").val(value.pers_lastname_th);
                                                  $("#gender_code").val(value.gender_code);
                                                  $("#tel_no_mobile").val(value.tel_no);
                                                  $("#email_addr").val(value.email_addr);
                                                  $("#healthy_congenital_disease").val(value.healthy_congenital_disease);

                                                  // var dob = spi

                                                  $("#date_of_birth").val(value.dob);
                                                }
                                                $(bt_spid).click(function(){//On Click for Search
                                                  if($(inputpid).val()!='') {//pid not null
                                                   
                                                   $(bt_spid).attr('disabled',true);

                                                    if(pers_authen!=null) { //Check Personal Authen
                                                      getPersInfo(inputpid,bt_spid,setData); //Get Data 
                                                    }else if(!reader_status) { //Run Reader Personal
                                                      run_readerPers();
                                                      $(bt_spid).attr('disabled',false);
                                                      toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                                                    }

                                                  }else { //pid is null
                                                    $(inputpid).select();
                                                  }
                                                });
                                              </script>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 dropdown">
                                              <label for="example-text-input" class="col-2 control-label">คำนำหน้า</label>
                                              <div class="col-10">
                                                <select id="pren_code" name="pers_info[pren_code]" title="คำนำหน้า" placeholder="เลือกคำนำหน้า" class="form-control">
                                                    <option value="">เลือกคำนำหน้า</option>
                                                    <?php $pren = $this->common_model->custom_query("SELECT * FROM std_prename ORDER BY pren_code ASC"); ?>
                                                    <?php foreach ($pren as $key => $row) { ?>
                                                      <option value="<?php echo $row['pren_code']; ?>" <?php if(@$pers_info['pren_code'] == $row['pren_code']){ echo "selected";} ?>><?php echo $row['prename_th']; ?></option>
                                                    <?php } ?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 has-error">
                                              <label class="col-2 control-label">ชื่อตัว</label>
                                              <input id="pers_firstname_th" name="pers_info[pers_firstname_th]" title="ชื่อตัว" placeholder="ระบุชื่อตัว" class="form-control" type="text" value="<?php echo @$pers_info['pers_firstname_th']; ?>" required/>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                              <label class="col-2 control-label">ชื่อสกุล</label>
                                              <input id="pers_lastname_th" name="pers_info[pers_lastname_th]" title="ชื่อสกุล" placeholder="ระบุชื่อสกุล" class="form-control" type="text" value="<?php echo @$pers_info['pers_lastname_th']; ?>"/>
                                            </div>
                                          </div>

                                          <div class="form-group row ">
                                            <div class="col-xs-12 col-sm-3 dropdown">
                                              <label for="example-text-input" class="col-2 control-label">เพศ</label>
                                              <div class="col-10">
                                                <select id="gender_code" name="" title="เพศ" placeholder="เลือกเพศ" class="form-control">
                                                    <option value="">เลือกเพศ</option>
                                                    <option value="0" <?php if(@$pers_info['gender_code'] == 0){ echo "selected";} ?>>ไม่ทราบ (Not Know)</option>
                                                    <option value="1" <?php if(@$pers_info['gender_code'] == 1){ echo "selected";} ?>>ชาย (Male)</option>
                                                    <option value="2" <?php if(@$pers_info['gender_code'] == 2){ echo "selected";} ?>>หญิง (Female)</option>
                                                    <option value="9" <?php if(@$pers_info['gender_code'] == 9){ echo "selected";} ?>>ไม่สามารถระบุได้ (Not Applicable)</option>
                                                </select>
                                              </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3">
                                              <label for="datetimepicker1" class="col-2 col-form-label">วันเดือนปีเกิด</label>
                                              <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                  <input id="date_of_birth" title="วันเดือนปีเกิด" placeholder="เลือกวันเดือนปีเกิด" class="form-control" type="text" name=""/>
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                              </div>                    
                                              <script type="text/javascript">
                                              <?php
                                              $tmp = array();
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
                                            </div>
                                            <div class="col-xs-12 col-sm-3 has-error">
                                              <label class="col-2 control-label">เบอร์โทรศัพท์ (ที่ติดต่อได้)</label>
                                              <input id="tel_no_mobile" name="pers_info[tel_no_mobile]" value="<?php echo @$pers_info['tel_no'];?>" title="เบอร์โทรศัพท์" placeholder="ระบุ 08XXXXXXXX" class="form-control" type="text" required/>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                              <label class="col-2 control-label">ที่อยู่อีเมล</label>
                                              <input id="email_addr" name="pers_info[email_addr]" value="<?php echo @$pers_info['email_addr'];?>" title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email"/>
                                            </div>

                                          </div>

                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-6">
                                              <label class="col-2 control-label">หน่วยงาน</label>
                                              <input name="prep_trn_trainee[req_org]" value="<?php echo $prep_trn_trainee['req_org'];?>" title="หน่วยงาน" placeholder="ระบุหน่วยงาน" class="form-control" type="text"/>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                              <label class="col-2 control-label">ตำแหน่ง</label>
                                              <input name="prep_trn_trainee[req_position]" value="<?php echo $prep_trn_trainee['req_position'];?>" title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" class="form-control" type="text"/>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-3">
                                              <label class="col-2 control-label">โครประจำตัว (ถ้ามี)</label>
                                              <input id="healthy_congenital_disease" name="pers_info[healthy_congenital_disease]" value="<?php echo @$pers_info['healthy_congenital_disease'];?>" title="โครประจำตัว" placeholder="ระบุโครประจำตัว" class="form-control" type="text"/>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                              <label class="col-2 control-label">บุคคลที่ติดต่อได้ (กรณีฉุกเฉิน)</label>
                                              <input name="prep_trn_trainee[emrc_name]" value="<?php echo $prep_trn_trainee['emrc_name'];?>" title="บุคคลที่ติดต่อได้" placeholder="(คำนำหน้า) ชื่อ - นามสุกล" class="form-control" type="text"/>
                                            </div>

                                            <div class="col-xs-12 col-sm-3">
                                              <label class="col-2 control-label">เบอร์โทรศัพท์ (ที่ติดต่อได้)</label>
                                              <input name="prep_trn_trainee[emrc_tel_no_mobile]" value="<?php echo $prep_trn_trainee['emrc_tel_no_mobile'];?>" title="เบอร์โทรศัพท์" placeholder="ระบุ 08XXXXXXXX" class="form-control" type="text"/>
                                            </div>
                                          </div>


                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-12">
                                              <label class="col-2 control-label">หมายเหตุ</label>
                                              <textarea name="prep_trn_trainee[trainee_remark]" class="form-control" rows="2"><?php echo $prep_trn_trainee['trainee_remark']; ?></textarea>
                                            </div>
                                          </div>


                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-3 dropdown">
                                              <label for="example-text-input" class="col-2 control-label">สถานะการเข้าร่วม</label>
                                              <div class="col-10">
                                                <select name="prep_trn_trainee[attd_status]" title="สถานะการเข้าร่วม" class="form-control">
                                                    <option value="ไม่ยืนยัน" <?php if($prep_trn_trainee['attd_status'] == 'ไม่ยืนยัน'){ echo "selected";} ?>>ไม่ยืนยัน</option>
                                                    <option value="ยืนยัน" <?php if($prep_trn_trainee['attd_status'] == 'ยืนยัน'){ echo "selected";} ?>>ยืนยัน</option>
                                                    <option value="ยกเลิก" <?php if($prep_trn_trainee['attd_status'] == 'ยกเลิก'){ echo "selected";} ?>>ยกเลิก</option>
                                                </select>
                                              </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3">
                                              <label for="example-text-input" class="col-2 control-label">รหัสลงทะเบียน (Registration Code)</label>
                                              <br><span style="color: #3890FE;"> 432185</span>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                              <label class="col-2 control-label">ช่องทางการลงทะเบียน</label>
                                              <br><span style="color: #3890FE;"><b>หน่วยงานดำเนินการรับลงทะเบียน</b>, ลงทะเบียนออนไลน์</span>
                                            </div>

                                          </div>

                                           <hr>
                                        <div class="row">
                                         <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                         <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('prepare/trainee_list/View/'.$trn_id); ?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                        </div>
                                      </div><!-- close class row-->

                                         
                                        </div>
                                      </div>
                                    </div>
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
<div id="sbmCnfrm" class="modal fade" role="dialog">
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
<div id="myPrint"  class="modal fade" role="dialog">
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
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
