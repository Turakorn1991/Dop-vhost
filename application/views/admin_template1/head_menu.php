

<?php
	//ระบบฐานข้อมูลการให้บริการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
	if($usrpm['app_parent_id']==1) {
?>
  <a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #ccc;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>

<?php
	}
?>

<?php
  //ระบบฐานข้อมูลผู้สูงอายุที่รับบริการในศูนย์พัฒนาการจัดสวัสดิการสังคม
  if($usrpm['app_parent_id']==11) {
?> 
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #ccc;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<?php
  }
?>

<?php
  //ระบบฐานข้อมูลการสงเคราะห์ในการจัดการศพผู้สูงอายุตามประเพณี
  if($usrpm['app_parent_id']==20) {
?> 
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #ccc;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<?php
  }
?>

<?php
  //ระบบฐานข้อมูลการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกที่เอื้อเฟื้อต่อคนทุกวัย
  if($usrpm['app_parent_id']==28) {
?>
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #333;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<ul class="dropdown-menu head_menu">
      <?php
      $tmp = $this->admin_model->getOnce_Application(29);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(29,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_id']==29) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a href="<?php echo site_url('adaptenvir/adaptenvir_list');?>"><i class="fa fa-table" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
        </a>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(36);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(36,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==36) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a href="<?php echo site_url('adaptenvir/activity_list');?>"><i class="fa fa-table" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
        </a>
      </li>
</ul>
<?php
  }
?>

<?php
  //ระบบฐานข้อมูลคลังปัญญาผู้สูงอายุ
  if($usrpm['app_parent_id']==44) {
?>
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #ccc;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<?php
  }
?>

<?php
  //ระบบฐานข้อมูลอาสาสมัครดูแลผู้สูงอายุ (อผส.)
  if($usrpm['app_parent_id']==50) {
?> 
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #ccc;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<?php
  }
?>

<?php
  //ระบบฐานข้อมูลการเตรียมความพร้อมสู่วัยสูงอายุ (การให้ความรู้ก่อนวัยเกษียณ)
  if($usrpm['app_parent_id']==53) {
?>
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #333;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<ul class="dropdown-menu head_menu">
      <?php
      $tmp = $this->admin_model->getOnce_Application(54);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(54,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_id']==54) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a href="<?php echo site_url('prepare/prepare_list');?>"><i class="fa fa-table" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo "คลังความรู้"; }?>
        </a>
      </li>

      <?php
      $tmp = $this->admin_model->getOnce_Application(54);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(54,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php
      if(!isset($tmp1['perm_status'])) { ?>
      class="disabled" 
    <?php 
    }else if($usrpm['app_parent_id']==54) {
    ?>
          class="active"
      <?php
        }
      ?>
       >
        <a href="<?php echo site_url('prepare/training_list');?>"><i class="fa fa-table" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo "การจัดฝึกอบรม"; }?>
        </a>
      </li>
      <li>
        <a href="<?php echo site_url('report/H0/xls');?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> สถิติประชากรไทย</a>
      </li>
</ul>
<?php
  }
?>

<?php
  //ระบบฐานข้อมูลโรงเรียนผู้สูงอายุ
  if($usrpm['app_parent_id']==57) {
?>
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #ccc;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<?php
  }
?>

<?php 
  //ระบบฐานข้อมูลการส่งเสริมการจ้างงานผู้สูงอายุ
  if($usrpm['app_parent_id']==63){ ?>
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #333;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<ul class="dropdown-menu head_menu">
      <?php
      $tmp = $this->admin_model->getOnce_Application(151);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(151,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php if(!isset($tmp1['perm_status'])) { ?>
        class="disabled" 
      <?php }else if($usrpm['app_id']==151) { ?>
        class="active"
      <?php } ?>
       >
        <a href="<?php echo site_url('jobs/jobs_list');?>"><i class="fa fa-table" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
        </a>
      </li>
      <?php
      $tmp = $this->admin_model->getOnce_Application(152);   
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(152,get_session('user_id')); //Check User Permission
      ?>      
      <li 
      <?php if(!isset($tmp1['perm_status'])) { ?>
        class="disabled" 
      <?php }else if($usrpm['app_id']==152) { ?>
        class="active"
      <?php } ?>
       >
        <a href="<?php echo site_url('jobs/registered_list');?>"><i class="fa fa-table" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
        </a>
      </li>
  </ul>
  <?php } ?>

  <?php
  //ทะเบียนประวัติผู้สูงอายุ (ฐานข้อมูลกลาง)
  if($usrpm['app_parent_id']==70) {
?>
<a class="navbar-minimalize minimalize-styl-2 dropdown-toggle" data-toggle="dropdown" style=" border: 0;font-size: 17px; padding: 4px 10px 0px 0px;margin-left:10px;  color: #ccc;" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
<?php
  }
?>
                



