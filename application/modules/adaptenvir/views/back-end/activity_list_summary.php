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
          <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ (ปรับปรุงสถานที่จัดกิจกรรมของผู้สูงอายุ)</span></div>
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
        <center><div id="chartdiv"></div></center>
      </div>
      <div class="col-xs-12 col-sm-12">
        <?php
          $tmp_query = $this->common_model->custom_query("
            SELECT IF(YEAR(impv_place_info.date_of_finish)+(IF(MONTH(impv_place_info.date_of_finish)>9,1,0)),YEAR(impv_place_info.date_of_finish)+(IF(MONTH(date_of_finish)>9,1,0)),'NULL') AS yyyy
            FROM impv_place_info
            WHERE delete_user_id IS NULL
            GROUP BY yyyy
            ORDER BY yyyy ASC
          ");
          ?>
          <table width="100%" class="summary-report-table">
            <tr >
              <td class="summary-report-th" rowspan="2">ปีงบประมาณ</td>
              <td class="summary-report-th" colspan="4">ผลการดำเนินงาน (ราย)</td>
            </tr>
            <tr style="background-color: #67a3d6; color: white">
              <td class="summary-report-th" width="18%">รอการพิจราณา</td>
              <td class="summary-report-th" width="18%">ได้รับอนุมัติ</td>
              <td class="summary-report-th" width="18%">ไม่ได้รับอนุมัติ</td>
              <td class="summary-report-th" width="18%">รวม</td>
            </tr>
            <?php if(!empty($tmp_query)){
            $intYear = 0;
            $total_wait = 0;
            $total_allow = 0;
            $total_notallow = 0;
            $total_all = 0;
            foreach ($tmp_query as $key => $row) {
              $intYear++;
              $wait = rowArray($this->common_model->custom_query("
              SELECT
              COUNT(pers_info.pers_id) AS count_info,
              impv_place_info.consi_result
              FROM impv_place_info
              JOIN pers_info
              ON impv_place_info.pers_id = pers_info.pers_id
              WHERE
              impv_place_info.date_of_consi IS NULL
              AND impv_place_info.delete_user_id IS NULL
              AND impv_place_info.consi_result IS NULL
              AND IF(YEAR(impv_place_info.date_of_finish)+(IF(MONTH(impv_place_info.date_of_finish)>9,1,0)),YEAR(impv_place_info.date_of_finish)+(IF(MONTH(date_of_finish)>9,1,0)),'NULL') = '".($row['yyyy'])."'
              GROUP BY impv_place_info.consi_result
              "));

              $allow = rowArray($this->common_model->custom_query("
              SELECT
              COUNT(pers_info.pers_id) AS count_info,
              impv_place_info.consi_result
              FROM impv_place_info
              JOIN pers_info
              ON impv_place_info.pers_id = pers_info.pers_id
              WHERE
              impv_place_info.date_of_consi IS NULL
              AND impv_place_info.delete_user_id IS NULL
              AND impv_place_info.consi_result ='อนุมัติ'
              AND IF(YEAR(impv_place_info.date_of_finish)+(IF(MONTH(impv_place_info.date_of_finish)>9,1,0)),YEAR(impv_place_info.date_of_finish)+(IF(MONTH(date_of_finish)>9,1,0)),'NULL') = '".($row['yyyy'])."'
              GROUP BY impv_place_info.consi_result
              "));

              $notallow = rowArray($this->common_model->custom_query("
              SELECT
              COUNT(pers_info.pers_id) AS count_info,
              impv_place_info.consi_result
              FROM impv_place_info
              JOIN pers_info
              ON impv_place_info.pers_id = pers_info.pers_id
              WHERE
              impv_place_info.date_of_consi IS NULL
              AND impv_place_info.delete_user_id IS NULL
              AND impv_place_info.consi_result ='ไม่อนุมัติ'
              AND IF(YEAR(impv_place_info.date_of_finish)+(IF(MONTH(impv_place_info.date_of_finish)>9,1,0)),YEAR(impv_place_info.date_of_finish)+(IF(MONTH(date_of_finish)>9,1,0)),'NULL') = '".($row['yyyy'])."'
              GROUP BY impv_place_info.consi_result
              "));

              if($row['yyyy'] != 'NULL'){
                    $budget_year =  $row['yyyy']+543;
                    if($intYear == 1){
                      $st = $budget_year;
                    }
                    $ed = $budget_year;

                    $chartData[$budget_year] = array(
                      array(
                        'sector'=>'รอการพิจราณา',
                        'size'=>intval($wait['count_info'])
                      ),
                      array(
                        'sector'=>'ได้รับอนุมัติ',
                        'size'=>intval($allow['count_info'])
                      ),
                      array(
                        'sector'=>'ไม่ได้รับอนุมัติ',
                        'size'=>intval($notallow['count_info'])
                      ),

                    );
              }else{
                    $budget_year = "ไม่ระบุ";
              }

              ?>
              <tr>
                <td class="summary-report-td center"><?php echo $budget_year;?></td>
                <td class="summary-report-td right"><?php echo number_format($wait['count_info']); ?></td>
                <td class="summary-report-td right"><?php echo number_format($allow['count_info']); ?></td>
                <td class="summary-report-td right"><?php echo number_format($notallow['count_info']); ?></td>
                <td class="summary-report-td right"><?php echo number_format($wait['count_info'] + $allow['count_info'] + $notallow['count_info']); ?></td>
              </tr>
            <?php
              $total_wait += $wait['count_info'];
              $total_allow += $allow['count_info'];
              $total_notallow += $notallow['count_info'];
              $total_all += $wait['count_info']+$allow['count_info']+$notallow['count_info'];
              }
            }
            ?>
            <tr>
              <td class="summary-report-td-sum center">รวม</td>
              <td class="summary-report-td-sum right"><?php echo number_format($total_wait); ?></td>
              <td class="summary-report-td-sum right"><?php echo number_format($total_allow); ?></td>
              <td class="summary-report-td-sum right"><?php echo number_format($total_notallow); ?></td>
              <td class="summary-report-td-sum right"><?php echo number_format($total_all); ?></td>
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
          <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">งบประมาณที่ใช้ไปในการปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ (ปรับปรุงสถานที่จัดกิจกรรมของผู้สูงอายุ)</span></div>
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
        <center><div id="chartdiv2"></div></center>
      </div>
      <div class="col-xs-12 col-sm-12">
        <table width="100%" class="summary-report-table">
          <tr>
            <td class="summary-report-th" rowspan="2">ปีงบประมาณ</td>
            <td class="summary-report-th" colspan="2">ปริมาณการให้บริการ (ราย)</td>
            <td class="summary-report-th" rowspan="2">งบประมานที่ใช้ไป (บาท)</td>
          </tr>
          <tr>
            <td class="summary-report-th">รอรับการสงเคราะห์</td>
            <td class="summary-report-th">ได้รับการสงเคราะห์</td>
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
                <td class="summary-report-td center"><?php echo $row['yyyy']+543; ?></td>
                <td class="summary-report-td right"><?php echo $wait['count_wait'];?></td>
                <td class="summary-report-td right"><?php echo $pay['count_pay']; ?></td>
                <td class="summary-report-td right"><?php echo number_format($pay['amount'],2); ?></td>
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
