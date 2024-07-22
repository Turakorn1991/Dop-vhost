
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                        <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(54); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(54,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/prepare_info/Edit/'.@$prep_dkm_info['dkm_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==54){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> คลังความรู้</a>
                            </li>
<!--                             <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(56); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/quiz_list/Edit/'.$prep_dkm_info['dkm_id']);?>" <?php }?> <?php if($usrpm['app_id']==56){?>aria-expanded="true" <?php }?>> แบบทดสอบ</a>
                            </li> -->
                      </ul>

                        <div class="tab-content">
                          <div class="family_members_template" hidden='hidden'>
                            <div class="family_members_items" style="margin-top: -10px;">
                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-6">
                                        <!-- <label for="" class="col-2 col-form-label">เกี่ยวของเป็น</label> -->
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput">
                                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                <span class="fileinput-filename">ไฟล์ชนิด .PDF, .MP3, .MP4, .M4V, .JPG และ .PNG เท่านั้น</span>
                                            </div>
                                            <span class="input-group-addon btn btn-default btn-file">
                                                <span class="fileinput-new">Browse</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="fileAtt[myID]"/>
                                            </span>
                                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                       </div>
                                    </div>
                                    <div class="col-xs-11 col-sm-5">
                                        <!-- <label for="" class="col-2 col-form-label">&nbsp;</label> -->
                                        <input name="fileDes[myID]" title="คำอธิบาย" placeholder="คำอธิบาย" class="form-control" type="text"/>
                                    </div>
                                    <div class="col-xs-1 col-sm-1">
                                        <!-- <label for="" class="col-2 col-form-label">&nbsp;</label><br> -->
                                        <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this)" style="width: 60px;"><i class="fa fa-minus" aria-hidden="true"></i></button>                  
                                    </div>
                                  </div>
                            </div>
                          </div>

                            <div id="tab-1" <?php if($usrpm['app_id']==54){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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
                                                    $tmp = $this->admin_model->getOnce_Application(55);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                      <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(55);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('prepare/prepare_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  <?php
                                                  if($process_action=='Edit') {
                                                  ?>
                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(55);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id=<?php echo $prep_dkm_info['dkm_id'];?> onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
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
                                            <a data-toggle="modal" data-target="#myPrint" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                       
                                             title="พิมพ์แบบฟอร์ม">
                                            <i class="fa fa-file-text" aria-hidden="true"></i> 
                                            </a>
                                            <?php }?>

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(52); 
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
                                            ?>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }else{?> onclick="return opnCnfrom()" 
                                            <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> 
                                            </a>
                                            -->

                                           
                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(52); 
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
                                            ?>
<!--                                             <a onclick="return opnBck()" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }else{?> href="<?php echo site_url('prepare/prepare_list'); ?>" 
                                            <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                             -->
                                            <!--
                                            <?php
                                              if($process_action=='Edit') {
                                              $tmp = $this->admin_model->getOnce_Application(52); 
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
                                            ?>
                                            <a data-id=<?php echo $prep_dkm_info['dkm_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly 
                                                  <?php }else{ ?>  
                                            <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                            <?php } ?>
                                           
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                            -->
                                          </div>
                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);
                                          </script>

                                  <div class="form-group row">

                                      <?php
                                      $dkm_id = '';

                                      if($process_action=='Add')$process_action = 'Added';
                                      if($process_action=='Edit'){$process_action = 'Edited'; $dkm_id = '/'.$prep_dkm_info['dkm_id'];}

                                      echo form_open_multipart('prepare/prepare_info/'.$process_action.$dkm_id,array('id'=>'form1'));
                                      ?>

                                      <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                      <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                      <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <div class="panel-group">
                                      <div class="panel panel-default" style="border: 0">
                                        <!-- <div class="panel-heading">
                                          <h4>ข้อมูลผู้สูงอายุ <label>&nbsp;</label></h4>
                                        </div> -->

                                        <div class="panel-body" style="border:0; padding: 20px;">
                                          <div class="form-group row ">
                                            <div class="col-xs-12 col-sm-9">

                                              <div class="form-group row has-error">
                                                <div class="col-xs-12 col-sm-12">
                                                  <label for="" class="col-2 control-label">ชื่อองค์ความรู้</label>
                                                  <input title="ชื่อองค์ความรู้" placeholder="ระบุชื่อองค์ความรู้" class="form-control" type="text" name="prep_dkm_info[dkm_title]" value="<?php echo $prep_dkm_info['dkm_title'];?>" required/>
                                                </div>
                                              </div>

                                              <div class="form-group row has-error">
                                                <!-- <label for="" class="col-2 control-label">ประเภท</label> -->
                                                <div class="col-xs-12 col-sm-12 dropdown">
                                                  <label for="example-text-input" class="col-2 control-label">ประเภท</label>
                                                  <div class="col-10">
                                                    <?php $akm_cate = $this->common_model->custom_query("SELECT * FROM std_dkm_cate WHERE dkm_cate_parent_id = 0"); ?>
                                                    <select id="sub0" name="dkm_cate_code[]" title="ประเภทองค์ความรู้" placeholder="เลือกประเภทองค์ความรู้" class="form-control" onchange='genCate(this,"sub1","<?php echo setZeroString(substr($prep_dkm_info['dkm_cate_code'],0,4),8,'R'); ?>")' required>
                                                        <option value="">เลือกประเภทองค์ความรู้</option>
                                                        <?php foreach ($akm_cate as $key => $value) { ?>
                                                          <option value="<?php echo $value['dkm_cate_code'];?>"><?php echo $value['dkm_cate_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 dropdown">
                                                  <label for="example-text-input" class="col-2 control-label"></label>
                                                  <div class="col-10">
                                                    <select id="sub1" name="dkm_cate_code[]" title="ประเภทองค์ความรู้" placeholder="เลือกประเภทองค์ความรู้" class="form-control" onchange='genCate(this,"sub2","<?php echo $prep_dkm_info['dkm_cate_code']; ?>")' disabled>
                                                        <option>เลือกประเภทองค์ความรู้</option>
                                                        <!-- <option>ประเภทที่ 1</option>
                                                        <option>ประเภทที่ 2</option>
                                                        <option>ประเภทที่ 3</option> -->
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 dropdown">
                                                  <label for="example-text-input" class="col-2 control-label"></label>
                                                  <div class="col-10">
                                                    <select id="sub2" name="dkm_cate_code[]" title="ประเภทองค์ความรู้" placeholder="เลือกประเภทองค์ความรู้" class="form-control" disabled>
                                                        <option>เลือกประเภทองค์ความรู้</option>
                                                        <!-- <option>ประเภทที่ 1</option>
                                                        <option>ประเภทที่ 2</option>
                                                        <option>ประเภทที่ 3</option> -->
                                                    </select>
                                                  </div>
                                                </div>
                                                <script type="text/javascript">
                                                  <?php if($prep_dkm_info['dkm_cate_code'] != ''){ ?>
                                                    $('#sub0').val('<?php echo setZeroString(substr($prep_dkm_info['dkm_cate_code'],0,2),8,'R'); ?>').trigger('change');
                                                  <?php } ?>
                                                  function genCate(item,target,opSelect=''){
                                                    $.ajax({
                                                      url: base_url+'prepare/get_option',
                                                      type: 'POST',
                                                      dataType: 'json',
                                                      data: {
                                                        'code': item.value,
                                                        'type': target,
                                                        <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                                      },
                                                    })
                                                    .done(function(ret) {
                                                      console.log("success");
                                                      console.dir(ret);
                                                      $('#'+target).empty();
                                                      if(ret.length != 0){
                                                        $('#'+target).prop('disabled', false);
                                                      }else{
                                                        $('#'+target).prop('disabled', true);
                                                      }
                                                      $('#'+target).append($('<option>', { 
                                                        value: '',
                                                        text : 'เลือกประเภทองค์ความรู้', 
                                                      }));
                                                      for (var i = 0; i < ret.length ; i++) {
                                                        
                                                        if(ret[i].dkm_cate_code == opSelect){
                                                          $('#'+target).append($('<option>', { 
                                                            value: ret[i].dkm_cate_code,
                                                            text : ret[i].dkm_cate_name 
                                                          }).attr('selected', true));
                                                          $('#'+target).val(opSelect).trigger('change');
                                                        }else{
                                                          $('#'+target).append($('<option>', { 
                                                            value: ret[i].dkm_cate_code,
                                                            text : ret[i].dkm_cate_name 
                                                          }));
                                                        }
                                                      }
                                                      // if(opSelect != ''){
                                                      //   $('#'+target).val(opSelect).trigger('change');
                                                      // }
                                                    })
                                                    .fail(function() {
                                                      console.log("error");
                                                    });
                                                  }
                                                </script>
                                              </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3">
                                              <label for="" class="col-2 control-label">ภาพหน้าปก</label>
                                              <img onclick="$('#att_tmb_file').click();" class="img-responsive perview" src="<?php if($prep_dkm_info['att_tmb_file'] != ''){ echo path($prep_dkm_info['att_tmb_file'],'prepare');}else{ echo path('default_image.png','prepare');}?>">
                                              <input id="att_tmb_file" onchange="imgPerview(this,'.perview');" type="file" accept="image/*" name="att_tmb_file" style="display: none;">
                                              <script type="text/javascript">
                                                function imgPerview(input,target){
                                                  if (input.files && input.files[0]) {
                                                    var reader = new FileReader();
                                                    reader.onload = function (e) {
                                                      $(target).attr('src', e.target.result);
                                                    }
                                                    reader.readAsDataURL(input.files[0]);
                                                  }else{
                                                    $(target).attr('src', '<?php echo path('default_image.png','prepare'); ?>');
                                                  }
                                                }
                                              </script>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-12">
                                              <label for="" class="col-2 control-label">รายละเอียด</label>
                                              <textarea class="form-control" rows="5" name="prep_dkm_info[dkm_describe]"><?php   echo $prep_dkm_info['dkm_describe']; ?></textarea>
                                            </div>
                                          </div>

                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-12">
                                            <?php $count_files = count(@$prep_dkm_info_file); ?>
                                            <h4>เอกสารแนบ (จำนวน <span id="nums_family_members"><?php echo $count_files; ?></span> ไฟล์)</h4>
                                                  <script>
                                                    var nummf = <?php echo $count_files; ?>;
                                                    function btDel_family_members(node,fileID='') {
                                                      if(fileID==''){
                                                        $(node).parent().parent().parent().remove();
                                                        $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                      }else{
                                                        $.ajax({
                                                          url: '<?php echo site_url("prepare/delFile"); ?>',
                                                          type: 'POST',
                                                          dataType: 'json',
                                                          data: {
                                                            dkm_file_id: fileID,
                                                            <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                                          },
                                                        })
                                                        .done(function() {
                                                          console.log("success");
                                                          $(node).parent().parent().parent().remove();
                                                          $("#nums_family_members").html($(".family_members .family_members_items").length);
                                                        })
                                                        .fail(function() {
                                                          console.log("error");
                                                        });
                                                      }
                                                    }
                                                  </script>

                                                  <div class="family_members">
                                                    <?php if($process_action == 'Edited'){ ?>
                                                      <?php foreach ($prep_dkm_info_file as $key => $attRow) { ?>
                                                        <div class="family_members_items" style="margin-top: -10px;">
                                                          <div class="form-group row">
                                                            <div class="col-xs-12 col-sm-6">
                                                                <!-- <label for="" class="col-2 col-form-label">เกี่ยวของเป็น</label> -->
                                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                    <div class="form-control" data-trigger="fileinput">
                                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                                        <span class="fileinput-filename"><?php echo $attRow['dkm_file']; ?></span>
                                                                    </div>
                                                                    <span class="input-group-addon btn btn-default btn-file">
                                                                        <span class="fileinput-new">Browse</span>
                                                                        <span class="fileinput-exists">Change</span>
                                                                        <!-- <input type="file" name="fileAtt[myID]"/> -->
                                                                    </span>
                                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                               </div>
                                                            </div>
                                                            <div class="col-xs-11 col-sm-5">
                                                                <!-- <label for="" class="col-2 col-form-label">&nbsp;</label> -->
                                                                <input name="fileDes[<?php echo $key; ?>]" title="คำอธิบาย" placeholder="คำอธิบาย" class="form-control" type="text" value="<?php echo $attRow['dkm_file_label']; ?>" />
                                                            </div>
                                                            <div class="col-xs-1 col-sm-1">
                                                                <!-- <label for="" class="col-2 col-form-label">&nbsp;</label><br> -->
                                                                <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this,<?php echo $attRow['dkm_file_id']; ?>)" style="width: 60px;"><i class="fa fa-minus" aria-hidden="true"></i></button>                  
                                                            </div>
                                                          </div>
                                                        </div>
                                                      <?php } ?>
                                                    <?php } ?>
                                                  </div>

                                                  <button type="button" class="btn btn-default" id="btAdd_family_members"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                                  
                                                  <script>
                                                    var cloneTmp = $('.family_members_template').clone();
                                                    // setTimeout(function(){addFmlyMember();},500);

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

                                          <div class="form-group row">
                                            <div class="col-xs-12 col-sm-6">
                                              <label for="" class="col-2 control-label">แหล่งที่มา (หน่วยงานเจ้าของข้อมูล)</label>
                                              <input title="แหล่งที่มา (หน่วยงานเจ้าของข้อมูล)" placeholder="ระบุแหล่งที่มา (หน่วยงานเจ้าของข้อมูล)" class="form-control" type="text" name="prep_dkm_info[dkm_provider]" value="<?php echo $prep_dkm_info['dkm_provider'];?>" />
                                            </div>

                                            <div class="col-xs-12 col-sm-6">
                                              <label for="" class="col-2 control-label">สถานะการเผยแพร่</label><br>
                                              <input type="checkbox" name="prep_dkm_info[public_status]" value="เผยแพร่" class="js-switch" style="display: none;" data-switchery="true" <?php if($prep_dkm_info['public_status'] == 'เผยแพร่'){ echo "checked";} ?>>
                                              <span style="color: #3890FE;"> (ผู้เข้าชม <?php echo $prep_dkm_info['stat_views']; ?> ราย ทดสอบ <?php echo $prep_dkm_info['stat_tests']; ?> ราย)</span>
                                            </div>
                                          </div>


                                        

                                        </div>

                                       

                                      </div>

                                     

                                    </div>

                                  </div>
                                         <hr>
                                        <div class="row">
                                         <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                         <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                        </div>
                                        <div class="col-xs-12 col-sm-2">
                                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('prepare/prepare_list');?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                        </div>
                                      </div><!-- close class row-->
                                </div>
                              </div>
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
