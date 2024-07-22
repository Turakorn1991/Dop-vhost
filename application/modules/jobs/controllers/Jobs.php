<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MX_Controller {

	function __construct() {
		parent::__construct();
		chkUserLogin();
	}

	function __deconstruct() {
		$this->db->close();
	}

	public function getChart(){
    // ini_set('max_execution_time', 800);
    $dataChart = array();
    // $prov = $this->personal_model->getAll_Province();
    $wisdom = $this->common_model->custom_query("SELECT * FROM std_position_type ORDER BY posi_type_code ASC");
    foreach ($wisdom as $key => $row) {
        $dataChart[] = array(
            'jobs_type' => $row['posi_type_title'],
            'value' => $this->db->where('posi_cate_code',$row['posi_type_code'])->from('edoe_job_vacancy')->count_all_results(),
            // 'value' => 10,
        );
    }
    echo json_encode($dataChart);
  }

	public function jobs_list($process_action='View') {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 151;
		$process_path = 'jobs/jobs_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] 		= $usrpm;
			$data['user_id'] 	= $user_id;

			// ******************* supposed to be in Model ***************************
			$this->db
				->from('edoe_job_vacancy')
				->join('std_position_type', 'posi_cate_code=posi_type_code')
				->order_by('date_of_post', 'desc');

			if ($this->input->post('posi_type_code'))
				$this->db->where('posi_cate_code', $this->input->post('posi_type_code'));
			if ($this->input->post('exp_code'))
				$this->db->where('posi_expert_code', $this->input->post('exp_code'));
			if ($this->input->post('posi_experience_GE'))
				$this->db->where('posi_experience>=', $this->input->post('posi_experience_GE'));
			if ($this->input->post('posi_experience_LE'))
				$this->db->where('posi_experience<=', $this->input->post('posi_experience_LE'));

			$data['jobsList'] = $this->db
				->get()
				->result_array();

			$data['std_position_type'] = $this->common_model->getTable('std_position_type');
			$data['std_expert'] = $this->common_model->getTable('std_expert');
			// ******************* supposed to be in Model ***************************

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['count_jobs'] 	= count($data['jobsList']);
			$data['count_regis'] 	= $this->useful_model->getNumRows('edoe_older_emp_reg');

			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/

  			/*-- Toastr style --*/
  			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
  			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
  			/*-- End Toastr style --*/

  			set_js_asset_footer('jobs_list.js','jobs'); //Set JS

 			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/ionRangeSlider/ion.rangeSlider.min.js'); //Set JS Index.js


			$data['process_action'] = $process_action;
			$data['content_heading'] = 'partial/_menu_tab_list_page';
			$data['content_view'] 	= 'jobs_list';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] 			= $usrpm['app_name'];
			// dieArray($data);
			$this->template->load('index_page_module_heading_blank',$data,'jobs');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}

	public function registered_list($process_action='View') {
		$data = array(); //Set Initial Variable to Views
		/*-- Initial Data for Check User Permission --*/
		$user_id = get_session('user_id');
		$app_id = 152;
		$process_path = 'jobs/registered_list';
		/*--END Inizial Data for Check User Permission--*/

		$this->webinfo_model->LogSave($app_id,$process_action,'Sign In','Success'); //Save Sign In Log
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id); //Check User Permission

		if(@$usrpm['perm_status']=='No' || !isset($usrpm['app_id'])){
			page500();
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Fail'); //Save Sign In Log
		}else {
			$app_name = $usrpm['app_name'];
			$data['usrpm'] = $usrpm;
			$data['user_id'] = $user_id;

			// ******************* supposed to be in Model ***************************
			$this->db
				->from('edoe_older_emp_reg a')
				->join('std_expert b', 'a.exp_code=b.exp_code');

			if ($this->input->post('pid') ||
				$this->input->post('name') ||
				$this->input->post('gender_code') ||
				$this->input->post('age_GE') ||
				$this->input->post('age_LE'))
				$this->db->join('pers_info c', 'a.pers_id=c.pers_id');

			if ($this->input->post('pid'))
				$this->db->where('pid', $this->input->post('pid'));

			if ($this->input->post('name')) {
				$name = explode(' ', $this->input->post('name'));
				$this->db->where(array(
					'c.pers_firstname_th' => $name[0],
					'c.pers_lastname_th' => $name[1]
				));
			}

			if ($this->input->post('gender_code'))
				$this->db->where('gender_code', $this->input->post('gender_code'));

			if ($this->input->post('age_GE'))
				$this->db->where('date_of_birth<=', (date('Y') - $this->input->post('age_GE')) . date('-m-d'));

			if ($this->input->post('age_LE'))
				$this->db->where('date_of_birth>=', (date('Y') - $this->input->post('age_LE')) . date('-m-d'));

			if ($this->input->post('date_of_register_GE'))
				$this->db->where("date_of_reg>=", $this->input->post('date_of_register_GE'));

			$data['regList'] = $this->db
				->get()
				->result_array();

			$data['std_gender'] = $this->common_model->getTable('std_gender');
			// ******************* supposed to be in Model ***************************

			$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
			);

			$data['count_jobs'] = $this->useful_model->getNumRows('edoe_job_vacancy');
			$data['count_regis'] = count($data['regList']);
			$this->load->library('template',
				array('name'=>'admin_template1',
					  'setting'=>array('data_output'=>''))
			); // Set Template

			/*-- datepicker custom --*/
			set_css_asset_head('../plugins/bootstrap-datepicker-custom/dist/css/bootstrap-datepicker.css');
			set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/js/bootstrap-datepicker-custom.js');
			set_js_asset_head('../plugins/bootstrap-datepicker-custom/dist/locales/bootstrap-datepicker.th.min.js');
			/*-- End datepicker custom--*/
			/*-- Load Datatables for Theme --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/dataTables/datatables.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/dataTables/datatables.min.js');
			/*-- End Load Datatables for Theme --*/
			/*-- Toastr style --*/
			set_css_asset_head('../plugins/Static_Full_Version/css/plugins/toastr/toastr.min.css');
			set_js_asset_footer('../plugins/Static_Full_Version/js/plugins/toastr/toastr.min.js');
			/*-- End Toastr style --*/

			set_js_asset_footer('registered_list.js','jobs'); //Set JS

			$data['process_action'] = $process_action;
			$data['content_heading'] = 'partial/_menu_tab_list_page';
			$data['content_view'] 	= 'registered_list';

			$tmp = $this->admin_model->getOnce_Application($usrpm['app_parent_id']); //Used for find root application
			$data['head_title'] = $tmp['app_name'];
			$data['title'] 			= $usrpm['app_name'];
			// dieArray($data);
			$this->template->load('index_page_module_heading_blank',$data,'jobs');
			$this->webinfo_model->LogSave($app_id,$process_action,'Sign Out','Success'); //Save Sign Out Log
		}
	}
}
