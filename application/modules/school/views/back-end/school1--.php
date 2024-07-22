
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(59);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/school1/Edit/'.$schl_info['schl_id']);?>" <?php }?>  data-toggle="tab" <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) โรงเรียน</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(60);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(60,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/photo2/Edit/'.$schl_info['schl_id']);?>" <?php }?>  <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(61);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(61,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/generation3/Edit/'.$schl_info['schl_id']);?>" <?php }?>  <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==59){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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
                                                  <?php }else{?> href="<?php echo site_url('school/school_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
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
                                             if($process_action=='Edit') {

                                            ?>
                                            <a data-toggle="modal" data-target="#myPrint" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"

                                             title="พิมพ์แบบฟอร์ม">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </a>
                                            <?php }?>

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(59);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                                            ?>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()"
                                            <?php }?> title="บันทึก <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            </a>
                                             -->

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(58);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(58,$user_id); //Check User Permission
                                            ?>

                                            <!--
                                            <?php
                                              if($process_action=='Edit') {
                                              $tmp = $this->admin_model->getOnce_Application(59);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                                            ?>
                                            <a data-id=<?php echo $schl_info['schl_id']; ?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
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
                                            <div class="panel-group family_members_items" style="margin-top: -10px;">
                                              <div class="panel panel-default" style="border: 0">
                                                <div class="panel-heading clear-fix" style="background-color: initial;">
                                                </div>
                                                  <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                    <div class="row text-right">

                                                    <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this,'')" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <label for="" class="col-2 col-form-label">ผู้ประสานงาน</label>
                                                            <input title="ผู้ประสานงาน" placeholder="(คำนำหน้า) ชื่อ-นามสกุล" name="schl_contacts[sch_cnt_name][myID]" class="form-control" type="text"/>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-3 ">
                                                            <label for="example-text-input" class="col-2 col-form-label">ตำแหน่ง</label>
                                                            <input title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" name="schl_contacts[sch_cnt_title][myID]" class="form-control" type="text"/>

                                                        </div>

                                                        <div class="col-xs-12 col-sm-3">
                                                            <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                                            <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXX" name="schl_contacts[tel_no_mobile][myID]" class="form-control" type="text"/>
                                                        </div>
                                                      </div>

                                                  </div>
                                              </div>
                                            </div>
                                          </div><!-- close family_members_template-->

                                    <div class="form-group row">

                                    <?php
                                    $schl_id = '';

                                    if($process_action=='Add'){$process_action = 'Added';}

                                    if($process_action=='Edit'){$process_action = 'Edited'; @$schl_id = '/'.$schl_info['schl_id'];}

                                    echo form_open_multipart('school/school1/'.$process_action.$schl_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>ข้อมูลโรงเรียนผู้สูงอายุ</h4>
                                              </div>

                                              <div class="panel-body" style="border:0; padding: 20px;">

                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-9 has-error">
                                                      <label for="" class="col-2 col-form-label" style="color: red;">ชื่อโรงเรียนxxx </label>
                                                      <input type="text" class="form-control" name="schl_info[schl_name]" title="ชื่อโรงเรียน" value="<?php echo $schl_info['schl_name']; ?>" placeholder="ระบุชื่อโรงเรียน" required>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-3">
                                                      <label for="datetimepicker1" class="col-2 col-form-label">ปีที่เริ่มดำเนินการ (ปี พ.ศ. ที่ก่อตั้ง)</label>
                                                      <br>
                                                      <select  style="width: 25%; padding: 4px 12px;" name="schl_info[date_of_established]">
                                                              <option>วันที่</option>
                                                          <?php
                                                              for($day=1;$day<=31;$day++){
                                                                   $day_two = $day;
                                                                  if($day<10){
                                                                    $day_two = "0".$day;
                                                                  }
                                                          ?>

                                                              <option value="<?php echo $day_two; ?>" <?php if($schl_info['date_of_established']==$day_two){ echo "selected"; }?> ><?php echo $day; ?></option>
                                                          <?php }?>
                                                      </select>
                                                      <?php $mount = array('01'=>'มกราคม','02'=>'กุมภาพันธ์','03'=>'มีนาคม','04'=>'เมษายน','05'=>'พฤษภาคม','06'=>'มิถุนายน','07'=>'กรกฎาคม','08'=>'สิงหาคม','09'=>'กันยายน','10'=>'ตุลาคม','11'=>'พฤศจิกายน','12'=>'ธันวาคม');?>
                                                      <select  style="width: 40%; padding: 4px 12px;" name="schl_info[month_of_established]">
                                                              <option>เดือน</option>
                                                          <?php foreach($mount as $key=>$value){ ?>
                                                              <option value="<?php echo $key; ?>" <?php if($schl_info['month_of_established']==$key){ echo "selected"; }?> ><?php echo $value; ?></option>
                                                          <?php } ?>
                                                      </select>
                                                      <select  style="width: 30%; padding: 4px 12px;" name="schl_info[year_of_established]">
                                                              <option>ปี</option>
                                                          <?php for($year = date("Y")-100;$year<=date("Y");$year++){ ?>
                                                              <option value="<?php echo $year; ?> " <?php if($schl_info['year_of_established']==$year){ echo "selected"; }?> ><?php echo $year+543; ?></option>
                                                          <?php } ?>
                                                      </select>
                                                  </div>
                                                </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3">
                                                     <?php
                                                            $addr_gps = @$schl_info['addr_gps']; // Old Data $diff_info['addr_gps']

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
                                                              <input type="hidden" name="schl_info[addr_gps]" value="<?php echo $addr_gps;?>" id="addr_gps">
                                                              <span id="addr_gpg_txt"><?php if($addr_gps!='0,0') { echo '('.$addr_gps.')';}?></span>

                                                     </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">สังกัด ศพอส.</label>
                                                        <select title="ศพอส." placeholder="เลือก ศพอส." class="form-control elder_addr_pre" id="qlc_id" name="schl_info[qlc_id]">
                                                            <option value="">เลือก ศพอส.</option>
                                                            <?php $temp = $this->common_model->custom_query("select * from qlc_info where delete_datetime IS NULL");
                                                              foreach ($temp as $key => $row) { ?>
                                                              <option value="<?php echo $row['qlc_id'];?>"> <?php echo $row['qlc_name']; ?></option>
                                                            <?php  } ?>
                                                        </select>
                                                        <script>
                                                        <?php if($schl_info['qlc_id']!=0) {?>
                                                        $('#qlc_id').val(<?php echo $schl_info['qlc_id'];?>).trigger('change');
                                                        <?php
                                                        }
                                                        ?>
                                                        </script>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                                                        <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" name="schl_info[addr_home_no]" value="<?php //echo $schl_info['addr_home_no']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">หมู่ที่</label>
                                                         <input title="หมู่ที่" placeholder="" name="schl_info[addr_moo]" value="<?php echo $schl_info['addr_moo']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                  </div>

                                               <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                        <div class="col-10">
                                                           <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="schl_info[addr_alley]" value="<?php echo @$schl_info['addr_alley']; ?>" />
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                      <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                                                      <div class="col-10">
                                                        <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" type="text" name="schl_info[addr_lane]" value="<?php echo @$schl_info['addr_lane']; ?>" />
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 dropdown">
                                                      <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                                                      <div class="col-10">
                                                        <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="schl_info[addr_road]" value="<?php echo @$schl_info['addr_road']; ?>" />
                                                      </div>
                                                    </div>
                                                  </div>


                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                                                        <div class="col-10">
                                                        <select title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="schl_info[addr_province]" onchange="optionGen(this,'Amphur',<?php echo @$schl_info['addr_district']; ?>);">
                                                            <option value="">เลือกจังหวัด</option>
                                                            <?php $temp = $this->personal_model->getAll_Province();
                                                              foreach ($temp as $key => $row) { ?>
                                                              <option value="<?php echo $row['area_code']; ?>"> <?php echo $row['area_name_th']; ?></option>
                                                            <?php  } ?>
                                                        </select>
                                                      </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                                                        <div class="col-10">
                                                          <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="schl_info[addr_district]" onchange="optionGen(this,'Tambon',<?php echo @$schl_info['addr_sub_district']; ?>);" disabled> <!--this.value-->
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
                                                        <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon" name="schl_info[addr_sub_district]" disabled>
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
                                                        <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" name="schl_info[addr_zipcode]" value="<?php echo $schl_info['addr_zipcode']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">

                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (โรงเรียน)</label>
                                                        <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="schl_info[tel_no]" value="<?php echo $schl_info['tel_no'];?>"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                                        <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="schl_info[fax_no]" value="<?php echo $schl_info['fax_no'];?>"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">ที่อยู่อีเมล</label>
                                                        <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="schl_info[email_addr]" value="<?php echo $schl_info['email_addr'];?>"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">หน่วยงานดูแล</label>
                                                        <input title="หน่วยงานดูแล" placeholder="ระบุชื่อหน่วยงานที่ดูแลโรงเรียน" class="form-control" type="text" name="schl_info[agency_org]" value="<?php //echo $schl_info['agency_org'];?>"/>
                                                    </div>

                                                  </div>




                                          <div class="form-group row">
                                             <div class="col-xs-12 col-sm-12">
                                                  <label>ผู้ประสานงานของโรงเรียนผู้สูงอายุ (จำนวน <span id="nums_family_members">0</span> คน)</label>
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                                  <div class="family_members" >
                                                       <?php if(($process_action!='Add')&&($process_action!='Added')){

                                                        $i=0;

                                                        foreach($schl_contacts as $key_contacts => $value_contacts){ ?>

                                                          <input type="hidden" name="update_contacts[<?php echo $i; ?>]" value="<?php echo $value_contacts['sch_cnt_id']; ?>">

                                                          <!--<div class="family_members_template" >-->
                                                              <div class="panel-group family_members_items" style="margin-top: -10px;">
                                                                <div class="panel panel-default" style="border: 0">
                                                                  <div class="panel-heading clear-fix" style="background-color: initial;">
                                                                  </div>
                                                                    <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                                      <div class="row text-right">

                                                                      <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this,<?php echo $value_contacts['sch_cnt_id']; ?>)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                                                      </div>

                                                                      <div class="form-group row">
                                                                          <div class="col-xs-12 col-sm-6">
                                                                              <label for="" class="col-2 col-form-label">ผู้ประสานงาน</label>
                                                                              <input title="ผู้ประสานงาน" placeholder="(คำนำหน้า) ชื่อ-นามสกุล" name="schl_contacts[sch_cnt_name][<?php echo $i; ?>]" value="<?php echo $value_contacts['sch_cnt_name']; ?>" class="form-control" type="text"/>
                                                                          </div>
                                                                          <div class="col-xs-12 col-sm-3 ">
                                                                              <label for="example-text-input" class="col-2 col-form-label">ตำแหน่ง</label>
                                                                              <input title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" name="schl_contacts[sch_cnt_title][<?php echo $i; ?>]" value="<?php echo $value_contacts['sch_cnt_title']; ?>" class="form-control" type="text"/>

                                                                          </div>

                                                                          <div class="col-xs-12 col-sm-3">
                                                                              <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                                                              <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXX" name="schl_contacts[tel_no_mobile][<?php echo $i; ?>]" value="<?php echo $value_contacts['tel_no_mobile']; ?>" class="form-control" type="text"/>
                                                                          </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                              </div>
                                                            <!--</div> close family_members_template-->

                                                      <?php
                                                        $i++;
                                                       }//close loop foreach($schl_contacts as $key_contacts => $value_contacts)
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
                                                        }// //close loop if(($process_action!='Add')&&($process_action!='Added'))
                                                      ?>

                                                  </div><!-- close family_members-->


                                                 <div class="col-xs-12 col-sm-12">
                                                      <button type="button" class="btn btn-default" id="btAdd_family_members"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                 </div>

                                                   <script>
                                                    //var nummf = 0;
                                                    function btDel_family_members(node,contacts_id) {

                                                          if(contacts_id!=""){
                                                             $.ajax({
                                                                  url: base_url+'school/del_schl_contacts',
                                                                  type: 'POST',
                                                                  dataType: 'html',
                                                                  data: {
                                                                  'contacts_id': contacts_id,
                                                                  <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                                                  },
                                                                 success: function(result){
                                                                   $(node).parent().parent().parent().parent().remove();
                                                                   $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                                 },
                                                                 error: function(){
                                                                  alert('ไม่สามารถลบผู้ประสานงานของโรงเรียนผู้สูงอายุได้ กรุณาลองใหม่');}
                                                              });
                                                           }else{

                                                                 $(node).parent().parent().parent().parent().remove();
                                                                 $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                           }
                                                         }

                                                  </script>

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

                                                      <div class="form-group row">
                                                      <!-- panel group โรงเรียนต้นแบบ -->
                                                      <div class="panel-group">
                                                            <div class="panel panel-default" style="border: 0">

                                                                <div class="panel-body" style="border:0; padding: 20px;">
                                                                       <div class="form-group row">
                                                                        <div class="col-xs-12 col-sm-12"><label>เป็นโรงเรียนต้นแบบ โดยมีคุณสมบัติ ดังนี้</label>
                                                                          <i id="star1" class="fa fa-star-o" aria-hidden="true" style="font-size: 16px;"></i>
                                                                          <i id="star2" class="fa fa-star-o" aria-hidden="true" style="font-size: 16px;"></i>
                                                                          <i id="star3" class="fa fa-star-o" aria-hidden="true" style="font-size: 16px;"></i>
                                                                          <i id="star4" class="fa fa-star-o" aria-hidden="true" style="font-size: 16px;"></i>
                                                                        </div>

                                                                        </div>

                                                                        <?php

                                                                        foreach($std_model as $key_model =>$val_model){

                                                                           if($process_action == 'Edited'){//ส่วนของการแก้ไขคุณสมบัติโรงเรียน
                                                                                $status_edit = false;
                                                                                $val_remark = '';
                                                                                foreach ($edit_model as $key_edit => $val_edit) {
                                                                                    if($val_edit['mdl_code']==$val_model['mdl_code']){
                                                                                          $status_edit = true;
                                                                                          $val_remark  = $val_edit['mdl_remark'];
                                                                                          break;
                                                                                      }// close loop if($val_edit['mdl_code']==$val_model['mdl_code'])
                                                                                 }//close loop foreach ($edit_model as $key_edit => $val_edit)

                                                                                      if($status_edit==true){
                                                                                  ?>
                                                                                        <div class="form-group row" >
                                                                                             <div class="col-xs-12 col-sm-6" id="std_model"><div class="checkbox-inline i-checks"><input  type="checkbox" name="std_model[]" value="<?php echo $val_model['mdl_code'];?>" onclick="checkbox_model(this)" checked>  <?php echo $val_model['mdl_title']; ?></div></div>
                                                                                             <div class="col-xs-12 col-sm-6" ><input  type="text" class="form-control" placeholder="ความคิดเห็นเจ้าหน้าที่" name="mdl_remark[]"  value="<?php echo $val_remark; ?>"></div>
                                                                                         </div>
                                                                                     <?php }else{ ?>
                                                                                          <div class="form-group row" >
                                                                                             <div class="col-xs-12 col-sm-6" id="std_model"><div class="checkbox-inline i-checks"><input  type="checkbox" name="std_model[]" value="<?php echo $val_model['mdl_code'];?>" onclick="checkbox_model(this)" >  <?php echo $val_model['mdl_title']; ?></div></div>
                                                                                             <div class="col-xs-12 col-sm-6" ><input  type="text" class="form-control" placeholder="ความคิดเห็นเจ้าหน้าที่" name="mdl_remark[]"  disabled></div>
                                                                                         </div>
                                                                                     <?php } ?>

                                                                           <?php }else{ //ส่วนของการเพิ่มคุณสมบัติของโรงเรียน ?>
                                                                                    <div class="form-group row" >
                                                                                        <div class="col-xs-12 col-sm-6" id="std_model"><div class="checkbox-inline i-checks"><input  type="checkbox" name="std_model[]" value="<?php echo $val_model['mdl_code'];?>" onclick="checkbox_model(this)" >  <?php echo $val_model['mdl_title']; ?></div></div>
                                                                                        <div class="col-xs-12 col-sm-6" ><input  type="text" class="form-control" placeholder="ความคิดเห็นเจ้าหน้าที่" name="mdl_remark[]" disabled></div>
                                                                                    </div>

                                                                           <?php  }?>

                                                                        <?php }//close loop foreach($std_model as $key_model =>$val_model) ?>

                                                                </div><!-- close panel-body-->
                                                              </div><!-- close panel-default-->
                                                      </div><!-- close panel group โรงเรียนต้นแบบ-->
                                                    </div><!-- close  form-group row โรงเรียนต้นแบบ -->




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
                                     <div class="col-xs-12 col-sm-2">
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/school_list');?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                    </div>
                                  </div><!-- close class row-->

                                </div>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==4){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==5){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div>
                            </div>

                        </div><!-- close tab-content-->


                    </div>
                </div>
            </div>

            <script type="text/javascript">


                  <?php if($process_action == 'Edited'){ ?>
                  setTimeout(function(){$("#Province").val('<?php echo @$schl_info['addr_province']; ?>').trigger('change');},200);
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

              function checkbox_model(node){
                 if($(node).prop('checked',)==true){
                     $(node).parent().next().children().attr('disabled',false);
                 }else{
                     $(node).parent().next().children().attr('disabled',true);
                 }
              }
            </script>

            <script type="text/javascript">
              $(document).ready(function () {
                $('.i-checks').iCheck({
                  checkboxClass: 'icheckbox_square-green',
                  radioClass: 'iradio_square-green',
                  increaseArea: '20%'
                });

                chebox_star();
              });

              $("input[name='std_model[]']").on('ifChanged',function(){
                 if($(this).prop('checked')){
                     $(this).parent().parent().parent().next().children().prop('disabled',false).focus();
                 }else{
                     $(this).parent().parent().parent().next().children().val('');
                     $(this).parent().parent().parent().next().children().prop('disabled',true);
                 }

               chebox_star();

              });

              function chebox_star(){

                var num_star = parseInt($("input[name='std_model[]']:checked").length);

                if(num_star>0 && num_star<=9){

                 add_color($("#star1"));

                 che_star($("#star2"));
                 che_star($("#star3"));
                 che_star($("#star4"));
               }else{

                if(num_star>9 && num_star<=12){
                 add_color($("#star1"));
                 add_color($("#star2"));

                 che_star($("#star3"));
                 che_star($("#star4"));
               }else{
                if(num_star>12 && num_star<=15){
                 add_color($("#star1"));
                 add_color($("#star2"));
                 add_color($("#star3"));

                 che_star($("#star4"));
               }else{

                if(num_star>15 && num_star<=20){
                 add_color($("#star1"));
                 add_color($("#star2"));
                 add_color($("#star3"));
                 add_color($("#star4"));
               }else{
                 che_star($("#star1"));
                 che_star($("#star2"));
                 che_star($("#star3"));
                 che_star($("#star4"));
               }

             }
           }

         }
       }

              function che_star(star_id){

                 var status_star = star_id.hasClass("fa fa-star-o");
                 if(!status_star){
                    star_id.removeClass("fa fa-star");
                    star_id.css("color","#676a6c");
                    star_id.addClass("fa fa-star-o");

                 }
              }

              function add_color(star_id){
                   star_id.removeClass("fa fa-star-o");
                   star_id.addClass("fa fa-star");
                   star_id.css("color","#FF9800");
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
