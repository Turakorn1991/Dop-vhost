$(document).ready(function () {
	$('#parent_0').on('change', ':checkbox', function () {
		var status_che = $(this).prop('checked');


		if (status_che == true) {
			$(this).parent().css('height', '30px');
		} else {
			$(this).parent().css('height', '');
		}
	});

	$('#parent_0').on('click', '.trash', function () {

		if (confirm('กรุณายืนยันการลบ')) {
			$('#parent_0  :checkbox').each(function () {

				if ($(this).prop('checked') == true) {
					$(this).parent().parent().parent().remove();
				}
			});

			$(this).parent().parent().parent().remove();
			$('.photo-hide').removeClass('photo-hide');
		}
	});
});

/* Modal Script Setting */
$('#savbtnYes').click(function () {
	$("input[name='bt_submit']").click();
}); //button save form

$('#dltbtnYes').click(function () { //button delete
	window.location.replace(base_url + 'adaptenvir/assist3' + '/Delete/' + $('#dltModel').data('id'));
});

$('#bckbtnYes').click(function () { //button back
	window.location.replace(base_url + 'adaptenvir/adaptenvir_list');
});

var opn = function (node) { //dialog check delete
	var id = $(node).data('id');
	$('#dltModel').data('id', id).modal('show');
}

var opnCnfrom = function () { //dialog check before submit form
	var i = 0,
		j = 0;
	$($("[required]")).each(function () {
		if ($(this).val() == '') {
			$(this).attr("title", "กรุณาใส่ข้อมูล");
			$(this).attr("data-original-title", "กรุณาใส่ข้อมูล");
			$(this).tooltip("show");
			i = 1;
		} else {
			$(this).attr("title", "");
			$(this).attr("data-original-title", "");
		}
		j++;
		if (j >= $("[required]").length && i == 0) {
			//console.log(j+':'+i);
			//console.log(frmKey);
			if (frmKey == true) {
				$('#sbmCnfrm').modal('show');
				return false;
			} else return true;
		}
	});
	$($("[required]")).each(function () {
		if ($(this).val() == '') {
			$(this).focus();
			return false;
		}
	});
}

var opnBck = function () { //dialog check before back
	//console.log(frmKey);
	if (frmKey == true) {
		$('#bckCnfrm').modal('show');
		return false;
	} else return true;
}

$("#form1").keyup(function () {
	frmKey = true;
});
/* End Modal Script Setting */

$('#dltbtnYes_photo').click(function () { //button delete
	console.log($('#dltModel_photo').data('id'));
	//window.location.replace(base_url+'school/center_kpi'+'/Delete/'+$('#dltModel').data('id'));
	window.location.replace(base_url + 'adaptenvir/delete_impv_photo' + '?' + 'photo_id=' + $('#dltModel_photo').data('photoid')); //add code
	//window.location.replace(base_url+'school'+'/del_impv_photo'+'?'+'photo_id='+$('#dltModel').data('photoid')); //add code
});

var opn_photo = function (node) { //dialog check delete
	var id = $(node).data('id');
	var photo_id = $(node).data('photoid'); //add code
	$('#dltModel_photo').data('id', id).data('photoid', photo_id).modal('show'); //add code date
}

function brwImg(node, myID) {
	$(node).prev().click();
}



function imgchange(node, myID) {

	var imgPath = $(node)[0].value;

	var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	//===opal====
	$('.btn-save').prop('disabled', false); //TO ENABLE


	if (extn == "png" || extn == "jpg" || extn == "jpeg") {
		if (typeof (FileReader) != "undefined") {
			if ($(node)[0].files[0].size < 5242880) {
				var reader = new FileReader();

				reader.onload = function (e) {


					var img_file = '<div class="container2"><img src="' + e.target.result + '" alt="..."  class="image">\
								  <div class="overlay">\
									  <input type="checkbox" class="che_del" > <span class="glyphicon glyphicon-trash trash" aria-hidden="true"></span>' +
						'</div></div>';

					$(img_file).appendTo($(node).parent());
					$(node).siblings('button').css('display', 'none');


					var photo_hide = $('.photo-contianer').length>9?'photo-hide':'';
					var add_img =
						'<div class="col-xs-12 col-sm-4 col-lg-3 element photo-contianer '+photo_hide+'" style="margin-top: 20px; height:300px; word-wrap: break-word;">' +
						'<text class="text-left">' +
						'<b style="color: red;">ชื่อภาพ* : </b>' +
						'</text>' +

						'<input type="text" name="photo2[]" maxlength="25" style="width:210px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"> <!-- 270px, 210px -->' +

						'<input type="file" name="img[]"  class="img_0" accept="image/png, image/jpeg"  style="display: none;" onchange="imgchange(this,\'\');">' +

						'<button type="button" class="btn btn-lg" style="width: 268px; height:150px;"   onclick="brwImg(this,\'\');">' +
						'<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>' +
						'</button>' +
						'</div>';

					$(node).parent().parent().append(add_img);

				}
				reader.readAsDataURL($(node)[0].files[0]);
			} else {
				alert("รูปภาพขนาดใหญ่เกินไป! ระบรองรับรูปภาพไม่เกิน 5 MB ต่อหนึ่งภาพ");
			}
		} else {
			alert("This browser does not support FileReader.");
		}

	} else {
		alert("กรุณาเลือกไฟล์เป็นชนิด รูปภาพ");
	}

} //close loop function