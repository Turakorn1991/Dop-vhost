

            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">

                        </ul>



                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==72){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">


                                    <div id="tmp_menu" hidden='hidden'>
                                            <!--
                                             <?php
                                             if($process_action=='Edit') {

                                            ?>
                                            <a data-toggle="modal" data-target="#myPrint" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"

                                             title="พิมพ์แบบฟอร์ม">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </a>
                                            <?php }?>

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(46);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(46,$user_id); //Check User Permission
                                            ?>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> onclick="return opnCnfrom()"
                                            <?php }?> title="บันทึก <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                            </a>
                                             -->

                                            <?php
                                              $tmp = $this->admin_model->getOnce_Application(45);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(45,$user_id); //Check User Permission
                                            ?>
                                            <a   class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('individual/individual_list'); ?>"
                                            <?php }?> title="ย้อนกลับ <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-caret-left" aria-hidden="true"></i> </a>

                                            <!--
                                            <?php
                                              if($process_action=='Edit') {
                                              $tmp = $this->admin_model->getOnce_Application(46);
                                              $tmp1 = $this->admin_model->chkOnce_usrmPermiss(46,$user_id); //Check User Permission
                                            ?>
                                            <a data-id=<?php echo $wisd_info['knwl_id'];?> onclick="opn(this)" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{ ?>
                                            <?php }?> title="ลบ <?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i> </a>
                                            <?php } ?>

                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                            -->
                                          </div>
                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);
                                          </script>

                              <div class="form-group row">


                                <div class="col-sm-8">
                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 1">

                                             <?php

                                                $pers_info = array('pid'      =>'5-1021-99020-66-5',
                                                                   'name'     =>'นาง คูเลาะ เคอหม่า',
                                                                   'gender_name' =>'หญิง',
                                                                   'nation_name_th'=>'ไทย',
                                                                   'relg_title' =>'คริส',
                                                                   'date_of_birth' => '18 มี.ค. 2596 (เสียชีวติ 30 เม.ย. 2560) (อายุ 93 ปี)',
                                                                   'reg_add_info' =>'54 หมู่ 4 ถนนสุดสนิท ตำบลช้างเคิ่ง อำเภอ แม่แจ่ม จังหวัด เชียงใหม่ 50270');
                                             ?>

                                              <div class="panel-body" style="border:0; padding: 20px;">
                                                    <div class="form-group row">
                                                              <div class="col-xs-12 col-sm-3"><img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto; width: 70%;"></div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เลขประจำตัวประชาชน</span> </div>
                                                              <div class="col-xs-12 col-sm-3 has-error" style="padding: 3px 15px;"><?php echo $pers_info['pid']; ?></div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 1px 15px;"><?php echo @$pers_info['name'];?></div>

                                                              <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                                                              <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="date_of_birth"> <?php echo @$pers_info['date_of_birth'];?> </div>


                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name"> <?php echo @$pers_info['gender_name'];?></span> </div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"> <?php echo @$pers_info['nation_name_th'];?></span> </div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ศาสนา</span> <span id="relg_title"> <?php echo @$pers_info['relg_title'];?> </span> </div>

                                                              <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span></div>
                                                              <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="reg_addr"><?php echo @$pers_info['reg_add_info']; ?></div>

                                                              <div class="col-xs-12 col-sm-3">&nbsp;</div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ผลการประเมิน (ล่าสุด)</span></div>
                                                              <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;" id="reg_addr"><div style="width:200px; background-color: green; color: #fff; text-align: center;">100%</div></div>
                                                              <div class="col-xs-12 col-sm-3"><font>(44 จาก 55 คะแนน)</font></div>


                                                      </div>


                                               </div>

                                          </div><!-- close panel-group-->
                                </div>

                              </div>

                              <div class="col-sm-4">

                                 <div class="panel-group">
                                          <div class="panel panel-default" style="border: 1; ">
                                              <div class="panel-body" style="border:0; padding: 20px; height: 301px;">

                                                          <canvas id="radarChart" ></canvas>


                                              </div>
                                          </div>
                                 </div>

                              </div>
                          </div><!-- close form-group row -->

                           <div class="from-group row">
                               <div class="col-sm-8">
                                    <?php $fa = array('fa fa-heart','fa fa-hospital-o','fa fa-suitcase','fa fa-credit-card','fa fa-paint-brush','fa fa-lightbulb-o','fa fa-umbrella','fa fa-pause','fa fa-archive','fa fa-bookmark'); ?>
                                    <div class="panel-group">
                                          <div class="panel panel-default" style="border: 1">
                                              <div class="panel-body" style="border:0; padding: 20px;">
                                               <?php foreach($fa as $value) {?>
                                                 <div class="row">
                                                      <div class="col-xs-12 col-sm-2"><button type="button" class="btn btn-default btn-circle btn-lg "><i class="<?php echo $value; ?>" ></i></button></div>
                                                      <div class="col-xs-12 col-sm-10">
                                                         <h2><label> 02/05/2560  ได้รับเงินสงเคราะห์ในภาวะยากลำบาก จำนวน 2000 บาท (ปีงบประมาณ xxx)</label></h2>
                                                         <h3>(ศูนย์พัฒนาการจัดสวัสดีการสังคมผู้สูงอายุ บ้านธรรมปกรณ์)</h3>
                                                       </div>
                                                 </div><br>
                                                 <?php } ?>

                                              </div>
                                          </div>
                                    </div>


                               </div><!-- close class="col-sm-8"-->
                               <div class="col-sm-4">

                                      <div class="panel-group">
                                          <div class="panel panel-default" style="border: 1;  height: 1040px;">
                                              <div class="panel-body" style="border:0; padding: 20px;">
                                                <div class="row">
                                                   <div class="col-xs-12 col-sm-12 text-center">
                                                       <?php for($i=1;$i<5;$i++){?>
                                                        <img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-circle" style="margin: 0 auto; width: 20%;">
                                                       <?php } ?>
                                                   </div>
                                                   <div class="col-xs-12 col-sm-12 text-center">
                                                    <h2><label>อาสาสมัครดูแลผู้สูงอายุ (อผส.)</label></h2>
                                                   </div>

                                                </div>
                                                <?php
                                                   for($i=1;$i<18;$i++){
                                                    echo "<br>";
                                                   }
                                                  ?>
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 text-center"><h2><label>คลังปัญญา</label></h2></div>
                                                </div>
                                              </div>
                                          </div>
                                    </div>

                               </div><!-- close class="col-sm-4"-->
                           </div><!-- close class="form-group row"-->

                           <div class="form-group row">
                              <div class="col-xs-12 col-sm-12">

                                   <div class="panel-group">
                                          <div class="panel panel-default" style="border: 1">
                                              <div class="panel-body" style="border:0; padding: 20px;">

                                                  <div class="row">
                                                   <?php for($i=1;$i<=3;$i++){?>
                                                     <div class="col-xs-12 col-sm-3">
                                                         <img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-rounded" style="margin: 0 auto; width: 70%;">
                                                     </div>
                                                     <?php }?>
                                                      <div class="col-xs-12 col-sm-3">
                                                         <button class="btn btn-default btn-lg" style="width: 202.125px; height: 202.125px;"><font>MORE +</font></button>
                                                     </div>
                                                  </div>

                                              </div>
                                          </div>
                                    </div>

                              </div><!-- close class="col-xs-12 col-sm-12" -->
                           </div><!-- close class="form-group row"-->



                        </div><!-- close panel-body-->


                    </div><!-- close tab-1-->
                </div><!-- close tab-content-->
            </div>

<!-- <script type="text/javascript">

var chart = AmCharts.makeChart( "chartdiv", {
  "type": "radar",
  "theme": "none",
  "dataProvider": [ {
    "country": "Czech Republic",
    "litres": 156.9
  }, {
    "country": "Ireland",
    "litres": 131.1
  }, {
    "country": "Germany",
    "litres": 115.8
  }, {
    "country": "Australia",
    "litres": 109.9
  }, {
    "country": "Austria",
    "litres": 108.3
  }, {
    "country": "UK",
    "litres": 99
  } ],
  "valueAxes": [ {
    "axisTitleOffset": 20,
    "minimum": 0,
    "axisAlpha": 0.15
  } ],
  "startDuration": 2,
  "graphs": [ {
    "balloonText": "[[value]] litres of beer per year",
    "bullet": "round",
    "lineThickness": 2,
    "valueField": "litres"
  } ],
  "categoryField": "country",
  "export": {
    "enabled": true
  }
});

</script> -->


<!-- Confirm Back Modal -->
<div id="bckCnfrm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('061');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="bckbtnYes" type="button" class="btn btn-warning">ตกลง</button>
        <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Confirm Back Modal -->
