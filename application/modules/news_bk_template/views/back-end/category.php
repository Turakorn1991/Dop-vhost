<?php if($P_ID == 21){?>
	<?php if($mode == ''){ ?>
		<div class="wrap_data">
			<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
			<?php echo css_asset("../plugin/datatable/css/jquery.dataTables.min.css");?>
			<?php echo js_asset("../plugin/datatable/js/jquery.js");?>
			<?php echo js_asset("../plugin/datatable/js/jquery.dataTables.min.js");?>
			<div class="table_result">
				<div class="command">
					<button title="เพิ่มข้อมูลใหม่" type='button' class="bt_tools bt_add"  onclick="window.location.href='<?php echo base_url(uri_seg(1)."/".uri_seg(2)."/add")?>'"><i class="fa fa-plus"></i> เพิ่มข้อมูลใหม่</button>
				</div>
				<table id="datatable">
					<thead>
						<th>ID</th>
						<th>หมวดหมู่ข่าวสาร</th>
						<th>ลำดับข้อมูล</th>
						<th>การเผยแพร่ที่ปฏิทินกิจกรรม</th>
						<th>ลำดับการแสดง</th>
						<th>สถานะ</th>
						<th>เครื่องมือ</th>
					</thead>
					<tbody>
					<?php foreach ($cnRows as $row) { 
						$cName = uns($row['CN_Name']);
						$odmode = array('1'=>'New ขึ้นก่อน','2'=>'Hot ขึ้นก่อน','3'=>'Update ขึ้นก่อน');
						$allow = array('1' => "เผยแพร่", '2' => "ไม่เผยแพร่");?>
						<tr>
							<td class="td-numeric"><?php echo $row['CN_ID'];?></td>
							<td width="30%"><?php echo $cName['TH'];?></td>
							<td><?php echo $odmode[$row['CN_DisplayConfig']];?></td>
							<td width="15%"><?php echo $allow[$row['CN_ActivityCheck']];?></td>
							<td class="td-numeric"><?php echo $row['CN_Order'];?></td>
							<td><?php echo $allow[$row['CN_Allow']];?></td>
							<td class="td-image" width="25%">
								<button title="เลื่อนลำดับขึ้น" type='button' class="bt_tools bt_order_up" onclick="window.location.href ='<?php echo base_url('news/category/up/'.$row['CN_ID']);?>';"><i class="fa fa-angle-up"></i> ขึ้น</button>
								<button title="เลื่อนลำดับลง" type='button' class="bt_tools bt_order_down" onclick="window.location.href ='<?php echo base_url('news/category/down/'.$row['CN_ID']);?>';"><i class="fa fa-angle-down"></i> ลง</button>
					            <button title="แก้ไข" type='button' class="bt_tools bt_edit" onclick="window.location.href ='<?php echo base_url('news/category/edit/'.$row['CN_ID']);?>';"><i class="fa fa-pencil"></i> แก้ไข</button>
					            <button title="ลบ" type='button' class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){ window.location.href='<?php echo base_url('news/category/del/'.$row['CN_ID']);?>';}else{ return false;}"><i class="fa fa-trash-o"></i> ลบ</button>
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<script type="text/javascript">
			$('#datatable').DataTable({'iDisplayLength': 25,"aaSorting": []});
		</script>
	<?php }elseif($mode == 'add' || $mode == 'edit'){?>	
		<?php echo js_asset('jquery.ddslick.min.js','news');?>
		<div class="wrap_form">
			
			<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
			<div class="content">
				<?php echo form_open();?>
					<table>
						<tr><td>
							<ul class="tab">
								<li class="lg_select" title="Thai Language"><img src="<?php echo base_url('assets/images/thai_icon.png');?>"><span>TH</span></li>
								<li title="English Language"><img src="<?php echo base_url('assets/images/English_icon.png');?>"><span>EN</span></li>
							</ul>
							</td>
						</tr>
						<tr>
							<td class="first_col">ไอคอนสัญลักษณ์:</td>
							<td>
								
								<select id="myDropdown" style="font-size:13px">
									<?php foreach ($nIcons as $icon) {
									$icName=uns($icon['CNI_Name']);?>
									<option value="<?php echo $icon['CNI_ID']?>" <?php if($cNews['CNI_ID'] == $icon['CNI_ID']) echo "selected";?> data-imagesrc="<?php if($icon['CNI_Img']!=''){echo base_url('assets/modules/news/images/'.$icon['CNI_Img']);}else{echo base_url('assets/images/noimage.gif');}?>"  data-description="<?php echo $icName['EN']?>" ><?php echo $icName['TH']?></option>
									<?php }?>
							    </select>
							    <input type="hidden" id="CNI_ID" name="CNI_ID" value="<?php echo$cNews['CNI_ID']?>">
							</td>
						</tr>
						
						<tr>
							<td class="first_col">ชื่อหมวดหมู่ข่าวสาร<font class="required"><span>*</span><span></span></font>:</td>
							<td class="th"><input title="ชื่อหมวดหมู่ข่าวสาร" name="CN_Name[TH]" type="text" class="txtinput in_large" value="<?php echo $cNews['CN_Name']['TH'];?>" required autofocus></td>
							<td class="en" style="display:none"><input title="Category Name" name="CN_Name[EN]" type="text" class="txtinput in_large" value="<?php echo $cNews['CN_Name']['EN'];?>"></td>
						</tr>
						<tr>
							<td class="first_col top">รายละเอียด:</td>
							<td class="th"><textarea title="รายละเอียด" name="CN_Descript[TH]" class="txtarea ar_large"><?php echo $cNews['CN_Descript']['TH'];?></textarea></td>
							<td class="en" style="display:none"><textarea title="Descript" name="CN_Descript[EN]" class="txtarea ar_large"><?php echo $cNews['CN_Descript']['EN'];?></textarea></td>
						</tr>
						
						<tr>
							<td class="first_col">การเรียงของหมวดหมู่<font class="required"><span>*</span><span></span></font>:</td>
							<td>
								<!-- <label><input type="radio" name="CN_DisplayConfig" value="1" <?php if($cNews['CN_DisplayConfig'] == '1') echo "checked"?>> ปกติ</label> -->
								<label><input type="radio" name="CN_DisplayConfig" value="1" <?php if($cNews['CN_DisplayConfig'] == '1') echo "checked"?>> New ขึ้นก่อน</label>
								<label><input type="radio" name="CN_DisplayConfig" value="2" <?php if($cNews['CN_DisplayConfig'] == '2') echo "checked"?>> Hot ขึ้นก่อน</label>
								<label><input type="radio" name="CN_DisplayConfig" value="3" <?php if($cNews['CN_DisplayConfig'] == '3') echo "checked"?>> Update ขึ้นก่อน</label>
							</td>
						</tr>
						<tr>
							<td class="first_col">การเผยแพร่ที่ปฏิทินกิจกรรม<font class="required"><span>*</span><span></span></font>:</td>
							<td>
								<label><input type="radio" name="CN_ActivityCheck" value="1" <?php if($cNews['CN_ActivityCheck'] == '1') echo "checked"?>> เผยแพร่</label>
								<label><input type="radio" name="CN_ActivityCheck" value="2" <?php if($cNews['CN_ActivityCheck'] == '2') echo "checked"?>> ไม่เผยแพร่</label>
							</td>
						</tr>
						<tr>
							<td class="first_col">สถานะ<font class="required"><span>*</span><span></span></font>:</td>
							<td>
								<select name="CN_Allow" class="select se_small">
									<option value="1" <?php if($cNews['CN_Allow'] == '1') echo 'selected'?>>เผยแพร่</option>
									<option value="2" <?php if($cNews['CN_Allow'] == '2') echo 'selected'?>>ไม่เผยแพร่</option>
								</select>
							</td>
						</tr>
						<?php if($mode == 'edit'){?>
							<tr>
								<td class="first_col top">อัพเดทล่าสุด:</td><td><?php echo $cNews['CN_UserUpdate'];?> เวลา <?php echo formatDateThaiFromDatatime($cNews['CN_DateTimeUpdate']);?></td>
							</tr>
						<?php }?>
						<tr>
							<td colspan='3'>
								<center>
									<input type='submit' name="bt_submit" value='บันทึกข้อมูล' hidden='hidden'>
									<button title="บันทึกข้อมูล" type='submit' class="bt_tools bt_save" onclick="$('input[name=bt_submit]').click()"><i class="fa fa-pencil-square-o"></i> บันทึกข้อมูล</button>						
									<?php if($mode == 'edit'){?>
										<button title="ลบ" type='button' class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){ window.location.href='<?php echo base_url(uri_seg(1)."/".uri_seg(2)."/del/{$cNews['CN_ID']}");?>';}else{ return false;}"><i class="fa fa-trash-o"></i> ลบข้อมูล</button>
									<?php }?>
									<button title="กลับไปยังรายการ" type='button' class="bt_tools bt_cancel"  onclick="window.location.href='<?php echo base_url(uri_seg(1)."/".uri_seg(2));?>'"><i class="fa fa-undo"></i> กลับไปยังรายการ</button>
								</center>
							</td>
						</tr>
					</table>
				<?php echo form_close();?>
			</div>
		</div>
		<script type="text/javascript">
			$('#myDropdown').ddslick({
				background: '#f0f0f0',
				width :300,
			    onSelected: function(selected){
			        $('#CNI_ID').val(selected.selectedData.value);
			    },
			});
		</script>
	<?php }?>
<?php }elseif($P_ID == 22){?>
	<?php if($mode == ''){?>
		<div class="wrap_data">
			<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
			<?php echo css_asset("../plugin/datatable/css/jquery.dataTables.min.css");?>
			<?php echo js_asset("../plugin/datatable/js/jquery.js");?>
			<?php echo js_asset("../plugin/datatable/js/jquery.dataTables.min.js");?>
			<div class="table_result">
				<div class="command">
					<button title="เพิ่มข้อมูลใหม่" type='button' class="bt_tools bt_add"  onclick="window.location.href='<?php echo base_url(uri_seg(1)."/".uri_seg(2)."/add")?>'"><i class="fa fa-plus"></i> เพิ่มข้อมูลใหม่</button>
				</div>
				<table id="datatable">
					<thead>
						<th>ID</th>
						<th>ไอคอนสัญลักษณ์</th>
						<th>ชื่อไอคอน</th>
						<th>ลำดับการแสดง</th>
						<th>สถานะการแสดง</th>
						<th>เครื่องมือ</th>
					</thead>
					<tbody>
					<?php foreach ($cnIcon as $row) { 
						$iName = uns($row['CNI_Name']);
						$allow = array('1' => "เผยแพร่", '2' => "ไม่เผยแพร่");?>
						<tr>
							<td class="td-numeric"><?php echo $row['CNI_ID'];?></td>
							<td class="td-image">
							<?php 
								if($row['CNI_Img']!=''){
									echo image_asset($row['CNI_Img'],'news',array('width'=>'32px','height'=>'32px'));
								}else{
									echo image_asset('noimage.gif',array('width'=>'32px','height'=>'32px'));
								}
							?>
							</td>
							<td><?php echo $iName['TH'];?></td>
							<td class="td-numeric"><?php echo $row['CNI_Order'];?></td>
							<td><?php echo $allow[$row['CNI_Allow']];?></td>
							<td class="td-image" width="25%">
								<button title="เลื่อนลำดับขึ้น" type='button' class="bt_tools bt_order_up" onclick="window.location.href ='<?php echo base_url('news/category_icon/up/'.$row['CNI_ID']);?>';"><i class="fa fa-angle-up"></i> ขึ้น</button>
								<button title="เลื่อนลำดับลง" type='button' class="bt_tools bt_order_down" onclick="window.location.href ='<?php echo base_url('news/category_icon/down/'.$row['CNI_ID']);?>';"><i class="fa fa-angle-down"></i> ลง</button>
					            <button title="แก้ไข" type='button' class="bt_tools bt_edit" onclick="window.location.href ='<?php echo base_url('news/category_icon/edit/'.$row['CNI_ID']);?>';"><i class="fa fa-pencil"></i> แก้ไข</button>
					            <button title="ลบ" type='button' class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){ window.location.href='<?php echo base_url('news/category_icon/del/'.$row['CNI_ID']);?>';}else{ return false;}"><i class="fa fa-trash-o"></i> ลบ</button>
							</td>
						</tr>
					<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<script type="text/javascript">
			$('#datatable').DataTable({'iDisplayLength': 25,"aaSorting": []});
		</script>
	<?php }elseif($mode == 'add' || $mode == 'edit'){?>
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
							</td>
						</tr>
						<tr>
							<td class="first_col">ไอคอนสัญลักษณ์<?php if($mode == 'add'){?><font class="required"><span>*</span><span>32x32PX</span></font><?php }?>:</td>
							<td>
								<img style="max-height:200px;" class="myPreview" src="<?php if($nIcons['CNI_Img']!=''){echo base_url('assets/modules/news/images/'.$nIcons['CNI_Img']);}?>"><br>
								<input title="ไอคอนสัญลักษณ์" name="CNI_Img" type="file" onclick="resetValue('CNI_Img','hidden');" onchange="imgPerview(this,'.myPreview');">
								<a class="filesBrowser bt_tools bt_upload" href="#fb"
									data-module="news"
									data-open="images"
									data-showid=".myPreview"
									data-saveid="#selected_json"
									data-multi="false"
									onclick="init($(this));resetValue('CNI_Img','file');">
								<i class="fa fa-upload"></i> เลือกไฟล์</a>
								<input id="selected_json" name="CNI_Img" type="hidden">
							</td>
						</tr>
						<tr>
							<td class="first_col">ชื่อไอคอน<font class="required"><span>*</span><span></span></font>:</td>
							<td class="th"><input title="ชื่อไอคอน" name="CNI_Name[TH]" type="text" class="txtinput in_large fileName" value="<?php echo $nIcons['CNI_Name']['TH'];?>" required ></td>
							<td class="en" style="display:none"><input title="Icon Name" name="CNI_Name[EN]" type="text" class="txtinput in_large fileName" value="<?php echo $nIcons['CNI_Name']['EN'];?>"></td>
						</tr>
						<tr>
							<td class="first_col">สถานะ:</td>
							<td>
								<select name="CNI_Allow" class="select se_small">
									<option value="1" <?php if($nIcons['CNI_Allow'] == '1') echo 'selected'?>>เผยแพร่</option>
									<option value="2" <?php if($nIcons['CNI_Allow'] == '2') echo 'selected'?>>ไม่เผยแพร่</option>
								</select>
							</td>
						</tr>
						<?php if($mode == 'edit'){?>
							<tr>
								<td class="first_col top">อัพเดทล่าสุด:</td><td><?php echo $nIcons['CNI_UserUpdate'];?> เวลา <?php echo formatDateThaiFromDatatime($nIcons['CNI_DateTimeUpdate']);?></td>
							</tr>
						<?php }?>
						<tr>
							<td colspan='3'>
								<center>
									<input type='submit' name="bt_submit" value='บันทึกข้อมูล' hidden='hidden'>
									<button title="บันทึกข้อมูล" type='submit' class="bt_tools bt_save" onclick="$('input[name=bt_submit]').click()"><i class="fa fa-pencil-square-o"></i> บันทึกข้อมูล</button>						
									<?php if($mode == 'edit'){?>
										<button title="ลบ" type='button' class="bt_tools bt_del" onclick="if(confirm('ยืนยันการลบข้อมูล!')){ window.location.href='<?php echo base_url(uri_seg(1)."/".uri_seg(2)."/del/{$nIcons['CNI_ID']}");?>';}else{ return false;}"><i class="fa fa-trash-o"></i> ลบข้อมูล</button>
									<?php }?>
									<button title="กลับไปยังรายการ" type='button' class="bt_tools bt_cancel"  onclick="window.location.href='<?php echo base_url(uri_seg(1)."/".uri_seg(2));?>'"><i class="fa fa-undo"></i> กลับไปยังรายการ</button>
								</center>
							</td>
						</tr>
					</table>
				<?php echo form_close()?>
			</div>
		</div>
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
		if(nowIndex != item.index()){
			nowIndex = item.index();

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
<?php }?>