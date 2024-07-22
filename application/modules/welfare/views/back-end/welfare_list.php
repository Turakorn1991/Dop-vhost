     <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(13); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('welfare/inform1');?>" 
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i class="fa fa-plus" aria-hidden="true"></i> 
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i class="fa fa-area-chart" aria-hidden="true"></i> </a>


    <a title="ค้นหา" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
    <i class="fa fa-filter" aria-hidden="true"></i> </a>

    <?php
      $tmp = $this->admin_model->getOnce_Application(16); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(16,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('report/B0/xls');?>" 
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
    <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

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
    <div class="row">
      <div class="col-xs-12">
        <h2 style="text-align: center;">ปริมาณผู้สูงอายุในศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ</h2>
        <h2 style="text-align: center;">ข้อมูล ณ วันที่ <?php echo dateChange(date("Y-m-d"),1); ?></h2>
      </div>
      <div class="col-xs-12 col-sm-6">
        <!-- Styles -->
        <style>
        #chartdiv {
          width: 100%;
          height: 500px;
        }                       
        </style>

        <!-- Resources -->
        <script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
        <script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
        <script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
        <script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
        <link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
        <script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>

        <!-- Chart code -->
        <script>
        var chart = AmCharts.makeChart( "chartdiv", {
          "type": "serial",
          "theme": "light",
          "depth3D": 20,
          "angle": 30,
          'fontSize': 16,
          "legend": {
            "horizontalGap": 10,
            "useGraphSettings": true,
            "markerSize": 10
          },
          "dataProvider": [ {
            "year": 2003,
            "europe": 2.5,
            "namerica": 2.5,
            "asia": 2.1,
            "lamerica": 1.2,
            "meast": 0.2,
            "africa": 0.1
          }, {
            "year": 2004,
            "europe": 2.6,
            "namerica": 2.7,
            "asia": 2.2,
            "lamerica": 1.3,
            "meast": 0.3,
            "africa": 0.1
          }, {
            "year": 2005,
            "europe": 2.8,
            "namerica": 2.9,
            "asia": 2.4,
            "lamerica": 1.4,
            "meast": 0.3,
            "africa": 0.1
          } ],
          "valueAxes": [ {
            "stackType": "regular",
            "axisAlpha": 0,
            "gridAlpha": 0
          } ],
          "graphs": [ {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Europe",
            "type": "column",
            "color": "#000000",
            "valueField": "europe"
          }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "North America",
            "type": "column",
            "color": "#000000",
            "valueField": "namerica"
          }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Asia-Pacific",
            "type": "column",
            "newStack": true,
            "color": "#000000",
            "valueField": "asia"
          }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Latin America",
            "type": "column",
            "color": "#000000",
            "valueField": "lamerica"
          }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Middle-East",
            "type": "column",
            "color": "#000000",
            "valueField": "meast"
          }, {
            "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
            "fillAlphas": 0.8,
            "labelText": "[[value]]",
            "lineAlpha": 0.3,
            "title": "Africa",
            "type": "column",
            "color": "#000000",
            "valueField": "africa"
          } ],
          "categoryField": "year",
          "categoryAxis": {
            "gridPosition": "start",
            "axisAlpha": 0,
            "gridAlpha": 0,
            "position": "left"
          },
          "export": {
            "enabled": true
          }

        } );
        </script>

        <!-- HTML -->
        <div id="chartdiv"></div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <table width="100%" border="1" style="text-align: center;font-size: 16px;">
          <tr style="background-color: #4b96d6; color: white" >
            <td rowspan="3">ปีงบประมาณ</td>
            <td colspan="7">ปริมาณการให้บริการ (ราย)</td>
          </tr>
          <tr style="background-color: #4b96d6; color: white">
            <td rowspan="2">แจ้งความประสงค์</td>
            <td colspan="5">รับเข้า</td>
            <td rowspan="2">จำหน่าย</td>
          </tr>
          <tr style="background-color: #67a3d6; color: white">
            <td>กลุ่ม a</td>
            <td>กลุ่ม b</td>
            <td>กลุ่ม c</td>
            <td>ไม่ได้ประเมิน</td>
            <td>รวม</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr><tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr><tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr><tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr><tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
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
            <th class="text-center">แจ้งความประสงค์</th>
            <th style="width:10% !important;" class="text-center">รับเข้า (วัน)</th>
            <th style="width:10% !important;" class="text-center">จำหน่าย</th>
            <th style="width:10% !important;" class="text-center">ประเมิน (ล่าสุด)</th>
            <th style="width:1% !important;">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $number = 1;
      foreach ($welfare_info as $key => $row) {
        $value = $this->personal_model->getOnce_PersonalInfo($row['pers_id']);
      ?>
                <tr>
                    <td class="lnk text-center"><?php echo $number;?></td>
                    <td class="lnk text-center"><?php echo $value['pid'];?></td>
                    <td class="lnk"><?php echo $value['prename_th'].$value['name'];?></td>
                    <td class="lnk text-center">
                    <?php
                    $age = '';
                    if($value['date_of_birth']!='') {
                      $date = new DateTime($value['date_of_birth']);
                      $now = new DateTime();
                      $interval = $now->diff($date);
                      $age = $interval->y;
                      echo $age;
                    }
                    ?>
                    </td>
                    <td class="lnk text-center">
                      <?php if($row['date_of_req']!='') { ?>
                        <font class="text-sucsess" color="green"><b><?php echo dateChange($row['date_of_req'],5);?></b></font>
                      <?php } ?>
                    </td>
                    <td class="lnk text-center">
                      <?php if($row['date_of_adm']!='' && $row['date_of_adm'] != '0000-00-00') { ?>
                        <font class="text-sucsess" color="green"><b><?php echo dateChange($row['date_of_adm'],5);?></b></font>
                        <?php 
                        $date = new DateTime($row['date_of_adm']);
                        if($row['date_of_dis']!='' && $row['date_of_dis'] != '0000-00-00'){
                          $now = new DateTime($row['date_of_dis']);
                        }else{
                          $now = new DateTime();
                        }
                        $interval = $now->diff($date);
                        $days = $interval->days;
                        echo " ({$days} วัน) ";
                        ?>
                      <?php }else{ ?>
                        <font class="text-sucsess" color="#B9B9B9"><b> - </b></font>
                      <?php } ?>
                    </td>
                    <td class="lnk text-center">
                      <?php if($row['date_of_dis']!='' && $row['date_of_dis'] != '0000-00-00') { ?>
                        <font class="text-sucsess" color="#FF5E2C"><b><?php echo dateChange($row['date_of_dis'],5);?></b></font>
                      <?php }else{ ?>
                        <font class="text-sucsess" color="#B9B9B9"><b> - </b></font>
                      <?php } ?>
                    </td>
                    <td class="lnk text-center">
                      <?php 
                      $tmp_irp = rowArray($this->welfare_model->getAll_admIrp($row['pers_id']));
                      if(!empty($tmp_irp)){
                        if($tmp_irp['date_of_irp']!='') { ?>
                          <font class="text-sucsess" color="green"><b><?php echo dateChange($tmp_irp['date_of_irp'],5);?></b></font>
                        <?php }else{ ?>
                          <font class="text-sucsess" color="#B9B9B9"><b> - </b></font>
                        <?php } ?>
                      <?php }else{ ?>
                          <font class="text-sucsess" color="#B9B9B9"><b> - </b></font>
                      <?php } ?>
                    </td>
                    <td align="right">

                  <?php
                    $tmp = $this->admin_model->getOnce_Application(13);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
                  ?>
                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                    readonly
                  <?php }else{?> href="<?php echo site_url('welfare/inform1/Edit/'.$row['adm_id']);?>" <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                      <i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i>
                  </a>

                  <a data-toggle="modal" data-target="#prt<?php echo $value['pid'];?>" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                      <i class="fa fa-file-text" aria-hidden="true" style="color: #000"></i>
                  </a>
                  <!-- Print Modal -->
                  
                  <div class="modal fade" id="prt<?php echo $value['pid'];?>" role="dialog">
                    <div class="modal-dialog">

                       <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header text-left">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title" style="color: #333; font-size: 20px;">พิมพ์แบบฟอร์ม</h4>
                         </div>
                        <div class="modal-body">
                          <div class="row">
                            <?php
                            $tmp = $this->admin_model->getOnce_Application(17);
                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(17,get_session('user_id')); //Check User Permission
                            ?>
                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                            <?php if(!isset($tmp1['perm_status'])) { ?>
                                class="disabled"
                            <?php }else if($usrpm['app_id']==17) { ?>
                                class="active"
                            <?php } ?>
                             >
                              <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/B1/pdf?id='.$row['adm_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                              </a>
                            </div>

                            <?php
                            $tmp = $this->admin_model->getOnce_Application(18);
                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(18,get_session('user_id')); //Check User Permission
                            ?>
                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                            <?php if(!isset($tmp1['perm_status'])) { ?>
                                class="disabled"
                            <?php }else if($usrpm['app_id']==18) { ?>
                                class="active"
                            <?php } ?>
                             >
                              <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/B2/pdf?id='.$row['adm_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                              </a>
                            </div>

                            <?php
                            $tmp = $this->admin_model->getOnce_Application(19);
                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(19,get_session('user_id')); //Check User Permission
                            ?>
                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                            <?php if(!isset($tmp1['perm_status'])) { ?>
                                class="disabled"
                            <?php }else if($usrpm['app_id']==19) { ?>
                                class="active"
                            <?php } ?>
                             >
                              <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/B3/pdf?id='.$row['adm_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
                    $tmp = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
                    if(isset($tmp['perm_status'])) {
                        if($tmp['perm_status']=='Yes') {
                   ?>
                        <a data-id=<?php echo $row['adm_id'];?> onclick="opn(this)" title="ลบ" type="button" class="btn btn-default">
                          <span class="glyphicon glyphicon-trash" style="color: #000"></span>
                        </a>
                    <?php }
                    }
                    ?>

                      <!-- Info Modal -->
                      <div class="modal fade" id="<?php echo $value['pid'];?>" role="dialog">

                       <?php 
                        $addr = $this->personal_model->getPersonalInfo($value['pers_id']); 
                         // dieArray($addr);

                        ?>

                        <div class="modal-dialog modal-lg" style="text-align: left; ">
                          <div class="modal-content">
                           <div class="modal-header" style="background-color: rgb(56, 145, 209); color:white; ">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3 class="modal-title text-left"><?php echo $value['prename_th'].$value['name'];?></h3>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-xs-12 col-sm-3">
                                  <img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive">
                                </div>
                                <div class="col-xs-12 col-sm-9">
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>เลขประจำตัวประชาชน</h4></div><div class="col-xs-12 col-sm-3"><?php echo $value['pid'];?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>วันเดือนปีเกิด</h4></div><div class="col-xs-12 col-sm-6"><?php echo @$addr['date_of_birth']; ?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>เพศ</h4> <?php echo @$value['gender_name']; ?></div>
                                    <div class="col-xs-12 col-sm-3"><h4>สัญชาติ</h4> <?php echo @$value['nation_name_th']; ?></div>
                                    <div class="col-xs-12 col-sm-3"><h4>ศาสนา</h4> <?php echo $value['relg_title']; ?></div>
                                  </div>
                                  <div class="row">
                                  &nbsp;
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>ที่อยู่ตามทะเบียนบ้าน</h4></div><div class="col-xs-12 col-sm-5"><?php echo @$addr['reg_add_info']; ?></div>
                                  </div><br>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>ผลการประเมิน (ล่าสุด) </h4></div>
                                    <div class="col-xs-12 col-sm-6"><div style="width:100%; background-color:green; color:#fff;">100%</div><div>(44 จาก 55 คะแนน)</div></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Info Modal -->

                    </td>
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

        <label for="col4_filter">วันที่แจ้งความประสงค์:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="4" type="text" class="form-control column_filter" id="col4_filter">

        <label for="col5_filter">วันที่รับเข้า:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="5" type="text" class="form-control column_filter" id="col5_filter">

        <label for="col6_filter">วันที่จำหน่าย:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="6" type="text" class="form-control column_filter" id="col6_filter">

        <label for="col7_filter">วันที่ประเมิน (ล่าสุด):</label>
        <input type="date" class="form-control date_filter">
        <input data-column="7" type="text" class="form-control column_filter" id="col7_filter">
        

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

        
      </div>
       <div class="modal-footer">
        <button id="filter" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-search" aria-hidden="true"></i> ตกลง</button> 
       </div>
    </div>

  </div>
 </div>
 <!-- End Search Modal -->
