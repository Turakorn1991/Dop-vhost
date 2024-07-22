<?php defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('memory_limit', '600000M');

class Volunteer_list_excel_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('member/admin_model', 'common_model'));
    }

    function get_volunteerList($where = null) {
      $query = $this->db->select('*,std_prename.prename_th,nation_name_th as nation,relg_title as relg,std_edu_level.edu_title as edu')
        ->from('volt_info')
        ->join('pers_info', 'volt_info.pers_id=pers_info.pers_id', 'left')
        ->join('std_prename','pers_info.pren_code=std_prename.pren_code','left')
        ->join('std_nationality','std_nationality.nation_code=pers_info.nation_code','left')
        ->join('std_religion','std_religion.relg_code=pers_info.nation_code','left')
        ->join('std_edu_level','pers_info.edu_code=std_edu_level.edu_code','left')
        ->join('std_local_admin_org','volt_info.la_org_id=std_local_admin_org.la_org_id','left');

  		$usrpm = $this->admin_model->chkOnce_usrmPermiss(50, get_session('user_id'));
      if($usrpm['perm_view'] == 'Organization')//เห็นข้อมูลเฉพาะองค์กรของตนเองเท่านั้น
        $this->db->where("volt_info.insert_org_id=".get_session('org_id'));
      if($usrpm['perm_view']=='Person')//เห็นข้อมูลเฉพาะของตนเองเท่านั้น
        $this->db->where("volt_info.insert_user_id=".get_session('user_id'));

      if (!empty($where)) {
  			if ($where['date_of_resign'] == 'is null')
  				$this->db->where('date_of_resign is null');
  			if ($where['date_of_resign'] == 'is not null')
  				$this->db->where('date_of_resign is not null');
  			unset($where['date_of_resign']);

  			$this->replace_key($where,'gender_code', 'pers_info.gender_code');
  			$this->replace_key($where,'insert_org_id', 'volt_info.insert_org_id');
  			$this->replace_key($where,'date_of_birth_LE', 'pers_info.date_of_birth<=');
  			$this->replace_key($where,'date_of_birth_GE', 'pers_info.date_of_birth>=');
  			$this->replace_key($where,'date_of_reg_GE', 'volt_info.date_of_reg>=');
  			$this->replace_key($where,'date_of_resign_LE', 'volt_info.date_of_resign<=');

  			$this->db->where($where);
  		}

      $result = $query->get();
      return $result->result();
    }

    public function get_address($id) {
        $result = $this->db->select('
            pers_addr.*,
            tbl_subdistrict.area_name_th as locality,
            tbl_district.area_name_th as district,
            tbl_province.area_name_th as province,
            addr_alley as alley
        ')
            ->from('pers_addr')
            ->join('std_area as tbl_subdistrict','pers_addr.addr_sub_district=tbl_subdistrict.area_code','left')
            ->join('std_area as tbl_district','pers_addr.addr_district=tbl_district.area_code','left')
            ->join('std_area as tbl_province','pers_addr.addr_province=tbl_province.area_code','left')
            ->where('addr_id',$id)
            ->get();
        return $result->row_array();
    }

    public function get_villagePosition($id) {
        $query = $this->db->get_where('volt_info_village_position', array('volt_id'=> $id));
        return $query->result_array();
    }

  	private function replace_key(&$array, $keyOld, $keyNew) {
  		if (empty($array[$keyOld]))
  			return;
  		$array[$keyNew] = $array[$keyOld];
  		unset($array[$keyOld]);
  	}

}
