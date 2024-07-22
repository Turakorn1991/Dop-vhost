<div class="row">
	<div class="col-lg-12">
		<div class="tabs-container">
			<ul class="nav nav-tabs">
				<li role="presentation" class="active" style="max-width: 100% !important;"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab" >แบบสำรวจการจ้างงานผู้สูงอายุ</a></li>
			</ul>

			<div class="tab-content">
				<div id="tab1" class="tab-pane active">
					<div class="panel-group">
						<div class="panel-body">
							<form action="<?php echo site_url('survey/store') ?>" method="POST" >
								<input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
								<input type="hidden" name="job_sur_id" value="<?php echo $survey->job_sur_id ?>">
								<div class="form-group">
									<label for="job_sur_title" class="control-label">ชื่อแบบสำรวจ</label>
									<input type="text" class="form-control" name="job_sur_title" value="<?php echo $survey->job_sur_title ?>" placeholder="ระบุชื่อแบบสำรวจ">
								</div>
								<div class="form-group">
									<label for="job_sur_url" class="control-label">ลิงค์แบบสำรวจ</label>
									<input type="text" class="form-control" name="job_sur_url" value="<?php echo $survey->job_sur_url ?>" placeholder="ระบุลิงค์แบบสำรวจ">
								</div>
								<div class="form-group">
									<label for="job_sur_slug" class="control-label">Slug URL</label>
									<input type="text" class="form-control" aria-describedby="job_sur_slug_describe" name="job_sur_slug" value="<?php echo $survey->job_sur_slug ?>" placeholder="ระบุ Slug URL">
									<small id="job_sur_slug_describe" class="form-text text-muted">ตัวอย่าง <?php echo site_url('').'survey/to/ระบุเฉพาะส่วนนี้' ?></small>
								</div>

								<div class="form-group">
									<label for="job_sur_status" class="control-label">สถานะการเผยแพร่</label>
									<div>
									<input type="checkbox" class="js-switch hide" name="job_sur_status" value="Active" <?php echo ( empty($survey->job_sur_id) || $survey->job_sur_status == 'Active' ? 'checked' : '' ) ?> />
										
									</div>
								</div>

								<div class="row">
                                     <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                     <div class="col-xs-12 col-sm-2">
                                      <button style="height: 40px;width: 100% !important;" type="submit" class="btn btn-primary btn-save"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                    </div>
                                    <div class="col-xs-12 col-sm-2">
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('survey') ?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                    </div>
                                </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>