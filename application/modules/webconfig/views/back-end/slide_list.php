<h3 style="color: #4e5f4d"><?php echo $title;?></h3>
<hr/>
<div>
	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#news"><?php echo $title;?></a></li>
	<li role="presentation"><a href="<?php echo site_url("webconfig/slide_list"); ?>">Profile</a></li>
	</ul>
  
	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="news">
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 text-right">

				  <?php
					$tmp = $this->admin_model->getOnce_Application(12);
					$tmp1 = $this->admin_model->chkOnce_usrmPermiss(12,$user_id); //Check User Permission
				  ?>
				  <a <?php if(!isset($tmp1['perm_status'])) {?>
					readonly
				  <?php }else{?> href="<?php echo site_url('webconfig/infrm2');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
					  <i class="fa fa-plus" aria-hidden="true"></i>
				  </a>

				  <?php
					$tmp = $this->admin_model->getOnce_Application(16);
					$tmp1 = $this->admin_model->chkOnce_usrmPermiss(16,$user_id); //Check User Permission
				  ?>
				  <a <?php if(!isset($tmp1['perm_status'])) {?>
					readonly
				  <?php }else{?> href="<?php echo site_url('report/excel');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
					  <i class="fa fa-file-excel-o" aria-hidden="true"></i>
				  </a>

				  &nbsp;
				  <a style="color: #000; padding-left: 20px; padding-right: 20px;" title="����" class="btn btn-default" data-toggle="modal" data-target="#mySearch">
					  <i class="fa fa-filter" aria-hidden="true"></i>
					  </a>

				</div>
			</div>
		</div>
	</div>
</div>
