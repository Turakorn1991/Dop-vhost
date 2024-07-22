
<?php

$schl_id = $schl_info['schl_id'];
$schl_id_original = $schl_id;

?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li>
                              <?php
$tmp = $this->admin_model->getOnce_Application(59);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(59, $user_id); //Check User Permission
?>
                                <a  <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/school1/Edit/' . $schl_info['schl_id']); ?>" <?php }?>  <?php if ($usrpm['app_id'] == 59) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>> (1) โรงเรียน</a>
                            </li>
                            <li>
                              <?php
$tmp = $this->admin_model->getOnce_Application(60);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(60, $user_id); //Check User Permission
?>
                                <a <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/photo2/Edit/' . $schl_info['schl_id']); ?>" <?php }?>  <?php if ($usrpm['app_id'] == 60) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>>(2) ภาพถ่าย</a>
                            </li>
                            <li>
                              <?php
$tmp = $this->admin_model->getOnce_Application(61);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(61, $user_id); //Check User Permission
?>
                                <a  <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/generation3/Edit/' . $schl_info['schl_id']); ?>" <?php }?>  <?php if ($usrpm['app_id'] == 61) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>>(3) รุ่น/หลักสูตร</a>
                            </li>
                            <li class="active">
                              <?php
$tmp = $this->admin_model->getOnce_Application(174);
$tmp1 = $this->admin_model->chkOnce_usrmPermiss(174, $user_id); //Check User Permission  parent=57โรงเรียนผส -> 174แบบขึ้นทะเบียน (ผลการประเมินโรงเรียน)
?>
                                <a  <?php if (!isset($tmp1['perm_status'])) {?>
                                    readonly
                                  <?php } else if ($process_action != 'Add') {?> href="<?php echo site_url('school/school1/Edit/' . $schl_info['schl_id']); ?>" <?php }?>  data-toggle="tab"  <?php if ($usrpm['app_id'] == 174) {?>aria-expanded="true" <?php } else {?> aria-expanded="false"<?php }?>> (4) แบบประเมินโรงเรียน</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-1" <?php if ($usrpm['app_id'] == 59) {?>class="tab-pane active" <?php } else {?> class="tab-pane"<?php }?>>
                              <div class="panel-body">
                              <div class="form-group row" style="margin-bottom:0px !important;">

                                  <!--1-->
                                  <div class="panel-group" style="margin-bottom:0px !important;">
                                    <!--2-->
                                    <div class="panel panel-default" style="border: 0">

                                      <div class="panel-heading">
                                        <h4>ประวัติการประเมินโรงเรียนต้นแบบ</h4>
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

                                            <div id="tmp_menu" hidden='hidden'>

                                                  <!--
                                                  <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style="margin-top: 11px; margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 5px 20px 3px 20px;" href="<?php echo site_url('control/main_module'); ?>"><i class="fa fa-caret-left" aria-hidden="true"></i> </a>
                                                  -->
                                            </div><!-- close <div id="tmp_menu" -->


                                            <script>
                                              $("#guide-book").click(function(){
                                                window.open('/assets/modules/school/guide/Sch_Manual.pdf', '_blank');
                                              }); 
                                              setTimeout(function(){
                                                $("#menu_topright").html($("#tmp_menu").html());
                                              },300);
                                            </script>


                                            <div style="float: right;" onclick="modalDoTest(this)" data-id="<?php echo $schl_id_original; ?>">
                                              <?php
//$tmp = $this->admin_model->getOnce_Application(59);
//$tmp1 = $this->admin_model->chkOnce_usrmPermiss(59,$user_id); //Check User Permission
?>
                                              <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                                              <?php //if(!isset($tmp1['perm_status'])) {?>
                                                      readonly
                                                    <?php //}else{?> <?php //href=" echo site_url('school/generation_detail/Add/'.$schl_id);"?>
                                              <?php //}?> title="<?php //if(isset($tmp['app_name'])){echo $tmp['app_name'];}?>">
                                              <i class="fa fa-plus" aria-hidden="true"></i>
                                              </a>
                                            </div><!-- close <div style="float: right;"> -->


                                            <style>
                                              i.fa.fa-star-o, i.fa.fa-star {font-size: 16px;}
                                              i.fa.fa-star-o {color: #909090;}
                                              i.fa.fa-star {color: #FF9800;}
                                              .evaluation-item label {cursor:pointer;}
                                            </style>

                                            <table
                                              id="dtable"
                                              class="table table-striped table-bordered table-hover dataTables-example text-center"
                                              style="margin-top: 0px !important; width:100% !important;"
                                            >
                                              <thead style="font-size: 15px;">
                                                <tr>
                                                  <th style="width:2% !important;">#</th>
                                                  <th style="width:28% !important;">วันที่และเวลาประเมิน</th>
                                                  <th style="width:28% !important;">เกรด</th>
                                                  <th style="width:28% !important;">คะแนน</th>
                                                  <th style="width:6% !important;">ลบผล</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php foreach ($schl_evaluations_group as $i => $evaluation): ?>
                                                  <tr>
                                                    <td><?=($i + 1)?></td>
                                                    <td><?=$evaluation['insert_datetime']?></td>
                                                    <td>
                                                      <i class='fa fa-star<?=$evaluation['n'] > 0 ? '' : '-o'?>'></i>
                                                      <i class='fa fa-star<?=$evaluation['n'] > 9 ? '' : '-o'?>'></i>
                                                      <i class='fa fa-star<?=$evaluation['n'] > 12 ? '' : '-o'?>'></i>
                                                      <i class='fa fa-star<?=$evaluation['n'] > 15 ? '' : '-o'?>'></i>
                                                    </td>
                                                    <td><?=$evaluation['n']?></td>
                                                    <td>
                                                      <div
                                                        class='evaluation-delete'
                                                        style="font-size:16px;cursor:pointer;"
                                                        title="ลบ"
                                                        insert-datetime='<?=$evaluation['insert_datetime']?>'
                                                      >
                                                        <i class="fa fa-trash" style="color: #000"></i>
                                                      </div>
                                                    </td>
                                                  </tr>
                                                <?php endforeach;?>
                                              </tbody>
                                            </table><!-- close <table id="dtable" -->
                                            <form id='evaluation-delete-form' action="<?=base_url("school/delete_schl_models")?>" method='post'>
                                              <input type="hidden" name='insert_datetime'>
                                              <input type="hidden" name='schl_id' value='<?=$schl_id?>'>
                                              <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
                                            </form>
                                            <script>
                                              $('.evaluation-delete').click(e => {
                                                let val = $(e.currentTarget).attr('insert-datetime');
                                                $('[name=insert_datetime]').val(val);
                                                $('#evaluation-delete-form').submit();
                                              })
                                            </script>

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
                                                    <p><?php echo $str; ?></p>
                                                    <!--<p>ยืนยันการลบ?</p>-->
                                                  </div>
                                                  <div class="modal-footer">
                                                    <a href="<?php echo base_url('school/generation3/Delete/' . $value['schl_id'] . '/' . $value['gen_id']); ?>"><button  type="button" class="btn btn-danger">ตกลง</button></a>
                                                    <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- End Delete Model -->

                                          </div><!-- <div class="col-xs-12 col-sm-12"> -->
                                        </div><!-- close form-group row-->
                                        <!-- === show image : end code === -->

                                        <hr>

                                        <div class="row">
                                          <div class="col-xs-12 col-sm-10">&nbsp;</div>
                                          <div class="col-xs-12 col-sm-2">
                                            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('school/photo2/Edit/' . $this->uri->segment('4')); ?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                          </div>
                                        </div><!-- close <div class="row"> -->


                                      </div><!-- close <div class="panel-body"> --->
                                    </div><!-- end 2-->
                                  </div><!-- end 1-->
                                <div><!--close <div class="form-group row"-->
                              </div> <!--<div class="panel-body">-->
                            </div> <!--<div id="tab-1"-->
                        </div> <!--<div class="tab-content">-->



                    </div><!-- close <div class="tabs-container"> -->
                </div><!-- close <div class="col-lg-12"> -->
          </div><!-- close <div class="row"> -->

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
        <?php $str = getMsg('061');?>
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

<!-- start opal modal -->

    <!-- start view image -->

        <!-- View all Photos in this Album Modal -->
        <div id="mdDoTest" class="modal fade" id="modal fade" role="dialog" style="margin-left:17px;">
        <!-- <div id="mdViewAlbum" class="modal fade" role="dialog" style="width:90vw; height:80vh; margin-left:5vw; margin-top:10vh; overflow-y: hidden;"> --><!-- modal-fade-in --> <!-- 1 -->
          <div class="modal-dialog-photoalbum"> <!-- modal-dialog --><!-- 2 -->

            <!-- Modal content-->
            <div class="modal-content"><!-- 3 -->

              <div class="modal-header"><!-- 4 -->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div id="viewAlbum-title-container"><b>
                  <i class="fa fa-pencil-square-o"></i>แบบประเมินโรงเรียนต้นแบบ</b><!-- <br> -->
                  <!-- <div style="padding-left:50px;"><text style="font-size: 15px;"><b> วันที่ประเมิน: </b>2 ส.ค. 2561 <br> -->
                  <!-- <b>คำอธิบายอัลบั้ม: </b>albumphotodddกกก1</text></div> -->
                </div>
              </div><!-- class="modal-header" --><!-- 4 -->

              <div class="modal-body" style="overflow-y: auto; height: 60vh;"><!-- 5 -->

              <!-- <p>OPAL TEST MODAL</p> -->
                <!-- <input type="text" name="albumid" id="albumid" value=""/> -->
                <!-- <h1><?php echo $_GET['albumid']; ?></h1> -->

                                          <!-- === show image : start code === -->
                                          <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                                            <div id="viewAlbum-container" class="col-xs-12 col-sm-12">
                                              <text class="text-left">
                                                <b style="font-size: 15px;">วันที่ทำแบบประเมิน : </b>
                                              </text>
<?php
$monthTH = explode(',', ',มกราคม,กุมภาพันธ์,มีนาคม,เมษายน,พฤษภาคม,มิถุนายน,กรกฎาคม,สิงหาคม,กันยายน,ตุลาคม,พฤศจิกายน,ธันวาคม');
$today[0] = date('j');
$today[1] = $monthTH[date('n')];
$today[2] = date('Y') + 543;
?>
                                              <input
                                                type="text"
                                                style="height:30px; margin-bottom:; color:lightgrey; background:transparent; border-width:0px !important"
                                                value="<?=implode(' ', $today)?>"
                                                disabled=""
                                              >
                                            </div>
                                          </div><!-- close form-group row-->
                                          <!-- === show image : end code === -->

                                          <hr style="border-top: 3px solid #eee !important;">

                                          <!-- === upload image : start code === -->
                                          <div class="form-group row" ><!--style="border-bottom: 1px solid #e5e5e5;"-->
                                              <div class="col-xs-12 col-sm-12">

                                                  <!-- panel group โรงเรียนต้นแบบ -->
                                                  <div class="panel-group">
                                                      <div class="panel panel-default" style="border: 0">

                                                          <div class="panel-body" style="border:0; padding: 20px;">
                                                              <div class="form-group row">

                                                                  <div class="col-xs-12 col-sm-6">
                                                                      <label>คุณสมบัติโรงเรียนต้นแบบ</label>
                                                                  </div>
                                                                  <div class="col-xs-12 col-sm-6 text-right">
                                                                      <i id="evaluation-star1" class="fa fa-star-o"></i>
                                                                      <i id="evaluation-star2" class="fa fa-star-o"></i>
                                                                      <i id="evaluation-star3" class="fa fa-star-o"></i>
                                                                      <i id="evaluation-star4" class="fa fa-star-o"></i>
                                                                      <b>คะแนนรวม: <span id='evaluation-scoring'>0</span>/20</b>
                                                                  </div>

                                                              </div>

                                                              <!-- for edit mode check $process_action -->
                                                              <form id='evaluation-list-form' method='post' action="<?=base_url("school/add_schl_models")?>">
                                                                <input type="hidden" name='schl_id' value='<?=$schl_id?>'>
                                                                <input type="hidden" name="<?=$csrf['name']?>" value="<?=$csrf['hash']?>">
                                                                <?php foreach ($std_model as $row): ?>
                                                                <div class="form-group row evaluation-item">
                                                                  <div class="col-xs-12 col-sm-6">
                                                                    <div class="checkbox-inline i-checks">
                                                                      <label>
                                                                        <input
                                                                          type="checkbox"
                                                                          name="mdl_code[]"
                                                                          value="<?=$row['mdl_code']?>"
                                                                          onclick="checkbox_model(this)"
                                                                        >
                                                                        <?=$row['mdl_title']?>
                                                                      </label>
                                                                    </div>
                                                                  </div>
                                                                  <div class="col-xs-12 col-sm-6">
                                                                    <input
                                                                      type="text"
                                                                      class="form-control"
                                                                      placeholder="ความคิดเห็นเจ้าหน้าที่"
                                                                      name="mdl_comment[<?=$row['mdl_code']?>]"
                                                                      evaluation-code='<?=$row['mdl_code']?>'
                                                                      disabled
                                                                    >
                                                                  </div>
                                                                </div>
                                                                <?php endforeach;?>
                                                              </form>
                                                            <script>
                                                              let targetInputs = {}, targetCode, target,
                                                                score, toggleStar = (ele, val) => {
                                                                  if (val) ele.removeClass('fa-star-o').addClass('fa-star');
                                                                  else ele.removeClass('fa-star').addClass('fa-star-o');
                                                                };
                                                              $('.evaluation-item label').click(e => {
                                                                targetCode = $(e.target).find('[type=checkbox]').val();
                                                                targetInputs[targetCode] = !targetInputs[targetCode];
                                                                target = $('.evaluation-item input[type=text][evaluation-code='+ targetCode +']');
                                                                if (targetInputs[targetCode]) target.removeAttr('disabled');
                                                                else target.attr('disabled', true);

                                                                score = Object.values(targetInputs).filter(a=>a).length;
                                                                $('#evaluation-scoring').text(score);
                                                                toggleStar($('#evaluation-star1'), score > 0);
                                                                toggleStar($('#evaluation-star2'), score > 9);
                                                                toggleStar($('#evaluation-star3'), score > 12);
                                                                toggleStar($('#evaluation-star4'), score > 15);
                                                              })
                                                            </script>

                                                          </div><!-- close panel-body-->
                                                      </div><!-- close panel-default-->
                                                  </div><!-- close panel group โรงเรียนต้นแบบ-->
                                              </div>
                                          </div>
                                          <!-- === upload image : end code === -->

                                </div><!-- class="modal-body" --><!-- 5 -->

                                <!--<p>ยืนยันการลบ?</p>-->
                                <div class="modal-footer"><!-- 6 -->
                                  <!-- <button id="dltOpalYes" type="button" class="btn btn-danger">ตกลง</button>
                                  <button type="button" style="margin-bottom: 5px;"  aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button> -->
                                  <div class="row">
                                    <div class="col-xs-12 col-sm-6">&nbsp;</div>
                                    <div class="col-xs-12 col-sm-3">
                                      <!--<input type="submit" name="submit" value="PUBLISH IMAGE">-->

                                      <button
                                        style="height: 40px;width: 100% !important;"
                                        type="button"
                                        class="btn btn-primary btn-save btn-confirmadd"
                                        id='evaluations-save'
                                      >
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                        บันทึก
                                      </button>
                                      <script>$('#evaluations-save').click(() => $('#evaluation-list-form').submit());</script>
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                      <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" data-dismiss="modal"> <i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
                                    </div>
                                  </div><!-- close class row-->
                                </div><!-- class="modal-footer" --><!-- 6 -->

                              </div><!-- class="modal-content" --><!-- 3 -->
                            </div><!-- div class="" --><!-- 2 -->
                          </div><!-- div id="dltOpal" --><!-- 1 -->
                          <!-- End Add Album Modal -->
                        <!-- end Add Album -->


<!-- end opal modal -->


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