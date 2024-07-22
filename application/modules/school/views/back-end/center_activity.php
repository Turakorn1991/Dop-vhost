<?php
$stdActivities = $this->db->get('std_care_activity')->result_array();
?>
<script src='<?=base_url('assets/modules/school/js/center_activity.js')?>'></script>
            <div id="alive_tab1" class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                    <ul class="nav nav-tabs">
                            <li>
                              <?php
$tmp = $this->admin_model->getOnce_Application(171);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(171, $user_id); //Check User Permission
?>
                                <a  <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/center_info/Edit/' . $center_info['qlc_id']); ?>" <?php }?>  <?php if ($usrpm['app_id'] == 3) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>> (1) ศพอส.</a>
                            </li>
                            <li>
                              <?php
$tmp = $this->admin_model->getOnce_Application(172);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(172, $user_id); //Check User Permission
?>
                                <a <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/center_kpi/Edit/' . $center_info['qlc_id']); ?>" <?php }?>  <?php if ($usrpm['app_id'] == 4) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>>(2) มาตรฐานตัวชี้วัด</a>
                            </li>
                            <li class="active">
                              <?php
$tmp = $this->admin_model->getOnce_Application(173);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(173, $user_id); //Check User Permission
?>
                                <a  <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/center_activity/Edit/' . $center_info['qlc_id']); ?>" <?php }?>  data-toggle="tab" <?php if ($usrpm['app_id'] == 5) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>>(3) ผลการดำเนินกิจกรรม</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if ($usrpm['app_id'] == 169) {?>class="tab-pane active" <?php } else {?> class="tab-pane"<?php }?>> <!--163,169แสดงเนื้อหาแบบขึ้นทะเบียน ศพอส-->
                                <div class="panel-body">


                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);
                                            
                                            $("#guide-book").click(function(){
                                              window.open('/assets/modules/school/guide/Center_Manual.pdf', '_blank');
                                            }); 
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

if ($process_action == 'Add') {$process_action = 'Added';}

if ($process_action == 'Edit') {$process_action = 'Edited';@$schl_id = '/' . $center_info['qlc_id'];}

echo form_open_multipart('school/center_info/' . $process_action . $schl_id, array('id' => 'form1'));
?>

                                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <!--1-->
                                    <div class="panel-group">
                                          <!--2-->
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>ผลการดำเนินกิจกรรมของ ศพอส.</h4>
                                              </div>

                                              <!--3-->
                                              <div class="panel-body" style="border:0; padding: 20px;">

                                                  <!--กรอกข้อมูล ศพอส-->
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-9 has-error"> <!-- col-sm-12 -->
                                                        <label for="" class="col-2 col-form-label">ชื่อหน่วยงาน ศพอส.</label> <!-- control-label col-md-3 col-sm-3 col-xs-12 -->
                                                        <div class='qlc-name-label'><?=$center_info['qlc_name']?></div>
                                                        <input type="text" class="form-control hidden" name="center_info[qlc_name]" title="ชื่อหน่วยงาน ศพอส." value="<?=$center_info['qlc_name']?>" placeholder="ระบุชื่อหน่วยงาน" disabled>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"> <!--ต้องกลับมาแก้ปี-->
                                                        <!--ปีที่เริ่มดำเนินการ (ปี พ.ศ. ที่ก่อตั้ง)-->
                                                        <br />
                                                        <div id="new-activity-insert" style="height: 40px;width: 49% !important;line-height:32px;" class="btn btn-search btn-primary" data-toggle="modal" data-target="#activity-insert-modal">
                                                          <i class="fa fa-plus-circle"></i>
                                                          เพิ่ม
                                                        </div>
                                                        <div style="height: 40px;width: 49% !important;line-height:32px;" class="btn btn-cancel btn-primary"
                                                          onclick="window.location.href='<?=site_url('school/center_list')?>'">
                                                          <i class="fa fa-caret-left"></i>
                                                          ย้อนกลับ
                                                        </div>
                                                    </div>
                                                  </div>
                                                  <!--จบ กรอกข้อมูล ศพอส-->


                                                  <!--กรอกข้อมูล ศพอส-->
                                                  <br />

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-6">
                                                          <label>ศพอส. มีการดำเนินกิจกรรมไปแล้วทั้งหมด <?=count($activities)?> กิจกรรม</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 right" style="padding-right: 0px;">
                                                        <input data-column="1" type="text" class="form-control numberonly column_filter" id="col1_filter" placeholder="ระบุกิจกรรมที่จะค้นหา" maxlength="13">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3 right" style="padding-right: 15px;">
                                                        <button id="filtersearch" class="btn btn-primary btn-save" type="button"  title="ค้นหา" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
                                                        <button id="btnclear" class="btn btn-primary  btn-cancel" type="button" title="ค้นหา" style=" background-color: #2f4050;border: 1px;"><i class="fa fa-refresh" aria-hidden="true"></i> ล้างค่า</button>
                                                    </div>
                                                  </div>
                                                  <!--จบ กรอกข้อมูล ศพอส-->


                                                  <div class="row">
                                                    <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                                  </div>


                                                  <!--ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->

                                                  <!--ตาราง รร ในสังกัด ศพอส.-->

                                                  <div class="table-responsive">

                                                    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                      <thead style="font-size: 15px;">
                                                        <tr>
                                                            <th style="width:2% !important;" class="text-center">#</th>
                                                            <th style="width:17% !important;" class="text-center">ชื่อกิจกรรม</th>
                                                            <th style="width:17% !important;" class="text-center">ประเภทกิจกรรม</th>
                                                            <th style="width:17% !important;" class="text-center">หน่วยงานที่ให้บริการ</th>
                                                            <th style="width:10% !important;" class="text-center">วันที่เริ่มต้นกิจกรรม</th>
                                                            <th style="width:10% !important;" class="text-center">วันที่สิ้นสุดกิจกรรม</th>
                                                            <th style="width:11% !important;" class="text-center">งบประมาณที่ใช้จริง (บาท)</th>
                                                            <th style="width:8% !important;" class="text-center">ผู้เข้าร่วม</th>
                                                            <th style="width:8% !important;" class="text-center">แก้ไข</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php foreach ($activities as $i => $activity): ?>
                                                        <tr>
                                                          <td class="text-left"><?=$i + 1?></td>
                                                          <td class="text-left">
                                                            <?=$activity['acti_name']?>
                                                          </td>
                                                          <td class="text-left">
<?php
foreach ($stdActivities as $acti) {
    if ($acti['care_acti_id'] == $activity['cate_acti']) {
        echo $acti['care_acti_title'] . ($activity['care_acti_custom'] ? ": {$activity['care_acti_custom']}" : "");
    }
}
?>
                                                          </td>
                                                          <td class="text-right"><?=$activity['acti_agency']?></td>
                                                          <td class="text-left"><?=$activity['start_date']?></td>
                                                          <td class="text-center"><?=$activity['end_date']?></td>
                                                          <td class="text-center"><?=$activity['budget']?></td>
                                                          <td class='text-center'>
                                                            <div class="btn-group" style="cursor: pointer;">
                                                              <a class="goto_tab2" style="font-size:16px;" activity_label='<?="{$activity['acti_name']} ({$activity['start_date']} - {$activity['end_date']})"?>' acti_id='<?=$activity['acti_id']?>'>
                                                                <i
                                                                  class="fa fa-search select-activity"
                                                                  aria-hidden="true"
                                                                  style="color: #000"
                                                                  title='แสดงผู้เข้าร่วม'
                                                                  acti-id='<?=$activity['acti_id']?>'
                                                                  qlc-id='<?=$center_info['qlc_id']?>'></i>
                                                              </a>
                                                            </div>
                                                          </td>
                                                          <td class='text-center'>
                                                            <i
                                                              class="fa fa-edit edit-activity"
                                                              style="color:#000;cursor:pointer;"
                                                              title='แก้ไขกิจกรรม'
                                                              acti-id='<?=$activity['acti_id']?>'
                                                              data-toggle="modal"
                                                              data-target="#activity-update-modal">
                                                            </i>
                                                          </td>
                                                        </tr>
                                                        <?php endforeach;?>
                                                      </tbody>
                                                    </table>

                                                  </div>
                                                  <!--จบ ตาราง รร ใน สังกัด ศพอส.-->
                                                <!--จบ ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->

                                              </div>
                                          </div>
                                      </div>

                                    <?php
echo form_close();
?>

                                    </div> <!-- close form group row-->

                                    <hr style="margin-top: 0px;">

                                    <div class="row">
                                      <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                      <div class="col-xs-12 col-sm-2">
                                        <!--<button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>-->
                                      </div>
                                    </div><!-- close class row-->



                                    <div id="alive_tab2"></div>
                                </div>
                            </div>




                            <div id="tab-2" <?php if ($usrpm['app_id'] == 169) {?>class="tab-pane active" <?php } else {?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                <div class="form-group row">
                                      <!--1-->
                                      <div class="panel-group">
                                          <!--2-->
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>ข้อมูลรายชื่อผู้สูงอายุที่เข้าร่วมกิจกรรม</h4>
                                              </div>

                                              <!--3-->
                                              <div class="panel-body" style="border:0; padding: 20px;">


                                                  <!--กรอกข้อมูล ศพอส-->
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-9 "> <!-- col-sm-12 has-error -->
                                                        <label for="" class="col-2 col-form-label" style="color: ;">ชื่อกิจกรรม</label> <!-- control-label col-md-3 col-sm-3 col-xs-12 style="color:red;"-->
                                                        <input type="text" class="form-control activity_label" name="center_info[qlc_name]" title="ชื่อกิจกรรม" value="-" disabled> <!--$center_info['qlc_name']-->
                                                    </div>
                                                  </div>
                                                  <!--จบ กรอกข้อมูล ศพอส-->
                                                  <form method='post' id='activity-member-form' action="<?=base_url('school/center_activity_detail/clear_participants')?>">
                                                    <div class='btn btn-white form-download disabled' style='display:inline-block;'>
                                                      <i class="fa fa-cloud-download"></i>
                                                      ดาวน์โหลดแบบฟอร์มนักเรียน
                                                    </div>
                                                    <div class='btn btn-white form-import disabled' style='display:inline-block;'>
                                                      <i class="fa fa-upload"></i>
                                                      นำเข้ารายชื่อนักเรียน
                                                    </div>
                                                    <div class='btn btn-danger disabled' style='display:inline-block;'>
                                                      <i class="fa fa-trash"></i>
                                                      ลบชื่อนักเรียนทั้งหมด
                                                    </div>
                                                    <input type="hidden" name='acti_id' value=''>
                                                    <input type="hidden" name='qlc_id' value=''>
                                                    <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>" />
                                                  </form>
                                                  <form
                                                    id='member-import-form'
                                                    method="post"
                                                    enctype="multipart/form-data"
                                                    action="<?=base_url('school/center_activity_detail/import_participants')?>"
                                                  >
                                                    <input
                                                      id='member-import-input'
                                                      type="file"
                                                      class='hidden'
                                                      name='importfile'
                                                    >
                                                    <input type="hidden" name='acti_id' value=''>
                                                    <input type="hidden" name='qlc_id' value=''>
                                                    <input type="hidden" name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>" />
                                                  </form>

                                                  <!--กรอกข้อมูล ศพอส-->
                                                  <br />

                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-12">
                                                      <label>ผู้สูงอายุที่เข้าร่วมกิจกรรม มีทั้งหมด <span id='participants-count'>0</span> คน ดังนี้</label>
                                                    </div>
                                                  </div>
                                                  <!--จบ กรอกข้อมูล ศพอส-->


                                                  <!--ตาราง รร ในสังกัด ศพอส.-->

                                                  <div class="table-responsive">

                                                    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                      <thead style="font-size: 15px;">
                                                        <!--<tr>
                                                            <th colspan="7" class="text-center">7. กิจกรรมฝึกอบรมแรงงานผู้สูงอายุ ให้บริการโดยกรมพัฒนาฝีมือแรงงาน ณ วันที่ 22/พ.ย./2559 ถึง 22/พ.ย./2559</th>
                                                        </tr>-->
                                                        <tr>
                                                            <th style="width:2% !important;" class="text-center">#</th>
                                                            <th style="width:16% !important;" class="text-center">หมายเลขบัตรประชาชน</th>
                                                            <th style="width:10% !important;" class="text-center">คำนำหน้า</th>
                                                            <th style="width:23% !important;" class="text-center">ชื่อตัว</th>
                                                            <th style="width:23% !important;" class="text-center">ชื่อนามสกุล</th>
                                                            <th style="width:10% !important;" class="text-center">อายุ</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody class='participant_list'>
                                                        <tr>
                                                          <td colspan=7 class='text-center'>ระบุกิจกรรมเพื่อแสดงผู้เข้าร่วม</td>
                                                        </tr>
                                                      </tbody>
                                                    </table>

                                                  </div>
                                                  <!--จบ ตาราง รร ใน สังกัด ศพอส.-->


                                              </div>
                                              </div>
                                              </div>

                                              </div><!-- close from group row-->




                                              <div id="alive_tab2"></div>

                                </div>
                            </div>


                            <div id="tab-3" <?php if ($usrpm['app_id'] == 5) {?>class="tab-pane active" <?php } else {?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div>
                            </div>




                        </div><!-- close tab-content-->


                    </div>
                </div>
            </div>

            <script type="text/javascript">


                  <?php if ($process_action == 'Edited') {?>
                  setTimeout(function(){$("#Province").val('<?php echo @$center_info['addr_province']; ?>').trigger('change');},200);
                  //setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
                  // setTimeot(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);

                <?php }?>
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
                      <?php echo $csrf['name']; ?>: '<?php echo $csrf['hash']; ?>'
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
        <p><?php echo $str; ?></p>
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
        <p><?php echo $str; ?></p>
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
        <p><?php echo $str; ?></p>
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
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(7, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 7) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

          <?php
$tmp = $this->admin_model->getOnce_Application(8);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(8, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 8) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

          <?php
$tmp = $this->admin_model->getOnce_Application(9);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(9, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 9) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

          <?php
$tmp = $this->admin_model->getOnce_Application(10);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(10, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 10) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

         </div>
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->

<script>
  if (fetch === undefined)
    alert('Please use Chrome browser');

  $(".goto_tab2").click(function() {
      $('html,body').animate({
          scrollTop: $("#alive_tab2").offset().top},
          'slow');
      if ($(this).attr('acti_id')) {
        $('.activity_label').val($(this).attr('activity_label'));
        fetch('<?=$link['get_participants_ajax']?>' + $(this).attr('acti_id'))
          .then(resp => {
            if (resp.status === 200)
              return resp.json();
          })
          .then(participants => {
            $('.participant_list').html(participants.map((p,i) => {
                return '<tr><td>' + (i+1) + '</td>' +
                  '<td>' + p.pid + '</td>' +
                  '<td>' + p.parti_title_th + '</td>' +
                  '<td>' + p.parti_firstname_th + '</td>' +
                  '<td>' + p.parti_lastname_th + '</td>' +
                  '<td>' + p.parti_age + '</td></tr>'
              }).join(''));
            $('#participants-count').text(participants.length);
          });
      }
  });
</script>
<!-- End Slide to View Result -->
<style>
  #activity-insert-modal label {
    font-weight: 100;
  }
  .datepicker-dropdown:after,
  .datepicker-dropdown:before {
    content: none !important;
  }
</style>
<div class="modal fade" id="activity-insert-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลกิจกรรม</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form method='post' id='insert-activity-form' action="<?=base_url('school/center_activity_detail/insert_activity')?>">
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">วัน เดือน ปี เริ่มกิจกรรม</label>
              <input type="text" class="form-control" name="start_date" value="" data-provide="datepicker" data-date-language="th-th" autocomplete="off">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">วัน เดือน ปี จบกิจกรรม</label>
              <input type="text" class="form-control" name="end_date" value="" data-provide="datepicker" data-date-language="th-th" autocomplete="off">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">ชื่อกิจกรรม</label>
              <input type="text" class="form-control" name="acti_name" value="">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">ประเภทกิจกรรม</label>
              <select class="form-control" name="cate_acti" id="">
                <option disabled selected>กรุณาเลือก</option>
<?php
foreach ($stdActivities as $acti) {
    echo "<option value='{$acti['care_acti_id']}'>{$acti['care_acti_title']}</option>";
}
echo "<input name='care_acti_custom' type='text' class='form-control' placeholder='โปรดระบุ' style='display:none'>";
?>
              </select>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">หน่วยงานที่ให้บริการ</label>
              <input type="text" class="form-control" name="acti_agency" value="">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">งบประมาณ</label>
              <input type="text" class="form-control" name="budget" value="">
            </div>
            <input type="hidden" name='qlc_id' value='<?=$center_info['qlc_id']?>'>
            <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>" />
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <div id='insert-activity-btn' class="btn btn-primary btn-save" style='margin-bottom:0;'>
          <i class="fa fa-save"></i>
          บันทึก
        </div>
        <div class="btn btn-cancel btn-primary" data-dismiss="modal" style='margin-bottom:0;'>
          <i class="fa fa-caret-left"></i>
          ย้อนกลับ
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="activity-update-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">ข้อมูลกิจกรรม</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form method='post' id='update-activity-form' action="<?=base_url('school/center_activity_detail/update_activity')?>">
            <input type='hidden' name='acti_id'>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">วัน เดือน ปี เริ่มกิจกรรม</label>
              <input type="text" class="form-control" name="start_date" value="" data-provide="datepicker" data-date-language="th-th" autocomplete="off">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">วัน เดือน ปี จบกิจกรรม</label>
              <input type="text" class="form-control" name="end_date" value="" data-provide="datepicker" data-date-language="th-th" autocomplete="off">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">ชื่อกิจกรรม</label>
              <input type="text" class="form-control" name="acti_name" value="">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">ประเภทกิจกรรม</label>
              <select class="form-control" name="cate_acti">
                <option disabled selected>กรุณาเลือก</option>
<?php
foreach ($stdActivities as $acti) {
    echo "<option value='{$acti['care_acti_id']}'>{$acti['care_acti_title']}</option>";
}
echo "<input name='care_acti_custom' type='text' class='form-control' placeholder='โปรดระบุ' style='display:none'>";
?>
              </select>
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">หน่วยงานที่ให้บริการ</label>
              <input type="text" class="form-control" name="acti_agency" value="">
            </div>
            <div class="form-group col-xs-12 col-md-6">
              <label class="col-form-label">งบประมาณ</label>
              <input type="text" class="form-control" name="budget" value="">
            </div>
            <input type="hidden" name='qlc_id' value='<?=$center_info['qlc_id']?>'>
            <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>" />
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <div id='update-activity-btn' class="btn btn-primary btn-save" style='margin-bottom:0;'>
          <i class="fa fa-save"></i>
          บันทึก
        </div>
        <div class="btn btn-cancel btn-primary" data-dismiss="modal" style='margin-bottom:0;'>
          <i class="fa fa-caret-left"></i>
          ย้อนกลับ
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const activities = <?=json_encode($activities)?>;
  let dateTHtoDB = d => {
    d = d.split('/').reverse();
    d[0] -= 543;
    return d.join('-');
  }, dateDBtoTH = d => {
    d=d.split('-');
    d[0] = +d[0] + 543;
    return d.reverse().join('/');
  };

  // submit insert data
  (() => {
    const scope = '#activity-insert-modal';
    $('[name=date_from],[name=date_to]', scope).datepicker();
    $('#insert-activity-btn', scope).click(() => {
      let ready = true;
      $('#insert-activity-form [name]', scope).each((i,ele) => ready = ready && $(ele).val());
      if (!ready) return;

      $('[name=start_date]', scope).val(dateTHtoDB($('[name=start_date]', scope).val()));
      $('[name=end_date]', scope).val(dateTHtoDB($('[name=end_date]', scope).val()));
      $('#insert-activity-form', scope).submit();
    });
  })();

  // submit update data
  (() => {
    const scope = '#activity-update-modal';
    $('[name=date_from],[name=date_to]', scope).datepicker();
    $('#update-activity-btn', scope).click(() => {
      let ready = true;
      $('#update-activity-form [name]', scope).each((i,ele) => ready = ready && $(ele).val());
      if (!ready) return;

      $('[name=start_date]', scope).val(dateTHtoDB($('[name=start_date]', scope).val()));
      $('[name=end_date]', scope).val(dateTHtoDB($('[name=end_date]', scope).val()));
      $('#update-activity-form', scope).submit();
    });
  })();

  (() => {
    // render existing data
    const scope = '#activity-update-modal';
    $('.fa.fa-edit.edit-activity').click(e => {
      let actiId = $(e.target).attr('acti-id'),
        editingActivity = activities.filter(a=>a.acti_id==actiId)[0];
      editingActivity.start_date = dateDBtoTH(editingActivity.start_date);
      editingActivity.end_date = dateDBtoTH(editingActivity.end_date);
      $('[name]', scope).each((i, ele) => {
        if (editingActivity[$(ele).attr('name')])
          $(ele).val(editingActivity[$(ele).attr('name')]);
      });
      if ($('[name=cate_acti]', scope).val() == 21)
        $('[name=care_acti_custom]', scope).show();
    });
    $('.fa.fa-search.select-activity').click(e => {
      $('#activity-member-form [name=acti_id], #member-import-form [name=acti_id]').val($(e.target).attr('acti-id'));
      $('#activity-member-form [name=qlc_id], #member-import-form [name=qlc_id]').val($(e.target).attr('qlc-id'));
      $('#activity-member-form .btn').removeClass('disabled');
    });
  })();

  (() => {
    $('#activity-member-form .form-download').click(e => {
      if ($(e.target).hasClass('disabled')) return e.preventDefault();
      window.location.href = "<?=base_url("school/center_activity_detail/download_member_form")?>";
    });
    $('#activity-member-form .form-import').click(e => {
      if ($(e.target).hasClass('disabled')) return e.preventDefault();
      $('#member-import-input').click();
    });
    $('#member-import-input').change(e => {
      $('#member-import-form').submit();
    });
    $('#activity-member-form .btn.btn-danger').click(e => {
      if ($(e.target).hasClass('disabled')) return e.preventDefault();
      $('#activity-member-form').submit();
    });
  })();

  (() => {
    $('[name=cate_acti]').change(function() {
      if ($(this).val() == '21')
        $(this).next().show();
      else {
        $(this).next().val('').hide();
      }
    });
  })();
</script>