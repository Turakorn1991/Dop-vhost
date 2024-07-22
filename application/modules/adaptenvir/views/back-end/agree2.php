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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                          <li >
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(30);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(30,$user_id); //Check User Permission
                            ?>

                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/inquire1/Edit/'.$impv_home_info['imp_home_id']);?>" <?php }?>  <?php if($usrpm['app_id']==30){?> aria-expanded="true" <?php }?>> (1) ข้อมูลผู้สูงอายุ
                              </a>
                          </li>
                          <li class="active">
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(31);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(31,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/agree2/Edit/'.$impv_home_info['imp_home_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==31){?> aria-expanded="true" <?php }?>>(2) ยินยอม</a>
                          </li>
                          <li>
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(32);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(32,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                  <?php //echo site_url('adaptenvir/assist3/Edit/'.$impv_home_info['imp_home_id']);?>
                                <?php }else if($process_action!='Add'){?> href="#" <?php }?> <?php if($usrpm['app_id']==32){?> aria-expanded="true" <?php }?>>(3) สงเคราะห์</a>
                          </li>
                      </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==30){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                </div><!-- close panel-body tab-1-->
                            </div><!-- close tab-1-->

                            <div id="tab-2" <?php if($usrpm['app_id']==31){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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
                                                    $tmp = $this->admin_model->getOnce_Application(31);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(31,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>


                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(31);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(31,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('adaptenvir/inquire1');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  <?php
                                                  if($process_action=='Edit') {
                                                  ?>
                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(31);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(31,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id=<?php echo $impv_home_info['imp_home_id'];?> onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
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
                                          $tmp = $this->admin_model->getOnce_Application(31);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(31,$user_id); //Check User Permission
                                        ?>
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                        <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?> onclick="return opnCnfrom()"
                                        <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> </a>
                                        -->

                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(31);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(31,$user_id); //Check User Permission
                                        ?>

                                        <!--
                                        <?php
                                         if($process_action=='Edit') {
                                          $tmp = $this->admin_model->getOnce_Application(31);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(31,$user_id); //Check User Permission
                                        ?>
                                        <a data-id=<?php echo $impv_home_info['imp_home_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
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
                                      $imp_home_id = '';

                                      if($process_action=='Add')$process_action = 'Added';
                                      if($process_action=='Edit'){$process_action = 'Edited'; $imp_home_id = '/'.$impv_home_info['imp_home_id'];}

                                      echo form_open_multipart('adaptenvir/agree2/'.$process_action.$imp_home_id,array('id'=>'form1'));
                                      ?>

                                      <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                      <input type="submit" value="submit" name="bt_submit" hidden="hidden">

                                      <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>
                                      <div class="panel-group" style="margin-bottom: 0px;">
                                            <div class="panel panel-default" style="border: 0;">
                                              <div class="panel-heading">
                                                <h4><font >ข้อมูลผู้สูงอายุ</font></h4>
                                              </div>
                                              <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 5px;">
                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เลขประจำตัวประชาชน: </span><?php echo $impv_personal_info['pid'];?></div>
                                                  <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล: </span><?php echo $req_prename['prename_th'].' '.$impv_personal_info['name'];?></div>
                                                  <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ: </span> <span id="gender_name"> <?php echo $impv_personal_info['gender_name'];?></span> </div>
                                                </div>
                                              </div>
                                            </div>
                                      </div>
                                      <div class="panel-group">
                                      <input type="hidden" name="currtoken" id="currtoken" value="<?php echo !empty($token_id) ? $token_id:''; ?>"/>
            
                                          <div class="panel panel-default" style="border: 0">
                                                <div class="panel-heading"><h4>ข้อมูลผู้ยินยอม (เจ้าของบ้านผู้ให้ความยินยอมในการปรับปรุงบ้านพักอาศัยของผู้สูงอายุ)</h4>  </div>
                                                <div class="panel-body" style="border:0; padding: 20px;">

                                                       <div class="form-group row">
                                                            
                                                            <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน</span> </div>
                                                            <div class="col-xs-12 col-sm-3 has-error" style="padding: 3px 15px;">
                                                              <?php //print_r($pers_info);exit();?>
                                                              <div class="input-group" style="width: 295px;">
                                                              <input  title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="req_pid"  name="impv_info[pid]" value="<?php echo $pers_info['pid'];?>" required/>
                                                              <input type="hidden" id="pers_id"  value="<?php echo $impv_personal_info['pers_id'];?>"> 
                                                              <input type="hidden" id="pid_id" name="impv_pid[pid]" value="<?php echo $pers_info['pid'];?>">
                                                        
                                                              <input type="hidden" id="cns_pers_id"  value="<?php echo $impv_personal_info['cns_pers_id'];?>"> 

                                                              <div class="input-group-btn" style="padding-bottom: 5px;">
                                                              <button type="button" onClick="bt_req_agree2()" title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_elder_pid"style="background-color:#F2DEDE; border-radius: 0px; border-color: #ed5565; color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                                                              </div><!--input-group-btn-->

                                                              </div><!--input-group-->
                                                            </div><!--col-xs-12 col-sm-6 has-error-->

                                                            <!-- /////////////////hidden///////////////// -->
                                                            <!-- <input type="text" id="pers_firstname_th" >
                                                            <input type="text" id="pers_lastname_th" >
                                                            <input type="text" id="date_of_birth" >
                                                            <input type="text" id="gender_code" >
                                                            <input type="text"  id="addr_home_no" >
                                                            <input type="text"  id="addr_moo" >
                                                            <input type="text"  id="addr_alley" >
                                                            <input type="text"  id="addr_lane" >
                                                            <input type="text"  id="addr_road">
                                                            <input type="text"  id="addr_province" >
                                                            <input type="text"  id="addr_district" >
                                                            <input type="text"  id="addr_sub_district" > -->

                                                            <!-- ///////////////////////////////////// -->

                                                            <div class="col-xs-12 col-sm-3 has-error" style="padding: 3px 15px;">                                                      
                                                              <button type="button" class="btn btn-default " onClick="cardAgree()" title="ดึงข้อมูลจากบัตร" style="background-color:#F2DEDE; order-radius: 0px; left: 1px; border-color: #ed5565; color: #ed5565;padding:5px 12px;">ดึงข้อมูลจากบัตร</button> 
                                                            </div>
                                                              <script>
                                                                // var elder_pers = null;
                                                                // var inputpid2 = "#pid";
                                                                // var bt_spid2 = "#bt_elder_pid";
                                                                // var setData2 = "reqData2"; //Declear Name
                                                                // var reqData2 = function(value) { //Set Structure Display Data
                                                                //   elder_pers = value;
                                                                //   $("#name").html(value.name);
                                                                //   $("#date_of_birth").html(value.date_of_birth);
                                                                //   $("#gender_name").html(value.gender_name);
                                                                //   $("#nation_name_th").html(value.nation_name_th);
                                                                //   $("#relg_title").html(value.relg_title);
                                                                //   $("#pers_id").val(value.pers_id);
                                                                //   $("#reg_addr_id").val(value.reg_addr_id);
                                                                //   $("#reg_addr").html(value.reg_add_info);
                                                                // }
                                                                // $(bt_spid2).click(function(){//On Click for Search
                                                                //   if($(inputpid2).val()!='') {//pid not null

                                                                //   $(bt_spid2).attr('disabled',true);

                                                                //     if(pers_authen!=null) { //Check Personal Authen
                                                                //       getPersInfo(inputpid2,bt_spid2,setData2); //Get Data
                                                                //     }else if(!reader_status) { //Run Reader Personal
                                                                //       run_readerPers();
                                                                //       $(bt_spid2).attr('disabled',false);
                                                                //       toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                                                                //     }

                                                                //   }else { //pid is null
                                                                //     $(inputpid2).select();
                                                                //   }
                                                                // });

                                                              </script>
                                                        </div><!--form-group row-->
                                                              <?php
                                                              //convert birth date to thai format
                                                              // $date = new DateTime(@$impv_home_info['date_of_birth']);
                                                              // $now = new DateTime();
                                                              // $interval = $now->diff($date);
                                                              // $age = $interval->y;
                                                              // $birth_date = formatDateThai(@$impv_home_info['date_of_birth']).' (อายุ '.$age.' ปี)';

                                                              if(@$impv_home_info['date_of_birth']!='' && checkdate(iconv_substr(@$impv_home_info['date_of_birth'],5,2,'utf-8'),iconv_substr(@$impv_home_info['date_of_birth'],8,2,'utf-8'),iconv_substr(@$impv_home_info['date_of_birth'],0,4,'utf-8'))) {
                                                              	$date = new DateTime(@$impv_home_info['date_of_birth']);
                                                              	$now = new DateTime();
                                                              	$interval = $now->diff($date);
                                                              	$age = $interval->y;
                                                              	$birth_date = formatDateThai(@$impv_home_info['date_of_birth']).' (อายุ '.$age.' ปี)';
                                                                }
                                                                else if(@$impv_home_info['date_of_birth']!='' && iconv_substr(@$impv_home_info['date_of_birth'],5,2,'utf-8')!= ''){
                                                              	$birthdate = iconv_substr(@$impv_home_info['date_of_birth'],0,4,'utf-8')+543; 
                                                              	$date = new DateTime(@$impv_home_info['date_of_birth']);
                                                              	$now = new DateTime();
                                                              	$interval = $now->diff($date);
                                                              	$age = $interval->y;
                                                              	$birth_date = "วัน - เดือน - พ.ศ. ".$birthdate." (อายุ ".$age." ปี)";
                                                              }
                                                                else {
                                                              	  $birth_date = ' - ';
                                                                }
                                                              ?>


                                                              <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                                                                <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"  id="name"><?php echo $prename2['prename_th'].' '.$impv_home_info['name'];?> </div>
                                                                <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                                                                <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;" id="date_of_birth_text"> <?php echo $birth_date ?> </div>
                                                              </div>
                                                              
                                                              <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name_th"> <?php echo @$impv_home_info['gender_name'];?></span> </div>
                                                                <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"> <?php echo @$impv_home_info['nation_name_th'];?></span> </div>
                                                                <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span>
                                                                <span id="reg_addr"> <?php echo @$impv_home_info['reg_add_info'] ?></span> </div>
                                                                <input type="hidden" id="reg_addr_id" name="pers_info[reg_addr_id]" value="<?php echo $impv_home_info['reg_add_info']; ?>">
                                                              </div>
                                                              <input type="hidden" id="pren_code" name="impv_info[pren_code]" value="<?php echo $req_agree2['pren_code'];?>">
                                                              <input type="hidden" id="pren_name" name="impv_info[pren_name]" value="<?php echo $prename2['prename_th'];?>">
                                                  
                                                              <input type="hidden" id="pers_firstname_th" name="impv_info[pers_firstname_th]" value="<?php echo $impv_home_info['pers_firstname_th'];?>">
                                                              <input type="hidden" id="pers_lastname_th" name="impv_info[pers_lastname_th]" value="<?php echo $impv_home_info['pers_lastname_th'];?>">
                                                              <input type="hidden" id="date_of_birth" name="impv_info[date_of_birth]" value="<?php echo $impv_home_info['date_of_birth'];?>">
                                                              <input type="hidden" id="gender_code" name="impv_info[gender_code]" value="<?php echo $impv_home_info['gender_code'];?>">

                                                              <input type="hidden"  name="impv_addr[addr_home_no]" value="<?php echo $reg_addr[0]['addr_home_no'];?>">
                                                              <input type="hidden"  name="impv_addr[addr_moo]" value="<?php echo $reg_addr[0]['addr_moo'];?>">
                                                              <input type="hidden"  name="impv_addr[addr_alley]" value="<?php echo $reg_addr[0]['addr_alley'];?>">
                                                              <input type="hidden"  name="impv_addr[addr_lane]" value="<?php echo $reg_addr[0]['addr_lane'];?>">
                                                              <input type="hidden"  name="impv_addr[addr_road]" value="<?php echo $reg_addr[0]['addr_road'];?>">
                                                              <input type="hidden"  name="impv_addr[addr_province]" value="<?php echo $reg_addr[0]['addr_province'];?>">
                                                              <input type="hidden"  name="impv_addr[addr_district]" value="<?php echo $reg_addr[0]['addr_district'];?>">
                                                              <input type="hidden"  name="impv_addr[addr_sub_district]" value="<?php echo $reg_addr[0]['addr_sub_district'];?>"> 

                                                              <input type="hidden" id="addr_province" name="pers_addr[addr_province]" value="<?php echo $addr_info['province_code'];?>">
                                                              <input type="hidden" id="addr_district" name="pers_addr[addr_district]" value="<?php echo $addr_info['district_code'];?>">
                                                              <input type="hidden" id="addr_sub_district" name="pers_addr[addr_sub_district]" value="<?php echo $addr_info['sub_district_code'];?>"> 
                                                                                                                
                                                              <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ทำหนังสือยินยอม </label>
                                                                <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                                <input title="วันที่ทำหนังสือยินยอม" placeholder="เลือกวันที่" class="form-control" type="text" name="impv_home_info[date_of_consi]" required />
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div><!--datetimepicker1-->
                                                                <script type="text/javascript">
                                                                <?php
                                                                $tmp = explode('-',@$impv_home_info['date_of_consi']);
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
                                                              </div><!--col-xs-12 col-sm-3-->
                                                              <div class="col-xs-12 col-sm-3">
                                                                      <label>สถานะเป็น</label>
                                                                      <select class="form-control" name="impv_home_info[cns_status]" id="cns_status">
                                                                      <option value="">เลือกสถานะของผู้ยินยอม</option>
                                                                      <option value="เจ้าของบ้าน" <?php if($impv_home_info['cns_status'] == 'เจ้าของบ้าน'){ echo "selected";} ?>>เจ้าของบ้าน</option>
                                                                      <option value="สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน" <?php if($impv_home_info['cns_status'] == 'สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน'){ echo "selected";} ?>>สมาชิกในครอบครัวที่ได้รับมอบหมายจากเจ้าของบ้าน</option>
                                                                      <option value="อื่นๆ" <?php if($impv_home_info['other_cns_status'] == 'อื่นๆ'){ echo "selected";} ?>>อื่นๆ</option>
                                                                      </select>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-3">
                                                                      <label class="col-2 col-form-label">สถานะอื่นๆ</label>
                                                                      <input id="other_cns_status" title="ระบุ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text"  name="impv_home_info[other_cns_status]" value="<?php echo $impv_home_info['other_cns_status']; ?>" <?php if($impv_home_info['other_cns_status'] == "") { echo "disabled";} ?> />
                                                               </div>
                                                               <script type="text/javascript">
                                                                          $("#cns_status").change(function () {
                                                                            if($(this).val() == "อื่นๆ"){
                                                                              $("#other_cns_status").prop('disabled', false ).focus();
                                                                            }else{
                                                                              $("#other_cns_status").val('');
                                                                              $("#other_cns_status").prop('disabled', true );
                                                                            }
                                                                          });
                                                                                              

                                                                </script>
                                                               <div class="col-xs-12 col-sm-3">
                                                                      <label>เกี่ยวข้องเป็น</label>
                                                                      <input type="text" class="form-control" name="impv_home_info[cns_relation]" onkeyup="thvalidate(this)" value="<?php echo $impv_home_info['cns_relation']; ?>" placeholder="ระบุความสัมพันธ์กับผู้อายุ">
                                                              </div><!--col-xs-12 col-sm-3-->
                                                              </div><!-- close form-group row-->

                                                              <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-6"><label>ที่อยู่ (บ้านพักอาศัยของผู้สูงอายุที่ต้องการปรับปรุง) </label> ( <div class="checkbox-inline i-checks"><label><input type="checkbox" name="elder_addr_chk" id="elder_addr_chk"> ตรงกับที่อยู่ตามทะเบียนบ้าน</label></div> )</div>
                                                                <script>

                                                                  $("input[name='elder_addr_chk']").on('ifClicked',function(){
                                                                    if(!$(this).prop('checked')) {
                                                                      $(".elder_addr_pre").attr('disabled',true);
                                                                    }else {
                                                                      $(".elder_addr_pre").attr('disabled',false);
                                                                    }
                                                                  });

                                                                  <?php
                                                                  // $reg_addr[0]['addr_home_no']
                                                                  //addr_info
                                                                  //if(($impv_home_info['reg_addr_id']==$impv_home_info['pre_addr_id']) && ($impv_home_info['reg_addr_id']!=''&&$impv_home_info['pre_addr_id']!='')) {
                                                                  ?>
                                                                  <?php if( $reg_addr[0]['addr_home_no'] == $addr_info['addr_home_no'] 
                                                                  && $reg_addr[0]['addr_moo'] == $addr_info['addr_moo'] 
                                                                  && $reg_addr[0]['addr_home_no']!= "" 
                                                                  ) { ?>
                                                     
                                                                      $("input[name='elder_addr_chk']").parent().addClass('checked');
                                                                      $("input[name='elder_addr_chk']").prop('checked',true);
                                                                      $(".elder_addr_pre").attr('disabled',true);

                                                                  <?php } ?>
                                                                </script>
                                                              </div><!-- close form-group row-->

                                                              <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-6 dropdown">
                                                                <label for="example-text-input" class="col-2 col-form-label">หรือตัวแทนของข้าพเจ้าชื่อ (จะอยู่ร่วมมือตลอดระยะเวลาการปรับปรุง ฯ)</label>
                                                                <input title="ตัวแทนของข้าพเจ้าชื่อ" placeholder="(คำนำหน้าชื่อ) ชื่อ-นามสกุล" class="form-control" name="impv_home_info[cns_delegate]" value="<?php echo @$impv_home_info['cns_delegate'];?>" type="text"/>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                                                                <input type="hidden" name="pre_addr_id" value="<?php echo @$pers_info['pre_addr_id']; ?>">
                                                                <input type="hidden" name="addr_home_id" value="<?php echo @$addr_info['addr_home_no']; ?>">
                                                                <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text" id="addr_home_no" name="pers_addr[addr_home_no]" value="<?php echo @$addr_info['addr_home_no']; ?>" />
                                                                </div>
                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="" class="col-2 col-form-label">หมู่ที่</label>
                                                                <input type="hidden" name="addr_moo_id" value="<?php echo @$pers_info['addr_moo']; ?>">
                                                                <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_moo]" id="addr_moo"  value="<?php echo @$addr_info['addr_moo']; ?>"/>
                                                                </div>
                                                              </div><!-- close form-group row-->
                                                              
                                                              <div class="form-group row">

                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                                <input title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_alley]" value="<?php echo @$addr_info['addr_alley']; ?>"/>
                                                                </div>

                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                                                                <input title="ซอย" placeholder="ตัวอย่าง วงพงษ์" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_lane]" value="<?php echo @$addr_info['addr_lane']; ?>"/>
                                                                </div>

                                                                <div class="col-xs-12 col-sm-6">
                                                                <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                                                                <input title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_road]" value="<?php echo @$addr_info['addr_road']; ?>"/>
                                                                </div>
                                                              </div><!-- close form-group row-->

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
                                                                </div><!--col-10-->
                                                                </div><!--col-xs-12 col-sm-3 dropdown-->

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
                                                                </div><!--col-10-->
                                                                </div><!--col-xs-12 col-sm-3 dropdown-->
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
                                                                </div><!--col-10-->
                                                                </div><!--col-xs-12 col-sm-3 dropdown-->
                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                                                                <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" type="text" maxlength="5" onkeyup="numbervalid(this)" name="pers_addr[addr_zipcode]" value="<?php echo @$addr_info['addr_zipcode']; ?>"/>
                                                                </div><!--col-xs-12 col-sm-3-->
                                                              </div><!-- close form-group row-->
                                                              
                                                              <div class="form-group row">
                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                                                                <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[tel_no_home]" value="<?php echo @$pers_info['tel_no_home'];?>"/>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                                                <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" maxlength="10" class="form-control" maxlength="10" onkeyup="numbervalid(this)" type="text" name="pers_info[tel_no]" value="<?php echo @$pers_info['tel_no'];?>"/>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-3">
                                                                <label for="" class="col-2 col-form-label">ที่อยู่อีเมล</label>
                                                                <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="pers_info[email_addr]" value="<?php echo @$pers_info['email_addr'];?>"/>
                                                                </div>
                                                              </div><!-- close form-group row-->

                                                        </div><!--form-group-->
                                                    
                                                        

                                                </div><!-- close panel-body-->
                                          </div><!-- close panel-default-->
                                      </div><!-- close panel-group-->



                                      <?php echo form_close(); ?>
                                    </div><!-- close form-group row-->



                                    <hr style="margin-top: 0px;">
                                      <div class="row">
                                      <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                      <div class="col-xs-12 col-sm-2">
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                      </div>
                                      <div class="col-xs-12 col-sm-2">
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('adaptenvir/inquire1/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                      </div>
                                      </div><!-- close class row-->

                                  </div><!-- close panel-body tab-2-->
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

  $("input[name='impv_home_info[land_tenure]']").change(function(){
    if($(this).val() == 'ที่ดินเช่า'){
      $("#land_tenure_remark").prop('disabled', false ).focus();
    }else{
      $("#land_tenure_remark").val('');
      $("#land_tenure_remark").prop('disabled', true );
    }
  });

  $("input[name='impv_home_info[staff_review]']").change(function(){
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


 <script>

function cardAgree(){
    showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');
    $.ajax({  
                    type: 'GET',
                    crossDomain: true,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    // data: param_service,
                    url: 'http://localhost:9000/api/Values',
                    success: function(data_service) {
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
  
                          // var houseNo = data.addrVillageNo.replace("หมู่ที่ ","");
                          $('#req_pid').val(res1+'-'+res2+'-'+res3+'-'+res4+'-'+res5);
                          // $('#pers_id').val(varCard);
                          $('#pid_id').val(varCard);
                          $('#name').html(data.Th_Firstname+' '+data.Th_Lastname);
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

                              $('#date_of_birth_text').html(data); 
                              
                            },
                            dataType: "json",
                          });
                                     
                          if(data.Sex =='0'){
                            $('#gender_name_th').html("ไม่ทราบ");
                          }else if(data.Sex =='1'){
                            $('#gender_name_th').html("ชาย");
                          }else if(data.Sex =='2'){
                            $('#gender_name_th').html("หญิง");
                          }else if(data.Sex =='9'){
                            $('#gender_name_th').html("ไม่สามารถระบุได้");
                          }else{
                            $('#gender_name_th').html("-");
                          } 
                                      
                          $('#reg_addr').html(data.Address);
                                                
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


function bt_req_agree2(){
   // alert('ddd');
    var pid_id = $('#req_pid').val();
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
                      //  console.log(data_token)                       
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

                                    $('#date_of_birth_text').html(data); 
                                    
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

                                $('#name').html(data.titleName+' '+data.firstName+' '+data.lastName);                              
                               // $('#date_of_birth_text').html(data.dateOfBirth);
                                $('#gender_name_th').html(data.genderDesc);            
                                $('#pers_firstname_th').val(data.firstName);
                                $('#pers_lastname_th').val(data.lastName);
                                $('#gender_code').val(data.genderCode);
                                $('#date_of_birth').val(varBirthday);   
                                   
                                $.ajax({
                                  type: "POST",
                                  url: base_url+"/adaptenvir/getAddress/",
                                  // data: {req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                                  data: { req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                                  success: function(dataAdderss){
                                   // console.log('>>>>>>>>',dataAdderss)
                                  
                                   var addressname = dataAdderss.houseNo +' หมู่ที่ '+dataAdderss.villageNo +' '+' ตำบล'+dataAdderss.subdistrictDesc +' '+' อำเภอ'+dataAdderss.districtDesc +' '+' จังหวัด'+dataAdderss.provinceDesc;
                                  $('#reg_addr').html(addressname);
                                     ////////////////////////////////
                                  //var mooNo = dataAdderss.villageNo.replace("หมู่ที่ ","");
                                  //console.log('>>>>>>>>',dataAdderss)
                                  
                                  $('input[name="impv_addr[addr_moo]"]').val(dataAdderss.villageNo);
                                  // //$('#date_of_birth').val((bd1-543)+'-'+bd2+'-'+bd3);                      
                                  // $('#addrProvince').attr(data.addrProvince);
                                  // $('#addrAmphur').attr(data.addrAmphur);
                                  // $('#addrTambol').attr(data.addrTambol);
                                  $('input[name="impv_addr[addr_home_no]"]').val(dataAdderss.houseNo);
                                 // $('input[name="impv_addr[addr_moo]"]').val(houseNo);
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
                                      closeloadswal();					
                                      $('input[name="impv_addr[addr_province]"]').val(dataArea.province_code);		
                                      $('input[name="impv_addr[addr_district]"]').val(dataArea.amphur_code);
                                      $('input[name="impv_addr[addr_sub_district]"]').val(dataArea.tambol_code);		
                                      
                                    },
                                    dataType: "json",
                                  });

                               
                                //////////////////////////////

                                   
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
                      
                        // $.ajax({
                        //   type: "POST",
                        //   url: "http://202.170.120.162:81/center/adaptenvir/getDataPid/",
                        //   data: { req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
                        //   success: function(data){
                        //    // console.log($('#req_pid').val())
                        //     if ($('#req_pid').val() == "_-____-_____-__-_" || $('#req_pid').val() == "") { 
                              
                        //       toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");   
                            
                        //     }else { 

                        //       if ($('#name').val() == "" || $('#name').val() == "undefined"  ) { 
                        //         toastr.error("ไม่พบข้อมูล", "หน้าต่างแจ้งเตือน");  
                        //       }else{
                                                           
                        //         $('#name').html(data.firstName+' '+data.lastName);                              
                        //         $('#date_of_birth_text').html(data.dateOfBirth);
                        //         $('#gender_name').html(data.genderDesc);            
                        //         $('#pers_firstname_th').val(data.firstName);
                        //         $('#pers_lastname_th').val(data.lastName);
                        //         $('#gender_code').val(data.genderCode);
                        //         $('#date_of_birth').val('');      
                                
                        //         $.ajax({
                        //           type: "POST",
                        //           url: "http://202.170.120.162:81/center/adaptenvir/getAddress/",
                        //           data: {req_pid : $('#req_pid').val(),csrf_dop : csrf_hash},
                        //           success: function(dataAdderss){
                        //           var addressname = dataAdderss.houseNo +' หมู่ที่ '+dataAdderss.villageNo +' '+' ตำบล'+dataAdderss.subdistrictDesc +' '+' อำเภอ'+dataAdderss.districtDesc +' '+' จังหวัด'+dataAdderss.provinceDesc;
                        //             $('#reg_addr').html(addressname);
                                   
                        //           },
                        //           dataType: "json",
                        //         });  
                        //       }
                                                              
                            
                        //     }  
                           
                        //   },
                        //   error: function(err) {
                        //     toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");
                          
                        //   }
                        // });
                                              

                    },
                    error: function(err) {
                      //var text = 'ไม่พบข้อมูล';
                      //token
                      closeloadswal();
                      toastr.error("ไม่พบข้อมูล", "หน้าต่างแจ้งเตือน");
                     
                    }
    });
  
}
</script>

<script src="https://center.dop.go.th/assets/js/loading_popup.js"></script>