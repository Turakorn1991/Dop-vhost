<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Welfare extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->output->set_content_type('json', 'utf-8');

    }
    public function __deconstruct()
    {
        $this->db->close();
    }

    public function test() {
        $this->db->where(array('pers_id'=>2 ,'delete_datetime'=> null));
        $fnrl = $this->db->get('diff_info')->row();
        // echo json_encode($fnrl);
        if($fnrl != null)
            echo json_encode($fnrl);
        else
            echo json_encode($fnrl);
    }


    public function index() 
    {
        $headers = apache_request_headers();
        if(!isset($headers["Authorization"])){
            $token = $this->input->post("token");
        }else{
            list($type, $token) = explode(" ",$headers["Authorization"]);
        }
        if(isset($token)){
            try{
                $token = JWT::decode($token, ReadTxt::readkey());
                $this->load->model('Welfare_model','WelfareModel');
                $this->db->where(array('pers_id'=>$token->pers_id));
                $pers_info_reg = $this->db->get('pers_info')->row();
                if($pers_info_reg != null){
                    $this->db->where(array('pers_id' =>$pers_info_reg->pers_id,'pid'=>$pers_info_reg->pid));
                    $user_gold = $this->db->get('app_user_gold_app_register')->row();
                    if($user_gold != null){
                        $this->db->where(array('pers_id'=>$user_gold->pers_id_elderly));
                        $pers_info = $this->db->get('pers_info')->row();
                        if($pers_info != null){
                            $status = $this->WelfareModel->check_welfare_status($pers_info->pers_id ,$pers_info->date_of_birth);
                            $welfares = array(
                                array(
                                    "welfare_id" => 0,
                                    "icon" => "icon1",
                                    "name" => "การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก",
                                    "description" => "มีชีวิตที่ยากลำบาก เช่นถูกทอดทิ้ง",
                                    "more_detail_url" => "https://google.com",
                                    "status" => $status["diff"],
                                    "status_operation" => ""  
                                ),
                                array(
                                    "welfare_id" => 1,
                                    "icon" => "icon2",
                                    "name" => "ศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ",
                                    "description" => "พัฒนาศักยภาพผู้สูงอายุ",
                                    "more_detail_url" => "https://google.com",
                                    "status" => $status["adm"],
                                    "status_operation" => ""
                                ),                 
                                array(
                                    "welfare_id" => 2,
                                    "icon" => "",
                                    "name" => "งานศพ",
                                    "description" => "",
                                    "more_detail_url" => "",
                                    "status" => "non-eligible",
                                    "status_operation" => ""
                                ),
                                array(
                                    "welfare_id" => 3,
                                    "icon" => "icon3",
                                    "name" => "การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ",
                                    "description" => "ปรับปรุงบ้านให้แก่ผู้สูงอายุ",
                                    "more_detail_url" => "https://google.com",
                                    "status" => $status["impv"],
                                    "status_operation" => ""
                                )
                            );
                            echo json_encode(array('success'=>true,'message'=>'','welfare'=>$welfares));
                        }else{
                            echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลในระบบ')); 
                        }
                    }else{
                        $status = $this->WelfareModel->check_welfare_status_default();
                        $welfares = array(
                            array(
                                "welfare_id" => 0,
                                "icon" => "icon1",
                                "name" => "การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก",
                                "description" => "มีชีวิตที่ยากลำบาก เช่นถูกทอดทิ้ง",
                                "more_detail_url" => "https://google.com",
                                "status" => $status["diff"],
                                "status_operation" => ""  
                            ),
                            array(
                                "welfare_id" => 1,
                                "icon" => "icon2",
                                "name" => "ศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ",
                                "description" => "พัฒนาศักยภาพผู้สูงอายุ",
                                "more_detail_url" => "https://google.com",
                                "status" => $status["adm"],
                                "status_operation" => ""
                            ),                 
                            array(
                                "welfare_id" => 2,
                                "icon" => "",
                                "name" => "งานศพ",
                                "description" => "",
                                "more_detail_url" => "",
                                "status" => "non-eligible",
                                "status_operation" => ""
                            ),
                            array(
                                "welfare_id" => 3,
                                "icon" => "icon3",
                                "name" => "การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ",
                                "description" => "ปรับปรุงบ้านให้แก่ผู้สูงอายุ",
                                "more_detail_url" => "https://google.com",
                                "status" => $status["impv"],
                                "status_operation" => ""
                            )
                        );
                        echo json_encode(array('success'=>true,'message'=>'','welfare'=>$welfares));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลในระบบ'));
                }
            }catch (Exception $e){
                echo json_encode(array('success'=>false,'message'=>'เกิดข้อผิดพลาด'));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
        }
    }

   
    public function claim() 
    {
        $headers = apache_request_headers();
        if(!isset($headers["Authorization"])){
            $token = $this->input->post("token");
        }else{
            list($type, $token) = explode(" ",$headers["Authorization"]);
        }
        if(isset($token)){
            try{
                if($this->uri->segment(4) != null){
                    $welfare_id = $this->uri->segment(4);
                }else{
                    $welfare_id = $this->input->post("welfare_id");
                }
                if(($welfare_id != null) && ($welfare_id == 0 || $welfare_id == 1 || $welfare_id == 2 || $welfare_id == 3)){
                    $token = JWT::decode($token, ReadTxt::readkey());
                    $this->db->where(array('pers_id'=>$token->pers_id));
                    $pers_info_reg = $this->db->get('pers_info')->row();
                    if($pers_info_reg != null){
                        $this->db->where(array('pers_id' =>$pers_info_reg->pers_id,'pid'=>$pers_info_reg->pid));
                        $user_gold = $this->db->get('app_user_gold_app_register')->row();
                        if($user_gold != null){
                            $this->db->where(array('pers_id'=>$user_gold->pers_id_elderly));
                            $pers_info = $this->db->get('pers_info')->row();
                            if($pers_info != null){
                                if(!empty($pers_info->pre_addr_id)){
                                    $this->load->model('Welfare_model','WelfareModel');
                                    $this->db->where(array('addr_id'=>$pers_info->pre_addr_id));
                                    $pers_addr = $this->db->get('pers_addr')->row();
                                    if($pers_addr->addr_province != null && $pers_addr->addr_province != ""){
                                        if($this->WelfareModel->check_age($pers_info->date_of_birth)){
                                            if(!$this->WelfareModel->check_fnrl($pers_info->pers_id)){
                                                switch($welfare_id)
                                                {
                                                    case 0:
                                                         // ตาราง diff_info
                                                         $diff_result = $this->WelfareModel->check_diff_status($pers_info->pers_id);
                                                         if($diff_result != 1 && $diff_result != 4){
                                                             if($this->WelfareModel->save_diff($pers_info->pers_id ,$pers_info_reg->pers_id))
                                                                 echo json_encode(array('success'=>true,'message'=>"",'welfare_id'=>$welfare_id));
                                                             else
                                                                 echo json_encode(array('success'=>false,'message'=>"เกิดข้อผิดพลาด",'welfare_id'=>$welfare_id));
                                                         }else if($diff_result == 4){
                                                             echo json_encode(array('success'=>false,'message'=>"การขอรับสิทธิ์เกินจำนวนครั้งที่กำหนด(ไม่เกิน 3 ครั้ง/ปี)",'welfare_id'=>$welfare_id));
                                                         }else{
                                                             echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอยู่ในระหว่างการดำเนินการ",'welfare_id'=>$welfare_id));
                                                         }
                                                         break;
                                                    case 1:
                                                        // ตาราง adm_info
                                                        $adm_result = $this->WelfareModel->check_adm($pers_info->pers_id);
                                                        if($adm_result == 0){
                                                            if($this->WelfareModel->save_adm($pers_info->pers_id,$pers_info_reg->pers_id))
                                                                echo json_encode(array('success'=>true,'message'=>"",'welfare_id'=>$welfare_id));
                                                            else
                                                                echo json_encode(array('success'=>false,'message'=>"เกิดข้อผิดพลาด",'welfare_id'=>$welfare_id));
                                                        }else {
                                                            echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอยู่ในระหว่างการดำเนินการ",'welfare_id'=>$welfare_id));
                                                        }
                                                        break;
                                                    case 2:
                                                        // ตาราง fnrl_info
                                                         $adm_fnrl = $this->WelfareModel->check_fnrl_status($pers_info->pers_id);
                                                         if($adm_fnrl == 0){
                                                             if($this->WelfareModel->save_fnrl($pers_info->pers_id,$pers_info_reg->pers_id))
                                                                 echo json_encode(array('success'=>true,'message'=>"",'welfare_id'=>$welfare_id));
                                                             else
                                                                 echo json_encode(array('success'=>false,'message'=>"เกิดข้อผิดพลาด",'welfare_id'=>$welfare_id));
                                                         }else if($adm_fnrl == 1) {
                                                             echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอยู่ในระหว่างการดำเนินการ",'welfare_id'=>$welfare_id));
                                                         }else if($adm_fnrl == 2) {
                                                            echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอนุมัติแล้ว",'welfare_id'=>$welfare_id));
                                                         }else{
                                                            echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าถูกปฎิเสธ",'welfare_id'=>$welfare_id));
                                                         }
                                                        break;
                                                    case 3:
                                                        // ตาราง impv_home_info
                                                        $impv_result = $this->WelfareModel->check_impv($pers_info->pers_id);
                                                        if($impv_result == 0){
                                                            if($this->WelfareModel->save_impv($pers_info->pers_id))
                                                                echo json_encode(array('success'=>true,'message'=>"",'welfare_id'=>$welfare_id));
                                                            else
                                                                echo json_encode(array('success'=>false,'message'=>"เกิดข้อผิดพลาด",'welfare_id'=>$welfare_id));
                                                        }else if($impv_result == 1){
                                                            echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอยู่ในระหว่างการดำเนินการ",'welfare_id'=>$welfare_id));
                                                        }else {
                                                            echo json_encode(array('success'=>false,'message'=>"ไม่มีสิทธิ์ในการร้องขอ",'welfare_id'=>$welfare_id));
                                                        }
                                                        break;
                                                }
                                            }else{
                                                echo json_encode(array('success'=>false,'message'=>"ผู้ร้องขอเสียชีวิตแล้ว",'welfare_id'=>$welfare_id));
                                            }
                                        }else{
                                            echo json_encode(array('success'=>false,'message'=>"ท่านยังไม่มีสิทธิ์ในการร้องขอ",'welfare_id'=>$welfare_id));
                                        }
                                    }else{
                                        echo json_encode(array('success'=>false,'message'=>'กรุณาอัพเดทข้อมูลประวัติส่วนตัว(ที่อยู่)','welfare_id'=>$welfare_id));  
                                    }          
                                }else{
                                    echo json_encode(array('success'=>false,'message'=>'กรุณาอัพเดทข้อมูลประวัติส่วนตัว(ที่อยู่ผู้สูงอายุ)','welfare_id'=>$welfare_id));
                                }
                            }else{
                                echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลผู้สูงอายุในระบบ','welfare_id'=>$welfare_id));
                            }
                        }else{
                            echo json_encode(array('success'=>false,'message'=>'กรุณาอัพเดทข้อมูลส่วนตัว(ข้อมูลผู้สูงอายุ)','welfare_id'=>$welfare_id));
                        }    
                    }else{
                        echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลในระบบ','welfare_id'=>$welfare_id));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วนหรือไม่ถูกต้อง','welfare_id'=>$welfare_id));
                }
            }catch (Exception $e){
                echo json_encode(array('success'=>false,'message'=>'เกิดข้อผิดพลาด','welfare_id'=>null));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน','welfare_id'=>null));
        }  
    }


    public function login(){
        $this->load->view('login');

    }

    public function history() {
        $headers = apache_request_headers();
        if(!isset($headers["Authorization"])){
            $token = $this->input->post("token");
        }else{
            list($type, $token) = explode(" ",$headers["Authorization"]);
        }
        if(isset($token)){
            try{
                $token = JWT::decode($token, ReadTxt::readkey());
                $this->db->where(array('pers_id'=>$token->pers_id));
                $pers_info_reg = $this->db->get('pers_info')->row();
                if($pers_info_reg != null){
                    $this->db->where(array('pers_id' =>$pers_info_reg->pers_id,'pid'=>$pers_info_reg->pid));
                    $user_gold = $this->db->get('app_user_gold_app_register')->row();
                    if($user_gold != null){
                        $this->db->where(array('pers_id'=>$user_gold->pers_id_elderly));
                        $pers_info = $this->db->get('pers_info')->row();
                        if($pers_info != null){
                            $this->load->model('Welfare_model','Welfare');
                            $data['diff_history'] = $this->Welfare->diff_history($pers_info->pers_id);
                            $data['impv_history'] = $this->Welfare->impv_history($pers_info->pers_id);
                            $data['adm_history'] = $this->Welfare->adm_history($pers_info->pers_id);
                            $data['fnlt_history'] = $this->Welfare->fntl_history($pers_info->pers_id);
                            echo json_encode(array('success'=>true,'message'=>'','data'=> $data)); 
                        }else{
                            echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลในระบบ(ข้อมูลผู้สูงอายุ)'));
                        }
                    }else{
                        echo json_encode(array('success'=>false,'message'=>'กรุณาอัพเดทข้อมูลส่วนตัว(ข้อมูลผู้สูงอายุ)'));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลในระบบ'));
                } 
            }catch(Exception $e){
                echo json_encode(array('success'=>false,'message'=>'เกิดข้อผิดพลาด')); 
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
        }
    }

    public function reset() 
    {
        list($type, $token) = split(" ",$headers["Authorization"]);
        if(!isset($token)){
            //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $token = $this->input->post("token");
        }
            try{
                
                $token = JWT::decode($token, ReadTxt::readkey());
                $tables = array('diff_info', 'impv_home_info', 'adm_info');
                $this->db->where('pers_id',$token->pers_id);
                $this->db->delete($tables);
    
                echo json_encode(array('success'=>true,'message'=>''));
            }catch (Exception $e){
                echo json_encode(array('success'=>false,'message'=>$e));
            }
    } 
    
}
?>