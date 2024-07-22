<?php $schl_id_original = $schl_id; ?>
<?php
$schl_id = '';

//if($process_action=='Add'){$process_action = 'Added';}

if($process_action=='Edit'){$process_action = 'Edited'; @$schl_id = '/'.$schl_id_original;}

//echo form_open_multipart('school/photo2/'.$process_action.$schl_id,array('id'=>'form1'));

//echo form_open_multipart('school/photo2/'.$process_action.$schl_id);

//<!=== show image : start code === -->

echo form_open_multipart('school/generation3/'.$process_action.$schl_id,array('id'=>'form1'));
                                    
/*                                  echo form_upload(['name'=>'userfile','value'=>'Save']);

echo form_error('userfile', '<div class="text-danger">', '</div>');

echo form_submit(['name'=>'submit', 'value'=>'PUBLISH IMAGE']); */

//echo anchor("welcome/viewImages", 'View Images'); 

//<!-- === show image : end code === -->

?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                           <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(59);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/school1/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==59){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (1) โรงเรียน</a>
                            </li>
                            <li >
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(60);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(60,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/photo2/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==60){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <li class="active">
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(61);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(61,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/generation3/Edit/'.$schl_id);?>" <?php }?> data-toggle="tab"  <?php if($usrpm['app_id']==61){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                           <li>
                              <?php
                                $tmp = $this->admin_model->getOnce_Application(174);
                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(174,$user_id); //Check User Permission
                              ?>
                                <a  <?php if(!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php }else{?> href="<?php echo site_url('school/school_model/Edit/'.$schl_id);?>" <?php }?>  <?php if($usrpm['app_id']==174){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> (4) แบบประเมินโรงเรียน</a>
                            </li>
                        </ul>



                        <div class="tab-content"><!--tab-content-->
                            <div id="tab-1" <?php if($usrpm['app_id']==3){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <strong>Tab-1</strong>
                            </div>

                            <div id="tab-2" <?php if($usrpm['app_id']==60){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                                <div class="panel-body">

                                </div>
                            </div>

                            <div id="tab-3" <?php if($usrpm['app_id']==61){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
                              <div class="panel-body">

                                <div class="form-group row" style="margin-bottom:0px !important;">

                                    <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                  <!--1-->
                                  <div class="panel-group" style="margin-bottom:0px !important;">
                                    <!--2-->
                                    <div class="panel panel-default" style="border: 0">

                                      <div class="panel-heading">
                                        <h4>รุ่นและหลักสูตร</h4>
                                      </div>
                                
                                      <div class="panel-body" style="border:0; padding: 20px;">

                                        
                                    
                                        <!-- === Add Album Button opal : start code === -->

                                        <div class="form-group row" style="margin-bottom:0px !important;"><!-- remove space bottom opal -->
                                          <div class="col-xs-12 col-sm-12">

                                            <div class="col-xs-12 col-sm-9 has-error">
                                              <label for="" class="col-2 col-form-label" style="color: red;">ชื่อโรงเรียน </label>
                                              <input type="text" class="form-control" name="schl_info[schl_name]" title="ชื่อโรงเรียน" value="<?php echo $schl_info['schl_name']; ?>" placeholder="ระบุชื่อโรงเรียน" disabled>
                                            </div>
                                            <div class="col-xs-12 col-sm-3">
                                                <br />
                                                

                                            </div>


                                          </div><!-- close div  class="col-xs-12 col-sm-12"-->
                                        </div><!-- close div class="form-group row"-->


                                        <br>
                                        <!-- === Add Album Button opal : end code === -->

                                        <!-- === show image : start code === -->
                                        <div class="form-group row" style="margin-bottom:0px !important;"><!-- remove space bottom opal -->
                                          <div class="col-xs-12 col-sm-12" style="padding-left: 30px; padding-right: 30px;">

                                            <!--
                                            <div class="row">
                                                <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                                                    <h2 style="color: #4e5f4d"></h2>
                                                    <div class="col-lg-12 text-right  border-bottom">

                                                          &nbsp;
                                                          <?php
                                                            $tmp = $this->admin_model->getOnce_Application(3);
                                                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                                                          ?>
                                                          <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                                                            readonly
                                                          <?php }else{?> href="<?php echo site_url('school/school_list/Edit/'.$schl_id);?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                                                              <i class="fa fa-undo" aria-hidden="true"></i>
                                                          </a>

                                                          &nbsp;
                                                          <?php
                                                            $tmp = $this->admin_model->getOnce_Application(61);
                                                            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(61,$user_id); //Check User Permission
                                                          ?>
                                                          <a <?php if(!isset($tmp1['perm_status'])) {?>
                                                            readonly
                                                          <?php }else{?> href="<?php echo site_url('school/generation_detail/Add/'.$schl_id);?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="รุ่นและหลักสูตรการเรียน" class="btn btn-default">
                                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                                          </a>

                                                    </div>
                                                </div>
                                            </div>
                                            -->


                                            <div id="tmp_menu" hidden='hidden'>

                                                  <!--
                                                  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module');?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                                  -->
                                            </div><!-- close <div id="tmp_menu" -->


                                            <script>
                                              setTimeout(function(){
                                                $("#menu_topright").html($("#tmp_menu").html());
                                              },300);
                                            </script>


                                            <div style="float: right;">
                                              <?php
                                                $tmp = $this->admin_model->getOnce_Application(59);
                                                $tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
                                              ?>
                                              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                              <?php if(!isset($tmp1['perm_status'])) {?>
                                                      readonly
                                                    <?php }else{?> href="<?php echo site_url('school/generation_detail/Add/'.$schl_id);?>"
                                              <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                              </a>
                                            </div><!-- close <div style="float: right;"> -->



                                            <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                            
                                              <thead style="font-size: 15px;">
                                                <tr>
                                                    <th style="width:5% !important;" class="text-center">รุ่นที่</th>
                                                    <th style="width:10% !important;" class="text-center">ปี (พ.ศ.)</th>
                                                    <th style="width:15% !important;" class="text-center">สถานะ</th>
                                                    <th style="" class="text-center">หลักสูตร</th>
                                                    <th style="width:10% !important;" class="text-center">วันที่เริ่มรุ่น</th>
                                                    <th style="width:10% !important;" class="text-center">วันที่สิ้นสุดรุ่น</th>
                                                    <th style="width:10% !important;" class="text-center">จำนวนนักเรียน</th>
                                                    <th style="width:5% !important;" class="text-center"></th>
                                                    <!-- <th style="width:1% !important;" class="text-center">&nbsp;</th> -->
                                                </tr>
                                              </thead>

                                              <tbody>
  <!--                                                 <tr>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">2559</td>
                                                    <td class="text-center">สำเร็จการศึกษา</td>
                                                    <td class="text-left">การพัฒนาทักษะด้านเกษตรกรรม</td>
                                                    <td class="text-center">1 มิ.ย. 2559</td>
                                                    <td class="text-center">31 ส.ค. 2559</td>
                                                    <td class="text-center">30</td>
                                                  </tr> -->
                                                <?php $schl_edu_gen_summary = $this->common_model->query("SELECT * FROM schl_edu_generation where schl_id = {$schl_id_original} and insert_datetime not like '' and insert_datetime is not null and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00') order by gen_code ASC, first_date_of_edu ASC;")->result_array(); 
                                                
                                                //$number = 1;

                                                foreach ($schl_edu_gen_summary as $gen_sum_result) { 
                                                
                                                  $first_date_of_edu = $gen_sum_result['first_date_of_edu'];
                                                  $first_date = date('Y-m-d',strtotime($first_date_of_edu));

                                                  $last_date_of_edu = $gen_sum_result['last_date_of_edu'];
                                                  $last_date = date('Y-m-d',strtotime($last_date_of_edu));

                                                  $year_of_edu = 543+substr($first_date_of_edu,0,4);

                                                  $crse_info = $this->common_model->query("SELECT * FROM std_schl_edu_course where crse_code = {$gen_sum_result['crse_code']} order by crse_id ASC, crse_code ASC;")->result_array();
                                                
                                                  $gen_id = $gen_sum_result['gen_id'];
                                                ?>
                                                                                                     
                                                
                                                  <tr>
                                                    <!-- <td class="text-center"><?php echo $number; ?></td><?php $number++; ?> -->
                                                    <td class="text-center"><?php echo $gen_sum_result['gen_code']; ?></td>
                                                    <td class="text-center"><?php echo $year_of_edu; ?></td>
                                                    <td class="text-center"><?php echo $gen_sum_result['gen_status']; ?></td>
                                                    <td class="text-left"><?php echo $crse_info[0]['crse_title']; ?></td>
                                                    <td class="text-center"><?php echo formatDateThai1($first_date); ?></td>
                                                    <td class="text-center"><?php echo formatDateThai1($last_date); ?></td>
                                                    <td class="text-center">28</td>
                                                    <td align="center">

                                                      <div class="btn-group" style="cursor: pointer;">
                                                          <i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>
                                                          <ul class="dropdown-menu" style="position: absolute;left: -210px;">

                                                              <li onclick="modalViewGen(this)" data-id="<?php echo $schl_id_original;?>" data-genid="<?php echo $gen_id;?>">
                                                                  <a style="font-size:16px;" > <!-- readonly -->
                                                                    <i class="fa fa-pencil" aria-hidden="true" style="color: #000" ></i> แก้ไขรายการ
                                                                  </a>
                                                              </li>

                                                              <li>
                                                                  <a style="font-size:16px;" data-id=<?php echo $schl['schl_id']; ?> onclick="opn(this)" title="ลบ"  >
                                                                    <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                                                                  </a>
                                                              </li>

                                                          </ul>
                                                      </div>


                                                            

                                                          <!-- Print Modal -->
                                                      <div class="modal fade" id="prt<?php echo $schl['schl_id']; ?>" role="dialog">
                                                          <div class="modal-dialog">

                                                              <!-- Modal content-->
                                                              <div class="modal-content">
                                                                  <div class="modal-header text-left">
                                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                      <h4 class="modal-title" style="color: #333; font-size: 16px;">พิมพ์แบบฟอร์ม</h4>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                      <div class="row ">
                                                                        <!--
                                                                        <?php
                                                                        $tmp  = $this->admin_model->getOnce_Application(150); //แก้ไข permission จาก 49 เป็น 150 = 'ส่งออกไฟล์ ประกาศนียบัตรการเป็นผู้นำบริหารโรงเรียน (G7) (PDF)' ของ parent 57 โรงเรียน ผส
                                                                        $tmp1 = $this->admin_model->chkOnce_usrmPermiss(150, get_session('user_id')); //Check User Permission
                                                                        ?>
                                                                                                              <div class="col-xs-12 col-sm-12 text-left" style="margin-bottom: 10px;"
                                                                                                              <?php
                                                                                  if (!isset($tmp1['perm_status'])) {?>
                                                                                                              class="disabled"
                                                                                                              <?php
                                                                                } else if ($usrpm['app_id'] == 150) {
                                                                                        ?>
                                                                                                              class="active"
                                                                                                              <?php
                                                                                }
                                                                                    ?>
                                                                        >
                                                                        -->
                                                                          <div class="col-xs-12 col-sm-12 text-left">
                                                                              <a style="color: #333; font-size: 16px;" target="_blank"
                                                                              href="<?php echo site_url('report/G7/pdf?id='.$schl['schl_id']); ?>"><i class="fa fa-print"
                                                                              aria-hidden="true"></i> ส่งออกไฟล์ ประกาศนียบัตรการเป็นผู้นำบริหารโรงเรียน (G7) (PDF)
                                                                              <!--<?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>-->
                                                                              </a>
                                                                          </div>
                                                                      </div>
                                                                  </div>

                                                              </div>
                                                              <br />

                                                          </div>
                                                      </div>

                                                      <!-- End Print Modal -->
                                                      </td>
                                                  </tr>

                                                <?php 
                                                }
                                                ?>
                                              </tbody>

                                            </table><!-- close <table id="dtable" -->
                                          
                                          </div><!-- <div class="col-xs-12 col-sm-12"> -->
                                        </div><!-- close form-group row-->
                                        <!-- === show image : end code === -->

                                        <hr>

                                        <div class="row">
                                          <div class="col-xs-12 col-sm-10">&nbsp;</div>
                                          <div class="col-xs-12 col-sm-2">
                                            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/photo2/Edit/'.$this->uri->segment('4'));?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                          </div>
                                        </div><!-- close <div class="row"> -->


                                      </div><!-- close <div class="panel-body"> --->
                                    </div><!-- end 2-->
                                  </div><!-- end 1-->
                                <div><!--close <div class="form-group row"-->
                              </div><!-- close <div class="panel-body"> --->

                            </div><!-- close tab-3 --->
                    

                    
                    </div><!-- close <div class="tabs-container"> -->
                </div><!-- close <div class="col-lg-12"> -->
            </div><!-- close <div class="row"> -->

<!-- Delete Modal -->
<div id="dltModel<?php echo $value['gen_id']; ?>" class="modal fade" role="dialog">
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
        <a href="<?php echo base_url('school/generation3/Delete/'.$value['schl_id'].'/'.$value['gen_id']); ?>"><button  type="button" class="btn btn-danger">ตกลง</button></a>
        <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->

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
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
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
        <!-- <button id="savbtnYes" type="button" class="btn btn-success">ตกลง</button> -->
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
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->

<!-- Start Add Code -->
    <!-- start opal modal -->

        <!-- start view image -->

            <!-- View all Photos in this Album Modal -->
            <div id="mdViewAlbum" class="modal fade" id="modal fade" role="dialog" style="margin-left:17px;">
            <!-- <div id="mdViewAlbum" class="modal fade" role="dialog" style="width:90vw; height:80vh; margin-left:5vw; margin-top:10vh; overflow-y: hidden;"> --><!-- modal-fade-in --> <!-- 1 -->
              <div class="modal-dialog-photoalbum"> <!-- modal-dialog --><!-- 2 -->
                
                <!-- Modal content-->
                <div class="modal-content"><!-- 3 -->

                  <div class="modal-header"><!-- 4 -->
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div id="viewAlbum-title-container">

                        <!-- START หัวข้อ -->
                        <div class="panel-heading">
                          <h4>รายละเอียดรุ่น</h4>
                        </div>
                        <!-- END หัวข้อ -->

                    </div><!--หน้าต่างภาพทั้งหมดในอัลบั้มนี้-->
                  </div><!-- class="modal-header" --><!-- 4 -->

                  <div class="modal-body" style="overflow-y: auto; height: 60vh;"><!-- 5 -->
                    
                  <!-- <p>OPAL TEST MODAL</p> -->
                    <!-- <input type="text" name="albumid" id="albumid" value=""/> -->
                    <!-- <h1><?php echo $_GET['albumid'];?></h1> -->

                                              <!-- === show image : start code === -->
                                              <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                                                <div id="viewAlbum-container" class="col-xs-12 col-sm-12" style="font-size: 13px;">
                                                                                          
                                                  <!-- START กรอกรายละเอียดรุ่นและหลักสูตร -->
                                                  <form id="formAddAlbum" method="post" action="<?php echo base_url();?>school/photo2/Added/<?php echo $schl_id_original; ?>">
                                                      <div class="form-group row" style="padding-left: 15px; padding-right: 15px;">
                                                          <div class="col-xs-12 col-sm-1 has-error" >
                                                              <input type="hidden" name="schl_gen[schl_id]" value="<?php echo $schl_gen['schl_id']; ?>">
                                                              <label for="" class="col-2 col-form-label" style="color: red;">รุ่นที่ </label>
                                                              <input type="number" min="1" placeholder="รุ่น" class="form-control" name="schl_gen[gen_code]" value="<?php echo $schl_gen['gen_code'];?>" title="" required>
                                                          </div>

                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label" style="color: red;">วันที่เริ่ม</label>
                                                            <!--   <select  class="form-control" name="schl_gen[year_of_study]"  title="ปีที่เปิดเรียน">
                                                                  <option value="">เลือกปี พ.ศ.</option>
                                                                  <?php
                                                                    $year = date("Y");
                                                                    for($yearTh = ($year-100);$yearTh<=$year;$yearTh++){
                                                                    ?>
                                                                    <option value="<?php echo $yearTh; ?>" <?php if($schl_gen['year_of_study']==$yearTh){ echo "selected"; } ?> ><?php echo ($yearTh+543);?></option>
                                                                    <?php } ?>
                                                              </select> -->
                                                              <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                                  <input title="วันที่แจ้งเรื่อง" placeholder="เลือกวันที่" class="form-control" type="text" name="schl_gen[first_date_of_edu]" required />
                                                                  <span class="input-group-addon" style=""><i class="glyphicon glyphicon-calendar"></i></span>
                                                              </div>

                                                              <script type="text/javascript">
                                                                  $(function () {
                                                                      $("#datetimepicker1").datepicker({
                                                                          autoclose: true,
                                                                          todayHighlight: true
                                                                      }).datepicker('update', new Date(Date.UTC(2017,08-1,16)));;
                                                                  });
                                                              </script>
                                                          </div>

                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label" style="color: red;">วันที่จบ</label>

                                                              <div id="datetimepicker2" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                                                                  <input title="วันที่แจ้งเรื่อง" placeholder="เลือกวันที่" class="form-control" type="text" name="schl_gen[last_date_of_edu]" required>
                                                                  <span class="input-group-addon" style=""><i class="glyphicon glyphicon-calendar"></i></span>
                                                              </div>

                                                              <script type="text/javascript">
                                                                  $(function () {
                                                                    $("#datetimepicker2").datepicker({
                                                                      autoclose: true,
                                                                      todayHighlight: true
                                                                    }).datepicker('update', new Date(Date.UTC(2017,08-1,16)));;
                                                                  });
                                                              </script>

                                                              <!-- <input id="gen_status" name="schl_gen[gen_status]" type="hidden" value="เปิด" checked> --><!-- เปิด/ปิดการศึกษา -->
                                                          </div>

                                                          <div class="col-xs-12 col-sm-1">
                                                              <label for="" class="col-2 col-form-label">วัน/สัปดาห์</label>
                                                              <input type="number" min="1" placeholder="วัน" name="schl_gen[hours_per_week]" class="form-control">
                                                          </div>

                                                          <div class="col-xs-12 col-sm-1">
                                                              <label for="" class="col-2 col-form-label">ชม./สัปดาห์</label>
                                                              <input type="number" min="1" placeholder="ชม." name="schl_gen[days_per_week]" class="form-control">
                                                          </div>

                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">หลักสูตร</label>
                                                              <br>
                                                              <select style=""  name="schl_gen[crse_code]"  placeholder="เลือก หลักสูตร" class="form-control elder_addr_pre" id="">
                                                                  <option value="" selected="">เลือก หลักสูตร</option>                            
                                                                  <option value="">หลักสูตรพัฒนาทักษะด้านเกษตรกรรม</option>
                                                                  <option value="">หลักสูตรพัฒนาทักษะด้านหัตถกรรม</option>
                                                                  <option value="">หลักสูตรพัฒนาทักษะด้านการปรุงอาหาร</option>
                                                              </select>
                                                          </div>

                                                      </div>

                                                      <div class="form-group row" style="padding-left: 15px; padding-right: 15px;">

                                                          <div class="col-xs-12 col-sm-3">
                                                              <label for="" class="col-2 col-form-label">ตารางเรียน</label> <!-- name="schl_gen[crse_att_file]" -->
                                                              <div class="fileinput fileinput-new input-group" data-provides="fileinput">

                                                                  <div id="parent_0">


                                                                  </div> <!-- close <div id="parent_0"> -->

                                                              </div>
                                                          </div>

                                                      </div>
                                                  </form>       
                                                  <!-- END กรอกรายละเอียดรุ่นและหลักสูตร -->

                                                </div>
                                              </div><!-- close form-group row-->
                                              <!-- === show image : end code === -->

                                              <hr style="border-top: 3px solid #eee !important;">  
                                          
                                              <!-- === upload image : start code === -->
                                              <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                                                <div class="col-xs-12 col-sm-12">
                                                <div id="parent_0">
                                                                                          
                                                              <div class="col-xs-12 col-sm-4 col-lg-3 element"   style="margin-top: 20px; height:300px; word-wrap: break-word; font-size: 13px;">



                                                              </div>  <!-- close div element -->
                                                </div>
                                                </div>
                                                <?php
                                                echo form_close();
                                                ?>
                                              </div><!-- close form-group row-->

                                              <hr style="margin-top: 0px; width: 90%; margin-left: 5%;">

                                              <div class="row">
                                                <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                                <div class="col-xs-12 col-sm-2">
                                                  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save btn-confirmupload" onclick="return opnCnfrom()"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                                                </div>
                                                <div class="col-xs-12 col-sm-2">
                                                <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" data-dismiss="modal"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button> <!--  onclick="window.location.href='<?php //echo site_url('school/school_list');?>'" -->
                                                </div>
                                              </div><!-- close class row-->

                                              <!-- === upload image : end code === -->
                  
                  </div><!-- class="modal-body" --><!-- 5 -->

                    <!--<p>ยืนยันการลบ?</p>-->
                  <div class="modal-footer"><!-- 6 -->
                    <!-- <button id="dltOpalYes" type="button" class="btn btn-danger">ตกลง</button>
                    <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button> -->
                    <div class="row">
    <!--                   <div class="col-xs-12 col-sm-8">&nbsp;</div>
                      <div class="col-xs-12 col-sm-2"> -->
                        <!--<input type="submit" name="submit" value="PUBLISH IMAGE">-->

    <!--                     <button disabled='disabled' style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save btn-confirmupload" onclick="return opnCnfrom()"> <i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                      </div>
                      <div class="col-xs-12 col-sm-2">
                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/school_list');?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                      </div> -->
                    </div><!-- close class row-->
                  </div><!-- class="modal-footer" --><!-- 6 -->

                </div><!-- class="modal-content" --><!-- 3 -->
              </div><!-- div class="" --><!-- 2 -->
            </div><!-- div id="dltOpal" --><!-- 1 -->
            <!-- End View all Photos in this Album Modal -->

        <!-- Confirm Save Form  Modal -->
        <div id="sbmCnfrm" class="modal fade" role="dialog">
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
                <button id="savbtnYes" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                <button type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Confirm Save Form  Modal -->

    <!-- end view image -->
<!-- End opal modal -->



<!-- Start Add Script -->
    <script>


    </script>
<!-- End Add Code -->