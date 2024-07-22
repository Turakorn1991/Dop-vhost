<style>
	.clickImage {
		cursor:pointer;
	}
</style>
<!--<div id="tmp_menu" hidden='hidden'>
<a onclick="return opnBck()" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('webconfig/main');?>">
<i class="fa fa-caret-left" aria-hidden="true"></i> </a>
</div>-->

<div class="row">
	<div class="col-lg-12">
		<div class="tabs-container">
			<ul class="nav nav-tabs">
				<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">ข้อมูลเว็บไซต์</a></li>
				<li role="presentation"><a href="#slide" aria-controls="slide" role="tab" data-toggle="tab">ภาพสไลด์</a></li>
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane active">
					<div class="panel-group">
						<div class="panel-body">
							<?php echo form_open_multipart("webconfig/webconfig_detail/Edited/1", array('id'=>'form1', 'class'=>'form-horizontal')); ?>
							<input value="submit" name="bt_submit" hidden="hidden">
							<div class="form-group">
								<label for="web_title" class="col-sm-2 control-label">ชื่อเว็บไซต์ :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_title" value="<?php echo @$web_title; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="web_icon" class="col-sm-2 control-label">ไอคอน :</label>
								<div class="col-sm-5">
									<?php if (@$web_icon != "" || @$web_icon != NULL) {?>
									<img src="<?php echo base_url("assets/modules/webconfig/images/".$web_icon);?>" style="width: 16px;"> <a href="<?php echo site_url('webconfig/delete_icon')?>" class="btn btn-danger btn-sm">ลบ</a>
									<?php } else { ?>
									<input type="file" name="web_icon">
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label for="web_logo" class="col-sm-2 control-label">โลโก้ :</label>
								<div class="col-sm-5">
									<?php if (@$web_logo != "" || @$web_logo != NULL) {?>
									<img src="<?php echo base_url("assets/modules/webconfig/images/".$web_logo);?>" style="width: 70px;"> <a href="<?php echo site_url('webconfig/delete_logo')?>" class="btn btn-danger btn-sm">ลบ</a>
									<?php } else { ?>
									<input type="file" name="web_logo">
									<?php } ?>
									
								</div>
							</div>
							<div class="form-group">
								<label for="web_address" class="col-sm-2 control-label">ที่อยู่ :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_address" value="<?php echo @$web_address; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="web_phone" class="col-sm-2 control-label">เบอร์โทรศัพท์ :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_phone" value="<?php echo @$web_phone; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="web_fax" class="col-sm-2 control-label">เบอร์แฟกซ์ :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_fax" value="<?php echo @$web_fax; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="web_email" class="col-sm-2 control-label">อีเมล์ :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_email" value="<?php echo @$web_email; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="web_keyword" class="col-sm-2 control-label">คีย์เวิร์ด :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_keyword" value="<?php echo @$web_keyword; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="web_description" class="col-sm-2 control-label">ลักษณะ :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_description" value="<?php echo @$web_description; ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="web_author" class="col-sm-2 control-label">ผู้เขียน :</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="web_author" value="<?php echo @$web_author; ?>">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-5">
									<button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				
				<div id="slide" class="tab-pane">
					<div class="panel-group">
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-12">
								<a href="<?php echo site_url('webconfig/infrm3');?>" class="navbar-minimalize minimalize-styl-2 btn btn-primary pull-right" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;">
									<i class="fa fa-plus" aria-hidden="true"></i> 
								</a>
								</div>
								<div class="col-lg-12">
								
									<div class="table-responsive">
										<table id="dtable" class="table table-bordered table-striped table-hover dataTables-example" style="margin-top: 0px !important;">
											<thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
												<tr>
													<th class="text-center" style="max-width: 50px;">#</th>
													<th class="text-center" style="max-width: 200px;">รูปสไลด์</th>
													<th class="text-center">ลิ้งค์</th>
													<th class="text-center" style="max-width: 100px;">สถานะ</th>
													<th style="max-width: 100px;"></th>
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
						</div>
					</div>
				</div>
			</div>
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

