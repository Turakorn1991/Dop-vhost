<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editor extends MX_Controller {

  var $APP_ID = 52;
  var $USER_ID;
  var $USER_PERMISSION;

	function __construct() {
		parent::__construct();
		chkUserLogin();

    $this->USER_ID = get_session('user_id');
		$this->USER_PERMISSION = $this->admin_model->chkOnce_usrmPermiss($this->APP_ID,$this->USER_ID); //Check User Permission
    $this->load->library('template', array(
      'name'=>'admin_template1',
      'setting'=>array('data_output'=>''))
    );
	}

	function __deconstruct() {
		$this->db->close();
	}

  public function insert() {
    $mode='Add';
    $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign In','Success'); //Save Sign In Log
    if (!$this->have_permission($mode))
      return page500();
    $data = $this->init_viewDataAndStylingAssets($mode);
    // blank form
    $data = $this->merge_blankVolunteerData($data);
    $this->template->load('index_page',$data,'volunteer');
    $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Success'); //Save Sign Out Log
  }

  public function inserted() {
    $mode='Added';
    $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign In','Success'); //Save Sign In Log
    if (!$this->have_permission($mode))
      return page500();
    $data = $this->init_viewDataAndStylingAssets($mode);
    // submit form
    $this->load->library('form_validation', null, 'frm');
    $this->frm->set_rules('volt_info[date_of_reg]','วันที่ขึ้นทะเบียน','required|callback_date_check');
    $this->frm->set_rules('volt_info[pers_id]','เลขประจำตัวประชาชน','required');
    $this->frm->set_message("required","กรุณากรอกข้อมูล %s");
    $this->frm->set_message("numeric","%s ต้องเป็นตัวเลข");
    $this->frm->set_message("date_check","%s รูปแบบของวันที่ไม่ถูกต้อง");
    if ($this->frm->run()) {
      // valid data
      $volunteer_id = $this->handle_volunteerInfo();
      $this->handle_volunteerAddress();
      $this->handle_volunteerVillagePositions($volunteer_id);
      // $this->handle_volunteerEldersInCharge($volunteer_id);
      $this->handle_volunteerTrainings($volunteer_id);

      $this->session->set_flashdata('msg',setMsg('011')); //Set Message code 011
      $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Success'); //Save Sign Out Log
      redirect('volunteer/editor/edit/'.$volunteer_id,'refresh');
    } else {
      // form error, re-enter data
      $data['volt_info'] 			= get_inpost_arr('volt_info');
      $data['elder_addr_chk'] = set_value('elder_addr_chk');

      $this->session->set_flashdata('msg',setMsg('012')); //Set Message code 012
      $this->template->load('index_page',$data,'volunteer');
      $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Fail'); //Save Sign Out Log
    }
  }

  public function elders_inserted() {
    $mode='Added';
    $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign In','Success'); //Save Sign In Log
    if (!$this->have_permission($mode))
      return page500();
    $data = $this->init_viewDataAndStylingAssets($mode);
    // submit form
    $this->load->library('form_validation', null, 'frm');
    $this->frm->set_rules('volt_info[date_of_reg]','วันที่ขึ้นทะเบียน','required|callback_date_check');
    $this->frm->set_rules('volt_info[pers_id]','เลขประจำตัวประชาชน','required');
    $this->frm->set_message("required","กรุณากรอกข้อมูล %s");
    $this->frm->set_message("numeric","%s ต้องเป็นตัวเลข");
    $this->frm->set_message("date_check","%s รูปแบบของวันที่ไม่ถูกต้อง");
    if ($this->frm->run()) {
      // valid data
      // $volunteer_id = $this->handle_volunteerInfo();
      // $this->handle_volunteerAddress();
      // $this->handle_volunteerVillagePositions($volunteer_id);
      $this->handle_volunteerEldersInCharge($volunteer_id);
      // $this->handle_volunteerTrainings($volunteer_id);

      $this->session->set_flashdata('msg',setMsg('011')); //Set Message code 011
      $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Success'); //Save Sign Out Log
      redirect('volunteer/editor/edit/'.$volunteer_id,'refresh');
    } else {
      // form error, re-enter data
      $data['volt_info']      = get_inpost_arr('volt_info');
      $data['elder_addr_chk'] = set_value('elder_addr_chk');

      $this->session->set_flashdata('msg',setMsg('012')); //Set Message code 012
      $this->template->load('index_page',$data,'volunteer');
      $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Fail'); //Save Sign Out Log
    }
  }

  public function edit($volunteer_id = 0) {
    $mode='Edit';
    $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign In','Success'); //Save Sign In Log
    if (!$this->have_permission($mode))
      return page500();
    $data = $this->init_viewDataAndStylingAssets($mode);
    // open edit form first time
    $row = rowArray($this->common_model->custom_query("SELECT * FROM volt_info WHERE volt_id = {$volunteer_id}"));
    if(isset($row['volt_id'])) {
      // volunteer found
      $data['volt_info'] = $row;
      $data['pers_info'] = $this->personal_model->getOnce_PersonalInfo($row['pers_id']);
      if($data['pers_info']['pre_addr_id'] != '')
        $data['reg_addr'] = $this->personal_model->getOnce_PersonalAddress($data['pers_info']['reg_addr_id']);
      else
        $data['pers_addr'] = array();
      $data['pers_addr'] = $this->personal_model->getOnce_PersonalAddress($data['pers_info']['reg_addr_id']);

      $tmp = $this->common_model->custom_query("SELECT * FROM volt_info_village_position WHERE volt_id = {$volunteer_id}");
      $data['volt_info_village_position'] = sort_array_with($tmp,'vpos_code');
      $data['volt_info_elderly_care'] = $this->common_model->custom_query("SELECT * FROM volt_info_elderly_care LEFT JOIN pers_info ON volt_info_elderly_care.pers_id = pers_info.pers_id LEFT JOIN std_prename ON pers_info.pren_code = std_prename.pren_code  WHERE volt_id = {$volunteer_id}");
      $data['volt_info_training'] = $this->common_model->custom_query("SELECT * FROM volt_info_training WHERE volt_id = {$volunteer_id}");

      $data['care_activities'] = $this->common_model->custom_query("SELECT * FROM std_care_activity");
      $data['volt_info_care_progress'] = $this->common_model->custom_query("SELECT * FROM volt_info_care_progress LEFT JOIN pers_info ON volt_info_care_progress.care_prog_pers_id=pers_info.pers_id WHERE care_prog_volt_id=$volunteer_id AND care_prog_status='Active'");

      $this->template->load('index_page',$data,'volunteer');
    } else {
      // no volunteer data
      page500();
      $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Fail'); //Save Sign Out Log
    }
  }

  public function edited($volunteer_id = 0) {
    $mode='Edited';
    $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign In','Success'); //Save Sign In Log
    if (!$this->have_permission($mode))
      return page500();

    $data = $this->init_viewDataAndStylingAssets($mode);
    // edited form
    $this->load->library('form_validation', null, 'frm');
    // $this->frm->set_rules('volt_info[date_of_reg]','วันที่ขึ้นทะเบียน','required|callback_date_check');
    $this->frm->set_rules('volt_info[pers_id]','เลขประจำตัวประชาชน','required');
    $this->frm->set_message("required","กรุณากรอกข้อมูล %s");
    $this->frm->set_message("numeric","%s ต้องเป็นตัวเลข");
    $this->frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");
    if ($this->frm->run()) {
      // valid Data
      $this->handle_volunteerInfo($volunteer_id);
      $this->handle_volunteerAddress();
      $this->handle_volunteerVillagePositions($volunteer_id);
      // $this->handle_volunteerEldersInCharge($volunteer_id, $mode);
      $this->handle_volunteerTrainings($volunteer_id, $mode);

      $this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021
      $this->webinfo_model->LogSave($this->APP_ID,"Edited",'Sign Out','Success'); //Save Sign Out Log
      redirect('volunteer/editor/edit/'.$volunteer_id,'refresh');
    } else {
      // form error
      $this->session->set_flashdata('msg',setMsg('022')); //Set Message code 022
      $this->template->load('index_page',$data,'volunteer');
      $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Fail'); //Save Sign Out Log
    }
  }

  public function elders_edited($volunteer_id = 0) {

    $mode='Edited';
    // $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign In','Success'); //Save Sign In Log
    // if (!$this->have_permission($mode))
    //   return page500();

    $data = $this->init_viewDataAndStylingAssets($mode);
    // edited form
    $this->load->library('form_validation', null, 'frm');
    // $this->frm->set_rules('volt_info[date_of_reg]','วันที่ขึ้นทะเบียน','required|callback_date_check');
    // $this->frm->set_rules('volt_info[pers_id]','เลขประจำตัวประชาชน','required');
    // $this->frm->set_message("required","กรุณากรอกข้อมูล %s");
    // $this->frm->set_message("numeric","%s ต้องเป็นตัวเลข");
    // $this->frm->set_message("date_check","%s รูปบบของวันที่ต้องถูกต้อง");
    // if ($this->frm->run()) {
      // valid Data
      // $this->handle_volunteerInfo($volunteer_id);
      // $this->handle_volunteerAddress();
      // $this->handle_volunteerVillagePositions($volunteer_id);
      $this->handle_volunteerEldersInCharge($volunteer_id, $mode);
      // $this->handle_volunteerTrainings($volunteer_id, $mode);

      // $this->session->set_flashdata('msg',setMsg('021')); //Set Message code 021
      // $this->webinfo_model->LogSave($this->APP_ID,"Edited",'Sign Out','Success'); //Save Sign Out Log
      // echo 'ok';die;
      redirect('volunteer/editor/edit/'.$volunteer_id,'refresh');
    // } else {
      // echo 'else';die;
      // form error
    //   $this->session->set_flashdata('msg',setMsg('022')); //Set Message code 022
    //   $this->template->load('index_page',$data,'volunteer');
    //   $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Fail'); //Save Sign Out Log
    // }
  }

  public function delete($volunteer_id) {
    $mode='Delete';
    $this->webinfo_model->LogSave($this->APP_ID,"Delete",'Sign In','Success'); //Save Sign In Log
    if (!$this->have_permission($mode))
      return page500();
    $data = $this->init_viewDataAndStylingAssets($mode);

    $this->common_model->update('volt_info', array(
      'delete_user_id'  => get_session('user_id'),
      'delete_org_id'   => get_session('org_id'),
      'delete_datetime' => getDatetime()
    ), array('volt_id' => $volunteer_id));
    $this->session->set_flashdata('msg',setMsg('031')); //Set Message code 031
    $this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Success'); //Save Sign Out Log
    redirect('volunteer/volunteer_list','refresh');
  }

  private function have_permission($mode) {
    if ($this->USER_PERMISSION['perm_status']!='Yes' ||
      !isset($this->USER_PERMISSION['app_id']) ||
      ($mode=='Add'   && get_inpost('bt_submit')!='') ||
      ($mode=='Added' && get_inpost('bt_submit')=='') ||
      ($mode=='Edit'  && get_inpost('bt_submit')!='') ||
      ($mode=='Edited'&& get_inpost('bt_submit')=='')) {
			$this->webinfo_model->LogSave($this->APP_ID,$mode,'Sign Out','Fail'); //Save Sign Out Log
      return false;
		} else
      return true;
  }

  private function init_viewDataAndStylingAssets($mode) {

    /*-- datepicker custom --*/
    set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
    set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
    set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
    /*-- End datepicker custom--*/

		/*-- Toastr style --*/
		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
		/*-- End Toastr style --*/

		/*-- select2 style --*/
		set_css_asset_head('../plugins/Static_Full_Version/css/plugins/select2/select2.min.css');
		set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/select2/select2.full.min.js');
		/*-- End select2 style --*/

		set_js_asset_footer('mapmarker.js','webconfig'); //Set JS mapmarker.js --
    set_js_asset_footer('webservice.js','personals'); //Set JS sufferer_form1.js
		set_js_asset_footer('volunteer_info.js','volunteer'); //Set JS volunteer_info.js

    $data = array();
		$data['usrpm'] = $this->USER_PERMISSION;
		$data['user_id'] = $this->USER_ID;
    $data['process_action'] = $mode;
		$data['content_view'] 	= 'volunteer_info';

		$tmp = $this->admin_model->getOnce_Application($this->USER_PERMISSION['app_parent_id']); //Used for find root application
		$data['head_title'] 	= $tmp['app_name'];
		$data['title'] 			= $this->USER_PERMISSION['app_name'];

		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
    return $data;
  }

  private function merge_blankVolunteerData($data) {
    $data['volt_info'] = array(
      'pers_id'						           => '',
      'date_of_reg'					         => date('d-m-Y'),
      'older_care_training'			     => 'ไม่เคยได้รับการอบรม',
      'older_care_training_identify' => '',
      'date_of_training'				     => '',
      'older_care_training_org'		   => '',
      'older_care_training_course'	 => '',
    );
    $data['reg_addr'] = array(
      'addr_home_no' 			=> '',
      'addr_moo' 					=> '',
      'addr_sub_district' => '',
      'addr_district' 	  => '',
      'addr_province' 	  => '',
      'addr_zipcode' 			=> '',
      'addr_gps'          => '',
    );
    $data['pers_info'] = array(
      'pid' 					 => '',
      'pers_id' 			 => '',
      'name' 				   => ' - ',
      'date_of_birth'  => ' - ',
      'gender_name'		 => ' - ',
      'nation_name_th' => ' - ',
      'relg_title' 		 => ' - ',
      'tel_no_home' 	 => '',
      'tel_no_mobile'  => '',
      'fax_no'				 => '',
      'email_addr' 		 => '',
      'reg_addr_id' 	 => '',
      'pre_addr_id' 	 => ''
    );
    $data['process_action'] = 'Add';
    return $data;
  }

  private function handle_volunteerInfo($volunteer_id=false) {
    $data_update = get_inpost_arr('volt_info');
    $data_update['date_of_reg'] 		= dateChange($data_update['date_of_reg']);
    $data_update['update_user_id'] 	= getUser();
    $data_update['update_datetime']	= getDatetime();
    $data_update['update_org_id'] 	= get_session("org_id");
    if ($volunteer_id) {
      unset($data_update['pid']);
      $this->common_model->update('volt_info',$data_update,array('volt_id'=>$volunteer_id));
    } else
      return $this->common_model->insert('volt_info', $data_update);
  }

  private function handle_volunteerAddress() {
    if (get_inpost('elder_addr_chk')=='on') // use same address
      return;
    // insert new address
    $addr_insert = get_inpost_arr('pers_addr');
    $addr_insert['insert_user_id']  = getUser();
    $addr_insert['insert_datetime'] = getDatetime();
    $addr_insert['insert_org_id']   = get_session("org_id");
    $addr_id = $this->common_model->insert('pers_addr', $addr_insert);
    // update person's new address
    $pers_update = array();
    $pers_update['pre_addr_id']     = $addr_id;
    $pers_update['update_user_id'] 	= getUser();
    $pers_update['update_org_id'] 	= get_session('org_id');
    $pers_update['update_datetime'] = getDatetime();
    $this->common_model->update('pers_info', $pers_update, array('pers_id'=>get_inpost('volt_info[pers_info]')));
  }

  private function handle_volunteerVillagePositions($volunteer_id) {
    $tmp_position = get_inpost_arr('volt_info_village_position[vpos_code]');
    if (empty($tmp_position)) // no data
      return;
    // delete all old positions
    $this->common_model->delete_where('volt_info_village_position','volt_id',$volunteer_id);
    // insert current positions
    foreach ($tmp_position as $row)
      $this->common_model->insert('volt_info_village_position', array(
        'volt_id'				=> $volunteer_id,
        'vpos_code'		  => $row,
        'vpos_identify' => get_inpost("volt_info_village_position[vpos_identify][{$row}]")
      ));
  }

  private function handle_volunteerEldersInCharge($volunteer_id, $mode = 'Added') {
    $tmp_elderly_care = @get_inpost_arr('volt_info_elderly_care[pers_id]');
    if (empty($tmp_elderly_care)) // no data
      return;
      // print_r($this->input->post('volt_info_elderly_care[care_freq][2]'));die;

    foreach ($tmp_elderly_care as $key =>$value ) {
      $elder_care_update = array(
        'volt_id'  	 	         => $volunteer_id,
        'pers_id'  		         => $value,
        'care_freq' 		       => get_inpost('volt_info_elderly_care[care_freq]['.$key.']'),
        'care_freq_per'        => get_inpost('volt_info_elderly_care[care_freq_per]['.$key.']'),
        'care_health_problems' => get_inpost('care_pers_info[healthy]['.$key.']'),
        'care_help_yourself'   => get_inpost('care_pers_info[healthy_self_help]['.$key.']'),
        'care_cause_code'      => get_inpost('care_pers_info[care_cause_code]['.$key.']'),
        'care_cause_identify'  => get_inpost('care_pers_info[care_cause_identify]['.$key.']')
      );
      // print_r($elder_care_update);die;
      if ($mode=='Edited' && get_inpost('volt_info_elderly_care[care_id]['.$key.']')!='')
        $this->common_model->update('volt_info_elderly_care', $elder_care_update, array('care_id'=>get_inpost('volt_info_elderly_care[care_id]['.$key.']')));
      else
        $this->common_model->insert('volt_info_elderly_care', $elder_care_update);
    }
  }

  private function handle_volunteerTrainings($volunteer_id, $mode = 'Added') {
    $tmp_training_info = @get_inpost_arr('training[date_of_training]');
    if(empty($tmp_training_info) || get_inpost('volt_info[older_care_training]')!='เคยได้รับการอบรม')
      return; // no data

    foreach ($tmp_training_info as $key =>$value ) {
      $training_update = array(
        'volt_id'                    => $volunteer_id,
        'date_of_training'           => dateChange(get_inpost('training[date_of_training]['.$key.']')),
        'older_care_training_org'    => get_inpost('training[older_care_training_org]['.$key.']'),
        'older_care_training_course' => get_inpost('training[older_care_training_course]['.$key.']')
      );
      if ($mode=='Edited' && get_inpost('training[train_id]['.$key.']')!='')
        $this->common_model->update('volt_info_training', $training_update, array('train_id'=>get_inpost('training[train_id]['.$key.']')));
      else
        $this->common_model->insert('volt_info_training', $training_update);
    }
  }

}
