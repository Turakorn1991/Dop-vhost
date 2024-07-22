
$(document).ready(function(){


});

/* Modal Script Setting */
$('#savbtnYes').click(function() {$("input[name='bt_submit']").click();}); //button save form

$('#dltbtnYes').click(function() {//button delete
    window.location.replace(base_url+'difficult/sufferer_form3'+'/Delete/'+$('#dltModel').data('id'));
});

$('#bckbtnYes').click(function() {//button back
    window.location.replace(base_url+'difficult/assist_list');
});

var opn = function(node) { //dialog check delete
    var id = $(node).data('id');
    $('#dltModel').data('id', id).modal('show');
}

var opnCnfrom = function() { //dialog check before submit form
	//console.log(frmKey);
	if(frmKey==true){$('#dltCnfrm').modal('show'); return false; }
	else return true;
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
