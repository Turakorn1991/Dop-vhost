<div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(13);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/inform1/Edit/'.$adm_info['adm_id']);?>" <?php }?>  <?php if($usrpm['app_id']==13){?>aria-expanded="true" <?php }?>> (1) แจ้งความประสงค์</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(14);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/admission2/Edit/'.$adm_info['adm_id']);?>" <?php }?>  data-toggle="tab" <?php if($usrpm['app_id']==14){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) รับเข้า/จำหน่าย</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(15);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                    <?php //echo site_url('welfare/estimate3/View/'.$adm_info['adm_id']);?>
                                  <?php }else{?> href="#" <?php }?>  <?php if($usrpm['app_id']==15){?>aria-expanded="true" <?php }?>>(3) ประเมินสมรรถภาพ</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==13){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <strong>Tab-1</strong>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==14){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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
                                                    $tmp = $this->admin_model->getOnce_Application(14);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(14);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('welfare/welfare_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(14);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
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
                                       <?php if($process_action=='Edit') { ?>
                                        <a title="พิมพ์แบบฟอร์ม" data-toggle="modal" data-target="#myPrint" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="" data-toggle="modal" data-target="#mySearch">
                                        <i class="fa fa-file-text" aria-hidden="true"></i> </a>
                                       <?php }?>


                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(14);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
                                        ?>
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                        <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?> onclick="return opnCnfrom()"
                                        <?php }?> title="บันทึก<?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                        </a>
                                        -->

                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(6);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
                                        ?>

                                        <!--
                                        <?php
                                        if($process_action=='Edit') {

                                        ?>
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"  data-id=111 onclick="opn(this)" title="ลบ">
                                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                        <?php } ?>




                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                        -->
                                    </div>
                                    <script>
                                      setTimeout(function(){
                                        $("#menu_topright").html($("#tmp_menu").html());
                                      },300);
                                    </script>

                                    <div class="form-group row">

                                    <?php
                                    $adm_id = '';

                                    if($process_action=='Add')$process_action = 'Added';
                                    if($process_action=='Edit'){$process_action = 'Edited'; $adm_id = '/'.$adm_info['adm_id'];}

                                    echo form_open_multipart('welfare/admission2/'.$process_action.$adm_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">

                                    <?php echo validation_errors('<div class="error" style="font-size: 20px; padding-left: 20px; color:red;">', '</div>'); ?>
                                      <!--begin -->
                                    <div class="panel-group" style="margin-bottom: 0px;">
                                          <div class="panel panel-default" style="border: 0;">
                                              <div class="panel-heading"><h4>ข้อมูลการรับเข้า </div>
                                              <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 0px;">
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 has-error">
                                                      <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่รับเข้า </label>
                                                      <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                          <input title="วันที่รับเข้า" placeholder="เลือกวันที่" class="form-control" type="text" name="adm_info[date_of_adm]" required/>
                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                      </div>
                                                      <script type="text/javascript">
                                                        <?php
                                                        $tmp = explode('-',$adm_info['date_of_adm']);
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

                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label" style="color: red;">สาเหตุการรับเข้า </label>
                                                        <div class="col-10 has-error">
                                                        <select id="adm_case_reason_code" title="สาเหตุการรับเข้า" placeholder="เลือกสาเหตุการรับเข้า" class="form-control" name="adm_info[adm_case_reason_code]" required>
                                                            <option value="">เลือกสาเหตุการรับเข้า</option>
                                                            <?php $tmp_cr = $this->welfare_model->getAll_caseReason('การรับเข้า');
                                                            foreach ($tmp_cr as $row) { ?>
                                                               <option value="<?php echo $row['case_reason_code'];?>" <?php if($row['case_reason_code'] == $adm_info['adm_case_reason_code']){ echo "selected";} ?>><?php echo $row['case_reason_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">&nbsp;</label>
                                                        <input id="adm_case_reason_identify" title="ระบุ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text" name="adm_info[adm_case_reason_identify]" value="<?php echo $adm_info['adm_case_reason_identify']; ?>" <?php if($adm_info['adm_case_reason_identify'] == "") { echo "disabled";} ?> />
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label" style="border:red;color:red;">รูปแบบการรับเข้า </label>
                                                        <div class="col-10 has-error">
                                                        <select id="adm_case_type" title="สาเหตุการรับเข้า" placeholder="เลือกรูปแบบการรับเข้า" class="form-control" name="adm_info[adm_case_type]" required>
                                                            <option value="">เลือกรูปแบบการรับเข้า</option>
                                                            <option value="มี" <?php if(@$adm_info['adm_case_type'] == 'มี'){ echo "selected"; } ?>>มีค่าบริการ</option>
                                                            <option value="ไม่มี" <?php if(@$adm_info['adm_case_type'] == 'ไม่มี'){ echo "selected"; } ?>>ไม่มีค่าบริการ</option>
                                                        </select>
                                                      </div>
                                                    </div>


                                                    <script type="text/javascript">
                                                      $("#adm_case_reason_code").change(function () {
                                                        if($(this).val() == "006"){
                                                          $("#adm_case_reason_identify").prop('disabled', false ).focus();
                                                        }else{
                                                          $("#adm_case_reason_identify").val('');
                                                          $("#adm_case_reason_identify").prop('disabled', true );
                                                        }
                                                      });
                                                    
                                                      $("#guide-book").click(function(){
                                                        window.open('/assets/modules/welfare/guide/Adm_Manual.pdf', '_blank');
                                                      });
                                                    </script>
                                                  </div>

                                                    <div class="form-group row">

                                                          <div class="col-xs-12 col-sm-6">
                                                            <label for="example-text-input" class="col-2 col-form-label">ประวัติความเป็นมา </label>
                                                            <textarea class="form-control" title="ประวัติความเป็นมา" name="adm_info[case_history]" rows="5" placeholder="ระบุรายละเอียด"><?php echo $adm_info['case_history']; ?></textarea>
                                                          </div>

                                                          <div class="col-xs-12 col-sm-6">
                                                            <label for="example-text-input" class="col-2 col-form-label">สิ่งที่นำติดตัวมาด้วย </label>
                                                            <!-- <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                              <div class="form-control" data-trigger="fileinput">
                                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                <span class="fileinput-filename"><?php echo $adm_info['belonging_att_label']; ?></span>
                                                              </div>
                                                              <span class="input-group-addon btn btn-default btn-file">
                                                                <span class="fileinput-new">Select file</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input type="file" name="belonging_att_file"/>
                                                              </span>
                                                              <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                            </div> -->
                                                            <textarea class="form-control" title="รายละเอียด" name="adm_info[belonging_with]" rows="5" placeholder="ระบุรายละเอียด"><?php echo $adm_info['belonging_with']; ?></textarea>
                                                          </div>
                                                    </div><!-- end ข้อมูลการรับเข้า -->

                                              

                                                    <div class="form-group row">
                                                     <div class="panel-group" style="margin-bottom: 0px;">
                                                          <div class="panel panel-default" style="border: 0;">
                                                              <div class="panel-heading"><h4>ข้อมูลการจำหน่าย </div>
                                                               <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 0px;">
                                                                   <div class="form-group row" style="padding-bottom: 0px;">
                                                                      <div class="col-xs-12 col-sm-3">
                                                                            <label for="datetimepicker1" class="col-2 col-form-label" >วันที่จำหน่าย </label>
                                                                            <div id="datetimepicker2" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                                                <input title="วันที่จำหน่าย" placeholder="เลือกวันที่" class="form-control" type="text" name="adm_info[date_of_dis]"  />
                                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                            </div>  <!-- datetimepicker2-->
                                                                              <script type="text/javascript">
                                                                              <?php
                                                                              $tmp = explode('-',$adm_info['date_of_dis']);
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
                                                                      </div><!--end has-error-->

                                                                      <div class="col-xs-12 col-sm-3 dropdown">
                                                                          <label for="example-text-input" class="col-2 col-form-label" >สาเหตุการจำหน่าย </label>
                                                                          <div class="col-10">
                                                                          <select id="dis_case_reason_code" title="สาเหตุการจำหน่าย" placeholder="เลือกสาเหตุการจำหน่าย" class="form-control" name="adm_info[dis_case_reason_code]">
                                                                              <option value="">เลือกสาเหตุการจำหน่าย</option>
                                                                              <?php $tmp_cr = $this->welfare_model->getAll_caseReason('การจำหน่าย');
                                                                              foreach ($tmp_cr as $row) { ?>
                                                                                 <option value="<?php echo $row['case_reason_code'];?>" <?php if($row['case_reason_code'] == $adm_info['dis_case_reason_code']){ echo "selected";} ?>><?php echo $row['case_reason_name']; ?></option>
                                                                              <?php } ?>
                                                                          </select>
                                                                        </div><!--end col-10-->
                                                                      </div><!--end สาเหตุการจำหน่าย-->
                                                                      <script type="text/javascript">
                                                                         
                                                                              $("#dis_case_reason_code").change(function () {
                                                                                if($(this).val() == "014"){
                                                                                  $("#dis_case_reason_identify").prop('disabled', false ).focus();
                                                                                }else{
                                                                                  $("#dis_case_reason_identify").val('');
                                                                                  $("#dis_case_reason_identify").prop('disabled', true );
                                                                                }
                                                                              });

                                                                      </script>
                                                                      <div class="col-xs-12 col-sm-6">
                                                                          <label for="" class="col-2 col-form-label">&nbsp;</label>
                                                                          <input id="dis_case_reason_identify" title="ระบุ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text" name="adm_info[dis_case_reason_identify]" value="<?php echo $adm_info['dis_case_reason_identify']; ?>" <?php if($adm_info['dis_case_reason_identify'] == "") { echo "disabled";} ?>  />
                                                                      </div><!--end อื่นๆ-->
                                                                      </div>
                                                                     </div>
                                                                          <div class="col-xs-12 col-sm-6">
                                                                            <label for="example-text-input" class="col-2 col-form-label" >การดำเนินการของศูนย์ </label>
                                                                            <textarea class="form-control" title="การดำเนินการของศูนย์" name="adm_info[adm_opr_procedure]" rows="5" placeholder="ระบุรายละเอียด" ><?php echo $adm_info['adm_opr_procedure']; ?></textarea>
                                                                          </div>
                                                                          <div class="col-xs-12 col-sm-6">
                                                                            <label for="example-text-input" class="col-2 col-form-label">หมายเหตุ </label>
                                                                            <textarea class="form-control" title="หมายเหตุ" name="adm_info[adm_opr_remark]" rows="5" placeholder="ระบุรายละเอียด"><?php echo $adm_info['adm_opr_remark']; ?></textarea>
                                                                          </div>
                                                                      </div>
                                                              </div>
                                                      </div><!-- end row-->

                                                      <!-- start new-->
                                                      <div class="form-group row">
                                                     <div class="panel-group" style="margin-bottom: 0px;">
                                                          <div class="panel panel-default" style="border: 0;">
                                                              <div class="panel-heading"><h4>การติดตามผล</h4></div>
                                                               <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 0px;">
                                                                   <div class="form-group row" style="padding-bottom: 0px;">
                                                                  
                                                                   <div class="col-xs-12 col-sm-12">  
                                                                        <div style="float: right" id="menu_topright">
                                                                                  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary"  id="add_toggle" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"> 
                                                                            
                                                                                  <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true" id="add_toggle"></i> เพิ่มรายการ
                                                                                  </a>
                                                                        </div><!--end menu topright-->
                                                                   </div> 
                                                                   </div>
                                                                   <script>
                                                                      $(document).ready(function(){
                                                                          $("#add_toggle").click(function(){
                                                                              $("#form_follow").toggle();
                                                                          });
                                                                      });
                                                                      </script>
                                                                   
                                                                   <div class="table-responsive">

                                                                          <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                                                  <thead style="font-size: 15px;">
                                                                                        <tr>
                                                                                            <th style="width:2% !important;" rowspan="2" class="text-center">#</th>
                                                                                            <th style="width:6% !important;" rowspan="2" class="text-center">วัน เดือน ปี</th>
                                                                                            <th style="width:12% !important;" rowspan="2" class="text-center">วิธีการติดตามผล</th>
                                                                                            <th style="width:7% !important;" rowspan="2">สภาพของผู้สูงอายุ/ ครอบครัว</th>
                                                                                            <th style="width:4% !important;" rowspan="2" class="text-center">ความเห็นของนักสังคม<br>สงเคราะห์</th>
                                                                                            <th style="width:8% !important;" rowspan="2" class="text-center">หมายเหตุ</th>
                                                                                            <th style="width:2% !important;" rowspan="2" class="text-center">&nbsp;</th>
                                                                                      </tr>
                                                                                  
                                                                                  </thead>
                                                                                  <tbody>
                                                                                            <?php foreach ($adm_follow_record as $i => $row) { ?>
                                                                                            <tr>
                                                                                                <!--#-->
                                                                                                <td class="lnk text-center"><?php echo $i+1; ?></td>

                                                                                                <!--date of follow-->
                                                                                                <td class="lnk text-center">
                                                                                                <?php if($row['date_of_follow']!='' && $row['date_of_follow'] != '0000-00-00') { ?>
                                                                                                <font class="text-sucsess" color="#18bd15"><?php echo dateChange($row['date_of_follow'],5);?></font>
                                                                                                <?php } ?>
                                                                                                </td>
                                                                                                <!--follow up approach-->
                                                                                                <td class="lnk"><?php echo $row['adm_follow_approach']; ?></td>

                                                                                                <!--follow up status-->
                                                                                                <td class="lnk"><?php echo $row['adm_follow_status']; ?></td>

                                                                                                <!--follow up comment-->
                                                                                                <td class="lnk"><?php echo $row['adm_follow_comment']; ?></td>

                                                                                                <!--follow up remark-->
                                                                                                <td class="lnk"><?php echo $row['adm_follow_remark']; ?></td>

                                                                                                <!--follow up delete-->
                                                                                                <td align="center">
                                                                                                    <div class="btn-group" style="cursor: pointer;">
                                                                                                    <!-- <i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>
                                                                                                    <ul class="dropdown-menu" style="position: absolute;left: -150px;">
                                                                                                      <li>
                                                                                                        <?php
                                                                                                        // $tmp = $this->admin_model->getOnce_Application(15);
                                                                                                        //   $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                                                                                          ?>
                                                                                                          <a style="font-size: 16px;"<?php if(!isset($tmp1['perm_status'])) {?>
                                                                                                            readonly
                                                                                                            <?php }else{?> data-toggle="modal" data-target="#myModal" <?php }?> title="<?php echo $row['adm_record_id']; ?>" id="" value="<?php echo $row['adm_record_id']; ?>">
                                                                                                            <i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ
                                                                                                          </a>
                                                                                                      </li> -->
                                                                                                      <?php
                                                                                                      $tmp = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                                                                      if(isset($tmp['perm_status'])) {
                                                                                                      if($tmp['perm_status']=='Yes') {
                                                                                                        ?>
                                                                                                      <a style="font-size:16px;" data-id="<?php echo $adm_id ?>" data-rec="<?php echo $row['adm_record_id']; ?>" onclick="opn(this)" title='ลบ' >
                                                                                                        <i class="fa fa-trash" style="color: #000"></i> 
                                                                                                      </a>
                                                                                                      <?php
                                                                                                        }
                                                                                                        }
                                                                                                        ?>
                                                                                                     <!-- </ul> -->
                                                                                                  </div> 

                                                                                                    
                                                                                                </td>
                                                                                                
                                                                                            
                                                                                            </tr>
                                                                                            <?php } ?>
                                                                                  </tbody>
                                                                          </table>

                                                                    </div><!-- end table-->
                                                                           
                                                                              <div id="form_follow" class="panel-body"   hidden='hidden' style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                                                  <div class="col-xs-12 col-sm-3 dropdown">
                                                                                        <label for="datetimepicker1" class="col-2 col-form-label" >วัน เดือน ปี </label>
                                                                                        <div id="datetimepicker3" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                                                            <input title="วันที่จำหน่าย" placeholder="เลือกวันที่" class="form-control" type="text" name="adm_follow_record[date_of_follow]" />
                                                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                        </div> 
                                                                                              <script type="text/javascript">
                                                                                              <?php
                                                                                              $tmp = explode('-',$adm_follow_record['date_of_follow']);
                                                                                              ?>
                                                                                              $(function () {
                                                                                              $("#datetimepicker3").datepicker({
                                                                                                autoclose: true,
                                                                                                todayHighlight: true,
                                                                                                format: 'dd/mm/yyyy',
                                                                                                todayBtn: true,
                                                                                                language: 'th',
                                                                                                thaiyear: true
                                                                                              })<?php if(count($tmp)==3){?>.datepicker('update', new Date(Date.UTC(<?php echo $tmp[2];?>,<?php echo $tmp[1];?>-1,<?php echo $tmp[0];?>)));<?php }?>
                                                                                              });
                                                                                              </script>
                                                                                         </div><!--end col sm 3 datetimepicker--> 
                                                                                            <div class="col-xs-12 col-sm-12"><br></div>
                                                                                            <div class="col-xs-12 col-sm-3"><label class="col-2 col-form-label" >วิธีการติดตามผล</label></div>
                                                                                            <div class="col-xs-12 col-sm-12"><textarea title="สภาพร่างกาย" name="adm_follow_record[adm_follow_approach]" class="form-control"></textarea></div>
                                                                                            <div class="col-xs-12 col-sm-12"><br></div>
                                                                                            <div class="col-xs-12 col-sm-3"><label class="col-2 col-form-label" >สภาพของผู้สูงอายุ/ ครอบครัว</label></div>
                                                                                            <div class="col-xs-12 col-sm-12"><textarea title="สภาพของผู้สูงอายุและครอบครัว" name="adm_follow_record[adm_follow_status]" class="form-control"></textarea></div>
                                                                                            <div class="col-xs-12 col-sm-12"><br></div>
                                                                                            <div class="col-xs-12 col-sm-3"><label class="col-2 col-form-label" >ความเห็นของนักสังคมสงเคราะห์</label></div>
                                                                                            <div class="col-xs-12 col-sm-12"><textarea title="ความเห็นของนักสังคมสงเคราะห์" name="adm_follow_record[adm_follow_comment]" class="form-control"></textarea></div>
                                                                                            <div class="col-xs-12 col-sm-12"><br></div>
                                                                                            <div class="col-xs-12 col-sm-3"><label class="col-2 col-form-label" >หมายเหตุ</label></div>
                                                                                            <div class="col-xs-12 col-sm-12"><textarea title="หมายเหตุ" name="adm_follow_record[adm_follow_remark]" class="form-control"></textarea></div>
                                                                                            <input type="hidden" name="adm_follow_record[pers_id]" value="<?php echo $adm_info['pers_id'];?>"/>
                                                                                
                                                                                  
                                                                              </div><!--end datetimepicker3-- >
                                                                              <!--edit modal-->

                                                                                <div class="modal fade" id="myModal" role="dialog">
                                                                                      <div class="modal-dialog">
                                                                                      
                                                                                        <!-- Modal content-->
                                                                                        <div class="modal-content">
                                                                                          <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                            <h4 class="modal-title">Modal Header</h4>
                                                                                          </div>
                                                                                          <div class="modal-body">
                                                                                            <p>Some text in the modal.</p>
                                                                                          </div>
                                                                                          <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                          </div>
                                                                                        </div>
                                                                                        
                                                                                      </div>
                                                                                  </div>

                                                                              <!--end edit modal-->
                                                                              
                                                                      
                                                                         </div><!-- end col-xs-12 col-sm-3 dropdown-->
                                                                     </div><!-- panel-body-->
                                                                    
                                                                      
                                                          </div>
                                                      </div><!-- end row-->






                                                       
                                              </div>
                                          </div>
                                      </div><!--end -->

                                    <?php
                                    echo form_close();
                                    ?>

                                    </div>

                                           <hr style="margin-top: 0px;">
                                              <div class="row">
                                               <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                               <div class="col-xs-12 col-sm-2">
                                                <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-cancel" onclick="window.location.href='<?php echo site_url('welfare/inform1/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                                </div>
                                              </div><!-- close class row-->

                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==15){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
          $tmp = $this->admin_model->getOnce_Application(18);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(18,get_session('user_id')); //Check User Permission
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
            <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>


           <!--
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
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>
           -->

         </div>
         <br/>

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
