function chkNPID(str) {
  var str_tmp = str.split('-').join('');
  if(str_tmp.length==13) {
    var sum = 0;
    for(i=0;i<12;i++) {
      sum +=str_tmp[i]*(13-i);
    }
    var rs = '';
    if(sum%11<=1) {
      rs = 1-(sum%11);
    }else {
      rs = 11-(sum%11);
    }

    if(str_tmp[12]==rs)
      return true;
    else
      return false;
  }else {
    return false;
  }

}
  
function alertToastr(msg, data) {
  if(msg=='success') {
    toastr.success("ดึงข้อมูลส่วนบุคคลเสร็จสิ้น","หน้าต่างแจ้งเตือน");
  }else if(msg=='warning') {
    toastr.warning("ไม่พบข้อมูลส่วนบุคคล","หน้าต่างแจ้งเตือน");
  }else if(msg=='error') {
    toastr.error("ดึงข้อมูลส่วนบุคคลล้มเหลว เนื่องจาก: " + data.ErrorMessage,"หน้าต่างแจ้งเตือน");
  }

}

//url: base_url+'personals/getPersonalInfo', //demo for test
function getPersInfo(inputpid,bt_spid,setData,integration=false) { //Function get Personal Info
    if(chkNPID($(inputpid).val())) {
      $.ajax({
      //url: base_url+'personals/getPersonalInfo1', //demo for test

      //TODO: Production gateway
      url: 'https://gateway.dop.go.th/transfer/import/getPersonalInfo', 

      //url: 'http://gateway.dop.go.th/transfer/import/getPersonalInfo', 

      //TODO: Local gateway
      //url: 'https://keng.gateway/transfer/import/getPersonalInfo', 

      type: 'POST',
      dataType: 'json',
      data: {
          'pid': pers_authen.pid,
          'cid': pers_authen.cid,
          'random_string': pers_authen.random_string,
          'target_pid': $(inputpid).val(),
          'user_id': user_id,
          'org_id': org_id,
          'csrf_dop': csrf_hash
      },
        success: function (value) { //Result True
          //console.log("success");console.dir(value);
          if(Object.keys(value).length) {
            console.log(value);

            if(integration)
              integration1(value);

            alertToastr('success', value.responseJSON);
            $(inputpid).select();$(inputpid).parent().removeClass("has-success has-warning has-error");$(inputpid).parent().addClass("has-success");
            $(bt_spid).attr('disabled',false);
            window[setData](value);
          }else { //Result no Data
            alertToastr('warning', value.responseJSON);
            $(inputpid).select();$(inputpid).parent().removeClass("has-success has-warning has-error");$(inputpid).parent().addClass("has-warning");
            setTimeout(function(){$(bt_spid).attr('disabled',false);},500);
          }
        },
        error:function(data) { //Result Error
          alertToastr('error', data.responseJSON);
          $(inputpid).select();$(inputpid).parent().removeClass("has-success has-warning has-error");$(inputpid).parent().addClass("has-error");
          setTimeout(function(){$(bt_spid).attr('disabled',false);},500);
          //console.log("error");
        },
      });
    }else {
      $(inputpid).select();$(inputpid).parent().removeClass("has-success has-warning has-error");$(inputpid).parent().addClass("has-warning");
      $(bt_spid).attr('disabled',false);
      toastr.error("หมายเลขบัตรประจำตัวประชาชนไม่ถูกต้อง!","หน้าต่างแจ้งเตือน");
    }
}

//TODO: Local test
function run_readerPers_test(){
  //alert("run reader!!") ; 
  if(chkNPID($(inputpid).val())) {
    reader_status = true;
	
	location.href = 'webrun:C:\\_Source Code\\Freelance\\Frontis\\ThaiNationalIDCard-master\\ThaiNationalIDCard.Example\\bin\\Debug\\ThaiNationalIDCard.Example.exe';
	var str = '';

    $(document).keyup(function (e) {
      if(reader_status){
		      str += String.fromCharCode(e.which);
          console.log(str);

          reader_status = false;
          setLogWSRV('12345678');
      }
    });
  }else {
      $(inputpid).select();$(inputpid).parent().removeClass("has-success has-warning has-error");$(inputpid).parent().addClass("has-warning");
      $(bt_spid).attr('disabled',false);
      toastr.error("หมายเลขบัตรประจำตัวประชาชนไม่ถูกต้อง!","หน้าต่างแจ้งเตือน");
  }
}
function run_readerPers(){
  if(chkNPID($(inputpid).val())) {
    reader_status = true;
    //location.href='webrun:C:\\readerid\\ThaiNationalIDCard\\bin\\Debug\\ThaiNationalIDCard_Demo.exe'; //demo for test
    //location.href='webrun:C:\\readerid\\ThaiNationalIDCard\\bin\\Debug\\ThaiNationalIDCard.exe';
    location.href='webrun:C:\\readerid\\ThaiNationalIDCard.exe';
    var str = '';
    $(document).keyup(function (e) {
      if(reader_status){
        //console.log(String.fromCharCode(e.which));
        str += String.fromCharCode(e.which);
        //console.log(str);
        if( str.length>=8 ){
          console.log(str);
          reader_status = false;
          setLogWSRV(str);
          str = '';
        }
      }
    });
  }else {
      $(inputpid).select();$(inputpid).parent().removeClass("has-success has-warning has-error");$(inputpid).parent().addClass("has-warning");
      $(bt_spid).attr('disabled',false);
      toastr.error("หมายเลขบัตรประจำตัวประชาชนไม่ถูกต้อง!","หน้าต่างแจ้งเตือน");
  }
}

$(document).keyup(function ( e) { //Check return uniq key
  //console.log(e.which);
  if(e.which==120 && authen_log_id!=0) {
    console.log(authen_log_id);

    var URL = base_url+'personals/setSessionWSRV';
     $.ajax({
         url: URL,
         type: "POST",
         dataType: 'json',
         data: {'authen_log_id':authen_log_id,'csrf_dop': csrf_hash},
         success: function (res) {
             if(!res.authen_log_id){
                toastr.error("เชื่อมโยงกับเครื่องอ่านบัตรล้มเหลว!","หน้าต่างแจ้งเตือน");
             }else {
                toastr.success("เข้าใช้งานระบบ Webservice สำเร็จ","Authentications");
                pers_authen = {'authen_log_id':res.authen_log_id,'pid':res.pid,'cid':res.cid,'random_string':res.random_string};
                console.log(pers_authen);
             }
             console.log(res.authen_log_id);
         },error:function() { //Result Error
            toastr.error("เชื่อมโยงกับเครื่องอ่านบัตรล้มเหลว!","หน้าต่างแจ้งเตือน");
         }
    });

  }
});

function setLogWSRV(uniq_id){

    console.log(uniq_id.toLowerCase());

    var URL = base_url+'personals/setLogWSRV';
     $.ajax({
         url: URL,
         type: "POST",
         dataType: 'json',
         data: {'user_id':user_id, 'org_id':org_id, 'uniq_id':uniq_id.toLowerCase(),'csrf_dop': csrf_hash},
         success: function (res) {
             if(!res.authen_log_id){
                toastr.error("เชื่อมโยงกับเครื่องอ่านบัตรล้มเหลว!","หน้าต่างแจ้งเตือน");
                setTimeout(function(){$(bt_spid).attr('disabled',false);},500);
             }else {
                authen_log_id = res.authen_log_id;
             }
             console.log(res.authen_log_id);
         },error:function() { //Result Error
            toastr.error("เชื่อมโยงกับเครื่องอ่านบัตรล้มเหลว!","หน้าต่างแจ้งเตือน");
            setTimeout(function(){$(bt_spid).attr('disabled',false);},500);
         }
    });
}
