<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    private static $_agentID = '1234567890987';
    private static $_consumerKey = '08fe2d00-1a3f-45d5-afcf-a1bfa9c34ecf';
    private static $_consumerSecret = 'x8MWv4a8olL';
    private static $_username_sms = '0656956322';
    private static $_password_sms = '8312233';
    private static $_key_sms_otp = '1712401646387974';
    private static $_secret_sms_otp = '3c303c493262e289345f5c96d063ea03';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->output->set_content_type('json', 'utf-8');
        $this->load->library([
            'PHPRequests' => 'PHPRequests'
        ]);

    }
    public function __deconstruct()
    {
        $this->db->close();
    }

    //------------------------------------------------------------------------
    private function delete_gen_otp_id($otp_id){
        $this->db->where('otp_id', $otp_id);
        $this->db->delete('gen_otp');
    }
    private static function randomOtp($len = 6) {
        $chars = '0123456789';    
        $l = strlen($chars) - 1;    
        $str = '';    
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }   
        return $str;    
    }
    private static function randomOtpReferece($len = 4) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';    
        $l = strlen($chars) - 1;    
        $str = '';    
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }   
        return $str;    
    }
    private function gen_otp($tel_no){
        try{
            $key_sms_otp = self::$_key_sms_otp;
            $secret_sms_otp = self::$_secret_sms_otp;
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://otp.thaibulksms.com/v2/otp/request',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
                "key" : "'.$key_sms_otp.'",
                "secret" : "'.$secret_sms_otp.'",
                "msisdn" : "'.$tel_no.'"
            }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $data = json_decode($response);
            if(isset($data->status)){
                if($data->status == "success"){
                    $data_return = array(
                        'success' => true,
                        'otpreference' => $data->refno,
                        'token'=>$data->token,
                        'message'=>''
                    );
                    return $data_return;
                }else{
                    $data_return = array(
                        'success' => false,
                        'otpreference' => '',
                        'token'=>'',
                        'message'=>'เกิดข้อผิดพลาด ส่ง OTP ไม่สำเร็จ'
                    );
                    return $data_return;
                }
            }else{
                $data_return = array(
                    'success' => false,
                    'otpreference' => '',
                    'token'=>'',
                    'message'=>'เกิดข้อผิดพลาด ส่ง OTP ไม่สำเร็จ'
                );
                return $data_return;
            }
        }catch(Exception $ex){
            $data_return = array(
                'success' => false,
                'otpreference' => '',
                'token'=>'',
                'message'=>'เกิดข้อผิดพลาด'
            );
            return $data_return;
        }
    }
    private function verify_otp($token,$pin)
    { 
      try{
        $key_sms_otp = self::$_key_sms_otp;
        $secret_sms_otp = self::$_secret_sms_otp;
        $curl = curl_init();  
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://otp.thaibulksms.com/v2/otp/verify',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{
            "key" : "'.$key_sms_otp.'",
            "secret" : "'.$secret_sms_otp.'",
            "token" : "'.$token.'",
            "pin" : "'.$pin.'"
        
        }',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response);
        if(isset($data->status)){
            if($data->status == "success"){
                return array('code' => '2','message'=>'');
            }else{
                return array('code' => '0','message'=>'เกิดข้อผิดพลาด');
            }
        }else{
            if(isset($data->errors)){
                switch ($data->errors[0]->message) {
                    case "Token is expire.":
                        return array('code' => '1','message'=>'เลข OTP หมดอายุ');
                      break;
                    case "Code is invalid.":
                        return array('code' => '0','message'=>'ยืนยัน OTP ไม่ถูกต้อง');
                      break;
                    case "Code used already":
                        return array('code' => '0','message'=>'เลข OTP นี้ถูกใช้งานแล้ว');
                      break;
                    default:
                    return array('code' => '0','message'=>'เกิดข้อผิดพลาด');
                  }
            }else{
                return array('code' => '0','message'=>'เกิดข้อผิดพลาด');
            }
        }
      }catch(Exception $ex){
        return array('code' => '0','message'=>'เกิดข้อผิดพลาด');
      }
    }
    private function gen_otp_old($tel_no)
    {
        try{
            $username_sms = self::$_username_sms;
            $password_sms = self::$_password_sms;
            $minutes_to_add = 5;
            $time = new DateTime();
            $time->add(new DateInterval('PT' . $minutes_to_add . 'M'));
            $date_otp = date_format($time, 'Y-m-d H:i:s');
            $date_otp_sms = date_format($time, 'd/m/Y H:i:s');
            $otp_ref = Register::randomOtpReferece();
            $otprandom = Register::randomOtp();
            $data_otp_add = array(
                'expire_datetime' => $date_otp,
                'otp' => $otprandom,
                'otp_reference'=> $otp_ref 
            );
            $this->db->insert('gen_otp', $data_otp_add);
            $insert_id = $this->db->insert_id();
            $sent_sms_success = false;
            $url = "https://thaibulksms.com/sms_api.php";
            $message_sms = "รหัสอ้างอิง:".$otp_ref." รหัส OTP:".$otprandom."ใช้งานได้ถึง ".$date_otp_sms." กรุณายืนยันรหัส OTP ด้วยตัวเอง";
            $msg_string = "";
            if(extension_loaded('curl')){
                $data = array(
                    'username' => $username_sms,
                    'password' => $password_sms,
                    'msisdn' => $tel_no,
                    'message' => $message_sms,
                    'sender' => "SMS",//"กรมกิจการผู้สูงอายุ",
                    'ScheduledDelivery' => "",
                    'force' => "premium");
                $data_string = http_build_query($data);        
                $agent = "ThaiBulkSMS API PHP Client";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_USERAGENT, $agent);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
                $xml_result = curl_exec($ch);
                $code = curl_getinfo($ch);
                curl_close($ch);
                if($code['http_code'] == 200){
                    if(function_exists('simplexml_load_string')) {
                        $sms = new SimpleXMLElement($xml_result);
                        $count = count($sms->QUEUE);
                        if($count > 0){
                            $count_pass = 0;
                            $count_fail = 0;
                            $used_credit = 0;
                            for($i=0;$i<$count;$i++){
                                if($sms->QUEUE[$i]->Status){    
                                    $count_pass++;  
                                    $used_credit += $sms->QUEUE[$i]->UsedCredit;
                                }else{                      
                                    $count_fail++; 
                                }
                            }
                            if($count_pass > 0){
                                if($used_credit > 0)
                                {
                                    $sent_sms_success = true;
                                }
                                $msg_string = "สามารถส่งออกได้จำนวน $count_pass หมายเลข, ใช้เครดิตทั้งหมด $used_credit เครดิต";
                            }               
                            if($count_fail > 0){
                                $msg_string = "ไม่สามารถส่งออกได้จำนวน $count_fail หมายเลข";
                            }
                        }else{
                            $msg_string = "เกิดข้อผิดพลาดในการทำงาน, (".$sms->Detail.")";
                        }                       
                    }else if(function_exists('xml_parse')){
                        $xml = sms::xml2array($xml_result);
                        $count = count($xml['SMS']['QUEUE']);
                        if($count > 0){
                            $count_pass = 0;
                            $count_fail = 0;
                            $used_credit = 0;
                            for($i=0;$i<$count;$i++){
                                if($xml['SMS']['QUEUE'][$i]['Status']){ 
                                        $count_pass++;  
                                        $used_credit +=                 
                                        $xml['SMS']['QUEUE'][$i]['UsedCredit'];
                                    }else{                      
                                        $count_fail++; 
                                    }
                                }
                            if($count_pass > 0){
                                if($used_credit > 0)
                                {
                                    $sent_sms_success = true;
                                }
                                $msg_string = "สามารถส่งออกได้จำนวน $count_pass หมายเลข, ใช้เครดิตทั้งหมด $used_credit เครดิต";
                            }               
                            if($count_fail > 0){
                                $msg_string = "ไม่สามารถส่งออกได้จำนวน $count_fail หมายเลข";
                            }
                        }else{
                            $msg_string = "เกิดข้อผิดพลาดในการทำงาน, (".$xml['SMS']['Detail'].")";
                        }
                    }else{
                        $msg_string = "เกิดข้อผิดพลาดในการทำงาน: <br /> ระบบไม่รองรับฟังก์ชั่น XML";
                    }
                }else{
                    $msg_string = "เกิดข้อผิดพลาดในการทำงาน: <br />" . $code['http_code'];
                }           
            }else{
                if(function_exists('fsockopen')) {
                    $msg_string = $this->sending_fsock($username,$password,$msisdn,$message,$sender,$ScheduledDelivery,$force);
                }else {
                    $msg_string = "cURL OR fsockopen is not enabled";
                }
            }

            if($sent_sms_success)
            {
                $data_return = array(
                    'success' => true,
                    'otpreference' => $otp_ref,
                    'token'=>Register::randomOtpReferece(40),
                    'message'=>$msg_string
                );
                return $data_return;
            }
            else
            {
                Register::delete_gen_otp_id($insert_id);
                $data_return_error_sms = array(
                    'success' => false,
                    'otpreference' => '',
                    'token'=>'',
                    'message'=>'พบข้อผิดพลาด การส่ง SMS OTP'
                );
                return $data_return_error_sms ;
            }
        }catch (Exception $e){
            $data_return_error = array(
                'success' => false,
                'otpreference' => '',
                'token'=>'',
                'message'=>'พบข้อผิดพลาด'
            );
            return $data_return_error;
        }
    }
    private function getToken() 
    {
        try{
            $agentID = self::$_agentID;
            $consumerKey = self::$_consumerKey;
            $consumerSecret = self::$_consumerSecret;
            $head = array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Consumer-Key' => $consumerKey,
            );
            $response = Requests::get('https://api.egov.go.th/ws/auth/validate?ConsumerSecret='.$consumerSecret.'&AgentID='.$agentID,$head); 
            $result = json_decode($response->body);
            if(isset($result->Result))
                return array('status' => true,'result' => $result->Result);            
            else
                return array('status' => false,'result' => "error"); 
        }catch (Exception $e){
            return array('status' => false,'result' => "error"); 
        }         
    }
    private function birthdayconvert($dateOfBirth){
        list($y,$m,$d) = explode("-",$dateOfBirth);
        $year = ((int)$y + 543);
        return "$year$m$d";
    }
    private function getDataAndCheckDataEGOV($token,$pid,$firstName,$lastName,$dateOfBirth) {
        try{ 
            $agentID = self::$_agentID;
            $consumerKey = self::$_consumerKey;
            $consumerSecret = self::$_consumerSecret;
            $headers  = [           
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Consumer-Key' => $consumerKey,
                'Token' => $token           
            ];
            $citizenId = str_replace("-","",$pid);
            $birthday = Register::birthdayconvert($dateOfBirth);        
            $response = Requests::get('https://api.egov.go.th/ws/dopa/linkage/v1/link?OfficeID=00023&ServiceID=001&Version=01&CitizenID='.$citizenId,$headers); 
            $result = json_decode($response->body);
            if(isset($result->Message)){
                $msgError = "เกิดข้อผิดพลาด";
                if(isset($result->Code))
                {
                    if($result->Code == "90001"){
                        $msgError = "เจ้าหน้าที่ยังไม่ได้ยืนยันสิทธิ์ข้อมูลกรมการปกครอง";
                    }
                    else{
                        $msgError = "ไม่พบข้อมูลบุคคลของกรมการปกครอง";
                    }
                }
                return array('status' => false,'message' => $msgError);
            }else
            {
                $s_firstname = $result->firstName;
                $s_lastname = $result->lastName;
                $s_dateOfBirth= $result->dateOfBirth;
                if(($s_firstname == $firstName) && ($s_lastname == $lastName) && ($s_dateOfBirth == $birthday)){
                    return array('status' => true,'message' => '');
                }
                else{
                    return array('status' => false,'message' => "ข้อมูลบุคคลไม่ถูกต้องกรุณาตรวจสอบข้อมูล");
                }          
            }
        }catch (Exception $e){
            return array('status' => false,'message' => "เกิดข้อผิดพลาด");
        }
    }
    
    public function reset_otp() 
    {  
        $tel_no = $this->input->post("tel");
        if(isset($tel_no))
        {
            if(!empty($tel_no)){
                echo json_encode(Register::gen_otp($tel_no));
            }else{
                echo json_encode(array('success'=>false,'otpreference'=>'','token'=>'','message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
            }
        }else{
            echo json_encode(array('success'=>false,'otpreference'=>'','token'=>'','message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน')); 
        }
    }
    public function indexOTP() 
    {
        $pid = $this->input->post("id");
        $laser_id = $this->input->post("laser_id");
        $prefix = $this->input->post("prefix");
        $pers_firstname_th = $this->input->post("name");
        $pers_lastname_th = $this->input->post("lastname");
        $date_of_birth = $this->input->post("birthdate");
        $tel_no = $this->input->post("tel");
        $password = $this->input->post("password");
        $otp = $this->input->post("otp");
        $otp_ref = $this->input->post("otpreference");
        $token = $this->input->post("token");
        // ตรวจสอบการส่ง field ข้อมูลตามกำหนด
        if(isset($token) && isset($pid) && isset($laser_id) && isset($pers_firstname_th) && isset($pers_lastname_th) 
        && isset($prefix) && isset($date_of_birth) && isset($tel_no) && isset($password) && isset($otp) && isset($otp_ref)){
            // ตรวจสอบค่าว่างข้อมูล
            if(!empty($token) && !empty($pid) && !empty($laser_id) && !empty($pers_firstname_th) && !empty($pers_lastname_th) 
            && !empty($prefix) && !empty($date_of_birth) && !empty($tel_no) && !empty($password) && !empty($otp) && !empty($otp_ref)){
                //ตรวจสอบข้อมูล Otp
                $verify_otp = Register::verify_otp($token,$otp);
                if($verify_otp['code'] == '2'){
                    $pers_user = $this->has_user($pid);
                    if($pers_user == null){
                        try{
                            $pers_id = 0;
                            $pers_info = $this->has_pers_info($pid);
                            if($pers_info != null){
                                $pers_id = $pers_info->pers_id;
                            }
                            else{
                                $prefix_result =$this->db->query("SELECT * FROM std_prename WHERE prename_th='{$prefix}'")->row(); 
                                $pren_code = ($prefix_result == null)?"":$prefix_result->pren_code;
                                $data = array(
                                    'pid' => $pid,
                                    'pers_firstname_th' => $pers_firstname_th,
                                    'pers_lastname_th' => $pers_lastname_th,
                                    'date_of_birth' => $date_of_birth,
                                    'pren_code'  => $pren_code,
                                    'tel_no' => $tel_no,
                                    'insert_user_id' => 18,
                                    'insert_org_id' => 174,
                                    'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s')
                                );
                                $this->db->insert('pers_info', $data);
                                $pers_id = $this->db->insert_id();
                            }
                            // บันทึกข้อมูล app_user
                            if($pers_id!=0){
                                $salt = Register::randomSalt(64);
                                $data = array(
                                    'pers_id' => $pers_id,
                                    'pid' => $pid,
                                    'password' => Register::hash_pw($password,$salt),
                                    'salt' => $salt
                                );
                                $this->db->insert('app_user', $data);
                                echo json_encode(array('success'=>true,'otpexpire'=>false,'message'=>'ลงทะเบียนเรียบร้อย'));
                            }
                            else{
                                echo json_encode(array('success'=>false,'otpexpire'=>false,'message'=>'พบข้อผิดพลาด'));
                            }
                        }catch (Exception $e){
                            echo json_encode(array('success'=>false,'otpexpire'=>false,'message'=>'พบข้อผิดพลาด'));
                        }
                    }
                    else{
                        echo json_encode(array('success'=>false,'otpexpire'=>false,'message'=>'เลขประจำตัวประชาชนนี้ มีผู้ใช้งานแล้ว'));
                    }
                }else if($verify_otp['code'] == '1'){
                    echo json_encode(array('success'=>false,'otpexpire'=>true,'message'=>$verify_otp['message']));
                }else{
                    echo json_encode(array('success'=>false,'otpexpire'=>false,'message'=>$verify_otp['message']));
                }
            }
            else{
                echo json_encode(array('success'=>false,'otpexpire'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
            }
        }
        else{
            echo json_encode(array('success'=>false,'otpexpire'=>false,'message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน'));
        }
    }
    public function validate() 
    {   
        $pid = $this->input->post("id");
        $laser_id = $this->input->post("laser_id");
        $prefix = $this->input->post("prefix");
        $pers_firstname_th = $this->input->post("name");
        $pers_lastname_th = $this->input->post("lastname");
        $date_of_birth = $this->input->post("birthdate");
        $tel_no = $this->input->post("tel");
        // ตรวจสอบการส่ง field ข้อมูลตามกำหนด
        if(isset($pid) && isset($laser_id) && isset($pers_firstname_th) && isset($pers_lastname_th) 
        && isset($prefix) && isset($date_of_birth) && isset($tel_no)){
            // ตรวจสอบค่าว่างข้อมูล
            if(!empty($pid) && !empty($laser_id) && !empty($pers_firstname_th) && !empty($pers_lastname_th) 
            && !empty($prefix) && !empty($date_of_birth) && !empty($tel_no)){
                $pers_info = $this->has_user($pid);
                // ตรวจสอบการซ้ำกันของผู้ใช้งาน
                if($pers_info == null){
                    // ตรวจสอบข้อมูลกรมการปกครอง
                    $data_token = Register::getToken();
                    if($data_token['status'] == true){
                        $token = $data_token['result'];
                        $data_check = Register::getDataAndCheckDataEGOV($token,$pid,$pers_firstname_th,$pers_lastname_th,$date_of_birth);
                        if($data_check['status'] == true)
                        {
                            echo json_encode(Register::gen_otp($tel_no));
                        }else
                        {
                            echo json_encode(array('success'=>false,'otpreference' => '','token'=>'','message'=>$data_check['message']));
                        }
                    }
                    else{
                        echo json_encode(array('success'=>false,'otpreference' => '','token'=>'','message'=>'เกิดข้อผิดพลาดการยืนยันสิทธิ์ข้อมูลกรมการปกครอง'));
                    }
                }
                else{
                    echo json_encode(array('success'=>false,'otpreference' => '','token'=>'','message'=>'เลขประจำตัวประชาชนนี้ มีผู้ใช้งานแล้ว'));
                }
            }
            else{
                echo json_encode(array('success'=>false,'otpreference' => '','token'=>'','message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
            }
        }
        else{
            echo json_encode(array('success'=>false,'otpreference' => '','token'=>'','message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน'));
        }
    }
  
    public function change_password() 
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $headers = apache_request_headers();
            if(!isset($headers["Authorization"])){
                $token = $this->input->post("token");
            }else{
                list($type, $token) = explode(" ",$headers["Authorization"]);
            }
            if(isset($token)){
                $old_password = $this->input->post("old_password"); 
                $new_password = $this->input->post("new_password");
                if(isset($old_password) && isset($new_password)){
                    if(!empty($old_password) && !empty($new_password)){
                        try{
                            $token = JWT::decode($token, ReadTxt::readkey());
                            $pers_id = $token->pers_id;
                            $pid = $token->pid;
                            $this->db->where('pers_id',$pers_id);
                            $result = $this->db->get('app_user')->row();
                            if($result != null){
                                $this->db->where(array('pers_id'=>$pers_id,'password'=>$this->db->escape_str(Register::hash_pw($old_password,$result->salt))));
                                $result_pass = $this->db->get('app_user')->row();
                                if($result_pass != null){
                                    $salt = Register::randomSalt(64);
                                    $this->db->set('salt', $salt)
                                    ->set('password', Register::hash_pw($new_password,$salt))
                                    ->where('pers_id', $pers_id)
                                    ->update('app_user');
                                    echo json_encode(array('success'=>true,'message'=>'ตั้งค่ารหัสผ่านใหม่เรียบร้อย'));
                                }else{
                                    echo json_encode(array('success'=>false,'message'=>'รหัสผ่านเก่าไม่ถูกต้อง'));  
                                }
                            }else{
                                echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูล'));
                            }
                        }catch (Exception $e){
                            echo json_encode(array('success'=>false,'message'=>'พบข้อผิดพลาด'));
                        }
                    }else{
                        echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน'));
                } 
            }else{
                echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
            }
        }
    }

    public function index() 
    {
        $reg_pid = $this->input->post("reg_pid");
        $reg_prefix = $this->input->post("reg_prefix");
        $reg_pers_firstname_th = $this->input->post("reg_name");
        $reg_pers_lastname_th = $this->input->post("reg_lastname");
        $reg_laser_id = $this->input->post("reg_laser_id");
        $reg_date_of_birth = $this->input->post("reg_birthdate");
        $reg_tel_no = $this->input->post("reg_tel");
        $reg_email= $this->input->post("reg_email");

        $pid = $this->input->post("id");
        $laser_id = $this->input->post("laser_id");
        $pers_firstname_th = $this->input->post("name");
        $pers_lastname_th = $this->input->post("lastname");
        $prefix = $this->input->post("prefix");
        $date_of_birth = $this->input->post("birthdate");
        $tel_no = $this->input->post("tel");
        $password = $this->input->post("password");
        $email= $this->input->post("email");

        $addr_home_no = $this->input->post("address_no");
        $addr_moo = $this->input->post("moo");
        $addr_alley = $this->input->post("alley");
        $addr_lane = $this->input->post("soi");
        $addr_road = $this->input->post("road");
        $addr_province_code = $this->input->post("province");
        $addr_amphur_code = $this->input->post("ampur");
        $addr_tambon_code = $this->input->post("tambol");
        $addr_postcode = $this->input->post("postal_code");

        // ตรวจสอบการส่ง field ข้อมูลตามกำหนด
        if(isset($pid) && isset($laser_id) && isset($pers_firstname_th) && isset($pers_lastname_th) 
        && isset($prefix) && isset($date_of_birth) && isset($tel_no) 
        && isset($password) && isset($addr_home_no) && isset($addr_moo) && isset($email)
        && isset($addr_alley) && isset($addr_lane) && isset($addr_road) && isset($addr_province_code) 
        && isset($addr_amphur_code) && isset($addr_tambon_code) && isset($addr_postcode)
        && isset($reg_pid) && isset($reg_prefix) && isset($reg_pers_firstname_th) && isset($reg_pers_lastname_th)
        && isset($reg_laser_id) && isset($reg_date_of_birth) && isset($reg_tel_no) && isset($reg_email)){
            // ตรวจสอบค่าว่างข้อมูล
            if(!empty($pid) && !empty($laser_id) && !empty($pers_firstname_th) && !empty($pers_lastname_th) 
            && !empty($prefix) && !empty($date_of_birth) && !empty($tel_no) && !empty($password) && !empty($addr_province_code)
            && !empty($reg_pid)&& !empty($reg_prefix)&& !empty($reg_pers_firstname_th)&& !empty($reg_pers_lastname_th)
            && !empty($reg_laser_id)&& !empty($reg_date_of_birth)){
                // ตรวจสอบ ตารางผู้ใช้งาน //Table app_user
                $pers_user = $this->has_user($reg_pid);
                if($pers_user == null){
                    try{
                        // ข้อมูลผู้ยื่น
                        $pers_id_reg = 0;
                        $pre_addr_id_reg = 0;
                        // ตรวจสอบตารางบุคคล //Table pers_info
                        $pers_info_reg = $this->has_pers_info($reg_pid);
                        if($pers_info_reg != null){
                            $pers_id_reg = $pers_info_reg->pers_id;
                            $pre_addr_id_reg = (empty($pers_info_reg->$pre_addr_id) || $pers_info_reg->$pre_addr_id == null)? 0 : $pers_info_reg->$pre_addr_id;
                        }else{
                            // เพิ่มข้อมูลบุคคลของผู้ยื่น //Table pers_info
                            $prefix_result = $this->db->query("SELECT * FROM std_prename WHERE prename_th='{$reg_prefix}'")->row(); 
                            $pren_code_reg = ($prefix_result == null)? "" : $prefix_result->pren_code;
                            $data = array(
                                'pid' => $reg_pid,
                                'pers_firstname_th' => $reg_pers_firstname_th,
                                'pers_lastname_th' => $reg_pers_lastname_th,
                                'date_of_birth' => $reg_date_of_birth,
                                'pren_code'  => $pren_code_reg,
                                'tel_no' => $reg_tel_no,
                                'email_addr' => $reg_email,
                                'insert_user_id' => 18,
                                'insert_org_id' => 174,
                                'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s'),
                                'laser_id' => $reg_laser_id
                            );
                            $this->db->insert('pers_info', $data);
                            $pers_id_reg = $this->db->insert_id();
                        }
                        // add in table app_user
                        if($pers_id_reg != 0){
                            $salt = Register::randomSalt(64);
                            $data = array(
                                'pers_id' => $pers_id_reg,
                                'pid' => $reg_pid,
                                'password' => Register::hash_pw($password,$salt),
                                'salt' => $salt
                            );
                            $this->db->insert('app_user', $data);
                        }else{
                            echo json_encode(array('success'=>false,'message'=>'พบข้อผิดพลาด'));
                        }

                        // ข้อมูลผู้สูงอายุ
                        $pers_id = 0;
                        $pre_addr_id = 0;
                        $pers_info = $this->has_pers_info($pid);
                        if($pers_info != null){
                            $pers_id = $pers_info->pers_id;
                            $pre_addr_id = (empty($pers_info->$pre_addr_id) || $pers_info->$pre_addr_id == null)? 0 : $pers_info->$pre_addr_id;
                        }else{  
                            $prefix_result = $this->db->query("SELECT * FROM std_prename WHERE prename_th='{$prefix}'")->row(); 
                            $pren_code = ($prefix_result == null)? "" : $prefix_result->pren_code;
                            $data = array(
                                'pid' => $pid,
                                'pers_firstname_th' => $pers_firstname_th,
                                'pers_lastname_th' => $pers_lastname_th,
                                'date_of_birth' => $date_of_birth,
                                'pren_code'  => $pren_code,
                                'tel_no' => $tel_no,
                                'email_addr' => $email,
                                'insert_user_id' => 18,
                                'insert_org_id' => 174,
                                'insert_datetime' => date_format(new DateTime(), 'Y-m-d H:i:s'),
                                'laser_id' => $laser_id
                            );
                            $this->db->insert('pers_info', $data);
                            $pers_id = $this->db->insert_id();
                        } 
                        // อัพเดทหรือเพิ่มข้อมูลลงตารางที่อยู่บุคคล update or add in table pers_addr
                        if($pre_addr_id == 0){
                            $pers_addr = array(
                                'addr_home_no' => $addr_home_no,
                                'addr_moo' => $addr_moo,
                                'addr_alley' => $addr_alley,
                                'addr_lane' => $addr_lane,
                                'addr_road' => $addr_road,
                                'addr_sub_district' => $addr_tambon_code,
                                'addr_district' => $addr_amphur_code,
                                'addr_province' => $addr_province_code,
                                'addr_zipcode' => $addr_postcode,
                                'insert_datetime' => date_format(new DateTime(),'Y-m-d H:i:s')
                            );
                            $this->db->insert('pers_addr', $pers_addr);
                            $pre_addr_id = $this->db->insert_id();
                        }else{
                            $pers_addr = array(
                                'addr_home_no' => $addr_home_no,
                                'addr_moo' => $addr_moo,
                                'addr_alley' => $addr_alley,
                                'addr_lane' => $addr_lane,
                                'addr_road' => $addr_road,
                                'addr_sub_district' => $addr_tambon_code,
                                'addr_district' => $addr_amphur_code,
                                'addr_province' => $addr_province_code,
                                'addr_zipcode' => $addr_postcode,
                                'update_datetime' => date_format(new DateTime(),'Y-m-d H:i:s')
                            );
                            $this->db->update('pers_addr', $pers_addr,array('addr_id'=>$pre_addr_id));
                        }
                        
                        // Update address in table pers_info
                        $pers_info_update = array('pre_addr_id' => $pre_addr_id);
                        $this->db->update('pers_info',$pers_info_update,array('pers_id'=>$pers_id));

                        // เพิ่มข้อมูลสำหรับ Map ผู้ยื่นคำร้อง กับผู้สูงอายุ
                        $data_user_gold = $this->has_pers_info($pers_id_reg,$reg_pid);
                        if($data_user_gold == null){
                            $data_gold = array(
                                'pers_id' => $pers_id_reg,
                                'pid' => $reg_pid,
                                'pers_id_elderly' =>$pers_id
                            );
                            $this->db->insert('app_user_gold_app_register', $data_gold);
                        }else{
                            $data_gold_update = array('pers_id_elderly' =>$pers_id);
                            $this->db->update('app_user_gold_app_register',$data_gold_update,array('pers_id'=>$pers_id_reg ,'pid' => $reg_pid));
                        }
                        echo json_encode(array('success'=>true,'message'=>'ลงทะเบียนเรียบร้อย'));
                    }catch (Exception $e){
                        echo json_encode(array('success'=>false,'message'=>'พบข้อผิดพลาด'));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'เลขประจำตัวประชาชนนี้ มีผู้ใช้งานแล้ว'));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน'));
        }
    }

    public function forgot_password()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $pid = $this->input->post("id");
            $laser_id = $this->input->post("laser_id");
            $pers_firstname = $this->input->post("name");
            $pers_lastname = $this->input->post("lastname");
            $date_of_birth = $this->input->post("birthdate");
            $tel_no = $this->input->post("tel");
            $password = $this->input->post("password");
            if(isset($pid) && isset($laser_id) 
            && isset($pers_firstname) && isset($pers_lastname) 
            && isset($date_of_birth) && isset($password)){
                if(!empty($pid) && !empty($laser_id) && !empty($pers_lastname)
                && !empty($date_of_birth) && !empty($password) && !empty($pers_firstname)){
                    try{
                        $this->db->where(array('pid'=>$pid));
                        $pers_info = $this->db->get('pers_info')->row();
                        if($pers_info != null){
                            if(($pers_info->pers_firstname_th == $pers_firstname)
                            && ($pers_info->pers_lastname_th == $pers_lastname)){
                                $this->db->where(array('pid'=>$pid));
                                $app_user = $this->db->get('app_user')->row();
                                if($app_user != null){
                                    $salt = Register::randomSalt(64);
                                    $this->db->set('salt', $salt);
                                    $this->db->set('password', Register::hash_pw($password,$salt));
                                    $this->db->where('pers_id', $app_user->pers_id);
                                    $this->db->update('app_user');
                                    echo json_encode(array('success'=>true,'message'=>''));
                                }else{
                                    echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลผู้ใช้งาน กรุณาลงทะเบียน'));
                                }
                            }else{
                                echo json_encode(array('success'=>false,'message'=>'ข้อมูลไม่ตรงกับระบบ กรุณาตรวจสอบข้อมูล'));
                            }
                        }else{
                            echo json_encode(array('success'=>false,'message'=>'ไม่พบข้อมูลในระบบ'));
                        }
                    }catch (Exception $e){
                        echo json_encode(array('success'=>false,'message'=>'พบข้อผิดพลาด'));
                    }
                }else{
                    echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน'));
            }
        }
    }
    

    //------------------------------------------------------------------------

   

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

    private function has_user_gold($pers_id,$pid)
    {
        $this->db->where(array('pers_id'=> $pers_id ,'pid' => $pid));
        return $this->db->get('app_user_gold_app_register')->row();   
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