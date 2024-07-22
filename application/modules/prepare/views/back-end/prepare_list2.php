<h3 style="color: #4e5f4d"><?php echo $title;?></h3>
<hr/>

   <div class="row">
	   <div class="col-xs-12 col-sm-12 text-right">

          <?php
            $tmp = $this->admin_model->getOnce_Application(12);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(12,$user_id); //Check User Permission
          ?>
          <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else{?> href="<?php echo site_url('prepare/prepare_info');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="บันทึกแบบขึ้นทะเบียน<?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
              <i class="fa fa-plus" aria-hidden="true"></i>
          </a>

          <?php
            $tmp = $this->admin_model->getOnce_Application(48);
            $tmp1 = $this->admin_model->chkOnce_usrmPermiss(48,$user_id); //Check User Permission
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
   </div>

  <div class="table-responsive">

    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" >
      <thead style="color: #333; font-wight: bold; font-size: 15px; font-weight: bold;">
        <tr>
            <th>#</th>
            <th>เลขประจำตัวประชาชน</th>
            <th>ชื่อตัว-ชื่อสกุล </th>
            <th>อายุ (ปี)</th>
            <th>วันที่ขึ้นทะเบียน</th>
            <th>การอบรมดูแลผู้สูงอายุ</th>
            <th>พื้นที่ดำเนินการ</th>
            <th>&nbsp;</th>
        </tr>
			</thead>
      <tbody>
      <?php
      $number = 1;

      //samble Data
      $fnrl_info = array(
        array('pid'=>'3-1022-00615-69-1','prename_th'=>'นาง','name'=>'จำปี ป้องกันภัย','date_of_birth'=>'1990/01/01','date_of_req'=>'05/05/2560','date_of_adm'=>'ไม่เคย','date_of_dis'=>'เทศบาลตำบล.. จ.ลำปาง'),
        array('pid'=>'1235','prename_th'=>'','name'=>'','date_of_birth'=>'','date_of_req'=>'','date_of_adm'=>'','date_of_dis'=>''),
        array('pid'=>'1236','prename_th'=>'','name'=>'','date_of_birth'=>'','date_of_req'=>'','date_of_adm'=>'','date_of_dis'=>''),

      );

      foreach ($fnrl_info as $key => $value) {
      ?>
                <tr>
                    <td class="lnk"><?php echo $number;?></td>
                    <td class="lnk"><?php echo $value['pid'];?></td>
                    <td class="lnk"><?php echo $value['prename_th'].$value['name'];?></td>
                    <td class="lnk">
                    <?php
                    $age = '';
                    if($value['date_of_birth']!='') {
                      $date = new DateTime($value['date_of_birth']);
                      $now = new DateTime();
                      $interval = $now->diff($date);
                      $age = $interval->y;
                      echo $age;
                    }
                    ?>
                    </td>
                    <td class="lnk">
                      <?php
                      echo $value['date_of_req'];
                      /*
                        if($value['date_of_req']!='') {
                      ?>
                        <font class="text-sucsess" color="green"><b><?php echo dateChange($value['date_of_req'],5);?></b></font>
                      <?php
                        }
                        */
                      ?>
                    </td>
                    <td class="lnk">

                      <?php
                       echo '<font class="text-sucsess" color="#FF9800">'.$value['date_of_adm'].'</font>';
                      /*
                        if($value['date_of_adm']!='') {
                      ?>
                        <font class="text-sucsess" color="green"><b><?php echo dateChange($value['date_of_adm'],5);?></b></font>
                      <?php
                        }
                        */
                      ?>
                    </td>
                    <td class="lnk">
                      <?php
                      echo $value['date_of_dis'];
                      /*
                        if($value['date_of_dis']!='') {
                      ?>
                        <font class="text-sucsess" color="green"><b><?php echo dateChange($value['date_of_dis'],5);?></b></font>
                      <?php
                        }
                        */
                        ?>
                    </td>

                    <td align="right">

                  <?php
                    $tmp = $this->admin_model->getOnce_Application(3);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                  ?>
                  <a <?php if(!isset($tmp1['perm_status'])) {?>
                    readonly
                  <?php }else{?> href="<?php echo site_url('difficult/sufferer_form1/Edit/'.@$value['diff_id']);?>" <?php }?> title="<?php if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>" class="btn btn-default">
                      <i class="fa fa-pencil-square" aria-hidden="true" style="color: #000"></i>
                  </a>

                  &nbsp;
                  <a data-toggle="modal" data-target="#prt<?php echo $value['pid'];?>" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                      <i class="fa fa-file-text" aria-hidden="true" style="color: #000"></i>
                  </a>
                  <!-- Print Modal -->
                  <div class="modal fade" id="prt<?php echo $value['pid'];?>" role="dialog">
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
                        <button data-id=<?php echo @$value['diff_id'];?> onclick="opn(this)" title="ลบ" type="button" class="btn btn-default">
                          <span class="glyphicon glyphicon-trash" style="color: #000"></span>
                        </button>
                    <?php }
                    }
                    ?>

                      <!-- Info Modal -->
                      <div class="modal fade" id="<?php echo $value['pid'];?>" role="dialog">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                           <div class="modal-header" style="background-color: #eee">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h3 class="modal-title text-left"><?php echo $value['prename_th'].$value['name'];?></h3>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-xs-12 col-sm-3">
                                  <img src="<?php echo path(get_session('user_photo_file'),'member');?>" class="img-responsive">
                                </div>
                                <div class="col-xs-12 col-sm-9">
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>เลขประจำตัวประชาชน</h4></div><div class="col-xs-12 col-sm-3"><?php echo $value['pid'];?></div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>วันเดือนปีเกิด</h4></div><div class="col-xs-12 col-sm-6">18 มี.ค. 2496 (เสียชีวิต 11 มี.ค. 2560) (อายุ <?php echo $age;?> ปี)</div>
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><b>เพศ</b> ชาย</div>
                                    <div class="col-xs-12 col-sm-3"><b>สัญชาติ</b> ไทย</div>
                                    <div class="col-xs-12 col-sm-3"><b>ศาสนา</b> อิสลาม</div>
                                  </div>
                                  <div class="row">
                                  &nbsp;
                                  </div>
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-3"><h4>ที่อยู่ตามทะเบียนบ้าน</h4></div><div class="col-xs-12 col-sm-5"> 124 ถนน รามคำแหง 58/3 แขวง หัวหมาก เขต ปางกะปิ กรุงเทพมหานคร 10240 </div>
                                  </div><br>

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Info Modal -->

                    </td>
                </tr>
      <?php
        $number++;
      }
      ?>
      </tbody>
		</table>

  </div>

<!-- Trigger the modal with a button -->
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

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
        <button id="btnYes" type="button" class="btn btn-danger">ตกลง</button>
        <button style="margin-bottom: 5px;" type="button" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
<!-- End Delete Model -->

<!-- Search Modal -->
<div class="modal fade" id="mySearch" role="dialog">
  <div class="modal-dialog">

     <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title" style="color: #333; font-size: 15px;">ค้นหา</h4>
       </div>
      <div class="modal-body">
        <label for="email">เลขประจำตัวประชาชน:</label>
         <input type="email" class="form-control" id="email">

         <label for="email">ชื่อตัว-ชื่อสกุล:</label>
         <input type="email" class="form-control" id="email">

          <label for="email">การแจ้งเรื่อง:</label>
         <input type="email" class="form-control" id="email">
      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-search" aria-hidden="true"></i> ตกลง</button>
       </div>
    </div>

  </div>
 </div>
 <!-- End Search Modal -->
