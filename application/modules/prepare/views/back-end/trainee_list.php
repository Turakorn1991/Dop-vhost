
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                      <ul class="nav nav-tabs">
                        <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(55); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/training_info/Edit/'.$trn_id);?>" <?php }?>  <?php if($usrpm['app_id']==55){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> การอบรม</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(56); 
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(56,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly 
                                  <?php }else if($process_action!='Add'){?> href="<?php echo site_url('prepare/trainee_list/View/'.$trn_id);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==56){?>aria-expanded="true" <?php }?>> ผุ้เข้าร่วม</a>
                            </li>
                      </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==55){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-1</strong>
                                </div>
                              </div>

                           
                            <div id="tab-2" <?php if($usrpm['app_id']==56){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php } ?>>
                                <div class="panel-body">
                                  <!-- <div class="row">
                                     <div class="col-xs-12 col-sm-12 text-right">

                                          <?php
                                            $tmp = $this->admin_model->getOnce_Application(55);
                                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                                          ?>
                                          <a <?php if(!isset($tmp1['perm_status'])) {?>
                                            readonly
                                          <?php }else{?> href="<?php echo site_url('prepare/trainee_regis');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกแบบขึ้นทะเบียน<?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                          </a>

                                          <?php
                                            $tmp = $this->admin_model->getOnce_Application(55);
                                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                                          ?>
                                          <a <?php if(!isset($tmp1['perm_status'])) {?>
                                            readonly
                                          <?php }else{?> href="<?php echo site_url('report/excel');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                                              <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                          </a>

                                          &nbsp;
                                          <a style="color: #000; padding-left: 20px; padding-right: 20px;" title="ค้นหา" class="btn btn-default" data-toggle="modal" data-target="#mySearch">
                                              <i class="fa fa-filter" aria-hidden="true"></i>
                                          </a>

                                     </div>
                                   </div> -->

                                   <div id="tmp_menu" hidden='hidden'>
                                    <?php
                                      $tmp = $this->admin_model->getOnce_Application(55); 
                                      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                                    ?>
                                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style="width:114px; margin-left: 0px; background-color: #e8152b; border: 0;font-size: 16px; padding: 4px 0 4px 0;"
                                    <?php if(!isset($tmp1['perm_status'])) {?>
                                            readonly 
                                          <?php }else{?> href="<?php echo site_url('prepare/trainee_regis/Add/'.$trn_id);?>" 
                                    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                    <i style='font-size:14px;' class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ

                                    <!-- <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="" data-toggle="modal" data-target="#mySearch">
                                    <i class="fa fa-filter" aria-hidden="true"></i> </a> -->

                                    <?php
                                      $tmp = $this->admin_model->getOnce_Application(55); 
                                      $tmp1 = $this->admin_model->chkOnce_usrmPermiss(55,$user_id); //Check User Permission
                                    ?>
                                     <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-export"  
                                    <?php if(!isset($tmp1['perm_status'])) {?>
                                            readonly 
                                          <?php }else{?> href="<?php echo site_url('report/excel');?>" 
                                    <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                    <i style='font-size:14px;' class="fa fa-table" aria-hidden="true"></i> ส่งออกไฟล์</a>

                                    
                                   <!--  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;" href="<?php echo site_url('prepare/training_list');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a> -->
                                    
                                  </div>
                                  <script>
                                    setTimeout(function(){
                                      $("#menu_topright").html($("#tmp_menu").html());
                                    },300);
                                  </script>

                                  <div class="table-responsive">

                                    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" >
                                      <thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
                                        <tr>
                                            <th>#</th>
                                            <th>เลขบัตรประจำตัวประชาชน</th>
                                            <th>(คำนำาหน้า) ชื่อ - สกุล</th>
                                            <th>อายุ (ปี)</th>
                                            <th>เพศ</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>สถานะ</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      $number = 1;
                                     // dieArray($prep_trn_trainee);
                                      foreach ($prep_trn_trainee as $key => $value) { 
                                        $pers = $this->personal_model->getPersonalInfo($value['pers_id']);

                                      ?>
                                        <tr>
                                            <td class="lnk"><?php echo $number;?></td>
                                            
                                            <?php 
                                              if ($pers['healthy_congenital_disease'] != ''){
                                                $heal = "<span style='padding:5px'><i data-toggle='tooltip' data-placement='left' title='{$pers['healthy_congenital_disease']}' class='fa fa-medkit' aria-hidden='true'></i></span>";
                                               // echo $pers['healthy_congenital_disease'];
                                              }
                                              if ($value['trainee_remark'] != ''){
                                                    $describe = "<span style='padding:5px'><i data-toggle='tooltip' data-placement='left' title='{$value['trainee_remark']}' class='fa fa-comment ' aria-hidden='true'></i></span>";
                                                
                                               // echo $pers['healthy_congenital_disease'];
                                              }
                                            ?>
                                            <td class="lnk"><?php echo $pers['pid']; ?></td>
                                            <td class="lnk"><?php echo $heal.$describe.$pers['name']; ?></td>
                                            <td class="lnk"><?php echo $pers['age']; ?></td>
                                            <td class="lnk"><?php echo $pers['gender_name']; ?></td>
                                            <td class="lnk"><?php echo $pers['tel_no']; ?></td>
                                            <?php
                                              $color_status = '';
                                              if (!empty($value['attd_status'])){
                                                if ($value['attd_status'] == 'ไม่ยืนยัน'){
                                                  $color_status = 'color:red;';
                                                }else{
                                                  $color_status = 'color:green;';
                                                }
                                              } 
                                            ?>
                                            <td class="lnk" style="<?php echo $color_status; ?>"><?php echo $value['attd_status']; ?></td>
                                            <td align="right">
                                              <?php
                                                $tmp = $this->admin_model->getOnce_Application(3);
                                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                              ?>
                                              <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                readonly
                                              <?php }else{?> href="<?php echo site_url('prepare/trainee_regis/Edit/'.@$value['trn_id'].'/'.@$value['trainee_id']);?>" <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                                                  <i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i>
                                              </a>

                                              &nbsp;
      <!--                                         <a data-toggle="modal" data-target="#prt<?php echo @$value['pid'];?>" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                  <i class="fa fa-file-text" aria-hidden="true" style="color: #000"></i>
                                              </a> -->
                                              <!-- Print Modal -->
                                              <div class="modal fade" id="prt<?php echo @$value['pid'];?>" role="dialog">
                                                <div class="modal-dialog">

                                                   <!-- Modal content-->
                                                  <div class="modal-content">
                                                    <div class="modal-header text-left">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                       <h4 class="modal-title" style="color: #333; font-size: 15px;">พิมพ์แบบฟอร์ม</h4>
                                                     </div>
                                                    <div class="modal-body">
                                                      <div class="row">
                                                        <?php
                                                        $tmp = $this->admin_model->getOnce_Application(7);
                                                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(7,get_session('user_id')); //Check User Permission
                                                        ?>
                                                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                        <?php
                                                        if(!isset($tmp1['perm_status'])) { ?>
                                                            class="disabled"
                                                        <?php
                                                          }else if($usrpm['app_id']==7) {
                                                        ?>
                                                            class="active"
                                                        <?php
                                                          }
                                                        ?>
                                                         >
                                                          <a style="color: #333; font-size: 15px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                                                          </a>
                                                        </div>

                                                        <?php
                                                        $tmp = $this->admin_model->getOnce_Application(8);
                                                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(8,get_session('user_id')); //Check User Permission
                                                        ?>
                                                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                        <?php
                                                        if(!isset($tmp1['perm_status'])) { ?>
                                                            class="disabled"
                                                        <?php
                                                          }else if($usrpm['app_id']==8) {
                                                        ?>
                                                            class="active"
                                                        <?php
                                                          }
                                                        ?>
                                                         >
                                                          <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                                                          </a>
                                                        </div>

                                                        <?php
                                                        $tmp = $this->admin_model->getOnce_Application(9);
                                                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(9,get_session('user_id')); //Check User Permission
                                                        ?>
                                                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                        <?php
                                                        if(!isset($tmp1['perm_status'])) { ?>
                                                            class="disabled"
                                                        <?php
                                                          }else if($usrpm['app_id']==9) {
                                                        ?>
                                                            class="active"
                                                        <?php
                                                          }
                                                        ?>
                                                         >
                                                          <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                                                          </a>
                                                        </div>

                                                        <?php
                                                        $tmp = $this->admin_model->getOnce_Application(10);
                                                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(10,get_session('user_id')); //Check User Permission
                                                        ?>
                                                        <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                        <?php
                                                        if(!isset($tmp1['perm_status'])) { ?>
                                                            class="disabled"
                                                        <?php
                                                          }else if($usrpm['app_id']==10) {
                                                        ?>
                                                            class="active"
                                                        <?php
                                                          }
                                                        ?>
                                                         >
                                                          <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
                                                          </a>
                                                        </div>

                                                       </div>
                                                       <br />

                                                    </div>
                                                  </div>

                                                </div>
                                               </div>
                                               <!-- End Print Modal -->

                                              &nbsp;
                                               <?php
                                                $tmp = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                if(isset($tmp['perm_status'])) {
                                                    if($tmp['perm_status']=='Yes') {
                                               ?>
                                                    <a data-subid=<?php echo @$value['trainee_id'];?> data-id=<?php echo @$value['trn_id'];?> onclick="opn(this)" title="ลบ" class="btn btn-default">
                                                      <span class="glyphicon glyphicon-trash" style="color: #000"></span>
                                                    </a>
                                                <?php }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                      <?php $number++; } ?>
                                      </tbody>
                                    </table>

                                  </div>
                                </div>
                            </div>
                          


                        </div>


                    </div>
                </div>
            </div>

<!-- Delete Modal -->
<div id="dltModel" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('034');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="dltbtnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->

<!-- Confirm Save Form  Modal -->
<div id="sbmCnfrm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 15px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('054');?>
        <p><?php echo $str;?></p>
        <!--<p>ยืนยันการลบ?</p>-->
      </div>
      <div class="modal-footer">
        <button id="savbtnYes" type="button" class="btn btn-success">ตกลง</button>
        <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Confirm Save Form  Modal -->

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

<!-- Print Modal -->
<div id="myPrint"  class="modal fade" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" style="color: #333; font-size: 15px;">พิมพ์แบบฟอร์ม</h4>
       </div>
      <div class="modal-body">
        <div class="row">
          <?php
          $tmp = $this->admin_model->getOnce_Application(7);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(7,get_session('user_id')); //Check User Permission
          ?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
              class="disabled"
          <?php
            }else if($usrpm['app_id']==7) {
          ?>
              class="active"
          <?php
            }
          ?>
           >
            <a style="color: #333; font-size: 15px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

          <?php
          $tmp = $this->admin_model->getOnce_Application(8);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(8,get_session('user_id')); //Check User Permission
          ?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
              class="disabled"
          <?php
            }else if($usrpm['app_id']==8) {
          ?>
              class="active"
          <?php
            }
          ?>
           >
            <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

          <?php
          $tmp = $this->admin_model->getOnce_Application(9);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(9,get_session('user_id')); //Check User Permission
          ?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
              class="disabled"
          <?php
            }else if($usrpm['app_id']==9) {
          ?>
              class="active"
          <?php
            }
          ?>
           >
            <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

          <?php
          $tmp = $this->admin_model->getOnce_Application(10);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(10,get_session('user_id')); //Check User Permission
          ?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
          if(!isset($tmp1['perm_status'])) { ?>
              class="disabled"
          <?php
            }else if($usrpm['app_id']==10) {
          ?>
              class="active"
          <?php
            }
          ?>
           >
            <a style="color: #333; font-size: 15px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

         </div>
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
