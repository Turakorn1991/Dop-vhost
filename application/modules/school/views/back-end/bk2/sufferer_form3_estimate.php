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
        $tmp = $this->admin_model->chkOnce_usrmPermiss(24,$user_id); //Check User Permission
        if(isset($tmp['perm_can_edit'])) {
          if($tmp['perm_can_edit']=='Yes') {
      ?>
      		<!--
            <a onclick="if(frmKey){$('#bcAddModel').modal('show'); return false;}" href="<?php echo site_url('difficult/sufferer_form3');?>" title="<?php echo $tmp['app_name'];?>" class="btn btn-default">
                <span class="glyphicon glyphicon-plus"></span>
            </a>       
            -->

      			<?php
      			if($process_action=='Edit' || $process_action=="View") {
      			?>

            <?php if($process_action!='Edit'){?>
      		   <a title="แก้ไข<?php echo $tmp['app_name'];?>" href="<?php echo site_url('difficult/sufferer_form3/Edit/'.$diff_info['diff_id']);?>" class="btn btn-default">
              <span class="fa fa-pencil-square-o"></span>
      		   </a>
             <?php }?>
      		   
      		<?php if($process_action!='View'){?>   
      		   <a onclick="$('button[name=bt_submit_print]').click(); return false;" title="ปริ้นท์<?php echo $tmp['app_name'];?>" href="<?php echo site_url('difficult/sufferer_form3/print');?>" class="btn btn-default">
              <span class="fa fa-print"></span>
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

echo form_open_multipart('difficult/sufferer_form3/'.$process_action.$diff_id,array('id'=>'form1'));
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

            <div class="panel-heading"><h4>แบบประเมินผลการให้บริการตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ (8) (9) (10)</h4></div>
            <div class="panel-body" style="padding: 20px;">
                <div class="form-group row">
                	<div class="col-xs-12 col-sm-6">

	                    <label for="example-text-input" class="col-2 col-form-label">วันที่กรอกแบบสอบถาม <font color='red'>*</font></label>
			            <div id="datetimepicker1" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
			                <input title="เลือกวันที่" placeholder="เลือกวันที่" class="form-control" type="text" name="diff_info[date_of_eva]" />
			                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			            </div>  

			              <script type="text/javascript">
			              <?php
			              if($diff_info['date_of_eva']=='') {
			              ?>
			              $(function () {
			                $("#datetimepicker1").datepicker({ 
			                    autoclose: true, 
			                    todayHighlight: true
			                });
			              });
			              <?php
			          		}else {
			              ?>
			              <?php
			              $tmp = explode('-',$diff_info['date_of_eva']);
			              ?>

			              $(function () {
			                $("#datetimepicker1").datepicker({ 
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
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อหน่วยงาน</label>
	                    <div class="col-10" style="border-bottom: 1px #333 dotted">
							&nbsp;<?php echo $diff_info['eva_org'];?>
	                	</div>
                	</div>
                </div>

               <div class="form-group row">

                	<div class="col-xs-12 col-sm-3">

	                    <label for="example-text-input" class="col-2 col-form-label">คำนำหน้านาม</label>
	                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                        <?php if($diff_info['elder_prename']=='นาย') {?>นาย<?php }?>
                        <?php if($diff_info['elder_prename']=='นาง') {?>นาง<?php }?>
                        <?php if($diff_info['elder_prename']=='นางสาว') {?>นางสาว<?php }?>
	                	</div>
                	</div>
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อตัว</label>
	                    <div class="col-10" style="border-bottom: 1px #333 dotted">
							<?php echo $diff_info['elder_firstname'];?>
	                	</div>
                	</div>  
                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อสกุล</label>
	                    <div class="col-10" style="border-bottom: 1px #333 dotted">
							<?php echo $diff_info['elder_lastname'];?>
	                	</div>
                	</div>  

                	<div class="col-xs-12 col-sm-3">
	                    <label for="example-text-input" class="col-2 col-form-label">อายุ</label>
	                    <div class="col-10" style="border-bottom: 1px #333 dotted">
							&nbsp;<!-- elder_old -->
	                	</div>
                	</div>  


                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">บ้านเลขที่</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_village --> 
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">หมู่ที่</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_villageid --> 
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_lane --> 
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_alley --> 
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_road --> 
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                      <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- req_province -->
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                      <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_amphur -->
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                      <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_tumbon -->
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_postcode -->
                    </div>
                  </div> 

                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<?php echo $diff_info['req_home_tel_no'];?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<?php echo $diff_info['req_tel_no'];?>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (แฟกซ์)</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_fax -->
                    </div>
                  </div>

                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">เบอร์โทรศัพท์ (แฟกซ์)</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
                    	&nbsp;<!-- elder_fax -->
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <h4><b>อาชีพ</b></h4>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <h6><input name="elder_job" value="ค้าขาย" type="radio">&nbsp;&nbsp;ค้าขาย</h6>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <h6><input name="elder_job" value="ค้าขาย" type="radio">&nbsp;&nbsp;รับจ้าง</h6>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <h6><input name="elder_job" value="ค้าขาย" type="radio">&nbsp;&nbsp;แม่บ้าน</h6>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <h6><input name="elder_job" value="เกษตรกรรม" type="radio">&nbsp;&nbsp;เกษตรกรรม</h6>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <h6><input name="elder_job" value="ไม่ได้ทำงาน" type="radio">&nbsp;&nbsp;ไม่ได้ทำงาน</h6>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="elder_job" value="อื่นๆ (ระบุ)" type="radio">&nbsp;&nbsp;อื่นๆ (ระบุ)</h6>
						&nbsp;&nbsp;<input style="margin-top: -15px" title="ระบุ" placeholder="ระบุ" name="elder_job_identify" class="form-control" type="text" readonly />
			            <script>
			                $("input[name='elder_job']").change(function(){
			                  if($(this).val()=='อื่นๆ (ระบุ)'){
			                    $("input[name='elder_job_identify']").attr('readonly',false);
			                    $("input[name='elder_job_identify']").focus();
			                  }else {
			                    $("input[name='elder_job_identify']").attr('readonly',true);
			                  }
			                });
			            </script>  
                  </div>

                  <div class="col-xs-12 hidden-xs col-sm-offset-12">

                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <label for="example-text-input" class="col-2 col-form-label">รายได้ บาท/เดือน</label>
                    <div class="col-10">
                    <input title="จำนวนเงิน (บาท)" name="elder_income" class="form-control" type="number" min=0 />
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <h4><b>ท่านเคยได้รับเงินสงเคราะห์ผู้สูงอายุจากหน่วยงานใดบ้าง (ตอบตามความเป็นจริง)</b></h4>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="diff_info[subv_hist]" value="1" type="radio">&nbsp;&nbsp;เคย (ชื่อหน่วยงาน)</h6>
						&nbsp;&nbsp;<input style="margin-top: -15px" title="ระบุ" placeholder="ระบุ" name="diff_info[subv_hist_org]" class="form-control" type="text" readonly value="<?php echo $diff_info['subv_hist_org'];?>"/>
                  </div>
                 <div class="col-xs-12 hidden-xs col-sm-offset-9">
						&nbsp;
                  </div>

                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="diff_info[subv_hist]" value="0" type="radio">&nbsp;&nbsp;ไม่เคย</h6>
			        <script>
			            $("input[name='diff_info[subv_hist]']").change(function(){
			                if($(this).val()=='1'){
			                   $("input[name='diff_info[subv_hist_org]']").attr('readonly',false);
			                   $("input[name='diff_info[subv_hist_org]']").focus();
			                }else {
			                   $("input[name='diff_info[subv_hist_org]']").attr('readonly',true);
			                 }
			            });
			        </script> 
                  </div>
                  <div class="col-xs-12 hidden-xs col-sm-offset-9">
						&nbsp;
                  </div>              

                  <div class="col-xs-12">
                    <h4><b>หลังเข้ารับบริการเงินสงเคราะห์ผู้สูงอายุ ท่านได้รับความพึงพอใจมากน้อยเพียงใด</b></h4>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="diff_info[satisfaction_status]" value="มาก" type="radio">&nbsp;&nbsp;มาก</h6>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="diff_info[satisfaction_status]" value="ปานกลาง" type="radio">&nbsp;&nbsp;ปานกลาง</h6>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="diff_info[satisfaction_status]" value="น้อย" type="radio">&nbsp;&nbsp;น้อย</h6>
                  </div>
                  <div class="col-xs-12 hidden-xs col-sm-offset-3">
						&nbsp;
                  </div>	

                  <div class="col-xs-12">
                    <h4><b>ท่านมีความไม่พึงพอใจในเรื่องใด</b></h4>
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="elder_job" value="วงเงินให้การช่วยเหลือ" type="radio">&nbsp;&nbsp;วงเงินให้การช่วยเหลือ อย่างไร (โปรดระบุ)</h6>
						&nbsp;&nbsp;<input style="margin-top: -15px" title="โปรดระบุ" placeholder="โปรดระบุ" name="not_satisfied_case1" class="form-control" type="text" readonly />
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="elder_job" value="กระบวนการ/ขั้นตอนการให้บริการ" type="radio">&nbsp;&nbsp;กระบวนการ/ขั้นตอนการให้บริการ อย่างไร (โปรดระบุ)</h6>
						&nbsp;&nbsp;<input style="margin-top: -15px" title="โปรดระบุ" placeholder="โปรดระบุ" name="not_satisfied_case2" class="form-control" type="text" readonly />
			            <!-- Insert Script--> 
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="elder_job" value="เจ้าหน้าที่หรือบุคลากรที่ให้บริการ" type="radio">&nbsp;&nbsp;เจ้าหน้าที่หรือบุคลากรที่ให้บริการ อย่างไร (โปรดระบุ)</h6>
						&nbsp;&nbsp;<input style="margin-top: -15px" title="โปรดระบุ" placeholder="โปรดระบุ" name="not_satisfied_case3" class="form-control" type="text" readonly />
			            <!-- Insert Script--> 
                  </div>
                  <div class="col-xs-12 col-sm-3">
                    <h6><input name="elder_job" value="ด้านคุณภาพการให้บริการ" type="radio">&nbsp;&nbsp;ด้านคุณภาพการให้บริการ อย่างไร (โปรดระบุ)</h6>
						&nbsp;&nbsp;<input style="margin-top: -15px" title="โปรดระบุ" placeholder="โปรดระบุ" name="not_satisfied_case4" class="form-control" type="text" readonly />
			            <!-- Insert Script--> 
                  </div>

				  <script>
					$("input[name='elder_job']").change(function(){
			            if($(this).val()=='วงเงินให้การช่วยเหลือ'){
			               $("input[name='not_satisfied_case1']").attr('readonly',false);
			               $("input[name='not_satisfied_case1']").focus();
			               $("input[name='not_satisfied_case2']").attr('readonly',true);
			               $("input[name='not_satisfied_case3']").attr('readonly',true);
			               $("input[name='not_satisfied_case4']").attr('readonly',true);
			            }else if($(this).val()=='กระบวนการ/ขั้นตอนการให้บริการ') {
			               $("input[name='not_satisfied_case2']").attr('readonly',false);
			               $("input[name='not_satisfied_case2']").focus();
			               $("input[name='not_satisfied_case1']").attr('readonly',true);
			               $("input[name='not_satisfied_case3']").attr('readonly',true);
			               $("input[name='not_satisfied_case4']").attr('readonly',true);
			        	}else if($(this).val()=='เจ้าหน้าที่หรือบุคลากรที่ให้บริการ') {
			               $("input[name='not_satisfied_case3']").attr('readonly',false);
			               $("input[name='not_satisfied_case3']").focus();
			               $("input[name='not_satisfied_case1']").attr('readonly',true);
			               $("input[name='not_satisfied_case2']").attr('readonly',true);
			               $("input[name='not_satisfied_case4']").attr('readonly',true);
			        	}else if($(this).val()=='ด้านคุณภาพการให้บริการ') {
			               $("input[name='not_satisfied_case4']").attr('readonly',false);
			               $("input[name='not_satisfied_case4']").focus();
			               $("input[name='not_satisfied_case1']").attr('readonly',true);
			               $("input[name='not_satisfied_case2']").attr('readonly',true);
			               $("input[name='not_satisfied_case3']").attr('readonly',true);
			        	}
			        });
					</script>

                	<div class="col-xs-12 col-sm-12">
					  <label for="comment">ข้อเสนอแนะ</label>
					  <textarea title="ความคิดเห็นนักสังคมสงเคราะห์" name="diff_info[eva_remark]" class="form-control" rows="5" id="comment"><?php echo $diff_info['eva_remark'];?></textarea>
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

            		  <button name="bt_submit_print" onclick="$('input[name=state]').val(3); $('#savModel').modal('show'); return false;" title="บันทึกข้อมูลและปริ้น" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;บันทึกข้อมูลและปริ้น</button>

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

/* Set Auto Checked Radio subv_hist */
  <?php
    if($diff_info['subv_hist'] == '1') {
  ?>
    setTimeout(function(){$("input:radio[name='diff_info[subv_hist]']:eq(0)").attr("checked",true);$("input[name='diff_info[subv_hist_org]']").attr('readonly',false);},300);
  <?php
    }else if($diff_info['subv_hist'] == '0') {
  ?>
    setTimeout(function(){$("input:radio[name='diff_info[subv_hist]']:eq(1)").click();},300);
  <?php
  }
  ?>
/* Set End Auto Checked Radio subv_hist */  

/* Set Auto Checked Radio satisfaction_status */
  <?php
    if($diff_info['satisfaction_status'] == 'มาก') {
  ?>
    setTimeout(function(){$("input:radio[name='diff_info[satisfaction_status]']:eq(0)").click();},300);
  <?php
    }else if($diff_info['satisfaction_status'] == 'ปานกลาง') {
  ?>
    setTimeout(function(){$("input:radio[name='diff_info[satisfaction_status]']:eq(1)").click();},300);
  <?php
  	}else if($diff_info['satisfaction_status'] == 'น้อย') {
  ?>
  	setTimeout(function(){$("input:radio[name='diff_info[satisfaction_status]']:eq(2)").click();},300);
  <?php
	}
  ?>
/* Set End Auto Checked Radio satisfaction_status */  

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
    window.location.replace('<?php echo site_url('difficult/sufferer_form3');?>');
});

$('#dltbtnYes').click(function() {
    window.location.replace('<?php echo site_url('difficult/sufferer_form3');?>'+'/Delete/'+$('#dltModel').data('id'));
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



