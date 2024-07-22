<div id="tmp_menu" hidden="hidden">
	<?php
      $tmp = $this->admin_model->getOnce_Application(59);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('survey/create');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>
</div>


<script>
	setTimeout(function(){
      $("#menu_topright").html($("#tmp_menu").html());
    },300);
</script>

<?php $this->load->file(APPPATH.'modules/jobs/views/back-end/partial/_menu_tab_list_page.php'); ?>

<div class="table-responsive">
	<table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" >
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">ชื่อแบบสำรวจ</th>
				<th class="text-center">ลิงค์แบบสำรวจ</th>
				<th class="text-center">สถานะ</th>
				<th class="text-center">อัพเดตเมื่อ</th>
				<th class="text-center"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($surveys as $key => $survey) { ?>
				<tr>
					<td class="text-center"><?php echo $key+1 ?></td>
					<td ><?php echo $survey->job_sur_title ?></td>
					<td ><?php echo site_url('survey/to/'.$survey->job_sur_id.'/'.$survey->job_sur_slug) ?></td>
					<td ><?php echo $survey->job_sur_status ?></td>
					<td ><?php echo $survey->job_sur_update_datetime ?></td>
					<td><a href="<?php echo site_url('survey/edit/'.$survey->job_sur_id) ?>">แก้ไข</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

