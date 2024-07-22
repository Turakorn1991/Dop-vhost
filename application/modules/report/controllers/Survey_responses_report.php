<?php defined('BASEPATH') OR exit('No direct script access allowed');

include_once("Main.php");
class Survey_responses_report extends Main_Controller {

	public function __construct() {
      parent::__construct();

      $this->load->model([ '../../../models/common_model' ,'../../jobs/models/edoe_job_survey_responses_model',]);
    }

    public function xls(){
    	
    	$this->excel(APPPATH . '/../assets/modules/report/static/survey_responses.xlsx',$this->get_reportData(),'D','report_F0',array(),6);
    }

    private function get_reportData() {
		$data = array();
		$survey_responses = $this->edoe_job_survey_responses_model->get_all();

		foreach ($survey_responses as $key => $respone) {

			$row = array();
			$row[] = $key+1;
			$row[] = $respone->job_sur_res_organization_type;
			$row[] = $respone->job_sur_res_organization_name;
			$row[] = $respone->job_sur_res_already_employed;
			$row[] = $respone->job_sur_res_employed_num;
			$row[] = $respone->job_sur_res_male_employed_num;
			$row[] = $respone->job_sur_res_female_employed_num;
			$row[] = $respone->job_sur_res_age_60_to_65_num;
			$row[] = $respone->job_sur_res_age_66_to_70_num;
			$row[] = $respone->job_sur_res_age_71_to_75_num;
			$row[] = $respone->job_sur_res_age_greater_than_76_num;
			$row[] = $respone->job_sur_res_education_not_educated_num;
			$row[] = $respone->job_sur_res_education_primary_school_num;
			$row[] = $respone->job_sur_res_education_secondary_school_num;
			$row[] = $respone->job_sur_res_education_vocational_num;
			$row[] = $respone->job_sur_res_education_bachelor_num;
			$row[] = $respone->job_sur_res_education_master_num;
			$row[] = $respone->job_sur_res_education_phd_num;
			$row[] = $respone->job_sur_res_education_spicify;
			$row[] = $respone->job_sur_res_work_hours;
			$row[] = $respone->job_sur_res_work_description;
			$row[] = $respone->job_sur_res_employment_payment_type_set;
			$row[] = $respone->job_sur_res_employment_policy;
			$row[] = $respone->job_sur_res_employment_purpose;
			$row[] = $respone->job_sur_res_suggestion;
			$row[] = $respone->job_sur_res_prename;
			$row[] = $respone->job_sur_res_firstname;
			$row[] = $respone->job_sur_res_lastname;
			$row[] = $respone->job_sur_res_tel;
			$row[] = $respone->job_sur_res_mobile_tel;
			$row[] = $respone->job_sur_res_email;

			$data['rows'][] = $row ;
		}

		$data['headers'] = array(
		'ข้อมูลอาสาสมัครดูแลผู้สูงอายุ (อผส.)',
		'กรมกิจการผู้สูงอายุ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์',
		'ข้อมูล ณ วันที่ '.dateTH(date('Y-m-d')).' (จำนวน '.count($survey_responses).' รายการ)',
		' '
		);

		if(!$data['rows'])
		$this->dataempty();
		return array(
			'content_view' => 'survey_report',
			'title' => 'ข้อมูลอาสาสมัครดูแลผู้สูงอายุ (อผส.)',
			'res' => $data
		);
    }
}

?>