 <div id="tmp_menu" hidden='hidden'>



    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม </a>

    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="#" data-toggle="collapse" data-target="#collapseExample">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
     $tmp = $this->admin_model->getOnce_Application(151);
     $tmp1 = $this->admin_model->chkOnce_usrmPermiss(151,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/I1/xls');?>"
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
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/registered_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/registered_list_filter.php');
  ?>

<div class="table-responsive">
  <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
    <thead style="font-size: 15px;">
      <tr>
          <th style="width:2% !important;" class="text-center">#</th>
          <th style="width:10% !important;" class="text-center">วันที่ขึ้นทะเบียน</th>
          <th style="width:12% !important;" class="text-center">เลขประจำตัว ปชช.</th>
          <th style="width:38% !important;" class="text-center">ชื่อตัว - ชื่อสุกล</th>
          <th style="width:7% !important;" class="text-center">อายุ (ปี)</th>
          <th class="text-center">ประเภทงานที่ต้องการ</th>
          <th class="text-center">สาขาความเชี่ยวชาญ</th>
          <th style="width:7% !important;" class="text-center">สถานะ</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($regList as $i => $value) {
      $po = $this->personal_model->getOnce_PersonalInfo($value['pers_id']);
    ?>
      <tr onmouseover="$(this).css('cursor','pointer')" style="cursor: pointer;" onmoueseout="$(this).css('cursor','default')">
        <td class="lnk text-center"><?php echo $i+1;?></td>
        <td class="lnk text-center"><?php echo dateChange($value['date_of_reg'],5); ?></td>
        <td class="lnk text-center"><?php echo $po['pid'];?></td>
        <td class="lnk"><?php echo $po['prename_th'].$po['name'];?></td>
        <td class="lnk text-center">
          <?php
          $age = '';
          if($po['date_of_birth']!='') {
            $date = new DateTime($po['date_of_birth']);
            $now = new DateTime();
            $interval = $now->diff($date);
            $age = $interval->y;
            echo $age;
          }
          ?>
        </td>
        <td class="lnk text-center"><?php echo $value['org_type']; ?></td>
        <td class="lnk text-center"><?php echo $value['exp_name']; ?></td>
        <td class="lnk text-center">
          <?php if($value['reg_status'] == 'ยังไม่ได้งาน'){ ?>
            <font color="red"><?php echo $value['reg_status']; ?></font>
          <?php }else{ ?>
            <font color="#18bd15"><?php echo $value['reg_status']; ?></font>
          <?php } ?>
        </td>
      </tr>

      <!-- Info Modal -->
      <div class="modal fade" id="<?php echo $po['pid'];?>" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
           <div class="modal-header" style="background-color: #eee">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title text-left" style="font-size:18px;"><?php echo $po['prename_th'].$po['name'];?></h3>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-xs-12">
                  <div class="row" style="font-size: 16px;">
                    <div class="col-xs-12 col-sm-3"><h4 style="font-size: 16px;">เลขประจำตัวประชาชน</h4></div><div class="col-xs-12 col-sm-6"><?php echo $po['pid'];?></div>
                  </div>
                  <div class="row" style="font-size: 16px;">
                    <div class="col-xs-12 col-sm-3"><h4 style="font-size: 16px;">วันเดือนปีเกิด</h4></div><div class="col-xs-12 col-sm-6"><?php echo formatDateThai($po['date_of_birth']);?> (อายุ <?php echo $age;?> ปี)</div>
                  </div>
                  <div class="row" style="font-size: 16px;">
                    <div class="col-xs-12 col-sm-3"><h4 style="font-size: 16px;">เพศ</h4> </div><div class="col-xs-12 col-sm-6"><?php echo $po['gender_name']; ?></div>
                </div>
                <div class="row" style="font-size: 16px;">
                    <div class="col-xs-12 col-sm-3"><h4 style="font-size: 16px;">สัญชาติ</h4> </div><div class="col-xs-12 col-sm-6"><?php echo $po['nation_name_th']; ?></div>
                </div>
                <div class="row" style="font-size: 16px;">
                    <div class="col-xs-12 col-sm-3"><h4 style="font-size: 16px;">ศาสนา</h4> </div><div class="col-xs-12 col-sm-6"><?php echo $po['relg_title']?$po['relg_title']:'-'; ?></div>
                  </div>
                  <div class="row" style="font-size: 16px;">
                  &nbsp;
                  </div>

                  <div class="row" style="font-size: 16px;">
                    &nbsp;
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12" >
                      <div style="font-size: 16px;">
                        <span>แหล่งข้อมูล:</span> <b><?php echo $value['rec_source']; ?></b>
                      </div>
                      <div style="font-size: 16px;">
                        <span>วันที่ปรับปรุง:</span> <b><?php echo formatDateThaiFromDatatime(date("Y-m-d H:i",strtotime($value['rec_update'])))." น."; ?></b>
                      </div>
                    </div>
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
      <span>แหล่งข้อมูล:</span> <b><?php echo @$regList[0]['rec_source']; ?></b>
    </div>
    <div>
      <span>วันที่ปรับปรุง:</span> <b><?php if(@$regList[0]['rec_source'] != '') echo @formatDateThaiFromDatatime(date("Y-m-d H:i",strtotime($regList[0]['rec_update'])))." น."; ?></b>
    </div>
  </div>
</div>
