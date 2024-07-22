var table;
$(document).ready(function() {

    table = $('#dtable').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      // Load data for the table's content from an Ajax source
      "ajax": {
           "url": dtable_url,
           "type": "POST",
           data:{ 'request':'get_users_invoices', 'csrf_dop': csrf_hash},
           //
           complete: function(response) {
             //export_setting(response.responseJSON.recordsFiltered);
             rs = response.responseJSON.recordsFiltered/500;
             if(response.responseJSON.recordsFiltered%500>0) {
               rs = parseInt(rs)+1;
             }
             rs = rs=='Undefined'?0:rs;
             html = "<h3>รายการส่งออกข้อมูล ทั้งหมด "+Number(response.responseJSON.recordsFiltered.toFixed(1)).toLocaleString()+" รายการ จำนวน "+rs+" ไฟล์ </h3>";
             //$("#lnkModel .modal-body").html("<h3>รายการส่งออกข้อมูล จำนวน "+response.responseJSON.recordsFiltered+" รายการ</h3>");
             if(rs>0) {
               html+= "<h3><ul style='list-style:none'>";
               tmp = 0;
               for(i=0;i<rs;i++) {
                 sort = parseInt(500*((i-1)+1))+1;
                 if((i+1)>=rs) {
                   dest = response.responseJSON.recordsFiltered;
                 }else {
                   dest = parseInt(500*(i+1));
                 }
                 html+="<li><a href='"+base_url+"report/D6/xls?sheet="+(i+1)+"' target='_blank'>ไฟล์ที่ "+(i+1)+" รายการที่ "+Number(sort.toFixed(1)).toLocaleString()+"-"+Number(dest.toFixed(1)).toLocaleString()+"</a></li>";
               }
               $("#lnkModel .modal-body").html(html+"</ul></h3>");
             }else {
             }
           }
           //
      },
      //Set column definition initialisation properties.
      "columnDefs": [
        { "name": "A.ptype_code_remark", "targets": 1 },
        { "name": "A.date_of_svy", "targets": 2 },
        { "name": "A.consi_result", "targets": 3 },
        { "name": "A.date_of_finish", "targets":4 },
        { "name": "A.case_budget", "targets": 5 },
        { "name": "start_age", "targets": 7,"visible": false },
        { "name": "end_age", "targets": 8,"visible": false },
      ],
      "order": [[ 0, "desc" ]],

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
        // console.log($('#col'+i+'_filter').val());
    }

    $("#filtersearch").on('click', function () {
      $('.column_filter').each(function() {
        console.log("filter: "+$(this).val());
        if($(this).val() != ''){
          filterColumn($(this).data('column'));
        }

      });
      // table.draw();
    });

    $("#dtable_filter").hide();


});

$('#dltModel').on('show', function() {var id = $(this).data('id'),removeBtn = $(this).find('.danger');});

//$('.confirm-delete').on('click', function(e) {e.preventDefault();var id = $(this).data('id');$('#myModal').data('id', id).modal('show');});

$('#btnYes').click(function() {
    window.location.replace(base_url+'adaptenvir/inquire1'+'/Delete/'+$('#dltModel').data('id'));
});

var opn = function(node) {
    var id = $(node).data('id');
    $('#dltModel').data('id', id).modal('show');
}
//
$("#exportLnk").click(function(){
  console.log('Export Dialog Opened');
  $('#lnkModel').modal();
});
//
