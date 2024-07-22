   <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(52);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('volunteer/editor/insert');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-overview" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i style='font-size:14px;' class="fa fa-area-chart" aria-hidden="true"></i> ภาพรวม</a>


    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-search" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
    <i style='font-size:14px;' class="fa fa-search" aria-hidden="true"></i> ค้นหา</a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(146);
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(146,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('report/F0/xls');?>"
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์ </a>

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

  <div id="chart_display"  style="display: none;">
    <!-- Resources -->
    <script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/plugins/dataloader/dataloader.min.js")?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
    <script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>
    <div class="row">
      <div class="col-xs-12">
        <h2 style="text-align: center;">ปริมาณอาสาสมัครดูแลผู้สูงอายุ (อผส.) จำแนกรายจังหวัด</h2>
        <h2 style="text-align: center;">ข้อมูล ณ วันที่ <?php echo dateChange(date("Y-m-d"),1); ?></h2>
      </div>

      <div class="col-xs-12">
        <!-- Styles -->
        <style>
        #chartdiv {
          width   : 100%;
          height    : 500px;
          font-size : 16px;
        }
        </style>
        <!-- HTML -->
        <div id="chartdiv"></div>

        <!-- Chart code -->
        <script>
          var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "light",
            "fontSize": 16,
            "legend": {
                "equalWidths": false,
                "useGraphSettings": true,
                "valueAlign": "left",
                "valueWidth": 120
            },
            "dataLoader": {
              "url": "<?php echo base_url("volunteer/getChart"); ?>",
              "data": {"<?php echo $csrf['name']?>" : '<?php echo $csrf['hash']?>'},
              "format": "json"
            },
            "valueAxes": [{
                "id": "provinceAxis",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "left",
                "title": "จำนวน อาสาสมัครดูแลผู้สู้อายุ (อผส.)"
            }, {
                "id": "olderAxis",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "position": "right",
                "title": "จำนวน ผู้สูงอายุในความดูแล"
            }],
            "graphs": [{
                "alphaField": "alpha",
                "balloonText": "จำนวนอาสาสมัครดูแลผู้อายุ [[value]] คน",
                "dashLengthField": "dashLength",
                "fillAlphas": 0.7,
                "legendValueText": "[[value]] คน",
                "title": "จำนวนอาสาสมัครดูแลผู้อายุ",
                "type": "column",
                "valueField": "value",
                "valueAxis": "provinceAxis"
            }, {
                "balloonText": "ผู้สูงอายุในความดูแล [[value]] คน",
                "bullet": "round",
                "bulletBorderAlpha": 1,
                "useLineColorForBulletBorder": true,
                "bulletColor": "#FFFFFF",
                "dashLengthField": "dashLength",
                "labelPosition": "right",
                "legendValueText": "[[value]] คน",
                "title": "ผู้สูงอายุในความดูแล",
                "fillAlphas": 0,
                "valueField": "older",
                "valueAxis": "olderAxis"
            }],
            "chartCursor": {
                "categoryBalloonDateFormat": "DD",
                "cursorAlpha": 0.1,
                "cursorColor":"#000000",
                 "fullWidth":true,
                "valueBalloonsEnabled": false,
                "zoomable": false
            },
            "categoryField": "province",
            "export": {
              "enabled": true
             }
          });
        </script>
      </div>
    </div>
  </div>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
      <thead style="font-size: 15px;">
        <tr>
            <th style="width:2% !important;" class="text-center">#</th>
            <th style="width:12% !important;" class="text-center">เลขประจำตัว ปชช.</th>
            <th style="width:38% !important;" class="text-center">ชื่อตัว-ชื่อสกุล</th>
            <th style="width:7% !important;" class="text-center">อายุ (ปี)</th>
            <th style="width:10% !important;" class="text-center">วันที่ขึ้นทะเบียน</th>
            <th style="width:10% !important;" class="text-center">เบอร์โทรศัพท์ (มือถือ)</th>
            <th class="text-center">พื้นที่ดำเนินการ</th>
            <th style="width:1% !important;">&nbsp;</th>
        </tr>
			</thead>
      <tbody>
      <?php
      $number = 1;
      // dieArray($volt_info);
      foreach ($volt_info as $key => $value) {
        $pers = $this->personal_model->getOnce_PersonalInfo($value['pers_id']);
      ?>
        <tr>
          <td class="lnk text-center"><?php echo $number;?></td>
          <td class="lnk text-center"><?php echo $pers['pid'];?></td>
          <td class="lnk"><?php echo $pers['prename_th'].$pers['name'];?></td>
          <td class="lnk text-center">
            <?php
            $age = '';
            if($pers['date_of_birth']!='') {
              $date = new DateTime($pers['date_of_birth']);
              $now = new DateTime();
              $interval = $now->diff($date);
              $age = $interval->y;
              echo $age;
            }
            ?>
          </td>
          <td class="lnk text-center"><?php echo dateChange($value['date_of_reg'],5); ?></td>
          <td class="lnk text-center">
            <?php if($pers['tel_no_mobile'] != ''){
              echo $pers['tel_no_mobile'];
            }else{
              echo "-";
            } ?>
          </td>
          <td class="lnk text-center">
             <!-- พื้นที่ดำเนินการ-->
          </td>

          <td align="right">
            <?php
              $tmp = $this->admin_model->getOnce_Application(52);
              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(52,$user_id); //Check User Permission
            ?>
            <a <?php if(!isset($tmp1['perm_status'])) {?>
              readonly
            <?php }else{?> href="<?php echo site_url('volunteer/editor/edit/'.$value['volt_id']);?>" <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                <i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i>
            </a>

            <a data-toggle="modal" data-target="#prt<?php echo $pers['pid'];?>" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                <i class="fa fa-file-text" aria-hidden="true" style="color: #000"></i>
            </a>
            <!-- Print Modal -->
            <div class="modal fade" id="prt<?php echo $pers['pid'];?>" role="dialog">
              <div class="modal-dialog">

                 <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header text-left">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
                   </div>
                  <div class="modal-body">
                    <div class="row">
                      <?php
                      $tmp = $this->admin_model->getOnce_Application(147);
                      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(147,get_session('user_id')); //Check User Permission
                      ?>
                      <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                        <?php
                        if(!isset($tmp1['perm_status'])) { ?>
                            class="disabled"
                        <?php
                          }else if($usrpm['app_id']==147) {
                        ?>
                            class="active"
                        <?php
                          }
                        ?>
                         >
                        <a style="color: #333; font-size: 16px;" target="_blank" href="<?php echo site_url('report/F2/pdf?id='.$value['volt_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                        </a>
                      </div>

                     </div>
                     <br/>

                  </div>
                </div>

              </div>
            </div>
            <!-- End Print Modal -->

             <?php
              $tmp = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
              if(isset($tmp['perm_status'])) {
                  if($tmp['perm_status']=='Yes') {
             ?>
                  <a data-id=<?php echo @$value['volt_id'];?> onclick="opn(this)" title="ลบ" type="button" class="btn btn-default">
                    <span class="glyphicon glyphicon-trash" style="color: #000"></span>
                  </a>
              <?php }
              }
              ?>
          </td>
          <!-- Info Modal -->
          <div class="modal fade" id="<?php echo $pers['pid'];?>" role="dialog">

             <?php
                 $addr = $this->personal_model->getPersonalInfo($value['pers_id']);
                 // dieArray($addr);
             ?>

            <div class="modal-dialog modal-lg" style="text-align: left; ">
              <div class="modal-content">
               <div class="modal-header" style="background-color: rgb(56, 145, 209); color:white; ">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h3 class="modal-title text-left"><?php echo $pers['prename_th'].$pers['name'];?></h3>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-xs-12 col-sm-3">
                      <img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive">
                    </div>
                    <div class="col-xs-12 col-sm-9">
                      <div class="row">
                        <div class="col-xs-12 col-sm-3"><h4>เลขประจำตัวประชาชน</h4></div><div class="col-xs-12 col-sm-3"><?php echo $pers['pid'];?></div>
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-3"><h4>วันเดือนปีเกิด</h4></div><div class="col-xs-12 col-sm-6"><?php echo @$addr['date_of_birth']; ?></div>
                      </div>
                      <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>เพศ</h4> <?php echo @$value['gender_name']; ?></div>
                                    <div class="col-xs-12 col-sm-3"><h4>สัญชาติ</h4> <?php echo @$value['nation_name_th']; ?></div>
                                    <div class="col-xs-12 col-sm-3"><h4>ศาสนา</h4> <?php echo @$value['relg_title']; ?></div>
                      </div>
                      <div class="row">
                      &nbsp;
                      </div>
                      <div class="row">
                        <div class="col-xs-12 col-sm-3"><h4>ที่อยู่ตามทะเบียนบ้าน</h4></div><div class="col-xs-12 col-sm-5"><?php echo @$addr['reg_add_info']; ?></div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Info Modal -->
        </tr>
      <?php
        $number++;
      }
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

<!-- Search Modal -->
<div class="modal fade" id="mySearch" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" style="color: #333; font-size: 20px;">ค้นหา</h4>
       </div>

       <div class="modal-body">

          <label for="col1_filter">เลขประจำตัวประชาชน:</label>
          <input data-column="1" type="text" class="form-control column_filter" id="col1_filter">

          <label for="col2_filter">ชื่อตัว-ชื่อสกุล:</label>
          <input data-column="2" type="text" class="form-control column_filter" id="col2_filter">

          <label for="col4_filter">วันที่ขึ้นทะเบียน:</label>
          <input type="date" class="form-control date_filter">
          <input data-column="4" type="text" class="form-control column_filter" id="col4_filter">

      </div>

          <!-- /* fitter */ -->
         <script type="text/javascript">
            $('.date_filter').css('display','none');
            var date_set = '<?php echo (date("Y")+543)."-".date("m-d"); ?>';

                 $('.date_filter').next().focus(function(){
                    $(this).css('display','none');
                    $(this).prev().css('display','block');
                    $(this).prev().val(date_set);
                 });

                $('.date_filter').change(function(){
                      var val_date    = $(this).val();
                      if(val_date!=''){
                      var date_filter = val_date.split("-");
                      //var year_th = parseInt(date_filter[0])+543;
                      var date_th     = date_filter[2]+"/"+date_filter[1]+"/"+date_filter[0];
                      $(this).next().val(date_th);
                      }else{
                        $(this).next().val('');
                        $(this).next().css('display','block');
                        $(this).css('display','none');
                        $(this).val(date_set);
                      }
                });
         </script>
         <!-- END fitter -->

       <div class="modal-footer">
        <button id="filter" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-search" aria-hidden="true"></i> ตกลง</button>
       </div>
    </div>

  </div>
 </div>
 <!-- End Search Modal -->
