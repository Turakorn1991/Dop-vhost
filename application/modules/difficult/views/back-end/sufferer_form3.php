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
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1/Edit/'.$diff_info['diff_id']);?>" <?php }?> <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }?>> (1) แจ้งเรื่อง</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(4);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(4,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form2/Edit/'.$diff_info['diff_id']);?>" <?php }?> <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }?>>(2) ตรวจเยี่ยม</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(5);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(5,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form3/Edit/'.$diff_info['diff_id']);?>" <?php }?> data-toggle="tab" href="#tab-3" <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) สงเคราะห์</a>
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

                                   <!--
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
                                    -->

                                    <div id="tmp_menu" hidden='hidden'>
                                            <!--
                                             <?php
                                             if($process_action=='Edit') {

                                            ?>
                                            <a data-toggle="modal" data-target="#myPrint" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"

                                             title="พิมพ์แบบฟอร์ม">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </a>
                                            <?php }?>

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(3);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                            ?>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()"
                                            <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            </a>
                                             -->

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(3);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                            ?>

                                            <!--
                                            <?php
                                              if($process_action=='Edit') {
                                              $tmp = $this->admin_model->getOnce_Application(3);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                            ?>
                                            <a data-id=<?php echo $diff_info['diff_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{ ?>
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
                                    $diff_id = '';

                                    if($process_action=='Add')$process_action = 'Added';
                                    if($process_action=='Edit'){$process_action = 'Edited'; $diff_id = '/'.$diff_info['diff_id'];}

                                    echo form_open_multipart('difficult/sufferer_form3/'.$process_action.$diff_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                                    <input value="false" name="sms" hidden="hidden">

                                    <?php echo validation_errors('<div class="error" style="font-size: 14px; padding-left: 20px">', '</div>'); ?>
                                    <div class="panel-group" style="margin-bottom: 0px;">
                                          <div class="panel panel-default" style="border: 0;">
                                             <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 0px;">
                                                <div class="form-group row">
                                                   <div class="col-xs-12 col-sm-12">
                                                          <label for="datetimepicker1" class="col-2 col-form-label" style="color:red;">ผลการพิจารณาอนุมัติเงินช่วยเหลือ </label>    
                                                    </div>
                                                  </div><!--end from group row-->
                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-3"> 
                                                    <div class="checkbox-inline i-checks"><label><input type="radio" name="diff_info[payment_status]" id="confirm" value="อนุมัติ" <?php if($diff_info['payment_status'] == "อนุมัติ") { echo "checked";} ?> required > อนุมัติ</label></div>
                                                  </div>
                                                </div><!--end from group row-->
                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-3">
                                                     <div class="checkbox-inline i-checks"><label><input  type="radio" id="refuse" name="diff_info[payment_status]" value="ปฎิเสธ" <?php if($diff_info['payment_status'] == "ปฎิเสธ") { echo "checked";} ?> required > ปฎิเสธ</label></div>
                                                   </div>
                                                     <div class="col-xs-12 col-sm-6"><input type="text" id="refuse_resason" disabled="disabled" placeholder="ระบุ" onkeyup="numberandth(this)" class="form-control" name="diff_info[payment_status_reason]" value="<?php echo $diff_info['payment_status_reason']; ?>"></div>
                                                </div><!--end from group row-->
                                             </div>
                                          </div>
                                    </div>
                                    <script type="text/javascript">
                  
                                    
                                          $("input[name='diff_info[payment_status]").on('ifChanged',function(){    
                                            if($('#refuse').prop('checked')){
                                              $("#refuse_resason").prop('disabled', false );
                                
                                            }else{
                                              $("#refuse_resason").val('');
                                              $("#refuse_resason").prop('disabled', true );
                                            }
                                          });
                                        
                                    
                                      </script>

                                  


                                    <div class="panel-group" style="margin-bottom: 0px;">
                                          <div class="panel panel-default" style="border: 0;">
                                              <!-- <div class="panel-heading"><h4>ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) (<label><input type="checkbox" name=""> บุคคลเดียวกับผู้ยื่นคำขอ</label>) <button class="btn btn-default" style="float: right;">ข้อมูลบูรณาการ</button></h4></div> -->
                                              <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 0px;">
                                                  <div class="form-group row">
                                                   <div class="col-xs-12 col-sm-12">
                                                          <label for="datetimepicker1" class="col-2 col-form-label">หน่วยงานดำเนินการ (ชำระเงิน) : </label>
                                                        <span color='#eee'>
                                                        <?php
                                                        echo $diff_info['org_title'];
                                                        ?>
                                                        </span>
                                                    </div>
                                                  </div>
                                                    <?php
                                                              //$this->common_model->custom_query("select * from diff_info as A inner join pers_info as B on A.pers_id=B.pers_id where B.pid in (select B.pid from diff_info as A inner join pers_info as B on A.pers_id=B.pers_id where A.diff_id = {$diff_info['diff_id']}) AND YEAR(A.date_of_pay)=YEAR(CURRENT_TIMESTAMP) AND A.delete_user_id = NULL order by A.date_of_pay desc");
                                                      $rows = $this->common_model->custom_query("select * from diff_info as A inner join pers_info as B on A.pers_id=B.pers_id where B.pid in (select B.pid from diff_info as A inner join pers_info as B on A.pers_id=B.pers_id where A.diff_id = {$diff_info['diff_id']}) AND A.date_of_pay is not null AND YEAR(A.date_of_pay)=YEAR(CURRENT_TIMESTAMP) AND A.delete_user_id is NULL order by A.date_of_pay desc");
                                                        if(count($rows)>0) {
                                                    ?>
                                                  <div class="row">
                                                    <div class="col-xs-12 col-sm-12">

                    <div class="ibox float-e-margins" style="margin-bottom: 0px !important;">
                    <div class="ibox-title">
                        <h5>ประวัติการได้รับการสงเคราะห์ 
                          
                          <?php 
                          if(count($rows)>0) {
                          ?>
                          <span style='color:#D25200'>มีประวัติ</span>
                          <?php
                          }else {
                          ?>
                          <span style='color:green'>ไม่มีประวัติ</span>
                          <?php
                          }
                          ?>

                          ภายในรอบปีนี้ 
                          <?php 
                            $rows1 = $this->common_model->custom_query("select * from diff_info as A inner join pers_info as B on A.pers_id=B.pers_id where B.pid in (select B.pid from diff_info as A inner join pers_info as B on A.pers_id=B.pers_id where A.diff_id = {$diff_info['diff_id']}) AND YEAR(A.date_of_pay)=YEAR(CURRENT_TIMESTAMP) AND A.delete_user_id is NULL order by A.date_of_pay desc");
                          if(count($rows1)>0) {
                          ?>
                          <span style='color:red'><?php echo count($rows1);?></span>
                          <?php
                          }else {
                          ?>
                          <span style='color:green'>-</span>
                          <?php
                          }
                          ?>
                          (ครั้ง)
                          
                          </h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                        <div class="ibox-content" style="padding: 0px !important;">
                            <div class="table-responsive">
                                
                                <table class="table table-bordered" style="">
                                    <thead>
                                    <tr>
                                        <th style="background-color: #459597; color: #fff; width:4% !important; text-align:center;">#</th>
                                        <th style="background-color: #459597; color: #fff; text-align:center;">วัน/เดือน/ปี แจ้งเรื่อง</th>
                                        <th style="background-color: #459597; color: #fff; text-align:center;">วัน/เดือน/ปี สงเคราะห์ (ล่าสุด)</th>
                                        <th style="background-color: #459597; color: #fff; text-align:center;">จำนวนเงิน (บาท)</th>
                                        <th style="background-color: #459597; color: #fff; text-align:center;">ผู้รับเงิน</th>
                                    </tr>
                                    </thead>
                                    <tbody style="text-align:center; font-size: 14px">
                                    <?php
                                    foreach($rows as $key=>$row) {
                                    ?>
                                      <tr style="font-size: 15px">
                                          <td><?php echo $key+1;?></td>
                                          <td><?php if($row['date_of_req']!=''){echo formatDateThai($row['date_of_req']);}?></td>
                                          <td><?php if($row['date_of_pay']!=''){echo formatDateThai($row['date_of_req']);}?></td>
                                          <td><?php echo number_format($row['pay_amount']);?></td>
                                          <td><?php echo $row['payee_type'];?></td>
                                      </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                                                    </div>
                                                  </div>
                                    <?php
                                      }
                                    ?>
                                                  <div class="form-group row">
                                                      <div class="col-xs-12 col-sm-4">
                                                            <label for="datetimepicker1" class="col-2 col-form-label">วันที่รับเงิน </label>
                                                            <div id="datetimepicker1" class="col-10 input-group date " data-date-format="dd-mm-yyyy" >
                                                                <input title="วันที่รับเงิน" placeholder="เลือกวันที่" class="form-control" id="date_of_pay" type="text" name="diff_info[date_of_pay]"/>
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                            </div>
                                                            <script type="text/javascript">
                                                            <?php
                                                            $tmp = explode('-',$diff_info['date_of_pay']);
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
                                                          <label for="" class="col-2 col-form-label" >จำนวนเงินที่สงเคราะห์ (บาท) </label>
                                                          <input title="ระบุ" placeholder="ระบุ" class="form-control" id="pay_amount"  onkeyup="nonthnumber(this)" type="text" name="diff_info[pay_amount]" value="<?php echo $diff_info['pay_amount']; ?>" />
                                                      </div>
                                                  </div>

                                                  <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-4">
                                                          <label for="" class="col-2 col-form-label" >ผู้รับเงิน </label><br>
                                                          <div class="checkbox-inline i-checks"><label><input type="radio"  name="diff_info[payee_type]"  id="payee_type" value="ผู้สูงอายุ" <?php if($diff_info['payee_type'] == "ผู้สูงอายุ") { echo "checked";} ?> /> ผู้สูงอายุ</label></div>
                                                          <div class="checkbox-inline i-checks"><label><input type="radio"  name="diff_info[payee_type]" id="payee_type" value="ผู้แจ้งเรื่อง" <?php if($diff_info['payee_type'] == "ผู้แจ้งเรื่อง") { echo "checked";} ?> > ผู้แจ้งเรื่อง</label></div>
                                                          <div class="checkbox-inline i-checks"><label><input type="radio"  name="diff_info[payee_type]" id="payee_type" value="ผู้รับมอบอำนาจ" <?php if($diff_info['payee_type'] == "ผู้รับมอบอำนนาจ") { echo "checked";} ?> > ผู้รับมอบอำนาจ</label></div>
                                                      </div>
                                                      <div class="col-xs-12 col-sm-6">
                                                          <label for="" class="col-2 col-form-label" >การรับเงิน </label><br>
                                                          <div class="checkbox-inline i-checks"><label><input type="radio"  name="diff_info[pay_channel]" value="เงินสด" <?php if($diff_info['pay_channel'] == "เงินสด") { echo "checked";} ?> > เงินสด</label></div>
                                                          <div class="checkbox-inline i-checks"><label><input type="radio"  name="diff_info[pay_channel]" value="เช็คเงินสด" <?php if($diff_info['pay_channel'] == "เช็คเงินสด") { echo "checked";} ?> > เช็คเงินสด</label></div>
                                                          <div class="checkbox-inline i-checks"><label><input type="radio"  name="diff_info[pay_channel]" value="KTB Online" <?php if($diff_info['pay_channel'] == "KTB Online") { echo "checked";} ?> > KTB Online</label></div>
                                                                                                              
                                                      </div>
                                                  </div>

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
                                                <!-- <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save"  onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button> -->
                                                <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                              </div>
                                              <div class="col-xs-12 col-sm-2">
                                                <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-cancel" onclick="window.location.href='<?php echo site_url('difficult/sufferer_form2/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
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
        <h4 class="modal-title" style="color: #333; font-size: 16px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
        <h4 class="modal-title" style="color: #333; font-size: 16px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
        <h4 class="modal-title" style="color: #333; font-size: 16px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
         <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
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
            <a style="color: #333; font-size: 16px;" target="_blank" href="<?php echo site_url('report/A1?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
    if($("[name='diff_info[date_of_pay]']").val() == null || $("[name='diff_info[date_of_pay]']").val()=='')// วันที่รับเงิน
    {
      toastr.error("โปรดระบุวันที่รับเงิน", "หน้าต่างแจ้งเตือน");
      ansCheck = true;
    }
    if($("[name='diff_info[pay_amount]']").val() == null || $("[name='diff_info[pay_amount]']").val() == '')// จำนวนเงินที่สงเคราะห์
    {
      toastr.error("โปรดระบุจำนวนเงินที่สงเคราะห์", "หน้าต่างแจ้งเตือน");
      ansCheck = true;
    }
    if(!$("[name='diff_info[payee_type]']").is(":checked"))// ผู้รับเงิน
    {
      toastr.error("โปรดระบุผู้รับเงิน", "payeetype");
      ansCheck = true;
    }
    if(!$("[name='diff_info[pay_channel]']").is(":checked"))// การรับเงิน
    {
      toastr.error("โปรดระบุการรับเงิน", "หน้าต่างแจ้งเตือน");
      ansCheck = true;
    }
 }
//  else
//  {
//  if ($("input[name='diff_info[payment_status_reason]']").val() === null || $("input[name='diff_info[payment_status_reason]']").match(/^ *$/) !== null)
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
