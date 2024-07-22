<?php
// set_session('pers_authen',array('authen_log_id'=>1,'pid'=>'1550700081881','cid'=>'k32kjk324j234','random_string'=>'3239663864316539316431313939353933356334663834636130396234353366')); //for Test
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
                          <li>
                            <?php
                              // dieFont($impv_place_info);
                              $tmp = $this->admin_model->getOnce_Application(37);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_inquire1/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php } ?>> (1) ข้อมูลผู้สูงอายุ
                              </a>
                          </li>
                          <li class="active">
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(38);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(38,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_agree2/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==38){?>aria-expanded="true" <?php }?>>(2) ยินยอม</a>
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

                                </div><!-- close panel-body tab-1-->
                            </div><!-- close tab-1-->

                            <div id="tab-2" <?php if($usrpm['app_id']==38){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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
                                                    $tmp = $this->admin_model->getOnce_Application(38);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(38,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>


                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(38);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(38,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('adaptenvir/ac_inquire1/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>


                                                  <?php
                                                  if($process_action=='Edit') {
                                                  ?>
                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(38);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(38,$user_id); //Check User Permission
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
                                    </div> close row tab-bar-->

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

                                    <div class="form-group row">
                                      <?php
                                      $impv_place_id = '';

                                      if($process_action=='Add')$process_action = 'Added';
                                      if($process_action=='Edit'){$process_action = 'Edited'; $impv_place_id = '/'.$impv_place_info['impv_place_id'];}

                                      echo form_open_multipart('adaptenvir/ac_agree2/'.$process_action.$impv_place_id,array('id'=>'form1'));
                                      ?>

                                      <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                      <input type="submit" value="submit" name="bt_submit" hidden="hidden">
                                      <div class="panel-group" style="margin-bottom: 0px;">
                                            <div class="panel panel-default" style="border: 0;">
                                              <div class="panel-heading">
                                                <h4><font >ข้อมูลผู้สูงอายุ</font></h4>
                                              </div>
                                              <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 5px;">
                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เลขประจำตัวประชาชน: </span><?php echo $impv_personal_info['pid'];?></div>
                                                  <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล: </span><?php echo $impv_personal_info['name'];?></div>
                                                  <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ: </span> <span id="gender_name"> <?php echo $impv_personal_info['gender_name'];?></span> </div>
                                                </div>
                                              </div>
                                            </div>
                                      </div>
                                      <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                      <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0">
                                                <div class="panel-heading"><h4>ข้อมูลผู้ยินยอม (เจ้าของสถานที่ผู้ให้ความยินยอมในการปรับปรุงสถานที่จัดกิจกรรม)</h4>  </div>
                                                <div class="panel-body" style="border:0; padding: 20px;">

                                                       <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-3"><img width="70%" src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto;"></div>
                                                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน</span> </div>
                                                            <div class="col-xs-12 col-sm-6 has-error" style="padding: 3px 15px;">
                                                                <div class="input-group" style="width: 295px;">
                                                                  <input  title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="pid" name="" value="<?php echo @$impv_place_info['pid'];?>" required/>
                                                                  <input type="hidden" id="pers_id" name="impv_place_info[cns_pers_id]" value="<?php echo @$impv_place_info['cns_pers_id'];?>">

                                                                 <div class="input-group-btn" style="padding-bottom: 5px;">
                                                                  <button type="button" title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_elder_pid" style="background-color:#F2DEDE;  border-radius: 0px; border-color: #ed5565;color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                              <!-- <button type="button" class="btn btn-default elder_same_req" title="กรณีไม่มีบัตร" style="">กรณีไม่มีบัตร</button> -->
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
                                                            <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"  id="name"><?php echo @$impv_place_info['name'];?> </div>

                                                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                                                            <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="date_of_birth"><?php echo @$impv_place_info['date_of_birth'];?> </div>

                                                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name"> <?php echo @$impv_place_info['gender_name'];?></span> </div>
                                                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"> <?php echo @$impv_place_info['nation_name_th'];?></span> </div>

                                                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ศาสนา</span> <span id="relg_title"><?php echo @$impv_place_info['relg_title'];?> </span> </div>
                                                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span></div>
                                                            <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="reg_addr"> <?php echo @$impv_place_info['reg_add_info'] ?> </div>
                                                            <input type="hidden" id="reg_addr_id" name="pers_info[reg_addr_id]" value="<?php echo $impv_place_info['reg_addr_id']; ?>">

                                                        </div><!-- close form-group row-->


                                                         <div class="form-group row">
                                                           <div class="col-xs-12 col-sm-3">
                                                                <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ทำหนังสือยินยอม </label>
                                                                <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                                    <input title="วันที่ทำหนังสือยินยอม" placeholder="เลือกวันที่" class="form-control" type="text" name="impv_place_info[date_of_consi]" required>
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                                <script type="text/javascript">
                                                                <?php
                                                                $tmp = explode('-',@$impv_place_info['date_of_consi']);
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
                                                            <div class="col-xs-12 col-sm-6">
                                                               <label>สถานะเป็น</label>
                                                               <select class="form-control" name="impv_place_info[cns_status]">
                                                                 <option value="">เลือกสถานะของผู้ยินยอม</option>
                                                                 <option value="เจ้าของบ้าน" <?php if($impv_place_info['cns_status'] == 'เจ้าของบ้าน'){ echo "selected";} ?>>เจ้าของบ้าน</option>
                                                                 <option value="สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน" <?php if($impv_place_info['cns_status'] == 'สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน'){ echo "selected";} ?>>สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน</option>
                                                               </select>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-3">
                                                               <label>เกี่ยวข้องเป็น</label>
                                                               <input type="text" class="form-control" name="impv_place_info[cns_relation]" value="<?php echo $impv_place_info['cns_relation']; ?>" placeholder="ระบุความสัมพันธ์กับผู้อายุ">
                                                            </div>
                                                         </div><!-- close form-group row-->

                                                         <!--<div class="form-group row"><div class="col-xs-12 col-sm-12"><br></div></div>-->
                                                         <div class="form-group row">
                                                              <div class="col-xs-12 col-sm-6"><label>ที่อยู่ (สถานที่จัดกิจกรรมที่ต้องการปรับปรุง) </label> ( <div class="checkbox-inline i-checks"><label><input type="checkbox" name="elder_addr_chk"> ตรงกับที่อยู่ตามทะเบียนบ้าน</label></div> )</div>
                                                              <script>


                                                                $("input[name='elder_addr_chk']").on('ifClicked',function(){
                                                                  if(!$(this).prop('checked')) {
                                                                    $(".elder_addr_pre").attr('disabled',true);
                                                                  }else {
                                                                    $(".elder_addr_pre").attr('disabled',false);
                                                                  }
                                                                });


                                                              </script>
                                                              <!-- <div class="col-xs-12 col-sm-6"><button type="button" class="btn btn-default"> <i class="fa fa-map-marker" aria-hidden="true"></i> ตำแหน่งพิกัดภูมิศาสตร์</button> <span>(102.5745382539, 97.394903489)</span></div> -->
                                                         </div><!-- close form-group row-->

                                                         <div class="form-group row">
                                                           <div class="col-xs-12 col-sm-6 dropdown">
                                                               <label for="example-text-input" class="col-2 col-form-label">หรือตัวแทนของข้าพเจ้าชื่อ (จะอยู่ร่วมมือตลอดระยะเวลาการปรับปรุง ฯ)</label>
                                                               <input title="ัวแทนของข้าพเจ้าชื่อ" placeholder="(คำนำหน้าชื่อ) ชื่อ-นามสกุล" class="form-control elder_addr_pre" name="impv_place_info[cns_delegate]" type="text" value="<?php echo $impv_place_info['cns_delegate'];?>" />
                                                           </div>
                                                           <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                                                        <input type="hidden" name="pre_addr_id" value="<?php echo @$pers_info['pre_addr_id']; ?>">
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
                                                               <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[tel_no_home]" value="<?php echo @$impv_place_info['tel_no_home'];?>"/>
                                                           </div>
                                                           <div class="col-xs-12 col-sm-3">
                                                               <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                                               <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="pers_info[tel_no_mobile]" value="<?php echo @$impv_place_info['tel_no_mobile'];?>"/>
                                                           </div>
                                                           <div class="col-xs-12 col-sm-3">
                                                               <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                                               <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[fax_no]" value="<?php echo @$impv_place_info['fax_no'];?>"/>
                                                           </div>
                                                           <div class="col-xs-12 col-sm-3">
                                                               <label for="" class="col-2 col-form-label">ที่อยู่อีเมล</label>
                                                               <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="pers_info[email_addr]" value="<?php echo @$impv_place_info['email_addr'];?>"/>
                                                           </div>
                                                         </div>

                                                </div><!-- close panel-body-->
                                          </div><!-- close panel-default-->
                                      </div><!-- close panel-group-->
                                      <?php echo form_close(); ?>
                                    </div><!-- close form-group row-->

                                                  <hr>
                                                                  <div class="row">
                                                                   <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                                                   <div class="col-xs-12 col-sm-2">
                                                                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-2">
                                                                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('adaptenvir/ac_inquire1/Edit/'.$impv_place_info['impv_place_id']);?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                                                    </div>
                                                                  </div><!-- close class row-->


                                  </div><!-- close panel-body tab-2-->
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==39){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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

  $("input[name='impv_palce_info[land_tenure]']").change(function(){
    if($(this).val() == 'ที่ดินเช่า'){
      $("#land_tenure_remark").prop('disabled', false ).focus();
    }else{
      $("#land_tenure_remark").val('');
      $("#land_tenure_remark").prop('disabled', true );
    }
  });

  $("input[name='impv_palce_info[staff_review]']").change(function(){
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
        if(ret[i].area_code == opSelect){
          $('#'+target).append($('<option>', {
            value: ret[i].area_code,
            selected: true,
            text : ret[i].area_name_th
          }));
        }else{
          $('#'+target).append($('<option>', {
            value: ret[i].area_code,
            text : ret[i].area_name_th
          }));
        }
      }
    })
    .fail(function() {
      console.log("error");
    });
  }
</script>

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
