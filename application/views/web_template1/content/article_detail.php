<div class="container">
	<div class="text-center" style="background-image: url('<?=site_url('assets/images/header_article.jpg')?>'); background-size: cover; background-position:center; height: 250px; padding-top: 80px;">
		<p style="color:#FFF; font-size: 48px; font-weight: 600;">บทความ</p>
	</div>
	<hr>
	<div class="detail">
		<?php if ($article['att_tmb_file'] != "") { ?>
		<div class="col-lg-2 font20 text-right">
			
		</div>
		<div class="col-lg-5 font20">
			
			<img src="<?=site_url('assets/modules/prepare/images/'.$article['att_tmb_file'])?>" width="100%">
		</div>
		<div class="clearfix"></div>
		<?php } ?>
		<div class="col-lg-2 font20 text-right">
			<b>ชื่อบทความ :</b>
		</div>
		<div class="col-lg-10 font20">
			<?=$article['dkm_title']?>
		</div>
		<div class="clearfix"></div>
		<div class="col-lg-2 font20 text-right">
			<b>บทความ : </b>
		</div>
		<div class="col-lg-10 font20">
			<?=$article['dkm_describe']?>
		</div>
		<div class="clearfix"></div>
		<?php if (COUNT($file)>0) { ?>
		<div class="col-lg-2 font20 text-right">
			<b>เอกสารแนบ : </b>
		</div>
		<div class="col-lg-10 font20">
			<ul style="padding-left: 12px; list-style-type: decimal;">
				<?php foreach ($file AS $v) { ?>
				<li><a href="<?=site_url('assets/modules/prepare/uploads/'.$v['dkm_file'])?>" target="_blank"><?=$v['dkm_file_label']?></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="clearfix"></div>
		<?php } ?>
		<div class="col-lg-2 font20 text-right">
			<b>ผู้เผยแพร่ : </b>
		</div>
		<div class="col-lg-10 font20">
			<?=$article['dkm_provider']?>
		</div>
		<div class="clearfix"></div>
		<div class="col-lg-2 font20 text-right">
			<b>ผู้เข้าชม : </b>
		</div>
		<div class="col-lg-10 font20">
			<?=$article['stat_views']?>
		</div>
		<div class="clearfix"></div>
	</div>
</div>