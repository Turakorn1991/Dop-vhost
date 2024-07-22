<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: sanitkeawtawan
 * Date: 7/15/2017 AD
 * Time: 22:42
 */

class Report_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->model(array('member/admin_model','member/member_model','common_model','useful_model','webconfig/webinfo_model'));
    }
    function statThaiPopulation($m,$y){
        $colmale="";
        $colfemale="";
        for($i=1;$i<=100;$i++){
            $colmale.=",sum(male_{$i}) as male_{$i}";
            $colfemale.=",sum(female_{$i}) as female_{$i}";
        }
        $result =$this->db->select('area_name_th as province,sum(male_less1) as male_less1,sum(female_less1) as female_less1,sum(male_over100) as male_over100,sum(female_over100) as female_over100'.$colmale.$colfemale)
            ->from('stat_thai_population')
            ->join('std_area as tbl_province',"left(stat_thai_population.area_code,2)=left(tbl_province.area_code,2) and month_of_stat={$m} and  year_of_stat={$y}",'right',false)
            ->where('tbl_province.area_type','Province')
            ->group_by('province')
            ->order_by('province')
            ->get();

        if($result)
            return $result->result();
        return null;
    }
    function calDiff_no($data){
        $result =$this->db->select('*')
            ->from('diff_info')
            ->where('pers_id',$data->pers_id)
            ->where("year(date_of_req)=year('$data->date_of_req')")
            ->where('delete_user_id', null)
            ->order_by('date_of_req')
            ->get();

        foreach ($result->result() as $index=> $row){
            if($row->diff_id==$data->diff_id){
                return $index+1;
                exit();
            }
        }
        return 1;
    }

    function getOrg($id){
        $result =$this->db->select('*')
            ->from('usrm_org')
            ->where('org_id',$id)
            ->get();
        if($result)
            return $result->row();
        return null;
    }
    function getStaff($id){
        $result =$this->db->select('usrm_user.*,std_prename.prename_th as prename')
            ->from('usrm_user')
            ->join('std_prename','usrm_user.user_prename=std_prename.pren_code','left')//nation_code
            ->where('user_id',$id)
            ->get();
        if($result)
            return $result->row();
        return null;
    }
    function getPersInfo($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";
        $query =$this->db->select('*,std_prename.prename_th,nation_name_th as nation,relg_title as relg,std_edu_level.edu_title as edu')
            ->from('pers_info')
            ->join('std_prename','pers_info.pren_code=std_prename.pren_code','left')//nation_code
            ->join('std_nationality','std_nationality.nation_code=pers_info.nation_code','left')//nation_code
            ->join('std_religion','std_religion.relg_code=pers_info.nation_code','left')//relg_code;
            ->join('std_edu_level','pers_info.edu_code=std_edu_level.edu_code','left')//edu_code;
                ;
        if($id){
            $query->where_in('pers_id',$id);
        }
        $query->limit(100);
            $result=$query->get();
        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }
        return null;
    }
    function getAddr($id){
        $result =$this->db->select('pers_addr.*,tbl_subdistrict.area_name_th as locality,tbl_district.area_name_th as district,tbl_province.area_name_th as province,addr_alley as alley')
            ->from('pers_addr')
            ->join('std_area as tbl_subdistrict','pers_addr.addr_sub_district=tbl_subdistrict.area_code','left')
            ->join('std_area as tbl_district','pers_addr.addr_district=tbl_district.area_code','left')
            ->join('std_area as tbl_province','pers_addr.addr_province=tbl_province.area_code','left')

            ->where('addr_id',$id)
            ->get();
        if($result)
            return $result->row();
        return null;
    }
    function getFamily($id){
//        $result =$this->db->select('pers_info.*,std_prename.prename_th,pers_family.fml_relation,std_edu_level.edu_title')
//            ->from('pers_family')
//            ->join('pers_info','pers_info.pers_id=pers_family.ref_pers_id')
//            ->join('std_edu_level','pers_info.edu_code=std_edu_level.edu_code','left')//nation_code
//            ->join('std_prename','pers_info.pren_code=std_prename.pren_code','left')//nation_code
//            ->where('pers_family.pers_id',$id)
//            ->get();
        $result =$this->db->select('fml_pid as pid,std_prename.prename_th,pers_firstname_th,pers_lastname_th,fml_age as age, fml_relation,occupation,mth_avg_income,healthy,healthy_self_help,\'\' as edu_title')
            ->from('pers_family')
            ->join('std_prename','pers_family.pren_code=std_prename.pren_code','left')//nation_code
            ->where('pers_family.pers_id',$id)
            ->get();

        if($result)
            return $result->result();
        return null;
    }
    function getHelp($id){
        $result =$this->db->select('
                `std_help`.`help_code`,
                `std_help`.`help_title`,
                `diff_help`.diff_id,
                `diff_help`.`help_remark`')
            ->from('std_help')
            ->join('diff_help','`std_help`.`help_code` = `diff_help`.`help_code` and `diff_help`.`diff_id`='.$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getPerDisability($id){
        $result =$this->db->select('std_disability.dis_code as code,std_disability.dis_title as title,pers_disability.pers_id as id,pers_disability.dis_remark as remark')
            ->from('std_disability')
            ->join('pers_disability',"pers_disability.dis_code=std_disability.dis_code and pers_disability.pers_id='{$id}'",'left')
            ->order_by('std_disability.dis_code')
            ->get();
        if($result)
            return $result->result();
        return null;
    }

    function getHealth($code){
        $result =$this->db->select('pers_congenital_disease as disease')
            ->from('pers_health_record')
            ->where('pers_id',$code)
            ->get();
        if($result){
            $row=$result->row();
            if($row)
            return $row->disease;
        }

        return null;
    }
    function test($id){
        $result =$this->db->select('pers_health_record.pers_congenital_disease, pers_health_record.pers_drug_allergy')
            ->from('pers_health_record')
            ->where('pers_id',$id)
            ->get();
        if($result)
            return $result->row();
		
    }


    function getHelpGuide($id){
        $result =$this->db->select('
                `std_help_guide`.`help_guide_code`,
                `std_help_guide`.`help_guide_title`,
                `diff_help_guide`.diff_id,
                `diff_help_guide`.`help_guide_remark`')
            ->from('std_help_guide')
            ->join('diff_help_guide','`std_help_guide`.`help_guide_code` = `diff_help_guide`.`help_guide_code` and `diff_help_guide`.`diff_id`='.$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getTrouble($id){
        $result =$this->db->select('
                `std_trouble`.`trb_code`,
                `std_trouble`.`trb_title`,
                `diff_trouble`.diff_id,
                `diff_trouble`.`trb_remark`')
            ->from('std_trouble')
            ->join('diff_trouble','`std_trouble`.`trb_code` = `diff_trouble`.`trb_code` and `diff_trouble`.`diff_id`='.$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getDiff_Info($id){

        $id=($id)?(!is_array($id))?array($id):$id:"";
        $query =$this->db->select('*')
            ->from('diff_info');
        if($id){
            $query->where_in('diff_id',$id);
        }
       // $query->limit(100);
        $result= $query->get();
        if($result){
           if($result->num_rows()>1) {
               return $result->result();
           }
            return $result->row();
        }

        return null;
    }
    function getDiffInfo($filter){

        $user_id = get_session('user_id');
        $app_id = 2;
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);
        
        $selectStr = "A.diff_id,
            A.date_of_req,
            A.date_of_visit,
            A.date_of_pay,
            A.pay_amount,
            A.payee_type,
            A.pay_channel,
            A.insert_org_id,
            B.pid,B.pers_firstname_th,
            B.pers_lastname_th,B.bank_acc_no,
            B.tel_no,B.email_addr,C.prename_th,
            diff_trouble.trb_remark,
            GROUP_CONCAT(DISTINCT(std_trouble.trb_title)) as trb_title,
            diff_help.help_remark,
            CASE 
                WHEN GROUP_CONCAT(distinct(std_help.help_title)) LIKE '%มาตรา (8) (9) (10)%' 
                THEN 'พิจารณาเงินสงเคราะห์ตามประกาศกระทรวงพัฒนาสังคมและความมั่นคงของมนุษย์ ตามมาตรา (8) (9) (10)' 
                ELSE '' 
            END as help_title,
            diff_help_guide.help_guide_remark,
            std_help_guide.help_guide_title, 
            H.addr_home_no, H.addr_moo,
            H.addr_lane, 
            H.addr_road, 
            std_sub_district.area_name_th as addr_sub_district, 
            std_district.area_name_th as addr_district, 
            std_province.area_name_th as addr_province";
        $this->db->select($selectStr);
		$this->db->from("diff_info as A");

		$this->db->join('pers_info as B', 'A.pers_id=B.pers_id', 'left');
		$this->db->join('std_prename as C', 'B.pren_code=C.pren_code', 'left');
		$this->db->join('std_gender as D', 'B.gender_code=D.gender_code', 'left');
		$this->db->join('std_nationality as E', 'B.nation_code=E.nation_code', 'left');		
		$this->db->join('pers_addr as H', 'B.pre_addr_id=H.addr_id', 'left');
        $this->db->join('usrm_org as I','A.insert_org_id=I.org_id','left');
        $this->db->join('diff_trouble', 'A.diff_id=diff_trouble.diff_id', 'left');
        $this->db->join('std_trouble', 'diff_trouble.trb_code=std_trouble.trb_code', 'left');
        $this->db->join('diff_help', 'A.diff_id=diff_help.diff_id', 'left');
        $this->db->join('std_help', 'std_help.help_code=diff_help.help_code', 'left');
        $this->db->join('diff_help_guide', 'A.diff_id=diff_help_guide.diff_id', 'left');
        $this->db->join('std_help_guide', 'std_help_guide.help_guide_code=diff_help_guide.help_guide_code', 'left');
        $this->db->join('std_area as std_sub_district', 'std_sub_district.area_code = H.addr_sub_district', 'left');
        $this->db->join('std_area as std_district', 'std_district.area_code = H.addr_district', 'left');
        $this->db->join('std_area as std_province', 'std_province.area_code = H.addr_province', 'left');

        if($usrpm['perm_view']=='All'){//เห็นข้อมูลทั้งหมด
        	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL)");
         }else if($usrpm['perm_view']=='Organization'){//เห็นข้อมูลเฉพาะองค์กรของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_org_id=".get_session('org_id'));

         }else if($usrpm['perm_view']=='Person'){//เห็นข้อมูลเฉพาะของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_user_id=".get_session('user_id'));
         }

		foreach ($filter['columns'] as $colId => $col) {
			if($col['search']['value']!='') // if datatable send POST for search
			{
				$arr = @explode('_', $col['search']['value']);				
				if(count($arr) >= 2){
					    $this->db->where("(".$col['name']." BETWEEN '".dateChange($arr[0],0)."' AND '".dateChange($arr[1],0)."')");	
					}else if($col['name']=='D.gender_name'){						  
						  $this->db->where('D.gender_code',$col['search']['value']);
					}
					else if($col['name']=='A.insert_org_id'){						
						$this->db->where('I.org_id',$col['search']['value']);
				    }else if($col['name'] == 'start_age' ){
						$year_age   = $col['search']['value'];
						$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) >= ".$year_age.")");
					}else if($col['name'] == 'end_age' ){
						$year_age   = $col['search']['value'];
						$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) <= ".$year_age.")");
					}else{
						$this->db->like($col['name'], $col['search']['value']);
			    }
			}
        }
        
        $this->db->group_by('A.diff_id');

		if(isset($filter['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
        }
        $result= $this->db->get();
        if($result){
           if($result->num_rows()>1) {
               return $result->result();
           }
            return $result->row();
        }

        return null;
    }
    function getAdmIrpByPerson($id){
        $result =$this->db->select('*,usrm_org.org_title as org')
            ->from('adm_irp')
            ->join('usrm_org','adm_irp.irp_org_id=usrm_org.org_id','left')
            ->where('pers_id',$id)
            ->order_by('irp_id','desc')
            ->get();
        if($result)
            return $result->row();
    }
    function getAdmIrp($id){
        $result =$this->db->select('*,usrm_org.org_title as org')
            ->from('adm_irp')
          ->join('usrm_org','adm_irp.irp_org_id=usrm_org.org_id','left')
            ->where('irp_id',$id)
            ->get();
        if($result)
            return $result->row();
    }
    function getStdIrpAns($root=0,$irp_id=0){
        $data=array();
        $result =$this->db->select('*')
            ->from('std_irp')
            ->where('qstn_pid',$root)
            ->get();
       if($result){
           foreach ($result->result() as $row){
               $new=new stdClass();
               $new=$row;
               $new->child=$this->getStdIrpAns($new->qstn_id,$irp_id);
               if($new->qstn_type=="Answer"&&$irp_id>0){
                   $new->chk=$this->getIrpResult($irp_id,$new->qstn_id);
               }
               $data[]=$new;
           }
       }
       return $data;
    }
    function getIrpResult($irp_id,$ans_id){
        $result =$this->db->select('*')
            ->from('adm_irp_result')
            ->where('irp_id',$irp_id)
            ->where('ans_id',$ans_id)
            ->get();
        if($result){
            $row=$result->row();
            if($row){
                //return ($row->ans_points)?true:false;
                //return $row->ans_points;
                return ($row->ans_points)?true:true;
            }
        }
        return false;
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
		$ans_percent = ($countIrp['ans_points']/$countIrp['ans_full_score'])*100;
		if($ans_percent >= 60){
		//if($ans_percent < 25){
			$ans_rate = 'A';
		}else if($ans_percent >= 20 && $ans_percent < 60){
		//}else if($ans_percent < 60){
			$ans_rate = 'B';
		}else{
			$ans_rate = 'C';
		}
		$irp_result = array(
			'ans_rate'	=> $ans_rate,
			'ans_points' => $countIrp['ans_points'],
			'ans_full_score' => $countIrp['ans_full_score'],
			'ans_percent'	=> $ans_percent,
		);

		return $irp_result;
    }
    
    function getAdmInfo($filter){
        $user_id = get_session('user_id');
        $app_id = 12;
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);
        
        $selectStr = "A.date_of_req,A.date_of_adm,A.date_of_dis,A.insert_org_id,".
            "B.pid,B.pers_firstname_th,B.pers_lastname_th,B.date_of_birth,C.prename_th,".
            "E.irp_id,E.date_of_irp,";
        $this->db->select($selectStr);
		$this->db->from("adm_info as A");

		$this->db->join('pers_info as B', 'A.pers_id=B.pers_id', 'left');
		$this->db->join('std_prename as C', 'B.pren_code=C.pren_code', 'left');
        $this->db->join('std_gender as D', 'B.gender_code=D.gender_code', 'left');	
        $this->db->join('adm_irp as E', 'A.pers_id=E.pers_id', 'left');
        $this->db->join('usrm_org as I','A.insert_org_id=I.org_id','left');

        if($usrpm['perm_view']=='All'){//เห็นข้อมูลทั้งหมด
        	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL)");
         }else if($usrpm['perm_view']=='Organization'){//เห็นข้อมูลเฉพาะองค์กรของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_org_id=".get_session('org_id'));

         }else if($usrpm['perm_view']=='Person'){//เห็นข้อมูลเฉพาะของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_user_id=".get_session('user_id'));
         }

		foreach ($filter['columns'] as $colId => $col) {
			if($col['search']['value']!='') // if datatable send POST for search
			{
				$arr = @explode('_', $col['search']['value']);				
				if(count($arr) >= 2){
					    $this->db->where("(".$col['name']." BETWEEN '".dateChange($arr[0],0)."' AND '".dateChange($arr[1],0)."')");	
					}else if($col['name']=='D.gender_name'){						  
						  $this->db->where('D.gender_code',$col['search']['value']);
					}
					else if($col['name']=='A.insert_org_id'){						
						$this->db->where('I.org_id',$col['search']['value']);
				    }else if($col['name'] == 'start_age' ){
						$year_age   = $col['search']['value'];
						$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) >= ".$year_age.")");
					}else if($col['name'] == 'end_age' ){
						$year_age   = $col['search']['value'];
						$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) <= ".$year_age.")");
					}else{
						$this->db->like($col['name'], $col['search']['value']);
			    }
			}
		}

		if(isset($filter['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
        }
        $result= $this->db->get();
        if($result){
           if($result->num_rows()>1) {
               return $result->result();
           }
            return $result->row();
        }

        return null;
    }

    function getAdm_Info($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";
        $query =$this->db->select('adm_info.*,std_req_channel.chn_name')
            ->from('adm_info')
            ->join('std_req_channel','adm_info.chn_code=std_req_channel.chn_code','left');
        if($id){
            $query->where_in('adm_id',$id);
        }
        $query->limit(100);
       $result=    $query->get();
        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }
        return null;
    }
    function getCaseReasonName($code,$type='การรับเข้า'){
        $result =$this->db->select('case_reason_name as name')
            ->from('std_case_reason')
            ->where('case_reason_code',$code)
            ->where('case_reason_type',$type)
            ->get();
        if($result){
            $row=$result->row();
            if($row)
             return$row->name;
        }

        return null;
    }
    function getDisCaseReasonName($code,$type='การจำหน่าย'){
        $result =$this->db->select('case_reason_name as name')
            ->from('std_case_reason')
            ->where('case_reason_code',$code)
            ->where('case_reason_type',$type)
            ->get();
        if($result){
            $row=$result->row();
            if($row)
             return$row->name;
        }

        return null;
    }

    function getDeathCause($code){
        $result =$this->db->select('cause_of_death as cause')
            ->from('std_cause_of_death')
            ->where('cause_code',$code)
            ->get();
        if($result){
            $row=$result->row();
            if($row)
             return$row->cause;
        }

        return null;
    }
    function getFnrlInfo($filter){

		$user_id = get_session('user_id');
        $app_id = 21;
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);
        
        $selectStr = "A.req_pers_id,
        A.date_of_req,
        A.date_of_pay,
        A.req_pers_aprv_pers_id,
        A.req_pers_aprv_org,
        A.pay_amount,
        A.payee_type,
        A.pay_channel,
        A.insert_org_id,
        B.pid,
        B.pers_firstname_th,
        B.pers_lastname_th,
        C.prename_th,
        H.addr_home_no, 
        H.addr_moo,
        H.addr_lane, 
        H.addr_road, 
        std_sub_district.area_name_th as addr_sub_district, 
        std_district.area_name_th as addr_district, 
        std_province.area_name_th as addr_province";
        $this->db->select($selectStr);
		$this->db->from("fnrl_info as A");

		$this->db->join('pers_info as B', 'A.pers_id=B.pers_id', 'left');
		$this->db->join('std_prename as C', 'B.pren_code=C.pren_code', 'left');
		$this->db->join('std_gender as D', 'B.gender_code=D.gender_code', 'left');
		$this->db->join('pers_addr as H', 'B.pre_addr_id=H.addr_id', 'left');
        $this->db->join('usrm_org as I','A.insert_org_id=I.org_id','left');
        $this->db->join('std_area as std_sub_district', 'std_sub_district.area_code = H.addr_sub_district', 'left');
        $this->db->join('std_area as std_district', 'std_district.area_code = H.addr_district', 'left');
        $this->db->join('std_area as std_province', 'std_province.area_code = H.addr_province', 'left');

        if($usrpm['perm_view']=='All'){//เห็นข้อมูลทั้งหมด
        	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL)");
         }else if($usrpm['perm_view']=='Organization'){//เห็นข้อมูลเฉพาะองค์กรของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_org_id=".get_session('org_id'));

         }else if($usrpm['perm_view']=='Person'){//เห็นข้อมูลเฉพาะของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_user_id=".get_session('user_id'));
         }

         foreach ($_POST['columns'] as $colId => $col) {
			if($col['search']['value']) // if datatable send POST for search
			{
				if($col['name']=='D.gender_code'){
					$this->db->where('B.gender_code',$col['search']['value']);
				}
				else if($col['name']=='I.org_title'){
					$this->db->where('A.insert_org_id',$col['search']['value']);
				}
                
				else if($col['name'] == 'start_age' ){
					$year_age   = $col['search']['value'];
					$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) >= ".$year_age.")");
				}
				else if($col['name'] == 'end_age' ){
					$year_age   = $col['search']['value'];
					$this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) <= ".$year_age.")");
				}
				else if($col['name'] == 'A.date_of_pay' ){
				
					list($start,$end)   				= explode("_",$col['search']['value']);
					list($str_day,$str_month,$str_year) = explode("/",$start);
					list($en_day,$en_month,$en_year) 	= explode("/",$end);
					$start_year 						= ((int)$str_year-543)."/".$str_month."/".$str_day;
					$end_year							= ((int)$en_year-543)."/".$en_month."/".$en_day;
					$this->db->where("(A.date_of_pay BETWEEN '".$start_year."' AND '".$end_year."')");
				}
				else if($col['name'] == 'A.date_of_req' ){
				
					list($start,$end)   				= explode("_",$col['search']['value']);
					list($str_day,$str_month,$str_year) = explode("/",$start);
					list($en_day,$en_month,$en_year) 	= explode("/",$end);
					$start_year 						= ((int)$str_year-543)."/".$str_month."/".$str_day;
					$end_year							= ((int)$en_year-543)."/".$en_month."/".$en_day;
					$this->db->where("(A.date_of_req BETWEEN '".$start_year."' AND '".$end_year."')");
				}
		
				else{
					$this->db->like($col['name'], $col['search']['value']);
				}
			}
		}

		if(isset($filter['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
        }
        $result= $this->db->get();
        if($result){
           if($result->num_rows()>1) {
               return $result->result();
           }
            return $result->row();
        }

        return null;
    }

    function getFnrl_Info($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";
        $query =$this->db->select('fnrl_info.*,std_req_channel.chn_name')
            ->from('fnrl_info')
            ->join('std_req_channel','fnrl_info.chn_code=std_req_channel.chn_code','left');
        if($id){
            $query->where_in('fnrl_id',$id);
        }
        //$query->limit(100);
        $result= $query->get();

        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }

        return null;
    }
    function getImpvPlace_Info($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";

        $query =$this->db->select('*')
            ->from('impv_home_info');
        if($id){
            $query->where_in('imp_home_id',$id);
        }
        //$query->limit(100);
            $result=$query->get();
        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }
        return null;
    }

    function getImpvHomeInfo($filter){
        $user_id = get_session('user_id');
        $app_id = 29;
        $usrpm = $this->admin_model->chkOnce_usrmPermiss($app_id,$user_id);
        
        $selectStr = "A.imp_home_id,
        A.case_budget,
        A.date_of_finish,
        A.mgt_budget,
        A.insert_org_id,
        B.pid,
        B.pers_firstname_th,
        B.pers_lastname_th,
        B.bank_acc_no,
        B.email_addr,
        B.tel_no,
        C.prename_th,
        H.addr_home_no, 
        H.addr_moo,
        H.addr_lane, 
        H.addr_road, 
        std_sub_district.area_name_th as addr_sub_district, 
        std_district.area_name_th as addr_district,
        std_province.area_name_th as addr_province";
        $this->db->select($selectStr);
		$this->db->from("impv_home_info as A");

		$this->db->join('pers_info as B', 'A.pers_id=B.pers_id', 'left');
        $this->db->join('std_prename as C', 'B.pren_code=C.pren_code', 'left');
        $this->db->join('std_gender as D', 'B.gender_code=D.gender_code', 'left');
		$this->db->join('pers_addr as H', 'B.pre_addr_id=H.addr_id', 'left');
        $this->db->join('std_area as std_sub_district', 'std_sub_district.area_code = H.addr_sub_district', 'left');
        $this->db->join('std_area as std_district', 'std_district.area_code = H.addr_district', 'left');
        $this->db->join('std_area as std_province', 'std_province.area_code = H.addr_province', 'left');
        $this->db->join('usrm_org as I','A.insert_org_id=I.org_id','left');


        if($usrpm['perm_view']=='All'){//เห็นข้อมูลทั้งหมด
        	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL)");
         }else if($usrpm['perm_view']=='Organization'){//เห็นข้อมูลเฉพาะองค์กรของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_org_id=".get_session('org_id'));

         }else if($usrpm['perm_view']=='Person'){//เห็นข้อมูลเฉพาะของตนเองเท่านั้น
         	$this->db->where("(A.delete_user_id IS NULL AND A.delete_datetime IS NULL) AND
        	(B.delete_user_id IS NULL AND B.delete_datetime IS NULL) AND A.insert_user_id=".get_session('user_id'));
         }

		foreach ($filter['columns'] as $colId => $col) {
			if($col['search']['value']!='') // if datatable send POST for search
			{
                $arr = @explode('_', $col['search']['value']);		
                if(count($arr) >= 2){
                    $this->db->where("(".$col['name']." BETWEEN '".dateChange($arr[0],0)."' AND '".dateChange($arr[1],0)."')");	
                }
                else if($col['name']=='D.gender_name'){
                            $this->db->where('D.gender_code',$col['search']['value']);
                }
                else if($col['name'] == 'start_age' ){
                    $year_age   = $col['search']['value'];
                    $this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) >= ".$year_age.")");
                }
                else if($col['name'] == 'end_age' ){
                    $year_age   = $col['search']['value'];
                    $this->db->where("(IF(TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE()) IS NULL,0,TIMESTAMPDIFF(YEAR, B.date_of_birth, CURDATE())) <= ".$year_age.")");
                }
                else if($col['name']=='I.org_title'){
                    $this->db->where('A.insert_org_id',$col['search']['value']);
                }
              else{
                  $this->db->like($col['name'], $col['search']['value']);
              }
			}
		}

		if(isset($filter['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
        }
        $result= $this->db->get();
        if($result){
           if($result->num_rows()>1) {
               return $result->result();
           }
            return $result->row();
        }

        return null;
    }
    function getImpvHomeCondition($id){
        $result =$this->db->select('
                `std_home_condition`.`hcond_code` as code ,
                `std_home_condition`.`hcond_title` as title,
                `impv_home_condition`.impv_home_id as id,
                `impv_home_condition`.`hcond_remark` as remark')
            ->from('std_home_condition')
            ->join('impv_home_condition','`std_home_condition`.`hcond_code` = `impv_home_condition`.`hcond_code` and `impv_home_condition`.`impv_home_id`='.$id,'left')
            ->get();

        return $result->result();
    }
    function getImpvPlaceInfo($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";
        $query =$this->db->select('impv_place_info.*,std_place_type.ptype_title')
            ->from('impv_place_info')
            ->join('std_place_type','impv_place_info.ptype_code=std_place_type.ptype_code','left');
        if($id){
            $query->where_in('impv_place_id',$id);
        }
        $query->limit(100);
        $result=$query->get();
        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }
        return null;
    }
    function placetype(){
        $result =$this->db->select('*')
            ->from('std_place_type')
            ->get();
            return $result->result();

    }
    function getImpvPlaceCondition($id){
        $result =$this->db->select('
                `std_place_condition`.`pcond_code` as code ,
                `std_place_condition`.`pcond_title` as title,
                `impv_place_condition`.impv_place_id as id,
                `impv_place_condition`.`pcond_remark` as remark')
            ->from('std_place_condition')
            ->join('impv_place_condition','`std_place_condition`.`pcond_code` = `impv_place_condition`.`pcond_code` and `impv_place_condition`.`impv_place_id`='.$id,'left')
            ->get();

        return $result->result();
    }
    function getMember($id){
        $result =$this->db->select('pers_info.*,std_prename.prename_th,std_edu_level.edu_title')
            ->from('impv_place_member')
            ->join('pers_info','pers_info.pers_id=impv_place_member.mbr_pers_id')
            ->join('std_edu_level','pers_info.edu_code=std_edu_level.edu_code','left')//nation_code
            ->join('std_prename','pers_info.pren_code=std_prename.pren_code','left')//nation_code
            ->where('impv_place_member.impv_place_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getEducation($id){
        $result =$this->db->select('std_edu_level.edu_code as code,edu_title as title,pers_info.pers_id as id')
            ->from('std_edu_level')
            ->join('pers_info',"pers_info.edu_code=std_edu_level.edu_code and pers_info.edu_code='{$id}'",'left')
            ->order_by('std_edu_level.edu_code')
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getWisdInfo($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";
        $query =$this->db->select('*')
            ->from('wisd_info');
            if($id){
               $query->where_in('knwl_id',$id);
            }
        $query->limit(100);
            $result=$query->get();
        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }
    }
    function getLastWisdBranch($id){
        $result =$this->db->select('wisd_branch.* ,std_wisdom.wis_name')
            ->from('std_wisdom')
            ->join('wisd_branch',"wisd_branch.wisd_code=std_wisdom.wis_code and wisd_branch.knwl_id='{$id}'")
            ->order_by('wisd_branch.insert_datetime','asc')
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getWisdBranch($id){
        $result =$this->db->select('wisd_branch.branch_id as id , std_wisdom.wis_code as code ,std_wisdom.wis_name as title, wisd_branch.wisd_sp_title as desc')
            ->from('std_wisdom')
            ->join('wisd_branch',"wisd_branch.wisd_code=std_wisdom.wis_code and wisd_branch.knwl_id='{$id}'",'left')
            ->order_by('std_wisdom.wis_code')
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getVoltInfo($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";
        $query =$this->db->select('*')
            ->from('volt_info');
            if($id){
                $query->where_in('volt_id',$id);
            }
        $query->limit(100);
           $result= $query->get();
        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }
        return null;
    }
    function getElderlyCare($id){
        $result =$this->db->select('pers_info.*,std_prename.prename_th,volt_info_elderly_care.care_freq,volt_info_elderly_care.care_freq_per')
            ->from('volt_info_elderly_care')
            ->join('pers_info','pers_info.pers_id=volt_info_elderly_care.pers_id')
            ->join('std_prename','pers_info.pren_code=std_prename.pren_code','left')//nation_code
            ->where('volt_info_elderly_care.volt_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getVillagePosition($id){
        $result =$this->db->select('std_village_position.vpos_code as code, vpos_title as title,volt_id as id,vpos_identify as remark')
            ->from('std_village_position')
            ->join('volt_info_village_position','std_village_position.vpos_code=volt_info_village_position.vpos_code and volt_id='.$id,'left')
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getStudent($id){
        $result =$this->db->select('schl_info_student.pers_id,schl_info_generation.gen_code ,schl_info_generation.year_of_study ,schl_info.schl_name')
            ->from('schl_info_student')
            ->join('schl_info_generation','schl_info_student.gen_id=schl_info_generation.gen_id and schl_info_student.schl_id=schl_info_generation.schl_id')
            ->join('schl_info','schl_info_student.schl_id=schl_info.schl_id')
            ->where('stu_id',$id)
            ->get();

        return $result->row();
    }
    function getHisDiffinfo($id){
        $result =$this->db->select('diff_info.*')
            ->from('diff_info')
            ->where('pers_id',$id)
            ->where('delete_user_id' , NULL )
            ->where('delete_org_id' , NULL )
            ->where('delete_datetime' , NULL )
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getHisvoltCount($id){
        $result =$this->db->select('count(care_id) as num')
            ->from('volt_info_elderly_care')
            ->where('volt_id',$id)
            ->get();
        if($result){
            $row=$result->row();
            return $row->num;
        }

        return null;
    }
    function getHisvoltInfo($id){
        $result =$this->db->select('volt_info.*')
            ->from('volt_info')
            ->where('pers_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getJobVacancy($id){
        $result =$this->db->select('*,std_position_type.posi_type_title,std_position_type.posi_grp,std_edu_level.edu_title,std_expert.exp_name,tbl_subdistrict.area_name_th as locality,tbl_district.area_name_th as district,tbl_province.area_name_th as province')
            ->from('edoe_job_vacancy')
            ->join('std_position_type','std_position_type.posi_type_code=edoe_job_vacancy.posi_cate_code','left')
            ->join('std_edu_level','std_edu_level.edu_code=edoe_job_vacancy.edu_code','left')
            ->join('std_expert','std_expert.exp_code=edoe_job_vacancy.posi_expert_code','left')
            ->join('std_area as tbl_subdistrict','edoe_job_vacancy.addr_sub_district=tbl_subdistrict.area_code','left')
            ->join('std_area as tbl_district','edoe_job_vacancy.addr_district=tbl_district.area_code','left')
            ->join('std_area as tbl_province','edoe_job_vacancy.addr_province=tbl_province.area_code','left')

            ->where_in('posi_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getJobInfo($id){
        $result =$this->db->select('edoe_older_emp_reg.*,exp_name')
            ->from('edoe_older_emp_reg')
            ->join('std_expert','std_expert.exp_code=edoe_older_emp_reg.exp_code')
            ->where_in('ereg_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getHisJobInfo($id){
        $result =$this->db->select('edoe_older_emp_reg.*,exp_name')
            ->from('edoe_older_emp_reg')
            ->join('std_expert','std_expert.exp_code=edoe_older_emp_reg.exp_code')
            ->where('pers_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getSchModel($id){
        $result =$this->db->select('*,std_model_school.mdl_grp')
            ->from('schl_model')
            ->join('std_model_school','schl_model.mdl_code=std_model_school.mdl_code','left')
            ->where('schl_id',$id)
            ->get();
        if($result)
            return $result->row();
        return null;
    }
    function getSchInfoGeneration($id){
        $result =$this->db->select('*')
            ->from('schl_info_generation')->where('schl_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getSchInfoStu($id){
        $result =$this->db->select('*')
            ->from('schl_info_student')->where('schl_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getSchContacts($id){
        $result =$this->db->select('*')
            ->from('schl_info_contacts')->where('sch_cnt_id',$id)
            ->get();
        if($result)
            return $result->row();
        return null;
    }
    function getSchInfoContacts($id){
        $result =$this->db->select('*')
            ->from('schl_info_contacts')->where('sch_id',$id)
            ->get();
        if($result)
            return $result->row();
        return null;
    }
    function getSchInfo($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";

        $query =$this->db->select('*,tbl_subdistrict.area_name_th as locality,tbl_district.area_name_th as district,tbl_province.area_name_th as province,addr_alley as alley')
            ->from('schl_info')

            ->join('std_area as tbl_subdistrict','schl_info.addr_sub_district=tbl_subdistrict.area_code','left')
            ->join('std_area as tbl_district','schl_info.addr_district=tbl_district.area_code','left')
            ->join('std_area as tbl_province','schl_info.addr_province=tbl_province.area_code','left');
        if($id){
            $query->where_in('schl_info.schl_id',$id);

        }
        $query->limit(100);
        $result=$query->get();
        if($result)
            return $result->result();
        return null;
    }
    function getHisSchInfo($id){
        $result =$this->db->select('schl_info.schl_name,schl_info_generation.gen_code,year(schl_info_generation.date_of_start) as year_of_study')
            ->from('schl_info_student')
            ->join('schl_info','schl_info.schl_id=schl_info_student.schl_id')
            ->join('schl_info_generation','schl_info_generation.gen_id=schl_info_student.gen_id and schl_info_student.schl_id=schl_info_generation.schl_id')
            ->where('schl_info_student.pers_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getHisTrnInfo($id){
        $result =$this->db->select('prep_trn_info.*')
            ->from('prep_trn_trainee')
            ->join('prep_trn_info','prep_trn_info.trn_id=prep_trn_trainee.trn_id')
            ->where('prep_trn_trainee.pers_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getHisWisdInfo($id){
        $result =$this->db->select('wisd_info.*,wisd_branch.wisd_sp_title,wis_name')
            ->from('wisd_info')
            ->join('wisd_branch','wisd_branch.knwl_id=wisd_info.knwl_id','left')
            ->join('std_wisdom','wisd_branch.wisd_code=std_wisdom.wis_code','left')
            ->where('pers_id',$id)
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getHisMpvHome($id){
        $result =$this->db->select('*')
            ->from('impv_home_info')
            ->where('pers_id',$id)
            ->where('delete_user_id' , NULL )
            ->where('delete_org_id' , NULL )
            ->where('delete_datetime' , NULL )
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getHisFnrlInfo($id){
        $result =$this->db->select('*')
            ->from('fnrl_info')
            ->where('pers_id',$id)
            ->where('delete_user_id' , NULL )
            ->where('delete_org_id' , NULL )
            ->where('delete_datetime' , NULL )
            ->get();
        if($result)
            return $result->result();
        return null;
    }

   
    function getHisAdmInfo($id){
        $result =$this->db->select('adm_info.*')
            ->from('adm_info')
            ->where('pers_id',$id)
            ->where('delete_user_id' , NULL )
            ->where('delete_org_id' , NULL )
            ->where('delete_datetime' , NULL )
            ->get();
        if($result)
            return $result->result();
        return null;
    }
    function getCountRtm($id){
        $result =$this->db->select('*')
            ->from('adm_trm_result')
            ->where('irp_id',$id)
            ->get();
        if($result)
            return $result->num_rows();
        return null;
    }
    function getLastIrp($id){
        $result =$this->db->select('*')
            ->from('adm_irp')
            ->where('pers_id',$id)
            ->order_by('date_of_irp','desc')
            ->get();
        if($result)
            return $result->row();
        return null;
    }
    function getIrpScore($irp_id){
        $result =$this->db->select('sum(ans_points) as score,sum(ans_full_score) as fullscore')
            ->from('adm_irp_result')
            ->where('irp_id',$irp_id)
            ->get();
        $score=0;
        $fullscore=0;
        $percent=0;
        $group='';
        if($result){
            foreach ($result->result() as $row ){
                $score+=$row->score;
                $fullscore+=$row->fullscore;
            }
            $percent=($fullscore)?round((($score*100)/$fullscore),2):0;
            if($percent>=66.66){
                $group="A";
            }elseif($percent>=33.33){
                $group="B";
            }else{
                $group="C";
            }
        }
        return (object)array(
            'score'=>$score,
            'fullscore'=>$fullscore,
            'percent'=>$percent,
            'group'=>$group,
        );
    }

    //------------------------ add code (opy) -----------------------------
    function getQlcInfo($id){
        $id=($id)?(!is_array($id))?array($id):$id:"";

        $query =$this->db->select('qlc_info.*')
            ->from('qlc_info');

        if($id){
            $query->where_in('qlc_id',$id);
        }
        
        $query->limit(10);
        $result= $query->get();

        if($result){
            if($result->num_rows()>1) {
                return $result->result();
            }
            return $result->row();
        }

        return null;
    }
    //---------------------------------------------------------------------

}