var table;
var postList = [];
var strFilter = ''
$(document).ready(function() {

  $("#filterexport").on('click', function () { 

    postList.push($('#col1_filter').val()); //placeholder="ชื่อหน่วยงาน ศพอส."
    postList.push($('#col2_filter').val()); //type="hidden" ภาค
    postList.push($('#col3_filter').val()); //type="hidden" จังหวัด
    postList.push($('#col4_filter').val()); //type="hidden" อำเภอ
    postList.push($('#col5_filter').val()); //type="hidden" ปีงบ start
    postList.push($('#col6_filter').val()); //type="hidden" ปีงบ end
    postList.push($('#col7_filter').val()); //type="hidden" grade
    postList.push($('#col8_filter').val()); //type="hidden" order by ?
    //   $.ajax({
    //     type: "POST",
    //     url: export_url,
    //     data:{ 'request':'get_users_invoices', 'csrf_dop': csrf_hash,'data': postList},
    //     success: function (data){
    //      alert('DONE')
    //      console.log(data);
    //  } // serializes the form's elements.

    //   });
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", dtable_url);
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "qlc_name");
    hiddenField.setAttribute("value", postList[0]);

    form.appendChild(hiddenField);
    // for(var key in params) {
    //     if(params.hasOwnProperty(key)) {
    //         var hiddenField = document.createElement("input");
    //         hiddenField.setAttribute("type", "hidden");
    //         hiddenField.setAttribute("name", key);
    //         hiddenField.setAttribute("value", params[key]);

    //         form.appendChild(hiddenField);
    //     }
    // }

    document.body.appendChild(form);
    form.submit();

    });

    table = $('#dtable').DataTable({
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      // Load data for the table's content from an Ajax source
      "ajax": {
           "url": dtable_url,
           "type": "POST",
           data:{ 'request':'get_users_invoices', 'csrf_dop': csrf_hash,'data':postList},
      },
      //Set column definition initialisation properties.
      "columnDefs": [
        { "name": "A.qlc_name",  "targets": 1 }, //do new filter : old code { "name": "qlc_name",  "targets": 1 }
        { "name": "B.four_regions",  "targets": 2 }, //do new filter : add code 
        { "name": "B.area_code", "targets": 3 }, //do new filter : add code (as C)
        { "name": "D.area_code", "targets": 4 }, //do new filter : add code
        { "name": "A.year_of_sponsorship", "targets": 5 }, //do new filter : add code Sponsor Year
        { "name": "A.year_of_sponsorship_2", "targets": 6 }, //do new filter : add code Sponsor Year 2
        { "name": "qlc_kpi_grade", "targets": 7 }, //do new filter : add code Latest Grade
        { "name": "obf", "targets": 8 }, //do new filter : add code Latest Grade
        // // { "name": "CONCAT(C.pers_firstname_th,' ', C.pers_lastname_th)",    "targets": 4 },
        // { "name": "A.consi_result","targets": 3 },
        // { "name": "A.date_of_finish","targets":4 },
        // { "name": "A.case_budget","targets": 5 },
      ],
      "order": [[ 0, "desc" ]],

      // "searching": false,
      "bSort" : false,
      "bLengthChange": false,
      "pageLength": 5, //50
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
        console.log($('#col'+i+'_filter').val());
    }
    
    $("#filtersearch").on('click', function () { //do new filter : old code $("#filter").on('click', function () {
      $('.column_filter').each(function(  ) { //do new filter : old code $('input.column_filter').each(function(  )
        if($(this).val() != ''){
          filterColumn($(this).data('column'));
        }
      });
      // table.draw();
    });

    $("#dtable_filter").hide();

    //====== start - opy do new export =============



    //====== end - opy do new export =============
});

$('#dltModel').on('show', function() {var id = $(this).data('id'),removeBtn = $(this).find('.danger');});

//$('.confirm-delete').on('click', function(e) {e.preventDefault();var id = $(this).data('id');$('#myModal').data('id', id).modal('show');});

$('#btnYes').click(function() {
    window.location.replace(base_url+'school/center_info'+'/Delete/'+$('#dltModel').data('id'));
});

var opn = function(node) {
    var id = $(node).data('id');
    $('#dltModel').data('id', id).modal('show');
}

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