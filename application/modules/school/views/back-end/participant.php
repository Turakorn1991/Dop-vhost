
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                        
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(13);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
                              ?>
                                <a href="<?php echo site_url('school/school1/Edit/'.$schl_id);?>" <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?>  <?php }?>  <?php if($usrpm['app_id']==13){?>aria-expanded="true" <?php }?>> (1) โรงเรียน</a>
                              
                             
                            </li>

                           
                            <li>

                              <?php 
                                $tmp = $this->admin_model->getOnce_Application(14);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
                              ?>
                                <a href="<?php echo site_url('school/photo2/Edit/'.$schl_id);?>" <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?>  <?php }?>   <?php if($usrpm['app_id']==14){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <?php ?>
                           
                          
                          
                        

                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(5);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(5,$user_id); //Check User Permission
                              ?>
                                <a href="<?php echo site_url('school/generation3');?>" <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/generation3/Edit/'.@$adm_info['adm_id']);?>" <?php }?>  <?php if($usrpm['app_id']==15){?>aria-expanded="true" <?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <strong>Tab-1</strong>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==60){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==61){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                             
                                  <!--
                                  <h3>ข้อมูลผู้สูงอายุู (ผู้เข้าร่วม)</h3><hr>

                                    <div class="row">
                                      <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                          <h2 style="color: #4e5f4d"></h2>
                                          <div class="col-lg-12 text-right  border-bottom">

                                                &nbsp;
                                                <?php
                                                  $tmp = $this->admin_model->getOnce_Application(3);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                ?>
                                                 <a data-toggle="modal" data-target="#confirmsave" style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </a>
                                                                                               
                                                &nbsp;
                                                <?php
                                                  $tmp = $this->admin_model->getOnce_Application(3);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                ?>
                                                <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                  readonly
                                                <?php }else{?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id);?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                                </a>

                                          </div>
                                      </div>
                                  </div>
                                  -->

                                     <div id="tmp_menu" hidden='hidden'>

                                           <?php
                                              $tmp = $this->admin_model->getOnce_Application(3); 
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                            ?>
                                            <a onclick="return opnBck()" class="navbar-minimalize minimalize-styl-2 btn btn-primary"  style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }else{?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id); ?>" 
                                            <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-caret-left" aria-hidden="true"></i> </a>

                                          <?php
                                            $tmp = $this->admin_model->getOnce_Application(59); 
                                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                                          ?>
                                          <a data-toggle="modal" data-target="#confirmsave" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                          <?php if(!isset($tmp1['perm_status'])) {?>
                                                  readonly 
                                                <?php }else{?>
                                          <?php }?> title="บันทึกข้อมูลนักเรียน<?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                          <i class="fa fa-plus" aria-hidden="true"></i> 
                                          </a>

                                           <?php
                                            $tmp = $this->admin_model->getOnce_Application(59); 
                                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                                          ?>
                                          <a onclick="uploadxls();" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                          <?php if(!isset($tmp1['perm_status'])) {?>
                                                  readonly 
                                                <?php }else{?>
                                          <?php }?> title="นำเข้าข้อมูลนักเรียน (xls)<?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                          <i class="fa fa-download" aria-hidden="true"></i> 
                                          </a>
                                          <input type="file" name="" id="uploadxls" style="display: none;">

                                        
                                          <!--
                                          <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                          -->
                                      </div>
                                        <script>
                                          setTimeout(function(){
                                            $("#menu_topright").html($("#tmp_menu").html());
                                          },300);

                                          function uploadxls(){
                                           $("#uploadxls").click();
                                          }
                                        </script>

                                  

                                  <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                    <thead style="font-size: 15px;">
                                      <tr>
                                          <th style="width:2% !important;" class="text-center">ลำดับ</th>
                                          <th style="width:12% !important;" class="text-center">เลขประจำตัว ปชช.</th>
                                          <th style="width:38% !important;" class="text-center">ชื่อ-นามสกุล</th>
                                          <th style="width:7% !important;" class="text-center">อายุ (ปี)</th>
                                          <th style="width:10% !important;" class="text-center">เบอร์โทรศัพท์ (มือถือ)</th>
                                          <th class="text-center">โรคประจำตัว (ถ้ามี)</th>
                                          <th style="width:1% !important;" class="text-center">&nbsp;</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $number = 1;

                                      ?>
                                         <?php
                                           foreach ($schl_stu as $key_stu => $value_stu) {
                                            //dieArray($schl_stu);
                                          ?>
                                                
                                              <tr>
                                                  <td class="lnk text-center"><?php echo $number; ?></td>
                                                  <td class="lnk text-center"><?php echo $value_stu['pid']; ?></td>
                                                  <td class="lnk text-center"><?php echo $value_stu['pren_code'].' '.$value_stu['pers_firstname_th'].' '.$value_stu['pers_lastname_th']; ?></td>
                                                  <td class="lnk text-center">
                                                      <?php
                                                            $age = '';
                                                            if($value_stu['date_of_birth']!='') {
                                                              $date = new DateTime($value_stu['date_of_birth']);
                                                              $now = new DateTime();
                                                              $interval = $now->diff($date);
                                                              $age = $interval->y;
                                                              echo $age;
                                                            }
                                                      ?>
                                                  </td>
                                                  <td class="lnk text-center"><?php if($value_stu['tel_no_mobile']!=''){  echo $value_stu['tel_no_mobile'];}else {echo "-"; } ?></td>
                                                  <td class="lnk text-center"><?php if($value_stu['healthy_congenital_disease']!=''){ echo "<font style=\"color:#FF9800;\">".$value_stu['healthy_congenital_disease']."</font>"; }else{ echo "-"; }  ?></td>
                                                  <td align="right">

                                                   
                                                    
                                                    
                                                    <?php
                                                      $tmp = $this->admin_model->getOnce_Application(3);
                                                      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                    ?>
                                                    <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                      readonly
                                                    <?php }else{?>  <?php }?> data-toggle="modal" data-target="#confirmsave_<?php echo $value_stu['stu_id'];?>" title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                                                        <i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i>
                                                    </a>
                                                    
                                                    &nbsp;
                                                    <a data-toggle="modal" data-target="#prt<?php echo $value_stu['pid']; ?>" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                      <i class="fa fa-file-text" aria-hidden="true" style="color: #000"></i>
                                                    </a>

                                                    &nbsp;
                                                    <a  data-toggle="modal" data-target="#dltModel<?php echo $value_stu['pid']; ?>" title="ลบ" type="button" class="btn btn-default">
                                                        <i class="fa fa-trash" aria-hidden="true" style="color: #000"></i>
                                                    </a>

                                                    
            <!-- Print Modal -->
            <div class="modal fade" id="prt<?php echo $value_stu['pid']; ?>" role="dialog">
              <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
              <div class="modal-header text-left">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="color: #333; font-size: 20px;">พิมพ์แบบฟอร์ม</h4>
              </div>
              <div class="modal-body">
              <div class="row ">
              <!--
              <?php
                $tmp  = $this->admin_model->getOnce_Application(49);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(49, get_session('user_id')); //Check User Permission
                    ?>
                                                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                            <?php
                                if (!isset($tmp1['perm_status'])) {?>
                                                            class="disabled"
                                                            <?php
                              } else if ($usrpm['app_id'] == 49) {
                                      ?>
                                                            class="active"
                                                            <?php
                              }
                                  ?>
              >
              -->
                  <div class="col-xs-12 col-sm-12 text-left">
                      <a style="color: #333; font-size: 20px;" target="_blank"
                      href="<?php echo site_url('report/G6/pdf?id='.$value_stu['stu_id']); ?>"><i class="fa fa-print"
                      aria-hidden="true"></i> ส่งออกไฟล์ วุฒิบัตรการสำเร็จการศึกษา (G6) (PDF)
                       <!--<?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>-->
                      </a>
                  </div>
              </div>

              </div>

              </div>
              <br />

              </div>
              </div>

              </div>
              </div>
              <!-- End Print Modal -->

                                                  </td>
                                              </tr>

                                              <!-- Delete Modal -->
                                              <div id="dltModel<?php echo $value_stu['pid']; ?>" class="modal fade" role="dialog">
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
                                                      <a href="<?php echo base_url('school/participant/Delete/'.$value_stu['schl_id'].'/'.$value_stu['gen_id'].'/'.$value_stu['stu_id']); ?>"><button  type="button" class="btn btn-danger">ตกลง</button></a>
                                                      <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <!-- End Delete Model -->

            <!-- modal ยืนยันการบันทึกข้อมูล -->
            <div class="modal fade" id="confirmsave_<?php echo $value_stu['stu_id'];?>" role="dialog">
                <div class="modal-dialog">
                   <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(158, 158, 158, 0.15);">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title" style="color: #333; font-size: 20px;" id="head_model_<?php echo $value_stu['stu_id'];?>">ยืนยันการแก้ไขข้อมูล</h4>
                     </div>
                    <div class="modal-body">

                          <div id="input_data_<?php echo $value_stu['stu_id']; ?>">
                               
                               <?php                                
                                    echo form_open_multipart('school/participant/Edited/'.$schl_id.'/'.$gen_id);
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->


                                  <div class="form-group row">
                                       <div class="col-xs-12 col-sm-12">
                                         <label >เลขประจำตัวประชาชน</label>
                                         <input title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text" value="<?php echo $value_stu['pid']; ?>" name="schl_stu[pid]" id="req_pid" readonly required>
                                       </div>
                                       <div class="col-sm-12"><br></div>
                                       <div class="col-xs-12 col-sm-12">
                                            <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                            <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control"  type="text" name="tel_no_mobile" value="<?php echo $value_stu['tel_no_mobile']; ?>">
                                            <input type="hidden" name="stu_id" value="<?php echo $value_stu['stu_id']; ?>">
                                            <input type="hidden" name="pers_id" value="<?php echo $value_stu['pers_id']; ?>">
                                        </div>
                                        <div class="col-sm-12"><br></div>
                                       <div class="col-xs-12 col-sm-12">
                                         <label >โรคประจำตัว (ถ้ามี)</label>
                                         <input type="text" class="form-control" name="healthy_congenital_disease"  placeholder="ระบุโรคประจำตัว (ถ้ามี)" value="<?php echo $value_stu['healthy_congenital_disease']; ?>">
                                       </div>
                                       <div class="col-xs-12 col-sm-12">
                                         <br>
                                        <button type="submit" class="btn btn-default" style="margin-bottom: -23px;" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

                                      </div>
                                  </div><!-- close  <div class="form-group row">-->

                                  <?php echo form_close(); ?>
                                         
                             </div><!-- close input_data-->
                       
                        <!--
                          <div id="show_detail_<?php //echo $value_stu['stu_id']; ?>">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4"><label>เลขประจำตัวประชาชน :</label></div>
                                <div class="col-xs-12 col-sm-8" ><?php //echo $value_stu['pid']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4"><label>ชื่อตัว-ชื่อสกุล :</label></div>
                                <div class="col-xs-12 col-sm-8"><?php //echo $value_stu['pren_code'].' '.$value_stu['pers_firstname_th'].' '.$value_stu['pers_lastname_th']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4"><label>วันเดือนปีเกิด (อายุ) :</label></div>
                                <div class="col-xs-12 col-sm-8" >
                                <?php /*

                                  $age = '';
                                  if($value_stu['date_of_birth']!='') {

                                  $date = new DateTime($value_stu['date_of_birth']);
                                  $now = new DateTime();
                                  $interval = $now->diff($date);
                                  $age = $interval->y;
                                  $value_age = formatDateThai($value_stu['date_of_birth']).' (อายุ '.$age.' ปี)';
                                  echo $value_age;
                                 }*/
                                ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8"></div>
                                <div class="col-xs-12 col-sm-4">
                                  <button class="btn btn-default" type="button" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                  <button id="undo_model" class="btn btn-default" ><i class=" fa fa-undo" aria-hidden="true"></i></button>
                                  <button id="close_model" class="btn btn-default" type="button" data-dismiss="modal" ><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div> close show detail-->

                      </div><!-- close modal-body -->
                  </div><!-- close modal-content -->
                </div><!-- close modal-dialog -->        
            </div><!-- close modal-->

                                        <script type="text/javascript">

                                            $('#show_detail_<?php echo $value_stu['stu_id']; ?>').hide();
                                            
                                            $('#btn_save_<?php echo $value_stu['stu_id']; ?>').click(function(){
                                                  
                                                  $('#input_data_<?php echo $value_stu['stu_id']; ?>').hide();
                                                  $('#show_detail_<?php echo $value_stu['stu_id']; ?>').show();
                                            });

                                        </script>


                                          <?php
                                            $number++; 
                                            }// close loop foreach ($schl_stu as $key => $value)
                                         ?>

                                    </tbody>
                                  </table>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>

           <!-- modal ยืนยันการบันทึกข้อมูล -->
            <div class="modal fade" id="confirmsave" role="dialog">
                <div class="modal-dialog">
                   <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: rgba(158, 158, 158, 0.15);">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title" style="color: #333; font-size: 20px;" id="head_model">ยืนยันการบันทึกข้อมูล</h4>
                     </div>
                    <div class="modal-body">

                          <div id="input_data">
                               
                               <?php
                                    $schl = '';

                                    if($process_action=='Add'){$process_action = 'Added'; $schl = '/'.$schl_id.'/'.$gen_id;}
                                    if($process_action=='Edit'){$process_action = 'Edited'; $schl = '/'.$schl_id.'/'.$gen_id;}

                                    echo form_open_multipart('school/participant/'.$process_action.$schl,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">

                                  <div class="form-group row">
                                       <div class="col-xs-12 col-sm-12">
                                         <label >เลขประจำตัวประชาชน</label>
                                         <input title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text" value="" name="schl_stu[pid]" id="req_pid" required>
                                       </div>
                                       <div class="col-sm-12"><br></div>
                                       <div class="col-xs-12 col-sm-12">
                                            <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                            <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" id="tel_no_mobile" type="text" name="tel_no_mobile" value="">
                                            <input type="hidden" name="pers_id" id="pers_id" value="">
                                        </div>
                                        <div class="col-sm-12"><br></div>
                                       <div class="col-xs-12 col-sm-12">
                                         <label >โรคประจำตัว (ถ้ามี)</label>
                                         <input type="text" class="form-control" name="healthy_congenital_disease" id="healthy_congenital_disease" placeholder="ระบุโรคประจำตัว (ถ้ามี)" value="">
                                       </div>
                                       <div class="col-xs-12 col-sm-12">
                                         <br>
                                        <button id="btn_save" type="button" class="btn btn-default" style="margin-bottom: -23px;" ><i class="fa fa-floppy-o" aria-hidden="true"></i></button>

                                      </div>
                                  </div><!-- close  <div class="form-group row">-->

                                  <?php echo form_close(); ?>

                                           <script>
                                                        var req_pers = null;
                                                        $("#btn_save").click(function(){

                                                          if($("#req_pid").val()!='') {
                                                             var split_req_pid = $("#req_pid").val().split("-");
                                                             var sum_split     = parseInt(split_req_pid[0]+split_req_pid[1]+split_req_pid[2]+split_req_pid[3]+split_req_pid[4]);
                                                             
                                                             var status_req_pid = 'true';

                                                            $('#dtable > tbody > tr > td:eq(1)').each(function(){
                                                              var req_pid = parseInt($(this).html());
                                                                   if(sum_split==req_pid){
                                                                       status_req_pid = 'false'; 
                                                                   }
                                                                  
                                                            });

                                                            console.log(status_req_pid);


                                                            if(status_req_pid=='true'){
                                                                           
                                                                  $.ajax({
                                                                  url: '<?php echo site_url('personals/getPersonalInfo');?>',
                                                                  type: 'POST',
                                                                  dataType: 'json',
                                                                  data: {
                                                                      pid: $("#req_pid").val(),
                                                                      <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                                                  },
                                                                    success: function (value) {
                                                                      console.log("success");
                                                                      console.dir(value);
                                                                      console.log(value.name);
                                                                      if(value.name!=undefined){
                                                                            req_pers = value;

                                                                            $('#pers_id').val(value.pers_id);
                                                                            $('#model_pid').html(value.pid);

                                                                            var prefix ='';

                                                                            if(value.pren_code!=null){prefix=value.pren_code;}
                                                                            $("#name").html(prefix+' '+value.pers_firstname_th+' '+value.pers_lastname_th);
                                                                            $("#req_date_of_birth").html(value.date_of_birth);             
                                                                            
                                                                            if($('#tel_no_mobile')==''){
                                                                                $("#tel_no_mobile").val(value.tel_no_mobile);
                                                                             }

                                                                             if($('#healthy_congenital_disease')==''){
                                                                                $('#healthy_congenital_disease').val(value.healthy_congenital_disease);
                                                                             }

                                                                             $('#input_data').hide();//ซ่อนช่องกรอกข้อมูล
                                                                             $('#head_model').html("ยืนยันการบันทึกข้อมูล");//เปลี่ยนหัวข้อ title
                                                                             $('#show_detail').show();//แสดงข้อมูลการยืนยันการบันทึกข้อมูล
                                                                        }else{
                                                                        alert('ไม่พบข้อมูล กรุณากรอกข้อมูลใหม่');
                                                                        $("#req_pid").val('');
                                                                        $("#req_pid").focus();
                                                                      }
                                                                    },
                                                                    error:function() {
                                                                      console.log("error");
                                                                      alert('เกิดข้อผิดพลาดในการค้นหาข้อมูล กรุณากรอกข้อมูลใหม่');
                                                                    },
                                                                  });

                                                               }else{
                                                                alert('เลขประจำตัวประชาชน ซ้ำกับข้อมูลในตาราง');
                                                                $("#req_pid").val('');
                                                                $("#req_pid").focus();
                                                             }// close loop if(status_req_pid==true)*/

                                                          }else {
                                                             alert('กรุณากรอก เลขประจำตัวประชาชน');
                                                             $("#req_pid").focus();
                                                          }
                                                          //$("#req_pers_id").val('');
                                                        });

                                                        function btn_submit(){
                                                          $('[name=bt_submit]').click();
                                                        }
                                                      </script>


                                                 </div><!-- close input_data-->
                       
                          <div id="show_detail">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4"><label>เลขประจำตัวประชาชน :</label></div>
                                <div class="col-xs-12 col-sm-8" id="model_pid"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4"><label>ชื่อตัว-ชื่อสกุล :</label></div>
                                <div class="col-xs-12 col-sm-8" id="name"></div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-4"><label>วันเดือนปีเกิด (อายุ) :</label></div>
                                <div class="col-xs-12 col-sm-8" id="req_date_of_birth"></div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-sm-8"></div>
                                <div class="col-xs-12 col-sm-4">
                                  <button class="btn btn-default" type="button" onclick="btn_submit()"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                  <button id="undo_model" class="btn btn-default" ><i class=" fa fa-undo" aria-hidden="true"></i></button>
                                  <button id="close_model" class="btn btn-default" type="button" data-dismiss="modal" onclick="close_model()"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div><!-- close show detail-->



                    </div><!-- close modal-body -->
                  </div><!-- close modal-content -->
                </div><!-- close modal-dialog -->        
            </div><!-- close modal-->

           <script type="text/javascript">

               $('#show_detail').hide();//ซ่อนเนื้อหาแสดงข้อมูลการยืนยันการบันทึกข้อมูล
               $('#head_model').html("บันทึกข้อมูล");//เพิ่มหัวข้อ title

               
              
               //ถ้าผู้ใข้คลิกปุ่ม ย้อนกลับให้ ซ่อนเนื้อหาการแสดงข้อมูล แล้วแสดงช่องกรอกข้อมูล
               $('#undo_model').click(function(){
                   $('#input_data').show();//ซ่อนช่องกรอกข้อมูล
                   $('#show_detail').hide();//ซ่อนเนื้อหาแสดงข้อมูลการยืนยันการบันทึกข้อมูล
                   $('#head_model').html("บันทึกข้อมูล");//เพิ่มหัวข้อ title
               });

               function close_model(){
                 $('#req_pid,#tel_no_home,#pers_id').val('');
                 $('#input_data').show();//ซ่อนช่องกรอกข้อมูล
                 $('#show_detail').hide();//ซ่อนเนื้อหาแสดงข้อมูลการยืนยันการบันทึกข้อมูล
                 $('#head_model').html("บันทึกข้อมูล");//เพิ่มหัวข้อ title
               }



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

<!-- Confirm Save Form  Modal -->
<div id="dltCnfrm" class="modal fade" role="dialog">
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
            <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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

         </div>
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
