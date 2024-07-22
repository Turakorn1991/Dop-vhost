<?php
  class Sufferer_form2_model extends CI_Model {
      function __construct() {
          parent::__construct();
      }

      function getAll_Trouble(){
          return $this->common_model->getTableOrder('std_trouble', 'trb_id', 'ASC');
      }
      function getAll_Helps(){
          return $this->common_model->getTableOrder('std_help', 'help_id', 'ASC');
      }
      function getAll_Helps_guide(){
          return $this->common_model->getTableOrder('std_help_guide', 'help_guide_id', 'ASC');
      }
  }

  $this->load->model('sufferer_form2_model');
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                          <li >
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(22);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(22,$user_id); //Check User Permission
                            ?>
                              <a href="<?php echo site_url('funeral/inform1');?>" <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('funeral/inform1/Edit/'.$diff_info['diff_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) แจ้งเรื่อง</a>
                          </li>

                          <li class="active">
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(23);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(23,$user_id); //Check User Permission
                            ?>
                              <a href="<?php echo site_url('funeral/assist2');?>" <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('funeral/assist2/Edit/'.$diff_info['diff_id']);?>" <?php }?> <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }?>>(2) สงเคราะห์</a>
                          </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <strong>Tab-1</strong>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==23){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d"></h2>
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
                                                  <?php }else{?> href="<?php echo site_url('funeral/inform1');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
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
                                    if($process_action=='Edit'){$process_action = 'Edited'; $diff_id = '/'.@$adm_info['adm_id'];}

                                    echo form_open_multipart('welfare/inform2/'.$process_action.$diff_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                                    <p class="text-danger"><font color=red><?php echo validation_errors();?></font></p>

                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0;">
                                              <div class="panel-heading"><h4>ข้อมูลการสงเคราห์ </div>
                                              <div class="panel-body" style="border: 0;padding: 20px;">
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="datetimepicker1" class="col-2 col-form-label">วันที่รับเงิน <font color="red">*</font></label>
                                                        <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                            <input title="วันที่รับเงิน" placeholder="เลือกวันที่" class="form-control" type="text" name="adm_info[date_of_adm]" />
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                          <script type="text/javascript">
                                                          <?php
                                                          $tmp = explode('-',@$adm_info['date_of_adm']);
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
                                                        <label for="datetimepicker2" class="col-2 col-form-label">วันที่ออกใบสำคัญรับเงิน <font color="red">*</font></label>
                                                        <div id="datetimepicker2" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                            <input title="วันที่ออกใบสำคัญรับเงิน" placeholder="เลือกวันที่" class="form-control" type="text" name="adm_info[date_of_adm]" />
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                          <script type="text/javascript">
                                                          <?php
                                                          $tmp = explode('-',@$adm_info['date_of_adm']);
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
                                                          </script>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">จำนวนเงินที่สงเคราห์ (บาท) <font style="color:red;"></font></label>
                                                        <input id="visit_place_identify" title="ระบุ" placeholder="ระบุจำนวนเงิน (บาท)" class="form-control" type="text" name="adm_info[adm_case_reason_identify]" value="<?php echo @$adm_info['adm_case_reason_identify']; ?>"  />
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">ผู้รับเงิน <font style="color:red;"></font></label><br>
                                                        <div style="margin-top: 6px;">
                                                              <input type="radio" name="1" value="" checked> รับด้วยตนเอง
                                                              <input type="radio" name="1" value=""> ผู้รับมอบอำนาจ
                                                        </div>
                                                    </div>


                                                  </div>


                                              </div>
                                          </div>
                                      </div>

                                    <?php
                                    echo form_close();
                                    ?>

                                    </div>


                                    <center>
                                            <button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> บันทึก</button>
                                            <button type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิก</button>
                                    </center>

                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==5){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
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
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
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
            <a style="color: #333; font-size: 15px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>



         </div>
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
