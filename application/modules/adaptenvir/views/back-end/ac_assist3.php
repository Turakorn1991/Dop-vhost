            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                          <li >
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(37);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_inquire1/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?>  <?php if($usrpm['app_id']==37){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php } ?>> (1) ข้อมูลผู้สูงอายุ
                              </a>
                          </li>
                          <li >
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(38);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(38,$user_id); //Check User Permission
                            ?>
                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_agree2/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> <?php if($usrpm['app_id']==38){?>aria-expanded="true" <?php }?>>(2) ยินยอม</a>
                          </li>
                          <li class="active">
                            <?php
                              $tmp = $this->admin_model->getOnce_Application(39);
                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
                            ?>
                              <a data-toggle="tab" <?php if(!isset($tmp1['perm_status'])) {?>
                                  readonly
                                <?php }else if($process_action!='Add'){?> href="<?php echo site_url('adaptenvir/ac_assist3/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> <?php if($usrpm['app_id']==39){?>aria-expanded="true" <?php }?>>(3) สงเคราะห์</a>
                          </li>
                      </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==37){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-1</strong>
                                </div>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==38){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-2</strong>
                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==39){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
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
                                                  $tmp = $this->admin_model->getOnce_Application(39);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
                                                ?>
                                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                  readonly
                                                <?php }else{?> onclick="return opnCnfrom()" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกช้อมูล" class="btn btn-default">
                                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                </a>


                                                &nbsp;
                                                <?php
                                                  $tmp = $this->admin_model->getOnce_Application(39);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
                                                ?>
                                                <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                  readonly
                                                <?php }else{?> href="<?php echo site_url('adaptenvir/ac_agree2/Edit/'.$impv_place_info['impv_place_id']);?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                                </a>

                                                <?php
                                                if($process_action=='Edit') {
                                                ?>
                                                &nbsp;
                                                <?php
                                                  $tmp = $this->admin_model->getOnce_Application(39);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
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
                                          <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="" data-toggle="modal" data-target="#myPrint">
                                          <i class="fa fa-file-text" aria-hidden="true"></i> </a>
                                        <?php }?>

                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(39);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
                                        ?>
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                        <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?> onclick="return opnCnfrom()"
                                        <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> </a>
                                         -->
                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(39);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
                                        ?>

                                        <!--
                                        <?php
                                         if($process_action=='Edit') {
                                          $tmp = $this->admin_model->getOnce_Application(39);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(39,$user_id); //Check User Permission
                                        ?>
                                        <a data-id=<?php echo $impv_place_info['impv_place_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                        <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?>
                                        <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
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



                                  <div class="form-group row">
                                      <?php
                                      $impv_place_id = '';

                                      if($process_action=='Add')$process_action = 'Added';
                                      if($process_action=='Edit'){$process_action = 'Edited'; $impv_place_id = '/'.$impv_place_info['impv_place_id'];}

                                      echo form_open_multipart('adaptenvir/ac_assist3/'.$process_action.$impv_place_id,array('id'=>'form1'));
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
                                                <div class="panel-heading"><h4>ผลการสงเคราะห์</h4>  </div>
                                                <div class="panel-body" style="border:0; padding: 20px;">

                                                        <div class="form-group row">
                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">ผลการพิจารณา</label><br>
                                                              <label>
                                                                <div class="checkbox-inline i-checks"><input type="radio" name="impv_place_info[consi_result]" value="อนุมัติ" <?php if(@$impv_place_info['consi_result'] == 'อนุมัติ'){ echo 'checked'; } ?>>
                                                                ได้รับอนุมัติ
                                                              </label></div>

                                                          </div>
                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">&nbsp;</label><br>
                                                              <div class="checkbox-inline i-checks"><label>
                                                                <input type="radio" name="impv_place_info[consi_result]" value="ไม่อนุมัติ" <?php if(@$impv_place_info['consi_result'] == 'ไม่อนุมัติ'){ echo 'checked'; } ?>>
                                                                ไม่ได้รับอนุมัติ
                                                              </label></div>
                                                          </div>

                                                          <div class="col-xs-12 col-sm-6">
                                                              <label for="" class="col-2 col-form-label">&nbsp;</label>
                                                              <input title="ระบุสาเหตุ" placeholder="ระบุสาเหตุ" class="form-control" type="text" name="impv_place_info[consi_result_remark]" id="consi_result_remark" value="<?php echo @$impv_place_info['consi_result_remark'];?>" <?php if(@$impv_place_info['consi_result'] != 'ไม่อนุมัติ'){ echo 'disabled'; } ?>/>
                                                          </div>
                                                          <script type="text/javascript">
                                                            $("input[name='impv_place_info[consi_result]']").on('ifChanged',function() {
                                                                if($(this).val() == 'ไม่อนุมัติ'){
                                                                  $("#consi_result_remark").prop('disabled', false ).focus();
                                                                }else{
                                                                  $("#consi_result_remark").val('');
                                                                  $("#consi_result_remark").prop('disabled', true );
                                                                }
                                                            });
                                                          </script>
                                                        </div>

                                                        <div class="form-group row">
                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">ผลการดำเนินงาน</label>
                                                              <label>&nbsp;</label>
                                                          </div>
                                                          <div class="col-xs-12 col-sm-3">
                                                                <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ดำเนินการเสร็จสิ้น </label>
                                                                <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                                    <input title="วันที่ดำเนินการเสร็จสิ้น" placeholder="เลือกวันที่" class="form-control" type="text" name="impv_place_info[date_of_finish]" required>
                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                                <script type="text/javascript">
                                                                <?php
                                                                $tmp = explode('-',@$impv_place_info['date_of_finish']);
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
                                                              <label for="" class="col-2 col-form-label">งบประมาณที่ใช้ไป (บาท)</label>
                                                              <input title="งบประมาณที่ใช้ไป (บาท)" placeholder="งบประมาณที่ใช้ไป (บาท)" class="form-control numberonly" type="text" name="impv_place_info[case_budget]" value="<?php echo @$impv_place_info['case_budget'];?>"/>
                                                          </div>
                                                        </div>

                                                        <div class="form-group row">
                                                          <div class="col-xs-12 col-sm-2">
                                                              <label for="" class="col-2 col-form-label">ภาพถ่ายประกอบ</label>
                                                              <label>&nbsp;</label>
                                                          </div>
                                                        </div>

                                                        <!-- UPDATE IMG-->
                                                        <div class="form-group row">
                                                          <div class="col-xs-12 col-sm-12" id="parent_0">

                                                              <?php if(($process_action!='Add')&&($process_action!='Added')){

                                                                      foreach($impv_photo as $key_photo => $value_photo){

                                                              ?>

                                                                      <div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">

                                                                            <button type="button" class="btn btn-lg" style="width: 100%; height:150px; display: none" name="btn[]"  onclick="brwImg(this,'')">
                                                                                <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                                                            </button>
                                                                          <div class="container2"><img src="<?php echo base_url();?>assets/modules/adaptenvir/images/<?php echo $value_photo['impv_place_photo_file']; ?>" alt="..."  class="image">
                                                                               <div class="overlay">
                                                                                  <input type="checkbox" class="che_del" > <span class="glyphicon glyphicon-trash trash" aria-hidden="true" onclick="Del_photo(this,<?php echo $value_photo['impv_place_photo_id'];?>)"></span>
                                                                               </div>
                                                                          </div>
                                                                     </div>

                                                                      <?php }// close loop foreach ?>

                                                                      <?php }// //close loop if(($process_action!='Add')&&($process_action!='Added')) ?>

                                                                    <div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">
                                                                          <input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,'');">
                                                                          <button type="button" class="btn btn-lg" style="width: 100%; height:150px;"   onclick="brwImg(this,'');">
                                                                                <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                                                          </button>
                                                                    </div>

                                                             </div>
                                                      </div><!-- close form-group row-->


                                                     </div>




                                </div><!-- close panel-body-->
                            </div><!-- close tab-3-->

                        </div>

                        <hr>
                        <div class="row">
                         <div class="col-xs-12 col-sm-8">&nbsp;</div>
                         <div class="col-xs-12 col-sm-2">
                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                        </div>
                        <div class="col-xs-12 col-sm-2">
                          <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('adaptenvir/ac_agree2/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                        </div>
                      </div><!-- close class row-->

                    </div>
                </div>
            </div>

            <script>
                                                      $('#parent_0').on('change',':checkbox',function(){
                                                          var status_che = $(this).prop('checked');


                                                             if(status_che==true){
                                                               $(this).parent().css('height','30px');
                                                             }else{
                                                                $(this).parent().css('height','');
                                                             }
                                                       });

                                                      $('#parent_0').on('click','.trash',function(){

                                                         if(confirm('กรุณายืนยันการลบ')){
                                                             $('#parent_0  :checkbox').each(function(){

                                                               if($(this).prop('checked')==true){
                                                                  $(this).parent().parent().parent().remove();
                                                               }
                                                             });

                                                                 $(this).parent().parent().parent().remove();

                                                               }
                                                     });

                                                     function brwImg (node,myID){
                                                             $(node).prev().click();
                                                             //console.log($(node).prev());
                                                          }



                                                          function imgchange(node,myID){

                                                                            //var countFiles = $(this)[0].files.length;

                                                                    var imgPath = $(node)[0].value;

                                                                    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                                                                                                                                                         //Get count of selected files
                                                                       //var image_holder = $("#image-holder");
                                                                       //image_holder.empty();
                                                                if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                                                                          if (typeof(FileReader) != "undefined") {
                                                                             //loop for each file selected for uploaded.
                                                                             //for (var i = 0; i < countFiles; i++) {
                                                                        var reader = new FileReader();

                                                                        reader.onload = function(e) {

                                                                        //console.log(e.target.result);

                                                                        var img_file = '<div class="container2"><img src="'+e.target.result+'" alt="..."  class="image">\
                                                                                        <div class="overlay">\
                                                                                            <input type="checkbox" class="che_del" > <span class="glyphicon glyphicon-trash trash" aria-hidden="true"></span>'+
                                                                                        '</div></div>';

                                                                         $(img_file).appendTo($(node).parent());
                                                                         $(node).siblings('button').css('display','none');



                                                                     var add_img = '<div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">\
                                                                                       <input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,\'\');">'+
                                                                                       '<button type="button" class="btn btn-lg" style="width: 100%; height:150px;"   onclick="brwImg(this,\'\');">'+
                                                                                           '<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>'+
                                                                                       '</button>\
                                                                                     </div>';

                                                                        $(node).parent().parent().append(add_img);

                                                                          }

                                                                        //  image_holder.show();
                                                                          reader.readAsDataURL($(node)[0].files[0]);

                                                                      }

                                                                        else {
                                                                          alert("This browser does not support FileReader.");
                                                                            }

                                                                  } else {
                                                                          alert("กรุณาเลือกไฟล์เป็นชนิด รูปภาพ");
                                                                        }

                                                          }//close loop function

                                                          function Del_photo(node,id_photo){

                                                                 $.ajax({
                                                                    url: base_url+'adaptenvir/del_impv_place_photo',
                                                                    type: 'POST',
                                                                    dataType: 'html',
                                                                    data: {
                                                                    'id_photo': id_photo,
                                                                    <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                                                                    },
                                                                   success: function(result){
                                                                       if(result=="remove"){
                                                                        $('node').parent().parent().parent().remove();
                                                                       }
                                                                   }
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
<div class="modal fade" id="myPrint" role="dialog">
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
