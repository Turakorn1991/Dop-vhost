<!--
<h3 style="color: #4e5f4d"><?php echo $title;?></h3>
<hr/>

   <div class="row">
	   <div class="col-xs-12 col-sm-12 text-right">

          <?php
            $tmp = $this->admin_model->getOnce_Application(163);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(163,$user_id); //Check User Permission
          ?>
          <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('school/center_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกแบบขึ้นทะเบียน<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
              <i class="fa fa-plus" aria-hidden="true"></i>
          </a>

          <?php
            $tmp = $this->admin_model->getOnce_Application(6);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
          ?>
          <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/excel');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
              <i class="fa fa-file-excel-o" aria-hidden="true"></i>
          </a>

          &nbsp;
          <a style="color: #000; padding-left: 20px; padding-right: 20px;" title="ค้นหา" class="btn btn-default" data-toggle="modal" data-target="#mySearch">
              <i class="fa fa-filter" aria-hidden="true"></i>
		      </a>

	   </div>
   </div>
   -->


      <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(59);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('school/center_info');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม </a>


    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(62);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(62,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/G0/xls');?>"
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
  </script>

  <?php
    //summary
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/center_list_summary.php');
    //search
    $this->load->file(APPPATH.'modules/'.uri_seg(1).'/views/back-end/center_list_filter.php');
  ?>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;" class="text-center">#</th>
            <th class="text-center" style="width:10% !important;" class="text-center">ชื่อหน่วยงาน</th>
            <th style="width:10% !important;" class="text-center">ที่ตั้ง</th>
            <th style="width:10% !important;" class="text-center">เบอร์โทรศัพท์</th>
            <th style="width:10% !important;" class="text-center">ผลการตรวจมาตรฐาน/ตัวชี้วัด(คะแนน)</th>
            <th style="width:1% !important;" class="text-center">&nbsp;</th>
        </tr>
			</thead>
      <tbody>
        <?php
        $number = 1;
            foreach ($center_info as $key => $schl) {

        ?>
                <tr>
                    <td class="lnk text-center"><?php echo $number; ?></td>
                    <td class="lnk">
                        <?php echo $schl['qlc_name'];?>
                    </td>
                    <td class="lnk">
                    <?php
                     if($schl['addr_province']!=''){
                      $sub_district = $this->common_model->query("SELECT * FROM std_area WHERE area_code = {$schl['addr_sub_district']}")->row_array();
                      $district = $this->common_model->query("SELECT * FROM std_area WHERE area_code = {$schl['addr_district']}")->row_array();
                     $province = $this->common_model->query("SELECT * FROM std_area WHERE area_code = {$schl['addr_province']}")->row_array();
                            echo 'ตำบล '.$sub_district['area_name_th'].' '.'อำเภอ '.$district['area_name_th'].' '.'จังหวัด '.$province['area_name_th'];
                     }else{
                      echo "-";
                     }

                    ?>

                    </td>
                  <td class="lnk text-center"><?php if($schl['tel_no'] != ''){ echo $schl['tel_no']; }else{ echo " - ";} ?></td>
                    <!-- จำนวนรุ่นตามโรงเรียน-->
                    <td class="lnk text-center">
                       <div class="progress">
                          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0"
                          aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            สำเร็จ 0% (success)
                          </div>
                        </div>
                    </td>



               <td><center><!-- Single button -->
                <div class="btn-group" style="cursor: pointer;">
                  <i data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>

                  <ul class="dropdown-menu" style="position: absolute;left: -190px;"> 
                    <li>
                      <a style="font-size:16px;" data-toggle="modal" data-target="#prt" title="พิมพ์แบบฟอร์ม">
                       <i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> พิมพ์แบบฟอร์ม (.PDF)
                   </a>
                 </li>
                   <li><a style="font-size:16px;" href="<?php echo site_url('school/center_info/').'/Edit/'.$schl['qlc_id']; ?>">
                    <i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ</a>
                   </li>
                   <li><a style="font-size:16px;" data-id="<?php  echo $schl['qlc_id']?>" onclick="opn(this)" title="ลบ">
                             <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                          </a>
                  </li>
                  </ul>
                              </div><!-- Print Modal -->
                   <div class="modal fade" id="prt" role="dialog">
                     <div class="modal-dialog">

                        <!-- Modal content-->
                       <div class="modal-content">
                         <div class="modal-header text-left">
                           <button type="button" class="close" data-dismiss="modal">×</button>
                            <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
                          </div>
                         <div class="modal-body">
                           <div class="row"><div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;">
                                 <a style="color: #333; font-size: 16px;" target="_blank" href="/report/D1/pdf?id=514"><i class="fa fa-print" aria-hidden="true"></i> บ้านของผู้สูงอายุ ส่งออกไฟล์ แบบสอบถามความต้องการฯ (D1) (PDF)  </a>
                             </div><div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"><a style="color: #333; font-size: 16px; margin-bottom: 50px;" target="_blank" href="/report/D2/pdf?id=514"><i class="fa fa-print" aria-hidden="true"></i> บ้านของผู้สูงอายุ ส่งออกไฟล์ หนังสือให้ความยินยอมฯ (D2) (PDF)
                            </a>
                          </div>
                           </div>
                           <br>

                        </div>
                      </div>

                    </div>
                   </div>
                   <!-- End Print Modal --></center></td>


                          <!-- Print Modal -->
            <div class="modal fade" id="prt<?php echo $schl['schl_id']; ?>" role="dialog">
              <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
              <div class="modal-header text-left">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
              </div>
              <div class="modal-body">
              <div class="row ">
              <!--
              <?php
                $tmp  = $this->admin_model->getOnce_Application(49);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(49, get_session('user_id')); //Check User Permission
                    ?>
                                                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                            <?php
                                if (!isset($tmp1['perm_status'])) {?>
                                                            class="disabled"
                                                            <?php
                              } else if ($usrpm['app_id'] == 49) {
                                      ?>
                                                            class="active"
                                                            <?php
                              }
                                  ?>
              >
              -->
              <div class="col-xs-12 col-sm-12 text-left">
              <a style="color: #333; font-size: 16px;" target="_blank"
              href="<?php echo site_url('report/G7/pdf?id='.$schl['schl_id']); ?>"><i class="fa fa-print"
              aria-hidden="true"></i> ส่งออกไฟล์ ประกาศนียบัตรการเป็นผู้นำบริหารโรงเรียน (G7) (PDF)
               <!--<?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>-->
              </a>
              </div>
              </div>

              </div>

              </div>
              <br />

              </div>
              </div>

              </div>
              </div>
              <!-- End Print Modal -->


                    </td>
                </tr>



          <?php
             $number++;
            } //close foreach
          ?>

      </tbody>
		</table>

  </div>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Delete Modal -->
<div id="dltModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('034');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->
