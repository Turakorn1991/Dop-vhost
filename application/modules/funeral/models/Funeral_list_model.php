<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Funeral_list_model extends CI_Model
{

	var $table = 'fnrl_info as A';
	//var $column_order = array('B.pid','C.prename_th','name','B.date_of_birth','A.date_of_req','A.date_of_visit','A.date_of_pay'); //set column field database for datatable orderable

	var $column_search = array(); //set column field database for datatable searchable

	// var $order = array('A.insert_datetime' => 'DESC', 'A.update_datetime', 'DESC'); // default order

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query($perm_view , $isCount=false)
	{
		//ถ้าแก้ไขตรงนี้ต้องไปแก้ไข Function Export ด้วยน่ะ  Report_model->getFnrlInfo
		$org_id = get_session('org_id');
		$user_id = get_session('user_id');

		if($isCount){
			$this->db->select("A.fnrl_id");
		}else{
			$this->db->select("A.fnrl_id
			,A.pers_id 
			,A.req_pers_id
			,A.date_of_req 
			,A.date_of_pay
			,A.cond_status
			,A.pay_amount
			,A.chn_code
			,A.insert_org_id
			,A.update_org_id
			,B.pid
			,B.gender_code
			,PRE.prename_th
			,CONCAT(B.pers_firstname_th, ' ', B.pers_lastname_th) as name
			,B.date_of_birth
			,B.date_of_death
			,CHA.chn_name
			,org.org_short_title
			,org.org_title
			");
		}
		
		$this->db->from("fnrl_info as A");
		$this->db->join('std_req_channel as CHA', 'A.chn_code = CHA.chn_code', 'left');
		$this->db->join('pers_info as B', 'A.pers_id = B.pers_id', 'left');
		$this->db->join('std_prename as PRE', 'B.pren_code = PRE.pren_code', 'left');
		$this->db->join('usrm_org as org', 'A.insert_org_id = org.org_id', 'left');

		if($perm_view == "Organization" || $perm_view == "All"){		
			$this->db->join('pers_addr as H', 'B.pre_addr_id = H.addr_id', 'left');	
		}

		//Where ตาม Filter
		$filter_org_id = "";
		$parameter_filter_str = $_POST['parameter_filter'];
		if(isset($parameter_filter_str)){
			$parameter = json_decode($parameter_filter_str, TRUE);

			//เลขประจำตัวประชาชน
			$disablepid = $parameter['disablepid'];
			if($disablepid == 1 || $disablepid == "1"){
				//กรณีไม่ระบุ เลขประจำตัวประชาชน (ผู้สูงอายุ)
				$this->db->where("(B.pid ='' OR B.pid IS NULL )");
			}else{
				if(isset($parameter['pid']) && $parameter['pid'] != ""){
					$this->db->like("B.pid", trim($parameter['pid']));	
				}
			}

			//ชื่อตัว-ชื่อสกุล
			if($parameter['fullname'] != ""){
				$fullname = trim($parameter['fullname']);
				$fullnameWhere = "(";
				$fullnameWhere = $fullnameWhere."B.pers_firstname_th like '%".$fullname."%'";
				$fullnameWhere = $fullnameWhere." OR B.pers_lastname_th like '%".$fullname."%'";
				$fullnameWhere = $fullnameWhere." OR CONCAT(B.pers_firstname_th, ' ', B.pers_lastname_th) like '%".$fullname."%'";
				$fullnameWhere = $fullnameWhere." OR CONCAT(B.pers_firstname_th, '-', B.pers_lastname_th) like '%".$fullname."%'";
				$fullnameWhere = $fullnameWhere." OR CONCAT(PRE.prename_th,B.pers_firstname_th, ' ', B.pers_lastname_th) like '%".$fullname."%'";
				$fullnameWhere = $fullnameWhere." OR CONCAT(PRE.prename_th,B.pers_firstname_th, '-', B.pers_lastname_th) like '%".$fullname."%'";
				$fullnameWhere = $fullnameWhere.")";
				$this->db->where($fullnameWhere);
			}

			//เพศ
			if($parameter['gender'] != ""){
				$gender = $parameter['gender'];
				if($gender == "0"){
					$this->db->where("(B.gender_code = 0)");
				}else if($gender == "1"){
					$this->db->where("(B.gender_code = 1)");
				}else if($gender == "2"){
					$this->db->where("(B.gender_code = 2)");
				}else if($gender == "ไม่ระบุ"){
					$this->db->where("(B.gender_code ='' OR B.gender_code IS NULL )");
				}
			}

			//วันที่ยื่นคำขอ
			$date_of_req_start_str = "";
			$date_of_req_end_str = "";
			if($parameter['reqdatestart'] != ""){
				list($req_start_str_day, $req_start_str_month, $req_start_str_year) = explode("/", $parameter['reqdatestart']);
				$date_of_req_start_str = ((int)$req_start_str_year - 543) . "-" . $req_start_str_month . "-" . $req_start_str_day;
			}
			if($parameter['reqdateend'] != ""){
				list($req_end_str_day, $req_end_str_month, $req_end_str_year) = explode("/", $parameter['reqdateend']);
				$date_of_req_end_str = ((int)$req_end_str_year - 543) . "-" . $req_end_str_month . "-" . $req_end_str_day;
			}

			if($date_of_req_start_str != "" && $date_of_req_end_str != ""){
				$this->db->where("(A.date_of_req >= '".$date_of_req_start_str ."' AND A.date_of_req <= '".$date_of_req_end_str."')");
			}else if($date_of_req_start_str == "" && $date_of_req_end_str != ""){
				$this->db->where("(A.date_of_req <= '".$date_of_req_end_str."')");
			}else if($date_of_req_start_str != "" && $date_of_req_end_str == ""){
				$this->db->where("(A.date_of_req >= '".$date_of_req_start_str ."')");
			}


			//สถานะดำเนินการ และ วันที่ได้รับการสงเคราะห์
			$date_of_pay_start_str = "";
			$date_of_pay_end_str = "";
			if($parameter['paydatestart'] != ""){
				list($pay_start_str_day, $pay_start_str_month, $pay_start_str_year) = explode("/", $parameter['paydatestart']);
				$date_of_pay_start_str = ((int)$pay_start_str_year - 543) . "-" . $pay_start_str_month . "-" . $pay_start_str_day;
			}
			if($parameter['paydateend'] != ""){
				list($pay_end_str_day, $pay_end_str_month, $pay_end_str_year) = explode("/", $parameter['paydateend']);
				$date_of_pay_end_str = ((int)$pay_end_str_year - 543) . "-" . $pay_end_str_month . "-" . $pay_end_str_day;
			}

			$is_where_date_of_pay = true;
			if($parameter['condstatus'] != ""){
				switch ($parameter['condstatus']) {
					case "1":
						$this->db->where("((A.cond_status IS NULL OR A.cond_status = '' ) AND (A.date_of_pay ='' OR A.date_of_pay IS NULL ))");
					  break;
					case "2":
						$this->db->where("(A.date_of_pay !='' OR A.date_of_pay IS NOT NULL )");
					  break;
					case "3":
						$is_where_date_of_pay = false;
						if($date_of_pay_start_str != "" && $date_of_pay_end_str != ""){
							$this->db->where("( ((A.cond_status IS NULL OR A.cond_status = '' ) AND (A.date_of_pay ='' OR A.date_of_pay IS NULL )) OR (A.date_of_pay >= '".$date_of_pay_start_str ."' AND A.date_of_pay <= '".$date_of_pay_end_str."'))");
						}else if($date_of_pay_start_str == "" && $date_of_pay_end_str != ""){
							$this->db->where("( ((A.cond_status IS NULL OR A.cond_status = '' ) AND (A.date_of_pay ='' OR A.date_of_pay IS NULL )) OR (A.date_of_pay <= '".$date_of_pay_end_str."'))");
						}else if($date_of_pay_start_str != "" && $date_of_pay_end_str == ""){
							$this->db->where("( ((A.cond_status IS NULL OR A.cond_status = '' ) AND (A.date_of_pay ='' OR A.date_of_pay IS NULL )) OR (A.date_of_pay >= '".$date_of_pay_start_str ."'))");
						}
					  break;
					case "4":
						$this->db->where("(A.cond_status = 'ปฎิเสธ')");
						break;
					default:
					  //code block
				  }
			}

			if($is_where_date_of_pay){
				if($date_of_pay_start_str != "" && $date_of_pay_end_str != ""){
					$this->db->where("(A.date_of_pay >= '".$date_of_pay_start_str ."' AND A.date_of_pay <= '".$date_of_pay_end_str."')");
				}else if($date_of_pay_start_str == "" && $date_of_pay_end_str != ""){
					$this->db->where("(A.date_of_pay <= '".$date_of_pay_end_str."')");
				}else if($date_of_pay_start_str != "" && $date_of_pay_end_str == ""){
					$this->db->where("(A.date_of_pay >= '".$date_of_pay_start_str ."')");
				}
			}

			//หน่วยงาน (ผู้บันทึกข้อมูล)
			$filter_org_id = $parameter['usrmorg'];
		}

		//หน่วยงาน (ผู้บันทึกข้อมูล):
		if($perm_view == "All"){
			if($filter_org_id != ""){
				if($filter_org_id == 174){ //โกลด์แอปพลิเคชั่น
					$this->db->where("A.insert_org_id=174");
				}else if($filter_org_id == 123){//กรุงเทพมหานคร
					$this->db->where("(
										A.insert_org_id = 123 
										OR 
										(A.insert_org_id in (select org_id from usrm_org where org_parent_id = 123))
									 	OR
										(A.insert_org_id = 174 AND A.update_org_id in (select org_id from usrm_org where org_parent_id = 123))
									   )");
				}else if($filter_org_id == 1 || $filter_org_id == 2){ //กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์ | สำนักงานปลัดกระทรวง
					$this->db->where("(
						(A.insert_org_id = 1 OR  A.insert_org_id = 2)
						OR 
						(A.insert_org_id in (select org_id from usrm_org where org_parent_id = 2))
						OR
						(A.insert_org_id = 174 AND A.update_org_id in (select org_id from usrm_org where org_parent_id = 2))
						OR
						(A.insert_org_id = 174 AND H.addr_province in (select province_code from usrm_org_province where org_parent_id = 2 and province_code is not null ))
					 )");
				}else{
					if (isset($org_id)) {
						$whereGoalApp = "";
						$provineCodeWhere = $this->admin_model->MapOrgIdToProvinceCode($filter_org_id);
						if ($provineCodeWhere != "" && $provineCodeWhere != null) {
							$whereGoalApp = " OR (A.insert_org_id = 174 AND H.addr_province = " . $provineCodeWhere . ")";
						}
					}
					$this->db->where("( (A.insert_org_id =" . $filter_org_id .") OR (A.insert_org_id = 174 AND A.update_org_id =".$filter_org_id.")". $whereGoalApp . ")");
				}
			}
		}
		else if ($perm_view == "Organization") {
			$whereGoalApp = "";
			if (isset($org_id)) {
				$provineCodeWhere = $this->admin_model->MapOrgIdToProvinceCode($org_id);
				if ($provineCodeWhere != "" && $provineCodeWhere != null) {
					$whereGoalApp = " OR (A.insert_org_id = 174 AND H.addr_province = " . $provineCodeWhere . ")";
				}
			}
			$this->db->where("( (A.insert_org_id =" . $org_id .") OR (A.insert_org_id = 174 AND A.update_org_id =".$org_id.")". $whereGoalApp . ")");
		} else if ($perm_view == "Person") {
			$this->db->where("A.insert_user_id=" . $user_id);
		}

		$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL)");
		$this->db->where("(B.delete_user_id IS NULL AND B.delete_datetime IS NULL)");
		$this->db->where("(A.date_of_req IS NOT NULL)");
		//เรียงลำดับ
		$order_by_clause = "
		CASE 
			WHEN A.date_of_pay IS NULL THEN 0 
			ELSE 1 
		END ASC, 
        CASE 
			WHEN A.date_of_pay IS NULL THEN A.insert_datetime 
			ELSE NULL 
		END DESC,
		CASE 
			WHEN A.date_of_pay IS NOT NULL THEN A.date_of_pay 
			ELSE NULL 
		END DESC,
	    CASE 
        	WHEN A.date_of_pay IS NOT NULL THEN A.update_datetime 
        	ELSE NULL 
    	END DESC
		";

	$this->db->order_by($order_by_clause, '', FALSE);
	}

	function get_datatables($perm_view)
	{
		$this->_get_datatables_query($perm_view);
		if ($_POST['length'] != -1) {
			$this->db->limit(50, $_POST['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($perm_view)
	{
		$this->_get_datatables_query($perm_view);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}
}
