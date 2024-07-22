  <div id="chart_display"  style="display: none;">
    <!-- Resources -->
    <script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
    <script src="<?php echo base_url("assets/plugins/amcharts/plugins/dataloader/dataloader.min.js")?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
    <script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>
    <div class="tabs-page-container">
          <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#chartTab-1" aria-expanded="true">&nbsp;</a></li>
          </ul>

        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">

            <div class="panel-body row">
              <div class="col-xs-12">
                <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub">ปริมาณอาสาสมัครดูแลผู้สูงอายุ (อผส.) จำแนกรายจังหวัด</span></div>
              </div>
              <div class="col-xs-12">
                <!-- Styles -->
                <style>
                #chartdiv {
                  width   : 100%;
                  height    : 500px;
                  font-size : 16px;
                }
                </style>
                <!-- HTML -->
                <div id="chartdiv"></div>

                <!-- Chart code -->
                <script>
                  var chart = AmCharts.makeChart("chartdiv", {
                    "type": "serial",
                    "theme": "light",
                    "fontSize": 16,
                    "legend": {
                        "equalWidths": false,
                        "useGraphSettings": true,
                        "valueAlign": "left",
                        "valueWidth": 120
                    },
                    "dataLoader": {
                      "url": "<?php echo base_url("volunteer/getChart"); ?>",
                      "data": {"<?php echo $csrf['name']?>" : '<?php echo $csrf['hash']?>'},
                      "format": "json"
                    },
                    "valueAxes": [{
                        "id": "provinceAxis",
                        "axisAlpha": 0,
                        "gridAlpha": 0,
                        "position": "left",
                        "title": "จำนวน อาสาสมัครดูแลผู้สู้อายุ (อผส.)"
                    }, {
                        "id": "olderAxis",
                        "axisAlpha": 0,
                        "gridAlpha": 0,
                        "position": "right",
                        "title": "จำนวน ผู้สูงอายุในความดูแล"
                    }],
                    "graphs": [{
                        "alphaField": "alpha",
                        "balloonText": "จำนวนอาสาสมัครดูแลผู้อายุ [[value]] คน",
                        "dashLengthField": "dashLength",
                        "fillAlphas": 0.7,
                        "legendValueText": "[[value]] คน",
                        "title": "จำนวนอาสาสมัครดูแลผู้อายุ",
                        "type": "column",
                        "valueField": "value",
                        "valueAxis": "provinceAxis"
                    }, {
                        "balloonText": "ผู้สูงอายุในความดูแล [[value]] คน",
                        "bullet": "round",
                        "bulletBorderAlpha": 1,
                        "useLineColorForBulletBorder": true,
                        "bulletColor": "#FFFFFF",
                        "dashLengthField": "dashLength",
                        "labelPosition": "right",
                        "legendValueText": "[[value]] คน",
                        "title": "ผู้สูงอายุในความดูแล",
                        "fillAlphas": 0,
                        "valueField": "older",
                        "valueAxis": "olderAxis"
                    }],
                    "chartCursor": {
                        "categoryBalloonDateFormat": "DD",
                        "cursorAlpha": 0.1,
                        "cursorColor":"#000000",
                         "fullWidth":true,
                        "valueBalloonsEnabled": false,
                        "zoomable": false
                    },
                    "categoryField": "province",
                    "export": {
                      "enabled": true
                     }
                  });
                </script>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
