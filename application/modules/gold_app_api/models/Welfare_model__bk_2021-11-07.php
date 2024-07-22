<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Welfare_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    public function check_welfare_status($pers_id){
        $status = array(
            "fnrl" => $this->status_enum(-1),
            "diff" => $this->status_enum(-1),
            "impv" => $this->status_enum(-1),
            "adm" => $this->status_enum(-1)
        );
        if($this->check_age($pers_id)){
            if($this->check_fnrl($pers_id)){
                $status["diff"] = $this->status_enum(-1);
                $status["impv"] = $this->status_enum(-1);
                $status["adm"] = $this->status_enum(-1);
            }else{
                $status["diff"] = $this->status_enum($this->check_diff($pers_id));
                $status["impv"] = $this->status_enum($this->check_impv($pers_id));
                $status["adm"] = $this->status_enum($this->check_adm($pers_id));
            }
        }
        return $status;
    }

    public function check_age($pers_id){
        $this->db->where(array('pers_id'=>$pers_id));
        $pers_info = $this->db->get('pers_info')->row();
        if(date('Y-m-d', strtotime("last day of -60 year")) > $pers_info->date_of_birth)
            return true;
        else
            return false;
    }

    public function check_fnrl($pers_id){
        $this->db->where(array('pers_id'=>$pers_id));
        $fnrl = $this->db->get('fnrl_info')->row();
        if(isset($fnrl))
            return true;
        else
            return false;
    }

    public function check_diff($pers_id){
        $this->db->where(array('pers_id'=>$pers_id, 'payment_status != '=>'ปฎิเสธ'));
        $this->db->order_by("date_of_req", "desc");
        $diff = $this->db->get('diff_info')->row();
        if(isset($diff)){
            if(!isset($diff->date_of_pay))
                return 1;
            else
                return 0;
        }else{
            return 0;
        }        
    }
    
    public function save_diff($pers_id){
/*         $getdt = getDatetime();
        $data = array(
            'pers_id' => $pers_id,
            'req_pers_id' => $pers_id,
            'date_of_req' => date_format(new DateTime(), 'Y-m-d'),
            'insert_user_id' => 18,
            'insert_org_id' => 79,
            'insert_datetime' => $getdt
        ); */

        $data_insert = array();
        $data_insert['pers_id'] = $pers_id;
        $data_insert['req_pers_id'] = $pers_id;
        $data_insert['date_of_req'] = date_format(new DateTime(), 'Y-m-d');
        $data_insert['chn_code'] = '007';
        $data_insert['insert_user_id'] = 18;
        $data_insert['insert_org_id'] = 174;
        $data_insert['insert_datetime'] =  date_format(new DateTime(), 'Y-m-d H:i:s');

        $this->common_model->insert('diff_info', $data_insert);

        // $this->db->insert('diff_info', $data);
        $pers_id = $this->db->insert_id();
        if(isset($pers_id))
            return true;
        else
            return false;
    }

    public function check_impv($pers_id){
        $this->db->where(array('pers_id'=>$pers_id));
        $this->db->order_by("date_of_svy", "desc");
        $impv = $this->db->get('impv_home_info')->row();
        if(isset($impv)){
            if(isset($impv->date_of_finish))
                return 0;
            else if($impv->consi_result == "อนุมัติ")
            {
                if($impv->date_of_coni > date("Y-m-d",strtotime("-1 month")))
                    return 2;
                else 
                    return 0;
            }
            else if($diff->consi_result == "ไม่อนุมัติ")
            {
                if($impv->date_of_coni > date("Y-m-d",strtotime("-1 month")))
                    return 3;
                else 
                    return 0;
            }
            else
                return 1;
        }else{
            return 0;
        }
    }
    public function check_dopa($pers_id){
        $this->db->where(array('pers_id'=>$pers_id));
        $pers_info = $this->db->get('is_authen_dopa')->row();
        if($pers_info->is_authen_dopa != null)
            return true;
        else
            return false;
    }

    public function save_impv($pers_id){
        $data = array(
            'pers_id' => $pers_id,
            'date_of_svy' => date_format(new DateTime(), 'Y-m-d'),
            'insert_user_id' => 18,
            'insert_org_id' => 174,
            'chn_code' => '007',
            'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s')
        );
        $this->db->insert('impv_home_info', $data);
        $pers_id = $this->db->insert_id();
        if(isset($pers_id))
            return true;
        else
            return false;
    }

    

    public function check_adm($pers_id){
        $this->db->where(array('pers_id'=>$pers_id));
        $this->db->order_by("date_of_req", "desc");
        $adm = $this->db->get('adm_info')->row();
        if(isset($adm)){
            if(isset($adm->date_of_adm))
                return -1;
            else if(isset($adm->date_of_dis))
                return 0;
            else
                return 1;
        }else{
            return 0;
        }
    }

    public function save_adm($pers_id){
        $data = array(
            'pers_id' => $pers_id,
            'req_pers_id' => $pers_id,
            'date_of_req' => date_format(new DateTime(), 'Y-m-d'),
            'chn_code' => '007',
            'insert_user_id' => 18,
            'insert_org_id' => 174,
            'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s')
        );
        $this->db->insert('adm_info', $data);
        $pers_id = $this->db->insert_id();
        if(isset($pers_id))
            return true;
        else
            return false;
    }

    // Status -1 = non-eligible, 0 = eligible, 1 = process, 2 = approved, 3 = not-approved, 4 = take-action 
    private function status_enum($int_status){
        $result = "";
        switch($int_status){
            case 0:
                $result = "eligible";
                break;
            case 1:
                $result = "processing";
                 break;
            case 2:
                $result = "approved";
                break;
            case 3:
                $result = "rejected";
                break;
            case 4:
                $result = "take-action";
                break;
            default:
                $result = "non-eligible";
        }
        return $result;
    }
    

    public function diff_history($pers_id){

        $this->db->SELECT("*");
        $this->db->FROM("diff_info");
        $this->db->WHERE("pers_id= {$pers_id} and pay_amount != ''");
        $this->db->order_by("date_of_pay", "DESC");

        $query = $this->db->get(); 
        return $query->result();
    }


    public function impv_history($pers_id){

        $this->db->SELECT("*");
        $this->db->FROM("impv_home_info");
        $this->db->WHERE("pers_id= {$pers_id} and consi_result = 'อนุมัติ'");
        $this->db->order_by("date_of_finish", "DESC");

        $query = $this->db->get(); 
        return $query->result();
    }
    public function adm_history($pers_id){

        $this->db->SELECT("*");
        $this->db->FROM("adm_info");
        $this->db->WHERE("pers_id= {$pers_id} and date_of_adm != ''");
        $this->db->order_by("date_of_adm", "DESC");

        $query = $this->db->get(); 
        return $query->result();
    }


}



?>