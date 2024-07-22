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



    public function index() 
    {
        $headers = apache_request_headers();
        list($type, $token) = split(" ",$headers["Authorization"]);
        if(!isset($token)){
            //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $token = $this->input->post("token");
        }
        if(isset($token)){
            try{
                $token = JWT::decode($token, ReadTxt::readkey());

                $this->load->model('Welfare_model','WelfareModel');
                $status = $this->WelfareModel->check_welfare_status($token->pers_id);

                $this->db->where(array('pers_id'=>$token->pers_id));
                    $pers_info = $this->db->get('pers_info')->row();
                $welfares = array(
                    array(
                        "welfare_id" => 0,
                        "icon" => "icon1",
                        "name" => "การสงเคราะห์ผู้สูงอายุในภาวะยากลำบาก",
                        "description" => "มีชีวิตที่ยากลำบาก เช่นถูกทอดทิ้ง",
                        "more_detail_url" => "https://google.com",
                        "status" => $status["diff"]
                        
                    ),
                    array(
                        "welfare_id" => 1,
                        "icon" => "icon2",
                        "name" => "การปรับสภาพแวดล้อมและสิ่งอำนวยความสะดวกฯ",
                        "description" => "ปรับปรุงบ้านให้แก่ผู้สูงอายุ",
                        "more_detail_url" => "https://google.com",
                        "status" => $status["impv"]
                    ),                    
                    array(
                        "welfare_id" => 2,
                        "icon" => "",
                        "name" => "งานศพ",
                        "description" => "",
                        "more_detail_url" => "",
                        "status" => "non-eligible"
                    ),
                    array(
                        "welfare_id" => 3,
                        "icon" => "icon3",
                        "name" => "ศูนย์พัฒนาการจัดสวัสดิการสังคมผู้สูงอายุ",
                        "description" => "พัฒนาศักยภาพผู้สูงอายุ",
                        "more_detail_url" => "https://google.com",
                        "status" => $status["adm"]
                    )
               );
                echo json_encode(array('success'=>true,'message'=>'','welfare'=>$welfares));
            
                }catch (Exception $e){
                    echo json_encode(array('success'=>false,'message'=>$e));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
            }
    }
    

    public function claim() 
     {
         $headers = apache_request_headers();
         if($this->uri->segment(4) != null){
             $welfare_id = $this->uri->segment(4);
         }else{
             //$wel = json_decode($this->security->xss_clean($this->input->raw_input_stream));
             $welfare_id = $this->input->post("welfare_id");
         }
         
         list($type, $token) = split(" ",$headers["Authorization"]);
         if(!isset($token)){
             //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
             $token = $this->input->post("token");
         }
         if(isset($token)){
             try{
                 $token = JWT::decode($token, ReadTxt::readkey());
                 $this->load->model('Welfare_model','WelfareModel');
                 //if($this->WelfareModel->check_dopa($token->pers_id)){
                     if($this->WelfareModel->check_age($token->pers_id)){
                         if(!$this->WelfareModel->check_fnrl($token->pers_id)){
                             switch($welfare_id){
                                 case 0:
                                     $diff_result = $this->WelfareModel->check_diff($token->pers_id);
                                     if($diff_result == 0){
                                         if($this->WelfareModel->save_diff($token->pers_id))
                                             echo json_encode(array('success'=>true,'message'=>"",'welfare_id'=>$welfare_id));
                                         else
                                             echo json_encode(array('success'=>false,'message'=>"เกิดข้อผิดพลาด",'welfare_id'=>$welfare_id));
                                     }else if($diff_result == 1){
                                         echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอยู่ในระหว่างการดำเนินการ",'welfare_id'=>$welfare_id));
                                     }else {
                                         echo json_encode(array('success'=>false,'message'=>"ไม่มีสิทธิ์ในการร้องขอ",'welfare_id'=>$welfare_id));
                                     }
                                     break;
                                 case 1:
                                     $impv_result = $this->WelfareModel->check_impv($token->pers_id);
                                     if($impv_result == 0){
                                         if($this->WelfareModel->save_impv($token->pers_id))
                                             echo json_encode(array('success'=>true,'message'=>"",'welfare_id'=>$welfare_id));
                                         else
                                             echo json_encode(array('success'=>false,'message'=>"เกิดข้อผิดพลาด",'welfare_id'=>$welfare_id));
                                     }else if($impv_result == 1){
                                         echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอยู่ในระหว่างการดำเนินการ",'welfare_id'=>$welfare_id));
                                     }else {
                                         echo json_encode(array('success'=>false,'message'=>"ไม่มีสิทธิ์ในการร้องขอ",'welfare_id'=>$welfare_id));
                                     }
                                     break;
                                 case 2:
                                     $adm_result = $this->WelfareModel->check_adm($token->pers_id);
                                     if($adm_result == 0){
                                         if($this->WelfareModel->save_adm($token->pers_id))
                                             echo json_encode(array('success'=>true,'message'=>"",'welfare_id'=>$welfare_id));
                                         else
                                             echo json_encode(array('success'=>false,'message'=>"เกิดข้อผิดพลาด",'welfare_id'=>$welfare_id));
                                     }else if($adm_result == 1){
                                         echo json_encode(array('success'=>false,'message'=>"คำร้องเก่าอยู่ในระหว่างการดำเนินการ",'welfare_id'=>$welfare_id));
                                     }else {
                                         echo json_encode(array('success'=>false,'message'=>"ไม่มีสิทธิ์ในการร้องขอ",'welfare_id'=>$welfare_id));
                                     }
                                     break;
                             }
                         }else{
                             echo json_encode(array('success'=>false,'message'=>"ยังไม่มีสิทธิ์ในการร้องขอ",'welfare_id'=>$welfare_id));
                         }
                     }else{
                         echo json_encode(array('success'=>false,'message'=>"ผู้ร้องขอเสียชีวิตแล้ว",'welfare_id'=>$welfare_id));
                     }
                  //}else{
                     //echo json_encode(array('success'=>false,'message'=>"ข้อมูลส่วนตัวยังไม่ได้ยืนยันจากกรมการปกครอง กรุณายืนยันข้อมูลที่หน้าแก้ไขข้อมูล",'welfare_id'=>$welfare_id));
                 //}
             }//try
             catch (Exception $e){
                 echo json_encode(array('success'=>false,'message'=>$e,'welfare_id'=>$welfare_id));
             }
         }else{
             echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน','welfare_id'=>$welfare_id));
         }
     }


    public function login(){
        $this->load->view('login');

    }

    public function history() {
        
        $headers = apache_request_headers();
        $token = JWT::decode($this->input->post("token"), ReadTxt::readkey());
        $this->load->model('Welfare_model','Welfare');
        $data['diff_history'] = $this->Welfare->diff_history($token->pers_id);
        $data['impv_history'] = $this->Welfare->impv_history($token->pers_id);
        $data['adm_history'] = $this->Welfare->adm_history($token->pers_id);
        $this->load->view("history", $data);
        
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