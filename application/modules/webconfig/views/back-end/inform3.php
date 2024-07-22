<div id="tmp_menu" hidden='hidden'>
<a onclick="return opnBck()" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('webconfig/webconfig_detail');?>">
	<i class="fa fa-caret-left" aria-hidden="true"></i> 
</a>
</div>
<script>
setTimeout(function(){
$("#menu_topright").html($("#tmp_menu").html());
},300);
</script>

<div class="row">
	<div class="col-lg-12">
		<div class="panel-group">
			<?php 
			if ($process_action == "Edit") { $process_action = "Edited/".$slide_id;}
			if ($process_action == "Add") { $process_action = "Added"; }
			echo form_open_multipart("webconfig/infrm3/".$process_action,array('id'=>'form1', 'class'=>'form-horizontal')); 
			?>
				<input type="hidden" name="bt_submit" value="submit">
				<div class="form-group">
					<label for="slide_name" class="col-sm-2 control-label">ชื่อสไลด์ : </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="slide_name" name="slide_name" required value="<?php echo @$slide_name; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="slide_image" class="col-sm-2 control-label">ภาพสไลด์ : <span class="text-danger">1240x610 px</span> </label>
					<div class="col-sm-5">
					<?php if (@$slide_image!=NULL) { ?>
						<img src="<?php echo site_url("assets/modules/webconfig/images/".$slide_image); ?>" style="width: 250px;">
						<a href="<?php echo site_url("webconfig/delete_image_slide/".$slide_id); ?>" class="btn btn-danger btn-sm" onClick="return confirm('ยืนยันการลบรูปภาพ?')" >ลบ</a>
					<?php } else { ?>
						<input type="file" id="slide_image" name="slide_image" required>
					<?php } ?>
					</div>
				</div>
				<div class="form-group">
					<label for="slide_link" class="col-sm-2 control-label">ลิ้งค์ : </label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="slide_link" name="slide_link" value="<?php echo @$slide_link; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="slide_status" class="col-sm-2 control-label">สถานะ : </label>
					<div class="col-sm-5" style="padding-top: 8px;">
						<label>
							<input type="radio" name="slide_status" id="slide_status" value="0" <?php if (@$slide_status == 0) { echo "checked"; }?>>
							ไม่แสดง
						</label>
						&nbsp;&nbsp;&nbsp;
						<label>
							<input type="radio" name="slide_status" id="slide_status" value="1" <?php if (@$slide_status == 1) { echo "checked"; }?>>
							แสดง
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-5">
						<button class="btn btn-primary btn-md">
							บันทึกข้อมูล
						</button>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

