$(document).ready(function () {
	$(".btn-save").click(function () {
		if ($("input[name='diff_info[date_of_visit]']").html() === " ") {
			toastr.error("โปรดระบุวันที่ตรวจเยี่ยม", "หน้าต่างแจ้งเตือน");
		} else if ($("input[name='diff_info[visit_place]']").val() === "") {
			toastr.error("โปรดระบุสถานที่ตรวจเยี่ยม", "หน้าต่างแจ้งเตือน");
		} else if ($("input[name='diff_info[visit_place]']").val() === "อื่น ๆ" &&
			$("input[name='diff_info[visit_place_identify]']").val() === "") {
			toastr.error("โปรดระบุสถานที่ตรวจเยี่ยม", "หน้าต่างแจ้งเตือน");
		} else {
			return opnCnfrom();
		}
	});
});

/* Modal Script Setting */
$('#savbtnYes').click(function () {
	$("input[name='bt_submit']").click();
}); //button save form

$('#dltbtnYes').click(function () { //button delete
	window.location.replace(base_url + 'difficult/sufferer_form2' + '/Delete/' + $('#dltModel').data('id'));
});

$('#bckbtnYes').click(function () { //button back
	window.location.replace(base_url + 'difficult/assist_list');
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
$("#guide-book").click(function(){
    window.open('/assets/modules/difficult/guide/Diff_Manual.pdf', '_blank');
});
/* End Modal Script Setting */