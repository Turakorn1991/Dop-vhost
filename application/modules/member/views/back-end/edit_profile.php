 
 <div class="container-fluid">
 <div class="form-group row">
 	    <?php echo form_open_multipart('member/edit_profile/update'); ?>
              
        <!--  <ul class="nav nav-tabs user-nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#page1" aria-controls="page1" role="tab" data-toggle="tab" aria-expanded="true">บัญชีผู้ใช้งาน</a>
          </li>   
        </ul> -->
        
       <!-- tab id="page1" -->    
    <div role="tabpanel" class="tab-pane active" id="page1">
        <div class="panel panel-default">
          <div class="panel-body" style="font-size: 15px;">

            <div class="row">
              <div class="col-xs-4 col-sm-4 element ">
                  <?php if($usrm_user['user_photo_file']!='') {?>
                               <center>
                               <img src="<?php echo base_url().$usrm_user['user_photo_file'];?>" alt="..." class="image" >                              
                               <input type="file" name="img"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,'');">
                               <button id="btnAddimg" type="button" class="btn btn-default" style="width: 138px;" onclick="brwImg(this,'');">เปลี่ยนรูปภาพ</button>
                               </center>
                               
                                            
                  <?php }else{ ?>
                  				<center>
                            
                               <img src="<?php echo base_url().get_session('user_photo_file');?>" class="image" >                                                               
                               <input type="file" name="img"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,'');">
                               <button id="btnAddimg" type="button" class="btn btn-default" style="width: 138px;" onclick="brwImg(this,'');">เพิ่มรูปภาพ</button>
                           	   </center>      
                  <?php } ?>
             
              </div>

              <script type="text/javascript">

               $('.image').mouseenter(function(){
                 $('#btnAddimg').css('display','block');
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
                      $(node).prev().remove();
                      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                              if (typeof(FileReader) != "undefined") {
                                      //loop for each file selected for uploaded.
                                     //for (var i = 0; i < countFiles; i++) {
                                    var reader = new FileReader();

                                    reader.onload = function(e) {

                                    //console.log(e.target.result);
                                    
                                    var add_img = '<img src="'+e.target.result+'" class="image" >';

                                      $(node).before(add_img);

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

              <div class="col-xs-4">
                <div class="form-group">
                  <label for="pid">เลขประจำตัวประชาชน</label>
                  <input type="text" class="form-control" id="pid"  value="<?php echo $usrm_user['pid']; ?>" readonly>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="org_title">หน่วยงานที่สังกัด</label>
                  
                  <input type="text" readonly="" class="form-control" id="org_title"  value="<?php echo $usrm_user['org_title']; ?>">
                </div>
              </div>

              <div class="col-xs-4">
                <div class="form-group">
                  <label for="passcode">รหัสบัญชีผู้ใช้งาน</label>
                  <input type="password" class="form-control" id="passcode" name="usrm_user[passcode]" value="<?php echo $usrm_user['passcode']; ?>">
                  
                </div>
              </div>

              <div class="col-xs-4">
                <div class="form-group">
                  <label>สถานะการเปิดใช้งาน</label>
                  <div style="height: 35px;padding: 9px 0;">
                    <div class="checkbox-inline">
                      <label>
                        <input type="checkbox" id="active_status"  value="Active" disabled="" checked>
                        เปิดใช้งาน
                      </label>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="user_prename-selectized">คำนำหน้านาม</label>
                      <select class="form-control selectized" id="user_prename" name="usrm_user[user_prename]" tabindex="-1" >
                        <?php foreach($prename as $key=>$value) {?>
                         <option value="<?php echo $value['pren_code']; ?>" <?php if($usrm_user['pren_code']==$value['pren_code']){ echo "selected"; } ?> ><?php echo $value['prename_th']; ?></option>
                         <?php } ?>
                      </select>
                </div>
              </div>

              <div class="col-xs-4">
                <div class="form-group">
                  <label for="user_firstname">ชื่อตัว</label>
                  <input type="text" class="form-control" id="user_firstname" name="usrm_user[user_firstname]" value="<?php echo $usrm_user['user_firstname']; ?>">
                </div>
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="user_lastname">ชื่อสกุล</label>
                  <input type="text" class="form-control" id="user_lastname" name="usrm_user[user_lastname]" value="<?php echo $usrm_user['user_lastname']; ?>">
                </div>
              </div>

              <div class="col-xs-4">
                <div class="form-group">
                  <div>
                    <label>เพศ</label>
                  </div>

                  <div class="radio-inline">
                    <label>
                      <input type="radio" name="usrm_user[user_gender]" id="user_gender1" value="1" <?php if($usrm_user['user_gender']=='1'){ echo "checked";}?> >
                      ชาย
                    </label>
                  </div>
                  <div class="radio-inline">
                    <label>
                      <input type="radio" name="usrm_user[user_gender]" id="user_gender2" value="2" <?php if($usrm_user['user_gender']=='2'){ echo "checked";}?>>
                      หญิง
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-xs-4">
                <div class="form-group">
                  <label for="date_of_birth">วันเดือนปีเกิด</label>
                   <?php $datebirth = explode("-",$usrm_user['date_of_birth']); ?>
                  <input type="text" readonly="" class="form-control" id="date_of_birth"  value="<?php echo $datebirth[2]."/".$datebirth[1]."/".($datebirth[0]+543); ?>" >
                    
                </div>
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="user_position">ชื่อตำแหน่ง</label>
                  <input type="text" class="form-control" id="user_position"  value="<?php echo $usrm_user['user_position']; ?>" readonly>
                </div>
              </div>
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="tel_no">เบอร์โทรศัพท์ (มือถือ)</label>
                  <input type="text" class="form-control" id="tel_no" placeholder="เบอร์โทรศัพท์ (มือถือ)" name="usrm_user[tel_no]" value="<?php echo $usrm_user['tel_no']; ?>">
                </div>
              </div>
              <div class="col-xs-4 col-sm-4 ">
                <div class="form-group">
                  <label for="email_addr">ที่อยู่อีเมล</label>
                  <input type="text" class="form-control" id="email_addr" placeholder="ที่อยู่อีเมล" name="usrm_user[email_addr]" value="<?php echo $usrm_user['email_addr']; ?>">
                </div>
              </div>
              <!-- /////////////////////////////////////// -->
              <div class="col-xs-12"><hr style="border: 1px solid #eeeeee;"></div>
              
              <div class="col-xs-12">
                <label style="padding-top: 15px; padding-bottom: 20px; font-size: 22px;">ตั้งค่าการใช้งาน Government API</label>
              </div>

              <div class="col-xs-4">
                <div class="form-group">
                  <label for="tel_no">Content-Type</label>
                  <input type="text" class="form-control" id="content_type" placeholder="Content-Type" name="usrm_user[content_type]" value="<?php echo "application/x-www-form-urlencoded" ?>" readonly>
                </div>
              </div>
              <div class="col-xs-9"></div>

              <div class="col-xs-4">
                <div class="form-group">
                  <label for="tel_no">Consumer-Key</label>
                  <input type="text" class="form-control" id="consumer_key" placeholder="Consumer-Key" name="usrm_user[consumer_key]" value="<?php echo "9f3d707a-e980-4691-816e-b5f860a1f99a"; ?>" readonly>
                </div>
              </div>
              <div class="col-xs-9"></div>
              
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="tel_no">ConsumerSecret</label>
                  <input type="text" class="form-control" id="consumer_secret" placeholder="ConsumerSecret" name="usrm_user[consumer_secret]" value="<?php echo "ig7T9zeLZXb"; ?>" readonly>
                </div>
              </div>
              <div class="col-xs-9"></div>
              
              <div class="col-xs-4">
                <div class="form-group">
                  <label for="tel_no">AgentID</label>
                  <input type="text" class="form-control" id="agent_id" placeholder="AgentID" name="usrm_user[agent_id]" value="<?php echo $usrm_user['agent_id']; ?>">
                </div>
              </div>
              <div class="col-xs-9"></div>
              
              <!-- /////////////////////////////////////// -->
              <div class="col-xs-12 col-sm-12">
              <label style="padding-top: 20px; padding-bottom: 10px; font-size: 15px;">
              หมายเหตุ :<br><br>
Content-Type = application/x-www-form-urlencoded<br><br>
Consumer-Key = เป็นชุดรหัสที่ สพร. ออกให้ เพื่อความปลอดภัยในการเรียกใช้งาน API<br><br>

ConsumerSecret = เป็นชุดรหัสที่ สพร. ออกให้ เพื่อความปลอดภัยในการเรียกใช้งาน API<br><br>
AgentID = ต้องเป็นเลขเดียวกับเลขประจำตัวประชาชนของบัตรเจ้าหน้าที่ที่เสียบ login GovAMI เท่านั้น<br><br>
 

              </label>
            
              
              </div>
              <div class="col-xs-12 col-sm-8">&nbsp;</div>
              <div class="col-xs-12 col-sm-2">
              	   <button style="width: 100% !important; height: 40px !important;" type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
              </div>
              <div class="col-xs-12 col-sm-2">
              	   <a  style="width: 100% !important; height: 40px !important; padding-top: 9px !important;" type="button" class="btn btn-default btn-cancel"  href="<?php echo base_url('control/main_module'); ?>"><i class="fa fa-ban" aria-hidden="true"></i> ยกเลิก</a>
              </div>         
              

              <?php echo form_close(); ?>
            </div>
          </div>

        </div>
      </div>
      <!-- END id="page1"-->

      
    </div>
</div><!-- End container-->

<script type="text/javascript">
	$(document).ready(function (){
		$('input[type=radio],input[type=checkbox]').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
			increaseArea: '20%'
		});
	});
</script>
    
      
