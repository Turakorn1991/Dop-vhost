<!-- Resources -->
<script src="<?php echo base_url("assets/plugins/amcharts/amcharts.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/pie.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/animate/animate.min.js")?>"></script>
<script src="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.min.js")?>"></script>
<link rel="stylesheet" href="<?php echo base_url("assets/plugins/amcharts/plugins/export/export.css")?>" type="text/css" media="all" />
<script src="<?php echo base_url("assets/plugins/amcharts/themes/light.js")?>"></script>
<div id="chart_display"  style="display: none;">
    <div class="tabs-page-container">
        <div class="tab-content">
            <div id="chartTab-1" class="tab-pane active">
                <div class="panel-body row">
                  <div class="col-xs-12 col-sm-12">
                    <!-- Styles -->
                    <style>
                      #chartdiv {
                        width: 100%;
                        /* height: 500px; */
                        min-height: 550px;
                      }
                    </style>
                    <!-- HTML -->
                    <center>
                      <div id="chartdiv">
                        <iframe width="100%" height="550" src="https://app.powerbi.com/view?r=eyJrIjoiMWIxMjlhMjQtMDI1Mi00NjVlLWJlZmItMGVkMjk0ZWI1N2JjIiwidCI6IjliMzg4YjE3LTk4MjItNDczNy04YTdhLWFkYWM2Yzc5Mjc4YiIsImMiOjN9" frameborder="0" allowFullScreen="true"></iframe>
                      </div>
                    </center>
                  </div>
                  <div class="col-xs-12 col-sm-12">
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>