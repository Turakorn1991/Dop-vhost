<script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
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
                  <!-- Resources -->
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณผู้สูงอายุจำแนกตามเพศ</span></div>
                  </div>
                  <div class="col-xs-12">
                  	<!-- Styles -->
										<style>
										#chartdiv {
											width		: 95%;
											height		: 500px;
										}
										</style>
										<!-- Chart code -->
                    <?php
                    $stat = $this->common_model->custom_query("SELECT
                        SUM(IF(gender_code=1,1,0)) AS count_req_m,
                        SUM(IF(gender_code=2,1,0)) AS count_req_f,
                        SUM(IF( (gender_code=0 || gender_code IS NULL),1,0)) AS count_req_null
                        FROM
                        pers_info
                      ");
                    $statRow =  rowArray($stat);
                    ?>
										<script>
                    var chart = AmCharts.makeChart( "chartdiv", {
                        "type": "pie",
                        "theme": "light",
                        "fontSize": 16,
                        "dataProvider": [ {
                          "country": "ชาย",
                          "litres": <?php echo $statRow['count_req_m'];?>
                        }, {
                          "country": "หญิง",
                          "litres": <?php echo $statRow['count_req_f'];?>
                        }, {
                          "country": "ไม่ระบุ",
                          "litres": <?php echo $statRow['count_req_null'];?>
                        } ],
                        "valueField": "litres",
                        "titleField": "country",
                         "balloon":{
                         "fixedPosition":true
                        },
                        "export": {
                          "enabled": true
                        }
                      } );
										</script>

										<!-- HTML -->
										<center><div id="chartdiv"></div></center>
                  </div>
                </div>
            </div>
            <div id="chratTab-2" class="tab-pane">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">สถิติผู้สูงอายุที่ลงทะเบียนประวัติ (ฐานข้อมูลกลาง)</span></div>
                  </div>
                  <div class="col-xs-12">
                  	<!-- Styles -->
										<style>
										#chartdiv2 {
											width		: 95%;
											height		: 500px;
										}
										</style>
										<!-- Chart code -->
                    <?php
                    $stat = $this->common_model->custom_query("SELECT
                    DATE(pers_info.insert_datetime) AS insert_date,
                    COUNT(pers_info.pers_id) AS count_info
                    FROM
                    pers_info
                    WHERE pers_info.insert_datetime IS NOT NULL
                    GROUP BY insert_date
                    ORDER BY pers_info.insert_datetime ASC
                    ");
                    ?>
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
                        "fillAlphas": 0.2,
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
                    "dataProvider": [
                    <?php
                    foreach ($stat as $key => $row) {
                    ?>
                      {
                          "date": "<?php echo $row['insert_date'];?>",
                          "value": <?php echo $row['count_info'];?>
                      },
                    <?php } ?>
                    ]
                });

                chart.addListener("rendered", zoomChart);

                zoomChart();

                function zoomChart() {
                    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
                }
										</script>

										<!-- HTML -->
										<center><div id="chartdiv2"></div></center>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
