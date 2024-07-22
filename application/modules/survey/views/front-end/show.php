<section id="content-survey" class="services bg-container">
	<div class="container">
		<ul class="nav nav-pills">
			
			<li role="presentation" class="font20"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
			<li role="presentation" class="disabled font20"><a href="javascript:void(0);">แบบสำรวจการจ้างงานผู้สูงอายุ</a> </li>
			
		</ul>
		<hr>
		<?php if(count($survey) != 0 && $survey->job_sur_status == 'Active'){ ?>
			<h1><?php echo $survey->job_sur_title ?></h1>
			<div class="">
			  <iframe id="job_sur_url" style="top: 0; bottom: 0; left: 0; width: 100%; height: 100%; min-height: 1200px; border: 0;" src="<?php echo $survey->job_sur_url ?>" allowfullscreen>กำลังโหลด...</iframe>
			</div>
		<?php }else{ ?>
			<h3>ไม่พบแบบสำรวจการจ้างงานผู้สูงอายุที่ท่านต้องการ</h3>
		<?php } ?>
	</div>
</section>