
<section id="content-about" class="services bg-container">
	<div class="container">
	<div class="text-center" style="background-image: url('<?=site_url('assets/images/header_about.jpg')?>'); background-size: cover; background-position:center; height: 250px; padding-top: 80px;">
		<p style="color:#FFF; font-size: 48px; font-weight: 600;">เกี่ยวกับเรา</p>
	</div>
		<!--<ul class="nav nav-pills">
			
			<li role="presentation" class="font20"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
			<li role="presentation" class="disabled font20"><a href="<?php echo site_url('main/all_news');?>"><i class="glyphicon glyphicon-th-list"></i> เกี่ยวกับกรมกิจการผู้สูงอายุ</a></li>
			
		</ul>-->
		<hr>
		<?php echo htmlspecialchars_decode($about['about_detail']); ?>
	</div>
</section>