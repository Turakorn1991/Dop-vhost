$(document).ready(function () {
	$(".btn-save").click(function () {
		if ($("#req_name").html() === " - ") {
			toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้ยืนคำขอ", "หน้าต่างแจ้งเตือน");
		} else if ($("#name").html() === " - ") {
			toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");
		} else if ($("input[name='diff_info[date_of_req]']").html() === " - ") {
			toastr.error("โปรดระบุวันที่แจ้งเรื่อง", "หน้าต่างแจ้งเตือน");
		} else if ($("input[name='diff_info[chn_code]']").val()  === "") {
			toastr.error("โปรดระบุช่องทางการแจ้งเรื่อง", "หน้าต่างแจ้งเตือน");
		} else {
			return opnCnfrom();
		}
	});


	$("#elder_addr_chk").on("ifClicked",function() {
		if(!$(this).prop("checked")){			
			showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');
			let tokenRequest = $('#currtoken').val();
			//console.log(tokenRequest)
			//showloadersc('warning','กรุณารอสักครู่ กำลังโหลดข้อมูล !');
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
							//console.log('>>>>>>>>',dataArea)	
							closeloadswal();				
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
					//console.log('ดึงข้อมูล Address ไม่ได้')
					toastr.error("โปรดตรวจสอบข้อมูลเลขบัตรประจำตัวประชาชนผู้สูงอายุ", "หน้าต่างแจ้งเตือน");  
				},
				dataType: "json",
			});

			$(".elder_addr_pre").attr('disabled',true);
		}else{
			$(".elder_addr_pre").attr('disabled',false);
		}
	});
	
});

/*	
	$('#Province').change(function (argument) {
		$('#lane').select2({
	    // placeholder: 'ค้นหา อปท.',
	    minimumInputLength: 3,
	    ajax: {
	      url: base_url+'personals/getLane/'+$('#Province').val(),
	      type:'get',
	      dataType: 'json',
	      delay: 1000,
	      processResults: function (data) {
	        return {
	          results: data
	        };
	      }//,
	      //cache: true
	    }
	  });

	  $('#road').select2({
	    // placeholder: 'ค้นหา อปท.',
	    minimumInputLength: 3,
	    ajax: {
	      url: base_url+'personals/getRoad/'+$('#Province').val(),
	      type:'get',
	      dataType: 'json',
	      delay: 1000,
	      processResults: function (data) {
	        return {
	          results: data
	        };
	      }//,
	      //cache: true
	    }
	  });
	});
*/

$('select.elder_addr_pre').select2();


// $('select').select2();
// $('select').chosen();

/* Modal Script Setting */
//$('#savbtnYesSms').click(function() {$("input[name='bt_submit']").click();}); //button save form
$('.savbtnYes').click(function (event) {
	if ($(event.target).hasClass("sms")) {

		$("input[name='sms']").val("true");
	}
	$("input[name='bt_submit']").click();
}); //button save form

$('#dltbtnYes').click(function () { //button delete
	console.log($('#dltModel').data('id'));
	window.location.replace(base_url + 'difficult/sufferer_form1' + '/Delete/' + $('#dltModel').data('id'));
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
				$('#sms').modal('show');
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
$("#guide-book").click(function(){
    window.open('/assets/modules/difficult/guide/Diff_Manual.pdf', '_blank');
  });


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

// //name 
// function txtvalid(event){
// 	var input = event.value;
// 	var result ="";
// 	for (var i = 0; i < input.length; i++) {
// 		if(input.charAt(i).match(/^[ก-ฮะ-์]/ig))
// 			result += input.charAt(i);
// 	}
// 	event.value = result;
// 	//retuevent.replace(/^[ก-๙]+$/ig,"");

// }
// End Modal Script Setting