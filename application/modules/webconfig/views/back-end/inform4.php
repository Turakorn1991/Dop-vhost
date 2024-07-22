<?php 
	if ($process_action == "Edit") { $process_action = "Edited/".$event_id;}
	if ($process_action == "Add") { $process_action = "Added"; }
	echo form_open_multipart("webconfig/infrm4/".$process_action,array('id'=>'form1', 'class'=>'form-horizontal')); 
?>
<div class="form-group">
	<label for="" class="col-sm-2 control-label font16">ชื่อกิจกรรม* : </label>
	<div class="col-sm-5">
		<input type="text" class="form-control" name="event_name" value="<?=@$event_name?>">
	</div>
</div>
<div class="form-group">
	<label for="" class="col-sm-2 control-label font16">รายละเอียดกิจกรรม : </label>
	<div class="col-sm-10">
		<textarea name="event_detail"><?=@$event_detail?></textarea>
	</div>
</div>
<div class="form-group">
	<label for="" class="col-sm-2 control-label font16">วันที่จัดกิจกรรม* : </label>
	<div class="col-sm-3">
		<input type="text" name="event_date_start" value="<?=@formatDateUniNoM($event_date_start)?>" class="form-control datepicker" placeholder="DD/MM/YYYY">
	</div>
</div>
<div class="form-group">
	<label for="" class="col-sm-2 control-label font16">ถึงวันที่* : </label>
	<div class="col-sm-3">
		<input type="text" name="event_date_end" value="<?=@formatDateUniNoM($event_date_end)?>" class="form-control datepicker" placeholder="DD/MM/YYYY">
	</div>
</div>
<div class="form-group">
	<label for="" class="col-sm-2 control-label font16">เวลา : </label>
	<div class="col-sm-3">
		<input type="text" name="event_time" class="form-control" value="<?=@$event_time?>">
	</div>
</div>
<div class="form-group">
	<label for="event_post" class="col-sm-2 control-label font16">ผู้ประกาศ : </label>
	<div class="col-sm-3">
		<input type="text" name="event_post" class="form-control" value="<?=@$event_post?>">
	</div>
</div>
<div class="form-group">
	<label for="" class="col-sm-2 control-label font16">เอกสารแนบ : </label>
	<div class="col-sm-3">
		<input type="file" name="event_files[]" multiple>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<?php 
			$arr = unserialize($event_files);
			if(COUNT($arr) > 0) { 
		?>	
		<ul class="font18">
		<?php foreach ($arr AS $k=>$v) { ?>
			<li><a href="<?=site_url('assets/modules/webconfig/uploads/'.$v['file'])?>"><?=$v['name']?></a> <a href="<?=site_url('webconfig/delete_file_event/'.$k."-".$this->uri->segment(4))?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล?')">ลบ</a></li>
		<?php } ?>
		</ul>
		<?php } ?>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button class="btn btn-success">บันทึกข้อมูล</button>
	</div>
</div>
<input type="text" value="submit" name="bt_submit" hidden="hidden">
<?php echo form_close(); ?>