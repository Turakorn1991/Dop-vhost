<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
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

    public function card_login_key(){
        return 'M17t8rbM8yjgc22YqjpaX85OOW9CxdnlsmWxEcli9UwXcXyQ6uIcJS7STcJX4cQKeM7Prvb8ITIWBJm2IAb0TmNoyIFPk2F9I0CkFXktqGTLBsKSwMzM1NihdjGLz5jU0X9mKqyZa6bKZuZsBXJOQc8UONQJYhjd87EL9F0EQiuLIdc9sw15NEURD8fxTfQLJNtazA60kpaVEGEq3TkE6PICjf5lncbWeVxv2RRZROTCviGTXJD5udlCIApHt0iJd6Pj';
    }

    public function get_token() 
    { 
        //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
        $id = $this->input->post("id");
        $password = $this->input->post("password");
        if(isset($id) && isset($password)) {
            $this->db->where(array('pid'=>$this->db->escape_str($id)));
            $result = $this->db->get('app_user')->row();
            if(isset($result)) {
                $this->db->where(array('pid'=>$this->db->escape_str($id),
                    'password'=>$this->db->escape_str(Authentication::hash_pw($password,$result->salt))));
                $result = $this->db->get('app_user')->row();
                if(isset($result)) {
                    $this->db->where(array('pid'=>$this->db->escape_str($id)));
                    $pers_info = $this->db->get('pers_info')->row();
                    $result->name = $pers_info->pers_firstname_th;
                    $result->lastname = $pers_info->pers_lastname_th;
                    $result->password = "";
                    $result->salt = "";
                    $date = new DateTime();
                    date_add($date, date_interval_create_from_date_string('3 months'));
                    $result->expires = $date;
                    $token = JWT::encode($result, ReadTxt::readkey());
                    echo json_encode(array('success'=>true,'message'=>'','token'=>$token,
                        'name'=>$pers_info->pers_firstname_th,'lastname'=>$pers_info->pers_lastname_th));
                    //echo json_encode(Authentication::check_token($token));
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ไม่พบรหัสบัตรประชาชน หรือรหัสผ่านในระบบ'));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'ไม่พบรหัสบัตรประชาชน หรือรหัสผ่านในระบบ'));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบรหัสบัตรประชาชน หรือรหัสผ่าน'));
        }
    }

    public function get_token_with_card_login() 
    { 
        $id = $this->input->post("id");
        $cardToken = $this->input->post("card_token");
        if(isset($id) && isset($cardToken) ) {
            if($cardToken == Authentication::card_login_key()) {
                $this->db->where(array('pid'=>$this->db->escape_str($id)));
                $result = $this->db->get('app_user')->row();
                if(isset($result)) {
                    $this->db->where(array('pid'=>$this->db->escape_str($id)));
                    $result = $this->db->get('app_user')->row();
                    if(isset($result)) {
                        $this->db->where(array('pid'=>$this->db->escape_str($id)));
                        $pers_info = $this->db->get('pers_info')->row();
                        $result->name = $pers_info->pers_firstname_th;
                        $result->lastname = $pers_info->pers_lastname_th;
                        $result->password = "";
                        $result->salt = "";
                        $date = new DateTime();
                        date_add($date, date_interval_create_from_date_string('3 months'));
                        $result->expires = $date;
                        $token = JWT::encode($result, ReadTxt::readkey());
                        echo json_encode(array('success'=>true,'message'=>'','token'=>$token,'result_status'=>0,
                            'name'=>$pers_info->pers_firstname_th,'lastname'=>$pers_info->pers_lastname_th));
                        //echo json_encode(Authentication::check_token($token));
                    }else{
                        echo json_encode(array('success'=>false,'message'=>'ไม่พบรหัสบัตรประชาชน หรือรหัสผ่านในระบบ','result_status'=>1));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ไม่พบรหัสบัตรประชาชน หรือรหัสผ่านในระบบ','result_status'=>1));
                }
            } else {
                echo json_encode(array('success'=>false,'message'=>'ไม่พบรหัสบัตรประชาชน หรือรหัสผ่านในระบบ','result_status'=>2));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบรหัสบัตรประชาชน หรือรหัสผ่าน','result_status'=>3));
        }
    }

    public static function check_token($token)
    {
        try 
        {
            $result = JWT::decode($token,"!an)1aLBF4!8qL&T70wEmVs^@BK4Ne39uGaWxGv@h)y!jU7uvYegs^Ft1zZPA^Wn");
            $expires = $result->expires;
            $now = new DateTime();
            if(isset($result->pid) && date_timestamp_get($expires) < date_timestamp_get($now)) 
            {
                return $result->pid;
            } else {
                return '';
            }
        } 
        catch(Exception $e)
        {
            return '';
        }
    }

    private static function hash_pw($password,$salt){
        $result = base64_encode(hash("sha384",$password.$salt));
        return $result;
    }
}
