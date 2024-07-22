<script>
  var dtable_url = '<?php echo site_url('monitordata/diff_list_ajax');?>';
  var csrf_hash = '<?php echo @$csrf['hash'];?>';
  var req_case = '<?php echo $this->uri->segment('3');?>';
</script>
  <script>
    setTimeout(function(){
      $("#menu_topright").html($("#tmp_menu").html());
    },300);

    function showChart(){
      $('#collapseExample').removeClass("in");
      $("#chart_display").slideToggle();
      //$(".collapse").hide();
      //$(".collapse").slideToggle();
    }
    function showFilter(){
      $("#chart_display").hide();
    }

  </script>

  <div class="table-responsive">
    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;">
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;">#</th>
            <th style="width:12% !important;">เลขประจำตัว ปชช.</th>
            <th style="width:28% !important;">ชื่อตัว-ชื่อสกุล</th>
            <th >เพศ</th>
            <th style="width:7% !important;">วันเดือนปี เกิด</th>
            <th style="width:10% !important;">แจ้งเรื่อง</th>
            <th style="width:10% !important;">ตรวจเยี่ยม</th>
            <th style="width:10% !important;">การช่วยเหลือ</th>
            <th style="width:10% !important;">จำนวน (บาท)</th>
            <th style="width:10% !important;">&nbsp;</th>
        </tr>
			</thead>
      <tbody>

      </tbody>
		</table>

  </div>
