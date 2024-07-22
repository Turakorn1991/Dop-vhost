<?php
class Survey_model extends CI_Model{

	public $job_sur_id;
	public $job_sur_title;
	public $job_sur_url;
	public $job_sur_slug;
	public $job_sur_status;

	public $job_sur_insert_user_id;
	public $job_sur_insert_org_id;
	public $job_sur_update_user_id;
	public $job_sur_update_org_id;

	public $job_sur_insert_datetime;
	public $job_sur_update_datetime;

	public function get_id($id){
		return $this->common_model->from('edoe_job_survey')
									->where('job_sur_id', $id)
									->get()
									->row();
	}

	public function get_slug($slug){
		return $this->common_model->from('edoe_job_survey')
									->where('job_sur_slug', $slug)
									->where('job_sur_status', 'Active')
									->order_by('job_sur_update_datetime', 'DESC')
									->limit(1)
									->get()
									->row();
	}

	public function get_latest(){
		return $this->common_model->from('edoe_job_survey')
									->where('job_sur_status', 'Active')
									->order_by('job_sur_update_datetime', 'DESC')
									->limit(1)
									->get()
									->row();
	}

	public function get_all_desc(){
		return $this->common_model->from('edoe_job_survey')
									->order_by('job_sur_update_datetime', 'DESC')
									->get()
									->result();
	}

	public function save(){
		if( empty( $this->job_sur_id )){ //Case Insert
			return $this->common_model->insert( 'edoe_job_survey' , $this);

		}else{ //Case Update
			return $this->common_model->update( 'edoe_job_survey' , $this , array('job_sur_id' => $this->job_sur_id) );
		}
	}
}
?>