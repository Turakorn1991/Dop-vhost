<?php
//TODO: Bypass authen
//set_session('pers_authen',array('authen_log_id'=>10,'pid'=>'3101701933555','cid'=>'0221004350953232','random_string'=>'0886e3bf787a223c90c8a231a63d283c')); //for Test
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>


<div class="row">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
        <li class="active">
          <?php
          $tmp = $this->admin_model->getOnce_Application(3);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
          ?>
          <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else if($process_action!='Add'){?> href="<?php echo site_url('difficult/sufferer_form1/Edit/'.$diff_info['diff_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) แจ้งเรื่อง</a>
        </li>
        <li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(4);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(4,$user_id); //Check User Permission
          ?>
          <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
            <?php //echo site_url('difficult/sufferer_form2/Edit/'.$diff_info['diff_id']);?> 
          <?php }else if($process_action!='Add'){?> href="#" <?php }?> <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }?>>(2) ตรวจเยี่ยม</a>
        </li>
        <li>
          <?php
          $tmp = $this->admin_model->getOnce_Application(5);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(5,$user_id); //Check User Permission
          ?>
          <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
            <?php //echo site_url('difficult/sufferer_form3/Edit/'.$diff_info['diff_id']);?>
          <?php }else if($process_action!='Add'){?> href="#" <?php }?> <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }?>>(3) สงเคราะห์</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
          <div class="panel-body">
            <!--
            <div class="row">
              <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                <h2 style="color: #4e5f4d">ระบบฐานข้อมูลยากลำบาก</h2>
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
                  <?php
                  if($process_action=='Edit') {
                  ?>
                  &nbsp;
                  <?php
                  $tmp = $this->admin_model->getOnce_Application(3);
                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                  ?>
                  <a data-id=<?php echo $diff_info['diff_id'];?> onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
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
            <script>
            setTimeout(function(){
            $("#menu_topright").html($("#tmp_menu").html());
            },300);
            </script>
            <div class="family_members_template" style="display: none;">
              <div class="panel-group family_members_items" style="margin-top: -10px;">
                <div class="panel panel-default" style="border: 0">
                  <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;margin-top: 10px;">
                    <div class="row text-right">
                      <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3 ">
                        <label class="col-2 col-form-label" style="font-weight: bold; color: red;">เลขบัตรประจำตัวประชาชน</label>
                            <input id="pid_myID" style="border-color: red;" title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text" name="pers_family[fml_pid][myID]" />
                      </div>
                      <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
                          <div class="col-10">
                            <select id="pren_code_myID" title="คำนำหน้านาม"  placeholder="เลือกคำนำหน้านาม" class="form-control elder_addr_pre" name="pers_family[pren_code][myID]">
                              <option value="">เลือกคำนำหน้านาม</option>
                              <?php
                              $tmps = $this->common_model->custom_query("select * from std_prename");
                              foreach ($tmps as $key => $value) {
                              ?>
                              <option value="<?php echo $value['pren_code'];?>"><?php echo $value['prename_th'];?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">ชื่อตัว</label>
                        <input title="ชื่อตัว" placeholder="ระบุชื่อตัว" class="form-control" onkeyup="thvalidate(this)" type="text" name="pers_family[pers_firstname_th][myID]" />
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">ชื่อสกุล</label>
                        <input title="ชื่อสกุล" placeholder="ระบุชื่อสกุล" class="form-control" onkeyup="thvalidate(this)" type="text" name="pers_family[pers_lastname_th][myID]" />
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">อายุ (ปี)</label>
                        <input title="อายุ" id="pers_age_myID" placeholder="ระบุอายุ (ปี)" class="form-control" onkeyup="numbervalid(this)" type="text" value="" name="pers_family[fml_age][myID]"/>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">เกี่ยวข้องเป็น</label>
                        <input title="ความสัมพันธ์กับผู้สูงอายุ" placeholder="ระบุความสัมพันธ์กับผู้สูงอายุ" onkeyup="thvalidate(this)" class="form-control" type="text" name="pers_family[fml_relation][myID]" />
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">อาชีพ</label>
                        <input title="อาชีพ" placeholder="ระบุอาชีพ" class="form-control" type="text" onkeyup="thvalidate(this)" id="occupation_myID" name="pers_family[occupation][myID]" />
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">รายได้เฉลี่ย (บาท/เดือน)</label>
                        <input title="รายได้เฉลี่ย" placeholder="ระบุรายได้เฉลี่ย (บาท/เดือน)" class="form-control" onkeyup="numberndot(this)" type="text" id="mth_avg_income_myID" name="pers_family[mth_avg_income][myID]"/>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                        <input title="อายุ" id="pers_age_myID" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" onkeyup="thnodash(this)" type="text"  name="pers_family[fml_tel_no_home][myID]"/>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                        <input title="อายุ" id="pers_age_myID" placeholder="ตัวอย่าง 08XXXXXXXX" maxlength="10" class="form-control" onkeyup="numbervalid(this)" type="text"  name="pers_family[fml_tel_no][myID]"/>
                      </div>
                        
                    </div>

                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-6">
                        <label class="col-2 col-form-label">ปัญหาสุขภาพ</label>&nbsp;&nbsp;
                        <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy][myID]" value="ปกติ"><i></i>  ปกติ</label></div>&nbsp;&nbsp;&nbsp;
                        <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy][myID]" value="ผู้ผู้ป่วยเรื้อรัง"><i></i>  ผู้ป่วยเรื้อรัง</label></div>&nbsp;&nbsp;&nbsp;
                        <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy][myID]" value="ผู้พิการ"><i></i>  ผู้พิการ</label></div>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                        <label class="col-2 col-form-label">ช่วยเหลือตนเอง</label>&nbsp;&nbsp;
                        <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy_self_help][myID]" value="ได้"><i></i> ได้</label></div>
                        <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy_self_help][myID]" value="ไม่ได้"><i></i> ไม่ได้</label></div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- <script>
                  icheck_loop();
                </script> -->

              </div>
            </div>

            <div class="form-group row">
              <?php
              $diff_id = '';
              if($process_action=='Add')$action = 'Added';
              if($process_action=='Edit'){$action = 'Edited'; $diff_id = '/'.$diff_info['diff_id'];}
              echo form_open_multipart('difficult/sufferer_form1/'.$action.$diff_id,array('id'=>'form1'));
              ?>
              <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
              <input type="submit" value="submit" name="bt_submit" hidden="hidden">
              <input value="false" name="sms" hidden="hidden">
              <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>
              <div class="panel-group" style="margin-bottom: 0px;">
                <div class="panel panel-default" style="border: 0">
                  <div class="panel-heading"><h4>ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง)</h4></div>
                  <div class="panel-body" style="border:0; padding: 20px; ">

                    <div class="form-group row">
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน</span></div>
                          <div class="col-xs-12 col-sm-3 has-error " style="padding: 3px 15px;">

                            <div class="input-group" style="width: 295px;">
                              <input  title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text" value="<?php echo $diff_info['req_pid'];?>" name="diff_info[req_pid]" id="req_pid" autofocus required/>
                              <div class="input-group-btn" style="padding-bottom: 5px;">
                                <button type="button" title="ตรวจสอบ" class="btn btn-default"  onClick="bt_req_pid()" style="background-color:#F2DEDE; border-radius: 0px; border-color: #ed5565; color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                             
                              </div><!--end input-group-btn-->
                              <?php //print_r($diff_info);exit();?>
                              <input type="hidden" id="diff_pid"  name="info_pid[pid]" value="<?php echo $diff_info['req_pid'];?>">
                              
                              <input type="hidden" id="req_pers_id" name="diff_info[req_pers_id]" value="<?php echo $diff_info['req_pers_id'];?>">
                              <input type="hidden" name="currtoken" id="currtoken" value="<?php echo !empty($token_id) ? $token_id:''; ?>"/>
                                  

                            </div><!--end input-group-->

                          </div><!--end col-xs-12 col-sm-6 has-error-->
                          <div class="col-xs-12 col-sm-3 has-error" style="padding: 3px 15px;">                                                      
                            <button type="button" class="btn btn-default " onClick="cardInfo()" title="ดึงข้อมูลจากบัตร" style="background-color:#F2DEDE; order-radius: 0px; left: 1px; border-color: #ed5565; color: #ed5565;padding:5px 12px;">ดึงข้อมูลจากบัตร</button> 
                          </div>   
                          <script>
                          // var req_pers = null;
                          // var inputpid = "#req_pid";//id
                          // var bt_spid = "#bt_req_pid";//button
                          // var setData = "reqData"; //Declear Name
                          // var reqData = function(value) { //Set Structure Display Data
                          // req_pers = value;
                          // $("#req_name").html(value.name);
                          // $("#req_date_of_birth").html(value.date_of_birth);
                          // $("#req_gender_name").html(value.gender_name);
                          // $("#req_nation_name_th").html(value.nation_name_th);
                          // $("#req_relg_title").html(value.relg_title);
                          // $("#req_pers_id").val(value.pers_id);
                          // $("#req_reg_addr").text(value.reg_add_info);
                          // }
                          // $(bt_spid).click(function(event){//On Click for Search
                          //   event.stopPropagation();
                          //   if($(inputpid).val()!='') {//pid not null
                          //     $(bt_spid).attr('disabled',true);
                          //     if(pers_authen!=null) { //Check Personal Authen
                          //       getPersInfo(inputpid,bt_spid,setData); //Get Data
                          //     }else if(!reader_status) { //Run Reader Personal
                          //       run_readerPers();
                          //       $(bt_spid).attr('disabled',false);
                          //       toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                          //     }
                          //   }else { //pid is null
                          //   $(inputpid).select();
                          //   }
                          // });
                          </script>
                          <!-- <button title="กรณีไม่มีบัตร" type="button"  class="btn btn-default" style="width: 48%">กรณีไม่มีบัตร</button> -->
                          </div><!--form-group row-->
                    <div class="form-group row">
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;" id="req_name"> <?php echo $req_prename['prename_th'].' '.$diff_info['req_name']; ?> </div>
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;" id="req_date_of_birth_text"> <?php echo $diff_info['req_date_of_birth'];?> </div>
                    </div>
                    <div class="form-group row">
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="req_gender_name"> <?php echo $diff_info['req_gender_name'];?> </span> </div>
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="req_nation_name_th"> <?php echo $diff_info['req_nation_name_th'];?> </span> </div>
                          <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span><!--<input type="hidden" id="reg_addr_id" name="pers_info[reg_addr_id]" value="<?php echo $diff_info['reg_addr_id']; ?>">-->
                          <span id="req_reg_addr"><?php echo ' '.@$diff_info['req_reg_add_info']; ?></span> </div>
                    </div> 
<?php //print_r($impv_info);exit(); ?> 
<input type="hidden" id="pren_code" name="impv_info[pren_code]" value="<?php echo $req_pers_info['pren_code'];?>">
<input type="hidden" id="pren_name" name="impv_info[pren_name]" value="<?php echo $req_prename['prename_th'];?>">

<input type="hidden" id="pers_firstname_th" name="impv_info[pers_firstname_th]" value="<?php echo $req_pers_info['pers_firstname_th'];?>">
<input type="hidden" id="pers_lastname_th" name="impv_info[pers_lastname_th]" value="<?php echo $req_pers_info['pers_lastname_th'];?>">
<input type="hidden" id="date_of_birth" name="impv_info[date_of_birth]" value="<?php echo $req_pers_info['date_of_birth'];?>">
<input type="hidden" id="req_reg_addr_id" name="impv_info[req_reg_addr_id]" value="<?php //echo $diff_info['pers_firstname_th'];?>">

<input type="hidden" id="gender_code" name="impv_info[gender_code]" value="<?php echo $req_pers_info['gender_code'];?>">

<input type="hidden"  name="impv_addr[addr_home_no]" value="<?php echo $addr_pers_info['addr_home_no'];?>">
<input type="hidden"  name="impv_addr[addr_moo]" value="<?php echo $addr_pers_info['addr_moo'];?>">
<input type="hidden"  name="impv_addr[addr_alley]" value="<?php echo $addr_pers_info['addr_alley'];?>">
<input type="hidden"  name="impv_addr[addr_lane]" value="<?php echo $addr_pers_info['addr_lane'];?>">
<input type="hidden"  name="impv_addr[addr_road]" value="<?php echo $addr_pers_info['addr_road'];?>">
<input type="hidden"  name="impv_addr[addr_province]" value="<?php echo $addr_pers_info['addr_province'];?>">
<input type="hidden"  name="impv_addr[addr_district]" value="<?php echo $addr_pers_info['addr_district'];?>">
<input type="hidden"  name="impv_addr[addr_sub_district]" value="<?php echo $addr_pers_info['addr_sub_district'];?>"> 

<input type="hidden" id="addr_province" name="pers_addr[addr_province]" value="<?php //echo $impv_home_info['addrProvince'];?>">
<input type="hidden" id="addr_district" name="pers_addr[addr_district]" value="<?php //echo $impv_home_info['addrAmphur'];?>">
<input type="hidden" id="addr_sub_district" name="pers_addr[addr_sub_district]" value="<?php //echo $impv_home_info['addrProvince'];?>"> 
                                                  
                      <!---->

                      		<div class="form-group row">
                              <div class="col-xs-12 col-sm-3">
                         
                              <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่แจ้งเรื่อง </label>
                                      <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                        <input title="วันที่แจ้งเรื่อง" placeholder="เลือกวันที่" class="form-control" type="text" name="diff_info[date_of_req]" required/>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                      </div><!--end datetimepicker1-->
                                          <script type="text/javascript">
                                          <?php
                                          $tmp = explode('-',@$diff_info['date_of_req']);
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
                              </div><!--end col-xs-12 col-sm-3-->
                            
                              <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">ตำแหน่ง</label>
                                      <input title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" class="form-control" onkeyup="numberandth(this)" type="text" name="diff_info[req_position]" value="<?php echo $diff_info['req_position'];?>"/>
                              </div><!--end ตำแหน่ง -->
                              <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">หน่วยงาน</label>
                                      <input title="หน่วยงานต้นสังกัด" placeholder="ระบุหน่วยงานต้นสังกัด (ชื่อเต็มเท่านั้น)" class="form-control" onkeyup="numberandth(this)" type="text" name="diff_info[req_org]" value="<?php echo $diff_info['req_org'];?>"/>
                              </div><!--end หน่วยงาน -->
                              <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">เกี่ยวข้องเป็น</label>
                                      <input title="ความสัมพันธ์กับผู้สูงอายุ" placeholder="ระบุความสัมพันธ์กับผู้สูงอายุ" class="form-control" onkeyup="thvalidate(this)" type="text" name="diff_info[req_relation]" value="<?php echo $diff_info['req_relation'];?>"/>
                              </div><!--end เกี่ยวข้องเป็น -->
                        </div><!--end form-group row-->
                        <!--end บันทัด1-->
                        <div class="form-group row">
                 
                              <div class="col-xs-12 col-sm-3">
                                            <label class="col-2 col-form-label">เบอร์โทรศัพท์ (ที่ติดต่อได้)</label>
                                            <input title="เบอร์โทรศัพท์ (ที่ติดต่อได้)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" onkeyup="thnodash(this)" type="text" name="diff_info[req_tel_no]" value="<?php echo $diff_info['req_tel_no'];?>"/>
                              </div><!--end เบอร์โทรศัพท์ -->

                              <div class="col-xs-12 col-sm-3">
                                            <label class="col-2 col-form-label">ที่อยู่อีเมล</label>
                                            <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" onkeyup="nonthai(this)" type="email" name="diff_info[req_email_addr]" value="<?php echo $diff_info['req_email_addr'];?>"/>
                              </div><!--end email -->
                
                              <div class="col-xs-12 col-sm-3 dropdown has-error">
                                            <label for="example-text-input" class="col-2 col-form-label" style="color:red;">ช่องทางการแจ้งเรื่อง </label>
                                            <div class="col-10">
                                              <select id="chn_code" title="เลือกช่องทางการแจ้งเรื่อง" name="diff_info[chn_code]" placeholder="เลือกช่องทางการแจ้งเรื่อง" class="form-control" required>
                                              <option value="">เลือกช่องทางการแจ้งเรื่อง</option>
                                              <?php
                                              $tmps = $this->difficult_model->getAll_reqChanel();
                                              foreach ($tmps as $key => $value) {
                                                ?>
                                                <option <?php if($diff_info['chn_code']==$value['chn_code']) {?> selected <?php }?> value="<?php echo $value['chn_code'];?>"><?php echo $value['chn_name'];?></option>
                                                <?php
                                              }
                                              ?>
                                              </select>
                                            </div>
                              </div><!--end ช่องทางการแจ้งเรื่อง -->
                              <?php
                                 $usrm = $this->difficult_model->getUsrm(get_session('user_id'));
                                 $first_org = $this->difficult_model->get_diffInfo($diff_info['diff_id']);
                              
                              ?>
                              <input type="hidden" name="position" id="position" value="<?php echo $usrm['user_position']?>">
                              <input type="hidden" name="org" id="org" value="<?php echo $first_org['insert_org_id']?>">
                              <script type="text/javascript">
                             
                                $(document).ready(function(){
                                        // console.log('org'+$("#org").val());
                                            if($("#chn_code").val() =='007' && $("#position").val()=='4' &&  $("#org").val()=='174' ){
                                              $("#insert_org_id").toggle();
                                            }
                                           
                                           $("#Province").next().css("cssText", "border: 1px solid red; width:100%;");
                                           $("#Amphur").next().css("cssText", "border: 1px solid red; width:100%;");
                                           $("#Tambon").next().css("cssText", "border: 1px solid red; width:100%;");
                                     
                                });
                                                    

                               </script>
                              
                              <div id="insert_org_id" hidden='hidden' class="col-xs-12 col-sm-3 dropdown">
                                            <label for="example-text-input" class="col-2 col-form-label" style="color:red;">ย้ายไปที่</label>
                                            <div class="col-10 has-error">
                                              <select id="insert_org_id" title="เลือกหน่วยงาน" name="diff_info[insert_org_id]" placeholder="เลือกหน่วยงาน" class="form-control" >
                                              <option value="">เลือกหน่วยงาน</option>
                                              <?php $tmp_cr = $this->common_model->custom_query("select * from usrm_org");
                                                  foreach ($tmp_cr as $row) { ?>
                                                  <option <?php if($diff_info['insert_org_id']==$value['org_id']) {?> selected <?php }?> value="<?php echo $row['org_id'];?>" ><?php echo $row['org_title']; ?></option>
                                              <?php } ?>
                                              </select>
                                            </div>
                              </div><!--end ย้ายเรื่อง -->

                              
                    </div><!--end form-group row-->
                            
                </div>
                       <!--ที่อยู่ปัจจุบัน -->
                       
                       <!--end ที่อยู่ปัจจุบัน-->
                   
                  <div class="panel-heading">
                      <h4>
                      
                      <font >ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) </font>
                           <div class="checkbox-inline i-checks" >(&nbsp;<input type="checkbox" name="elder_pers_chk" id="elder_pers_chk"  
                           <?php if($req_pers_info['pers_firstname_th']== $diff_info['pers_firstname_th']
                           && $req_pers_info['pers_lastname_th']== $diff_info['pers_lastname_th']
                           && $req_pers_info['date_of_birth']== $diff_info['date_of_birth_num']
                           && $addr_pers_info['addr_home_no']== $addr_diff_info['addr_home_no']
                           && $addr_pers_info['addr_home_no']!= ""
                           ){ echo "checked"; }?> >  บุคคลเดียวกับผู้ยื่นคำขอ )</div>
                      &nbsp;
                      <!--
                      <button type="button" onclick="get_integration();" class="btn btn-default" style="float: right;padding-top: 0px; padding-bottom: 2px;">ข้อมูลบูรณาการ</button>-->
                      </h4>
                    </div>
                    <div class="panel-body" style="border:0; padding: 20px; padding-bottom: 0px;">
                      
                      <div class="alert alert-danger alert-excep-age <?php echo ( isset($diff_info['age']) && $diff_info['age'] < 60 ? "" : "hide" ) ?>">
                        <strong>แจ้งเตือน!</strong> การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก ผู้สูงอายุจะต้องมีอายุมากกว่า 60 ปี
                      </div>

                      <div class="form-group row">

                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน</span></div>
                        <div class="col-xs-12 col-sm-6 has-error" style="padding: 3px 15px;">

                         <div class="input-group" style="width: 295px;">
                            <input title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="elder_pid" name="diff_info[pid]" value="<?php echo $diff_info['pid'];?>" required/>
                            <div class="input-group-btn" style="padding-bottom: 5px;">
                                  <button type="button" title="ตรวจสอบ" class="btn btn-default elder_same_req r" onClick="bt_elder_pid()"   style="background-color:#F2DEDE;  border-radius: 0px; border-color: #ed5565;color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <input type="hidden" id="pid_id" name="diff_pid[pid]" value="<?php echo $diff_info['pid'];?>">
                            <input type="hidden" id="pers_id" name="diff_info[pers_id]" value="<?php echo $diff_info['pers_id'];?>">
                          </div>
                        </div>
        <?php //print_r($diff_info);exit(); ?> 
                 
<input type="hidden" id="pren_code_sufferer" name="impv_info2[pren_code_sufferer]" value="<?php echo $diff_info['pren_code'];?>">
<input type="hidden" id="pers_firstname_th" name="impv_info2[pers_firstname_th]" value="<?php echo $diff_info['pers_firstname_th'];?>">
<input type="hidden" id="pers_lastname_th" name="impv_info2[pers_lastname_th]" value="<?php echo $diff_info['pers_lastname_th'];?>">
<input type="hidden" id="date_of_birth" name="impv_info2[date_of_birth]" value="<?php echo $diff_info['date_of_birth_num'];?>">
<input type="hidden" id="gender_code" name="impv_info2[gender_code]" value="<?php echo $diff_info['gender_code'];?>">

<input type="hidden"  name="impv_addr2[addr_home_no]" value="<?php echo $addr_diff_info['addr_home_no'];?>">
<input type="hidden"  name="impv_addr2[addr_moo]" value="<?php echo $addr_diff_info['addr_moo'];?>">
<input type="hidden"  name="impv_addr2[addr_alley]" value="<?php echo $addr_diff_info['addr_alley'];?>">
<input type="hidden"  name="impv_addr2[addr_lane]" value="<?php echo $addr_diff_info['addr_lane'];?>">
<input type="hidden"  name="impv_addr2[addr_road]" value="<?php echo $addr_diff_info['addr_road'];?>">
<input type="hidden"  name="impv_addr2[addr_province]" value="<?php echo $addr_diff_info['addr_province'];?>">
<input type="hidden"  name="impv_addr2[addr_district]" value="<?php echo $addr_diff_info['addr_district'];?>">
<input type="hidden"  name="impv_addr2[addr_sub_district]" value="<?php echo $addr_diff_info['addr_sub_district'];?>"> 
                            
                          <!-- <button class="btn btn-default elder_same_req" title="กรณีไม่มีบัตร" type="button" style="">กรณีไม่มีบัตร</button> -->

                        <script>
                        // var elder_pers = null;
                        // var inputpid2 = "#elder_pid";//id
                        // var bt_spid2 = "#bt_elder_pid";//button
                        // var setData2 = "reqData2"; //Declear Name
                        // var reqData2 = function(value) { //Set Structure Display Data
                        // elder_pers = value;
                        // $("#name").html(value.name);
                        // $("#date_of_birth").html(value.date_of_birth);
                        // $("#gender_name").html(value.gender_name);
                        // $("#nation_name_th").html(value.nation_name_th);
                        // $("#relg_title").html(value.relg_title);
                        // $("#pers_id").val(value.pers_id);
                        // $("#reg_addr_id").val(value.reg_addr_id);
                        // $("#reg_addr").html(value.reg_add_info);

                        //   notice_excep_age(value.age);
                        // }
                        // $(bt_spid2).click(function(){//On Click for Search
                        // if($(inputpid2).val()!='') {//pid not null

                        //   $(bt_spid2).attr('disabled',true);
                        // if(pers_authen!=null) { //Check Personal Authen
                        //   getPersInfo(inputpid2,bt_spid2,setData2,true); //Get Data
                        // }else if(!reader_status) { //Run Reader Personal
                        //   run_readerPers();
                        //   $(bt_spid2).attr('disabled',false);
                        //   toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                        // }
                        // }else { //pid is null
                        // $(inputpid2).select();
                        // }
                        // });
                        </script>
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"  id="name_sufferer"> <?php echo $diff_prename['prename_th'].' '.$diff_info['name'];?> </div>
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;" id="date_of_birth_sufferer"> <?php echo $diff_info['date_of_birth']?> </div> 
                    </div>
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name_sufferer"> <?php echo $diff_info['gender_name'];?></span> </div>
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_sufferer"> <?php echo $diff_info['nation_name_th'];?></span> </div>
                        <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span><input type="hidden" id="reg_addr_sufferer" name="pers_info[reg_addr_id]" value="<?php echo $diff_info['reg_addr_id']; ?>">
                        <span id="reg_addr"> <?php echo @$diff_info['reg_add_info']; ?></span> </div>
                    </div>   
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-6"><font >ที่อยู่ (ปัจจุบัน) </font> (&nbsp; <div  class="checkbox-inline i-checks" ><input  type="checkbox" name="elder_addr_chk" id="elder_addr_chk"> <i></i> ตรงกับที่อยู่ตามทะเบียนบ้าน )</div></div>
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

                      <div class="addr form-group row" >

                    <div class="col-lg-12" id="integration1" hidden='hidden'>
                    <div class="ibox float-e-margins">
                        <div class="ibox-content" style="padding-bottom: 0px">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="background-color: #459597; color: #fff">ข้อมูลบูรณาการ</th>
                                        <th style="background-color: #459597; color: #fff">หน่วยงาน</th>
                                        <th style="background-color: #459597; color: #fff">รายละเอียด</th>
                                        <!-- <th style="background-color: #459597; color: #fff">#</th> -->
                                    </tr>
                                    </thead>
                                    <tbody>
                             
                                    <tr>
                                        <td>
                                            <b>อายุผู้ขอรับบริการ</b> <!--วัน/เดือน/ปี/เกิด : <span id="row1_date_of_birth">-</span>-->
                                        </td>
                                        <td>
                                          กรมการปกครอง
                                        </td>
                                        <td>
                                          <span id="age_status_txt"><?php echo $diff_info['age_status'] ?></span>
                                        </td>
                                        <!-- <td id="row1_state"><i class="fa fa-times text-danger"></i></td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>สถานะการเสียชีวิต</b> วัน/เดือน/ปีเสียชีวิต  <span id="row2_date_of_death"><?php echo $diff_info['death_date'] ?></span>
                                        </td>
                                        <td>
                                          กรมการปกครอง
                                        </td>
                                        <td>
                                
                                          <span id="death_status_txt"><?php echo $diff_info['death_status'] ?></span>
                                        </td>
                                        <!-- <td id="row2_state"><i class="fa fa-times text-danger"></i></td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>ความจำเป็นพื้นฐาน (จปฐ.) : รายได้เฉลี่ย </b> <span id="jpth_detail">-</span>
                              
                                        </td>
                                        <td>
                                          กรมการพัฒนาชุมชน
                                        </td>
                                        <td>
                                           <span id="income_state"></span>
                                           <!--ไม่สามารถดึงข้อมูลได้-->
                                        </td>
                                        <!-- <td id="row3_state"><i class="fa fa-times text-danger"></i></td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>ทะเบียนจัดหางานผุ้สูงอายุ</b> วันที่ขึ้นทะเบียน : <span id="row4_date_of_reg_th">-</span> สถานะการได้รับงาน : <span id="row4_reg_status">-</span>
                                        </td>
                                        <td>
                                            กรมการจัดหางาน
                                        </td>
                                        <td>
                                            ไม่สามารถดึงข้อมูลได้
                                        </td>
                                        <!-- <td id="row4_state"><i class="fa fa-times text-danger"></i></td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>กองทุนผู้สูงอายุ</b> ประวัติการกู้ยืมกองทุน : <span id="row5_loan_history">-</span> สถานะสัญญากู้ยืม : <span id="row5_contract_status">-</span>
                                        </td>
                                        <td>
                                          กรมกิจการผู้สูงอายุ
                                        </td>
                                        <td id="row5_state">ไม่พบข้อมูลประวัติการกู้ยืมกองทุน</td>
                                        <!-- <td id="row5_state"><i class="fa fa-times text-danger"></i></td> -->
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก</b> ประวัติการได้รับการสงเคราะห์ : <span id="row6_history">-</span> ภายในรอบปีนี้ <span id="row6_year_now_history">-</span> (ครั้ง)
                                        </td>
                                        <td>
                                          กรมกิจการผู้สูงอายุ
                                        </td>
                                        <td id="row6_state">ตรวจสอบข้อมูลเสร็จสิ้น</td>
                                        <!-- <td id="row6_state"><i class="fa fa-times text-danger"></i></td> -->
                                    </tr>

                              
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                        

                        <script type="text/javascript">
                        $(document).ready(function (){
                            $('.i-checks').iCheck({
                              checkboxClass: 'icheckbox_square-green',
                              radioClass: 'iradio_square-green',
                              increaseArea: '20%'
                            });

                          <?php
                          if(
                            $addr_pers_info['addr_home_no']== $addr_info['addr_home_no']
                           && $addr_pers_info['addr_moo']== $addr_info['addr_moo']
                           && $addr_pers_info['addr_home_no']!= ""

                          ) 
                            {
                            ?>
                              $("input[name='elder_addr_chk']").parent().addClass('checked');
                              $("input[name='elder_addr_chk']").prop('checked',true);
                              $(".elder_addr_pre").attr('disabled',true);
                            <?php
                          }
                          ?>

                        });

                       

                        // $("input[name='elder_pers_chk']").on('ifUnchecked', function(event){
                        //     $("#elder_pid").val('');
                        //     $("#pid").val("");
                        //     $("#pers_id").val("");
                        //     $("#name").html('-');
                        //     $("#date_of_birth").html('-');
                        //     $("#gender_name").html('-');
                        //     $("#nation_name_th").html('-');
                        //     $("#relg_title").html('-');
                        //     $("#reg_addr_id").val('');
                        //     $("#reg_addr").html('-');
                        //     $("#elder_name").html(" - ");

                        //     $(".elder_same_req").attr('disabled',false);
                        //     $("#integration1").hide();

                        //     notice_excep_age(-1);
                        // });

                        // $("select[name='pers_addr[addr_province]").on('ifUnchecked', function(event){
                        //     $(".elder_addr_pre").css("color","red")
                        // });

                        </script>

                      </div>
                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">สถานะการพักอาศัย</label>
                          <div class="col-10">
                            <select title="สานะการพักอาศัย" placeholder="เลือกสถานะการพักอาศัย" class="form-control" name="pers_info[pre_addr_status]">
                              <option value="">เลือกสถานะการพักอาศัย</option>
                              <option value="บ้านตนเอง" <?php if(@$req_pers_info['pre_addr_status'] == 'บ้านตนเอง'){ echo "selected";} ?>>บ้านตนเอง</option>
                              <option value="อาศัยผู้อื่นอยู่" <?php if(@$req_pers_info['pre_addr_status'] == 'อาศัยผู้อื่นอยู่'){ echo "selected";} ?>>อาศัยผู้อื่นอยู่</option>
                              <option value="บ้านเช่า" <?php if(@$req_pers_info['pre_addr_status'] == 'บ้านเช่า'){ echo "selected";} ?>>บ้านเช่า</option>
                              <option value="อยู่กับผู้จ้าง" <?php if(@$req_pers_info['pre_addr_status'] == 'อยู่กับผู้จ้าง'){ echo "selected";} ?>>อยู่กับผู้จ้าง</option>
                              <option value="ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง" <?php if(@$req_pers_info['pre_addr_status'] == 'ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง'){ echo "selected";} ?>>ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label" style="color:red">บ้านเลขที่</label>
                          <input type="hidden" name="pre_addr_id" value="<?php echo @$diff_info['pre_addr_id']; ?>">
                          <input type="hidden" name="addr_home_id" value="<?php echo @$addr_info['addr_home_no']; ?>">
                          <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" style="border-color:#ed5565" onkeyup="nonthnumber(this)" type="text"  id="addr_home_no" name="pers_addr[addr_home_no]" value="<?php echo @$addr_info['addr_home_no']; ?>" required/>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">หมู่ที่</label>
                          <input type="hidden" name="addr_moo_id" value="<?php echo @$addr_info['addr_moo']; ?>">
                          <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" onkeyup="housenumber(this)" name="pers_addr[addr_moo]" id="addr_moo"  value="<?php echo @$addr_info['addr_moo']; ?>"/>
                        </div>
                      </div>
                      <div class="form-group row pre_addr_dev">
                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                          <div class="col-10">
                            <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" onkeyup="nonthnumandeng(this)" type="text" name="pers_addr[addr_alley]" value="<?php echo @$addr_info['addr_alley']; ?>" />
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                          <div class="col-10">
                            <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" onkeyup="addressvalidate(this)" type="text" name="pers_addr[addr_lane]" value="<?php echo @$addr_info['addr_lane']; ?>" />
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                          <div class="col-10">
                            <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" onkeyup="nonthnumandeng(this)" type="text" name="pers_addr[addr_road]" value="<?php echo @$addr_info['addr_road']; ?>" />
                          </div>
                        </div>
                      </div>
                      <div class="form-group row pre_addr_dev">
                         <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label" style="color:red">จังหวัด</label>
                          <div class="col-10">
                            <select title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="pers_addr[addr_province]" onchange="optionGen(this,'Amphur',<?php echo @$addr_info['district_code']; ?>);" required>
                              <option value="">เลือกจังหวัด</option>
                              <?php $temp = $this->personal_model->getAll_Province();
                              foreach ($temp as $key => $row) { ?>
                              <option value="<?php echo $row['area_code']; ?>"  ><?php echo $row['area_name_th']; ?></option>
                              <?php  } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label" style="color:red">อำเภอ</label>
                          <div class="col-10">
                            <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="pers_addr[addr_district]" onchange="optionGen(this,'Tambon',<?php echo @$addr_info['sub_district_code']; ?>);" disabled required>
                              <option value="">เลือกอำเภอ</option>
                              <?php //$temp = $this->personal_model->getAll_Amphur();
                              //foreach ($temp as $key => $row) { ?>
                              <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                              <?php  //} ?>
                            </select>
                          </div>
                        </div>
                   
                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" style="color:red" class="col-2 col-form-label">ตำบล</label>
                          <div class="col-10">
                            <select title="ตำบล" placeholder="เลือกตำบล"  class="form-control elder_addr_pre" id="Tambon" name="pers_addr[addr_sub_district]" disabled required>
                              <option value="">เลือกตำบล</option>
                              <?php //$temp = $this->personal_model->getAll_Tambon();
                              //foreach ($temp as $key => $row) { ?>
                              <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                              <?php  //} ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">รหัสไปรษณีย์</label>
                          <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" maxlength="5" onkeyup="numbervalid(this)" type="text" name="pers_addr[addr_zipcode]" value="<?php echo @$addr_info['addr_zipcode']; ?>"/>
                        </div>
                      </div>

                       <div class="form-group row pre_addr_dev">
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">เบอร์โทรศัพท์ (ที่ติดต่อได้)</label>
                          <input title="เบอร์โทรศัพท์ (ที่ติดต่อได้)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" onkeyup="thnodash(this)" type="text" name="pers_info[tel_no]" value="<?php echo @$diff_detail['tel_no'];?>"/>
                        </div><!--end tel_no-->

                        <div class="col-xs-12 col-sm-3">
                          <label  class="col-2 col-form-label">ที่อยู่อีเมล</label>
                          <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" onkeyup="nonthai(this)" type="email" name="pers_info[email_addr]" value="<?php echo @$diff_detail['email_addr'];?>"/>
                        </div> <!--end email_addr-->
                      

                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">สถานะการสมรส</label>
                          <div class="col-10">
                            <select title="สถานะการสมรส" placeholder="เลือกสถานะการสมรส" class="form-control" name="pers_info[marital_status]">
                              <option value="">เลือกสถานะการสมรส</option>
                              <option value="โสด" <?php if(@$diff_detail['marital_status'] == 'โสด'){ echo "selected"; } ?>>โสด</option>
                              <option value="สมรส อยู่ด้วยกัน" <?php if(@$diff_detail['marital_status'] == 'สมรส อยู่ด้วยกัน'){ echo "selected"; } ?>>สมรส อยู่ด้วยกัน</option>
                              <option value="สมรส แยกกันอยู่" <?php if(@$diff_detail['marital_status'] == 'สมรส แยกกันอยู่'){ echo "selected"; } ?>>สมรส แยกกันอยู่</option>
                              <option value="หย่าร้าง" <?php if(@$diff_detail['marital_status'] == 'หย่าร้าง'){ echo "selected"; } ?>>หย่าร้าง</option>
                              <option value="ไม่ได้สมรส แต่อยู่ด้วยกัน" <?php if(@$diff_detail['marital_status'] == 'ไม่ได้สมรส แต่อยู่ด้วยกัน'){ echo "selected"; } ?>>ไม่ได้สมรส แต่อยู่ด้วยกัน</option>
                              <option value="หม้าย (คู่สมรสเสียชีวิต)" <?php if(@$diff_detail['marital_status'] == 'หม้าย (คู่สมรสเสียชีวิต)'){ echo "selected"; } ?>>หม้าย (คู่สมรสเสียชีวิต)</option>
                            </select>
                          </div>
                        </div><!--end marital-->

                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                          <div class="col-10">
                            <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control" name="pers_info[edu_code]">
                              <option value="">เลือกระดับการศึกษา</option>
                              <?php $temp = $this->personal_model->getAll_edu_level();
                              foreach ($temp as $key => $row) { ?>
                              <option value="<?php echo $row['edu_code']; ?>" <?php if(@$diff_detail['edu_code'] == $row['edu_code']){ echo "selected"; } ?>><?php echo $row['edu_title']; ?></option>
                              <?php  } ?>
                            </select>
                          </div>
                        </div><!--end edu-->
                       </div><!--end row-->           
              

                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">อาชีพ (ปัจจุบัน)</label>
                            <select id="occupation" title="อาชีพ (ปัจจุบัน)" placeholder="เลือกอาชีพ" class="form-control" name="pers_info[occupation]">
                              <option value="">เลือกอาชีพ</option>
                              <option value="ค้าขาย" <?php if(@$diff_detail['occupation'] == 'ค้าขาย'){ echo "selected"; } ?>>ค้าขาย</option>
                              <option value="แม่บ้าน" <?php if(@$diff_detail['occupation'] == 'แม่บ้าน'){ echo "selected"; } ?>>แม่บ้าน</option>
                              <option value="รับจ้าง" <?php if(@$diff_detail['occupation'] == 'รับจ้าง'){ echo "selected"; } ?>>รับจ้าง</option>
                              <option value="เกษตรกรรม" <?php if(@$diff_detail['occupation'] == 'เกษตรกรรม'){ echo "selected"; } ?>>เกษตรกรรม</option>
                              <option value="ไม่ได้ทำงาน"<?php if(@$diff_detail['occupation'] == 'ไม่ได้ทำงาน'){ echo "selected"; } ?>>ไม่ได้ทำงาน</option>
                              <option value="อื่นๆ" <?php if(@$diff_detail['occupation'] == 'อื่นๆ'){ echo "selected"; } ?>>อื่นๆ</option>
                            </select>                                
                        </div>
                        <script type="text/javascript">
                                                      $("#occupation").change(function () {
                                                        if($(this).val() == "อื่นๆ"){
                                                          $("#other_occupation").prop('disabled', false ).focus();
                                                        }else{
                                                          $("#other_occupation").val("");
                                                          $("#other_occupation").prop('disabled', true );
                                                        }
                                                      });
                                                    

                        </script>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">อาชีพอื่นๆ (ระบุ)</label>
                          <input id="other_occupation" title="ระบุ" onkeyup="thvalidate(this)" id="other" placeholder="ระบุ" class="form-control" type="text" name="pers_info[other_occupation]" value="<?php echo @$diff_info['other_occupation']; ?>"/>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">รายได้เฉลี่ย (บาท/เดือน)</label>
                          <input title="รายได้เฉลี่ย (บาท/เดือน)" placeholder="รายได้เฉลี่ย (บาท/เดือน)" class="form-control" type="text" onkeyup="numberndot(this)" name="pers_info[mth_avg_income]" value="<?php echo @$diff_info['mth_avg_income']; ?>"/>
                        </div> -->
                        </div>
                        <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">รายได้เฉลี่ย (บาท/เดือน)</label>
                          <input title="รายได้เฉลี่ย (บาท/เดือน)" placeholder="รายได้เฉลี่ย (บาท/เดือน)" class="form-control" type="text" onkeyup="numberndot(this)" name="pers_info[mth_avg_income]" value="<?php echo @$diff_info['mth_avg_income']; ?>"/>
                        </div>
                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label for="example-text-input" class="col-2 col-form-label">ที่มาของรายได้</label>
                          <div class="col-10">
                            <select title="ที่มาของรายได้" placeholder="เลือกที่มาของรายได้" class="form-control" name="pers_info[src_of_income]">
                              <option value="">เลือกที่มาของรายได้</option>
                              <option value="ด้วยตนเอง" <?php if($diff_detail['src_of_income'] == 'ด้วยตนเอง'){ echo "selected"; } ?>>ด้วยตนเอง</option>
                              <option value="ผู้อื่นให้" <?php if($diff_detail['src_of_income'] == 'ผู้อื่นให้'){ echo "selected"; } ?>>ผู้อื่นให้</option>
                              <option value="อื่น ๆ" <?php if($diff_detail['src_of_income'] == 'อื่น ๆ'){ echo "selected"; } ?>>อื่น ๆ</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">ที่มาของรายได้อื่นๆ (ระบุ)</label>
                          <input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" onkeyup="nonthnumandeng(this)" name="pers_info[src_of_income_identify]" value="<?php echo @$diff_detail['src_of_income_identify']; ?>"/>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">เลขบัญชีธนาคาร</label>
                          <input title="ระบุ" placeholder="ระบุ" class="form-control" type="text"  name="pers_info[bank_acc_no]" value="<?php echo @$diff_detail['bank_acc_no']; ?>"/>
                        </div>
                        <div class="col-xs-12 col-sm-3 dropdown">
                          <label class="col-2 col-form-label">ชื่อธนาคาร</label>
                          <select id="bank_code" title="ชื่อธนาคาร" placeholder="เลือกธนาคาร" class="form-control" name="pers_info[bank_name]" >
                              <option value="">เลือกธนาคาร</option>
                                   <?php $tmp_cr = $this->common_model->custom_query("select * from std_bank");
                                        foreach ($tmp_cr as $row) { ?>
                                        <option value="<?php echo $row['bank_code'];?>" <?php if($row['bank_code'] == $diff_detail['bank_name']){ echo "selected";} ?>><?php echo $row['bank_name']; ?></option>
                                        <?php } ?>
                          </select>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">ธนาคารอื่นๆ</label>
                          <input id="other_bank" title="ระบุ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text"  name="pers_info[bank_other]" value="<?php echo $diff_detail['bank_other']; ?>" <?php if($diff_detail['bank_other'] == "") { echo "disabled";} ?> />
                        </div>
                      </div>
                      <script type="text/javascript">
                                $("#bank_code").change(function () {
                                  if($(this).val() == "030"){
                                    $("#other_bank").prop('disabled', false ).focus();
                                  }else{
                                    $("#other_bank").val('');
                                    $("#other_bank").prop('disabled', true );
                                  }
                                });
                                                    

                      </script>

                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">สถานะหนี้สิน</label><br>
                          <div class="i-checks"><label><input type="radio" name="pers_info[dept_status]" value="ไม่มีหนี้สิน" <?php if(@$diff_detail['dept_status'] == 'ไม่มีหนี้สิน') { echo "checked";} ?>><i></i> ไม่มีหนี้สิน</label></div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">&nbsp;</label><br>
                          <div class="i-checks"><label><input type="radio" name="pers_info[dept_status]" value="มีหนี้สิน" <?php if(@$diff_detail['dept_status'] == 'มีหนี้สิน') { echo "checked";} ?>><i></i> มีหนี้สิน</label></div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">เงินกู้ในระบบ (บาท)</label>
                          <input title="เงินกู้ในระบบ" placeholder="ระบุจำนวนเงิน (บาท)" name="pers_info[dept_loan_system]" class="form-control" type="text" onkeyup="numberndot(this)"  value="<?php echo @$diff_detail['dept_loan_system']; ?>" />
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label class="col-2 col-form-label">เงินกู้นอกระบบ (บาท)</label>
                          <input title="เงินกู้นอกระบบ" placeholder="ระบุจำนวนเงิน (บาท)" class="form-control" type="text" onkeyup="numberndot(this)" name="pers_info[dept_loan_shark]"  value="<?php echo @$diff_detail['dept_loan_shark']; ?>"/>
                        </div>
                      </div>
                                                

                      <div class="form-group row" style="margin-bottom: 5px;">
                       <div class="col-xs-12 col-sm-12">
                        <?php $count = count(@$pers_family); ?>
                        <label>สมาชิกในครอบครัว (จำนวน <span id="nums_family_members"><?php echo $count; ?></span> คน)</label>
                      </div>
                      <div class="col-xs-12 col-sm-12"><br></div>
                        <script>
                        var nummf = <?php echo $count; ?>;
                        function btDel_family_members(node) {
                        $(node).parent().parent().parent().parent().remove();
                        $("#nums_family_members").html($(".family_members .family_members_items").length);
                        }
                        </script>

                        <div class="col-xs-12 col-sm-12">
                          <div class="family_members" >
                            <?php if(!empty($pers_family)){ ?>
                            <?php foreach ($pers_family as $key => $row) { ?>
                            <?php //dieArray($row); ?>
                            <div class="panel-group family_members_items" style="margin-top: -10px;">
                              <div class="panel panel-default" style="border: 0">

                                <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                  <div class="row text-right">
                                    <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label" style="font-weight: bold; color: red;">เลขบัตรประจำตัวประชาชน</label>
                                      <input  id="pid_<?php echo $key;?>" value="<?php echo $row['fml_pid'];?>" style="border-color:red;" title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard" type="text" name="pers_family[fml_pid][<?php echo $key;?>]"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 dropdown">
                                      <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
                                      <div class="col-10">
                                        <select title="คำนำหน้านาม" placeholder="เลือกคำนำหน้านาม" class="form-control " name="pers_family[pren_code][<?php echo $key;?>]">
                                          <option value="">เลือกคำนำหน้านาม</option>
                                          <?php
                                          $tmps = $this->common_model->custom_query("select * from std_prename");
                                          foreach ($tmps as $key1 => $value) {
                                            ?>
                                            <option <?php if(@$row['pren_code']==$value['pren_code']){?> selected<?php }?> value="<?php echo $value['pren_code'];?>"><?php echo $value['prename_th'];?></option>
                                            <?php
                                          }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">ชื่อตัว</label>
                                      <input title="ชื่อตัว" placeholder="ระบุชื่อตัว" class="form-control" type="text" name="pers_family[pers_firstname_th][<?php echo $key;?>]" value="<?php echo @$row['pers_firstname_th'];?>"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">ชื่อสกุล</label>
                                      <input title="ชื่อสกุล" placeholder="ระบุชื่อสกุล" class="form-control " type="text" name="pers_family[pers_lastname_th][<?php echo $key;?>]" value="<?php echo @$row['pers_lastname_th'];?>"/>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">อายุ (ปี)</label>
                                      <input title="อายุ" id="pers_age_<?php echo $key;?>" placeholder="ระบุอายุ (ปี)" class="form-control numberonly" type="text" name="pers_family[fml_age][<?php echo $key;?>]" value="<?php echo @$row['fml_age'];?>" />
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">เกี่ยวข้องเป็น</label>
                                      <input title="ความสัมพันธ์กับผู้สูงอายุ" placeholder="ระบุความสัมพันธ์กับผู้สูงอายุ" onkeyup="numberandth(this)" class="form-control" type="text" name="pers_family[fml_relation][<?php echo $key;?>]" value="<?php echo $row['fml_relation'];?>"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">อาชีพ</label>
                                      <input title="อาชีพ" placeholder="ระบุอาชีพ" class="form-control" type="text" id="occupation_<?php echo $key;?>" name="pers_family[occupation][<?php echo $key;?>]" value="<?php echo $row['occupation'];?>"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">รายได้เฉลี่ย (บาท/เดือน)</label>
                                      <input title="รายได้เฉลี่ย" placeholder="ระบุรายได้เฉลี่ย (บาท/เดือน)" class="form-control" onkeyup="numberndot(this)" type="text" id="mth_avg_income_<?php echo $key;?>" name="pers_family[mth_avg_income][<?php echo $key;?>]" value="<?php echo $row['mth_avg_income'];?>"/>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                                      <input title="อายุ" id="pers_age_myID" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" onkeyup="thnodash(this)" type="text" id="fml_tel_no_home_<?php echo $key;?>" value="<?php echo $row['fml_tel_no_home'];?>" name="pers_family[fml_tel_no_home][<?php echo $key;?>]"/>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                      <label class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                      <input title="อายุ" id="pers_age_myID" placeholder="ตัวอย่าง 08XXXXXXXX" maxlength="10" class="form-control" onkeyup="numbervalid(this)" type="text" id="fml_tel_no_<?php echo $key;?>" value="<?php echo $row['fml_tel_no'];?>" name="pers_family[fml_tel_no][<?php echo $key;?>]"/>
                                    </div>
                                      
                                  </div>


                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-6">
                                      <label class="col-2 col-form-label">ปัญหาสุขภาพ</label>&nbsp;&nbsp;
                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy][<?php echo $key;?>]" value="ปกติ" <?php if($row['healthy'] == 'ปกติ'){ echo "checked";} ?>><i></i> ปกติ</label></div>&nbsp;&nbsp;&nbsp;
                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy][<?php echo $key;?>]" value="ผู้ป่วยเรื้อรัง" <?php if($row['healthy'] == 'ผู้ป่วยเรื้อรัง'){ echo "checked";} ?>><i></i> ผู้ป่วยเรื้อรัง</label></div>&nbsp;&nbsp;&nbsp;
                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy][<?php echo $key;?>]" value="ผู้พิการ" <?php if($row['healthy'] == 'ผู้พิการ'){ echo "checked";} ?>><i></i> ผู้พิการ</label></div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                      <label class="col-2 col-form-label">ช่วยเหลือตนเอง</label>&nbsp;&nbsp;
                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy_self_help][<?php echo $key;?>]" value="ได้" <?php if($row['healthy_self_help'] == 'ได้'){ echo "checked";} ?>><i></i> ได้</label></div>&nbsp;&nbsp;&nbsp;
                                      <div class="checkbox-inline i-checks"><label><input type="radio" name="pers_family[healthy_self_help][<?php echo $key;?>]" value="ไม่ได้" <?php if($row['healthy_self_help'] == 'ไม่ได้'){ echo "checked";} ?>><i></i> ไม่ได้</label></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <?php } ?>
                            <?php } ?>
                          </div>
                        </div>

                        <div class="col-xs-12 col-sm-12">
                          <button type="button" class="btn btn-default" id="btAdd_family_members" style="margin-top: 4px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                        </div>

                        <script>
                        var cloneTmp = $('.family_members_template').clone();
                        // setTimeout(function(){addFmlyMember();},500);
                        function addFmlyMember() {
                          var cloneTmp1 = cloneTmp.html().replace(new RegExp("myID", 'g'), nummf);

                          setTimeout(function(){
                            $("#pid_"+(nummf-1)).mask("9-9999-99999-99-9");
                            $("#pren_code_"+(nummf-1)).select2();
                            //alert("#pid_"+(nummf-1));
                          },1000);

                          nummf = nummf+1;
                          $(cloneTmp1).clone().appendTo('.family_members');
                          $("#nums_family_members").html($(".family_members .family_members_items").length);
                          $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                            increaseArea: '20%'
                          });
                        }
                        $("#btAdd_family_members").click(function(){ //Add

                           addFmlyMember();
                           //icheck_loop();
                        });
                        </script>

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
                      <!-- <div class="col-xs-12 col-sm-2">
                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-export" onclick="window.location.href='<?php //echo site_url('difficult/send_sms');?>'"><i class="fa fa-commenting" aria-hidden="true"></i> ส่ง sms</button>
                      </div> -->
    
                      <div class="col-xs-12 col-sm-2">
                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" ><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('difficult/assist_list');?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                      </div>
                    </div><!-- close class row-->

              </div>

            </div>
            <div id="tab-2" <?php if($usrpm['app_id']==4){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
              <div class="panel-body">
                <!-- <strong>Tab-3</strong> -->
              </div>
            </div>
            <div id="tab-3" <?php if($usrpm['app_id']==5){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
              <div class="panel-body">
                <!-- <strong>Tab-3</strong> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
    <?php if($process_action == 'Edit'){ ?>
    setTimeout(function(){$("#Province").val('<?php echo @$addr_info['province_code']; ?>').trigger('change');},200);
   
    <?php } ?>
    function set_enable(elem,target='') {
    if(elem.prop('checked') == true) {
    $(target).prop('disabled', false ).focus();
    }else{
    $(target).val('');
    $(target).prop('disabled', true );
    }
    }
    function optionGen(code,target,opSelect) {
     
     //alert('code = '+code.value);
    // alert('target = '+target);
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
    //console.dir('off',ret);
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
          function get_integration() {
          if($("#pers_id").val() != ''){
            $.ajax({
              url: '<?php echo base_url("personals/getIntegration"); ?>',
              type: 'POST',
              dataType: 'json',
              data: {
              'pers_id': $("#pers_id").val(),
              'csrf_dop': csrf_hash,
            },
            }).done(function(ret) {
              console.log("success");
              //console.log(ret);

              // จ้างงาน ///////////////////////////////////
              $("#job_req").text(ret.job_info.date_of_reg);
              if(ret.job_info.reg_status == "ยังไม่ได้งาน"){
              $("#job_stat").text(ret.job_info.reg_status).css('color', '#D1813F');
              }else{
              $("#job_stat").text(ret.job_info.reg_status).css('color', 'green');
              }
              $("#job_org").text('('+ret.job_info.rec_source+')');
              //////////////////////////////////////////////
            })
            .fail(function() {
              console.log("error");
            });

              $('#integration').modal('show');
            }
          }
          </script>




          <!-- Modal -->
              <div class="modal fade" id="modal_marker" role="dialog">
            <div class="modal-dialog modal-lg">

              <!-- Modal content-->
              <div class="modal-content" style="font-size:14px;">
                <div class="modal-header" style="background-color: rgb(56,145,209);color: white;">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <b><i class="fa fa-map-marker" aria-hidden="true"></i> ค้นหาสถานที่</b>
                </div>
                <div class="modal-body">
                  <form name="form_search" method="post" action="">
                    ชื่อสถานที่
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
          <!-- Info Modal -->
          <div class="modal fade" id="integration" role="dialog">
            <div class="modal-dialog" style="width: 1000px;">
              <div class="modal-content">
                <div class="modal-header" style="background-color: #eee">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h3 class="modal-title text-left">ผู้สูงอายุที่เข้าร่วม</h3>
                </div>
                <div class="modal-body">
                  <div style="font-size: 24px;color: #A7A7A7;margin-bottom: 10px; border-top: 1px solid #EDEDED;border-bottom: 1px solid #EDEDED;">
                    ข้อมูลบูรณาการ
                  </div>
                  <!-- <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <label>ขึ้นทะเบียนผู้มีรายได้น้อย</label>
                      <div>(กรมการปกครอง)</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>วันที่ขึ้นทะเบียน</label>
                      <div>20 สิงหาคม 2559</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>สถานะการได้รับความช่วยเหลือ</label>
                      <div style="color: green;">ได้รับ</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label></label>
                      <div></div>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <label>ความจำเป็นพื้นฐาน (จปฐ.)</label>
                      <div>(กรมการพัฒนาชุมชน)</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>อาชีพ (ปัจจุบัน)</label>
                      <div>เกษตรกร</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>รายได้เฉลี่ยน (บาท/เดือน)</label>
                      <div style="color: #D1813F;">3,800</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>ที่มาของรายได้</label>
                      <div  style="color: green;">ด้วยตนเอง</div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <label>ทะเบียนจัดหางานผุ้สูงอายุ</label>
                      <div id="job_org">(กรมการจัดหางาน)</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>วันที่ขึ้นทะเบียน</label>
                      <div id="job_req">16 มกราคม 2560</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>สถานะการได้รับงาน</label>
                      <div  style="color: green;" id="job_stat">ได้งานทำแล้ว</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label></label>
                      <div></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <label>กองทุนผู้สูงอายุ</label>
                      <div>(กรมกิจการผู้สูงอายุ)</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>ประวัติการกู้ยืมกองทุน</label>
                      <div style="color: green">มีประวัติ</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>สถานะสัญญากู้ยืม</label>
                      <div style="color: #D1813F;">ยังมีสัญญา</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label></label>
                      <div></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <label>การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก</label>
                      <div>(กรมกิจการผู้สูงอายุ)</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>ประวัติการได้รับการสงเราะห์</label>
                      <div style="color: green" >เคยได้รับ</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>ภายในรอบปีนี้ (ครั้ง)</label>
                      <div style="color: red;">3 (ได้รับครบ 3 ครั้ง ภายในรอบ 1 ปี)</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label></label>
                      <div></div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <label>ศูนย์พัฒนาการจัดสวัสดิการสังคมฯ</label>
                      <div>(กรมกิจการผู้สูงอายุ)</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>ประวัติการได้รับบริการ</label>
                      <div style="color: green">เคยได้รับ</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>ภายในรอบปีนี้ (ครั้ง)</label>
                      <div style="color: #D1813F;">1</div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                      <label>ศูนย์ที่รับเข้ารับบริการ (ล่าสุด)</label>
                      <div>ศูนย์พัฒนาฯ บางละมุง (จำหน่ายแล้ว)</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Info Modal -->
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
                  <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
                </div>
                <div class="modal-body">
                  <?php $str = getMsg('054');?>
                  <p><?php echo $str;?></p>
                  <!--<p>ยืนยันการลบ?</p>-->
                </div>
                <div class="modal-footer">
                  <button id="savbtnYes"  type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
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
                      <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
                      <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
                      <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
                      <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                      </a>
                    </div>
                  </div>
                  <br/>
                </div>
              </div>

            </div>
          </div>
          <!-- End Print Modal -->

<script>

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

var integration1 = function(info) {
  $("#integration1").show();//Show Dialog

  //Service 1
  if(info.age>=60) {
    info.date_of_birth = info.date_of_birth==''?'-':info.date_of_birth;
    $("#row1_date_of_birth").html("<span style='color:green'>"+info.date_of_birth+"</span>");
    $("#row1_state").html("<i class='fa fa-check text-navy'></i>");

    $("#age_status_txt").html("60 ปีขึ้นไป");
  }else {
    info.date_of_birth = info.date_of_birth==''?'-':info.date_of_birth;
    $("#row1_date_of_birth").html("<span style='color:red'>"+info.date_of_birth+"</span>");
    $("#row1_state").html("<i class='fa fa-times text-danger'></i>");

    $("#age_status_txt").html("ต่ำกว่า 60 ปี");
  }
  //$("#pers_old").html(info.age);
  //End Service 1

  //Service 2
  if(info.date_of_death!='') {
    info.date_of_death = info.date_of_death==''?'-':info.date_of_death;
    $("#row2_date_of_death").html("<span style='color:red'>"+info.date_of_death+"</span>");
    $("#row2_state").html("<i class='fa fa-times text-danger'></i>");

     $("#death_status_txt").html("เสียชีวิต");
  }else {
    info.date_of_death = info.date_of_death==''?'-':info.date_of_death;
    $("#row2_date_of_death").html("<span style='color:green'>"+info.date_of_death+"</span>");
    $("#row2_state").html("<i class='fa fa-check text-navy'></i>");

    $("#death_status_txt").html("มีชีวิตอยู่");
  }
  //End Service 2
  info.reg_addr.addr_home_no = info.reg_addr.addr_home_no==null?'-':info.reg_addr.addr_home_no;
  info.reg_addr.addr_sub_district = info.reg_addr.addr_sub_district==null?'-':info.reg_addr.addr_sub_district;
  //Service 3
    // $.ajax({
    // url: 'https://gateway.dop.go.th/transfer/import/RequestElderyJPTH',
    // type: 'POST',
    // dataType: 'json',
    // data: {
    //     'Username': 'dopjpth',
    //     'Password': 'dpuser',
    //     'OfficerPID': pers_authen.pid,
    //     'addr_home_no': info.reg_addr.addr_home_no,
    //     'addr_sub_district': info.reg_addr.addr_sub_district,
    //     'csrf_dop': csrf_hash
    // },
    //   success: function (value) { //Result True
    //     //console.log("success");console.dir(value);
    //     if(Object.keys(value).length) {
    //       console.log(value);
    //       if(value[0].message!='') {
    //         toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");
    //         $("#accountJPTH").html("");
    //         $("<option value=''>ไม่พบข้อมูล.</option>").appendTo($("#accountJPTH"));
    //         $("#row3_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
    //       }else {
    //         //toastr.success("ดึงข้อมูลความจำเป็นพื้นฐาน (จปฐ.)เสร็จสิ้น","หน้าต่างแจ้งเตือน");
    //         $("#accountJPTH").html("");
    //         $("#accountJPTH").attr("size",Object.size(value));
    //         $(value).each(function(key,data) {
    //           console.log(data);
    //           $("<option value="+data.Q23AvgIncome+">อาชีพ (ปัจจุบัน) : "+data.Career+" รายได้เฉลี่ย "+numberWithCommas(data.Q23AvgIncome)+" (บาท/เดือน) :  ที่มาของรายได้ : - *("+data.MemberName+" "+data.MemberLastName+") บ้านเลขที่"+data.HHNumber+" หมู่บ้าน "+data.VillName+" ซอย "+data.Soi+" ถนน "+data.Tanon+"</option>").appendTo($("#accountJPTH"));
    //         });
    //       }
    //     }else { //Result no Data
    //       toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");
    //       $("#accountJPTH").html("");
    //       $("<option value=''>ไม่พบข้อมูล.</option>").appendTo($("#accountJPTH"));
    //       $("#row3_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
    //     }
    //   },
    //   error:function() { //Result Error
    //     toastr.error("ดึงข้อมูลความจำเป็นพื้นฐาน (จปฐ.)ล้มเหลว","หน้าต่างแจ้งเตือน");
    //     $("#accountJPTH").html("");
    //     $("<option value=''>ไม่พบข้อมูล.</option>").appendTo($("#accountJPTH"));
    //     $("#row3_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
    //   },
    // });
    // $("#accountJPTH").change(function() {
    //   console.log();
    //   if($(this).val()>38000) {
    //     $("#income_state").html("เกิน 38,000");
    //   }else {
    //     $("#income_state").html("ไม่เกิน 38,000")
    //   }
    // });
  //End Service 3

  //Service 4
    $.ajax({
    url: 'https://gateway.dop.go.th/transfer/import/RequestOlderEmploymentRegistration',
    type: 'POST',
    dataType: 'json',
    data: {
        'eldery_pid': info.pid,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        //console.log("success");console.dir(value);
        if(Object.keys(value).length) {
          console.log(value);
          if(value[0].message!='') {
            toastr.warning("ไม่พบข้อมูลทะเบียนจัดหางานผุ้สูงอายุ","หน้าต่างแจ้งเตือน");
            $("#row4_date_of_reg_th").html("<span>-</span>");
            $("#row4_reg_status").html("<span>-</span>");
            $("#row4_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
          }else {
            //toastr.success("ดึงข้อมูลทะเบียนจัดหางานผุ้สูงอายุเสร็จสิ้น","หน้าต่างแจ้งเตือน");
            if(value[0].date_of_reg!='') {
              $("#row4_date_of_reg_th").html("<span style='color:green'>"+value[0].date_of_reg_th+"</span>");
            }
            if(value[0].reg_status=="ยังไม่ได้งาน") {
              $("#row4_reg_status").html("<span style='color:#D25200'>"+value[0].reg_status+"</span>");
            }else {
              $("#row4_reg_status").html("<span style='color:green'>"+value[0].reg_status+"</span>");
            }
            $("#row4_state").html("<i class='fa fa-check text-navy'></i>");
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลทะเบียนจัดหางานผุ้สูงอายุ","หน้าต่างแจ้งเตือน");
          $("#row4_date_of_reg_th").html("<span>-</span>");
          $("#row4_reg_status").html("<span>-</span>");
          $("#row4_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
        }
      },
      error:function() { //Result Error
        toastr.error("ดึงข้อมูลทะเบียนจัดหางานผุ้สูงอายุล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#row4_date_of_reg_th").html("<span>-</span>");
        $("#row4_reg_status").html("<span>-</span>");
        $("#row4_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
      },
    });
  //End Service 4

  //Service 5
    $.ajax({
    url: 'https://gateway.dop.go.th/transfer/import/RequestElderyFoundation',
    type: 'POST',
    dataType: 'json',
    data: {
        'Username': 'dopuser',
        'Password': 'dpuser',
        'OfficerPID': pers_authen.pid,
        'TargetPID': info.pid,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        //console.log("success");console.dir(value);
        if(Object.keys(value).length) {
          console.log(value);
          if(value.message!='') {
            toastr.warning("ไม่พบข้อมูลประวัติการกู้ยืมกองทุน","หน้าต่างแจ้งเตือน");
            $("#row5_loan_history").html("<span>-</span>");
            $("#row5_contract_status").html("<span>-</span>");
            $("#row5_state").html("ไม่พบข้อมูลประวัติการกู้ยืมกองทุน");
          }else {
            //toastr.success("ดึงข้อมูลประวัติการกู้ยืมกองทุนเสร็จสิ้น","หน้าต่างแจ้งเตือน");
            if(value.loan_history=='มีประวัติ') {
              $("#row5_loan_history").html("<span style='color:green'>"+value.loan_history+"</span>");
            }else {
              $("#row5_loan_history").html("<span style='color:#D25200'>"+value.loan_history+"</span>");
            }
            if(value.contract_status=="ปิดสัญญาแล้ว") {
              $("#row5_contract_status").html("<span style='color:#D25200'>"+value.contract_status+"</span>");
            }else {
              $("#row5_contract_status").html("<span style='color:green'>"+value.contract_status+"</span>");
            }
            $("#row5_state").html("ดึงข้อมูลประวัติการกู้ยืมกองทุนเสร็จสิ้น");
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลประวัติการกู้ยืมกองทุน","หน้าต่างแจ้งเตือน");
          $("#row5_loan_history").html("<span>-</span>");
          $("#row5_contract_status").html("<span>-</span>");
          $("#row5_state").html("ไม่พบข้อมูลประวัติการกู้ยืมกองทุน'></i>");
        }
      },
      error:function() { //Result Error
        toastr.error("ดึงข้อมูลประวัติการกู้ยืมกองทุนล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#row5_loan_history").html("<span>-</span>");
        $("#row5_contract_status").html("<span>-</span>");
        $("#row5_state").html("ดึงข้อมูลประวัติการกู้ยืมกองทุนล้มเหลว</i>");
      },
    });
  //End Service 5

  //Service 6
    $.ajax({
    url: base_url+'difficult/getHistory',
    type: 'POST',
    dataType: 'json',
    data: {
        'pers_id': info.pers_id,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        //console.log("success");console.dir(value);
        if(Object.keys(value).length) {
          console.log(value);
          if(value.message!='') {
            toastr.warning("ไม่พบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก","หน้าต่างแจ้งเตือน");
            $("#row6_history").html("<span>-</span>");
            $("#row6_year_now_history").html("<span>-</span>");
            $("#row6_state").html("ไม่พบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก");
          }else {
            //toastr.success("ตรวจสอบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบากเสร็จสิ้น","หน้าต่างแจ้งเตือน");
            if(value.history=='มีประวัติ') {
              $("#row6_history").html("<span style='color:#D25200'>"+value.history+"</span>");
            }else {
              $("#row6_history").html("<span style='color:green'>"+value.history+"</span>");
            }
            if(value.year_now_history>0) {
              $("#row6_year_now_history").html("<span style='color:red'>"+value.year_now_history+"</span>");
            }else {
              $("#row6_year_now_history").html("<span style='color:green'>"+value.year_now_history+"</span>");
            }
            $("#row6_state").html("ตรวจสอบข้อมูลเสร็จสิ้น");
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก","หน้าต่างแจ้งเตือน");
          $("#row6_history").html("<span>-</span>");
          $("#row6_year_now_history").html("<span>-</span>");
          $("#row6_state").html("ไม่พบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก");
        }
      },
      error:function() { //Result Error
        toastr.error("ตรวจสอบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบากล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#row6_history").html("<span>-</span>");
        $("#row6_year_now_history").html("<span>-</span>");
        $("#row6_state").html("ตรวจสอบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบากล้มเหลว");
      },
    });
  //End Service 6
    //ลองจปฐ
    $.ajax({
    url: base_url+'difficult/getElderyJPTH',
    type: 'POST',
    dataType: 'json',
    data: {
        'pers_id' : info.pid,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        //console.log("success");console.dir(value);
        if(Object.keys(value).length) {
          console.log(value);
          if(value.message!='') {
            toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");       
            $("#jpth_detail").html("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)");
          }else {
            //toastr.success("ตรวจสอบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบากเสร็จสิ้น","หน้าต่างแจ้งเตือน");
            if(value.history =='มีประวัติ'){
                  if(value.income>38000) {
                    $("#income_state").html("เกิน 38,000");
                    $("#jpth_detail").html(numberWithCommas(value.income)+" (บาท/ปี)");
                  }else {
                    $("#income_state").html("ไม่เกิน 38,000");
                    $("#jpth_detail").html(numberWithCommas(value.income)+" (บาท/ปี)");
                   // $("#jpth_detail").html("<span>รายได้เฉลี่ย: "+numberWithCommas(value.income)+" อาชีพ: "+value.occupation+"</span>");
                  }
            
            }
            else{
              $("#jpth_detail").html("<span>ไม่พบข้อมูล</span>");
              $("#income_state").html("ไม่พบข้อมูล");

            }
            
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");
          $("#jpth_detail").html("<span>ไม่พบข้อมูล</span>");
        }
      },
      error:function() { //Result Error
        toastr.error("ดึงข้อมูลความจำเป็นพื้นฐาน (จปฐ.)ล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#jpth_detail").html("<span>ไม่พบข้อมูล</span>");
       
      },
    });


/*  //Service 7
    $.ajax({
    url: base_url+'welfare/getHistory',
    type: 'POST',
    dataType: 'json',
    data: {
        'pers_id': info.pers_id,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        //console.log("success");console.dir(value);
        if(Object.keys(value).length) {
          console.log(value);
          if(value.message!='') {
            toastr.warning("ไม่พบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯ","หน้าต่างแจ้งเตือน");
            $("#row7_history").html("<span>-</span>");
            $("#row7_year_now_history").html("<span>-</span>");
            $("#row7_req_org").html("<span>-</span>");
            $("#row7_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
          }else {
            //toastr.success("ตรวจสอบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯเสร็จสิ้น","หน้าต่างแจ้งเตือน");
            if(value.history=='มีประวัติ') {
              $("#row7_history").html("<span style='color:#D25200'>"+value.history+"</span>");
            }else {
              $("#row7_history").html("<span style='color:green'>"+value.history+"</span>");
            }
            if(value.year_now_history>0) {
              $("#row7_year_now_history").html("<span style='color:red'>"+value.year_now_history+"</span>");
            }else {
              $("#row7_year_now_history").html("<span style='color:green'>"+value.year_now_history+"</span>");
            }

            value.req_org = value.req_org==null?'-':value.req_org;
            $("#row7_req_org").html("<span>"+value.req_org+"</span>");
            $("#row7_state").html("<i class='fa fa-check text-navy'></i>");
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯ","หน้าต่างแจ้งเตือน");
          $("#row7_history").html("<span>-</span>");
          $("#row7_year_now_history").html("<span>-</span>");
          $("#row7_req_org").html("<span>-</span>");
          $("#row7_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
        }
      },
      error:function() { //Result Error
        toastr.error("ตรวจสอบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#row7_history").html("<span>-</span>");
        $("#row7_year_now_history").html("<span>-</span>");
        $("#row7_req_org").html("<span>-</span>");
        $("#row7_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
      },
    });
  //End Service 7*/

}
</script>

<script>
$(function(){
  //Check age > 60
  handler_notice_excep_age();
  
});

function notice_excep_age(age){
  if(age < 60){
    $('.alert-excep-age').removeClass('hide');
    $('.btn-save').prop('disabled', true);

  }else{

    $('.alert-excep-age').addClass('hide');
    $('.btn-save').prop('disabled', false);
  }

  if(age == -1){
    $('.alert-excep-age').addClass('hide');
    $('.btn-save').prop('disabled', false);
  }
  
}

function handler_notice_excep_age(){
  if(!$('.alert-excep-age').hasClass('hide')){
    $('.btn-save').prop('disabled', true);
  }
}


function cardInfo(){
    //alert('ddd');
    showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');
    $.ajax({  
                    type: 'GET',
                    crossDomain: true,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    // data: param_service,
                    url: 'http://localhost:9000/api/Values',
                    success: function(data_service) {
                      //console.log(data_service)                       
                        var data = data_service.personal;                       
                        if(data_service.result == false){
                          closeloadswal();
                          toastr.error("บัตรประชาชนต้องเสียบอยู่กับเครื่องอ่านบัตร", "กรุณาตรวจสอบ");
                        }else{
                          var varCard = data.Citizenid;
                          var res1 = varCard.substring(0, 1);
                          var res2 = varCard.substring(1, 5);
                          var res3 = varCard.substring(5, 10);
                          var res4 = varCard.substring(10, 12);
                          var res5 = varCard.substring(12, 13);

                        
                          var houseNo = data.addrVillageNo.replace("หมู่ที่ ","");
                          $('#req_pid').val(res1+'-'+res2+'-'+res3+'-'+res4+'-'+res5);
                          $('#diff_pid').val(varCard);
                          
                          $('#req_name').html(data.Th_Firstname+' '+data.Th_Lastname);
                          //10 สิงหาคม 2534 (อายุ 29 ปี)
                          var varBirthday = data.Birthday;
                          var bd1 = varBirthday.substring(0, 2);
                          var bd2 = varBirthday.substring(3, 5);
                          var bd3 = varBirthday.substring(6, 10);
                          var varBD = (bd3-543)+'-'+bd2+'-'+bd1;
                          var varBDText = bd3+'-'+bd2+'-'+bd1;
                          $.ajax({
                            type: "POST",
                            url: base_url+"/adaptenvir/getBirthday/",
                            data: {birthday : varBDText,csrf_dop : csrf_hash},
                            success: function(data){

                              $('#req_date_of_birth_text').html(data); 
                              
                            },
                            dataType: "json",
                          });
                        
                          //$('#date_of_birth_text').html((bd1-543)+'-'+bd2+'-'+bd3);
                          // $('#gender_name').html(data.Sex);                        

                          if(data.Sex =='0'){
                            $('#req_gender_name').html("ไม่ทราบ");
                          }else if(data.Sex =='1'){
                            $('#req_gender_name').html("ชาย");
                          }else if(data.Sex =='2'){
                            $('#req_gender_name').html("หญิง");
                          }else if(data.Sex =='9'){
                            $('#req_gender_name').html("ไม่สามารถระบุได้");
                          }else{
                            $('#req_gender_name').html("-");
                          }                        
                          $('#req_reg_addr').html(data.Address);
                          $('#req_reg_addr_id').val(data.Address);
                                                
                          $('#pers_firstname_th').val(data.Th_Firstname);
                          $('#pers_lastname_th').val(data.Th_Lastname);
                          $('#gender_code').val(data.Sex);
                          // $('#pid').val(varCard);
                          $('input[name="impv_addr[addr_moo]"]').val(houseNo);
                          $('#date_of_birth').val(varBD);                      
                          $('#addrProvince').attr(data.addrProvince);
                          $('#addrAmphur').attr(data.addrAmphur);
                          $('#addrTambol').attr(data.addrTambol);
                          
                          var province = data.addrProvince.replace("จังหวัด","");
                          var amphur = data.addrAmphur.replace("อำเภอ","");
                          var tambol = data.addrTambol.replace("ตำบล","");
            
                          $.ajax({
                            type: "POST",
                            url: base_url+"/adaptenvir/getarea/",
                            data: {province_name : province,amphur_name : amphur,tambol_name : tambol,csrf_dop : csrf_hash},
                            success: function(data){
                             // console.log(data)  
                              closeloadswal();							
                              $('input[name="impv_addr[addr_province]"]').val(data.province_code);		
                              $('input[name="impv_addr[addr_district]"]').val(data.amphur_code);
                              $('input[name="impv_addr[addr_sub_district]"]').val(data.tambol_code);		
                              
                            },
                            dataType: "json",
                          });

                          var houseNo = data.addrVillageNo.replace("หมู่ที่ ","");
                          $('input[name="impv_addr[addr_home_no]"]').val(data.addrHouseNo);
                          $('input[name="impv_addr[addr_moo]"]').val(houseNo);
                          $('input[name="impv_addr[addr_lane]"]').val(data.addrRoad);
                          $('input[name="impv_addr[addr_alley]"]').val('');
                          $('input[name="impv_addr[addr_road]"]').val('');
                        }  
                    },
                    error: function(err) {
                      closeloadswal();	
                      toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");
                      //$('.modal').modal('hide');
                      //$('#linkage-loade-'+key).html('<i class="fas fa-download"></i>');
                     //  var text = 'กรุณาตรวจสอบ ' + '\n' + '- เครื่องอ่านบัตรต้องเชื่อมต่อ กับ คอมพิวเตอร์ ' + '\n' + '- ต้องมีบัตรประชาชน เสียบอยู่กับเครื่องอ่านบัตร' + '\n' + '- ตรวจสอบว่าโปรแกรม Linkage Service เปิดใช้งานอยู่';
                      //  $("#exampleModalLinkage").modal();
                        

                    }
    });
}

function bt_req_pid(){

    var pid_id = $('#req_pid').val();
    var reqId = pid_id.replaceAll("-","");
    $('#diff_pid').val(reqId); 
   // console.log('loadstart')

    showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');

    $.ajax({  
                    type: 'GET',
                    crossDomain: true,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    // data: param_service,
                    url: base_url+"/adaptenvir/getTokenID/",
                    success: function(data_token) {
                        //console.log(data_token)                       
                        $.ajax({
                          type: "POST",
                          url: base_url+"difficult/getDataDead/",
                          data: {req_id : reqId,csrf_dop : csrf_hash},
                          success: function(data){ 
                        // console.log(data)        
                            if (!!data) {  
                              closeloadswal();
                              toastr.error("เลขบัตรประจำตัวประชาชนนี้ เคยขอรับการสงเคราะห์แล้ว", "หน้าต่างแจ้งเตือน");
                            }
                                
                            $.ajax({
                              type: "POST",
                              url: base_url+"/adaptenvir/getDataPid/",
                              data: { req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                              success: function(data){
                                //console.log(data)
                                if ($('#req_pid').val() == "_-____-_____-__-_" || $('#req_pid').val() == "") { 
                                  closeloadswal();	
                                  toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");   
                                
                                }else { 
                                  if (data['Code'] == 90001) { 
                                    closeloadswal();	
                                    toastr.error("โปรดตรวจสอบการเชื่อมต่อ", "หน้าต่างแจ้งเตือน");  
                                      
                                  }else{
                                  //if (!!data.firstName && !!data.lastName) {                               
                                   
                                    var varBD = data.dateOfBirth.toString();
                                    // var res = varCard.split("");
                                    var res1 = varBD.substring(0, 4);
                                    var res2 = varBD.substring(4, 6);
                                    var res3 = varBD.substring(6, 8);
                                    //1960-08-07
                                    var varBirthday = (res1-543)+'-'+res2+'-'+res3
                                    var varBirthdayText = res1+'-'+res2+'-'+res3
                                    //console.log('>>>>>>>>',varBirthday)
                                    $.ajax({
                                      type: "POST",
                                      url: base_url+"/adaptenvir/getBirthday/",
                                      data: {birthday : varBirthdayText,csrf_dop : csrf_hash},
                                      success: function(data){

                                        $('#req_date_of_birth_text').html(data); 
                                        
                                      },
                                      dataType: "json",
                                    });
                                    
                                    var titleName = data.titleName
                                    $.ajax({
                                      type: "POST",
                                      url: base_url+"/adaptenvir/getTitleName/",
                                      data: {title_name : titleName,csrf_dop : csrf_hash},
                                      success: function(data){                                    
                                        $('#pren_code').val(data.pren_code);  
                                        $('#pren_name').val(data.prename_th);                                     
                                      },
                                      dataType: "json",
                                    });
                                    $('#req_name').html(data.titleName+' '+data.firstName+' '+data.lastName);                              
                                    //$('#req_date_of_birth').html(data.dateOfBirth);
                                    $('#req_gender_name').html(data.genderDesc);            
                                    $('#pers_firstname_th').val(data.firstName);
                                    $('#pers_lastname_th').val(data.lastName);
                                    $('#gender_code').val(data.genderCode);
                                   // $('#date_of_birth').val(data.dateOfBirth);     
                                    $('#date_of_birth').val(varBirthday);    
                                    $.ajax({
                                      type: "POST",
                                      url: base_url+"/adaptenvir/getAddress/",
                                      // data: {req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                                      data: { req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                                      success: function(dataAdderss){
                                        //console.log(dataAdderss)

                                      var addressname = dataAdderss.houseNo +' หมู่ที่ '+dataAdderss.villageNo +' '+' ตำบล'+dataAdderss.subdistrictDesc +' '+' อำเภอ'+dataAdderss.districtDesc +' '+' จังหวัด'+dataAdderss.provinceDesc;
                                        $('#req_reg_addr').html(addressname);

                                        $('#req_reg_addr_id').val(addressname);
                               

                                      $('input[name="impv_addr[addr_moo]"]').val(dataAdderss.villageNo);
                                      $('input[name="impv_addr[addr_home_no]"]').val(dataAdderss.houseNo);
                                      $('input[name="impv_addr[addr_lane]"]').val(dataAdderss.roadDesc);
                                      $('input[name="impv_addr[addr_alley]"]').val('');
                                      $('input[name="impv_addr[addr_road]"]').val('');
                   
                                      var province = dataAdderss.provinceDesc.replace("จังหวัด","");
                                      var amphur = dataAdderss.districtDesc.replace("อำเภอ","");
                                      var tambol = dataAdderss.subdistrictDesc.replace("ตำบล","");
                                      
                                      $.ajax({
                                        type: "POST",
                                        url: base_url+"/adaptenvir/getarea/",
                                        data: {province_name : province,amphur_name : amphur,tambol_name : tambol,csrf_dop : csrf_hash},
                                        success: function(dataArea){
                                         // console.log('>>>>>>>>',dataArea)		
                                          // console.log('loadEnd')
                                          closeloadswal();

                                          $('input[name="impv_addr[addr_province]"]').val(dataArea.province_code);		
                                          $('input[name="impv_addr[addr_district]"]').val(dataArea.amphur_code);
                                          $('input[name="impv_addr[addr_sub_district]"]').val(dataArea.tambol_code);		
                                          
                                        },
                                        dataType: "json",
                                      });
                                      },
                                      dataType: "json",
                                    }); 
                                  }
                                  
                                                                  
                                
                                }  
                               
                              },
                              error: function(err) {
                                closeloadswal();	
                                toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");
                              
                              }
                            });
                      
                          },
                          error: function(err) {
                            closeloadswal();
                            toastr.error("เลขบัตรประจำตัวประชาชนนี้ เคยแจ้งเรื่องแล้ว", "หน้าต่างแจ้งเตือน");

                          }
                        });    
          
                        

                    },
                    error: function(err) {
                      closeloadswal();	
                     // console.log(err)
                      //var text = 'ไม่พบข้อมูล';
                      //token
                      toastr.error("ไม่พบข้อมูล", "หน้าต่างแจ้งเตือน");
                     
                    }
    });

} 

function bt_elder_pid(){

var pid_id = $('#elder_pid').val();
var reqId = pid_id.replaceAll("-","");
$('#pid_id').val(reqId); 

showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');
$.ajax({  
                type: 'GET',
                crossDomain: true,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                // data: param_service,
                url: base_url+"/adaptenvir/getTokenID/",
                success: function(data_token) {
                    //console.log(data_token)                       
                  $.ajax({
                  type: "POST",
                  url: base_url+"difficult/getDataDead/",
                  data: {req_id : reqId,csrf_dop : csrf_hash},
                  success: function(data){ 
                  // console.log(data)        
                    if (!!data) {  
                      closeloadswal();
                      toastr.error("เลขบัตรประจำตัวประชาชนนี้ เคยขอรับการสงเคราะห์แล้ว", "หน้าต่างแจ้งเตือน");
                    }
                        $.ajax({
                          type: "POST",
                          url: base_url+"/adaptenvir/getDataPid/",
                          data: { req_pid : $('#elder_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                          success: function(data){
                            //console.log(data)
                            if ($('#elder_pid').val() == "_-____-_____-__-_" || $('#elder_pid').val() == "") { 
                              closeloadswal();	
                              toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");   
                            
                            }else { 

                              if (!!data.firstName && !!data.lastName) {                               
                                
                                var varBD = data.dateOfBirth.toString();
                                // var res = varCard.split("");
                                var res1 = varBD.substring(0, 4);
                                var res2 = varBD.substring(4, 6);
                                var res3 = varBD.substring(6, 8);
                                //1960-08-07
                                var varBirthday = (res1-543)+'-'+res2+'-'+res3
                                var varBirthdayText = res1+'-'+res2+'-'+res3
                                //console.log('>>>>>>>>',varBirthday)
                                $.ajax({
                                  type: "POST",
                                  url: base_url+"/adaptenvir/getBirthday/",
                                  data: {birthday : varBirthdayText,csrf_dop : csrf_hash},
                                  success: function(data){

                                    $('#date_of_birth_sufferer').html(data); 
                                    
                                  },
                                  dataType: "json",
                                });
                                
                                var titleName = data.titleName
                                $.ajax({
                                  type: "POST",
                                  url: base_url+"/adaptenvir/getTitleName/",
                                  data: {title_name : titleName,csrf_dop : csrf_hash},
                                  success: function(data){                                    
                                    $('#pren_code_sufferer').val(data.pren_code);                                     
                                  },
                                  dataType: "json",
                                });                          
                                $('#name_sufferer').html(data.titleName+' '+data.firstName+' '+data.lastName);                              
                               // $('#date_of_birth_sufferer').html(data.dateOfBirth);
                                $('#gender_name_sufferer').html(data.genderDesc);            
                                $('input[name="impv_info2[pers_firstname_th]"]').val(data.firstName);
                                $('input[name="impv_info2[pers_lastname_th]"]').val(data.lastName);
                                $('input[name="impv_info2[gender_code]"]').val(data.genderCode);
                                $('input[name="impv_info2[date_of_birth]"]').val(varBirthday);      
                                $.ajax({
                                  type: "POST",
                                  url: base_url+"/adaptenvir/getAddress/",
                                  // data: {req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                                  data: { req_pid : $('#elder_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                                  success: function(dataAdderss){
                                    //console.log(dataAdderss)
                                  var addressname = dataAdderss.houseNo +' หมู่ที่ '+dataAdderss.villageNo +' '+' ตำบล'+dataAdderss.subdistrictDesc +' '+' อำเภอ'+dataAdderss.districtDesc +' '+' จังหวัด'+dataAdderss.provinceDesc;
                                    $('#reg_addr').html(addressname);         
                                    $('input[name="impv_addr2[addr_moo]"]').val(dataAdderss.villageNo);
                                      // //$('#date_of_birth').val((bd1-543)+'-'+bd2+'-'+bd3);                      
                                      // $('#addrProvince').attr(data.addrProvince);
                                      // $('#addrAmphur').attr(data.addrAmphur);
                                      // $('#addrTambol').attr(data.addrTambol);
                                      $('input[name="impv_addr2[addr_home_no]"]').val(dataAdderss.houseNo);
                                     // $('input[name="impv_addr[addr_moo]"]').val(houseNo);
                                      $('input[name="impv_addr2[addr_lane]"]').val(dataAdderss.roadDesc);
                                      $('input[name="impv_addr2[addr_alley]"]').val('');
                                      $('input[name="impv_addr2[addr_road]"]').val('');
                                      var province = dataAdderss.provinceDesc.replace("จังหวัด","");
                                      var amphur = dataAdderss.districtDesc.replace("อำเภอ","");
                                      var tambol = dataAdderss.subdistrictDesc.replace("ตำบล","");
                                      
                                      $.ajax({
                                        type: "POST",
                                        url: base_url+"/adaptenvir/getarea/",
                                        data: {province_name : province,amphur_name : amphur,tambol_name : tambol,csrf_dop : csrf_hash},
                                        success: function(dataArea){
                                         // console.log('>>>>>>>>',dataArea)
                                          closeloadswal();					
                                          $('input[name="impv_addr2[addr_province]"]').val(dataArea.province_code);		
                                          $('input[name="impv_addr2[addr_district]"]').val(dataArea.amphur_code);
                                          $('input[name="impv_addr2[addr_sub_district]"]').val(dataArea.tambol_code);		
                                          
                                        },
                                        dataType: "json",
                                      });



                                  },
                                  dataType: "json",
                                }); 
                              }
                              else{
                                closeloadswal();	
                                toastr.error("ไม่พบข้อมูล", "หน้าต่างแจ้งเตือน");  
                                                           
                           
                              }
                                                              
                            
                            }  
                           
                          },
                          error: function(err) {
                            closeloadswal();	
                            toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");
                          
                          }
                        });
                    
                  },
                  error: function(err) {
                    closeloadswal();
                    toastr.error("เลขบัตรประจำตัวประชาชนนี้ เคยแจ้งเรื่องแล้ว", "หน้าต่างแจ้งเตือน");

                  }
                });                  
      
                    

                },
                error: function(err) {
                  closeloadswal();	
                  console.log(err)
                  //var text = 'ไม่พบข้อมูล';
                  //token
                  toastr.error("ไม่พบข้อมูล", "หน้าต่างแจ้งเตือน");
                 
                }
});

} 


$("input[name='elder_pers_chk']").on('ifChecked', function(event){
  //alert("s");
  
        $("#elder_pid").val($("#req_pid").val());
    // if(req_pers){
    //     $("#pid").val(req_pers.pid);
        var reqPid =  $("#req_pers_id").val();
        var reqPid2 =  $("#diff_pid").val();
        $("#pers_id").val(reqPid);
        $("#pid_id").val(reqPid2);

                             
        $('#pren_code_sufferer').val($("#pren_code").val());           
        $("#name_sufferer").html($("#pren_name").val()+' '+$("#pers_firstname_th").val()+' '+$("#pers_lastname_th").val());

       //  $("#date_of_birth_text").html($("#date_of_birth").val());
        var varBirthday = $("#date_of_birth").val();
        var bd1 = varBirthday.substring(0, 4);
        var bd2 = varBirthday.substring(5, 7);
        var bd3 = varBirthday.substring(8, 10);
        $.ajax({
          type: "POST",
          url: base_url+"/adaptenvir/getBirthday/",
          data: {birthday : varBirthday,csrf_dop : csrf_hash},
          success: function(data){
            //console.log('>>>>>>>>',data)
            $('#date_of_birth_sufferer').html(data); 
            
          },
          dataType: "json",
        });
                        
       // $("#gender_name").html($("#gender_code").val());

        if($("#gender_code").val() =='0'){
          $('#gender_name_sufferer').html("ไม่ทราบ");
        }else if($("#gender_code").val() =='1'){
          $('#gender_name_sufferer').html("ชาย");
        }else if($("#gender_code").val() =='2'){
          $('#gender_name_sufferer').html("หญิง");
        }else if($("#gender_code").val() =='9'){
          $('#gender_name_sufferer').html("ไม่สามารถระบุได้");
        }else{
          $('#gender_name_sufferer').html("-");
        }                        
                         // $('#reg_addr').html(data.Address);

    //     $("#nation_name_th").html(req_pers.nation_name_th);
    //     $("#relg_title").html(req_pers.relg_title);
    
        $("#reg_addr_id").val("");
        var reg_addr_id = $('input[name="impv_info[req_reg_addr_id]"]').val();
        $("#reg_addr").html(reg_addr_id);
        
        var pers_firstname = $('input[name="impv_info[pers_firstname_th]"]').val();
        var pers_lastname = $('input[name="impv_info[pers_lastname_th]"]').val();
        var date_birth = $('input[name="impv_info[date_of_birth]"]').val();
        var gender = $('input[name="impv_info[gender_code]"]').val();

        var addr_home_no = $('input[name="impv_addr[addr_home_no]"]').val();
        var addr_moo = $('input[name="impv_addr[addr_moo]"]').val();
        var addr_province = $('input[name="impv_addr[addr_province]"]').val();
        var addr_district = $('input[name="impv_addr[addr_district]"]').val();
        var addr_sub_district = $('input[name="impv_addr[addr_sub_district]"]').val();
       
        $('input[name="impv_info2[pers_firstname_th]"]').val(pers_firstname);  
        $('input[name="impv_info2[pers_lastname_th]"]').val(pers_lastname);
        $('input[name="impv_info2[date_of_birth]"]').val(date_birth);		
        $('input[name="impv_info2[gender_code]"]').val(gender);

        $('input[name="impv_addr2[addr_home_no]"]').val(addr_home_no);  
        $('input[name="impv_addr2[addr_moo]"]').val(addr_moo);                                               
  
        $('input[name="impv_addr2[addr_province]"]').val(addr_province);		
        $('input[name="impv_addr2[addr_district]"]').val(addr_district);
        $('input[name="impv_addr2[addr_sub_district]"]').val(addr_sub_district);	
        $('input[name="impv_addr2[addr_lane]"]').val('');
        $('input[name="impv_addr2[addr_alley]"]').val('');
        $('input[name="impv_addr2[addr_road]"]').val('');  
    //     notice_excep_age(req_pers.age);
    //     getPersInfo(inputpid, bt_spid, setData, true); //Get Data
    // }
    //$(".elder_same_req").attr('disabled',true);
});


</script>

<script src="https://center.dop.go.th/assets/js/loading_popup.js"></script>