<?php
// set_session('pers_authen',array('authen_log_id'=>223,'pid'=>'3101701933555','cid'=>'0221004350953232','random_string'=>'80db7f660e7ef6255597fc5794be0093')); //for Test
?>
<script>
//Declear Info Reader PID
var user_id = '<?php echo get_session('user_id');?>';
var org_id = '<?php echo get_session('org_id');?>';
var pers_authen = JSON.parse('<?php echo json_encode(get_session('pers_authen'));?>');
console.log(pers_authen);
var reader_status = false;
var authen_log_id = 0;
//End Declear Info Reader PID
var csrf_hash='<?php echo @$csrf['hash'];?>';
</script>
<div class="row">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
          <li class="active">
          <?php
          $tmp = $this->admin_model->getOnce_Application(161);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(161,$user_id); //Check User Permission
          ?>
<!--           <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else if($process_action!='Add'){?> href="<?php echo site_url('interprop/olderp_info/Edit/'.$wisd_info['knwl_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==161){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> ข้อมูลผู้สูงอายุ</a>
 -->        
          <a  href="<?php echo site_url('intelprop/olderp_info');?>"  data-toggle="tab"  aria-expanded="false"> ข้อมูลผู้สูงอายุ</a>

        </li>

        <li>
        <!--   <?php
          $tmp = $this->admin_model->getOnce_Application(44);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(44,$user_id); //Check User Permission
          ?>   -->

          <a  <?php if($process_action!='Add'){?> href="<?php echo site_url('intelprop/olderp_info2/Edit/'.$wisd_info['knwl_id']);?>" <?php }?> > ภูมิปัญญา </a>
        </li>

      </ul>

        
        <div class="tab-content">
          <div id="tab-1" <?php if($usrpm['app_id']==161){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
            <div class="panel-body">  
              <div class="form-group row">
                <?php
                $wisd_id = '';
                if($process_action=='Add')$process_action = 'Added';
                if($process_action=='Edit'){$process_action = 'Edited'; $wisd_id = '/'.$wisd_info['knwl_id'];}
                echo form_open_multipart('intelprop/olderp_info/'.$process_action.$wisd_id,array('id'=>'form1'));
                ?>
                <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                <input type="submit" value="submit" name="bt_submit" hidden="hidden">

                <?php echo validation_errors('<div class="error" style="font-size: 18px; padding-left: 20px">', '</div>'); ?>

                <div class="panel-group">
                  <div class="panel panel-default" style="border: 0">
                    <!-- <div class="panel-heading">
                      <h4>ข้อมูลผู้สูงอายุ <label>&nbsp;</label></h4>
                    </div> -->
                    <div class="panel-body" style="border:0; padding: 20px;">

                   <div class="row">
                     <div class="col-xs-12 col-sm-9">
                     <div class="form-group row">
                            <div class="col-xs-12 col-sm-3">
                             <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ขึ้นทะเบียน:</label>
                           </div>
                           <div class="col-xs-12 col-sm-3">

                            <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                              <input style="width: 257px;" title="วันที่ขึ้นทะเบียน" placeholder="เลือกวันที่" class="form-control" type="text" name="wisd_info[date_of_reg]" required/>
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>

                            <script type="text/javascript">
                              <?php
                              $tmp = explode('-',@$wisd_info['date_of_reg']);
                              ?>
                              $(function () {
                                $("#datetimepicker1").datepicker({
                                  autoclose: true,
                                  todayHighlight: true,
                                  format: 'dd/mm/yyyy',
                                  todayBtn: true,
                                  language: 'th',
                                  thaiyear: true
                                })<?php if(count($tmp)==3){?>.datepicker('update', new Date(Date.UTC(<?php echo $tmp[2];?>,<?php echo $tmp[1];?>-1,<?php echo $tmp[0];?>)));<?php }?>
                              });
                            </script>
                          </div>
                     </div>

                      <div class="form-group row">
                        <!-- <div class="col-xs-12 col-sm-3"><img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto; width: 70%;"></div> -->
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน:</span> </div>
                        <div class="col-xs-12 col-sm-3 has-error" style="padding: 3px 15px;">
                            <div class="input-group" style="width: 295px;">
                                <input  title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="req_pid" name="wisd_info[pid]" value="<?php echo $wisd_info['pid'];?>" required/>
                                <input type="hidden" id="pers_id" name="wisd_info[pers_id]" value="<?php echo $wisd_info['pers_id']; ?>">
                      
                              <div class="input-group-btn" style=" padding-bottom: 5px;">                            
                                <button type="button" title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_req_pid" style="background-color:#F2DEDE;  border-radius: 0px; border-color: #ed5565;color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                              </div>
                            </div>
                        </div>
                      
                        <script>
                          var req_pers = null;
                          var inputpid = "#req_pid";
                          var bt_spid = "#bt_req_pid";
                      var setData = "reqData"; //Declear Name

                      // $("input[name='elder_addr_chk']").prop('disabled',true);

                      var reqData = function(value) { //Set Structure Display Data
                        req_pers = value;

                        $("#name").html(value.name);
                        $("#date_of_birth").html(value.date_of_birth);
                        $("#gender_name").html(value.gender_name);
                      // $("#nation_name_th").html(value.nation_name_th);
                      // $("#relg_title").html(value.relg_title);
                      $("#pers_id").val(value.pers_id);
                      $("#reg_addr_id").val(req_pers.reg_addr_id);
                      $("#reg_addr").text(value.reg_add_info);

                      $('#addr_code').text(req_pers.reg_addr.addr_code);
                      $('#gps_addr').text(req_pers.reg_addr.addr_gps);

                    }


                      $(bt_spid).click(function(){//On Click for Search
                          if($(inputpid).val()!='') {//pid not null
                            $(bt_spid).attr('disabled',true); 
                            $("input[name='elder_addr_chk']").prop('disabled',false);    
                              if(pers_authen!=null) { //Check Personal Authen
                                  getPersInfo(inputpid,bt_spid,setData,true); //Get Data

                              }else if(!reader_status) { //Run Reader Personal
                                run_readerPers();
                                $(bt_spid).attr('disabled',false);
                                toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก","Authentications");
                              }
                          }else { //pid is null
                            $(inputpid).select();
                          }
                        });

                      <?php
                      if(isset($Valid)){
                        ?>
                        setTimeout(function(){$('#bt_req_pid').trigger('click');},1000);

                        <?php
                      }
                      ?>
                    </script>

                      </div>


                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">(คำนำหน้า) ชื่อตัว-ชื่อสกุล:</span></div>
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"  id="name"><?php echo @$wisd_info['name'];?></div>
                        <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name"> <?php echo @$wisd_info['gender_name'];?></span> </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด:</span></div>
                        <div class="col-xs-12 col-sm-9" style="padding: 7px 15px;" id="date_of_birth"> <?php echo @$wisd_info['date_of_birth'];?> </div>        
                       </div>

                    </div>

                    <div class="col-xs-12 col-sm-3">
                         <img id="img_profile" src="<?php if($wisd_info['img_file']==''){ echo path('noProfilePic.jpg','member');}else{ echo base_url('assets/modules/personals/uploads/'.$wisd_info['img_file']); }?>" width="70%" class="img-responsive" style="margin: 0 auto;">
                         <input type="file" name="img_profile"  class="img_0" accept="image/*"  style="display: none;" onchange="imgchange(this,'');">
                         <button type="button" class="btn btn-primary" style="position: relative;bottom: 35px; width: 70%; margin: 15%; margin-top: 0px;" onclick="brwImg(this,'');">อัปโหลดรูปภาพ</button>
                    </div>
                  
                  </div>

                  <div class="form-group row" style="margin-bottom: 0px;">
                        <!-- <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"> <?php echo @$wisd_info['nation_name_th'];?></span> </div>
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ศาสนา</span> <span id="relg_title"> <?php echo @$wisd_info['relg_title'];?> </span> </div> -->
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ (ตามทะเบียนบ้าน):</span><input type="hidden" id="reg_addr_id" name="pers_info[reg_addr_id]" value="<?php echo @$wisd_info['reg_addr_id']; ?>"></div>
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เลขรหัสประจำบ้าน</span></div>
                          <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;" id="addr_code"><?php echo $wisd_info['addr_code']; ?></span></div>
                          <div class="col-xs-12 col-sm-3" >
                          <!-- <div class="input-group" style="width: 295px;">
                            <input  id="gps_addr" title="เลือกพิกัด" placeholder="เลือกพิกัด" class="form-control " type="text"   value="" />                           
                            <div class="input-group-btn" style=" padding-bottom: 5px;">   
                              <button type="button" title="ตำแหน่งพิกัดภูมิศาสตร์"  class="btn btn-default "  onclick="mode_gps('save_addr1');" style=" border-radius: 0px; padding:5px 12px;"><i class="fa fa-map-marker" aria-hidden="true"></i></button>                            
                            </div>
                          </div>  -->               
                        </div>           
                      </div>
                      
                      <div class="form-group row">
                         <div class="col-xs-12 col-sm-9 col-sm-offset-3" style="padding: 7px 15px;" id="reg_addr"><?php echo @$wisd_info['reg_add_info']; ?></div>
                      </div>

                
                         <div class="form-group row">
                        <div class="col-xs-12 col-sm-9 col-sm-offset-3">
                          <div class="col-lg-12" id="integration1" hidden='hidden'>
                            <div class="ibox float-e-margins">
                              <div class="ibox-content" style="padding-bottom: 0px">
                                <div class="table-responsive">
                                  <table class="table table-bordered">
                                    <thead>
                                      <tr>
                                        <th style="background-color: #459597; color: #fff">ข้อมูลบูรณาการ</th>
                                        <th style="background-color: #459597; color: #fff">หน่วยงาน</th>
                                        <th style="background-color: #459597; color: #fff">รายละเอียด</th>
                                        <th style="background-color: #459597; color: #fff">#</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <!--
                                    <tr>
                                        <td>
                                            <label>ขึ้นทะเบียนผู้มีรายได้น้อย</label>
                                            <div style="font-size: 18px;">(กรมการปกครอง)</div>
                                        </td>
                                        <td>
                                            <label>วันที่ขึ้นทะเบียน</label>
                                            <div style="font-size: 18px;">-</div>
                                        </td>
                                        <td>
                                            <label>สถานะการได้รับความช่วยเหลือ</label>
                                            <div style="font-size: 18px; color: green;">-</div>
                                        </td>
                                        <td></td>
                                        <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                                    </tr>
                                  -->
                                  <tr>
                                    <td>
                                      <b>อายุผู้ขอรับบริการ</b> วัน/เดือน/ปี/เกิด : <span id="row1_date_of_birth">-</span>
                                    </td>
                                    <td>
                                      กรมการปกครอง
                                    </td>
                                    <td>
                                      60 ปีขึ้นไป
                                    </td>
                                    <td id="row1_state"><i class="fa fa-times text-danger"></i></td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <b>สถานะการเสียชีวิต</b> วัน/เดือน/ปีเสียชีวิต : <span id="row2_date_of_death">-</span>
                                    </td>
                                    <td>
                                      กรมการปกครอง
                                    </td>
                                    <td>
                                      มีชีวิตอยู่
                                    </td>
                                    <td id="row2_state"><i class="fa fa-times text-danger"></i></td>
                                  </tr>
                                <!--   <tr>
                                    <td>
                                      <b>ความจำเป็นพื้นฐาน (จปฐ.)</b>
                                      <select class="form-control m-b" id="accountJPTH" style="overflow:auto;">
                                        <option>อาชีพ (ปัจจุบัน) : - รายได้เฉลี่ย - (บาท/เดือน) :  ที่มาของรายได้ : - </option>
                                      </select>
                                    </td>
                                    <td>
                                      กรมการพัฒนาชุมชน
                                    </td>
                                    <td>
                                      ไม่เกิน 38,000
                                    </td>
                                    <td id="row3_state"><i class="fa fa-times text-danger"></i></td>
                                  </tr> -->
                                 <!--  <tr>
                                    <td>
                                      <b>ทะเบียนจัดหางานผุ้สูงอายุ</b> วันที่ขึ้นทะเบียน : <span id="row4_date_of_reg_th">-</span> สถานะการได้รับงาน : <span id="row4_reg_status">-</span>
                                    </td>
                                    <td>
                                      กรมการจัดหางาน
                                    </td>
                                    <td>
                                    </td>
                                    <td id="row4_state"><i class="fa fa-times text-danger"></i></td>
                                  </tr> -->
                                  <!-- <tr>
                                    <td>
                                      <b>กองทุนผู้สูงอายุ</b> ประวัติการกู้ยืมกองทุน : <span id="row5_loan_history">-</span> สถานะสัญญากู้ยืม : <span id="row5_contract_status">-</span>
                                    </td>
                                    <td>
                                      กรมกิจการผู้สูงอายุ
                                    </td>
                                    <td>
                                    </td>
                                    <td id="row5_state"><i class="fa fa-times text-danger"></i></td>
                                  </tr> -->
                                  <!-- <tr>
                                    <td>
                                      <b>การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก</b> ประวัติการได้รับการสงเคราะห์ : <span id="row6_history">-</span> ภายในรอบปีนี้ <span id="row6_year_now_history">-</span> (ครั้ง) :
                                    </td>
                                    <td>
                                      กรมกิจการผู้สูงอายุ
                                    </td>
                                    <td>
                                    </td>
                                    <td id="row6_state"><i class="fa fa-times text-danger"></i></td>
                                  </tr> -->
                                    <!--
                                    <tr>
                                        <td>
                                            <b>ศูนย์พัฒนาการจัดสวัสดิการสังคมฯ</b> ประวัติการได้รับบริการ : <span id="row7_history">-</span> ภายในรอบปีนี้ <span id="row7_year_now_history">-</span> (ครั้ง) ศูนย์ที่รับเข้ารับบริการ (ล่าสุด) : <span id="row7_req_org">-</span>
                                        </td>
                                        <td>
                                          กรมกิจการผู้สูงอายุ
                                        </td>
                                        <td>
                                        </td>
                                        <td id="row7_state"><i class="fa fa-times text-danger"></i></td>
                                    </tr>
                                  -->

                                   <tr>
                                        <td>
                                            <b>ตรวจสอบสถานะการขึ้นทะเบียนคลังปัญญาผู้สูงอายุ</b> 
                                        </td>
                                        <td>
                                          กรมกิจการผู้สูงอายุ
                                        </td>
                                        <td>
                                           <span id="val8_branch" style="color: green;"></span>
                                        </td>
                                        <td id="row8_state"><i class="fa fa-check text-navy"></i></td>
                                    </tr>

                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3"><span style="font-weight: bold;">ที่อยู่ (ปัจจุบัน): </span></div>                                   
                        <div class="col-xs-12 col-sm-9">( <div class="checkbox-inline i-checks"><label><input type="checkbox" name="elder_addr_chk"> ตรงกับที่อยู่ตามทะเบียนบ้าน</label></div> )</div>
                      </div>

                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3 col-sm-offset-3" style="padding: 3px 15px;">
                            <span style="font-weight: bold; color: red;">เลขรหัสประจำบ้าน:</span>
                        </div>
                        <div class="col-xs-12 col-sm-3 has-error" >
                            <div class="input-group" style="width: 295px;">
                                <input  title="เลขรหัสประจำบ้าน" placeholder="xxxx xxxxxx x" class="form-control elder_addr_pre" type="text" id="address_che" name="" value="<?php echo @$addr_info['addr_code']; ?>" required/>
                                      
                              <div class="input-group-btn" style=" padding-bottom: 5px;">                            
                                <button id="btn_addr" type="button" title="ตรวจสอบ" class="btn btn-default " onclick="check_addr()" style="background-color:#F2DEDE;  border-radius: 0px; border-color: #ed5565;color: #ed5565;padding:5px 12px;"><i class="fa fa-search" aria-hidden="true"></i></button>
                              </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3">
                          <?php
                        $addr_gps = @$addr_info['addr_gps']; // Old Data $diff_info['addr_gps']
                        if($addr_gps=='') {
                        $addr_gps ='0,0'; // Set Default Data
                      }
                      $arr = explode(',',$addr_gps);
                      ?>
                      <script type="text/javascript">
                        var latitude = '<?php echo $arr[0];?>';
                        var longitude = '<?php echo $arr[1];?>';
                        //var latitude_center = latitude=='0'?'13.5847536':latitude;
                        //var longitude_center = longitude=='0'?'13.5847536':longitude;
                        var marker_img = '<?php echo path('map-marker.png','webconfig');?>';
                        if(latitude!='0' && longitude!='0') {
                          setTimeout(function(){
                        $("#lat_value").val(latitude);  // เอาค่า latitude ตัว marker แสดงใน textbox id=lat_value
                        $("#lon_value").val(longitude);  // เอาค่า longitude ตัว marker แสดงใน textbox id=lon_value
                        //$("#zoom_value").val(map.getZoom());  // เอาขนาด zoom ของแผนที่แสดงใน textbox id=zoom_valu
                      },1500);
                        }

                        function check_addr(){
                           // console.log($('#address_che').val());
                           $.ajax({
                            url: base_url+'intelprop/check_addr',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                              'addr_code': $('#address_che').val(),
                              'csrf_dop': csrf_hash
                            },
                            success: function (value) {
                              console.log(value);
                              if(value.history!='ไม่พบ'){
                                toastr.success("ดึงข้อมูลเสร็จสิ้น","หน้าต่างแจ้งเตือน");
                                $('#addr_home_no').val(value.history[0].addr_home_no);
                                $('#addr_gps').val(value.history[0].addr_gps);
                                $('#addr_moo').val(value.history[0].addr_moo);
                                $('#alley').val(value.history[0].addr_alley);
                                $('#lane').val(value.history[0].addr_lane);
                                $('#road').val(value.history[0].addr_road);

                                
                                // $('#Province').trigger('change',function(){

                                //     $('#Province').each(function(){
                                //      if($(this).val()==value.history[0].addr_province){
                                //       $(this).prop("selected","selected");
                                //     }
                                //   });
                                  
                                // });

                                // $('#Province').val(''+value.history[0].addr_province).trigger('change',function(){ optionGen(this,'Amphur',value.history[0].addr_district);});
                                $('#Province').val(''+value.history[0].addr_province).trigger('change');

                                if(!$("input[name=elder_addr_chk]").prop('checked')){
                                   $('#Amphur,#Tambon').prop("disabled",false);
                                }

                                setTimeout(function(){
                                  // $('#Amphur').val(''+value.history[0].addr_district).trigger('change',function(){ optionGen(this,'Tambon',value.history[0].addr_sub_district);});
                                  $('#Amphur').val(''+value.history[0].addr_district).trigger('change');
                                  // $('#Tambon').val(''+value.history[0].addr_sub_district).trigger('change');
                                },2000);

                                setTimeout(function(){
                                  // $('#Amphur').val(''+value.history[0].addr_district).trigger('change',function(){ optionGen(this,'Tambon',value.history[0].addr_sub_district);});
                                  // $('#Amphur').val(''+value.history[0].addr_district).trigger('change');
                                  $('#Tambon').val(''+value.history[0].addr_sub_district).trigger('change');
                                },5000);




                                $('#addr_zipcode').val(value.history[0].addr_zipcode);

                              }else{
                                toastr.warning("ไม่พบข้อมูล","หน้าต่างแจ้งเตือน");
                              }

                            }
                          });
                        }
                        
                      </script>

                      <div class="input-group" style="width: 295px;">
                        <input  id="gps" title="เลือกพิกัด" placeholder="เลือกพิกัด" class="form-control elder_addr_pre" type="text"   value="" />                           
                        <div class="input-group-btn" style=" padding-bottom: 5px;">   
                          <button type="button" title="ตำแหน่งพิกัดภูมิศาสตร์" class="btn btn-default elder_addr_pre"  onclick="mode_gps('save_addr2');" style=" border-radius: 0px; padding:5px 12px;"><i class="fa fa-map-marker" aria-hidden="true"></i></button>                            
                        </div>
                      </div>
                      
                      &nbsp;
                      <input type="hidden" name="pers_addr[addr_gps]" value="<?php echo $addr_gps;?>" id="addr_gps">
                      <span id="addr_gpg_txt" style="display: none;"><?php if($addr_gps!='0,0') { echo '('.$addr_gps.')';}?></span>
                    </div>
                  </div>
                    
                  <div class="form-group row">
                   <!--  <select title="สานะการพักอาศัย" placeholder="เลือกสถานะการพักอาศัย" class="form-control" name="pers_info[pre_addr_status]" style="display: none;">
                      <option value="">เลือกสถานะการพักอาศัย</option>
                      <option value="บ้านตนเอง" <?php if(@$wisd_info['pre_addr_status'] == 'บ้านตนเอง'){ echo "selected";} ?>>บ้านตนเอง</option>
                      <option value="อาศัยผู้อื่นอยู่" <?php if(@$wisd_info['pre_addr_status'] == 'อาศัยผู้อื่นอยู่'){ echo "selected";} ?>>อาศัยผู้อื่นอยู่</option>
                      <option value="บ้านเช่า" <?php if(@$wisd_info['pre_addr_status'] == 'บ้านเช่า'){ echo "selected";} ?>>บ้านเช่า</option>
                      <option value="อยู่กับผู้จ้าง" <?php if(@$wisd_info['pre_addr_status'] == 'อยู่กับผู้จ้าง'){ echo "selected";} ?>>อยู่กับผู้จ้าง</option>
                      <option value="ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง" <?php if(@$wisd_info['pre_addr_status'] == 'ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง'){ echo "selected";} ?>>ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง</option>
                    </select> -->
                    
                    <div class="col-xs-12 col-sm-3 col-sm-offset-3">
                      <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                     <input type="hidden" name="pre_addr_id" value="<?php echo @$wisd_info['pre_addr_id']; ?>">
                     <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_home_no]" id="addr_home_no" value="<?php echo @$addr_info['addr_home_no']; ?>" />
                   </div>
                   <div class="col-xs-12 col-sm-1">
                    <label for="" class="col-2 col-form-label">หมู่ที่</label>
                  </div>
                  <div class="col-xs-12 col-sm-1">
                    <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_moo]" id="addr_moo" value="<?php echo @$addr_info['addr_moo']; ?>"/>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-xs-12 col-sm-3 col-sm-offset-3 dropdown">
                    <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>                    
                  </div>
                  <div class="col-xs-12 col-sm-6 dropdown">
                       <input id="alley" title="ตรอก" placeholder="ตัวอย่าง บ้านหล่อ" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_alley]" value="<?php echo @$addr_info['addr_alley']; ?>" />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-xs-12 col-sm-3 col-sm-offset-3 dropdown">
                    <label for="example-text-input" class="col-2 col-form-label">ซอย</label>                  
                  </div>
                  <div class="col-xs-12 col-sm-6 dropdown">
                    <input id="lane" title="ซอย" placeholder="ตัวอย่าง วรพงษ์" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_lane]" value="<?php echo @$addr_info['addr_lane']; ?>" />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-xs-12 col-sm-3 col-sm-offset-3 dropdown">
                    <label for="example-text-input" class="col-2 col-form-label">ถนน</label>                 
                  </div>
                  <div class="col-xs-12 col-sm-6 dropdown">
                    <input id="road" title="ถนน" placeholder="ตัวอย่าง ปรินายก" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_road]" value="<?php echo @$addr_info['addr_road']; ?>" />
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-xs-12 col-sm-3 col-sm-offset-3 dropdown">
                    <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>                      
                  </div>
                  <div class="col-xs-12 col-sm-3 dropdown">
                   <select title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="pers_addr[addr_province]" onchange="optionGen(this,'Amphur',<?php echo @$addr_info['district_code']; ?>);">
                    <option value="">เลือกจังหวัด</option>
                    <?php $temp = $this->personal_model->getAll_Province();
                    foreach ($temp as $key => $row) { ?>
                    <option value="<?php echo $row['area_code']; ?>"><?php echo $row['area_name_th']; ?></option>
                    <?php  } ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-12 col-sm-3 col-sm-offset-3 dropdown">
                  <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>                    
                </div>
                <div class="col-xs-12 col-sm-3 dropdown">
                  <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="pers_addr[addr_district]" onchange="optionGen(this,'Tambon',<?php echo @$addr_info['sub_district_code']; ?>);" disabled>
                    <option value="">เลือกอำเภอ</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-12 col-sm-3 col-sm-offset-3 dropdown">
                  <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>                   
                </div>
                <div class="col-xs-12 col-sm-3 dropdown">
                  <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon" name="pers_addr[addr_sub_district]" disabled>
                    <option value="">เลือกตำบล</option>                   
                  </select>
                </div>
                <div class="col-xs-12 col-sm-2 dropdown" style="width: 10%">
                  <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                </div>
                <div class="col-xs-12 col-sm-1 " style="width: 15%">
                  <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_zipcode]" id="addr_zipcode" value="<?php echo @$addr_info['addr_zipcode']; ?>" />
                </div>
              </div>

                    
                    <div class="form-group row">
                    
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ):</label>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="pers_info[tel_no]" id="tel_no" value="<?php echo $wisd_info['tel_no'];?>"/>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="example-text-input" class="col-2 col-form-label">สถานะการสมรส:</label>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <select title="สถานะการสมรส" placeholder="เลือกสถานะการสมรส" class="form-control" name="pers_info[marital_status]" id="marital_status" >
                            <option value="">เลือกสถานะการสมรส</option>
                            <option value="โสด" <?php if(@$wisd_info['marital_status'] == 'โสด'){ echo "selected"; } ?>>โสด</option>
                            <option value="สมรส อยู่ด้วยกัน" <?php if(@$wisd_info['marital_status'] == 'สมรส อยู่ด้วยกัน'){ echo "selected"; } ?>>สมรส อยู่ด้วยกัน</option>
                            <option value="สมรส แยกกันอยู่" <?php if(@$wisd_info['marital_status'] == 'สมรส แยกกันอยู่'){ echo "selected"; } ?>>สมรส แยกกันอยู่</option>
                            <option value="หย่าร้าง" <?php if(@$wisd_info['marital_status'] == 'หย่าร้าง'){ echo "selected"; } ?>>หย่าร้าง</option>
                            <option value="ไม่ได้สมรส แต่อยู่ด้วยกัน" <?php if(@$wisd_info['marital_status'] == 'ไม่ได้สมรส แต่อยู่ด้วยกัน'){ echo "selected"; } ?>>ไม่ได้สมรส แต่อยู่ด้วยกัน</option>
                            <option value="หม้าย (คู่สมรสเสียชีวิต)" <?php if(@$wisd_info['marital_status'] == 'หม้าย (คู่สมรสเสียชีวิต)'){ echo "selected"; } ?>>หม้าย (คู่สมรสเสียชีวิต)</option>
                          </select>
                      </div>
                    </div>

                    <div class="form-group row">               
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา:</label>                  
                      </div>
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control" name="pers_info[edu_code]" id="edu_code">
                            <option value="">เลือกระดับการศึกษา</option>
                            <?php $temp = $this->personal_model->getAll_edu_level();
                            foreach ($temp as $key => $row) { ?>
                            <option value="<?php echo $row['edu_code']; ?>" <?php if(@$wisd_info['edu_code'] == $row['edu_code']){ echo "selected"; } ?>><?php echo $row['edu_title']; ?></option>
                            <?php  } ?>
                          </select>
                      </div>
                      <div class="col-xs-12 col-sm-3 ">
                        <label for="example-text-input" class="col-2 col-form-label">อื่นๆ ระบุ</label>
                      </div>
                      <div class="col-xs-12 col-sm-3 ">
                         <input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" name="pers_info[src_of_income_identify]" id="src_of_income_identify" value="<?php echo @$wisd_info['src_of_income_identify']; ?>"/>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3 ">
                        <label for="" class="col-2 col-form-label">อาชีพ (ปัจจุบัน):</label>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <input title="อาชีพ (ปัจจุบัน)" placeholder="ระบุอาชีพ (ปัจจุบัน)" class="form-control" type="text" name="pers_info[occupation]" id="occupation" value="<?php echo @$wisd_info['occupation']; ?>" />
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">รายได้เฉลี่ย (บาท/เดือน)</label>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <input title="รายได้เฉลี่ย (บาท/เดือน)" placeholder="ระบุรายได้เฉลี่ย (บาท/เดือน)" class="form-control numberonly" type="text" name="pers_info[mth_avg_income]" id="mth_avg_income" value="<?php echo @$wisd_info['mth_avg_income']; ?>"/>
                      </div>
                    </div>



                    <!-- <div class="form-group row" style="display: none;">
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">ที่มาของรายได้</label>
                        <div class="col-10">
                          <select title="ที่มาของรายได้" placeholder="เลือกที่มาของรายได้" class="form-control" name="pers_info[src_of_income]">
                            <option value="">เลือกที่มาของรายได้</option>
                            <option value="ด้วยตนเอง">ด้วยตนเอง</option>
                            <option value="ผู้อื่นให้">ผู้อื่นให้</option>
                            <option value="อื่น ๆ">อื่น ๆ</option>
                          </select>
                        </div>
                      </div>                     
                    </div> -->
                                                   
                          </div>
                          </div><!-- close panel-group-->
                        </div>
                             
                        </div><!-- close panel-body -->
                        <!--
                        <div id="tab-2" <?php /*if($usrpm['app_id']==23){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }*/?>>
                          <div class="panel-body">
                            <strong>Tab-2</strong>
                          </div>
                        </div>
                        -->

                         <hr>
                         <div class="row">
                          <div class="col-xs-12 col-sm-8">&nbsp;</div>
                          <div class="col-xs-12 col-sm-2">
                            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-save" onclick="return opnCnfrom()"><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
                          </div>
                          <div class="col-xs-12 col-sm-2">
                            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('intelprop/intelprop_list');?>'"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
                          </div>
                        </div><!-- close class row-->
                      </div>

                    </div>

                  </div>

                </div>

<!-- *********************************************body*js************************************************************************ -->

                <script type="text/javascript">
                  $(document).ready(function () {
                    $('.i-checks').iCheck({
                      checkboxClass: 'icheckbox_square-green',
                      radioClass: 'iradio_square-green',
                      increaseArea: '20%'
                    });

                    <?php if($process_action !="Edited"){ ?>
                        $("input[name='elder_addr_chk']").prop('disabled',true);
                   <?php  } ?>

                    $("input[name='elder_addr_chk']").on('ifClicked',function(){

                            if(!$(this).prop('checked')) {
                              $(".elder_addr_pre").attr('disabled',true);
                               $('#address_che').val($('#addr_code').text());
                               setTimeout(function(){$('#btn_addr').trigger('click');},1000);
                            }else {
                              $(".elder_addr_pre").attr('disabled',false);
                              $('#address_che').val('');
                              $(".elder_addr_pre").val('');
                            }                    
                    });

                 
                  });
                </script>


                <script>
                  <?php
                  if(($wisd_info['reg_addr_id']==$wisd_info['pre_addr_id']) && ($wisd_info['reg_addr_id']!=''&&$wisd_info['pre_addr_id']!='')) {
                    ?>
                    $(function(){
                      $("input[name='elder_addr_chk']").parent().addClass('checked');
                      $("input[name='elder_addr_chk']").prop('checked',true);
                      $(".elder_addr_pre").attr('disabled',true);
                    });
                    <?php
                  }
                  ?>
                </script>

                <script type="text/javascript">
                <?php if($process_action == 'Edited'){ ?>
                  $('#req_pid').val(<?php echo $wisd_info['pid']; ?>);
                setTimeout(function(){$("#Province").val('<?php echo @$addr_info['province_code']; ?>').trigger('change');},200);
                //setTimeout(function(){$("#Amphur").val('<?php echo @$addr_info['district_code']; ?>').trigger('change');},300);
                // setTimeot(function(){$("#Tambon").val('<?php echo @$addr_info['sub_district_code']; ?>').trigger('change');},400);
                <?php } ?>

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
                          <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                        },
                      })

                      .done(function(ret) {
                        console.log("success");
                        console.dir(ret);
                        $('#'+target).empty();
                        // if($("input[name='elder_addr_chk']").prop('checked') == true){
                        //   $('#'+target).prop('disabled', true);
                        // }else{
                        //   $('#'+target).prop('disabled', false);
                        // }
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
                      
                      function Del_photo(node,id_photo){
                      
                      $.ajax({
                      url: base_url+'intelprop/del_wisd_photo',
                      type: 'POST',
                      dataType: 'html',
                      data: {
                      'id_photo': id_photo,
                      <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                      },
                      success: function(result){
                      if(result=="remove"){
                      $('node').parent().parent().parent().remove();
                      }
                      }
                      });
                      
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
                                    <input type="hidden" value="" id="button">
                                    <button  type="button" class="btn btn-default" style="margin-top: 22px; width: 100%" name="button"  onclick="select_location(this);"  >Save</button>
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

                      <!-- Cropper imgprofile -->         
                      <!-- Modal -->
                      <div class="modal fade bs-example-modal-lg" id="myModal_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              
                              <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                            </div>
                            <div class="modal-body">

                             
                            </div> <!-- End modal-body -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">ตกลง</button>      
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Cropper imgprofile -->

                         <!-- Confirm Add branch Modal -->
                      <div id="Confirm_branch" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                              <h4 class="modal-title" style="color: #333; font-size: 20px;">หน้าต่างแจ้งเตือนเพื่อยืนยัน</h4>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                 <div class="col-xs-12 col-sm-12"><font style="font-size: 16px;" id="text_Cbranch1"></font></div>
                                 <div class="col-xs-12 col-sm-12"><font style="font-size: 16px;" id="text_Cbranch2"></font></div>
                               </div>

                               
                            </div>
                            <div class="modal-footer">
                              <a id="btn_branch" type="button" class="btn btn-warning">ตกลง</a>
                              <button id="btn_cancel" type="button" style="margin-bottom: 5px;" aria-hidden="true" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            </div>
                          </div>
                        </div>
                      </div>

                      <script type="text/javascript">
                         
                         $("#btn_cancel").click(function(){
                              var clear_detail_pid ={
                                'name':'-',
                                'date_of_birth':'-',
                                'gender_name':'-',
                                'pers_id':'',
                                'reg_addr_id':'',
                                'reg_add_info':'',
                                'reg_addr':{'addr_code':'','addr_gps':''},
                              };
                              reqData(clear_detail_pid);

                              $("#req_pid").val('');
                              $("#integration1").css('display','none');
                              $("#req_pid").focus();

                              $("input[name='elder_addr_chk']").prop('disabled',true);
                         });

                      </script>
                      <!-- End Confirm Add branch Modal -->

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

                      <script>

                        function mode_gps(value){
                           $('#modal_marker').modal('show');
                           $('#button').val(value);
                        }

                        function numberWithCommas(x) {
                          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                        }
                        Object.size = function(obj) {
                          var size = 0, key;
                          for (key in obj) {
                            if (obj.hasOwnProperty(key)) size++;
                          }
                          return size;
                        };

                        var integration1 = function(info) {

  $("#integration1").show();//Show Dialog

  //Service 1
  if(info.age>=60) {
    info.date_of_birth = info.date_of_birth==''?'-':info.date_of_birth;
    $("#row1_date_of_birth").html("<span style='color:green'>"+info.date_of_birth+"</span>");
    $("#row1_state").html("<i class='fa fa-check text-navy'></i>");
  }else {
    info.date_of_birth = info.date_of_birth==''?'-':info.date_of_birth;
    $("#row1_date_of_birth").html("<span style='color:red'>"+info.date_of_birth+"</span>");
    $("#row1_state").html("<i class='fa fa-times text-danger'></i>");
    $(".btn-save").prop('disabled',true);
  }
  //$("#pers_old").html(info.age);
  //End Service 1

  //Service 2
  if(info.date_of_death!='') {
    info.date_of_death = info.date_of_death==''?'-':info.date_of_death;
    $("#row2_date_of_death").html("<span style='color:red'>"+info.date_of_death+"</span>");
    $("#row2_state").html("<i class='fa fa-times text-danger'></i>");
    $(".btn-save").prop('disabled',true);
  }else {
    info.date_of_death = info.date_of_death==''?'-':info.date_of_death;
    $("#row2_date_of_death").html("<span style='color:green'>"+info.date_of_death+"</span>");
    $("#row2_state").html("<i class='fa fa-check text-navy'></i>");
  }
  //End Service 2
  info.reg_addr.addr_home_no = info.reg_addr.addr_home_no==null?'-':info.reg_addr.addr_home_no;
  info.reg_addr.addr_sub_district = info.reg_addr.addr_sub_district==null?'-':info.reg_addr.addr_sub_district;
  //Service 3
  // $.ajax({
  //   url: 'https://gateway.dop.go.th/transfer/import/RequestElderyJPTH',
  //   type: 'POST',
  //   dataType: 'json',
  //   data: {
  //     'Username': 'dopjpth',
  //     'Password': 'dpuser',
  //     'OfficerPID': pers_authen.pid,
  //     'addr_home_no': info.reg_addr.addr_home_no,
  //     'addr_sub_district': info.reg_addr.addr_sub_district,
  //     'csrf_dop': csrf_hash
  //   },
  //     success: function (value) { //Result True
  //       //console.log("success");console.dir(value);
  //       if(Object.keys(value).length) {
  //         console.log(value);
  //         if(value[0].message!='') {
  //           toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");
  //           $("#accountJPTH").html("ไม่พบข้อมูล.");
  //           $("#row3_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
  //         }else {
  //           //toastr.success("ดึงข้อมูลความจำเป็นพื้นฐาน (จปฐ.)เสร็จสิ้น","หน้าต่างแจ้งเตือน");
  //           $("#accountJPTH").html("");
  //           $("#accountJPTH").attr("size",Object.size(value));
  //           $(value).each(function(key,data) {
  //             console.log(data);
  //             $("<option value="+data.Q23AvgIncome+">อาชีพ (ปัจจุบัน) : "+data.Career+" รายได้เฉลี่ย "+numberWithCommas(data.Q23AvgIncome)+" (บาท/เดือน) :  ที่มาของรายได้ : - *("+data.MemberName+" "+data.MemberLastName+") บ้านเลขที่"+data.HHNumber+" หมู่บ้าน "+data.VillName+" ซอย "+data.Soi+" ถนน "+data.Tanon+"</option>").appendTo($("#accountJPTH"));
  //           });
  //         }
  //       }else { //Result no Data
  //         toastr.warning("ไม่พบข้อมูลความจำเป็นพื้นฐาน (จปฐ.)","หน้าต่างแจ้งเตือน");
  //         $("#accountJPTH").html("ไม่พบข้อมูล.");
  //         $("#row3_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //       }
  //     },
  //     error:function() { //Result Error
  //       toastr.error("ดึงข้อมูลความจำเป็นพื้นฐาน (จปฐ.)ล้มเหลว","หน้าต่างแจ้งเตือน");
  //       $("#accountJPTH").html("ไม่พบข้อมูล.");
  //       $("#row3_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //     },
  //   });
  // $("#accountJPTH").change(function() {
  //   console.log();
  //   if($(this).val()>38000) {
  //     $("#row3_state").html("<i class='fa fa-times text-danger'></i>");
  //   }else {
  //     $("#row3_state").html("<i class='fa fa-check text-navy'></i>");
  //   }
  // });
  //End Service 3

  //Service 4
  // $.ajax({
  //   url: 'https://gateway.dop.go.th/transfer/import/RequestOlderEmploymentRegistration',
  //   type: 'POST',
  //   dataType: 'json',
  //   data: {
  //     'eldery_pid': info.pid,
  //     'csrf_dop': csrf_hash
  //   },
  //     success: function (value) { //Result True
  //       //console.log("success");console.dir(value);
  //       if(Object.keys(value).length) {
  //         console.log(value);
  //         if(value[0].message!='') {
  //           toastr.warning("ไม่พบข้อมูลทะเบียนจัดหางานผุ้สูงอายุ","หน้าต่างแจ้งเตือน");
  //           $("#row4_date_of_reg_th").html("<span>-</span>");
  //           $("#row4_reg_status").html("<span>-</span>");
  //           $("#row4_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
  //         }else {
  //           //toastr.success("ดึงข้อมูลทะเบียนจัดหางานผุ้สูงอายุเสร็จสิ้น","หน้าต่างแจ้งเตือน");
  //           if(value[0].date_of_reg!='') {
  //             $("#row4_date_of_reg_th").html("<span style='color:green'>"+value[0].date_of_reg_th+"</span>");
  //           }
  //           if(value[0].reg_status=="ยังไม่ได้งาน") {
  //             $("#row4_reg_status").html("<span style='color:#D25200'>"+value[0].reg_status+"</span>");
  //           }else {
  //             $("#row4_reg_status").html("<span style='color:green'>"+value[0].reg_status+"</span>");
  //           }
  //           $("#row4_state").html("<i class='fa fa-check text-navy'></i>");
  //         }
  //       }else { //Result no Data
  //         toastr.warning("ไม่พบข้อมูลทะเบียนจัดหางานผุ้สูงอายุ","หน้าต่างแจ้งเตือน");
  //         $("#row4_date_of_reg_th").html("<span>-</span>");
  //         $("#row4_reg_status").html("<span>-</span>");
  //         $("#row4_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //       }
  //     },
  //     error:function() { //Result Error
  //       toastr.error("ดึงข้อมูลทะเบียนจัดหางานผุ้สูงอายุล้มเหลว","หน้าต่างแจ้งเตือน");
  //       $("#row4_date_of_reg_th").html("<span>-</span>");
  //       $("#row4_reg_status").html("<span>-</span>");
  //       $("#row4_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //     },
  //   });
  //End Service 4

  //Service 5
  // $.ajax({
  //   url: 'https://gateway.dop.go.th/transfer/import/RequestElderyFoundation',
  //   type: 'POST',
  //   dataType: 'json',
  //   data: {
  //     'Username': 'dopuser',
  //     'Password': 'dpuser',
  //     'OfficerPID': pers_authen.pid,
  //     'TargetPID': info.pid,
  //     'csrf_dop': csrf_hash
  //   },
  //     success: function (value) { //Result True
  //       //console.log("success");console.dir(value);
  //       if(Object.keys(value).length) {
  //         console.log(value);
  //         if(value.message!='') {
  //           toastr.warning("ไม่พบข้อมูลประวัติการกู้ยืมกองทุน","หน้าต่างแจ้งเตือน");
  //           $("#row5_loan_history").html("<span>-</span>");
  //           $("#row5_contract_status").html("<span>-</span>");
  //           $("#row5_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
  //         }else {
  //           //toastr.success("ดึงข้อมูลประวัติการกู้ยืมกองทุนเสร็จสิ้น","หน้าต่างแจ้งเตือน");
  //           if(value.loan_history=='มีประวัติ') {
  //             $("#row5_loan_history").html("<span style='color:green'>"+value.loan_history+"</span>");
  //           }else {
  //             $("#row5_loan_history").html("<span style='color:#D25200'>"+value.loan_history+"</span>");
  //           }
  //           if(value.contract_status=="ปิดสัญญาแล้ว") {
  //             $("#row5_contract_status").html("<span style='color:#D25200'>"+value.contract_status+"</span>");
  //           }else {
  //             $("#row5_contract_status").html("<span style='color:green'>"+value.contract_status+"</span>");
  //           }
  //           $("#row5_state").html("<i class='fa fa-check text-navy'></i>");
  //         }
  //       }else { //Result no Data
  //         toastr.warning("ไม่พบข้อมูลประวัติการกู้ยืมกองทุน","หน้าต่างแจ้งเตือน");
  //         $("#row5_loan_history").html("<span>-</span>");
  //         $("#row5_contract_status").html("<span>-</span>");
  //         $("#row5_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //       }
  //     },
  //     error:function() { //Result Error
  //       toastr.error("ดึงข้อมูลประวัติการกู้ยืมกองทุนล้มเหลว","หน้าต่างแจ้งเตือน");
  //       $("#row5_loan_history").html("<span>-</span>");
  //       $("#row5_contract_status").html("<span>-</span>");
  //       $("#row5_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //     },
  //   });
  //End Service 5

  //Service 6
  // $.ajax({
  //   url: base_url+'difficult/getHistory',
  //   type: 'POST',
  //   dataType: 'json',
  //   data: {
  //     'pers_id': info.pers_id,
  //     'csrf_dop': csrf_hash
  //   },
  //     success: function (value) { //Result True
  //       //console.log("success");console.dir(value);
  //       if(Object.keys(value).length) {
  //         console.log(value);
  //         if(value.message!='') {
  //           toastr.warning("ไม่พบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก","หน้าต่างแจ้งเตือน");
  //           $("#row6_history").html("<span>-</span>");
  //           $("#row6_year_now_history").html("<span>-</span>");
  //           $("#row6_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
  //         }else {
  //           //toastr.success("ตรวจสอบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบากเสร็จสิ้น","หน้าต่างแจ้งเตือน");
  //           if(value.history=='มีประวัติ') {
  //             $("#row6_history").html("<span style='color:#D25200'>"+value.history+"</span>");
  //           }else {
  //             $("#row6_history").html("<span style='color:green'>"+value.history+"</span>");
  //           }
  //           if(value.year_now_history>0) {
  //             $("#row6_year_now_history").html("<span style='color:red'>"+value.year_now_history+"</span>");
  //           }else {
  //             $("#row6_year_now_history").html("<span style='color:green'>"+value.year_now_history+"</span>");
  //           }
  //           $("#row6_state").html("<i class='fa fa-check text-navy'></i>");
  //         }
  //       }else { //Result no Data
  //         toastr.warning("ไม่พบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก","หน้าต่างแจ้งเตือน");
  //         $("#row6_history").html("<span>-</span>");
  //         $("#row6_year_now_history").html("<span>-</span>");
  //         $("#row6_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //       }
  //     },
  //     error:function() { //Result Error
  //       toastr.error("ตรวจสอบข้อมูลการสงเคราะห์ผู้สูงอายุในภาวะยากลำบากล้มเหลว","หน้าต่างแจ้งเตือน");
  //       $("#row6_history").html("<span>-</span>");
  //       $("#row6_year_now_history").html("<span>-</span>");
  //       $("#row6_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
  //     },
  //   });
  //End Service 6

/*  //Service 7
    $.ajax({
    url: base_url+'welfare/getHistory',
    type: 'POST',
    dataType: 'json',
    data: {
        'pers_id': info.pers_id,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        //console.log("success");console.dir(value);
        if(Object.keys(value).length) {
          console.log(value);
          if(value.message!='') {
            toastr.warning("ไม่พบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯ","หน้าต่างแจ้งเตือน");
            $("#row7_history").html("<span>-</span>");
            $("#row7_year_now_history").html("<span>-</span>");
            $("#row7_req_org").html("<span>-</span>");
            $("#row7_state").html("<i class='fa fa-exclamation-triangle text-warning'></i>");
          }else {
            //toastr.success("ตรวจสอบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯเสร็จสิ้น","หน้าต่างแจ้งเตือน");
            if(value.history=='มีประวัติ') {
              $("#row7_history").html("<span style='color:#D25200'>"+value.history+"</span>");
            }else {
              $("#row7_history").html("<span style='color:green'>"+value.history+"</span>");
            }
            if(value.year_now_history>0) {
              $("#row7_year_now_history").html("<span style='color:red'>"+value.year_now_history+"</span>");
            }else {
              $("#row7_year_now_history").html("<span style='color:green'>"+value.year_now_history+"</span>");
            }

            value.req_org = value.req_org==null?'-':value.req_org;
            $("#row7_req_org").html("<span>"+value.req_org+"</span>");
            $("#row7_state").html("<i class='fa fa-check text-navy'></i>");
          }
        }else { //Result no Data
          toastr.warning("ไม่พบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯ","หน้าต่างแจ้งเตือน");
          $("#row7_history").html("<span>-</span>");
          $("#row7_year_now_history").html("<span>-</span>");
          $("#row7_req_org").html("<span>-</span>");
          $("#row7_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
        }
      },
      error:function() { //Result Error
        toastr.error("ตรวจสอบข้อมูลการรับบริการศูนย์พัฒนาการจัดสวัสดิการสังคมฯล้มเหลว","หน้าต่างแจ้งเตือน");
        $("#row7_history").html("<span>-</span>");
        $("#row7_year_now_history").html("<span>-</span>");
        $("#row7_req_org").html("<span>-</span>");
        $("#row7_state").html("<i class='fa fa-exclamation-triangle text-danger'></i>");
      },
    });
    //End Service 7*/

      //Service 8
    $.ajax({
    url: base_url+'intelprop/getHistory',
    type: 'POST',
    dataType: 'json',
    data: {
        'pers_id': info.pers_id,
        'csrf_dop': csrf_hash
    },
      success: function (value) { //Result True
        
        //console.log("success");console.dir(value);
        $('#val8_branch').text(value.history);
        if(value.count_branch>0){
          $("#text_Cbranch1").text('หมายเลขประจำตัวประชาชนท่านนี้ ได้ทำการขึ้นทะเบียนคลังปัญญาผู้สูงอายุแล้ว');
          $("#text_Cbranch2").text('ท่านต้องการทำรายการต่อไปหรือไม่');
          $("#btn_branch").prop('href','<?php echo base_url('intelprop/olderp_info/Edit').'/'; ?>'+value.knwl_id);
          $("#Confirm_branch").modal({'show':true,'backdrop':false});
        }
      },
    
    });
    //End Service 8

    // Check img_profile  
    if(info.img_file!=null){
      $('#img_profile').prop('src','<?php echo base_url('assets/modules/personals/uploads/'); ?>'+'/'+info.img_file);
    }
    // End Check img_profile

    // set_value pers_info
      $('#tel_no').val(info.tel_no);//เบอร์โทร

      $('#marital_status option').each(function(){//สถานะสมรส
        //console.log($(numtan).val());
         if($(this).val()==info.marital_status){
            $(this).prop('selected','selected');
         }
      });

      if(info.edu_code!=''){//การศึกษา
         $('#edu_code option').each(function(){
             if($(this).val()==info.edu_code){
                $(this).prop('selected','selected');
             }
         });
      }

      $('#src_of_income_identify').val(info.src_of_income_identify);//รายละเอียดอื่นๆ
      $('#occupation').val(info.occupation);//อาชีพ
      $('#mth_avg_income').val(info.mth_avg_income);//รายได้เฉลี่ย (บาท/เดือน)


    // End set_value pers_info 

  }
</script>

<!-- upload profile -->
<script type="text/javascript">

  function brwImg (node,myID){
    $(node).prev().click();
  //console.log($(node).prev());
  }

  function imgchange(node,myID){
      //var countFiles = $(this)[0].files.length;
      var imgPath = $(node)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
      //Get count of selected files
      //var image_holder = $("#image-holder");
      //image_holder.empty();
      // $(node).prev().remove();
      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
      if (typeof(FileReader) != "undefined") {
      //loop for each file selected for uploaded.
      //for (var i = 0; i < countFiles; i++) {
      var reader = new FileReader();
      reader.onload = function(e) {
      //console.log(e.target.result);

      // var add_img = '<img src="'+e.target.result+'" class="image" >';
      // $(node).before(add_img);
      $("#img_profile").prop("src",e.target.result);
      }
      //  image_holder.show();
      reader.readAsDataURL($(node)[0].files[0]);
      }
      else {
      alert("This browser does not support FileReader.");
      }
      } else {
      alert("กรุณาเลือกไฟล์เป็นชนิด รูปภาพ");
      }
  }//close loop function
</script>