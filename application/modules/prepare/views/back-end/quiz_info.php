
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                      
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(55); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/quiz_list/Edit/'.@$prep_dkm_info['dkm_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==55){?>aria-expanded="true" <?php }?>> แบบทดสอบ</a>
                            </li>
                      </ul>

<!--                       <div id="tmp_menu" hidden='hidden'>
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('prepare/prepare_list');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                      </div> -->
                      <script>
                        setTimeout(function(){
                          $("#menu_topright").html($("#tmp_menu").html());
                        },300);
                      </script>

                        <div class="tab-content">
                          <div class="family_members_template" hidden='hidden'>
                            <div class="family_members_items" style="margin-top: -10px;">
                                  <div class="form-group row">
                                    <div class="col-xs-1 col-sm-1 text-right">
                                      <span class="badge" style="width: 34px; height: 34px; font-size: 16px;  padding: 9px; border-radius: 50%; color: #ffffff; background-color: #2F4050;"> myID </span>
                                    </div>
                                    <div class="col-xs-10 col-sm-10 has-error">
                                        <!-- <label for="" class="col-2 col-form-label">&nbsp;</label> -->
                                        <!-- <span class="badge"> myID </span> -->
                                        <input name="q[myID]" title="คำถาม" placeholder="ระบุคำถาม" class="form-control" type="text"/>
                                    </div>

                                    <div class="col-xs-1 col-sm-1">
                                        <!-- <label for="" class="col-2 col-form-label">&nbsp;</label><br> -->
                                        <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="width: 60px; padding-top: 3px;padding-bottom: 1px;color: #ffffff; background-color: #2F4050;"><i class="fa fa-minus" aria-hidden="true"></i></button>                  
                                    </div>
                                  </div>

                                  <div class="row" style="margin-bottom: 15px">
                                    <div class="col-xs-2 text-right">
                                      <div class="checkbox-inline i-checks"><input type="checkbox" onchange="set_enable($(this),'.input_myID_1');"></div>
                                      <span class="badge" style="width: 34px; height: 34px; font-size: 20px;  padding: 6px; border-radius: 50%; color: #ffffff; background-color: #1664FA; font-weight: initial;"> ก </span>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="a[myID][]" title="คำถาม" placeholder="ระบุคำตอบ" class="form-control input_myID_1" type="text" disabled />
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="p[myID][]" title="คำถาม" placeholder="ระบุค่าคะแนน" class="form-control input_myID_1" type="number" min="0" disabled/>
                                    </div>
                                    <div class="col-xs-2">
                                      
                                    </div>
                                  </div>
                                  <div class="row" style="margin-bottom: 15px">
                                    <div class="col-xs-2 text-right">
                                      <div class="checkbox-inline i-checks"><input type="checkbox" onchange="set_enable($(this),'.input_myID_2');"></div>
                                      <span class="badge" style="width: 34px; height: 34px; font-size: 20px;  padding: 6px; border-radius: 50%; color: #ffffff; background-color: #1664FA; font-weight: initial;"> ข </span>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="a[myID][]" title="คำถาม" placeholder="ระบุคำตอบ" class="form-control input_myID_2 " type="text" disabled/>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="p[myID][]" title="คำถาม" placeholder="ระบุค่าคะแนน" class="form-control input_myID_2" type="number" min="0" disabled/>
                                    </div>
                                    <div class="col-xs-2">
                                      
                                    </div>
                                  </div>
                                  <div class="row" style="margin-bottom: 15px">
                                    <div class="col-xs-2 text-right">
                                      <div class="checkbox-inline i-checks"><input type="checkbox" onchange="set_enable($(this),'.input_myID_3');"></div>
                                      <span class="badge" style="width: 34px; height: 34px; font-size: 20px;  padding: 6px; border-radius: 50%; color: #ffffff; background-color: #1664FA; font-weight: initial;"> ค </span>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="a[myID][]" title="คำถาม" placeholder="ระบุคำตอบ" class="form-control input_myID_3" type="text" disabled/>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="p[myID][]" title="คำถาม" placeholder="ระบุค่าคะแนน" class="form-control input_myID_3" type="number" min="0" disabled/>
                                    </div>
                                    <div class="col-xs-2">
                                      
                                    </div>
                                  </div>
                                  <div class="row" style="margin-bottom: 15px">
                                    <div class="col-xs-2 text-right">
                                      <div class="checkbox-inline i-checks"><input type="checkbox" onchange="set_enable($(this),'.input_myID_4');"></div>
                                      <span class="badge" style="width: 34px; height: 34px; font-size: 20px;  padding: 6px; border-radius: 50%; color: #ffffff; background-color: #1664FA; font-weight: initial;"> ง </span>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="a[myID][]" title="คำถาม" placeholder="ระบุคำตอบ" class="form-control input_myID_4" type="text" disabled/>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="p[myID][]" title="คำถาม" placeholder="ระบุค่าคะแนน" class="form-control input_myID_4" type="number" min="0" disabled/>
                                    </div>
                                    <div class="col-xs-2">
                                      
                                    </div>
                                  </div>
                                  <div class="row" style="margin-bottom: 15px">
                                    <div class="col-xs-2 text-right">
                                      <div class="checkbox-inline i-checks"><input type="checkbox" onchange="set_enable($(this),'.input_myID_5');"></div>
                                      <span class="badge" style="width: 34px; height: 34px; font-size: 20px;  padding: 6px; border-radius: 50%; color: #ffffff; background-color: #1664FA; font-weight: initial;"> จ </span>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="a[myID][]" title="คำถาม" placeholder="ระบุคำตอบ" class="form-control input_myID_5" type="text" disabled/>
                                    </div>
                                    <div class="col-xs-4">
                                      <input name="p[myID][]" title="คำถาม" placeholder="ระบุค่าคะแนน" class="form-control input_myID_5" type="number" min="0" disabled/>
                                    </div>
                                    <div class="col-xs-2">
                                      
                                    </div>
                                  </div>
                                  <br>
                                  <script type="text/javascript">
                                    $(function(){
                                       icheck_loop();
                                     });
                                    
                                  </script>
                            </div>
                          </div>


                           
                            <div id="tab-2" <?php if($usrpm['app_id']==55){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php } ?>>
                                <div class="panel-body">
                                  <?php

                                  $dkm_id = '';
                                  if($process_action=='Add')$process_action = 'Added';
                                  if($process_action=='Edit'){$process_action = 'Edited'; $dkm_id = '/'.$prep_dkm_exr[0]['dkm_id'].'-'.@$prep_dkm_exr[0]['qstn_seq'];}

                                  echo form_open_multipart('prepare/quiz_info/'.$process_action.$dkm_id,array('id'=>'form1'));

                                  ?>

                                  <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                                  <input type="submit" value="submit" name="bt_submit" hidden="hidden">

                                  <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                  <!-- title quiz -->
                                  <div class="form-group row ">
                                      <div class="col-xs-12 col-sm-12 has-error">
                                        <label for="" class="col-2 control-label">หัวข้อคำถาม</label>
                                        <input title="หัวข้อคำถาม" placeholder="ระบุชื่อหัวข้อคำถาม" class="form-control" name="prep_dkm_exr[qstn_title]" value="<?php echo $prep_dkm_exr[0]['qstn_msg'];?>" type="text">
                                      </div>
                                  </div>
                                  <br><hr>
                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-12">
                                    <!-- <h4>เอกสารแนบ (จำนวน <span id="nums_family_members">0</span> ไฟล์)</h4> -->
                                          <script>
                                            var nummf = <?php echo count($prep_dkm_exr)+1; ?>;
                                            function btDel_family_members(node) {
                                              $(node).parent().parent().parent().remove();
                                              $("#nums_family_members").html($(".family_members .family_members_items").length);
                                            }
                                          </script>

                                          
                                          <div class="family_members" >

                                            <?php if(!empty($prep_dkm_exr)){ ?>

                                              <?php foreach ($prep_dkm_exr as $key => $value) {?>

                                                <div class="family_members_items" style="margin-top: -10px;">
                                                  <div class="form-group row">
                                                    <div class="col-xs-1 col-sm-1 text-right">
                                                      <span class="badge" style="width: 34px; height: 34px; font-size: 16px;  padding: 9px; border-radius: 50%; color: #ffffff; background-color: #2F4050;"> <?php echo $key+1; ?> </span>
                                                    </div>
                                                    <div class="col-xs-10 col-sm-10 has-error">

                                                        <input name="q[<?php echo $key+1; ?>]" title="คำถาม" placeholder="ระบุคำถาม" class="form-control" type="text" value="<?php echo $value['qstn_title'];?>" />
                                                    </div>
                                                    <div class="col-xs-1 col-sm-1">
                                                        <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="width: 60px; padding-top: 3px;padding-bottom: 1px;color: #ffffff; background-color: #2F4050;"><i class="fa fa-minus" aria-hidden="true"></i></button>                  
                                                    </div>
                                                  </div>

                                                  <?php
                                                  if (empty($value['qstn_id'])){
                                                    $value['qstn_id'] = "0";
                                                  }

                                                  if (empty($prep_dkm_info['dkm_id'])){
                                                    $prep_dkm_info['dkm_id'] = "0";
                                                  }

                                                  $arr = array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5');
                                                  $ans = $this->common_model->custom_query("SELECT * FROM prep_dkm_exr WHERE qstn_type = 'Answer' AND qstn_pid = {$value['qstn_id']} AND dkm_id = {$value['dkm_id']}");
                                                  for($i=1;$i<=5;$i++){ ?>
  
                                                  <div class="row" style="margin-bottom: 15px">
                                                    <div class="col-xs-2 text-right">
                                                      <div class="checkbox-inline i-checks">
                                                      <input type="checkbox" onchange="set_enable($(this),'.input_<?php echo $key+1; ?>_<?php echo $i;?>');" <?php if(@$ans[$i-1]['qstn_title'] != ''){ echo "checked";} ?>>
                                                    </div>
                                                      <span class="badge" style="width: 34px; height: 34px; font-size: 20px;  padding: 6px; border-radius: 50%; color: #ffffff; background-color: #1664FA; font-weight: initial;"> <?php echo $arr[$i]; ?> </span>
                                                    </div>
                                                    <div class="col-xs-4">
                                                      <input name="a[<?php echo $key+1; ?>][]" title="คำถาม" placeholder="ระบุคำตอบ" class="form-control input_<?php echo $key+1; ?>_<?php echo $i;?>" type="text" value="<?php echo @$ans[$i-1]['qstn_title'];?>" <?php if(@$ans[$i-1]['qstn_title'] == ''){ echo "disabled";} ?> />
                                                    </div>
                                                    <div class="col-xs-4">
                                                      <input name="p[<?php echo $key+1; ?>][]" title="คำถาม" placeholder="ระบุค่าคะแนน" class="form-control input_<?php echo $key+1; ?>_<?php echo $i;?>" type="number" min="0" value="<?php echo @$ans[$i-1]['ans_full_score'];?>" <?php if(@$ans[$i-1]['ans_full_score'] == ''){ echo "disabled";} ?>/>
                                                    </div>
                                                    <div class="col-xs-2">
                                                      
                                                    </div>
                                                  </div>
                                                  <?php } ?>
                                                  <br>
                                            </div>
                                              <?php } ?>
                                            <?php } ?>
                                          </div>
                                          
                                         <!--  <button type="button" class="btn btn-default" id="btAdd_family_members" style="color: #ffffff; background-color: #2F4050;padding-bottom: 4px;"><i class="fa fa-plus" aria-hidden="true"></i></button> -->
                                     <!--    //  <input type="" name=""> -->
                                          <?php if(!empty($prep_dkm_exr)){ ?>
                                            <div class="form-group row">
                                                <div class="col-xs-1 col-sm-1 text-right">
                                                  <span class="badge" style="width: 34px; height: 34px; font-size: 16px;  padding: 9px; border-radius: 50%; color: #ffffff; background-color: #2F4050;"> 15 </span>
                                                </div>
                                                <div class="col-xs-10 col-sm-10 has-error">

                                                    <input name="q[15]" title="คำถาม" placeholder="ระบุคำถาม" class="form-control" type="text" value="ท่านมีการเตรียมความพร้อมเข้าสู่  “สังคมผู้สูงอายุ” ทางด้านสุขภาพ ทรัพย์สิน สังคม และที่อยู่อาศัยอย่างไร">
                                                </div>
                                                <div class="col-xs-1 col-sm-1">
                                                    <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="width: 60px; padding-top: 3px;padding-bottom: 1px;color: #ffffff; background-color: #2F4050;"><i class="fa fa-minus" aria-hidden="true"></i></button>                  
                                                </div>
                                            </div>
                                          <div class="row" style="margin-bottom: 15px">
                                                  <div class="col-xs-12  col-sm-12 text-center">
                                                      <textarea style=" height: 100px; width: 80%; margin: 0; padding: 0; border-width: 2;"></textarea>
                                                    </div>
                                                    
                                          </div>
                                          <?php } ?>

                                          <button type="button" class="btn btn-default" id="btAdd_family_members" style="color: #ffffff; background-color: #2F4050;padding-bottom: 4px;"><i class="fa fa-plus" aria-hidden="true"></i></button>

                                          <script>
                                            var cloneTmp = $('.family_members_template').clone();
                                            <?php if(empty($prep_dkm_exr)){ ?>
                                              setTimeout(function(){addFmlyMember();},500);
                                            <?php } ?>

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

                                         <hr>
                                        <div class="row">
                                         <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                         <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('prepare/quiz_list');?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                        </div>
                                      </div><!-- close class row-->
                                          
                                   
                                </div>
                            </div>
                          


                        </div>


                    </div>
                </div>
            </div>
<script type="text/javascript">

  function icheck_loop() {

    $('.i-checks').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%'
    });

    $("input[type='checkbox']").on('ifChanged',function(){
        if($(this).prop('checked')){
            $(this).parent().parent().parent().next().children().prop('disabled',false).focus();
            $(this).parent().parent().parent().next().next().children().prop('disabled',false);
        }else{
            $(this).parent().parent().parent().next().children().prop('disabled',true);
            $(this).parent().parent().parent().next().next().children().prop('disabled',true);
            $(this).parent().parent().parent().next().children().val('');
            $(this).parent().parent().parent().next().next().children().val('');
        }
        
    });

  };

  function set_enable(elem,target='') {
    if(elem.prop('checked') == true) {
      $(target).prop('disabled', false );
      $(target).first().focus();
    }else{
      $(target).val('');
      $(target).prop('disabled', true );
    }
  }
</script>            

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
