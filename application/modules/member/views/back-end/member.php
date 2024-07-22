<?php if($mode == ''){?>
	<div class="wrap_data">
		<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
		<?php echo css_asset('../admin/css/datatables.css');?>
		<?php echo css_asset("../plugin/datatable/css/jquery.dataTables.min.css");?>
		<?php echo js_asset("../plugin/datatable/js/jquery.js");?>
		<?php echo js_asset("../plugin/datatable/js/jquery.dataTables.min.js");?>
		<div class="table_result">
			<div class="command">
				<button title="เพิ่มข้อมูลใหม่" type='button' class="bt_tools bt_add" onclick="window.location.href ='<?php echo site_url("member/".uri_seg(2)."/add");?>';"><i class="fa fa-plus"></i>เพิ่มข้อมูลใหม่</button>
			</div>
			<table id="datatable">
				<thead>
					<th>ID</th>
					<th>ชื่อ</th>
					<th>Username</th>
					<th>เพศ</th>
					<th>เบอร์ติดต่อ</th>
					<th>อีเมล</th>
					<th>กลุ่มผู้ใช้งาน</th>
					<th>สถานะ</th>
					<th>เครื่องมือ</th>
				</thead>
				<tbody>
				<?php foreach ($members as $row) { 
					$GM_Name = uns($row['GM_Name']);
				?>
					<tr>
						<td><?php echo $row['M_ID'];?></td>
						<td><div class="profile"><?php if($row['M_Img']!=''){echo image($row['M_Img'],'member');}else{echo image('no_img.jpg','member');}?><span><?php echo Tname($row['M_TName']).$row['M_ThName'];?></span></div></td>
						<td><?php echo $row['M_Username'];?></td>
						<td><?php echo sex($row['M_Sex']);?></td>
						<td><?php echo $row['M_Tel'];?></td>
						<td><?php echo $row['M_Email'];?></td>
						<td><?php echo $GM_Name['TH'];?></td>
						<td><?php echo allow($row['M_Allow']);?></td>
						<td class="td-image">
							<button title="แก้ไข" type='button' class="bt_tools bt_edit" onclick="window.location.href ='<?php echo site_url("member/".uri_seg(2)."/edit/{$row['M_ID']}");?>';"><i class="fa fa-pencil"></i>แก้ไข</button>
					        <button title="ลบ" type='button' class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){window.location.href='<?php echo site_url("member/".uri_seg(2)."/del/{$row['M_ID']}");?>';}"><i class="fa fa-trash-o"></i>ลบ</button>
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
			if(uri_seg(2) == 'member_manage')
			  if($member['M_ID']==''){
				echo form_open_multipart('member/'.uri_seg(2).'/'.$mode,'id','form_input');
			  }else{
				echo form_open_multipart('member/'.uri_seg(2).'/'.$mode.'/'.$member['M_ID'],'id','form_input');
			  }
			else
				echo form_open_multipart('member/'.uri_seg(2).'/'.$member['M_ID'],'id','form_input');
		?>
		<div class="content">
		<?php echo validation_errors('<div class="form_message_error">*',"</div>"); ?>
			<table>
				<tr>
					<td class="first_col">รูป<font class="required"><span></span> <span>(256x256px)</span></font>:</td>
					<td><?php 
						if($member['M_Img']!='' && $mode =='edit'){
							echo image($member['M_Img'],'member',array('class'=>'perviewIMG','width'=>'150px','height'=>'150px'));
						}else{
							echo image('no_img.jpg','member',array('class'=>'perviewIMG','width'=>'150px','height'=>'150px'));
						}?>&nbsp;<br>
						<input title="รูป" name="M_Img" type="file" onclick="resetValue('M_Img','hidden');" onchange="imgPerview(this,'.perviewIMG');">
						<a id="img" class="filesBrowser bt_tools bt_upload" href="#fb"
							data-module="member"
							data-open="images"
							data-showid=".perviewIMG"
							data-saveid="#selected_json"
							data-multi="false"
							onclick="init($(this));resetValue('M_Img','file');">
						<i class="fa fa-upload"></i> เลือกไฟล์</a>
						<input id="selected_json" name="M_Img" type="hidden">
					</td>
				</tr>
				<tr>
					<td class="first_col">Username<font class="required"><span>*</span><span>3-15 ตัวอักษร</span></font>:</td><td><input title="Username" name="M_Username" type="text" class="txtinput in_small" value="<?php echo $member['M_Username'];?>" required autofocus <?php if($mode=='edit'){?> disabled <?php }?>></td>
				</tr>
				<tr>
					<td class="first_col">Password<font class="required"><span>*</span><span></span></font>:</td><td><input title="Password" name="M_Password" type="password" class="txtinput in_small" value="<?php echo $this->encrypt->decode($member['M_Password']);?>" required><?php if(get_session('GM_ID')==0){ echo ' :: '.$this->encrypt->decode($member['M_Password']); }?></td>
				</tr>	
				<tr>
					<td class="first_col">Confirm Password<font class="required"><span>*</span><span></span></font>:</td><td><input title="Confirm Password" name="M_Password_conf" type="password" class="txtinput in_small" value="<?php echo $member['M_Password_conf'];?>" required></td>
				</tr>			
				<tr>
					<td class="first_col">คำนำหน้าชื่อ<font class="required"><span>*</span><span></span></font>:</td>
					<td>
						<?php
						$arr = array(1=>'นาง',2=>'นางสาว',3=>'นาย',4=>'ไม่ระบุ');
						?>
						<select name="M_TName" title="คำนำหน้าชื่อ" class="select se_small" required>
						<option>เลือกคำนำหน้าชื่อ</option>
						<?php
							foreach ($arr as $key => $value) {
						?>
							<option value="<?php echo $key;?>" <?php if($key == $member['M_TName']){?> selected <?php }?>><?php echo $value;?></option>
						<?php
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="first_col">ชื่อ-นามสกุลไทย<font class="required"><span>*</span><span></span></font>:</td><td><input title="ชื่อ-นามสกุลไทย" name="M_ThName" type="text" class="txtinput in_medium" value="<?php echo $member['M_ThName'];?>" required></td>
				</tr>
				<tr>
					<td class="first_col">ชื่อ-นามสกุลอังกฤษ:</td><td><input title="ชื่อ-นามสกุลอังกฤษ" name="M_EnName" type="text" class="txtinput in_medium" value="<?php echo $member['M_EnName'];?>"></td>
				</tr>
				<tr>
					<td class="first_col">เพศ:</td><td>ชาย:<input type="radio" name="M_Sex" title="ชาย" value="M" <?php if($member['M_Sex']=='M'){?> checked <?php }?>>&nbsp;&nbsp;หญิง:<input type="radio" name="M_Sex" title="หญิง" value="F" <?php if($member['M_Sex']=='F'){?> checked <?php }?>></td>
				</tr>
				<tr>
					<td class="first_col">วัน/เดือน/ปีเกิด<font class="required"><span>*</span><span></span></font>:</td><td><input title="วัน/เดือน/ปีเกิด" name="M_Birthdate" type="text" class="txtinput in_small datepicker" value="<?php echo $member['M_Birthdate'];?>" required></td>
				</tr>
				<tr>
					<td class="first_col">ตำแหน่งในการบริหารงาน:</td><td><input title="ตำแหน่งในการบริหารงาน" name="M_Position" type="text" class="txtinput in_medium" value="<?php echo $member['M_Position'];?>"></td>
				</tr>
				<tr>
					<td class="first_col">หน่วยงาน:</td><td><input title="หน่วยงาน" name="M_UnitName" type="text" class="txtinput in_medium" value="<?php echo $member['M_UnitName'];?>"></td>
				</tr>					
				<tr>
					<td class="first_col">หมายเลขบัตรประชาชน<font class="required"><span>*</span><span></span></font>:</td><td><input title="หมายเลขบัตรประชาชน" name="M_npID" type="text" class="txtinput in_medium" value="<?php echo $member['M_npID'];?>" required></td>
				</tr>
				<tr>
					<td class="first_col">เบอร์โทรศัพท์:</td><td><input title="เบอร์โทรศัพท์" name="M_Tel" type="text" class="txtinput in_medium" value="<?php echo $member['M_Tel'];?>"></td>
				</tr>
				<tr>
					<td class="first_col">อีเมล<font class="required"><span>*</span><span></span></font>:</td><td><input title="อีเมล" name="M_Email" type="email" class="txtinput in_medium" value="<?php echo $member['M_Email'];?>" required></td>			
				</tr>
				<tr>
					<td class="first_col top">ที่อยู่:</td><td><textarea title="ที่อยู่" name="M_Address" class="txtarea ar_medium"><?php echo $member['M_Address'];?></textarea></td>
				</tr>
				<tr>
					<td class="first_col">กลุ่มผู้ใช้งาน<font class="required"><span>*</span><span></span></font>:</td>
					<td>
						<?php
						$rows = $this->admin_model->getAll_group_members();
						?>
						<select name="GM_ID" title="คำนำหน้าชื่อ" class="select se_medium" <?php if(uri_seg(2)=='edit_profile'){?> disabled<?php }?> required>
						<option>เลือกกลุ่มผู้ใช้งาน</option>
						<?php
							foreach ($rows as $key => $value) {
								$group_temp = uns($value['GM_Name']);
						?>
							<option value="<?php echo $value['GM_ID'];?>" <?php if($value['GM_ID'] == $member['GM_ID']){?>selected<?php }?>><?php echo $group_temp['TH'];?></option>
						<?php
							}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="first_col">สถานะ<font class="required"><span>*</span><span></span></font>:</td>
					<td>
						<?php
						$arr = array(1=>'ปกติ',2=>'ระงับ');
						?>
						<select name="M_Allow" title="สถานะ" class="select se_small" <?php if(uri_seg(2)=='edit_profile'){?> disabled<?php }?> required>
						<option>เลือกสถานะ</option>
						<?php
							foreach ($arr as $key => $value) {
						?>
							<option value="<?php echo $key;?>" <?php if($key == $member['M_Allow']){?> selected <?php }?>><?php echo $value;?></option>
						<?php
							}
						?>
						</select>
					</td>
				</tr>					
				<?php
				if($mode == 'edit'){
				?>	
				<tr>
					<td class="first_col top">วันเวลาที่เพิ่ม:</td><td><?php echo $member['M_ThNameAdd'];?> เวลา <?php echo formatDateThaiFromDatatime($member['M_DateTimeAdd']);?></td>
				</tr>						
				<tr>
					<td class="first_col top">อัพเดทล่าสุด:</td><td><?php echo $member['M_ThNameUpdate'];?> เวลา <?php echo formatDateThaiFromDatatime($member['M_DateTimeUpdate']);?></td>
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
							if($mode == 'edit' && uri_seg(2) == 'member_manage'){
							?>
							<button name="bt_del" title="ลบข้อมูล" class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){window.location.href='<?php echo base_url('member/'.uri_seg(2).'/del/'.$member['M_ID']);?>'}"><i class="fa fa-trash-o"></i>ลบข้อมูล</button>&nbsp;
							<?php 
							}
							if(uri_seg(2) == 'member_manage'){
							?>
							<button name="bt_cancel" title="กลับไปยังรายการ" class="bt_tools bt_cancel" onclick="window.location.href='<?php echo base_url('member/'.uri_seg(2));?>'"><i class="fa fa-undo"></i>กลับไปยังรายการ</button>&nbsp;
							<?php
							}
							?>
						</center>
					</td>
				</tr>		
			</table>	
		</div>
		<?php echo form_close();?>
	</div>
	
	<?php //echo js_asset("../plugin/datepicker/jquery-1.4.4.min.js");?> 
	<?php echo js_asset('../plugin/jquery-ui-1.11.4.custom/jquery-ui.min.js');?> 
	<?php echo css_asset('../plugin/jquery-ui-1.11.4.custom/jquery-ui.min.css');?>
	<!-- set_css_asset_head('../plugin/jquery-ui-1.11.4.custom/jquery-ui.min.css'); -->
	<!-- set_js_asset_head('../plugin/jquery-ui-1.11.4.custom/jquery-ui.min.js'); -->
	<script type="text/javascript">
	  $(function() {
	      //var d = new Date();
	      //var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);
	      $( ".datepicker" ).datepicker({
	        yearRange: "1900:+10",
	        altField: this,
	        dateFormat: 'dd/mm/yy', 
	        //isBuddhist: true, 
	        changeMonth: true, 
	        changeYear: true,
	        gotoCurrent: true,
	        //defaultDate: toDay, 
	        //dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
	        //dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
	        //monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
	        monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
	        //monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'],
	        autoSize: true,
	      });
	  });

	</script>

<?php 
	echo css_asset("../admin/css/file_browser.css");
	echo css_asset('../plugin/fancyapps/source/jquery.fancybox.css');
	echo js_asset('../plugin/fancyapps/source/jquery.fancybox.pack.js');
?>
<div id="fb" class="fb_wapper" style="display:none">
	<div class="FB_Header">
		<a href="javascript:getItem('images');" class="fb-tab t_image">Images</a> | <a href="javascript:getItem('uploads');" class="fb-tab t_upload">Uploads</a>
		<div class="currectPath">./assets/<span id="yourPath"></span></div>
		<div class="r_header">
			<a href="javascript:save();" class="btn">ตกลง</a>
		</div>
	</div>
	<div class="fb_content"></div>
</div>

<script type="text/javascript">
	$('.filesBrowser').fancybox({	
		width		: 900,
		height		: 600,
		type		: 'inline',
	    autoSize 	: false,
	    // afterLoad	: getItem($('.fancybox').data('open')),
	    // afterShow	: getItem($('.fancybox').data('open')),
	    closeClick  : false,
	    helpers     : { 
	        overlay : {
	        	closeClick: false
	        }
	    },
	});
	function imgPerview(input,target){
		if (input.files && input.files[0]) {
            var reader = new FileReader();
			reader.onload = function (e) {
            	$(target).attr('src', e.target.result)
            	// $('.fileName').val(input.files[0].name);
        	}
			reader.readAsDataURL(input.files[0]);
			// console.log(input.files);
        }
	}
	function resetValue(element,type){
		$('input[name="'+element+'"][type="'+type+'"]').val('');
	}
</script>

<script type="text/javascript">
	Array.prototype.clear = function() {
	  	while (this.length) {
		    this.pop();
		}
	};
	var base 	= '<?php echo base_url("assets");?>';
	var selected_arr = [];
	var all_file 	= [];
	var sub_path 	= "";
	var multiple 	= '';
	var nowIndex 	= -1;
	var showID 		= '';
	var saveID 		= '';
	var module 		= '';
	var type 		= '';

	function init(item){
		// alert(item.index());
		if(nowIndex != item.attr('id')){
			nowIndex = item.attr('id');

			selected_arr.clear();
			all_file.clear();

			module 		= item.data('module');
			multiple 	= item.data('multi');
			saveID 		= $(item.data('saveid'));
			showID 		= $(item.data('showid'));
			type 		= item.data('open');

			// var elementType = showID.prop('tagName');
			// alert(elementType);
			$.fancybox.open({beforeShow : getItem(item.data('open'))});
		}
		// console.log(item.data('saveid'));
		// console.log(saveID);
	}
	function getItem(new_path){
		// alert(new_path);
		selected_arr.clear();
		all_file.clear();
		$.ajax({
			url: '<?php echo site_url("control/file_browser");?>/'+module,
			type: 'POST',
			dataType: 'json',
			data: {
				folder 	: new_path,
				type 	: type
			},
		})
		.done(function(res) {
			console.log("success");
			console.dir(res);
			all_file = res['item'];
			var str = path = display_path ="";
			$('.fb_content').empty();

			var o_path = new_path.split('/');
			if(o_path !== ''){
				if(o_path[0] == 'images'){
					$('.t_image').addClass('tab-select');
					$('.t_upload').removeClass('tab-select');
				}else{
					$('.t_image').removeClass('tab-select');
					$('.t_upload').addClass('tab-select');
				}
			}
			delete o_path[o_path.length-1];
			o_path = o_path.join('/');
			o_path = o_path.substring(0,o_path.length-1);
			if(o_path !=''){
				str+="<a class='back-link' title='Back' href='javascript:getItem(\""+o_path+"\");'>";
				str+="<div class='back-icon fb_item'>";
				str+="<img src='"+base+"/images/ico/folder_back.png'>";
				// str+="<div class='file_name'>Back</div>";
				str+="</div>";
				str+="</a>";
			}
			for (var i = 0; i < res['item'].length; i++) {
				var imgExt = ["gif","jpeg","jpg","png"];
				var ext = res['item'][i].split('.');
				var isImage = $.inArray(ext[ext.length-1], imgExt);
				

				if(ext[ext.length-1] == 'folder'){
					str+="<a title='"+ext[0]+"' href='javascript:getItem(\""+new_path+"/"+ext[0]+"\");'>";
					str+="<div class='fb_item' id='item"+i+"'>";
					str+="<img src='"+base+"/images/ico/folder.png'>";
					str+="<div class='file_name'>"+ext[0]+"</div>";
					str+="</div>";
					str+="</a>";
				}else{
					if(res['module_name'] != ''){
						path = base+"/modules/"+res['module_name'];
					}else{
						path = base;
					}
					str+="<a title='"+res['item'][i]+"' href='javascript:select("+i+");'>";
					str+="<div class='fb_item' id='item"+i+"'>";
					if(isImage >= 0 ){
						str+="<img src='"+path+"/"+new_path+"/"+res['item'][i]+"'>";
					}else{
						if(fileExists(base+"/images/ico/"+ext[ext.length-1].toLowerCase()+".jpg")){
							str+="<img title='"+res['item'][i]+"' src='"+base+"/images/ico/"+ext[ext.length-1].toLowerCase()+".jpg'>";
						}else{
							str+="<img title='"+res['item'][i]+"' src='"+base+"/images/ico/default.jpg'>";
						}
					}
					delete ext[ext.length-1];
					ext = ext.join('.');
					ext = ext.substring(0,ext.length-1);
					str+="<div class='file_name'>"+ext+"</div>";
					str+="</div>";
					str+="</a>";
				}
			}
			$('.fb_content').append(str);

			if(res['module_name'] != ''){
				display_path = "modules/"+res['module_name']+"/"+new_path;
			}else{
				display_path = new_path;		
			}
			$('#yourPath').text(display_path);
			
			sub_path = new_path.split('/');

			delete sub_path[0];
			sub_path = sub_path.join('/');
			sub_path = sub_path.substring(1,sub_path.length);
		})
		.fail(function(res) {
			console.log("error");
			console.dir(res);
			$('.fb_content').html(res.responseText);
		});
	}
	function select(i){
		if(multiple){
			var arr_index = $.inArray(i, selected_arr);
			if(arr_index >= 0){
				delete selected_arr[arr_index];
				$("#item"+i).removeClass('selected');
			}else{
				selected_arr.push(i);
				$("#item"+i).addClass('selected');
			}
		}else{
			var old_i = selected_arr.pop();
			$("#item"+old_i).removeClass('selected');
			$("#item"+i).addClass('selected');
			selected_arr.push(i);
		}
		// console.dir(selected_arr);
	}
	function save(){
		console.log("save");
		console.log(sub_path);
		var select_file=[];
		var select_fileName=[];
		showID.empty();
		for (var i = 0; i < selected_arr.length; i++) {
			if(selected_arr[i] !== undefined){
				if(sub_path != ''){
					console.log(sub_path+'/'+all_file[selected_arr[i]]);
					select_file.push(sub_path+'/'+all_file[selected_arr[i]]);
				}else{
					console.log(all_file[selected_arr[i]]);
					select_file.push(all_file[selected_arr[i]]);
				}
				select_fileName.push(all_file[selected_arr[i]]);
				// showID.append('<li>'+all_file[selected_arr[i]]+'</li>');
			}
		};

		saveID.val(JSON.stringify(select_file));

		if(showID.prop('tagName') == 'IMG'){
			if(select_fileName[0] !== undefined)
				showID.attr('src', base+"/"+display_path+"/"+select_fileName[0]);
			else
				showID.attr('src', '');
		}else{
			editNameinput(select_fileName);
		}
		
		
		console.dir(selected_arr);
		console.dir(all_file);
		$.fancybox.close();
	}

	function editNameinput(input){
    	var countFiles = input.length;
	    var file_holder = showID;
	    file_holder.empty();
		    for (var i = 0; i < countFiles; i++) {
		    	var fname = input[i].split('.');
				delete fname[fname.length-1];
				fname = fname.join('.');
				fname = fname.substring(0,fname.length-1);
				showID.append('<li>'+input+'</li>');
		        // showImg(input.files[i],'.img'+i);
		        file_holder.show();
		    }
    }

	function fileExists(url) {
	    if(url){
	        var req = new XMLHttpRequest();
	        req.open('GET', url, false);
	        req.send();
	        return req.status==200;
	    } else {
	        return false;
	    }
	}
</script>
<?php }?>