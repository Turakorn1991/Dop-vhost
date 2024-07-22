<?php 
if ($process_action == "Edit") { $process_action = "Edited/".$news_id;}
if ($process_action == "Add") { $process_action = "Added"; }
echo form_open_multipart("webconfig/infrm1/".$process_action,array('id'=>'form1', 'class'=>'form-horizontal')); 
?>
	<div class="form-group">
		<label for="news_images" class="control-label font18 col-sm-2">รูปภาพหน้าปก *: </label>
		<div class="col-sm-5">
		
			<?php if ($news_image_title == "") { ?>
			<input type="file" name="news_images" id="news_images">
			<?php } else { ?>
			<img src="<?php echo site_url('assets/modules/webconfig/images/'.$news_image_title)?>" width="150px;">
			<a href="<?=site_url('webconfig/deleteNewsImage/'.$this->uri->segment(4))?>" id="delImageTitle" type="button" class="btn btn-sm btn-danger" style="position: relative; top: 38px;" onclick="return confirm('ยืนยันการลบข้อมูล ?')">ลบ</a>
			<?php } ?>
		</div>
		
	</div>
	<div class="form-group">
		<label for="news_name" class="control-label font18 col-sm-2">ชื่อข่าวประสัมพันธ์ *: </label>
		<div class="col-sm-4">
			<input type="text" name="news_name" class="form-control" id="news_name" value="<?php echo @$news_name; ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="news_detail" class="control-label font18 col-sm-2">รายละเอียดข่าว *: </label>
		<div class="col-sm-10">
			<textarea name="news_detail" id="news_detail"  class="form-control" required><?php echo @$news_detail; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="files" class="control-label font18 col-sm-2">เอกสารแนบ : </label>
		<div class="col-sm-10">
			<input type="file" name="files[]" id="files" multiple>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<?php
			
			if($news_document!="") {
				$files = unserialize($news_document);
			?>
			<ul>
			<?php foreach ($files AS $k=>$v) { ?>
				<li class="font16"><a href="<?=site_url('assets/modules/webconfig/uploads/'.$v['file'])?>"><?=$v['name']?></a> <a href="<?=site_url('webconfig/delete_news_document/'.$k.'-'.$this->uri->segment(4))?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบข้อมูล ?')">ลบ</a></li>
			<?php } ?>
			</ul>
			<?php } ?>
		</div>
	</div>
	<div class="form-group">
		<label for="NameNews" class="control-label font18 col-sm-2">คลังรูปภาพ : </label>
			<!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addImages"><i class="glyphicon glyphicon-picture"></i> เพิ่มรูปภาพ</button>-->
		<div class="col-sm-10">
			<input type="file" name="images[]" id="gallery-photo-add" multiple>
			<br>
			<div class="gallery">
				<?php 
				if (@$news_images) {
					$i=0;
				foreach ($news_images AS $v) { ?>
					<img src="<?php echo site_url("assets/modules/webconfig/images/".$v['file'])?>" id="imageOld-<?php echo $i;?>" data-href="<?php echo site_url("webconfig/delete_image/".$news_id."/".$i); ?>" class="show-image" style="height: 100px; margin-right: 3px;">
				<?php $i++;}} ?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="news_announcer" class="control-label font18 col-sm-2">ผู้ประกาศข่าว *: </label>
		<div class="col-sm-4">
			<input type="text" name="news_announcer" class="form-control" id="news_announcer" value="<?php echo @$news_announcer; ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="news_post" class="control-label font18 col-sm-2">วันที่โพส *: </label>
		<div class="col-sm-4">
			<input type="text" name="news_post" class="form-control datepicker" id="news_post" value="<?php echo @formatDateUniNoM($news_post); ?>" placeholder="DD/MM/YYYY" required>
		</div>
	</div>
	<?php if ($this->uri->segment(3) == "Edit") { ?>
	<div class="form-group">
		<label for="news_view" class="control-label font18 col-sm-2">จำนวนผู้เข้าชม : </label>
		<div class="col-sm-2">
			<input type="text" readonly class="form-control " id="news_view" value="<?php echo @$news_view; ?>">
		</div>
	</div>
	<?php } ?>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> บันทึก</button>
			<button type="reset" class="btn btn-primary btn-md"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิก</button>
		</div>
	</div>
	<input type="text" value="submit" name="bt_submit" hidden="hidden">
<?php echo form_close(); ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">คลังรูปภาพ</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<img id="image-preview" src="" width="100%">
		</div>
      </div>
      <div class="modal-footer">
        <a href="" id="deleteImage" class="btn btn-danger">ลบรูปภาพ</a>
      </div>
    </div>
  </div>
</div>