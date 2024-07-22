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
                                  <?php }else{?> href="<?php echo site_url('welfare/inform1/Edit/'.@$adm_info['adm_id']);?>" <?php }?>  <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }?>> (1) แจ้งความประสงค์</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(14);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/admission2/Edit/'.@$adm_info['adm_id']);?>" <?php }?>  <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }?>>(2) รับเข้า/จำหน่าย</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(15);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/estimate3/Edit/'.@$adm_info['adm_id']);?>" <?php }?>  data-toggle="tab" href="#tab-3" <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) ประเมินสมรรถภาพ</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==13){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-1</strong>
                                </div>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==14){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-2</strong>
                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==15){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>

                                <div class="panel-body">

                                   <!--
                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d"></h2>
                                            <div class="col-lg-12 text-right  border-bottom">

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(15);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึก" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>

                                                  <a href="<?php echo site_url('welfare/estimate3/View/'.@$adm_info['adm_id']);?>" href="" style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                     <i class="fa fa-undo" aria-hidden="true"></i>
                                                 </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(15);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
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
                                          $tmp = $this->admin_model->getOnce_Application(13);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
                                        ?>
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                        <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?> onclick="return opnCnfrom()"
                                        <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                        </a>
                                        -->


                                        <!--
                                        <?php if($process_action=='Edit') { ?>
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"  data-id=111 onclick="opn(this)" title="ลบข้อมูล">
                                        <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                        <?php }?>




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
                                      if($process_action=='Add'){$process_action = 'Added'; $adm_id = '/'.$adm_info['adm_id'];}
                                      if($process_action=='Edit'){$process_action = 'Edited'; $adm_id = '/'.$adm_info['adm_id'].'/'.$adm_irp['irp_id'];}
                                      echo form_open_multipart('welfare/inform4/'.$process_action.$adm_id,array('id'=>'form1'));
                                      ?>
                                      <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                      <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                                      <p class="text-danger"><font color=red><?php echo validation_errors();?></font></p>

                                      <div class="panel-group">
                                        <div class="panel panel-default" style="border: 0">
                                          <div class="panel-heading"><h4>แบบประเมินสมรรถภาพรายบุคคลและการฟื้นฟู</h4></div>
                                            <div class="panel-body" style="border:0; padding: 20px;">

                                                  <div class="col-xs-12 col-sm-3 has-error">
                                                      <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ประเมิน </label>
                                                      <div id="datetimepicker1" class="col-3 input-group date" data-date-format="dd-mm-yyyy">
                                                          <input title="วันที่ประเมิน" placeholder="เลือกวันที่" class="form-control" type="text" name="adm_irp[date_of_irp]" required />
                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                      </div>

                                                            <script type="text/javascript">
                                                              <?php
                                                              $tmp = explode('-',@$adm_irp['date_of_irp']);
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
                                                  <div class="col-xs-12 col-sm-6 col-sm-offset-3">
                                                       <label  class="col-2 col-form-label">เจ้าหน้าที่ผู้ประเมิน </label>
                                                       <input title="เจ้าหน้าที่ผู้ประเมิน" placeholder="ระบุ (คำนำหน้า) ชื่อตัว - ชื่อสกุล" class="form-control" onkeyup="thvalidate(this)" type="text" name="adm_irp[irp_name]" value="<?php echo @$adm_irp['irp_name']; ?>"/>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-12 "><br></div>
                                                  <div class="col-xs-12 col-sm-6">
                                                       <label  class="col-2 col-form-label">พยาบาล (เจ้าหน้าที่ปฏิบัติหน้าที่แทน) </label>
                                                       <input title="พยาบาล" placeholder="ระบุ (คำนำหน้า) ชื่อตัว - ชื่อสกุล" class="form-control" type="text" onkeyup="thvalidate(this)" name="adm_irp[nurse_name]" value="<?php echo @$adm_irp['nurse_name']; ?>"/>
                                                  </div>

                                                  <div class="col-xs-12 col-sm-6">
                                                       <label  class="col-2 col-form-label">นักสังคมสงเคราะห์ (เจ้าหน้าที่ปฏิบัติหน้าที่แทน) </label>
                                                       <input title="นักสังคมสงเคราะห์" placeholder="ระบุ (คำนำหน้า) ชื่อตัว - ชื่อสกุล" class="form-control"  onkeyup="thvalidate(this)" type="text" name="adm_irp[almoner_name]" value="<?php echo @$adm_irp['almoner_name']; ?>"/>
                                                  </div>
                                            </div><!-- close panel-body-->
                                          </div><!-- close panel-default-->
                                        </div><!-- close panel-group-->
                                    </div><!-- close form-group row-->

                                     <?php

                                        $count = count($this->common_model->custom_query("SELECT * FROM std_irp WHERE qstn_type='Question'"));

                                     ?>

                                     <input type="hidden" id="count_dim" value="<?php echo $count; ?>">

                                     <script type="text/javascript">



                                        $(function(){

                                            set_text_score('#sum_score',<?php echo $count; ?>,0);
                                            che_progress('#dimension_score',0);//กำหนดค่าเริ่มต้นคะแนนรวมทั้งหมด
                                        });
                                        $("#guide-book").click(function(){
                                          window.open('/assets/modules/welfare/guide/Adm_Manual.pdf', '_blank');
                                        });
                                     </script>

                                    <div class="form-group row" style="margin-bottom: 0px;">
                                      <div class="panel-group" style="margin-bottom: 10px;">
                                        <div class="panel panel-default" style="border: 0">
                                          <div class="panel-heading">
                                              <div class="row">
                                                <div class="col-xs-12 col-sm-8"><h4>แบบประเมินสมรรถภาพรายบุคคล </h4></div>
                                                <div class="col-xs-12 col-sm-4" align="right">
                                                  <b style=" margin-right: 6px;  position: relative;top: 5px;" id="sum_score"></b>
                                                  <div class="progress" style="float: right; background-color: rgba(96, 125, 139, 0.32);width: 42%;margin: 0px;margin-top: 6px; margin-right: 12px;">
                                                    <div class="progress-bar progress-bar-success " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" id="dimension_score">
                                                       <!-- set data to jquery-->

                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                          </div>
                                          <!-- <div class="panel-body" style="border: none;"></div> -->
                                        </div><!-- close panel-default-->
                                      </div><!-- close panel-group-->
                                    </div><!-- close form-group row-->

                                    <div class="panel-group" id="accordion">
                                      <?php

                                      $dimension = $this->welfare_model->getAll_irpDimension();
                                         // dieArray($dimension);
                                      $count_sum_dim = 0;
                                      foreach ($dimension as $AiKey => $AiRow) {
                                        $count_sum_dim +=$AiRow['ans_full_score'];
                                      }

                                      foreach ($dimension as $diKey => $diRow) {

                                        $count_dim = count($this->common_model->custom_query("SELECT * FROM std_irp WHERE qstn_type='Question' AND qstn_pid={$diRow['qstn_id']}"));

                                        ?>

                                        <script type="text/javascript">
                                          //กำหนดเปอร์เซ็นแต่ละมิติ
                                          $(function(){
                                             set_text_score('#title_dimension<?php echo $diRow['qstn_id']; ?>',<?php echo $count_dim; ?>,0);
                                             che_progress('#progress_dimension<?php echo $diRow['qstn_id']; ?>',0);//กำหนดค่าเริ่มต้นคะแนนรวมทั้งหมด
                                           });
                                         </script>

                                        <input type="hidden" id="count_sum_dim" value="<?php echo $count_sum_dim; ?>">
                                        <input type="hidden" id="score_dimension<?php echo $diRow['qstn_id']; ?>" value="<?php echo $diRow['ans_full_score']; ?>">

                                         <div class="panel panel-default" style="border: none;">
                                          <div class="panel-heading">
                                            <div class="row">
                                              <div class="col-xs-12 col-sm-8">
                                                <h4 style="display: inline-block;" class="panel-title" style="width: 70%">
                                                  <a style="display: block; width: 100%;" data-toggle="collapse" data-parent="#accordion" href="#dimension<?php echo $diRow['qstn_id']; ?>">มิติที่ <?php echo $diKey +1; ?> : <?php echo $diRow['qstn_title']; ?></a>
                                                </h4>
                                              </div>
                                              <div class="col-xs-12 col-sm-4" align="right">
                                                <!-- <div class="col-xs-12 col-sm-8"><label>มิติที่ <?php echo $diKey +1; ?> : <?php echo $diRow['qstn_title']; ?> </label></div> -->
                                                <b style=" margin-right: 10px;  position: relative;top: 5px;" id="title_dimension<?php echo $diRow['qstn_id']; ?>"></b>
                                                <div class="progress" style="float: right; background-color: rgba(96, 125, 139, 0.32);width: 42%;margin: 0px;margin-top: 6px;">
                                                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" id="progress_dimension<?php echo $diRow['qstn_id']; ?>">
                                                    60%
                                                  </div>
                                                </div>
                                              </div>
                                            </div>

                                          </div>



                                          <div id="dimension<?php echo $diRow['qstn_id']; ?>" class="panel-collapse collapse in" <?php //if($diKey == 0){ echo "in"; } ?> >
                                            <div class="panel-body" style="border: none; padding: 10px 0;">


                                              <table class="table table-bordered">
                                                <thead>
                                                  <tr>
                                                    <th style="width:5%; text-align:center;">ลำดับ</th>
                                                    <th> &nbsp;ข้อคำถาม</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                  $question =  $this->welfare_model->getAll_irpQuestion($diRow['qstn_id']);
                                                 // dieArray($question);
                                                  foreach ($question as $qkey => $qRow) {
                                                  $ans_result = $this->welfare_model->get_adm_irp_result($adm_irp['irp_id'],$qRow['qstn_id']);
                                                  ?>
                                                  <tr>
                                                    <td align="center"><span class="badge"><?php echo $qkey+1; ?></span></td>
                                                    <td>
                                                      <div class="form-group row">
                                                        <label class="col-xs-10 col-sm-10 "><?php echo $qRow['qstn_title']; ?></label>
                                                        <input type="hidden" name="question[<?php echo $qRow['qstn_id']; ?>][ans_full_score]" value="<?php echo $qRow['ans_full_score']; ?>">
                                                        <input type="hidden" id="set_point_answer_id<?php echo $qRow['qstn_id'];?>" name="point_answer_id[<?php echo $qRow['qstn_id']; ?>]" value="<?php echo (isset($ans_result['ans_points']))?$ans_result['ans_points']:'';?>">
                                                        <input type="hidden" id="set_ans_answer_id<?php echo $qRow['qstn_id'];?>" name="ans_answer_id[<?php echo $qRow['qstn_id']; ?>]" value="<?php echo (isset($ans_result['ans_id']))?$ans_result['ans_id']:'';?>">
                                                        <div class="col-xs-2 col-sm-2" align="right">
                                                          <?php $irp_result = @$this->welfare_model->get_Percentage($adm_irp['irp_id'],$qRow['qstn_id']);?>
                                                          <div class="progress" style="margin-bottom: 0px; background-color: #c6cfd4; margin-right: 7px;">
                                                            <div id="id<?php echo $qRow['qstn_id']; ?>" style="width: <?php echo @round($irp_result['ans_percent'],2)."%"; ?>" aria-valuemax="100" aria-valuemin="0" aria-valuenow="<?php echo @round($irp_result['ans_percent'],2); ?>" role="progressbar" class="progress-bar progress-bar-success">
                                                              <span><?php echo @round($irp_result['ans_percent'],2)." %"; ?></span>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <?php
                                                        $answer =  $this->welfare_model->getAll_irpAnswer($qRow['qstn_id']);

                                                        foreach ($answer as $akey => $aRow) {
                                                          $ans_result = $this->welfare_model->get_adm_irp_result($adm_irp['irp_id'],$qRow['qstn_id']);
                                                        ?>
                                                        <div class="col-xs-12 col-sm-12">

                                                          <div class="i-checks">
                                                            <label>
                                                              <input type="hidden" value="dimension<?php echo $diRow['qstn_id']; ?>">
                                                              <input type="hidden" value="<?php echo $qRow['ans_full_score']; ?>">
                                                              <input type="radio" id="answer_id<?php echo $qRow['qstn_id'].'_'.$aRow['qstn_id'];?>" class="answer_id<?php echo $qRow['qstn_id']; ?>" name="answer_id<?php echo $qRow['qstn_id'];?>[<?php echo $qRow['qstn_id']; ?>]" value="<?php echo $aRow['ans_full_score']; ?>" <?php if(@$ans_result['ans_id'] == $aRow['qstn_id']){ echo "checked"; } ?>>
                                                              <!-- <input type="hidden" name="answer_point[<?php echo $aRow['qstn_id']; ?>]" value="<?php echo $aRow['ans_full_score']; ?>"> -->
                                                              <?php echo $aRow['qstn_title']; ?>
                                                            </label>
                                                          </div>

                                                        </div>
                                                        <script type="text/javascript">
                                                          //กำหนดเปอร์เซ็นแต่ละมิติ
                                                          $(function(){
                                                            che_ans_dimension('dimension<?php echo $diRow['qstn_id']; ?>')//คำนวณจำนวนข้อคำถามที่เลือก
                                                            add_progree('answer_id<?php echo $qRow['qstn_id']; ?>','<?php echo $aRow['ans_full_score']; ?>');//กำหนดเปอร์เซ็น
                                                            che_sum_dimension();
                                                          });
                                                        </script>
                                                        <?php } ?>
                                                      </div>
                                                    </td>
                                                  </tr>
                                                  <?php } ?>
                                                </tbody>
                                              </table>

                                              <div class="form-group row" style="display: none;">
                                                <div class="col-xs-12 col-sm-7 col-sm-offset-1"><label>โปรแกรมการฟื้นฟูสมรรถภาพรายบุคคล</label></div>
                                                <div class="col-xs-12 col-sm-4"><label>ดำเนินการภายใน (วัน)</label></div>
                                              </div>

                                              <div class="form-group row" style="display: none;">
                                                <?php
                                                $prgmList = $this->welfare_model->getAll_Progarm($diRow['qstn_id']);

                                                ?>
                                                <?php foreach ($prgmList as $key => $prmgRow) { ?>
                                                <div class="col-xs-12 col-sm-7 col-sm-offset-1">
                                                 <div class="i-checks">
                                                  <label><input  type="checkbox" name="adm_trm_result[<?php echo $diRow['qstn_id'] ?>][prgm_id][<?php echo $prmgRow['prgm_id']; ?>]" value="<?php echo $prmgRow['prgm_id']; ?>" <?php if(@$adm_trm_result[$prmgRow['prgm_id']]['prgm_id'] == $prmgRow['prgm_id']){ echo "checked"; } ?>> <?php echo $prmgRow['prgm_title']; ?></label></div>
                                                  <!-- <input type="hidden" name=""> -->
                                                </div>
                                                <div class="col-xs-12 col-sm-4"><input id="time-<?php echo $diRow['qstn_id'].'-'.$prmgRow['prgm_id']; ?>" class="form-control" type="number" min='1' name="adm_trm_result[<?php echo $diRow['qstn_id'] ?>][treatment_within][<?php echo $prmgRow['prgm_id']; ?>]" value="<?php echo @$adm_trm_result[$prmgRow['prgm_id']]['treatment_within']; ?>" <?php if(!isset($adm_trm_result[$prmgRow['prgm_id']]['treatment_within'])){ echo "disabled";} ?>></div>
                                                <div class="col-xs-12 col-sm-12"><br></div>

                                                <script type="text/javascript">


                                                  $("input[name='adm_trm_result[<?php echo $diRow['qstn_id'] ?>][prgm_id][<?php echo $prmgRow['prgm_id']; ?>]']").on('ifChanged',function(){

                                                    if($(this).prop('checked')){
                                                     $("input[name='adm_trm_result[<?php echo $diRow['qstn_id'] ?>][treatment_within][<?php echo $prmgRow['prgm_id']; ?>]']").prop('disabled',false).focus();
                                                   }else{
                                                     $("input[name='adm_trm_result[<?php echo $diRow['qstn_id'] ?>][treatment_within][<?php echo $prmgRow['prgm_id']; ?>]']").prop('disabled',true);
                                                   }
                                                 });
                                               </script>
                                               <?php } ?>
                                             </div>

                                           </div>
                                         </div>


                                       </div>

                                       <?php } ?>
                                     </div>

                                    <hr>
                                              <div class="row">
                                               <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                               <div class="col-xs-12 col-sm-2">
                                                <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i>  บันทึก</button>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('welfare/estimate3/View/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                                </div>
                                              </div><!-- close class row-->




                                    <script type="text/javascript">

                                      $(document).ready(function () {
                                        $('.i-checks').iCheck({
                                          checkboxClass: 'icheckbox_square-green',
                                          radioClass: 'iradio_square-green',
                                          increaseArea: '20%'
                                        });
                                      });



                                      function set_enable(elem,target='') {
                                        if(elem.prop('checked') == true) {
                                          $(target).prop('disabled', false ).focus();
                                        }else{
                                          $(target).val('');
                                          $(target).prop('disabled', true );
                                        }
                                      }
                                    </script>
                                    <?php echo form_close(); ?>
                                </div><!-- close panel-body-->
                            </div><!-- close tab-3-->
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">

                //กำหนดค่าเปอร์เซ็น
                function che_progress(name_id,attr_value){
                  if(attr_value<=33.33){
                      var color_bar = "#F44336"; //สีแดง
                  }else if(attr_value<=66.66){
                      var color_bar = "#ffc107"; //สีเหลือง
                  }else{
                      var color_bar = "#4caf50"; //สีเขียว
                  }

                   $(name_id).attr('aria-valuenow',attr_value).css({"width":attr_value+"%","background-color":color_bar}).html(attr_value+'%');
                }

                //คำนวณคะแนนรวมทั้งหมด
                function set_text_score(name_id,count,score_ans){
                  var str_scroe = "(ตอบ "+score_ans+" จาก "+count+" ข้อ)";
                  $(''+name_id).html(str_scroe);
                }

                //คำนวณค่าเปอร์เซ็นในข้อคำถาม
                function add_progree(nameclass,score_full_ans){
                    $('.'+nameclass).each(function(){
                         if($(this).prop('checked')==true){
                             var score = parseInt($(this).val());
                             var progree_score = (score/score_full_ans)*100;
                             // console.log('คะแนนเต็มแต่ละข้อ ='+score_full_ans+' คะแนนที่เลือก ='+score+'เปอร์เซ็น ='+progree_score);
                             var id_spit = nameclass.split("_");
                             var name_id = '#'+id_spit[1];
                             var ans_spit_id = $(this).attr("id");
                             var ans_id =  ans_spit_id.split("_");
                              $("#set_point_"+nameclass).val($("#"+$(this).attr("id")).val());
                              $("#set_ans_"+nameclass).val(ans_id[2]);
                              $("#"+$(this).attr("id")).attr("checked", true);
                              $("#"+$(this).attr("id")).iCheck('check');
                              //console.log("id:"+$(this).attr("id")+" class:"+nameclass+":"+$("#"+$(this).attr("id")).val());
                             che_progress(name_id,progree_score.toFixed(2));
                              //console.log($("#"+$(this).attr("id")).attr("checked"));
                          }else{
                              //$("#set_point_"+nameclass).val('');
                            $("#"+$(this).attr("id")).attr("checked", false);
                            $("#"+$(this).attr("id")).iCheck('uncheck');
                          }
                     });
                }

                function che_ans_dimension(dimension_id){
                     // console.log(dimension_id);
                    var len_dim = ($('#'+dimension_id+' tr').length)-1;//จำนวนข้อคำถาม
                    var len_sum = $('#'+dimension_id+' input[type=radio]:checked').length;//จำนวนข้อที่ตอบ
                    var sum = 0;
                    var score_ans_full = parseInt($('#score_'+dimension_id).val());
                    // console.log(score_ans_full);
                    $('#'+dimension_id+' input[type=radio]:checked').each(function(){

                        sum += parseInt($(this).val());
                        //var score_val = parseInt();
                        score_sum = (sum/score_ans_full)*100;

                        set_text_score('#title_'+dimension_id,len_dim,len_sum);
                        che_progress('#progress_'+dimension_id,score_sum.toFixed(2));
                    });
                }

                function che_sum_dimension(){

                    var sum_ans_dimension = $(':radio:checked').length;//จำนวนข้อคำตอบที่ถูกเลือก
                    var sum_dimension_ans = parseInt($('#count_dim').val());//จำนวนข้อคำถามทั้งหมด
                    var sum_score_dim     = parseInt($('#count_sum_dim').val());
                    var sum_dimension     = 0;
                    $(':radio:checked').each(function(){
                        sum_dimension += parseInt($(this).val());//ผลรวมคะแนนคำตอบทั้ง 3มิติ
                    });

                    var count_sum_dim = (sum_dimension/sum_score_dim)*100;
                    //console.log(sum_score_dim);
                    set_text_score('#sum_score',sum_dimension_ans,sum_ans_dimension);
                    che_progress('#dimension_score',count_sum_dim.toFixed(2));//กำหนดค่าเริ่มต้นคะแนนรวมทั้งหมด
                }

                $(':radio').on('ifChanged',function(){
                     //คะแนนเต็มแต่ละข้อ
                     var score_full_ans = parseInt($(this).parent().prev().val());

                     //ข้อคำถามแต่ละมิติ เช่น มิติที่ 1,2,3
                     var dimension_id = $(this).parent().prev().prev().val();

                     che_ans_dimension(dimension_id)//คำนวณจำนวนข้อคำถามที่เลือก

                     add_progree(this.className,score_full_ans);//กำหนดเปอร์เซ็น

                     che_sum_dimension();

                });

                /*var classList = $('div').attr('class').split(/\s+/);
                $.each(classList, function(index, item) {
                    if (item === 'i-checks') {
                      $(':radio:checked').each(function(){
                          console.log('i-checks');
                      });
                    }
                });*/

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
         <br/>

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
