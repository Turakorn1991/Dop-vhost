<div class="row">
  <div class="col-xs-12 col-sm-8">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
          <li role="presentation" class="<?php echo (uri_seg(2) == 'jobs_list' ? 'active' : '') ?>" style="max-width: 100% !important;"><a href="<?php echo site_url('jobs/jobs_list') ?>" >(1) ตำแหน่งงานว่าง</a></li>
          <li role="presentation" class="<?php echo (uri_seg(2) == 'registered_list' ? 'active' : '') ?>" style="max-width: 100% !important;"><a href="<?php echo site_url('jobs/registered_list') ?>" >(2) ผู้สูงอายุที่ลงทะเบียนหางาน</a></li>
          <li role="presentation" class="<?php echo (uri_seg(2) == 'survey_list' ? 'active' : '') ?>" style="max-width: 100% !important;"><a href="<?php echo site_url('jobs/survey_list') ?>" >(3) แบบสำรวจการจ้างงานผู้สูงอายุ</a></li>
      </ul>
    </div>
  </div>
  <div class="col-xs-12 col-sm-4">
  	<div id="menu_topright" style="float: right;"></div>
  </div>
</div>