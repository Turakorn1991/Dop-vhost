
<?php $schl_id_original = $schl_id; ?>

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
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/school1/Edit/'.$schl_id_original);?>" <?php }?> <?php if($usrpm['app_id']==59){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) โรงเรียน</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(60);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(60,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/photo2/Edit/'.$schl_id_original);?>" <?php }?>  data-toggle="tab" <?php if($usrpm['app_id']==60){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(61);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(61,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id_original);?>" <?php }?> <?php if($usrpm['app_id']==61){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(174);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(174,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('school/school_model/Edit/'.$schl_id_original);?>" <?php }?> <?php if($usrpm['app_id']==174){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (4) แบบประเมินโรงเรียน</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div id="tab-1" <?php if($usrpm['app_id']==60){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                  
                                  <div class="form-group row" style="margin-bottom:0px !important;">

<!-- multi part -->

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <!--1-->
                                    <div class="panel-group" style="margin-bottom:0px !important;">
                                          <!--2-->
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>อัลบั้มภาพถ่ายบรรยากาศการเรียน</h4>
                                              </div>

                                             <div class="panel-body" style="border:0; padding: 20px;"><!--3-->
                                          
                                                <!-- === Add Album Button opal : start code === -->

                                                <div class="form-group row" style="margin-bottom:0px !important;"><!-- remove space bottom opal -->
                                                  <div class="col-xs-12 col-sm-12">

                                                    <div class="col-xs-12 col-sm-9 has-error">
                                                      <label for="" class="col-2 col-form-label" style="color: red;">ชื่อโรงเรียน </label>
                                                      <input type="text" class="form-control" name="schl_info[schl_name]" title="ชื่อโรงเรียน" value="<?php echo $schl_info['schl_name']; ?>" placeholder="ระบุชื่อโรงเรียน" disabled>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                        <br/>
                                                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-add" onclick="modalAddAlbum(this)" data-id="<?php echo $schl_id_original;?>" data-albumid="<?php echo $album_id;?>"> <i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มอัลบั้มภาพ</button>

                                                    </div>


                                                  </div><!-- close div  class="col-xs-12 col-sm-12"-->
                                                </div><!-- close div class="form-group row"-->


                                                <br>
                                                <!-- === Add Album Button opal : end code === -->

                                                <!-- === show image : start code === -->
                                                <div class="form-group row" style="margin-bottom:0px !important;"><!-- remove space bottom opal -->
                                                  <div class="col-xs-12 col-sm-12">
                                                                                            
                                                        <?php 
                                                                  
                                                                $test_photo_query = $this->common_model->query(
                                                                  "SELECT a.* 
                                                                  FROM schl_photo a
                                                                  where a.schl_id = $schl_id_original and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                                  order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC;")->result_array();
                                                                  
                                                                
                                                                $test_album_query = $this->common_model->query(
                                                                  "SELECT b.*
                                                                    FROM schl_photo_album b
                                                                    where b.schl_id = $schl_id_original and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00')
                                                                    order by b.album_id ASC, b.insert_datetime ASC, b.album_title ASC;")->result_array();


                                                        ?>
                                                        <?php $i=0;
                                                        foreach ($test_album_query as $album_query_result) { ?>

                                                        <?php 
                                                                $album_id = $album_query_result['album_id'];

                                                                $test_album_cover_query = $this->common_model->query(
                                                                  "SELECT min(a.photo_id) as min_photo_id, count(a.photo_id) as count_photo_id, a.*
                                                                  FROM schl_photo a
                                                                  where a.schl_id = $schl_id_original and album_id = $album_id
                                                                  and a.album_id not like '' and a.album_id is not null 
                                                                  and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                                  order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC")->result_array();

/*                                                                 $test_album_photo_query = $this->common_model->query(
                                                                  "SELECT a.photo_id, a.*
                                                                  FROM schl_photo a
                                                                  where a.schl_id = $schl_id_original and album_id = $album_id
                                                                  and a.album_id not like '' and a.album_id is not null 
                                                                  and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                                  order by a.photo_id ASC, a.insert_datetime ASC, a.photo_title ASC")->result_array(); */
                                                        ?>

                                                                <div class="col-xs-12 col-sm-4 col-lg-3 element center"   style="margin-top: 20px; height:300px; word-wrap: break-word;">
                                                                      <div class="container3">
                                                        <?php         
                                                                        if($test_album_cover_query[0]['count_photo_id']>0){ 
                                                                          $albumcover = "uploads/".$test_album_cover_query[0]['photo_file_name'];
                                                                        } else{
                                                                          $albumcover = "OP01_no_picture.png";
                                                                        }
                                                        ?>
                                                                        <img src="<?php echo base_url();?>assets/modules/school/images/<?php echo $albumcover; ?>" alt="..."  class="image" style="display: block !important; margin-left: auto !important; margin-right: auto !important;">
                                                                        <div class="overlay2">
                                                                          <!-- <input type="checkbox" class="che_del" >  -->
                                                                          <span class="glyphicon glyphicon-pencil trashleft" title="แก้ไขอัลบั้ม" aria-hidden="true" onclick="modalEditAlbum(this)" data-id="<?php echo $schl_id_original;?>" data-albumid="<?php echo $album_id;?>"></span>
                                                                          <span class="glyphicon glyphicon-trash trashleft2 trashdelete" title="ลบอัลบั้ม" aria-hidden="true" onclick="opnDelAlbum(this)" data-id="<?php echo $schl_id_original;?>" data-albumid="<?php echo $album_id;?>"></span>
                                                                          <span class="glyphicon glyphicon-resize-full trash" title="ดูภาพทั้งหมด" aria-hidden="true" onclick="modalViewAlbum(this)" data-id="<?php echo $schl_id_original;?>" data-albumid="<?php echo $album_id;?>"></span>
                                                                        </div>
                                                                      </div>
                                                                      <div style="margin-top:20px;">  
                                                                        <text>
                                                                          <!-- <b>ชื่อไฟล์ : <?php //echo $album_query_result['photo_file_name']; ?><b><br> -->
                                                                          
                                                                          <?php
                                                                            $date = date('Y-m-d',strtotime($album_query_result['insert_datetime']));
                                                                            $time = date('H:i:s',strtotime($album_query_result['insert_datetime']));

                                                                            $test_count_photo_query = $this->common_model->query(
                                                                              "SELECT count(a.photo_id) as count_photo
                                                                              FROM schl_photo a
                                                                              JOIN schl_photo_album b
                                                                              ON a.album_id = b.album_id
                                                                              where a.schl_id = $schl_id_original and b.schl_id = $schl_id_original and a.album_id = $album_id 
                                                                              and a.insert_datetime not like '' and a.insert_datetime is not null and a.delete_user_id IS NULL AND (a.delete_datetime IS NULL || a.delete_datetime = '0000-00-00 00:00:00')
                                                                              and b.insert_datetime not like '' and b.insert_datetime is not null and b.delete_user_id IS NULL AND (b.delete_datetime IS NULL || b.delete_datetime = '0000-00-00 00:00:00');")->result_array();
                                                                          ?>
<!--                                                                             <b style="font-size: 15px;" ><i class="fa fa-book"></i> อัลบั้มที่ <?php echo ++$i.'-'.$album_id.' - '.$test_album_cover_query[0]['min_photo_id']; ?></b><br>
                                                                            <b>ชื่อ : </b><?php echo $album_query_result['album_title']; ?><br>
                                                                            <b>วันที่สร้าง : </b><?php echo formatDateThai1($date).' ('.$time.' น.)' ?><br>
                                                                            <b>จำนวนภาพ : </b><?php echo $test_count_photo_query[0]['count_photo']; ?> -->
                                                                            
                                                                            <b style="font-size: 15px;" ><i class="fa fa-book"></i> อัลบั้มที่ <?php echo ++$i ?></b><br>
                                                                            <b>ชื่อ : </b><?php echo (($album_query_result['album_title'] == null) || ($album_query_result['album_title'] == '') ? "-" : $album_query_result['album_title']) ?><br>
                                                                            <b>วันที่สร้าง : </b><?php echo formatDateThai1($date).' ('.$time.' น.)' ?><br>
                                                                            <b>จำนวนภาพ : </b><?php echo $test_count_photo_query[0]['count_photo']; ?>
                                                                        </text>
                                                                      </div>
                                                              </div>

                                                        <?php }// close loop foreach ?>

                                                  </div>
                                                </div><!-- close form-group row-->
                                                <!-- === show image : end code === -->


                                                  <!-- <input type="checkbox" class="che_del" > --> <!-- <span class="glyphicon glyphicon-trash trash" style="color:red;" aria-hidden="true" onclick="opnOpal(this)" data-id="<?php echo $album_id;?>"?></span> -->

                                      </div><!--3-->
                                      </div><!--2-->
                                      </div><!--1-->

                                  </div><!-- form-group row-->
                                </div><!-- panel-body -->
                              </div><!-- tab-1 -->         

                        </div><!-- close tab-content-->

              </div>
          </div>
      </div>





<!-- start opal modal -->

    <!-- start view image -->

        <!-- View all Photos in this Album Modal -->
        <div id="mdViewAlbum" class="modal fade" id="modal fade" role="dialog" style="margin-left:17px;">
        <!-- <div id="mdViewAlbum" class="modal fade" role="dialog" style="width:90vw; height:80vh; margin-left:5vw; margin-top:10vh; overflow-y: hidden;"> --><!-- modal-fade-in --> <!-- 1 -->
          <div class="modal-dialog-photoalbum"> <!-- modal-dialog --><!-- 2 -->
            
            <!-- Modal content-->
            <div class="modal-content"><!-- 3 -->

              <div class="modal-header"><!-- 4 -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="viewAlbum-title-container"></div><!--หน้าต่างภาพทั้งหมดในอัลบั้มนี้-->
              </div><!-- class="modal-header" --><!-- 4 -->

              <div class="modal-body" style="overflow-y: auto; height: 60vh;"><!-- 5 -->
                
              <!-- <p>OPAL TEST MODAL</p> -->
                <!-- <input type="text" name="albumid" id="albumid" value=""/> -->
                <!-- <h1><?php echo $_GET['albumid'];?></h1> -->

                                          <!-- === show image : start code === -->
                                          <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                                            <div id="viewAlbum-container" class="col-xs-12 col-sm-12">
                                                                                      
                                                  <?php /*$i=0;
                                                  foreach ($test_photo_query as $photo_query_result) { ?>

                                                          <div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word; font-size: 13px;">
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

                                          <hr style="border-top: 3px solid #eee !important;">  
                                      
                                          <!-- === upload image : start code === -->
                                          <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                                            <div class="col-xs-12 col-sm-12">
                                            <div id="parent_0">
                                                                                      
                                                          <div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word; font-size: 13px;">

                                                            <text class="text-left">
                                                              <b style="color: red;">ชื่อภาพ* : </b>
                                                            </text><br/>
                                                            
                                                            <input type="text" name="photo2[]" maxlength="25" style="width:270px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"> <!-- 270px, 210px, width:202px -->
                                                            <!-- <input type="text" name="photo2[]" maxlength="25" style="width:270px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"> -->

                                                            <text class="text-left">
                                                              <b style="">คำอธิบายภาพ : </b>
                                                            </text><br/>
                                                            
                                                            <input type="text" name="photo2desc[]" maxlength="45" style="width:270px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 45 ตัวอักษร";> <!-- 270px, 210px -->


                                                            <input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,'');">

                                                            <!-- <input type="file" name="userfile" value="Save" style="display: none;" onchange="imgchange(this,'');"> -->
                                                            <button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,'');">
                                                                  <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                                            </button>

                                                          </div>  <!-- close div element -->
                                            </div>
                                            </div>
                                            <?php
                                            echo form_close();
                                            ?>
                                          </div><!-- close form-group row-->

                                          <hr style="margin-top: 0px; width: 90%; margin-left: 5%;">

                                          <div class="row">
                                            <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                            <div class="col-xs-12 col-sm-2">
                                              <button disabled='disabled' style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save btn-confirmupload" onclick="return opnCnfrom()"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                            </div>
                                            <div class="col-xs-12 col-sm-2">
                                            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" data-dismiss="modal"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button> <!--  onclick="window.location.href='<?php //echo site_url('school/school_list');?>'" -->
                                            </div>
                                          </div><!-- close class row-->

                                          <!-- === upload image : end code === -->
              
              </div><!-- class="modal-body" --><!-- 5 -->

                <!--<p>ยืนยันการลบ?</p>-->
              <div class="modal-footer"><!-- 6 -->
                <!-- <button id="dltOpalYes" type="button" class="btn btn-danger">ตกลง</button>
                <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button> -->
                <div class="row">
<!--                   <div class="col-xs-12 col-sm-8">&nbsp;</div>
                  <div class="col-xs-12 col-sm-2"> -->
                    <!--<input type="submit" name="submit" value="PUBLISH IMAGE">-->

<!--                     <button disabled='disabled' style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save btn-confirmupload" onclick="return opnCnfrom()"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                  </div>
                  <div class="col-xs-12 col-sm-2">
                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/school_list');?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                  </div> -->
                </div><!-- close class row-->
              </div><!-- class="modal-footer" --><!-- 6 -->

            </div><!-- class="modal-content" --><!-- 3 -->
          </div><!-- div class="" --><!-- 2 -->
        </div><!-- div id="dltOpal" --><!-- 1 -->
        <!-- End View all Photos in this Album Modal -->
    <!-- end view image -->


    <!-- start Add Album -->

        <!-- Add Album Modal -->
        <div id="mdAddAlbum" class="modal fade" id="modal fade" role="dialog" style="margin-left:17px;">
        <!-- <div id="mdViewAlbum" class="modal fade" role="dialog" style="width:90vw; height:80vh; margin-left:5vw; margin-top:10vh; overflow-y: hidden;"> --><!-- modal-fade-in --> <!-- 1 -->
          <div class="modal-dialog-addalbum"> <!-- modal-dialog / modal-dialog-photoalbum --><!-- 2 -->
            
            <!-- Modal content-->
            <div class="modal-content"><!-- 3 -->

              <div class="modal-header"><!-- 4 -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="addAlbum-title-container">
                  <b><i class="fa fa-book"></i> สร้างอัลบั้มใหม่ </b><br>
                </div><!--หน้าต่างภาพทั้งหมดในอัลบั้มนี้-->
              </div><!-- class="modal-header" --><!-- 4 -->

              <div class="modal-body" style="overflow-y: auto; height: 35vh;"><!-- 5 -->
                                                      
                  <!-- === upload image : start code === -->
                  <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                      <div class="col-xs-12 col-sm-12">
                                                                
                          <div class="col-xs-12 col-sm-12 col-lg-12 element"   style="margin-top: 20px; height:150px; word-wrap: break-word; font-size: 13px;">
                          
                              <form id="formAddAlbum" method="post" action="<?php echo base_url();?>school/photo2/Added/<?php echo $schl_id_original; ?>">

                                  <text class="text-left">
                                    <b style="color: red;">ชื่ออัลบั้ม* : </b>
                                  </text>
                                  
                                  <input type="text" name="schl_album_title" maxlength="25" style="width:202px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"; required> <!-- 270px, 210px -->

                                  <br/>
                                  
                                  <text class="text-left">
                                    <b style="">วันที่สร้างอัลบั้ม : </b>
                                  </text>

                                  <?php                                                                     
                                    $date = date('Y-m-d');
                                    $time = date('H:i:s');
                                  ?>

                                  <!-- <input type="text" name="photo2[]" maxlength="25" style="width:202px; height:30px; margin-bottom:20px; color:lightgrey;" placeholder="วันนี้" value="<?php echo formatDateThai1($date)." (".$time." น.)"; ?>" disabled> --> <!-- 270px, 210px -->
                                  <input type="text" name="" maxlength="25" style="width:100px; height:30px; margin-bottom:20px; color:lightgrey; background:transparent; border-width:0px !important" placeholder="วันนี้"; value="<?php echo formatDateThai1($date); ?>" disabled> <!-- 270px, 210px -->

                                  <br/>

                                  <text class="text-left">
                                    <b style="">คำอธิบายอัลบั้ม : </b>
                                  </text>
                                  
                                  <input type="text" name="schl_album_description" maxlength="45" style="width:400px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 45 ตัวอักษร";> <!-- 270px, 210px -->
                          
                                  <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                              </form>

                          </div>  <!-- close div element -->

                          
                      </div>
                  </div><!-- close form-group row-->
                  <!-- === upload image : end code === -->
              
              </div><!-- class="modal-body" --><!-- 5 -->

                <!--<p>ยืนยันการลบ?</p>-->
              <div class="modal-footer"><!-- 6 -->
                <!-- <button id="dltOpalYes" type="button" class="btn btn-danger">ตกลง</button>
                <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button> -->
                <div class="row">
                  <div class="col-xs-12 col-sm-6">&nbsp;</div>
                  <div class="col-xs-12 col-sm-3">
                    <!--<input type="submit" name="submit" value="PUBLISH IMAGE">-->

                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save btn-confirmadd" onclick="opnCnAddAlbum(this)" data-id="<?php echo $schl_id_original;?>"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" data-dismiss="modal"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button> <!--  onclick="window.location.href='<?php //echo site_url('school/school_list');?>'" -->
                  </div>
                </div><!-- close class row-->
              </div><!-- class="modal-footer" --><!-- 6 -->

            </div><!-- class="modal-content" --><!-- 3 -->
          </div><!-- div class="" --><!-- 2 -->
        </div><!-- div id="dltOpal" --><!-- 1 -->
        <!-- End Add Album Modal -->
    <!-- end Add Album -->


    <!-- start Edit Album -->

        <!-- Edit Album Modal -->
        <div id="mdEditAlbum" class="modal fade" id="modal fade" role="dialog" style="margin-left:17px;">
        <!-- <div id="mdViewAlbum" class="modal fade" role="dialog" style="width:90vw; height:80vh; margin-left:5vw; margin-top:10vh; overflow-y: hidden;"> --><!-- modal-fade-in --> <!-- 1 -->
          <div class="modal-dialog-addalbum"> <!-- modal-dialog / modal-dialog-photoalbum --><!-- 2 -->
            
            <!-- Modal content-->
            <div class="modal-content"><!-- 3 -->

              <div class="modal-header"><!-- 4 -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="editAlbum-title-container">
                  <b><i class="fa fa-book"></i> แก้ไขอัลบั้มนี้ </b><br>
                </div><!--หน้าต่างภาพทั้งหมดในอัลบั้มนี้-->
              </div><!-- class="modal-header" --><!-- 4 -->

              <div class="modal-body" style="overflow-y: auto; height: 35vh;"><!-- 5 -->
                                                      
                  <!-- === upload image : start code === -->
                  <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                      <div class="col-xs-12 col-sm-12">

                          <form id="formEditAlbum" method="post" action="<?php echo base_url();?>school/edt_album_photo">
                              
                              <div id="editAlbum-container" class="col-xs-12 col-sm-12 col-lg-12 element"   style="margin-top: 20px; height:150px; word-wrap: break-word; font-size: 13px;">

                                  

                              </div>  <!-- close div element -->

                              <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                              
                          </form>
                          
                      </div>
                  </div><!-- close form-group row-->
                  <!-- === upload image : end code === -->
              
              </div><!-- class="modal-body" --><!-- 5 -->

                <!--<p>ยืนยันการลบ?</p>-->
              <div class="modal-footer"><!-- 6 -->
                <!-- <button id="dltOpalYes" type="button" class="btn btn-danger">ตกลง</button>
                <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button> -->
                <div class="row">
                  <div class="col-xs-12 col-sm-6">&nbsp;</div>
                  <div class="col-xs-12 col-sm-3">
                    <!--<input type="submit" name="submit" value="PUBLISH IMAGE">-->

                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save btn-confirmadd" onclick="opnCnEditAlbum(this)" data-id="<?php echo $schl_id_original;?>"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" data-dismiss="modal"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button> <!--  onclick="window.location.href='<?php //echo site_url('school/school_list');?>'" -->
                  </div>
                </div><!-- close class row-->
              </div><!-- class="modal-footer" --><!-- 6 -->

            </div><!-- class="modal-content" --><!-- 3 -->
          </div><!-- div class="" --><!-- 2 -->
        </div><!-- div id="dltOpal" --><!-- 1 -->
        <!-- End Edit Album Modal -->
    <!-- end Edit Album -->


    <!-- start Edit Photo Info -->
        <!-- Edit Album Modal -->
        <div id="mdEditPhoto" class="modal fade" id="modal fade" role="dialog" style="margin-left:17px;">
        <!-- <div id="mdViewAlbum" class="modal fade" role="dialog" style="width:90vw; height:80vh; margin-left:5vw; margin-top:10vh; overflow-y: hidden;"> --><!-- modal-fade-in --> <!-- 1 -->
          <div class="modal-dialog-addalbum"> <!-- modal-dialog / modal-dialog-photoalbum --><!-- 2 -->
            
            <!-- Modal content-->
            <div class="modal-content"><!-- 3 -->

              <div class="modal-header"><!-- 4 -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="editPhoto-title-container">
                  <b><i class="fa fa-image"></i> แก้ไขภาพนี้ </b><br>
                </div><!--หน้าต่างภาพทั้งหมดในอัลบั้มนี้-->
              </div><!-- class="modal-header" --><!-- 4 -->

              <div class="modal-body" style="overflow-y: auto; height: 55vh;"><!-- 5 -->
                                                      
                  <!-- === upload image : start code === -->
                  <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                      <div class="col-xs-12 col-sm-12">

                          <form id="formEditPhoto" method="post" action="<?php echo base_url();?>school/edt_photo">
                              
                              <div id="editPhoto-container" class="col-xs-12 col-sm-12 col-lg-12 element"   style="margin-top: 20px; height:150px; word-wrap: break-word; font-size: 13px;">

                                  

                              </div>  <!-- close div element -->

                              <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                              
                          </form>
                          
                      </div>
                  </div><!-- close form-group row-->
                  <!-- === upload image : end code === -->
              
              </div><!-- class="modal-body" --><!-- 5 -->

                <!--<p>ยืนยันการลบ?</p>-->
              <div class="modal-footer"><!-- 6 -->
                <!-- <button id="dltOpalYes" type="button" class="btn btn-danger">ตกลง</button>
                <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button> -->
                <div class="row">
                  <div class="col-xs-12 col-sm-6">&nbsp;</div>
                  <div class="col-xs-12 col-sm-3">
                    <!--<input type="submit" name="submit" value="PUBLISH IMAGE">-->

                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save btn-confirmadd" onclick="opnCnEditPhoto(this)" data-id="<?php echo $schl_id_original;?>"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" data-dismiss="modal"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button> <!--  onclick="window.location.href='<?php //echo site_url('school/school_list');?>'" -->
                  </div>
                </div><!-- close class row-->
              </div><!-- class="modal-footer" --><!-- 6 -->

            </div><!-- class="modal-content" --><!-- 3 -->
          </div><!-- div class="" --><!-- 2 -->
        </div><!-- div id="dltOpal" --><!-- 1 -->
        <!-- End Edit Album Modal -->
    <!-- end Edit Photo Info -->

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

<!-- Start Add Code Delete Modal 2 (Album) -->
  <!-- Delete Modal -->
  <div id="dltAlbum" class="modal fade" role="dialog">
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
          <button id="dltbtnYes2" type="button" class="btn btn-danger">ตกลง</button>
          <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Delete Model -->
<!-- End Add Code Delete Modal 2 (Album) -->

<!-- Start Add Code Edit Modal 3 (Album) -->
  <!-- Delete Modal -->
  <div id="edtAlbum" class="modal fade" role="dialog">
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
<!--         <div class="modal-footer">
          <button id="dltbtnYes2" type="button" class="btn btn-danger">ตกลง</button>
          <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        </div> -->
      </div>
    </div>
  </div>
  <!-- End Delete Model -->
<!-- End Add Code Edit Modal 2 (Album) -->

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

<!-- Start Add Code Add sbmCnfrm 2 (Album) -->
  <!-- Confirm Save Form  Modal -->
  <div id="sbmCnfrmAddAlbum" class="modal fade" role="dialog">
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
          <button id="savbtnYesAddAlbum" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
          <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Confirm Save Form  Modal -->
<!-- End Add Code Add sbmCnfrm 2 (Album) -->

<!-- Start Add Code Edit sbmCnfrm 3 (Album) -->
  <!-- Confirm Save Form  Modal -->
  <div id="sbmCnfrmEditAlbum" class="modal fade" role="dialog">
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
          <button id="savbtnYesEditAlbum" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
          <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Confirm Save Form  Modal -->
<!-- End Add Code Edit sbmCnfrm 3 (Album)  -->

<!-- Start Add Code Edit sbmCnfrm 4 (Photo) -->
  <!-- Confirm Save Form  Modal -->
  <div id="sbmCnfrmEditPhoto" class="modal fade" role="dialog">
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
          <button id="savbtnYesEditPhoto" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
          <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Confirm Save Form  Modal -->
<!-- End Add Code Edit sbmCnfrm 4 (Photo)  -->


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
         <br/>

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->

 <!-- Start Photo Upload -->
 <script>
                                                      $("#guide-book").click(function(){
                                                        window.open('/assets/modules/school/guide/Sch_Manual.pdf', '_blank');
                                                      }); 

                                                      $('#parent_0').on('change',':checkbox',function(){
                                                          var status_che = $(this).prop('checked');


                                                             if(status_che==true){
                                                               $(this).parent().css('height','30px');
                                                             }else{
                                                                $(this).parent().css('height','');
                                                             }
                                                       });

                                                      $('#parent_0').on('click','.trashdelete',function(){ //'.trash'

                                                         if(confirm('กรุณายืนยันการลบ')){
                                                             $('#parent_0  :checkbox').each(function(){

                                                               if($(this).prop('checked')==true){
                                                                  $(this).parent().parent().parent().remove();
                                                               }
                                                             });

                                                                 $(this).parent().parent().parent().remove();

                                                               }

                                                        //===opal===
                                                        var count_img = $('#parent_0 .img_0').length;
                                                        console.log(count_img);
                                                        //==========       
                                                     });

                                                     function brwImg (node,myID){
                                                             $(node).prev().click();
                                                             //console.log($(node).prev());
                                                          }



                                                          function imgchange(node,myID){

                                                                    //var countFiles = $(this)[0].files.length;

                                                                    //===opal===
                                                                    var count_img = $('#parent_0 .img_0').length;
                                                                    console.log(count_img);
                                                                    //==========

                                                                    var imgPath = $(node)[0].value;

                                                                    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

                                                                    console.log(node);

                                                                    console.log(imgPath);

                                                                    console.log(extn);

                                                                    //===opal====

                                                                    //$('.enableOnInput').prop('disabled', true); //TO DISABLED 
                                                                    $('.btn-confirmupload').prop('disabled', false); //TO ENABLE
                                                                    

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
                                                                                                <input type="checkbox" class="che_del2" > <span class="glyphicon glyphicon-trash trash trashdelete" aria-hidden="true"></span>'+
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
                                                                            '<div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word; font-size: 13px;">'+
                                                                                  '<text class="text-left">'+
                                                                                    '<b style="color: red;">ชื่อภาพ* : </b>'+
                                                                                  '</text><br/>'+
                                                                                  
                                                                                  '<input type="text" name="photo2[]" maxlength="25" style="width:270px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"> <!-- 270px, 210px -->'+

                                                                                  '<text class="text-left">'+
                                                                                    '<b style="">คำอธิบายภาพ : </b>'+
                                                                                  '</text><br/>'+
                                                                                  
                                                                                  '<input type="text" name="photo2desc[]" maxlength="25" style="width:270px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 45 ตัวอักษร"> <!-- 270px, 210px -->'+

                                                                                  '<input type="file" name="img[]"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,\'\');">'+

                                                                                  '<button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,\'\');">'+
                                                                                        '<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>'+
                                                                                  '</button>'+
                                                                            '</div>';

                                                                            //$(img_file).appendTo($(node).parent());

                                                                            //$(node).parent().parent().append(add_img);

                                                                            //$(node).parent().parent().append(add_img);

                                                                            $("#parent_0").append(add_img);

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

                                            </script>
 <!-- End Photo Uplaod -->
