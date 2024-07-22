<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welfare_list_model extends CI_Model {

	var $table = 'adm_info';
	var $column_order = array('B.pid','C.prename_th','name','B.date_of_birth','A.date_of_req'); //set column field database for datatable orderable
	var $order = array('A.insert_datetime' => 'DESC','A.update_datetime','DESC'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$whereGoalApp = " ";
		$org_id_current = get_session('org_id');
		if(isset($org_id_current)){
            $provineCodeWhere = $this->admin_model->MapOrgIdToProvinceCode($org_id_current);
			if($provineCodeWhere != "" && $provineCodeWhere != null){
                $whereGoalApp = " OR (AA.insert_org_id = 174 AND HH.addr_province = ".$provineCodeWhere." AND (AA.delete_user_id IS NULL AND AA.delete_datetime IS NULL)) ";
			}
		}
		$user_id = get_session('user_id');
		$app_id = 12;
		$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);


		$tableMain = "";
		$whereByRole = "";
		if($usrpm['perm_view']=='All'){
			$tableMain = "(select AA.* from adm_info as AA where (AA.delete_user_id IS NULL AND AA.delete_datetime IS NULL))";
		}
		else if($usrpm['perm_view']=='Organization')
		{
			$tableMain = "(select AA.* from adm_info as AA 
						  left join pers_info as BB on AA.pers_id = BB.pers_id
			              left join pers_addr as HH on BB.pre_addr_id = HH.addr_id
			              where (AA.delete_user_id IS NULL AND AA.delete_datetime IS NULL)
						  AND AA.insert_org_id = ".get_session('org_id').$whereGoalApp.")";
        }
		else if($usrpm['perm_view']=='Person'){
			$tableMain = "(select AA.* from adm_info as AA where (AA.delete_user_id IS NULL AND AA.delete_datetime IS NULL) AND AA.insert_user_id =".get_session('user_id')." )";
		}


		$this->db->select("A.*");
		$this->db->from($tableMain." as A");

		$this->db->join('pers_info as B', 'A.pers_id=B.pers_id', 'left');
        $this->db->join('std_prename as C', 'B.pren_code=C.pren_code', 'left');
		$this->db->join('std_gender as D', 'B.gender_code=D.gender_code', 'left');
		$this->db->join('std_nationality as E', 'B.nation_code=E.nation_code', 'left');
		// $this->db->join('std_religion as F', 'B.relg_code=F.relg_code', 'left');
		$this->db->join('std_edu_level as G', 'B.edu_code=G.edu_code', 'left');
		$this->db->join('adm_irp as H','A.pers_id=H.pers_id','left');
		$this->db->join('usrm_org as I','A.insert_org_id=I.org_id','left');
		// $this->db->join('pers_addr as AD', 'B.pre_addr_id=AD.addr_id', 'left');
		$this->db->group_by('B.pers_id');

		$this->db->where("(B.delete_user_id IS NULL AND B.delete_datetime IS NULL)");
		//  if($usrpm['perm_view']=='All'){//เห็นข้อมูลทั้งหมด
		// 	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
		// 	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL)");
        //  }else if($usrpm['perm_view']=='Organization'){//เห็นข้อมูลเฉพาะองค์กรของตนเองเท่านั้น
        //  	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        //  		(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_org_id=".get_session('org_id'));

        //  }else if($usrpm['perm_view']=='Person'){//เห็นข้อมูลเฉพาะของตนเองเท่านั้น
        //  	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        //  		(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_user_id=".get_session('user_id'));
        //  }

	    // dieArray($_POST['columns']);
			foreach ($_POST['columns'] as $colId => $col) {
			if($col['search']['value']!='') // if datatable send POST for search
			{

				$arr = @explode('_', $col['search']['value']);
				
					if(count($arr) >= 2){

					    $this->db->where("(".$col['name']." BETWEEN '".dateChange($arr[0],0)."' AND '".dateChange($arr[1],0)."')");
				
					}else if($col['search']['value']=='*'){
						
						$this->db->where($col['name'].' IS NOT NULL');
					}
					else if($col['name']=='D.gender_name'){
					
						  $this->db->where('D.gender_code',$col['search']['value']);
					}
					else if($col['name']=='A.insert_org_id'){
				
						$this->db->where('I.org_id',$col['search']['value']);
				  }
						else if($col['name'] == 'start_age' ){
							$year_age   = $col['search']['value'];
							//$yearStart = date("Y")-$yearbir[0];
							//$yearEnd   = date("Y")-$yearbir[1];
							//$this->db->where("YEAR(".$col['name'].") BETWEEN ".$yearStart." AND ".$yearEnd);
							$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) >= ".$year_age.")");
						}else if($col['name'] == 'end_age' ){
							$year_age   = $col['search']['value'];
							//$yearStart = date("Y")-$yearbir[0];
							//$yearEnd   = date("Y")-$yearbir[1];
							//$this->db->where("YEAR(".$col['name'].") BETWEEN ".$yearStart." AND ".$yearEnd);
							$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) <= ".$year_age.")");
					}else{
						$this->db->like($col['name'], $col['search']['value']);

					}
				// }
			}
		}

		// dieArray($this->db);

/*		if($_POST['search']['value']){
			foreach ($allow as $key => $val) {
				if(stristr($val,$_POST['search']['value']) == true){
					//$this->db->or_where("D_Allow",$key);
				}
			}
		}
*/
		// dieArray($this->db);
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1){
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		//$this->db->where("log_type =",'Import');// เพิ่ม where log_type = Import
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		//$this->db->where("log_type =",'Import');// เพิ่ม where log_type = Import
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		//$this->db->where("log_type =",'Import');// เพิ่ม where log_type = Import
		return $this->db->count_all_results();
	}

}
