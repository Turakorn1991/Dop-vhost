
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                    <ul class="nav nav-tabs">
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(171);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(171,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/center_info/Edit/'.$center_info['qlc_id']);?>" <?php }?>  data-toggle="tab" <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) ศพอส.</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(172);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(172,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/center_kpi/Edit/'.$center_info['qlc_id']);?>" <?php }?>  <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) มาตรฐานตัวชี้วัด</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(173);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(173,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/center_activity/Edit/'.$center_info['qlc_id']);?>" <?php }?>  <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) ผลการดำเนินกิจกรรม</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==169){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>> <!--163,169แสดงเนื้อหาแบบขึ้นทะเบียน ศพอส-->
                                <div class="panel-body">

                                
                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);

                                            $("#Province").next().css("cssText", "border: 1px solid red; width:100%; !important");
                                            $("#Amphur").next().css("cssText", "border: 1px solid red; width:100%;");
                                            $("#Tambon").next().css("cssText", "border: 1px solid red; width:100%;");
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
                                    $qlc_id = '';

                                    if($process_action=='Add'){$process_action = 'Added';}

                                    if($process_action=='Edit'){$process_action = 'Edited'; @$qlc_id = '/'.$center_info['qlc_id'];}

                                    echo form_open_multipart('school/center_info/'.$process_action.$qlc_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>ข้อมูลศูนย์พัฒนาคุณภาพชีวิตและส่งเสริมอาชีพผู้สูงอายุ (ศพอส.)</h4>
                                              </div>

                                              <div class="panel-body" style="border:0; padding: 20px;">

                                                  <!--กรอกข้อมูล ศพอส-->
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-9 has-error"> <!-- col-sm-12 -->
                                                        <label for="" class="col-2 col-form-label" style="color: red;">ชื่อหน่วยงาน ศพอส.</label> <!-- control-label col-md-3 col-sm-3 col-xs-12 -->
                                                        <input type="text" class="form-control " name="center_info[qlc_name]" title="ชื่อโรงเรียน" value="<?php echo $center_info['qlc_name']; ?>" placeholder="ระบุชื่อหน่วยงาน" required>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"> <!--ต้องกลับมาแก้ปี-->
                                                        <!--ปีที่เริ่มดำเนินการ (ปี พ.ศ. ที่ก่อตั้ง)-->
                                                        <!-- ย้าย ปีงบประมาณแรก -->
                                                        <label for="datetimepicker1" class="col-2 col-form-label">ปีที่ได้รับงบประมาณเป็นครั้งแรก (ปี พ.ศ.)</label>
                                                        <br>
                                                        <select  style="width: 30%; padding: 4px 12px;" name="center_info[year_of_sponsorship]"> <!--ต้องกลับมาแก้ปี-->
                                                                <option>ปี</option>
                                                            <?php for($year = date("Y")-100;$year<=date("Y");$year++){ ?>
                                                                <option value="<?php echo $year; ?> " <?php if($center_info['year_of_sponsorship']==$year){ echo "selected"; }?> ><?php echo $year+543; ?></option>
                                                            <?php } ?>
                                                        </select>  
                                                        <!--==================-->
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <!--<div class="col-xs-12 col-sm-3">-->
                                                        <!--สังกัด ศพอส สำหรับโรงเรียน-->
                                                        <!--ต้องกลับมาแก้ปี-->
                                                        <!--<label for="datetimepicker1" class="col-2 col-form-label">ปีที่ได้รับงบประมาณเป็นครั้งแรก (ปี พ.ศ.)</label>
                                                        <br>
                                                        <select  style="width: 30%; padding: 4px 12px;" name="center_info[year_of_sponsorship]">--> <!--ต้องกลับมาแก้ปี-->
                                                                <!--<option>ปี</option>
                                                            <?php for($year = date("Y")-100;$year<=date("Y");$year++){ ?>
                                                                <option value="<?php echo $year; ?> " <?php if($center_info['year_of_sponsorship']==$year){ echo "selected"; }?> ><?php echo $year+543; ?></option>
                                                            <?php } ?>
                                                        </select>          
                                                    </div>-->
                                                    <div class="col-xs-12 col-sm-3">
                                                      
                                                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_marker">
                                                        <i class="fa fa-map-marker" aria-hidden="true"></i> ตำแหน่งพิกัดภูมิศาสตร์
                                                        </button>

                                                      &nbsp;
                                                        <input type="hidden" name="center_info[addr_gps]" value="<?php echo $addr_gps;?>" id="addr_gps">
                                                      
                                                      <br/>

                                                     <?php
                                                            $addr_gps = @$center_info['addr_gps']; // Old Data $diff_info['addr_gps']

                                                            if($addr_gps=='') {
                                                              $addr_gps ='0,0'; // Set Default Data
                                                            }
                                                            $arr = explode(',',$addr_gps);
                                                          ?>
                                                          <span id="addr_gpg_txt"><?php if($addr_gps!='0,0') { echo '('.$addr_gps.')';}?></span> <!-- addr_gpg_txt -->
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

                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"><!--ต้องกลับมาแก้บ้านเลขที่-->
                                                        <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                                                        <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" name="center_info[addr_home_no]" value="<?php echo $center_info['addr_home_no']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"><!--ต้องกลับมาแก้หมู่ที่-->
                                                        <label for="" class="col-2 col-form-label">หมู่ที่</label>
                                                         <input title="หมู่ที่" placeholder="" name="center_info[addr_moo]" value="<?php echo $center_info['addr_moo']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                    <!--ย้าย ตรอก-->
                                                    <div class="col-xs-12 col-sm-3 dropdown"> <!--col-sm-3-->
                                                        <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                        <div class="col-10">
                                                           <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="center_info[addr_alley]" value="<?php echo @$center_info['addr_alley']; ?>" />
                                                      </div>
                                                    </div>
                                                    <!--=========-->
                                                  </div>

                                                  <div class="form-group row">
                                                    <!--<div class="col-xs-12 col-sm-3 dropdown">--><!--ต้องกลับมาแก้ตรอก-->
                                                        <!--<label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                        <div class="col-10">
                                                           <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="center_info[addr_alley]" value="<?php echo @$center_info['addr_alley']; ?>" />
                                                      </div>
                                                    </div>-->
                                                    <div class="col-xs-12 col-sm-6 dropdown"><!--ต้องกลับมาแก้ซอย--> <!--col-sm-3-->
                                                      <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                                                      <div class="col-10">
                                                        <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" type="text" name="center_info[addr_lane]" value="<?php echo @$center_info['addr_lane']; ?>" />
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 dropdown"><!--ต้องกลับมาแก้ถนน--> 
                                                      <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                                                      <div class="col-10">
                                                        <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="center_info[addr_road]" value="<?php echo @$center_info['addr_road']; ?>" />
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                          <label for="example-text-input" style="color:red" class="col-2 col-form-label">จังหวัด</label>
                                                          <div class="col-10">
                                                            <select  title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="center_info[addr_province]" onchange="optionGen(this,'Amphur',<?php echo @$center_info['addr_district']; ?>);" required>
                                                                <option value="">เลือกจังหวัด</option>
                                                                <?php $temp = $this->personal_model->getAll_Province();
                                                                  foreach ($temp as $key => $row) { ?>
                                                                  <option value="<?php echo $row['area_code']; ?>"> <?php echo $row['area_name_th']; ?></option>
                                                                <?php  } ?>
                                                            </select>
                                                          </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" style="color:red" class="col-2 col-form-label">อำเภอ</label>
                                                        <div class="col-10">
                                                          <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="center_info[addr_district]" onchange="optionGen(this,'Tambon',<?php echo @$center_info['addr_sub_district']; ?>);" disabled required> <!--this.value-->
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
                                                        <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon" name="center_info[addr_sub_district]" disabled required>
                                                            <option value="">เลือกตำบล</option>
                                                            <?php //$temp = $this->personal_model->getAll_Tambon();
                                                              //foreach ($temp as $key => $row) { ?>
                                                              <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                                                            <?php  //} ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"><!--ต้องกลับมาแก้รหัสไปรษณีย์-->
                                                        <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                                                        <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" name="center_info[addr_zipcode]" value="<?php echo $center_info['addr_zipcode']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                  </div>


                                                  <div class="form-group row">

                                                    <div class="col-xs-12 col-sm-3">
                                                          <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (ศพอส.)</label>
                                                          <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_info[tel_no]" value="<?php echo $center_info['tel_no'];?>"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                          <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                                          <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_info[fax_no]" value="<?php echo $center_info['fax_no'];?>"/>
                                                    </div>
                                            
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">ที่อยู่อีเมล (ศพอส.)</label>
                                                        <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="center_info[email_addr]" value="<?php echo $center_info['email_addr'];?>"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <!--หน่วยงานทีู่แล-->
                                                    </div>
                                          
                                                  </div>
                                                <!--จบ กรอกข้อมูล ศพอส-->



                                                <!--เริ่ม code ผู้ประสานงานของ ศพอส.-->
                                                <div class="form-group row">
                                                        <div class="family_members" >
                                                                <!--<div class="family_members_template" >-->
                                                                    <div class="panel-group family_members_items" style="margin-top: -10px;">
                                                                      <div class="panel panel-default" style="border: 0">
                                                                        <div class="panel-heading clear-fix" style="background-color: initial;">
                                                                        </div>

                                                                          <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                                            <!-- ซ่อน code ปุ่มลบ
                                                                            <div class="row text-right">

                                                                            <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this,<?php echo $value_contacts['sch_cnt_id']; ?>)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                                                            </div>
                                                                            -->
                                                
                                                                            <div class="form-group row"><!--ต้องกลับมาแก้ผู้ประสานงานของ ศพอส.-->
                                                                              <div class="col-xs-12 col-sm-12">
                                                                                    <label>ผู้ประสานงานของ ศพอส.</label>
                                                                              </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">คำนำหน้านาม</label>
                                                                                    <div class="col-10">
                                                                                      <select title="เลือก" placeholder="เลือก" name="center_coor[pren_code]" class="form-control"> <!-- diff_info[req_prename] -->
                                                                                          <option value="">เลือก</option>
                                                                                          <option <?php if($center_coor['pren_code']=='003') {?> selected <?php }?> value="003">นาย</option>
                                                                                          <option <?php if($center_coor['pren_code']=='005') {?> selected <?php }?> value="005">นาง</option>
                                                                                          <option <?php if($center_coor['pren_code']=='004') {?> selected <?php }?> value="004">นางสาว</option>
                                                                                      </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">ชื่อตัว</label>
                                                                                    <input title="ชื่อตัวผู้ประสานงาน" placeholder="ชื่อตัว" class="form-control" type="text" name="center_coor[qlc_coor_firstname_th]" value="<?php echo $center_coor['qlc_coor_firstname_th']; ?>"/> <!-- $value_contacts['qlc_coor_firstname_th']; -->
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">ชื่อสกุล</label>
                                                                                    <input title="ชื่อสกุลผู้ประสานงาน" placeholder="ชื่อสกุล" class="form-control" type="text" name="center_coor[qlc_coor_lastname_th]" value="<?php echo $center_coor['qlc_coor_lastname_th']; ?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3 ">
                                                                                    <label for="example-text-input" class="col-2 col-form-label">ตำแหน่ง</label>
                                                                                    <input title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" class="form-control" type="text" name="center_coor[qlc_coor_position]" value="<?php echo $center_coor['qlc_coor_position']; ?>"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (ผู้ประสานงานของ ศพอส.)</label>
                                                                                    <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXX" class="form-control" type="text" name="center_coor[qlc_coor_tel_no]" value="<?php echo $center_coor['qlc_coor_tel_no']; ?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                      <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (ศพอส.)</label>
                                                                                      <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_coor[qlc_tel_no]" value="<?php echo $center_coor['qlc_tel_no'];?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                      <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                                                                      <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_coor[qlc_fax_no]" value="<?php echo $center_coor['qlc_fax_no'];?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">ที่อยู่อีเมล (ผู้ประสานงานของ ศพอส.)</label>
                                                                                    <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="center_coor[qlc_coor_email_addr]" value="<?php echo $center_coor['qlc_coor_email_addr'];?>"/>
                                                                                </div>
                                                                            </div>
                                                                          </div>

                                                                      </div>
                                                                    </div>
                                                                  <!--</div> close family_members_template-->

                                                        </div><!-- close family_members-->
                                                
                                                </div>
                                                <!--จบ code ผู้ประสานงานของ ศพอส.-->



                                                  <!--กรอกข้อมูล หน่วยงานที่ดูแล ศพอส-->
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-9 has-error"> <!-- col-sm-12 -->
                                                        <label for="" class="col-2 col-form-label" style="color: red;">ชื่อหน่วยงานที่ดูแล ศพอส.</label> <!-- control-label col-md-3 col-sm-3 col-xs-12 -->
                                                        <input type="text" class="form-control " name="center_agency[qlc_agency_name]" title="ชื่อโรงเรียน" value="<?php echo $center_agency['qlc_agency_name']; ?>" placeholder="ระบุชื่อหน่วยงาน" > <!-- required -->
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"> <!--ต้องกลับมาแก้ปี-->
                                                        <!--ปีที่เริ่มดำเนินการ (ปี พ.ศ. ที่ก่อตั้ง)-->
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <!--<div class="col-xs-12 col-sm-3">-->
                                                        <!--สังกัด ศพอส สำหรับโรงเรียน-->
                                                        <!--ต้องกลับมาแก้ปี-->
                                                        <!--<label for="datetimepicker1" class="col-2 col-form-label">ปีที่เริ่มดำเนินการ (ปี พ.ศ. ที่ก่อตั้ง)</label>
                                                        <br>
                                                        <select  style="width: 30%; padding: 4px 12px;" name="schl_info[year_of_established]">--> <!--ต้องกลับมาแก้ปี-->
                                                                <!--<option>ปี</option>
                                                            <?php for($year = date("Y")-100;$year<=date("Y");$year++){ ?>
                                                                <option value="<?php echo $year; ?> " <?php if($schl_info['year_of_established']==$year){ echo "selected"; }?> ><?php echo $year+543; ?></option>
                                                            <?php } ?>
                                                        </select>-->    
                                                    <!--</div>-->
                                                    <!--<div class="col-xs-12 col-sm-3">-->
                                                     <?php
                                                            /*$addr_gps = @$center_agency['addr_gps']; // Old Data $diff_info['addr_gps']

                                                            if($addr_gps=='') {
                                                              $addr_gps ='0,0'; // Set Default Data
                                                            }
                                                            $arr = explode(',',$addr_gps);*/
                                                          ?>

                                                          <!--<script type="text/javascript">
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
                                                              <input type="hidden" name="center_agency[addr_gps]" value="<?php echo $addr_gps;?>" id="addr_gps">
                                                              <span id="addr_gpg_txt"><?php if($addr_gps!='0,0') { echo '('.$addr_gps.')';}?></span>-->

                                                    <!--</div>-->
                                                    <div class="col-xs-12 col-sm-3"><!--ต้องกลับมาแก้บ้านเลขที่-->
                                                        <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                                                        <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" name="center_agency[addr_home_no]" value="<?php echo $center_agency['addr_home_no']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"><!--ต้องกลับมาแก้หมู่ที่-->
                                                        <label for="" class="col-2 col-form-label">หมู่ที่</label>
                                                         <input title="หมู่ที่" placeholder="" name="center_agency[addr_moo]" value="<?php echo $center_agency['addr_moo']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                    <!-- ย้าย ตรอก -->
                                                    <div class="col-xs-12 col-sm-6 dropdown"> <!-- col-sm-3 -->
                                                        <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                        <div class="col-10">
                                                           <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="center_agency[addr_alley]" value="<?php echo @$center_agency['addr_alley']; ?>" />
                                                      </div>
                                                    </div>
                                                    <!--==========-->
                                                  </div>

                                                  <div class="form-group row">
                                                    <!--<div class="col-xs-12 col-sm-3 dropdown">--><!--ต้องกลับมาแก้ตรอก-->
                                                        <!--<label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                        <div class="col-10">
                                                           <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="center_agency[addr_alley]" value="<?php echo @$center_agency['addr_alley']; ?>" />
                                                      </div>
                                                    </div>-->
                                                    <div class="col-xs-12 col-sm-6 dropdown"><!--ต้องกลับมาแก้ซอย-->  <!-- col-sm-3 -->
                                                      <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                                                      <div class="col-10">
                                                        <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" type="text" name="center_agency[addr_lane]" value="<?php echo @$center_agency['addr_lane']; ?>" />
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 dropdown"><!--ต้องกลับมาแก้ถนน-->
                                                      <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                                                      <div class="col-10">
                                                        <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="center_agency[addr_road]" value="<?php echo @$center_agency['addr_road']; ?>" />
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                          <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                                                          <div class="col-10">
                                                            <select  title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province2" name="center_agency[addr_province]" onchange="optionGen2('Province2','Amphur2',<?php echo @$center_agency['addr_district']; ?>);">
                                                                <option value="">เลือกจังหวัด</option>
                                                                <?php $temp2 = $this->personal_model->getAll_Province();
                                                                  foreach ($temp2 as $key => $row) { ?>
                                                                  <option value="<?php echo $row['area_code']; ?>"> <?php echo $row['area_name_th']; ?></option>
                                                                <?php  } ?>
                                                            </select>
                                                          </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                                                        <div class="col-10">
                                                          <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur2" name="center_agency[addr_district]" onchange="optionGen2('Amphur2','Tambon2',<?php echo @$center_agency['addr_sub_district']; ?>);" disabled> <!--this.value-->
                                                              <option value="">เลือกอำเภอ</option>
                                                              <?php //$temp2 = $this->personal_model->getAll_Amphur();
                                                                //foreach ($temp2 as $key => $row) { ?>
                                                                <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                                                              <?php  //} ?>
                                                          </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                                                        <div class="col-10">
                                                        <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon2" name="center_agency[addr_sub_district]" disabled>
                                                            <option value="">เลือกตำบล</option>
                                                            <?php //$temp2 = $this->personal_model->getAll_Tambon();
                                                              //foreach ($temp2 as $key => $row) { ?>
                                                              <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                                                            <?php  //} ?>
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"><!--ต้องกลับมาแก้รหัสไปรษณีย์-->
                                                        <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                                                        <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" name="center_agency[addr_zipcode]" value="<?php echo $center_agency['addr_zipcode']; ?>" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                  </div>


                                                  <div class="form-group row">

                                                    <div class="col-xs-12 col-sm-3">
                                                          <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (หน่วยงานที่ดูแล ศพอส.)</label>
                                                          <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_agency[tel_no]" value="<?php echo $center_agency['tel_no'];?>"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                          <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                                          <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_agency[fax_no]" value="<?php echo $center_agency['fax_no'];?>"/>
                                                    </div>
                                            
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">ที่อยู่อีเมล (หน่วยงานที่ดูแล ศพอส.)</label>
                                                        <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="center_agency[email_addr]" value="<?php echo $center_agency['email_addr'];?>"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <!--หน่วยงานทีู่แล-->
                                                    </div>
                                          
                                                  </div>
                                                <!--จบ กรอกข้อมูล หน่วยงานที่ดูแล ศพอส-->



                                                <!--เริ่ม code ผู้ประสานงานของ หน่วยงานที่ดูแล ศพอส.-->
                                                <div class="form-group row">
                                                        <div class="family_members" >
                                                                <!--<div class="family_members_template" >-->
                                                                    <div class="panel-group family_members_items" style="margin-top: -10px;">
                                                                      <div class="panel panel-default" style="border: 0">
                                                                        <div class="panel-heading clear-fix" style="background-color: initial;">
                                                                        </div>

                                                                          <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                                            <!-- ซ่อน code ปุ่มลบ
                                                                            <div class="row text-right">

                                                                            <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this,<?php echo $value_contacts['sch_cnt_id']; ?>)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                                                            </div>
                                                                            -->
                                                
                                                                            <div class="form-group row"><!--ต้องกลับมาแก้ผู้ประสานงานของ ศพอส.-->
                                                                              <div class="col-xs-12 col-sm-12">
                                                                                    <label>ผู้ประสานงานของหน่วยงานที่ดูแล ศพอส.</label>
                                                                              </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">คำนำหน้านาม</label>
                                                                                    <div class="col-10">
                                                                                      <!--<select title="เลือก" placeholder="เลือก" name="center_agency_coor[req_prename]" class="form-control">
                                                                                          <option value="">เลือก</option>
                                                                                          <option <?php if($diff_info['req_prename']=='นาย') {?> selected <?php }?> value="นาย">นาย</option>
                                                                                          <option <?php if($diff_info['req_prename']=='นาง') {?> selected <?php }?> value="นาง">นาง</option>
                                                                                          <option <?php if($diff_info['req_prename']=='นางสาว') {?> selected <?php }?> value="นางสาว">นางสาว</option>
                                                                                      </select>-->
                                                                                      <select title="เลือก" placeholder="เลือก" name="center_agency_coor[pren_code]" class="form-control"> <!-- diff_info[req_prename] -->
                                                                                          <option value="">เลือก</option>
                                                                                          <option <?php if($center_coor['pren_code']=='003') {?> selected <?php }?> value="003">นาย</option>
                                                                                          <option <?php if($center_coor['pren_code']=='005') {?> selected <?php }?> value="005">นาง</option>
                                                                                          <option <?php if($center_coor['pren_code']=='004') {?> selected <?php }?> value="004">นางสาว</option>
                                                                                      </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">ชื่อตัว</label>
                                                                                    <input title="ชื่อตัวผู้ประสานงาน" placeholder="ชื่อตัว" class="form-control" type="text" name="center_agency_coor[qlc_agency_coor_firstname_th]" value="<?php echo $center_agency_coor['qlc_agency_coor_firstname_th']; ?>"/> <!--[<?php //echo $i; ?>]-->
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">ชื่อสกุล</label>
                                                                                    <input title="ชื่อสกุลผู้ประสานงาน" placeholder="ชื่อสกุล" class="form-control" type="text" name="center_agency_coor[qlc_agency_coor_lastname_th]" value="<?php echo $center_agency_coor['qlc_agency_coor_lastname_th']; ?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3 ">
                                                                                    <label for="example-text-input" class="col-2 col-form-label">ตำแหน่ง</label>
                                                                                    <input title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" class="form-control" type="text" name="center_agency_coor[qlc_agency_coor_position]" value="<?php echo $center_agency_coor['qlc_agency_coor_position']; ?>"/>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group row">
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (ผู้ประสานงานของหน่วยงานที่ดูแล)</label>
                                                                                    <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXX" class="form-control" type="text" name="center_agency_coor[qlc_agency_coor_tel_no]" value="<?php echo $center_agency_coor['qlc_agency_coor_tel_no']; ?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                      <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (หน่วยงานที่ดูแล ศพอส.)</label>
                                                                                      <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_agency_coor[qlc_agency_tel_no]" value="<?php echo $center_agency_coor['qlc_agency_tel_no'];?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                      <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                                                                      <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="center_agency_coor[qlc_agency_fax_no]" value="<?php echo $center_agency_coor['qlc_agency_fax_no'];?>"/>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <label for="" class="col-2 col-form-label">ที่อยู่อีเมล (ผู้ประสานงานของหน่วยงานที่ดูแล)</label>
                                                                                    <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="center_agency_coor[qlc_agency_coor_email_addr]" value="<?php echo $center_agency_coor['qlc_agency_coor_email_addr'];?>"/>
                                                                                </div>
                                                                            </div>
                                                                          </div>

                                                                      </div>
                                                                    </div>
                                                                  <!--</div> close family_members_template-->

                                                        </div><!-- close family_members-->
                                                
                                                </div>
                                                <!--จบ code ผู้ประสานงานของ หน่วยงานที่ดูแล ศพอส.-->





                                                  <!--ตาราง รร ในสังกัด ศพอส.-->                                                  

                                                    <div class="table-responsive">

                                                      <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                        <thead style="font-size: 15px;">
                                                          <tr>
                                                              <th style="width:2% !important;" class="text-center">#</th>
                                                              <th class="text-center">ชื่อโรงเรียนในสังกัด ศพอส. (<?php echo $center_info['qlc_name']; ?>)</th>
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                          if($center_info['qlc_id'] != null)
                                                          {
                                                            $number = 1;
                                                            $this->load->model('school_model');
                                                            $schl_info = $this->school_model->get_schlInfo_byqlcid($center_info['qlc_id']);
                                                            //echo count($schl_info);
                                                            if(count($schl_info)>0 & count($schl_info)!=0 & (count($schl_info)!= null | count($schl_info)!='') )
                                                            {                                                        
                                                              foreach ($schl_info as $schl)
                                                              {
                                                        ?>
                                                                <tr><td><?php echo $number; ?></td><td><?php echo $schl['schl_name']; ?></td></tr>
                                                        <?php 
                                                                $number++;
                                                              }
                                                            }
                                                            else
                                                            {
                                                        ?>
                                                              <tr><td><?php echo "#"; ?></td><td><center><?php echo "ไม่พบข้อมูล"; ?></center></td></tr>
                                                        <?php      
                                                            }    
                                                          }
                                                          else
                                                          {
                                                        ?>
                                                            <tr><td><?php echo "#"; ?></td><td><center><?php echo "ไม่พบข้อมูล"; ?></center></td></tr>
                                                        <?php
                                                          }
                                                        ?>  
                                                        </tbody>
                                                      </table>

                                                    </div>
                                                    <!--จบ ตาราง รร ใน สังกัด ศพอส.-->


                                                
                                                <!--ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->
                                                <!--<br />
                                                <div class="form-group row">
                                                  <label for="" class=" col-sm-3 col-xs-12 col-form-label">ผลการตรวจมาตรฐาน/ตัวชี้วัด</label>
                                                  <div class="col-xs-12 col-sm-9">

                                                    <?php 
                                                      $qlc_select = array();
                                                      if($process_action=='Edited'){
                                                         $qlc_select = $this->common_model->query("SELECT qlc_kpi_code FROM qlc_kpi WHERE qlc_id = {$center_info['qlc_id']}")->result_array();
                                                      }
                                                          
                              
                                                    ?>
                                                    <?php foreach ($std_qlc as $key => $values) { ?>
                                         
                                                     <div class="table-responsive">
                                                        <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                          <thead style="font-size: 15px;">
                                                            <tr>
                                                                <th style="width:2% !important; text-align: left;" class=""><?php echo $values['title']['qlc_kpi_grp'];?></th>
                          
                                                            </tr>
                                                          </thead>
                                                          <tbody>

                                                            <?php foreach ($values['data'] as $key2 => $value) { ?>
                                                              <tr>
                                                                <td>
                                                                  <?php 

                                                                    $status = '';
                                                                     foreach($qlc_select as $key => $product)
                                                                     {
                                                                        if ( $product['qlc_kpi_code'] === $value['qlc_kpi_code'] )
                                                                           $status = 'checked=checked';
                                                                     }
                                                                    
                                                                  ?>
                                                                  <div class="i-checks">
                                                                    <input  <?php echo $status;?> type="checkbox"  name="qlc[<?php echo $value['qlc_kpi_code']?>]" value="<?php echo $value['qlc_kpi_score']?>">
                                                                    <div style="margin-left: 5px; display: inline;">
                                                                      <?php echo $value['qlc_kpi_title']; ?>
                                                                    </div>
                                                                  </div>
                                                                </td>
                                                              </tr>
                                                            <?php  } ?>
                                                            
                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    <?php } ?>
                                                  </div>
                                                </div>-->
                                                <!--จบ ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->

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
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/center_list');?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
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
                  setTimeout(function(){$("#Province").val('<?php echo @$center_info['addr_province']; ?>').trigger('change');},200);
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



                //--- add option gen province ---//
                  <?php if($process_action == 'Edited'){ ?>
                  setTimeout(function(){$("#Province2").val('<?php echo @$center_agency['addr_province']; ?>').trigger('change');},200);
                  //setTimeout(function(){$("#Amphur2").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
                  // setTimeot(function(){$("#Tambon2").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);

                <?php } ?>
                function set_enable2(elem,target='') {
                  if(elem.prop('checked') == true) {
                    $(target).prop('disabled', false ).focus();
                  }else{
                    $(target).val('');
                    $(target).prop('disabled', true );
                  }
                }
                function optionGen2(code,target,opSelect) {
                  // alert(code.value);
                  // alert(target);
                  $.ajax({
                    url: base_url+'personals/get_Area_option',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                      'code': $('#'+code).val(),
                      'type': target.split('2')[0],
                      <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                    },
                  })
                  .done(function(ret) {
                    console.log("success");
                    console.dir(ret);
                    $('#'+target).empty();
                    $('#'+target).prop('disabled', false);
                    if(target == 'Amphur2'){
                      str = "เลือกอำเภอ";
                    }else if(target == 'Tambon2'){
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
                        //console.log("Hey")
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
                //------------------------------------------------------------



              function checkbox_model(node){
                 if($(node).prop('checked',)==true){
                     $(node).parent().next().children().attr('disabled',false);
                 }else{
                     $(node).parent().next().children().attr('disabled',true);
                 }
              }

              $("#guide-book").click(function(){
                window.open('/assets/modules/school/guide/Center_Manual.pdf', '_blank');
              }); 
            </script>

            <script type="text/javascript">
              $(document).ready(function () {
                $('.i-checks').iCheck({
                  checkboxClass: 'icheckbox_square-green',
                  radioClass: 'iradio_square-green',
                  increaseArea: '20%'
                });

                //chebox_star();
              });

              /*$("input[name='std_model[]']").on('ifChanged',function(){
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
              }*/

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
        <?php $str = getMsg('0173');?>
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
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
