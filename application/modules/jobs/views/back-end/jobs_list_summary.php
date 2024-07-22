<!-- Resources -->
<script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/dataloader/dataloader.min.js")?>"></script>

  <div id="chart_display"  style="display: none;">
    <div class="tabs-page-container">
          <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#chartTab-1" aria-expanded="true">&nbsp;</a></li>
          </ul>

        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">
              <div class="panel-body row">
                <link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
                <script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>
                <div class="col-xs-12">
                  <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณตำแหน่งงานว่าง จำแนกรายประเภท</span></div>
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
                  <?php  ?>
                  <table width="100%" class="summary-report-table">
                    <tr>
                      <td class="summary-report-th" rowspan="2">ประเภทงาน</td>
                      <td class="summary-report-th" colspan="2">จำนวน ตำแหน่งงานว่าง</td>
                    </tr>
                    <tr>
                      <td class="summary-report-th" width="20%">ตำแหน่ง</td>
                      <td class="summary-report-th" width="20%">ร้อยละ</td>
                    </tr>

                    <tr>
                      <td class="summary-report-td-sum"  colspan="3">มีรายได้</td>
                    </tr>
                    <?php $countAlljobs = $this->db->from('edoe_job_vacancy')->count_all_results(); ?>
                    <?php $tmpPois1 = $this->common_model->custom_query("SELECT * FROM std_position_type WHERE posi_grp = 'มีรายได้'"); ?>
                    <?php foreach ($tmpPois1 as $key => $row) {?>
                      <?php $countjobs = $this->db->where('posi_cate_code',$row['posi_type_code'])->from('edoe_job_vacancy')->count_all_results(); ?>
                      <tr>
                        <td class="summary-report-td left" style="padding-left:15px;"><?php echo $row['posi_type_title']; ?></td>
                        <td class="summary-report-td right"><?php echo $countjobs; ?></td>
                        <td class="summary-report-td right"><?php echo round(($countjobs/$countAlljobs)*100,2); ?></td>
                      </tr>
                    <?php } ?>

                    <tr>
                      <td class="summary-report-td-sum" colspan="3">ไม่มีรายได้</td>
                    </tr>
                    <?php $tmpPois2 = $this->common_model->custom_query("SELECT * FROM std_position_type WHERE posi_grp = 'ไม่มีรายได้'"); ?>
                    <?php foreach ($tmpPois2 as $key => $row) {?>
                      <?php $countjobs = $this->db->where('posi_cate_code',$row['posi_type_code'])->from('edoe_job_vacancy')->count_all_results(); ?>
                      <tr>
                        <td  class="summary-report-td left" style="padding-left:15px;"><?php echo $row['posi_type_title']; ?></td>
                        <td class="summary-report-td right"><?php echo $countjobs; ?></td>
                        <td class="summary-report-td right"><?php echo round(($countjobs/$countAlljobs)*100,2); ?></td>
                      </tr>
                    <?php } ?>

                  </table>
                </div>

                <!-- Chart code -->
                <script>
                var chart = AmCharts.makeChart( "chartdiv", {
                  "type": "serial",
                  "theme": "light",
                  "fontSize": 16,
                  "dataLoader": {
                    "url": "<?php echo base_url("jobs/getChart"); ?>",
                    "data": {"<?php echo $csrf['name']?>" : '<?php echo $csrf['hash']?>'},
                    "format": "json"
                  },
                  "valueAxes": [ {
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "title": "ตำแหน่งงานว่าง",
                    "dashLength": 0
                  } ],
                  "gridAboveGraphs": true,
                  "startDuration": 1,
                  "graphs": [ {
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,

                    "type": "column",
                    "valueField": "value"
                  } ],
                  "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                  },
                  "categoryField": "jobs_type",
                  "categoryAxis": {
                    "gridPosition": "start",
                    "gridAlpha": 0,
                    "autoRotateAngle": 45,
                    "autoRotateCount":1,
                    // "autoWrap": true,
                    // "tickPosition": "start",
                    // "tickLength": 20,
                    "labelFunction": function(label, item, axis) {
                      var chart = axis.chart;
                      // if ( (chart.realWidth <= 300 ) && ( label.length > 5 ) )
                      //   return label.substr(0, 5) + '...';
                      if ( label.length > 30 )
                        return label.substr(0, 20) + '...';
                      else
                        return label;
                    }
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
