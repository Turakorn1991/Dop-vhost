<?php
//set_session('pers_authen',array('authen_log_id'=>1,'pid'=>'1550700081881','cid'=>'k32kjk324j234','random_string'=>'3239663864316539316431313939353933356334663834636130396234353366')); //for Test
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
      <div class="tab-content">
        <div id="tab-1">
         <div class="panel-body">
          <div id="tmp_menu" hidden='hidden'>


            <?php
            $tmp = $this->admin_model->getOnce_Application(51);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(51,$user_id); //Check User Permission
                                ?>
                                <a  class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                <?php if(!isset($tmp1['perm_status'])) {?>
                                readonly
                                <?php }else{?> href="<?php echo site_url('volunteer/volunteer_list'); ?>"
                                <?php }?> title="ย้อนกลับ <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                <i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                
                                <!--
                                <?php
                                if($process_action=='Edit') {
                                $tmp = $this->admin_model->getOnce_Application(52);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
                                ?>
                                <a data-id=<?php echo $volt_info['volt_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                  <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                  <?php }else{ ?>
                                  <?php }?> title="ลบ <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
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
                            <div class="family_members_template" hidden='hidden'>
                              <div class="family_members_items panel-group" style="margin-top: -10px;">
                                <div class="panel panel-default" style="border: 0">
                                  <div class="panel-heading clear-fix" style="background-color: initial;">
                                  </div>
                                  <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                    <div class="row text-right">
                                      <button type="button" class="btn btn-default" onclick="btDel_family_members(this,'');" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-xs-12 col-sm-3">
                                        <label for="" class="col-2 col-form-label">เลขบัตรประจำตัวประชาชน</label>
                                        <div class="input-group">
                                          <input title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control" type="text" id="pid_myID" name="" />
                                          <input type="text" name="volt_info_elderly_care[pers_id][myID]" id="pers_id_myID" hidden="hidden">
                                          <div class="input-group-btn" >
                                            <button  title="ตรวจสอบ" type="button" class="btn btn-default" id="bt_pid_myID"><i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-3">
                                        <label for="" class="col-2 col-form-label">(คำนำหน้า) ชื่อตัว-ชื่อสกุล</label>
                                        <input title="(คำนำหน้า) ชื่อตุว-ชื่อสกุลุ" placeholder="ระบุ (คำนำหน้า) ชื่อตัว-ชื่อสกุล" id="name_myID" class="form-control" type="text" name=""/>
                                      </div>
                                      <div class="col-xs-12 col-sm-2">
                                        <label for="" class="col-2 col-form-label">อายุ (ปี)</label>
                                        <input title="อายุ" placeholder="ระบุอายุ (ปี)" class="form-control" type="text" id="pers_age_myID" name=""/>
                                      </div>
                                      <div class="col-xs-12 col-sm-2">
                                        <label for="" class="col-2 col-form-label">การดูแล (ครั้ง/สัปดาห์/เดือน)</label>
                                        <input title="การดูแล (ครั้ง/สัปดาห์/เดือน)" placeholder="ระบุการดูแล (ครั้ง)" class="form-control" type="text" name="volt_info_elderly_care[care_freq][myID]"/>
                                      </div>
                                      <div class="col-xs-12 col-sm-2">
                                        <label for="" class="col-2 col-form-label">&nbsp;</label>
                                        <select class="form-control" name="volt_info_elderly_care[care_freq_per][myID]" title="การดูแล (ต่อสัปดาห์ หรือเดือน)">
                                          <option value="สัปดาห์">สัปดาห์</option>
                                          <option value="เดือน">เดือน</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                      <div class="col-xs-12 col-sm-6">
                                        <label for="" class="col-2 col-form-label">ปัญหาสุขภาพ</label>
                                        <div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy][myID]" value="ปกติ" checked> ปกติ</label></div>
                                        <div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy][myID]" value="ป่วยเรื้อรัง"> ป่วยเรื้อรัง</label></div>
                                        <div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy][myID]" value="พิการ"> พิการ</label></div>
                                      </div>
                                      <div class="col-xs-12 col-sm-6">
                                        <label for="" class="col-2 col-form-label">ช่วยเหลือตนเอง</label>
                                        <div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy_self_help][myID]" value="ได้" checked> ได้</label></div>
                                        <div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy_self_help][myID]" value="ไม่ได้"> ไม่ได้</label></div>
                                      </div>
                                    </div>


                                    <script type="text/javascript">
                                      icheck_loop();
                                      var inputpid_myID = "#pid_myID";
                                      var bt_spid_myID = "#bt_pid_myID";
                                  var setData_myID = "reqData_myID"; //Declear Name
                                  var reqData_myID = function(value) { //Set Structure Display Data
                                    console.dir(value);
                                    $("#name_myID").val(value.name);
                                    $("#pers_id_myID").val(value.pers_id);
                                    $("#marital_status_myID").val(value.marital_status);
                                    $("#pers_age_myID").val(value.age);
                                    $("#occupation_myID").val(value.occupation);
                                    $("#mth_avg_income_myID").val(value.mth_avg_income);
                                    $("#edu_code_myID").val(value.edu_code);
                                    $("input[name='pers_family[healthy][myID]']").filter('[value="'+value.healthy+'"]').attr('checked', true);
                                    $("input[name='pers_family[healthy_self_help][myID]']").filter('[value="'+value.healthy_self_help+'"]').attr('checked', true);
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
                            </div><!-- close panel-body-->
                          </div><!-- close panel-default-->
                        </div><!-- close panel-group-->
                      </div><!-- close family_members_template-->

                      <div class="form-group row">
                        <?php
                        if($process_action=='Add'){$process_action = 'Added';$func='inserted'}
                        if($process_action=='Edit'){$process_action = 'Edited';$func='edited';}
                        echo form_open_multipart("volunteer/editor/$func/".$volt_info['volt_id'],array('id'=>'form1'));
                        ?>
                        <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                        <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                        <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                        <div class="panel-group">
                          <div class="panel panel-default" style="border: 0">
                           
                            <div class="panel-heading"><h4>ข้อมูลอาสาสมัคร</h4></div>
                            <div class="panel-body" style="border:0; padding: 20px;">

                              <div class="form-group row">
                                <div class="col-xs-12 col-sm-3"><img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto; width: 70%;"></div>
                                <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน </span></div>
                                <div class="col-xs-12 col-sm-6 has-error" style="padding: 3px 15px;">

                                  <div class="input-group" style="width: 295px;">
                                    <input  title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="req_pid" name="pers_info[pid]" value="<?php echo @$pers_info['pid'];?>" required/>
                                    <input type="hidden" id="pers_id" name="volt_info[pers_id]" value="<?php echo $volt_info['pers_id'];?>">

                                    <div class="input-group-btn" style="padding-bottom: 5px;">
                                      <button title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_req_pid" type="button" style=" border-radius: 0px; left: 1px;"><i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                      <!--<button class="btn btn-default elder_same_req" title="กรณีไม่มีบัตร" style="display: none;">กรณีไม่มีบัตร</button>-->
                                    </div>
                                  </div>
                                </div>
                                            <!--
                                            <script>
                                            var elder_pers = null;
                                            $("#bt_elder_pid").click(function(){
                                            if($("#pid").val()!='') {
                                            //$("#bt_elder_pid").html('<i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i><span> ตรวจสอบ</span>');
                                            $("#bt_elder_pid").attr('disabled',true);
                                            $.ajax({
                                            url: '<?php echo site_url('personals/getPersonalInfo');?>',
                                            type: 'POST',
                                            dataType: 'json',
                                            data: {
                                            pid: $("#pid").val(),
                                            <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                            },
                                            success: function (value) {
                                            console.log("success");
                                            console.dir(value);
                                            elder_pers = value;
                                            $("#name").html(value.name);
                                            $("#date_of_birth").html(value.date_of_birth);
                                            $("#gender_name").html(value.gender_name);
                                            $("#nation_name_th").html(value.nation_name_th);
                                            $("#relg_title").html(value.relg_title);
                                            $("#pers_id").val(value.pers_id);
                                            $("#bt_elder_pid").attr('disabled',false);
                                            },
                                            error:function() {
                                            console.log("error");
                                            $("#bt_elder_pid").attr('disabled',false);
                                            },
                                            });
                                            }else {
                                            $("#pid").select();
                                            $("#bt_elder_pid").attr('disabled',false);
                                            }
                                            //$("#pers_id").val('');
                                            });
                                            </script>
                                          -->
                                          <script>
                                            var req_pers = null;
                                            var inputpid = "#req_pid";
                                            var bt_spid = "#bt_req_pid";
                                            var setData = "reqData"; //Declear Name
                                            var reqData = function(value) { //Set Structure Display Data
                                              req_pers = value;
                                              $("#name").html(value.name);
                                              $("#date_of_birth").html(value.date_of_birth);
                                              $("#gender_name").html(value.gender_name);
                                              $("#nation_name_th").html(value.nation_name_th);
                                              $("#relg_title").html(value.relg_title);
                                              $("#pers_id").val(value.pers_id);
                                              $("#reg_addr_id").val(req_pers.reg_addr_id);
                                              $("#reg_addr").text(value.reg_add_info);
                                            }
                                            $(bt_spid).click(function(){//On Click for Search
                                            if($(inputpid).val()!='') {//pid not null

                                              $(bt_spid).attr('disabled',true);
                                            if(pers_authen!=null) { //Check Personal Authen
                                            getPersInfo(inputpid,bt_spid,setData); //Get Data
                                            }else if(!reader_status) { //Run Reader Personal
                                              run_readerPers();
                                              $(bt_spid).attr('disabled',false);
                                              toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                                            }
                                            }else { //pid is null
                                              $(inputpid).select();
                                            }
                                          });
                                            <?php
                                            if(isset($Valid)){
                                              ?>
                                              setTimeout(function(){$('#bt_req_pid').trigger('click');},1000);

                                              <?php
                                            }
                                            ?>
                                          </script>
                                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                                          <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"  id="name"><?php echo @$pers_info['name'];?> </div>
                                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                                          <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="date_of_birth"><?php echo @$pers_info['date_of_birth'];?> </div>
                                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name"><?php echo @$pers_info['gender_name'];?></span> </div>
                                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"><?php echo @$pers_info['nation_name_th'];?></span> </div>
                                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ศาสนา</span> <span id="relg_title"><?php echo @$pers_info['relg_title'];?> </span> </div>
                                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span></div>
                                          <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"><span id="reg_addr"><?php echo @"{$reg_addr['addr_home_no']} หมุ่ {$reg_addr['addr_moo']} {$reg_addr['addr_sub_district']} {$reg_addr['addr_district']} {$reg_addr['addr_province']} {$reg_addr['addr_zipcode']}"; ?></span></div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-3">
                                            <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ขึ้นทะเบียน </label>
                                            <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                              <input title="วันที่ขึ้นทะเบียน" placeholder="เลือกวันที่" class="form-control" type="text" name="volt_info[date_of_reg]" value="<?php echo $volt_info['date_of_reg'];?>" required />
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                            </div>
                                            <script type="text/javascript">
                                              <?php
                                              $tmp = explode('-',@$volt_info['date_of_reg']);
                                              ?>
                                              $(function () {
                                                $("#datetimepicker1").datepicker({
                                                  autoclose: true,
                                                  todayHighlight: true
                                                });
                                              });
                                            </script>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-6">ที่อยู่ (ปัจจุบัน) ( <div class="checkbox-inline i-checks"><label><input type="checkbox" name="elder_addr_chk" <?php if(isset($elder_addr_chk)){ echo "checked"; } ?>> ตรงกับที่อยู่ตามทะเบียนบ้าน</label></div> )</div>

                                          <script>
                                            setTimeout(icheck_loop,2000);
                                            // iCheck
                                            function icheck_loop () {
                                              $('.i-checks').iCheck({
                                                checkboxClass: 'icheckbox_square-green',
                                                radioClass: 'iradio_square-green',
                                                increaseArea: '20%'
                                              });
                                              $("input[name='elder_addr_chk']").on('ifClicked',function(){
                                                if(!$(this).prop('checked')) {
                                                  $(".elder_addr_pre").attr('disabled',true);
                                                }else {
                                                  $(".elder_addr_pre").attr('disabled',false);
                                                }
                                              });
                                              <?php
                                              if((@$pers_info['reg_addr_id']==@$pers_info['pre_addr_id']) && (@$pers_info['reg_addr_id']!=''&&@$pers_info['pre_addr_id']!='')) {
                                                ?>
                                                $("input[name='elder_addr_chk']").parent().addClass('checked');
                                                $("input[name='elder_addr_chk']").prop('checked',true);
                                                $(".elder_addr_pre").attr('disabled',true);
                                                <?php
                                              }
                                              ?>
                                              $("input[name='volt_info_village_position[vpos_code][009]']").on('ifChanged',function(){
                                                if($(this).prop('checked')){
                                                  $("input[name='volt_info_village_position[vpos_identify][009]']").prop('disabled',false).focus();
                                                }else{
                                                  $("input[name='volt_info_village_position[vpos_identify][009]']").prop('disabled',true);
                                                }
                                              });

                                              $("input[name='volt_info[older_care_training]']").on('ifChanged',function() {
                                                if($(this).val() == 'เคยได้รับการอบรม'){
                                                  $(".training").prop('disabled', false);
                                                }else{
                                                  $(".training").prop('disabled', true);
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
                                            <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_home_no]" />
                                          </div>
                                          <div class="col-xs-12 col-sm-3">
                                            <label for="" class="col-2 col-form-label">หมู่ที่</label>
                                            <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_moo]"/>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-3 dropdown">
                                            <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                            <div class="col-10">
                                              <select title="ตรอก" placeholder="เลือกตรอก" class="form-control elder_addr_pre" id="alley" name="pers_addr[addr_alley]">
                                                <option value="">เลือกตรอก</option>
                                                <?php $temp = $this->personal_model->getAll_alley();
                                                foreach ($temp as $key => $row) { ?>
                                                <option value="<?php echo $row['alley_code']; ?>"><?php echo $row['alley_name']; ?></option>
                                                <?php  } ?>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-xs-12 col-sm-3 dropdown">
                                            <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                                            <div class="col-10">
                                              <select title="ซอย" placeholder="เลือกซอย" class="form-control elder_addr_pre" id="lane" name="pers_addr[addr_lane]">
                                                <option value="">เลือกซอย</option>
                                                  <?php //$temp = $this->personal_model->getAll_lane();
                                                  //foreach ($temp as $key => $row) { ?>
                                                  <!-- <option value="<?php //echo $row['lane_code']; ?>"><?php //echo $row['lane_name']; ?></option> -->
                                                  <?php  //} ?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 dropdown">
                                              <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                                              <div class="col-10">
                                                <select title="ถนน" placeholder="เลือกถนน" class="form-control elder_addr_pre" id="road" name="pers_addr[addr_road]">
                                                  <option value="">เลือกถนน</option>
                                                  <?php //$temp = $this->personal_model->getAll_road();
                                                  //foreach ($temp as $key => $row) { ?>
                                                  <!-- <option value="<?php //echo $row['road_code']; ?>"><?php //echo $row['road_name']; ?></option> -->
                                                  <?php  //} ?>
                                                </select>
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
                                                  <option value="<?php echo $row['area_code']; ?>"><?php echo $row['area_name_th']; ?></option>
                                                  <?php  } ?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-3 dropdown">
                                              <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                                              <div class="col-10">
                                                <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="pers_addr[addr_district]" onchange="optionGen(this.value,'Tambon');" disabled>
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
                                              <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_zipcode]"/>
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-3">
                                              <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                              <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="pers_info[tel_no_home]" value=""/>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 dropdown">
                                              <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                                              <div class="col-10">
                                                <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control" name="pers_info[edu_code]">
                                                  <option value="">เลือกระดับการศึกษา</option>
                                                  <?php $temp = $this->personal_model->getAll_edu_level();
                                                  foreach ($temp as $key => $row) { ?>
                                                  <option value="<?php echo $row['edu_code']; ?>"><?php echo $row['edu_title']; ?></option>
                                                  <?php  } ?>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                              <label for="" class="col-2 col-form-label">อาชีพ (ปัจจุบัน)</label>
                                              <input title="อาชีพ (ปัจจุบัน)" placeholder="ระบุอาชีพ (ปัจจุบัน)" class="form-control" type="text" name="pers_info[occupation]" />
                                            </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-12"><label>ปัจจุบันดำรงดำแหน่งในหมู่บ้าน/ตำบล</label></div>
                                            <div class="col-xs-12 col-sm-3"><div class="checkbox-inline i-checks"><label><input type="checkbox" name="volt_info_village_position[vpos_code][001]" value="001"<?php if(@$volt_info_village_position['001']['vpos_code'] == "001"){ echo "checked";}?>> กรรมการหมู่บ้าน/สภา/ตำบล</label></div></div>
                                            
                                            <div class="col-xs-12 col-sm-3"><div class="checkbox-inline i-checks"><label><input type="checkbox" name="volt_info_village_position[vpos_code][002]" value="002" <?php if(@$volt_info_village_position['002']['vpos_code'] == "002"){ echo "checked";}?>> กรรมการกองทุนหมู่บ้าน</label></div></div>
                                            
                                            <div class="col-xs-12 col-sm-3"><div class="checkbox-inline i-checks"><label><input type="checkbox" name="volt_info_village_position[vpos_code][003]" value="003"<?php if(@$volt_info_village_position['003']['vpos_code'] == "003"){ echo "checked";}?>> ชมรม/สมาคม/มูลนิธิ</label></div></div>
                                            
                                            <div class="col-xs-12 col-sm-3" style="margin-bottom: 15px;" ><div class="checkbox-inline i-checks"><label><input type="checkbox" name="volt_info_village_position[vpos_code][004]" value="004" <?php if(@$volt_info_village_position['003']['vpos_code'] == "003"){ echo "checked";}?>> อาสาสมัครสาธารณสุขประจำหมู่บ้าน (อสม.)</label></div></div>
                                            
                                            <div class="col-xs-12 col-sm-3"><div class="checkbox-inline i-checks"><label><input type="checkbox" name="volt_info_village_position[vpos_code][009]" value="009" onChange="set_enable($(this),'#vpos-009');" <?php if(@$volt_info_village_position['009']['vpos_code'] == "009"){ echo "checked";}?>> อื่น ฯ</label></div></div>
                                            <div class="col-xs-12 col-sm-9"><input id="vpos-009" type="text" class="form-control" title="ตำแหน่งในหมู่บ้าน/ตำบล อื่น ๆ (ระบุ)" placeholder="อื่น ฯ (ระบุ)" name="volt_info_village_position[vpos_identify][009]" value="<?php echo @$volt_info_village_position['009']['vpos_identify'];?>" <?php if(!isset($volt_info_village_position['009']['vpos_identify'])) { echo "disabled";} ?>> </div>
                                          </div>
                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-12"><label>ได้รับการอบรมเรื่องการดูแลผู้สูงอายุ</label></div>
                                            <div class="col-xs-12 col-sm-12" style="margin-bottom: 15px;"><div class="checkbox-inline i-checks"><label><input type="radio" name="volt_info[older_care_training]" value="ไม่เคยได้รับการอบรม" <?php if($volt_info['older_care_training'] == "ไม่เคยได้รับการอบรม"){ echo "checked";}?>> ไม่เคยได้รับการอบรม</label></div></div>
                                            <div class="col-xs-12 col-sm-3"><div class="checkbox-inline i-checks"><label><input type="radio" name="volt_info[older_care_training]" value="เคยได้รับการอบรม"<?php if($volt_info['older_care_training'] == "เคยได้รับการอบรม"){ echo "checked";}?>> เคยได้รับการอบรม</label></div></div>
                                            <div class="col-xs-12 col-sm-3">
                                              <label for="datetimepicker2" class="col-2 col-form-label">วันที่ได้รับการอบรม (ล่าสุด) </label>
                                              <div id="datetimepicker2" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                <input title="ววันที่ได้รับการอบรม (ล่าสุด)" placeholder="เลือกวันที่" class="form-control training" type="text" name="volt_info[date_of_training]" value="<?php echo $volt_info['date_of_training'];?>" <?php if($volt_info['date_of_training'] == '') { echo "disabled";} ?>/>
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                              </div>
                                              <script type="text/javascript">
                                                $(function () {
                                                  $("#datetimepicker2").datepicker({
                                                    autoclose: true,
                                                    todayHighlight: true
                                                  });
                                                });
                                              </script>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                              <label for="" class="col-2 col-form-label">จากหน่วยงาน</label>
                                              <input title="จากหน่วยงาน" placeholder="จากหน่วยงาน" class="form-control training" type="text" name="volt_info[older_care_training_org]" value="<?php echo $volt_info['older_care_training_org'];?>" <?php if($volt_info['older_care_training_org'] == '') { echo "disabled";} ?>/>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                              <label for="" class="col-2 col-form-label">หลักสูตร</label>
                                              <input title="หลักสูตร" placeholder="ระบุหลักสูตร" class="form-control training" type="text" name="volt_info[older_care_training_course]" value="<?php echo $volt_info['older_care_training_course'];?>" <?php if($volt_info['older_care_training_course'] == '') { echo "disabled";} ?>/>
                                            </div>
                                            
                                          </div>
                                          
                                          
                                          <div class="form-group row">
                                            <label>ผู้สูงอายุในความดูแล (จำนวน <span id="nums_family_members">0</span> คน)</label>
                                            <script>
                                              var nummf = 0;
                                              function btDel_family_members(node,care_id) {
                                                if(care_id!=""){
                                                  $.ajax({
                                                    url: base_url+'volunteer/del_elderly_care',
                                                    type: 'POST',
                                                    dataType: 'html',
                                                    data: {
                                                      'care_id': care_id,
                                                      <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                                    },
                                                    success: function(result){
                                                      $(node).parent().parent().parent().parent().remove();
                                                      $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                    },
                                                    error: function(){
                                                      alert('ไม่สามารถลบผู้สูงอายุในความดูแลได้ กรุณาลองใหม่');}
                                                    });
                                                }else{
                                                  $(node).parent().parent().parent().parent().remove();
                                                  $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                }
                                              }
                                            </script>
                                            <div class="family_members" >
                                              <?php if(($process_action!='Add')&&($process_action!='Added')){

                                              //dieArray($volt_info_elderly_care);
                                                $i=0;
                                                foreach($volt_info_elderly_care as $key_elderly => $value_elderly ){

                                                  ?>
                                                  <input type="hidden" name="volt_info_elderly_care[care_id][<?php echo $i; ?>]" value="<?php echo $value_elderly['care_id']; ?>">
                                                  <div class="family_members_template" >
                                                    <div class="family_members_items panel-group" style="margin-top: -10px;">
                                                      <div class="panel panel-default" style="border: 0">
                                                        <div class="panel-heading clear-fix" style="background-color: initial;">
                                                        </div>
                                                        <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                          <div class="row text-right">
                                                            <button type="button" class="btn btn-default" onclick="btDel_family_members(this,<?php echo $value_elderly['care_id']; ?>);" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                          </div>
                                                          <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">เลขบัตรประจำตัวประชาชน</label>
                                                              <div class="input-group">
                                                                <input title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control" type="text" id="pid_myID" name="" value="<?php echo $value_elderly['pid']; ?>" disabled/>
                                                                <input type="text" name="volt_info_elderly_care[pers_id][<?php echo $i; ?>]" value="<?php echo $value_elderly['pers_id']; ?>" hidden="hidden">
                                                                <div class="input-group-btn">
                                                                  <button title="ตรวจสอบ" type="button" class="btn btn-default" id="bt_pid_<?php echo $i; ?>" disabled><i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">(คำนำหน้า) ชื่อตัว-ชื่อสกุล</label>
                                                              <input title="(คำนำหน้า) ชื่อตุว-ชื่อสกุลุ" placeholder="ระบุ (คำนำหน้า) ชื่อตัว-ชื่อสกุล"  value="<?php echo $value_elderly['pren_code'].' '.$value_elderly['pers_firstname_th'].' '.$value_elderly['pers_lastname_th']; ?>" class="form-control" type="text" name="" disabled/>
                                                            </div>
                                                            <?php
                                                            $age="";
                                                            $date = new DateTime($value_elderly['date_of_birth']);
                                                            $now = new DateTime();
                                                            $interval = $now->diff($date);
                                                            $age = $interval->y;

                                                            ?>
                                                            <div class="col-xs-12 col-sm-2">
                                                              <label for="" class="col-2 col-form-label">อายุ (ปี)</label>
                                                              <input title="อายุ" placeholder="ระบุอายุ (ปี)" class="form-control" type="text"  name="" value="<?php echo $age; ?>" disabled/>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-2">
                                                              <label for="" class="col-2 col-form-label">การดูแล (ครั้ง/สัปดาห์/เดือน)</label>
                                                              <input title="การดูแล (ครั้ง/สัปดาห์/เดือน)" placeholder="ระบุการดูแล (ครั้ง)" class="form-control" value="<?php echo @$value_elderly['care_freq']?>" type="text" name="volt_info_elderly_care[care_freq][<?php echo $i; ?>]"/>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-2">
                                                              <label for="" class="col-2 col-form-label">&nbsp;</label>
                                                              <select class="form-control" name="volt_info_elderly_care[care_freq_per][<?php echo $i; ?>]" title="การดูแล (ต่อสัปดาห์ หรือเดือน)">
                                                                <option value="สัปดาห์" <?php if($value_elderly['care_freq_per']=="สัปดาห์") { echo "selected"; }?> >สัปดาห์</option>
                                                                <option value="เดือน"   <?php if($value_elderly['care_freq_per']=="เดือน") { echo "selected"; }?>   >เดือน</option>
                                                              </select>
                                                            </div>
                                                          </div>
                                                          <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-2"><label for="" class="col-2 col-form-label">ปัญหาสุขภาพ</label></div>
                                                            <div class="col-xs-12 col-sm-1"><div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy][<?php echo $i; ?>]" value="ปกติ" checked> ปกติ</label></div></div>
                                                            <div class="col-xs-12 col-sm-1"><div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy][<?php echo $i; ?>]" value="ป่วยเรื้อรัง"> ป่วยเรื้อรัง</label></div></div>
                                                            <div class="col-xs-12 col-sm-1"><div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy][<?php echo $i; ?>]" value="พิการ"> พิการ</label></div></div>

                                                            <div class="col-xs-12 col-sm-2 col-sm-offset-1"><label for="" class="col-2 col-form-label">ช่วยเหลือตนเอง</label></div>
                                                            <div class="col-xs-12 col-sm-1"><div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy_self_help][<?php echo $i; ?>]" value="ได้" checked> ได้</label></div></div>
                                                            <div class="col-xs-12 col-sm-1"><div class="checkbox-inline i-checks"><label><input type="radio" name="care_pers_info[healthy_self_help][<?php echo $i; ?>]" value="ไม่ได้"> ไม่ได้</label></div></div>
                                                          </div>

                                                        </div><!-- close panel-body-->
                                                      </div><!-- close panel-default-->
                                                    </div><!-- close panel-group-->
                                                  </div><!-- close family_members_template-->



                                                  <?php
                                                  $i++;
                                                      }//close
                                                      ?>
                                                      <script type="text/javascript">

                                                        $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                        var nummf = <?php echo $i; ?>;

                                                      </script>
                                                      <?php
                                                    }else{
                                                      ?>
                                                      <script type="text/javascript">
                                                        var nummf = 0;
                                                      </script>
                                                      <?php
                                                    }
                                                    ?>

                                                  </div>
                                                  <button type="button" class="btn btn-default" id="btAdd_family_members"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                                  <script>
                                                    var cloneTmp = $('.family_members_template').clone();
                                                    //setTimeout(function(){addFmlyMember();},500);
                                                    function addFmlyMember() {
                                                      var cloneTmp1 = cloneTmp.html().replace(new RegExp("myID", 'g'), nummf);
                                                      nummf = nummf+1;
                                                      $(cloneTmp1).clone().appendTo('.family_members');
                                                      $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                    }
                                                    $("#btAdd_family_members").click(function(){ //Add
                                                      addFmlyMember();
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

                                        <hr>
                                        <div class="row">
                                          <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                          <div class="col-xs-12 col-sm-2">
                                            <button style="width: 100%;" type="button" class="btn btn-primary btn-md" onclick="return opnCnfrom()"> บันทึก</button>
                                          </div>
                                          <div class="col-xs-12 col-sm-2">
                                            <button style="width: 100%;" type="button" class="btn btn-primary btn-md" onclick="window.location.href='<?php echo site_url('volunteer/volunteer_list');?>'"> ล้างค่า</button>
                                          </div>
                                        </div><!-- close class row-->
                                        
                                      </div><!-- end panel-body tab-1-->
                                    </div><!-- end  tab-1-->
                                  </div><!-- end  tab-content-->
                                </div><!-- end  tabs-container-->
                              </div><!-- end  col-lg-12-->
                            </div><!-- end  row-->

 

      
          
         
                       
                          <script type="text/javascript">
                          <?php if($process_action == 'Edited'){ ?>
                          setTimeout(function(){$("#Province").val('<?php echo @$addr_info['province_code']; ?>').trigger('change');},200);
                          //setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
                          // setTimeot(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);
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
                          $('#'+target).prop('disabled', false);
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
                                <!-- Modal -->
                                <div class="modal fade" id="modal_marker" role="dialog">
                                  <div class="modal-dialog modal-lg">
                                    
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header" style="background-color: rgb(56,145,209);color: white;">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Search Location</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form name="form_search" method="post" action="">
                                          <b>Location</b>
                                          <div class="row">
                                            <div class="col-xs-12 col-sm-10">
                                              <input name="namePlace" class="form-control" size="70" type="text" id="namePlace" size="30" />
                                              <input type="hidden" name="address" id="namePlace2">
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                              <input type="button" class="btn btn-default" style="width: 100%; margin-top: -5px" name="SearchPlace" id="SearchPlace" value="Search" />
                                            </div>
                                          </div>
                                        </form>
                                        <hr />
                                        <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">
                                          <div class="row">
                                            <div class="col-xs-6 col-sm-5">
                                              Latitude <input class="form-control" name="lat_value" type="text" id="lat_value" value="0" size="20" readonly />
                                            </div>
                                            <div class="col-xs-6 col-sm-5">
                                              Longitude <input class="form-control" name="lon_value" type="text" id="lon_value" value="0" size="20" readonly />
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                              <input type="button" class="btn btn-default" style="margin-top: 22px; width: 100%" name="button" id="button" onclick="select_location();" value="Save" />
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
                                <!-- END modal_marker -->
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