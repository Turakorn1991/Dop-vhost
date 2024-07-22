
<div class="wrap_form">
	<br><br>
	<div class="h3">&nbsp;&nbsp;<?php echo $title;?></div>
	<?php echo form_open_multipart('webconfig/site_setting','id=form_input');?>

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
				<td class="first_col">โลโก้<font class="required"><span>*</span><span>616x616px</span></font>:</td>
				<td><?php 
					if($site['WD_Logo']!=''){
						echo image($site['WD_Logo'],'webconfig',array('class'=>'previewLogo','width'=>'64px','height'=>'64px'));
					}else{
						echo image('noimage.gif','',array('class'=>'previewLogo','width'=>'64px','height'=>'64px'));
					}?>&nbsp;
					<input title="โลโก้" name="WD_Logo" type="file" onclick="resetValue('WD_Logo','hidden');" onchange="imgPerview(this,'.previewLogo');">
					<a id="logo" class="filesBrowser bt_tools bt_upload" href="#fb"
						data-module="webconfig"
						data-open="images"
						data-showid=".previewLogo"
						data-saveid="#selected_json"
						data-multi="false"
						onclick="init($(this));resetValue('WD_Logo','file');">
					<i class="fa fa-upload"></i> เลือกไฟล์</a>
					<input id="selected_json" name="WD_Logo" type="hidden">
				</td>
			</tr>
			<tr>
				<td class="first_col">ไอคอน<font class="required"><span>*</span><span>32x32px</span></font>:</td>
				<td><?php 
					if($site['WD_Icon']!=''){
						echo image($site['WD_Icon'],'webconfig',array('class'=>'previewIcon','width'=>'32px','height'=>'32px'));
					}else{
						echo image('noimage.gif','',array('class'=>'previewIcon','width'=>'32px','height'=>'32px'));
					}?>&nbsp;
					<input title="ไอคอน" name="WD_Icon" type="file" onclick="resetValue('WD_Icon','hidden');" onchange="imgPerview(this,'.previewIcon');">
					<a id="icon" class="filesBrowser bt_tools bt_upload" href="#fb"
						data-module="webconfig"
						data-open="images"
						data-showid=".previewIcon"
						data-saveid="#selected_json2"
						data-multi="false"
						onclick="init($(this));resetValue('WD_Icon','file');">
					<i class="fa fa-upload"></i> เลือกไฟล์</a>
					<input id="selected_json2" name="WD_Icon" type="hidden">

				</td>	
			</tr>

			<tr>
				<td class="first_col">ภาพ header<font class="required"><span>*</span><span>ขนาดที่เหมาะสม หรือ 1800x920px</span></font>:</td>
				<td><?php 
					if($site['WD_ImgHeader']!=''){
						echo image($site['WD_ImgHeader'],'webconfig',array('class'=>'previewHeader','height'=>'100px'));
					}else{
						echo image('noimage.gif','',array('class'=>'previewHeader','width'=>'32px','height'=>'32px'));
					}?><br>
					<input title="ภาพ header" name="WD_ImgHeader" type="file" onclick="resetValue('WD_ImgHeader','hidden');" onchange="imgPerview(this,'.previewHeader');">
					<a id="head" class="filesBrowser bt_tools bt_upload" href="#fb"
						data-module="webconfig"
						data-open="images"
						data-showid=".previewHeader"
						data-saveid="#selected_json3"
						data-multi="false"
						onclick="init($(this));resetValue('WD_ImgHeader','file');">
					<i class="fa fa-upload"></i> เลือกไฟล์</a>
					<input id="selected_json3" name="WD_ImgHeader" type="hidden">
				</td>	
			</tr>

			<tr>
				<td class="first_col">ภาพพื้นหลัง<font class="required"><span>*</span><span>ขนาดที่เหมาะสม หรือ 1800x2250px</span></font>:</td>
				<td><?php 
					if($site['WD_BG']!=''){
						echo image($site['WD_BG'],'webconfig',array('class'=>'previewBG','height'=>'100px'));
					}else{
						echo image('noimage.gif','',array('class'=>'previewBG','width'=>'32px','height'=>'32px'));
					}?>&nbsp;
				<br>
				<input title="ภาพพื้นหลัง" name="WD_BG" type="file" onclick="resetValue('WD_BG','hidden');" onchange="imgPerview(this,'.previewBG');">
				<a id="BG" class="filesBrowser bt_tools bt_upload" href="#fb"
					data-module="webconfig"
					data-open="images"
					data-showid=".previewBG"
					data-saveid="#selected_json4"
					data-multi="false"
					onclick="init($(this));resetValue('WD_BG','file');">
				<i class="fa fa-upload"></i> เลือกไฟล์</a>
				<input id="selected_json4" name="WD_BG" type="hidden">

				</td>	

			</tr>


			
			<tr>

				<td class="first_col">ชื่อ<font class="required"><span>*</span><span></span></font>:</td>
				<td class="th"><input title="ชื่อ" name="WD_Name[TH]" type="text" class="txtinput in_medium" value="<?php echo $site['WD_Name']['TH'];?>" required autofocus></td>
				<td class="en" style="display:none"><input title="Name" name="WD_Name[EN]" type="text" class="txtinput in_medium" value="<?php echo $site['WD_Name']['EN'];?>" required></td>

			</tr>
			<tr>

				<td class="first_col">ชื่อ สำนัก/กอง<font class="required"><span>*</span><span></span></font>:</td>
				<td class="th"><input title="ชื่อ สำนัก/กอง" name="WD_SubName[TH]" type="text" class="txtinput in_medium" value="<?php echo $site['WD_SubName']['TH'];?>" required></td>
				<td class="en" style="display:none"><input title="Division Name" name="WD_SubName[EN]" type="text" class="txtinput in_medium" value="<?php echo $site['WD_SubName']['EN'];?>" required></td>

			</tr>
			<tr>

				<td class="first_col top">ที่อยู่:</td>
				<td class="th"><textarea title="ที่อยู่" name="WD_Address[TH]" class="txtarea ar_large"><?php echo $site['WD_Address']['TH'];?></textarea></td>
				<td class="en"><textarea title="Address" name="WD_Address[EN]" class="txtarea ar_large"><?php echo $site['WD_Address']['EN'];?></textarea></td>	
			</tr>
			<tr>
				<td class="first_col">อีเมล<font class="required"><span>*</span><span></span></font>:</td><td><input title="อีเมล" name="WD_Email" type="email" class="txtinput in_medium" value="<?php echo $site['WD_Email'];?>" required></td>			
			</tr>
			<tr>
				<td class="first_col">เบอร์โทรศัพท์:</td><td><input title="เบอร์โทรศัพท์" name="WD_Tel" type="text" class="txtinput in_large" value="<?php echo $site['WD_Tel'];?>"></td>
			</tr>
			<tr>
				<td class="first_col">โทรสาร:</td><td><input title="โทรสาร" name="WD_Fax" type="text" class="txtinput in_large" value="<?php echo $site['WD_Fax'];?>"></td>
			</tr>
			<tr>
				<td class="first_col">สายด่วน:</td><td><input title="สายด่วน" name="WD_Hotline" type="text" class="txtinput in_large" value="<?php echo $site['WD_Hotline'];?>"></td>
			</tr>
			<tr>
				<td class="first_col">ลิงค์ facebook:</td><td><input title="ลิงค์ facebook" name="WD_Facebook" type="url" class="txtinput in_large" value="<?php echo $site['WD_Facebook'];?>"></td>
			</tr>
			<tr>
				<td class="first_col">ลิงค์ youtube:</td><td><input title="ลิงค์ youtube" name="WD_Youtube" type="url" class="txtinput in_large" value="<?php echo $site['WD_Youtube'];?>"></td>
			</tr>
			<tr>
				<td class="first_col">หมุดในแผนที่<font class="required"><span>*</span><span>64x64px</span></font>:</td>
				<td><?php 
					if($site['WD_ImgMap']!=''){
						echo image($site['WD_ImgMap'],'webconfig',array('class'=>'previewMK','width'=>'64px','height'=>'64px'));
					}else{
						echo image('noimage.gif','',array('class'=>'previewMK','width'=>'64px','height'=>'64px'));
					}?>&nbsp;
					<input title="หมุดในแผนที่" name="WD_ImgMap" type="file" onclick="resetValue('WD_ImgMap','hidden');" onchange="imgPerview(this,'.previewMK');">
					<a id="MK" class="filesBrowser bt_tools bt_upload" href="#fb"
						data-module="webconfig"
						data-open="images"
						data-showid=".previewMK"
						data-saveid="#selected_json5"
						data-multi="false"
						onclick="init($(this));resetValue('WD_ImgMap','file');">
					<i class="fa fa-upload"></i> เลือกไฟล์</a>
					<input id="selected_json5" name="WD_ImgMap" type="hidden">
				</td>
			</tr>
			<tr>
				<td class="first_col">ละติจูด<font class="required"><span>*</span><span></span></font>:</td><td><input title="ละติจูด" name="WD_Latitude" type="text" class="txtinput in_medium" value="<?php echo $site['WD_Latitude'];?>" required></td>	
			</tr>
			<tr>
				<td class="first_col">ลองจิจูด<font class="required"><span>*</span><span></span></font>:</td><td><input title="ลองจิจูด" name="WD_Longjitude" type="text" class="txtinput in_medium" value="<?php echo $site['WD_Longjitude'];?>" required></td>
			</tr>
			<tr>

				<td class="first_col top">ไตเติ้ล/เรื่องย่อ:</td>
				<td class="th"><textarea title="ไตเติ้ล/เรื่องย่อ" name="WD_Title[TH]" class="txtarea ar_large"><?php echo $site['WD_Title']['TH'];?></textarea></td>
				<td class="en" style="display:none"><textarea title="Title/Paragraph" name="WD_Title[EN]" class="txtarea ar_large"><?php echo $site['WD_Title']['EN'];?></textarea></td>
			</tr>
			<tr>
				<td class="first_col top">รายละเอียด:</td>
				<td class="th"><textarea title="รายละเอียด" name="WD_Descrip[TH]" class="txtarea ar_large"><?php echo $site['WD_Descrip']['TH'];?></textarea></td>
				<td class="en" style="display:none"><textarea title="Descript" name="WD_Descrip[EN]" class="txtarea ar_large"><?php echo $site['WD_Descrip']['EN'];?></textarea></td>
			</tr>
			<tr>
				
				<td class="first_col top">คีย์เวิร์ด<font class="required"><span>*</span><span></span></font>:</td>
				<td class="th"><textarea title="คีย์เวิร์ด" name="WD_Keyword[TH]" class="txtarea ar_large" required><?php echo $site['WD_Keyword']['TH'];?></textarea></td>
				<td class="en" style="display:none"><textarea title="Keyword" name="WD_Keyword[EN]" class="txtarea ar_large" required><?php echo $site['WD_Keyword']['EN'];?></textarea></td>

			</tr>
			<tr>
				<td class="first_col top">อัพเดทล่าสุด:</td><td><?php echo $site['M_ThNameAdd'];?> เวลา <?php echo formatDateThaiFromDatatime($site['WD_DatetimeUpdate']);?></td>
			</tr>
			<tr>
				<td colspan='6'>
					<center>
						<input type="submit" name="bt_submit" hidden="hidden">
						<button name="bt_submit" title="บันทึกข้อมูล" class="bt_tools bt_save" onclick="$('input[name=bt_submit]').click()"><i class="fa fa-pencil-square-o"></i></i>บันทึกข้อมูล</button>
						<!-- &nbsp;<input title="คืนค่า" type='reset' value='คืนค่า' class="bt_tools bt_cancel">-->
					</center>
				</td>
			</tr>		
		</table>	
	</div>
	<?php echo form_close();?>
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
			if(type == 'images'){
				editNameimg(select_fileName);
			}else{
				editNameinput(select_fileName);
			}
			
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
		    	var eexxtt = fname[fname.length-1];
				delete fname[fname.length-1];
				fname = fname.join('.');
				fname = fname.substring(0,fname.length-1);
				if(eexxtt == 'pdf'){
		    		$('<li>')
				        .append($("<span>", {"class": "th"})
				           	.append($('<input />',{'name': 'WMD_Name[TH]','type':'text','class':'txtinput in_medium'}).val(fname))
				        )
				        .append($("<span>", {"class": "en"}).css('display', 'none')
				           	.append($('<input />',{'name': 'WMD_Name[EN]','type':'text','class':'txtinput in_medium'}).val(fname))
				       )
			        .appendTo(file_holder);
			        file_holder.show();
		    	}else{
		    		$('<li class="form_message_error">').text('กรุณาเลือกไฟล์ในรูปแบบ PDF').appendTo(file_holder);
					saveID.value = '';
				   	//console.log(input.files);
				    file_holder.show();
		    	} 
		    }
    }
    function editNameimg(input){
    	var countFiles = input.length;
	    var file_holder = showID;
	    file_holder.empty();
		    for (var i = 0; i < countFiles; i++) {
		    	var fname = input[i].split('.');
				delete fname[fname.length-1];
				fname = fname.join('.');
				fname = fname.substring(0,fname.length-1);
				$('<li >')
			        .append($('<img>').addClass('img'+i).css('max-height', '100px').attr('src', base+"/"+display_path+"/"+input[i]))
			        .append($('<br>'))
		       	 	.append($('<input />',{'name': 'IAL_Name['+i+']','type':'text','class':'txtinput in_medium'}).val(fname))
				    .append($("<label>").text('ภาพที่ '+(i+1)).css('margin-left', '10px'))
			    .appendTo(file_holder);
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