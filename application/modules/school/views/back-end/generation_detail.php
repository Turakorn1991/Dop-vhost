<?php $schl_id_original = $schl_id; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(59);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/school1/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==59){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) โรงเรียน</a>
                            </li>
                            <li >
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(60);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(60,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/photo2/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==60){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(61);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(61,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id);?>" <?php }?> data-toggle="tab"  <?php if($usrpm['app_id']==61){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(174);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(174,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/school_model/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==174){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (4) แบบประเมินโรงเรียน</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==61){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                   <!--
                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d"></h2>
                                            <div class="col-lg-12 text-right  border-bottom">


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
                                                  <?php }else{?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id);?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(3);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                  ?>

                                                  <?php
                                                  if($process_action=='Edit') {
                                                  ?>
                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(3);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id=<?php echo @$adm_info['diff_id'];?> onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ลบข้อมูล" class="btn btn-default">
                                                      <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                  </a>
                                                  <?php
                                                  }
                                                  ?>

                                            </div>
                                        </div>
                                    </div>
                                    -->

                                       <div id="tmp_menu" hidden='hidden'>
                                          <!--
                                           <?php
                                              $tmp = $this->admin_model->getOnce_Application(3);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
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
                                    $schl_id = '';


                                    if($process_action=='Add'){$process_action = 'Added'; $schl_id = '/'.$schl;}
                                    if($process_action=='Edit'){$process_action = 'Edited'; $schl_id = '/'.$schl;}

                                    echo form_open_multipart('school/generation_detail/'.$process_action.$schl_id."/".$gen_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo @$csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>รายละเอียดรุ่น</h4>
                                              </div>

                                              <div class="panel-body" style="border:0; padding: 20px;">


                                                <!-- === Add Album Button opal : start code === -->

                                                <div class="form-group row" style="margin-bottom:0px !important; padding-left: 0px; padding-right: 0px;"><!-- remove space bottom opal -->
                                                  <div class="col-xs-12 col-sm-12">

                                                    <div class="col-xs-12 col-sm-9 has-error">
                                                      <label for="" class="col-2 col-form-label" style="color: red;">ชื่อโรงเรียน </label>
                                                      <input type="text" class="form-control" name="schl_info[schl_name]" title="ชื่อโรงเรียน" value="<?php echo $schl_info['schl_name']; ?>" placeholder="ระบุชื่อโรงเรียน" disabled>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <br />
                                                        

                                                    </div>


                                                  </div><!-- close div  class="col-xs-12 col-sm-12"-->
                                                </div><!-- close div class="form-group row"-->


                                                <br /><hr/><br />
                                                <!-- === Add Album Button opal : end code === -->



                                                <div class="form-group row" style="padding-left: 15px; padding-right: 15px;">
                                                  <div class="col-xs-12 col-sm-3 has-error" >
                                                      <input type="hidden" name="schl_gen[schl_id]" value="<?php echo $schl_gen['schl_id']; ?>">
                                                      <label for="" class="col-2 col-form-label" style="color: red;">รุ่นที่ </label>
                                                      <input type="text" class="form-control" name="schl_gen[gen_code]" value="<?php echo $schl_gen['gen_code'];?>" title="" placeholder="ระบุรุ่น" required>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-3">
                                                      <label for="" class="col-2 col-form-label" style="color: red;">วันที่เริ่ม</label>
                                                    <!--   <select  class="form-control" name="schl_gen[year_of_study]"  title="ปีที่เปิดเรียน">
                                                           <option value="">เลือกปี พ.ศ.</option>
                                                           <?php
                                                             $year = date("Y");
                                                             for($yearTh = ($year-100);$yearTh<=$year;$yearTh++){
                                                            ?>
                                                            <option value="<?php echo $yearTh; ?>" <?php if($schl_gen['year_of_study']==$yearTh){ echo "selected"; } ?> ><?php echo ($yearTh+543);?></option>
                                                            <?php } ?>
                                                      </select> -->
                                                      <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                        <input title="วันที่แจ้งเรื่อง" placeholder="เลือกวันที่" class="form-control" type="text" name="schl_gen[date_of_start]" required />
                                                        <span class="input-group-addon" style=""><i class="glyphicon glyphicon-calendar"></i></span>
                                                      </div>
                                                      <script type="text/javascript">
                                                        $(function () {
                                                          $("#datetimepicker1").datepicker({
                                                            autoclose: true,
                                                            todayHighlight: true
                                                          }).datepicker('update', new Date(Date.UTC(2017,08-1,16)));;
                                                        });
                                                      </script>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-3">
                                                      <label for="" class="col-2 col-form-label" style="color: red;">วันที่จบ</label>

                                                      <div id="datetimepicker2" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                        <input title="วันที่แจ้งเรื่อง" placeholder="เลือกวันที่" class="form-control" type="text" name="" required>
                                                        <span class="input-group-addon" style=""><i class="glyphicon glyphicon-calendar"></i></span>
                                                      </div>
                                                      <script type="text/javascript">
                                                        $(function () {
                                                          $("#datetimepicker2").datepicker({
                                                            autoclose: true,
                                                            todayHighlight: true
                                                          }).datepicker('update', new Date(Date.UTC(2017,08-1,16)));;
                                                        });
                                                      </script>

                                                       <input id="gen_status" name="schl_gen[gen_status]" type="hidden" value="เปิด" checked>
                                                  </div>

                                                  <div class="col-xs-12 col-sm-1">
                                                      <label for="" class="col-2 col-form-label">จำนวนวัน</label>
                                                      <input type="text" name="" class="form-control">
                                                  </div>

                                                    <div class="col-xs-12 col-sm-1">
                                                      <label for="" class="col-2 col-form-label">จำนวนชั่วโมง</label>
                                                      <input type="text" name="" class="form-control">
                                                  </div>

                                                </div>

                                                <div class="form-group row" style="padding-left: 15px; padding-right: 15px;">

                                                  <div class="col-xs-12 col-sm-3">
                                                    <label for="" class="col-2 col-form-label">หลักสูตร</label>
                                                    <br>
                                                    <select style="" name="" placeholder="เลือก หลักสูตร" class="form-control elder_addr_pre" id="">
                                                      <option value="" selected="">เลือก หลักสูตร</option>                            
                                                      <option value="">หลักสูตรพัฒนาทักษะด้านเกษตรกรรม</option>
                                                      <option value="">หลักสูตรพัฒนาทักษะด้านหัตถกรรม</option>
                                                      <option value="">หลักสูตรพัฒนาทักษะด้านการปรุงอาหาร</option>
                                                    </select>
                                                  </div>

                                                  <div class="col-xs-12 col-sm-3">
                                                    <label for="" class="col-2 col-form-label">ตารางเรียน</label>
                                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                      <div class="form-control" data-trigger="fileinput">
                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                        <span class="fileinput-filename"></span>
                                                      </div>

                                                      <span class="input-group-addon btn btn-default btn-file">
                                                        <span class="fileinput-new">Browse</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="hidden"><input type="file" accept="" name="wisd_file[]">
                                                      </span>
                                                        
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                  </div>

                                                </div>



                                                <script type="text/javascript">



                                                   $('#gen_status').change(function(){
                                                        if($('#gen_status').prop('checked',)==true){
                                                           $('#gen_status').val("เปิด");
                                                        }else{
                                                           $('#gen_status').val("ปิด");
                                                        }
                                                   });

                                                   <?php
                                                   if($process_action == 'Edited'){
                                                         if($schl_gen['gen_status']=="ปิด"){
                                                    ?>
                                                             $('#gen_status').prop('checked',false);
                                                             $('#gen_status').val('ปิด');
                                                   <?php
                                                         }
                                                    }
                                                   ?>
                                                </script>

                                          </div>
                                      </div>

                                    <?php
                                    echo form_close();
                                    ?>

                                    </div>



                                </div>

                                    <hr>
                                        <div class="row">
                                         <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                         <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/generation3/Edit'.$schl_id);?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                        </div>
                                      </div><!-- close class row-->
                            </div>



                        </div><!-- close tab-content-->


                    </div>
                </div>
            </div>

            <div>

              <div class="form-group row clone"  style="display:none">
                            <div class="form-group row clone_container">
                                   <div class="col-xs-12 col-sm-6 ">
                                   <select class="form-control" name="schl_info_edu[crse_code][]">
                                   <option value="">เลือกหลักสูตร</option>
                                   <?php
                                   $schl_course = $this->common_model->custom_query("SELECT * FROM std_schl_course");
                                      foreach ($schl_course as $key_course => $value_course){
                                   ?>
                                    <option value="<?php echo $value_course['crse_id']; ?> "><?php echo $value_course['crse_grp']."->".$value_course['crse_cate']."->".$value_course['crse_title']; ?></option>
                                     <?php
                                   }
                                  ?>
                                   </select>
                                  </div>
                                    <div class="col-xs-12 col-sm-5" ><input type="text" class="form-control" placeholder="ความคิดเห็นเจ้าหน้าที่" name="schl_info_edu[crse_identify][]"></div>
                                    <div class="col-xs-12 col-sm-1" ><button type="button" class="btn btn-default" onclick="Del_course(this,'')"><i class="fa fa-minus" aria-hidden="true"></i></button></div>
                            </div>
              </div>
            </div>

            <script type="text/javascript">
               function add_course(node){


                  var add_course = $('.clone > .clone_container').clone();


                     $(node).parent().before(add_course);
               }

               function Del_course(node,edu_id){

                 if(edu_id!=""){
                     if(confirm('กรุณายืนยันการลบ')){
                           $.ajax({
                             url: base_url+'school/del_schl_edu',
                             type: 'POST',
                             dataType: 'html',
                             data: {
                                    'id_edu': edu_id,
                             <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                    },
                                  success: function(result){
                                    if(result=="remove"){
                                       $(node).parent().parent().remove();
                                     }
                                   },

                            });
                        }
                }else{
                  if(confirm('กรุณายืนยันการลบ')){
                   $(node).parent().parent().remove();
                  }
                }


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
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('054');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="dltbtnYes" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
        <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Confirm Save Form  Modal -->


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
        <button  onclick="window.location.href='<?php echo base_url('school/generation3/Edit/'.$schl);?>'" type="button" class="btn btn-warning">ตกลง</button>
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
