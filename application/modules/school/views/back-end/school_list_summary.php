  <!-- Resources -->
  <script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
  <script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
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
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณโรงเรียนผู้สูงอายุ จำแนกตามปีที่ก่อตั้ง</span></div>
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
                    <?php $stat = $this->common_model->custom_query("
                      SELECT
                        year_of_established,
                        COUNT(year_of_established) AS count_schl
                      FROM
                        schl_info
                      WHERE
                        delete_user_id IS NULL
                      AND year_of_established !=''
                      GROUP BY
                        year_of_established
                      "); $dataChart = array(); ?>
                    <table width="100%" class="summary-report-table">
                      <tr>
                        <td class="summary-report-th" rowspan="2">ปีที่ก่อตั้ง (พ.ศ.)</td>
                        <td class="summary-report-th" colspan="3">ผลการดำเนินการ (ราย)</td>
                      </tr>
                      <tr>
                        <td class="summary-report-th"  width="30%">โรงเรียน</td>
                        <td class="summary-report-th"  width="30%">รุ่น</td>
                        <td class="summary-report-th"  width="30%">ผู้สูงอายุ (ราย)</td>
                      </tr>
                      <?php if(!empty($stat)){ ?>
                      <?php foreach ($stat as $key => $row) {?>
                       <tr>
                         <td class="summary-report-td center"><?php echo $row['year_of_established']+543; ?></td>
                         <td class="summary-report-td right"><?php echo $row['count_schl']; ?></td>
                         <td class="summary-report-td right"></td>
                         <td class="summary-report-td right"></td>
                       </tr>

                      <?php
                        $dataChart[] = array(
                          'date' => $row['year_of_established']+543,
                          'schl' => $row['count_schl'],
                        );
                      } ?>
                      <?php } ?>
                    </table>
                  </div>

                  <!-- Chart code -->
                  <script>
                    var chart = AmCharts.makeChart("chartdiv", {
                        "type": "serial",
                        "theme": "light",
                        "marginRight": 80,
                        "dataProvider": <?php echo json_encode($dataChart); ?>,
                        "balloon": {
                            "cornerRadius": 6,
                            "horizontalPadding": 15,
                            "verticalPadding": 10
                        },
                        // "valueAxes": [{
                        //     "duration": "mm",
                        //     "durationUnits": {
                        //         "hh": "h ",
                        //         "mm": "min"
                        //     },
                        //     "axisAlpha": 0
                        // }],
                        "valueAxes": [{
                            "id": "v1",
                            "axisAlpha": 0,
                            "position": "left",
                            "title": "จำนวนโรงเรียนที่ก่อตั้ง (โรงเรียน)",
                            "ignoreAxisWidth":true
                        }],
                        "graphs": [{
                            "bullet": "square",
                            "bulletBorderAlpha": 1,
                            "bulletBorderThickness": 1,
                            "fillAlphas": 0.3,
                            "fillColorsField": "lineColor",
                            "legendValueText": "จำนวนโรงเรียน: [[value]] ",
                            "lineColorField": "lineColor",
                            "title": "",
                            "valueField": "schl"
                        }],
                        "chartScrollbar": {

                        },
                        "chartCursor": {
                            "categoryBalloonDateFormat": "YYYY MMM DD",
                            "cursorAlpha": 0,
                            "fullWidth": true
                        },
                        "dataDateFormat": "YYYY-MM-DD",
                        "categoryField": "date",
                        "categoryAxis": {
                            "dateFormats": [{
                                "period": "DD",
                                "format": "DD"
                            }, {
                                "period": "WW",
                                "format": "MMM DD"
                            }, {
                                "period": "MM",
                                "format": "MMM"
                            }, {
                                "period": "YYYY",
                                "format": "YYYY"
                            }],
                            "parseDates": true,
                            "autoGridCount": false,
                            "axisColor": "#555555",
                            "gridAlpha": 0,
                            "gridCount": 50
                        },
                        "export": {
                            "enabled": true
                        }
                    });

                    chart.addListener("dataUpdated", zoomChart);

                    function zoomChart() {
                        chart.zoomToDates(new Date(2012, 0, 3), new Date(2012, 0, 11));
                    }
                  </script>
                </div>
            </div>
            <div id="chratTab-2" class="tab-pane">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณโรงเรียนผู้สูงอายุ จำแนกรายพื้นที่</span></div>
                  </div>
                  <div class="col-xs-12">
                    <!-- Styles -->
                    <style>
                      #chartdiv2 {
                        width : 95%;
                        height  : 500px;
                      }

                    </style>
                    <!-- HTML -->
                    <center><div id="chartdiv2"></div></center>
                    <?php $stat = $this->common_model->custom_query("
                    SELECT
                      std_area.area_name_th,
                      COUNT(schl_info.schl_id) AS count_info
                      FROM
                      schl_info
                      JOIN std_area
                      ON schl_info.addr_province = std_area.area_code
                      GROUP BY std_area.area_code
                      ORDER BY std_area.area_name_th ASC
                      "); $dataChart = array(); ?>
                    <!-- Chart code -->
                    <script>
                    var chart = AmCharts.makeChart( "chartdiv2", {
                      "type": "serial",
                      "theme": "light",
                      "dataProvider": [
                      <?php
                      foreach ($stat as $key => $row) {
                      ?>
                      {
                        "country": "<?php echo $row['area_name_th'];?>",
                        "visits": <?php echo $row['count_info'];?>
                      },
                      <?php } ?>
                      ],
                      "valueAxes": [ {
                        "gridColor": "#FFFFFF",
                        "gridAlpha": 0.2,
                        "dashLength": 0
                      } ],
                      "gridAboveGraphs": true,
                      "startDuration": 1,
                      "graphs": [ {
                        "balloonText": "[[category]]: <b>[[value]]</b>",
                        "fillAlphas": 0.8,
                        "lineAlpha": 0.2,
                        "type": "column",
                        "valueField": "visits"
                      } ],
                      "chartCursor": {
                        "categoryBalloonEnabled": false,
                        "cursorAlpha": 0,
                        "zoomable": false
                      },
                      "categoryField": "country",
                      "categoryAxis": {
                        "gridPosition": "start",
                        "gridAlpha": 0,
                        "tickPosition": "start",
                        "tickLength": 20
                      },
                      "export": {
                        "enabled": true
                      }

                    } );
                    </script>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
