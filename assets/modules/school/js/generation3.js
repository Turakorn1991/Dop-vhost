var table;
var table2;
$(document).ready(function() {
  table = $("#dtable").DataTable({
    // "searching": false,
    bSort: false,
    bLengthChange: false,
    bFilter: false, // remove filter search opy
    pageLength: 10, //50
    responsive: true,
    language: {
      sProcessing: "กำลังดำเนินการ...",
      sLengthMenu: "แสดง _MENU_ แถว",
      sZeroRecords: "ไม่พบข้อมูล",
      // "sInfo":         "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว / รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
      sInfo:
        "รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 10 รายการ)", //50
      // "sInfoEmpty":    "แสดง 0 ถึง 0 จาก 0 แถว",
      sInfoEmpty:
        "รายการทั้งหมด จำนวน 0 รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 10 รายการ)", //50
      sInfoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
      sInfoPostFix: "",
      sSearch: "ค้นหา: ",
      sUrl: "",
      oPaginate: {
        sFirst:
          '<i class="fa fa-step-backward" style="font-size: 12px;" aria-hidden="true"></i>',
        sPrevious:
          '<i class="fa fa-backward" style="font-size: 12px;" aria-hidden="true"></i>',
        sNext:
          '<i class="fa fa-forward" style="font-size: 12px;" aria-hidden="true"></i>',
        sLast:
          '<i class="fa fa-step-forward" style="font-size: 12px;" aria-hidden="true"></i>'
      }
    }
  });

  table2 = $(".dtable2").DataTable({
    //dtable2
    // "searching": false,
    bSort: false,
    bLengthChange: false,
    bFilter: false, // remove filter search opy
    pageLength: 5, //50
    responsive: true,
    language: {
      sProcessing: "กำลังดำเนินการ...",
      sLengthMenu: "แสดง _MENU_ แถว",
      sZeroRecords: "ไม่พบข้อมูล",
      // "sInfo":         "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว / รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
      sInfo:
        "รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 5 รายการ)", //50
      // "sInfoEmpty":    "แสดง 0 ถึง 0 จาก 0 แถว",
      sInfoEmpty:
        "รายการทั้งหมด จำนวน 0 รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 5 รายการ)", //50
      sInfoFiltered: "(กรองข้อมูล _MAX_ ทุกแถว)",
      sInfoPostFix: "",
      sSearch: "ค้นหา: ",
      sUrl: "",
      oPaginate: {
        sFirst:
          '<i class="fa fa-step-backward" style="font-size: 12px;" aria-hidden="true"></i>',
        sPrevious:
          '<i class="fa fa-backward" style="font-size: 12px;" aria-hidden="true"></i>',
        sNext:
          '<i class="fa fa-forward" style="font-size: 12px;" aria-hidden="true"></i>',
        sLast:
          '<i class="fa fa-step-forward" style="font-size: 12px;" aria-hidden="true"></i>'
      }
    },

    columns: [
      { className: "text-center" }, //no.
      { className: "text-center" }, //pid no.
      { className: "text-center" }, //sex
      { className: "text-left" }, //fname
      { className: "text-left" }, //lname
      { className: "text-center" } //age
    ]

    /*         "columnDefs": [
            { className: "dt-head-right dt-body-right", "targets": [ 1 ] }
        ] */
  }); //remove filter search opy //remove filter search opy

  /*     function filterColumn (i) {
        $('#dtable').DataTable().column(i).search(
            $('#col'+i+'_filter').val()
        ).draw();
    } */ /*     $("#filter").on('click', function () {
      $('input.column_filter').each(function(  ) {
        filterColumn($(this).data('column'));
      });
      // table.draw();
    }); */ $(
    "#dtable_filter"
  ).hide();
});

/* Modal Script Setting */
$("#savbtnYes").click(function() {
  $("input[name='bt_submit']").click();
}); //button save form

$("#savbtnYes2").click(function() {
  //var id = $('#sbmCnfrm2').data('id');
  /* console.log($('#sbmCnfrm2').data('id'));
    window.location.replace(base_url+'school/generation3'+'/Added/'+$('#sbmCnfrm2').data('id')); */
  $("#formAddGen").submit();
}); //button save form

$("#btnYesActiveGen").click(function() {
  //console.log($('#mdActive').data('genid'));
  $("#formActiveGen").submit();
  //window.location.replace(base_url+'school/active_gen'+'?'+'gen_id='+$('#mdActive').data('genid'));
});

$("#btnYesDeleteGen").click(function() {
  var id = $("#dltGenModel").data("id");
  var genid = $("#dltGenModel").data("genid");
  console.log(id + " and " + genid);
  window.location.replace(
    base_url + "school/generation3" + "/Delete/" + id + "?gen_id=" + genid
  );
});

$("#bckbtnYes").click(function() {
  //button back
  window.location.replace(base_url + "school/school_list");
});

var opnDelGen = function(node) {
  //dialog check delete
  var id = $(node).data("id");
  var genid = $(node).data("genid");
  $("#dltGenModel")
    .data("id", id)
    .data("genid", genid)
    .modal("show");
};

/* var opnDelGen = function(node) { //dialog check delete
    var id = $(node).data('id');
    var genid = $(node).data('genid');
    $('#dltGenModel').data('id', id).data('genid', genid).modal('show');
} */

/* function opn_del(schl_id,gen_id){
  console.log(schl_id+'  '+gen_id);
} */

var opnCnfrom = function() {
  //dialog check before submit form
  var i = 0,
    j = 0;
  $($("[required]")).each(function() {
    if ($(this).val() == "") {
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
        $("#sbmCnfrm").modal("show");
        return false;
      } else return true;
    }
  });
  $($("[required]")).each(function() {
    if ($(this).val() == "") {
      $(this).focus();
      return false;
    }
  });
};

//=== start opal add ===
var opnCnfrom2 = function() {
  //dialog check before submit form
  var id = $("#mdAddGen").data("id");
  console.log(id);
  var i = 0,
    j = 0;
  $($("[required]")).each(function() {
    if ($(this).val() == "") {
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
        $("#sbmCnfrm2")
          .data("id", id)
          .modal("show");
        return false;
      } else return true;
    }
  });
  $($("[required]")).each(function() {
    if ($(this).val() == "") {
      $(this).focus();
      return false;
    }
  });
};
//=== end opal add ===

var opnBck = function() {
  //dialog check before back
  //console.log(frmKey);
  if (frmKey == true) {
    $("#bckCnfrm").modal("show");
    return false;
  } else return true;
};

$("#form1").keyup(function() {
  frmKey = true;
});
/* End Modal Script Setting */

//=== Start Add Code ===//

var modalViewGen = function(node) {
  $("body").trigger("set_gen_id", [$(node).data("genid")]);
  //dialog check delete
  $("#viewGen-title-container").empty(); //opy
  /* $("#viewAlbum-desc-container").empty(); //opy */
  $("#viewGen-container-sec1").empty(); //opy
  $("#viewGen-container-sec2").empty(); //opy
  // $("#viewGen-container-sec3").empty(); //opy
  table2.clear().draw();
  var id = $(node).data("id");
  var genid = $(node).data("genid");
  $.get(base_url + "school/generation_modal?gen_id=" + genid, function(data) {
    $.get(base_url + "school/std_crse_modal", function(data2) {
      $.get(base_url + "school/student_modal?gen_id=" + genid, function(data3) {
        var jData = jQuery.parseJSON(data);
        var jData2 = jQuery.parseJSON(data2);
        var jData3 = jQuery.parseJSON(data3);
        /* $("#viewAlbum-container").empty(); */
        //var i = 0;

        var elm2 = "";
        studdata = jData3;

        for (var x = 0; x < studdata.length; x++) {
          if (
            (studdata[x]["stud_id"] =
              !0 &&
              studdata[x]["stud_id"] != null &&
              studdata[x]["stud_id"] != "")
          ) {
            // elm2 += '<tr>';
            // elm2 += '<td class="text-center">'+'1'+'</td>';
            // elm2 += '<td class="text-center">'+studdata[x]['pid']+'</td>';
            // elm2 += '<td class="text-center">ชาย</td>';
            // elm2 += '<td class="text-left">'+studdata[x]['stud_firstname_th']+'</td>';
            // elm2 += '<td class="text-left">'+studdata[x]['stud_lastname_th']+'</td>';
            // elm2 += '<td class="text-center">'+studdata[x]['stud_age']+'</td>';
            // elm2 += '</tr>';

            elm2 = table2.row
              .add([
                x + 1,
                studdata[x]["pid"],
                "ชาย",
                studdata[x]["stud_firstname_th"],
                studdata[x]["stud_lastname_th"],
                studdata[x]["stud_age"]
              ])
              .draw(false);
          } else {
            elm2 += "";
          }
        }

        /*                 var counter = 1;
                
                var elm3 = table2.row.add( [
                    counter +'.1',
                    counter +'.2',
                    counter +'.3',
                    counter +'.4',
                    counter +'.5',
                    counter +'.6'
                ] ).draw( false );

                elm3 += table2.row.add( [
                    counter++ +'.1',
                    counter++ +'.2',
                    counter++ +'.3',
                    counter++ +'.4',
                    counter++ +'.5',
                    counter++ +'.6'
                ] ).draw( false ); */

        var elm =
          '<select id="crse_code" name="schl_gen[crse_code]" placeholder="เลือก หลักสูตร" class="form-control elder_addr_pre" >';
        elm += "<option selected disabled>เลือก หลักสูตร</option>";
        arrdata = jData2;

        for (var i = 0; i < arrdata.length; i++) {
          if (arrdata[i]["crse_code"] == jData[0]["gn_crse_code"]) {
            elm +=
              '<option value="' +
              arrdata[i]["crse_code"] +
              '" selected>' +
              arrdata[i]["crse_title"] +
              "</option>";
          } else {
            elm +=
              '<option value="' +
              arrdata[i]["crse_code"] +
              '">' +
              arrdata[i]["crse_title"] +
              "</option>";
          }
        }
        elm += "<option>อื่นๆ</option>";
        elm += "</select>";
        elm +=
          "<input value='" +
          jData[0]["gn_crse_custom"] +
          "' name='schl_gen[crse_custom]' type='text' class='form-control crse_custom' placeholder='โปรดระบุ' style='display:none'>";

        /* $('.select_crse').append(elm); */

        var datetm = formatDateThai1(jData[0]["gn_insert_datetime"]);
        var dttime = jData[0]["gn_insert_datetime"].substring(11);

        if (
          jData[0]["gn_gen_code"] != null &&
          jData[0]["gn_gen_code"] != "" &&
          jData[0]["gn_gen_code"] != "0"
        ) {
          $("#viewGen-title-container").append(
            '<b><i class="fa fa-flag"></i> รายละเอียดรุ่นที่ ' +
              jData[0]["gn_gen_code"] +
              '<div style="padding-left:50px;"><text style="font-size: 15px;"><b> วันที่เพิ่ม: </b>' +
              datetm +
              " (" +
              dttime +
              " น.) <br>" +
              "<b>สถานะรุ่น: </b>" +
              (jData[0]["gn_gen_status"] == null ||
              jData[0]["gn_gen_status"] == ""
                ? "-"
                : jData[0]["gn_gen_status"]) +
              "</text></div>"
            //+'<input type="hidden" name="genid[]" value="'+genid+'" /> <!-- Set hidden album_id field -->'
          );
        } else {
          $("#viewGen-title-container").append(
            '<b><i class="fa fa-flag"></i> รายละเอียดรุ่น (ไม่ระบุ)' +
              '<div style="padding-left:50px;"><text style="font-size: 15px;"><b> วันที่เพิ่ม: </b>' +
              datetm +
              " (" +
              dttime +
              " น.) <br>" +
              "<b>สถานะรุ่น: </b>" +
              (jData[0]["gn_gen_status"] == null ||
              jData[0]["gn_gen_status"] == ""
                ? "-"
                : jData[0]["gn_gen_status"]) +
              "</text></div>"
            //+'<input type="hidden" name="genid[]" value="'+genid+'" /> <!-- Set hidden album_id field -->'
          );
        }

        var str = jData[0]["gn_first_date_of_edu"];
        if (str != "0000-00-00" && str != "" && str != null) {
          var tmp = str.split("-");
          if (
            tmp.length == 3 &&
            (str != "0000-00-00" && str != "" && str != null)
          ) {
            var dateuptodate =
              ".datepicker('update', new Date(Date.UTC(" +
              tmp[0] +
              "," +
              tmp[1] +
              "-1," +
              tmp[2] +
              ")));;";
          }
        } else {
          var dateuptodate = "";
        }

        var str2 = jData[0]["gn_last_date_of_edu"];
        if (str2 != "0000-00-00" && str2 != "" && str2 != null) {
          var tmp2 = str2.split("-");
          if (
            tmp2.length == 3 &&
            (str2 != "0000-00-00" && str2 != "" && str2 != null)
          ) {
            var dateuptodate2 =
              ".datepicker('update', new Date(Date.UTC(" +
              tmp2[0] +
              "," +
              tmp2[1] +
              "-1," +
              tmp2[2] +
              ")));;";
          }
        } else {
          var dateuptodate2 = "";
        }

        if (
          jData[0]["gn_crse_att_file"] != "" &&
          jData[0]["gn_crse_att_file"] != null
        ) {
          var timetablepicture = "uploads/" + jData[0]["gn_crse_att_file"];
          var imgbuttonlabel = " เปลี่ยนรูปภาพ";
        } else {
          var timetablepicture = "OP02_no_picture.png";
          var imgbuttonlabel = " เพิ่มรูปภาพ";
        }

        console.log(
          genid + " // " + str + " // " + dateuptodate + " // " + elm2
        );
        $("#viewGen-container-sec1").append(
          '<div class="form-group row" style="padding-left: 15px; padding-right: 15px;">' +
            '<div class="panel-group" style="margin-bottom:20px !important;">' +
            '<div class="panel panel-default" style="border: 0">' +
            '<div class="panel-heading">' +
            "<h4>รายละเอียดรุ่นและหลักสูตร</h4>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="col-xs-12 col-sm-2 has-error" >' +
            '<input type="hidden" name="schl_gen[gen_id]" value="' +
            jData[0]["gn_gen_id"] +
            '">' +
            '<label class="col-2 col-form-label" style="color: red;">รุ่นที่ </label>' +
            '<input type="number" min="1" placeholder="รุ่น" class="form-control" name="schl_gen[gen_code]" value="' +
            jData[0]["gn_gen_code"] +
            '" title="" required>' +
            "</div>" +
            '<div class="col-xs-12 col-sm-2">' +
            '<label class="col-2 col-form-label" style="color: red;">วันที่เริ่ม</label>' +
            '<div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">' +
            '<input title="วันที่เริ่มรุ่น" placeholder="เลือกวันที่" class="form-control" type="text" name="schl_gen[first_date_of_edu]" required />' +
            '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>' +
            '<script type="text/javascript">' +
            "$(function () {" +
            '$("#datetimepicker1").datepicker({' +
            "autoclose: true," +
            "todayHighlight: true," +
            "format: 'dd/mm/yyyy'," +
            "todayBtn: true," +
            "language: 'th'," +
            "thaiyear: true" +
            "})" +
            dateuptodate +
            "});" +
            "</script>" +
            "</div>" +
            "</div>" +
            '<div class="col-xs-12 col-sm-2">' +
            '<label class="col-2 col-form-label" style="color: red;">วันที่จบ</label>' +
            '<div id="datetimepicker2" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">' +
            '<input title="วันที่จบรุ่น" placeholder="เลือกวันที่" class="form-control" type="text" name="schl_gen[last_date_of_edu]" required>' +
            '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>' +
            '<script type="text/javascript">' +
            "$(function () {" +
            '$("#datetimepicker2").datepicker({' +
            "autoclose: true," +
            "todayHighlight: true," +
            "format: 'dd/mm/yyyy'," +
            "todayBtn: true," +
            "language: 'th'," +
            "thaiyear: true" +
            "})" +
            dateuptodate2 +
            "});" +
            "</script>" +
            "</div>" +
            //'<!-- <input id="gen_status" name="schl_gen[gen_status]" type="hidden" value="เปิด" checked> --><!-- เปิด/ปิดการศึกษา -->'+
            "</div>" +
            '<div class="col-xs-12 col-sm-2">' +
            '<label class="col-2 col-form-label">วัน/สัปดาห์</label>' +
            '<input type="number" min="0" max="7" placeholder="วัน" name="schl_gen[days_per_week]" class="form-control" value="' +
            jData[0]["gn_days_per_week"] +
            '">' +
            "</div>" +
            '<div class="col-xs-12 col-sm-2">' +
            '<label class="col-2 col-form-label">ชม./สัปดาห์</label>' +
            '<input type="number" min="0" max="168" placeholder="ชม." name="schl_gen[hours_per_week]" class="form-control" value="' +
            jData[0]["gn_hours_per_week"] +
            '">' +
            "</div>" +
            '<div class="col-xs-12 col-sm-2">' +
            '<label class="col-2 col-form-label">หลักสูตร</label>' +
            "<br>" +
            elm +
            "</div>" +
            "</div>"
        );
        if ($("input.crse_custom").val()) {
          $("#crse_code").val("อื่นๆ");
          $("input.crse_custom").show();
        }

        $("#viewGen-container-sec2").append(
          '<div class="panel-group" style="margin-bottom:20px !important;">' +
            '<div class="panel panel-default" style="border: 0">' +
            '<div class="panel-heading">' +
            "<h4>ตารางเรียน</h4>" +
            "</div>" +
            "</div>" +
            "</div>" +
            '<div class="col-xs-12 col-sm-12 col-lg-12 element"   style="margin-top: 0px; margin-left: 25px; height: auto; word-wrap: break-word; font-size: 13px;">' +
            '<img src="' +
            base_url +
            "/assets/modules/school/images/" +
            timetablepicture +
            '" class="image2" >  ' +
            '<input type="file" name="img2"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,\'\');">' +
            '<button id="btnAddimg" type="button" class="btn btn-default" style="width: 138px; margin-top:20px;" onclick="brwImg(this,\'\');"><i class="fa fa-upload"></i>' +
            imgbuttonlabel +
            "</button>" +
            "</div>"
        );

        /*                 $("#viewGen-container-sec3").append( */
        /*                     '<button id="btnAddimg" type="button" class="btn btn-default" style="width: 300px; margin-bottom:20px; float: right;" onclick="brwImg(this,\'\');"><i class="fa fa-upload"></i> นำเข้ารายชื่อนักเรียน (.XLS/.XLSX) </button>'+
                    '<table id="dtable" class="dtable2 table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >'+
                        '<thead style="font-size: 15px;">'+
                            '<tr>'+
                                '<th style="width:5% !important;" class="text-center">ลำดับ</th>'+
                                '<th style="width:20% !important;" class="text-center">เลชบัตรประจำตัวประชาชน</th>'+
                                '<th style="width:15% !important;" class="text-center">เพศ</th>'+
                                '<th style="width:20% !important;" class="text-center">ชื่อ</th>'+
                                '<th style="width:20% !important;" class="text-center">นามสกุล</th>'+
                                '<th style="width:15% !important;" class="text-center">อายุ</th>'+
                            '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                            elm2+
                        '</tbody>'+
                    '</table>' */
        /*                     elm2
                );    */
      });
    });
  });
  $("#mdViewGen")
    .data("id", id)
    .data("genid", genid)
    .modal("show"); //add code date
};

var modalAddGen = function(node) {
  //dialog check delete
  $("#addGen-title-container").empty(); //opy
  /* $("#viewAlbum-desc-container").empty(); //opy */
  $("#addGen-container-sec1").empty(); //opy
  $("#addGen-container-sec2").empty(); //opy
  var id = $(node).data("id");
  //var genid = $(node).data('genid');
  /* $.get( base_url+'school/generation_modal?gen_id='+genid, function(data){ */
  $.get(base_url + "school/std_crse_modal", function(data2) {
    //var jData = jQuery.parseJSON(data);
    var jData2 = jQuery.parseJSON(data2);
    /* $("#viewAlbum-container").empty(); */
    //var i = 0;

    var elm =
      '<select id="crse_code" name="schl_gen[crse_code]" placeholder="เลือก หลักสูตร" class="form-control elder_addr_pre" >';
    elm += "<option selected disabled>เลือก หลักสูตร</option>";
    arrdata = jData2;

    for (var i = 0; i < arrdata.length; i++) {
      /*                 if(arrdata[i]['crse_code'] == jData[0]['gn_crse_code']){
                    elm += '<option value="' + arrdata[i]['crse_code'] + '" selected>' + arrdata[i]['crse_title'] + '</option>';
                }else{ */
      elm +=
        '<option value="' +
        arrdata[i]["crse_code"] +
        '">' +
        arrdata[i]["crse_title"] +
        "</option>";
      /* } */
    }
    elm += "<option>อื่นๆ</option>";
    elm += "</select>";
    elm +=
      "<input name='schl_gen[crse_custom]' type='text' class='form-control crse_custom' placeholder='โปรดระบุ' style='display:none'>";

    /* $('.select_crse').append(elm); */

    //var datetm = formatDateThai1(jData[0]['gn_insert_datetime']);
    //var dttime = jData[0]['gn_insert_datetime'].substring(11);

    //var imgbuttonlabel = "เพิ่มรูปภาพ";
    //var timetablepicture = "OP02_no_picture.png";
    var dateuptodate = "";
    var dateuptodate2 = "";

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
      dd = "0" + dd;
    }

    if (mm < 10) {
      mm = "0" + mm;
    }

    today = yyyy + "-" + mm + "-" + dd;

    var datetm = formatDateThai1(today);
    //var dttime = jData[0]['gn_insert_datetime'].substring(11);

    $("#addGen-title-container").append(
      '<b><i class="fa fa-flag"></i> กรอกรายละเอียดรุ่น' +
      '<div style="padding-left:50px;"><text style="font-size: 15px;"><b> วันที่เพิ่ม: </b>' +
      datetm +
      "<br>" + //<!-- ('+dttime+' น.) -->
        "<b>สถานะรุ่น: </b>" +
        "(ยังไม่ได้ระบุ)" +
        "</text></div>"
      //+'<input type="hidden" name="schlid[]" value="'+id+'" /> <!-- Set hidden album_id field -->'
    );

    //console.log(genid+' // '+str+' // '+dateuptodate+' // '+elm);
    console.log(id + " // " + dateuptodate + " // " + elm);
    $("#addGen-container-sec1").append(
      '<div class="form-group row" style="padding-left: 15px; padding-right: 15px;">' +
        '<div class="panel-group" style="margin-bottom:20px !important;">' +
        '<div class="panel panel-default" style="border: 0">' +
        '<div class="panel-heading">' +
        "<h4>รายละเอียดรุ่นและหลักสูตร</h4>" +
        "</div>" +
        "</div>" +
        "</div>" +
        '<div class="col-xs-12 col-sm-2 has-error" >' +
        '<input type="hidden" name="schl_gen[schl_id]" value="' +
        id +
        '">' +
        '<label class="col-2 col-form-label" style="color: red;">รุ่นที่ </label>' +
        '<input type="number" min="1" placeholder="รุ่น" class="form-control" name="schl_gen[gen_code]" value="' +
        '" title="" required>' +
        "</div>" +
        '<div class="col-xs-12 col-sm-2">' +
        '<label class="col-2 col-form-label" style="color: red;">วันที่เริ่ม</label>' +
        '<div id="datetimepicker3" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">' +
        '<input title="วันที่เริ่มรุ่น" placeholder="เลือกวันที่" class="form-control" type="text" name="schl_gen[first_date_of_edu]" required />' +
        '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>' +
        '<script type="text/javascript">' +
        "$(function () {" +
        '$("#datetimepicker3").datepicker({' +
        "autoclose: true," +
        "todayHighlight: true," +
        "format: 'dd/mm/yyyy'," +
        "todayBtn: true," +
        "language: 'th'," +
        "thaiyear: true" +
        "})" +
        dateuptodate +
        "});" +
        "</script>" +
        "</div>" +
        "</div>" +
        '<div class="col-xs-12 col-sm-2">' +
        '<label class="col-2 col-form-label" style="color: red;">วันที่จบ</label>' +
        '<div id="datetimepicker4" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">' +
        '<input title="วันที่จบรุ่น" placeholder="เลือกวันที่" class="form-control" type="text" name="schl_gen[last_date_of_edu]" required>' +
        '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>' +
        '<script type="text/javascript">' +
        "$(function () {" +
        '$("#datetimepicker4").datepicker({' +
        "autoclose: true," +
        "todayHighlight: true," +
        "format: 'dd/mm/yyyy'," +
        "todayBtn: true," +
        "language: 'th'," +
        "thaiyear: true" +
        "})" +
        dateuptodate2 +
        "});" +
        "</script>" +
        "</div>" +
        //'<!-- <input id="gen_status" name="schl_gen[gen_status]" type="hidden" value="เปิด" checked> --><!-- เปิด/ปิดการศึกษา -->'+
        "</div>" +
        '<div class="col-xs-12 col-sm-2">' +
        '<label class="col-2 col-form-label">วัน/สัปดาห์</label>' +
        '<input type="number" min="0" max="7" placeholder="วัน" name="schl_gen[days_per_week]" class="form-control" value="' +
        '">' +
        "</div>" +
        '<div class="col-xs-12 col-sm-2">' +
        '<label class="col-2 col-form-label">ชม./สัปดาห์</label>' +
        '<input type="number" min="0" max="168" placeholder="ชม." name="schl_gen[hours_per_week]" class="form-control" value="' +
        '">' +
        "</div>" +
        '<div class="col-xs-12 col-sm-2">' +
        '<label class="col-2 col-form-label">หลักสูตร</label>' +
        "<br>" +
        elm +
        "</div>" +
        "</div>"
    );
    /*             $("#addGen-container-sec2").append(
                '<div class="panel-group" style="margin-bottom:20px !important;">'+
                    '<div class="panel panel-default" style="border: 0">'+
                        '<div class="panel-heading">'+
                            '<h4>ตารางเรียน</h4>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="col-xs-12 col-sm-12 col-lg-12 element"   style="margin-top: 0px; margin-left: 25px; height: auto; word-wrap: break-word; font-size: 13px;">'+
                    '<img src="'+base_url+'/assets/modules/school/images/'+timetablepicture+'" class="image2" >  '+
                    '<input type="file" name="img2"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,\'\');">'+
                    '<button id="btnAddimg" type="button" class="btn btn-default" style="width: 138px; margin-top:20px;" onclick="brwImg(this,\'\');"><i class="fa fa-upload"></i> '+imgbuttonlabel+'</button>'+
                '</div>'
            ); */
  });
  /* }); */

  $("#mdAddGen")
    .data("id", id)
    .modal("show"); //add code date
};

/* var modalActive = function(node) {
    var id = $(node).data('id');
    var genid = $(node).data('genid');
    $('#mdActive').data('id', id).data('genid', genid).modal('show');
} */

var modalActive = function(node) {
  //dialog check delete
  $("#viewGenStatus").empty();
  var id = $(node).data("id");
  var genid = $(node).data("genid");

  $.get(base_url + "school/generation_modal?gen_id=" + genid, function(data) {
    var jData = jQuery.parseJSON(data);

    if (jData[0]["gn_gen_status"] == "เปิดการศึกษา") {
      var start_sel = "selected";
      var end_sel = "";
    } else if (jData[0]["gn_gen_status"] == "ปิดการศึกษา") {
      var start_sel = "";
      var end_sel = "selected";
    } else {
      var start_sel = "";
      var end_sel = "";
    }

    $("#viewGenStatus").append(
      '<input type="hidden" name="schl_gen[gen_id]" value="' +
        jData[0]["gn_gen_id"] +
        '">' +
        '<input type="hidden" name="schl_gen[schl_id]" value="' +
        jData[0]["gn_schl_id"] +
        '">' +
        '<select  title="สถานะของรุ่น" placeholder="เลือกหัวข้อ" class="form-control elder_addr_pre" name="schl_gen[gen_status]">' +
        '<option value="" selected>เลือกสถานะ</option>' +
        '<option value="เปิดการศึกษา" ' +
        start_sel +
        ">เปิดการศึกษา</option>" +
        '<option value="ปิดการศึกษา" ' +
        end_sel +
        ">ปิดการศึกษา</option>" +
        "</select>"
    );
  });
  $("#mdActive")
    .data("id", id)
    .data("genid", genid)
    .modal("show"); //add code date
};

function formatDateThai1(date) {
  if (date == "") {
    return "";
  }
  var str = date.substring(0, 10);
  var spl = str.split("-");

  var thai_month_arr = [
    "",
    "ม.ค.",
    "ก.พ.",
    "มี.ค.",
    "เม.ย.",
    "พ.ค.",
    "มิ.ย.",
    "ก.ค.",
    "ส.ค.",
    "ก.ย.",
    "ต.ค.",
    "พ.ย.",
    "ธ.ค."
  ];

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
      mmonth = thai_month_arr[3];
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

  var yyear = parseInt(spl[0]) + 543;

  var dday = parseInt(spl[2]).toString();

  var conc = dday.concat(" ", mmonth, " ", yyear);
  return conc;
}

$(document).on("change", "#crse_code", function() {
  if ($(this).val() === "อื่นๆ") {
    $("input.crse_custom").show();
  } else
    $("input.crse_custom")
      .hide()
      .val("");
});

//=== End Add Code ===//
