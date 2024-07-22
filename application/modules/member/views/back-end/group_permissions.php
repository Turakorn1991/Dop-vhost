		<?php echo css_asset('main.css','member');?>
<?php if($mode == ''){?>
	<div class="wrap_data">
		<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
		<?php echo css_asset('../admin/css/datatables.css');?>
		<?php echo css_asset("../plugin/datatable/css/jquery.dataTables.min.css");?>
		<?php echo js_asset("../plugin/datatable/js/jquery.js");?>
		<?php echo js_asset("../plugin/datatable/js/jquery.dataTables.min.js");?>
		<div class="table_result">
			<div class="command">
				<button title="เพิ่มข้อมูลใหม่" type='button' class="bt_tools bt_add" onclick="window.location.href ='<?php echo site_url("member/".uri_seg(2)."/setting/add");?>';"><i class="fa fa-plus"></i>เพิ่มข้อมูลใหม่</button>
			</div>
			<table id="datatable">
				<thead>
					<th>ID</th>
					<th>ชื่อ</th>
					<th>คำอธิบาย</th>
					<th>สถานะ</th>
					<th>เครื่องมือ</th>
				</thead>
				<tbody>
				<?php foreach ($group_members as $row) { 
					$GM_Name = uns($row['GM_Name']);
					$GM_Descript = uns($row['GM_Descript']);
				?>
					<tr>
						<td><?php echo $row['GM_ID'];?></td>
						<td><?php echo nameTitle($GM_Name['TH'],50);?></td>
						<td><?php echo nameTitle($GM_Descript['TH']);?></td>
						<td><?php echo allow($row['GM_Allow']);?></td>
						<td class="td-image">
							<button title="แก้ไข" type='button' class="bt_tools bt_edit" onclick="window.location.href ='<?php echo site_url("member/".uri_seg(2)."/setting/edit/{$row['GM_ID']}");?>';"><i class="fa fa-pencil"></i>แก้ไข</button>
					        <button title="ลบ" type='button' class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){window.location.href='<?php echo site_url("member/".uri_seg(2)."/setting/del/{$row['GM_ID']}");?>';}"><i class="fa fa-trash-o"></i>ลบ</button>
						</td>
					</tr>
				<?php }?>
				</tbody>
			</table>
		</div>
		<script type="text/javascript">
			$('#datatable').DataTable({"aaSorting": []});
		</script>
	</div>
<?php }elseif($mode == 'add' || $mode == 'edit') {?>

	<div class="wrap_form">
		<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
		<?php 
			if($group_member['GM_ID']==''){
				echo form_open_multipart('member/'.uri_seg(2).'/setting/'.$mode,'id','form_input');
			}else{
				echo form_open_multipart('member/'.uri_seg(2).'/setting/'.$mode.'/'.$group_member['GM_ID'],'id','form_input');
			}
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
				<tr>
					<td class="first_col">ชื่อ<font class="required"><span>*</span><span></span></font>:</td>
					<td class="th"><input title="ชื่อ" name="GM_Name[TH]" type="text" class="txtinput in_medium" value="<?php echo $group_member['GM_Name']['TH'];?>" required autofocus></td>
					<td class="en" style="display:none"><input title="Name" name="GM_Name[EN]" type="text" class="txtinput in_medium" value="<?php echo $group_member['GM_Name']['EN'];?>"></td>
				</tr>
				<tr>

					<td class="first_col top">คำอธิบาย/รายละเอียด:</td>
					<td class="th"><textarea title="คำอธิบาย/รายละเอียด" name="GM_Descript[TH]" class="txtarea ar_medium"><?php echo $group_member['GM_Descript']['TH'];?></textarea></td>
					<td class="en" style="display:none"><textarea title="Descript" name="GM_Descript[EN]" class="txtarea ar_medium"><?php echo $group_member['GM_Descript']['EN'];?></textarea></td>
				</tr>
				<tr>
					<td class="first_col">สถานะ<font class="required"><span>*</span><span></span></font>:</td>
					<td>
						<?php
						$arr = array(1=>'ปกติ',2=>'ระงับ');
						?>
						<select name="GM_Allow" title="สถานะ" class="select se_small" <?php if(uri_seg(2)=='edit_profile'){?> disabled<?php }?> required>
						<option>เลือกสถานะ</option>
						<?php
							foreach ($arr as $key => $value) {
						?>
							<option value="<?php echo $key;?>" <?php if($key == $group_member['GM_Allow']){?> selected <?php }?>><?php echo $value;?></option>
						<?php
							}
						?>
						</select>
					</td>
				</tr>
				<tr><td class="first_col top">สิทธิการเข้าถึง<font class="required"><span>*</span><span></span></font>:</td></tr>
				
				<?php
				$process = $this->admin_model->getAll_permissions_with_parentID(0);
				$i=0;
				foreach ($process as $key => $value) {
					if(count($process)<1)break;
				?>
					<tr>
						<td class="first_col top"></td>
						<td>
							<div class="wrap_process">
								<div class="root">
									<?php
									$name = uns($value['P_Name']);
									?>
									<input class="root<?php echo $value['P_ID'];?>" type="checkbox" name="p[<?php echo $i;?>]" <?php if($group_member['P_ID_arr'][$i] == 1){?> checked <?php }?> value="<?php echo $value['P_ID'];?>">
									<i class='fa <?php echo $value['P_FontAweIcon'];?>'></i>
									<?php echo $name['TH'];?>
								</div>
							<?php $i++; ?>	
							<?php echo process_list($value['P_ID'],$i,$group_member['P_ID_arr']);?>
								
							</div>
						</td>
					</tr>					
				<?php
				}
				?>

				<?php
				if($mode == 'edit'){
				?>	
				<tr>
					<td class="first_col top">วันเวลาที่เพิ่ม:</td><td><?php echo $group_member['GM_UserAdd'];?> เวลา <?php echo formatDateThaiFromDatatime($group_member['GM_DateTimeAdd']);?></td>
				</tr>						
				<tr>
					<td class="first_col top">อัพเดทล่าสุด:</td><td><?php echo $group_member['GM_UserUpdate'];?> เวลา <?php echo formatDateThaiFromDatatime($group_member['GM_DateTimeUpdate']);?></td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan='6'>
						<center>
							<input type="submit" name="bt_submit" hidden="hidden">
							<button name="bt_submit" title="บันทึกข้อมูล" class="bt_tools bt_save" onclick="$('input[name=bt_submit]').click()"><i class="fa fa-pencil-square-o"></i>บันทึกข้อมูล</button>
							<?php
							if($mode == 'edit'){
							?>
							<button name="bt_del" title="ลบข้อมูล" class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){window.location.href='<?php echo base_url('member/'.uri_seg(2).'/setting/del/'.$group_member['GM_ID']);?>'}"><i class="fa fa-trash-o"></i>ลบข้อมูล</button>&nbsp;
							<?php 
							}
							?>
							<button name="bt_cancel" title="กลับไปยังรายการ" class="bt_tools bt_cancel" onclick="window.location.href='<?php echo base_url('member/'.uri_seg(2).'/setting');?>'"><i class="fa fa-undo"></i>กลับไปยังรายการ</button>&nbsp;
						</center>
					</td>
				</tr>		
			</table>	
		</div>
		<?php echo form_close();?>
	</div>
<?php }?>