<style>
.title-header-secondary{
  padding: 10px 10px 0;
  border-bottom: 1px solid #e7eaec;
}

.title-header-secondary-text{
  color: #000;
  font-size: 16px;
}

.tabs-container-header{
  padding: 10px 10px 0px;
}

.ibox-content{
  border-top: none;
  padding-top: 0;
}

.tabs-container-border{
  border: 1px solid #e7eaec;
  border-top: none;
}

.panel-heading{
  margin: 0 10px;
}

.form-horizontal .control-label{
  text-align: left;
}

.tab-panel-heading{
  color: #333;
  background-color: #f5f5f5;
  border-color: #ddd;
  margin-bottom: 15px;
  padding: 10px 15px;
  border-top-left-radius: 3px;
  border-top-right-radius: 3px;
}
</style>

<div class="row title-header-secondary white-bg" >
  <div class="col-xs-12">
    <p class="title-header-secondary-text">
      แบบขึ้นทะเบียน
    </p>  
  </div>
</div>

<?php 
if(uri_seg(3) == 'create'){
  $info_url = site_url('volunteer/info/create');
  $elderly_care_url = 'javascript:void(0);';
  $care_progress_url = 'javascript:void(0);';
}else{
  $info_url = site_url('volunteer/info/edit/'.uri_seg(4));
  $elderly_care_url = site_url('volunteer/elderly_care/edit/'.uri_seg(4));
  $care_progress_url = site_url('volunteer/care_progress/edit/'.uri_seg(4));
}

?>

<div class="row">
  <div class="col-xs-12">
    <div class="tabs-container white-bg tabs-container-header">
      <ul class="nav nav-tabs">
          <li role="presentation" class="<?php echo (uri_seg(2) == 'info' ? 'active' : '') ?>" style="max-width: 100% !important;"><a href="<?php echo $info_url ?>" >(1) ข้อมูลอาสาสมัคร</a></li>
          <li role="presentation" class="<?php echo (uri_seg(2) == 'elderly_care' ? 'active' : '') ?>" style="max-width: 100% !important;"><a href="<?php echo $elderly_care_url; ?>" >(2) ข้อมูลผู้สูงอายุ</a></li>
          <li role="presentation" class="<?php echo (uri_seg(2) == 'care_progress' ? 'active' : '') ?>" style="max-width: 100% !important;"><a href="<?php echo $care_progress_url ?>" >(3) ผลการดำเนินงาน</a></li>
      </ul>
    </div>
  </div>
</div>