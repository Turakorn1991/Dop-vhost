var table;
$(document).ready(function() {
  table = $("#dtable").DataTable({
    processing: true, //Feature control the processing indicator.
    serverSide: true, //Feature control DataTables' server-side processing mode.
    // Load data for the table's content from an Ajax source
    ajax: {
      url: dtable_url,
      type: "POST",
      data: { request: "get_users_invoices", csrf_dop: csrf_hash }
    },
    //Set column definition initialisation properties.
    columnDefs: [
      { name: "A.qlc_name", targets: 1 }, //do new filter : old code { "name": "qlc_name",  "targets": 1 }
      { name: "B.four_regions", targets: 2 }, //do new filter : add code
      { name: "B.area_code", targets: 3 }, //do new filter : add code (as C)
      { name: "D.area_code", targets: 4 }, //do new filter : add code
      { name: "A.year_of_sponsorship", targets: 5 }, //do new filter : add code Sponsor Year
      { name: "A.year_of_sponsorship_2", targets: 6 }, //do new filter : add code Sponsor Year 2
      { name: "qlc_kpi_grade", targets: 7 }, //do new filter : add code Latest Grade
      { name: "obf", targets: 8 } //do new filter : add code Latest Grade
      // // { "name": "CONCAT(C.pers_firstname_th,' ', C.pers_lastname_th)",    "targets": 4 },
      // { "name": "A.consi_result","targets": 3 },
      // { "name": "A.date_of_finish","targets":4 },
      // { "name": "A.case_budget","targets": 5 },
    ],
    order: [[0, "desc"]],

    // "searching": false,
    bSort: false,
    bLengthChange: false,
    pageLength: 50,
    responsive: true,
    language: {
      sProcessing: "กำลังดำเนินการ...",
      sLengthMenu: "แสดง _MENU_ แถว",
      sZeroRecords: "ไม่พบข้อมูล",
      // "sInfo":         "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว / รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
      sInfo:
        "รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
      // "sInfoEmpty":    "แสดง 0 ถึง 0 จาก 0 แถว",
      sInfoEmpty:
        "รายการทั้งหมด จำนวน 0 รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
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

  function filterColumn(i) {
    $("#dtable")
      .DataTable()
      .column(i)
      .search($("#col" + i + "_filter").val())
      .draw();
  }

  $("#filtersearch").on("click", function() {
    //do new filter : old code $("#filter").on('click', function () {
    $(".column_filter").each(function() {
      //do new filter : old code $('input.column_filter').each(function(  )
      filterColumn($(this).data("column"));
    });
    // table.draw();
  });

  $("#dtable_filter").hide();
});

$("#dltModel").on("show", function() {
  var id = $(this).data("id"),
    removeBtn = $(this).find(".danger");
});

//$('.confirm-delete').on('click', function(e) {e.preventDefault();var id = $(this).data('id');$('#myModal').data('id', id).modal('show');});

$("#btnYes").click(function() {
  window.location.replace(
    base_url + "school/center_info" + "/Delete/" + $("#dltModel").data("id")
  );
});

var opn = function(node) {
  var id = $(node).data("id");
  $("#dltModel")
    .data("id", id)
    .modal("show");
};

/*$('#dtable').on('click', 'td button.lnk', function () {
    
  console.log($(this).data('info'));
        var data_info = $(this).data('info');
        $.each(data_info, function(key,val) {
            $("."+key).html(val );
            //console.log(key+': '+val);
        });

  $("#info").modal('show');
  //$('.m'+($(this).parent().parent().index()+1)).modal("show");
});*/
