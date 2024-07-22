<?php
class Edoe_job_survey_responses_model extends CI_Model{

	public $job_sur_res_id;
	public $job_sur_res_organization_type;
	public $job_sur_res_organization_name;
	public $job_sur_res_already_employed;
	public $job_sur_res_employed_num;
	public $job_sur_res_male_employed_num;
	public $job_sur_res_female_employed_num;
	public $job_sur_res_age_60_to_65_num;
	public $job_sur_res_age_66_to_70_num;
	public $job_sur_res_age_71_to_75_num;
	public $job_sur_res_age_greater_than_76_num;
	public $job_sur_res_education_not_educated_num;
	public $job_sur_res_education_primary_school_num;
	public $job_sur_res_education_secondary_school_num;
	public $job_sur_res_education_vocational_num;
	public $job_sur_res_education_bachelor_num;
	public $job_sur_res_education_master_num;
	public $job_sur_res_education_phd_num;
	public $job_sur_res_education_spicify;
	public $job_sur_res_work_hours;
	public $job_sur_res_work_description;
	public $job_sur_res_employment_payment_type_set;
	public $job_sur_res_employment_policy;
	public $job_sur_res_employment_purpose;
	public $job_sur_res_suggestion;
	public $job_sur_res_prename;
	public $job_sur_res_firstname;
	public $job_sur_res_lastname;
	public $job_sur_res_tel;
	public $job_sur_res_mobile_tel;
	public $job_sur_res_email;
	public $job_sur_res_insert_datetime;

	public function count(){
		return $this->common_model->from('edoe_job_survey_responses')
									->count_all_results();
	}

	public function get_all(){
		return $this->common_model->from('edoe_job_survey_responses')
									->get()
									->result();
	}

	public function save(){
		if( empty( $this->job_sur_id )){ //Case Insert
			return $this->common_model->insert( 'edoe_job_survey_responses' , $this);

		}else{ //Case Update
			return $this->common_model->update( 'edoe_job_survey_responses' , $this , array('job_sur_res_id' => $this->job_sur_id) );
		}
	}
}
?>