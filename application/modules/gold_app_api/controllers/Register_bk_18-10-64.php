<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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
        //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
        $pid = $this->input->post("id");
        $laser_id = $this->input->post("laser_id");
        $prefix = $this->input->post("prefix");
        $pers_firstname_th = $this->input->post("name");
        $pers_lastname_th = $this->input->post("lastname");
        $date_of_birth = $this->input->post("birthdate");
        $tel_no = $this->input->post("tel");
        $password = $this->input->post("password");
        
        if(isset($pid) && isset($laser_id) && isset($pers_firstname_th) && isset($pers_lastname_th) 
           && isset($prefix) && isset($date_of_birth) && isset($tel_no) && isset($password)) {
            $pers_info = $this->has_user($pid);
            $pers_account = $this->has_pers_info($pid);
            if(!isset($pers_info)) {
                $pers_id = 0;
                if($pers_info != null){
                    /* EGA API*/
                    //$result = EGA_API::VerifyCitizenIDCard(($this->input->post('pid'),$this->input->post('pren_code'),$this->input->post('pers_firstname_th'),
                    //    $this->input->post('pers_lastname_th'),$this->input->post('laser'));
                    /* EGA API End*/
                    //if($result->code==200){
                        $pers_id = $pers_info->$pers_id;
                    //}
                }
                elseif (isset($pers_account)) {
                         $pers_id = $pers_account->pers_id;
                }
                else{
                    /* EGA API*/
                    //$result = EGA_API::VerifyCitizenIDCard(($this->input->post('pid'),$this->input->post('pren_code'),$this->input->post('pers_firstname_th'),
                    //    $this->input->post('pers_lastname_th'),$this->input->post('laser'));
                    /* EGA API End*/
                    //if($result->code==200){
                        /* INSERT pers_info */
                        $prefix_result =$this->db->query("SELECT * FROM std_prename WHERE prename_th='{$prefix}'")->row(); 
                        $pren_code = isset($prefix_result->pren_code)?$prefix_result->pren_code:"";
                        list($date, $time) = split('T',$date_of_birth);
                        $data = array(
                            'pid' => $pid,
                            'pers_firstname_th' => $pers_firstname_th,
                            'pers_lastname_th' => $pers_lastname_th,
                            //'date_of_birth' => date_format($date,"Y-m-d"),
                            'date_of_birth' => $date_of_birth,
                            'pren_code'  => $pren_code,
                            'tel_no' => $tel_no,
                            'insert_user_id' => 18,
                            'insert_org_id' => 79,
                            'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s')
                        );
                        $this->db->insert('pers_info', $data);
                        $pers_id = $this->db->insert_id();
                        /* INSERT pers_info End */
                    //}
                }
                if($pers_id!=0){
                    $salt = Register::randomSalt(64);
                    $data = array(
                        'pers_id' => $pers_id,
                        'pid' => $pid,
                        'password' => Register::hash_pw($password,$salt),
                        'salt' => $salt
                    );
                        $this->db->insert('app_user', $data);
                    echo json_encode(array('success'=>true,'message'=>''));
                }else{
                    echo json_encode(array('success'=>false,'message'=>'พบข้อผิดพลาด'));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'เลขประจำตัวประชาชนนี้ มีผู้ใข้งานแล้ว'));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
        }
    }

    public function forgot_password()
    {
        //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
        $pid = $this->input->post("id");
        $laser_id = $this->input->post("laser_id");
        //$pren_code = $input->pren_code;
        $pers_firstname_th = $this->input->post("name");
        $pers_lastname_th = $this->input->post("lastname");
        $date_of_birth = $this->input->post("birthdate");
        $tel_no = $this->input->post("tel");
        $password = $this->input->post("password");
        if(isset($pid) && isset($laser_id) && isset($pers_firstname_th) && isset($pers_lastname_th) 
           /*&& isset($pren_code)*/ && isset($date_of_birth) && isset($password)) {
            /* EGA API*/
            //$result = EGA_API::VerifyCitizenIDCard($this->input->post('pid'),$this->input->post('pren_code'),$this->input->post('pers_firstname_th'),
            //    $this->input->post('pers_lastname_th'),$this->input->post('laser'));
            /* EGA API End*/
           /* if($result->code==200){
                
            }*/
            $salt = Register::randomSalt(64);
            $this->db->set('salt', $salt);
            $this->db->set('password', Register::hash_pw($password,$salt));
            $this->db->where('pid', $pid);
            $this->db->update('app_user');
            echo json_encode(array('success'=>true,'message'=>''));
        }else{
            echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
        }
    }

    public function change_password() 
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
                $pers_id = $token->pers_id;
                $old_password = $this->input->post("old_password"); 
                $new_password = $this->input->post("new_password"); 
                if(isset($pers_id) && isset($old_password) && isset($new_password)) {
                    $this->db->where('pers_id',$pers_id);
                    $result = $this->db->get('app_user')->row();
                    if(isset($result)) {
                        $this->db->where(array('pers_id'=>$pers_id,
                            'password'=>$this->db->escape_str(Register::hash_pw($old_password,$result->salt))));
                        $result = $this->db->get('app_user')->row();
                        if(isset($result)) {
                            $salt = Register::randomSalt(64);
                            $this->db->set('salt', $salt)
                            ->set('password', Register::hash_pw($new_password,$salt))
                            ->where('pers_id', $pers_id)
                            ->update('app_user');

                            echo json_encode(array('success'=>true,'message'=>''));
                        }else{
                            echo json_encode(array('success'=>false,'message'=>'รหัสผ่านเก่าไม่ถูกต้อง'));
                        }
                    }else{
                        echo json_encode(array('success'=>false,'message'=>'เกิดข้อผิดพลาด'));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
                }
            }catch (Exception $e){
                echo json_encode(array('success'=>false,'message'=>$e));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'เกิดข้อผิดพลาด'));
        }
    }

    public function check_user_by_pid() 
    {
        //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
        $pid = $this->input->post("id");
        if(isset($pid)) {
            if(!Register::has_user()) {
                echo json_encode(array('success'=>true));
            }else{
                echo json_encode(array('success'=>false));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'Citizen ID is Blank.'));
        }
    }

    public function get_province() 
    {
        $this->db->where(array('area_type'=>$this->db->escape_str("Province")));
        echo json_encode($this->db->get('std_area')->result());
    }

    public function get_district() 
    {
        //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
        $pro_id = substr($this->input->post("area_code"),0,2);
        $this->db->like('area_code', $pro_id, 'after'); 
        $this->db->where(array('area_type'=>$this->db->escape_str("Amphur")));
        echo json_encode($this->db->get('std_area')->result());
    }

    public function get_subdistrict() 
    {
        //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
        $district_id = substr($this->input->post("area_code"),0,4);
        $this->db->like('area_code', $district_id, 'after'); 
        $this->db->where(array('area_type'=>$this->db->escape_str("Tambon")));
        echo json_encode($this->db->get('std_area')->result());
    }
    private function has_pers_info($id){
        $this->db->where(array('pid'=>$id));
        return $this->db->get('pers_info')->row();
    }

    private function has_user($id)
    {
        $this->db->where(array('pid'=>$id));
        return $this->db->get('app_user')->row();
        
    }

    private static function hash_pw($password,$salt){
        return base64_encode(hash("sha384",$password.$salt));
        
    }

    private static function randomSalt($len = 64) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';    
        $l = strlen($chars) - 1;    
        $str = '';    
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }   
        return $str;    
    }
}