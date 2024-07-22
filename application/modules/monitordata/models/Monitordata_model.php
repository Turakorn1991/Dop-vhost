<?php
	class monitordata_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

		#การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		public function _get_diff_query()
		{
			$sql = "SELECT
							diff_info.date_of_req,
							pers_info_req.pid AS req_pid,
							std_prename_req.prename_th AS req_prename_th,
							pers_info_req.pers_firstname_th AS req_pers_firstname_th,
							pers_info_req.pers_lastname_th AS req_pers_lastname_th,
							pers_info_req.gender_code AS req_gender_code,
							pers_info_req.date_of_birth AS req_date_of_birth,
							std_area_req.area_name_th AS req_older_addr_detail,
							pers_info.pid,
							std_prename.prename_th,
							pers_info.pers_firstname_th,
							pers_info.pers_lastname_th,
							pers_info.gender_code,
							pers_info.date_of_birth,
							diff_info.visit_place,
							std_area.area_name_th AS older_addr_detail,
							pers_info.pre_addr_id,
							diff_info.date_of_visit,
							diff_info.visit_place,
							diff_info.visit_place_identify,
							diff_info.date_of_pay,
							diff_info.pay_amount,
							diff_info.payee_type
							FROM
							diff_info
							LEFT JOIN pers_info AS pers_info
							ON diff_info.pers_id = pers_info.pers_id
							LEFT JOIN pers_addr
							ON pers_info.pre_addr_id = pers_addr.addr_id
							LEFT JOIN std_area
							ON pers_addr.addr_province = std_area.area_code
							LEFT JOIN std_prename
							ON pers_info.pren_code = std_prename.pren_code

							LEFT JOIN pers_info AS pers_info_req
							ON diff_info.req_pers_id = pers_info_req.pers_id
							LEFT JOIN pers_addr AS pers_addr_req
							ON pers_info_req.pre_addr_id = pers_addr_req.addr_id
							LEFT JOIN std_area AS std_area_req
							ON pers_addr_req.addr_province = std_area_req.area_code
							LEFT JOIN std_prename AS std_prename_req
							ON pers_info_req.pren_code = std_prename_req.pren_code

							WHERE
							pers_info.pid IS NOT NULL
							AND pers_info.pid != ''
							GROUP BY
							pers_info.pid
							ORDER BY
							pers_info.pid ASC
						";
			$row = $this->common_model->custom_query($sql);
			return $row;
		}

		public function get_pers_info_list(){
			$sql = "SELECT
							pers_info.pers_id,
							pers_info.pid,
							std_prename.prename_th,
							pers_info.pers_firstname_th,
							pers_info.pers_lastname_th,
							pers_info.gender_code,
							pers_info.date_of_birth,
							pers_info.pre_addr_id
							FROM
							pers_info
							JOIN std_prename
							ON pers_info.pren_code = std_prename.pren_code
							WHERE
							pers_info.pid IS NULL
							OR pers_info.pid = ''
							ORDER BY
							pers_info.pid ASC
							LIMIT 50000,10000
							";
			return $this->common_model->custom_query($sql);
		}

		public function get_individual_list($pid=''){
			$sql = "SELECT
							pers_info.pers_id,
							pers_info.pid,
							pers_info.pers_firstname_th,
							pers_info.pers_lastname_th,
							diff_info.pers_id AS diff_info_pers_id,
							fnrl_info.pers_id AS fnrl_info_pers_id,
							impv_home_info.pers_id AS impv_home_info_pers_id,
							impv_place_info.pers_id AS impv_place_info_pers_id,
							volt_info_elderly_care.pers_id AS volt_info_elderly_care_pers_id,
							wisd_info.pers_id AS wisd_info_pers_id,
							adm_info.pers_id AS adm_info_pers_id,
							edoe_older_emp_reg.pers_id AS edoe_older_emp_reg_pers_id
							FROM
							pers_info
							LEFT JOIN diff_info
							ON pers_info.pers_id = diff_info.pers_id
							LEFT JOIN fnrl_info
							ON pers_info.pers_id = fnrl_info.pers_id
							LEFT JOIN impv_home_info
							ON pers_info.pers_id = impv_home_info.pers_id
							LEFT JOIN impv_place_info
							ON pers_info.pers_id = impv_place_info.pers_id
							LEFT JOIN volt_info_elderly_care
							ON pers_info.pers_id = volt_info_elderly_care.pers_id
							LEFT JOIN wisd_info
							ON pers_info.pers_id = wisd_info.pers_id
							LEFT JOIN adm_info
							ON pers_info.pers_id = adm_info.pers_id
							LEFT JOIN edoe_older_emp_reg
							ON pers_info.pers_id = edoe_older_emp_reg.pers_id
							WHERE pers_info.pid='".$pid."'
							GROUP BY pers_info.pers_id ";
			return rowArray($this->common_model->custom_query($sql));
		}

		#ข้อมูลที่อยู่ 1
		public function getAddress1($addr_id=''){
				$sql = "SELECT * FROM pers_addr WHERE addr_id='".$addr_id."' ";
				$res = $this->common_model->custom_query($sql);
				$row = rowArray($res);
				$str_addr = '';
				if($row){
					$str_addr .= $row['addr_home_no'];
					if($row['addr_moo']){
						$str_addr .= ' ม.'.$row['addr_moo'];
					}
					if($row['addr_alley']){
						//$str_addr .= ' ต.'.$this->getStdAlley($row['addr_alley']);
					}
					if($row['addr_lane']){
						$str_addr .= ' ซ.'.$row['addr_lane'];
					}
					if($row['addr_sub_district']){
						$str_addr .= ' ต.'.$this->getStdArea($row['addr_sub_district']);
					}
				}
				return $str_addr;
		}

		#ข้อมูลที่อยู่ 2
		public function getAddress2($addr_id=''){
				$sql = "SELECT * FROM pers_addr WHERE addr_id='".$addr_id."' ";
				$res = $this->common_model->custom_query($sql);
				$row = rowArray($res);
				$str_addr = '';
				if($row){
					if($row['addr_sub_district']){
						$str_addr .= ' อ.'.$this->getStdArea($row['addr_district']);
					}
					if($row['addr_sub_district']){
						$str_addr .= ' จ.'.$this->getStdArea($row['addr_province']);
					}
					/*if($row['addr_zipcode']){
						$str_addr .= ' '.$row['addr_zipcode'];
					}*/
				}
				return $str_addr;
		}

		#ข้อมูลที่อยู่
		public function getStdArea($id=''){
				$sql = "SELECT area_name_th FROM std_area WHERE area_code='".$id."' ";
				$res = $this->common_model->custom_query($sql);
				$row = rowArray($res);
				return str_replace('*','',$row['area_name_th']);
		}

		#การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		private function _get_diff_datatables_query($count_field='', $case='')
		{
			$user_id = get_session('user_id');
			$app_id = 2;
			$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);
			if($count_field == ''){
					$this->db->select("diff_info.*,pers_info.*,std_prename.*,std_gender.*,CONCAT(pers_info.pers_firstname_th, ' ', pers_info.pers_lastname_th) as name");
			}else{
					$this->db->select($count_field);
			}
			$this->db->from("diff_info");
			$this->db->join('pers_info', 'diff_info.pers_id=pers_info.pers_id', 'left');
			$this->db->join('std_prename', 'pers_info.pren_code=std_prename.pren_code', 'left');
			$this->db->join('std_gender', 'pers_info.gender_code=std_gender.gender_code', 'left');
			$this->db->join('pers_addr', 'pers_info.pre_addr_id=pers_addr.addr_id', 'left');

			if($case == '1'){#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) เลขประจำตัวประชาชน
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_req_pers_idcard_null('diff_id','sql').")");
			}else if($case == '2'){#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) วันที่แจ้งเรื่อง
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_date_of_req_null('diff_id','sql').")");
			}else if($case == '3'){#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ช่องทางการแจ้งเรื่อง
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_chn_code_null('diff_id','sql').")");
			}else if($case == '4'){#ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) เลขประจำตัวประชาชน
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_pers_idcard_null('diff_id','sql').")");
			}else if($case == '5'){#วันที่ตรวจเยี่ยม
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_date_of_visit_null('diff_id','sql').")");
			}else if($case == '6'){#วันที่รับเงิน
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_date_of_pay_null('diff_id','sql').")");
			}else if($case == '7'){#จำนวนเงินที่สงเคราะห์ (บาท)
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_pay_amount_null('diff_id','sql').")");
			}else if($case == '8'){#ผู้รับเงิน
					$this->db->where(" diff_info.diff_id IN(".$this->get_diff_sum_payee_type_null('diff_id','sql').")");
			}else if($case == '9'){#

			}

			foreach ($_POST['columns'] as $colId => $col) {
				if($col['search']['value']!='') // if datatable send POST for search
				{
					$arr = @explode('_', $col['search']['value']);
						if(count($arr) >= 2){
								$this->db->where("(".$col['name']." BETWEEN '".dateChange($arr[0],0)."' AND '".dateChange($arr[1],0)."')");
						}else if($col['name']=='D.gender_code'){
							condinue;
						}else if($col['name']=='B.date_of_birth'){
							$yearbir   = explode(";", $col['search']['value']);
							$yearStart = date("Y")-$yearbir[0];
							$yearEnd   = date("Y")-$yearbir[1];
							$this->db->where("YEAR(".$col['name'].") BETWEEN ".$yearStart." AND ".$yearEnd);
						}else{
							$this->db->like($col['name'], $col['search']['value']);
						}
				}
			}

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

		function get_diff_datatables($case='')
		{
			$this->_get_diff_datatables_query('', $case);
			if($_POST['length'] != -1){
				$this->db->limit(50, $_POST['start']);
			}
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			return $query->result();
		}

		function count_diff_filtered($case)
		{
			$this->_get_diff_datatables_query("COUNT(diff_info.diff_id) AS count_row", $case);
			$query = $this->db->get();
			//echo $query;
			$row = rowArray($this->common_model->custom_query($this->db->last_query()));
			//echo $this->db->last_query(); die;
			return $row['count_row'];
		}

		public function count_diff_all()
		{
			$sql = "SELECT COUNT(pers_info.pers_id) AS count_row FROM pers_info ";
			$row = rowArray($this->common_model->custom_query($sql));
			return $row['count_row'];
		}

		#การสงเคราะห์ในการจัดการศพผู้สูงอายุตามประเพณี
		private function _get_funeral_datatables_query($count_field='', $case='')
		{
			if($count_field == ''){
					$this->db->select("fnrl_info.*");
			}else{
					$this->db->select($count_field);
			}
			$this->db->from('fnrl_info');
			$this->db->join('pers_info', 'fnrl_info.pers_id=pers_info.pers_id', 'left');

			if($case == '1'){#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) เลขประจำตัวประชาชน
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_req_pers_idcard_null('fnrl_id','sql').")");
			}else if($case == '2'){#ข้อมูลผู้ยืนคำขอ (ผู้ยื่นขอรับเงินสงเคราะห์ในการจัดงานศพผู้สูงอายุตามประเพณี) วันที่แจ้งเรื่อง
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_date_of_req_null('fnrl_id','sql').")");
			}else if($case == '3'){#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) เลขประจำตัวประชาชน
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_pers_idcard_null('fnrl_id','sql').")");
			}else if($case == '4'){#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) วันที่เสียชีวิต
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_date_of_death_null('fnrl_id','sql').")");
			}else if($case == '5'){#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) วันที่ออกใบมรณบัตร
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_date_of_death_certificate_null('fnrl_id','sql').")");
			}else if($case == '6'){#ข้อมูลการสงเคราะห์ วันที่รับเงิน
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_date_of_pay_null('fnrl_id','sql').")");
			}else if($case == '7'){#ข้อมูลผู้รับรอง (กรณีไม่ได้รับการสำรวจข้อมูล จปฐ. ในปีที่เสียชีวิต)เลขประจำตัวประชาชน
					//$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_pay_amount_null('fnrl_id','sql').")");
			}else if($case == '8'){#มูลผู้รับรอง (กรณีไม่ได้รับการสำรวจข้อมูล จปฐ. ในปีที่เสียชีวิต)วันที่รับรอง
					//$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_payee_type_null('fnrl_id','sql').")");
			}else if($case == '9'){#ข้อมูลการสงเคราะห์ จำนวนเงินที่สงเคราะห์ (บาท)
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_pay_amount_null('fnrl_id','sql').")");
			}else if($case == '10'){#ข้อมูลการสงเคราะห์ ผู้รับเงิน
					$this->db->where(" fnrl_info.fnrl_id IN(".$this->get_fnrl_sum_payee_type_null('fnrl_id','sql').")");
			}

			$user_id = get_session('user_id');
			$app_id = 20;
			$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);

			// dieArray($_POST);
			foreach ($_POST['columns'] as $colId => $col) {
				if($col['search']['value']) // if datatable send POST for search
				{
					$arr = @explode('/', $col['search']['value']);
					if(count($arr) > 2){
						$this->db->like($col['name'], dateChange($col['search']['value'],0));
					}else{
						$this->db->like($col['name'], $col['search']['value']);
					}
				}
			}

			if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}

		function get_funeral_datatables($case='')
		{
			$this->_get_funeral_datatables_query('', $case);
			if($_POST['length'] != -1){
				$this->db->limit(50, $_POST['start']);
			}
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			return $query->result();
		}

		function count_funeral_filtered($case)
		{
			$this->_get_funeral_datatables_query("COUNT(fnrl_info.fnrl_id) AS count_row", $case);
			$query = $this->db->get();
			//echo $query;
			$row = rowArray($this->common_model->custom_query($this->db->last_query()));
			//echo $this->db->last_query(); die;
			return $row['count_row'];
		}

		public function count_funeral_all()
		{
			$sql = "SELECT COUNT(pers_info.pers_id) AS count_row FROM pers_info ";
			$row = rowArray($this->common_model->custom_query($sql));
			return $row['count_row'];
		}

		#การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ ปรับปรุงบ้าน
		private function _get_impv_home_datatables_query($count_field='', $case='')
		{
			if($count_field == ''){
					$this->db->select("impv_home_info.*");
			}else{
					$this->db->select($count_field);
			}
			$this->db->from('impv_home_info');
			$this->db->join('pers_info', 'impv_home_info.pers_id=pers_info.pers_id', 'left');

			if($case == '1'){#ข้อมูลผู้สูงอายุ เลขประจำตัวประชาชน
					$this->db->where(" impv_home_info.imp_home_id IN(".$this->get_impv_home_sum_pers_idcard_null('imp_home_id','sql').")");
			}else if($case == '2'){#ข้อมูลผู้สูงอายุ วันที่สอบถาม
					$this->db->where(" impv_home_info.imp_home_id IN(".$this->get_impv_home_sum_date_of_svy_null('imp_home_id','sql').")");
			}else if($case == '3'){#ข้อมูลผู้ยินยอม เลขประจำตัวประชาชน
					$this->db->where(" impv_home_info.imp_home_id IN(".$this->get_impv_home_sum_cns_pers_null('imp_home_id','sql').")");
			}else if($case == '4'){#ผลการสงเคราะห์ วันที่ดำเนินการเสร็จสิ้น
					$this->db->where(" impv_home_info.imp_home_id IN(".$this->get_impv_home_sum_date_of_finish_null('imp_home_id','sql').")");
			}
			//echo $this->db->last_query(); die;
			$user_id = get_session('user_id');
			$app_id = 20;
			$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);

			// dieArray($_POST);
			foreach ($_POST['columns'] as $colId => $col) {
				if($col['search']['value']) // if datatable send POST for search
				{
					$arr = @explode('/', $col['search']['value']);
					if(count($arr) > 2){
						$this->db->like($col['name'], dateChange($col['search']['value'],0));
					}else{
						$this->db->like($col['name'], $col['search']['value']);
					}
				}
			}

			if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
			//echo $this->db->last_query(); die;
		}

		function get_impv_home_datatables($case='')
		{
			$this->_get_impv_home_datatables_query('', $case);
			if($_POST['length'] != -1){
				$this->db->limit(50, $_POST['start']);
			}
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			return $query->result();
		}

		function count_impv_home_filtered($case)
		{
			$this->_get_impv_home_datatables_query("COUNT(impv_home_info.imp_home_id) AS count_row", $case);
			$query = $this->db->get();
			//echo $query;
			$row = rowArray($this->common_model->custom_query($this->db->last_query()));
			//echo $this->db->last_query(); die;
			return $row['count_row'];
		}

		public function count_impv_home_all()
		{
			$sql = "SELECT COUNT(pers_info.pers_id) AS count_row FROM pers_info ";
			$row = rowArray($this->common_model->custom_query($sql));
			return $row['count_row'];
		}


		private function _get_impv_place_datatables_query($count_field='', $case='')
		{

			if($count_field == ''){
					$this->db->select("impv_place_info.*");
			}else{
					$this->db->select($count_field);
			}
			$this->db->from('impv_place_info');
			if($case == '1'){#ข้อมูลผู้สูงอายุ เลขประจำตัวประชาชน
					$this->db->where(" impv_place_info.impv_place_id IN(".$this->get_impv_place_sum_pers_idcard_null('impv_place_id','sql').")");
			}else if($case == '2'){#ข้อมูลผู้สูงอายุ วันที่สอบถาม
					$this->db->where(" impv_place_info.impv_place_id IN(".$this->get_impv_place_sum_date_of_svy_null('impv_place_id','sql').")");
			}else if($case == '3'){#ข้อมูลผู้ยินยอม เลขประจำตัวประชาชน
					$this->db->where(" impv_place_info.impv_place_id IN(".$this->get_impv_place_sum_cns_pers_null('impv_place_id','sql').")");
			}else if($case == '4'){#ผลการสงเคราะห์ วันที่ดำเนินการเสร็จสิ้น
					$this->db->where(" impv_place_info.impv_place_id IN(".$this->get_impv_place_sum_date_of_finish_null('impv_place_id','sql').")");
			}

			$user_id = get_session('user_id');
			$app_id = 36;
			$usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);

			foreach ($_POST['columns'] as $colId => $col) {
						if($col['search']['value']) // if datatable send POST for search
						{
								$arr = @explode('/', $col['search']['value']);
								if(count($arr) > 2){
									$this->db->like($col['name'], dateChange($col['search']['value'],0));
								}else{
									$this->db->like($col['name'], $col['search']['value']);
								}
						}
			}

			if(isset($this->order)){
						$order = $this->order;
						$this->db->order_by(key($order), $order[key($order)]);
			}
		}

		function get_impv_place_datatables($case='')
		{
			$this->_get_impv_place_datatables_query('', $case);
			if($_POST['length'] != -1){
				$this->db->limit(50, $_POST['start']);
			}
			$query = $this->db->get();
			return $query->result();
		}

		function count_impv_place_filtered($case)
		{
			$this->_get_impv_place_datatables_query("COUNT(impv_place_info.impv_place_id) AS count_row", $case);
			$query = $this->db->get();
			//echo $query;
			$row = rowArray($this->common_model->custom_query($this->db->last_query()));
			//echo $this->db->last_query(); die;
			return $row['count_row'];
		}

		public function count_impv_place_all()
		{
			$sql = "SELECT COUNT(pers_info.pers_id) AS count_row FROM pers_info ";
			$row = rowArray($this->common_model->custom_query($sql));
			return $row['count_row'];
		}
		#รวมทั้งหมด
		public function get_sum_personal()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id ";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ไม่มีเลขบัตรประจำตัวประชาชน
		public function get_sum_idcard_null()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								WHERE pers_info.pid IS NULL OR pers_info.pid = ''
								";
				return rowArray($this->common_model->custom_query($sql));
		}
		#
		public function get_sum_idcard_validate()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id ";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ไม่มีคำหน้าชื่อและไม่ถูกต้อง
		public function get_sum_prename_null()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers,
								std_prename.pren_code
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								LEFT JOIN std_prename
								ON pers_info.pren_code = std_prename.pren_code
								WHERE std_prename.pren_code IS NULL OR std_prename.pren_code = ''
								GROUP BY std_prename.pren_code
								";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ไม่มีชื่อหรือนามสกุล
		public function get_sum_name_null()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								WHERE pers_info.pers_firstname_th IS NULL OR pers_info.pers_firstname_th = ''
								OR pers_info.pers_lastname_th IS NULL OR pers_info.pers_lastname_th = ''
								";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ไม่มีเพศและไม่ถูกต้อง
		public function get_sum_gender_null()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								WHERE pers_info.gender_code NOT IN('1','2')
								";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ไม่มีวัน เดือน ปีเกิด
		public function get_sum_date_of_birth_null()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								WHERE TIMESTAMPDIFF(YEAR, pers_info.date_of_birth, CURDATE()) IS NULL
 								OR TIMESTAMPDIFF(YEAR, pers_info.date_of_birth, CURDATE()) = 0
								";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ไม่มีอยู่ตามทะเบียนบ้าน
		public function get_sum_reg_addr_null()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								WHERE pers_info.reg_addr_id IS NULL
 								OR pers_info.reg_addr_id = 0
								OR pers_info.reg_addr_id = ''
								";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ไม่มีที่อยู่ปัจจุบัน
		public function get_sum_pre_addr_null()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.pre_addr_id = pers_addr.addr_id
								WHERE pers_info.pre_addr_id IS NULL
								OR pers_info.pre_addr_id = 0
								OR pers_info.pre_addr_id = ''
								";
				return rowArray($this->common_model->custom_query($sql));
		}
		#เลขบัตรประจำตัวประชาชนซ้ำกัน
		public function get_sum_idcard_double()
		{
				$sql = "SELECT
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								WHERE (pers_info.pid IS NOT NULL AND pers_info.pid != '')
								GROUP BY pers_info.pid
								HAVING count_pers>1
								";
				$res = $this->common_model->custom_query($sql);
				$count_pers = 0;
				foreach ($res as $k=>$row) {
						$count_pers += $row['count_pers'];
				}
				return $count_pers;
		}
		#ชื่อ-นามสกุลซ้ำกันซ้ำกัน
		public function get_sum_name_double()
		{
				$sql = "SELECT
								CONCAT(pers_info.pers_firstname_th,pers_lastname_th) AS name,
								pers_info.pers_firstname_th,pers_lastname_th,
								COUNT(pers_info.pers_id) AS count_pers
								FROM
								pers_info
								LEFT JOIN pers_addr
								ON pers_info.reg_addr_id = pers_addr.addr_id
								WHERE (pers_info.pers_firstname_th IS NOT NULL AND pers_info.pers_firstname_th != '')
								GROUP BY CONCAT(pers_info.pers_firstname_th,pers_lastname_th)
								HAVING count_pers>1
								";
				$res = $this->common_model->custom_query($sql);
				$count_pers = 0;
				foreach ($res as $k=>$row) {
						$count_pers += $row['count_pers'];
				}
				return $count_pers;
		}
		#การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
		#รวมทั้งหมด
		public function get_diff_sum_personal()
		{
				$sql = "SELECT
								COUNT(diff_info.diff_id) AS count_pers
								FROM
								diff_info
								LEFT JOIN pers_info
								ON diff_info.pers_id = pers_info.pers_id ";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ไม่กรอกเลขประจำตัวประชาชน
		public function get_diff_sum_req_pers_idcard_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
				}else{
					$sql_field = "diff_info.diff_id";
				}

				$sql = "SELECT
								".$sql_field."
								FROM
								diff_info
								LEFT JOIN pers_info
								ON diff_info.req_pers_id = pers_info.pers_id
								WHERE
								pers_info.pid IS NULL OR pers_info.pid = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ไม่กรอกวันที่แจ้งเรื่อง
		public function get_diff_sum_date_of_req_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
				}else{
					$sql_field = "diff_info.diff_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								pers_info
								JOIN diff_info
								ON pers_info.pers_id = diff_info.pers_id
								WHERE diff_info.date_of_req IS NULL OR diff_info.date_of_req = ''
								OR diff_info.date_of_req = '0000-00-00'
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้ยื่นคำขอ (ผู้แจ้งเรื่อง) ไม่กรอกช่องทางการแจ้งเรื่อง
		public function get_diff_sum_chn_code_null($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
			}else{
				$sql_field = "diff_info.diff_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							pers_info
							JOIN diff_info
							ON pers_info.pers_id = diff_info.pers_id
							WHERE diff_info.chn_code IS NULL OR diff_info.chn_code = ''
							OR diff_info.chn_code = '000'
								";
			if($return_row == 'sql'){
					return $sql;
			}else{
					return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) ไม่กรอกเลขประจำตัวประชาชน
		public function get_diff_sum_pers_idcard_null($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
			}else{
				$sql_field = "diff_info.diff_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							diff_info
							LEFT JOIN pers_info
							ON diff_info.pers_id = pers_info.pers_id
							WHERE pers_info.pid IS NULL OR pers_info.pid = ''
							";
			if($return_row == 'sql'){
					return $sql;
			}else{
					return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ข้อมูลผู้สูงอายุ (ผู้ขอรับการสงเคราะห์) เลขบัตรประจำตัวประชาชนซ้ำกัน
		public function get_diff_sum_pers_idcard_double($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
			}else{
				$sql_field = "diff_info.diff_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							diff_info
							LEFT JOIN pers_info
							ON diff_info.pers_id = pers_info.pers_id
							LEFT JOIN
							(SELECT
									pers_info.pers_id,
									COUNT(pers_info.pers_id) AS count_pers
									FROM	pers_info
									LEFT JOIN pers_addr
									ON pers_info.reg_addr_id = pers_addr.addr_id
									WHERE (pers_info.pid IS NOT NULL AND pers_info.pid != '')
									GROUP BY pers_info.pid
									HAVING count_pers>1
								) AS count_pers
								ON count_pers.pers_id = pers_info.pers_id
							WHERE
							count_pers.pers_id IS NOT NULL
							";
			if($return_row == 'sql'){
					return $sql;
			}else{
					return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ไม่กรอกวันที่ตรวจเยี่ยม
		public function get_diff_sum_date_of_visit_null($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
			}else{
				$sql_field = "diff_info.diff_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							pers_info
							JOIN diff_info
							ON pers_info.pers_id = diff_info.pers_id
							WHERE diff_info.date_of_visit IS NULL OR diff_info.date_of_visit = ''
							OR diff_info.date_of_req = '0000-00-00'
							";
			if($return_row == 'sql'){
					return $sql;
			}else{
					return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ไม่กรอกวันที่รับเงิน
		public function get_diff_sum_date_of_pay_null($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
			}else{
				$sql_field = "diff_info.diff_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							pers_info
							JOIN diff_info
							ON pers_info.pers_id = diff_info.pers_id
							WHERE diff_info.date_of_pay IS NULL OR diff_info.date_of_pay = ''
							OR diff_info.date_of_pay = '0000-00-00'
							";
			if($return_row == 'sql'){
						return $sql;
			}else{
						return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ไม่กรอกจำนวนเงินที่สงเคราะห์ (บาท)
		public function get_diff_sum_pay_amount_null($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
			}else{
				$sql_field = "diff_info.diff_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							pers_info
							JOIN diff_info
							ON pers_info.pers_id = diff_info.pers_id
							WHERE diff_info.pay_amount IS NULL OR diff_info.pay_amount = ''
							OR diff_info.pay_amount < '0'
							";
			if($return_row == 'sql'){
						return $sql;
			}else{
						return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ไม่กรอกผู้รับเงิน
		public function get_diff_sum_payee_type_null($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(diff_info.diff_id) AS count_pers";
			}else{
				$sql_field = "diff_info.diff_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							pers_info
							JOIN diff_info
							ON pers_info.pers_id = diff_info.pers_id
							WHERE diff_info.payee_type IS NULL OR diff_info.payee_type = ''
							";
			if($return_row == 'sql'){
					return $sql;
			}else{
					return rowArray($this->common_model->custom_query($sql));
			}
		}
		#การสงเคราะห์ในการจัดงานศพผู้สูงอายุตามประเพณี
		#รวมทั้งหมด
		public function get_fnrl_sum_personal()
		{
				$sql = "SELECT
								COUNT(fnrl_info.fnrl_id) AS count_pers
								FROM
								pers_info
								JOIN fnrl_info
								ON pers_info.pers_id = fnrl_info.pers_id ";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ข้อมูลผู้ยืนคำขอ (ผู้ยื่นขอรับเงินสงเคราะห์ในการจัดงานศพผู้สูงอายุตามประเพณี) ไม่กรอกเลขประจำตัวประชาชน
		public function get_fnrl_sum_req_pers_idcard_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								fnrl_info
								LEFT JOIN pers_info
								ON fnrl_info.req_pers_id = pers_info.pers_id
								WHERE
								pers_info.pid IS NULL OR pers_info.pid = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้ยืนคำขอ (ผู้ยื่นขอรับเงินสงเคราะห์ในการจัดงานศพผู้สูงอายุตามประเพณี) ไม่กรอกวันที่แจ้งเรื่อง
		public function get_fnrl_sum_date_of_req_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								pers_info
								JOIN fnrl_info
								ON pers_info.pers_id = fnrl_info.pers_id
								WHERE fnrl_info.date_of_req IS NULL OR fnrl_info.date_of_req = ''
								OR fnrl_info.date_of_req = '0000-00-00'
								";
				if($return_row == 'sql'){
							return $sql;
				}else{
							return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) ไม่กรอกเลขประจำตัวประชาชน
		public function get_fnrl_sum_pers_idcard_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								fnrl_info
								LEFT JOIN pers_info
								ON fnrl_info.pers_id = pers_info.pers_id
								WHERE
								pers_info.pid IS NULL OR pers_info.pid = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) เลขบัตรประจำตัวประชาชนซ้ำกัน
		public function get_fnrl_sum_pers_idcard_double($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
			}else{
				$sql_field = "fnrl_info.fnrl_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							fnrl_info
							LEFT JOIN pers_info
							ON fnrl_info.pers_id = pers_info.pers_id
							LEFT JOIN
							(SELECT
									pers_info.pers_id,
									COUNT(pers_info.pers_id) AS count_pers
									FROM	pers_info
									LEFT JOIN pers_addr
									ON pers_info.reg_addr_id = pers_addr.addr_id
									WHERE (pers_info.pid IS NOT NULL AND pers_info.pid != '')
									GROUP BY pers_info.pid
									HAVING count_pers>1
								) AS count_pers
								ON count_pers.pers_id = pers_info.pers_id
							WHERE
							count_pers.pers_id IS NOT NULL
							";
			if($return_row == 'sql'){
					return $sql;
			}else{
					return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) ไม่กรอกวันที่เสียชีวิต
		public function get_fnrl_sum_date_of_death_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								fnrl_info
								LEFT JOIN pers_info
								ON fnrl_info.pers_id = pers_info.pers_id
								WHERE pers_info.date_of_death IS NULL OR pers_info.date_of_death = ''
								OR pers_info.date_of_death = '0000-00-00'
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้สูงอายุ (ผู้สูงอายุที่เสียชีวิต) ไม่กรอกวันที่ออกใบมรณบัตร
		public function get_fnrl_sum_date_of_death_certificate_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								fnrl_info
								LEFT JOIN pers_info
								ON fnrl_info.pers_id = pers_info.pers_id
								WHERE fnrl_info.date_of_death_certificate IS NULL OR fnrl_info.date_of_death_certificate = ''
								OR fnrl_info.date_of_death_certificate = '0000-00-00'
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลการสงเคราะห์ ไม่กรอกวันที่รับเงิน
		public function get_fnrl_sum_date_of_pay_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								fnrl_info
								LEFT JOIN pers_info
								ON fnrl_info.pers_id = pers_info.pers_id
								WHERE fnrl_info.date_of_pay IS NULL OR fnrl_info.date_of_pay = ''
								OR fnrl_info.date_of_pay = '0000-00-00'
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลการสงเคราะห์ ไม่กรอกจำนวนเงินที่สงเคราะห์ (บาท)
		public function get_fnrl_sum_pay_amount_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								fnrl_info
								LEFT JOIN pers_info
								ON fnrl_info.pers_id = pers_info.pers_id
								WHERE fnrl_info.pay_amount IS NULL OR fnrl_info.pay_amount = ''
								OR fnrl_info.pay_amount < '0'
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลการสงเคราะห์ ไม่กรอกผู้รับเงิน
		public function get_fnrl_sum_payee_type_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(fnrl_info.fnrl_id) AS count_pers";
				}else{
					$sql_field = "fnrl_info.fnrl_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								fnrl_info
								JOIN pers_info
								ON fnrl_info.pers_id = pers_info.pers_id
								WHERE fnrl_info.payee_type IS NULL OR fnrl_info.payee_type = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ ปรับปรุงบ้าน
		#รวมทั้งหมด
		public function get_impv_home_sum_personal($show_field='count', $return_row='')
		{
				$sql = "SELECT
								COUNT(impv_home_info.imp_home_id) AS count_pers
								FROM
								impv_home_info
								LEFT JOIN pers_info
								ON impv_home_info.pers_id = pers_info.pers_id ";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ข้อมูลผู้สูงอายุ เลขบัตรประจำตัวประชาชนซ้ำกัน
		public function get_impv_home_sum_pers_idcard_double($show_field='count', $return_row='')
		{
			if($show_field == 'count'){
				$sql_field = "COUNT(impv_home_info.imp_home_id) AS count_pers";
			}else{
				$sql_field = "impv_home_info.imp_home_id";
			}
			$sql = "SELECT
							".$sql_field."
							FROM
							impv_home_info
							LEFT JOIN pers_info
							ON impv_home_info.pers_id = pers_info.pers_id
							LEFT JOIN
							(SELECT
									pers_info.pers_id,
									COUNT(pers_info.pers_id) AS count_pers
									FROM	pers_info
									LEFT JOIN pers_addr
									ON pers_info.reg_addr_id = pers_addr.addr_id
									WHERE (pers_info.pid IS NOT NULL AND pers_info.pid != '')
									GROUP BY pers_info.pid
									HAVING count_pers>1
								) AS count_pers
								ON count_pers.pers_id = pers_info.pers_id
							WHERE
							count_pers.pers_id IS NOT NULL
							";
			if($return_row == 'sql'){
					return $sql;
			}else{
					return rowArray($this->common_model->custom_query($sql));
			}
		}
		#ข้อมูลผู้สูงอายุ ไม่กรอกเลขประจำตัวประชาชน
		public function get_impv_home_sum_pers_idcard_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_home_info.imp_home_id) AS count_pers";
				}else{
					$sql_field = "impv_home_info.imp_home_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_home_info
								LEFT JOIN pers_info
								ON impv_home_info.pers_id = pers_info.pers_id
								WHERE
								pers_info.pid IS NULL OR pers_info.pid = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้สูงอายุ ไม่กรอกวันที่สอบถาม
		public function get_impv_home_sum_date_of_svy_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_home_info.imp_home_id) AS count_pers";
				}else{
					$sql_field = "impv_home_info.imp_home_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_home_info
								LEFT JOIN pers_info
								ON impv_home_info.pers_id = pers_info.pers_id
								WHERE impv_home_info.date_of_svy IS NULL OR impv_home_info.date_of_svy = ''
								OR impv_home_info.date_of_svy = '0000-00-00'
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้ยินยอม ไม่กรอกเลขประจำตัวประชาชน
		public function get_impv_home_sum_cns_pers_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_home_info.imp_home_id) AS count_pers";
				}else{
					$sql_field = "impv_home_info.imp_home_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_home_info
								LEFT JOIN pers_info
								ON impv_home_info.cns_pers_id = pers_info.pers_id
								WHERE pers_info.pid IS NULL OR pers_info.pid = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ผลการสงเคราะห์ ไม่กรอกวันที่ดำเนินการเสร็จสิ้น
		public function get_impv_home_sum_date_of_finish_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_home_info.imp_home_id) AS count_pers";
				}else{
					$sql_field = "impv_home_info.imp_home_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_home_info
								LEFT JOIN pers_info
								ON impv_home_info.pers_id = pers_info.pers_id
								WHERE impv_home_info.date_of_finish IS NULL OR impv_home_info.date_of_finish = ''
								OR impv_home_info.date_of_finish = '0000-00-00'
								";
					if($return_row == 'sql'){
								return $sql;
					}else{
								return rowArray($this->common_model->custom_query($sql));
					}
		}
		#การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ สถานที่
		#รวมทั้งหมด
		public function get_impv_place_sum_personal($show_field='count', $return_row='')
		{
				$sql = "SELECT
								COUNT(impv_place_info.impv_place_id) AS count_pers
								FROM
								impv_place_info
								LEFT JOIN pers_info
								ON impv_place_info.pers_id = pers_info.pers_id ";
				return rowArray($this->common_model->custom_query($sql));
		}
		#ข้อมูลผู้สูงอายุ ไม่กรอกเลขประจำตัวประชาชน
		public function get_impv_place_sum_pers_idcard_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_place_info.impv_place_id) AS count_pers";
				}else{
					$sql_field = "impv_place_info.impv_place_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_place_info
								LEFT JOIN pers_info
								ON impv_place_info.pers_id = pers_info.pers_id
								WHERE
								pers_info.pid IS NULL OR pers_info.pid = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้สูงอายุ ไม่กรอกวันที่สอบถาม
		public function get_impv_place_sum_date_of_svy_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_place_info.impv_place_id) AS count_pers";
				}else{
					$sql_field = "impv_place_info.impv_place_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_place_info
								LEFT JOIN pers_info
								ON impv_place_info.pers_id = pers_info.pers_id
								WHERE impv_place_info.date_of_svy IS NULL OR impv_place_info.date_of_svy = ''
								OR impv_place_info.date_of_svy = '0000-00-00'
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ข้อมูลผู้ยินยอม ไม่กรอกเลขประจำตัวประชาชน
		public function get_impv_place_sum_cns_pers_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_place_info.impv_place_id) AS count_pers";
				}else{
					$sql_field = "impv_place_info.impv_place_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_place_info
								LEFT JOIN pers_info
								ON impv_place_info.cns_pers_id = pers_info.pers_id
								WHERE pers_info.pid IS NULL OR pers_info.pid = ''
								";
				if($return_row == 'sql'){
						return $sql;
				}else{
						return rowArray($this->common_model->custom_query($sql));
				}
		}
		#ผลการสงเคราะห์ ไม่กรอกวันที่ดำเนินการเสร็จสิ้น
		public function get_impv_place_sum_date_of_finish_null($show_field='count', $return_row='')
		{
				if($show_field == 'count'){
					$sql_field = "COUNT(impv_place_info.impv_place_id) AS count_pers";
				}else{
					$sql_field = "impv_place_info.impv_place_id";
				}
				$sql = "SELECT
								".$sql_field."
								FROM
								impv_place_info
								LEFT JOIN pers_info
								ON impv_place_info.pers_id = pers_info.pers_id
								WHERE impv_place_info.date_of_finish IS NULL OR impv_place_info.date_of_finish = ''
								OR impv_place_info.date_of_finish = '0000-00-00'
								";
					if($return_row == 'sql'){
								return $sql;
					}else{
								return rowArray($this->common_model->custom_query($sql));
					}
		}


}
?>
