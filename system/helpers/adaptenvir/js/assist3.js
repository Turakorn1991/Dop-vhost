
$(document).ready(function(){


});

/* Modal Script Setting */
$('#savbtnYes').click(function() {$("input[name='bt_submit']").click();}); //button save form

$('#dltbtnYes').click(function() {//button delete
    window.location.replace(base_url+'adaptenvir/assist3'+'/Delete/'+$('#dltModel').data('id'));
});

$('#bckbtnYes').click(function() {//button back
    window.location.replace(base_url+'adaptenvir/adaptenvir_list');
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
			if(frmKey==true){$('#sbmCnfrm').modal('show'); return false; }
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
/* End Modal Script Setting */

$('#dltbtnYes_photo').click(function() {//button delete
	console.log($('#dltModel_photo').data('id'));
	//window.location.replace(base_url+'school/center_kpi'+'/Delete/'+$('#dltModel').data('id'));
	window.location.replace(base_url+'adaptenvir/delete_impv_photo'+'?'+'photo_id='+$('#dltModel_photo').data('photoid')); //add code
	//window.location.replace(base_url+'school'+'/del_impv_photo'+'?'+'photo_id='+$('#dltModel').data('photoid')); //add code
});

var opn_photo = function(node) { //dialog check delete
	var id = $(node).data('id');
	var photo_id = $(node).data('photoid'); //add code
	$('#dltModel_photo').data('id', id).data('photoid',photo_id).modal('show'); //add code date
}