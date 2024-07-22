<div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" >
		<thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
			<tr>
				<th class="text-center" style="width: 70px;">#</th>
				<th class="text-center">ชื่อกิจกรรม</th>
				<th class="text-center" style="width: 200px;">วันที่จัดกิจกรรม</th>
				<th class="text-center" style="width: 200px;">ถึงวันที่</th>
				<th class="text-center" style="width: 200px;">บันทึกเมื่อ</th>
				<th style="width: 100px;">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach ($event AS $k => $row) { ?>
			<tr>
				<td class="lnk"><?php echo $i; ?></td>
				<td class="lnk"><?php echo $row['event_name']; ?></td>
				<td class="lnk"><?php echo formatDateThai1($row['event_date_start']); ?></td>
				<td class="lnk"><?php echo formatDateThai1($row['event_date_end']); ?></td>
				<td class="lnk"><?php echo formatDateThai1($row['insert_datetime']); ?></td>
				<td>
					<a href="<?php echo site_url("webconfig/infrm4/Edit/".$row['event_id'])?>" class="btn btn-default"><i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i></a>
					<a href="#" data-id=<?php echo $row['event_id'];?> data-toggle="modal" data-target="#dltModel" title="ลบ" type="button" class="btn btn-default"><i class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #000"></i></a>
					
				</td>
			</tr>
			<?php $i++; } ?>
		</tbody>
	</table>

</div>

<!-- Delete Modal -->
<div id="dltModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('034');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->