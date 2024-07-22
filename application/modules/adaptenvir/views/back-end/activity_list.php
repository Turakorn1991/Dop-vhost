
                           <div id="tmp_menu" hidden='hidden'>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(37); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                              ?>
                              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                              <?php if(!isset($tmp1['perm_status'])) {?>
                                      readonly 
                                    <?php }else{?> href="<?php echo site_url('adaptenvir/ac_inquire1');?>" 
                              <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                              <i class="fa fa-plus" aria-hidden="true"></i> 
                              </a>

                              <a id="showChart" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 17px 2px 17px;" href="javascript:showChart();"><i class="fa fa-area-chart" aria-hidden="true"></i> </a>

                              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
                              <i class="fa fa-filter" aria-hidden="true"></i> </a>

                              <?php
                                $tmp = $this->admin_model->getOnce_Application(40); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(40,$user_id); //Check User Permission
                              ?>
                              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" 
                              <?php if(!isset($tmp1['perm_status'])) {?>
                                      readonly 
                                    <?php }else{?> href="<?php echo site_url('report/D6/xls');?>" 
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
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#chartTab-1" aria-expanded="true">ปริมาณการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ (ปรับปรุงสถานที่จัดกิจกรรมของผู้สูงอายุ)</a></li>
                                    <li class=""><a data-toggle="tab" href="#chratTab-2" aria-expanded="false">งบประมาณที่ใช้ไปในการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ (ปรับปรุงสถานที่จัดกิจกรรมของผู้สูงอายุ)</a></li>
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
                            <?php 
                              $tmp_query = $this->common_model->custom_query("
                                SELECT DISTINCT YEAR(date_of_finish) AS yyyy 
                                FROM impv_place_info 
                                WHERE delete_user_id IS NULL
                                AND date_of_finish != '0000-00-00'
                                ORDER BY yyyy ASC
                              ");
                              ?>
                            <table width="100%" border="1" style="text-align: center;font-size: 16px;">
                              <tr style="background-color: #4b96d6; color: white" >
                                <td rowspan="2">ปีงบประมาณ</td>
                                <td colspan="4">ผลการดำเนินงาน (ราย)</td>
                              </tr>
                              <tr style="background-color: #67a3d6; color: white">
                                <td>รอการพิจราณา</td>
                                <td>ได้รับอนุมัติ</td>
                                <td>ไม่ได้รับอนุมัติ</td>
                                <td>รวม</td>
                              </tr>
                              <?php if(!empty($tmp_query) && @$tmp_query[0]['yyyy']){ ?>
                              <?php foreach ($tmp_query as $key => $row) {
                                $wait = rowArray($this->common_model->custom_query("
                                  SELECT
                                    COUNT(date_of_svy) AS count_wait
                                  FROM
                                    impv_place_info
                                  WHERE
                                    date_of_consi IS NULL
                                  AND delete_user_id IS NULL
                                  AND YEAR(date_of_svy) = {$row['yyyy']}
                                "));

                                $allow = rowArray($this->common_model->custom_query("
                                  SELECT
                                    COUNT(date_of_finish) AS count_allow
                                  FROM
                                    impv_place_info
                                  WHERE
                                  --   consi_result = 'อนุมัติ'
                                  -- AND delete_user_id IS NULL
                                   delete_user_id IS NULL
                                  AND YEAR(date_of_finish) = {$row['yyyy']}
                                "));

                                $notallow = rowArray($this->common_model->custom_query("
                                  SELECT
                                    COUNT(date_of_finish) AS count_notallow
                                  FROM
                                    impv_place_info
                                  WHERE
                                    consi_result = 'ไม่อนุมัติ'
                                  AND delete_user_id IS NULL
                                  AND YEAR(date_of_finish) = {$row['yyyy']}
                                "));

                                ?>
                                <tr>
                                  <td><?php echo $row['yyyy']+543; ?></td>
                                  <td><?php echo $wait['count_wait']; ?></td>
                                  <td><?php echo $allow['count_allow']; ?></td>
                                  <td><?php echo $notallow['count_notallow']; ?></td>
                                  <td><?php echo $wait['count_wait'] + $allow['count_allow'] + $notallow['count_notallow']; ?></td>
                                </tr>
                              <?php 
                                $chartData[$row['yyyy']+543] = array(
                                  array(
                                    'sector'=>'รอการพิจราณา',
                                    'size'=>$wait['count_wait']
                                  ),
                                  array(
                                    'sector'=>'ได้รับอนุมัติ',
                                    'size'=>$allow['count_allow']
                                  ),
                                  array(
                                    'sector'=>'ไม่ได้รับอนุมัติ',
                                    'size'=>$notallow['count_notallow']
                                  ),

                                );

                              }?>
                              <?php 
                              $st = $tmp_query[0]['yyyy']+543;
                              $ed = end($tmp_query);
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
                            <table width="100%" border="1" style="text-align: center;font-size: 16px;">
                              <tr style="background-color: #4b96d6; color: white" >
                                <td rowspan="2">ปีงบประมาณ</td>
                                <td colspan="2">ปริมาณการให้บริการ (ราย)</td>
                                <td rowspan="2">งบประมานที่ใช้ไป (บาท)</td>
                              </tr>
                              <tr style="background-color: #67a3d6; color: white">
                                <td>รอรับการสงเคราะห์</td>
                                <td>ได้รับการสงเคราะห์</td>
                              </tr>
                              <?php if(!empty($tmp_query) && @$tmp_query[0]['yyyy']){ ?>
                                <?php foreach ($tmp_query as $key => $row) { ?>
                                  <?php 
                                    $wait = rowArray($this->common_model->custom_query("
                                      SELECT
                                        COUNT(date_of_svy) AS count_wait
                                      FROM
                                        impv_place_info
                                      WHERE
                                       date_of_consi IS NULL
                                      AND delete_user_id IS NULL
                                      AND YEAR(date_of_svy) = {$row['yyyy']}
                                    "));
                                    $pay = rowArray($this->common_model->custom_query("
                                      SELECT
                                        COUNT(date_of_finish) AS count_pay,
                                        SUM(case_budget) AS amount
                                      FROM
                                        impv_place_info
                                      WHERE
                                          -- consi_result = 'อนุมัติ'
                                      -- AND delete_user_id IS NULL
                                        delete_user_id IS NULL
                                      AND YEAR(date_of_finish) = {$row['yyyy']}
                                    "));
                                  ?>
                                  <tr>
                                    <td><?php echo $row['yyyy']+543; ?></td>
                                    <td><?php echo $wait['count_wait'];?></td>
                                    <td><?php echo $pay['count_pay']; ?></td>
                                    <td><?php echo number_format($pay['amount'],2); ?></td>
                                  </tr>
                                <?php 
                                  
                                  }
                                $stat2 = $this->common_model->custom_query("
                                  SELECT
                                  date_of_finish,
                                  SUM(case_budget) AS amount
                                FROM
                                  impv_place_info
                                WHERE
                                  -- consi_result = 'อนุมัติ'
                                -- AND delete_user_id IS NULL
                                  delete_user_id IS NULL
                                  AND date_of_finish != '0000-00-00'
                                GROUP BY
                                  date_of_finish");
                                foreach ($stat2 as $key => $value) {
                                  $arr=explode('-',$value['date_of_finish']);
                                  $chartData2[] = array(
                                    'date'=> ($arr[0]+543).'-'.$arr[1].'-'.$arr[2],
                                    'value'=> round($value['amount'],2),
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

                          <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;">
                            <thead style="font-size: 15px;">
                                  <tr>
                                      <th style="width:2% !important;" class="text-center">ลำดับ</th>
                                      <th style="width:38% !important;" class="text-center">ชื่อสถานที่จัดกิจกรรมของผู้สูงอายุ</th>
                                      <!-- <th class="text-center">ที่อยู่</th> -->
                                      <th style="width:10% !important;" class="text-center">วันที่ได้รับการสำรวจ</th>
                                      <th class="text-center">ผลการพิจารณา</th>
                                      <th style="width:10% !important;" class="text-center">วันที่เสร็จสิ้น</th>
                                      <th style="width:10% !important;" class="text-center">งบประมาณที่ใช้ไป (บาท)</th>
                                      <th style="width:1% !important;">&nbsp;</th>
                                  </tr>
                            </thead>
                            <tbody>
                            <?php
                            $number = 1;
                            foreach ($impv_place_info as $key => $value) {
                            ?>
                                      <tr>
                                          <td class="lnk text-center"><?php echo $number;?></td>
                                          <td class="lnk"><?php if($value['ptype_code'] == '' || $value['ptype_code'] == '009'){ echo $value['ptype_code_remark'];}else{ echo $value['ptype_title'];}?></td>
                                          <!-- <td class="lnk"></td> -->
                                          <td class="lnk text-center">
                                            <?php
                                              if($value['date_of_svy']!='') {
                                            ?>
                                              <font class="text-sucsess" color="green"><b><?php echo dateChange($value['date_of_svy'],5);?></b></font>
                                            <?php
                                              }
                                            ?>
                                          </td>
                                          <td class="lnk text-center">
                                            <?php
                                              if($value['date_of_consi']!='') {
                                            ?>
                                              <font class="text-sucsess" color="green"><b><?php echo dateChange($value['date_of_consi'],5);?></b></font>
                                            <?php
                                              }
                                            ?>
                                          </td>
                                          <td class="lnk text-center">
                                            <?php
                                              if($value['date_of_finish']!='') {
                                            ?>
                                              <font class="text-sucsess" color="green"><b><?php echo dateChange($value['date_of_finish'],5);?></b></font>
                                            <?php
                                              }
                                            ?>
                                          </td>
                                          <td class="lnk" align="right"><?php echo number_format($value['case_budget'],2); ?></td>

                                          <td align="right">

                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(37);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                                        ?>
                                        <a <?php if(!isset($tmp1['perm_status'])) {?>
                                          readonly
                                        <?php }else{?> href="<?php echo site_url('adaptenvir/ac_inquire1/Edit/'.@$value['impv_place_id']);?>" <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                                            <i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i>
                                        </a>

                                        <a data-toggle="modal" data-target="#prt<?php echo $value['impv_place_id'];?>" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                            <i class="fa fa-file-text" aria-hidden="true" style="color: #000"></i>
                                        </a>
                                        <!-- Print Modal -->
                                        <div class="modal fade" id="prt<?php echo $value['impv_place_id'];?>" role="dialog">
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
                                                  $tmp = $this->admin_model->getOnce_Application(41);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(41,get_session('user_id')); //Check User Permission
                                                  ?>
                                                  <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                  <?php
                                                  if(!isset($tmp1['perm_status'])) { ?>
                                                      class="disabled"
                                                  <?php
                                                    }else if($usrpm['app_id']==41) {
                                                  ?>
                                                      class="active"
                                                  <?php
                                                    }
                                                  ?>
                                                   >
                                                    <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/D3/pdf?id='.$value['impv_place_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                                                    </a>
                                                  </div>

                                                  <?php
                                                  $tmp = $this->admin_model->getOnce_Application(42);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(42,get_session('user_id')); //Check User Permission
                                                  ?>
                                                  <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                  <?php
                                                  if(!isset($tmp1['perm_status'])) { ?>
                                                      class="disabled"
                                                  <?php
                                                    }else if($usrpm['app_id']==42) {
                                                  ?>
                                                      class="active"
                                                  <?php
                                                    }
                                                  ?>
                                                   >
                                                    <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/D4/pdf?id='.$value['impv_place_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                                                    </a>
                                                  </div>

                                                  <?php
                                                  $tmp = $this->admin_model->getOnce_Application(43);
                                                  $tmp1 = $this->admin_model->chkOnce_usrmPermiss(43,get_session('user_id')); //Check User Permission
                                                  ?>
                                                  <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                  <?php
                                                  if(!isset($tmp1['perm_status'])) { ?>
                                                      class="disabled"
                                                  <?php
                                                    }else if($usrpm['app_id']==43) {
                                                  ?>
                                                      class="active"
                                                  <?php
                                                    }
                                                  ?>
                                                   >
                                                    <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/D5/pdf?id='.$value['impv_place_id']);?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
                                          $tmp = $this->admin_model->chkOnce_usrmPermiss(37,$user_id); //Check User Permission
                                          if(isset($tmp['perm_status'])) {
                                              if($tmp['perm_status']=='Yes') {
                                         ?>
                                              <a data-id=<?php echo @$value['impv_place_id'];?> onclick="opn(this)" title="ลบ" type="button" class="btn btn-default">
                                                <span class="glyphicon glyphicon-trash" style="color: #000"></span>
                                              </a>
                                          <?php }
                                          }
                                          ?>

                                            <!-- Info Modal -->
                                            <div class="modal fade" id="<?php echo $value['impv_place_id'];?>" role="dialog">
                                              <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                 <div class="modal-header" style="background-color: #eee">
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
                                                          <div class="col-xs-12 col-sm-3"><h4>เลขประจำตัวประชาชน</h4></div><div class="col-xs-12 col-sm-3"><?php echo $value['impv_place_id'];?></div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-xs-12 col-sm-3"><h4>วันเดือนปีเกิด</h4></div><div class="col-xs-12 col-sm-6">18 มี.ค. 2496 (เสียชีวิต 11 มี.ค. 2560) (อายุ <?php echo $age;?> ปี)</div>
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-xs-12 col-sm-3"><b>เพศ</b> ชาย</div>
                                                          <div class="col-xs-12 col-sm-3"><b>สัญชาติ</b> ไทย</div>
                                                          <div class="col-xs-12 col-sm-3"><b>ศาสนา</b> อิสลาม</div>
                                                        </div>
                                                        <div class="row">
                                                        &nbsp;
                                                        </div>
                                                        <div class="row">
                                                          <div class="col-xs-12 col-sm-3"><h4>ที่อยู่ตามทะเบียนบ้าน</h4></div><div class="col-xs-12 col-sm-5"> 124 ถนน รามคำแหง 58/3 แขวง หัวหมาก เขต ปางกะปิ กรุงเทพมหานคร 10240 </div>
                                                        </div><br>

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
        <label for="col1_filter">ชื่อสถานที่จัดกิจกรรมของผู้สูงอายุ:</label>
        <input data-column="1" type="text" class="form-control column_filter" id="col1_filter">
    
        <label for="col3_filter">วันที่ได้รับการสำรวจ:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="3" type="text" class="form-control column_filter" id="col3_filter">

        <label for="col4_filter">วันที่ผลการพิจารณา:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="4" type="text" class="form-control column_filter" id="col4_filter">

        <label for="col5_filter">วันที่เสร็จสิ้น:</label>
        <input type="date" class="form-control date_filter">
        <input data-column="5" type="text" class="form-control column_filter" id="col5_filter">

        <label for="col6_filter">งบประมาณที่ใช้ไป (บาท):</label>
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
