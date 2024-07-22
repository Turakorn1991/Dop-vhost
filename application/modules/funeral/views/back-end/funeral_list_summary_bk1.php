<!-- Resources -->
<script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/pie.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
<script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>
  <div id="chart_display"  style="display: none;">
    <div class="tabs-page-container">
      <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#chartTab-1" aria-expanded="true">&nbsp;</a></li>
          <li class=""><a data-toggle="tab" href="#chratTab-2" aria-expanded="false">&nbsp;</a></li>
      </ul>
        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณการสงเคราะห์ในการจัดการงานศพผู้สูงอายุตามประเพณี</span></div>
                  </div>
                  <div class="col-xs-12 col-sm-12">
                    <!-- Styles -->
                    <style>
                      #chartdiv {
                        width: 95%;
                        height: 500px;
                        /*min-height: 600px;*/
                      }
                    </style>
                    <!-- HTML -->
                    <div id="chartdiv"></div>
                  </div>
                  <div class="col-xs-12 col-sm-12">
                    <?php $stat = $this->common_model->custom_query("
                    SELECT
                      IF(YEAR(fnrl_info.date_of_req)+(IF(MONTH(fnrl_info.date_of_req)>9,1,0)),YEAR(fnrl_info.date_of_req)+(IF(MONTH(fnrl_info.date_of_req)>9,1,0)),'NULL') AS yyyy,
                      SUM(IF(YEAR(date_of_pay) = 0,1,0)) AS count_req,
                      SUM(IF(YEAR(date_of_pay) > 0,1,0)) AS count_pay,
                      SUM(pay_amount) AS amount
                      FROM
                      fnrl_info
                      JOIN pers_info
                      ON fnrl_info.pers_id = pers_info.pers_id
                      WHERE
                      fnrl_info.delete_user_id IS NULL
                      GROUP BY
                      yyyy
                      ORDER BY
                      yyyy ASC
                      "); ?>
                    <table  width="100%" class="summary-report-table">
                      <tr >
                        <td class="summary-report-th" rowspan="2">ปีงบประมาณ</td>
                        <td class="summary-report-th" colspan="5">ปริมาณการให้บริการ (ราย)</td>
                      </tr>
                      <tr >
                        <td class="summary-report-th" width="18%">รอรับการสงเคราะห์</td>
                        <td class="summary-report-th" width="18%">ได้รับการสงเคราห์แล้ว</td>
                        <td class="summary-report-th" width="18%">ไม่ผ่านคุณสมบัติ</td>
                        <td class="summary-report-th" width="18%">รวม</td>
                      </tr>
                      <?php
                      if(!empty($stat)){
                      $total_count_req = 0;
                      $total_count_pay = 0;
                      $total_count_all = 0;
                      $intYear = 0;
                      foreach ($stat as $key => $row) {
                        $total_count_req += $row['count_req'];
                        $total_count_pay += $row['count_pay'];
                        $total_count_all += $row['count_req']+$row['count_pay'];

                        if($row['yyyy'] != 'NULL'){
                              $intYear++;
                              $budget_year =  $row['yyyy']+543;
                              if($intYear == 1){
                                $st = $budget_year;
                              }
                              $ed = $budget_year;

                              $chartData[$budget_year] = array(
                                array(
                                  'sector'=>'รอรับการสงเคราะห์ '.($row['count_req']).' ราย',
                                  'size'=>intval($row['count_req'])
                                ),
                                array(
                                  'sector'=>'ได้รับการสงเคราห์แล้ว',
                                  'size'=>intval($row['count_pay'])
                                ),
                                array(
                                  'sector'=>'ไม่ผ่านคุณสมบัติ',
                                  'size'=> 0
                                ),
                              );
                        }else{
                              $budget_year = "ไม่ระบุ";
                        }
                      ?>
                        <tr>
                          <td class="summary-report-td center"><?php echo $budget_year; ?></td>
                          <td class="summary-report-td right"><?php echo number_format($row['count_req']);?></td>
                          <td class="summary-report-td right"><?php echo number_format($row['count_pay']); ?></td>
                          <td class="summary-report-td right">-</td>
                          <td class="summary-report-td right"><?php echo number_format($row['count_req']+$row['count_pay']); ?></td>
                        </tr>
                      <?php
                        }
                      }
                      ?>
                      <tr>
                        <td class="summary-report-td-sum center">รวม</td>
                        <td class="summary-report-td-sum right"><?php echo number_format($total_count_req);?></td>
                        <td class="summary-report-td-sum right"><?php echo number_format($total_count_pay) ?></td>
                        <td class="summary-report-td-sum right">-</td>
                        <td class="summary-report-td-sum right"><?php echo number_format($total_count_all); ?></td>
                      </tr>
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
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">งบประมาณที่ใช้ไปในการให้บริการสงเคราะห์ในการจัดการงานศพผู้สูงอายุตามประเพณี</span></div>
                  </div>
                  <div class="col-xs-12 col-sm-12">
                    <!-- Styles -->
                    <style>
                      #chartdiv2 {
                        width : 95%;
                        height  : 500px;
                      }

                    </style>
                    <!-- HTML -->
                    <div id="chartdiv2"></div>
                  </div>
                  <div class="col-xs-12 col-sm-12">
                    <?php $stat2 = $this->common_model->custom_query("
                      SELECT
                        date_of_req,
                        SUM(pay_amount) AS amount
                      FROM
                        fnrl_info
                      WHERE
                        (pay_amount != ''
                      OR pay_amount IS NOT NULL)
                      AND delete_user_id IS NULL
                      GROUP BY
                        date_of_req
                      ");
                    ?>
                    <table width="100%" class="summary-report-table">
                      <tr >
                        <td class="summary-report-th" rowspan="2">ปีงบประมาณ</td>
                        <td class="summary-report-th" colspan="2">ปริมาณการให้บริการ (ราย)</td>
                        <td class="summary-report-th" rowspan="2">งบประมานที่ใช้ไป (บาท)</td>
                      </tr>
                      <tr>
                        <td class="summary-report-th">รอรับการสงเคราะห์</td>
                        <td class="summary-report-th">ได้รับการสงเคราะห์</td>
                      </tr>
                      <?php
                      if(!empty($stat)){
                        $total_count_req = 0;
                        $total_count_pay = 0;
                        $total_amount = 0;
                        foreach ($stat as $key => $row) {
                          $total_count_req += $row['count_req'];
                          $total_count_pay += $row['count_pay'];
                          $total_amount += $row['amount'];

                          if($row['yyyy'] != 'NULL'){
                                $intYear++;
                                $budget_year =  $row['yyyy']+543;

                          }else{
                                $budget_year = "ไม่ระบุ";
                          }
                      ?>
                          <tr>
                            <td class="summary-report-td center"><?php echo $budget_year; ?></td>
                            <td class="summary-report-td right"><?php echo number_format($row['count_req']);?></td>
                            <td class="summary-report-td right"><?php echo number_format($row['count_pay']); ?></td>
                            <td class="summary-report-td right"><?php echo number_format($row['amount'],2); ?></td>
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
                        <tr>
                          <td class="summary-report-td-sum center">รวม</td>
                          <td class="summary-report-td-sum right"><?php echo number_format($total_count_req);?></td>
                          <td class="summary-report-td-sum right"><?php echo number_format($total_count_pay); ?></td>
                          <td class="summary-report-td-sum right"><?php echo number_format($total_amount,2); ?></td>
                        </tr>
                    </table>
                  </div>
                  <!-- Resources -->
                    <script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
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
