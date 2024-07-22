
   <div class="row" style="margin: 5px;">

       <div class="col-sm-3 text-left hidden-xs text-muted">
          <!-- <h3><?php echo $title;?></h3> -->
       </div>

     <div class="col-xs-12 col-sm-9 text-right">
      <?php
        $tmp = $this->admin_model->chkOnce_usrmPermiss(21,$user_id); //Check User Permission
        if(isset($tmp['perm_can_edit'])) {
          if($tmp['perm_can_edit']=='Yes') {
      ?>
            <a onclick="if(frmKey){$('#bcAddModel').modal('show'); return false;}" href="<?php echo site_url('difficult/sufferer_form1');?>" title="<?php echo $tmp['app_name'];?>" class="btn btn-default">
                <span class="glyphicon glyphicon-plus"></span>
            </a>       

            <?php
            if($process_action=='Edit' || $process_action=="View") {
            ?>

            <?php if($process_action!='Edit'){?>
             <a title="แก้ไข<?php echo $tmp['app_name'];?>" href="<?php echo site_url('difficult/sufferer_form1/Edit/'.$diff_info['diff_id']);?>" class="btn btn-default">
              <span class="fa fa-pencil-square-o"></span>
             </a>
             <?php }?>

             <button data-id=<?php echo $diff_info['diff_id'];?> onclick="opn(this)" title="ลบ" type="button" class="btn btn-default" ><span class="glyphicon glyphicon-trash"></span>
             </button>  
             <?php
             }
             ?>

           <?php
                }
            }
           ?>

      <?php
      if($process_action!='View') {
      ?>
       <button onclick="if(frmKey){$('#calModel').modal('show'); return false;}else{$('#calbtnYes').click();}" title="ย้อนกลับ" type="button" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>
       </button>
      <?php
      }else {
      ?>
       <a href="<?php echo site_url('difficult/assist_list');?>" title="ย้อนกลับ" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>
       </a>
      <?php
      }
      ?>

     </div>
   </div>

<?php
$diff_id = '';

if($process_action=='Add')$process_action = 'Added';
if($process_action=='Edit'){$process_action = 'Edited'; $diff_id = '/'.$diff_info['diff_id'];}

echo form_open_multipart('difficult/sufferer_form1/'.$process_action.$diff_id,array('id'=>'form1'));
?>


<input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

<!-- Alert Notifications -->
<?php
$state_form= $this->session->flashdata('state_form');
$msg_form= $this->session->flashdata('msg_form');
if($state_form =='2') {
?>
  <div class="alert alert-success alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>เสร็จสิ้น!</strong> <?php echo $msg_form;?>
  </div>
  <script>
    window.setTimeout(function() { $(".alert-success").alert('close'); }, 2000);
  </script>
<?php
}else if($state_form =='-1') {
?>

  <div class="alert alert-danger alert-dismissable fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>ล้มเหลว!</strong> <?php echo $msg_form;?>
  </div>

  <p class="text-danger"><font color=red><?php echo validation_errors();?></font></p>

<?php
}
?>
<!-- End Alert Notifications -->

    <div class="panel-group">
        <div class="panel panel-default">

            <div class="panel-heading"><h4>ข้อมูลคำขอรับบริการ</h4></div>
            <div class="panel-body" style="padding: 20px;">
                <div class="form-group row">
                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">วันที่แจ้งเรื่อง <font color="red">*</font></label>

            <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text" name="diff_info[date_of_req]" required />
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>  

              <script type="text/javascript">
              <?php
              $tmp = explode('-',$diff_info['date_of_req']);
              ?>

              $(function () {
                $("#datetimepicker1").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
                }).datepicker('update', new Date(Date.UTC(<?php echo $tmp[2];?>,<?php echo $tmp[1];?>-1,<?php echo $tmp[0];?>)));;
              });
              </script>

                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">ผู้เพิ่มรายการ</label>
                      <div class="col-10">
            <?php
              $user = get_session('user_firstname').' '.get_session('user_lastname');
            ?>                        
                        <?php echo $user;?> (<?php echo dtParse(getDatetime());?>)
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">ผู้แก้ไขรายการล่าสุด</label>
                      <div class="col-10">
                      <?php
                      if(isset($diff_info['update_user_id'])) {
                        if($diff_info['update_user_id']!='' || $diff_info['update_datetime']!='') {
                          $tmp = $this->member_model->getOnce_Member($diff_info['update_user_id']);
                          $user = $tmp['user_firstname'].' '.$tmp['user_lastname'];
                          echo $user.' ('.dtParse($diff_info['update_datetime']).')';
                        }
                      }else {echo '-';}
                      ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">ผู้ลบรายการ</label>
                      <div class="col-10">
                      <?php
                      if(isset($diff_info['delete_user_id'])) {
                        if($diff_info['delete_user_id']!='' || $diff_info['delete_datetime']!='') {
                          $tmp = $this->member_model->getOnce_Member($diff_info['update_user_id']);
                          $user = $tmp['user_firstname'].' '.$tmp['user_lastname'];
                          echo $user.' ('.dtParse($diff_info['delete_datetime']).')';
                        }
                      }else {echo '-';}
                      ?>
                    </div>
                  </div>
                </div>
            </div>  

            <div class="panel-heading"><h4>ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง)</h4></div>
            <div class="panel-body" style="padding: 20px;">

               <div class="form-group row">
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label"></label>
                      <div class="col-10">
              <?php
              if($process_action!='View') {
              ?>
              <div class="radio">
                <label><input title="มีบัตรประจำตัวประชาชน" type="radio" name="rd_req_pers_id" value=1 required>มีบัตรประจำตัวประชาชน</label>
              </div>
              <?php
              }else if($rd_req_pers_id==1) {
              ?>
                <i class="fa fa-check-circle-o">&nbsp;<font size=4>มีบัตรประจำตัวประชาชน</font></i>
              <?php 
              }
              ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน <font color=red>*</font></label>
                      <div class="col-10 input-group">

              <input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="number" name="diff_info[req_pers_id]" value="<?php echo $diff_info['req_pers_id'];?>" required readonly />

              <span title="ค้นหา" id="persID_req_search" style="cursor:pointer" class="input-group-addon"><i class="text-primary glyphicon glyphicon-search"></i></span>

              <?php 
                if($process_action!='View') {
               ?>                
              <script>
                $("#persID_req_search").click(function(){
                  if($("input[name='diff_info[req_pers_id]']").val()!='') {
                    $("#persID_req_search i").removeClass("glyphicon glyphicon-search text-primary");
                    $("#persID_req_search i").addClass("fa fa-circle-o-notch fa-spin text-info");
                  setTimeout(function(){
                    //$("#per_result_ok").text("ดึงข้อมูลสำเร็จ"); $("#per_result_nok").text("ดึงข้อมูลล้มเหลว");
                    $("#persID_req_search i").removeClass("fa fa-circle-o-notch fa-spin text-info");
                    $("#persID_req_search i").addClass("fa fa-check text-success");
                    //$("#per_search i").addClass("fa fa-times text-danger");
                  },1000);
                  }
                });
              </script>
              <?php
              }
              ?>
                    </div>
                  </div>
                  <div class="col-xs-12 hidden-xs col-sm-offset-6">

                  </div>

                  <div class="col-xs-12 col-sm-offset-3 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">วันที่ออกบัตร</label>
            <div id="req_iddatein" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                <input title="เลือกวันที่" name="req_iddatein" placeholder="เลือกวันที่" class="form-control" type="text"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>                    
              <script type="text/javascript">
              $(function () {
                $("#req_iddatein").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
                });
              });
              </script>
                  </div>   
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">วันที่บัตรหมดอายุ</label>
            <div id="req_iddateout" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                <input title="เลือกวันที่" name="req_iddateout" placeholder="เลือกวันที่" class="form-control" type="text"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>                    
              <script type="text/javascript">
              $(function () {
                $("#req_iddateout").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
                });
              });
              </script>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">สถานที่ออกบัตร</label>
                      <div class="col-10">
                    <input title="สถานที่ออกบัตร" name="req_idlocateout" class="form-control" type="text"/>
                    </div>
                  </div>   

                </div>

                <div class="form-group row">

                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label"></label>
                      <div class="col-10">
              <?php
              if($process_action!='View') {
              ?>
              <div class="radio">
                <label><input title="ไม่มีบัตร/ไม่สามารถระบุได้" name="rd_req_pers_id" type="radio" value=2 required>ไม่มีบัตร/ไม่สามารถระบุได้</label>
              </div>
              <?php
              }else if($rd_req_pers_id==2) {
              ?>
                <i class="fa fa-check-circle-o">&nbsp;<font size=4>ไม่มีบัตร/ไม่สามารถระบุได้</font></i>
              <?php 
              }
              ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-9">
                      <label for="example-text-input" class="col-2 col-form-label">เนื่องจาก</label>
                      <div class="col-10">
              <input title="เนื่องจาก" name="diff_info[req_none_inasmuch]" class="form-control" type="text" value="<?php echo $diff_info['req_none_inasmuch'];?>" readonly />
                    </div>
                  </div>                  

                  <div class="col-xs-12 hidden-xs">

                  </div>   

              <?php 
                if($process_action!='View') {
               ?>  
                  <script>
                      $("input[name='rd_req_pers_id']").click(function(){
                        if($(this).val()==1) {
                          $("input[name='diff_info[req_pers_id]']").addClass('required');
                          $("input[name='diff_info[req_pers_id]']").attr('readonly',false);
                          $("input[name='diff_info[req_none_inasmuch]']").val("");
                          $("input[name='diff_info[req_none_inasmuch]']").attr('readonly',true);
                        }else {
                          $("input[name='diff_info[req_pers_id]']").removeClass('required');
                          $("input[name='diff_info[req_pers_id]']").val("");
                          $("input[name='diff_info[req_pers_id]']").attr('readonly',true);
                          $("input[name='diff_info[req_none_inasmuch]']").attr('readonly',false);       

                          $("#persID_req_search i").removeClass("fa fa-check text-success");
                          $("#persID_req_search i").removeClass("fa fa-times text-danger");       
                          $("#persID_req_search i").addClass("text-primary glyphicon glyphicon-search");                               
                        }

                      });
                  </script>
              <?php
                }
              ?>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
                      <div class="col-10">
                      <select title="เลือก" placeholder="เลือก" name="diff_info[req_prename]" class="form-control">
                        <option value="">เลือก</option>
                        <option <?php if($diff_info['req_prename']=='นาย') {?> selected <?php }?> value="นาย">นาย</option>
                        <option <?php if($diff_info['req_prename']=='นาง') {?> selected <?php }?> value="นาง">นาง</option>
                        <option <?php if($diff_info['req_prename']=='นางสาว') {?> selected <?php }?> value="นางสาว">นางสาว</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว <font color=red>*</font> <!--<i title="ชื่อตัว" class="fa fa-pencil-square text-success" aria-hidden="true"></i>--><input title="ชื่อตัว" checked type='checkbox' name='req_firstname'></label>
                      <div class="col-10">
              <input title="ชื่อตัว" name="diff_info[req_firstname]" class="form-control" type="text" value="<?php echo $diff_info['req_firstname'];?>" required/>
                    </div>
                  </div>  
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล <font color=red>*</font> </label>
                      <div class="col-10">
              <input title="ชื่อสกุล" name="diff_info[req_lastname]" class="form-control" type="text" value="<?php echo $diff_info['req_lastname'];?>"  required />
                    </div>
                  </div>  

                  <div class="col-xs-12 hidden-xs col-sm-offset-3">
                  &nbsp;
                  </div> 

                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">วัน-เดือน-ปีเกิด</label>
            <div id="req_birthdate" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                <input title="เลือกวันที่" name="req_birthdate" placeholder="เลือกวันที่" class="form-control" type="text"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>                    
              <script type="text/javascript">
              $(function () {
                $("#req_birthdate").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
                });
              });
              </script>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
                      <div class="col-10">
                    <h5 id="req_old"></h5>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">เพศ</label>
                      <div class="col-10">
                    <h5><input title="ชาย" type="radio" value="m" name="req_sex"> ชาย &nbsp;&nbsp;
                      <input title="หญิง" type="radio" value="f" name="req_sex"> หญิง 
                     </h5>
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">ตำแหน่ง</label>
                      <div class="col-10">
              <input title="ตำแหน่ง" name="diff_info[req_position]" class="form-control" type="text" value="<?php echo $diff_info['req_position'];?>" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">หน่วยงาน</label>
                      <div class="col-10">
              <input title="หน่วยงาน" name="diff_info[req_depart]" class="form-control" type="text" value="<?php echo $diff_info['req_depart'];?>" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3 dropdown">
                      <label for="example-text-input" class="col-2 col-form-label">ช่องทางการรับแจ้ง <font color=red>*</font> </label>
                      <div class="col-10">
              <select title="เลือก" name="diff_info[req_channel]" placeholder="เลือก" class="form-control" required>
                  <option value="">เลือก</option>
                  <option <?php if($diff_info['req_channel']=='หนังสือ') {?> selected <?php }?>>หนังสือ</option>
                  <option <?php if($diff_info['req_channel']=='แจ้งด้วยตัวเอง') {?> selected <?php }?>>แจ้งด้วยตัวเอง</option>
                  <option <?php if($diff_info['req_channel']=='เว็บบล็อก') {?> selected <?php }?>>เว็บบล็อก</option>
              </select>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <h4><b>ที่อยู่ (ปัจจุบัน)</b></h4>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">เลขรหัสประจำบ้าน</label>
                    <div class="col-10 input-group">

              <input title="13 หลัก" placeholder="13 หลัก" name="req_homeid" class="form-control" type="number"/>

              <span title="ค้นหา" id="homeID_req_search" style="cursor:pointer" class="input-group-addon"><i class="text-primary glyphicon glyphicon-search"></i></span>

              <?php 
                if($process_action!='View') {
               ?>                
              <script>
                $("#homeID_req_search").click(function(){
                  if($("input[name='req_homeid']").val()!='') {
                    $("#homeID_req_search i").removeClass("glyphicon glyphicon-search text-primary");
                    $("#homeID_req_search i").addClass("fa fa-circle-o-notch fa-spin text-info");
                  setTimeout(function(){
                    //$("#per_result_ok").text("ดึงข้อมูลสำเร็จ"); $("#per_result_nok").text("ดึงข้อมูลล้มเหลว");
                    $("#homeID_req_search i").removeClass("fa fa-circle-o-notch fa-spin text-info");
                    $("#homeID_req_search i").addClass("fa fa-check text-success");
                    //$("#per_search i").addClass("fa fa-times text-danger");
                  },1000);
                  }
                });
              </script>
              <?php
              }
              ?>

                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสำนักทะเบียน</label>
                    <div class="col-10">
                    <input title="ระบุ" name="req_nameid" class="form-control" placeholder="ระบุ" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">บ้านเลขที่</label>
                    <div class="col-10">
                    <input title="บ้านเลขที่" name="req_village" class="form-control" type="text" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">หมู่ที่</label>
                    <div class="col-10">
                    <input title="หมู่ที่" name="req_villageid" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                    <div class="col-10">
                    <input title="ตรอก" name="req_lane" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                    <div class="col-10">
                    <input title="ซอย" name="req_alley" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                    <div class="col-10">
                    <input title="ถนน" name="req_road" class="form-control" type="text" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                      <div class="col-10">
                    <select title="เลือก" name="req_province" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                      <div class="col-10">
                    <select title="เลือก" name="req_amphur" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                      <div class="col-10">
                    <select title="เลือก" name="req_tumbon" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                    <div class="col-10">
                    <input title="5 หลัก" name="req_postcode" placeholder="5 หลัก" class="form-control" type="text" />
                    </div>
                  </div> 

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                    <div class="col-10">
                    <input title="เบอร์โทรศัพท์ (บ้าน)" name="diff_info[req_home_tel_no]" class="form-control" type="text" value="<?php echo $diff_info['req_home_tel_no'];?>"/>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                      <div class="col-10">
                    <input title="เบอร์โทรศัพท์ (มือถือ)" name="diff_info[req_tel_no]" class="form-control" type="text" value="<?php echo $diff_info['req_tel_no'];?>"/> 
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (แฟกซ์)</label>
                    <div class="col-10">
                    <input title="เบอร์โทรศัพท์ (แฟกซ์)" name="req_fax" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 hidden-xs col-sm-offset-3">
                  &nbsp;
                  </div> 
                </div>
            </div>

            <div class="panel-heading"><h4>ประวัติผู้สูงอายุที่ขอรับบริการ</h4></div>
            <div class="panel-body" style="padding: 20px;">

                <div class="form-group row">
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label"></label>
                      <div class="col-10">
              <?php
              if($process_action!='View') {
              ?>
              <div class="radio">
                <label><input title="มีบัตรประจำตัวประชาชน" type="radio" name="rd_pers_id" value=1 required>มีบัตรประจำตัวประชาชน</label>
              </div>
              <?php
              }else if($rd_pers_id==1) {
              ?>
                <i class="fa fa-check-circle-o">&nbsp;<font size=4>มีบัตรประจำตัวประชาชน</font></i>
              <?php 
              }
              ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน <font color=red>*</font></label>
                      <div class="col-10 input-group">
              <input title="13 หลัก" placeholder="13 หลัก" class="form-control" type="number" name="diff_info[pers_id]" value="<?php echo $diff_info['pers_id'];?>" required readonly />

              <span title="ค้นหา" id="persID_search" style="cursor:pointer" class="input-group-addon"><i class="text-primary glyphicon glyphicon-search"></i></span>
              
              <?php 
                if($process_action!='View') {
               ?>              
              <script>
                $("#persID_search").click(function(){
                    if($("input[name='diff_info[pers_id]']").val()!='') {
                      $("#persID_search i").removeClass("glyphicon glyphicon-search text-primary");
                      $("#persID_search i").addClass("fa fa-circle-o-notch fa-spin text-info");
                    setTimeout(function(){
                      //$("#per_result_ok").text("ดึงข้อมูลสำเร็จ"); $("#per_result_nok").text("ดึงข้อมูลล้มเหลว");
                      $("#persID_search i").removeClass("fa fa-circle-o-notch fa-spin text-info");
                      $("#persID_search i").addClass("fa fa-check text-success");
                      //$("#per_search i").addClass("fa fa-times text-danger");
                    },1000);
                  }
                });
              </script>
              <?php
              }
              ?>
                    </div>
                  </div>

                  <div class="col-xs-12 hidden-xs col-sm-offset-6">

                  </div>

                  <div class="col-xs-12 col-sm-offset-3 col-sm-3">
                        <label for="example-text-input" class="col-2 col-form-label">วันที่ออกบัตร</label>
                  <div id="elder_iddatein" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                      <input title="เลือกวันที่" name="elder_iddatein" placeholder="เลือกวันที่" class="form-control" type="text"/>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>                    
                    <script type="text/javascript">
                    $(function () {
                      $("#elder_iddatein").datepicker({ 
                          autoclose: true, 
                          todayHighlight: true
                      });
                    });
                    </script>
                  </div>   
                  <div class="col-xs-12 col-sm-3">
                        <label for="example-text-input" class="col-2 col-form-label">วันที่บัตรหมดอายุ</label>
                  <div id="elder_iddateout" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                      <input title="เลือกวันที่" name="elder_iddateout" placeholder="เลือกวันที่" class="form-control" type="text"/>
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  </div>                    
                    <script type="text/javascript">
                    $(function () {
                      $("#elder_iddateout").datepicker({ 
                          autoclose: true, 
                          todayHighlight: true
                      });
                    });
                    </script>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">สถานที่ออกบัตร</label>
                      <div class="col-10">
                    <input title="สถานที่ออกบัตร" name="elder_idlocateout" class="form-control" type="text"/>
                    </div>
                  </div>                   

                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label"></label>
                      <div class="col-10">
                  <?php
                  if($process_action!='View') {
                  ?>
                  <div class="radio">
                    <label><input title="ไม่มีบัตร/ไม่สามารถระบุได้" type="radio" name="rd_pers_id" value=2 required>ไม่มีบัตร/ไม่สามารถระบุได้</label>
                  </div>
                  <?php
                  }else if($rd_pers_id==2) {
                  ?>
                    <i class="fa fa-check-circle-o">&nbsp;<font size=4>ไม่มีบัตร/ไม่สามารถระบุได้</font></i>
                  <?php 
                  }
                  ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-9">
                      <label for="example-text-input" class="col-2 col-form-label">เนื่องจาก</label>
                      <div class="col-10">
              <input title="เนื่องจาก" class="form-control" type="text" name="diff_info[elder_none_inasmuch]" value="<?php echo $diff_info['elder_none_inasmuch'];?>" readonly />
                    </div>
                  </div>  

                  <div class="col-xs-12 hidden-xs">

                  </div>                  
              <?php 
                if($process_action!='View') {
               ?>  
                  <script>
                      $("input[name='rd_pers_id']").click(function(){
                        if($(this).val()==1) {
                          $("input[name='diff_info[pers_id]']").addClass('required');
                          $("input[name='diff_info[pers_id]']").attr('readonly',false);
                          $("input[name='diff_info[elder_none_inasmuch]']").val("");
                          $("input[name='diff_info[elder_none_inasmuch]']").attr('readonly',true);
                        }else {
                          $("input[name='diff_info[pers_id]']").removeClass('required');
                          $("input[name='diff_info[pers_id]']").val("");
                          $("input[name='diff_info[pers_id]']").attr('readonly',true);
                          $("input[name='diff_info[elder_none_inasmuch]']").attr('readonly',false);     
                          
                          $("#persID_search i").removeClass("fa fa-check text-success");
                          $("#persID_search i").removeClass("fa fa-times text-danger");       
                          $("#persID_search i").addClass("text-primary glyphicon glyphicon-search");              
                        }
                      });
                  </script>
              <?php
              }
              ?>
                  <div class="col-xs-12 col-sm-3">

                      <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
                      <div class="col-10">

              <!-- <input title="คำนำหน้านาม" class="form-control" type="text" /> -->
                      <select title="เลือก" placeholder="เลือก" name="diff_info[elder_prename]" class="form-control">
                        <option value="">เลือก</option>
                        <option <?php if($diff_info['elder_prename']=='นาย') {?> selected <?php }?> value="นาย">นาย</option>
                        <option <?php if($diff_info['elder_prename']=='นาง') {?> selected <?php }?> value="นาง">นาง</option>
                        <option <?php if($diff_info['elder_prename']=='นางสาว') {?> selected <?php }?> value="นางสาว">นางสาว</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว <font color=red>*</font> <!--<i title="ชื่อตัว" class="fa fa-pencil-square text-success" aria-hidden="true"></i>--><input title="ชื่อตัว" checked type='checkbox' name='elder_firstname'></label>
                      <div class="col-10">
              <input title="ชื่อตัว" name="diff_info[elder_firstname]" class="form-control" type="text" value="<?php echo $diff_info['elder_firstname'];?>" required/>
                    </div>
                  </div>  
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล <font color=red>*</font> </label>
                      <div class="col-10">
              <input title="ชื่อสกุล" name="diff_info[elder_lastname]" class="form-control" type="text" value="<?php echo $diff_info['elder_lastname'];?>" required />
                    </div>
                  </div>  

                  <div class="col-xs-12 hidden-xs col-sm-offset-3">

                  </div>

                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">วัน-เดือน-ปีเกิด</label>
            <div id="elder_birthdate" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                <input title="เลือกวันที่" name="elder_birthdate" placeholder="เลือกวันที่" class="form-control" type="text"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>                    
              <script type="text/javascript">
              $(function () {
                $("#elder_birthdate").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
                });
              });
              </script>
                  </div>  
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
                      <div class="col-10">
              <h5>65 ปี 3 เดือน 20 วัน</h5>
                    </div>
                  </div>
                  <div class="col-xs-12 hidden-xs col-sm-offset-6">

                  </div>

                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">วันที่เสียชีวิต</label>
            <div id="elder_diedate" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                <input title="เลือกวันที่" name="elder_diedate" placeholder="เลือกวันที่" class="form-control" type="text"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>                    
              <script type="text/javascript">
              $(function () {
                $("#elder_diedate").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
                });
              });
              </script>
                  </div>
                  <div class="col-xs-12 col-sm-9">
                      <label for="example-text-input" class="col-2 col-form-label">สาเหตุการเสียชีวิต</label>
                      <div class="col-10">
              <input title="ระบุ" name="elder_diecause" placeholder="ระบุ" class="form-control" type="text" />
                    </div>
                  </div>  


                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">เลขที่ใบมรณบัตร</label>
                      <div class="col-10">
              <input title="เลขที่ใบมรณบัตร" name="elder_dieid" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                      <label for="example-text-input" class="col-2 col-form-label">หน่วยงานที่ออกใบมรณบัตร</label>
                      <div class="col-10">
              <input title="ชื่อหน่วยงาน" name="elder_departoutid" placeholder="ชื่อหน่วยงาน" class="form-control" type="text" />
                    </div>
                  </div>  
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">วันที่ออกใบมรณบัตร</label>
            <div id="elder_dieoutdate" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
                <input title="เลือกวันที่" name="elder_dieoutdate" placeholder="เลือกวันที่" class="form-control" type="text"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>                    
              <script type="text/javascript">
              $(function () {
                $("#elder_dieoutdate").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true
                });
              });
              </script>
                  </div>


                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">เพศ</label>
                      <div class="col-10">
              <h5><input title="ชาย" type="radio" value="m" name="elder_sex"> ชาย &nbsp;&nbsp;
                <input title="หญิง" type="radio" value="f" name="elder_sex"> หญิง 
               </h5>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">เชื้อชาติ</label>
                      <div class="col-10">
              <input title="ระบุ" name="elder_origin" placeholder="ระบุ" class="form-control" type="text" />
                    </div>
                  </div> 
                  <div class="col-xs-12 col-sm-3 dropdown">
                      <label for="example-text-input" class="col-2 col-form-label">สัญชาติ</label>
                      <div class="col-10">
              <select title="เลือก" name="elder_nation_id" placeholder="เลือก" class="form-control" id="elder_nation_id">
                  <option>เลือก</option>
              <?php
              $rows = $this->difficult_model->getAll_nationality();
              foreach($rows as $row) {
              ?>
                  <option value="<?php echo $row['nation_id'];?>"><?php echo $row['nation_title'];?></option>
              <?php
              }
              ?>
              </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3 dropdown">
                      <label for="example-text-input" class="col-2 col-form-label">ศาสนา</label>
                      <div class="col-10">
              <select title="เลือก" name="elder_religion_id" placeholder="เลือก" class="form-control" id="elder_religion_id">
                  <option>เลือก</option>
              <?php
              $rows = $this->difficult_model->getAll_religion();
              foreach($rows as $row) {
              ?>
                  <option value="<?php echo $row['religion_id'];?>"><?php echo $row['religion_title'];?></option>
              <?php
              }
              ?>
              </select>
                    </div>
                  </div>


                  <div class="col-xs-12">
                    <h4><b>ที่อยู่ (ตามทะเบียนบ้าน)</b> <input checked title="ที่อยู่ (ตามทะเบียนบ้าน)" type="checkbox" name="elder_ck_homeid"></h4>
                  </div>

                  <div class="col-xs-12">
                    <h4><b>สถานะการพักอาศัย</b></h4>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <div class="col-10">
              <input title="บ้านตนเอง" type="radio" value="บ้านตนเอง" name="elder_homeid">&nbsp;บ้านตนเอง
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <div class="col-10">
              <input title="อาศัยผู้อื่นอยู่" type="radio" value="อาศัยผู้อื่นอยู่" name="elder_homeid">&nbsp;อาศัยผู้อื่นอยู่
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <div class="col-10">
              <input title="บ้านเช่า" type="radio" value="บ้านเช่า" name="elder_homeid">&nbsp;บ้านเช่า
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <div class="col-10">
              <input title="อยู่กับผู้จ้าง" type="radio" value="อยู่กับผู้จ้าง" name="elder_homeid">&nbsp;อยู่กับผู้จ้าง
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <div class="col-10">
              <input title="ไม่มีที่อยู่เป็นหลักแหล่ง" type="radio" value="ไม่มีที่อยู่เป็นหลักแหล่ง" name="elder_homeid">&nbsp;ไม่มีที่อยู่เป็นหลักแหล่ง
                    </div>
                  </div>                                    
                  <div class="col-xs-12 hidden-xs col-sm-offset-9">
                      &nbsp;
                  </div>

                  <div class="col-xs-12">
                    <h4><b>ลักษณะการครอบครองที่ดิน</b></h4>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <div class="col-10">
              <input title="ที่ดินตนเอง" type="radio" value="ที่ดินตนเอง" name="elder_homeid_occupy">&nbsp;ที่ดินตนเอง
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                      <div class="col-10">
              <input title="ที่ดินเช่า" type="radio" value="ที่ดินเช่า" name="elder_homeid_occupy">&nbsp;ที่ดินเช่า
                    </div>
                  </div>                                  
                  <div class="col-xs-12 hidden-xs col-sm-offset-6">
                      &nbsp;
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">เลขรหัสประจำบ้าน</label>
                    <div class="col-10 input-group">

              <input title="13 หลัก" placeholder="13 หลัก" name="elder_homeid" class="form-control" type="number"/>

              <span title="ค้นหา" id="elder_homeid_search" style="cursor:pointer" class="input-group-addon"><i class="text-primary glyphicon glyphicon-search"></i></span>

              <?php 
                if($process_action!='View') {
               ?>                
              <script>
                $("#elder_homeid_search").click(function(){
                  if($("input[name='elder_homeid']").val()!='') {
                    $("#elder_homeid_search i").removeClass("glyphicon glyphicon-search text-primary");
                    $("#elder_homeid_search i").addClass("fa fa-circle-o-notch fa-spin text-info");
                  setTimeout(function(){
                    //$("#per_result_ok").text("ดึงข้อมูลสำเร็จ"); $("#per_result_nok").text("ดึงข้อมูลล้มเหลว");
                    $("#elder_homeid_search i").removeClass("fa fa-circle-o-notch fa-spin text-info");
                    $("#elder_homeid_search i").addClass("fa fa-check text-success");
                    //$("#per_search i").addClass("fa fa-times text-danger");
                  },1000);
                  }
                });
              </script>
              <?php
              }
              ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสำนักทะเบียน</label>
                    <div class="col-10">
                    <input title="ระบุ" name="elder_homeid_nameid" class="form-control" placeholder="ระบุ" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">บ้านเลขที่</label>
                    <div class="col-10">
                    <input title="บ้านเลขที่" name="elder_homeid_village" class="form-control" type="text" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">หมู่ที่</label>
                    <div class="col-10">
                    <input title="หมู่ที่" name="elder_homeid_villageid" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                    <div class="col-10">
                    <input title="ตรอก" name="elder_homeid_lane" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                    <div class="col-10">
                    <input title="ซอย" name="elder_homeid_alley" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                    <div class="col-10">
                    <input title="ถนน" name="elder_homeid_road" class="form-control" type="text" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                      <div class="col-10">
                    <select title="เลือก" name="elder_homeid_province" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                      <div class="col-10">
                    <select title="เลือก" name="elder_homeid_amphur" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                      <div class="col-10">
                    <select title="เลือก" name="elder_homeid_tumbon" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                    <div class="col-10">
                    <input title="5 หลัก" name="elder_homeid_postcode" placeholder="5 หลัก" class="form-control" type="text" />
                    </div>
                  </div>               

                  <div class="col-xs-12">
                    <h6>ที่อยู่ (ปัจจุบัน) <input title="ที่อยู่ (ปัจจุบัน)" checked type="checkbox" name="elder_address_present">&nbsp;&nbsp;&nbsp;(<input title="ที่อยู่ (ปัจจุบัน)" type="checkbox" name="elder_address_same_ck_homeid"> ตรงกับที่อยู่ตามทะเบียนบ้าน)</h6>
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">เลขรหัสประจำบ้าน</label>
                    <div class="col-10 input-group">

              <input title="13 หลัก" placeholder="13 หลัก" name="elder_address_present" class="form-control" type="number"/>

              <span title="ค้นหา" id="elder_address_present_search" style="cursor:pointer" class="input-group-addon"><i class="text-primary glyphicon glyphicon-search"></i></span>

              <?php 
                if($process_action!='View') {
               ?>                
              <script>
                $("#elder_address_present_search").click(function(){
                  if($("input[name='elder_address_present']").val()!='') {
                    $("#elder_address_present_search i").removeClass("glyphicon glyphicon-search text-primary");
                    $("#elder_address_present_search i").addClass("fa fa-circle-o-notch fa-spin text-info");
                  setTimeout(function(){
                    //$("#per_result_ok").text("ดึงข้อมูลสำเร็จ"); $("#per_result_nok").text("ดึงข้อมูลล้มเหลว");
                    $("#elder_address_present_search i").removeClass("fa fa-circle-o-notch fa-spin text-info");
                    $("#elder_address_present_search i").addClass("fa fa-check text-success");
                    //$("#per_search i").addClass("fa fa-times text-danger");
                  },1000);
                  }
                });
              </script>
              <?php
              }
              ?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสำนักทะเบียน</label>
                    <div class="col-10">
                    <input title="ระบุ" name="elder_address_present_nameid" class="form-control" placeholder="ระบุ" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">บ้านเลขที่</label>
                    <div class="col-10">
                    <input title="บ้านเลขที่" name="elder_address_present_village" class="form-control" type="text" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">หมู่ที่</label>
                    <div class="col-10">
                    <input title="หมู่ที่" name="elder_address_present_villageid" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                    <div class="col-10">
                    <input title="ตรอก" name="elder_address_present_lane" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                    <div class="col-10">
                    <input title="ซอย" name="elder_address_present_alley" class="form-control" type="text" />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                    <div class="col-10">
                    <input title="ถนน" name="elder_address_present_road" class="form-control" type="text" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                      <div class="col-10">
                    <select title="เลือก" name="elder_address_present_province" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                      <div class="col-10">
                    <select title="เลือก" name="elder_address_present_amphur" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                      <div class="col-10">
                    <select title="เลือก" name="elder_address_present_tumbon" placeholder="เลือก" class="form-control" id="sel1">
                        <option>เลือก</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                    <div class="col-10">
                    <input title="5 หลัก" name="elder_address_present_postcode" placeholder="5 หลัก" class="form-control" type="text" />
                    </div>
                  </div>   

                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">ตำแหน่งพิกัดภูมิศาสตร์</label>
                      <div class="col-10 input-group">
              <input title="ระบุพิกัด" name="elder_coordinates" placeholder="ระบุพิกัด" class="form-control" type="text" />
              <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span> 
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                    <div class="col-10">
              <input title="เบอร์โทรศัพท์ (บ้าน)" name="diff_info[elder_home_tel_no]" class="form-control" type="text" value="<?php echo $diff_info['elder_home_tel_no'];?>" />
                    </div>
                  </div>
                    <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                      <div class="col-10">
                    <input title="เบอร์โทรศัพท์ (มือถือ)" name="diff_info[elder_tel_no]" class="form-control" type="text" value="<?php echo $diff_info['elder_tel_no'];?>" /> 
                      </div>
                    </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (แฟกซ์)</label>
                    <div class="col-10">
              <input title="เบอร์โทรศัพท์ (แฟกซ์)" name="elder_fax" class="form-control" type="text" />
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">ที่อยู่อีเมล</label>
                    <div class="col-10">
              <input title="ระบุ" name="elder_email" placeholder="ระบุ" class="form-control" type="text" />
                    </div>
                  </div>                                  
                  <div class="col-xs-12 hidden-xs col-sm-offset-6">
                      &nbsp;
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">สถานะภาพ</label>
                      <div class="col-10">
              <select title="เลือก" name="elder_status" placeholder="เลือก" class="form-control" id="sel1">
                  <option>เลือก</option>
                <?php
                $status = array('โสด','สมรสอยู่ด้วยกัน','สมรสแยกกันอยู่','อย่าร้าง','ไม่ได้สมรสแต่อยู่ด้วยกัน','หม้าย(คู่สมรสเสียชีวิต)');
                foreach ($status as $data) {
                ?>
                  <option value="<?php echo $data;?>"><?php echo $data;?></option>
                <?php
                }
                ?>
              </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                      <div class="col-10">
              <select title="เลือก" name="elder_edu_lvl_id" placeholder="เลือก" class="form-control" id="elder_edu_lvl_id">
                  <option>เลือก</option>
                <?php
                $rows = $this->difficult_model->getAll_edu_level();
                foreach($rows as $row) {
                ?>
                    <option value="<?php echo $row['edu_lvl_id'];?>"><?php echo $row['edu_lvl_title'];?></option>
                <?php
                }
                ?>
              </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">&nbsp;</label>
                    <div class="col-10">
              <input title="ระบุ" name="elder_edu_specify" placeholder="ระบุ" class="form-control" type="text" readonly />
              <script>
                $("#elder_edu_lvl_id").change(function(){
                  if($(this).val()=='7'){
                    $("input[name='elder_edu_specify']").attr('readonly',false);
                  }else {
                    $("input[name='elder_edu_specify']").attr('readonly',true);
                  }
                });
              </script>
                    </div>
                  </div>                  

                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">อาชีพ (ปัจจุบัน) <input title="อาชีพ (ปัจจุบัน)" checked type="checkbox" name=""></label>
                    <div class="col-10">
              <input title="อาชีพ (ปัจจุบัน)" name="elder_job_present" class="form-control" type="text" />
                    </div>
                  </div>  
                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">อาชีพ (เดิม)</label>
                    <div class="col-10">
              <input title="อาชีพ (เดิม)" name="elder_job_old" class="form-control" type="text" />
                    </div>
                  </div>    

                  <div class="col-xs-12 col-sm-offset-12">

                  </div> 
  
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">รายได้เฉลี่ยต่อเดือน (บาท)</label>
                    <div class="col-10">
              <input title="รายได้เฉลี่ยต่อเดือน (บาท)" name="avg_incm_pmth" class="form-control" type="text" />
                    </div>
                  </div>  
                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">ที่มาของรายได้</label>
                      <div class="col-10">
              <select title="เลือก" name="elder_inc_src" placeholder="เลือก" class="form-control" id="elder_inc_src">
                  <option>เลือก</option>
                <?php
                $status = array('ด้วยตนเอง','ผู้อื่นให้');
                foreach ($status as $data) {
                ?>
                  <option value="<?php echo $data;?>"><?php echo $data;?></option>
                <?php
                }
                ?>
              </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <label for="example-text-input" class="col-2 col-form-label">&nbsp;</label>
                    <div class="col-10">
              <input title="ระบุ" name="elder_inc_src_specify" placeholder="ระบุ" class="form-control" type="text" readonly/>
              <script>
                $("#elder_inc_src").change(function(){
                  if($(this).val()=='ผู้อื่นให้'){
                    $("input[name='elder_inc_src_specify']").attr('readonly',false);
                  }else {
                    $("input[name='elder_inc_src_specify']").attr('readonly',true);
                  }
                });
              </script>
                    </div>
                  </div> 

                </div>

        <div class="form-group row">

                  <div class="col-xs-12 col-sm-3">
                      <label for="example-text-input" class="col-2 col-form-label"><h4><b>จำนวนสมาชิกในครอบครัว</b></h4></label>
                      <div class="col-10 input-group">
              <input title="จำนวนสมาชิก" name="num_family_members" placeholder="จำนวนสมาชิก" class="form-control" type="number" value=2 min=1 max=8 id="num_family_members" />
              <span title="ตกลง" class="input-group-addon" style="cursor: pointer;" id="bt_family_members" ><i class="fa fa-hand-pointer-o text-success">&nbsp;ตกลง</i></span>  
                    </div>
                  </div>

          <div class="family_members clearfix" style="padding: 10px;">

            <div class="family_members_items clearfix">
                       <div class="col-xs-12">
                         <h4><b>สมาชิกในครอบครัวคนที่ 1</b></h4>
                       </div>
                    
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน</label>
                          <div class="col-10 input-group">
                  <input title="13 หลัก" name="elder_family_members_pers_id[]" placeholder="13 หลัก" class="form-control" type="text" />
                  <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> 
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
                          <div class="col-10">
                            <select title="เลือก" placeholder="เลือก" name="elder_family_members_prename[]" class="form-control">
                              <option value="">เลือก</option>
                              <option value="นาย">นาย</option>
                              <option value="นาง">นาง</option>
                              <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว</label>
                          <div class="col-10">
                  <input title="ชื่อตัว" name="elder_family_members_firstname[]" class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล</label>
                          <div class="col-10">
                  <input title="ชื่อสกุล" name="elder_family_members_lastname[]" class="form-control" type="text" />
                        </div>
                      </div>                  

                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
                          <div class="col-10">
                  <input title="คำนำหน้านาม" name="elder_family_members_old[]" class="form-control" type="number" min=1/>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">เกี่ยวข้องเป็น</label>
                          <div class="col-10">
                  <input title="เกี่ยวข้องเป็น" name="elder_family_members_about[]" class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">อาชีพ</label>
                          <div class="col-10">
                  <input title="อาชีพ" name="elder_family_members_job[]" class="form-control" type="text" />
                        </div>
                      </div> 
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">รายได้ต่อเดือน</label>
                          <div class="col-10">
                  <input title="รายได้ต่อเดือน" name="elder_family_members_avg_incpmth[]" class="form-control" type="number" min=0/>
                        </div>
                      </div>                   
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">สุขภาพ</label>
                          <div class="col-10">
                  <input title="สุขภาพ" name="elder_family_members_health[]" class="form-control" type="text" />
                        </div>
                      </div> 
            </div>

            <div class="family_members_items clearfix">
                       <div class="col-xs-12">
                         <h4><b>สมาชิกในครอบครัวคนที่ 2</b></h4>
                       </div>
                    
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">เลขประจำตัวประชาชน</label>
                          <div class="col-10 input-group">
                  <input title="13 หลัก" name="elder_family_members_pers_id[]" placeholder="13 หลัก" class="form-control" type="text" />
                  <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span> 
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
                          <div class="col-10">
                            <select title="เลือก" placeholder="เลือก" name="elder_family_members_prename[]" class="form-control">
                              <option value="">เลือก</option>
                              <option value="นาย">นาย</option>
                              <option value="นาง">นาง</option>
                              <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว</label>
                          <div class="col-10">
                  <input title="ชื่อตัว" name="elder_family_members_firstname[]" class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล</label>
                          <div class="col-10">
                  <input title="ชื่อสกุล" name="elder_family_members_lastname[]" class="form-control" type="text" />
                        </div>
                      </div>                  

                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
                          <div class="col-10">
                  <input title="คำนำหน้านาม" name="elder_family_members_old[]" class="form-control" type="number" min=1/>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">เกี่ยวข้องเป็น</label>
                          <div class="col-10">
                  <input title="เกี่ยวข้องเป็น" name="elder_family_members_about[]" class="form-control" type="text" />
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">อาชีพ</label>
                          <div class="col-10">
                  <input title="อาชีพ" name="elder_family_members_job[]" class="form-control" type="text" />
                        </div>
                      </div> 
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">รายได้ต่อเดือน</label>
                          <div class="col-10">
                  <input title="รายได้ต่อเดือน" name="elder_family_members_avg_incpmth[]" class="form-control" type="number" min=0/>
                        </div>
                      </div>                   
                      <div class="col-xs-12 col-sm-3">
                          <label for="example-text-input" class="col-2 col-form-label">สุขภาพ</label>
                          <div class="col-10">
                  <input title="สุขภาพ" name="elder_family_members_health[]" class="form-control" type="text" />
                        </div>
                      </div> 
            </div>

            <script>

            	//var code = $(".family_members .family_members_items:first-child").clone();

              $("#bt_family_members").click(function(){
              	
                //console.log($("#num_family_members").val()+' '+$(".family_members .family_members_items").length);
                if($("#num_family_members").val()<3) $("#num_family_members").val("2");
                if($("#num_family_members").val()>8) $("#num_family_members").val("8");

                if($("#num_family_members").val()>$(".family_members .family_members_items").length) {
                  for(i=$(".family_members .family_members_items").length;i<$("#num_family_members").val();i++) {
                    $('.family_members .family_members_items:first-child').clone().appendTo('.family_members');
                    console.log(i);
                  }
                }
                else if($("#num_family_members").val()<$(".family_members .family_members_items").length) {
                  for(var i=$("#num_family_members").val();i<$(".family_members .family_members_items").length;i++) {
                    $('.family_members .family_members_items:eq('+($(".family_members .family_members_items").length-1)+')').remove();
                    console.log(i);
                  }
                }

                $.each($('.family_members .family_members_items'), function( key, value ) {
				  $(".family_members .family_members_items:eq("+key+") .col-xs-12:eq(0) h4 b").html("สมาชิกในครอบครัวคนที่ "+(key+1));
				});
              
              });
            </script>

                  </div>



        </div>

            </div>

            <div class="panel-heading"><h4>ข้อมูลการตรวจเยี่ยม</h4></div>
            <div class="panel-body" style="padding: 20px;">
                <div class="form-group row">
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่ตรวจเยี่ยม <font color='red'>*</font></label>

						<div id="date_of_visit" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" name="diff_info[date_of_visit]" placeholder="เลือกวันที่" class="form-control" type="text"/ required>
						    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
						</div>	                	

					    <script type="text/javascript">
					    <?php
					    if($diff_info['date_of_visit']=='') {
					    ?>
							$(function () {
								$("#date_of_visit").datepicker({ 
								    autoclose: true, 
								    todayHighlight: true
								});
							});

			              <?php
			          }else {
			              $tmp = explode('-',$diff_info['date_of_visit']);
			              ?>
			              $(function () {
			               $("#date_of_visit").datepicker({ 
			                    autoclose: true, 
			                    todayHighlight: true
			               }).datepicker('update', new Date(Date.UTC(<?php echo $tmp[2];?>,<?php echo $tmp[1];?>-1,<?php echo $tmp[0];?>)));
			              });
			           <?php
			           }
			           ?>
					    </script>

                	</div>
                	<div class="col-xs-12 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">เจ้าหน้าที่ผู้ตรวจเยี่ยม <font color="red">*</font></label>
	                    <div class="col-10">
							<input title="เจ้าหน้าที่ผู้ตรวจเยี่ยม" name="diff_info[visitor_name]" value="<?php echo $diff_info['visitor_name'];?>" class="form-control" type="text" required/>
	                	</div>
                	</div>

                	<div class="col-xs-12 col-sm-offset-6 col-sm-6">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตำแหน่ง (เจ้าหน้าที่ผู้ตรวจเยี่ยม)</label>
	                    <div class="col-10">
							<input title="ชื่อตำแหน่ง (เจ้าหน้าที่ผู้ตรวจเยี่ยม)" name="diff_info[visitor_position]" value="<?php echo $diff_info['visitor_position'];?>" class="form-control" type="text"/>
	                	</div>
                	</div>

				</div>

				<div class="form-group row">
                	<div class="col-xs-12 col-sm-3 dropdown">
	                    <label for="example-text-input" class="col-2 col-form-label">สถานที่ตรวจเยี่ยม</label>
	                    <div class="col-10">
							<select title="เลือก" placeholder="เลือก" name="diff_info[visit_place]" class="form-control" id="visit_place">
							<option>เลือก</option>
			                <?php
			                $visit_options = array('ที่พักอาศัย','โรงพยาบาล','สถานีตำรวจ','อื่นๆ (ระบุ)');
			                foreach ($visit_options as $data) {
			                ?>
			                  <option <?php if($diff_info['visit_place']==$data){?> selected <?php }?> value="<?php echo $data;?>"><?php echo $data;?></option>
			                <?php
			                }
			                ?>
							</select>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-9">
	                    <label for="example-text-input" class="col-2 col-form-label">&nbsp;</label>
	                    <div class="col-10">
							<input title="ระบุ" placeholder="ระบุ" name="diff_info[visit_place_identify]" class="form-control" type="text" <?php if($diff_info['visit_place']!='อื่นๆ ระบุ' || $diff_info['visit_place']==''){?> readonly <?php }?> value="<?php echo $diff_info['visit_place_identify'];?>" />
	                	</div>
                	</div> 
		              <script>
		                $("#visit_place").change(function(){
		                  if($(this).val()=='อื่นๆ (ระบุ)'){
		                    $("input[name='diff_info[visit_place_identify]']").attr('readonly',false);
		                  }else {
		                    $("input[name='diff_info[visit_place_identify]']").attr('readonly',true);
		                  }
		                });
		              </script>  	

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">ความคิดเห็นนักสังคมสงเคราะห์</label>
					  <textarea title="ความคิดเห็นนักสังคมสงเคราะห์" name="diff_info[visit_alm_opinion]" class="form-control" rows="5" id="comment"><?php echo $diff_info['visit_alm_opinion'];?></textarea>
                	</div>

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">สภาพปัญหาความเดือดร้อน</label>
					  <textarea title="สภาพปัญหาความเดือดร้อน" name="diff_info[visit_alm_trouble]" class="form-control" rows="5" id="comment"><?php echo $diff_info['visit_alm_trouble'];?></textarea>
                	</div>

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">ผลการให้ความช่วยเหลือ</label>
					  <textarea title="ผลการให้ความช่วยเหลือ" name="diff_info[visit_alm_help]" class="form-control" rows="5" id="comment"><?php echo $diff_info['visit_alm_help'];?></textarea>
                	</div>

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">แนวทางการช่วยเหลือ</label>
					  <textarea title="แนวทางการช่วยเหลือ" name="diff_info[visit_alm_help_guide]" class="form-control" rows="5" id="comment"><?php echo $diff_info['visit_alm_help_guide'];?></textarea>
                	</div>

              	</div>
        		<div class="form-group row">

                  <div class="col-xs-12 col-sm-12">
                      <label for="example-text-input" class="col-2 col-form-label"><h4><b>หนี้สิ้น</b></h4></label>
                      <div class="col-10 input-group">
			              <div class="radio">
			                <label>
			                	<input title="มีบัตรประจำตัวประชาชน" type="radio" name="elder_debt_end" value='ไม่มีหนี้สิ้น'>ไม่มีหนี้สิ้น
			                </label>
			              </div>
                      </div>
                  </div>

                  <div class="col-xs-12 col-sm-12">
                      <label for="example-text-input" class="col-2 col-form-label"></label>
                      <div class="col-10 input-group">
			              <div class="radio">
			                <label>
			                	<input title="มีบัตรประจำตัวประชาชน" type="radio" name="elder_debt_end" value='มีหนี้สิ้น'>มีหนี้สิ้น
			                </label>
			              </div>
                      </div>
                  </div>

                <div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เงินกู้ในระบบ <input title="เงินกู้ในระบบ" checked type='checkbox' name='insystem_loan_ck'></label>
	                    <div class="col-10">
							<input title="จำนวน" name="insystem_loan" class="form-control" type="number" min=0 readonly />
	                	</div>
                </div>

                <div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เงินกู้ในระบบ <input title="เงินกู้ในระบบ" checked type='checkbox' name='outsystem_loan_ck'></label>
	                    <div class="col-10">
							<input title="จำนวน" name="outsystem_loan" class="form-control" type="number" min=0 readonly />
	                	</div>
                	</div>
                </div>
                <script>

                	$("input:radio[name='elder_debt_end']").change(function(){
                		if($(this).val()=='ไม่มีหนี้สิ้น') {
                			$("input[name='insystem_loan']").attr('readonly',true);$("input[name='outsystem_loan']").attr('readonly',true);
                		}else {
                			$("input[name='insystem_loan']").attr('readonly',false);$("input[name='outsystem_loan']").attr('readonly',false);
                		}
                	});

                	$("input[name='insystem_loan_ck']").click(function(){
                		if($("input:radio[name='elder_debt_end']:checked").val() == 'มีหนี้สิ้น') {
                			if($(this).is(':checked'))$("input[name='insystem_loan']").attr('readonly',false);
                			else $("input[name='insystem_loan']").attr('readonly',true);
                		}

                	});

                	$("input[name='outsystem_loan_ck']").click(function(){
                		if($("input:radio[name='elder_debt_end']:checked").val() == 'มีหนี้สิ้น') {
	                		if($(this).is(':checked'))$("input[name='outsystem_loan']").attr('readonly',false);
	                		else $("input[name='outsystem_loan']").attr('readonly',true);
                		}
                	});

                </script>

            </div>


            <div class="form-group row">
              <div class="col-xs-12 text-center">

                <input type='hidden' name='state'>
                <input type='submit' name="bt_submit" hidden='hidden'>

                <?php
                if($process_action!='View') {
                ?>
                  <button onclick="$('input[name=state]').val(1); $('#savModel').modal('show'); return false;" title="บันทึกข้อมูล" class="btn btn-primary"><i class="fa fa-floppy-o"></i>&nbsp;บันทึกข้อมูล</button>
              
                  <button onclick="$('input[name=state]').val(2); $('#savModel').modal('show'); return false;" title="บันทึกข้อมูลแล้วกลับไปหน้าหลัก" name="bt_submit_back" class="btn btn-info"><i class="glyphicon glyphicon-saved"></i>&nbsp;บันทึกข้อมูลแล้วกลับไปหน้าหลัก</button>

                   <button onclick="if(frmKey){$('#calModel').modal('show'); return false;}else{$('#calbtnYes').click();}" title="ยกเลิก" name="bt_cancel" class="btn btn-default inputBT"><i class="fa fa-ban"></i>&nbsp;ยกเลิก</button>
                <?php
                }else {
                ?>
                   <a href="<?php echo site_url('difficult/assist_list');?>" title="ย้อนกลับไปเมนูหลัก" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left">ย้อนกลับไปเมนูหลัก</span>
                   </a>
                <?php
                }
                ?>

              </div>
            </div>

        </div>
    </div>
    <?php
    echo form_close();
    ?>

<!-- Modal Delete -->
<div id="dltModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ลบข้อมูล</h4>
      </div>
      <div class="modal-body">
        <p>ระบบจะดำเนินการลบรายการข้อมูล</p>
        <p>ยืนยันการลบ?</p>
      </div>
      <div class="modal-footer">
        <button id="dltbtnYes" type="button" class="btn btn-danger" data-dismiss="modal">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cancel -->
<div id="calModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ยกเลิก</h4>
      </div>
      <div class="modal-body">
        <p>ระบบจะดำเนินการยกเลิกรายการข้อมูล</p>
        <p>ยืนยันการยกเลิก?</p>
      </div>
      <div class="modal-footer">
        <button id="calbtnYes" type="button" class="btn btn-warning" data-dismiss="modal">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Before Add -->
<div id="bcAddModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ยกเลิก</h4>
      </div>
      <div class="modal-body">
        <p>ระบบจะดำเนินการยกเลิกรายการข้อมูล</p>
        <p>ยืนยันการยกเลิก?</p>
      </div>
      <div class="modal-footer">
        <button id="bcAddYes" type="button" class="btn btn-warning" data-dismiss="modal">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Save -->
<div id="savModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">บันทึกข้อมูล</h4>
      </div>
      <div class="modal-body">
        <p>ระบบจะดำเนินการบันทึกรายการข้อมูล</p>
        <p>ยืนยันการบันทึก?</p>
      </div>
      <div class="modal-footer">
        <button id="savbtnYes" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
        <button type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> -->
<script>
/* Radio Event Script Setting */
<?php
if($process_action!='View') {
?>

/* Set Auto Checked Radio rd_pers_id */
  <?php
    if($rd_pers_id == 1) {
  ?>
    setTimeout(function(){$("input:radio[name='rd_pers_id']:eq(0)").click();},300);
  <?php
    }else if($rd_pers_id == 2) {
  ?>
    setTimeout(function(){$("input:radio[name='rd_pers_id']:eq(1)").click();},300);
  <?php
  }
  ?>
/* End Set Auto Checked Radio rd_pers_id */

/* Set Auto Checked Radio rd_pers_id */
  <?php
    if($rd_req_pers_id == 1) {
  ?>
    setTimeout(function(){$("input:radio[name='rd_req_pers_id']:eq(0)").click();},300);
  <?php
    }else if($rd_req_pers_id == 2) {
  ?>
    setTimeout(function(){$("input:radio[name='rd_req_pers_id']:eq(1)").click();},300);
  <?php
  }
  ?>
/* Set End Auto Checked Radio rd_req_pers_id */

<?php
}
?>
/* End Radio Event Script Setting */
</script>

