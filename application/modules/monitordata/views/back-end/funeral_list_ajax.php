<script>
  var dtable_url = '<?php echo site_url('monitordata/funeral_list_ajax');?>';
  var csrf_hash='<?php echo @$csrf['hash'];?>';
  var req_case = '<?php echo $this->uri->segment('3');?>';
</script>

  <script>
    setTimeout(function(){
      $("#menu_topright").html($("#tmp_menu").html());
    },300);

    function showChart(){
      $('#collapseExample').removeClass("in");
      $("#chart_display").slideToggle();
    }
    function showFilter(){
      $("#chart_display").hide();
    }
  </script>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;" class="text-center">ลำดับ</th>
            <th style="width:12% !important;" class="text-center">เลขประจำตัว ปชช.</th>
            <th style="width:27% !important;" class="text-center">ชื่อตัว-ชื่อสกุล <br>(ผู้สูงอายุผู้เสียชีวิต)</th>
            <th style="width:7% !important;" class="text-center">อายุ (ปี)</th>
            <th style="width:10% !important;" class="text-center">วันที่ยื่นคำขอ</th>
            <th style="width:10% !important;" class="text-center">วันที่ได้รับ <br>การสงเคราห์</th>
            <th style="width:10% !important;" class="text-center">จำนวนเงิน (บาท)</th>
            <th style="width:10% !important;">&nbsp;</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>

  </div>
