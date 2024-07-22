<div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" >
		<thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
			<tr>
				<th class="text-center" style="width: 70px;">#</th>
				<th class="text-center">ชื่อบทความ</th>
				<th class="text-center" style="width: 200px;">บันทึกเมื่อ</th>
				<th style="width: 100px;">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach ($article AS $k => $row) { ?>
			<tr>
				<td class="lnk"><?php echo $i; ?></td>
				<td class="lnk"><?php echo $row['article_name']; ?></td>
				<td class="lnk"><?php echo formatDateThai1($row['insert_datetime']); ?></td>
				<td>
					<a href="<?php echo site_url("webconfig/infrm5/Edit/".$row['article_id'])?>" class="btn btn-default"><i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i></a>
					<a href="<?php echo site_url("webconfig/infrm5/Delete/".$row['article_id'])?>" class="btn btn-default" onclick="return confirm('ยืนยันการลบข้อมูล ?')"><i class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #000"></i></a>
				</td>
			</tr>
			<?php $i++; } ?>
		</tbody>
	</table>

</div>