
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">

                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==46){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">


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
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                      <i class="fa fa-file" aria-hidden="true"></i>
                                                  </a>


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
                                                  <?php }else{?> href="<?php echo site_url('intelprop/intelprop_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(3);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-trash" aria-hidden="true"></i>
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

                                    <div class="form-group row">

                                    <?php
                                    $diff_id = '';

                                    if($process_action=='Add')$process_action = 'Added';
                                    if($process_action=='Edit'){$process_action = 'Edited'; $diff_id = '/'.$diff_info['diff_id'];}

                                    echo form_open_multipart('difficult/sufferer_form1/'.$process_action.$diff_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <p class="text-danger"><font color=red><?php echo validation_errors();?></font></p>

                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>ข้อมูลผู้สูงอายุ <label>&nbsp;</label></h4>
                                              </div>

                                              <div class="panel-body" style="border:0; padding: 20px;">
                                          <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3"><img src="<?php echo path(get_session('user_photo_file'),'member');?>" class="img-responsive" style="margin: 0 auto;"></div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 11px 15px;"><span style="font-weight: bold;">เลขประจำตัวประชาชน</span></div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 3px 15px;"><input title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="pid" name="diff_info[pid]" value="<?php echo $diff_info['pid'];?>" required/>
                                                    <input type="hidden" id="pers_id" name="diff_info[pers_id]" value="<?php echo $diff_info['pers_id'];?>">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 1px 15px;">
                                                      <button title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_elder_pid">ตรวจสอบ</button>
                                                      <button class="btn btn-default elder_same_req" title="กรณีไม่มีบัตร" style="">กรณีไม่มีบัตร</button>
                                                    </div>
                                                      <script>
                                                        var elder_pers = null;
                                                        $("#bt_elder_pid").click(function(){

                                                          if($("#pid").val()!='') {

                                                            //$("#bt_elder_pid").html('<i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i><span> ตรวจสอบ</span>');
                                                            $("#bt_elder_pid").attr('disabled',true);

                                                            $.ajax({
                                                            url: '<?php echo site_url('member/getPersonalInfo');?>',
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

                                                    <div class="col-xs-12 col-sm-3" style="padding: 11px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                                                    <div class="col-xs-12 col-sm-6" style="padding: 11px 15px;"  id="name"> <?php echo $diff_info['name'];?> </div>

                                                    <div class="col-xs-12 col-sm-3" style="padding: 11px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                                                    <div class="col-xs-12 col-sm-6" style="padding: 11px 15px;" id="date_of_birth"> <?php echo $diff_info['date_of_birth'];?> </div>

                                                    <div class="col-xs-12 col-sm-3" style="padding: 11px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name"> <?php echo $diff_info['gender_name'];?></span> </div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 11px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"> <?php echo $diff_info['nation_name_th'];?></span> </div>

                                                    <div class="col-xs-12 col-sm-3" style="padding: 11px 15px;"><span style="font-weight: bold;">ศาสนา</span> <span id="relg_title"> <?php echo $diff_info['relg_title'];?> </span> </div>
                                                    <div class="col-xs-12 col-sm-3" style="padding: 11px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span></div>
                                                    <div class="col-xs-12 col-sm-6" style="padding: 11px 15px;"> - </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="datetimepicker1" class="col-2 col-form-label">วันที่ขึ้นทะเบียน <font color="red">*</font></label>
                                                        <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                                                            <input title="วันที่ขึ้นทะเบียน" placeholder="เลือกวันที่" class="form-control" type="text" name=""/>
                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                        </div>
                                                          <script type="text/javascript">
                                                          <?php
                                                          $tmp = explode('-',@$adm_info['date_of_adm']);
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
                                                    <div class="col-xs-12 col-sm-6">ที่อยู่ (ปัจจุบัน) (<label><input type="checkbox" name="elder_addr_chk"> ตรงกับที่อยู่ตามทะเบียนบ้าน</label>)</div>
                                                    <script>
                                                      $("input[name='elder_addr_chk']").click(function(){
                                                        if($(this).prop('checked')) {
                                                          $(".elder_addr_pre").attr('disabled',true);
                                                        }else {
                                                          $(".elder_addr_pre").attr('disabled',false);
                                                        }
                                                      });

                                                      <?php
                                                      if(($diff_info['reg_addr_id']==$diff_info['pre_addr_id']) && ($diff_info['reg_addr_id']!=''&&$diff_info['pre_addr_id']!='')) {
                                                      ?>
                                                        setTimeout(function(){
                                                          $("input[name='elder_addr_chk']").prop('checked',true);
                                                          $(".elder_addr_pre").attr('disabled',true);
                                                        },500);
                                                      <?php
                                                      }
                                                      ?>

                                                    </script>
                                                    <div class="col-xs-12 col-sm-6"><button class="btn btn-default"> <i class="fa fa-map-marker" aria-hidden="true"></i> ตำแหน่งพิกัดภูมิศาสตร์</button> <span>(102.5745382539, 97.394903489)</span></div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-6 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">สถานะการพักอาศัย</label>
                                                        <div class="col-10">
                                                <select title="สถานะการพักอาศัย" placeholder="เลือกสถานะการพักอาศัย" class="form-control">
                                                    <option>เลือกสถานะการพักอาศัย</option>
                                                    <option>ช่องทางที่ 1</option>
                                                    <option>ช่องทางที่ 2</option>
                                                    <option>ช่องทางที่ 3</option>
                                                </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                                              <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">หมู่ที่</label>
                                              <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                                                        <div class="col-10">
                                                          <select title="ตรอก" placeholder="เลือกตรอก" class="form-control elder_addr_pre">
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
                                                <select title="ซอย" placeholder="เลือกซอย" class="form-control elder_addr_pre">
                                                    <option value="">เลือกซอย</option>
                                                    <?php $temp = $this->personal_model->getAll_lane();
                                                      foreach ($temp as $key => $row) { ?>
                                                      <option value="<?php echo $row['lane_code']; ?>"><?php echo $row['lane_name']; ?></option>
                                                    <?php  } ?>
                                                </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                                                        <div class="col-10">
                                                <select title="ถนน" placeholder="เลือกถนน" class="form-control elder_addr_pre">
                                                    <option value="">เลือกถนน</option>
                                                    <?php $temp = $this->personal_model->getAll_road();
                                                      foreach ($temp as $key => $row) { ?>
                                                      <option value="<?php echo $row['road_code']; ?>"><?php echo $row['road_name']; ?></option>
                                                    <?php  } ?>
                                                </select>
                                                      </div>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                                                        <div class="col-10">
                                                <select title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre">
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
                                                <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre">
                                                    <option value="">เลือกอำเภอ</option>
                                                    <?php $temp = $this->personal_model->getAll_Amphur();
                                                      foreach ($temp as $key => $row) { ?>
                                                      <option value="<?php echo $row['area_code']; ?>"><?php echo $row['area_name_th']; ?></option>
                                                    <?php  } ?>
                                                </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                                                        <div class="col-10">
                                                <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre">
                                                    <option value="">เลือกตำบล</option>
                                                    <?php $temp = $this->personal_model->getAll_Tambon();
                                                      foreach ($temp as $key => $row) { ?>
                                                      <option value="<?php echo $row['area_code']; ?>"><?php echo $row['area_name_th']; ?></option>
                                                    <?php  } ?>
                                                </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                                              <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" type="text"/>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                                              <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="diff_info[tel_no_home]" value="<?php echo $diff_info['tel_no_home'];?>"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                              <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="diff_info[tel_no_mobile]" value="<?php echo $diff_info['tel_no_mobile'];?>"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                                              <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="diff_info[fax_no]" value="<?php echo $diff_info['fax_no'];?>"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">ที่อยู่อีเมล</label>
                                              <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="diff_info[email_addr]" value="<?php echo $diff_info['email_addr'];?>"/>
                                                    </div>
                                                  </div>

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-6 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">สถานะการสมรส</label>
                                                        <div class="col-10">
                                                <select title="สถานะการสมรส" placeholder="เลือกสถานะการสมรส" class="form-control">
                                                    <option>เลือกสถานะการสมรส</option>
                                                    <option>สถานะการสมรสที่ 1</option>
                                                    <option>สถานะการสมรสที่ 2</option>
                                                    <option>สถานะการสมรสที่ 3</option>
                                                </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                                                        <div class="col-10">
                                                <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control">
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
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">อาชีพ (ปัจจุบัน)</label>
                                              <input title="อาชีพ (ปัจจุบัน)" placeholder="ระบุอาชีพ (ปัจจุบัน)" class="form-control" type="text"/>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">รายได้เฉลี่ย (บาท/เดือน)</label>
                                              <input title="ราบได้เฉลี่ย (บาท/เดือน)" placeholder="ระบุราบได้เฉลี่ย (บาท/เดือน)" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label">ที่มาของรายได้</label>
                                                        <div class="col-10">
                                                <select title="ที่มาของรายได้" placeholder="เลือกที่มาของรายได้" class="form-control">
                                                    <option>เลือกที่มาของรายได้</option>
                                                    <option>ที่มาของรายได้ที่ 1</option>
                                                    <option>ที่มาของรายได้ที่ 2</option>
                                                    <option>ที่มาของรายได้ที่ 3</option>
                                                </select>
                                                      </div>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="" class="col-2 col-form-label">&nbsp;</label>
                                              <input title="ระบุ" placeholder="ระบุ" class="form-control" type="text"/>
                                                    </div>
                                                  </div>

                                                  </div>

                                              </div>
                                          </div><!-- close panel-group-->

                                          <h3>สาขาภูมิปัญญาที่เชี่ยวชาญ (จำนวน 1 สาขา)</h3>
                                          <div class="panel-group" style="margin-top: -10px;">
                                                  <div class="panel panel-default" style="border: 0">
                                                    <div class="panel-heading clear-fix" style="background-color: initial;">
                                                    </div>
                                                      <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                        <div class="row text-right">
                                                        <button class="btn btn-default" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-xs-12 col-sm-6 dropdown">
                                                                <label for="example-text-input" class="col-2 col-form-label">สาขาภูมิปัญญา</label>
                                                                <div class="col-10">
                                                                <select title="สาขาภูมิปัญญา" placeholder="เลือกสาขาภูมิปัญญา" class="form-control">
                                                                    <option>เลือกสาขาภูมิปัญญา</option>
                                                                    <option>สถานะการสมรสที่ 1</option>
                                                                    <option>สถานะการสมรสที่ 2</option>
                                                                    <option>สถานะการสมรสที่ 3</option>
                                                                </select>
                                                              </div>
                                                            </div>

                                                            <div class="col-xs-12 col-sm-6">
                                                                <label for="" class="col-2 col-form-label">เชี่ยวชาญเรื่อง</label>
                                                      <input title="เชี่ยวชาญเรื่องุ" placeholder="ระบุความเชี่ยวชาญ" class="form-control" type="text">
                                                            </div>
                                                          </div>

                                                          <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-6">
                                                                <label for="" class="col-2 col-form-label">เอกสารแนบ</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="เลือก" aria-describedby="basic-addon2">
                                                                    <span class="input-group-addon" id="basic-addon2">Browse</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6">
                                                                <label for="" class="col-2 col-form-label">ลิ้ง</label>
                                                                <input title="ลิ้ง" placeholder="ระบุลิ้ง (เว็บไซต์ เฟสบุ๊ค หรือ ยูทูป เป็นต้น)" class="form-control" type="text">
                                                            </div>

                                                          </div>

                                                          <div class="row">
                                                                  <div class="col-xs-12 col-sm-3" align="center">
                                                                        <img src="<?php echo base_url();?>assets/modules/school/images/img200x200.jpg" alt="..." class="img-rounded"><br>
                                                                        <button type="button" class="btn btn-default btn-xs" style="width:200px; height:auto; position: relative;bottom: 22px; background-color: rgba(158, 158, 158, 0.33);"><input type="checkbox" style="float: left;">
                                                                          <span class="glyphicon glyphicon-trash" aria-hidden="true" style="float: right;"></span></button>
                                                                  </div>
                                                                  <div class="col-xs-12 col-sm-3" align="center">
                                                                      <div style="width:200px; height:200px;">
                                                                        <img src="<?php echo base_url();?>assets/modules/school/images/imgplus.jpg" alt="..." class="img-rounded"><br>
                                                                      </div>
                                                                  </div>
                                                            </div>

                                                      </div>
                                                  </div>
                                                </div>

                                                <button class="btn btn-default"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                                <center>
                                                        <button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> บันทึก</button>
                                                        <button type="button" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิก</button>
                                                </center>


                                </div>
                            </div>

                           <!--
                            <div id="tab-2" <?php /*if($usrpm['app_id']==23){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }*/?>>
                                <div class="panel-body">
                                    <strong>Tab-2</strong>
                                </div>
                            </div>
                          -->


                        </div>


                    </div>
                </div>
            </div>

<!-- Delete Modal -->
<div id="dltModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
