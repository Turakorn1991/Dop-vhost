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
        $tmp = $this->admin_model->chkOnce_usrmPermiss(22,$user_id); //Check User Permission
        if(isset($tmp['perm_can_edit'])) {
          if($tmp['perm_can_edit']=='Yes') {
      ?>
      		<!--
            <a onclick="if(frmKey){$('#bcAddModel').modal('show'); return false;}" href="<?php echo site_url('difficult/sufferer_form2');?>" title="<?php echo $tmp['app_name'];?>" class="btn btn-default">
                <span class="glyphicon glyphicon-plus"></span>
            </a>       
            -->

      			<?php
      			if($process_action=='Edit' || $process_action=="View") {
      			?>

            <?php if($process_action!='Edit'){?>
      		   <a title="แก้ไข<?php echo $tmp['app_name'];?>" href="<?php echo site_url('difficult/sufferer_form2/Edit/'.$diff_info['diff_id']);?>" class="btn btn-default">
              <span class="fa fa-pencil-square-o"></span>
      		   </a>
             <?php }?>
      		   
      		<?php if($process_action!='View'){?>   
      		   <a onclick="$('button[name=bt_submit_print]').click(); return false;" title="ปริ้นท์<?php echo $tmp['app_name'];?>" href="<?php echo site_url('difficult/sufferer_form2/print');?>" class="btn btn-default">
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

echo form_open_multipart('difficult/sufferer_form2/'.$process_action.$diff_id,array('id'=>'form1'));
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

            <div class="panel-heading"><h4><img src="<?php echo path('logo1B&W.png','webconfig');?>" title="logo" width="32" height="32">&nbsp;แบบใบสำคัญรับเงินตามประกาศตามกระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ มาตรา 11 (8) (9) (10)</h4></div>
            <div class="panel-body" style="padding: 20px;">
                <div class="form-group row">
                	<div class="col-xs-12 col-sm-6">

	                    <label for="example-text-input" class="col-2 col-form-label">วันที่ออกใบฯ <font color='red'>*</font></label>
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
	                    <label for="example-text-input" class="col-2 col-form-label">ชื่อหน่วยงาน</label>
	                    <div class="col-10" style="border-bottom: 1px #333 dotted">
							&nbsp;
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

                  <div class="col-xs-12 hidden-xs col-sm-offset-3">
                  &nbsp;
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
                    <label for="example-text-input" class="col-2 col-form-label">จำนวนเงิน (บาท) <font color='red'>*</font></label>
                    <div class="col-10">
                    <input title="จำนวนเงิน (บาท)" name="diff_info[pay_amount]" class="form-control" type="number" min=0 value="<?php echo $diff_info['pay_amount'];?>" required autofocus />
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">ผู้รับเงิน</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
						&nbsp;
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">ผู้จ่ายเงิน</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
						&nbsp;
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">พยาน</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
						&nbsp;
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-3" style="margin-top: 8px;">
                    <label for="example-text-input" class="col-2 col-form-label">พยาน</label>
                    <div class="col-10" style="border-bottom: 1px #333 dotted">
						&nbsp;
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
//if($process_action!='View') {
?>

/* Set Auto Checked Radio rd_pers_id */
  <?php
//    if($rd_pers_id == 1) {
  ?>
//    setTimeout(function(){$("input:radio[name='rd_pers_id']:eq(0)").click();},300);
  <?php
//    }else if($rd_pers_id == 2) {
  ?>
//    setTimeout(function(){$("input:radio[name='rd_pers_id']:eq(1)").click();},300);
  <?php
//  }
  ?>
/* End Set Auto Checked Radio rd_pers_id */  

/* Set Auto Checked Radio rd_pers_id */
  <?php
//   if($rd_req_pers_id == 1) {
  ?>
//    setTimeout(function(){$("input:radio[name='rd_req_pers_id']:eq(0)").click();},300);
  <?php
//    }else if($rd_req_pers_id == 2) {
  ?>
//    setTimeout(function(){$("input:radio[name='rd_req_pers_id']:eq(1)").click();},300);
  <?php
//  }
/* Set End Auto Checked Radio rd_req_pers_id */
  
  ?>
<?php
//}
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
    window.location.replace('<?php echo site_url('difficult/sufferer_form2');?>');
});

$('#dltbtnYes').click(function() {
    window.location.replace('<?php echo site_url('difficult/sufferer_form2');?>'+'/Delete/'+$('#dltModel').data('id'));
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



