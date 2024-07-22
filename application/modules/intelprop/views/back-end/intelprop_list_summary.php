<!-- Resources -->
<script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/serial.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/pie.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/dataloader/dataloader.min.js")?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
<script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>
  <div id="chart_display"  style="display: none;">
    <div class="tabs-page-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#chartTab-1" aria-expanded="true">&nbsp;</a></li>
            <li class=""><a data-toggle="tab" href="#chartTab-2" aria-expanded="false">&nbsp;</a></li>
            <li class=""><a data-toggle="tab" href="#chartTab-3" aria-expanded="false">&nbsp;</a></li>
        </ul>
        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub"> ปริมาณคลังปัญญาผู้สูงอายุ จำนวนรายสาขาภูมิปัญญา</span></div>
                  </div>
                  <div class="col-xs-12">
                    <!-- Styles -->
                    <style>
                    #chartdiv2 {
                      width		: 95%;
                      height		: 500px;
                      font-size	: 11px;
                    }
                    </style>
                    <!-- Chart code -->
                    <script>
                    var chart = AmCharts.makeChart( "chartdiv2", {
                      "type": "serial",
                      "theme": "light",
                      "fontSize": 16,
                      "dataLoader": {
                        "url": "<?php echo base_url("intelprop/getChart2"); ?>",
                        "data": {
                          "<?php echo $csrf['name']?>" : '<?php echo $csrf['hash']?>'
                        },
                        "format": "json",
                      },
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
                        "valueField": "value"
                      } ],
                      "chartCursor": {
                        "categoryBalloonEnabled": false,
                        "cursorAlpha": 0,
                        "zoomable": false
                      },
                      "categoryField": "wisdom",
                      "categoryAxis": {
                        "gridPosition": "start",
                        "gridAlpha": 0,
                        "autoRotateAngle": 45,
                        "autoRotateCount":1,
                        "tickPosition": "start",
                        "tickLength": 20
                      },
                      "export": {
                        "enabled": true
                      }

                    } );
                    </script>

                    <!-- HTML -->
                    <center><div id="chartdiv2"></div></center>
                  </div>
                </div>
            </div>
            <div id="chartTab-2" class="tab-pane">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub"> ปริมาณผู้สูงอายุที่มีภูมิปัญญา จำนวนรายจังหวัด</span></div>
                  </div>

                  <div class="col-xs-12">
                  	<!-- Styles -->
										<style>
										#chartdiv {
											width		: 95%;
											height		: 500px;
										}
										</style>
										<!-- HTML -->
										<center><div id="chartdiv"></div></center>

										<!-- Chart code -->
										<script>
										var chart = AmCharts.makeChart( "chartdiv", {
										  "type": "serial",
										  "theme": "light",
										  "fontSize": 16,
										  // "dataProvider": <?php //echo json_encode($dataChart); ?>,
										  "dataLoader": {
										    "url": "<?php echo base_url("intelprop/getChart"); ?>",
										    "data": {"<?php echo $csrf['name']?>" : '<?php echo $csrf['hash']?>'},
										    "format": "json"
										  },
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
										    "valueField": "value"
										  } ],
										  "chartCursor": {
										    "categoryBalloonEnabled": false,
										    "cursorAlpha": 0,
										    "zoomable": false
										  },
										  "categoryField": "province",
										  "categoryAxis": {
										    "gridPosition": "start",
										    "gridAlpha": 0,
										    "autoRotateAngle": 45,
										    "autoRotateCount":1,
										    "tickPosition": "start",
										    "tickLength": 20
										  },
										  "export": {
										    "enabled": false
										  }

										} );
										</script>
                  </div>
                </div>
            </div>

            <div id="chartTab-3" class="tab-pane">
                <div class="panel-body row">
                  <div class="col-xs-12">
                    <div class="summary-title left" style="position: relative;top: 0px;">ภาพรวม: <span class="summary-title-sub"> ปริมาณคลังปัญญาผู้สูงอายุ จำนวนรายภูมิภาค</span></div>
                  </div>
                  <div class="col-xs-12">
                    <!-- Styles -->
                    <style>
                    #chartdiv3 {
                      width		: 95%;
                      height		: 500px;
                      font-size	: 11px;
                    }
                    </style>
                    <!-- Chart code -->
                    <script>
                    var chart = AmCharts.makeChart( "chartdiv3", {
                        "type": "pie",
                        "theme": "light",
                        "fontSize": 16,
                        "dataLoader": {
                          "url": "<?php echo base_url("intelprop/getChart3"); ?>",
                          "data": {
                            "<?php echo $csrf['name']?>" : '<?php echo $csrf['hash']?>'
                          },
                          "format": "json",
                        },
                        /*"dataProvider": [ {
                          "country": "ชาย",
                          "litres": 1
                        }, {
                          "country": "หญิง",
                          "litres": 2
                        }, {
                          "country": "ไม่ระบุ",
                          "litres": 3
                        } ],*/
                        "valueField": "value",
                        "titleField": "wisdom",
                         "balloon":{
                         "fixedPosition":true
                        },
                        "export": {
                          "enabled": true
                        }
                      } );
                    </script>
<?php /* ?>
                    <script>
                    var chart = AmCharts.makeChart( "chartdiv3", {
                      "type": "serial",
                      "theme": "light",
                      "fontSize": 16,
                      "dataLoader": {
                        "url": "<?php echo base_url("intelprop/getChart3"); ?>",
                        "data": {
                          "<?php echo $csrf['name']?>" : '<?php echo $csrf['hash']?>'
                        },
                        "format": "json",
                      },
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
                        "valueField": "value"
                      } ],
                      "chartCursor": {
                        "categoryBalloonEnabled": false,
                        "cursorAlpha": 0,
                        "zoomable": false
                      },
                      "categoryField": "wisdom",
                      "categoryAxis": {
                        "gridPosition": "start",
                        "gridAlpha": 0,
                        "autoRotateAngle": 45,
                        "autoRotateCount":1,
                        "tickPosition": "start",
                        "tickLength": 20
                      },
                      "export": {
                        "enabled": true
                      }

                    } );
                    </script>
<?php */ ?>
                    <!-- HTML -->
                    <center><div id="chartdiv3"></div></center>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
