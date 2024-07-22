<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Welfare_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    #region Msg Error
    private function msg_operationing(){
        return "คำร้องเก่าอยู่ในระหว่างการดำเนินการ";
    }
    private function msg_approve(){
        return "คำร้องเก่าอนุมัติแล้ว";
    }
    private function msg_save_unsuccess(){
        return "บันทึกข้อมูลไม่สำเร็จ";
    }
    #endregion

    #region Default value
    private function default_user_id(){ //ผู้รับเรื่อง
        return 18;
    }
    private function default_org_id(){  //หน่วยงาน
        return 174;
    }
    private function default_chn_code(){   // ช่องทางการแจ้งเรื่อง
        return '007';
    }
    #endregion


    // ตรวจสอบอายุถึง 60 ปี หรือไม่
    public function check_age($date_of_birth){
        if(date('Y-m-d', strtotime("last day of -60 year")) > $date_of_birth)
            return true; // อายุ 60 ปี ขึ้นไป
        else
            return false; // อายุยังไม่ถึง 60 ปี
    }

    // ตรวจสอบการเสียชีวิต
    public function check_fnrl($pers_id){
        $this->db->where(array('pers_id'=>$pers_id));
        $fnrl = $this->db->get('fnrl_info')->row();
        if($fnrl != null)
            return true;  // เสียชีวิตแล้ว
        else
            return false; // ยังมีชีวิตอยู่
    }

    #region check status
    // ตารางการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
    public function check_diff($pers_id){
        $mysql_query = "select *
                        from diff_info 
                        where delete_datetime is null
                        and pers_id = '".$pers_id."'  order by date_of_req desc , diff_id desc" ;
        $query = $this->db->query($mysql_query);
        $diff = $query->row();
        if(isset($diff)){
            if($diff->payment_status == 'ปฎิเสธ'){
                return 3;
            }else if($diff->payment_status == 'อนุมัติ'){
                return 2;
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }
    
    // ตารางศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ
    public function check_adm($pers_id){
        $mysql_query = "select *
                        from adm_info 
                        where delete_datetime is null
                        and pers_id = '".$pers_id."'  order by date_of_req desc , adm_id desc" ;
        $query = $this->db->query($mysql_query);
        $adm = $query->row();
        if(isset($adm)){
            if(isset($adm->date_of_dis)){
                return 0;
            }else if(isset($adm->date_of_adm)){
                return 2;
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }

    // ตารางปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ (บ้านพักอาศัยของผู้สูงอายุ)
    public function check_impv($pers_id){
        $mysql_query = "select *
                        from impv_home_info 
                        where delete_datetime is null
                        and pers_id = '".$pers_id."'  order by date_of_svy desc , imp_home_id desc" ;
        $query = $this->db->query($mysql_query);
        $impv = $query->row();
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
    #endregion
    

    #region Save Data
    // Save to table diff_info
    // ตารางการสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก
    public function save_diff($pers_id){
        $data_insert = array();
        $data_insert['pers_id'] = $pers_id;
        $data_insert['req_pers_id'] = $pers_id;
        $data_insert['date_of_req'] = date_format(new DateTime(), 'Y-m-d');
        $data_insert['chn_code'] = $this->default_chn_code();
        $data_insert['insert_user_id'] = $this->default_user_id();
        $data_insert['insert_org_id'] = $this->default_org_id();
        $data_insert['insert_datetime'] =  date_format(new DateTime(), 'Y-m-d H:i:s');
        $this->common_model->insert('diff_info', $data_insert);
        $pers_id = $this->db->insert_id();
        if(isset($pers_id))
            return true;
        else
            return false;       
    }
    
    // Save to table adm_info
    // ตารางศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ
    public function save_adm($pers_id,$welfare_id){
        $data = array(
            'pers_id' => $pers_id,
            'req_pers_id' => $pers_id,
            'date_of_req' => date_format(new DateTime(), 'Y-m-d'),
            'chn_code' => $this->default_chn_code(),
            'insert_user_id' => $this->default_user_id(),
            'insert_org_id' => $this->default_org_id(),
            'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s')
        );
        $this->db->insert('adm_info', $data);
        $pers_id = $this->db->insert_id();
        if(isset($pers_id))
            return true;
        else
            return false;
    }

    // Save to table impv_home_info
    // ตารางปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ (บ้านพักอาศัยของผู้สูงอายุ)
    public function save_impv($pers_id){
        $data = array(
            'pers_id' => $pers_id,
            'date_of_svy' => date_format(new DateTime(), 'Y-m-d'),
            'insert_user_id' => $this->default_user_id(),
            'insert_org_id' => $this->default_org_id(),
            'chn_code' => $this->default_chn_code(),
            'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s')
        );
        $this->db->insert('impv_home_info', $data);
        $pers_id = $this->db->insert_id();
        if(isset($pers_id))
            return true;
        else
            return false;
    }


    #endregion



    public function check_welfare_status($pers_id ,$date_of_birth){
        $status = array(
            "fnrl" => $this->status_enum(-1),
            "diff" => $this->status_enum(-1),
            "impv" => $this->status_enum(-1),
            "adm" => $this->status_enum(-1)
        );
        if($this->check_age($date_of_birth)){
            if($this->check_fnrl($pers_id)){
                $status["fnrl"] = $this->status_enum(0);
            }else{
                $status["diff"] = $this->status_enum($this->check_diff($pers_id));
                $status["impv"] = $this->status_enum($this->check_impv($pers_id));
                $status["adm"] = $this->status_enum($this->check_adm($pers_id));
            }
        }
        return $status;
    }

    public function check_dopa($pers_id){
        $this->db->where(array('pers_id'=>$pers_id));
        $pers_info = $this->db->get('is_authen_dopa')->row();
        if($pers_info->is_authen_dopa != null)
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