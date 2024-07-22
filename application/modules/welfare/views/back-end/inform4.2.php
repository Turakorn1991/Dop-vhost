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
                                  <?php }else{?> href="<?php echo site_url('welfare/inform1/Edit/'.@$adm_info['adm_id']);?>" <?php }?> style="border: 1px #eee solid;background-color: #fff; color: #333; padding-left: 30px; padding-right: 30px; font-size: 14px;" <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }?>> (1) แจ้งความประสงค์</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(4);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(4,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/inform2/Edit/'.@$adm_info['adm_id']);?>" <?php }?> style="border: 1px #eee solid;background-color: #fff; color: #333; padding-left: 30px; padding-right: 30px; font-size: 14px;" <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }?>>(2) รับเข้า/จำหน่าย</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(5);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(5,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/inform3/Edit/'.@$adm_info['adm_id']);?>" <?php }?> style="border: 1px #eee solid;background-color: #3D5263; color: #fff; padding-left: 30px; padding-right: 30px; font-size: 14px;" data-toggle="tab" href="#tab-3" <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) ประเมินสมรรถภาพ</a>
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

                                                  <a href="<?php echo site_url('welfare/estimate3/Edit/'.$adm_info['adm_id']);?>" href="" style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
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

                                    <div class="form-group row">
                                      <div class="panel-group">
                                        <div class="panel panel-default" style="border: 0">
                                          <div class="panel-heading"><h4>แบบประเมินสมรรถภาพรายบุคคลและการฟื้นฟู</h4></div>
                                            <div class="panel-body" style="border:0; padding: 20px;">

                                                  <div class="col-xs-12 col-sm-3">
                                                      <label for="datetimepicker1" class="col-2 col-form-label">วันที่ประเมิน </label>
                                                      <div id="datetimepicker1" class="col-3 input-group date" data-date-format="dd-mm-yyyy">
                                                          <input title="วันที่ประเมิน" placeholder="เลือกวันที่" class="form-control" type="text" name="adm_irp[date_of_irp]" required/>
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
                                                       <input title="เจ้าหน้าที่ผู้ประเมิน" placeholder="ระบุ (คำนำหน้า) ชื่อตัว - ชื่อสกุล" class="form-control" type="text" name="adm_irp[irp_name]" value="<?php echo @$adm_irp['irp_name']; ?>"/>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-12 "><br></div>
                                                  <div class="col-xs-12 col-sm-6">
                                                       <label  class="col-2 col-form-label">พยาบาล (เจ้าหน้าที่ปฏิบัติหน้าที่แทน) </label>
                                                       <input title="พยาบาล" placeholder="ระบุ (คำนำหน้า) ชื่อตัว - ชื่อสกุล" class="form-control" type="text" name="adm_irp[nurse_name]" value="<?php echo @$adm_irp['nurse_name']; ?>"/>
                                                  </div>

                                                  <div class="col-xs-12 col-sm-6">
                                                       <label  class="col-2 col-form-label">นักสังคมสงเคราะห์ (เจ้าหน้าที่ปฏิบัติหน้าที่แทน) </label>
                                                       <input title="นักสังคมสงเคราะห์" placeholder="ระบุ (คำนำหน้า) ชื่อตัว - ชื่อสกุล" class="form-control" type="text" name="adm_irp[almoner_name]" value="<?php echo @$adm_irp['almoner_name']; ?>"/>
                                                  </div>
                                            </div><!-- close panel-body-->
                                          </div><!-- close panel-default-->
                                        </div><!-- close panel-group-->
                                    </div><!-- close form-group row-->

                                    <div class="form-group row">
                                      <div class="panel-group">
                                        <div class="panel panel-default" style="border: 0">
                                          <div class="panel-heading">
                                              <div class="row">
                                                <div class="col-xs-12 col-sm-8"><h4>แบบประเมินสมรรถภาพรายบุคคล </h4></div>
                                                <div class="col-xs-12 col-sm-4" align="right"><b>(ตอบ 12 จาก 50 ข้อ) </b><div style="background-color:green; color:#fff; width:100px">23.00%</div></div>
                                              </div>
                                          </div>
  
                                          <div class="panel-body" style="border:0; padding: 20px;">
                                            <?php 
                                            $dimension = $this->welfare_model->getAll_irpDimension();
                                            foreach ($dimension as $diKey => $diRow) { ?>
                                                <div class="form-group row">
                                                     <div class="col-xs-12 col-sm-8"><label>มิติที่ <?php echo $diKey +1; ?> : <?php echo $diRow['qstn_title']; ?> </label></div>
                                                     <div class="col-xs-12 col-sm-4" align="right"><label>ตอบ (4 จาก 10 ข้อ) <div style="background-color:green; color:#fff; width:100px">55.00%</div></label></div>
                                                </div>
                                                <div class="">
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
                                                        foreach ($question as $qkey => $qRow) { ?>
                                                           <tr>
                                                            <td align="center"><span class="badge"><?php echo $qkey+1; ?></span></td>
                                                            <td>
                                                              <div class="form-group row">
                                                                  <label class="col-xs-10 col-sm-10 "><?php echo $qRow['qstn_title']; ?></label>
                                                                  <div class="col-xs-2 col-sm-2" align="right"><div style="background-color:green; color:#fff; width:100px">55.00%</div></div>

                                                                  <?php 
                                                                  $answer =  $this->welfare_model->getAll_irpAnswer($qRow['qstn_id']);
                                                                  foreach ($answer as $akey => $aRow) {?>
                                                                    <div class="col-xs-12 col-sm-12">
                                                                      <div class="radio">
                                                                        <label>
                                                                         <input type="radio" name="answer[<?php echo $qRow['qstn_id']; ?>][]"  value="<?php echo $aRow['qstn_id']; ?>">
                                                                         <?php echo $aRow['qstn_title']; ?>
                                                                        </label>
                                                                      </div>
                                                                    </div>
                                                                  <?php } ?>
                                                              </div>
                                                            </td>
                                                        </tr>
                                                      <?php } ?>
                                                     </tbody>
                                                  </table>
                                                </div><!-- close table-responsive-->
                                                <br>
                                                <br>
                                                <div class="form-group row">
                                                     <div class="col-xs-12 col-sm-7 col-sm-offset-1"><label>โปรแกรมการฟื้นฟูสมรรถภาพรายบุคคล</label></div>
                                                     <div class="col-xs-12 col-sm-4"><label>ดำเนินการภายใน (วัน)</label></div>
                                                     <div class="col-xs-12 col-sm-12"><br></div>
                                                     <div class="col-xs-12 col-sm-7 col-sm-offset-1"><input type="checkbox"> โปรแกรมจิตแพทย์ตรวจโรคทั่วไป</div>
                                                     <div class="col-xs-12 col-sm-4"><input type="form-control"></div>
                                                     <div class="col-xs-12 col-sm-12"><br></div>
                                                     <div class="col-xs-12 col-sm-7 col-sm-offset-1"><input type="checkbox"> โปรแกรมส่งเสริมและรักษาสุขภาพ เช่น ให้ความรู้เรื่องโรค</div>
                                                     <div class="col-xs-12 col-sm-4"><input type="form-control"></div>
                                                     <div class="col-xs-12 col-sm-12"><br></div>
                                                     <div class="col-xs-12 col-sm-7 col-sm-offset-1"><input type="checkbox"> โปรแกรมจิตแพทย์ตรวจโรคทั่วไป</div>
                                                     <div class="col-xs-12 col-sm-4"><input type="form-control"></div>
                                                     <div class="col-xs-12 col-sm-12"><br></div>
                                                     <div class="col-xs-12 col-sm-7 col-sm-offset-1"><input type="checkbox"> โปรแกรมจิตแพทย์ตรวจโรคทั่วไป</div>
                                                     <div class="col-xs-12 col-sm-4"><input type="form-control"></div>
                                                     <div class="col-xs-12 col-sm-12"><br></div>
                                                     <div class="col-xs-12 col-sm-7 col-sm-offset-1"><input type="checkbox"> อื่น ๆ  <input type="form-control" placeholder="อื่น ๆ (ระบุ)"></div>
                                                     <div class="col-xs-12 col-sm-4"><input type="form-control"></div>
                                                </div>
                                            <?php } ?>
                                          </div><!-- close panel-body-->

                                        </div><!-- close panel-default-->
                                      </div><!-- close panel-group-->
                                    </div><!-- close form-group row-->

                                    <div class="panel-group" id="accordion">
                                      <?php 
                                      $dimension = $this->welfare_model->getAll_irpDimension();
                                      foreach ($dimension as $diKey => $diRow) { ?>
                                      <div class="panel panel-default" style="border: none;">
                                        <div class="panel-heading">
                                          <h4 style="display: inline-block;" class="panel-title" style="width: 70%">
                                            <a style="display: block; width: 100%;" data-toggle="collapse" data-parent="#accordion" href="#dimension<?php echo $diRow['qstn_id']; ?>">มิติที่ <?php echo $diKey +1; ?> : <?php echo $diRow['qstn_title']; ?></a>
                                          </h4>
                                          <!-- <div class="col-xs-12 col-sm-8"><label>มิติที่ <?php echo $diKey +1; ?> : <?php echo $diRow['qstn_title']; ?> </label></div> -->
                                          <div style="width: 30%;float: right;text-align: right;"><label>ตอบ (4 จาก 10 ข้อ) <div style="background-color:green; color:#fff; width:100px; display: inline-block;">55.00%</div></label></div>
                                        </div>
                                        <div id="dimension<?php echo $diRow['qstn_id']; ?>" class="panel-collapse collapse <?php if($diKey == 0){ echo "in"; } ?>">
                                          <div class="panel-body" style="border: none; padding: 20px 0;">
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
                                                foreach ($question as $qkey => $qRow) { ?>
                                                   <tr>
                                                    <td align="center"><span class="badge"><?php echo $qkey+1; ?></span></td>
                                                    <td>
                                                      <div class="form-group row">
                                                          <label class="col-xs-10 col-sm-10 "><?php echo $qRow['qstn_title']; ?></label>
                                                          <input type="hidden" name="question[<?php echo $qRow['qstn_id']; ?>][ans_full_score]" value="<?php echo $qRow['ans_full_score']; ?>">
                                                          <div class="col-xs-2 col-sm-2" align="right"><div style="background-color:green; color:#fff; width:100px">55.00%</div></div>
                                                          <?php 
                                                          $answer =  $this->welfare_model->getAll_irpAnswer($qRow['qstn_id']);
                                                          foreach ($answer as $akey => $aRow) { ?>
                                                            <div class="col-xs-12 col-sm-12">
                                                              <div class="radio">
                                                                <label>
                                                                 <input type="radio" name="answer[<?php echo $qRow['qstn_id']; ?>][]"  value="<?php echo $aRow['qstn_id']; ?>">
                                                                 <?php echo $aRow['qstn_title']; ?>
                                                                </label>
                                                              </div>
                                                            </div>
                                                          <?php } ?>
                                                      </div>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                              </tbody>
                                            </table>
                                            <br>
                                            <br>
                                            <div class="form-group row">
                                              <div class="col-xs-12 col-sm-7 col-sm-offset-1"><label>โปรแกรมการฟื้นฟูสมรรถภาพรายบุคคล</label></div>
                                              <div class="col-xs-12 col-sm-4"><label>ดำเนินการภายใน (วัน)</label></div>
                                              <div class="col-xs-12 col-sm-12"><br></div>
                                              <?php $prgmList = $this->welfare_model->getAll_Progarm($diRow['qstn_id']); ?>
                                              <?php foreach ($prgmList as $key => $prmgRow) { ?>
                                                <div class="col-xs-12 col-sm-7 col-sm-offset-1">
                                                  <label><input type="checkbox"> <?php echo $prmgRow['prgm_title']; ?></label>
                                                </div>
                                                <div class="col-xs-12 col-sm-4"><input class="form-control" type="text" ></div>
                                                <div class="col-xs-12 col-sm-12"><br></div>
                                              <?php } ?>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <?php } ?>
                                    </div> 

                                    <center>
                                      <button type="button" class="btn btn-success btn-lg" onclick="return opnCnfrom()"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> บันทึก</button>
                                      <button type="button" class="btn btn-danger btn-lg" onclick="window.location.href='<?php echo site_url('welfare/welfare_list');?>'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิก</button>
                                    </center>

                                </div><!-- close panel-body-->
                            </div><!-- close tab-3-->

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
