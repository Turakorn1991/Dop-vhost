
<div class="container">	
	<div class="text-center" style="background-image: url('<?=site_url('assets/images/header_news.jpg')?>'); background-size: cover; background-position:center; height: 250px; padding-top: 80px;">
		<p style="color:#FFF; font-size: 48px; font-weight: 600;">ข่าวประชาสัมพันธ์</p>
	</div>
	<!--<ul class="nav nav-pills">
		<li role="presentation" class="font20"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
		<li role="presentation" class="disabled font20"><a href="<?php echo site_url('main/all_news');?>"><i class="glyphicon glyphicon-th-list"></i> ข่างประชาสัมพันธ์</a></li>
	</ul>-->
	<hr>
	<?php $i=1; foreach ($news AS $v) { mb_internal_encoding("UTF-8"); ?>
	<div class="col-md-4">
		<div class="thumbnail">
			<img src="<?php echo base_url("assets/modules/webconfig/images/".$v['news_image_title']);?>" width="100%" alt="...">
			<div class="caption">
				<h4 class="font18 title-news"><i class="glyphicon glyphicon-pushpin"></i> <?php echo formatDateThai($v['insert_datetime']); ?> <span class="pull-right"><i class="fa fa-users"></i> <?=$v['news_view']?></span></h4>
				<a href="<?php echo base_url("main/news/".$v['news_id']); ?>" class="font22 fontbold font-href"><?php echo mb_substr($v['news_name'], 0, 65); ?>...</a>
			</div>
		</div>
	</div>
	<?php if ($i%3==0) {?>
	<div class="clearfix"></div>
	<?php } ?>
	
	<?php $i++;} ?>
</div>