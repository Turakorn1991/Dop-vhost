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
          
        </ul>
        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณ ศพอส. จำแนกตามพื้นที่</span></div>
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
                        addr_province,
                        COUNT(addr_province) AS count_schl
                      FROM
                        qlc_info
                      WHERE
                        delete_user_id IS NULL
                      AND addr_province !=''
                      GROUP BY
                        addr_province
                      "); 
                 //   dieArray($stat);
                      $dataChart = array(); ?>
                    <!-- <table width="100%" class="summary-report-table"> -->
<!--                       <tr>
                        <td class="summary-report-th" rowspan="2">ปีที่ก่อตั้ง (พ.ศ.)</td>
                        <td class="summary-report-th" colspan="3">ผลการดำเนินการ (ราย)</td>
                      </tr>
                      <tr>
                        <td class="summary-report-th"  width="30%">โรงเรียน</td>
                        <td class="summary-report-th"  width="30%">รุ่น</td>
                        <td class="summary-report-th"  width="30%">ผู้สูงอายุ (ราย)</td>
                      </tr> -->
                      <?php if(!empty($stat)){ ?>
                      <?php foreach ($stat as $key => $row) {?>
<!--                        <tr>
                         <td class="summary-report-td center"><?php echo $row['year_of_established']+543; ?></td>
                         <td class="summary-report-td right"><?php echo $row['count_schl']; ?></td>
                         <td class="summary-report-td right"></td>
                         <td class="summary-report-td right"></td>
                       </tr> -->
                      <?php
                        $province = $this->common_model->query("SELECT area_name_th FROM std_area WHERE area_code = {$row['addr_province']}")->row_array();

                        $dataChart[] = array(
                          'date' => $province['area_name_th'],
                          'schl' => $row['count_schl'],
                          'color'=> "#873600"
                        );
                      } ?>

                      <?php }
                     // dieArray($dataChart); ?>
                    <!-- </table> -->
                  </div>


                       <!-- Chart code -->
                <script>
                var chart = AmCharts.makeChart( "chartdiv", {
                  "type": "serial",
                  "theme": "light",
                  "fontSize": 16,
                  "dataProvider": <?php echo json_encode($dataChart); ?>,
                  "valueAxes": [ {
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "title": "จำนวน ศพอส.",
                    "dashLength": 0,
  
                  } ],
                  "gridAboveGraphs": true,
                  "startDuration": 1,
                  "graphs": [ {
                    "balloonText": "[[date]]: <b>[[schl]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "colorField" : "color",
                    "type": "column",
                    "valueField": "schl"
                  } ],
                  "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                  },
                  "categoryField": "date",
                  "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "autoRotateAngle": 45,
                    "autoRotateCount":1,
                    // "autoWrap": true,
                    // "tickPosition": "start",
                    // "tickLength": 20,
                    // "labelFunction": function(label, item, axis) {
                    //   var chart = axis.chart;
                    //   // if ( (chart.realWidth <= 300 ) && ( label.length > 5 ) )
                    //   //   return label.substr(0, 5) + '...';
                    //   if ( label.length > 30 )
                    //     return label.substr(0, 20) + '...';
                    //   else
                    //     return label;
                    // }
                  },
                  "export": {
                    "enabled": true
                  }

                } );
                $('a[href="http://www.amcharts.com/javascript-charts/"]').hide();
                </script>
                </div>
            </div>
            
    </div>
  </div>
</div>
