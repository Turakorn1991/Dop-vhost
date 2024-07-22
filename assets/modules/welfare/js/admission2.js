$(document).ready(function () {
  $(".btn-save").click(function () {
    if ($("input[name='adm_info[date_of_adm]']").html() === "  -  ") {
      toastr.error("โปรดระบุวันที่แจ้งเรื่อง", "หน้าต่างแจ้งเตือน");
    } else if ($("#adm_case_reason_code").val() === undefined ||
      $("input[name='adm_info[adm_case_reason_code]']").val() === "") {
      toastr.error("โปรดระบุสาเหตุการรับเข้า", "หน้าต่างแจ้งเตือน");
    } else if ($("#adm_case_type").val() === undefined ||
      $("input[name='adm_info[adm_case_type]']").val() === "") {
      toastr.error("โปรดระบุรูปแบบการรับเข้า", "หน้าต่างแจ้งเตือน");
    } else {
      return opnCnfrom();
    }
  });
});

/* Modal Script Setting */

$('#savbtnYes').click(function () {
  $("input[name='bt_submit']").click();
}); //button save form

//$('#dltModel').on('show', function () { var id = $(this).data('id'), removeBtn = $(this).find('.danger'); });

$('#dltbtnYes').click(function () { //button delete
  window.location.replace(base_url + 'welfare/admission2' + '/Delete/' + $('#dltModel').data('id') + '?' + 'adm_record_id=' + $('#dltModel').data('rec'));
});

$('#bckbtnYes').click(function () { //button back
  window.location.replace(base_url + 'welfare/admission2');
});

var opn = function (node) { //dialog check delete
  var id = $(node).data('id');
  var reco = $(node).data('rec');
  $('#dltModel').data('id', id).data('rec', reco).modal('show');
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