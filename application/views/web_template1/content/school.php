
<div class="container">
	<!--<ul class="nav nav-pills">
		
		<li role="presentation" class="font20"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
		<li role="presentation" class="disabled font20"><a href="#"><i class="glyphicon glyphicon-th-list"></i> โรงเรียนผู้สูงอายุ</a></li>
		
	</ul>-->
	<div class="text-center" style="background-image: url('<?=site_url('assets/images/header_school.jpg')?>'); background-size: cover; background-position:center; height: 250px; padding-top: 80px;">
		<p style="color:#FFF; font-size: 48px; font-weight: 600;">โรงเรียนผู้สูงอายุ</p>
	</div>
	<hr>
	<div id="map" style="width: 100%; height: 450px;"></div>
	<!--<nav aria-label="Page navigation">
		<?php //echo $this->pagination->create_links(); ?>
	</nav>-->
	<form class="form-inline">
		<select class="form-control font18 pull-right page">
			<?php for($i=0; $i<=$page; $i++) { ?>
			<option value="<?=$i?>" <?php if(($this->uri->segment(3)/15) == $i){ echo "selected";}?>>หน้าที่ <?=$i+1?></option>
			<?php } ?>
		</select>
		<br>
		<br>
	</form>
	<div class="clearfix"></div>
	<div class="row">
		<?php foreach ($school AS $v) { ?>
		<div class="col-sm-6 col-md-4">
			<div class="thumbnail" style="height: 385px;  overflow-y: hidden">
				<?php if ($v['schl_photo_file'] != "") { ?>
				<img src="<?=site_url('assets/modules/school/images/'.$v['schl_photo_file'])?>" alt="<?=$v['schl_name']?>" width="100%">
				<?php } else { ?>
				<img src="<?=site_url('assets/images/default_image.png')?>" alt="<?=$v['schl_name']?>" width="100%">
				<?php } ?>
				<div class="caption">
					<a href="#" style="color: #000; text-decoration: none;" data-id="<?=$v['schl_id']?>" data-toggle="modal" data-target="#school">
						<h3><?=$v['schl_name']?></h3>
						<p class="font18">
							<?=$v['addr_home_no']?>
						</p>
					</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<form class="form-inline">
		<select class="form-control font18 pull-right page">
			<?php for($i=0; $i<=$page; $i++) { ?>
			<option value="<?=$i?>" <?php if(($this->uri->segment(3)/15) == $i){ echo "selected";}?>>หน้าที่ <?=$i+1?></option>
			<?php } ?>
		</select>
		<br>
		<br>
	</form>
	<div class="clearfix"></div>
</div>