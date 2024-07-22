
$(document).ready(function(){

  /*	$('#Province').change(function (argument){
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
    });*/
  
    //$('select.elder_addr_pre').select2();
  });
  
  /* Modal Script Setting */
  $('#savbtnYes').click(function() {$("input[name='bt_submit']").click();}); //button save form
  
  $('#dltbtnYes').click(function() {//button delete
    console.log($('#dltModel').data('id'));
      //window.location.replace(base_url+'school/center_kpi'+'/Delete/'+$('#dltModel').data('id'));
      window.location.replace(base_url+'school/photo2'+'/Delete/'+$('#dltModel').data('id')+'?'+'photo_id='+$('#dltModel').data('photoid')); //add code
      //window.location.replace(base_url+'school'+'/del_impv_photo'+'?'+'photo_id='+$('#dltModel').data('photoid')); //add code
  });

  /*=== Start Add Code ===*/
  $('#dltbtnYes2').click(function() {//button delete
    console.log($('#dltModel2').data('id'));
      window.location.replace(base_url+'school/del_album_photo'+'?'+'album_id='+$('#dltAlbum').data('albumid')); //add code
  });
  
/*   $('#savbtnYesAddAlbum').click(function() {//button delete
    console.log($('#sbmCnfrmAddAlbum').data('id'));
      window.location.replace(base_url+'school/photo2/Added/'+$('#sbmCnfrmAddAlbum').data('id')); //add code //+'?'+'album_id='+$('#dltAlbum').data('albumid')
  }); */

  $('#savbtnYesAddAlbum').click(function() {
      $( '#formAddAlbum' ).submit();
  });
  
  $('#savbtnYesEditAlbum').click(function() {
      $( '#formEditAlbum' ).submit();
  });
  
  $('#savbtnYesEditPhoto').click(function() {
      $( '#formEditPhoto' ).submit();
  });
  /*=== End Add Code ===*/

/*   $('#dltbtnYes').click(function() {//button delete
    window.location.replace(base_url+'adaptenvir/assist3'+'/Delete/'+$('#dltModel').data('id'));
  }); */
  
  $('#bckbtnYes').click(function() {//button back
      window.location.replace(base_url+'school/school_list');
  });
  
  /*=== Start Add Code ===*/
  var opnDelPhoto = function(node) { //dialog check delete //from opn to opnDelPhoto
      var id = $(node).data('id');
      //var albumid = $(node).data('albumid'); //add code
      var photoid = $(node).data('photoid'); //add code
      $('#dltModel').data('id', id).data('photoid',photoid).modal('show'); //add code date //.data('albumid',albumid)
  }

  var opnDelAlbum = function(node) { //dialog check delete //from opn to opnDelPhoto
      var id = $(node).data('id');
      var albumid = $(node).data('albumid'); //add code
      //var photoid = $(node).data('photoid'); //add code
      console.log(id+" and "+albumid);
      $('#dltAlbum').data('id', id).data('albumid',albumid).modal('show'); //add code date //.data('photoid',photoid)
  }

  var modalEditAlbum = function(node) { //dialog check delete //from opn to opnDelPhoto
/*       var id = $(node).data('id');
      var albumid = $(node).data('albumid'); //add code
      console.log(id+" and "+albumid);
      $('#mdEditAlbum').data('id', id).data('albumid',albumid).modal('show'); //add code date */

      //$("#viewAlbum-title-container").empty(); //opy
      //$("#viewAlbum-desc-container").empty(); //opy
      $("#editAlbum-container").empty(); //opy
      var id = $(node).data('id');
      var albumid = $(node).data('albumid');
      $.get( base_url+'school/album_modal?album_id='+albumid, function(data){
        var jData = jQuery.parseJSON(data);
        //$("#album-container").empty();
        var i = 0;
        var datetm = formatDateThai1(jData[0]['al_insert_datetime']);
        var dttime = jData[0]['al_insert_datetime'].substring(11);
        $("#editAlbum-container").append(
            '<text class="text-left">'
                +'<b style="color: red;">ชื่ออัลบั้ม* : </b>'
            +'</text>'
            +'<input type="text" name="schl_album_title_edit" maxlength="25" style="width:202px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"; value="'+jData[0]['al_album_title']+'" required> <!-- 270px, 210px -->'
            +'<br/>'
            +'<text class="text-left">'
                +'<b style="">วันที่สร้างอัลบั้ม : </b>'
            +'</text>'
            +'<!-- <input type="text" name="photo2[]" maxlength="25" style="width:202px; height:30px; margin-bottom:20px; color:lightgrey;" placeholder="วันนี้" value="<?php echo formatDateThai1($date)." (".$time." น.)"; ?>" disabled> --> <!-- 270px, 210px -->'
            +'<input type="text" name="" maxlength="25" style="width:200px; height:30px; margin-bottom:20px; color:lightgrey; background:transparent; border-width:0px !important" placeholder="วันนี้"; value="'+datetm+' ('+dttime+' น.)'+'" disabled> <!-- 270px, 210px -->'
            +'<br/>'
            +'<text class="text-left">'
                +'<b style="">คำอธิบายอัลบั้ม : </b>'
            +'</text>'
            +'<input type="text" name="schl_album_description_edit" maxlength="45" style="width:400px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 45 ตัวอักษร"; value="'+jData[0]['al_album_description']+'"> <!-- 270px, 210px -->'
            +'<input type="hidden" name="schl_album_id_edit" value="'+jData[0]['al_album_id']+'" /> <!-- Set hidden csrf field -->'
            +'<input type="hidden" name="schl_id_edit_album" value="'+jData[0]['al_schl_id']+'" /> <!-- Set hidden csrf field -->'
        );
      });
      $('#mdEditAlbum').data('id', id).data('albumid',albumid).modal('show');
  }

  var modalEditPhoto = function(node) { //dialog check delete //from opn to opnDelPhoto
/*       var id = $(node).data('id');
      var albumid = $(node).data('albumid'); //add code
      console.log(id+" and "+albumid);
      $('#mdEditAlbum').data('id', id).data('albumid',albumid).modal('show'); //add code date */

      //$("#viewAlbum-title-container").empty(); //opy
      //$("#viewAlbum-desc-container").empty(); //opy
      $("#editPhoto-container").empty(); //opy
      var id = $(node).data('id');
      var photoid = $(node).data('photoid');
      var albumid = $(node).data('albumid');
/*       $("#editPhoto-container").append(
        '<text class="text-left">'
            +'<b style="color: red;">ชื่อภาพ* : '+id+'='+photoid+'='+albumid+'</b>'
        +'</text>'
        +'<input type="text" name="schl_photo_title_edit" maxlength="25" style="width:202px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"; value="" required> <!-- 270px, 210px -->'
        +'<br/>'
        +'<text class="text-left">'
            +'<b style="">วันที่เพิ่ม : </b>'
        +'</text>'
        +'<!-- <input type="text" name="photo2[]" maxlength="25" style="width:202px; height:30px; margin-bottom:20px; color:lightgrey;" placeholder="วันนี้" value="<?php echo formatDateThai1($date)." (".$time." น.)"; ?>" disabled> --> <!-- 270px, 210px -->'
        +'<input type="text" name="" maxlength="25" style="width:200px; height:30px; margin-bottom:20px; color:lightgrey; background:transparent; border-width:0px !important" placeholder="วันนี้"; value="" disabled> <!-- 270px, 210px -->'
        +'<br/>'
        +'<text class="text-left">'
            +'<b style="">คำอธิบายภาพ : </b>'
        +'</text>'
        +'<input type="text" name="schl_album_description_edit" maxlength="45" style="width:400px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 45 ตัวอักษร"; value=""> <!-- 270px, 210px -->'
        +'<input type="hidden" name="schl_album_id_edit" value="" /> <!-- Set hidden csrf field -->'
      ); */
      $.get( base_url+'school/photo_modal_edit?photo_id='+photoid, function(data){
        var jData = jQuery.parseJSON(data);
        //$("#album-container").empty();
        var i = 0;
        var datetm = formatDateThai1(jData[0]['ph_insert_datetime']);
        var dttime = jData[0]['ph_insert_datetime'].substring(11);
        $("#editPhoto-container").append(
          '<div class="container3" style="margin-bottom:20px;">'
            +'<img src="'+base_url+'/assets/modules/school/images/uploads/'+jData[0]['ph_photo_file_name']+'" alt="..."  class="image" style="display: block !important; margin-left: auto !important; margin-right: auto !important;">'
          +'</div>'
          +'<text class="text-left">'
              +'<b style="color: red;">ชื่อภาพ* : </b>'
          +'</text>'
          +'<input type="text" name="schl_photo_title_edit" maxlength="25" style="width:202px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 25 ตัวอักษร"; value="'+((jData[0]['ph_photo_title'] == null) || (jData[0]['ph_photo_title'] == '') ? "-" : jData[0]['ph_photo_title'])+'" required> <!-- 270px, 210px -->'
          +'<br/>'
          +'<text class="text-left">'
              +'<b style="">วันที่เพิ่ม : </b>'
          +'</text>'
          +'<!-- <input type="text" name="photo2[]" maxlength="25" style="width:202px; height:30px; margin-bottom:20px; color:lightgrey;" placeholder="วันนี้" value="<?php echo formatDateThai1($date)." (".$time." น.)"; ?>" disabled> --> <!-- 270px, 210px -->'
          +'<input type="text" name="" maxlength="25" style="width:200px; height:30px; margin-bottom:20px; color:lightgrey; background:transparent; border-width:0px !important" placeholder="วันนี้"; value="'+datetm+' ('+dttime+' น.)'+'" disabled> <!-- 270px, 210px -->'
          +'<br/>'
          +'<text class="text-left">'
              +'<b style="">คำอธิบายภาพ : </b>'
          +'</text>'
          +'<input type="text" name="schl_photo_description_edit" maxlength="45" style="width:400px; height:30px; margin-bottom:20px;" placeholder="สูงสุด 45 ตัวอักษร"; value="'+((jData[0]['ph_photo_description'] == null) || (jData[0]['ph_photo_description'] == '') ? "-" : jData[0]['ph_photo_description'])+'"> <!-- 270px, 210px -->'
          +'<input type="hidden" name="schl_photo_id_edit" value="'+jData[0]['ph_photo_id']+'" /> <!-- Set hidden csrf field -->'
          +'<input type="hidden" name="schl_id_edit_photo" value="'+jData[0]['ph_schl_id']+'" /> <!-- Set hidden csrf field -->'
        );
      });
      $('#mdEditPhoto').data('id', id).data('photoid',photoid).modal('show');
  }
  /*=== End Add Code ===*/
  
  var opnCnfrom = function() { //dialog check before submit form //add photo
    var i = 0,j=0;

    var count_img = $('#parent_0 .img_0').length;
    console.log(count_img);
    if(count_img-1 > 0){
      /*$($("[required]")).each(function() {
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
      });*/
      if(frmKey==true){$('#sbmCnfrm').modal('show'); return false; } //add code
          //else return true; //add code
  /*     $($("[required]")).each(function() {
          if($(this).val()==''){
            $(this).focus();
            return false;
          }
      }); */    
    }else{
      $('.btn-confirmupload').prop('disabled', true);
    }
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
  

/* === start modal === */
var opnOpal = function(node) { //dialog check delete
  var id = $(node).data('id');
  //alert(id)
  //var photo_id = $(node).data('photoid'); //add code
  //$('#dltOpal').data('id', id).data('photoid',photo_id).modal('show'); //add code date
  $('#dltOpal').data('id', id).modal('show'); //add code date
}
  
/* $('#dltOpalYes').click(function() {//button delete
  console.log($('#dltOpal'));
    //window.location.replace(base_url+'school/center_kpi'+'/Delete/'+$('#dltModel').data('id'));
    //window.location.replace(base_url+'school/photo2'+'/Delete/'+$('#dltModel').data('id')+'?'+'photo_id='+$('#dltModel').data('photoid')); //add code
    //window.location.replace(base_url+'school'+'/del_impv_photo'+'?'+'photo_id='+$('#dltModel').data('photoid')); //add code
}); */

/* var opnAlbum = function(node) { //dialog check delete
  var album_id = $(node).data('id');
  //alert(id)
  console.log(album_id);
  //var photo_id = $(node).data('photoid'); //add code
  //$('#dltOpal').data('id', id).data('photoid',photo_id).modal('show'); //add code date
  $(".modal-body #albumid").val( album_id );
  $('#dltOpal').data('id', album_id).modal('show'); //add code date
}*/

var modalViewAlbum = function(node) { //dialog check delete
  $("#viewAlbum-title-container").empty(); //opy
  $("#viewAlbum-desc-container").empty(); //opy
  $("#viewAlbum-container").empty(); //opy
  var id = $(node).data('id');
  var albumid = $(node).data('albumid');
  $.get( base_url+'school/photo_modal?album_id='+albumid, function(data){
    var jData = jQuery.parseJSON(data);
    //$("#album-container").empty();
    var i = 0;
    var datetm = formatDateThai1(jData[0]['al_insert_datetime']);
    var dttime = jData[0]['al_insert_datetime'].substring(11);
    $("#viewAlbum-title-container").append(
      '<b><i class="fa fa-book"></i> อัลบั้ม \"'+((jData[0]['al_album_title'] == null) || (jData[0]['al_album_title'] == '') ? "-" : jData[0]['al_album_title'])+'\"</b><br>'
      +'<div style="padding-left:50px;"><text style="font-size: 15px;"><b> วันที่สร้าง: </b>'+datetm+' ('+dttime+' น.) <br>'
      +'<b>คำอธิบายอัลบั้ม: </b>'+((jData[0]['al_album_description'] == null) || (jData[0]['al_album_description'] == '') ? "-" : jData[0]['al_album_description'])+'</text></div>'
      +'<input type="hidden" name="albumid[]" value="'+albumid+'" /> <!-- Set hidden album_id field -->'
    );
/*     $("#viewAlbum-desc-container").append(
      '<b>วันที่สร้าง: </b>'+datetm+' ('+dttime+' น.) <br>'+'<b>คำอธิบายอัลบั้ม: </b>'+jData[0]['al_album_description']
    ); */
    //var date = formatDateThai1(photo.ph_insert_datetime);

    if(jData[0]['al2_album_id']) {
      //$("#viewAlbum-container").append('<div style="height:500px;width:300px;background-color:blue;"></div>');
      $("#viewAlbum-container").append(
        '<div class="col-xs-12 col-sm-4 col-lg-3 element" style="margin-top: 20px; height:200px; word-wrap: break-word; font-size: 13px;">'
          +'<div style="margin-bottom:20px;">'
            +'<text>'
              +'<b style="font-size: 15px;" ><i class="fa fa-image"></i> '+ 'ยังไม่มีภาพในอัลบั้มนี้' +'</b><br>'
/*               +'<b>ชื่อภาพ : </b>'+photo.ph_photo_title+'<br>'
              +'<b>วันที่เพิ่ม : </b>'+datetm+' ('+dttime+' น.)<br>'
              +'<b>คำอธิบาย : </b>'+photo.ph_photo_description */
            +'</text>'
          +'</div>'
          +'<div class="container2">'
            +'<img src="'+base_url+'assets/modules/school/images/'+'OP01_no_picture.png'+'" alt="..."  class="image">'
/*             +'<div class="overlay">'
              // +'<span class="glyphicon glyphicon-pencil trashleft" aria-hidden="true" onclick="opn(this)" ></span>'
              // +'<span class="glyphicon glyphicon-trash trash trashdelete" aria-hidden="true" onclick="opnDelPhoto(this)" data-id="'+photo.al_schl_id+'" data-photoid="'+photo.ph_photo_id+'" data-albumid="'+photo.al_album_id+'"></span>'
              // +'<input type="checkbox" class="che_del2" >'
            +'</div>' */
          +'</div>'
        +'</div>'
      );
    } 

    jData.forEach(photo => {        
      var datetm = formatDateThai1(photo.ph_insert_datetime);
      var dttime = photo.ph_insert_datetime.substring(11);
      if(photo.ph_photo_file_name != "" && photo.ph_photo_id != ""){
        // $("#viewAlbum-container").append('<div style="height:500px;width:300px;background-color:yellow;"></div>');
        $("#viewAlbum-container").append(
          '<div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word; font-size: 13px;">'
            +'<div style="margin-bottom:20px;">'
              +'<text>'
                +'<b style="font-size: 15px;" ><i class="fa fa-image"></i> ภาพที่ '+ ++i +'</b><br>'
                +'<b>ชื่อภาพ : </b>'+((photo.ph_photo_title == null) || (photo.ph_photo_title == '') ? "-" : photo.ph_photo_title)+'<br>'
                +'<b>วันที่เพิ่ม : </b>'+datetm+' ('+dttime+' น.)<br>'
                +'<b>คำอธิบาย : </b>'+((photo.ph_photo_description == null) || (photo.ph_photo_description == '') ? "-" : photo.ph_photo_description)
              +'</text>'
            +'</div>'
            +'<div class="container2">'
              +'<img src="'+base_url+'assets/modules/school/images/uploads/'+photo.ph_photo_file_name+'" alt="..."  class="image">'
              +'<div class="overlay">'
                +'<span class="glyphicon glyphicon-pencil trashleft" aria-hidden="true" onclick="modalEditPhoto(this)" data-id="'+photo.al_schl_id+'" data-photoid="'+photo.ph_photo_id+'" data-albumid="'+photo.al_album_id+'"></span>'
                +'<span class="glyphicon glyphicon-trash trash trashdelete" aria-hidden="true" onclick="opnDelPhoto(this)" data-id="'+photo.al_schl_id+'" data-photoid="'+photo.ph_photo_id+'" data-albumid="'+photo.al_album_id+'"></span>'
                // +'<input type="checkbox" class="che_del2" >'
              +'</div>'
            +'</div>'
          +'</div>'
        );
      }
      console.log(photo.photo_file_name);
    });
  });
  $('#mdViewAlbum').data('id', id).data('albumid',albumid).modal('show'); //add code date
}

var modalAddAlbum = function(node) { //dialog check delete
  var schl_id = $(node).data('id');
  $('#mdAddAlbum').data('id', schl_id).modal('show'); //add code date
}

function formatDateThai1(date){
  if (date=='') {
		return '';
  }
    var str = date.substring(0,10);
    var spl = str.split("-");

    var thai_month_arr = ["","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];

    var mmonth;
    switch (spl[1]) {
        case "00":
            mmonth = thai_month_arr[0];
            break;
        case "01":
            mmonth = thai_month_arr[1];
            break;
        case "02":
            mmonth = thai_month_arr[2];
            break;
        case "03":
            mmonth = thai_month_arr[3];;
            break;
        case "04":
            mmonth = thai_month_arr[4];
            break;
        case "05":
            mmonth = thai_month_arr[5];
            break;
        case "06":
            mmonth = thai_month_arr[6];
            break;
        case "07":
            mmonth = thai_month_arr[7];
            break;
        case "08":
            mmonth = thai_month_arr[8];
            break;
        case "09":
            mmonth = thai_month_arr[9];
            break;
        case "10":
            mmonth = thai_month_arr[10];
            break;
        case "11":
            mmonth = thai_month_arr[11];
            break;
    }

    var yyear = parseInt(spl[0])+543;

    var dday = parseInt(spl[2]).toString();

    var conc = dday.concat(" ",mmonth," ",yyear);
    return conc;
    
/* 	if(arr[0]=='0000'||arr[1]=='00'||arr[2]=='00')
		return '';
	var thai_month_arr = ["","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค."];
	$arr=explode('-',$date);
	return arr[2]+' '+thai_month_arr[arr[1]]+' '+arr[0]+543; */
}
  
var opnCnAddAlbum = function(node) { //dialog check before submit form
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
      if(frmKey==true)
      {
        var id = $(node).data('id');
        console.log(id);
        $('#sbmCnfrmAddAlbum').data('id', id).modal('show'); //add code date
        //$('#sbmCnfrmAddAlbum').modal('show'); 
        return false; 
      }
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
  
var opnCnEditAlbum = function(node) { //dialog check before submit form
  var i = 0,j=0;

    if(frmKey==true)
    {
      var id = $(node).data('id');
      console.log(id);
      $('#sbmCnfrmEditAlbum').data('id', id).modal('show'); //add code date
      return false; 
    }
}
  
var opnCnEditPhoto = function(node) { //dialog check before submit form
  var i = 0,j=0;

    if(frmKey==true)
    {
      var id = $(node).data('id');
      console.log(id);
      $('#sbmCnfrmEditPhoto').data('id', id).modal('show'); //add code date
      return false; 
    }
}

/* $(document).on("click", ".open-AddBookDialog", function () {
    var myBookId = $(this).data('id');
    $(".modal-body #bookId").val( myBookId );
    $('#addBookDialog').modal('show');
}); */
/* === end modal === */