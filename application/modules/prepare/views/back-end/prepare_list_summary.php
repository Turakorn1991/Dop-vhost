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
          </ul>

        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">
              <div class="panel-body row">
                <div class="col-xs-12">
                  <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ผลการดำเนินการเตรียมความพร้อมสู่วัยสูงอายุ (การให้ความรู้ก่อนวัยเกษียณ)</span></div>
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
                  <table width="100%" class="summary-report-table">
                    <tr >
                      <td class="summary-report-th" rowspan="2">ปีงบประมาณ</td>
                      <td class="summary-report-th" colspan="5">ผลการดำเนินการ (ราย)</td>
                    </tr>
                    <tr>
                      <td class="summary-report-th" width="15%">รอการตรวจเยี่ยม (แจ้งเรื่อง)</td>
                      <td class="summary-report-th" width="15%">รอรับการสงเคราะห์ (ตรวจเยี่ยมแล้ว)</td>
                      <td class="summary-report-th" width="15%">ได้รับการสงเคราห์แล้ว</td>
                      <td class="summary-report-th" width="15%">ไม่ผ่านคุณสมบัติ</td>
                      <td class="summary-report-th" width="15%">รวม</td>
                    </tr>
                    <?php if(!empty($stat)){ ?>
                    <?php foreach ($stat as $key => $row) { ?>
                      <tr>
                        <td class="summary-report-td center"><?php echo $row['yyyy']+543; ?></td>
                        <td class="summary-report-td right"><?php echo number_format($row['count_req'] - $row['count_visit']);?></td>
                        <td class="summary-report-td right"><?php echo number_format($row['count_visit'] - $row['count_pay']); ?></td>
                        <td class="summary-report-td right"><?php echo number_format($row['count_pay']); ?></td>
                        <td class="summary-report-td right"> - </td>
                        <td class="summary-report-td right"><?php echo number_format($row['count_req']); ?></td>
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
      </div>
    </div>
  </div>
&nbsp;
