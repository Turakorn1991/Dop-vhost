 <script type="text/javascript">
    var adm_id = <?php echo $adm_id; ?>
 </script>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(13);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(13,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/inform1/Edit/'.@$adm_info['adm_id']);?>" <?php }?> <?php if($usrpm['app_id']==13){?>aria-expanded="true" <?php }?>> (1) แจ้งความประสงค์</a>
                            </li>
                            <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(14);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(14,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/admission2/Edit/'.@$adm_info['adm_id']);?>" <?php }?>  <?php if($usrpm['app_id']==14){?>aria-expanded="true" <?php }?>>(2) รับเข้า/จำหน่าย</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(15);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                              ?>
                                <a <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('welfare/estimate3/Edit/'.@$adm_info['pers_id']);?>" <?php }?>  data-toggle="tab" href="#tab-3" <?php if($usrpm['app_id']==5){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) ประเมินสมรรถภาพ</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-1</strong>
                                </div>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==4){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                  <strong>Tab-2</strong>
                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==15){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                    <!--
                                    <div class="row">
                                        <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                            <h2 style="color: #4e5f4d"></h2>
                                            <div class="col-lg-12 text-right  border-bottom">

                                                  <a data-toggle="modal" data-target="#myPrint" style="color: #000; padding-left: 20px; padding-right: 20px;" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                                                      <i class="fa fa-file-text" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(15);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                                  ?>
                                                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('welfare/inform4/Add/'.$adm_id);?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกแบบประเมินสมรรถภาพรายบุคคลและการฟื้นฟู" class="btn btn-default">
                                                      <i class="fa fa-plus" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(15);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                                  ?>
                                                  <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }else{?> href="<?php echo site_url('welfare/welfare_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                      <i class="fa fa-undo" aria-hidden="true"></i>
                                                  </a>

                                                  &nbsp;
                                                  <?php
                                                    $tmp = $this->admin_model->getOnce_Application(15);
                                                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                                  ?>
                                                  <a data-id=111 onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
                                                    readonly
                                                  <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ลบข้อมูล" class="btn btn-default">
                                                      <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                                                  </a>

                                            </div>
                                        </div>
                                    </div>
                                    -->

                                         <div id="tmp_menu" hidden='hidden'>

                                          <!--
                                          <a title="พิมพ์แบบฟอร์ม" data-toggle="modal" data-target="#myPrint" class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="" data-toggle="modal" data-target="#mySearch">
                                          <i class="fa fa-file-text" aria-hidden="true"></i> </a>
                                          -->


                                        <?php
                                          $tmp = $this->admin_model->getOnce_Application(15);
                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                        ?>

                                        <!--
                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;"  data-id=111 onclick="opn(this)" title="ลบ">
                                        <i class="fa fa-trash" aria-hidden="true"></i> </a>





                                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                        -->
                                    </div>
                                    <script>
                                      setTimeout(function(){
                                        $("#menu_topright").html($("#tmp_menu").html());
                                      },300);

                                      $("#guide-book").click(function(){
                                        window.open('/assets/modules/welfare/guide/Adm_Manual.pdf', '_blank');
                                      });
                                    </script>

                                    <div class="table-responsive">

                                      <?php
                                      $tmp = $this->admin_model->getOnce_Application(15);
                                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                            ?>
                                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px; float: right;"
                                            <?php if(!isset($tmp1['perm_status'])) {?>
                                            readonly
                                            <?php }else{?> href="<?php echo site_url('welfare/inform4/Add/'.$adm_id);?>"
                                            <?php }?> title="บันทึก<?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                            <i class="fa fa-plus" aria-hidden="true"></i>
                                          </a>

                                      <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                        <thead style="font-size: 15px;">
                                          <tr>
                                              <th style="width:2% !important;" class="text-center">#</th>
                                              <th style="width:10% !important;" class="text-center">วัน เดือน ปีที่ประเมิน</th>
                                              <th class="text-center">เจ้าหน้าที่ผู้ประเมิน</th>
                                              <th class="text-center">พยาบาล<br>(เจ้าหน้าที่ปฏิบัติหน้าที่แทน)</th>
                                              <th class="text-center">นักสังคมสงเคราะห์<br>(เจ้าหน้าที่ปฏิบัติหน้าที่แทน)</th>
                                              <th style="width:10% !important;" class="text-center">ผลการประเมิน</th> 
                                              <th style="width:1% !important;">&nbsp;</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          
                                          <?php foreach ($irp_info as $i => $row) { ?>
                                            <?php $irp_result = $this->welfare_model->get_Percentage($row['irp_id']);?>
                                            <tr>
                                               <!--#-->
                                               <td class="lnk text-center"><?php echo $i+1; ?></td>

                                               <!--date of irp-->
                                               <td class="lnk text-center">
                                                <?php if($row['date_of_irp']!='' && $row['date_of_irp'] != '0000-00-00') { ?>
                                                  <font class="text-sucsess" color="#18bd15"><?php echo dateChange($row['date_of_irp'],5);?></font>
                                                <?php } ?>
                                                </td>

                                                <!--name of irp-->
                                               <td class="lnk"><?php echo $row['irp_name']; ?></td>

                                               <!--name of nurse-->
                                               <td class="lnk"><?php echo $row['nurse_name']; ?></td>

                                               <!--name of almoner-->
                                               <td class="lnk"><?php echo $row['almoner_name']; ?></td>

                                               <td>
                                                <?php $scroe = round($irp_result['ans_percent'],2); ?>
                                                <div class="progress" style="background-color: rgba(96, 125, 139, 0.34);margin-bottom: 0px !important;">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $scroe; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $scroe."%"; ?>; <?php if($scroe<=30){ echo "background-color: #F44336 !important;"; }else if($scroe<=60){ echo "background-color: #ffc107 !important;"; }else{ echo "background-color: #4caf50 !important;";  } ?> ">
                                                    <?php echo $scroe."%"; ?>

                                                  </div>
                                                </div>

                                               </td>


                                               <!-- <td><?php //echo "{$irp_result['ans_points']} จาก {$irp_result['ans_full_score']}"; ?></td> -->
                                               <!-- <td><?php
                                                 // $countTrm = $this->db->where('irp_id',$row['irp_id'])->count_all_results('adm_trm_result');
                                                  //if($countTrm == 0){ echo " - "; }else{ echo $countTrm; }
                                               ?></td> -->
                                               <td align="center">

                                                  <!-- Single button -->
                                                  <div class="btn-group" style="cursor: pointer;">
                                                    <i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>
                                                    <ul class="dropdown-menu" style="position: absolute;left: -150px;">
                                                       <li>
                                                        <?php
                                                        $tmp = $this->admin_model->getOnce_Application(15);
                                                          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                                          ?>
                                                          <a style="font-size: 16px;"<?php if(!isset($tmp1['perm_status'])) {?>
                                                            readonly
                                                            <?php }else{?> href="<?php echo site_url("welfare/inform4/Edit/{$adm_id}/{$row['irp_id']}");?>" <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                                            <i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ
                                                          </a>
                                                       </li>
                                                      <?php
                                                       $tmp = $this->admin_model->chkOnce_usrmPermiss(15,$user_id); //Check User Permission
                                                       if(isset($tmp['perm_status'])) {
                                                       if($tmp['perm_status']=='Yes') {
                                                        ?>
                                                       <li><a style="font-size:16px;" data-id='<?php echo $row['irp_id']; ?>' onclick="opn(this)" title="ลบ" >
                                                         <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                                                       </a></li>
                                                       <?php
                                                         }
                                                        }
                                                        ?>
                                                    </ul>
                                                  </div>

                                             </td>
                                           </tr>
                                          <?php } ?>
                                        </tbody>
                                      </table>
                                    </div><!-- close table-responsive-->
                                    <hr style="margin-top: 0px;">
                                       <div class="row">
                                        <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                        <div class="col-xs-12 col-sm-2">
                                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-save" onclick="window.location.href='<?php echo site_url('welfare/welfare_list');?>'"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                        </div>
                                         <div class="col-xs-12 col-sm-2">
                                         <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-md btn-cancel" onclick="window.location.href='<?php echo site_url('welfare/admission2/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                                         </div>
                                       </div>
                                </div><!-- close panel-body-->
                            </div><!-- close tab-3-->
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
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
<div id="dltCnfrm" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
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
<div class="modal fade" id="myPrint" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" style="color: #333; font-size: 20px;">พิมพ์แบบฟอร์ม</h4>
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
            <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
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
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4');?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if(isset($tmp1['perm_status'])) {echo $tmp1['app_name']; }?>
            </a>
          </div>

         </div>
         <br/>

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->
