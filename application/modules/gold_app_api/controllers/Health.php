<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Health extends CI_Controller
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
        // $health = array(
        //     "success"=> true,
        //     "message"=> "",
        //     "drug_allergy"=>"paracetamol, amoxilin",
        //      "is_disabled"=>true,
        //     "disabled_explain"=>"ซีกซ้ายและตาบอด",
            // "right_own_treatment"=>true,
            // "right_kharatchakan"=>false,
            // "right_ratwisahakit"=>false,
            // "right_pakansukaparb"=>false,
            // "right_social_security"=>false,
            // "right_etc"=>true,
            // "right_etc_specify"=>"ญาติช่วยชำระ",
        //     "congenital_disorder"=>"ภูมิแพ้",
        //     "hospital"=>"พญาไท, พะรามสาม",
        //     "contact_name"=>"จริงจัง",
        //     "contact_lastname"=>"จรลี",
        //     "contact_relationship"=>"บิดา/มารดา",
        //     "contact_tel"=>"089-232-2932"
        // );
     
        $headers = apache_request_headers();
        list($type, $token) = split(" ",$headers["Authorization"]);
        if(!isset($token)){
            //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
            $token = $this->input->post("token");
        }
        if(isset($token)){
            try{
                $token = JWT::decode($token, ReadTxt::readkey());
                if (false){//($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // The request is using the POST method
                }else{
                    $this->db->where(array('pers_id'=>$token->pers_id));
                    $pers_info = $this->db->get('pers_app_info')->row();

                    $per_drug_allergy ="";
                    $pers_disability ="";
                    $per_disability_remark ="";
                    $congenital_disorder ="";
                    $hospital ="";
                    $contact_fname ="";
                    $contact_lname ="";
                    $contact_relationship ="";
                    $contact_tel ="";
                    $right_own_treatment ="";
                    $right_kharatchakan ="";
                    $right_ratwisahakit ="";
                    $right_pakansukaparb="";
                    $right_social_security="";
                    $right_etc="";
                    $right_etc_specify="";

                    if(isset($pers_info)){
           
                        $pers_app_info =$this->db->query("SELECT * FROM pers_app_info WHERE pers_id={$token->pers_id}")->row(); 

                        $pers_drug_allergy = isset($pers_app_info->pers_drug_allergy)?$pers_app_info->pers_drug_allergy:"";
                        $pers_disability  = isset($pers_app_info->pers_disability)?$pers_app_info->pers_disability:"";
                        $per_disability_remark = isset($pers_app_info->pers_disability_remark)?$pers_app_info->pers_disability_remark:"";
                        $congenital_disorder = isset($pers_app_info->congenital_disorder)?$pers_app_info->congenital_disorder:"";
                        $hospital = isset($pers_app_info->hospital)?$pers_app_info->hospital:"";
                        $contact_fname = isset($pers_app_info->contact_fname)?$pers_app_info->contact_fname:"";
                        $contact_lname = isset($pers_app_info->contact_lname)?$pers_app_info->contact_lname:"";
                        $contact_relationship = isset($pers_app_info->contact_relationship)?$pers_app_info->contact_relationship:"";
                        $contact_tel = isset($pers_app_info->contact_tel)?$pers_app_info->contact_tel:"";  
                        $right_own_treatment = isset($pers_app_info->right_own_treatment)?$pers_app_info->right_own_treatment:"";
                        $right_kharatchakan =isset($pers_app_info->right_kharatchakan)?$pers_app_info->right_kharatchakan:"";
                        $right_ratwisahakit =isset($pers_app_info->right_ratwisahakit)?$pers_app_info->right_ratwisahakit:"";
                        $right_pakansukaparb=isset($pers_app_info->right_pakansukaparb)?$pers_app_info->right_pakansukaparb:"";
                        $right_social_security=isset($pers_app_info->right_social_security)?$pers_app_info->right_social_security:"";
                        $right_etc=isset($pers_app_info->right_etc)?$pers_app_info->right_etc:"";
                        $right_etc_specify=isset($pers_app_info->right_etc_specify)?$pers_app_info->right_etc_specify:"";
                        }

                    $personal_health = array(
                        'success'=>true,
                        'message'=>"",
                        "drug_allergy"=>$pers_drug_allergy,
                        "is_disabled"=>(bool)$pers_disability,
                        "disabled_explain"=>$per_disability_remark,
                        "congenital_disorder"=> $congenital_disorder,
                        "hospital"=>$hospital,
                        "contact_name"=> $contact_fname,
                        "contact_lastname"=>$contact_lname,
                        "contact_relationship"=>$contact_relationship,
                        "contact_tel"=>$contact_tel,
                        "right_own_treatment"=>(bool)$right_own_treatment,
                        "right_kharatchakan"=>(bool)$right_kharatchakan,
                        "right_ratwisahakit"=>(bool)$right_ratwisahakit,
                        "right_pakansukaparb"=>(bool)$right_pakansukaparb,
                        "right_social_security"=>(bool)$right_social_security,
                        "right_etc"=>(bool)$right_etc,
                        "right_etc_specify"=>$right_etc_specify
                                              
                    );
                  
                    echo json_encode($personal_health);
                }
            }catch (Exception $e){
                echo json_encode(array('success'=>false,'message'=>$e));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
        }
    }

   
    public function update() 
    {
        $headers = apache_request_headers();
        list($type, $token) = split(" ",$headers["Authorization"]);
        if(!isset($token)){
            $token = $this->input->post("token");
        }
        if(isset($token)){
            try{
                $token = JWT::decode($token, ReadTxt::readkey());
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // The request is using the POST method
                    $this->db->where(array('pers_id'=>$token->pers_id));
                    $pers_info = $this->db->get('pers_app_info')->row();
                   
                    if(isset($pers_info)){
                        $pers_app_info = array(
                            //'pers_id'                 =>$token->pers_id,
                            'pers_drug_allergy'       =>$this->input->post("drug_allergy"),
                            'pers_disability'         =>filter_var($this->input->post("is_disabled"),FILTER_VALIDATE_BOOLEAN),
                            'pers_disability_remark'  =>$this->input->post("disabled_explain"),
                            'congenital_disorder'     =>$this->input->post("congenital_disorder"),
                            'hospital'                =>$this->input->post("hospital"),
                            'contact_fname'           =>$this->input->post("contact_name"),
                            'contact_lname'           =>$this->input->post("contact_lastname"),
                            'contact_relationship'    =>$this->input->post("contact_relationship"),
                            'contact_tel'             =>$this->input->post("contact_tel"),
                            'right_own_treatment'     =>filter_var($this->input->post("right_own_treatment"),FILTER_VALIDATE_BOOLEAN),
                            'right_kharatchakan'      =>filter_var($this->input->post("right_kharatchakan"),FILTER_VALIDATE_BOOLEAN),
                            'right_ratwisahakit'      =>filter_var($this->input->post("right_ratwisahakit"),FILTER_VALIDATE_BOOLEAN),
                            'right_pakansukaparb'     =>filter_var($this->input->post("right_pakansukaparb"),FILTER_VALIDATE_BOOLEAN),
                            'right_social_security'   =>filter_var($this->input->post("right_social_security"),FILTER_VALIDATE_BOOLEAN),
                            'right_etc'               =>filter_var($this->input->post("right_etc"),FILTER_VALIDATE_BOOLEAN),
                            'right_etc_specify'       =>$this->input->post("right_etc_specify")                  
                        );
                        //update into pers_app_info
                        $this->common_model->update('pers_app_info',$pers_app_info,array('pers_id'=>$token->pers_id));
                    

                    }else{
                        if(!isset($pers_info)){
                            $pers_app_info = array(
                                'pers_id'                 =>$token->pers_id,
                                'pers_drug_allergy'       =>$this->input->post("drug_allergy"),
                                'pers_disability'         =>filter_var($this->input->post("is_disabled"),FILTER_VALIDATE_BOOLEAN),
                                'pers_disability_remark'  =>$this->input->post("disabled_explain"),
                                'congenital_disorder'     =>$this->input->post("congenital_disorder"),
                                'hospital'                =>$this->input->post("hospital"),
                                'contact_fname'           =>$this->input->post("contact_name"),
                                'contact_lname'           =>$this->input->post("contact_lastname"),
                                'contact_relationship'    =>$this->input->post("contact_relationship"),
                                'contact_tel'             =>$this->input->post("contact_tel"),
                                'right_own_treatment'     =>filter_var($this->input->post("right_own_treatment"),FILTER_VALIDATE_BOOLEAN),
                                'right_kharatchakan'      =>filter_var($this->input->post("right_kharatchakan"),FILTER_VALIDATE_BOOLEAN),
                                'right_ratwisahakit'      =>filter_var($this->input->post("right_ratwisahakit"),FILTER_VALIDATE_BOOLEAN),
                                'right_pakansukaparb'     =>filter_var($this->input->post("right_pakansukaparb"),FILTER_VALIDATE_BOOLEAN),
                                'right_social_security'   =>filter_var($this->input->post("right_social_security"),FILTER_VALIDATE_BOOLEAN),
                                'right_etc'               =>filter_var($this->input->post("right_etc"),FILTER_VALIDATE_BOOLEAN),
                                'right_etc_specify'       =>$this->input->post("right_etc_specify")                      
                            );
                            $this->db->insert('pers_app_info', $pers_app_info);
                            //$addr_id = $this->db->insert_id();

                          
                        }
                    }
                    echo json_encode(array('success'=>true,'message'=>''));
                }
            }catch (Exception $e){
                echo json_encode(array('success'=>false,'message'=>$e));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
        }
    }
}
?>