
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                        <?php $schl_id_original = $schl_id; ?>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(59);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/school1/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==59){?>aria-expanded="true" <?php }?>> (1) โรงเรียน</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(60);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(60,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/photo2/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==60){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(61);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(61,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==61){?>aria-expanded="true" <?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <strong>Tab-1</strong>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==60){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                      <div id="tmp_menu" hidden='hidden'>


                                           <!--
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

                                          </div>
                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);
                                          </script>

                                   <h3>อัลบั้มภาพถ่ายบรรยากาศการเรียน</h3>
                                   <hr>


                                   <?php
                                   if($process_action=='Edit'){$process_action = 'Edited'; $schl_id = '/'.$schl_id;}
                                   echo form_open_multipart('school/photo2/'.$process_action.$schl_id); ?>

                                      <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">




                                  <!-- === show image : start code === -->
                                  <div class="form-group row">
                                      <div class="col-xs-12 col-sm-12" id="parent_0">
                                        
                                          <?php if(($process_action!='Add')&&($process_action!='Added')){
                                                  $test_photo_query = $this->common_model->query(
                                                    "SELECT a.*, b.* 
                                                    FROM db_center.schl_photo a
                                                    left join db_center.schl_photo_album b
                                                    on a.album_id = b.album_id
                                                    where b.schl_id = $schl_id_original and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00') 
                                                    and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                    group by b.album_id order by b.album_id DESC, a.insert_datetime DESC, a.photo_id ASC, a.photo_title ASC;")->result_array();
                                                  

                                                  //$photo['value'] = $this->common_model->custom_query("SELECT * FROM tbl_fingerprint JOIN tbl_user ON tbl_user.user_id = tbl_fingerprint.fp_user_id");
                                                  //foreach($schl_photo as $key_photo => $value_photo){

                                          ?>
                                          <?php foreach ($test_photo_query as $photo_query_result) { ?>

                                                  <div class="col-xs-12 col-sm-4 element"   style="margin-top: 20px;">
<!--                                                         <button type="button" class="btn btn-lg" style="width: 100%; height:150px; display: none" name="btn[]"  onclick="brwImg(this,'')">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                                        </button> -->
                                                        <text>
                                                          <b>ชื่ออัลบั้ม : <?php echo $photo_query_result['album_title']; ?><b><br>
                                                          สร้างเมื่อวันที่ : <?php echo $photo_query_result['insert_datetime']; ?>

                                                        </text>
                                                        <div class="container2"><img src="<?php echo base_url();?>assets/modules/school/images/test_photo_upload/<?php echo $photo_query_result['photo_file_name']; ?>" alt="..."  class="image">
                                                      
                                                      <!--<div class="overlay">
                                                              <input type="checkbox" class="che_del" > <span class="glyphicon glyphicon-trash trash" aria-hidden="true" onclick="Del_photo(this,<?php echo $value_photo['schl_photo_id'];?>)"></span>
                                                           </div>-->
                                                      </div>
                                                 </div>

                                                  <?php }// close loop foreach ?>

                                          <?php }// //close loop if(($process_action!='Add')&&($process_action!='Added')) ?>

                                                <div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">
                                                      <input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,'');">
                                                      <button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,'');">
                                                            <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                                      </button>
                                                </div>

                                         </div>
                                  </div>
                                  <!-- close form-group row-->
                                  <!-- === show image : end code === -->





                                   <!--
                                   <hr>
                                          <center>
                                                <button type="button" class="btn btn-success btn-lg" onclick="return opnCnfrom()"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> บันทึก</button>
                                                <button type="button" class="btn btn-danger btn-lg" onclick="window.location.href='<?php echo site_url('school/school1/Edit'.$schl_id);?>'"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิก</button>
                                          </center>
                                          -->

<!--                                     <hr>
                                                                  <div class="row">
                                                                   <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                                                   <div class="col-xs-12 col-sm-2">
                                                                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-2">
                                                                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/school1/Edit/'.$this->uri->segment('4'));?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                                                    </div>
                                                                  </div> --><!-- close class row-->


                                  <?php echo form_close(); ?>

                                </div><!-- close panel body-->

<hr style="margin-top: 0px;">

<div class="row">
 <div class="col-xs-12 col-sm-8">&nbsp;</div>
 <div class="col-xs-12 col-sm-2">
   <button onclick='console.log("Hello")'> click </button>
  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick='console.log("Hello")'> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
</div>
<div class="col-xs-12 col-sm-2">
  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/center_list');?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
</div>
</div><!-- close class row-->
                            </div>

 <!--                            <div id="tab-3" <?php if($usrpm['app_id']==5){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div>
                            </div> -->

                        </div>


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
                                                                                       '<button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,\'\');">'+
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
                                                                    url: base_url+'school/del_schl_photo',
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