
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                    <ul class="nav nav-tabs">
                            <li>
                              <?php
$tmp = $this->admin_model->getOnce_Application(171);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(171, $user_id); //Check User Permission
?>
                                <a  <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonlys
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/center_info/Edit/' . $center_info['qlc_id']); ?>" <?php }?>  <?php if ($usrpm['app_id'] == 3) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>> (1) ศพอส.</a>
                            </li>
                            <li class="active">
                              <?php
$tmp = $this->admin_model->getOnce_Application(172);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(172, $user_id); //Check User Permission
?>
                                <a <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/center_kpi/Edit/' . $center_info['qlc_id']); ?>" <?php }?>  data-toggle="tab" <?php if ($usrpm['app_id'] == 4) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>>(2) มาตรฐานตัวชี้วัด</a>
                            </li>
                            <li>
                              <?php
$tmp = $this->admin_model->getOnce_Application(173);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(173, $user_id); //Check User Permission
?>
                                <a  <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/center_activity/Edit/' . $center_info['qlc_id']); ?>" <?php }?>  <?php if ($usrpm['app_id'] == 5) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>>(3) ผลการดำเนินกิจกรรม</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if ($usrpm['app_id'] == 169) {?>class="tab-pane active" <?php } else {?> class="tab-pane"<?php }?>> <!--163,169แสดงเนื้อหาแบบขึ้นทะเบียน ศพอส-->
                                <div class="panel-body">


                                          <script>
                                            setTimeout(function(){
                                              $("#menu_topright").html($("#tmp_menu").html());
                                            },300);

                                            $("#guide-book").click(function(){
                                              window.open('/assets/modules/school/guide/Center_Manual.pdf', '_blank');
                                            }); 
                                          </script>

                                     <div class="family_members_template" hidden='hidden'>
                                            <div class="panel-group family_members_items" style="margin-top: -10px;">
                                              <div class="panel panel-default" style="border: 0">
                                                <div class="panel-heading clear-fix" style="background-color: initial;">
                                                </div>
                                                  <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                                    <div class="row text-right">

                                                    <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this,'')" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>

                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-xs-12 col-sm-6">
                                                            <label for="" class="col-2 col-form-label">ผู้ประสานงาน</label>
                                                            <input title="ผู้ประสานงาน" placeholder="(คำนำหน้า) ชื่อ-นามสกุล" name="schl_contacts[sch_cnt_name][myID]" class="form-control" type="text"/>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-3 ">
                                                            <label for="example-text-input" class="col-2 col-form-label">ตำแหน่ง</label>
                                                            <input title="ตำแหน่ง" placeholder="ระบุตำแหน่ง" name="schl_contacts[sch_cnt_title][myID]" class="form-control" type="text"/>

                                                        </div>

                                                        <div class="col-xs-12 col-sm-3">
                                                            <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                                                            <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXX" name="schl_contacts[tel_no_mobile][myID]" class="form-control" type="text"/>
                                                        </div>
                                                      </div>

                                                  </div>
                                              </div>
                                            </div>
                                          </div><!-- close family_members_template-->

                                    <div class="form-group row">

                                    <?php
$qlc_id = '';

//if($process_action=='Add'){$process_action = 'Added';}

if ($process_action == 'Edit') {$process_action = 'Edited';@$qlc_id = '/' . $center_info['qlc_id'];}

echo form_open_multipart('school/center_kpi/' . $process_action . $qlc_id, array('id' => 'form1'));
?>

                                    <input type="hidden" name="<?php echo $csrf['name']; ?>" value="<?php echo $csrf['hash']; ?>" /> <!-- Set hidden csrf field -->

                                    <input type="submit" value="submit" name="bt_submit" hidden="hidden">


                                    <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                                    <!--1-->
                                    <div class="panel-group">
                                          <!--2-->
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>แบบประเมินมาตรฐานตัวชี้วัด ศพอส.</h4>
                                              </div>

                                              <!--3-->
                                              <div class="panel-body" style="border:0; padding: 20px;">

                                                  <!--กรอกข้อมูล ศพอส-->
                                                  <div class="form-group row">
                                                    <div class="col-xs-12 col-sm-9 has-error"> <!-- col-sm-12 -->
                                                        <label for="" class="col-2 col-form-label" style="color: red;">ชื่อหน่วยงาน ศพอส.</label> <!-- control-label col-md-3 col-sm-3 col-xs-12 -->
                                                        <input type="text" class="form-control " name="center_info[qlc_name]" title="ชื่อศพอส" value="<?php echo $center_info['qlc_name']; ?>" placeholder="ระบุชื่อหน่วยงาน" disabled>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3"> <!--ต้องกลับมาแก้ปี-->
                                                        <!--ปีที่เริ่มดำเนินการ (ปี พ.ศ. ที่ก่อตั้ง)-->
                                                        <br />
                                                        <button id="goto_tab2" style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-search"> <i class="fa fa-search" aria-hidden="true"></i> ดูผลการประเมินทั้งหมด</button>

                                                    </div>
                                                  </div>
                                                  <!--จบ กรอกข้อมูล ศพอส-->

                                                <!--ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->
                                                <br />
                                                <div class="form-group row">
                                                  <label for="" class=" col-sm-3 col-xs-12 col-form-label">ทำแบบประเมินมาตรฐานตัวชี้วัด</label>
                                                  <div class="col-xs-12 col-sm-9">

                                                    <?php
$qlc_select = array();
if ($process_action == 'Edited') {
    //$qlc_select = $this->common_model->query("SELECT qlc_kpi_code FROM qlc_kpi WHERE qlc_id = {$center_info['qlc_id']}")->result_array();
}

?>
                                                    <?php foreach ($std_qlc as $key => $values) {?>

                                                     <div class="table-responsive">
                                                        <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                          <thead style="font-size: 15px;">
                                                            <tr>
                                                                <th style="width:2% !important; text-align: left;" class=""><?php echo $values['title']['qlc_kpi_grp']; ?></th>

                                                            </tr>
                                                          </thead>
                                                          <tbody>

                                                            <?php foreach ($values['data'] as $key2 => $value) {?>
                                                              <tr>
                                                                <td>
                                                                  <?php

    $status = '';
    /*foreach($qlc_select as $key => $product)
    {
    //ซ่อนเครื่องหมายถูก (ผล)
    if ( $product['qlc_kpi_code'] === $value['qlc_kpi_code'] )
    $status = 'checked=checked';
    }*/

    ?>
                                                                  <div class="i-checks">
                                                                    <input  <?php echo $status; ?> type="checkbox"  name="qlc[<?php echo $value['qlc_kpi_code'] ?>]" value="<?php echo $value['qlc_kpi_score'] ?>">
                                                                    <div style="margin-left: 5px; display: inline;">
                                                                      <?php echo $value['qlc_kpi_title']; ?>
                                                                    </div>
                                                                  </div>
                                                                </td>
                                                              </tr>
                                                            <?php }?>

                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    <?php }?>
                                                  </div>
                                                </div>
                                                <!--จบ ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->

                                              </div><!--3-->
                                          </div><!--2-->
                                      </div><!--1-->

                                    <?php echo form_close(); ?>

                                    </div> <!-- close form group row-->

                                    <hr style="margin-top: 0px;">

                                    <div class="row">
                                      <div class="col-xs-12 col-sm-8">&nbsp;</div>
                                      <div class="col-xs-12 col-sm-2">
                                        <button
                                          id='data-save'
                                          style="height: 40px;width: 100% !important;"
                                          type="button"
                                          class="btn btn-primary btn-save"
                                          onclick="return opnCnfrom()"
                                        >
                                          <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                          บันทึก
                                        </button>
                                        <button
                                          style="height:40px;width:100% !important;display:none;cursor:not-allowed;filter:grayscale(100%);"
                                          type="button"
                                          class="btn btn-primary btn-save"
                                        >
                                          <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                          บันทึก
                                        </button>
                                        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
                                        <script>
                                          $('body').on('saving-data', e => {
                                            $('button#data-save').hide().next().show();
                                            $('body').append(
                                              $('<div/>', {
                                                style:"position:fixed;width:100%;height:100%;top:0;left:0;background:black;z-index:10000;opacity:.5;"
                                              }),
                                              $('<div/>', {
                                                style:"position:fixed;width:50%;height:50%;top:20%;left:25%;background:white;z-index:100000;text-align:center;font-size:xx-large;display:flex;"
                                              }).append('<div style="margin:auto"><b><i class="fas fa-hourglass-half"></i><br>กำลังบันทึกข้อมูล<br>กรุณารอซักครู่</b></div>')
                                            )
                                          });
                                        </script>
                                      </div>
                                      <div class="col-xs-12 col-sm-2">
                                        <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/center_list'); ?>'"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                      </div>
                                    </div><!-- close class row-->



                                    <div id="alive_tab2"></div>
                                </div>
                            </div>




                            <div id="tab-2" <?php if ($usrpm['app_id'] == 169) {?>class="tab-pane active" <?php } else {?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                <div class="form-group row">
                                      <!--1-->
                                      <div class="panel-group">
                                          <!--2-->
                                          <div class="panel panel-default" style="border: 0">

                                              <div class="panel-heading">
                                                <h4>ประวัติการประเมินมาตรฐานตัวชี้วัด ศพอส.</h4>
                                              </div>

                                              <!--3-->
                                              <div class="panel-body" style="border:0; padding: 20px;">


                                                  <!--ตาราง รร ในสังกัด ศพอส.-->

                                                  <div class="table-responsive">

                                                    <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                      <thead style="font-size: 15px;">
                                                        <tr>
                                                            <th style="width:2% !important;" class="text-center">#</th>
                                                            <th style="width:28% !important;" class="text-center">วันที่และเวลาประเมิน</th>
                                                            <th style="width:28% !important;" class="text-center">เกรด</th>
                                                            <th style="width:28% !important;" class="text-center">คะแนน</th>
                                                            <!--<th style="width:5% !important;" class="text-center">ดูผล</th>-->
                                                            <th style="width:6% !important;" class="text-center">ลบผล</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                        <!--<tr>
                                                          <td class="text-center">2</td>
                                                          <td class="text-center">2017-07-31 11:01:01</td>
                                                          <td class="text-center">ดี (B)</td>
                                                          <td class="text-center">60</td>-->
                                                          <!--<td>
                                                            <center>--><!-- Single button -->
                                                              <!--<div class="btn-group" style="cursor: pointer;">-->
                                                                <!--<i data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>
                                                                <ul class="dropdown-menu" style="position: absolute;left: -190px;">-->
                                                                <!--<li>
                                                                  <a style="font-size:16px;" data-toggle="modal" data-target="#prt" title="พิมพ์แบบฟอร์ม">
                                                                    <i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> พิมพ์ผลการประเมิน (.PDF)
                                                                  </a>
                                                                </li>-->
                                                                <!--<li>
                                                                  <a style="font-size:16px;" href="<?php echo site_url('school/center_info/') . '/Edit/' . $schl['qlc_id']; ?>">
                                                                    <i class="fa fa-search" aria-hidden="true" style="color: #000"></i> ดูผลการประเมิน
                                                                  </a>
                                                                </li>
                                                                <li>
                                                                  <a style="font-size:16px;" data-id="<?php echo $schl['qlc_id'] ?>" onclick="opn(this)" title="ลบ">
                                                                    <i class="fa fa-trash" style="color: #000"></i> ลบรายการ
                                                                  </a>
                                                                </li>
                                                                </ul>-->

                                                                <!--<a style="font-size:16px;" href="<?php echo site_url('school/center_info/') . '/Edit/' . $schl['qlc_id']; ?>">
                                                                    <i class="fa fa-search" aria-hidden="true" style="color: #000"></i>
                                                                </a>
                                                                <a style="font-size:16px;" data-id="<?php echo $schl['qlc_id'] ?>" onclick="opn(this)" title="ลบ">
                                                                    <i class="fa fa-trash" style="color: #000"></i>
                                                                </a>

                                                              </div>
                                                            </center>
                                                          </td>-->
                                                          <!--<td>-->
                                                            <!--<center>--><!-- Single button -->
                                                              <!--<div class="btn-group" style="cursor: pointer;">

                                                                <a style="font-size:16px;" href="<?php echo site_url('school/center_info/') . '/Edit/' . $schl['qlc_id']; ?>">
                                                                    <i class="fa fa-search" aria-hidden="true" style="color: #000"></i>
                                                                </a>

                                                              </div>
                                                            </center>
                                                          </td>-->
                                                          <!--<td>
                                                            <center>--><!-- Single button -->
                                                              <!--<div class="btn-group" style="cursor: pointer;">

                                                                <a style="font-size:16px;" data-id="<?php echo $schl['qlc_id'] ?>" onclick="opn(this)" title="ลบ">
                                                                    <i class="fa fa-trash" style="color: #000"></i>
                                                                </a>

                                                              </div>
                                                            </center>
                                                          </td>
                                                        </tr>-->

                                                        <?php
$select_all_qlc_kpi = array();
if ($process_action == 'Edited') {
    //$qlc_select = $this->common_model->query("SELECT qlc_kpi_code FROM qlc_kpi WHERE qlc_id = {$center_info['qlc_id']}")->result_array();
    $select_all_qlc_kpi = $this->common_model->query("SELECT insert_datetime FROM qlc_kpi WHERE qlc_id = {$center_info['qlc_id']} and insert_datetime not like '' and insert_datetime is not null and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00') group by insert_datetime order by insert_datetime DESC, insert_id DESC, qlc_id ASC, qlc_kpi_code ASC;")->result_array();
}
?>

                                                        <?php
if ($center_info['qlc_id'] != null) //add code if null
{ //add code if null
    $number = 1;
    if (count($select_all_qlc_kpi) > 0 & count($select_all_qlc_kpi) != 0 & (count($select_all_qlc_kpi) != null | count($select_all_qlc_kpi) != '')) {
        foreach ($select_all_qlc_kpi as $all_qlc_kpi_result) {
            ?>

                                                                <tr>
                                                                  <td class="text-center"><?php echo $number; ?></td>
                                                                  <?php $number++;?>
                                                                  <td class="text-center">
                                                                    <?php
//$qlc_kpi_insert_datetime = $all_qlc_kpi_result['insert_datetime'];

            //echo $qlc_kpi_insert_datetime;

            $qlc_kpi_insert_datetime = $all_qlc_kpi_result['insert_datetime'];

            $qlc_date = date('Y-m-d', strtotime($qlc_kpi_insert_datetime));
            $qlc_time = date('H:i:s', strtotime($qlc_kpi_insert_datetime));

            echo "" . formatDateThai1($qlc_date) . " (" . $qlc_time . " น.)";

            if ($center_info['qlc_id'] != '' & $qlc_kpi_insert_datetime != '') {
                $qlc_kpi_none = $this->common_model->query("SELECT * FROM qlc_kpi where qlc_id = {$center_info['qlc_id']} and insert_datetime like '{$qlc_kpi_insert_datetime}'")->row_array();
                $qlc_kpi_group1 = $this->common_model->query("SELECT count(*) as group1 FROM qlc_kpi where qlc_id = {$center_info['qlc_id']} and insert_datetime like '{$qlc_kpi_insert_datetime}' and qlc_kpi_code between 0101 and 0110 and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')")->row_array();
                $qlc_kpi_group2 = $this->common_model->query("SELECT count(*) as group2 FROM qlc_kpi where qlc_id = {$center_info['qlc_id']} and insert_datetime like '{$qlc_kpi_insert_datetime}' and qlc_kpi_code between 0201 and 0210 and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')")->row_array();
                $qlc_kpi_group3 = $this->common_model->query("SELECT count(*) as group3 FROM qlc_kpi where qlc_id = {$center_info['qlc_id']} and insert_datetime like '{$qlc_kpi_insert_datetime}' and qlc_kpi_code between 0301 and 0302 and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')")->row_array();
                $qlc_kpi_group4 = $this->common_model->query("SELECT count(*) as group4 FROM qlc_kpi where qlc_id = {$center_info['qlc_id']} and insert_datetime like '{$qlc_kpi_insert_datetime}' and qlc_kpi_code between 0401 and 0408 and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')")->row_array();
                $qlc_kpi_group5 = $this->common_model->query("SELECT count(*) as group5 FROM qlc_kpi where qlc_id = {$center_info['qlc_id']} and insert_datetime like '{$qlc_kpi_insert_datetime}' and qlc_kpi_code between 0501 and 0503 and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')")->row_array();
                $qlc_kpi_group6 = $this->common_model->query("SELECT count(*) as group6 FROM qlc_kpi where qlc_id = {$center_info['qlc_id']} and insert_datetime like '{$qlc_kpi_insert_datetime}' and qlc_kpi_code between 0601 and 0612 and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')")->row_array();

                $qlc_kpi_total = ($qlc_kpi_group1['group1'] * 2) + ($qlc_kpi_group2['group2'] * 3) + ($qlc_kpi_group3['group3'] * 2) + ($qlc_kpi_group4['group4'] * 2) + ($qlc_kpi_group5['group5'] * 2) + ($qlc_kpi_group6['group6'] * 2);

                ?>
                                                                  </td>
                                                                  <td class="text-center"><!--ดีมาก (A)-->
                                                                    <?php
if ($qlc_kpi_none['qlc_id'] != '') {

                    if ($qlc_kpi_total >= 0) {
                        if ($qlc_kpi_total < 50) {
                            echo "D";
                        } else if ($qlc_kpi_total < 60) {
                            echo "C";
                        } else if ($qlc_kpi_total < 80) {
                            echo "B";
                        } else if ($qlc_kpi_total >= 80) {
                            echo "A";
                        }
                    }

                } else {
                    echo "-";
                }
                ?>
                                                                  </td>
                                                                  <td class="text-center">
                                                                  <?php
if ($qlc_kpi_none['qlc_id'] != '') {

                    if ($qlc_kpi_total >= 0) {
                        if ($qlc_kpi_total < 50) {
                            echo $qlc_kpi_total;
                        } else if ($qlc_kpi_total < 60) {
                            echo $qlc_kpi_total;
                        } else if ($qlc_kpi_total < 80) {
                            echo $qlc_kpi_total;
                        } else if ($qlc_kpi_total >= 80) {
                            echo $qlc_kpi_total;
                        }
                    }

                } else {
                    echo "-";
                }

            } else {
                echo "-";
            }
            ?>
                                                                  </td>
                                                                  <td>
                                                                    <center><!-- Single button -->
                                                                      <div class="btn-group" style="cursor: pointer;">


                                                                        <!--<input  <?php echo $status; ?> type="checkbox"  name="qlc[<?php echo $value['qlc_kpi_code'] ?>]" value="<?php echo $value['qlc_kpi_score'] ?>">-->

                                                                        <!--<a style="font-size:16px;" data-id="<?php //echo $schl['qlc_id']?>" onclick="opn(this)" title="ลบ">-->
                                                                        <a style="font-size:16px;" data-id="<?php echo $qlc_id ?>" data-datetime="<?php echo $qlc_kpi_insert_datetime ?>" onclick="opn(this)" title="ลบ"> <!--$qlc_kpi_insert_datetime-->
                                                                            <i class="fa fa-trash" style="color: #000"></i>
                                                                        </a>

                                                                      </div>
                                                                    </center>
                                                                  </td>
                                                                </tr>

                                                        <?php
}
    } //add code if null
    else //--------- add code if null ---------
    {
        ?>
                                                              <tr>
                                                                <td><?php echo "#"; ?></td>
                                                                <td><center><?php echo "ไม่พบข้อมูล"; ?></center></td>
                                                                <td><center><?php echo "ไม่พบข้อมูล"; ?></center></td
                                                                ><td><center><?php echo "ไม่พบข้อมูล"; ?></center></td>
                                                                <td>
                                                                  <center><!-- Single button -->
                                                                    <div  style="cursor: not-allowed;"> <!-- class="btn-group" style="cursor: pointer;" -->
                                                                      <text style="font-size:16px;" title="ลบ"> <!-- <a></a> -->
                                                                        <i class="fa fa-trash" style="color: #000"></i>
                                                                      </text>
                                                                    </div>
                                                                  </center>
                                                                </td>
                                                              </tr>
                                                        <?php
}
} //add code if null
else //--------- add code if null ---------
{
    ?>
                                                              <tr>
                                                                <td><?php echo "#"; ?></td>
                                                                <td><center><?php echo "ไม่พบข้อมูล"; ?></center></td>
                                                                <td><center><?php echo "ไม่พบข้อมูล"; ?></center></td
                                                                ><td><center><?php echo "ไม่พบข้อมูล"; ?></center></td>
                                                                <td>
                                                                  <center><!-- Single button -->
                                                                    <div  style="cursor: not-allowed;"> <!-- class="btn-group" style="cursor: pointer;" -->
                                                                      <text style="font-size:16px;" title="ลบ"> <!-- <a></a> -->
                                                                        <i class="fa fa-trash" style="color: #000"></i>
                                                                      </text>
                                                                    </div>
                                                                  </center>
                                                                </td>
                                                              </tr>
                                                        <?php
}
?>


                                                      </tbody>
                                                    </table>

                                                  </div>
                                                  <!--จบ ตาราง รร ใน สังกัด ศพอส.-->



                                                <!--ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->
                                                <br />
                                                <div class="form-group row">

                                                    <?php
$qlc_select = array();
if ($process_action == 'Edited') {
    //$qlc_select = $this->common_model->query("SELECT qlc_kpi_code FROM qlc_kpi WHERE qlc_id = {$center_info['qlc_id']}")->result_array();
    $qlc_select = $this->common_model->query("SELECT *
                                                          FROM qlc_kpi
                                                          WHERE qlc_id = {$center_info['qlc_id']}
                                                          and insert_datetime =
                                                          (SELECT max(insert_datetime)
                                                          FROM qlc_kpi
                                                          WHERE qlc_id = {$center_info['qlc_id']} and insert_datetime not like '' and insert_datetime is not null
                                                          and delete_user_id IS NULL AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
                                                          order by insert_datetime DESC, insert_id DESC, qlc_id ASC, qlc_kpi_code ASC);")->result_array();
}
$qlc_select_datetime = $qlc_select[0]['insert_datetime'];

//--- splite datetime-1 using explode function
//$split_qlc_datetime = explode(" ",$qlc_select_datetime);
//$qlc_date = $split_qlc_datetime[0];
//$qlc_time = $split_qlc_datetime[1];

$qlc_date = date('Y-m-d', strtotime($qlc_select_datetime));
$qlc_time = date('H:i:s', strtotime($qlc_select_datetime));
//$split_qlc_time = explode(":",$qlc_time);
//$qlc_time_hh = $split_qlc_time[0];
//$qlc_time_mm = $split_qlc_time[1];
//$qlc_time_ss = $split_qlc_time[2];
?>

                                                  <label for="" class=" col-sm-3 col-xs-12 col-form-label">ผลการประเมินมาตรฐานตัวชี้วัดล่าสุด<br />ณ วันที่ <?php echo formatDateThai1($qlc_date) ?> <!--2018-01-03--> เวลา <?php echo $qlc_time; ?> น.<!--09:01:01--></label>
                                                  <div class="col-xs-12 col-sm-9">

                                                    <?php foreach ($std_qlc as $key => $values) {?>

                                                     <div class="table-responsive">
                                                        <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;" >
                                                          <thead style="font-size: 15px;">
                                                            <tr>
                                                                <th style="width:2% !important; text-align: left;" class=""><?php echo $values['title']['qlc_kpi_grp']; ?></th>

                                                            </tr>
                                                          </thead>
                                                          <tbody>

                                                            <?php foreach ($values['data'] as $key2 => $value) {?>
                                                              <tr>
                                                                <td>
                                                                  <?php

    $status = '';
    $change_qlc_kpi_name = '';
    foreach ($qlc_select as $key => $product) {
        if ($product['qlc_kpi_code'] === $value['qlc_kpi_code']) {
            $status = 'checked=checked';
            $change_qlc_kpi_name = 'color: green;'; //#2c8f7b
        }
    }

    ?>
                                                                  <div class="i-checks">
                                                                    <input disabled <?php echo $status; ?> type="checkbox"  > <!--name="qlc[<?php //echo $value['qlc_kpi_code']?>]" value="<?php //echo $value['qlc_kpi_score']?>"-->
                                                                    <div style="margin-left: 5px; display: inline; <?php echo $change_qlc_kpi_name ?>">
                                                                      <?php echo $value['qlc_kpi_title']; ?>
                                                                    </div>
                                                                  </div>
                                                                </td>
                                                              </tr>
                                                            <?php }?>

                                                          </tbody>
                                                        </table>
                                                      </div>
                                                    <?php }?>
                                                  </div>
                                                </div>
                                                <!--จบ ซ่อน ผลการตรวจมาตรฐาน/ตัวชี้วัด-->

                                              </div><!--3-->
                                              </div><!--2-->
                                              </div><!--1-->

                                              </div><!-- close from group row-->
                                              <!--<hr style="margin-top: 0px; margin-bottom: 0px;">-->
                                </div>
                            </div>


                            <div id="tab-3" <?php if ($usrpm['app_id'] == 5) {?>class="tab-pane active" <?php } else {?> class="tab-pane"<?php }?>>
                                <div class="panel-body">
                                    <strong>Tab-3</strong>
                                </div>
                            </div>




                        </div><!-- close tab-content-->


                    </div>
                </div>
            </div>

            <script type="text/javascript">


                  <?php if ($process_action == 'Edited') {?>
                  setTimeout(function(){$("#Province").val('<?php echo @$center_info['addr_province']; ?>').trigger('change');},200);
                  //setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
                  // setTimeot(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);

                <?php }?>
                function set_enable(elem,target='') {
                  if(elem.prop('checked') == true) {
                    $(target).prop('disabled', false ).focus();
                  }else{
                    $(target).val('');
                    $(target).prop('disabled', true );
                  }
                }
                function optionGen(code,target,opSelect) {
                  // alert(code.value);
                  // alert(target);
                  $.ajax({
                    url: base_url+'personals/get_Area_option',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                      'code': code.value,
                      'type': target,
                      <?php echo $csrf['name']; ?>: '<?php echo $csrf['hash']; ?>'
                    },
                  })
                  .done(function(ret) {
                    console.log("success");
                    console.dir(ret);
                    $('#'+target).empty();
                    $('#'+target).prop('disabled', false);
                    if(target == 'Amphur'){
                      str = "เลือกอำเภอ";
                    }else if(target == 'Tambon'){
                      str = "เลือกตำบล";
                    }
                    $('#'+target).append($('<option>', {
                      value: '',
                      text : str
                    }));
                    for (var i = 0; i < ret.length ; i++) {
                      // if(ret[i].area_code == opSelect){
                        $('#'+target).append($('<option>', {
                          value: ret[i].area_code,
                          text : ret[i].area_name_th
                        }));
                      // }else{
                      //   $('#'+target).append($('<option>', {
                      //     value: ret[i].area_code,
                      //     text : ret[i].area_name_th
                      //   }));
                      // }
                    }
                    $('#'+target).val(opSelect).trigger('change');
                  })
                  .fail(function() {
                    console.log("error");
                  });
                }

              function checkbox_model(node){
                 if($(node).prop('checked',)==true){
                     $(node).parent().next().children().attr('disabled',false);
                 }else{
                     $(node).parent().next().children().attr('disabled',true);
                 }
              }
            </script>

            <script type="text/javascript">
              $(document).ready(function () {
                $('.i-checks').iCheck({
                  checkboxClass: 'icheckbox_square-green',
                  radioClass: 'iradio_square-green',
                  increaseArea: '20%'
                });

                chebox_star();
              });

              $("input[name='std_model[]']").on('ifChanged',function(){
                 if($(this).prop('checked')){
                     $(this).parent().parent().parent().next().children().prop('disabled',false).focus();
                 }else{
                     $(this).parent().parent().parent().next().children().val('');
                     $(this).parent().parent().parent().next().children().prop('disabled',true);
                 }

               chebox_star();

              });

              function chebox_star(){

                var num_star = parseInt($("input[name='std_model[]']:checked").length);

                if(num_star>0 && num_star<=9){

                 add_color($("#star1"));

                 che_star($("#star2"));
                 che_star($("#star3"));
                 che_star($("#star4"));
               }else{

                if(num_star>9 && num_star<=12){
                 add_color($("#star1"));
                 add_color($("#star2"));

                 che_star($("#star3"));
                 che_star($("#star4"));
               }else{
                if(num_star>12 && num_star<=15){
                 add_color($("#star1"));
                 add_color($("#star2"));
                 add_color($("#star3"));

                 che_star($("#star4"));
               }else{

                if(num_star>15 && num_star<=20){
                 add_color($("#star1"));
                 add_color($("#star2"));
                 add_color($("#star3"));
                 add_color($("#star4"));
               }else{
                 che_star($("#star1"));
                 che_star($("#star2"));
                 che_star($("#star3"));
                 che_star($("#star4"));
                      }

                    }
                  }

                }
              }

              function che_star(star_id){

                 var status_star = star_id.hasClass("fa fa-star-o");
                 if(!status_star){
                    star_id.removeClass("fa fa-star");
                    star_id.css("color","#676a6c");
                    star_id.addClass("fa fa-star-o");

                 }
              }

              function add_color(star_id){
                   star_id.removeClass("fa fa-star-o");
                   star_id.addClass("fa fa-star");
                   star_id.css("color","#FF9800");
              }

            </script>

            <!-- Modal -->
  <div class="modal fade" id="modal_marker" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: rgb(56,145,209);color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="fa fa-map-marker" aria-hidden="true"></i> Search Location</h4>
        </div>
        <div class="modal-body">

      <form name="form_search" method="post" action="">

      <b>Location</b>
        <div class="row">
          <div class="col-xs-12 col-sm-10">
              <input name="namePlace" class="form-control" size="70" type="text" id="namePlace" size="30" />
              <input type="hidden" name="address" id="namePlace2">
          </div>
          <div class="col-xs-12 col-sm-2">
              <input type="button" class="btn btn-default" style="width: 100%; margin-top: -5px" name="SearchPlace" id="SearchPlace" value="Search" />
            </div>
        </div>
       </form>

      <hr />

      <form id="form_get_detailMap" name="form_get_detailMap" method="post" action="">
        <div class="row">
          <div class="col-xs-6 col-sm-5">
            Latitude <input class="form-control" name="lat_value" type="text" id="lat_value" value="0" size="20" readonly />
          </div>
          <div class="col-xs-6 col-sm-5">
            Longitude <input class="form-control" name="lon_value" type="text" id="lon_value" value="0" size="20" readonly />
          </div>
          <div class="col-xs-12 col-sm-2">
            <input type="button" class="btn btn-default" style="margin-top: 22px; width: 100%" name="button" id="button" onclick="select_location();" value="Save" />
            </div>
          </div>
      </form>

      <div class="row">
        <div class="col-xs-12 col-sm-12">
          <!-- show map -->
          <div id="map_canvas" style="width:100%;height:400px;margin:auto;margin-top:10px;"></div>
        </div>
      </div>

        </div>
        <!--
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        -->
      </div>

    </div>
  </div>
  <!-- END modal_marker -->

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
        <p><?php echo $str; ?></p>
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
        <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
      </div>
      <div class="modal-body">
        <?php $str = getMsg('054');?>
        <p><?php echo $str; ?></p>
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
        <?php $str = getMsg('0173');?>
        <p><?php echo $str; ?></p>
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
         <h4 class="modal-title" style="color: #333; font-size: 20px;">พิมพ์แบบฟอร์ม</h4>
       </div>
      <div class="modal-body">
        <div class="row">
          <?php
$tmp = $this->admin_model->getOnce_Application(7);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(7, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 7) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px;" target="_blank" href="<?php echo site_url('report/A1'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

          <?php
$tmp = $this->admin_model->getOnce_Application(8);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(8, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 8) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A2'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

          <?php
$tmp = $this->admin_model->getOnce_Application(9);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(9, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 9) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A3'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

          <?php
$tmp = $this->admin_model->getOnce_Application(10);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(10, get_session('user_id')); //Check User Permission
?>
          <div class="col-xs-12 col-sm-12" style="margin-bottom: 10px;"
          <?php
if (!isset($tmp1['perm_status'])) {?>
              class="disabled"
          <?php
} else if ($usrpm['app_id'] == 10) {
    ?>
              class="active"
          <?php
}
?>
           >
            <a style="color: #333; font-size: 20px; margin-bottom: 50px;" target="_blank" href="<?php echo site_url('report/A4'); ?>"><i class="fa fa-print" aria-hidden="true"></i> <?php if (isset($tmp1['perm_status'])) {echo $tmp1['app_name'];}?>
            </a>
          </div>

         </div>
         <br />

      </div>
    </div>

  </div>
 </div>
 <!-- End Print Modal -->


<!-- Star Slide to View Result -->
<script>
  $("#goto_tab2").click(function() {
      $('html,body').animate({
          scrollTop: $("#alive_tab2").offset().top},
          'slow');
  });
</script>
<!-- End Slide to View Result -->