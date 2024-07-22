$(document).ready(function(){
    auto_setformat();
});
function auto_setformat(){
   // $.mask.definitions['h'] = "[1-9]";
    $(".phone").mask("9999999999",{allow:true});
    $(".date").mask("99/99/9999");
    $(".numberZipcode").mask("99999");
    $('.numeric').number( true, 2 );//$('#numberic').number( true, 2,'.','' )
    $('.numberonly').number( true ,0,'','');
    $('.input_idcard').mask("9-9999-99999-99-9");
	$('.death_certificate_no').mask("99-99999999");
}
//name 
function thvalidate(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[ก-ฮะ-์\s]/ig))
			result += input.charAt(i);
	}
	event.value = result;
	
}
function numbervalid(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function avgincomevalidate(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}

function deptvalidate(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9,.]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function nonthnumber(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/[^๑-๙]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function nonthai(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/[^๑-๙ก-ฮะ-์]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function numberndot(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9.]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function numberandth(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[ก-ฮะ-์0-9\s]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function housenumber(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9/-]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function addressvalidate(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9ก-ฮะ-์/]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function nonthnumandsym(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9ก-ฮะ-์a-zA-Z]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function thnodash(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/^[0-9ก-ฮะ-์-]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}
function nonthnumandeng(event){
	var input = event.value;
	var result ="";
	for (var i = 0; i < input.length; i++) {
		if(input.charAt(i).match(/[^๑-๙a-zA-Z]/ig))
			result += input.charAt(i);
	}
    event.value = result;
    
}

function formatMoney(input){
	var num = input.value.replace(/\,/g,'');
	if(!isNaN(num)){
		if(num.indexOf('.') > -1){
			num = num.split('.');
			num[0] = num[0].toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'');
			if(num[1].length > 2){
				alert('You may only enter two decimals!');
				num[1] = num[1].substring(0,num[1].length-1);
			}input.value = num[0]+'.'+num[1];
		} else{ input.value = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,').split('').reverse().join('').replace(/^[\,]/,'') };
	}
	else{ 
		//return false;
		input.value = input.value.substring(0,input.value.length-1);
	}
}
//onkeyup="formatMoney(this)" onchange="formatMoney(this)" onblur="if(this.value.indexOf('.')==-1)this.value=this.value+'.00'"