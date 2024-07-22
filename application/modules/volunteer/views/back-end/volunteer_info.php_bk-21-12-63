<?php
//set_session('pers_authen',array('authen_log_id'=>223,'pid'=>'3101701933555','cid'=>'0221004350953232','random_string'=>'80db7f660e7ef6255597fc5794be0093')); //for Test
?>
  <script>
    //Declear Info Reader PID
    var user_id = '<?php echo get_session('user_id');?>';
    var org_id = '<?php echo get_session('org_id');?>';
    var pers_authen = JSON.parse('<?php echo json_encode(get_session('pers_authen '));?>');
    console.log('pers_authen', pers_authen);
    var reader_status = false;
    var authen_log_id = 0;
    //End Declear Info Reader PID
    var csrf_hash = '<?php echo @$csrf['hash'];?>';
    console.log('see values pers_info', <?php echo json_encode($pers_info);?>);
    console.log('see values volt_info', <?php echo json_encode($volt_info);?>);
    console.log('see values reg_addr', <?php echo json_encode($reg_addr);?>);
    // $addr_info to be used separately with $reg_addr
    console.log('see values process_action', <?php echo json_encode($process_action);?>);
  </script>
  <ul id='nav3Tabs' class="nav nav-pills<?php echo $process_action=='Edit'||$process_action=='Edited'?'':' hidden';?>">
    <li class="nav-item">
      <a class="nav-link active" forTab='1'>(1) ข้อมูลอาสาสมัคร</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" forTab='2'>(2) ข้อมูลผู้สูงอายุ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" forTab='3'>(3) ผลการดำเนินงาน</a>
    </li>
  </ul>
  <style>
    #nav3Tabs.nav.nav-pills .nav-item .nav-link.active,
    #nav3Tabs.nav.nav-pills .nav-item .nav-link:hover {
      background: white;
      color: inherit;
    }
    #nav3Tabs.nav.nav-pills .nav-item .nav-link {
      background: #eee;
    }
  </style>
  <script>
    $(function() {
      $('#nav3Tabs [forTab]').click(function() {
        $('#nav3Tabs [forTab]').removeClass('active');
        $(this).addClass('active');
        $('[navTab]').hide();
        $('[navTab='+$(this).attr('forTab')+']').show();
      });
    });
  </script>
  <div class="row">
    <div class="col-lg-12">
      <div class="tabs-container">
        <!-- <ul class="nav nav-tabs">
          <li role="presentation" class="active" style="max-width: 100% !important;"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" >(1) ข้อมูลอาสาสมัคร</a></li>
          <li role="presentation" class="active" style="max-width: 100% !important;"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab" >(2) ข้อมูลผู้สูงอายุ</a></li>
          <li role="presentation" class="active" style="max-width: 100% !important;"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab" >(3) ข้อมูลผลการดำเนินการ</a></li>
        </ul> -->
        <div class="tab-content">
          <div id="tab-1" navTab='1'>
            <div class="panel-body">
              <div id="tmp_menu" hidden='hidden'>
                <?php
                $tmp = $this->admin_model->getOnce_Application(51);
                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(51,$user_id); //Check User Permission
                ?>

                <!--
                <?php
                if($process_action=='Edit') {
                $tmp = $this->admin_model->getOnce_Application(52);
                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
                ?>
                <a data-id=<?php echo $volt_info['volt_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                  <?php if(!isset($tmp1['perm_status'])) {?>
                  readonly
                  <?php } ?>
                  title="ลบ <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                <i class="fa fa-trash" aria-hidden="true"></i> </a>
                <?php } ?>

                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                -->
              </div>
              <script>
                setTimeout(function() {
                  $("#menu_topright").html($("#tmp_menu").html());
                }, 300);
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
                            <div class="input-group-btn">
                              <button title="ตรวจสอบ" type="button" class="btn btn-default" id="bt_pid_myID"><i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label for="" class="col-2 col-form-label">(คำนำหน้า) ชื่อตัว-ชื่อสกุล</label>
                          <input title="(คำนำหน้า) ชื่อตัว-ชื่อสกุล" placeholder="ระบุ (คำนำหน้า) ชื่อตัว-ชื่อสกุล" id="name_myID" class="form-control" type="text" name="" />
                        </div>
                        <div class="col-xs-12 col-sm-2">
                          <label for="" class="col-2 col-form-label">อายุ (ปี)</label>
                          <input title="อายุ" placeholder="ระบุอายุ (ปี)" class="form-control" type="text" id="pers_age_myID" name="" />
                        </div>
                        <div class="col-xs-12 col-sm-2">
                          <label for="" class="col-2 col-form-label">การดูแล (ครั้ง/สัปดาห์/เดือน)</label>
                          <input title="การดูแล (ครั้ง/สัปดาห์/เดือน)" placeholder="ระบุการดูแล (ครั้ง)" class="form-control" type="text" name="volt_info_elderly_care[care_freq][myID]" />
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
                        <div class="col-xs-12 col-sm-3">
                          <label for="" class="col-2 col-form-label">ปัญหาสุขภาพ</label>
                          <div class="checkbox-inline i-checks">
                            <label style="font-weight: normal">
                              <input type="radio" name="care_pers_info[healthy][myID]" value="ปกติ" checked> ปกติ</label>
                          </div>
                          <div class="checkbox-inline i-checks">
                            <label style="font-weight: normal">
                              <input type="radio" name="care_pers_info[healthy][myID]" value="ป่วยเรื้อรัง"> ป่วยเรื้อรัง</label>
                          </div>
                          <div class="checkbox-inline i-checks">
                            <label style="font-weight: normal">
                              <input type="radio" name="care_pers_info[healthy][myID]" value="พิการ"> พิการ</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label for="" class="col-2 col-form-label">ช่วยเหลือตนเอง</label>
                          <div class="checkbox-inline i-checks">
                            <label style="font-weight: normal">
                              <input type="radio" name="care_pers_info[healthy_self_help][myID]" value="ได้" checked> ได้</label>
                          </div>
                          <div class="checkbox-inline i-checks">
                            <label style="font-weight: normal">
                              <input type="radio" name="care_pers_info[healthy_self_help][myID]" value="ไม่ได้"> ไม่ได้</label>
                          </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <label for="" class="col-2 col-form-label">สาเหตุการพ้นการดูแล</label>
                          <?php
                          $rows = $this->common_model->custom_query("select * from std_cause_of_care");
                          foreach($rows as $key=>$row) {
                          ?>
                          <div class="checkbox-inline i-checks">
                            <label style="font-weight: normal">
                              <input type="radio" class="care_cause_code" data-index=myID name="care_pers_info[care_cause_code][myID]" value="<?php echo $row['cause_code'];?>">
                              <?php echo $row['cause_of_care'];?>
                            </label>
                          </div>
                          <?php } ?>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <input id="care_cause_ident-myID" type="text" class="form-control" title="สาเหตุการพ้นการดูแลอื่น ๆ (ระบุ)" placeholder="อื่น ฯ (ระบุ)" name="care_pers_info[care_cause_identify][myID]" value="" disabled="">
                        </div>
                      </div>


                      <script type="text/javascript">
                        // **************** fix calling undeclaring function ****************************
                        function icheck_loop() {
                          $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                            increaseArea: '20%'
                          });
                          $("input[name='elder_addr_chk']").on('ifClicked', function() {
                            if (!$(this).prop('checked')) {
                              $(".elder_addr_pre").attr('disabled', true);
                            } else {
                              $(".elder_addr_pre").attr('disabled', false);
                            }
                          });
                          <?php
                          if((@$pers_info['reg_addr_id']==@$pers_info['pre_addr_id']) && (@$pers_info['reg_addr_id']!=''&&@$pers_info['pre_addr_id']!='')) {
                          ?>
                          $("input[name='elder_addr_chk']").parent().addClass('checked');
                          $("input[name='elder_addr_chk']").prop('checked', true);
                          $(".elder_addr_pre").attr('disabled', true);
                          <?php
                                      }
                                      ?>
                          $("input[name='volt_info_village_position[vpos_code][009]']").on('ifChanged', function() {
                            if ($(this).prop('checked')) {
                              $("input[name='volt_info_village_position[vpos_identify][009]']").prop('disabled', false).focus();
                            } else {
                              $("input[name='volt_info_village_position[vpos_identify][009]']").prop('disabled', true);
                            }
                          });

                          $("input[name='volt_info[older_care_training]']").on('ifChanged', function() {
                            if ($(this).val() == 'เคยได้รับการอบรม') {
                              $(".training").prop('disabled', false);
                            } else {
                              $(".training").prop('disabled', true);
                            }
                          });

                          $(".care_cause_code").on('ifClicked', function() {
                            //console.log($(this).val());
                            if ($(this).val() == '002') {
                              $("#care_cause_ident-" + $(this).data("index")).removeAttr('disabled');
                            } else {
                              $("#care_cause_ident-" + $(this).data("index")).attr('disabled', '');
                            }
                          });
                        };
                        setTimeout(icheck_loop, 2000);
                        // ***************** end fix ******************************

                        icheck_loop();
                        var inputpid_myID = "#pid_myID";
                        var bt_spid_myID = "#bt_pid_myID";
                        var setData_myID = "reqData_myID"; //Declear Name
                        var reqData_myID = function(value) { //Set Structure Display Data
                          console.dir(value);
                          console.log('reqData_myID', value);
                          $("#name_myID").val(value.name);
                          $("#pers_id_myID").val(value.pers_id);
                          $("#marital_status_myID").val(value.marital_status);
                          $("#pers_age_myID").val(value.age);
                          $("#occupation_myID").val(value.occupation);
                          $("#mth_avg_income_myID").val(value.mth_avg_income);
                          $("#edu_code_myID").val(value.edu_code);
                          $("input[name='pers_family[healthy][myID]']").filter('[value="' + value.healthy + '"]').attr('checked', true);
                          $("input[name='pers_family[healthy_self_help][myID]']").filter('[value="' + value.healthy_self_help + '"]').attr('checked', true);
                        }
                        $(bt_spid_myID).click(function() { //On Click for Search
                          if ($(inputpid_myID).val() != '') { //pid not null
                            $(bt_spid_myID).attr('disabled', true);
                            if (pers_authen != null) { //Check Personal Authen
                              getPersInfo(inputpid_myID, bt_spid_myID, setData_myID); //Get Data
                            } else if (!reader_status) { //Run Reader Personal
                              run_readerPers();
                              $(bt_spid_myID).attr('disabled', false);
                              toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก", "Authentications");
                            }
                          } else //pid is null
                            $(inputpid_myID).select();
                        });
                      </script>

                    </div>
                    <!-- close panel-body-->
                  </div>
                  <!-- close panel-default-->
                </div>
                <!-- close panel-group-->
              </div>
              <!-- close family_members_template-->

              <!-- training_members_template-->
              <div class="training_template" hidden='hidden'>
                <div class="row">
                  <div class="col-xs-12 col-sm-2">
                    &nbsp;
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="datetimepicker_tmyID" class="col-2 col-form-label">วันที่ได้รับการอบรม</label>
                    <div id="datetimepicker_tmyID" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                      <input title="วันที่ได้รับการอบรม" placeholder="เลือกวันที่" class="form-control training" type="text" name="training[date_of_training][myID]" disabled />
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>
                    <script type="text/javascript">
                      $(function() {
                        $("#datetimepicker_tmyID").datepicker({
                          autoclose: true,
                          todayHighlight: true,
                          format: 'dd/mm/yyyy',
                          todayBtn: true,
                          language: 'th',
                          thaiyear: true
                        });
                      });
                    </script>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="" class="col-2 col-form-label">จากหน่วยงาน</label>
                    <input title="จากหน่วยงาน" placeholder="จากหน่วยงาน" class="form-control training" type="text" name="training[older_care_training_org][myID]" disabled />
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="" class="col-2 col-form-label">หลักสูตร</label>
                    <input title="หลักสูตร" placeholder="ระบุหลักสูตร" class="form-control training" type="text" name="training[older_care_training_course][myID]" disabled />
                  </div>
                  <div class="col-xs-12 col-sm-1">
                    <button type="button" class="btn btn-default" style="margin-top: 24px;" onclick="btDel_trainer_members(this,'');" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                  </div>
                </div>
              </div>
              <!-- close training_members_template-->


              <div class="form-group row">
                <?php
                $volt_id = '';
                if($process_action=='Add'){$process_action = 'Added';$func='inserted';}
                if($process_action=='Edit'){$process_action = 'Edited';$func='edited';}
                echo form_open_multipart("volunteer/editor/$func/".$volt_info['volt_id'],array('id'=>'form1'));
                ?>
                  <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
                  <!-- Set hidden csrf field -->
                  <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                  <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                    <div class="panel-group">
                      <div class="panel panel-default" style="border: 0">

                       <!--  <div class="panel-heading">
                          <h4>ข้อมูลอาสาสมัคร</h4>
                        </div> -->
                        <h2>ข้อมูลอาสาสมัคร</h2>
                        <div class="panel-body" style="border:0; padding: 20px;">

                          <div class="form-group row">
                            <div class="col-xs-12 col-sm-3"><img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto; width: 70%;"></div>
                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน </span></div>
                            <div class="col-xs-12 col-sm-6 has-error" style="padding: 3px 15px;">

                              <div class="input-group" style="width: 295px;">
                                <input title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="req_pid" name="pers_info[pid]" value="<?php echo @$pers_info['pid'];?>" required/>
                                <input type="hidden" id="pers_id" name="volt_info[pers_id]" value="<?php echo $volt_info['pers_id'];?>">

                                <div class="input-group-btn" style="padding-bottom: 5px;">
                                  <button title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_req_pid" type="button" style="background-color:#F2DEDE; border-radius: 0px; border-color: #ed5565; color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                              var inputpid = "#req_pid";
                              var bt_spid = "#bt_req_pid";
                              var setData = "reqData"; //Declear Name
                              var reqData = function(value) { //Set Structure Display Data
                                // console.log('reqData called', value);
                                // $("#name").html(value.name);
                                // $("#date_of_birth").html(value.date_of_birth);
                                // $("#gender_name").html(value.gender_name);
                                // $("#nation_name_th").html(value.nation_name_th);
                                // $("#relg_title").html(value.relg_title);
                                // $("#pers_id").val(value.pers_id);
                                // $("#reg_addr_id").val(value.reg_addr_id);
                                // $("#reg_addr").text(value.reg_add_info);
                              }
                              $(bt_spid).click(function() { //On Click for Search
                                if ($(inputpid).val() != '') { //pid not null

                                  $(bt_spid).attr('disabled', true);
                                  if (pers_authen != null) { //Check Personal Authen
                                    getPersInfo(inputpid, bt_spid, setData); //Get Data
                                  } else if (!reader_status) { //Run Reader Personal
                                    run_readerPers();
                                    $(bt_spid).attr('disabled', false);
                                    toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก", "Authentications");
                                  }
                                } else { //pid is null
                                  $(inputpid).select();
                                }
                              });
                              <?php
                                            if(isset($Valid)){
                                              ?>
                              setTimeout(function() {
                                $('#bt_req_pid').trigger('click');
                              }, 1000);

                              <?php
                                            }
                                            ?>
                            </script>
                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                            <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="name">
                              <?php echo @$pers_info['name'];?>
                            </div>
                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                            <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="date_of_birth">
                              <?php echo @$pers_info['date_of_birth'];?>
                            </div>
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
                                <input title="วันที่ขึ้นทะเบียน" placeholder="เลือกวันที่" class="form-control" type="text" name="volt_info[date_of_reg]" required />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                              <script type="text/javascript">
                                $(function() {
                                  $("#datetimepicker1").datepicker({
                                    autoclose: true,
                                    todayHighlight: true,
                                    format: 'dd/mm/yyyy',
                                    todayBtn: true,
                                    language: 'th',
                                    thaiyear: true
                                  })
                                  <?php
                                  if ($volt_info['date_of_reg'] && $volt_info['date_of_reg'] != '0000-00-00') {
                                    $DReg = explode('-', $volt_info['date_of_reg']);
                                    $DReg[1] -= 1;
                                    echo ".datepicker('update', new Date(Date.UTC($DReg[0],$DReg[1],$DReg[2])))";
                                  }
                                  ?>;
                                });
                              </script>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-xs-12 col-sm-6">ที่อยู่ (ปัจจุบัน) (
                              <div class="checkbox-inline i-checks">
                                <label>
                                  <input type="checkbox" name="elder_addr_chk" <?php if(isset($elder_addr_chk)){ echo "checked"; } ?>> ตรงกับที่อยู่ตามทะเบียนบ้าน</label>
                              </div> )</div>

                            <div class="col-xs-12 col-sm-6">
                              <?php
                              $addr_gps = $addr_info['addr_gps']; // Old Data $diff_info['addr_gps']
                              if($addr_gps=='')
                                $addr_gps ='0,0'; // Set Default Data
                              $arr = explode(',',$addr_gps);
                              ?>
                                <script type="text/javascript">
                                  var latitude = '<?php echo $arr[0];?>';
                                  var longitude = '<?php echo $arr[1];?>';
                                  //var latitude_center = latitude=='0'?'13.5847536':latitude;
                                  //var longitude_center = longitude=='0'?'13.5847536':longitude;
                                  var marker_img = '<?php echo path('map - marker.png','webconfig');?>';
                                  if (latitude != '0' && longitude != '0') {
                                    setTimeout(function() {
                                      $("#lat_value").val(latitude); // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                                      $("#lon_value").val(longitude); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                                      //$("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
                                    }, 1500);
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
                              <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_moo]" />
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
                                    <option value="<?php echo $row['area_code']; ?>">
                                      <?php echo $row['area_name_th']; ?>
                                    </option>
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
                              <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_zipcode]" />
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-xs-12 col-sm-3">
                              <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                              <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="pers_info[tel_no_home]" value="" />
                            </div>
                            <div class="col-xs-12 col-sm-6 dropdown">
                              <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                              <div class="col-10">
                                <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control" name="pers_info[edu_code]">
                                  <option value="">เลือกระดับการศึกษา</option>
                                  <?php $temp = $this->personal_model->getAll_edu_level();
                                                  foreach ($temp as $key => $row) { ?>
                                    <option value="<?php echo $row['edu_code']; ?>">
                                      <?php echo $row['edu_title']; ?>
                                    </option>
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
                            <div class="row">
                              <div class="col-xs-12 col-sm-12">
                                <label>ปัจจุบันดำรงดำแหน่งในหมู่บ้าน/ตำบล</label>
                              </div>
                              <div class="col-xs-12 col-sm-3">
                                <div class="checkbox-inline i-checks">
                                  <label>
                                    <input type="checkbox" name="volt_tasks[]" value="001" <?php if(@$volt_info_village_position['001']['vpos_code']=="001" ){ echo "checked";}?>> กรรมการหมู่บ้าน/สภา/ตำบล</label>
                                </div>
                              </div>

                              <div class="col-xs-12 col-sm-3">
                                <div class="checkbox-inline i-checks">
                                  <label>
                                    <input type="checkbox" name="volt_info_village_position[vpos_code][002]" value="002" <?php if(@$volt_info_village_position['002']['vpos_code']=="002" ){ echo "checked";}?>> กรรมการกองทุนหมู่บ้าน</label>
                                </div>
                              </div>

                              <div class="col-xs-12 col-sm-3">
                                <div class="checkbox-inline i-checks">
                                  <label>
                                    <input type="checkbox" name="volt_info_village_position[vpos_code][003]" value="003" <?php if(@$volt_info_village_position['003']['vpos_code']=="003" ){ echo "checked";}?>> ชมรม/สมาคม/มูลนิธิ</label>
                                </div>
                              </div>

                              <div class="col-xs-12 col-sm-3" style="margin-bottom: 15px;">
                                <div class="checkbox-inline i-checks">
                                  <label>
                                    <input type="checkbox" name="volt_info_village_position[vpos_code][004]" value="004" <?php if(@$volt_info_village_position['003']['vpos_code']=="003" ){ echo "checked";}?>> อาสาสมัครสาธารณสุขประจำหมู่บ้าน (อสม.)</label>
                                </div>
                              </div>

                              <div class="col-xs-12 col-sm-3">
                                <div class="checkbox-inline i-checks">
                                  <label>
                                    <input type="checkbox" name="volt_info_village_position[vpos_code][009]" value="009" onChange="set_enable($(this),'#vpos-009');" <?php if(@$volt_info_village_position['009']['vpos_code']=="009" ){ echo "checked";}?>> อื่น ฯ</label>
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-9">
                                <input id="vpos-009" type="text" class="form-control" title="ตำแหน่งในหมู่บ้าน/ตำบล อื่น ๆ (ระบุ)" placeholder="อื่น ฯ (ระบุ)" name="volt_info_village_position[vpos_identify][009]" value="<?php echo @$volt_info_village_position['009']['vpos_identify'];?>"
                                <?php if(!isset($volt_info_village_position['009']['vpos_identify'])) { echo "disabled";} ?>> </div>
                            </div>
                            <div class="form-group row">
                              <div class="col-xs-12 col-sm-12">
                                <label>ได้รับการอบรมเรื่องการดูแลผู้สูงอายุ</label>
                              </div>
                              <div class="col-xs-12 col-sm-12" style="margin-bottom: 15px;">
                                <div class="checkbox-inline i-checks">
                                  <label>
                                    <input type="radio" name="volt_info[older_care_training]" value="ไม่เคยได้รับการอบรม" <?php if($volt_info['older_care_training']=="ไม่เคยได้รับการอบรม" ){ echo "checked";}?>> ไม่เคยได้รับการอบรม</label>
                                </div>
                              </div>


                              <div class="col-xs-12 col-sm-3">
                                <div class="checkbox-inline i-checks">
                                  <label>
                                    <input type="radio" name="volt_info[older_care_training]" value="เคยได้รับการอบรม" <?php if($volt_info['older_care_training']=="เคยได้รับการอบรม" ){ echo "checked";}?>> เคยได้รับการอบรม</label>
                                </div>
                              </div>

                              <div class="col-xs-12 col-sm-9">
                                &nbsp;
                              </div>
                            </div>

                            <div class="training_members" style="margin-top:-15px">
                              <?php
                              if(($process_action!='Add')&&($process_action!='Added'))
                                foreach($volt_info_training as $j => $value_training ) {
                              ?>
                                <div class="row">
                                  <div class="col-xs-12 col-sm-2">
                                    &nbsp;
                                    <input type="hidden" name="training[train_id][<?php echo $j; ?>]" value="<?php echo $value_training['train_id']; ?>">
                                  </div>
                                  <div class="col-xs-12 col-sm-3">
                                    <label for="datetimepicker_t<?=$j?>" class="col-2 col-form-label">วันที่ได้รับการอบรม</label>
                                    <div id="datetimepicker_t<?=$j?>" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                      <input title="วันที่ได้รับการอบรม" placeholder="เลือกวันที่" class="form-control training" type="text" name="training[date_of_training][<?=$j?>]" />
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                    <script type="text/javascript">
                                      $(function() {
                                        $("#datetimepicker_t<?=$j?>").datepicker({
                                          autoclose: true,
                                          todayHighlight: true,
                                          format: 'dd/mm/yyyy',
                                          todayBtn: true,
                                          language: 'th',
                                          thaiyear: true
                                        })
                                        <?php
                                        if ($value_training['date_of_training'] && $value_training['date_of_training'] != '0000-00-00') {
                                          $DTrain = explode('-', $value_training['date_of_training']);
                                          $DTrain[1] -= 1;
                                          echo ".datepicker('update', new Date(Date.UTC($DTrain[0],$DTrain[1],$DTrain[2])))";
                                        }
                                        ?>;
                                      });
                                    </script>
                                  </div>
                                  <div class="col-xs-12 col-sm-3">
                                    <label for="" class="col-2 col-form-label">จากหน่วยงาน</label>
                                    <input title="จากหน่วยงาน" placeholder="จากหน่วยงาน" class="form-control training" type="text" name="training[older_care_training_org][<?=$j?>]" value="<?php echo $value_training['older_care_training_org'];?>" />
                                  </div>
                                  <div class="col-xs-12 col-sm-3">
                                    <label for="" class="col-2 col-form-label">หลักสูตร</label>
                                    <input title="หลักสูตร" placeholder="ระบุหลักสูตร" class="form-control training" type="text" name="training[older_care_training_course][<?=$j?>]" value="<?php echo $value_training['older_care_training_course'];?>" />
                                  </div>
                                  <div class="col-xs-12 col-sm-1">
                                    <button type="button" class="btn btn-default" style="margin-top: 24px;" onclick="btDel_trainer_members(this,<?php echo $value_training['train_id'];?>);" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                  </div>
                                </div>
                                <?php } ?>
                            </div>

                            <div class=row>
                              <div class="col-xs-12 col-sm-2">
                                &nbsp;
                              </div>
                              <div class="col-xs-12 col-sm-10 text-left" style="margin-top:4px;">
                                <button type="button" class="btn btn-default" id="btAdd_training"><i class="fa fa-plus" aria-hidden="true"></i></button>
                              </div>
                            </div>

                            <script>
                              var nummt = <?=$j?>;
                              var cloneTmp_t = $('.training_template').clone();

                              function addTrnMember() {
                                if (!$("input[name='volt_info[older_care_training]']").prop("checked")) {
                                  var cloneTmp0 = cloneTmp_t.html().replace(new RegExp("myID", 'g'), nummt);
                                  nummt = nummt + 1;
                                  $(cloneTmp0).clone().appendTo('.training_members');
                                  $(".training").prop('disabled', false);
                                }
                              }
                              $("#btAdd_training").click(function() { //Add
                                addTrnMember();
                              });

                              <?php
                              if(count($volt_info_training)==0){
                              ?>
                              var cloneTmp0 = cloneTmp_t.html().replace(new RegExp("myID", 'g'), nummt);
                              nummt = nummt + 1;
                              $(cloneTmp0).clone().appendTo('.training_members');
                              <?php } ?>

                              function btDel_trainer_members(node, train_id) {
                                if (train_id != "") {
                                  $.ajax({
                                    url: base_url + 'volunteer/del_train',
                                    type: 'POST',
                                    dataType: 'html',
                                    data: {
                                      'train_id': train_id
                                      <?php echo ','.$csrf['name'].':"'.$csrf['hash'].'"';?>
                                    },
                                    success: function(result) {
                                      $(node).parent().parent().remove();
                                    },
                                    error: function() {
                                      alert('ไม่สามารถลบประวัติการอบรมได้ กรุณาลองใหม่');
                                    }
                                  });
                                } else {
                                  $(node).parent().parent().remove();
                                }
                              }

                              <?php
                              if(($process_action!='Add' && $process_action!='Added') && $volt_info['older_care_training']=='เคยได้รับการอบรม'){
                              ?>
                              $(".training").prop('disabled', false);
                              <?php } ?>
                            </script>

                          </div>


                          

                          <!--******************** new section added ********************* -->
                          <div class='form-group row'>
                            <div class='h3'>สถานะการพ้นจากการเป็นอาสาสมัครดูแลผู้สูงอายุ</div>
                            <div class="col-xs-12 col-sm-3">
                              <label for="quit_date" class="col-2 col-form-label"> วันที่พ้นจากการเป็นอาสาสมัคร </label>
                              <div id="quit_date" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                <input id='date_of_resign' title="วันที่พ้นจากการเป็นอาสาสมัคร" placeholder="เลือกวันที่" class="form-control" type="text">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                              <input type='hidden' name='volt_info[date_of_resign]' value="<?php echo $volt_info['date_of_resign']?>" />
                              <script type="text/javascript">
                                $(function() {
                                  $("#quit_date").datepicker({
                                    autoclose: true,
                                    todayHighlight: true,
                                    format: 'dd/mm/yyyy',
                                    todayBtn: true,
                                    language: 'th',
                                    thaiyear: true
                                  })
                                  <?php
                                  if ($volt_info['date_of_resign'] && $volt_info['date_of_resign'] != '0000-00-00') {
                                    $DResign = explode('-', $volt_info['date_of_resign']);
                                    $DResign[1] -= 1;
                                    echo ".datepicker('update', new Date(Date.UTC($DResign[0],$DResign[1],$DResign[2])))";
                                  }
                                  ?>;
                                });

                                $('#date_of_resign').change(function() {
                                  var val = $(this).val().split('/');
                                  $('[name="volt_info[date_of_resign]"]').val((val[2] - 543) + '-' + val[1] + '-' + val[0]);
                                });
                              </script>
                            </div>
                            <div class="col-xs-12 col-sm-2">
                              <label for="" class="col-2 col-form-label">สาเหตุที่พ้นจากการเป็นอาสาสมัคร</label>
                              <select id='resign_reason_choices' class="form-control" title="สาเหตุที่พ้นจากการเป็นอาสาสมัคร">
                                <option disabled selected>เลือกสาเหตุ</option>
                                <option value="ลาออก">ลาออก</option>
                                <option value="เข้าสู่วัยผู้สูงอายุ">เข้าสู่วัยผู้สูงอายุ</option>
                                <option value="เสียชีวิต">เสียชีวิต</option>
                                <option value="">อื่นๆ</option>
                              </select>
                            </div>
                            <div class="col-xs-12 col-sm-3" style='display:none;'>
                              <label for="" class="col-2 col-form-label">&nbsp;</label>
                              <input id='resign_reason' class='form-control' type="text" placeholder="อื่นๆ(โปรดระบุ)" name='volt_info[resign_reason]' value='<?php echo $volt_info['resign_reason'];?>' />
                            </div>
                          </div>
                          <script>
                            $('#resign_reason_choices').change(function() {
                              $('#resign_reason').val($(this).val()).parent()[$(this).val() == '' ? 'show' : 'hide']();
                            });
                            var reason = $('#resign_reason').val();
                            if (reason && !$('#resign_reason_choices').val(reason).val()) {
                              $('#resign_reason_choices option:last').attr('selected', 'selected');
                              $('#resign_reason').val(reason).parent().show();
                            }
                          </script>
                          <!-- ***************** end added ************************ -->

                        </div>
                      </div>
                    </div>
                    <?php echo form_close();?>
              </div>

              <hr>
              <div class="row">
                <div class="col-xs-12 col-sm-8">&nbsp;</div>
                <div class="col-xs-12 col-sm-2">
                  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                </div>
                <div class="col-xs-12 col-sm-2">
                  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('volunteer/volunteer_list');?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                </div>
              </div>
              <!-- close class row-->

            </div>
            <!-- end panel-body tab-1-->
          </div>
          <!-- end  tab-1-->
          <div id='tab-2' navTab='2' style='display:none;'>
            <?php
                $volt_id = '';
                if($process_action=='Added'){$process_action = 'Added';$func_elders='elders_inserted';}
                if($process_action=='Edited'){$process_action = 'Edited';$func_elders='elders_edited';}
                echo form_open_multipart("volunteer/editor/$func_elders/".$volt_info['volt_id'],array('id'=>'form-elders'));
            ?>

            <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
            <input type="submit" value="submit" name="bt_submit" hidden="hidden">
            <!-- This is a second tab. -->
            <h2>รายการผู้สูงอายุในความดูแล</h2>
            
            <!-- form-group row -->
            <div class="">
              <label>ผู้สูงอายุในความดูแล (จำนวน <span id="nums_family_members">0</span> คน)</label>
              <script>
                var nummf = 0;

                function btDel_family_members(node, care_id) {
                  if (care_id != "") {
                    $.ajax({
                      url: base_url + 'volunteer/del_elderly_care',
                      type: 'POST',
                      dataType: 'html',
                      data: {
                        'care_id': care_id
                        <?php echo ','.$csrf['name'].": '".$csrf['hash']."'";?>
                      },
                      success: function(result) {
                        $(node).parent().parent().parent().parent().remove();
                        $("#nums_family_members").html($(".family_members .family_members_items").length);
                      },
                      error: function() {
                        alert('ไม่สามารถลบผู้สูงอายุในความดูแลได้ กรุณาลองใหม่');
                      }
                    });
                  } else {
                    $(node).parent().parent().parent().parent().remove();
                    $("#nums_family_members").html($(".family_members .family_members_items").length);
                  }
                }
              </script>
              <div class="family_members">
                <?php if(($process_action!='Add')&&($process_action!='Added')){

                                //dieArray($volt_info_elderly_care);
                                  $i=0;
                                  foreach($volt_info_elderly_care as $key_elderly => $value_elderly ){

                                    ?>
                  <input type="hidden" name="volt_info_elderly_care[care_id][<?php echo $i; ?>]" value="<?php echo $value_elderly['care_id']; ?>">
                  <div class="family_members_template">
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
                              <input title="(คำนำหน้า) ชื่อตัว-ชื่อสกุล" placeholder="ระบุ (คำนำหน้า) ชื่อตัว-ชื่อสกุล" value="<?php echo $value_elderly['prename_th'].' '.$value_elderly['pers_firstname_th'].' '.$value_elderly['pers_lastname_th']; ?>" class="form-control" type="text"
                              name="" disabled/>
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
                                <input title="อายุ" placeholder="ระบุอายุ (ปี)" class="form-control" type="text" name="" value="<?php echo $age; ?>" disabled/>
                              </div>
                              <div class="col-xs-12 col-sm-2">
                                <label for="" class="col-2 col-form-label">การดูแล (ครั้ง/สัปดาห์/เดือน)</label>
                                <input title="การดูแล (ครั้ง/สัปดาห์/เดือน)" placeholder="ระบุการดูแล (ครั้ง)" class="form-control" value="<?php echo @$value_elderly['care_freq']?>" type="text" name="volt_info_elderly_care[care_freq][<?php echo $i; ?>]" />
                              </div>
                              <div class="col-xs-12 col-sm-2">
                                <label for="" class="col-2 col-form-label">&nbsp;</label>
                                <select class="form-control" name="volt_info_elderly_care[care_freq_per][<?php echo $i; ?>]" title="การดูแล (ต่อสัปดาห์ หรือเดือน)">
                                  <option value="สัปดาห์" <?php if($value_elderly['care_freq_per']=="สัปดาห์" ) { echo "selected"; }?> >สัปดาห์</option>
                                  <option value="เดือน" <?php if($value_elderly['care_freq_per']=="เดือน" ) { echo "selected"; }?> >เดือน</option>
                                </select>
                              </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-xs-12 col-sm-3">
                              <label for="" class="col-2 col-form-label">ปัญหาสุขภาพ</label>
                              <div class="checkbox-inline i-checks">
                                <label style="font-weight: normal">
                                  <input type="radio" name="care_pers_info[healthy][<?php echo $i;?>]" value="ปกติ" <?php if($value_elderly['care_health_problems']=="ปกติ" ) {?>checked
                                  <?php }?>> ปกติ</label>
                              </div>
                              <div class="checkbox-inline i-checks">
                                <label style="font-weight: normal">
                                  <input type="radio" name="care_pers_info[healthy][<?php echo $i;?>]" value="ป่วยเรื้อรัง" <?php if($value_elderly['care_health_problems']=="ป่วยเรื้อรัง" ) {?>checked
                                  <?php }?>> ป่วยเรื้อรัง</label>
                              </div>
                              <div class="checkbox-inline i-checks">
                                <label style="font-weight: normal">
                                  <input type="radio" name="care_pers_info[healthy][<?php echo $i;?>]" value="พิการ" <?php if($value_elderly['care_health_problems']=="พิการ" ) {?>checked
                                  <?php }?>> พิการ</label>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                              <label for="" class="col-2 col-form-label">ช่วยเหลือตนเอง</label>
                              <div class="checkbox-inline i-checks">
                                <label style="font-weight: normal">
                                  <input type="radio" name="care_pers_info[healthy_self_help][<?php echo $i;?>]" value="ได้" <?php if($value_elderly['care_help_yourself']=="พิการ" ) {?>checked
                                  <?php }?>> ได้</label>
                              </div>
                              <div class="checkbox-inline i-checks">
                                <label style="font-weight: normal">
                                  <input type="radio" name="care_pers_info[healthy_self_help][<?php echo $i;?>]" value="ไม่ได้" <?php if($value_elderly['care_help_yourself']=="ไม่ได้" ) {?>checked
                                  <?php }?>> ไม่ได้</label>
                              </div>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                              <label for="" class="col-2 col-form-label">สาเหตุการพ้นการดูแล</label>
                              <?php
                                                $rows = $this->common_model->custom_query("select * from std_cause_of_care");
                                                foreach($rows as $key=>$row) {
                                                ?>
                                <div class="checkbox-inline i-checks">
                                  <label style="font-weight: normal">
                                    <input type="radio" class="care_cause_code" data-index=<?php echo $i;?> name="care_pers_info[care_cause_code][
                                    <?php echo $i;?>]" value="
                                      <?php echo $row['care_cause_code'];?>"
                                        <?php if($value_elderly['care_cause_code']==$row['cause_code']) {?>checked
                                          <?php }?>>
                                            <?php echo $row['cause_of_care'];?>
                                  </label>
                                </div>
                                <?php
                                                }
                                                ?>
                            </div>
                            <div class="col-xs-12 col-sm-3">
                              <input id="care_cause_ident-<?php echo $i;?>" type="text" class="form-control" title="สาเหตุการพ้นการดูแลอื่น ๆ (ระบุ)" placeholder="อื่น ฯ (ระบุ)" name="care_pers_info[care_cause_identify][<?php echo $i;?>]" value="<?php $row['care_cause_identify'];?>"
                              <?php if($value_elderly['care_cause_code']!='002' ){?> disabled=""
                              <?php }?>>
                            </div>
                          </div>

                        </div>
                        <!-- close panel-body-->
                      </div>
                      <!-- close panel-default-->
                    </div>
                    <!-- close panel-group-->
                  </div>
                  <!-- close family_members_template-->



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
                  nummf = nummf + 1;

                  setTimeout(function() {
                    $("#pid_" + (nummf - 1)).mask("9-9999-99999-99-9");
                    //$("#pren_code_"+(nummf-1)).select2();
                    //alert("#pid_"+(nummf-1));
                  }, 1000);

                  $(cloneTmp1).clone().appendTo('.family_members');
                  $("#nums_family_members").html($(".family_members .family_members_items").length);
                }
                $("#btAdd_family_members").click(function() { //Add
                  addFmlyMember();
                });
              </script>
            </div>

            
            <div class="row">
                <div class="col-xs-12 col-sm-10">&nbsp;</div>
                <div class="col-xs-12 col-sm-2">
                  <button style="height: 40px;width: 100% !important;" class="btn btn-primary btn-save" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                </div>
                <!-- <div class="col-xs-12 col-sm-2">
                  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='http://localhost:4567/dop/volunteer/volunteer_list'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                </div> -->
            </div>
            <?php echo form_close();?>

          </div>


          <div id='tab-3' navTab='3' style='display:none;'>
            <h2>ผลการดำเนินงาน</h2>
            <div class='panel-body'>
              <div class='row text-right'>
                <div id='newPortfolioEntry' class='btn btn-primary btn-add'>
                  <i style="font-size:14px;" class="fa fa-plus-circle" aria-hidden="true"></i>
                  เพิ่มรายการ
                </div>
              </div>
              <div class='row'>
                <table id="portfolio" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important;" >
                  <thead style="font-size: 15px;">
                    <tr>
                      <th class="text-center">วัน เดือน ปี ที่ให้การดูแลผู้สูงอายุ</th>
                      <th class="text-center">ชื่อ – สกุล ผู้สูงอายุ</th>
                      <th class="text-center">จำนวนกิจกรรมที่ให้การดูแลและช่วยเหลือ</th>
                      <th class="text-center" style='width:120px;'>เครื่องมือ</th>
                      <style>
                      #portfolio thead tr th,
                      #portfolio tbody tr.active td {
                        background: #2F4050;
                        color: white;
                        font-weight: 400;
                      }
                      #portfolio tbody tr.active td i {
                        color: white;
                      }
                      </style>
                    </tr>
            			</thead>
                  <tbody></tbody>
            		</table>
              </div>
              <div id='editEntryModal' style='display:none;'>
                <div class='content-panel'>
                  <form>
                    <div class='form-group row'>
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-form-label">ชื่อ – สกุล ผู้สูงอายุ</label>
                        <select class='form-control' name='care_prog_pers_id'>
                          <option disabled>เลือกชื่อผู้สูงอายุ</option>
                          <?php foreach ($volt_info_elderly_care as $elder) {
                          echo "<option value='".$elder['pers_id']."'>".$elder['pers_firstname_th'].' '.$elder['pers_lastname_th']."</option>";
                          } ?>
                        </select>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label class="col-form-label">วันเดือนปี ที่ให้การดูแลผู้สูงอายุ</label>
                        <div id="entry_date_wrapper" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                          <input id='entry_date' title="วันเดือนปี ที่ให้การดูแลผู้สูงอายุ" placeholder="เลือกวันที่" class="form-control" type="text">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                        <input type='hidden' name='volt_info[entry_date]' value="<?php echo $volt_info['entry_date']?>" />
                        <script type="text/javascript">
                          $(function() {
                            $("#entry_date_wrapper").datepicker({
                              autoclose: true,
                              todayHighlight: true,
                              format: 'dd/mm/yyyy',
                              todayBtn: true,
                              language: 'th',
                              thaiyear: true
                            });
                          });
                          $('#entry_date').change(function() {
                            var val = $(this).val().split('/');
                            $('[name="volt_info[entry_date]"]').val((val[2] - 543) + '-' + val[1] + '-' + val[0]);
                          });
                        </script>
                      </div>
                    </div>
                    <div class='h3'>กิจกรรมการดูแลช่วยเหลือและคุ้มครองพิทักษ์สิทธิผู้สูงอายุ</div>
                    <div class='form-group row'>
                      <?php foreach ($care_activities as $activity) { ?>
                      <div class="col-xs-12 col-sm-3">
                        <div class="checkbox-inline i-checks">
                          <label>
                            <div class="icheckbox_square-green">
                              <input type="checkbox" name="care_prog_acti_id_set[]" value="<?php echo $activity['care_acti_id'];?>">
                              <ins class="iCheck-helper"></ins>
                            </div>
                            <?php echo $activity['care_acti_title'];?>
                          </label>
                        </div>
                      </div>
                      <?php } ?>
                      <div class="col-xs-12 col-sm-3">
                        <div class="checkbox-inline i-checks">
                          <label>
                            <div class="icheckbox_square-green">
                              <input type="checkbox" name="care_prog_acti_id_set[]" value="etc">
                              <ins class="iCheck-helper"></ins>
                            </div>
                            อื่นๆ
                          </label>
                          &nbsp;
                          <input class='form-control' type='text' name='care_prog_specify' value="<?php echo $activity['care_prog_specify'];?>" style='width:auto;display:inline-block;margin-top:-8px;position:relative;top:4px;' placeholder="โปรดระบุ" />
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class='row'>
                      <div class='col-xs-12 col-sm-8'></div>
                      <div class='col-xs-12 col-sm-2'>
                        <div id='save_volt_progress' class='btn btn-primary btn-save' style='width:100%!important'>
                          <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
                        </div>
                      </div>
                      <div class='col-xs-12 col-sm-2'>
                        <div class='btn btn-primary btn-cancel' style='width:100%!important'>
                          <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <script>
                var portfolio = <?php echo json_encode($volt_info_care_progress);?>;
                console.log('care_progresses', portfolio);
                var elders = <?php echo json_encode($volt_info_elderly_care);?>;
                console.log('elders in charge', elders);
                var saveMethod, entryId;
                $(function() {
                  var tab3 = $('#tab-3');
                  $.fn.hilightTab3Tr = function(index) {
                    tab3.find('#portfolio tr').removeClass('active');
                    if (index)
                      tab3.find('#portfolio tr[index='+index+']').addClass('active');
                    return this;
                  };
                  $.fn.showTab3Form = function() {
                    tab3.find('#editEntryModal').show();
                    return this;
                  };
                  $.fn.clearTab3Form = function() {
                    tab3.find('#editEntryModal [type=checkbox]')
                      .prop('checked', false)
                      .parent().removeClass('checked');
                    tab3.find("#entry_date_wrapper").datepicker('update', 'now');
                    tab3.find('#editEntryModal [name=care_prog_specify]').val('');
                    return this;
                  };
                  $.fn.fillTab3Form = function(entry) {
                    var tasks = eval(entry.care_prog_acti_id_set);
                    for (var i = 0, ii = tasks.length; i < ii; i++)
                      tab3.find('#editEntryModal [type=checkbox][value='+tasks[i]+']')
                        .prop('checked', true)
                        .parent().addClass('checked');
                    tab3.find('[name=care_prog_pers_id]').val(entry.care_prog_pers_id);
                    tab3.find("#entry_date_wrapper").datepicker('update', entry.care_prog_care_date.split('-').reverse().join('-'));
                    tab3.find('#editEntryModal [name=care_prog_specify]').val(entry.care_prog_specify);
                    return this;
                  };
                  var editEntry = function(careProgId, set) {
                    if (careProgId) {
                      for (var i = 0, ii = portfolio.length; i < ii; i++)
                        if (portfolio[i].care_prog_id == careProgId)
                          $.extend(portfolio[i], set);
                    } else
                      portfolio.push(set);
                  };
                  var renderTab3 = function() {
                    var entryBody = tab3.find('#portfolio tbody').html('');
                    portfolio.sort(function(a, b) {
                      return a.care_prog_care_date < b.care_prog_care_date ? -1 : a.care_prog_care_date > b.care_prog_care_date ? 1 : 0;
                    });
                    for (var i = 0, ii = portfolio.length; i < ii; i++) {
                      if (portfolio[i].care_prog_status == 'Inactive')
                        continue;
                      var tr = $('<tr>', { index : i });
                      var date = portfolio[i].care_prog_care_date.split('-');
                      tr.append($('<td>', { class : 'text-center', text : date[2] + '/' + date[1] + '/' + (+date[0] + 543) }));
                      var elder = elders.filter(e => e.pers_id==portfolio[i].pers_id)[0];
                      tr.append($('<td>', { text : elder.pers_firstname_th + ' ' + elder.pers_lastname_th }));
                      tr.append($('<td>', { class : 'text-center', text : eval(portfolio[i].care_prog_acti_id_set).length }));
                      tr.append($('<td>', { class : 'text-center' }).append(
                        $('<i>', { class : 'fa fa-pencil btn editEntry', "entry-index" : i, "entry-id" : portfolio[i].care_prog_id }),
                        $('<i>', { class : 'fa fa-trash btn deleteEntry', "entry-index" : i, "entry-id" : portfolio[i].care_prog_id })
                      ));
                      entryBody.append(tr);
                    }
                    tab3.find('#editEntryModal').hide();
                  };
                  renderTab3();

                  tab3.find('#newPortfolioEntry').click(function() {
                    tab3.find('#portfolio tr').removeClass('active');
                    tab3
                      .hilightTab3Tr()
                      .showTab3Form()
                      .clearTab3Form();
                    saveMethod = 'ajax_insert';
                    entryId = null;
                  });
                  tab3.find('#portfolio').on('click', '.editEntry', function() {
                    var index = $(this).attr('entry-index');
                    tab3
                      .hilightTab3Tr(index)
                      .showTab3Form()
                      .clearTab3Form()
                      .fillTab3Form(portfolio[index]);
                    saveMethod = 'ajax_update';
                    entryId = $(this).attr('entry-id');
                  });
                  tab3.find('#portfolio').on('click', '.deleteEntry', function() {
                    entryId = $(this).attr('entry-id');
                    if (confirm('sure?')) {
                      $.ajax({
                        url: base_url + 'volunteer/care_progress/ajax_delete',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                          care_prog_id : entryId,
                          care_prog_status : 'Inactive'
                          <?php echo ','.$csrf['name'].':"'.$csrf['hash'].'"';?>}
                      }).done(function(ret) {
                        editEntry(entryId, { care_prog_status : 'Inactive' });
                        renderTab3();
                      }).fail(function(e) { console.log("error", e); });
                    }
                  });

                  tab3.find('#save_volt_progress').click(function() {
                    var data = {};
                    data.care_prog_volt_id = <?php echo $volt_info['volt_id'];?>;
                    data.care_prog_pers_id = tab3.find('[name="care_prog_pers_id"]').val();
                    var d = tab3.find("#entry_date_wrapper").datepicker('getDate');
                    data.care_prog_care_date =
                      d.getFullYear() + "-" +
                      ("0" + (d.getMonth() + 1)).slice(-2) + "-" +
                      ("0" + d.getDate()).slice(-2);
                    data.care_prog_specify = tab3.find('[name="care_prog_specify"]').val();
                    data.care_prog_acti_id_set = [];
                    tab3.find('[name="care_prog_acti_id_set[]"]:checked').each(function() {
                      data.care_prog_acti_id_set.push($(this).val());
                    });
                    data.care_prog_status = 'Active';
                    if (entryId)
                      data.care_prog_id = entryId;
                    data['<?php echo $csrf['name'];?>'] = '<?php echo $csrf['hash'];?>';

                    $.ajax({
                      url: base_url + 'volunteer/care_progress/'+saveMethod,
                      type: 'POST',
                      dataType: 'json',
                      data: data
                    }).done(function(ret) {
                      if (saveMethod == 'ajax_insert')
                        editEntry(null, $.extend(data, { pers_id : data.care_prog_pers_id, care_prog_id : ret.care_prog_id }));
                      if (saveMethod == 'ajax_update')
                        editEntry(entryId, $.extend(data, { pers_id : data.care_prog_pers_id }));
                      renderTab3();
                    }).fail(function(e) { console.log("error", e); });
                  });
                });
              </script>
            </div>
          </div>
        </div>
        <!-- end  tab-content-->
      </div>
      <!-- end  tabs-container-->
    </div>
    <!-- end  col-lg-12-->
  </div>
  <!-- end  row-->



  <script type="text/javascript">
    <?php if($process_action == 'Edited'){ ?>
    setTimeout(function() {
      $("#Province").val('<?php echo @$addr_info['province_code']; ?>').trigger('change');
    }, 200);
    //setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
    // setTimeot(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);
    <?php } ?>

    function set_enable(elem, target = '') {
      if (elem.prop('checked') == true) {
        $(target).prop('disabled', false).focus();
      } else {
        $(target).val('');
        $(target).prop('disabled', true);
      }
    }

    function optionGen(code, target, opSelect) {
      // alert(code.value);
      // alert(target);
      $.ajax({
          url: base_url + 'personals/get_Area_option',
          type: 'POST',
          dataType: 'json',
          data: {
            'code': code.value,
            'type': target
            <?php echo ','.$csrf['name'].':"'.$csrf['hash'].'"';?>
          },
        })
        .done(function(ret) {
          console.log("success");
          console.dir(ret);
          $('#' + target).empty();
          $('#' + target).prop('disabled', false);
          if (target == 'Amphur') {
            str = "เลือกอำเภอ";
          } else if (target == 'Tambon') {
            str = "เลือกตำบล";
          }
          $('#' + target).append($('<option>', {
            value: '',
            text: str
          }));
          for (var i = 0; i < ret.length; i++) {
            // if(ret[i].area_code == opSelect){
            $('#' + target).append($('<option>', {
              value: ret[i].area_code,
              text: ret[i].area_name_th
            }));
            // }else{
            //   $('#'+target).append($('<option>', {
            //     value: ret[i].area_code,
            //     text : ret[i].area_name_th
            //   }));
            // }
          }
          $('#' + target).val(opSelect).trigger('change');
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
                <a href="#" class="btn btn-default btn-search" style="width: 100%; margin-top: 0px; color:#fff" name="SearchPlace" id="SearchPlace" value="ค้นหา"><i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา
                        </a>
              </div>
            </div>
          </form>
          <hr />
          <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">
            <div class="row">
              <div class="col-xs-6 col-sm-5">
                ละติจูด
                <input class="form-control" name="lat_value" type="text" id="lat_value" value="0" size="20" readonly />
              </div>
              <div class="col-xs-6 col-sm-5">
                ลองจิจูด
                <input class="form-control" name="lon_value" type="text" id="lon_value" value="0" size="20" readonly />
              </div>
              <div class="col-xs-12 col-sm-2">
                <a href="#" class="btn btn-default btn-save" style="margin-top: 22px; width: 100%; color:#fff" name="button" id="button" onclick="select_location();" value="บันทึก"><i style='font-size:14px;' class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
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
            <p>
              <?php echo $str;?>
            </p>
            <!--<p>ยืนยันการลบ?</p>-->
        </div>
        <div class="modal-footer">
          <button id="dltbtnYes" type="button" class="btn btn-danger">ตกลง</button>
          <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
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
            <p>
              <?php echo $str;?>
            </p>
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
            <p>
              <?php echo $str;?>
            </p>
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
  <div id="myPrint" class="modal fade" role="dialog">
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
              <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" <?php if(!isset($tmp1['perm_status'])) { ?>
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
                <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" <?php if(!isset($tmp1['perm_status'])) { ?>
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
                  <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" <?php if(!isset($tmp1['perm_status'])) { ?>
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
                    <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;" <?php if(!isset($tmp1['perm_status'])) { ?>
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
