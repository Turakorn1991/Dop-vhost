    <script>
      var dtable_url = '<?php echo site_url('monitordata/activity_list_ajax');?>';
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
                            <th style="width:28% !important;" class="text-center">ชื่อสถานที่จัดกิจกรรมของผู้สูงอายุ</th>
                            <!-- <th class="text-center">ที่อยู่</th> -->
                            <th style="width:10% !important;" class="text-center">วันที่ได้รับการสำรวจ</th>
                            <th class="text-center">ผลการพิจารณา</th>
                            <th style="width:10% !important;" class="text-center">วันที่เสร็จสิ้น</th>
                            <th style="width:10% !important;" class="text-center">งบประมาณที่ใช้ไป (บาท)</th>
                            <th style="width:10% !important;">&nbsp;</th>
                        </tr>
                  </thead>
                  <tbody>
                  </tbody>
            </table>
      </div>
