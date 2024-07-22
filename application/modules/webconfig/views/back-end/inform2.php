<?php 
if ($process_action == "Edit") { $process_action = "Edited/".$about_id;}
if ($process_action == "Add") { $process_action = "Added"; }
echo form_open_multipart("webconfig/infrm2/".$process_action,array('id'=>'form1', 'class'=>'form-horizontal')); 
?>
	<div class="form-group">
		<label for="news_images" class="control-label col-sm-2 font18">ชื่อเกี่ยวกับเรา *: </label>
		<div class="col-sm-4">
			<input type="text" name="about_title" class="form-control" id="about_title" value="<?php echo @$about_title; ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="about_detail" class="control-label col-sm-2 font18">รายละเอียดเกี่ยวกับเรา *: </label>
		<div class="col-sm-10">
			<textarea name="about_detail" id="about_detail" rows="10"  class="form-control"><?php echo @$about_detail; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> บันทึก</button>
			<button type="reset" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิก</button>
		</div>
	</div>
	<input type="text" value="submit" name="bt_submit" hidden="hidden">
<?php echo form_close(); ?>