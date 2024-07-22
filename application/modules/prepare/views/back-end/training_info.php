            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                        <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(56); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/training_info/Edit/'.@$prep_trn_info['trn_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==56){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> การอบรม</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(56); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/trainee_list/View/'.@$prep_trn_info['trn_id']);?>" <?php }?> <?php if($usrpm['app_id']==56){?>aria-expanded="true" <?php }?>> ผู้เข้าร่วม</a>
                            </li>
                      </ul>

                        <div class="tab-content">
                          <div class="family_members_template" hidden='hidden'>
                            <div class="family_members_items" style="margin-top: -10px;">
                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-6">
                                        <!-- <label for="" class="col-2 col-form-label">เกี่ยวของเป็น</label> -->
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename">ไฟล์ชนิด .PDF, .MP3, .MP4, .M4V, .JPG และ .PNG เท่านั้น</span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">Browse</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="fileAtt[myID]"/>
                                            </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                       </div>
                                    </div>
                                    <div class="col-xs-11 col-sm-5">
                                        <!-- <label for="" class="col-2 col-form-label">&nbsp;</label> -->
                                        <input name="fileDes[myID]" title="คำอธิบาย" placeholder="คำอธิบาย" class="form-control" type="text"/>
                                    </div>
                                    <div class="col-xs-1 col-sm-1">
                                        <!-- <label for="" class="col-2 col-form-label">&nbsp;</label><br> -->
                                        <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="width: 60px;"><i class="fa fa-minus" aria-hidden="true"></i></button>                  
                                    </div>
                                  </div>
                              </div>
                          </div>

                            <div id="tab-1" <?php if($usrpm['app_id']==56){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
<!--                                   <div id="tmp_menu" hidden='hidden'>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('prepare/training_list');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                          </div> -->
                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);
                                          </script>

                                  <div class="form-group row">

                                      <?php
                                      $trn_id = '';

                                      if($process_action=='Add')$process_action = 'Added';
                                      if($process_action=='Edit'){$process_action = 'Edited'; $trn_id = '/'.$prep_trn_info['trn_id'];}

                                      echo form_open_multipart('prepare/training_info/'.$process_action.$trn_id,array('id'=>'form1'));
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
                                            <div class="col-xs-12 col-sm-12 has-error">
                                              <label for="" class="col-2 control-label">หัวข้อการจัดอบรม</label>
                                              <input title="หัวข้อการจัดอบรม" placeholder="ระบุชื่อหัวข้อการจัดอบรม" class="form-control" type="text" name="prep_trn_info[trn_title]" value="<?php echo @$prep_trn_info['trn_title'];?>" />
                                            </div>
                                          </div>
                                          <div class="form-group row ">
                                            <div class="col-xs-12 col-sm-3">
                                              <label for="" class="col-2 control-label">ปีงบประมาณ</label>
                                              <input title="ปีงบประมาณ" placeholder="ระบุปีงบประมาณ" class="form-control" type="text"  name="prep_trn_info[budget_year]" value="<?php echo @$prep_trn_info['budget_year'];?>"/>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 has-error">
                                              <label for="" class="col-2 control-label">หน่วยงานดำเนินการ</label>
                                              <input title="หน่วยงานดำเนินการ" placeholder="ระบุหน่วยงานดำเนินการ" class="form-control" type="text"  name="prep_trn_info[trn_org]" value="<?php echo @$prep_trn_info['trn_org'];?>"/>
                                            </div>

                                            <div class="col-xs-12 col-sm-6 has-error">
                                              <label for="" class="col-2 control-label">สถานที่จัดอบรม</label>
                                              <input title="สถานที่จัดอบรม" placeholder="ระบุสถานที่จัดอบรม" class="form-control" type="text" name="prep_trn_info[trn_place]" value="<?php echo @$prep_trn_info['trn_place'];?>"/>
                                            </div>
                                          </div>

                                          <div class="form-group row ">
                                            <div class="col-xs-12 col-sm-3 has-error">
                                              <label for="datetimepicker1" class="col-2 col-form-label" style="color: #ed5565;">วันที่</label>
                                              <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                  <input title="วันที่" placeholder="เลือกวันที่" class="form-control" type="text" name="prep_trn_info[start_date]" required/>
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                              </div>                    
                                              <script type="text/javascript">
                                              /*
                                              $(function () {
                                                $("#datetimepicker1").datetimepicker({
                                                  locale: 'th',
                                                  format:'DD-MM-YYYY',
                                                });
                                              });
                                              */
                                              <?php
                                              $tmp = explode('-',@$prep_trn_info['start_date']);
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
                                            <div class="col-xs-12 col-sm-3">
                                              <label for="datetimepicker2" class="col-2 col-form-label">(ถึง วันที่)</label>
                                              <div id="datetimepicker2" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                  <input title="(ถึง วันที่)" placeholder="เลือกวันที่" class="form-control" type="text" name="prep_trn_info[end_date]" />
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                              </div>                    
                                              <script type="text/javascript">
/*                                              $(function () {
                                                $("#datetimepicker2").datetimepicker({
                                                  locale: 'th',
                                                  format:'DD-MM-YYYY',
                                                });
                                              });*/
                                                <?php
                                                $tmp = explode('-',@$prep_trn_info['end_date']);
                                                ?>
                                                $(function () {
                                                $("#datetimepicker2").datepicker({
                                                  autoclose: true,
                                                  todayHighlight: true,
                                                  format: 'dd/mm/yyyy',
                                                   todayBtn: true,
                                                   language: 'th',
                                                   thaiyear: true
                                                })<?php if(count($tmp)==3){?>.datepicker('update', new Date(Date.UTC(<?php echo $tmp[2];?>,<?php echo $tmp[1];?>-1,<?php echo $tmp[0];?>)));<?php }?>
                                                });
/*                                              $("#datetimepicker1").on("dp.change", function (e) {
                                                  $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
                                              });
                                              $("#datetimepicker2").on("dp.change", function (e) {
                                                  $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
                                              });*/
                                              </script>
                                            </div>

                                            <div class="col-xs-12 col-sm-3">
                                              <label for="datetimepicker3" class="col-2 col-form-label">เวลา</label>
                                              <div id="datetimepicker3" class="col-10 input-group">
                                                  <input title="เวลา" placeholder="เลือกเวลา" class="form-control" type="text" name="prep_trn_info[start_time]" value="<?php echo @$prep_trn_info['start_time'];?>"/>
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                              </div>                    
                                              <script type="text/javascript">
                                              $(function () {
                                                $("#datetimepicker3").datetimepicker({
                                                  locale: 'th',
                                                  format:'HH:mm',
                                                });
                                              });
                                              </script>
                                            </div>

                                            <div class="col-xs-12 col-sm-3">
                                              <label for="datetimepicker4" class="col-2 col-form-label">(ถึง เวลา)</label>
                                              <div id="datetimepicker4" class="col-10 input-group">
                                                  <input title="(ถึง เวลา)" placeholder="เลือกเวลา" class="form-control" type="text" name="prep_trn_info[end_time]" value="<?php echo @$prep_trn_info['end_time'];?>"/>
                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                              </div>                    
                                              <script type="text/javascript">
                                              $(function () {
                                                $("#datetimepicker4").datetimepicker({
                                                  locale: 'th',
                                                  format:'HH:mm',
                                                });
                                              });
                                              </script>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-12">
                                              <label for="" class="col-2 control-label">รายละเอียด</label>
                                              <textarea class="form-control" rows="8" name="prep_trn_info[trn_describe]"><?php echo @$prep_trn_info['trn_describe'];?></textarea>
                                            </div>
                                          </div>


                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-6">
                                              <label for="" class="col-2 col-form-label">เอกสารแนบ</label>
                                              <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                  <div class="form-control" data-trigger="fileinput">
                                                      <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                      <span class="fileinput-filename"><?php if(isset($prep_trn_info['att_trn_file'])){ echo $prep_trn_info['att_trn_label'];}else{ echo "ไฟล์ชนิด .PDF, .MP3, .MP4, .M4V, .JPG และ .PNG เท่านั้น";} ?></span>
                                                  </div>
                                                  <span class="input-group-addon btn btn-default btn-file">
                                                      <span class="fileinput-new">Browse</span>
                                                      <span class="fileinput-exists">Change</span>
                                                      <input type="file" name="att_trn_file"/>
                                                  </span>
                                                  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                              </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                              <label for="" class="col-2 control-label">สถานะการเผยแพร่</label><br>
                                              <input type="checkbox" class="js-switch" checked="" style="display: none;" data-switchery="true">
                                              <span style="color: #3890FE;"> (ผู้เข้าชม 0 ราย ทดสอบ 0 ราย)</span>
                                            </div>
                                          </div>

                                         <hr>
                                        <div class="row">
                                         <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                         <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('prepare/training_list');?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                        </div>
                                      </div><!-- close class row-->
                                           

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                           
                            <div id="tab-2" <?php if($usrpm['app_id']==56){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php } ?>>
                                <div class="panel-body">
                                    <strong>Tab-2</strong>
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
