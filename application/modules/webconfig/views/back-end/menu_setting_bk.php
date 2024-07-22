	<div class="wrap_form">
		<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>

		<?php 
		echo form_open_multipart('webconfig/menu_setting','id','form_input');
		?>

		<div class="content">
		<?php echo validation_errors('<div class="form_message_error">*',"</div>"); ?>
			<table>
				<tr><td>
					<ul class="tab">
						<li class="lg_select" title="Thai Language"><?php echo image('thai_icon.png');?><span>TH</span></li>
						<li title="English Language"><?php echo image('English_icon.png');?><span>EN</span></li>
					</ul>
					</td>
				</tr>			
				<?php
				foreach ($process as $key => $value) {
					if(count($process)<1)break;
				?>
					<tr>
						<td class="first_col top"></td>
						<td class="th">
							<div class="wrap_process">
								<div class="root">
									<?php
									$name = uns($value['P_Name']);
									?>
									<i class='fa <?php echo $value['P_FontAweIcon'];?>'></i>
									<input class="txtinput in_medium" type="text" name="p[TH][<?php echo $value['P_ID'];?>]" value="<?php echo $name['TH'];?>">
								</div>
							<?php echo process_edit_list($value['P_ID'],'TH');?>
							</div>
						</td>
						<td class="en" style="display:none;">
							<div class="wrap_process">
								<div class="root">
									<?php
									$name = uns($value['P_Name']);
									?>
									<i class='fa <?php echo $value['P_FontAweIcon'];?>'></i>
									<input class="txtinput in_medium" type="text" name="p[EN][<?php echo $value['P_ID'];?>]" value="<?php echo $name['EN'];?>">
								</div>
							<?php echo process_edit_list($value['P_ID'],'EN');?>
							</div>
						</td>
					</tr>					
				<?php
				}
				?>						
				<tr>
					<td class="first_col top">อัพเดทล่าสุด:</td><td><?php echo $M_ThNameUpdate;?> เวลา <?php echo @formatDateThaiFromDatatime($P_DateTimeUpdate);?></td>
				</tr>
				<tr>
					<td colspan='6'>
						<center>
							<input type="submit" name="bt_submit" hidden="hidden">
							<button name="bt_submit" title="บันทึกข้อมูล" class="bt_tools bt_save" onclick="$('input[name=bt_submit]').click()"><i class="fa fa-pencil-square-o"></i>บันทึกข้อมูล</button>
						</center>
					</td>
				</tr>		
			</table>	
		</div>

		<?php echo form_close();?>
	</div>