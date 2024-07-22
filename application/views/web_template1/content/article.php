<div class="container">
	<div class="text-center" style="background-image: url('<?=site_url('assets/images/header_article.jpg')?>'); background-size: cover; background-position:center; height: 250px; padding-top: 80px;">
		<p style="color:#FFF; font-size: 48px; font-weight: 600;">บทความ</p>
	</div>
	<!--<ul class="nav nav-pills">
		<li role="presentation" class="font20"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
		<li role="presentation" class="disabled font20"><a href="#"><i class="glyphicon glyphicon-th-list"></i> บทความ</a></li>
	</ul>-->
	<hr>
	<?php foreach ($article AS $v) { ?>
	<div class="media">
		<div class="media-left">
			<a href="<?=site_url('main/article_detail/'.$v['dkm_id'])?>" target="_blank">
				<?php if ($v['att_tmb_file'] != "") { ?>
				<img class="media-object" src="<?=site_url('assets/modules/prepare/images/'.$v['att_tmb_file'])?>" alt="..." width="120px;">
				<?php } else { ?>
				<img class="media-object" src="<?=site_url('assets/images/default_image.png')?>" alt="..." width="120px;" style="border: 1px #DDD solid;">
				<?php } ?>
			</a>
		</div>
		<div class="media-body" >
			<a href="<?=site_url('main/article_detail/'.$v['dkm_id'])?>" target="_blank" style="color: #000; text-decoration: none;">
			<h4 class="media-heading fontbold font20"><i class="glyphicon glyphicon-book" style="font-size: 16px"></i> <?=$v['dkm_title']?></h4>
			<span class="font20"><?=$v['dkm_describe']?></span>
			<p class="font20"><i class="glyphicon glyphicon-eye-open" style="font-size: 16px"></i> <?=$v['stat_views']?></p>
			</a>
		</div>
	</div>
	<hr>
	<?php } ?>
</div>