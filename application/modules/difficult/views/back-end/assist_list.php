
<!--<h3 style="color: #4e5f4d"><?php echo $title;?></h3>
<hr/>

   <div class="row">
	   <div class="col-xs-12 col-sm-12 text-right">	

          <?php
            $tmp = $this->admin_model->getOnce_Application(3); 
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
          ?>
          <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
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
   </div>-->

   <div id="tmp_menu" hidden='hidden'>
    <?php
      $tmp = $this->admin_model->getOnce_Application(3); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1');?>" 
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>"><i class="fa fa-plus" aria-hidden="true"></i> 
    </a>

    <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i class="fa fa-area-chart" aria-hidden="true"></i> </a>

    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch"><i class="fa fa-filter" aria-hidden="true"></i> </a>



    <?php
      $tmp = $this->admin_model->getOnce_Application(6); 
      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(6,$user_id); //Check User Permission
    ?>
    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
    <?php if(!isset($tmp1['perm_status'])) {?>
            readonly 
          <?php }else{?> href="<?php echo site_url('report/excel');?>" 
    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>

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
    // $("#showChart").click(function() {
    //   alert("CHART");
    //   $("#chart_display").toggle();
    // });
  </script>

  <div id="chart_display"  style="display: none;">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#chartTab-1" aria-expanded="true">ปริมาณการให้บริการสงเคาระห์ผู้สูงอายุในภาวะยากลำบาก</a></li>
            <li class=""><a data-toggle="tab" href="#chratTab-2" aria-expanded="false">งบประมาณที่ใช้ไปในการให้บริการสงเคราะห์ผู้สูงอายุในสภาวะยากลำบาก</a></li>
        </ul>
        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">
                <div class="panel-body row">
                  <!-- Resources -->
                  <script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
                  <script src="<?php echo base_url("assets/plugins/amcharts/pie.js")?>"></script>
                  <script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
                  <script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
                  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
                  <script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>
                  <div class="col-xs-12">
                    <h2 style="text-align: center;">ข้อมูล ณ วันที่ <?php echo dateChange(date("Y-m-d"),1); ?></h2>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <!-- Styles -->
                    <style>
                      #chartdiv {
                        width: 100%;
                        height: 500px;
                        /*min-height: 600px;*/
                      }               
                    </style>
                    <!-- HTML -->
                    <div id="chartdiv"></div>
                  </div>
                  <div class="col-xs-12 col-sm-6">
                    <?php $stat = $this->common_model->custom_query("
                      SELECT
                        YEAR (date_of_req) AS yyyy,
                        COUNT(date_of_req) AS count_req,
                        COUNT(date_of_visit) AS count_visit,
                        COUNT(date_of_pay) AS count_pay,
                        SUM(pay_amount) AS amount
                      FROM
                        diff_info
                      WHERE
                        delete_user_id IS NULL
                        AND YEAR (date_of_req) != '0000'
                      GROUP BY
                        YEAR (date_of_req)
                      ORDER BY
                        yyyy ASC
                      "); ?>
                    <table width="100%" border="1" style="text-align: center;font-size: 16px;">
                      <tr><td>&nbsp;</td><td colspan="5">ผลการดำเนินการ (ราย)</td></tr>
                      <tr>
                        <td>ปีงบประมาณ</td>
                        <td>รอการตรวจเยี่ยม (แจ้งเรื่อง)</td>
                        <td>รอรับการสงเคราะห์ (ตรวจเยี่ยมแล้ว)</td>
                        <td>ได้รับการสงเคราห์แล้ว</td>
                        <td>ไม่ผ่านคุณสมบัติ</td>
                        <td>รวม</td>
                      </tr>
                      <?php if(!empty($stat)){ ?>
                      <?php foreach ($stat as $key => $row) { ?>
                        <tr>
                          <td><?php echo $row['yyyy']+543; ?></td>
                          <td><?php echo $row['count_req'] - $row['count_visit'];?></td>
                          <td><?php echo $row['count_visit'] - $row['count_pay']; ?></td>
                          <td><?php echo $row['count_pay']; ?></td>
                          <td> - </td>
                          <td><?php echo $row['count_req']; ?></td>
                        </tr>
                      <?php 
                        $chartData[$row['yyyy']+543] = array(
                          array(
                            'sector'=>'รอการตรวจเยี่ยม '.($row['count_req'] - $row['count_visit']).' ราย',
                            'size'=>$row['count_req'] - $row['count_visit']
                          ),
                          array(
                            'sector'=>'รอรับการสงเคราะห์',
                            'size'=>$row['count_visit'] - $row['count_pay']
                          ),
                          array(
                            'sector'=>'ได้รับการสงเคราห์แล้ว',
                            'size'=>$row['count_pay']
                          ),
                          array(
                            'sector'=>'ไม่ผ่านคุณสมบัติ',
                            'size'=> 0
                          ),
                        );

                      }?>
                      <?php 
                      $st = $stat[0]['yyyy']+543;
                      $ed = end($stat);
                      $ed = $ed['yyyy']+543;
                      } ?>
                    </table>
                  </div>

                  <!-- Chart code -->
                  <script>
                    var chartData = <?php echo json_encode($chartData); ?>

                    /**
                     * Create the chart
                     */
                    var currentYear = <?php echo @$st; ?>;
                    var firstYear = <?php echo @$st; ?>;
                    var lastYear = <?php echo @$ed; ?>;

                    var chart = AmCharts.makeChart( "chartdiv", {
                      "type": "pie",
                      "theme": "light",
                      "dataProvider": [],
                      "valueField": "size",
                      "titleField": "sector",
                      "startDuration": 0,
                      "innerRadius": 80,
                      "pullOutRadius": 20,
                      // "marginTop": 20,
                      "fontSize":16,
                      "titles": [],
                      "balloon": {
                        'fontSize': 16
                      },
                      "allLabels": [{
                        "y": "50%",
                        "align": "center",
                        "size": 28,
                        // "bold": true,
                        // "text": "1995",
                        "color": "#555"
                      }, {
                        "y": "45%",
                        "align": "center",
                        "size": 24,
                        "text": "ปีงบประมาณ",
                        "color": "#555"
                      }],
                      "listeners": [ {
                        "event": "init",
                        "method": function( e ) {
                          var chart = e.chart;

                          function getCurrentData() {
                            var data = chartData[currentYear];
                            currentYear++;
                            if (currentYear > lastYear)
                              currentYear = firstYear;
                            return data;
                          }

                          function loop() {
                            chart.allLabels[0].text = currentYear;
                            var data = getCurrentData();
                            chart.animateData( data, {
                              duration: 700,
                              complete: function() {
                                setTimeout( loop, 5000 );
                              }
                            } );
                          }

                          loop();
                        }
                      } ],
                       "export": {
                       "enabled": true
                      }
                    } );
                  </script>
                </div>
            </div>
            <div id="chratTab-2" class="tab-pane">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <h2 style="text-align: center;">ข้อมูล ณ วันที่ <?php echo dateChange(date("Y-m-d"),1); ?></h2>
                  </div>
                  <div class="col-xs-12 col-sm-8">
                    <!-- Styles -->
                    <style>
                      #chartdiv2 {
                        width : 100%;
                        height  : 500px;
                      }
                                        
                    </style>
                    <!-- HTML -->
                    <div id="chartdiv2"></div>
                  </div>
                  <div class="col-xs-12 col-sm-4">
                    <?php $stat2 = $this->common_model->custom_query("
                      SELECT
                        date_of_req,
                        SUM(pay_amount) AS amount
                      FROM
                        diff_info
                      WHERE
                        (pay_amount != ''
                      OR pay_amount IS NOT NULL)
                      AND delete_user_id IS NULL
                      GROUP BY
                        date_of_req
                      "); 
                    ?>
                    <table width="100%" border="1" style="text-align: center;font-size: 16px;">
                      <tr>
                        <td rowspan="2">ปีงบประมาณ</td>
                        <td colspan="2">ปริมาณการให้บริการ (ราย)</td>
                        <td rowspan="2">งบประมานที่ใช้ไป (บาท)</td>
                      </tr>
                      <tr>
                        <td>รอรับการสงเคราะห์</td>
                        <td>ได้รับการสงเคราะห์</td>
                      </tr>
                      <?php if(!empty($stat)){ ?>
                        <?php foreach ($stat as $key => $row) { ?>
                          <tr>
                            <td><?php echo $row['yyyy']+543; ?></td>
                            <td><?php echo $row['count_req'] - $row['count_visit'];?></td>
                            <td><?php echo $row['count_pay']; ?></td>
                            <td><?php echo number_format($row['amount'],2); ?></td>
                          </tr>
                        <?php 
                          
                          }
                        foreach ($stat2 as $key => $value) {
                          $arr=explode('-',$value['date_of_req']);
                          $chartData2[] = array(
                            'date'=> ($arr[0]+543).'-'.$arr[1].'-'.$arr[2],
                            'value'=>$value['amount']
                          );
                        }
                        } ?>
                    </table>
                  </div>
                  <!-- Resources -->
                    <script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
                    <!-- <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
                    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
                    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
                    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
                    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script> -->

                    <!-- Chart code -->
                    <script>
                      var chart = AmCharts.makeChart("chartdiv2", {
                        "type": "serial",
                        "theme": "light",
                        "marginRight": 40,
                        "marginLeft": 40,
                        "autoMarginOffset": 20,
                        "mouseWheelZoomEnabled":true,
                        "dataDateFormat": "YYYY-MM-DD",
                        "valueAxes": [{
                            "id": "v1",
                            "axisAlpha": 0,
                            "position": "left",
                            "ignoreAxisWidth":true
                        }],
                        "balloon": {
                            "borderThickness": 1,
                            "shadowAlpha": 0
                        },
                        "graphs": [{
                            "id": "g1",
                            "balloon":{
                              "drop":true,
                              "adjustBorderColor":false,
                              "color":"#ffffff"
                            },
                            "bullet": "round",
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "bulletSize": 5,
                            "hideBulletsCount": 50,
                            "lineThickness": 2,
                            "title": "red line",
                            "useLineColorForBulletBorder": true,
                            "valueField": "value",
                            "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                        }],
                        "chartScrollbar": {
                            "graph": "g1",
                            "oppositeAxis":false,
                            "offset":30,
                            "scrollbarHeight": 80,
                            "backgroundAlpha": 0,
                            "selectedBackgroundAlpha": 0.1,
                            "selectedBackgroundColor": "#888888",
                            "graphFillAlpha": 0,
                            "graphLineAlpha": 0.5,
                            "selectedGraphFillAlpha": 0,
                            "selectedGraphLineAlpha": 1,
                            "autoGridCount":true,
                            "color":"#AAAAAA"
                        },
                        "chartCursor": {
                            "pan": true,
                            "valueLineEnabled": true,
                            "valueLineBalloonEnabled": true,
                            "cursorAlpha":1,
                            "cursorColor":"#258cbb",
                            "limitToGraph":"g1",
                            "valueLineAlpha":0.2,
                            "valueZoomable":true
                        },
                        "valueScrollbar":{
                          "oppositeAxis":false,
                          "offset":50,
                          "scrollbarHeight":10
                        },
                        "categoryField": "date",
                        "categoryAxis": {
                            "parseDates": true,
                            "dashLength": 1,
                            "minorGridEnabled": true
                        },
                        "export": {
                            "enabled": true
                        },
                        "dataProvider": <?php echo json_encode($chartData2); ?>
                      });

                      chart.addListener("rendered", zoomChart);

                      zoomChart();

                      function zoomChart() {
                          chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
                      }
                    </script>
                </div>
            </div>
        </div>
    </div>
  </div>
  
  <div class="table-responsive">
    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important;">
      <thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
        <tr>
            <th style="width: 5%; text-align: center;">#</th>
            <th style="width: 15%; text-align: center;">เลขประจำตัวประชาชน</th>
            <th style="width: 38%; text-align: center;">ชื่อตัว-ชื่อสกุล</th>
            <th style="width: 7%; text-align: center;">อายุ (ปี)</th>
            <th style="width: 10%; text-align: center;">แจ้งเรื่อง</th>
            <th style="width: 10%; text-align: center;">ตรวจเยี่ยม</th>
            <th style="width: 10%; text-align: center;">การช่วยเหลือ</th>
            <th style="width: 5%; text-align: center;">&nbsp;</th>
        </tr>
			</thead>
      <tbody>
      <?php
      $number = 1;
      foreach ($diff_info as $key => $value) {
      ?>
                <tr>
                    <td class="lnk" align="center"><?php echo $number;?></td>
                    <td class="lnk"><?php echo $value['pid'];?></td>
                    <td class="lnk"><?php echo $value['prename_th'].$value['name'];?></td>
                    <td class="lnk" align="center">
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
                    <td class="lnk" align="center"> 
                      <?php if($value['date_of_req']!='' && $value['date_of_req']!='0000-00-00') { ?>
                        <font class="text-sucsess" color="green"><?php echo dateChange($value['date_of_req'],5);?></font>
                      <?php } ?>                     
                    </td>
                    <td class="lnk" align="center">
                      <?php if($value['date_of_visit']!='' && $value['date_of_visit']!='0000-00-00') { ?>
                        <font class="text-sucsess" color="green"><?php echo dateChange($value['date_of_visit'],5);?></font>
                      <?php }else{ ?>
                         <!-- <font class="text-sucsess" color="#B9B9B9">ยังไม่ได้รับการตรวจเยี่ยม</font> -->
                         <font class="text-sucsess" color="#B9B9B9"> - </font>
                      <?php } ?>
                    </td>
                    <td class="lnk" align="center">
                      <?php if($value['date_of_pay']!='' && $value['date_of_pay']!='0000-00-00') { ?>
                        <font class="text-sucsess" color="green"><?php echo dateChange($value['date_of_pay'],5);?></font>
                      <?php }else{ ?>
                         <!-- <font class="text-sucsess" color="#B9B9B9">ยังไม่ได้รับการช่วยเหลือ</font> -->
                         <font class="text-sucsess" color="#B9B9B9"> - </font>
                      <?php } ?>
                    </td>
                    <td align="right" nowrap="nowrap">
                    <!-- <div class="btn-group"> -->
    
                  <?php
                    $tmp = $this->admin_model->getOnce_Application(3); 
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                  ?>
                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                    readonly 
                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1/Edit/'.$value['diff_id']);?>" <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
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
                            $tmp = $this->admin_model->getOnce_Application(7);   
                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(7,get_session('user_id')); //Check User Permission
                            ?>      
                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;" 
                            <?php
                            if(!isset($tmp1['perm_status'])) { ?>
                                class="disabled" 
                            <?php 
                              }else if($usrpm['app_id']==7) {
                            ?>
                                class="active"
                            <?php
                              }
                            ?>
                             >
                              <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1?id='.$value['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                              </a>
                            </div>

                            <?php
                            $tmp = $this->admin_model->getOnce_Application(8);   
                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(8,get_session('user_id')); //Check User Permission
                            ?>      
                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;" 
                            <?php
                            if(!isset($tmp1['perm_status'])) { ?>
                                class="disabled" 
                            <?php 
                              }else if($usrpm['app_id']==8) {
                            ?>
                                class="active"
                            <?php
                              }
                            ?>
                             >
                              <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2?id='.$value['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                              </a>
                            </div>

                            <?php
                            $tmp = $this->admin_model->getOnce_Application(9);   
                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(9,get_session('user_id')); //Check User Permission
                            ?>      
                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;" 
                            <?php
                            if(!isset($tmp1['perm_status'])) { ?>
                                class="disabled" 
                            <?php 
                              }else if($usrpm['app_id']==9) {
                            ?>
                                class="active"
                            <?php
                              }
                            ?>
                             >
                              <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3?id='.$value['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                              </a>
                            </div>

                            <?php
                            $tmp = $this->admin_model->getOnce_Application(10);   
                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(10,get_session('user_id')); //Check User Permission
                            ?>      
                            <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;" 
                            <?php
                            if(!isset($tmp1['perm_status'])) { ?>
                                class="disabled" 
                            <?php 
                              }else if($usrpm['app_id']==10) {
                            ?>
                                class="active"
                            <?php
                              }
                            ?>
                             >
                              <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4?id='.$value['diff_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
                        <a data-id=<?php echo $value['diff_id'];?> onclick="opn(this)" title="ลบ" type="button" class="btn btn-default">
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
                           <div class="modal-header" style="background-color: rgb(56, 145, 209); color:white;">
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
                      <!-- </div> -->

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

        <label for="col4_filter">วันที่แจ้งเรื่อง:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="4" type="text" class="form-control column_filter" id="col4_filter">

        <label for="col5_filter">วันที่ตรวจเยี่ยม:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="5" type="text" class="form-control column_filter" id="col5_filter">

        <label for="col6_filter">วันที่ช่วยเหลือ:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="6" type="text" class="form-control column_filter" id="col6_filter">
         
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
