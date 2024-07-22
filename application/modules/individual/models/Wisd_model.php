<?php
class Wisd_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	public function getAll_admInfo() {
		return $this->common_model->custom_query("
			SELECT * FROM wisd_info 
			WHERE (delete_user_id IS NULL && delete_datetime IS NULL) 
			ORDER BY insert_datetime DESC,update_datetime DESC
		");
	}

	public function getOnce_admInfo($adm_id = '')	{
		return rowArray($this->common_model->custom_query("select A.*,B.*,C.*,D.*,E.*,F.*,G.*,CONCAT(B.pers_firstname_th, ' ', B.pers_lastname_th) as name 
                from wisd_info as A 
                                    left join pers_info as B       on A.pers_id=B.pers_id 
                                    left join std_prename as C     on B.pren_code=C.pren_code 
                                    left join std_gender as D      on B.gender_code=D.gender_code 
                                    left join std_nationality as E on B.nation_code=E.nation_code 
                                    left join std_religion as F    on B.relg_code=F.relg_code 
                                    left join std_edu_level as G    on B.edu_code=G.edu_code 
                                     
                where (A.delete_user_id IS NULL && A.delete_datetime IS NULL) and
                      (B.delete_user_id IS NULL && B.delete_datetime IS NULL) 
                      and knwl_id={$adm_id}
                "));
	}

	public function getAll_Disability($pers_id='') {
		if($pers_id == ''){
			return array();
		}
		$tmp = array();
    $tmp = $this->common_model->get_where_custom('pers_disability', 'pers_id', $pers_id);
    $tmp = sort_array_with($tmp,'dis_code');
    return $tmp;
	}

	public function getAll_caseReason($type = "การรับเข้า"){
		return $this->common_model->get_where_custom('std_case_reason', 'case_reason_type', $type);
	}

	public function getAll_admIrp($pers_id = ''){
		if($pers_id == ''){
			return array();
		}
		return $this->common_model->custom_query("
			SELECT A.*,B.* FROM adm_irp AS A
			LEFT JOIN usrm_org AS B ON A.irp_org_id = B.org_id
			WHERE pers_id = {$pers_id} 
			ORDER BY date_of_irp DESC
		");
	}

	public function getOnce_admIrp($pers_id = '',$irp_id=''){
		if($pers_id == '' || $irp_id == ''){
			return array();
		}
		return rowArray($this->common_model->custom_query("
			SELECT A.*,B.* FROM adm_irp AS A
			LEFT JOIN usrm_org AS B ON A.irp_org_id = B.org_id
			WHERE A.pers_id = {$pers_id}
			AND A.irp_id = {$irp_id} 
		"));
	}

	public function getAll_irpDimension(){ 
		return $this->common_model->get_where_custom_order('std_irp', 'qstn_type', 'Dimension','qstn_id','ASC');
	}
	
	public function getAll_irpQuestion($parent=''){ 
		if($parent == ''){
			return array();
		}
		return $this->common_model->custom_query("
			SELECT * FROM std_irp 
			WHERE qstn_type = 'Question' 
			AND qstn_pid = {$parent}
			ORDER BY qstn_id ASC
		");
	}

	public function getAll_irpAnswer($parent=''){ 
		if($parent == ''){
			return array();
		}
		return $this->common_model->custom_query("
			SELECT * FROM std_irp 
			WHERE qstn_type = 'Answer' 
			AND qstn_pid = {$parent}
			ORDER BY qstn_id ASC
		");
	}

	public function get_Percentage($irp_id='',$q_id=''){
		if($irp_id == ''){
			return array();
		}
		$question = "";
		if($q_id != ''){
			$question = "AND qstn_id = {$q_id}";
		}
		$countIrp = rowArray($this->common_model->custom_query("SELECT SUM(ans_points) AS ans_points ,SUM(ans_full_score) AS ans_full_score FROM adm_irp_result WHERE irp_id = {$irp_id} {$question}"));

		$irp_result = array(
			'ans_points' => $countIrp['ans_points'],
			'ans_full_score' => $countIrp['ans_full_score'],
			'ans_percent'	=> ($countIrp['ans_points']/$countIrp['ans_full_score'])*100,
		);

		return $irp_result;
	}

	public function getAll_Progarm($dimension = ''){
		if($dimension == ''){
			return array();
		}
		return $this->common_model->custom_query("
			SELECT * FROM std_programs 
			WHERE qstn_id = {$dimension} 
			OR qstn_id = '999'
			ORDER BY qstn_id ASC ,prgm_title DESC
		");
	}

	public function getAll_adm_irp_result($irp_id=''){
		if($irp_id == ''){
			return array();
		}
		$tmp = $this->common_model->custom_query("
			SELECT * FROM adm_irp_result
			WHERE irp_id = {$irp_id}
		");

		return sort_array_with($tmp,'qstn_id');
	}

	public function getAll_adm_trm_result($irp_id=''){
		if($irp_id == ''){
			return array();
		}
		$tmp = $this->common_model->custom_query("
			SELECT * FROM adm_trm_result
			WHERE irp_id = {$irp_id}
		");
		return sort_array_with($tmp,'prgm_id');
	}
    
    //แสดงสาขาภูมิปัญญาตามเลข id
	public function get_wisd_branch_by_knwlid($knwl_id = 0){
		return $this->common_model->custom_query("
			SELECT
				wisd_branch.*,std_wisdom.*
			FROM
					wisd_branch
			    LEFT JOIN std_wisdom ON wisd_branch.wisd_code = std_wisdom.wis_code
			WHERE wisd_branch.knwl_id = {$knwl_id}
			AND delete_user_id IS NULL 
			AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
		");

	}

	public function get_photo($branch_id = 0){
		return $this->common_model->custom_query("SELECT * FROM wisd_photo WHERE branch_id={$branch_id}");
	}

	

}
?>
