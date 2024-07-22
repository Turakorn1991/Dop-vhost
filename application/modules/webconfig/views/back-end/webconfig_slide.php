<div id="tmp_menu" hidden='hidden'>
<a href="<?php echo site_url('webconfig/infrm3');?>" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;">
	<i class="fa fa-plus" aria-hidden="true"></i> 
</a>
<a onclick="return opnBck()" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('webconfig/main');?>">
	<i class="fa fa-caret-left" aria-hidden="true"></i> 
</a>
</div>
<script>
setTimeout(function(){
$("#menu_topright").html($("#tmp_menu").html());
},300);
</script>
<style>
	.clickImage {
		cursor:pointer;
	}
</style>
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<table id="dtable" class="table table-bordered table-striped table-hover dataTables-example" style="margin-top: 0px !important;">
				<thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
					<tr>
						<th class="text-center" style="width: 50px;">#</th>
						<th class="text-center" style="width: 200px;">รูปสไลด์</th>
						<th class="text-center">ลิ้งค์</th>
						<th class="text-center" style="width: 100px;">สถานะ</th>
						<th style="width: 100px;"></th>
					</tr>
				</thead>
				<tbody>
				<?php $i=1; foreach ($slide AS $val) { ?>
					<tr>
						<td class="text-center"><?php echo $i; ?></td>
						<td><img class="clickImage" src="<?php echo site_url("assets/modules/webconfig/images/".$val['slide_image']); ?>" style="height: 85px;" alt="<?php echo $val['slide_name']; ?>"></td>
						<td><?php echo $val['slide_link']; ?></td>
						<td class="text-center <?php echo ($val['slide_status']==0)?"text-danger":"text-success"; ?>"><?php echo ($val['slide_status']==0)?"ไม่แสดง":"แสดง"; ?></td>
						<td class="text-right">
							<a href="<?php echo site_url("webconfig/infrm3/Edit/".$val['slide_id']); ?>" class="btn btn-default btn-sm" title="แก้ไข"><i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i></a>
							<a href="<?php echo site_url("webconfig/infrm3/Delete/".$val['slide_id']); ?>" onclick="return confirm('ยืนยันการลบข้อมูล?')" class="btn btn-default btn-sm" title="ลบ"><i class="glyphicon glyphicon-trash" aria-hidden="true" style="color: #000"></i></a>
						</td>
					</tr>
				<?php $i++; } ?>
				<tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">ภาพสไลด์</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<img id="previewImage" src="" width="100%">
				</div>
			</div>
		</div>
	</div>
</div>

