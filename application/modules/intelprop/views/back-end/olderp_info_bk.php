<?php
//set_session('pers_authen',array('authen_log_id'=>223,'pid'=>'3101701933555','cid'=>'0221004350953232','random_string'=>'80db7f660e7ef6255597fc5794be0093')); //for Test
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
      </ul>
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
                <div class="col-xs-12 col-sm-6 dropdown">
                  <label for="example-text-input" class="col-2 col-form-label">สาขาภูมิปัญญา</label>
                  <div class="col-10">
                    <select title="สาขาภูมิปัญญา" placeholder="เลือกสาขาภูมิปัญญา" class="form-control" name="wisd_branch[wisd_code][myID]">
                      <option value="">เลือกสาขาภูมิปัญญา</option>
                      <?php
                      $wisdom = $this->common_model->custom_query("SELECT * FROM std_wisdom ");
                      foreach ($wisdom as $key => $value){
                      ?>
                      <option value="<?php echo $value['wis_code'];?>" ><?php echo $value['wis_name']; ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <label for="" class="col-2 col-form-label">เชี่ยวชาญเรื่อง</label>
                  <input title="เชี่ยวชาญเรื่องุ" placeholder="ระบุความเชี่ยวชาญ" class="form-control" type="text" name="wisd_branch[wisd_sp_title][myID]" >
                </div>
              </div>
              <div class="form-group row">
                <div class="col-xs-12 col-sm-6">
                  <label for="" class="col-2 col-form-label">เอกสารแนบ</label>
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                          <i class="glyphicon glyphicon-file fileinput-exists"></i>
                          <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                          <span class="fileinput-new">Browse</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" accept="" name="wisd_file[]"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                  <label for="" class="col-2 col-form-label">ลิ้งค์</label>
                  <input title="ลิ้ง" placeholder="ระบุลิ้งค์ (เว็บไซต์ เฟสบุ๊ค หรือ ยูทูป เป็นต้น)" class="form-control" type="text" name="wisd_branch[wisd_sp_url][myID]">
                </div>
              </div>
              <div class="row" id="imageupload">
                <div class="col-xs-12 col-sm-12" id="parent_myID">
                  <div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">
                    <input type="file" name="img_myID[]"  class="img_myID" accept="image/*"  style="display: none;" onchange="imgchange(this,myID);" >
                    <button type="button" class="btn btn-lg" style="width: 100%; height:150px;" name="btn[myID]"  onclick="brwImg(this,myID);">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                    </button>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <script>
        $('#parent_myID').on('change',':checkbox',function(){
        var status_che = $(this).prop('checked');
        
        if(status_che==true){
        $(this).parent().css('height','30px');
        }else{
        $(this).parent().css('height','');
        }
        });
        $('#parent_myID').on('click','.trash',function(){
        //console.log($('#img_myID'));
        if(confirm('กรุณายืนยันการลบ')){
        $('#parent_myID  :checkbox').each(function(){
        
        if($(this).prop('checked')==true){
        $(this).parent().parent().parent().remove();
        }
        });
        
        $(this).parent().parent().parent().remove();
        //var id_span = this.id;
        //$('#img_'+id_span).remove();
        }
        });
        </script>
        
        </div> <!--close family_members_template-->
        
        <div class="tab-content">
          <div id="tab-1" <?php if($usrpm['app_id']==46){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
            <div class="panel-body">
              <!--
              <div class="row">
                <div class="col-lg-12" style="padding-top: 15px; padding-bottom: 15px;">
                  <h2 style="color: #4e5f4d"></h2>
                  <div class="col-lg-12 text-right  border-bottom">
                    <?php
                    if($process_action=='Edit') {
                    ?>
                    <a data-toggle="modal" data-target="#myPrint" style="color: #000; padding-left: 20px; padding-right: 20px;" title="พิมพ์แบบฟอร์ม" class="btn btn-default">
                      <i class="fa fa-file-text" aria-hidden="true"></i>
                    </a>
                    <?php
                    }else{
                    }
                    ?>
                    
                    &nbsp;
                    <?php
                    $tmp = $this->admin_model->getOnce_Application(3);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                    ?>
                    <a onclick="return opnBck()" <?php if(!isset($tmp1['perm_status'])) {?>
                      readonly
                      <?php }else{?> href="<?php echo site_url('intelprop/intelprop_list');?>" <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ย้อนกลับ" class="btn btn-default">
                      <i class="fa fa-undo" aria-hidden="true"></i>
                    </a>
                    
                    <?php
                    if($process_action=='Edit') {
                    ?>
                    &nbsp;
                    <?php
                    $tmp = $this->admin_model->getOnce_Application(3);
                    $tmp1 = $this->admin_model->chkOnce_usrmPermiss(3,$user_id); //Check User Permission
                    ?>
                    <a data-id=<?php echo $wisd_info['knwl_id'];?> onclick="opn(this)" <?php if(!isset($tmp1['perm_status'])) {?>
                      readonly
                      <?php }?> style="color: #000; padding-left: 20px; padding-right: 20px;" title="ลบข้อมูล" class="btn btn-default">
                      <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                    </a>
                    <?php
                    }
                    ?>
                  </div>
                </div>
              </div>
              -->
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
                <a  class="navbar-minimalize minimalize-styl-2 btn btn-primary" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px;"
                  <?php if(!isset($tmp1['perm_status'])) {?>
                  readonly
                  <?php }else{?> href="<?php echo site_url('intelprop/intelprop_list'); ?>"
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
                    <div class="panel-heading">
                      <h4>ข้อมูลผู้สูงอายุ <label>&nbsp;</label></h4>
                    </div>
                    <div class="panel-body" style="border:0; padding: 20px;">
                      <div class="form-group row">
                        <div class="col-xs-12 col-sm-3"><img src="<?php echo path('noProfilePic.jpg','member');?>" class="img-responsive" style="margin: 0 auto; width: 70%;"></div>
                        <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold; color: red;">เลขประจำตัวประชาชน</span> </div>
                        <div class="col-xs-12 col-sm-6 has-error" style="padding: 3px 15px;">
                            <div class="input-group" style="width: 295px;">
                                <input  title="เลขประจำตัวประชาชน" placeholder="เลขประจำตัวประชาชน (13 หลัก)" class="form-control input_idcard elder_same_req" type="text" id="req_pid" name="wisd_info[pid]" value="<?php echo $wisd_info['pid'];?>" required/>
                                <input type="hidden" id="pers_id" name="wisd_info[pers_id]" value="<?php echo $wisd_info['pers_id'];?>">
                      
                              <div class="input-group-btn" style=" padding-bottom: 5px;">
                                <button type="button" title="ตรวจสอบ" class="btn btn-default elder_same_req" id="bt_req_pid" style="  border-radius: 0px; left: 1px;"><i class="fa fa-id-card-o" aria-hidden="true"></i></button>
                                <!-- <button class="btn btn-default elder_same_req" title="กรณีไม่มีบัตร" style="width: 48%;">กรณีไม่มีบัตร</button> -->
                              </div>
                            </div>
                        </div>
                      
                      <script>
                      var req_pers = null;
                      var inputpid = "#req_pid";
                      var bt_spid = "#bt_req_pid";
                      var setData = "reqData"; //Declear Name
                      var reqData = function(value) { //Set Structure Display Data
                      req_pers = value;
                      $("#name").html(value.name);
                      $("#date_of_birth").html(value.date_of_birth);
                      $("#gender_name").html(value.gender_name);
                      $("#nation_name_th").html(value.nation_name_th);
                      $("#relg_title").html(value.relg_title);
                      $("#pers_id").val(value.pers_id);
                      $("#reg_addr_id").val(req_pers.reg_addr_id);
                      $("#reg_addr").text(value.reg_add_info);
                      }
                      $(bt_spid).click(function(){//On Click for Search
                      if($(inputpid).val()!='') {//pid not null
                      
                      $(bt_spid).attr('disabled',true);
                      if(pers_authen!=null) { //Check Personal Authen
                      getPersInfo(inputpid,bt_spid,setData); //Get Data
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
                      
                      <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ชื่อตัว/ชื่อสกุล</span></div>
                      <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;"  id="name"><?php echo @$wisd_info['name'];?></div>
                      <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">วันเดือนปีเกิด</span></div>
                      <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="date_of_birth"> <?php echo @$wisd_info['date_of_birth'];?> </div>
                      <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">เพศ</span> <span id="gender_name"> <?php echo @$wisd_info['gender_name'];?></span> </div>
                      <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">สัญชาติ</span> <span id="nation_name_th"> <?php echo @$wisd_info['nation_name_th'];?></span> </div>
                      <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ศาสนา</span> <span id="relg_title"> <?php echo @$wisd_info['relg_title'];?> </span> </div>
                      <div class="col-xs-12 col-sm-3" style="padding: 7px 15px;"><span style="font-weight: bold;">ที่อยู่ตามทะเบียนบ้าน</span><input type="hidden" id="reg_addr_id" name="pers_info[reg_addr_id]" value="<?php echo @$wisd_info['reg_addr_id']; ?>"></div>
                      <div class="col-xs-12 col-sm-6" style="padding: 7px 15px;" id="reg_addr"><?php echo @$wisd_info['reg_add_info']; ?></div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3">
                        <label for="datetimepicker1" class="col-2 col-form-label" style="color: red;">วันที่ขึ้นทะเบียน </label>
                        <div id="datetimepicker1" class="col-10 input-group date has-error" data-date-format="dd-mm-yyyy">
                          <input title="วันที่ขึ้นทะเบียน" placeholder="เลือกวันที่" class="form-control" type="text" name="wisd_info[date_of_reg]" value="<?php echo $wisd_info['date_of_reg']; ?>" required/>
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                        <script type="text/javascript">
                        <?php
                        $tmp = explode('-',$wisd_info['date_of_reg']);
                        ?>
                        $(function () {
                        $("#datetimepicker1").datepicker({
                        autoclose: true,
                        todayHighlight: true
                        });
                        });
                        </script>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-6">ที่อยู่ (ปัจจุบัน) ( <div class="checkbox-inline i-checks"><label><input type="checkbox" name="elder_addr_chk"> ตรงกับที่อยู่ตามทะเบียนบ้าน</label></div> )</div>
                      <script>
                      $("input[name='elder_addr_chk']").on('ifClicked',function(){
                      if(!$(this).prop('checked')) {
                      $(".elder_addr_pre").attr('disabled',true);
                      }else {
                      $(".elder_addr_pre").attr('disabled',false);
                      }
                      });
                      <?php
                      if(($wisd_info['reg_addr_id']==$wisd_info['pre_addr_id']) && ($wisd_info['reg_addr_id']!=''&&$wisd_info['pre_addr_id']!='')) {
                      ?>
                     
                      $("input[name='elder_addr_chk']").parent().addClass('checked');
                      $("input[name='elder_addr_chk']").prop('checked',true);
                      $(".elder_addr_pre").attr('disabled',true);
                     
                      <?php
                      }
                      ?>
                      </script>
                      <div class="col-xs-12 col-sm-6">
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
                        </script>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal_marker">
                        <i class="fa fa-map-marker" aria-hidden="true"></i> ตำแหน่งพิกัดภูมิศาสตร์
                        </button>
                        &nbsp;
                        <input type="hidden" name="pers_addr[addr_gps]" value="<?php echo $addr_gps;?>" id="addr_gps">
                        <span id="addr_gpg_txt"><?php if($addr_gps!='0,0') { echo '('.$addr_gps.')';}?></span>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-6 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">สถานะการพักอาศัย</label>
                        <div class="col-10">
                          <select title="สานะการพักอาศัย" placeholder="เลือกสถานะการพักอาศัย" class="form-control" name="pers_info[pre_addr_status]">
                            <option value="">เลือกสถานะการพักอาศัย</option>
                            <option value="บ้านตนเอง" <?php if(@$wisd_info['pre_addr_status'] == 'บ้านตนเอง'){ echo "selected";} ?>>บ้านตนเอง</option>
                            <option value="อาศัยผู้อื่นอยู่" <?php if(@$wisd_info['pre_addr_status'] == 'อาศัยผู้อื่นอยู่'){ echo "selected";} ?>>อาศัยผู้อื่นอยู่</option>
                            <option value="บ้านเช่า" <?php if(@$wisd_info['pre_addr_status'] == 'บ้านเช่า'){ echo "selected";} ?>>บ้านเช่า</option>
                            <option value="อยู่กับผู้จ้าง" <?php if(@$wisd_info['pre_addr_status'] == 'อยู่กับผู้จ้าง'){ echo "selected";} ?>>อยู่กับผู้จ้าง</option>
                            <option value="ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง" <?php if(@$wisd_info['pre_addr_status'] == 'ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง'){ echo "selected";} ?>>ไม่มีที่อยู่อาศัยเป็นหลักแหล่ง</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">บ้านเลขที่</label>
                        <input type="hidden" name="pre_addr_id" value="<?php echo @$wisd_info['pre_addr_id']; ?>">
                        <input title="บ้านเลขที่" placeholder="ตัวอย่าง xxx/xx" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_home_no]" value="<?php echo @$addr_info['addr_home_no']; ?>" />
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">หมู่ที่</label>
                        <input title="หมู่ที่" placeholder="" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_moo]" value="<?php echo @$addr_info['addr_moo']; ?>"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">ตรอก</label>
                        <div class="col-10">
                          <select title="ตรอก" placeholder="เลือกตรอก" class="form-control elder_addr_pre" id="alley" name="pers_addr[addr_alley]">
                            <option value="">เลือกตรอก</option>
                            <?php $temp = $this->personal_model->getAll_alley();
                            foreach ($temp as $key => $row) { ?>
                            <option value="<?php echo $row['alley_code']; ?>"><?php echo $row['alley_name']; ?></option>
                            <?php  } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">ซอย</label>
                        <div class="col-10">
                          <select title="ซอย" placeholder="เลือกซอย" class="form-control elder_addr_pre" id="lane" name="pers_addr[addr_lane]">
                            <option value="">เลือกซอย</option>
                            <?php //$temp = $this->personal_model->getAll_lane();
                            //foreach ($temp as $key => $row) { ?>
                            <!--<option value="<?php //echo $row['lane_code']; ?>"><?php //echo $row['lane_name']; ?></option> -->
                            <?php  //} ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">ถนน</label>
                        <div class="col-10">
                          <select title="ถนน" placeholder="เลือกถนน" class="form-control elder_addr_pre" id="road" name="pers_addr[addr_road]">
                            <option value="">เลือกถนน</option>
                            <?php //$temp = $this->personal_model->getAll_road();
                            //foreach ($temp as $key => $row) { ?>
                            <!-- <option value="<?php //echo $row['road_code']; ?>"><?php //echo $row['road_name']; ?></option> -->
                            <?php  //} ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">จังหวัด</label>
                        <div class="col-10">
                          <select title="จังหวัด" placeholder="เลือกจังหวัด" class="form-control elder_addr_pre" id="Province" name="pers_addr[addr_province]" onchange="optionGen(this,'Amphur',<?php echo @$addr_info['district_code']; ?>);">
                            <option value="">เลือกจังหวัด</option>
                            <?php $temp = $this->personal_model->getAll_Province();
                            foreach ($temp as $key => $row) { ?>
                            <option value="<?php echo $row['area_code']; ?>"><?php echo $row['area_name_th']; ?></option>
                            <?php  } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">อำเภอ</label>
                        <div class="col-10">
                          <select title="อำเภอ" placeholder="เลือกอำเภอ" class="form-control elder_addr_pre" id="Amphur" name="pers_addr[addr_district]" onchange="optionGen(this,'Tambon',<?php echo @$addr_info['sub_district_code']; ?>);" disabled>
                            <option value="">เลือกอำเภอ</option>
                            
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">ตำบล</label>
                        <div class="col-10">
                          <select title="ตำบล" placeholder="เลือกตำบล" class="form-control elder_addr_pre" id="Tambon" name="pers_addr[addr_sub_district]" disabled>
                            <option value="">เลือกตำบล</option>
                            <?php //$temp = $this->personal_model->getAll_Tambon();
                            //foreach ($temp as $key => $row) { ?>
                            <!-- <option value="<?php //echo $row['area_code']; ?>"><?php //echo $row['area_name_th']; ?></option> -->
                            <?php  //} ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">รหัสไปรษณีย์</label>
                        <input title="รหัสไปรษณีย์" placeholder="ระบุรหัสไปรษณีย์ (5 หลัก)" class="form-control elder_addr_pre" type="text" name="pers_addr[addr_zipcode]" value="<?php echo @$addr_info['addr_zipcode']; ?>" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (บ้าน)</label>
                        <input title="เบอร์โทรศัพท์ (บ้าน)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[tel_no_home]" value="<?php echo $wisd_info['tel_no_home'];?>"/>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">เบอร์โทรศัพท์ (มือถือ)</label>
                        <input title="เบอร์โทรศัพท์ (มือถือ)" placeholder="ตัวอย่าง 08XXXXXXXX" class="form-control" type="text" name="pers_info[tel_no_mobile]" value="<?php echo $wisd_info['tel_no_mobile'];?>"/>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">เบอร์โทรสาร (แฟกซ์)</label>
                        <input title="เบอร์โทรสาร (แฟกซ์)" placeholder="ตัวอย่าง 02XXXXXXX ต่อ XXX" class="form-control" type="text" name="pers_info[fax_no]" value="<?php echo $wisd_info['fax_no'];?>"/>
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">ที่อยู่อีเมล</label>
                        <input title="ที่อยู่อีเมล" placeholder="ตัวอย่าง me@mail.com" class="form-control" type="email" name="pers_info[email_addr]" value="<?php echo $wisd_info['email_addr'];?>"/>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-6 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">สถานะการสมรส</label>
                        <div class="col-10">
                          <select title="สถานะการสมรส" placeholder="เลือกสถานะการสมรส" class="form-control" name="pers_info[marital_status]">
                            <option value="">เลือกสถานะการสมรส</option>
                            <option value="โสด" <?php if(@$wisd_info['marital_status'] == 'โสด'){ echo "selected"; } ?>>โสด</option>
                            <option value="สมรส อยู่ด้วยกัน" <?php if(@$wisd_info['marital_status'] == 'สมรส อยู่ด้วยกั'){ echo "selected"; } ?>>สมรส อยู่ด้วยกัน</option>
                            <option value="สมรส แยกกันอยู่" <?php if(@$wisd_info['marital_status'] == 'สมรส แยกกันอยู่'){ echo "selected"; } ?>>สมรส แยกกันอยู่</option>
                            <option value="หย่าร้าง" <?php if(@$wisd_info['marital_status'] == 'หย่าร้าง'){ echo "selected"; } ?>>หย่าร้าง</option>
                            <option value="ไม่ได้สมรส แต่อยู่ด้วยกัน" <?php if(@$wisd_info['marital_status'] == 'ไม่ได้สมรส แต่อยู่ด้วยกัน'){ echo "selected"; } ?>>ไม่ได้สมรส แต่อยู่ด้วยกัน</option>
                            <option value="หม้าย (คู่สมรสเสียชีวิต)" <?php if(@$wisd_info['marital_status'] == 'หม้าย (คู่สมรสเสียชีวิต)'){ echo "selected"; } ?>>หม้าย (คู่สมรสเสียชีวิต)</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6 dropdown">
                        <label for="example-text-input" class="col-2 col-form-label">ระดับการศึกษา</label>
                        <div class="col-10">
                          <select title="ระดับการศึกษา" placeholder="เลือกระดับการศึกษา" class="form-control" name="pers_info[edu_code]">
                            <option value="">เลือกระดับการศึกษา</option>
                            <?php $temp = $this->personal_model->getAll_edu_level();
                            foreach ($temp as $key => $row) { ?>
                            <option value="<?php echo $row['edu_code']; ?>" <?php if(@$wisd_info['edu_code'] == $row['edu_code']){ echo "selected"; } ?>><?php echo $row['edu_title']; ?></option>
                            <?php  } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">อาชีพ (ปัจจุบัน)</label>
                        <input title="อาชีพ (ปัจจุบัน)" placeholder="ระบุอาชีพ (ปัจจุบัน)" class="form-control" type="text" name="pers_info[occupation]" value="<?php echo @$wisd_info['occupation']; ?>" />
                      </div>
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">รายได้เฉลี่ย (บาท/เดือน)</label>
                        <input title="รายได้เฉลี่ย (บาท/เดือน)" placeholder="ระบุรายได้เฉลี่ย (บาท/เดือน)" class="form-control" type="text" name="pers_info[mth_avg_income]" value="<?php echo @$wisd_info['mth_avg_income']; ?>"/>
                      </div>
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
                      <div class="col-xs-12 col-sm-3">
                        <label for="" class="col-2 col-form-label">&nbsp;</label>
                        <input title="ระบุ" placeholder="ระบุ" class="form-control" type="text" name="pers_info[src_of_income_identify]" value="<?php echo @$wisd_info['src_of_income_identify']; ?>"/>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      
                      <div class="col-xs-12 col-sm-12">
                        <label>สาขาภูมิปัญญาที่เชี่ยวชาญ (จำนวน <span id="nums_family_members">0</span> สาขา) </label>
                        
                        <div class="family_members" >
                          <?php if(($process_action!='Add')&&($process_action!='Added')){
                          
                          $i=0;
                          foreach($wisd_branch as $key_branch => $value_branch){
                          ?>
                          <input type="hidden" name="wisd_branch[branch_id][]" value="<?php echo $value_branch['branch_id']; ?>">
                          <!--<div class="family_members_template"> -->
                          <div class="panel-group family_members_items" style="margin-top: -10px;">
                            <div class="panel panel-default" style="border: 0">
                              <div class="panel-heading clear-fix" style="background-color: initial;">
                              </div>
                              <div class="panel-body" style="background-color:#FBFBFB;border: 1px #eee solid; padding: 15px;">
                                <div class="row text-right">
                                  <button type="button" class="btn btn-default delfamily_members" onclick="btDel_family_members(this,<?php echo $value_branch['branch_id']; ?>)" style="margin-right: 16px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                                <div class="form-group row">
                                  <div class="col-xs-12 col-sm-6 dropdown">
                                    <label for="example-text-input" class="col-2 col-form-label">สาขาภูมิปัญญา</label>
                                    <div class="col-10">
                                      <select title="สาขาภูมิปัญญา" placeholder="เลือกสาขาภูมิปัญญา" class="form-control" name="wisd_branch[wisd_code][<?php echo $i;?>]">
                                        <option value="">เลือกสาขาภูมิปัญญา</option>
                                        <?php
                                        $wisdom = $this->common_model->custom_query("SELECT * FROM std_wisdom ");
                                        foreach ($wisdom as $key => $value){
                                        ?>
                                        <option value="<?php echo $value['wis_code'];?>" <?php if($value_branch['wisd_code']==$value['wis_code']){ echo "selected"; }?> >
                                        <?php echo $value['wis_name']; ?></option>
                                        <?php }?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-6">
                                    <label for="" class="col-2 col-form-label">เชี่ยวชาญเรื่อง</label>
                                    <input title="เชี่ยวชาญเรื่องุ" placeholder="ระบุความเชี่ยวชาญ" class="form-control" type="text" value="<?php echo $value_branch['wisd_sp_title']; ?>" name="wisd_branch[wisd_sp_title][<?php echo $i;?>]">
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-xs-12 col-sm-6">
                                    <label for="" class="col-2 col-form-label">เอกสารแนบ</label>
                                    <div class="row">
                                      <div class="col-xs-12 col-sm-12">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                          <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"><?php echo $value_branch['wisd_sp_label']; ?></span>
                                          </div>
                                          <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Browse</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" accept="" name="wisd_file[]" placeholder="" />
                                          </span>
                                          <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-6">
                                    <label for="" class="col-2 col-form-label">ลิ้งค์</label>
                                    <input title="ลิ้ง" placeholder="ระบุลิ้งค์ (เว็บไซต์ เฟสบุ๊ค หรือ ยูทูป เป็นต้น)" class="form-control" type="text" value="<?php echo $value_branch['wisd_sp_url']; ?>" name="wisd_branch[wisd_sp_url][<?php echo $i;?>]">
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="row" id="imageupload">
                                    <div class="col-xs-12 col-sm-12" id="parent_<?php echo $i;?>">
                                      <?php
                                      $wisd_photo = $this->wisd_model->get_photo($value_branch['branch_id']);
                                      if($wisd_photo!=""){
                                      foreach ($wisd_photo as $key => $value) {
                                      ?>
                                      <div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">
                                        
                                        <button type="button" class="btn btn-lg" style="width: 100%; height:150px; display: none" name="btn[<?php echo $i;?>]"  onclick="brwImg(<?php echo $i;?>);">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                        </button>
                                        <div class="container2"><img src="<?php echo base_url();?>assets/modules/intelprop/images/<?php echo $value['wisdom_photo_file']; ?>" alt="..."  class="image">
                                          <div class="overlay">
                                            <input type="checkbox" class="che_del" > <span class="glyphicon glyphicon-trash trash" aria-hidden="true" onclick="Del_photo(this,<?php echo $value['wisdom_photo_id'];?>)"></span>
                                          </div>
                                        </div>
                                      </div>
                                      <?php
                                      }//close loop foreach
                                      }// close loop if
                                      ?>
                                      <div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">
                                        <input type="file" name="img_<?php echo $i;?>[]"  class="img_<?php echo $i;?>" accept="image/*"  style="display: none;" onchange="imgchange(this,'<?php echo $i;?>');">
                                        <button type="button" class="btn btn-lg" style="width: 100%; height:150px;" name="btn[<?php echo $i;?>]"  onclick="brwImg(this,'<?php echo $i;?>');">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            </div><!--</div> close family_members_template-->
                            <script>
                            $('#parent_<?php echo $i; ?>').on('change',':checkbox',function(){
                            var status_che = $(this).prop('checked');
                            
                            if(status_che==true){
                            $(this).parent().css('height','30px');
                            }else{
                            $(this).parent().css('height','');
                            }
                            });
                            $('#parent_<?php echo $i; ?>').on('click','.trash',function(){
                            //console.log($('#img_myID'));
                            if(confirm('กรุณายืนยันการลบ')){
                            $('#parent_<?php echo $i; ?>  :checkbox').each(function(){
                            
                            if($(this).prop('checked')==true){
                            $(this).parent().parent().parent().remove();
                            }
                            });
                            
                            $(this).parent().parent().parent().remove();
                            //var id_span = this.id;
                            //$('#img_'+id_span).remove();
                            }
                            });
                            </script>
                            
                            <?php
                            $i++;
                            }// close loop foreach
                            ?>
                            <script type="text/javascript">
                            
                            $("#nums_family_members").html($(".family_members .family_members_items").length);
                            var nummf = <?php echo $i; ?>;
                            
                            </script>
                            <?php
                            }else{
                            ?>
                            <script type="text/javascript">
                            var nummf = 0;
                            </script>
                            
                            <?php
                            }// //close loop if(($process_action!='Add')&&($process_action!='Added'))
                            ?>
                            
                            </div><!-- close .family_members-->
                            
                            
                            <script>
                            
                            
                            function btDel_family_members(node,branch_id) {
                            if(branch_id!=""){
                            $.ajax({
                            url: base_url+'intelprop/del_wisd_branch',
                            type: 'POST',
                            dataType: 'html',
                            data: {
                            'branch_id': branch_id,
                            <?php echo $csrf['name'];?>: '<?php echo $csrf['hash'];?>'
                            },
                            success: function(result){
                            $(node).parent().parent().parent().parent().remove();
                            $("#nums_family_members").html($(".family_members .family_members_items").length);
                            },
                            error: function(){
                            alert('ไม่สามารถลบสาขาภูมิปัญญาได้ กรุณาลองใหม่');}
                            });
                            }else{
                            $(node).parent().parent().parent().parent().remove();
                            $("#nums_family_members").html($(".family_members .family_members_items").length);
                            }
                            }
                            
                            </script>
                            
                            <button type="button" class="btn btn-default" id="btAdd_family_members"><i class="fa fa-plus" aria-hidden="true"></i></button>
                            
                            <script>
                            
                            
                            var cloneTmp = $('.family_members_template').clone();
                            //setTimeout(function(){addFmlyMember();},500);
                            function addFmlyMember() {
                            var cloneTmp1 = cloneTmp.html().replace(new RegExp("myID", 'g'), nummf);
                            
                            nummf = nummf+1;
                            $(cloneTmp1).clone().appendTo('.family_members');
                            //$("#nums_family_members").html($(".family_members .family_members_items").length);
                            $("#nums_family_members").html($(".family_members .family_members_items").length);
                            
                            }
                            $("#btAdd_family_members").click(function(){ //Add
                            addFmlyMember();
                            });
                            
                            function brwImg (node,myID){
                            //console.log(':::::::::::::::::::::::'+myID);
                            //$(".img_"+myID+":eq("+($('.img_'+($('.img_0').length-1)).length-1)+")").click();
                            $(node).prev().click();
                            }
                            
                            
                            function imgchange(node,myID){
                            
                            //var countFiles = $(this)[0].files.length;
                            
                            var imgPath = $(node)[0].value;
                            
                            var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                            //Get count of selected files
                            //var image_holder = $("#image-holder");
                            //image_holder.empty();
                            if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                            if (typeof(FileReader) != "undefined") {
                            //loop for each file selected for uploaded.
                            //for (var i = 0; i < countFiles; i++) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                            //console.log(e.target.result);
                            var img_file = '<div class="container2"><img src="'+e.target.result+'" alt="..."  class="image">\
                              <div class="overlay">\
                                <input type="checkbox" class="che_del" > <span class="glyphicon glyphicon-trash trash" aria-hidden="true"></span>'+
                              '</div></div>';
                              
                              $(img_file).appendTo($(node).parent());
                              $(node).siblings('button').css('display','none');
                              
                              
                              var add_img = '<div class="col-xs-12 col-sm-3 element"   style="margin-top: 20px;">\
                                <input type="file" name="img_'+myID+'[]"  class="img_'+myID+'" accept="image/*"  style="display: none;" onchange="imgchange(this,'+myID+');">'+
                                '<button type="button" class="btn btn-lg" style="width: 100%; height:150px;" name="btn['+myID+']"  onclick="brwImg(this,'+myID+');">'+
                                '<span class="glyphicon glyphicon-plus" aria-hidden="true" style="font-size: -webkit-xxx-large;"></span>'+
                                '</button>\
                              </div>';
                              $(node).parent().parent().append(add_img);
                              
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
                            </div>
                          </div>
                          
                         
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
                                  <button style="width: 100%;" type="button" class="btn btn-primary btn-md" onclick="return opnCnfrom()"> บันทึก</button>
                                </div>
                                <div class="col-xs-12 col-sm-2">
                                  <button style="width: 100%;" type="button" class="btn btn-primary btn-md" onclick="window.location.href='<?php echo site_url('intelprop/intelprop_list');?>'"> ล้างค่า</button>
                                </div>
                              </div><!-- close class row-->
                      </div>

                    </div>

                  </div>

                </div>
                <script type="text/javascript">
                <?php if($process_action == 'Edited'){ ?>
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

                      <script type="text/javascript">
                        $(document).ready(function () {
                          $('.i-checks').iCheck({
                            checkboxClass: 'icheckbox_square-green',
                            radioClass: 'iradio_square-green',
                            increaseArea: '20%'
                          });
                        });
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