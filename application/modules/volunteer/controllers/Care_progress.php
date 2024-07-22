<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Care_progress extends MX_Controller {

  // var $APP_ID = 52;
  // var $USER_ID;
  // var $USER_PERMISSION;

	// function __construct() {
	// 	parent::__construct();
	// 	chkUserLogin();
 //    $this->USER_ID = get_session('user_id');
	// 	$this->USER_PERMISSION = $this->admin_model->chkOnce_usrmPermiss($this->APP_ID,$this->USER_ID); //Check User Permission
 //    $this->load->library('template', array(
 //      'name'=>'admin_template1',
 //      'setting'=>array('data_output'=>''))
 //    );
	// }

	// function __deconstruct() {
	// 	$this->db->close();
	// }

  private $user_id;
  private $app_id;
  private $process_action;
  private $usrpm;

  function __construct() {
    parent::__construct();

    $exceptAuth = ['ajax_insert', 'ajax_update', 'ajax_delete'];
    $method_name = $this->uri->segment(3);
    
    if(!in_array($method_name, $exceptAuth)){

      chkUserLogin();

      $this->user_id = get_session('user_id');
      $this->app_id = 52; //Fix for dev.

      if($method_name == 'index' || $method_name == '' ){
        $this->process_action = 'View';

      }else if($method_name == 'create'){
        $this->process_action = 'Add';

      }else if( $method_name == 'store' && is_empty($this->input->post('volt_info[volt_id]')) ){
        $this->process_action = 'Added';

      }else if($method_name == 'edit'){
        $this->process_action = 'Edit';

      }else if($method_name == 'store' && !is_empty($this->input->post('volt_info[volt_id]')) ){
        $this->process_action = 'Edited';
      }

      $this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign In','Success'); //Save Sign In Log
      $this->usrpm = $this->admin_model->chkOnce_usrmPermiss($this->app_id,$this->user_id); //Check User Permission

      //Check permission
      if(!isset($this->usrpm['app_id']) || $this->usrpm['perm_status']=='No'){
        $this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign Out','Fail'); //Save Sign In Log
        page500();
        die;
      }

      $this->load->library('template',
      array(  
          'name'=>'admin_template1',
          'setting'=>array('data_output'=>'')
        )
      ); // Set Template

    }
  }

  function __deconstruct() {
    $this->db->close();
  }

  public function edit($id = 0){
    $volunteer_id = $id;
    $volt_info = $this->volunteer_model->get_id($volunteer_id);

    if(count($volt_info) != 0){

      //data set section
      $data = array();

      $data['volt_info'] = $volt_info;
      $data['volt_info_elderly_care'] = $this->volunteer_model->elderly_care($volunteer_id); //Get data elderly_care
      $data['care_activities'] = $this->volunteer_model->get_care_activity();
      $data['volt_info_care_progress'] = $this->volunteer_model->care_progress($volunteer_id);




      //Start required view section

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

      set_js_asset_footer('webservice.js','personals'); //Set JS sufferer_form1.js
      // set_js_asset_footer('volunteer_info.js','volunteer'); //Set JS volunteer_info.js

      $data['usrpm'] = $this->usrpm;
      $data['user_id'] = $this->user_id;
      $data['process_action'] = $this->process_action;
      $data['content_heading'] = 'partial/_menu_tab_list_page';
      $data['content_view']   = 'form_care_progress';

      $tmp = $this->admin_model->getOnce_Application($this->usrpm['app_parent_id']); //Used for find root application

      $data['head_title']   = $tmp['app_name'];
      $data['title']      = $this->usrpm['app_name'];

      $data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
      );


      $this->template->load('index_page_module_heading_blank',$data,'volunteer');
    }else {
          // no volunteer data
          page500();
          $this->webinfo_model->LogSave($this->app_id, $this->process_action, 'Sign Out', 'Fail'); //Save Sign Out Log
      }
      
  }

  public function ajax_insert() {
    try {
      $data_insert = $this->input->post();
      $data_insert['care_prog_acti_id_set']     = json_encode($data_insert['care_prog_acti_id_set']);
      $data_insert['care_prog_insert_user_id'] 	= getUser();
      $data_insert['care_prog_insert_datetime']	= getDatetime();
      $data_insert['care_prog_insert_org_id'] 	= get_session("org_id");
      $primaryKey = $this->common_model->insert('volt_info_care_progress', $data_insert);
      echo json_encode(array(
        'fx'           => 'ajax_insert_volunteerProgress',
        'success'      => true,
        'data'         => $data_insert,
        'care_prog_id' => $primaryKey
      ));
    } catch (\Exception $e) {
      echo json_encode(array('error'=>$e));
    }
  }

  public function ajax_update() {
    try {
      $data_update = $this->input->post();
      $data_update['care_prog_acti_id_set']     = json_encode($data_update['care_prog_acti_id_set']);
      $data_update['care_prog_update_user_id'] 	= getUser();
      $data_update['care_prog_update_datetime']	= getDatetime();
      $data_update['care_prog_update_org_id'] 	= get_session("org_id");
      $this->common_model->update('volt_info_care_progress', $data_update, array('care_prog_id'=>$data_update['care_prog_id']));
      echo json_encode(array('fx'=>'ajax_update_volunteerProgress', 'success'=>true));
    } catch (\Exception $e) {
      echo json_encode(array('error'=>$e));
    }
  }

  public function ajax_delete() {
    try {
      $data_update = $this->input->post();
      $data_update['care_prog_update_user_id'] 	= getUser();
      $data_update['care_prog_update_datetime']	= getDatetime();
      $data_update['care_prog_update_org_id'] 	= get_session("org_id");
      $this->common_model->update('volt_info_care_progress', $data_update, array('care_prog_id'=>$data_update['care_prog_id']));
      echo json_encode(array('fx'=>'ajax_delete_volunteerProgress', 'success'=>true));
    } catch (\Exception $e) {
      echo json_encode(array('error'=>$e));
    }
  }

}
