<div class="panel panel-default">
	<div class="panel-heading font18">ข้อมูลบทความ</div>
	<div class="panel-body">
		<?php 
			if ($process_action == "Edit") { $process_action = "Edited/".$article_id;}
			if ($process_action == "Add") { $process_action = "Added"; }
			echo form_open_multipart("webconfig/infrm5/".$process_action,array('id'=>'form1', 'class'=>'form-horizontal')); 
		?>
		<div class="form-group">
			<label for="" class="col-sm-2 control-label font16">ชื่อบทความ* : </label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="article_name" value="<?=@$article_name?>">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="col-sm-2 control-label font16">รายละเอียดบทความ* : </label>
			<div class="col-sm-10">
				<textarea name="article_detail"><?=@$article_detail?></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button class="btn btn-success">บันทึกข้อมูล</button>
			</div>
		</div>
		<input type="text" value="submit" name="bt_submit" hidden="hidden">
		<?php echo form_close(); ?>
	</div>
</div>