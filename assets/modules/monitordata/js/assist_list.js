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
       /*
       // Show Export Tools
       dom: '<"html5buttons"B>lTfgitp',
       buttons: [
           {extend: 'copy'},
           {extend: 'csv'},
           {extend: 'excel', title: 'ExampleFile'},
           {extend: 'pdf', title: 'ExampleFile'},
           {extend: 'print',

            customize: function (win){
                   $(win.document.body).addClass('white-bg');
                   $(win.document.body).css('font-size', '10px');

                   $(win.document.body).find('table')
                           .addClass('compact')
                           .css('font-size', 'inherit');
           }
           }
       ]
       */
    });

    // $.fn.dataTable.ext.search.push(
    //   function( settings, data, dataIndex ) {
    //       var form = $('#form').val();
    //       var to = $('#to').val();
    //       var date = data[4]; // use data for the date column
   
    //       if ( ( isNaN( form ) && isNaN( to ) ) ||
    //            ( isNaN( form ) && date <= to ) ||
    //            ( form <= date   && isNaN( to ) ) ||
    //            ( form <= date   && date <= to ) )
    //       {
    //           return true;
    //       }
    //       return false;
    //   }
    // );

    // $.fn.dataTableExt.afnFiltering.push(
    //   function( oSettings, aData, iDataIndex ) {
    //     // var iFini = document.getElementById('from').value;
    //     // var iFfin = document.getElementById('to').value;
    //     var iFini = $('#form').val();
    //     var iFfin = $('#to').val();
    //     var iStartDateCol = 4;
    //     var iEndDateCol = 4;
 
    //     iFini=iFini.substring(6,10) + iFini.substring(3,5)+ iFini.substring(0,2);
    //     iFfin=iFfin.substring(6,10) + iFfin.substring(3,5)+ iFfin.substring(0,2);
 
    //     var datofini=aData[iStartDateCol].substring(6,10) + aData[iStartDateCol].substring(3,5)+ aData[iStartDateCol].substring(0,2);
    //     var datoffin=aData[iEndDateCol].substring(6,10) + aData[iEndDateCol].substring(3,5)+ aData[iEndDateCol].substring(0,2);
 
    //     if ( iFini === "" && iFfin === "" )
    //     {
    //         return true;
    //     }
    //     else if ( iFini <= datofini && iFfin === "")
    //     {
    //         return true;
    //     }
    //     else if ( iFfin >= datoffin && iFini === "")
    //     {
    //         return true;
    //     }
    //     else if (iFini <= datofini && iFfin >= datoffin)
    //     {
    //         return true;
    //     }
    //     return false;
    //   }
    // );
    
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

$('#dltModel').on('show', function() {var id = $(this).data('id'),removeBtn = $(this).find('.danger');});

//$('.confirm-delete').on('click', function(e) {e.preventDefault();var id = $(this).data('id');$('#myModal').data('id', id).modal('show');});

$('#btnYes').click(function() {
    window.location.replace(base_url+'difficult/sufferer_form1'+'/Delete/'+$('#dltModel').data('id'));
});

var opn = function(node) {
    var id = $(node).data('id');
    $('#dltModel').data('id', id).modal('show');
}


$('#dtable').on('click', 'td.lnk', function () {
      
  // Get Data from record table
  var tmp = table.row($(this).parent()).data();
  console.log(tmp[1]);

  //console.log(name);
  //console.log( companyTable.row(this).data()[1]);
  //$("#company-full-name").val(companyTable.row(this).data()[1]);
  //$("#company-short-name").val(companyTable.row(this).data()[2]);
  //console.log(pid);
  $('#'+tmp[1]).modal("show");
});