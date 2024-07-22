<script>

$("#guide-book").click(function(){
    window.open('/assets/modules/jobs/guide/Job_Manual.pdf', '_blank');
});
</script>
<div class="table-responsive">
	<table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" >
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">วันที่สร้าง</th>
				<th class="text-center">ชื่อแบบฟอร์ม</th>
				<th class="text-center">ลิงค์แบบฟอร์ม</th>
				<th class="text-center">จำนวนผู้ตอบ</th>
				<th class="text-center">ส่งออกไฟล์</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td class="text-center">1</td>
					<td >01/09/2561</td>
					<td >แบบสำรวจการจ้างงานผู้สูงอายุ</td>
					<td ><a href="<?php echo site_url('jobs/survey/form'); ?>" target="_blank"><?php echo site_url('jobs/survey/form'); ?> </a>
						<div class="pull-right">
							<a href="#"><i class="fa fa-clipboard" aria-hidden="true"></i></a>
						</div>
					</td>
					<td class="text-center"><?php echo $num_survey_responses; ?></td>
					<td><a href="<?php echo site_url('report/survey/xls') ?>" target="_blank"><i class="fa fa-file-excel-o"></i> ดาวน์โหลด</a></td>
				</tr>
		</tbody>
	</table>
</div>