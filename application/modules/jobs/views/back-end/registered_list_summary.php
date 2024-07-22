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
                <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณผู้สูงอายุที่ขึ้นทะเบียนจัดหางาน</span></div>
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
                    YEAR (date_of_reg) AS year
                  FROM
                    edoe_older_emp_reg
                  WHERE
                    YEAR (date_of_reg) != '0000'
                  GROUP BY
                    YEAR (date_of_reg)
                  ORDER BY
                    year ASC
                  "); ?>
                <table width="100%" class="summary-report-table">
                  <tr>
                    <td class="summary-report-th" rowspan="2">ปีงบประมาณ</td>
                    <td class="summary-report-th" colspan="3">ผลการดำเนินการ (ราย)</td>
                  </tr>
                  <tr>
                    <td width="25%" class="summary-report-th">ได้งานทำแล้ว</td>
                    <td width="25%" class="summary-report-th">ยังไม่ได้งาน</td>
                    <td width="25%" class="summary-report-th">รวม</td>
                  </tr>
                  <?php $chartData = array(); ?>
                  <?php if(!empty($stat)){ ?>
                  <?php foreach ($stat as $key => $row) { ?>
                    <?php $jobs1 = $this->common_model->custom_query("SELECT COUNT(date_of_reg) AS count_pers FROM edoe_older_emp_reg WHERE YEAR(date_of_reg) = '{$row['year']}' GROUP BY reg_status"); ?>
                    <tr>
                      <td class="summary-report-td center"><?php echo $row['year']+543; ?></td>
                      <td class="summary-report-td right"><?php echo @$jobs1[0]['count_pers']; ?></td>
                      <td class="summary-report-td right"><?php echo @$jobs1[1]['count_pers']; ?></td>
                      <td class="summary-report-td right"><?php echo @$jobs1[0]['count_pers'] + @$jobs1[1]['count_pers']; ?></td>
                    </tr>
                  <?php
                    $chartData[] = array(
                      "year"=> $row['year']+543,
                      "worked"=> @$jobs1[0]['count_pers'],
                      "notwork"=>  @$jobs1[1]['count_pers'],
                    );

                  }?>
                  <?php } ?>
                </table>
              </div>

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
                  "dataProvider": <?php echo json_encode($chartData); ?>,
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
                    "title": "ได้งานทำแล้ว",
                    "type": "column",
                    "color": "#000000",
                    "valueField": "worked"
                  }, {
                    "balloonText": "<b>[[title]]</b><br><span style='font-size:14px'>[[category]]: <b>[[value]]</b></span>",
                    "fillAlphas": 0.8,
                    "labelText": "[[value]]",
                    "lineAlpha": 0.3,
                    "title": "ยังไม่ได้งาน",
                    "type": "column",
                    "newStack": true,
                    "color": "#000000",
                    "valueField": "notwork"
                  }],
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
            </div>
      </div>
    </div>
  </div>
</div>
