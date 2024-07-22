
<div class="container">	
	<div class="text-center" style="background-image: url('<?=site_url('assets/images/header_news.jpg')?>'); background-size: cover; background-position:center; height: 250px;  padding-top: 80px;">
		<p style="color:#FFF; font-size: 48px; font-weight: 600;">ข่าวประชาสัมพันธ์</p>
	</div>
	<!--<ul class="nav nav-pills">
		
		<li role="presentation" class="font20"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
		<li role="presentation" class="font20"><a href="<?php echo site_url('main/all_news');?>"><i class="glyphicon glyphicon-th-list"></i> ข่างประชาสัมพันธ์</a></li>
		<li role="presentation" class="disabled font20"><a href="#"><i class="glyphicon glyphicon-file"></i> <?php echo $news['news_name']; ?></a></li>
	</ul>-->
	<hr>
	<div class="news-content">
		<p class="font20 fontbold text-center"><?php echo $news['news_name']; ?></p>
		<div class="font20">
		<?php echo $news['news_detail']; ?>
		</div>
	</div>
	
	<div class="document font20">
		<?php if (!empty($news['news_document'])) { ?>
		เอกสารแนบ
		<ul>
			<?php
				$arr = unserialize($news['news_document']);
				foreach ($arr AS $k=>$v) {
			?>
			<li class="font16"><a href="<?=site_url('assets/modules/webconfig/uploads/'.$v['file'])?>" style="color: #000;"><?=$v['name']?></a></li>
			<?php } ?>
		</ul>
		<?php } ?>
	</div>
	
	<div class="gallery font20 fontbold">
	<?php $images = unserialize($news['news_images']); if (COUNT($images)>1) { echo "คลังรูปภาพ"; } ?>
	<div class="row">
		<?php foreach ($images AS $v) { ?>
		<div class="col-md-3">
			<div style="height: 180px; background-image: url('<?php echo base_url('assets/modules/webconfig/images/'.$v['file']); ?>'); background-size: cover; cursor:pointer;" data-image="<?php echo base_url('assets/modules/webconfig/images/'.$v['file']); ?>" data-toggle="modal" data-target="#viewImage"></div>
		</div>
		<?php } ?>
	</div>
	</div>
	<div class="">
		<p class="font20 fontbold text-right">ผู้ประกาศข่าว <?php echo $news['news_announcer'];?> วันที่ประกาศ <?php echo formatDateThai($news['news_post']); ?> ผู้ชม <?php echo ($news['news_view']=="")?0:$news['news_view']; ?> ครั้ง</p>
	</div>
	<?php $this->common_model->update("web_news",array("news_view"=>$news['news_view'] + 1),"news_id = '".$news['news_id']."'"); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="viewImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title font20 fontbold" id="myModalLabel">คลังรูปภาพ</h4>
      </div>
      <div class="modal-body">
			<img src="" width="100%">
      </div>
    </div>
  </div>
</div>