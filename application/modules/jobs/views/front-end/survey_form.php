<section id="container-survey-form" >
	<div class="container">
		<ul class="nav nav-pills">
			
			<li role="presentation" class="font20"><a href="<?php echo site_url();?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
			<li role="presentation" class="disabled font20"><a href="javascript:void(0);">แบบสำรวจการจ้างงานผู้สูงอายุ</a> </li>
			
		</ul>
		<hr>
		<div class="survey-form font22">
			<h1>แบบสำรวจสถานประกอบการที่มีการจ้างงานผู้สูงอายุ</h1>
			<form action="<?php echo site_url('jobs/survey/form_store') ?>" method="POST" data-toggle="validator" id="survey-form">
			  <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
			  <div class="form-group row">
			    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">1. ประเภทสถานที่ประกอบการ <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
				    <div class="form-check">
					  <input class="form-check-input" type="radio" name="job_sur_res_organization_type" id="job_sur_res_organization_type1" value="เอกชน" required checked>
					  <label class="form-check-label" for="job_sur_res_organization_type1">
					    เอกชน
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="job_sur_res_organization_type" id="job_sur_res_organization_type2" value="รัฐบาล" required>
					  <label class="form-check-label" for="job_sur_res_organization_type2">
					    รัฐบาล
					  </label>
					</div>
				</div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_organization_name" class="col-sm-3 col-form-label">2. ชื่อสถานที่ประกอบการ <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control surveytxt" id="job_sur_res_organization_name" name="job_sur_res_organization_name" required>
			   	</div>
			  </div>

			  <div class="form-group row">
			    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">3. การจ้างงานผู้สูงอายุ <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
				    <div class="form-check">
					  <input class="form-check-input" type="radio" name="job_sur_res_already_employed" id="job_sur_res_already_employed1" value="มีการจ้างงานผู้สูงอายุในสถานที่ประกอบการ" required checked>
					  <label class="form-check-label" for="job_sur_res_already_employed1">
					    มีการจ้างงานผู้สูงอายุในสถานที่ประกอบการ
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="job_sur_res_already_employed" id="job_sur_res_already_employed2" value="ไม่มีการจ้างงานผู้สูงอายุในสถานที่ประกอบการ" required>
					  <label class="form-check-label" for="job_sur_res_already_employed2">
					    ไม่มีการจ้างงานผู้สูงอายุในสถานที่ประกอบการ
					  </label>
					</div>
				</div>
			  </div>

			  <div class="form-group">
			    <label for="exampleInputPassword1">4. รายละเอียดการจ้างงานผู้สูงอายุในสถานที่ประกอบการ</label>
			  </div>

			  <div class="form-group">
			    <label for="exampleInputPassword1">4.1. จำนวนพนักงานผู้สูงอายุ</label>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_employed_num" class="col-sm-3 col-form-label">พนักงานผู้สูงอายุทั้งหมด <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_employed_num" name="job_sur_res_employed_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_male_employed_num" class="col-sm-3 col-form-label">แบ่งเป็นเพศชาย จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_male_employed_num" name="job_sur_res_male_employed_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_female_employed_num" class="col-sm-3 col-form-label">แบ่งเป็นเพศหญิง จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_female_employed_num" name="job_sur_res_female_employed_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="exampleInputPassword1">4.2. ช่วงอายุ</label>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_age_60_to_65_num" class="col-sm-3 col-form-label">60 - 65 ปี จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_age_60_to_65_num" name="job_sur_res_age_60_to_65_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_age_66_to_70_num" class="col-sm-3 col-form-label">66 - 70 ปี จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_age_66_to_70_num" name="job_sur_res_age_66_to_70_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_age_71_to_75_num" class="col-sm-3 col-form-label">71 - 75 ปี จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_age_71_to_75_num" name="job_sur_res_age_71_to_75_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_age_greater_than_76_num" class="col-sm-3 col-form-label">76 ปีขึ้นไป จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_age_greater_than_76_num" name="job_sur_res_age_greater_than_76_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group">
			    <label for="exampleInputPassword1">4.3. ระดับการศึกษา</label>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_education_not_educated_num" class="col-sm-3 col-form-label">ไม่มีการศึกษา จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_education_not_educated_num" name="job_sur_res_education_not_educated_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_education_primary_school_num" class="col-sm-3 col-form-label">ระดับประถมศึกษา จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_education_primary_school_num" name="job_sur_res_education_primary_school_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_education_secondary_school_num" class="col-sm-3 col-form-label">ระดับมัธยมศึกษา จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_education_secondary_school_num" name="job_sur_res_education_secondary_school_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_education_vocational_num" class="col-sm-3 col-form-label">ระดับปริญญาตรี จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_education_vocational_num" name="job_sur_res_education_vocational_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_education_bachelor_num" class="col-sm-3 col-form-label">ระดับปริญญาโท จำนวน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_education_bachelor_num" name="job_sur_res_education_bachelor_num" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_education_spicify" class="col-sm-3 col-form-label">อื่นๆ <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control surveytxt" id="job_sur_res_education_spicify" name="job_sur_res_education_spicify" value="" required>
			    </div>
			  </div>

			  <div class="form-group row">
			    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">4.4 ช่วงเวลาทำงาน <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
				    <div class="form-check">
					  <input class="form-check-input " type="radio" name="job_sur_res_work_hours" id="job_sur_res_work_hours1" value="เต็มเวลา 8 ชั่วโมง" checked>
					  <label class="form-check-label" for="job_sur_res_work_hours1" required>
					    เต็มเวลา 8 ชั่วโมง
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="job_sur_res_work_hours" id="job_sur_res_work_hours2" value="บางเวลา">
					  <label class="form-check-label" for="job_sur_res_work_hours2" required>
					    บางเวลา (กรุณาระบุเวลา)
					  </label>
					</div>
					<div class="form-check">
					  <input type="text" class="form-control surveytxt" placeholder="โปรดระบุ" required>
					  
					</div>
				</div>
			  </div>

			  <div class="form-group row">
			    <label for="job_sur_res_work_description"  class="col-sm-3 col-form-label">4.5. ลักษณะหรือประเภทงานที่ทำ <span class="text-danger">*</span></label>
			    <div class="col-sm-9">
			    	<input type="text" class="form-control surveytxt" id="job_sur_res_work_description" name="job_sur_res_work_description" required>
			   	</div>
			  </div>


				<div class="">
			    	<label for="exampleInputPassword1">4.6. การจ่ายผลตอบแทนการจ้างแรงงานผู้สูงอายุในสถานประกอบการ (ตอบได้มากกว่า 1 ข้อ)</label>
			  	</div>
			  	<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="รายเดือน" id="job_sur_res_employment_payment_type_set1" name="job_sur_res_employment_payment_type_set">
				  <label class="form-check-label" for="job_sur_res_employment_payment_type_set1">
				    รายเดือน
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="รายชิ้น" id="job_sur_res_employment_payment_type_set2" name="job_sur_res_employment_payment_type_set">
				  <label class="form-check-label" for="job_sur_res_employment_payment_type_set2">
				    รายชิ้น
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="รายชั่วโมง" id="job_sur_res_employment_payment_type_set3" name="job_sur_res_employment_payment_type_set">
				  <label class="form-check-label" for="job_sur_res_employment_payment_type_set3">
				    รายชั่วโมง
				  </label>
				</div>
				<div class="form-check">
				  <input class="form-check-input" type="checkbox" value="" id="job_sur_res_employment_payment_type_set4" name="job_sur_res_employment_payment_type_set">
				  <label class="form-check-label" for="job_sur_res_employment_payment_type_set4">
				    อื่นๆ (กรุณาระบุ)
				  </label>
				</div>
				<div class="form-check">
					<input type="text" class="form-control surveytxt" name="job_sur_res_employment_payment_type_set" placeholder="โปรดระบุ">	  
				</div>

				<br>

				<div class="form-group">
					<label for="job_sur_res_employment_policy">5. นโยบายการจ้างงานผู้สูงอายุ (ถ้ามี)</label>
					<textarea class="form-control surveytxt" id="job_sur_res_employment_policy" name="job_sur_res_employment_policy" rows="3"></textarea>
				</div>

				<div class="form-group">
					<label for="job_sur_res_employment_purpose">6. แรงบันดาลใจในการจ้างงานผู้สูงอายุ</label>
					<textarea class="form-control surveytxt" id="job_sur_res_employment_purpose" name="job_sur_res_employment_purpose" rows="3"></textarea>
				</div>

				<div class="form-group">
					<label for="job_sur_res_suggestion">7. ข้อเสนอแนะเพื่อความต่อเนื่องในการจ้างงาน หรือมีความยั่งยืนอย่างไร</label>
					<textarea class="form-control surveytxt" id="job_sur_res_suggestion" name="job_sur_res_suggestion" rows="3"></textarea>
				</div>

				<div class="form-group">
			    	<label>8. ผู้ให้ข้อมูล <span class="text-danger">*</span></label>
			  	</div>

			  	<div class="form-group row">
				    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">คำนำหน้านาม</label>
				    <div class="col-sm-9">
					    <div class="form-check">
						  <input class="form-check-input" type="radio" name="job_sur_res_prename" id="job_sur_res_prename1" value="นาย" checked required>
						  <label class="form-check-label" for="job_sur_res_prename1">
						    นาย
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="job_sur_res_prename" id="job_sur_res_prename2" value="นาง" required>
						  <label class="form-check-label" for="job_sur_res_prename2">
						    นาง
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="job_sur_res_prename" id="job_sur_res_prename3" value="นางสาว" required>
						  <label class="form-check-label" for="job_sur_res_prename3">
						    นางสาว
						  </label>
						</div>
					</div>
			  	</div>
				
				<div class="form-group row">
				    <label for="job_sur_res_firstname" class="col-sm-3 col-form-label">ชื่อ</label>
				    <div class="col-sm-9">
				    	<input type="text" class="form-control surveytxt" id="job_sur_res_firstname" name="job_sur_res_firstname" required>
				   	</div>
			  	</div>

				<div class="form-group row">
				    <label for="job_sur_res_lastname" class="col-sm-3 col-form-label">นามสกุล</label>
				    <div class="col-sm-9">
				    	<input type="text" class="form-control surveytxt" id="job_sur_res_lastname" name="job_sur_res_lastname" required>
				   	</div>
			  	</div>

				<div class="form-group row">
				    <label for="job_sur_res_position" class="col-sm-3 col-form-label">ตำแหน่ง</label>
				    <div class="col-sm-9">
				    	<input type="text" class="form-control surveytxt" id="job_sur_res_position" name="job_sur_res_position" required>
				   	</div>
			  	</div>

				<div class="form-group row">
				    <label for="job_sur_res_tel" class="col-sm-3 col-form-label">เบอร์โทรศัพท์</label>
				    <div class="col-sm-9">
				    	<input type="text" class="form-control surveytxt" id="job_sur_res_tel" name="job_sur_res_tel" required>
				   	</div>
			  	</div>

			  	<div class="form-group row">
				    <label for="job_sur_res_mobile_tel" class="col-sm-3 col-form-label">เบอร์มือถือ</label>
				    <div class="col-sm-9">
				    	<input type="text" class="form-control surveytxt" id="job_sur_res_mobile_tel" name="job_sur_res_mobile_tel" required>
				   	</div>
			  	</div>

			  	<div class="form-group row">
				    <label for="job_sur_res_email" class="col-sm-3 col-form-label">E-Mail</label>
				    <div class="col-sm-9">
				    	<input type="text" class="form-control surveytxt" id="job_sur_res_email" name="" required>
				   	</div>
			  	</div>
			  
			  	<div class="pull-right">
			  		<button type="submit" class="btn btn-primary btn-lg" style="min-width: 200px;"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>		  		
			  		<button type="submit" class="btn btn-danger btn-lg" style="min-width: 200px;">ยกเลิก</button>		  		
			  	</div>


			</form>
		</div>
	</div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
