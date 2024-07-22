<link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script>var frmKey = false;</script>

<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" /> -->

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#DltModel">Open Modal</button> -->

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

   <div class="row" style="margin: 5px;">

   	   <div class="col-sm-3 text-left hidden-xs text-muted">
   	   		<!-- <h3><?php echo $title;?></h3> -->
   	   </div>

	   <div class="col-xs-12 col-sm-9 text-right">
      <?php
        $tmp = $this->admin_model->chkOnce_usrmPermiss(20,$user_id); //Check User Permission
        if(isset($tmp['perm_can_edit'])) {
          if($tmp['perm_can_edit']=='Yes') {
      ?>
            <a onclick="if(frmKey){$('#bcAddModel').modal('show'); return false;}" href="<?php echo site_url('difficult/sufferer_preform1');?>" title="<?php echo $tmp['app_name'];?>" class="btn btn-default">
                <span class="glyphicon glyphicon-plus"></span>
            </a>       

      			<?php
      			if($process_action=='Edit' || $process_action=="View") {
      			?>

            <?php if($process_action!='Edit'){?>
      		   <a title="แก้ไข<?php echo $tmp['app_name'];?>" href="<?php echo site_url('difficult/sufferer_preform1/Edit/'.$diff_info['diff_id']);?>" class="btn btn-default">
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

echo form_open_multipart('difficult/sufferer_preform1/'.$process_action.$diff_id,array('id'=>'form1'));
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
	                    <label for="example-text-input" class="col-2 col-form-label">วันที่แจ้งเรื่อง</label>

						<div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
						    <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text" name="diff_info[date_of_req]" />
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
                      <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว <font color=red>*</font> <!-- <i title="ชื่อตัว" class="fa fa-pencil-square text-success" aria-hidden="true"></i>--><input title="ชื่อตัว" checked type='checkbox' name='req_firstname'></label> 
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

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
	                    <div class="col-10">
							<input title="เบอร์โทรศัพท์ (มือถือ)" name="diff_info[elder_tel_no]" class="form-control" type="text" value="<?php echo $diff_info['elder_tel_no'];?>" />	
	                	</div>
                	</div>

                </div>

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

<script>

$(document).ready(function(){

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
/* Set End Auto Checked Radio rd_pers_id */    

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
});
/* End Radio Event Script Setting */


/* View Setting */
<?php
if($process_action=='View') {
?>
  setTimeout(function(){
    $("input,select,textarea").css('border','0');
    $("input,select,textarea").css('border-bottom','1px #333 dotted');
    $("input,select,textarea,radio").attr('readonly',true);
  },300);

<?php
}
?>
/* View Setting*/


/* Modal Script Setting */
$('#savbtnYes').click(function() {$("input[name='bt_submit']").click();});

$('#calbtnYes').click(function() {
    window.location.replace('<?php echo site_url('difficult/assist_list');?>');
});
$('#bcAddYes').click(function(){
    window.location.replace('<?php echo site_url('difficult/sufferer_preform1');?>');
});

$('#dltbtnYes').click(function() {
    window.location.replace('<?php echo site_url('difficult/sufferer_preform1');?>'+'/Delete/'+$('#dltModel').data('id'));
});

$("button.inputBT").click(function(){
	return false;
});

var opn = function(node) {
    var id = $(node).data('id');
    $('#dltModel').data('id', id).modal('show');
}

$( "#form1" ).keyup(function() {
  frmKey = true;
});

/* End Modal Script Setting */

</script>

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> -->



