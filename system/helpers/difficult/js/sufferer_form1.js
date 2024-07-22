
$(document).ready(function(){
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
$('.savbtnYes').click(function(event) {
	if($(event.target).hasClass("sms")){
	
		$("input[name='sms']").val("true");
	}
	$("input[name='bt_submit']").click();
}); //button save form

$('#dltbtnYes').click(function() {//button delete
	console.log($('#dltModel').data('id'));
    window.location.replace(base_url+'difficult/sufferer_form1'+'/Delete/'+$('#dltModel').data('id'));
});

$('#bckbtnYes').click(function() {//button back
    window.location.replace(base_url+'difficult/assist_list');
});

var opn = function(node) { //dialog check delete
    var id = $(node).data('id');
    $('#dltModel').data('id', id).modal('show');
}

var opnCnfrom = function() { //dialog check before submit form
	var i = 0,j=0;
	$($("[required]")).each(function() {
	    if($(this).val()==''){
	    	$(this).attr("title","กรุณาใส่ข้อมูล");
	    	$(this).attr("data-original-title","กรุณาใส่ข้อมูล");
	    	$(this).tooltip("show"); 
	    	i=1;
	  	}else {
	  		$(this).attr("title","");
	  		$(this).attr("data-original-title","");
	  	}
	  	j++;
	  	if(j>=$("[required]").length && i==0) {
	  		//console.log(j+':'+i);
			//console.log(frmKey);
			if(frmKey==true){$('#sms').modal('show'); return false; }
			else return true;
	  	}
	});
	$($("[required]")).each(function() {
	    if($(this).val()==''){
	    	$(this).focus();
	    	return false;
	  	}
	});
}



var opnBck = function() { //dialog check before back
	//console.log(frmKey);
	if(frmKey==true){$('#bckCnfrm').modal('show'); return false; }
	else return true;
}

$( "#form1" ).keyup(function() {
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
/* End Modal Script Setting */
