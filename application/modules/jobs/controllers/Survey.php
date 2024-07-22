<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// use Port\Excel\ExcelWriter;

class Survey extends MX_Controller {

	private $user_id;
	private $app_id;
	private $process_action;
	private $usrpm;

	function __construct() {
		parent::__construct();

		$exceptAuth = ['government','private', 'to', 'form','export_xlsx', 'form_store', 'thankyou'];
		$method_name = $this->uri->segment(3);
		
		if(!in_array($method_name, $exceptAuth)){

			chkUserLogin();

			$this->user_id = get_session('user_id');

			if($this->config->item('app_env') == 'production'){
				$this->app_id = 175; //Fix for production.

			}else{
				$this->app_id = 174; //Fix for dev.
				
			}

			if($method_name == 'index' || $method_name == '' ){
				$this->process_action = 'View';

			}else if($method_name == 'create'){
				$this->process_action = 'Add';

			}else if( $method_name == 'store' && is_empty($this->input->post('job_sur_id')) ){
				$this->process_action = 'Added';

			}else if($method_name == 'edit'){
				$this->process_action = 'Edit';

			}else if($method_name == 'store' && !is_empty($this->input->post('job_sur_id')) ){
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

		}
	}

	function __deconstruct() {
		
		$this->webinfo_model->LogSave($this->app_id,$this->process_action,'Sign Out','Success'); //Save Sign Out Log

		$this->db->close();
	}

	public function index(){ 
		// // echo 'for list or index';
		$data = array();//Set Initial Variable to Views

		$app_name = $this->usrpm['app_name'];
		$data['usrpm'] = $this->usrpm;
		$data['user_id'] = $this->user_id;
		

		$this->load->library('template',
			array('name'=>'admin_template1',
				  'setting'=>array('data_output'=>''))
		); // Set Template

		$data['process_action'] = $this->process_action;
		$data['content_heading'] = 'partial/_menu_tab_list_page';
		$data['content_view'] = 'survey_list';

		$tmp = $this->admin_model->getOnce_Application($this->usrpm['app_parent_id']); //Used for find root application
		$data['head_title'] = $tmp['app_name'];
		$data['title'] = $this->usrpm['app_name'];

		$Edoe_job_survey_responses_model = new Edoe_job_survey_responses_model();
		$data['num_survey_responses'] = $Edoe_job_survey_responses_model->count();

		$this->template->load('index_page_module_heading_blank',$data,'survey');
	}

	public function form(){
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);

		$Survey_model = new Survey_model();
		$data['survey'] = $Survey_model->get_latest();

		$data['title'] = $data['web_title'];

		$data['content_view'] = '../modules/jobs/views/front-end/survey_form';

		$data['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);

		set_js_asset_footer('../modules/jobs/js/survey_form.js');
		$this->load->view("web_template1/index_page", $data);
	}

	public function thankyou(){
		$result = $this->common_model->custom_query("SELECT * FROM web_detail WHERE web_id = '1'");
		$data = rowArray($result);

		$Survey_model = new Survey_model();
		$data['survey'] = $Survey_model->get_latest();

		$data['title'] = $data['web_title'];

		$data['content_view'] = '../modules/jobs/views/front-end/survey_thankyou';


		$this->load->view("web_template1/index_page", $data);
	}

	public function form_store(){
		// echo 'for save date to DB';die;
		$Edoe_job_survey_responses_model = new Edoe_job_survey_responses_model();

		$Edoe_job_survey_responses_model->job_sur_res_organization_type = $this->input->post('job_sur_res_organization_type');
		$Edoe_job_survey_responses_model->job_sur_res_organization_name = $this->input->post('job_sur_res_organization_name');
		$Edoe_job_survey_responses_model->job_sur_res_already_employed = $this->input->post('job_sur_res_already_employed');
		$Edoe_job_survey_responses_model->job_sur_res_employed_num = $this->input->post('job_sur_res_employed_num');
		$Edoe_job_survey_responses_model->job_sur_res_male_employed_num = $this->input->post('job_sur_res_male_employed_num');
		$Edoe_job_survey_responses_model->job_sur_res_female_employed_num = $this->input->post('job_sur_res_female_employed_num');
		$Edoe_job_survey_responses_model->job_sur_res_age_60_to_65_num = $this->input->post('job_sur_res_age_60_to_65_num');
		$Edoe_job_survey_responses_model->job_sur_res_age_66_to_70_num = $this->input->post('job_sur_res_age_66_to_70_num');
		$Edoe_job_survey_responses_model->job_sur_res_age_71_to_75_num = $this->input->post('job_sur_res_age_71_to_75_num');
		$Edoe_job_survey_responses_model->job_sur_res_age_greater_than_76_num = $this->input->post('job_sur_res_age_greater_than_76_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_not_educated_num = $this->input->post('job_sur_res_education_not_educated_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_primary_school_num = $this->input->post('job_sur_res_education_primary_school_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_secondary_school_num = $this->input->post('job_sur_res_education_secondary_school_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_vocational_num = $this->input->post('job_sur_res_education_vocational_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_bachelor_num = $this->input->post('job_sur_res_education_bachelor_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_master_num = $this->input->post('job_sur_res_education_master_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_phd_num = $this->input->post('job_sur_res_education_phd_num');
		$Edoe_job_survey_responses_model->job_sur_res_education_spicify = $this->input->post('job_sur_res_education_spicify');
		$Edoe_job_survey_responses_model->job_sur_res_work_hours = $this->input->post('job_sur_res_work_hours');
		$Edoe_job_survey_responses_model->job_sur_res_work_description = $this->input->post('job_sur_res_work_description');
		$Edoe_job_survey_responses_model->job_sur_res_employment_payment_type_set = $this->input->post('job_sur_res_employment_payment_type_set');
		$Edoe_job_survey_responses_model->job_sur_res_employment_policy = $this->input->post('job_sur_res_employment_policy');
		$Edoe_job_survey_responses_model->job_sur_res_employment_purpose = $this->input->post('job_sur_res_employment_purpose');
		$Edoe_job_survey_responses_model->job_sur_res_suggestion = $this->input->post('job_sur_res_suggestion');
		$Edoe_job_survey_responses_model->job_sur_res_prename = $this->input->post('job_sur_res_prename');
		$Edoe_job_survey_responses_model->job_sur_res_firstname = $this->input->post('job_sur_res_firstname');
		$Edoe_job_survey_responses_model->job_sur_res_lastname = $this->input->post('job_sur_res_lastname');
		$Edoe_job_survey_responses_model->job_sur_res_tel = $this->input->post('job_sur_res_tel');
		$Edoe_job_survey_responses_model->job_sur_res_mobile_tel = $this->input->post('job_sur_res_mobile_tel');
		$Edoe_job_survey_responses_model->job_sur_res_email = $this->input->post('job_sur_res_email');
		$Edoe_job_survey_responses_model->job_sur_res_lastname = $this->input->post('job_sur_res_lastname');
		$Edoe_job_survey_responses_model->job_sur_res_insert_datetime = getDatetime();

		$Edoe_job_survey_responses_model->save();

		// print_r($Survey_model);
		redirect('jobs/survey/thankyou','refresh');
	}

	// public function export_xlsx(){
		// $file = new \SplFileObject('../download/data.xlsx', 'w');
		// $writer = new ExcelWriter($file);

		// $writer->prepare();
		// $writer->writeItem(['first', 'last']);
		// $writer->writeItem(['first' => 'James', 'last' => 'Bond']);
		// $writer->finish();
		// echo 'ok';
	// }

}
?>