<?php
//set_session('pers_authen',array('authen_log_id'=>223,'pid'=>'3101701933555','cid'=>'0221004350953232','random_string'=>'80db7f660e7ef6255597fc5794be0093')); //for Test
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
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(37);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_inquire1/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==37){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) ข้อมูลผู้สูงอายุ</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(38);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(38,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_agree2/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> <?php if($usrpm['app_id']==38){?>aria-expanded="true" <?php }?>>(2) ยินยอม</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(39);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_assist3/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> <?php if($usrpm['app_id']==39){?>aria-expanded="true" <?php }?>>(3) สงเคราะห์</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==37){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                    <!--
                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d"></h2>
                                            <div class="col-lg-12 text-right  border-bottom">
                                                  <?php
                                                  if($process_action=='Edit') {
                                                  ?>
                                                  <a data-toggle="modal" data-target="#myPrint" style="color: #000; padding-left: 20px; padding-right: 20px;" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                      <i class="fa fa-file-text" aria-hidden="true"></i>
                                                  </a>
                                                  <?php
                                                  }
                                                  ?>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(37);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>


                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(37);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('adaptenvir/activity_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  <?php
                                                  if($process_action=='Edit') {
                                                  ?>
                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(37);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id=<?php echo $impv_place_info['impv_place_id'];?> onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
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
                                        <a data-id=<?php echo $impv_place_info['impv_place_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
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

                                    <div class="family_members_template" hidden='hidden'>
                                      <div class="panel-group family_members_items" style="margin-top: -10px;">
                                        <div class="panel panel-default" style="border: 0">
                                          <div class="panel-heading clear-fix" style="background-color: initial;">
                                          </div>
                                            <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                              <div class="row text-right">

                                              <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                              </div>
                                              <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-3">
                                                      <label for="" class="col-2 col-form-label">เลขบัตรประจำตัวประชาชน</label>
                                                      <div class="input-group">
                                                           <input id="pid_myID" title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text"/>
                                                           <input type="hidden" id="pers_id_myID" name="impv_place_member[pers_id][myID]">
                                                          <div class="input-group-btn">
                                                            <button title="ตรวจสอบ" class="btn btn-default" id="bt_pid_myID"><i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-6">
                                                      <label for="" class="col-2 col-form-label">(คำนำหน้า) ขื่อตัว - ชื่อสกุล</label>
                                                      <input title="ขื่อตัว - ชื่อสกุล" id="pers_name_myID" placeholder="ระบุ (คำนำหน้า) ขื่อตัว - ชื่อสกุล" class="form-control" type="text" value="" />
                                                  </div>

                                                  <div class="col-xs-12 col-sm-3">
                                                      <label for="" class="col-2 col-form-label">อายุ (ปี)</label>
                                                      <input title="อายุ" id="pers_age_myID" placeholder="ระบุอายุ (ปี)" class="form-control" type="text"/>
                                                  </div>
                                                </div>

                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-6">
                                                      <label for="" class="col-2 col-form-label">อาชีพ</label>
                                                      <input title="อาชีพ" id="occupation_myID" placeholder="ระบุอาชีพ" class="form-control" name="impv_place_member[occupation][myID]" type="text"/>
                                                  </div>

                                                  <div class="col-xs-12 col-sm-6 dropdown">
                                                      <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                                                      <div class="col-10">
                                                        <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" id="edu_code_myID" name="impv_place_member[edu_code][myID]" class="form-control">
                                                            <option value="">เลือกระดับการศึกษา</option>
                                                            <?php $temp = $this->personal_model->getAll_edu_level();
                                                              foreach ($temp as $key => $row) { ?>
                                                              <option value="<?php echo $row['edu_code']; ?>"><?php echo $row['edu_title']; ?></option>
                                                            <?php  } ?>
                                                        </select>
                                                    </div>
                                                  </div>

                                                </div>

                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-6">
                                                      <label for="" class="col-2 col-form-label">ปัญหาสุขภาพ</label>&nbsp;&nbsp;
                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy][myID]" value="ปกติ"> ปกติ</label></div>&nbsp;&nbsp;&nbsp;
                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy][myID]" value="ผู้ป่วยเรื้อรัง"> ผู้ป่วยเรื้อรัง</label></div>&nbsp;&nbsp;&nbsp;
                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy][myID]" value="ผู้พิการ"> ผู้พิการ</label></div>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-6">
                                                      <label for="" class="col-2 col-form-label">ช่วยเหลือตนเอง</label>&nbsp;&nbsp;
                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy_self_help][myID]" value="ได้"> ได้</label></div>&nbsp;&nbsp;&nbsp;
                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy_self_help][myID]" value="ไม่ได้"> ไม่ได้</label></div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                        <script type="text/javascript">

                                          icheck_loop();

                                          var inputpid_myID = "#pid_myID";
                                          var bt_spid_myID = "#bt_pid_myID";
                                          var setData_myID = "reqData_myID"; //Declear Name
                                          var reqData_myID = function(value) { //Set Structure Display Data
                                            console.dir(value);
                                            $("#pers_id_myID").val(value.pers_id);
                                            $("#pers_age_myID").val(value.age);
                                            $("#pers_name_myID").val(value.name);
                                            $("#occupation_myID").val(value.occupation);
                                            // $("#mth_avg_income_myID").val(value.mth_avg_income);
                                            $("#edu_code_myID").val(value.edu_code);
                                            $("input[name='impv_place_member[healthy][myID]']").filter('[value="'+value.healthy+'"]').attr('checked', true);
                                            $("input[name='impv_place_member[healthy_self_help][myID]']").filter('[value="'+value.healthy_self_help+'"]').attr('checked', true);
                                          }
                                          $(bt_spid_myID).click(function(){//On Click for Search
                                            if($(inputpid_myID).val()!='') {//pid not null

                                             $(bt_spid_myID).attr('disabled',true);

                                              if(pers_authen!=null) { //Check Personal Authen
                                                getPersInfo(inputpid_myID,bt_spid_myID,setData_myID); //Get Data
                                              }else if(!reader_status) { //Run Reader Personal
                                                run_readerPers();
                                                $(bt_spid_myID).attr('disabled',false);
                                                toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                                              }

                                            }else { //pid is null
                                              $(inputpid_myID).select();
                                            }
                                          });
                                        </script>
                                      </div>
                                    </div>

                                    <div class="form-group row">

                                    <?php
                                    $diff_id = '';

                                    if($process_action=='Add')$process_action = 'Added';
                                    if($process_action=='Edit'){$process_action = 'Edited'; $diff_id = '/'.$impv_place_info['impv_place_id'];}

                                    echo form_open_multipart('adaptenvir/ac_inquire1/'.$process_action.$diff_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่มีความต้องการปรับปรุงสถานที่จัดกิจกรรมของผู้สูงอายุ) <label>&nbsp;</label></h4>
                                              </div>

                                              <div class="panel-body" style="border:0; padding: 20px;">
                                          <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3"><img width="70%" src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto;"></div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน</span> </div>
                                                    <div class="col-xs-12 col-sm-6 has-error" style="padding: 3px 15px;">
                                                        <div class="input-group" style="width: 295px;">
                                                            <input  title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="pid" name="impv_place_info[pid]" value="<?php echo $impv_place_info['pid'];?>" required/>
                                                            <input type="hidden" id="pers_id" name="impv_place_info[pers_id]" value="<?php echo $impv_place_info['pers_id'];?>">

                                                        <div class="input-group-btn" style="padding-bottom: 5px;">
                                                              <button type="button" title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_elder_pid"style="background-color:#F2DEDE; border-radius: 0px; border-color: #ed5565; color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                      <!-- <button class="btn btn-default elder_same_req" title="กรณีไม่มีบัตร" style="">กรณีไม่มีบัตร</button> -->
                                                         </div>
                                                        </div>
                                                    </div>
                                                    <script>
                                                        var elder_pers = null;
                                                        var inputpid2 = "#pid";
                                                        var bt_spid2 = "#bt_elder_pid";
                                                        var setData2 = "reqData2"; //Declear Name
                                                        var reqData2 = function(value) { //Set Structure Display Data
                                                          elder_pers = value;
                                                          $("#name").html(value.name);
                                                          $("#date_of_birth").html(value.date_of_birth);
                                                          $("#gender_name").html(value.gender_name);
                                                          $("#nation_name_th").html(value.nation_name_th);
                                                          $("#relg_title").html(value.relg_title);
                                                          $("#pers_id").val(value.pers_id);
                                                          $("#reg_addr_id").val(value.reg_addr_id);
                                                          $("#reg_addr").html(value.reg_add_info);
                                                        }
                                                        $(bt_spid2).click(function(){//On Click for Search
                                                          if($(inputpid2).val()!='') {//pid not null

                                                           $(bt_spid2).attr('disabled',true);

                                                            if(pers_authen!=null) { //Check Personal Authen
                                                              getPersInfo(inputpid2,bt_spid2,setData2); //Get Data
                                                            }else if(!reader_status) { //Run Reader Personal
                                                              run_readerPers();
                                                              $(bt_spid2).attr('disabled',false);
                                                              toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                                                            }

                                                          }else { //pid is null
                                                            $(inputpid2).select();
                                                          }
                                                        });

                                                      </script>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                                                    <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"  id="name"> <?php echo $impv_place_info['name'];?> </div>

                                                    <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                                                    <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="date_of_birth"> <?php echo $impv_place_info['date_of_birth'];?> </div>

                                                    <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name"> <?php echo $impv_place_info['gender_name'];?></span> </div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"> <?php echo $impv_place_info['nation_name_th'];?></span> </div>

                                                    <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ศาสนา</span> <span id="relg_title"> <?php echo $impv_place_info['relg_title'];?> </span> </div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span></div>
                                                    <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="reg_addr"> <?php echo $impv_place_info['reg_add_info']; ?> </div>
                                                    <input type="hidden" id="reg_addr_id" name="pers_info[reg_addr_id]" value="<?php echo $impv_place_info['reg_addr_id']; ?>">

                                                  </div>

                                                  <div class="form-group row">
                                                        <div class="col-xs-12 col-sm-3">
                                                            <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่สอบถาม </label>
                                                              <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                                  <input title="วันที่สอบถาม" placeholder="เลือกวันที่" class="form-control" type="text" name="impv_place_info[date_of_svy]" required>
                                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                              </div>
                                                                <script type="text/javascript">
                                                                <?php
                                                                $tmp = explode('-',@$impv_place_info['date_of_svy']);
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
                                                    </div>


                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-6">ที่อยู่ (สถานที่จัดกิจกรรม) ( <div class="checkbox-inline i-checks"><label><input type="checkbox" name="elder_addr_chk"> ตรงกับที่อยู่ตามทะเบียนบ้าน</label></div> )</div>
                                                    <script>

                                                      setTimeout(icheck_loop,2000);

                                                      function icheck_loop () {

                                                        $('.i-checks').iCheck({
                                                          checkboxClass: 'icheckbox_square-green',
                                                          radioClass: 'iradio_square-green',
                                                          increaseArea: '20%'
                                                        });

                                                      <?php
                                                      if(($impv_place_info['reg_addr_id']==$impv_place_info['pre_addr_id']) && ($impv_place_info['reg_addr_id']!=''&&$impv_place_info['pre_addr_id']!='')) {
                                                      ?>

                                                          $("input[name='elder_addr_chk']").parent().addClass('checked');
                                                          $("input[name='elder_addr_chk']").prop('checked',true);
                                                          $(".elder_addr_pre").attr('disabled',true);

                                                      <?php
                                                      }
                                                      ?>

                                                      <?php $trm_ptype = $this->common_model->custom_query("SELECT * FROM std_place_type ORDER BY ptype_code ASC"); ?>
                                                      <?php foreach ($trm_ptype as $key => $row) { ?>
                                                       $("input[name='impv_place_info[ptype_code]']").on('ifChanged',function(){

                                                          if($("input[value='<?php echo $row['ptype_code']; ?>']").prop('checked')){
                                                             $("input[data-ptype='<?php echo $row['ptype_code']; ?>']").prop('disabled',false).focus();
                                                          }else{
                                                             $("input[data-ptype='<?php echo $row['ptype_code']; ?>']").prop('disabled',true);
                                                          }
                                                        });


                                                       <?php } ?>

                                                       <?php $temp_condi = $this->common_model->custom_query("SELECT * FROM std_place_condition ORDER BY pcond_code ASC"); ?>
                                                       <?php foreach ($temp_condi as $key => $row) { ?>

                                                         $("input[name='impv_place_condition[pcond_code][<?php echo $row['pcond_code']; ?>]']").on('ifChanged',function(){
                                                          if($("input[name='impv_place_condition[pcond_code][<?php echo $row['pcond_code']; ?>]']").prop('checked')){
                                                           $("input[name='impv_place_condition[pcond_remark][<?php echo $row['pcond_code']; ?>]']").prop('disabled',false).focus();
                                                         }else{
                                                           $("input[name='impv_place_condition[pcond_remark][<?php echo $row['pcond_code']; ?>]']").prop('disabled',true);
                                                         }
                                                       });

                                                         <?php } ?>

                                                         $("input[name='impv_place_info[staff_review]']").on('ifChanged',function(){
                                                           if($("input[value='เห็นควรให้ความช่วยเหลือ']").prop('checked')){
                                                            $("#staff_review_remark-1").prop('disabled',false).focus();
                                                            $("#staff_review_remark-2").prop('disabled',true);
                                                          }else{
                                                            $("#staff_review_remark-2").prop('disabled',false).focus();
                                                            $("#staff_review_remark-1").prop('disabled',true);
                                                          }
                                                        });

                                                    };

                                                    </script>
                                                    <div class="col-xs-12 col-sm-6">
                                                          <?php
                                                            $addr_gps = @$addr_info['addr_gps']; // Old Data $diff_info['addr_gps']

                                                            if($addr_gps=='') {
                                                              $addr_gps ='0,0'; // Set Default Data
                                                            }
                                                            $arr = explode(',',$addr_gps);
                                                          ?>

                                                          <script type="text/javascript">
                                                            var latitude = '<?php echo $arr[0];?>';
                                                            var longitude = '<?php echo $arr[1];?>';


                                                            //var latitude_center = latitude=='0'?'13.5847536':latitude;
                                                            //var longitude_center = longitude=='0'?'13.5847536':longitude;
                                                            var marker_img = '<?php echo path('map-marker.png','webconfig');?>';
                                                            if(latitude!='0' && longitude!='0') {
                                                              setTimeout(function(){
                                                                $("#lat_value").val(latitude);  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                                                                $("#lon_value").val(longitude);  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                                                                //$("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu

                                                              },1500);
                                                            }

                                                          </script>

                                                           <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_marker">
                                                              <i class="fa fa-map-marker" aria-hidden="true"></i> ตำแหน่งพิกัดภูมิศาสตร์
                                                             </button>

                                                            &nbsp;
                                                              <input type="hidden" name="pers_addr[addr_gps]" value="<?php echo $addr_gps;?>" id="addr_gps">
                                                              <span id="addr_gpg_txt"><?php if($addr_gps!='0,0') { echo '('.$addr_gps.')';}?></span>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">

                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                                                        <input type="hidden" name="pre_addr_id" value="<?php echo @$diff_info['pre_addr_id']; ?>">
                                              <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_home_no]" value="<?php echo @$addr_info['addr_home_no']; ?>" />
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">หมู่ที่</label>
                                              <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_moo]" value="<?php echo @$addr_info['addr_moo']; ?>"/>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                        <div class="col-10">
                                                          <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_alley]" value="<?php echo @$addr_info['addr_alley']; ?>" />
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                      <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                                                      <div class="col-10">
                                                        <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_lane]" value="<?php echo @$addr_info['addr_lane']; ?>" />
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 dropdown">
                                                      <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                                                      <div class="col-10">
                                                        <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_road]" value="<?php echo @$addr_info['addr_road']; ?>" />
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                                                        <div class="col-10">
                                                        <select title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="pers_addr[addr_province]" onchange="optionGen(this,'Amphur',<?php echo @$addr_info['district_code']; ?>);">
                                                            <option value="">เลือกจังหวัด</option>
                                                            <?php $temp = $this->personal_model->getAll_Province();
                                                              foreach ($temp as $key => $row) { ?>
                                                              <option value="<?php echo $row['area_code']; ?>" ><?php echo $row['area_name_th']; ?></option>
                                                            <?php  } ?>
                                                        </select>
                                                      </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                                                        <div class="col-10">
                                                          <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="pers_addr[addr_district]" onchange="optionGen(this,'Tambon',<?php echo @$addr_info['sub_district_code']; ?>);" disabled>
                                                              <option value="">เลือกอำเภอ</option>
                                                              <?php //$temp = $this->personal_model->getAll_Amphur();
                                                                //foreach ($temp as $key => $row) { ?>
                                                                <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                                                              <?php  //} ?>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                                                        <div class="col-10">
                                                        <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon" name="pers_addr[addr_sub_district]" disabled>
                                                            <option value="">เลือกตำบล</option>
                                                            <?php //$temp = $this->personal_model->getAll_Tambon();
                                                              //foreach ($temp as $key => $row) { ?>
                                                              <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                                                            <?php  //} ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                                                        <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_zipcode]" value="<?php echo @$addr_info['addr_zipcode']; ?>"/>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                                                        <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[tel_no_home]" value="<?php echo @$pers_info['tel_no_home'];?>"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                                        <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="pers_info[tel_no_mobile]" value="<?php echo @$pers_info['tel_no_mobile'];?>"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                                        <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[fax_no]" value="<?php echo @$pers_info['fax_no'];?>"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">ที่อยู่อีเมล</label>
                                                        <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="pers_info[email_addr]" value="<?php echo @$pers_info['email_addr'];?>"/>
                                                    </div>
                                                  </div>



                                                  <div class="row">
                                                    <?php $count = count(@$impv_place_member);  ?>
                                                    <label>ผู้ใช้บริการในสถานที่ (จำนวน <span id="nums_family_members"><?php echo $count; ?></span> คน)</label>
                                                    <script>
                                                      var nummf = <?php echo $count; ?>;
                                                      function btDel_family_members(node) {
                                                        $(node).parent().parent().parent().parent().remove();
                                                        $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                      }
                                                    </script>

                                                    <div class="family_members" >
                                                      <?php if($process_action == 'Edited' && !empty($impv_place_member)){ ?>
                                                      <?php foreach ($impv_place_member as $key => $row) { ?>
                                                      <div class="panel-group family_members_items" style="margin-top: -10px;">
                                                        <div class="panel panel-default" style="border: 0">
                                                          <div class="panel-heading clear-fix" style="background-color: initial;">
                                                          </div>
                                                            <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                              <div class="row text-right">

                                                              <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                                              </div>
                                                              <div class="form-group row">
                                                                  <div class="col-xs-12 col-sm-3">
                                                                      <label for="" class="col-2 col-form-label">เลขบัตรประจำตัวประชาชน</label>
                                                                      <div class="input-group">
                                                                          <input  id="pid_<?php echo $key;?>" value="<?php echo $row['pid'];?>" title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text"/>
                                                                          <input type="hidden" id="pers_id_<?php echo $key;?>" name="impv_place_member[pers_id][<?php echo $key;?>]" value="<?php echo $row['mbr_pers_id'];?>">
                                                                          <div class="input-group-btn">
                                                                              <button  title="ตรวจสอบ" class="btn btn-default" id="bt_pid_<?php echo $key;?>" onclick="return false;"><i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                                                          </div>
                                                                     </div>
                                                                  </div>
                                                                  <div class="col-xs-12 col-sm-6">
                                                                      <label for="" class="col-2 col-form-label">(คำนำหน้า) ขื่อตัว - ชื่อสกุล</label>
                                                                      <input title="ขื่อตัว - ชื่อสกุล" id="pers_name_myID" placeholder="ระบุ (คำนำหน้า) ขื่อตัว - ชื่อสกุล" class="form-control" type="text" value="<?php echo @$row['name'];?>"/>
                                                                  </div>

                                                                  <div class="col-xs-12 col-sm-3">
                                                                      <label for="" class="col-2 col-form-label">อายุ (ปี)</label>
                                                                      <input title="อายุ" id="pers_age_<?php echo $key;?>" placeholder="ระบุอายุ (ปี)" class="form-control" type="text" value="<?php echo @$row['age'];?>" />
                                                                  </div>
                                                                </div>

                                                                <div class="form-group row">

                                                                  <div class="col-xs-12 col-sm-6">
                                                                      <label for="" class="col-2 col-form-label">อาชีพ</label>
                                                                      <input title="อาชีพ" placeholder="ระบุอาชีพ" class="form-control" type="text" id="occupation_<?php echo $key;?>" name="impv_place_member[occupation][<?php echo $key;?>]" value="<?php echo $row['occupation'];?>"/>
                                                                  </div>

                                                                  <div class="col-xs-12 col-sm-6 dropdown">
                                                                      <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                                                                      <div class="col-10">
                                                                        <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control" id="edu_code_<?php echo $key;?>" name="impv_place_member[edu_code][<?php echo $key;?>]" >
                                                                          <option value="">เลือกระดับการศึกษา</option>
                                                                          <?php $temp = $this->personal_model->getAll_edu_level();
                                                                            foreach ($temp as $eduRow) { ?>
                                                                            <option value="<?php echo $eduRow['edu_code']; ?>" <?php if($eduRow['edu_code'] == $row['edu_code']){ echo "selected";} ?>><?php echo $eduRow['edu_title']; ?></option>
                                                                          <?php  } ?>
                                                                      </select>
                                                                    </div>
                                                                  </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                  <div class="col-xs-12 col-sm-6">
                                                                      <label for="" class="col-2 col-form-label">ปัญหาสุขภาพ</label>&nbsp;&nbsp;
                                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy][<?php echo $key;?>]" value="ปกติ" <?php if($row['healthy'] == 'ปกติ'){ echo "checked";} ?>> ปกติ</label></div>&nbsp;&nbsp;&nbsp;
                                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy][<?php echo $key;?>]" value="ผู้ป่วยเรื้อรัง" <?php if($row['healthy'] == 'ผู้ป่วยเรื้อรัง'){ echo "checked";} ?>> ผู้ป่วยเรื้อรัง</label></div>&nbsp;&nbsp;&nbsp;
                                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy][<?php echo $key;?>]" value="ผู้พิการ" <?php if($row['healthy'] == 'ผู้พิการ'){ echo "checked";} ?>> ผู้พิการ</label></div>
                                                                  </div>
                                                                  <div class="col-xs-12 col-sm-6">
                                                                      <div class="checkbox-inline i-checks"><label for="" class="col-2 col-form-label">ช่วยเหลือตนเอง</label>&nbsp;&nbsp;
                                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy_self_help][<?php echo $key;?>]" value="ได้" <?php if($row['healthy_self_help'] == 'ได้'){ echo "checked";} ?>> ได้</label></div>&nbsp;&nbsp;&nbsp;
                                                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_member[healthy_self_help][<?php echo $key;?>]" value="ไม่ได้" <?php if($row['healthy_self_help'] == 'ไม่ได้'){ echo "checked";} ?>> ไม่ได้</label></div>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <script type="text/javascript">


                                                          var inputpid_<?php echo $key;?> = "#pid_<?php echo $key;?>";
                                                          var bt_spid_<?php echo $key;?> = "#bt_pid_<?php echo $key;?>";
                                                          var setData_<?php echo $key;?> = "reqData_<?php echo $key;?>"; //Declear Name
                                                          var reqData_<?php echo $key;?> = function(value) { //Set Structure Display Data
                                                            $("#pers_id_<?php echo $key;?>").val(value.pers_id);
                                                            $("#marital_status_<?php echo $key;?>").val(value.marital_status);
                                                            $("#pers_age_<?php echo $key;?>").val(value.age);
                                                            $("#occupation_<?php echo $key;?>").val(value.occupation);
                                                            $("#mth_avg_income_<?php echo $key;?>").val(value.mth_avg_income);
                                                            $("#edu_code_<?php echo $key;?>").val(value.edu_code);
                                                            $("input[name='impv_place_member[healthy][<?php echo $key;?>]']").filter('[value="'+value.healthy+'"]').attr('checked', true);
                                                            $("input[name='impv_place_member[healthy_self_help][<?php echo $key;?>]']").filter('[value="'+value.healthy_self_help+'"]').attr('checked', true);
                                                          }
                                                          $(bt_spid_<?php echo $key;?>).click(function(){//On Click for Search
                                                            if($(inputpid_<?php echo $key;?>).val()!='') {//pid not null

                                                             $(bt_spid_<?php echo $key;?>).attr('disabled',true);

                                                              if(pers_authen!=null) { //Check Personal Authen
                                                                getPersInfo(inputpid_<?php echo $key;?>,bt_spid_<?php echo $key;?>,setData_<?php echo $key;?>); //Get Data
                                                              }else if(!reader_status) { //Run Reader Personal
                                                                run_readerPers();
                                                                $(bt_spid_<?php echo $key;?>).attr('disabled',false);
                                                                toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                                                              }

                                                            }else { //pid is null
                                                              $(inputpid_<?php echo $key;?>).select();
                                                            }
                                                          });
                                                        </script>
                                                      </div>

                                                      <?php } ?>
                                                    <?php } ?>
                                                    </div>

                                                    <button type="button" class="btn btn-default" id="btAdd_family_members"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                                    <script>
                                                      var cloneTmp = $('.family_members_template').clone();
                                                      // setTimeout(function(){addFmlyMember();},500);

                                                      function addFmlyMember() {
                                                        var cloneTmp1 = cloneTmp.html().replace(new RegExp("myID", 'g'), nummf);
                                                        nummf = nummf+1;

                                                        setTimeout(function(){
                                                          $("#pid_"+(nummf-1)).mask("9-9999-99999-99-9");
                                                          //$("#pren_code_"+(nummf-1)).select2();
                                                          //alert("#pid_"+(nummf-1));
                                                        },1000);

                                                        $(cloneTmp1).clone().appendTo('.family_members');
                                                        $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                      }

                                                      $("#btAdd_family_members").click(function(){ //Add
                                                        addFmlyMember();
                                                      });
                                                    </script>

                                                  </div>

                                                   <br>

                                                   <div class="form-group row"><!-- row leverl 2-->
                                                       <label>ลักษณะสถานที่จัดกิจกรรม (ถ้ามี)</label>
                                                       <div class="col-xs-12 col-sm-12"><br></div>
                                                       <?php $trm_ptype = $this->common_model->custom_query("SELECT * FROM std_place_type ORDER BY ptype_code ASC"); ?>
                                                       <?php foreach ($trm_ptype as $key => $row) { ?>
                                                           <div class="col-xs-12 col-sm-6"><div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_info[ptype_code]" value="<?php echo $row['ptype_code']; ?>" <?php if(@$impv_place_info['ptype_code'] == $row['ptype_code']){ echo "checked"; } ?>> <?php echo $row['ptype_title']; ?></label></div></div>
                                                           <div class="col-xs-12 col-sm-6"><input type="text" data-ptype ="<?php echo $row['ptype_code']; ?>" class="form-control" placeholder="<?php if($row['ptype_code'] != '009'){ echo 'ความคิดเห็นเจ้าหน้าที่ (ผู้สอบถาม)'; }else{ echo 'อื่น ฯ (ระบุ)'; }?>" name="impv_place_info[ptype_code_remark]" value="<?php if(@$impv_place_info['ptype_code'] == $row['ptype_code']){ echo $impv_place_info['ptype_code_remark']; } ?>" <?php if(@$impv_place_info['ptype_code'] != $row['ptype_code']){ echo "disabled";} ?>></div>
                                                           <div class="col-xs-12 col-sm-12"><br></div>
                                                       <?php } ?>
                                                   </div>


                                                   <div class="form-group row"><!-- row leverl 2-->
                                                       <label>สภาพสถานที่จัดกิจกรรมที่ต้องปรับปรุง</label>
                                                       <div class="col-xs-12 col-sm-12"><br></div>
                                                       <?php $temp_condi = $this->common_model->custom_query("SELECT * FROM std_place_condition ORDER BY pcond_code ASC"); ?>
                                                       <?php foreach ($temp_condi as $key => $row) { ?>
                                                         <div class="col-xs-12 col-sm-6"><div class="checkbox-inline i-checks"><label><input type="checkbox" onChange="set_enable($(this),'#pcond-<?php echo $row['pcond_code'];?>');" value="<?php echo $row['pcond_code'];?>"  name="impv_place_condition[pcond_code][<?php echo $row['pcond_code']; ?>]" <?php if(@$impv_place_condition[$row['pcond_code']]['pcond_code'] == $row['pcond_code']){ echo "checked"; } ?>> <?php echo $row['pcond_title']; ?></label></div></div>
                                                         <div class="col-xs-12 col-sm-6"><input id="pcond-<?php echo $row['pcond_code']; ?>" type="text" class="form-control" placeholder="<?php if($row['pcond_code'] != '009'){ echo 'ความคิดเห็นเจ้าหน้าที่ (ผู้สอบถาม)'; }else{ echo 'อื่น ฯ (ระบุ)'; }?>" name="impv_place_condition[pcond_remark][<?php echo $row['pcond_code']; ?>]" value="<?php echo @$impv_place_condition[$row['pcond_code']]['pcond_remark']; ?>" <?php if(!isset($impv_place_condition[$row['pcond_code']]['pcond_remark'])){ echo "disabled";} ?>></div>
                                                         <div class="col-xs-12 col-sm-12"><br></div>
                                                       <?php } ?>
                                                   </div>


                                                   <div class="form-group row"><!-- row leverl 2-->
                                                    <label>ความคิดเห็นเจ้าหน้าที่</label>
                                                    <div class="col-xs-12 col-sm-12"><br></div>
                                                    <div class="col-xs-12 col-sm-6"><div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_info[staff_review]" value="เห็นควรให้ความช่วยเหลือ" <?php if(@$impv_place_info['staff_review'] == "เห็นควรให้ความช่วยเหลือ"){ echo "checked";} ?>>  เห็นควรให้ความช่วยเหลือ</label></div></div>
                                                    <div class="col-xs-12 col-sm-6"><input type="text" id="staff_review_remark-1" class="form-control" placeholder="ความคิดเห็นเจ้าหน้าที่ (ผู้สอบถาม)" name="impv_place_info[staff_review_remark]" value="<?php if(@$impv_place_info['staff_review'] == "เห็นควรให้ความช่วยเหลือ" ){ echo @$impv_place_info['staff_review_remark']; } ?>" <?php if(@$impv_place_info['staff_review'] != "เห็นควรให้ความช่วยเหลือ" ){ echo "disabled"; } ?>></div>
                                                    <div class="col-xs-12 col-sm-12"><br></div>
                                                    <div class="col-xs-12 col-sm-6"><div class="checkbox-inline i-checks"><label><input type="radio" name="impv_place_info[staff_review]" value="เห็นควรให้ความช่วยเหลืออย่างเร่งด่วน" <?php if(@$impv_place_info['staff_review'] == "เห็นควรให้ความช่วยเหลืออย่างเร่งด่วน"){ echo "checked";} ?>>  เห็นควรให้ความช่วยเหลืออย่างเร่งด่วน</label></div></div>
                                                    <div class="col-xs-12 col-sm-6"><input type="text" id="staff_review_remark-2" class="form-control" placeholder="ความคิดเห็นเจ้าหน้าที่ (ผู้สอบถาม)" name="impv_place_info[staff_review_remark]" value="<?php if(@$impv_place_info['staff_review'] == "เห็นควรให้ความช่วยเหลืออย่างเร่งด่วน" ){ echo @$impv_place_info['staff_review_remark']; } ?>" <?php if(@$impv_place_info['staff_review'] != "เห็นควรให้ความช่วยเหลืออย่างเร่งด่วน"){ echo "disabled"; } ?>></div>
                                                   </div>





                                              </div>
                                          </div>
                                      </div>

                                  </div>

                                      <hr>
                                      <div class="row">
                                       <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                       <div class="col-xs-12 col-sm-2">
                                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                      </div>
                                      <div class="col-xs-12 col-sm-2">
                                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('adaptenvir/activity_list');?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                      </div>
                                    </div><!-- close class row-->

                                </div>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==4){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div><!-- close panel-body tab-2-->
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
<script type="text/javascript">
  function set_enable(elem,target='') {
    if(elem.prop('checked') == true) {
      $(target).prop('disabled', false ).focus();
    }else{
      $(target).val('');
      $(target).prop('disabled', true );
    }
  }

  $("input[name='impv_place_info[ptype_code]']").change(function() {
    var trm = $(this).val();
    $("input[name='impv_place_info[ptype_code_remark]']").each(function() {
       if(trm==$(this).data('ptype')){
        $(this).attr('disabled', false).focus();
       }else{
         $(this).val('');
         $(this).prop('disabled', true );
       }
    });
  });

  $("input[name='impv_place_info[staff_review]']").change(function(){
    if($(this).val() == 'เห็นควรให้ความช่วยเหลือ'){
      $("#staff_review_remark-1").prop('disabled', false ).focus();
      $("#staff_review_remark-2").val('');
      $("#staff_review_remark-2").prop('disabled', true );
    }else{
      $("#staff_review_remark-2").prop('disabled', false ).focus();
      $("#staff_review_remark-1").val('');
      $("#staff_review_remark-1").prop('disabled', true );
    }
  });

  <?php if($process_action == 'Edited'){ ?>
    setTimeout(function(){$("#Province").val('<?php echo @$addr_info['province_code']; ?>').trigger('change');},200);
    // setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
    // setTimeout(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);
  <?php } ?>
  function optionGen(code,target,opSelect) {
    // alert(code.value);
    // alert(target);
    $.ajax({
      url: base_url+'personals/get_Area_option',
      type: 'POST',
      dataType: 'json',
      data: {
        'code': code.value,
        'type': target,
        <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
      },
    })
    .done(function(ret) {
      console.log("success");
      console.dir(ret);
      $('#'+target).empty();
      if($("input[name='elder_addr_chk']").prop('checked') == true){
        $('#'+target).prop('disabled', true);
      }else{
        $('#'+target).prop('disabled', false);
      }
      if(target == 'Amphur'){
        str = "เลือกอำเภอ";
      }else if(target == 'Tambon'){
        str = "เลือกตำบล";
      }
      $('#'+target).append($('<option>', {
        value: '',
        text : str
      }));
      for (var i = 0; i < ret.length ; i++) {
        // if(ret[i].area_code == opSelect){
          $('#'+target).append($('<option>', {
            value: ret[i].area_code,
            text : ret[i].area_name_th
          }));
        // }else{
        //   $('#'+target).append($('<option>', {
        //     value: ret[i].area_code,
        //     text : ret[i].area_name_th
        //   }));
        // }
      }
      $('#'+target).val(opSelect).trigger('change');
    })
    .fail(function() {
      console.log("error");
    });
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
<div id="myPrint"  class="modal fade" role="dialog">
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

 <!-- Modal -->
  <div class="modal fade" id="modal_marker" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: rgb(56,145,209);color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-map-marker" aria-hidden="true"></i> ค้นหาสถานที่</h4>
        </div>
        <div class="modal-body">

      <form name="form_search" method="post" action="">

      <b>ชื่อสถานที่</b>
        <div class="row">
          <div class="col-xs-12 col-sm-10">
              <input name="namePlace" class="form-control" size="70" type="text" id="namePlace" size="30" />
              <input type="hidden" name="address" id="namePlace2">
          </div>
          <div class="col-xs-12 col-sm-2">
                        <a href="#" class="btn btn-default btn-search" style="width: 100%; margin-top: 0px; color:#fff" name="SearchPlace" id="SearchPlace" value="ค้นหา" ><i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา
                        </a>
            </div>
        </div>
       </form>

      <hr />

      <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">
        <div class="row">
          <div class="col-xs-6 col-sm-5">
            ละติจูด <input class="form-control" name="lat_value" type="text" id="lat_value" value="0" size="20" readonly />
          </div>
          <div class="col-xs-6 col-sm-5">
            ลองจิจูด <input class="form-control" name="lon_value" type="text" id="lon_value" value="0" size="20" readonly />
          </div>
          <div class="col-xs-12 col-sm-2">
                        <a href="#" class="btn btn-default btn-save" style="margin-top: 22px; width: 100%; color:#fff" name="button" id="button" onclick="select_location();" value="บันทึก" ><i style='font-size:14px;' class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                        </a>
            </div>
          </div>
      </form>

      <div class="row">
        <div class="col-xs-12 col-sm-12">
          <!-- show map -->
          <div id="map_canvas" style="width:100%;height:400px;margin:auto;margin-top:10px;"></div>
        </div>
      </div>

        </div>
        <!--
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        -->
      </div>

    </div>
  </div>
