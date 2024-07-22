
<?php $schl_id_original = $schl_id; ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(59);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/school1/Edit/'.$schl_id);?>" <?php }?>  data-toggle="tab" <?php if($usrpm['app_id']==3){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) โรงเรียน</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(60);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(60,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/photo2/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==4){?>aria-expanded="true" <?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(61);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(61,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==60){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                    <div class="form-group row">

                                    <?php
                                    $schl_id = '';

                                    //if($process_action=='Add'){$process_action = 'Added';}

                                    if($process_action=='Edit'){$process_action = 'Edited'; @$schl_id = '/'.$schl_id_original;}

                                    //echo form_open_multipart('school/photo2/'.$process_action.$schl_id,array('id'=>'form1'));

                                    //echo form_open_multipart('school/photo2/'.$process_action.$schl_id);

                                    //<!=== show image : start code === -->

                                    echo form_open_multipart('school/photo2/'.$process_action.$schl_id,array('id'=>'form1'));
                                                                        
   /*                                  echo form_upload(['name'=>'userfile','value'=>'Save']);

                                    echo form_error('userfile', '<div class="text-danger">', '</div>');

                                    echo form_submit(['name'=>'submit', 'value'=>'PUBLISH IMAGE']); */

                                    //echo anchor("welcome/viewImages", 'View Images'); 
                                    
                                    //<!-- === show image : end code === -->
                                    
                                    ?>

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <!--1-->
                                    <div class="panel-group">
                                          <!--2-->
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>อัลบั้มภาพถ่ายบรรยากาศการเรียน</h4>
                                              </div>

                                              <!--3-->
                                              <div class="panel-body" style="border:0; padding: 20px;">

                                                <!--กรอกข้อมูล รร-->
                                                <div class="form-group row">
                                                  <div class="col-xs-12 col-sm-12" id="parent_0">
<!--                                                  <div class="col-xs-12 col-sm-9 has-error">
                                                          <label for="" class="col-2 col-form-label" style="color: red;">ชื่อโรงเรียนxxx </label>
                                                          <input type="text" class="form-control" name="schl_info[schl_name]" title="ชื่อโรงเรียน" value="<?php echo $schl_info['schl_name']; ?>" placeholder="ระบุชื่อโรงเรียน" required>
                                                      </div> -->


                                                      <!-- === up image : start code === -->
<!--                                                  <script> //นับตัวอักษร
                                                        function textCounter(field, cnt, maxlimit) {         
                                                          var cntfield = document.getElementById(cnt)   
                                                          if (field.value.length > maxlimit) // if too long...trim it!
                                                            field.value = field.value.substring(0, maxlimit);
                                                            // otherwise, update 'characters left' counter
                                                          else
                                                            cntfield.value = maxlimit - field.value.length;
                                                        }
                                                      </script> -->


<!--                                                  <tr id="rq17">
                                                        <td class='qnum'>17.</td>
                                                        <td class='qtext'>
                                                          Questions? <i>Maximum of 500 characters - 
                                                          <input style="color:red;font-size:12pt;font-style:italic;" readonly="readonly" type="text" id='q17length' name="q17length" size="3" maxlength="3" value="500" /> characters left</i>
                                                          <br />
                                                          <textarea 
                                                                onKeyDown="textCounter(this,'q17length',500);"
                                                                onKeyUp="textCounter(this,'q17length',500)" 
                                                                class="scanwid" name="q17" id="q17" rows="5" cols=""></textarea>
                                                        </td>
                                                      </tr> -->

                                                      <div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word;" >
                                                        <!-- <div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;"> -->

  <!--                                                       <div>
                                                          <text class="text-left"><b>
                                                          
                                                          ชื่อภาพ </b>

                                                            ( <input style="border:0px; color:red !important; width:18px;" readonly="readonly" type="text" id='photonamelength' name="photonamelength" maxlength="2" value="25" />
                                                            / 25 ) :
                                                          </text>
                                                        </div> -->
                                                                                                              
  <!--                                                  <input type="text" id="photoname" name="photoname[]" maxlength="25" 
                                                          onKeyDown="textCounter(this,'photonamelength',25);"
                                                          onKeyUp="textCounter(this,'photonamelength',25)" 
                                                          style="width:270px; margin-bottom:20px;"> --> <!-- 270px, 210px -->
                                                        
                                                        <text class="text-left">
                                                          <b style="color: red;">ชื่อภาพ* : </b>
                                                        </text>
                                                        
                                                        <input type="text" name="photo2[]" maxlength="25" style="width:210px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร";> <!-- 270px, 210px -->


                                                        <input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,'');">

                                                        <!-- <input type="file" name="userfile" value="Save" style="display: none;" onchange="imgchange(this,'');"> -->
                                                        <button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,'');">
                                                              <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                                        </button>
                                                        
                                                      </div>  <!-- close div element -->

                                                       <!-- === up image : end code === -->


                                                  </div> <!-- id="parent_0" -->

                                                <?php
                                                echo form_close();
                                                ?>

                                                </div> <!-- close form group row-->
              
                                                <hr style="margin-top: 0px;">

                                                <div class="row">
                                                  <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                                  <div class="col-xs-12 col-sm-2">
                                                    <!--<input type="submit" name="submit" value="PUBLISH IMAGE">-->

                                                  <button disabled='disabled' style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-2">
                                                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/school_list');?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                                  </div>
                                                </div><!-- close class row-->

                                                <div id="alive_tab2"></div>
                                      </div><!--3-->
                                      </div><!--2-->
                                      </div><!--1-->
                                  </div>
                                </div>
                              </div>         

                                                      
                              <div id="tab-2" <?php if($usrpm['app_id']==60){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                
                                  <!-- === show image : start code === -->
                                  <div class="form-group row">
                                    <div class="col-xs-12 col-sm-12">
                                                                              
                                          <?php //if(($process_action!='Edit')&&($process_action!='Edited')){
/*                                                   $test_photo_query = $this->common_model->query(
                                                    "SELECT a.* 
                                                    FROM schl_photo a
                                                    where a.schl_id = $schl_id_original and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                    order by a.insert_datetime DESC, a.photo_id ASC, a.photo_title ASC;")->result_array(); */

                                                    
                                                  $test_photo_query = $this->common_model->query(
                                                    "SELECT a.* 
                                                    FROM schl_photo a
                                                    where a.schl_id = $schl_id_original and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                    order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC;")->result_array();

                                                  
/*                                                   $test_photo_album_query = $this->common_model->query(
                                                    "SELECT 	
                                                        b.album_id			    as al_album_id, 
                                                        b.album_title		    as al_album_title, 
                                                        b.album_description	as al_album_description, 
                                                        b.schl_id			      as al_schl_id, 
                                                        b.insert_user_id	  as al_insert_user_id, 
                                                        b.insert_org_id		  as al_insert_org_id, 
                                                        b.insert_datetime	  as al_insert_datetime, 
                                                        b.update_user_id	  as al_update_user_id, 
                                                        b.update_org_id		  as al_update_org_id, 
                                                        b.update_datetime	  as al_update_datetime, 
                                                        b.delete_user_id	  as al_delete_user_id, 
                                                        b.delete_org_id		  as al_delete_org_id, 
                                                        b.delete_datetime   as al_delete_datetime,
                                                        a.photo_id 			    as ph_photo_id, 
                                                        a.photo_title 		  as ph_photo_title, 
                                                        a.schl_id 			    as ph_schl_id, 
                                                        a.photo_file_name 	as ph_photo_file_name, 
                                                        a.photo_thumbnail 	as ph_photo_thumbnail, 
                                                        a.photo_description as ph_photo_description, 
                                                        a.album_id 			    as ph_album_id, 
                                                        a.insert_user_id 	  as ph_insert_user_id, 
                                                        a.insert_org_id 	  as ph_insert_org_id, 
                                                        a.insert_datetime 	as ph_insert_datetime, 
                                                        a.update_user_id 	  as ph_update_user_id, 
                                                        a.update_org_id 	  as ph_update_org_id, 
                                                        a.update_datetime 	as ph_update_datetime, 
                                                        a.delete_user_id 	  as ph_delete_user_id, 
                                                        a.delete_org_id 	  as ph_delete_org_id, 
                                                        a.delete_datetime 	as ph_delete_datetime
                                                      FROM schl_photo a
                                                      JOIN schl_photo_album b 
                                                      ON a.album_id = b.album_id
                                                      where b.schl_id = $schl_id_original and a.schl_id = $schl_id_original 
                                                      and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                      and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
                                                      order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC;")->result_array(); */
                                                    
                                                  
                                                  $test_album_query = $this->common_model->query(
                                                    "SELECT b.*
                                                      FROM schl_photo_album b
                                                      where b.schl_id = $schl_id_original and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
                                                      order by b.album_id ASC, b.insert_datetime ASC, b.album_title ASC;")->result_array();


                                                  //$photo['value'] = $this->common_model->custom_query("SELECT * FROM tbl_fingerprint JOIN tbl_user ON tbl_user.user_id = tbl_fingerprint.fp_user_id");
                                                  //foreach($schl_photo as $key_photo => $value_photo){

                                          ?>
                                          <?php $i=0;
                                          foreach ($test_album_query as $album_query_result) { ?>

                                          <?php 
                                                  $album_id = $album_query_result['album_id'];

                                                  $test_album_cover_query = $this->common_model->query(
                                                    "SELECT min(a.photo_id) as min_photo_id, a.*
                                                    FROM schl_photo a
                                                    where a.schl_id = $schl_id_original and album_id = $album_id
                                                    and a.album_id not like '' and a.album_id is not null 
                                                    and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                    order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC")->result_array();
                                          ?>

                                                  <div class="col-xs-12 col-sm-4 col-lg-3 element center"   style="margin-top: 20px; height:300px; word-wrap: break-word;">
                                                        <div class="container3">
                                                          <img src="<?php echo base_url();?>assets/modules/school/images/uploads/<?php echo $test_album_cover_query[0]['photo_file_name']; ?>" alt="..."  class="image" style="display: block !important; margin-left: auto !important; margin-right: auto !important;">
                                                          <div class="overlay2">
                                                            <!-- <input type="checkbox" class="che_del" >  --><span class="glyphicon glyphicon-resize-full trash" aria-hidden="true" onclick="opnAlbum(this)" data-id="<?php echo $schl_id_original;?>" data-albumid="<?php echo $album_id;?>"></span>
                                                          </div>
                                                        </div>
                                                        <div style="margin-top:20px;">  
                                                          <text>
                                                            <!-- <b>ชื่อไฟล์ : <?php //echo $album_query_result['photo_file_name']; ?><b><br> -->
                                                            
                                                            <?php
                                                              $date = date('Y-m-d',strtotime($album_query_result['al_insert_datetime']));
                                                              $time = date('H:i:s',strtotime($album_query_result['al_insert_datetime']));
                                                            ?>
                                                              <b style="font-size: 15px;" ><i class="fa fa-book"></i> อัลบั้มที่ <?php echo ++$i.'-'.$album_id.' - '.$test_album_cover_query[0]['min_photo_id']; ?></b><br>
                                                              <b>ชื่อ : </b><?php echo $album_query_result['al_album_title']; ?><br>
                                                              <b>วันที่สร้าง : </b><?php echo 'วันที่ '.formatDateThai1($date).' เวลา '.$time ?><br>
                                                              <b>จำนวนภาพ : </b>100
                                                          </text>
                                                        </div>
                                                 </div>

                                          <?php }// close loop foreach ?>

                                    </div>
                                  </div><!-- close form-group row-->
                                  <!-- === show image : end code === -->


                                    <!-- <input type="checkbox" class="che_del" > --> <!-- <span class="glyphicon glyphicon-trash trash" style="color:red;" aria-hidden="true" onclick="opnOpal(this)" data-id="<?php echo $album_id;?>"?></span> -->

                                </div>
                            </div>

                            <!--<div id="tab-3" <?php if($usrpm['app_id']==5){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div>
                            </div> -->

                        </div><!-- close tab-content-->

              </div>
          </div>
      </div>





<!-- start opal modal -->
    <!-- start view image -->


<!-- Delete Modal -->
<div id="dltOpal" class="modal fade" role="dialog" style="width:90%; height:80%; margin-left:5%; margin-top:5%;"><!-- modal-fade-in -->
  <div class=""> <!-- modal-dialog -->
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        
      <!-- <p>OPAL TEST MODAL</p> -->
        <input type="text" name="albumid" id="albumid" value=""/>
        <h1><?php echo $_GET['albumid'];?></h1>
<!--         <button onclick="alertt()">ALERT ALBUM_ID</button> -->

<!-- === show image : start code === -->
<div class="form-group row">
                                    <div id="album-container" class="col-xs-12 col-sm-12">
                                                                              
                                          <?php 
                                                  /* $test_photo_query = $this->common_model->query(
                                                    "SELECT a.* 
                                                    FROM schl_photo a
                                                    where a.schl_id = $schl_id_original and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                    order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC;")->result_array(); */
                                          ?>
                                          <?php /*$i=0;
                                          foreach ($test_photo_query as $photo_query_result) { ?>

                                                  <div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word; font-size: 13px;
">
                                                        <div style="margin-bottom:20px;">  
                                                          <text>
                                                            <?php
                                                              $date = date('Y-m-d',strtotime($photo_query_result['insert_datetime']));
                                                              $time = date('H:i:s',strtotime($photo_query_result['insert_datetime']));
                                                            ?>
                                                            <b>ภาพที่ : <?php echo ++$i; ?><b><br>
                                                            ชื่อภาพ : <?php echo $photo_query_result['photo_title']; ?><br>
                                                            เพิ่มเมื่อ : <?php echo 'วันที่ '.formatDateThai1($date).' เวลา '.$time ?>
                                                          </text>
                                                        </div>
                                                        <div class="container2">
                                                          <img src="<?php echo base_url();?>assets/modules/school/images/uploads/<?php echo $photo_query_result['photo_file_name']; ?>" alt="..."  class="image">
                                                          <div class="overlay">
                                                            <input type="checkbox" class="che_del" > <span class="glyphicon glyphicon-trash trash" aria-hidden="true" onclick="opn(this)" data-id="<?php echo $schl_id_original;?>" data-photoid="<?php echo $photo_query_result['photo_id'];?>" ></span>
                                                          </div>
                                                        </div>
                                                 </div>

                                          <?php }*/ // close loop foreach ?>

                                    </div>
                                  </div><!-- close form-group row-->
                                  <!-- === show image : end code === -->

        <?php //$str = getMsg('034');?>
<!--         <p><?php //echo $str;?></p> -->

        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="dltOpalYes" type="button" class="btn btn-danger">ตกลง</button>
        <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->

    <!-- end view image -->
<!-- end opal modal -->




            <!-- Modal -->
  <div class="modal fade" id="modal_opal" role="dialog">
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
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->

 <!-- Start Photo Upload -->
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

                                                                    console.log(node);

                                                                    console.log(imgPath);

                                                                    console.log(extn);

                                                                    //===opal====

                                                                    //$('.enableOnInput').prop('disabled', true); //TO DISABLED 
                                                                    $('.btn-save').prop('disabled', false); //TO ENABLE
                                                                    

                                                                    //===========

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



/*                                                                      var add_img = '<div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">\
                                                                                       <input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,\'\');">'+
                                                                                       '<button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,\'\');">'+
                                                                                           '<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>'+
                                                                                       '</button>\
                                                                                     </div>'; */

                                                                        var add_img = 
                                                                      '<div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word;">'+
                                                                            '<text class="text-left">'+
                                                                              '<b style="color: red;">ชื่อภาพ* : </b>'+
                                                                            '</text>'+
                                                                            
                                                                            '<input type="text" name="photo2[]" maxlength="25" style="width:210px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"> <!-- 270px, 210px -->'+

                                                                            '<input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,\'\');">'+

                                                                            '<button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,\'\');">'+
                                                                                  '<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>'+
                                                                            '</button>'+
                                                                      '</div>';

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

/*                                                           function Del_photo(node,id_photo){

                                                                 $.ajax({
                                                                    url: base_url+'school/del_impv_photo',
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

                                                          } */

                                            </script>
 <!-- End Photo Uplaod -->
