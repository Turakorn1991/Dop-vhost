<?php 

    if(empty($value_elderly)){
        $care_store_status = 'create';
    }else{
        $care_store_status = 'update';
    }
?>
<div class="family_members_items panel-group hide value_elderly_section_<?php echo $key_elderly; ?>" style="margin-top: -10px;">

	<div class="panel panel-default" style="border: 0">
		<div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
			<!-- <div class="row text-right">
            	<button type="button" class="btn btn-default" onclick="btDel_family_members(this,<?php //echo $value_elderly['care_id']; ?>);" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
            </div> -->
            <input type="hidden" name="elderly_care[care_store_status][<?php echo $key_elderly; ?>]" value="<?php echo $care_store_status; ?>">
            <input type="hidden" name="elderly_care[care_id][<?php echo $key_elderly; ?>]" value="<?php echo $value_elderly['care_id']; ?>">

            <div class="form-group row">
            	<div class="col-xs-12 col-sm-3">
					<label class="col-2 col-form-label">เลขบัตรประจำตัวประชาชน</label>
					<div class="input-group">

						<input title="เลขบัตรประจำตัวประชาชน" placeholder="เลขบัตรประจำตัวประชาชน (13 หลัก)" class="form-control input-pid input_idcard" type="text" id="pid_<?php echo $key_elderly; ?>" name="elderly_care[pid][<?php echo $key_elderly; ?>]" value="<?php echo $value_elderly['pid']; ?>" <?php echo ($care_store_status == 'update' ? 'disabled' : '') ?> />
						<input type="hidden" name="elderly_care[pers_id][<?php echo $key_elderly; ?>]" class="elderly_care_pers_id" value="<?php echo $value_elderly['pers_id']; ?>" >

						<div class="input-group-btn">
							<button title="ตรวจสอบ" type="button" class="btn btn-default btn-check-pid" id="bt_pid_<?php echo $key_elderly; ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-3">
					<label class="col-2 col-form-label">(คำนำหน้า) ชื่อตัว-ชื่อสกุล</label>
					<input title="(คำนำหน้า) ชื่อตัว-ชื่อสกุล" placeholder="ระบุ (คำนำหน้า) ชื่อตัว-ชื่อสกุล" value="<?php echo $value_elderly['prename_th'].' '.$value_elderly['pers_firstname_th'].' '.$value_elderly['pers_lastname_th']; ?>" class="form-control elderly_care_fullname" type="text"
					name="elderly_care[fullname][<?php echo $key_elderly; ?>]" <?php echo ($care_store_status == 'update' ? 'disabled' : '') ?> />
				</div>

				<?php
					$age="";
					$date = new DateTime($value_elderly['date_of_birth']);
					$now = new DateTime();
					$interval = $now->diff($date);
					$age = $interval->y;

				?>

				<div class="col-xs-12 col-sm-2">
					<label class="col-2 col-form-label">อายุ (ปี)</label>
					<input title="อายุ" placeholder="ระบุอายุ (ปี)" class="form-control elderly_care_age" type="text" name="" value="<?php echo $age; ?>" disabled/>
				</div>

				<div class="col-xs-12 col-sm-2">
                	<label class="col-2 col-form-label">การดูแล (ครั้ง/สัปดาห์/เดือน)</label>

                	<input title="การดูแล (ครั้ง/สัปดาห์/เดือน)" placeholder="ระบุการดูแล (ครั้ง)" class="form-control" value="<?php echo $value_elderly['care_freq']?>" type="text" name="elderly_care[care_freq][<?php echo $key_elderly; ?>]" />

              	</div>

              	<div class="col-xs-12 col-sm-2">
                    <label class="col-2 col-form-label">&nbsp;</label>

                    <select class="form-control" name="elderly_care[care_freq_per][<?php echo $key_elderly; ?>]" title="การดูแล (ต่อสัปดาห์ หรือเดือน)">

                      <option value="สัปดาห์" <?php if($value_elderly['care_freq_per']=="สัปดาห์" ) { echo "selected"; }?> >สัปดาห์</option>
                      <option value="เดือน" <?php if($value_elderly['care_freq_per']=="เดือน" ) { echo "selected"; }?> >เดือน</option>
                    </select>
                </div>

            </div>
            <div class="form-group row">
				<div class="col-xs-12 col-sm-3">
					<label class="col-2 col-form-label">ปัญหาสุขภาพ</label>
					<div class="checkbox-inline i-checks">
						<label style="font-weight: normal">

							<input type="radio" class="elderly_care_healthy" name="elderly_care[healthy][<?php echo $key_elderly;?>]" value="ปกติ" <?php if($value_elderly['care_health_problems']=="ปกติ" ) {?>checked

						<?php }?>> ปกติ
						</label>
					</div>
					<div class="checkbox-inline i-checks">
						<label style="font-weight: normal">

							<input type="radio" class="elderly_care_healthy" name="elderly_care[healthy][<?php echo $key_elderly;?>]" value="ป่วยเรื้อรัง" <?php if($value_elderly['care_health_problems']=="ป่วยเรื้อรัง" ) {?>checked

							<?php }?>> ป่วยเรื้อรัง
						</label>
					</div>
					<div class="checkbox-inline i-checks">
						<label style="font-weight: normal">

							<input type="radio" class="elderly_care_healthy" name="elderly_care[healthy][<?php echo $key_elderly;?>]" value="พิการ" <?php if($value_elderly['care_health_problems']=="พิการ" ) {?>checked

							<?php }?>> พิการ
						</label>
					</div>
				</div>

				<div class="col-xs-12 col-sm-3">
					<label class="col-2 col-form-label">ช่วยเหลือตนเอง</label>
					<div class="checkbox-inline i-checks">
						<label style="font-weight: normal">

							<input type="radio" class="elderly_care_healthy_self_help" name="elderly_care[healthy_self_help][<?php echo $key_elderly;?>]" value="ได้" <?php if($value_elderly['care_help_yourself']=="ได้" ) {?>checked

							<?php }?>> ได้
						</label>
					</div>
					<div class="checkbox-inline i-checks">
						<label style="font-weight: normal">

							<input type="radio" class="elderly_care_healthy_self_help" name="elderly_care[healthy_self_help][<?php echo $key_elderly;?>]" value="ไม่ได้" <?php if($value_elderly['care_help_yourself']=="ไม่ได้" ) {?>checked

							<?php }?>> ไม่ได้
						</label>
					</div>
                </div>

                <div class="col-xs-12 col-sm-3">
                  <label class="col-2 col-form-label">สาเหตุการพ้นการดูแล</label>
                  	<?php
                    foreach($cause_of_cares as $key_cause_of_care => $cause_of_care) {
                    ?>
                    <div class="checkbox-inline i-checks">
                      <label style="font-weight: normal">

                        <input type="radio" class="care_cause_code" data-index=<?php echo $key_elderly;?> name="elderly_care[care_cause_code][

                        <?php echo $key_elderly;?>]" value="<?php echo $cause_of_care['cause_code'];?>"
                            <?php if($value_elderly['care_cause_code']==$cause_of_care['cause_code']) {?> checked <?php }?> >
                            <?php echo $cause_of_care['cause_of_care'];?>
                      </label>
                    </div>
                    <?php } ?>
                </div>

                <div class="col-xs-12 col-sm-3">

                  <input id="care_cause_ident-<?php echo $key_elderly?>" type="text" class="form-control" title="สาเหตุการพ้นการดูแลอื่น ๆ (ระบุ)" placeholder="อื่น ฯ (ระบุ)" name="elderly_care[care_cause_identify][<?php echo $key_elderly?>]" value="<?php $value_elderly['care_cause_identify'];?>"

                  <?php if($value_elderly['care_cause_code']!='002' ){?> disabled=""
                  <?php }?>>
                </div>


            </div>

            <hr>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                			<label class="col-2 col-form-label">สถานภาพ</label>
                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php foreach($marital_status as $mar_sta){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="radio" name="elderly_care[marital_status][<?php echo $key_elderly; ?>]" value="<?php echo $mar_sta;?>" <?php echo ($value_elderly['marital_status'] == $mar_sta ? 'checked' : ''); ?> >

											<?php echo $mar_sta;?>
										</label>
									</div>
									
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                			<label class="col-2 col-form-label">ระดับการศึกษา/ สูงสุด</label>
                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php foreach($edu_level as $edu_lev){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="radio" name="elderly_care[edu_code][<?php echo $key_elderly; ?>]" value="<?php echo $edu_lev['edu_code'];?>" class="elderly_care_edu_code radio-toggle-text" <?php echo ($value_elderly['edu_code'] == $edu_lev['edu_code'] ? 'checked' : ''); ?> >

											<?php echo $edu_lev['edu_title'];?>
										</label>
									</div>
									<?php if( $edu_lev['edu_code'] == '007' ){ ?>

                    				<input style="display: inline-block;min-width: 350px;width: auto;" type="text" name="elderly_care[edu_identify][<?php echo $key_elderly; ?>]" class="form-control text-toggle-disabled" placeholder="<?php echo $edu_lev['edu_title']; ?> (ระบุ)" <?php echo ($value_elderly['edu_identify'] != NULL ? 'value="'.$value_elderly['edu_identify'].'"' : 'disabled'); ?> >

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12">
            		<div class="row">
						<div class="col-xs-12 col-sm-3">
                    		<label class="col-2 col-form-label">ความสามารถพิเศษ</label>

                    		<input type="text" class="form-control" name="elderly_care[care_talent][<?php echo $key_elderly?>]" value="<?php echo $value_elderly['care_talent']; ?>">

                		</div>
            		</div>
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                			<label class="col-2 col-form-label">อาชีพหลัก</label>
                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php foreach($occupation as $occ){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="radio" name="elderly_care[occupation][<?php echo $key_elderly; ?>]" value="<?php echo $occ;?>" class="elderly_care_occupation radio-toggle-text" <?php echo ($value_elderly['occupation'] == $occ || ( $value_elderly['occupation'] != NULL && !in_array($value_elderly['occupation'], $occupation) ) ? 'checked' : ''); ?>>

											<?php echo $occ;?>
										</label>
									</div>
									<?php $specify_occ = array( "อื่นๆ" ); ?>
									<?php if(in_array($occ, $specify_occ)){ ?>

                    				<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[occupation_identify][<?php echo $key_elderly; ?>]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $occ; ?> (ระบุ)" <?php echo ($value_elderly['occupation'] != NULL && !in_array($value_elderly['occupation'], $occupation) ? 'value="'.$value_elderly['occupation'].'"' : 'disabled'); ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	

            	<div class="col-xs-12 ">
            		<label class="col-2 col-form-label">รายได้/ เงินสำหรับใช้จ่ายของผู้สูงอายุมาจาก ทางใด (เลือกได้มากกว่า 1 ข้อ)</label>
            		
            	</div>
            	<div class="col-xs-12">

					<ul class="list-unstyled" style="margin-bottom: 0;">
						<?php foreach($revenue_source as $rev_sou){ ?>
						<li>
							<div class="checkbox-inline i-checks">
								<label>

              						<input type="checkbox" name="elderly_care[care_src_of_income][<?php echo $key_elderly; ?>][]" value="<?php echo $rev_sou;?>" class="checkbox-toggle-text" <?php echo ( in_array($rev_sou, json_decode($value_elderly['care_src_of_income'] , TRUE)) ? 'checked' : ''); ?>>

									<?php echo $rev_sou;?>
								</label>
							</div>
							<?php $specify_rev_sou = array( "อื่นๆ" ); ?>
							<?php if(in_array($rev_sou, $specify_rev_sou)){ ?>

            				<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[care_src_of_income_specify][<?php echo $key_elderly; ?>]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $rev_sou; ?> (ระบุ)" <?php echo ($value_elderly['care_src_of_income_specify'] != NULL ? 'value="'.$value_elderly['care_src_of_income_specify'].'"' : 'disabled'); ?>>

							<?php } ?>
						</li>
                		
                		<?php } ?>
                		
					</ul>
            	
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12">
            		<div class="row">
						<div class="col-xs-12 col-sm-3">
                    		<label class="col-2 col-form-label">ผู้สูงอายุที่มีรายได้ มีรายได้ (บาท/เดือน)</label>

                    		<input type="text" class="form-control elderly_care_mth_avg_income" name="elderly_care[mth_avg_income][<?php echo $key_elderly; ?>]" value="<?php echo ( $value_elderly['mth_avg_income'] != NULL ? $value_elderly['mth_avg_income'] : '') ?>">

                		</div>
            		</div>
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                			<label class="col-2 col-form-label">ความสัมพันธ์ของผู้สูงอายุกับ อผส. ที่ให้การดูแล</label>
                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php foreach($relationship as $rel){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="radio" name="elderly_care[care_relationship][<?php echo $key_elderly?>]" value="<?php echo $rel;?>" class="radio-toggle-text" <?php echo ($value_elderly['care_relationship'] == $rel ? 'checked' : ''); ?> >

											<?php echo $rel;?>
										</label>
									</div>
									<?php $specify_rel = array("เป็นญาติ", "อื่นๆ" ); ?>
									<?php if(in_array($rel, $specify_rel)){ ?>

                    				<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[care_relationship_specify][<?php echo $key_elderly?>]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $rel; ?> (ระบุ)" <?php echo ( $value_elderly['care_relationship'] == $rel && $value_elderly['care_relationship_specify'] != NULL ? 'value="'.$value_elderly['care_relationship_specify'].'"' : 'disabled'); ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                    		<label class="col-2 col-form-label">กิจกรรมของชุมชนที่ผู้สูงอายุมักเข้าร่วม (เลือกได้มากกว่า 1 ข้อ)</label>

                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php 
								$care_community_activity_specify = json_decode( $value_elderly['care_community_activity_specify'], TRUE );
								$care_community_activity_specify_index = 0;
								?>

								<?php foreach($community_activity as $com_act){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="checkbox" name="elderly_care[care_community_activity][<?php echo $key_elderly?>][]" value="<?php echo $com_act;?>" class="checkbox-toggle-text" <?php echo ( in_array($com_act, json_decode($value_elderly['care_community_activity'] , TRUE) ) ? 'checked' : ''); ?> >

											<?php echo $com_act;?>
										</label>
									</div>
									<?php $specify_com_act = array("เป็นสมาชิกชมรมผู้สูงอายุ" ,"กลุ่มอาชีพต่างๆ", "อื่นๆ" ); ?>
									<?php if(in_array($com_act, $specify_com_act)){ ?>
										<?php
											 if( in_array($com_act, json_decode($value_elderly['care_community_activity'] , TRUE) ) && $care_community_activity_specify[ $care_community_activity_specify_index ] != NULL ){
											 	$care_community_activity_specify_attr =  'value="'. $care_community_activity_specify[ $care_community_activity_specify_index ].'"';
											 	$care_community_activity_specify_index++;
											 }else{
											 	$care_community_activity_specify_attr = 'disabled';
											 }
										?>
                    					<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[care_community_activity_specify][<?php echo $key_elderly?>][]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $com_act; ?> (ระบุ)" <?php echo $care_community_activity_specify_attr; ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12 ">
                	<label class="col-2 col-form-label">
                		สภาพปัญญาของผู้สูงอายุ
                		<br>
                		(ในแต่ละข้อสามารถเลือกได้มากกว่า 1 อย่างตามสภาพที่เป็นจริง)
                	</label>
                		
                </div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                    		<label class="col-2 col-form-label">1. สุขภาพกาย</label>

                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
                    			<?php 
								$care_health_issues_specify = json_decode( $value_elderly['care_health_issues_specify'], TRUE );
								$care_health_issues_specify_index = 0;
								?>
								<?php foreach($health_issues as $hea){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="checkbox" name="elderly_care[care_health_issues][<?php echo $key_elderly?>][]" value="<?php echo $hea;?>" class="checkbox-toggle-text" <?php echo ( in_array($hea, json_decode($value_elderly['care_health_issues'] , TRUE) ) ? 'checked' : ''); ?>>

											<?php echo $hea;?>
										</label>
									</div>
									<?php $specify_hea = array("เจ็บป่วยเรื้อรัง" ,"พิการ", "อื่นๆ" ); ?>
									<?php if(in_array($hea, $specify_hea)){ ?>
									<?php
										 if( in_array($hea, json_decode($value_elderly['care_health_issues'] , TRUE) ) && $care_health_issues_specify[ $care_health_issues_specify_index ] != NULL ){
										 	$care_health_issues_specify_attr =  'value="'. $care_health_issues_specify[ $care_health_issues_specify_index ].'"';
										 	$care_health_issues_specify_index++;
										 }else{
										 	$care_health_issues_specify_attr = 'disabled';
										 }
									?>

                    				<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[care_health_issues_specify][<?php echo $key_elderly?>][]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $hea; ?> (ระบุ)" <?php echo $care_health_issues_specify_attr; ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                    		<label class="col-2 col-form-label">2. สุขภาพจิต</label>

                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php foreach($mental_health_issues as $men_hea){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="checkbox" name="elderly_care[care_mental_health_issues][<?php echo $key_elderly?>][]" value="<?php echo $men_hea;?>" class="checkbox-toggle-text" <?php echo ( in_array($men_hea, json_decode($value_elderly['care_mental_health_issues'] , TRUE) ) ? 'checked' : ''); ?> >

											<?php echo $men_hea;?>
										</label>
									</div>
									<?php $specify_men_hea = array( "อื่นๆ" ); ?>
									<?php if(in_array($men_hea, $specify_men_hea)){ ?>

                    				<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[care_mental_health_issues_specify][<?php echo $key_elderly?>]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $men_hea; ?> (ระบุ)" <?php echo ($value_elderly['care_mental_health_issues_specify'] != NULL ? 'value="'.$value_elderly['care_mental_health_issues_specify'].'"' : 'disabled'); ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                    		<label class="col-2 col-form-label">3. ทางด้านสังคม</label>

                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php foreach($social_issues as $soc){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="checkbox" name="elderly_care[care_social_issues][<?php echo $key_elderly?>][]" value="<?php echo $soc;?>" class="checkbox-toggle-text" <?php echo ( in_array($soc, json_decode($value_elderly['care_social_issues'] , TRUE) ) ? 'checked' : ''); ?> >

											<?php echo $soc;?>
										</label>
									</div>
									<?php $specify_soc = array( "อื่นๆ" ); ?>
									<?php if(in_array($soc, $specify_soc)){ ?>

                    				<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[care_social_issues_specify][<?php echo $key_elderly?>]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $soc; ?> (ระบุ)" <?php echo ($value_elderly['care_social_issues_specify'] != NULL ? 'value="'.$value_elderly['care_social_issues_specify'].'"' : 'disabled'); ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                    		<label class="col-2 col-form-label">4. ทางด้านเศรษฐกิจ</label>

                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
								<?php foreach($economy_issues as $eco){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="checkbox" name="elderly_care[care_economy_issues][<?php echo $key_elderly?>][]" 
value="<?php echo $eco;?>" class="checkbox-toggle-text" <?php echo ( in_array($eco, json_decode($value_elderly['care_economy_issues'] , TRUE) ) ? 'checked' : ''); ?>>

											<?php echo $eco;?>
										</label>
									</div>
									<?php $specify_eco = array( "อื่นๆ" ); ?>
									<?php if(in_array($eco, $specify_eco)){ ?>

                    				<input style="display: inline-block;min-width: 350px;width: auto;" name="elderly_care[care_economy_issues_specify][<?php echo $key_elderly?>]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $eco; ?> (ระบุ)" <?php echo ($value_elderly['care_economy_issues_specify'] != NULL ? 'value="'.$value_elderly['care_economy_issues_specify'].'"' : 'disabled'); ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>


            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                    		<label class="col-2 col-form-label">ความต้องการของผู้สูงอายุ เมื่อเริ่มแรกที่ อผส. เข้าไปให้การดูแล พบว่า ผู้สูงอายุมีความจำเป็นต้องได้รับการดูแล ช่วยเหลือ หรือมีความต้องการ คือ</label>

                		
                    	</div>
                    	<div class="col-xs-12">
                    		
                    		<ul class="list-unstyled" style="margin-bottom: 0;">
                    			<?php 
								$care_elderly_requirement_specify = json_decode( $value_elderly['care_elderly_requirement_specify'], TRUE );
								$care_elderly_requirement_specify_index = 0;
								?>
								<?php foreach($elderly_requirement as $eld_req){ ?>
								<li>
									<div class="checkbox-inline i-checks">
										<label>

                      						<input type="checkbox" name="elderly_care[care_elderly_requirement][<?php echo $key_elderly?>][]" 
value="<?php echo $eld_req;?>" class="checkbox-toggle-text" <?php echo ( in_array($eld_req, json_decode($value_elderly['care_elderly_requirement'] , TRUE) ) ? 'checked' : ''); ?>>

											<?php echo $eld_req;?>
										</label>
									</div>
									<?php $specify_eld_req = array( "ต้องการช่วยเหลือสังคม และมีบทบาทในสังคมตามความถนัด", "อื่นๆ" ); ?>
									<?php if(in_array($eld_req, $specify_eld_req)){ ?>

									<?php
										 if( in_array($eld_req, json_decode($value_elderly['care_elderly_requirement'] , TRUE) ) && $care_elderly_requirement_specify[ $care_elderly_requirement_specify_index ] != NULL ){
										 	$care_elderly_requirement_specify_attr =  'value="'. $care_elderly_requirement_specify[ $care_elderly_requirement_specify_index ].'"';
										 	$care_elderly_requirement_specify_index++;
										 }else{
										 	$care_elderly_requirement_specify_attr = 'disabled';
										 }
									?>
                    				<input style="display: inline-block;min-width: 450px;width: auto;" name="elderly_care[care_elderly_requirement_specify][<?php echo $key_elderly?>][]" type="text" class="form-control text-toggle-disabled" placeholder="<?php echo $eld_req; ?> (ระบุ)" <?php echo $care_elderly_requirement_specify_attr; ?>>

									<?php } ?>
								</li>
                        		
                        		<?php } ?>
								
                        		
							</ul>
                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

            <div class="form-group row">
            	<div class="col-xs-12  col-sm-6">
            		<div class="row">
            			<div class="col-xs-12">
                    		<label class="col-2 col-form-label">ความเห็น อผส. ควรให้ความช่วยเหลือ ผู้สูงอายุรายนี้โดย (ระบุ)</label>

                		
                    	</div>
                    	<div class="col-xs-12">
                    		<div class="group-dynamic">
                        		<ul class="list-unstyled group-dynamic-list" style="margin-bottom: 0;">
									<?php if( count(json_decode($value_elderly['care_assistance_opinion_set'] , TRUE)) != 0 ){ ?>
	                        			<?php foreach (json_decode($value_elderly['care_assistance_opinion_set'] , TRUE) as $care_assistance_opinion_key => $care_assistance_opinion) { ?>
	                        				<li>
												<div class="row">
													<div class="col-xs-11">
														<input type="text" class="form-control" name="elderly_care[care_assistance_opinion_set][<?php echo $key_elderly?>][]"
value="<?php echo $care_assistance_opinion; ?>"	>
														
													</div>
													<div class="col-xs-1" style="padding-left: 0;">
														<button type="button" class="btn btn-default btn-delate-list-dynamic">
															<i class="fa fa-minus" aria-hidden="true"></i>
														</button>
													</div>
												</div>
											</li>
	                        			<?php } ?>
                        			
                        			<?php }else{ ?>
									
										<li>
											<div class="row">
												<div class="col-xs-11">
													<input type="text" class="form-control" name="elderly_care[care_assistance_opinion_set][<?php echo $key_elderly?>][]"
>
													
												</div>
												<div class="col-xs-1" style="padding-left: 0;">
													<button type="button" class="btn btn-default btn-delate-list-dynamic">
														<i class="fa fa-minus" aria-hidden="true"></i>
													</button>
												</div>
											</div>
										</li>
									<?php } ?>
								</ul>
								
								<button type="button" class="btn btn-default btn-add-list-dynamic" data-template="template_care_assistance_opinion_set" data-index="<?php echo $key_elderly?>"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มความเห็น อผส.</button>
							</div>

                    	</div>
                    	
            		</div>
            		
            	</div>
            </div>

		</div>
	</div>
</div>