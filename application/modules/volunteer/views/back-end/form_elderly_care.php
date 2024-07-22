<?php 
//set_session('pers_authen',array('authen_log_id'=>10,'pid'=>'3101701933555','cid'=>'0221004350953232','random_string'=>'0886e3bf787a223c90c8a231a63d283c')); //for Test

?>

<style>

#table-elderly_care thead tr th,
#table-elderly_care tbody tr.active td {
	background: #2F4050;
	color: white;
	font-weight: 400;
}
#table-elderly_care tbody tr.active td i {
	color: white;

}
</style>

<div class="row">
	<div class="col-lg-12">
		<div class="tabs-container tabs-container-border">
			<div class="panel-group">
				<div class="panel panel-default" style=" border: none; ">
					<br>
				
					<div class="panel-heading">
						<h4>
							ข้อมูลผู้สูงอายุ
						</h4>
					</div>

					<div class="panel-body" style="border:none;">
						
						<form action="<?php echo site_url('volunteer/elderly_care/store')  ?>" method="post" class="form-horizontal">
							<input type="hidden" name="<?php echo $csrf['name'];?>" value="<?php echo $csrf['hash'];?>" />
							<input type="hidden" id="csrf_name" value="<?php echo $csrf['name'];?>">
							<input type="hidden" id="csrf_hash" value="<?php echo $csrf['hash'];?>">
							<input type="hidden" id="user_id" value="<?php echo get_session('user_id');?>">
							<input type="hidden" id="org_id" value="<?php echo get_session('org_id');?>">
							<input type="hidden" id="app_env" value="<?php echo $this->config->item('app_env') ?>">
							<!-- <input type="hidden" id="pers_authen" value="<?php //echo json_encode(get_session('pers_authen '));?>"> -->
							<input type="hidden" name="volt_info[volt_id]" value="<?php echo $volt_info['volt_id'];?>">

							<div class="form-group row">
								<div class="col-sm-12">
									<label>ผู้สูงอายุในความดูแล (จำนวน <span id="nums_family_members" data-num="<?php echo count($volt_info_elderly_care) ?>"><?php echo count($volt_info_elderly_care) ?></span> คน)</label>

									<button type="button" class=" pull-right btn btn-primary btn-add create" data-index="<?php echo count($volt_info_elderly_care); ?>">
					                  <i style="font-size:14px;" class="fa fa-plus-circle" aria-hidden="true"></i>
					                  เพิ่มรายการ
					                </button>
								</div>
								<div class="col-xs-12">
									<table id="table-elderly_care" class="table table-striped table-bordered table-hover dataTables-example" style="margin-top: 0px !important;" >
					                  	<thead style="font-size: 15px;">
						                    <tr>
						                      <th class="text-center" style="width:25%;">เลขบัตรประจำตัวประชาชน</th>
						                      <th class="text-center">(คำนำหน้า) ชื่อตัว-ชื่อสกุล</th>
						                      <th class="text-center">อายุ (ปี)</th>
						                      <th class="text-center" style="width:120px;">เครื่องมือ</th>
						                    </tr>
					            		</thead>
					                  	<tbody>
					                  		<?php foreach ($volt_info_elderly_care  as $key_elderly => $value_elderly) {  ?>
												<tr>
													<td class="text-center"><?php echo ($value_elderly['pid'] != '' ? $value_elderly['pid'] : '-' ); ?></td>
													<td><?php echo $value_elderly['prename_th'].' '.$value_elderly['pers_firstname_th'].' '.$value_elderly['pers_lastname_th']; ?></td>
													<td class="text-center">
														<?php if($value_elderly['date_of_birth'] != ''){ ?>
														<?php
															$age="";
															$date = new DateTime($value_elderly['date_of_birth']);
															$now = new DateTime();
															$interval = $now->diff($date);
															$age = $interval->y;

														?>
														<?php echo $age; ?>
														<?php }else{ ?>
																-
														<?php } ?>
													</td>
													<td class="text-center">
														<i class="fa fa-pencil btn edit" data-index="<?php echo $key_elderly; ?>" data-id="<?php echo $value_elderly['care_id']; ?>"></i>
														<i class="fa fa-trash btn delete" data-index="<?php echo $key_elderly; ?>" data-id="<?php echo $value_elderly['care_id']; ?>"></i>
													</td>
												</tr>
					                  		<?php } ?>
					                  	</tbody>
					            	</table>
								</div>
								
							</div>

							<div class="family_members">

								<?php foreach ($volt_info_elderly_care  as $key_elderly => $value_elderly) {  ?>
										
									<?php $this->load->ext_view('modules/volunteer/views/back-end/partial', '_form_elderly_care_list' , [ 'key_elderly' => $key_elderly, 'value_elderly' => $value_elderly ] ) ?>
								<?php } ?>

								<?php $this->load->ext_view('modules/volunteer/views/back-end/partial', '_form_elderly_care_list' , [ 'key_elderly' => count($volt_info_elderly_care), 'value_elderly' => [] ] ) ?>

							</div>
							<!-- <div class="row">
								<div class="col-xs-12">
									<button type="button" class="btn btn-default btn-lg btn-block" id="btAdd_family_members"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อมูลผู้สูงอายุ</button>
								</div>
							</div> -->


							<div class="row form-footer hide">
								<hr>

				                <div class="col-xs-12 col-sm-8">&nbsp;</div>
				                <div class="col-xs-12 col-sm-2">
				                  <button style="height: 40px;width: 100% !important;" type="submit" class="btn btn-primary btn-save" ><i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก</button>
				                </div>
				                <div class="col-xs-12 col-sm-2">
				                  <button style="height: 40px;width: 100% !important;" type="button" class="btn btn-primary btn-cancel" onclick="window.location.href='<?php echo site_url('volunteer/info/edit/'.$volt_info['volt_id']);?>'"><i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ</button>
				                </div>
				            </div>
						</form>
					</div>

					
					<div class="row section-btn-nav" style="margin: 0;">
						<div class="col-xs-12 col-sm-8">&nbsp;</div>
						<div class="col-xs-12 col-sm-2">
							<a href="<?php echo site_url('volunteer/care_progress/edit/'.$volt_info['volt_id']);?>" class="btn btn-primary btn-save" style="width:100%!important">
								<i class="fa fa-floppy-o" aria-hidden="true"></i> บันทึก
							</a>
						</div>
						<div class="col-xs-12 col-sm-2">
							<a href="<?php echo site_url('volunteer/info/edit/'.$volt_info['volt_id']);?>" class="btn btn-primary btn-cancel" style="width:100%!important">
								<i class="fa fa-caret-left" aria-hidden="true"></i> ย้อนกลับ
							</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<!-- #################
#Template section
################# -->

<div class="hide" data-description="template for clone">
	<li id="template_care_assistance_opinion_set">
		<div class="row">
			<div class="col-xs-11">
				<input type="text" class="form-control" name="care_assistance_opinion_set[]">
				
			</div>
			<div class="col-xs-1" style="padding-left: 0;">
				<button type="button" class="btn btn-default btn-delate-list-dynamic">
					<i class="fa fa-minus" aria-hidden="true"></i>
				</button>
			</div>
		</div>
	</li>
	
</div>


<script>
//Variable Fix required
var APP_ENV = $('#app_env').val();

//Declear Info Reader PID
// var pers_authen = JSON.parse( $('#pers_authen').val() );
var pers_authen = JSON.parse('<?php echo json_encode(get_session("pers_authen"));?>');
var user_id = $('#user_id').val();
var org_id = $('#org_id').val();
var reader_status = false;
var authen_log_id = 0;

//End Declear Info Reader PID
var csrf_hash = $('#csrf_hash').val();


//Chcek Authen pid
var bt_spid;
var inputpid;
var setData = "reqData"; //Declear Name


var reqData = function(value) { //Set Structure Display Data
	req_pers = value;

	// $("#name").html(value.name);
	// $("#date_of_birth").html(value.date_of_birth);
	// $("#gender_name").html(value.gender_name);
	// $("#nation_name_th").html(value.nation_name_th);
	// // $("#relg_title").html(value.relg_title);
	// $("#pers_id").val(value.pers_id);
	// $("#reg_addr_id").val(req_pers.reg_addr_id);
	// $("#req_reg_addr").text(value.reg_add_info);

	// $('#addr_code').text(req_pers.reg_addr.addr_code);
	// $('#gps_addr').text(req_pers.reg_addr.addr_gps);


	  // $("#name_myID").val(value.name);
//   $("#pers_id_myID").val(value.pers_id);
//   $("#marital_status_myID").val(value.marital_status);
//   $("#pers_age_myID").val(value.age);
//   $("#occupation_myID").val(value.occupation);
//   $("#mth_avg_income_myID").val(value.mth_avg_income);
//   $("#edu_code_myID").val(value.edu_code);
//   $("input[name='pers_family[healthy][myID]']").filter('[value="' + value.healthy + '"]').attr('checked', true);
//   $("input[name='pers_family[healthy_self_help][myID]']").filter('[value="' + value.healthy_self_help + '"]').attr('checked', true);
	
	$('.check-pid-active').find('.elderly_care_fullname').val(value.name);
	$('.check-pid-active').find('.elderly_care_pers_id').val(value.pers_id);
	$('.check-pid-active').find('.elderly_care_age').val(value.age);
	$('.check-pid-active').find('.elderly_care_occupation').filter('[value="' +value.occupation + '"]').prop('checked',true).iCheck('update');
	$('.check-pid-active').find('.elderly_care_mth_avg_income').val(value.mth_avg_income);
	$('.check-pid-active').find('.elderly_care_edu_code').filter('[value="' + value.edu_code+ '"]').prop('checked',true).iCheck('update');
	$('.check-pid-active').find('.elderly_care_healthy').filter('[value="' + value.healthy+ '"]').prop('checked',true).iCheck('update');
	$('.check-pid-active').find('.elderly_care_healthy_self_help').filter('[value="' + value.healthy_self_help+ '"]').prop('checked',true).iCheck('update');

	$('.check-pid-active').removeClass('check-pid-active');
}



var elderly_care_template = $('.family_members_template').clone();
var num_elderly_care = parseInt($('#nums_family_members').attr('data-num'));

$(function(){

	//Insert/Update
	// if(num_elderly_care == 0){

	// }else{ //Update case
		
	// }

	$('.i-checks').iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green',
		increaseArea: '20%'
	});

	$('.edit, .create').click(function(){
		$('.family_members_items').addClass('hide');
		$('.section-btn-nav').addClass('hide');

		var indexSectionElm = $(this).attr('data-index');
		$('.value_elderly_section_'+indexSectionElm).removeClass('hide');
		$('.form-footer').removeClass('hide');
	});

	$('.delete').click(function(){
		var indexSectionElm = $(this).attr('data-index');
		var idSectionElm = $(this).attr('data-id');

		btDel_family_members(indexSectionElm, idSectionElm , this);
	});

	$('.btn-add-list-dynamic').click(function(){
		var nameTemplate = $(this).attr('data-template');
		var elmTemplate = $('#'+nameTemplate).clone();

		elmTemplate.removeAttr('id');

		$(this).parents('.group-dynamic').find('.group-dynamic-list').append(elmTemplate);

	});

	$('.group-dynamic').on('click' , '.btn-delate-list-dynamic', function(){
		$(this).parents('li').remove();
	});

	$('.radio-toggle-text').on( 'ifClicked', function(){
		//Clear elm disabled
		$(this).parents('ul').find('.text-toggle-disabled').prop('disabled', true);

		var textToggleElm = $(this).parents('li').find('.text-toggle-disabled');
		if(textToggleElm.length != 0){
			if(textToggleElm.is(':disabled')){
				textToggleElm.prop('disabled', false);
			}else{
				textToggleElm.prop('disabled', true);

			}
		}
	});

	$('.checkbox-toggle-text').on( 'ifClicked', function(){
		var textToggleElm = $(this).parents('li').find('.text-toggle-disabled');
		if(textToggleElm.length != 0){
			if(textToggleElm.is(':disabled')){
				textToggleElm.prop('disabled', false);
			}else{
				textToggleElm.prop('disabled', true);

			}
		}
		
	});


	// $("#btAdd_family_members").click(function() { //Add
 //        addFmlyMember();
 //    });

	$('.family_members').on('ifClicked', '.care_cause_code' , function(){
		if ($(this).val() == '002') {
			$("#care_cause_ident-" + $(this).data("index")).removeAttr('disabled');
		} else {
			$("#care_cause_ident-" + $(this).data("index")).attr('disabled', '');
		}

	});

    // ###################
    //Chcek Authen pid
   	// ###################

   	$('.family_members').on( 'click', '.btn-check-pid', function() { //On Click for Search
   		//Active elm check pid
   		$(this).parents('.family_members_items').addClass('check-pid-active');

		var inputPidElderlyItem = $(this).parents('.family_members_items').find('.input-pid');
		inputpid = inputPidElderlyItem; //Fix request
		bt_spid = this;

		if ($(inputPidElderlyItem).val() != '') { //pid not null
			$(this).attr('disabled', true);

			if (pers_authen != null) { //Check Personal Authen
				getPersInfo(inputPidElderlyItem, this, setData); //Get Data
			} else if (!reader_status) { //Run Reader Personal
				run_readerPers();
				$(this).attr('disabled', false);
				toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก", "Authentications");
			}
		} else //pid is null
			$(inputPidElderlyItem).select();
	});





});

function btDel_family_members(index, care_id , elm) {
	var cf = confirm('ท่านต้องการลบข้อมูลนี้ ใช่หรือไม่');

	if(cf == true){
		num_elderly_care -= 1;
		if (care_id != "") {
			var dataAjax = {};
		    dataAjax[$('#csrf_name').val()] = $('#csrf_hash').val();
		    dataAjax['care_id'] = care_id;

			$.ajax({
				  url: base_url + 'volunteer/del_elderly_care',
				  type: 'POST',
				  dataType: 'html',
				  data: dataAjax,
				  success: function(result) {
				  	$('.value_elderly_section_'+index).remove();
				    // $(node).parents('.family_members_items').remove();
				    $("#nums_family_members").text(num_elderly_care);

				    $(elm).parents('tr').remove();
				  },
				  error: function() {
				    alert('ไม่สามารถลบผู้สูงอายุในความดูแลได้ กรุณาลองใหม่');
				  }
			});
		} else {
			// $(node).parents('.family_members_items').remove();
			$('.value_elderly_section_'+index).remove();
			$("#nums_family_members").text(num_elderly_care);
		}
	}
}

// function addFmlyMember() {
// 	var elderly_care_template_new = elderly_care_template.html().replace(new RegExp("myID", 'g'), num_elderly_care);


// 	$(elderly_care_template_new).appendTo('.family_members');


// 	//Re initial libs jquery

// 	$("#pid_" +num_elderly_care ).mask("9-9999-99999-99-9");

// 	$('.i-checks').iCheck({
// 		checkboxClass: 'icheckbox_square-green',
// 		radioClass: 'iradio_square-green',
// 		increaseArea: '20%'
// 	});

// 	num_elderly_care += 1;
// 	$("#nums_family_members").text(num_elderly_care);
// }

$("#guide-book").click(function(){
	window.open('/assets/modules/volunteer/guide/Vol_Manual.pdf', '_blank');
});
</script>





<script type="text/javascript">
// **************** fix calling undeclaring function ****************************
// function icheck_loop() {
  // $('.i-checks').iCheck({
  //   checkboxClass: 'icheckbox_square-green',
  //   radioClass: 'iradio_square-green',
  //   increaseArea: '20%'
  // });
  // $("input[name='elder_addr_chk']").on('ifClicked', function() {
  //   if (!$(this).prop('checked')) {
  //     $(".elder_addr_pre").attr('disabled', true);
  //   } else {
  //     $(".elder_addr_pre").attr('disabled', false);
  //   }
  // });
 
  // $("input[name='elder_addr_chk']").parent().addClass('checked');
  // $("input[name='elder_addr_chk']").prop('checked', true);
  // $(".elder_addr_pre").attr('disabled', true);
  


  // $("input[name='volt_info_village_position[vpos_code][009]']").on('ifChanged', function() {
  //   if ($(this).prop('checked')) {
  //     $("input[name='volt_info_village_position[vpos_identify][009]']").prop('disabled', false).focus();
  //   } else {
  //     $("input[name='volt_info_village_position[vpos_identify][009]']").prop('disabled', true);
  //   }
  // });

  // $("input[name='volt_info[older_care_training]']").on('ifChanged', function() {
  //   if ($(this).val() == 'เคยได้รับการอบรม') {
  //     $(".training").prop('disabled', false);
  //   } else {
  //     $(".training").prop('disabled', true);
  //   }
  // });

  
// };
// setTimeout(icheck_loop, 2000);
// ***************** end fix ******************************

// icheck_loop();
// var inputpid_myID = "#pid_myID";
// var bt_spid_myID = "#bt_pid_myID";
// var setData_myID = "reqData_myID"; //Declear Name
// var reqData_myID = function(value) { //Set Structure Display Data
//   console.dir(value);
//   console.log('reqData_myID', value);
//   $("#name_myID").val(value.name);
//   $("#pers_id_myID").val(value.pers_id);
//   $("#marital_status_myID").val(value.marital_status);
//   $("#pers_age_myID").val(value.age);
//   $("#occupation_myID").val(value.occupation);
//   $("#mth_avg_income_myID").val(value.mth_avg_income);
//   $("#edu_code_myID").val(value.edu_code);
//   $("input[name='pers_family[healthy][myID]']").filter('[value="' + value.healthy + '"]').attr('checked', true);
//   $("input[name='pers_family[healthy_self_help][myID]']").filter('[value="' + value.healthy_self_help + '"]').attr('checked', true);
// }


// $(bt_spid_myID).click(function() { //On Click for Search
//   if ($(inputpid_myID).val() != '') { //pid not null
//     $(bt_spid_myID).attr('disabled', true);
//     if (pers_authen != null) { //Check Personal Authen
//       getPersInfo(inputpid_myID, bt_spid_myID, setData_myID); //Get Data
//     } else if (!reader_status) { //Run Reader Personal
//       run_readerPers();
//       $(bt_spid_myID).attr('disabled', false);
//       toastr.warning("ท่านยังไม่ได้ Authen เข้าใช้งานในฐานะเจ้าหน้าที่ ระบบกำลังเชื่อมโยงข้อมูลกับฐานข้อมูลหลัก", "Authentications");
//     }
//   } else //pid is null
//     $(inputpid_myID).select();
// });

</script>


