
	<?php echo js_asset("../plugin/ckeditor/ckeditor.js");?>
	<div class="wrap_form">
		
		<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
		<div class="content">
			<?php echo validation_errors('<div class="form_message_error">*',"</div>"); ?>
			<?php echo form_open_multipart()?>
			<table>
				<tr><td>
					<ul class="tab">
						<li class="lg_select" title="Thai Language"><img src="<?php echo base_url('assets/images/thai_icon.png');?>"><span>TH</span></li>
						<li title="English Language"><img src="<?php echo base_url('assets/images/English_icon.png');?>"><span>EN</span></li>
					</ul>
				</td></tr>
		
				<tr>
					<td class="first_col top">เนื้อเรื่อง<font class="required"><span>*</span><span></span></font>:</td>
					<td class="th" colspan="3"><textarea id="ckeditorTH" title="<?php echo $title;?>" name="descript[TH]" class="txtarea ar_large ckeditor"><?php echo $descript['TH']?></textarea></td>
					<td class="en" style="display:none;" colspan="3"><textarea id="ckeditorEN" title="<?php echo $title;?>" name="descript[EN]" class="txtarea ar_large ckeditor"><?php echo $descript['EN']?></textarea></td>
				</tr>
				
				<tr>
					<td class="first_col top">อัพเดทล่าสุด:</td><td><?php echo $site['WD_UserUpdate'];?> เวลา <?php echo formatDateThaiFromDatatime($site['WD_DatetimeUpdate']);?></td>
				</tr>
				<tr>
					<td colspan='6'>
						<center>
							<input type='submit' name="bt_submit" value='บันทึกข้อมูล' hidden='hidden'>
							<button title="บันทึกข้อมูล" type='submit' class="bt_tools bt_save" onclick="$('input[name=bt_submit]').click()"><i class="fa fa-pencil-square-o"></i> บันทึกข้อมูล</button>						
						</center>
					</td>
				</tr>
			</table>
			<?php echo form_close()?>
		</div>
	</div>
