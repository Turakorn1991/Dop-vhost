<?php
  class Sufferer_form2_model extends CI_Model {
      function __construct() {
          parent::__construct();
      }

      function getAll_Trouble(){
          return $this->common_model->getTableOrder('std_trouble', 'trb_id', 'ASC');
      }
      function getAll_Helps(){
          return $this->common_model->getTableOrder('std_help', 'help_id', 'ASC');
      }
      function getAll_Helps_guide(){
          return $this->common_model->getTableOrder('std_help_guide', 'help_guide_id', 'ASC');
      }
  }

  $this->load->model('sufferer_form2_model');
?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(3);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1/Edit/'.$diff_info['diff_id']);?>" <?php }?> <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }?>> (1) แจ้งเรื่อง</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(4);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(4,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form2/Edit/'.$diff_info['diff_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) ตรวจเยี่ยม</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(5);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(5,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                    <?php //echo site_url('difficult/sufferer_form3/Edit/'.$diff_info['diff_id']);?>
                                  <?php }else{?> href="#" <?php }?>  <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }?>>(3) สงเคราะห์</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <strong>Tab-1</strong>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==4){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                   <!--
                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d">ระบบฐานข้อมูลยากลำบาก</h2>
                                            <div class="col-lg-12 text-right  border-bottom">

                                                  <a data-toggle="modal" data-target="#myPrint" style="color: #000; padding-left: 20px; padding-right: 20px;" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                      <i class="fa fa-file-text" aria-hidden="true"></i>
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
                                                  <?php }else{?> href="<?php echo site_url('difficult/assist_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(3);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id=111 onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ลบข้อมูล" class="btn btn-default">
                                                      <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                  </a>

                                            </div>
                                        </div>
                                    </div>
                                    -->

                                    <div id="tmp_menu" hidden='hidden'>
                                            <!--
                                             <?php
                                             if($process_action=='Edit') {

                                            ?>
                                            <a data-toggle="modal" data-target="#myPrint" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"

                                             title="พิมพ์แบบฟอร์ม">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </a>
                                            <?php }?>

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(3);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                            ?>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()"
                                            <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            </a>
                                            -->


                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(3);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                            ?>

                                            <!--
                                            <?php
                                              if($process_action=='Edit') {
                                              $tmp = $this->admin_model->getOnce_Application(3);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                            ?>
                                            <a data-id=<?php echo $diff_info['diff_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{ ?>
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

                                    <div class="form-group row" style="margin-bottom: 5px;">
                                    <?php
                                    $diff_id = '';

                                    if($process_action=='Add')$process_action = 'Added';
                                    if($process_action=='Edit'){$process_action = 'Edited'; $diff_id = '/'.$diff_info['diff_id'];}

                                    echo form_open_multipart('difficult/sufferer_form2/'.$process_action.$diff_id,array('id'=>'form1'));
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">

                                    <?php echo validation_errors('<div class="error" style="font-size: 14px; padding-left: 20px">', '</div>'); ?>

                                    <div class="panel-group" style="margin-bottom: 0px;">
                                          <div class="panel panel-default" style="border: 0;">
                                              <!-- <div class="panel-heading"><h4>ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) (<label><input type="checkbox" name=""> บุคคลเดียวกับผู้ยื่นคำขอ</label>) <button class="btn btn-default" style="float: right;">ข้อมูลบูรณาการ</button></h4></div> -->
                                              <div class="panel-body" style="border: 0;padding: 20px; padding-bottom: 5px;">
                                                  <div class="form-group row" >
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="datetimepicker1" class="col-2 col-form-label">ผู้ตรวจเยี่ยม : </label>
                                                      <span color='#eee'>
                                                      <?php
                                                        echo $diff_info['visitor_user_id'];
                                                      ?>
                                                      </span>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="datetimepicker1" class="col-2 col-form-label">หน่วยงาน : </label>
                                                      <span color='#eee'>
                                                      <?php
                                                        echo $diff_info['visitor_org_id'];
                                                      ?>
                                                      </span>
                                                    </div>
                                                   
                                                  </div>
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-3">
                                                        <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ตรวจเยี่ยม </label>
                                                        <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                          <input title="วันที่ตรวจเยี่ยม" placeholder="เลือกวันที่" class="form-control" type="text" name="diff_info[date_of_visit]" required/>
                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                      </div>
                                                        <script type="text/javascript">
                                                        <?php
                                                        $tmp = explode('-',@$diff_info['date_of_visit']);
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
                                                    <div class="col-xs-12 col-sm-3 dropdown">
                                                        <label for="example-text-input" class="col-2 col-form-label" style="color: red;">สถานที่ตรวจเยี่ยม </label>
                                                        <div class="col-10 has-error">
                                                        <select id="visit_place" title="สถานที่ตรวจเยี่ยม" placeholder="เลือกสถานที่ตรวจเยี่ยม" class="form-control" name="diff_info[visit_place]" required>
                                                            <option value="">เลือกสถานที่ตรวจเยี่ยม</option>
                                                            <option value="ที่พักอาศัย" <?php if($diff_info['visit_place'] == "ที่พักอาศัย") { echo "selected";} ?>>ที่พักอาศัย</option>
                                                            <option value="โรงพยาบาล" <?php if($diff_info['visit_place'] == "โรงพยาบาล") { echo "selected";} ?>>โรงพยาบาล</option>
                                                            <option value="สถานีตำรวจ" <?php if($diff_info['visit_place'] == "สถานีตำรวจ") { echo "selected";} ?>>สถานีตำรวจ</option>
                                                            <option value="อื่น ๆ" <?php if($diff_info['visit_place'] == "อื่น ๆ") { echo "selected";} ?>>อื่น ๆ</option>
                                                        </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                        <label for="" class="col-2 col-form-label">&nbsp;</label>
                                                        <input id="visit_place_identify" title="ระบุ" placeholder="ระบุ" class="form-control" type="text" name="diff_info[visit_place_identify]" value="<?php echo $diff_info['visit_place_identify']; ?>" disabled="<?php if($diff_info['visit_place'] == "อื่น ๆ") { echo "true";}else{ echo "false";} ?>" />
                                                    </div>
                                                    <script type="text/javascript">
                                                      $("#visit_place").change(function () {
                                                        if($(this).val() == "อื่น ๆ"){
                                                          $("#visit_place_identify").prop('disabled', false ).focus();
                                                        }else{
                                                          $("#visit_place_identify").val('');
                                                          $("#visit_place_identify").prop('disabled', true );
                                                        }
                                                      });
                                                    </script>
                                                  </div>


                                                  <div class="form-group row" style="font-size: 15px;">
                                                    <div class="col-xs-12 col-sm-12">
                                                      <label for="example-text-input" class="col-2 col-form-label">สภาพปัญหา</label>
                                                    </div>
                                                    <?php $trouble = $this->sufferer_form2_model->getAll_Trouble();?>
                                                    <?php foreach ($trouble as $key => $value) {?>

                                                      <?php if ($value !== end($trouble)){ ?>
                                                        <div class="row">
                                                              <div class="col-xs-12 col-sm-3" style="padding: 4px 15px; padding-left: 30px;">
                                                                <div class="i-checks"><label><input id="chk-<?php echo $value['trb_code']; ?>" type="checkbox" name="diff_trouble[trb_code][<?php echo $value['trb_code']; ?>]" value="<?php echo $value['trb_code']; ?>" <?php if(@$diff_trouble[$value['trb_code']]['trb_code'] == $value['trb_code']){ echo 'checked';} ?> onChange="set_enable($(this),'#trb-<?php echo $value['trb_code'];?>');"> <?php echo $value['trb_title']; ?></label></div>
                                                              </div>
                                                              <div class="col-xs-12 col-sm-9" style="padding: 3px 15px">
                                                                <input id="trb-<?php echo $value['trb_code']; ?>" title="ความคิดเห็นนักสังคมสงเคราะห์/ผู้สำรวจ" placeholder="ความคิดเห็นนักสังคมสงเคราะห์/ผู้สำรวจ" class="form-control" type="text" name="diff_trouble[trb_remark][<?php echo $value['trb_code']; ?>]" value="<?php echo @$diff_trouble[$value['trb_code']]['trb_remark']; ?>" <?php if(!isset($diff_trouble[$value['trb_code']]['trb_remark'])) { echo "disabled";} ?> />
                                                              </div>
                                                        </div>
                                                      <?php }else{ ?>
                                                        <div class="row">
                                                        <div class="col-xs-12 col-sm-3" style="padding: 4px 15px; padding-left: 30px;">
                                                          <div class="i-checks"><label><input id="chk-<?php echo $value['trb_code']; ?>" type="checkbox" name="diff_trouble[trb_code][<?php echo $value['trb_code']; ?>]" value="<?php echo $value['trb_code']; ?>" <?php if(@$diff_trouble[$value['trb_code']]['trb_code'] == $value['trb_code']){ echo 'checked';} ?> onChange="set_enable($(this),'#trb-<?php echo $value['trb_code'];?>');"> <?php echo $value['trb_title']; ?></label></div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-9" style="padding: 3px 15px">
                                                          <input id="trb-<?php echo $value['trb_code']; ?>" title="อื่นๆ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text" name="diff_trouble[trb_remark][<?php echo $value['trb_code']; ?>]" value="<?php echo @$diff_trouble[$value['trb_code']]['trb_remark']; ?>" <?php if(!isset($diff_trouble[$value['trb_code']]['trb_remark'])) { echo "disabled";} ?> />
                                                        </div>
                                                        </div>
                                                      <?php } ?>

                                                      <script type="text/javascript">

                                                           $("input[name='diff_trouble[trb_code][<?php echo $value['trb_code']; ?>]']").on('ifChanged',function(){

                                                                if($(this).prop('checked')){
                                                                       $('#trb-<?php echo $value['trb_code']; ?>').prop('disabled',false).focus();
                                                                }else{
                                                                       $('#trb-<?php echo $value['trb_code']; ?>').prop('disabled',true);
                                                                }

                                                           });

                                                     </script>

                                                    <?php } ?>
                                                    <!-- <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> อื่นๆ</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="อื่นๆ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text"/>
                                                    </div> -->
                                                  </div>


                                                  <div class="form-group row" style="font-size: 15px;">
                                                    <div class="col-xs-12 col-sm-12">
                                                      <label for="example-text-input" class="col-2 col-form-label">ผลการให้ความช่วยเหลือ</label>
                                                    </div>
                                                    <?php $helps = $this->sufferer_form2_model->getAll_Helps();?>
                                                    <?php foreach ($helps as $key => $value) {?>
                                                      <?php if ($value !== end($helps)){ ?>
                                                            <?php if($value['help_title']!="ประสานส่งต่อหน่วยงานที่เกี่ยวข้อง") { ?>
                                                              <div class="row">
                                                              <div class="col-xs-12 col-sm-12" style="padding: 4px 15px; padding-left: 30px;">
                                                                <div class="i-checks"><label><input type="checkbox" name="diff_help[help_code][<?php echo $value['help_code']; ?>]" value="<?php echo $value['help_code']; ?>" <?php if(@$diff_help[$value['help_code']]['help_code'] == $value['help_code']){ echo 'checked';} ?>> <?php echo $value['help_title']; ?></label></div>
                                                              </div>
                                                              </div>

                                                              <?php }else{ ?>
                                                              <div class="row">
                                                              <div class="col-xs-12 col-sm-3" style="padding: 4px 15px; padding-left: 30px;">
                                                                <div class="i-checks"><label><input type="checkbox" name="diff_help[help_code][<?php echo $value['help_code']; ?>]" value="<?php echo $value['help_code']; ?>" <?php if(@$diff_help[$value['help_code']]['help_code'] == $value['help_code']){ echo 'checked';} ?>> <?php echo $value['help_title']; ?></label></div>
                                                              </div>

                                                              <div class="col-xs-12 col-sm-9" style="padding: 3px 15px">
                                                                <input id="hlp-<?php echo $value['help_code'];?>" title="ระบุหน่วยงาน" placeholder="ระบุหน่วยงาน" class="form-control" type="text" name="diff_help[help_remark][<?php echo $value['help_code']; ?>]"  value="<?php echo @$diff_help[$value['help_code']]['help_remark']; ?>" <?php if(!isset($diff_help[$value['help_code']]['help_remark'])) { echo "disabled";} ?> />
                                                              </div>
                                                              </div>

                                                              <?php }?>
                                                      <?php }else{ ?>
                                                        <div class="row">
                                                        <div class="col-xs-12 col-sm-3" style="padding: 4px 15px; padding-left: 30px;">
                                                          <div class="i-checks"><label><input type="checkbox" name="diff_help[help_code][<?php echo $value['help_code']; ?>]" value="<?php echo $value['help_code']; ?>" <?php if(@$diff_help[$value['help_code']]['help_code'] == $value['help_code']){ echo 'checked';} ?> onChange="set_enable($(this),'#hlp-<?php echo $value['help_code'];?>');"> <?php echo $value['help_title']; ?></label></div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-9" style="padding: 3px 15px">
                                                          <input id="hlp-<?php echo $value['help_code'];?>" title="อื่นๆ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text" name="diff_help[help_remark][<?php echo $value['help_code']; ?>]"  value="<?php echo @$diff_help[$value['help_code']]['help_remark']; ?>" <?php if(!isset($diff_help[$value['help_code']]['help_remark'])) { echo "disabled";} ?> />
                                                        </div>
                                                        </div>



                                                      <?php } ?>

                                                      <script type="text/javascript">

                                                       $("input[name='diff_help[help_code][<?php echo $value['help_code']; ?>]']").on('ifChanged',function(){

                                                        if($(this).prop('checked')){
                                                         $('#hlp-<?php echo $value['help_code'];?>').prop('disabled',false).focus();
                                                       }else{
                                                         $('#hlp-<?php echo $value['help_code'];?>').prop('disabled',true);
                                                       }

                                                     });

                                                   </script>
                                                    <?php } ?>

                                                    <!-- <div class="col-xs-12 col-sm-12">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div> -->
                                                    <!-- <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div> -->

                                                   <!--  <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> อื่นๆ</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="อื่นๆ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text"/>
                                                    </div> -->
                                                  </div>

                                                  <div class="form-group row" style="font-size: 15px;">
                                                    <div class="col-xs-12 col-sm-12">
                                                      <label for="example-text-input" class="col-2 col-form-label">แนวทางการให้ความช่วยเหลือต่อไป</label>
                                                    </div>

                                                    <?php $help_guide = $this->sufferer_form2_model->getAll_Helps_guide();?>
                                                    <?php foreach ($help_guide as $key => $value) {?>
                                                      <?php if ($value !== end($help_guide)){ ?>
                                                        <div class="row">
                                                        <div class="col-xs-12 col-sm-3" style="padding: 4px 15px; padding-left: 30px;">
                                                          <div class="i-checks"><label><input type="checkbox" name="diff_help_guide[help_guide_code][<?php echo $value['help_guide_code']; ?>]" value="<?php echo $value['help_guide_code']; ?>" <?php if(@$diff_help_guide[$value['help_guide_code']]['help_guide_code'] == $value['help_guide_code']){ echo 'checked';} ?> onChange="set_enable($(this),'#hlp_guide-<?php echo $value['help_guide_code'];?>');"> <?php echo $value['help_guide_title']; ?></label></div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-9" style="padding: 3px 15px">
                                                          <input id="hlp_guide-<?php echo $value['help_guide_code'];?>" title="ความคิดเห็นนักสังคมสงเคราะห์/ผู้สำรวจ" placeholder="ความคิดเห็นนักสังคมสงเคราะห์/ผู้สำรวจ" class="form-control" type="text" name="diff_help_guide[help_guide_remark][<?php echo $value['help_guide_code']; ?>]" value="<?php echo @$diff_help_guide[$value['help_guide_code']]['help_guide_remark']; ?>"  <?php if(!isset($diff_help_guide[$value['help_guide_code']]['help_guide_remark'])) { echo "disabled";} ?>/>
                                                        </div>
                                                        </div>
                                                      <?php }else{ ?>
                                                        <div class="row">
                                                        <div class="col-xs-12 col-sm-3" style="padding: 4px 15px; padding-left: 30px;">
                                                          <div class="i-checks"><label><input type="checkbox" name="diff_help_guide[help_guide_code][<?php echo $value['help_guide_code']; ?>]" value="<?php echo $value['help_guide_code']; ?>" <?php if(@$diff_help_guide[$value['help_guide_code']]['help_guide_code'] == $value['help_guide_code']){ echo 'checked';} ?> onChange="set_enable($(this),'#hlp_guide-<?php echo $value['help_guide_code'];?>');"> <?php echo $value['help_guide_title']; ?></label></div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-9" style="padding: 3px 15px">
                                                          <input id="hlp_guide-<?php echo $value['help_guide_code'];?>" title="อื่นๆ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text" name="diff_help_guide[help_guide_remark][<?php echo $value['help_guide_code']; ?>]" value="<?php echo @$diff_help_guide[$value['help_guide_code']]['help_guide_remark']; ?>"  <?php if(!isset($diff_help_guide[$value['help_guide_code']]['help_guide_remark'])) { echo "disabled";} ?>/>
                                                        </div>
                                                        </div>
                                                      <?php } ?>

                                                          <script type="text/javascript">

                                                           $("input[name='diff_help_guide[help_guide_code][<?php echo $value['help_guide_code']; ?>]']").on('ifChanged',function(){

                                                            if($(this).prop('checked')){
                                                             $('#hlp_guide-<?php echo $value['help_guide_code'];?>').prop('disabled',false).focus();
                                                           }else{
                                                             $('#hlp_guide-<?php echo $value['help_guide_code'];?>').prop('disabled',true);
                                                           }

                                                         });

                                                       </script>

                                                    <?php } ?>

                                                    <!-- <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> XXXXXXXXXXXXXXXXXXXXXXXXXXXXX</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="ความคิดเห็นนักสังคมสงเคราะห์" placeholder="ความคิดเห็นนักสังคมสงเคราะห์" class="form-control" type="text"/>
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6">
                                                      <label><input type="checkbox" name=""> อื่นๆ</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6">
                                                      <input title="อื่นๆ" placeholder="อื่นๆ (ระบุ)" class="form-control" type="text"/>
                                                    </div> -->
                                                  </div>

                                                  <script type="text/javascript">
                                                    function set_enable(elem,target='') {



                                                      if(elem.prop('checked') == false) {
                                                        $(target).prop('disabled', false ).focus();
                                                      }else{
                                                        $(target).val('');
                                                        $(target).prop('disabled', true );
                                                      }
                                                    }
                                                  </script>
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
                                            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                          </div>
                                          <div class="col-xs-12 col-sm-2">
                                            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-cancel" onclick="window.location.href='<?php echo site_url('difficult/sufferer_form1/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                          </div>
                                        </div><!-- close class row-->
                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==5){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div>
                            </div>

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
              });
            </script>

<!-- Delete Modal -->
<div id="dltModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 16px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('034');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
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
        <h4 class="modal-title" style="color: #333; font-size: 16px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
        <h4 class="modal-title" style="color: #333; font-size: 16px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
<div class="modal fade" id="myPrint" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
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
            <a style="color: #333; font-size: 16px;" target="_blank" href="<?php echo site_url('report/A1?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4?id='.$diff_info['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

         </div>
         <br/>

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
