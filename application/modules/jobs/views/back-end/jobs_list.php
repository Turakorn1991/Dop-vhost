
  <div id="tmp_menu" hidden='hidden'>

      <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม </a>


      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" type="button" id="filter" href="#" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
      <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

      <?php
       $tmp = $this->admin_model->getOnce_Application(151);
       $tmp1 = $this->admin_model->chkOnce_usrmPermiss(151,$user_id); //Check User Permission
      ?>
      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
      <?php if(!isset($tmp1['perm_status'])) {?>
             readonly
           <?php }else{?> href="<?php echo site_url('report/L0/xls');?>"
      <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
      <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>
      <!--
      <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
      -->
    </div>
    <script>
      setTimeout(function(){
        $("#menu_topright").html($("#tmp_menu").html());
      },300);
      function showChart(){
      $("#chart_display").slideToggle();
    }

    $("#guide-book").click(function(){
      window.open('/assets/modules/jobs/guide/Job_Manual.pdf', '_blank');
    });
    </script>

    <?php
      //summary
      $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/jobs_list_summary.php');
      //search
      $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/jobs_list_filter.php');
    ?>

<div class="table-responsive">
  <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
    <thead style="font-size: 15px;">
      <tr>
          <th style="width:2% !important;" class="text-center">#</th>
          <th class="text-center">วันที่ประกาศ</th>
          <th class="text-center">ชื่อตำแหน่งงาน</th>
          <th class="text-center">ประเภท</th>
          <th class="text-center">ประสบการณ์ (ปี)</th>
          <th class="text-center">ชื่อองค์กร</th>
          <th style="width:7% !important;" class="text-center">สถานะ</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($jobsList as $i => $value) { ?>
      <tr onmouseover="$(this).css('cursor','pointer')" style="cursor: pointer;" onmoueseout="$(this).css('cursor','default')">
        <td class="lnk text-center"><?php echo $i+1;?></td>
        <td class="lnk text-center"><?php echo dateChange($value['date_of_post'],5); ?></td>
        <td class="lnk"><?php echo $value['posi_title']; ?></td>
        <td class="lnk"><?php echo $value['posi_type_title']; ?></td>
        <td class="lnk text-center"><?php if($value['posi_experience'] != '') { echo $value['posi_experience']; }else{ echo "-";} ?></td>
        <td class="lnk"><?php echo $value['org_title']; ?></td>
        <td class="lnk text-center">
          <?php if($value['post_status'] == 'เปิดรับสมัคร'){ ?>
            <font color="#18bd15"><?php echo $value['post_status']; ?></font>
          <?php }else{ ?>
            <font color="red"><?php echo $value['post_status']; ?></font>
          <?php } ?>
        </td>
      </tr>

      <!-- Info Modal -->
      <div class="modal fade" id="<?php echo $i+1;?>" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
           <div class="modal-header" style="background-color: #eee">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title text-left" style="font-size: 18px;">รายละเอียดงาน</h3>
            </div>
            <div class="modal-body">
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">วันที่ประกาศ</h4></div>
                <div class="col-xs-12 col-sm-8"><?php echo formatDateThai($value['date_of_post']);?></div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">ชื่อตำแหน่งงาน</h4></div>
                <div class="col-xs-12 col-sm-8"><?php echo $value['posi_title']; ?></div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">งานประเภท</h4></div>
                <div class="col-xs-12 col-sm-8"><?php echo $value['posi_type_title']; ?></div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">เวลาทำงาน</h4></div>
                <div class="col-xs-12 col-sm-8"><?php if($value['posi_workday'] !== 'อื่น ๆ'){ echo $value['posi_workday'];}else{ echo $value['posi_work_day_identify'];} ?></div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">ประสบการณ์ (ปี)</h4></div>
                <div class="col-xs-12 col-sm-8"><?php if($value['posi_experience'] != '') { echo $value['posi_experience']; }else{ echo "-";} ?></div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">ลักษณะงาน</h4></div>
                <div class="col-xs-12 col-sm-8">
                  <?php echo $value['job_responsibility']; ?>
                </div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">ค่าตอบแทน</h4></div>
                <div class="col-xs-12 col-sm-8">
                  <?php echo $value['org_type']; ?>
                </div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">สถานะ</h4></div>
                <div class="col-xs-12 col-sm-8">
                  <?php if($value['post_status'] == 'เปิดรับสมัคร'){ ?>
                    <font color="#18bd15"><?php echo $value['post_status']; ?></font>
                  <?php }else{ ?>
                    <font color="red"><?php echo $value['post_status']; ?></font>
                  <?php } ?>
                </div>
              </div>
              <div class="row" style="font-size: 16px;">
                <div class="col-xs-12 col-sm-4"><h4 style="font-size: 16px;">ชื่อองค์กร</h4></div>
                <div class="col-xs-12 col-sm-8"><?php echo $value['org_title']; ?></div>
              </div>

              <div class="row">
                &nbsp;
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12">
                  <div  style="font-size: 16px;">
                    <span>แหล่งข้อมูล:</span> <b><?php echo $value['rec_source']; ?></b>
                  </div>
                  <div  style="font-size: 16px;">
                    <span>วันที่ปรับปรุง:</span> <b><?php echo formatDateThaiFromDatatime(date("Y-m-d H:i",strtotime($value['rec_update'])))." น."; ?></b>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Info Modal -->

    <?php } ?>
    </tbody>
  </table>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-12" style="font-size: 18px;">
    <div>
      <span>แหล่งข้อมูล:</span> <b><?php echo @$jobsList[0]['rec_source']; ?></b>
    </div>
    <div>
      <span>วันที่ปรับปรุง:</span> <b><?php if(@$jobsList[0]['rec_update'] != '') echo @formatDateThaiFromDatatime(date("Y-m-d H:i",strtotime($jobsList[0]['rec_update'])))." น."; ?></b>
    </div>
  </div>
</div>
