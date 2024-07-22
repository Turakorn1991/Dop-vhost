

<div class="row">
  <div class="col-lg-12">
    <div class="tabs-container">
      <ul class="nav nav-tabs">
          <li >
          <?php
          $tmp = $this->admin_model->getOnce_Application(161);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(161,$user_id); //Check User Permission
          ?>
          <!-- <a <?php if(!isset($tmp1['perm_status'])) {?> -->
            <!-- readonly -->
          <!-- <?php }else if($process_action!='Add'){?> href="<?php echo site_url('difficult/sufferer_form1/Edit/'.$diff_info['diff_id']);?>" <?php }?> data-toggle="tab" <?php if($usrpm['app_id']==161){?>aria-expanded="true" <?php }else{?> aria-expanded="false"<?php }?>> ข้อมูลผู้สูงอายุ</a> -->
                   
          <a  href="<?php echo site_url('intelprop/olderp_info/Edit/'.uri_seg(4));?>"  > ข้อมูลผู้สูงอายุ</a>

        </li>

        <li class="active">
          <?php
          $tmp = $this->admin_model->getOnce_Application(161);
          $tmp1 = $this->admin_model->chkOnce_usrmPermiss(161,$user_id); //Check User Permission
          ?>
<!--           <a <?php if(!isset($tmp1['perm_status'])) {?>
            readonly
          <?php }else if($process_action!='Add'){?> href="<?php echo site_url('difficult/sufferer_form2/Edit/'.$diff_info['diff_id']);?>" <?php }?> <?php if($usrpm['app_id']==161){?>aria-expanded="true" <?php }?>> ภูมิปัญญา () </a>
 -->        
          <a  href="<?php echo site_url('intelprop/olderp_info2/Edit/'.uri_seg(4));?>" > ภูมิปัญญา  </a>

        </li>

      </ul>

      <div class="tab-content">
        <div id="tab-1" <?php if($usrpm['app_id']==161){?>class="tab-pane active" <?php }else{?> class="tab-pane"<?php }?>>
          <div class="panel-body">
              
            <div class="from-group row">
             <div class="col-xs-12 col-sm-12">
               <a class="navbar-minimalize minimalize-styl-2 btn btn-primary btn-add" style=" margin-left: 0px; background-color: #2f4250; border: 0;font-size: 17px; padding: 2px 20px 2px 20px; float: right;"  title="เพิ่มรายการ" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> เพิ่มรายการ
              </a>
            </div>
          </div>
              

              <div class="table-responsive">
                <table id="dtable" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important; width:100% !important;">
                  <thead style="font-size: 15px;">
                    <tr>
                      <th style="width:3% !important; border-left-color: #072b42;">#</th>
                      <th style="width:20% !important;">ภาพถ่าย</th>
                      <th style="width:37% !important;">สาขาภูมิปัญญา</th>                
                      <th style="width:37% !important;">เชี่ยวชาญเรื่อง/วันที่ขึ้นทะเบียน</th>            
                      <th style="width:3% !important;">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                       if(!empty($wisd_branch)){
                        // dieArray($wisd_branch);
                         $i=0;
                         foreach ($wisd_branch as $key => $value) {
          
                      ?>
                     <tr>
                       <td style="border-left-color: #072b42;"><?php echo $i++; ?></td>
                       <td>
                           <?php 
                           $img_head = $this->common_model->custom_query("SELECT * FROM wisd_photo WHERE branch_id={$value['branch_id']}"); 
                            if(empty($img_head)){
                            ?>
                           <div style="background-color: #607D8B;padding: 30px;text-align: center;color: aliceblue;">ภาพถ่าย<br>(หน้าปก)</div>
                           <?php }else{ ?>
                           <img src="<?php echo base_url('assets/modules/intelprop/images/'.$img_head[0]['wisdom_photo_file']);?>" style="width: 200px;">
                           <?php } ?>
                       </td>
                       <td><?php echo $value['wis_name']; ?></td>
                       <td><?php echo $value['wisd_sp_title']; ?><!-- <br>(วันที่ขึ้นทะเบียน 23 กันยายน 2560) --></td>
                       <td>
                        <!-- Single button -->
                        <div class="btn-group" style="cursor: pointer;">
                          <i  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle fa fa-gear" aria-hidden="true" style="color: #000"></i>
                          <ul class="dropdown-menu" style="position: absolute;left: -150px;">
                            <!-- <li><a style="font-size:16px;"  title="พิมพ์แบบฟอร์ม" ><i class="fa fa-file-pdf-o" aria-hidden="true" style="color: #000"></i> เอกสารแนบ</a></li> -->
                            <!-- <li><a style="font-size:16px;"  title="ลบ" ><i class="fa fa-chain" style="color: #000"></i> ลิงค์ภูมิปัญญา</a></li> -->
                            <li><a style="font-size:16px;"><i class="fa fa-pencil" aria-hidden="true" style="color: #000"></i> แก้ไขรายการ</a></li>
                            <li><a style="font-size:16px;"  title="ลบ" ><i class="fa fa-trash" style="color: #000"></i> ลบรายการ</a></li>
                          </ul>
                        </div>
                      </td>
                     </tr>
                     <?php 
                        }
                      }else{ 
                     ?>
                     <tr>
                       <td colspan="5" class="text-center">ไม่พบข้อมูล</td>
                     
                     </tr>
                     <?php } ?>
                  </tbody>
                </table>
              </div> <!-- END table-responsive -->


          </div> <!-- END panel-body -->
        </div> <!-- END tab-1 -->
      </div> <!-- END tab-content -->

    </div><!-- END tabs-container-->

  </div>
</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog" id="myModal" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title">สาขาภูมิปัญญาและความเชี่ยวชาญ</h5>
      </div>
      <div class="modal-body" style="font-size: 15px;">

           <?php
                $wisd_id = '';
                if($process_action=='Add')$process_action = 'Added';
                if($process_action=='Edit'){$process_action = 'Edited'; $wisd_id = '/'.uri_seg(4);}
                echo form_open_multipart('intelprop/olderp_info2/'.$process_action.$wisd_id);
                ?>
                <input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" /> <!-- Set hidden csrf field -->
                <input type="submit" value="submit" name="bt_submit" hidden="hidden">
         
          <div class="form-group row">
             <div class="col-xs-12 col-sm-3 ">
                <font color="red">สาขาภูมิปัญญา:</font>
             </div>
             <div class="col-xs-12 col-sm-9 has-error">
                  <select title="สาขาภูมิปัญญา" placeholder="เลือกสาขาภูมิปัญญา" class="form-control" name="wisd_branch[wisd_code]">
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
           
          <div class="form-group row ">
            <div class="col-xs-12 col-sm-3 ">
              <font color="red">เชี่ยวชาญเรื่อง:</font>             
            </div>
            <div class="col-xs-12 col-sm-9 has-error">
              <textarea rows="2" cols="50" class="form-control" placeholder="ระบุชื่อเรื่องความเชี่ยวชาญ"  name="wisd_branch[wisd_sp_title]"></textarea>
            </div>
          </div>

          <div class="form-group row ">
            <div class="col-xs-12 col-sm-3 ">
              <font color="red">ลิงค์ภูมิปัญญา:</font>             
            </div>
            <div class="col-xs-12 col-sm-9 has-error">
              <input type="text" class="form-control" placeholder="ระบุลิงค์ภูมิปัญญา" name="wisd_branch[wisd_sp_url]">
              
            </div>
          </div>

           <div id="content_file"></div>   

           <div class="form-group row">
            <div class="col-xs-12 col-sm-3">
              <font>ภาพถ่าย(หน้าปก):</font>      
            </div>
            <div class="col-xs-12 col-sm-9">
               <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput">
                      <i class="glyphicon glyphicon-file fileinput-exists"></i>
                      <span class="fileinput-filename" style="color: #99999c;">ไฟล์ชนิด .jpg,.jpeg,.png และจำกัดขนาดไม่เกิน 5MB</span>
                    </div>
                    <span class="input-group-addon btn btn-default btn-file">
                      <span class="fileinput-new">เลือกไฟล์</span>
                      <span class="fileinput-exists">แก้ไข</span>
                      <input type="file" accept="" name="wisd_photo_head"  onchange="imgchange(this); "/>               
                    </span>
                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>
                  </div>
            </div>
            <div class="col-xs-12 col-sm-2 col-sm-offset-3">
              <button class="btn btn-default form-control" style="font-size: 15px !important;">ดาวน์โหลด</button>      
            </div>
             <div class="col-xs-12 col-sm-2">
              <button class="btn btn-default form-control" type="button" style="font-size: 15px !important;">ลบไฟล์</button>      
            </div>
            <div class="col-xs-12 col-sm-2"><img src="" class="img-responsive" style="width: 50%;"></div>   
          </div>
          <hr>

         <div id="content_img"></div> 

          <div class="form-group row">
            <div class="col-xs-12 col-sm-2 col-sm-offset-3"><button type="button" class="btn btn-default form-control" onclick="add_img(this);" style="font-size: 15px !important;">เพิ่มไฟล์</button></div>
          </div>

          

      </div>
      <div class="modal-footer">
        <div class="row">
          <div class="col-xs-12 col-sm-8">&nbsp;</div>
          <div class="col-xs-12 col-sm-2">
            <button style="height: 40px;width: 100% !important;" type="submit" class="btn btn-primary btn-save" ><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
          </div>
          <div class="col-xs-12 col-sm-2">
            <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" data-dismiss="modal"><i class="fa fa-undo" aria-hidden="true"></i> ย้อนกลับ</button>
          </div>
        </div>
      </div>

      <?php echo form_close();?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END Modal -->

<div id="view_file" style="display: none;">
    <div class="form-group row">
      <div class="col-xs-12 col-sm-3">
        <font>เอกสารแนบ:</font>      
      </div>
      <div class="col-xs-12 col-sm-9">
       <div class="fileinput fileinput-new input-group" data-provides="fileinput">
        <div class="form-control" data-trigger="fileinput">
          <i class="glyphicon glyphicon-file fileinput-exists"></i>
          <span class="fileinput-filename" style="color: #99999c;" >ไฟล์ชนิด .PDF และจำกัดขนาดไม่เกิน 25MB</span>
        </div>
        <span class="input-group-addon btn btn-default btn-file">
          <span class="fileinput-new">เลือกไฟล์</span>
          <span class="fileinput-exists">แก้ไข</span>
          <input type="file"  name="wisd_file[]"  />
        </span>
        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>
      </div>
    </div>
    <div class="col-xs-12 col-sm-2 col-sm-offset-3">
      <button class="btn btn-default form-control" style="font-size: 15px !important;">ดาวน์โหลด</button>      
    </div>
    <div class="col-xs-12 col-sm-2">
      <button class="btn btn-default form-control" type="button" onclick="del_file(this);" style="font-size: 15px !important;">ลบไฟล์</button>      
    </div>
    <div class="col-xs-12 col-sm-2">
      <button class="btn btn-default form-control" type="button" onclick="add_file(this);" style="font-size: 15px !important;">เพิ่มไฟล์</button>      
    </div>
  </div>
</div>

<div id="view_formupload" style="display: none;">
  <div class="form-group row add_img">
    <div class="col-xs-12 col-sm-3">
      <font>ภาพถ่าย(ประกอบภูมิปัญญา):</font>      
    </div>
    <div class="col-xs-12 col-sm-9">
     <div class="fileinput fileinput-new input-group" data-provides="fileinput">
      <div class="form-control" data-trigger="fileinput">
        <i class="glyphicon glyphicon-file fileinput-exists"></i>
        <span class="fileinput-filename" style="color: #99999c;" >ไฟล์ชนิด .jpg,.jpeg,.png และจำกัดขนาดไม่เกิน 5MB</span>
      </div>
      <span class="input-group-addon btn btn-default btn-file">
        <span class="fileinput-new" >เลือกไฟล์</span>
        <span class="fileinput-exists">แก้ไข</span>
        <input type="file" accept="" name="wisd_wisd_photo[]"  onchange="imgchange(this);" />    
      </span>
      <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">ลบ</a>
    </div>
  </div>
  <div class="col-xs-12 col-sm-2 col-sm-offset-3">
    <button class="btn btn-default form-control" type="button" style="font-size: 15px !important;">ดาวน์โหลด</button>      
  </div>
  <div class="col-xs-12 col-sm-2">
    <button class="btn btn-default form-control" type="button" onclick="del_file(this);" style="font-size: 15px !important;">ลบไฟล์</button>      
  </div>
  <div class="col-xs-12 col-sm-2"><img src="" class="img-responsive" style="width: 50%;"></div>    
</div>
</div>

<!-- ******************************body*js***************************************************** -->
<script>

   var copy_form        = $('#view_formupload').children().clone();
   var copy_file_upload = $('#view_file').children().clone();

   $('#content_file').before(copy_file_upload);
   $('#content_img').before(copy_form);
   
   function add_img(node){
      if($('.add_img').length>5){
        alert('จำนวนรูปภาพ ครบตามที่กำหนด 5 รูปภาพ');
      }else{
      var copy_form        = $('#view_formupload').children().clone();
      $(node).parent().parent().before(copy_form);
     }      
   }

   function add_file(node){  
     var copy_file_upload = $('#view_file').children().clone();
    // console.log($(node).parent().parent());
     $(node).css('display','none');
     $(node).parent().parent().before(copy_file_upload);
   }

   function del_file(node){
      $(node).parent().parent().remove();
   }

   $(function(){
     $('#myModal').modal({
      show:false,
      backdrop:false
    });
   });

</script>

<!-- upload profile -->
<script type="text/javascript">

  function brwImg (node,myID){
    $(node).prev().click();
  //console.log($(node).prev());
  }

  function imgchange(node,myID){
      //var countFiles = $(this)[0].files.length;
      var path_img = $(node).parent().parent().parent().next().next().next().children();
      var imgPath  = $(node)[0].value;
      var extn     = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
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
      $(path_img).prop("src",e.target.result);
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