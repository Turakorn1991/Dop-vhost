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
                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==157){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                    <script>
                                      setTimeout(function(){
                                        $("#menu_topright").html($("#tmp_menu").html());
                                      },300);
                                    </script>
          
                    <div class="form-group row">

                    <?php
                    $adm_id = '';

                    if($process_action=='Add')$process_action = 'Added';
                    if($process_action=='Edit'){$process_action = 'Edited'; @$adm_id = '/'.@$adm_info['adm_id'];}

                    echo form_open_multipart('welfare/webblock_list/'.$process_action.$adm_id,array('id'=>'form1'));
                    ?>

                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


               <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                    <div class="panel-group" style="margin-bottom: 0px;">
                          <div class="panel panel-default" style="border: 0">
                              <div class="panel-body" style="border:0; padding: 20px; padding-bottom: 0px;">

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12 has-error">
                                              <label for="" class="control-label  col-sm-3 col-xs-12" style="color: red;">ชื่อองค์กร :</label>
                                              <div class=" col-sm-9 col-xs-12 ">
                                                <input type="text" class="form-control " name="webblock_info[org_title]" title="ชื่อองค์กร" value="<?php echo $webblock_info['org_title']; ?>" placeholder="ระบุชื่อองค์กร" required>
                                              </div>
                                          </div>
                               
                                        </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12 has-error">
                                              <label for="" class="control-label  col-sm-3 col-xs-12" style="color: red;">ชื่อองค์กร(ย่อ) :</label>
                                              <div class=" col-sm-4 col-xs-6 ">
                                                <input type="text" class="form-control " name="webblock_info[org_short_title]" title="ชื่อองค์กร" value="<?php echo $webblock_info['org_short_title']; ?>" placeholder="ไม่เกิน 30 ตัวอักษร" required>
                                              </div>
                                          </div>
                               
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-xs-12 col-sm-12 dropdown">
                                                    <label for="example-text-input" class="col-md-3 col-sm-3 col-xs-12 col-form-label" style="color: red;">ที่ตั้งองค์กร</label>
                                                     <div class=" col-sm-6 col-xs-12">
                                                    
                                                    <label for="example-text-input" class="col-sm-4 col-xs-12 col-form-label" style="padding: 0px;color: red;">พิกัดภูมิศาสตร์</label>
                                                    <div class="col-xs-12 col-sm-6">
                                                     <?php
                                                            $addr_gps = @$webblock_info['addr_gps']; // Old Data $diff_info['addr_gps']

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

                                                           <button  type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_marker">
                                                              <i class="fa fa-map-marker" aria-hidden="true"></i> ตำแหน่งพิกัดภูมิศาสตร์
                                                             </button>

                                                            &nbsp;
                                                              <input required type="hidden" name="webblock_info[addr_gps]" value="<?php echo $addr_gps;?>" id="addr_gps">
                                                              <span id="addr_gpg_txt"><?php if($addr_gps!='0,0') { echo '('.$addr_gps.')';}?></span>

                                                     </div>
                                                      </div>
                                                  </div>
                                                </div>

                                      <div class="form-group row">
                                        <div class="col-xs-12 col-sm-12">
                                           <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                           </div>
                                          <div class="col-xs-6 col-sm-6" style="padding: 0px">
                                              <label for="" class="col-sm-4 col-xs-12 col-form-label">บ้านเลขที่</label>
                                               <div class=" col-sm-6 col-xs-12">
                                                  <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text" name="webblock_info[addr_home_no]" value="<?php echo @$webblock_info['addr_home_no']; ?>" />
                                              </div>
                                          </div>
                                          <div class="col-xs-3 col-sm-3" style="padding: 0px">
                                            <div class="col-xs-12 col-sm-12">
                                                <label for="" class="col-sm-4 col-xs-6 col-form-label">หมู่ที่</label>
                                                <div class=" col-sm-6 col-xs-6">
                                                  <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" name="webblock_info[addr_moo]" value="<?php echo @$webblock_info['addr_moo']; ?>"/>
                                                </div>
                                            </div>
                                          </div>
                                         </div>
                                        </div>
                                     

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 " style="padding: 0px">
                                                <label for="example-text-input" class="col-sm-4 col-xs-12 col-form-label">ตรอก</label>
                                                <div class=" col-sm-6 col-xs-12">
                                                  <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="webblock_info[addr_alley]" value="<?php echo @$webblock_info['addr_alley']; ?>" />
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 " style="padding: 0px">
                                                <label for="example-text-input" class="col-sm-4 col-xs-12 col-form-label">ซอย</label>
                                                <div class=" col-sm-6 col-xs-12">
                                                    <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" type="text" name="webblock_info[addr_lane]" value="<?php echo @$webblock_info['addr_lane']; ?>" />
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 " style="padding: 0px">
                                                <label for="example-text-input" class="col-sm-4 col-xs-12 col-form-label">ถนน</label>
                                                <div class=" col-sm-6 col-xs-12">
                                                    <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="webblock_info[addr_road]" value="<?php echo @$webblock_info['addr_road']; ?>" />
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12 dropdown">
                                              <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                              </div>
                                               <div class="col-xs-12 col-sm-6 " style="padding: 0px; color: red;">
                                                <label for="example-text-input" class="col-sm-4 col-xs-12 col-form-label">จังหวัด</label>

                                                <div class=" col-sm-6 col-xs-12">
                                                <select  required title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="webblock_info[addr_province]" onchange="optionGen(this,'Amphur',<?php echo @$webblock_info['addr_district']; ?>);">
                                                    <option value="">เลือกจังหวัด</option>
                                                    <?php $temp = $this->personal_model->getAll_Province();
                                                      foreach ($temp as $key => $row) { ?>
                                                      <option value="<?php echo $row['area_code']; ?>"><?php echo $row['area_name_th']; ?></option>
                                                    <?php  } ?>
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12 dropdown">
                                              <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                              </div>
                                              <div class="col-xs-12 col-sm-6 " style="padding: 0px; color:red;">
                                              <label for="example-text-input" class="col-sm-4 col-xs-12 col-form-label">อำเภอ</label>
                                              <div class=" col-sm-6 col-xs-12">
                                             <select  required title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="webblock_info[addr_district]" onchange="optionGen(this.value,'Tambon',<?php echo @$webblock_info['addr_sub_district']; ?>);" disabled>
                                                              <option value="">เลือกอำเภอ</option>
                                                              <?php //$temp = $this->personal_model->getAll_Amphur();
                                                                //foreach ($temp as $key => $row) { ?>
                                                                <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                                                              <?php  //} ?>
                                                          </select>
                                            </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12 dropdown">
                                              <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                              </div>
                                              <div class="col-xs-12 col-sm-6 " style="padding: 0px; color: red;">
                                                <label for="example-text-input" class="col-sm-4 col-xs-12 col-form-label">ตำบล</label>
                                                <div class=" col-sm-6 col-xs-12">
                                                <select required title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon" name="webblock_info[addr_sub_district]" disabled>
                                                          <option value="">เลือกตำบล</option>
                                                          <?php //$temp = $this->personal_model->getAll_Tambon();
                                                            //foreach ($temp as $key => $row) { ?>
                                                            <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                                                          <?php  //} ?>
                                                </select>
                                                </div>
                                            </div>


                                            <div class="col-xs-12 col-sm-3" >
                                                <label for="" class="col-sm-5 col-xs-12 col-form-label">รหัสไปรษณีย์</label>
                                                <div class=" col-sm-7 col-xs-12" style="padding: 0px">
                                                <input title="รหัสไปรษณีย์" placeholder="(5 หลัก)" class="form-control elder_addr_pre" type="text" name="webblock_info[addr_zipcode]" value="<?php echo $webblock_info['addr_zipcode'];?>"/>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                         <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-12">
                                                      <div class="col-xs-6 col-sm-6" style="padding: 0px">
                                                          <label for="" class="col-sm-6 col-xs-12 col-form-label">เบอร์โทรศัพท์ </label>
                                                          <div class=" col-sm-6 col-xs-12">
                                                            <input title="เบอร์โทรศัพท์ " placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="webblock_info[tel_no]" value="<?php echo $webblock_info['tel_no'];?>"/>
                                                           </div>
                                                      </div>

                                                      <div class="col-xs-6 col-sm-6" style="padding: 0px">
                                                          <label for="" class=" col-sm-4 col-xs-6 col-form-label">เบอร์โทรสาร</label>
                                                          <div class=" col-sm-6 col-xs-6">
                                                          <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="webblock_info[fax_no]" value="<?php echo $webblock_info['fax_no'];?>"/>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                            
                                                      <div class="col-xs-12 col-sm-12" >
                                                        <label for="" class=" col-sm-3 col-xs-12 col-form-label">ที่อยู่อีเมล</label>
                                                        <div class=" col-sm-6 col-xs-12">
                                                        <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="webblock_info[email_addr]" value="<?php echo $webblock_info['email_addr'];?>"/>
                                                        </div>
                                                    </div>
                                          
                                                  </div>

                                        <hr/>

                                         

                                            <div class="form-group row">
                                              <div class="col-xs-12 col-sm-6 dropdown">
                                                <label for="example-text-input" class="col-xs-12 col-sm-6 col-form-label">ผู้บริหารองค์กร</label>
                                                 <div class="col-xs-12 col-sm-6" >
                                                     <select id="pren_code_myID" title="คำนำหน้านาม" placeholder="เลือกคำนำหน้านาม" class="form-control elder_addr_pre" name="webblock_info[mngr_pren_code]">
                                                    <option value="">เลือกคำนำหน้านาม</option>
                                                    <?php
                                                    $tmps = $this->common_model->custom_query("select * from std_prename");
                                                    foreach ($tmps as $key => $value) {
                                                      $sel = '';
                                                      if ($webblock_info['mngr_pren_code'] == $value['pren_code']){
                                                        $sel = "selected";
                                                      }
                                                    ?>
                                                    <option <?php echo $sel; ?> value="<?php echo $value['pren_code'];?>"><?php echo $value['prename_th'];?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                  </select>
                                                </div>
                                              </div>
<!--                                                     <div class="col-xs-12 col-sm-3">
                                                <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                                                <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[tel_no_home]" value="<?php echo @$pers_info['tel_no_home'];?>"/>
                                              </div> -->
                                              <div class="col-xs-12 col-sm-3">
                                                <input title="ชือ" placeholder="ระบุชื่อตัว" class="form-control" type="text" name="webblock_info[mngr_firstname_th]" value="<?php echo @$webblock_info['mngr_firstname_th'];?>"/>
                                              </div>

                                              <div class="col-xs-12 col-sm-3">
                                                <input title="นามสกุล" placeholder="ระบุนามสกุล" class="form-control" type="text" name="webblock_info[mngr_lastname_th]" value="<?php echo @$webblock_info['mngr_lastname_th'];?>"/>
                                              </div>
                                             </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12">
                                            <div class="col-xs-12 col-sm-3" style="padding: 0px">
                                            </div>
                                            <div class="col-xs-12 col-sm-6 " style="padding: 0px">
                                                <label for="example-text-input" class="col-sm-6 col-xs-12 col-form-label">ตำแหน่ง</label>
                                                <div class=" col-sm-6 col-xs-12">
                                                    <input id="road" title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" class="form-control elder_addr_pre" type="text" name="webblock_info[mngr_position]" value="<?php echo @$webblock_info['mngr_position']; ?>" />
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <div class="col-xs-12 col-sm-12">
                   
                                            <div class="col-xs-12 col-sm-6 " style="padding: 0px">
                                                <label for="example-text-input" class="col-sm-6 col-xs-12 col-form-label">ภาพถ่าย(หน้าปก)</label>
                                                <div class=" col-sm-6 col-xs-12">
                                                    <input type="file" name="img_webblock" class="file" style="  visibility: hidden;position: absolute;">
                                                    <div class="input-group ">
                                                      <input type="text" class="form-control "  placeholder="ไพล์ชนิด" value="<?php echo $webblock_info['mngr_img_label'];?>">
                                                      <span class="input-group-btn">
                                                        <button class="browse btn btn-default" type="button">เลือกไพล์</button>
                                                      </span>
                                                    </div>
          
                                              </div>
                                            </div>
                                            <div class=" col-sm-1 col-xs-3">
                                            </div>
                                            <div class=" col-sm-1 col-xs-3">
                                              <?php $url = base_url().'assets/modules/welfare/uploads/'.$webblock_info['mngr_img_label']; ?>
                                              <a type="button" target="_blank" class="btn btn-default" href="<?php echo $url; ?>">ดาวน์โหลด
                                              </a>
                                            </div>
                                            <div class=" col-sm-1 col-xs-3">
                                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#dltModel">
                                                 ลบไพล์
                                              </button>
                                            </div>
                                          </div>
                                           
                                        </div>

                                        <hr/>

                                        <label for="example-text-input" class="col-sm-6 col-xs-12 col-form-label">ภาพถ่าย(บรรยากาศ)</label>
                                        <div class="form-group row" >
                                          <div class="col-xs-12 col-sm-12 ">
                                        <?php foreach ($web_info_photo as $key => $value) { ?>
                                          <div class="list-data" id="list_<?php echo $key; ?>">
                                            <div class="col-xs-12 col-sm-6 ">
                         
                                                <div class=" col-sm-6 col-xs-12">
                                                </div>
                                                <div class=" col-sm-6 col-xs-12">
                                                    <input type="file" name="blog_photo_file[]" class="file" style="  visibility: hidden;position: absolute;">
                                                    <div class="input-group ">
                                                      <input type="text" class="form-control "  placeholder="ไพล์ชนิด" value="<?php echo $value['blog_photo_label'];?>">
                                                      <span class="input-group-btn">
                                                        <button class="browse btn btn-default" type="button">เลือกไพล์</button>
                                                      </span>
                                                    </div>


                                              </div>
                                            </div>

                                            <div class=" col-sm-1 col-xs-3">
                                            </div>
                                            <div class=" col-sm-1 col-xs-3">
                                              <?php $url = base_url().'assets/modules/welfare/uploads/'.$value['blog_photo_label']; ?>
                                              <a type="button" class="btn btn-default" target="_blank" href="<?php echo $url; ?>">ดาวน์โหลด
                                              </a>
                                            </div>
                                            <div class=" col-sm-1 col-xs-3">
                                              <button id="list_<?php echo $key; ?>" type="button" class="btn btn-default" onclick="removeimg(this);" >
                                                 ลบไพล์
                                              </button>
                                            </div>
                                          </div>
                                           <?php  } ?>
                                           <?php if (empty($web_info_photo)){ ?>
                                             <div class="list-data" id="">
                                            <div class="col-xs-12 col-sm-6 ">
                         
                                                <div class=" col-sm-6 col-xs-12">
                                                </div>
                                                <div class=" col-sm-6 col-xs-12">
                                                    <input type="file" name="blog_photo_file[]" class="file" style="  visibility: hidden;position: absolute;">
                                                    <div class="input-group ">
                                                      <input type="text" class="form-control "  placeholder="ไพล์ชนิด" value="<?php echo @$value['blog_photo_label'];?>">
                                                      <span class="input-group-btn">
                                                        <button class="browse btn btn-default" type="button">เลือกไพล์</button>
                                                      </span>
                                                    </div>


                                              </div>
                                            </div>

                                            <div class=" col-sm-1 col-xs-3">
                                            </div>
                                            <div class=" col-sm-1 col-xs-3">
                                              <?php $url = base_url().'assets/modules/welfare/uploads/'.@$value['blog_photo_label']; ?>
                                              <a type="button" class="btn btn-default" target="_blank" href="<?php echo $url; ?>">ดาวน์โหลด
                                              </a>
                                            </div>
                                            <div class=" col-sm-1 col-xs-3">
                                              <button id="list<?php echo $key; ?>" type="button" class="btn btn-default" onclick="removeimg(this);" >
                                                 ลบไพล์
                                              </button>
                                            </div>
                                          </div>
                                 

                                        <?php    } ?>
                                           
                                          <div id="listimg"></div>
                                          </div>
                                        </div>

                                        <div class=" col-sm-3 col-xs-6 col-md-offset-3">
                                                    <button  type="button" class="btn btn-default" onclick="create_thum();">
                                                     เพิ่มไพล์
                                                  </button>
                                        </div>

                                        <script type="text/javascript">
                                          $(document).on('click', '.browse', function(){
                                              var file = $(this).parent().parent().parent().find('.file');
                                              file.trigger('click');
                                            });
                                            $(document).on('change', '.file', function(){
                                              $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
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
                                         <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-cancel" onclick="window.location.href='<?php echo site_url('welfare/welfare_list');?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                        </div>
                                      </div><!-- close class row-->


                                </div>
                            </div>

                        </div><!-- close tab-content-->


                    </div>
                </div>
            </div>



<script type="text/javascript">

    setTimeout(function(){$("#Province").val('<?php echo @$webblock_info['addr_province']; ?>').trigger('change');},200);

    // setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
    // setTimeout(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);

  function removeimg (item){
    console.log(item.id);
    var id = item.id;
    $('#'+item.id+'').hide();

    var res = id.split("_");
   // alert(res);
    window.location.href = base_url+'welfare/webblock_list/Delete/'+res[1];
    

  }
 //create thumbmaill image 
  function create_thum(){


    $('.list-data').not('.cloned').clone().addClass('cloned').appendTo('#listimg').find("input[type='text']").val("");
   // var container1=$('.list-data').clone({withDataAndEvents:true});
   //  // $(".list-data:first-child").clone({withDataAndEvents:true}).appendTo(".list-data").find("input[type='text']").val("");
   // container1.appendTo( '.list-data').find("input[type='text']").val("");
  }

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
          $tmp = $this->admin_model->getOnce_Application(17);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(17,get_session('user_id')); //Check User Permission
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

          <!--
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
           -->

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
  }else {
    info.date_of_birth = info.date_of_birth==''?'-':info.date_of_birth;
    $("#row1_date_of_birth").html("<span style='color:red'>"+info.date_of_birth+"</span>");
    $("#row1_state").html("<i class='fa fa-times text-danger'></i>");
  }
  //$("#pers_old").html(info.age);
  //End Service 1

  //Service 2
  if(info.date_of_death!='') {
    info.date_of_death = info.date_of_death==''?'-':info.date_of_death;
    $("#row2_date_of_death").html("<span style='color:red'>"+info.date_of_death+"</span>");
    $("#row2_state").html("<i class='fa fa-times text-danger'></i>");
  }else {
    info.date_of_death = info.date_of_death==''?'-':info.date_of_death;
    $("#row2_date_of_death").html("<span style='color:green'>"+info.date_of_death+"</span>");
    $("#row2_state").html("<i class='fa fa-check text-navy'></i>");
  }
  //End Service 2
  info.reg_addr.addr_home_no = info.reg_addr.addr_home_no==null?'-':info.reg_addr.addr_home_no;
  info.reg_addr.addr_sub_district = info.reg_addr.addr_sub_district==null?'-':info.reg_addr.addr_sub_district;
  //Service 3
    $.ajax({
    url: 'https://gateway.dop.go.th/transfer/import/RequestElderyJPTH',
    type: 'POST',
    dataType: 'json',
    data: {
        'Username': 'dopjpth',
        'Password': 'dpuser',
        'OfficerPID': pers_authen.pid,
        'addr_home_no': info.reg_addr.addr_home_no,
        'addr_sub_district': info.reg_addr.addr_sub_district,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        //console.log("success");console.dir(value);
        if(Object.keys(value).length) {
          console.log(value);
          if(value[0].message!='') {
            toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");
            $("#accountJPTH").html("ไม่พบข้อมูล.");
            $("#row3_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
          }else {
            //toastr.success("ดึงข้อมูลความจำเป็นพื้นฐาน (จปฐ.)เสร็จสิ้น","หน้าต่างแจ้งเตือน");
            $("#accountJPTH").html("");
            $("#accountJPTH").attr("size",Object.size(value));
            $(value).each(function(key,data) {
              console.log(data);
              $("<option value="+data.Q23AvgIncome+">อาชีพ (ปัจจุบัน) : "+data.Career+" รายได้เฉลี่ย "+numberWithCommas(data.Q23AvgIncome)+" (บาท/เดือน) :  ที่มาของรายได้ : - *("+data.MemberName+" "+data.MemberLastName+") บ้านเลขที่"+data.HHNumber+" หมู่บ้าน "+data.VillName+" ซอย "+data.Soi+" ถนน "+data.Tanon+"</option>").appendTo($("#accountJPTH"));
            });
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");
          $("#accountJPTH").html("ไม่พบข้อมูล.");
          $("#row3_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
        }
      },
      error:function() { //Result Error
        toastr.error("ดึงข้อมูลความจำเป็นพื้นฐาน (จปฐ.)ล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#accountJPTH").html("ไม่พบข้อมูล.");
        $("#row3_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
      },
    });
    $("#accountJPTH").change(function() {
      console.log();
      if($(this).val()>38000) {
        $("#row3_state").html("<i class='fa fa-times text-danger'></i>");
      }else {
        $("#row3_state").html("<i class='fa fa-check text-navy'></i>");
      }
    });
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
            $("#row5_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
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
            $("#row5_state").html("<i class='fa fa-check text-navy'></i>");
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลประวัติการกู้ยืมกองทุน","หน้าต่างแจ้งเตือน");
          $("#row5_loan_history").html("<span>-</span>");
          $("#row5_contract_status").html("<span>-</span>");
          $("#row5_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
        }
      },
      error:function() { //Result Error
        toastr.error("ดึงข้อมูลประวัติการกู้ยืมกองทุนล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#row5_loan_history").html("<span>-</span>");
        $("#row5_contract_status").html("<span>-</span>");
        $("#row5_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
      },
    });
  //End Service 5

  /*
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
            $("#row6_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
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
            $("#row6_state").html("<i class='fa fa-check text-navy'></i>");
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก","หน้าต่างแจ้งเตือน");
          $("#row6_history").html("<span>-</span>");
          $("#row6_year_now_history").html("<span>-</span>");
          $("#row6_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
        }
      },
      error:function() { //Result Error
        toastr.error("ตรวจสอบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบากล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#row6_history").html("<span>-</span>");
        $("#row6_year_now_history").html("<span>-</span>");
        $("#row6_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
      },
    });
  //End Service 6
  */

  //Service 7
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
  //End Service 7

}
</script>
