<?php 
// set_session('pers_authen',array('authen_log_id'=>10,'pid'=>'3101701933555','cid'=>'0221004350953232','random_string'=>'0886e3bf787a223c90c8a231a63d283c')); //for Test

?>

<style>
.close{
	font-size: 2.5rem !important;
}

.datepicker .clear{
	display: table-cell;
}
</style>
<script>
var localAdmins = <?php echo json_encode($localAdmins);?>;

var formatThaiDate = (() => {
	var thaiMonth = ',มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม'.split(',');
	var millisecToYear = ms => Math.floor(ms / (1000 * 60 * 60 * 24 * 365));
	return (birth, death) => {
		var birthday = new Date(birth);
		birth = birth.split('-');
		if (birthday.toDateString() === 'Invalid Date')
			return 'ไม่ได้ระบุ';
		var deathday = new Date(death);
		var dateCompare = deathday.toDateString() === 'Invalid Date' ? new Date() : deathday;
		return birth[2] + ' ' + thaiMonth[+birth[1]] + ' ' + (+birth[0] + 543) +
			' (อายุ ' + millisecToYear(dateCompare - birthday) + ' ปี)';
	};
})();
		$("#Province").next().css("cssText", "border: 1px solid red; width:100%;");
		$("#Amphur").next().css("cssText", "border: 1px solid red; width:100%;");
		$("#Tambon").next().css("cssText", "border: 1px solid red; width:100%;");
		$("#guide-book").click(function(){
		window.open('/assets/modules/volunteer/guide/Vol_Manual.pdf', '_blank');
		});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<div class="row">
	<div class="col-lg-12">
		<div class="tabs-container tabs-container-border">
			<div class="panel-group">
				<div class="panel panel-default" style=" border: none; ">
					<br>					
					<input type="hidden" name="currtoken" id="currtoken" value="<?php echo !empty($token_id) ? $token_id:''; ?>"/>
            
					<div class="panel-heading">
						<h4>
							ข้อมูลอาสาสมัคร
						</h4>
					</div>

					<div class="panel-body" style=" border: none;">

						<form action="<?php echo site_url('volunteer/info/store')  ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
							<input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
							<input type="hidden" id="csrf_name" value="<?php echo $csrf['name'];?>">
							<input type="hidden" id="csrf_hash" value="<?php echo $csrf['hash'];?>">
							<input type="submit" value="submit" name="bt_submit" hidden="hidden">
							<input type="hidden" name="volt_info[volt_id]" value="<?php echo $volt_info['volt_id'];?>">
							<input type="hidden" id="marker_img" value="<?php echo path('map-marker.png','webconfig');?>">
							<input type="hidden" id="user_id" value="<?php echo get_session('user_id');?>">
							<input type="hidden" id="org_id" value="<?php echo get_session('org_id');?>">
							<input type="hidden" id="app_env" value="<?php echo $this->config->item('app_env') ?>">
							<!-- <input type="hidden" id="pers_authen" value="<?php //echo json_encode(get_session('pers_authen'));?>"> -->

							<div class="form-group row">

								<!-- <div class="col-xs-12 col-sm-3">
									<img src="<?php //echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto; width: 70%;">
								</div> -->
								<div class="col-xs-12 col-sm-9">

									<div class="form-group row">
										<label class="col-sm-3 control-label text-danger"><b>เลขประจำตัวประชาชน</b></label>
			                            <div class="col-sm-3">
			                            	<div class="input-group has-error" style="max-width: 300px;">
										      	<input title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="req_pid" name="pers_info[pid]" value="<?php echo $pers_info['pid'];?>" required/>
				                                <input type="hidden" id="pers_id" name="volt_info[pers_id]" value="<?php echo $volt_info['pers_id'];?>">
												<input type="hidden" id="pid_id" name="impv_pid[pid]" value="<?php echo $pers_info['pid'];?>">

											    <div class="input-group-btn" style="padding-bottom: 5px;">
				                                	<button title="ตรวจสอบ" class="btn btn-default elder_same_req" onClick="bt_req_pid()" type="button" style="background-color:#F2DEDE; border-radius: 0px; border-color: #ed5565; color: #ed5565;padding:4.5px 12px;">
				                                		<i class="fa fa-search" aria-hidden="true"></i>
				                                	</button>
				                                </div>
			                                </div>
									    </div>
										<div class="col-sm-6">
											<button type="button" class="btn btn-default " onClick="cardInfo()" title="ดึงข้อมูลจากบัตร" style="background-color:#F2DEDE; order-radius: 0px; left: 1px; border-color: #ed5565; color: #ed5565;padding:5px 12px;">ดึงข้อมูลจากบัตร</button> 
                                                   
										</div>

									</div>

									<div class="form-group row">
										<label class="col-sm-3 control-label"><b>ชื่อตัว/ชื่อสกุล</b></label>
										<div class="col-sm-3" >
											<p class="form-control-static" id="name">
												<?php echo $req_prename['prename_th'].' '.$pers_info['name'];?>
											</p>
										</div>

										<label class="col-sm-3 control-label"><b>วันเดือนปีเกิด</b></label>
										<div class="col-sm-3">
											<p class="form-control-static" id="date_of_birth_text">
												<?php echo $pers_info['date_of_birth'];?>
											</p>
										</div>
										
										
									</div>

									<div class="form-group row">
										<div class="col-sm-3">
											<b class="control-label">เพศ</b>
											<span id="gender_name" class="form-control-static">
												<?php echo $pers_info['gender_name'];?>
											</span>
										</div>

										<div class="col-sm-3">
											<b class="control-label">สัญชาติ</b>
											<span id="nation_name_th" class="form-control-static">
												<?php echo $pers_info['nation_name_th'];?>
											</span>
										</div>

										<div class="col-sm-6">
											<b class="control-label">ที่อยู่ตามทะเบียนบ้าน</b>
											
											<span id="reg_addr"> <?php echo $pers_info['reg_add_info'];?></span> 
										</div>

		
									</div>

<!-- 									<div class="form-group row">
										<label class="col-sm-3 control-label"><b>ที่อยู่ตามทะเบียนบ้าน</b></label>
										<div class="col-sm-9" >
											<p class="form-control-static">
												<?php //echo ($reg_addr['addr_home_no'] != '' ? $reg_addr['addr_home_no'] : '-' );  ?>
												<?php //echo ($reg_addr['addr_moo'] != '' ? 'หมุ่ '.$reg_addr['addr_moo'] : '');  ?>
												<?php //echo $reg_addr['addr_sub_district'];  ?>
												<?php //echo $reg_addr['addr_district'];  ?>
												<?php //echo $reg_addr['addr_province'];  ?>
												<?php //echo $reg_addr['addr_zipcode'];  ?>
											</p>
										</div>
									</div> -->



								</div>
							</div>

							<hr>

							<div class="form-group row">
								<div class="col-sm-12">
									<label for="date_of_reg" class="control-label text-danger"><b>วันที่ขึ้นทะเบียน</b></label>
									<div id="date_of_reg" class="input-group date has-error" data-date-format="dd-mm-yyyy" style="max-width:300px;">
		                                <input title="วันที่ขึ้นทะเบียน" placeholder="เลือกวันที่" class="form-control" type="text" name="volt_info[date_of_reg]" id="volt_info_date_of_reg" value="<?php echo $volt_info['date_of_reg'] ?>" required />
		                                <span class="input-group-addon" style="height: 35px;"><i class="glyphicon glyphicon-calendar"></i></span>
		                            </div>
								</div>
							</div>
							
							<div class="form-group row">
								<div class="col-sm-12">

									<div class="checkbox-inline i-checks">
	                            		<label>
	                              			<b>ที่อยู่ (ปัจจุบัน)</b> ( <input type="checkbox" name="volt_addr_chk" > ตรงกับที่อยู่ตามทะเบียนบ้าน )
	                              			<!-- Case Update stat from js -->

	                              			<input type="hidden" id="reg_addr_id" name="reg_addr_id" value="<?php echo $pers_info['reg_addr_id'] ?>">
	                              			<input type="hidden" id="pre_addr_id" name="pre_addr_id" value="<?php echo $pers_info['pre_addr_id'] ?>">

	                              		</label>
	                          		</div>

								</div>
							</div>
							<input type="hidden" id="pren_code" name="impv_info[pren_code]" value="<?php echo $req_pers_info['pren_code'];?>">
                            <input type="hidden" id="pren_name" name="impv_info[pren_name]" value="<?php echo $req_prename['prename_th'];?>">
                                                  
							<input type="hidden" id="pers_firstname_th" name="impv_info[pers_firstname_th]" value="<?php echo $pers_info['pers_firstname_th'];?>">
							<input type="hidden" id="pers_lastname_th" name="impv_info[pers_lastname_th]" value="<?php echo $pers_info['pers_lastname_th'];?>">
							<input type="hidden" id="date_of_birth" name="impv_info[date_of_birth]" value="<?php echo $pers_info['date_of_birth_num'];?>">
							<input type="hidden" id="gender_code" name="impv_info[gender_code]" value="<?php echo $pers_info['gender_code'];?>">

							<input type="hidden"  name="impv_addr[addr_home_no]" value="<?php echo $reg_addr['addr_home_no'];?>">
							<input type="hidden"  name="impv_addr[addr_moo]" value="<?php echo $reg_addr['addr_moo'];?>">
							<input type="hidden"  name="impv_addr[addr_alley]" value="<?php echo $reg_addr['addr_alley'];?>">
							<input type="hidden"  name="impv_addr[addr_lane]" value="<?php echo $reg_addr['addr_lane'];?>">
							<input type="hidden"  name="impv_addr[addr_road]" value="<?php echo $reg_addr['addr_road'];?>">
							<input type="hidden"  name="impv_addr[addr_province]" value="<?php echo $reg_addr['province_code'];?>">
							<input type="hidden"  name="impv_addr[addr_district]" value="<?php echo $reg_addr['district_code'];?>">
							<input type="hidden"  name="impv_addr[addr_sub_district]" value="<?php echo $reg_addr['sub_district_code'];?>"> 

							<input type="hidden" id="addr_province" name="pers_addr[addr_province]" value="<?php //echo $impv_home_info['addrProvince'];?>">
							<input type="hidden" id="addr_district" name="pers_addr[addr_district]" value="<?php //echo $impv_home_info['addrAmphur'];?>">
							<input type="hidden" id="addr_sub_district" name="pers_addr[addr_sub_district]" value="<?php //echo $impv_home_info['addrProvince'];?>"> 

							<div class="volunteer-address">

								<div class="form-group row">
									<div class="col-sm-12">
										<label>พิกัดภูมิศาสตร์</label>
										<div class="input-group" style="max-width: 500px;">
										<?php
											$addr_gps = '0,0'; // Default case insert, Old Data $diff_info['addr_gps']
											if($volt_info['volt_id'] != ''){ //Show spec case update
												$addr_gps = $pers_addr['addr_gps']; // Set Default Data
											}
											$addr_gps_set = explode(',',$addr_gps);
				                        ?>
									      <input type="text" class="form-control" placeholder="ตัวอย่าง xxxx,xxxx" name="pers_addr[addr_gps]" value="<?php echo $pers_addr['addr_gps'];?>" id="addr_gps" data-lat="<?php echo $addr_gps_set[0]; ?>"  data-long="<?php echo $addr_gps_set[1]; ?>">

									      <span class="input-group-btn">
									      	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_marker">
		                                  		<i class="fa fa-map-marker" aria-hidden="true"></i> ตำแหน่งพิกัดภูมิศาสตร์
		                                	</button>
									      </span>

									    </div>
									</div>
								</div>

								<div class="form-group row">
		                            <div class="col-xs-12 col-sm-3">
		                            	<label for="" class="col-2 col-form-label">บ้านเลขที่</label>
										
										<input type="hidden" name="addr_home_id" value="<?php echo @$addr_pers_info['addr_home_no']; ?>">
		                              	<input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text" id="addr_home_no" name="pers_addr[addr_home_no]" value="<?php echo $addr_pers_info['addr_home_no']; ?>" />
		                            </div>
		                            <div class="col-xs-12 col-sm-3">
		                              	<label for="" class="col-2 col-form-label">หมู่ที่</label>
										<input type="hidden" name="addr_moo_id"  value="<?php echo @$addr_pers_info['addr_moo']; ?>">
		                              	<input title="หมู่ที่" placeholder="" id="addr_moo" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_moo]" value="<?php echo $addr_pers_info['addr_moo']; ?>" />
		                            </div>
		                        </div>

		                        <div class="form-group row">
			                        <div class="col-xs-12 col-sm-3 dropdown">
			                          <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
			                          <div class="col-10">
			                            <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_alley]" value="<?php echo $addr_pers_info['addr_alley']; ?>" />
			                          </div>
			                        </div>
			                        <div class="col-xs-12 col-sm-3 dropdown">
			                          <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
			                          <div class="col-10">
			                            <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_lane]" value="<?php echo $addr_pers_info['addr_lane']; ?>" />
			                          </div>
			                        </div>
			                        <div class="col-xs-12 col-sm-6 dropdown">
			                          <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
			                          <div class="col-10">
			                            <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_road]" value="<?php echo $addr_pers_info['addr_road']; ?>" />
			                          </div>
			                        </div>
		                      	</div>

		                      	<div class="form-group row">
		                            <div class="col-xs-12 col-sm-3 dropdown">
		                              <label for="example-text-input" style="color:red;" class="col-2 col-form-label">จังหวัด</label>
		                              <div class="col-10">
		                                <select title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="pers_addr[addr_province]" onchange="optionGen(this,'Amphur');" value="<?php echo $addr_pers_info['addr_province']; ?>" required>
		                                  <option value="">เลือกจังหวัด</option>
		                                  <?php
		                                    foreach ($provinces as $key => $province) { ?>
		                                    <option value="<?php echo $province['area_code']; ?>" <?php echo ( $province['area_code'] == $addr_pers_info['addr_province'] ? 'selected' : '' ) ?>>
		                                      <?php echo $province['area_name_th']; ?>
		                                    </option>
		                                    <?php  } ?>
		                                </select>
		                              </div>
		                            </div>
		                            <div class="col-xs-12 col-sm-3 dropdown">
		                              <label for="example-text-input" style="color:red;" class="col-2 col-form-label">อำเภอ</label>
		                              <div class="col-10">
		                                <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="pers_addr[addr_district]" onchange="optionGen(this,'Tambon');" value="<?php echo $addr_pers_info['addr_district']; ?>" disabled required>
		                                  <option value="">เลือกอำเภอ</option>
		                                </select>
		                              </div>
		                            </div>
		                            <div class="col-xs-12 col-sm-3 dropdown">
		                              <label for="example-text-input" style="color:red;" class="col-2 col-form-label">ตำบล</label>
		                              <div class="col-10">
		                                <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon" name="pers_addr[addr_sub_district]" onchange="genLAOption(this);" value="<?php echo $addr_pers_info['addr_sub_district']; ?>" disabled required>
		                                  <option value="">เลือกตำบล</option>
		                                </select>
		                              </div>
		                            </div>
									<div class="col-xs-12 col-sm-3 dropdown">
		                              <label for="example-text-input" class="col-2 col-form-label">องค์กรปกครองส่วนท้องถิ่น (อปท.)</label>
		                              <div class="col-10">
		                                <select title="ตำบล" placeholder="เลือก อปท." class="form-control elder_addr_pre" id="LocalAdmin" name="volt_info[la_org_id]" value="<?php echo $volt_info['la_org_id']; ?>" disabled>
		                                  <option value="">เลือก อปท.</option>
		                                </select>
		                              </div>
		                            </div>
		                            <div class="col-xs-12 col-sm-3">
		                              <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
		                              <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_zipcode]" value="<?php echo $addr_pers_info['addr_zipcode'] ?>" />
		                            </div>
		                          </div>

	                      	</div>
	                      	<!-- END .volunteer-address -->

	                      	<div class="form-group row">
	                            <div class="col-xs-12 col-sm-3">
	                              <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
	                              <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="pers_info[tel_no_home]" value="<?php echo $pers_info['tel_no_home'] ?>" />
	                            </div>
								<div class="col-xs-12 col-sm-3 dropdown">
	                              <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
	                              <div class="col-10">
	                                <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control" name="pers_info[edu_code]">
	                                  <option value="">เลือกระดับการศึกษา</option>
	                                  	<?php foreach ($edu_levels as $key => $edu_level) { ?>
	                                    <option value="<?php echo $edu_level['edu_code']; ?>" <?php echo ($pers_info['edu_code'] == $edu_level['edu_code'] ? 'selected' : '' ); ?>>
	                                      <?php echo $edu_level['edu_title']; ?>
	                                    </option>
	                                    <?php } ?>
	                                </select>
	                              </div>
	                            </div>
								<div class="col-xs-12 col-sm-3 dropdown">
	                              <label for="example-text-input" class="col-2 col-form-label">อาชีพ (ปัจจุบัน)</label>
	                              <div class="col-10">
	                                <select id='jobDefault' title="อาชีพ (ปัจจุบัน)" placeholder="เลือกอาชีพ" class="form-control">
									  <?php $jobEtc=true;?>
	                                  <option value="" <?php if (!$pers_info['occupation']) {echo 'selected';$jobEtc=false;}; ?>>เลือกอาชีพ</option>
									  <option value="ไม่ได้ประกอบอาชีพ" <?php if ($pers_info['occupation'] == 'ไม่ได้ประกอบอาชีพ') {echo 'selected';$jobEtc=false;}; ?>>
	                                    ไม่ได้ประกอบอาชีพ
	                                  </option>
									  <option value="เกษตรกรรม" <?php if ($pers_info['occupation'] == 'เกษตรกรรม') {echo 'selected';$jobEtc=false;}; ?>>
	                                    เกษตรกรรม
	                                  </option>
									  <option value="รับจ้างทั่วไป" <?php if ($pers_info['occupation'] == 'รับจ้างทั่วไป') {echo 'selected';$jobEtc=false;}; ?>>
	                                    รับจ้างทั่วไป
	                                  </option>
	                                  <option value="รับราชการ" <?php if ($pers_info['occupation'] == 'รับราชการ') {echo 'selected';$jobEtc=false;}; ?>>
	                                    รับราชการ
	                                  </option>
									  <option value="ค้าขาย" <?php if ($pers_info['occupation'] == 'ค้าขาย') {echo 'selected';$jobEtc=false;}; ?>>
	                                    ค้าขาย
	                                  </option>
									  <option value="etc" <?php echo $jobEtc ? 'selected' : ''; ?>>
	                                    อื่นๆ
	                                  </option>
	                                </select>
	                              </div>
	                            </div>
	                            <div class="col-xs-12 col-sm-3">
	                              	<label for="" class="col-2 col-form-label">อาชีพอื่นๆ (ระบุ)</label>
	                              	<input id='jobEtc' title="อาชีพอื่นๆ (ระบุ)" placeholder="ระบุ" class="form-control" type="text"
										value="<?php echo $jobEtc ? $pers_info['occupation'] : ''; ?>"
										<?php echo $jobEtc ? '' : 'disabled'; ?>/>
	                            </div>
								<input id='jobValue' type='hidden' name='pers_info[occupation]' value="<?php echo $pers_info['occupation'] ?>" />
	                        </div>

	                        <div class="form-group row">
	                        	<div class="col-xs-12 col-sm-12">
	                                <label>ปัจจุบันดำรงดำแหน่งในหมู่บ้าน/ตำบล  (เลือกได้มากกว่า 1 ข้อ)</label>
	                            </div>
								<?php foreach ($village_positions as $key => $village_position) { ?>

									<div class="col-xs-12 col-sm-3">
										<div class="checkbox-inline i-checks">
										<label>
											<input type="checkbox" name="volt_info_village_position[vpos_code][<?php echo $key; ?>]" id="volt_info_village_position-<?php echo $key; ?>" value="<?php echo $key; ?>" <?php echo ( $volt_info_village_position[$key]['vpos_code'] == $key ? 'checked' : '' ) ?> > <?php echo $village_position; ?></label>
										</div>
									</div>
								<?php } ?>

								<div class="col-xs-12 col-sm-6">
									<input id="vpos-009" type="text" class="form-control" title="ตำแหน่งในหมู่บ้าน/ตำบล อื่น ๆ (ระบุ)" placeholder="อื่น ฯ (ระบุ)" name="volt_info_village_position[vpos_identify][009]" value="<?php echo $volt_info_village_position['009']['vpos_identify'];?>"
	                                <?php if(!isset($volt_info_village_position['009']['vpos_identify'])) { echo "disabled";} ?>>
	                            </div>
							</div>

							<div class="form-group row">
	                          <div class="col-xs-12 col-sm-12">
	                            <label>ได้รับการอบรมเรื่องการดูแลผู้สูงอายุ</label>
	                          </div>
	                          <div class="col-xs-12" >
	                            <div class="checkbox-inline i-checks">
	                              <label>
	                                <input type="radio" name="volt_info[older_care_training]" value="ไม่เคยได้รับการอบรม" <?php if($volt_info['older_care_training']=="ไม่เคยได้รับการอบรม" ){ echo "checked";}?>> ไม่เคยได้รับการอบรม</label>
	                            </div>
	                          </div>


	                          <div class="col-xs-12">
	                            <div class="checkbox-inline i-checks">
	                              <label>
	                                <input type="radio" name="volt_info[older_care_training]" value="เคยได้รับการอบรม" <?php if($volt_info['older_care_training']=="เคยได้รับการอบรม" ){ echo "checked";}?>> เคยได้รับการอบรม</label>
	                            </div>
	                          </div>

	                        </div>

	                        <div class="training_members" style="margin-bottom:1rem;">
	                        	<?php if(($process_action=='Edit')){ ?>
	                        		<?php foreach($volt_info_training as $key_training => $value_training ){ ?>
	                        			<div class="row training_template_list">
		                                  <input type="hidden" name="training[train_id][<?php echo $key_training; ?>]" value="<?php echo $value_training['train_id']; ?>">

		                                  <div class="col-xs-12 col-sm-3">
		                                    <label for="datetimepicker_trn_<?php echo $key_training?>" class="col-2 col-form-label">วันที่ได้รับการอบรม</label>
		                                    <div id="datetimepicker_trn_<?php echo $key_training?>" class="col-10 input-group date datetimepicker_trn" data-date-format="dd-mm-yyyy">
		                                      <input title="วันที่ได้รับการอบรม" placeholder="เลือกวันที่" class="form-control training" type="text" name="training[date_of_training][<?php echo $key_training?>]" value="<?php echo dateChange($value_training['date_of_training'],3); ?>" />
		                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
		                                    </div>
		                                  </div>
		                                  <div class="col-xs-12 col-sm-3">
		                                    <label for="" class="col-2 col-form-label">จากหน่วยงาน</label>
		                                    <input title="จากหน่วยงาน" placeholder="จากหน่วยงาน" class="form-control training" type="text" name="training[older_care_training_org][<?php echo $key_training?>]" value="<?php echo $value_training['older_care_training_org'];?>" />
		                                  </div>
		                                  <div class="col-xs-12 col-sm-3">
		                                    <label for="" class="col-2 col-form-label">หลักสูตร</label>
		                                    <input title="หลักสูตร" placeholder="ระบุหลักสูตร" class="form-control training" type="text" name="training[older_care_training_course][<?php echo $key_training?>]" value="<?php echo $value_training['older_care_training_course'];?>" />
		                                  </div>
		                                  <div class="col-xs-12 col-sm-1">
		                                    <button type="button" class="btn btn-default" style="margin-top: 24px;" onclick="btDel_trainer_members(this,<?php echo $value_training['train_id'];?>);" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
		                                  </div>
		                                </div>
	                        		<?php } ?>
	                        	<?php } ?>
	                        </div>

	                        <div class="row">

	                          <div class="col-xs-12">
	                            <button type="button" class="btn btn-default" id="btAdd_training"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อมูลรายการอบรม</button> (เฉพาะเคยได้รับการอบรม)
	                          </div>
	                        </div>

							<hr>

							<div class='form-group row'>
								<div class="col-xs-12">
									<div class="tab-panel-heading">
	                            		<h3>สถานะการพ้นจากการเป็นอาสาสมัครดูแลผู้สูงอายุ</h3>

									</div>
	                        	</div>
	                            <div class="col-xs-12 col-sm-3">
	                              <label for="quit_date" class="col-2 col-form-label"> วันที่พ้นจากการเป็นอาสาสมัคร </label>
	                              <div id="quit_date" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
	                                <input id='date_of_resign' title="วันที่พ้นจากการเป็นอาสาสมัคร" placeholder="เลือกวันที่" class="form-control" type="text" name='volt_info[date_of_resign]' value="<?php echo $volt_info['date_of_resign']?>">
	                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	                              </div>

	                            </div>
	                            <div class="col-xs-12 col-sm-3">
	                              <label for="" class="col-2 col-form-label">สาเหตุที่พ้นจากการเป็นอาสาสมัคร</label>
	                              <select id='resign_reason_choices' class="form-control" title="สาเหตุที่พ้นจากการเป็นอาสาสมัคร">
	                                <option disabled selected>เลือกสาเหตุ</option>
	                                <option value="ลาออก">ลาออก</option>
	                                <option value="เข้าสู่วัยผู้สูงอายุ">เข้าสู่วัยผู้สูงอายุ</option>
	                                <option value="เสียชีวิต">เสียชีวิต</option>
	                                <option value="">อื่นๆ</option>
	                              </select>
	                            </div>
	                            <div class="col-xs-12 col-sm-3" style='display:none;'>
	                              <label for="" class="col-2 col-form-label">&nbsp;</label>
	                              <input id='resign_reason' class='form-control' type="text" placeholder="อื่นๆ(โปรดระบุ)" name='volt_info[resign_reason]' value='<?php echo $volt_info['resign_reason'];?>' />
	                            </div>
	                        </div>

							<hr>
				            <div class="row">
				                <div class="col-xs-12 col-sm-8">&nbsp;</div>
				                <div class="col-xs-12 col-sm-2">
				                  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
				                </div>
				                <div class="col-xs-12 col-sm-2">
				                  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('volunteer/volunteer_list');?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
				                </div>
				            </div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_marker" role="dialog">
	<div class="modal-dialog modal-lg">

	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header" style="background-color: rgb(56,145,209);color: white;">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title"><i class="fa fa-map-marker" aria-hidden="true"></i> ค้นหาสถานที่</h4>
	    </div>
	    <div class="modal-body">
	      <form name="form_search" method="post" action="">
	        <b>ชื่อสถานที่</b>
	        <div class="row">
	          <div class="col-xs-12 col-sm-10">
	            <input name="namePlace" class="form-control" size="70" type="text" id="namePlace" size="30" />
	            <input type="hidden" name="address" id="namePlace2">
	          </div>
	          <div class="col-xs-12 col-sm-2">
	            <a href="javascript:void(0);" class="btn btn-default btn-search" style="width: 100%; margin-top: 0px; color:#fff" name="SearchPlace" id="SearchPlace" value="ค้นหา"><i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา
	                    </a>
	          </div>
	        </div>
	      </form>
	      <hr />
	      <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">
	        <div class="row">
	          <div class="col-xs-6 col-sm-5">
	            ละติจูด
	            <input class="form-control" name="lat_value" type="text" id="lat_value" value="" size="20" readonly />
	          </div>
	          <div class="col-xs-6 col-sm-5">
	            ลองจิจูด
	            <input class="form-control" name="lon_value" type="text" id="lon_value" value="" size="20" readonly />
	          </div>
	          <div class="col-xs-12 col-sm-2">
	            <a href="#" class="btn btn-default btn-save" style="margin-top: 22px; width: 100%; color:#fff" name="button" id="button" onclick="select_location();" value="บันทึก"><i style='font-size:14px;' class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
	                    </a>
	          </div>
	        </div>
	      </form>
	      <div class="row">
	        <div class="col-xs-12 col-sm-12">
	          <!-- show map -->
	          <div id="map_canvas" style="width:100%;height:400px;margin:auto;margin-top:10px;"></div>
	        </div>
	      </div>
	    </div>
	    <!--
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	      -->
	  </div>

	</div>
</div>
<!-- END modal_marker -->

<!-- Confirm Save Form  Modal -->
<div id="sbmCnfrm" class="modal fade" role="dialog">
	<div class="modal-dialog">
	  <!-- Modal content-->
	  <div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
	    </div>
	    <div class="modal-body">
	      <?php $str = getMsg('054');?>
	        <p>
	          <?php echo $str;?>
	        </p>
	        <!--<p>ยืนยันการลบ?</p>-->
	    </div>
	    <div class="modal-footer">
	      <button id="savbtnYes" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
	      <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
	    </div>
	  </div>
	</div>
</div>
<!-- End Confirm Save Form  Modal -->

<!-- training_members_template-->
<div class="training_template" hidden='hidden'>
	<div class="row training_template_list">
	  <div class="col-xs-12 col-sm-3">
	    <label for="datetimepicker_trn_listID" class="col-2 col-form-label">วันที่ได้รับการอบรม</label>
	    <div id="datetimepicker_trn_listID" class="col-10 input-group date" data-date-format="dd-mm-yyyy">
	      <input title="วันที่ได้รับการอบรม" placeholder="เลือกวันที่" class="form-control training" type="text" name="training[date_of_training][listID]" disabled />
	      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	    </div>
	  </div>
	  <div class="col-xs-12 col-sm-3">
	    <label for="" class="col-2 col-form-label">จากหน่วยงาน</label>
	    <input title="จากหน่วยงาน" placeholder="จากหน่วยงาน" class="form-control training" type="text" name="training[older_care_training_org][listID]" disabled />
	  </div>
	  <div class="col-xs-12 col-sm-3">
	    <label for="" class="col-2 col-form-label">หลักสูตร</label>
	    <input title="หลักสูตร" placeholder="ระบุหลักสูตร" class="form-control training" type="text" name="training[older_care_training_course][listID]" disabled />
	  </div>
	  <div class="col-xs-12 col-sm-1">
	    <button type="button" class="btn btn-default" style="margin-top: 24px;" onclick="btDel_trainer_members(this,'');" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
	  </div>
	</div>
</div>
<!-- close training_members_template-->



<script type="text/javascript">
	//Variable Fix required
	var APP_ENV = $('#app_env').val();

	//Declear Info Reader PID
    var pers_authen = JSON.parse('<?php echo json_encode(get_session("pers_authen"));?>');
	var user_id = $('#user_id').val();
    var org_id = $('#org_id').val();
    var reader_status = false;
    var authen_log_id = 0;
    // var authen_log_id = 1; //Fix for dev
    //End Declear Info Reader PID
    var csrf_hash = $('#csrf_hash').val();

	//Chcek Authen pid
	// var bt_spid = "#bt_req_pid";
	// var inputpid = "#req_pid";
	// var setData = "reqData"; //Declear Name

	//Fix function get data from PID
	// var reqData = function(value) { //Set Structure Display Data
	// 	req_pers = value;

	// 	$("#name").html(value.name);
	// 	$("#date_of_birth").html(value.date_of_birth);
	// 	$("#gender_name").html(value.gender_name);
	// 	$("#nation_name_th").html(value.nation_name_th);
	// 	// $("#relg_title").html(value.relg_title);
	// 	$('#pid_id').val(varCard);
	// 	$("#pers_id").val(value.pers_id);
	// 	$("#reg_addr_id").val(req_pers.reg_addr_id);
	// 	$("#req_reg_addr").text(value.reg_add_info);

	// 	// $('#addr_code').text(req_pers.reg_addr.addr_code);
	// 	// $('#gps_addr').text(req_pers.reg_addr.addr_gps);

	// 	check_volt_duplicate(value.pers_id, value.name); //Check Duplicate
	// }

	//Map
	var latitude = $('#addr_gps').attr('data-lat');
    var longitude = $('#addr_gps').attr('data-long');
    var marker_img = $('#marker_img').val();

    //date_of_reg
    var date_of_reg = '';
   	var quit_date = '';

   	//training
   	var num_list_trn = $('.training_members .training_template_list').length;
    var template_trn = $('.training_template').clone();

    $(function() {

    	if(APP_ENV != 'production'){
    		authen_log_id = 1; //Fix for dev
    	}

    	//Section Process Insert/Update
    	if($('#volt_id').val() == ''){

    		date_of_reg = new Date();
    		quit_date = new Date();
    	}else{
    		date_of_reg = new Date( $('#volt_info_date_of_reg').val() );
    		quit_date = new Date( $('#date_of_resign').val() );

    		//Update Address
			optionGen( document.getElementById("Province") ,'Amphur' );

    	}



    	// ###################
    	//Chcek Authen pid
    	// ###################

    	// $(bt_spid).click(function() { //On Click for Search
		// 	if ($(inputpid).val() != '') { //pid not null

		// 	  $(bt_spid).attr('disabled', true);

		// 	  if (pers_authen != null) { //Check Personal Authen
		// 	    // getPersInfo(inputpid, bt_spid, setData); //Get Data
		// 	    getPersInfo(inputpid , bt_spid ,setData, true); //Get Data

		// 	  } else if (!reader_status) { //Run Reader Personal
		// 	    run_readerPers();
		// 	    $(bt_spid).attr('disabled', false);
		// 	    toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก", "Authentications");
		// 	  }

		// 	} else { //pid is null
		// 	  $(inputpid).select();
		// 	}
		// });

    	// ##########
		// Map
    	// ##########
    	//latitude , longitude Fix Spec variable

		$("#lat_value").val(latitude); // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
        $("#lon_value").val(longitude); // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value


    	// ############
    	// #date_of_reg
    	// ############


		$("#date_of_reg").datepicker({
			autoclose: true,
			todayHighlight: true,
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',
			thaiyear: true
		}).datepicker("setDate", date_of_reg );


		// ############
    	// #quit_date
    	// ############

		$("#quit_date").datepicker({
			autoclose: true,
			todayHighlight: true,
			format: 'dd/mm/yyyy',
			todayBtn: true,
			language: 'th',
			thaiyear: true,
			clearBtn: true
		}).datepicker("setDate", quit_date );




		// ############
		// #pre_addr_id
		// ############
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
			increaseArea: '20%'
		});

		
		$("input[name='volt_addr_chk']").on('ifClicked', function(event) {			
			 //$('.volunteer-address').slideToggle();
			
			if(!$(this).prop("checked")){
				showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');
				let tokenRequest = $('#currtoken').val();
				//console.log(tokenRequest)
				$.ajax({
					type: "POST",
					url: base_url+"/adaptenvir/getAddress/",
					data: {req_pid : $('#pid_id').val(),tokenId : tokenRequest,csrf_dop : csrf_hash},
					success: function(dataAdderss){							
						if (dataAdderss['Code'] == 90001) { 
							closeloadswal();	
							toastr.error("โปรดตรวจสอบการเชื่อมต่อ", "หน้าต่างแจ้งเตือน");  
							
						}else{
							var province = dataAdderss.provinceDesc;
							var amphur = dataAdderss.districtDesc;
							var tambol = dataAdderss.subdistrictDesc;
							
							$.ajax({
							type: "POST",
							url: base_url+"/adaptenvir/getarea/",
							data: {province_name : province,amphur_name : amphur,tambol_name : tambol,csrf_dop : csrf_hash},
							success: function(dataArea){
								closeloadswal();
								//console.log('>>>>>>>>',dataArea)					
								$('input[name="impv_addr[addr_province]"]').val(dataArea.province_code);		
								$('input[name="impv_addr[addr_district]"]').val(dataArea.amphur_code);
								$('input[name="impv_addr[addr_sub_district]"]').val(dataArea.tambol_code);		
								
								$('#Province').val(dataArea.province_code);	
								$('input[name="pers_addr[addr_province]"]').val(dataArea.province_code);	
								$('#addrProvince').attr(dataArea.province_code);	

								$('#Amphur').val(dataArea.amphur_code);
								$('input[name="pers_addr[addr_district]"]').val(dataArea.amphur_code);
								$('#addrAmphur').attr(dataArea.amphur_code);

								$('#Tambon').val(dataArea.tambol_code);	
								$('input[name="pers_addr[addr_sub_district]"]').val(dataArea.tambol_code);	
								$('#addrTambol').attr(dataArea.tambol_code);

							},
							dataType: "json",
							});
										
							$('#select2-Province-container').text(dataAdderss.provinceDesc);	
							$("#select2-Amphur-container").text(dataAdderss.districtDesc);	
							$("#select2-Tambon-container").text(dataAdderss.subdistrictDesc);
							$('input[name="addr_moo_id"]').val(dataAdderss.villageNo);
							$('input[name="addr_home_id"]').val(dataAdderss.houseNo);

							$('#addr_home_no').val(dataAdderss.houseNo);  
							$('#addr_moo').val(dataAdderss.villageNo);                                                
								
							$('input[name="impv_addr[addr_home_no]"]').val(dataAdderss.houseNo);
							$('input[name="impv_addr[addr_moo]"]').val(dataAdderss.villageNo);
							$('input[name="impv_addr[addr_lane]"]').val('');
							$('input[name="impv_addr[addr_alley]"]').val('');
							$('input[name="impv_addr[addr_road]"]').val('');
						}
					},error: function(err) {
						closeloadswal();  
						toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");  
					},
					dataType: "json",
				});

				$(".elder_addr_pre").attr('disabled', true);
			}else{
				$(".elder_addr_pre").attr('disabled', false);
			}
		});

		//Case update
		if($("input[name='impv_addr[addr_home_no]']").val() == $("input[name='pers_addr[addr_home_no]']").val() 
		&& $("input[name='impv_addr[addr_home_no]']").val() != 0 
		&& $("input[name='pers_addr[addr_home_no]").val() ){
			$("input[name='volt_addr_chk']").iCheck('check');
			
		}



		$('#volt_info_village_position-009').on('ifClicked', function() {
			set_enable( this , '#vpos-009' );
		});

		// #########
		// #training
		// #########

		if(num_list_trn != 0){
			$(".datetimepicker_trn").datepicker({
				autoclose: true,
				todayHighlight: true,
				format: 'dd/mm/yyyy',
				todayBtn: true,
				language: 'th',
				thaiyear: true
			});
		}

		$("#btAdd_training").click(function() { //Add
			addTrnMember();
		});

		$("input[name='volt_info[older_care_training]']").on('ifChecked', function() {
			// $('.training_members').slideToggle();
			if ($(this).val() == 'เคยได้รับการอบรม') {
				$('.training_members').slideDown();
			  	$(".training").prop('disabled', false);
			} else {
			  	$('.training_members').slideUp();
			  	$(".training").prop('disabled', true);
			}
		});


		// ###############
		// # resign_reason
		// ###############
		$('#resign_reason_choices').change(function() {
          $('#resign_reason').val($(this).val()).parent()[$(this).val() == '' ? 'show' : 'hide']();
        });
        var reason = $('#resign_reason').val();
        if (reason && !$('#resign_reason_choices').val(reason).val()) {
          $('#resign_reason_choices option:last').attr('selected', 'selected');
          $('#resign_reason').val(reason).parent().show();
        }


		// ###############
		// # occupation
		// ###############
		$('#jobDefault, #jobEtc').change(function() {
			$('#jobEtc').prop('disabled', $('#jobDefault').val() !== 'etc');
			if ($('#jobDefault').val() !== 'etc')
				$('#jobEtc').val('');
			$('#jobValue').val($('#job' + ($('#jobDefault').val() !== 'etc' ? 'Default' : 'Etc')).val());
		});

    });

	function check_volt_duplicate(pers_id , pers_fullname){
		var dataAjax = {};
	    	dataAjax[$('#csrf_name').val()] = $('#csrf_hash').val();
	    	dataAjax['pers_id'] = pers_id;

		$.ajax({
			url: base_url + 'volunteer/info/check_volt_duplicate',
			type: 'POST',
			dataType: 'json',
			data: dataAjax,
			success: function(result) {
	        	console.log(result);
	        	if(result.is_duplicate == 1){
	        		alert('พบข้อมูล' + pers_fullname + ' เป็นอาสาสมัครแล้ว');
	        	}
	        },
	        error: function() {
	          alert('ไม่สามารถตรวจสอบข้อมูลอาสาสมัครได้ กรุณาลองใหม่');
	        }
		});
	}

	function addTrnMember() {
		if (!$("input[name='volt_info[older_care_training]']").prop("checked")) {

		  var cloneTmp0 = template_trn.html().replace(new RegExp("listID", 'g'), num_list_trn);
		  $(cloneTmp0).appendTo('.training_members');
		  $(".training").prop('disabled', false);

		  $("#datetimepicker_trn_"+num_list_trn).datepicker({
	          autoclose: true,
	          todayHighlight: true,
	          format: 'dd/mm/yyyy',
	          todayBtn: true,
	          language: 'th',
	          thaiyear: true
	        }).datepicker("setDate", new Date() );

		  num_list_trn = num_list_trn + 1;

		}
	}

	function btDel_trainer_members(node, train_id) {
	    if (train_id != "") {
	    	var dataAjax = {};
	    	dataAjax[$('#csrf_name').val()] = $('#csrf_hash').val();
	    	dataAjax['train_id'] = train_id;

	      $.ajax({
	        url: base_url + 'volunteer/del_train',
	        type: 'POST',
	        dataType: 'html',
	        data: dataAjax,
	        success: function(result) {
	          $(node).parents('.training_template_list').remove();
	        },
	        error: function() {
	          alert('ไม่สามารถลบประวัติการอบรมได้ กรุณาลองใหม่');
	        }
	      });
	    } else {
	      $(node).parent().parent().remove();
	    }
    }

	function set_enable(elem, target = '') {
		if (!$(elem).prop('checked')) {
			$(target).prop('disabled', false).focus();
		} else {
			$(target).val('');
			$(target).prop('disabled', true);
		}
    }

    function optionGen(code, target, opSelect = '') {
	    // alert(code.value);
	    // alert(target);
    	var dataAjax = {};
    	dataAjax[$('#csrf_name').val()] = $('#csrf_hash').val();
    	dataAjax['code'] =  code.value;
    	dataAjax['type'] =  target;

    	if(code.value == ''){
    		return ;
    	}

		$.ajax({
			url: base_url + 'personals/get_Area_option',
			type: 'POST',
			dataType: 'json',
			data: dataAjax
		})
		.done(function(ret) {

			// console.log("success");
			// console.dir(ret);

			$('#' + target).empty();
			$('#' + target).prop('disabled', false);

			if (target == 'Amphur') {
				str = "เลือกอำเภอ";
			} else if (target == 'Tambon') {
				str = "เลือกตำบล";
			}
			$('#' + target).append($('<option>', {
				value: '',
				text: str
			}));
			for (var i = 0; i < ret.length; i++) {
				// if(ret[i].area_code == opSelect){
				$('#' + target).append($('<option>', {
					value: ret[i].area_code,
				  	text: ret[i].area_name_th
				}));
				// }else{
				//   $('#'+target).append($('<option>', {
				//     value: ret[i].area_code,
				//     text : ret[i].area_name_th
				//   }));
				// }
			}

			if($('#' + target).attr('value') != '' ){ //case update
				$('#' + target).val($('#' + target).attr('value')).trigger('change');
				// $('#' + target).select2('val', opSelect, false)
			}
		})
		.fail(function() {
			console.log("error");
		});
    }

	function genLAOption(tambon) {
		var district = $(tambon).parent().find('.select2-selection__rendered').text();
		var amphur = $(tambon).parents('.dropdown').prev().find('.select2-selection__rendered').text();
		opts = localAdmins.filter(la => la.la_org_district === district && la.la_org_city === amphur);
		$('#LocalAdmin')
			.empty()
			.prop('disabled', false)
			.append($('<option>', {
				value: '',
				text: 'เลือก อปท.'
			}));
		for (var i = 0; i < opts.length; i++) {
			$('#LocalAdmin').append($('<option>', {
				value: opts[i].la_org_id,
				text: opts[i].la_org_title
			}));
		}
		if($('#LocalAdmin').attr('value') != '' ) {
			$('#LocalAdmin').val($('#LocalAdmin').attr('value')).trigger('change');
		}
	}


	function cardInfo(){
    //alert('ddd');
	showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');

    $.ajax({  
                    type: 'GET',
                    crossDomain: true,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    // data: param_service,
                    url: 'http://localhost:9000/api/Values',
                    success: function(data_service) {
                      //console.log(data_service)                       
					  	var data = data_service.personal;                       
                		if(data_service.result == false){
							closeloadswal();
                          	toastr.error("บัตรประชาชนต้องเสียบอยู่กับเครื่องอ่านบัตร", "กรุณาตรวจสอบ");
                        }else{
                          var varCard = data.Citizenid;
                          var res1 = varCard.substring(0, 1);
                          var res2 = varCard.substring(1, 5);
                          var res3 = varCard.substring(5, 10);
                          var res4 = varCard.substring(10, 12);
                          var res5 = varCard.substring(12, 13);

                        
                          var houseNo = data.addrVillageNo.replace("หมู่ที่ ","");
                          $('#req_pid').val(res1+'-'+res2+'-'+res3+'-'+res4+'-'+res5);
                          $('#pid_id').val(varCard);
                          
                          $('#name').html(data.Th_Firstname+' '+data.Th_Lastname);
                          //10 สิงหาคม 2534 (อายุ 29 ปี)
                          var varBirthday = data.Birthday;
						  var bd1 = varBirthday.substring(0, 2);
						  var bd2 = varBirthday.substring(3, 5);
						  var bd3 = varBirthday.substring(6, 10);
						  var varBD = (bd3-543)+'-'+bd2+'-'+bd1;
						  var varBDText = bd3+'-'+bd2+'-'+bd1;
                          $.ajax({
                            type: "POST",
                            url: base_url+"/adaptenvir/getBirthday/",
                            data: {birthday : varBDText,csrf_dop : csrf_hash},
                            success: function(data){

                              $('#date_of_birth_text').html(data); 
                              
                            },
                            dataType: "json",
                          });
                        
                          //$('#date_of_birth_text').html((bd1-543)+'-'+bd2+'-'+bd3);
                          // $('#gender_name').html(data.Sex);                        

                          if(data.Sex =='0'){
                            $('#gender_name').html("ไม่ทราบ");
                          }else if(data.Sex =='1'){
                            $('#gender_name').html("ชาย");
                          }else if(data.Sex =='2'){
                            $('#gender_name').html("หญิง");
                          }else if(data.Sex =='9'){
                            $('#gender_name').html("ไม่สามารถระบุได้");
                          }else{
                            $('#gender_name').html("-");
                          }                        
                          $('#reg_addr').html(data.Address);
                                                
                          $('#pers_firstname_th').val(data.Th_Firstname);
                          $('#pers_lastname_th').val(data.Th_Lastname);
                          $('#gender_code').val(data.Sex);
                          // $('#pid').val(varCard);
                          $('input[name="impv_addr[addr_moo]"]').val(houseNo);
                          $('#date_of_birth').val(varBD);                      
                          $('#addrProvince').attr(data.addrProvince);
                          $('#addrAmphur').attr(data.addrAmphur);
                          $('#addrTambol').attr(data.addrTambol);
                          
                          var province = data.addrProvince.replace("จังหวัด","");
                          var amphur = data.addrAmphur.replace("อำเภอ","");
                          var tambol = data.addrTambol.replace("ตำบล","");
            
                          $.ajax({
                            type: "POST",
                            url: base_url+"/adaptenvir/getarea/",
                            data: {province_name : province,amphur_name : amphur,tambol_name : tambol,csrf_dop : csrf_hash},
                            success: function(data){
							 // console.log(data)  
							  closeloadswal();							
                              $('input[name="impv_addr[addr_province]"]').val(data.province_code);		
                              $('input[name="impv_addr[addr_district]"]').val(data.amphur_code);
                              $('input[name="impv_addr[addr_sub_district]"]').val(data.tambol_code);		
                              
                            },
                            dataType: "json",
                          });

                          var houseNo = data.addrVillageNo.replace("หมู่ที่ ","");
                          $('input[name="impv_addr[addr_home_no]"]').val(data.addrHouseNo);
                          $('input[name="impv_addr[addr_moo]"]').val(houseNo);
                          $('input[name="impv_addr[addr_lane]"]').val(data.addrRoad);
                          $('input[name="impv_addr[addr_alley]"]').val('');
                          $('input[name="impv_addr[addr_road]"]').val('');
                        }  
                    },
                    error: function(err) {
						closeloadswal();
                      toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");
                      //$('.modal').modal('hide');
                      //$('#linkage-loade-'+key).html('<i class="fas fa-download"></i>');
                     //  var text = 'กรุณาตรวจสอบ ' + '\n' + '- เครื่องอ่านบัตรต้องเชื่อมต่อ กับ คอมพิวเตอร์ ' + '\n' + '- ต้องมีบัตรประชาชน เสียบอยู่กับเครื่องอ่านบัตร' + '\n' + '- ตรวจสอบว่าโปรแกรม Linkage Service เปิดใช้งานอยู่';
                      //  $("#exampleModalLinkage").modal();
                        

                    }
    });
}

function bt_req_pid(){

var pid_id = $('#req_pid').val();
var reqId = pid_id.replaceAll("-","");
$('#pid_id').val(reqId); 
showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');
$.ajax({  
				type: 'GET',
				crossDomain: true,
				contentType: "application/json; charset=utf-8",
				dataType: "json",
				// data: param_service,
				url: base_url+"/adaptenvir/getTokenID/",
				success: function(data_token) {
					//console.log(data_token)                       
				$.ajax({
                    type: "POST",
                    url: base_url+"volunteer/getDataDead/",
                    data: {req_id : reqId,csrf_dop : csrf_hash},
                    success: function(data){ 
	                    // console.log(data)        
	                    if (!!data) {  
	                       closeloadswal();
	                       toastr.error("เลขบัตรประจำตัวประชาชนนี้ เคยสมัครดูแลผู้สูงอายุแล้ว", "หน้าต่างแจ้งเตือน");
	                    }  

						$.ajax({
						  type: "POST",
						  url: base_url+"/adaptenvir/getDataPid/",
						  data: { req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
						  success: function(data){
							//console.log(data)
							if ($('#req_pid').val() == "_-____-_____-__-_" || $('#req_pid').val() == "") { 
								closeloadswal();
							  toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");   
							
							}else { 

							  if (!!data.firstName && !!data.lastName) {                               
							   
								var varBD = data.dateOfBirth.toString();
								// var res = varCard.split("");
								var res1 = varBD.substring(0, 4);
								var res2 = varBD.substring(4, 6);
								var res3 = varBD.substring(6, 8);
								//1960-08-07
								var varBirthday = (res1-543)+'-'+res2+'-'+res3
								var varBirthdayText = res1+'-'+res2+'-'+res3
								//console.log('>>>>>>>>',varBirthday)
								$.ajax({
								  type: "POST",
								  url: base_url+"/adaptenvir/getBirthday/",
								  data: {birthday : varBirthdayText,csrf_dop : csrf_hash},
								  success: function(data){

									$('#date_of_birth_text').html(data); 
									
								  },
								  dataType: "json",
								});

								var titleName = data.titleName
								$.ajax({
									type: "POST",
									url: base_url+"/adaptenvir/getTitleName/",
									data: {title_name : titleName,csrf_dop : csrf_hash},
									success: function(data){                                    
									$('#pren_code').val(data.pren_code);  
									$('#pren_name').val(data.prename_th);                                     
									},
									dataType: "json",
								});
								
								$('#name').html(data.titleName+' '+data.firstName+' '+data.lastName);                              
								//$('#req_date_of_birth').html(data.dateOfBirth);
								$('#gender_name').html(data.genderDesc);            
								$('#pers_firstname_th').val(data.firstName);
								$('#pers_lastname_th').val(data.lastName);
								$('#gender_code').val(data.genderCode);
							   // $('#date_of_birth').val(data.dateOfBirth);     
								$('#date_of_birth').val(varBirthday);    
								$.ajax({
								  type: "POST",
								  url: base_url+"/adaptenvir/getAddress/",
								  // data: {req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
								  data: { req_pid : $('#req_pid').val(),tokenId : data_token,csrf_dop : csrf_hash},
								  success: function(dataAdderss){
									//console.log(dataAdderss)
								  var addressname = dataAdderss.houseNo +' หมู่ที่ '+dataAdderss.villageNo +' '+' ตำบล'+dataAdderss.subdistrictDesc +' '+' อำเภอ'+dataAdderss.districtDesc +' '+' จังหวัด'+dataAdderss.provinceDesc;
									$('#reg_addr').html(addressname);

				

								  $('input[name="impv_addr[addr_moo]"]').val(dataAdderss.villageNo);
								  $('input[name="impv_addr[addr_home_no]"]').val(dataAdderss.houseNo);
								  $('input[name="impv_addr[addr_lane]"]').val(dataAdderss.roadDesc);
								  $('input[name="impv_addr[addr_alley]"]').val('');
								  $('input[name="impv_addr[addr_road]"]').val('');
			   
									var province = dataAdderss.provinceDesc.replace("จังหวัด","");
								  var amphur = dataAdderss.districtDesc.replace("อำเภอ","");
								  var tambol = dataAdderss.subdistrictDesc.replace("ตำบล","");
								  
								  $.ajax({
									type: "POST",
									url: base_url+"/adaptenvir/getarea/",
									data: {province_name : province,amphur_name : amphur,tambol_name : tambol,csrf_dop : csrf_hash},
									success: function(dataArea){
										closeloadswal();
									 // console.log('>>>>>>>>',dataArea)					
									  $('input[name="impv_addr[addr_province]"]').val(dataArea.province_code);		
									  $('input[name="impv_addr[addr_district]"]').val(dataArea.amphur_code);
									  $('input[name="impv_addr[addr_sub_district]"]').val(dataArea.tambol_code);		
									  
									},
									dataType: "json",
								  });
								  },
								  dataType: "json",
								}); 
							  }
							  else{
								closeloadswal();
								toastr.error("ไม่พบข้อมูล", "หน้าต่างแจ้งเตือน");  
														   
						   
							  }
															  
							
							}  
						   
						  },
						  error: function(err) {
							closeloadswal();
							toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");
						  
						  }
						});
					  
					},
				    error: function(err) {
				      closeloadswal();
				      toastr.error("เลขบัตรประจำตัวประชาชนนี้ เคยเคยสมัครดูแลผู้สูงอายุแล้ว", "หน้าต่างแจ้งเตือน");

				    }
				});   

					

				},
				error: function(err) {
					closeloadswal();
				  console.log(err)
				  //var text = 'ไม่พบข้อมูล';
				  //token
				  toastr.error("ไม่พบข้อมูล", "หน้าต่างแจ้งเตือน");
				 
				}
});

} 


</script>
<script src="https://center.dop.go.th/assets/js/loading_popup.js"></script>