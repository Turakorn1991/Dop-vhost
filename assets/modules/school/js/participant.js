var table;
$(document).ready(function() {

    table = $('#dtable').DataTable({
      // "searching": false,
      "bSort" : false,
      "bLengthChange": false,
      "pageLength": 50,
      "responsive": true,
      "language": {
        "sProcessing":   "กำลังดำเนินการ...",
        "sLengthMenu":   "แสดง _MENU_ แถว",
        "sZeroRecords":  "ไม่พบข้อมูล",
        // "sInfo":         "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว / รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
        "sInfo":         "รายการทั้งหมด จำนวน _TOTAL_ รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
        // "sInfoEmpty":    "แสดง 0 ถึง 0 จาก 0 แถว",
        "sInfoEmpty":    "รายการทั้งหมด จำนวน 0 รายการ (แบ่งออกเป็น _PAGES_ หน้า หน้าละ 50 รายการ)",
        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
        "sInfoPostFix":  "",
        "sSearch":       "ค้นหา: ",
        "sUrl":          "",
        "oPaginate": {
          "sFirst":    '<i class="fa fa-step-backward" style="font-size: 12px;" aria-hidden="true"></i>',
          "sPrevious": '<i class="fa fa-backward" style="font-size: 12px;" aria-hidden="true"></i>',
          "sNext":     '<i class="fa fa-forward" style="font-size: 12px;" aria-hidden="true"></i>',
          "sLast":     '<i class="fa fa-step-forward" style="font-size: 12px;" aria-hidden="true"></i>'
        }
      }

      });

    function filterColumn (i) {
        $('#dtable').DataTable().column(i).search(
            $('#col'+i+'_filter').val()
        ).draw();
    }
    
    $("#filter").on('click', function () {
      $('input.column_filter').each(function(  ) {
        filterColumn($(this).data('column'));
      });
      // table.draw();
    });


    $("#dtable_filter").hide();

});