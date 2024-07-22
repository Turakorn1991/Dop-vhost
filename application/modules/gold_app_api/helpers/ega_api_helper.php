<?php
class EGA_API {

    private static $verify_url = "https://ws.ega.or.th/ws/dopa/verification/personal";
    private static $authen_url = "https://ws.ega.or.th/ws/auth/validate";
    private static $token;
    function __construct() {
        parent::__construct();
        $this->load->database('default');
    }

    private function Authentication($ConsumerSecret,$AgentID)
    {
        $url = self::$authen_url;
        $url = $url."?ConsumerSecret=".$ConsumerSecret;
        $url = $url."&AgentID=".$AgentID;

        $auth_headers = [
            'Cache-Control: no-cache',
            'Consumer-Key: ',
        ];
        $handle=curl_init($url);
        curl_setopt($handle, CURLOPT_VERBOSE, true);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($handle);
        $http_status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($http_status==200){
            $result = json_decode($response);
            self::$token = array();
            self::$token['key'] = $result->Result;
            self::$token['time'] = new DateTime();
        }else{
            self::$token = "";
        }
        

    }

    public function VerifyCitizenIDCard($CitizenID,$NameTitleCode,$FirstName,$LastName,$BEBirthDate,$LaserCode){
        if(isset($headers)){
            if($CitizenID != '' && $NameTitleCode != ''&& $FirstName != '' && $LastName !='' && $BEBirthDate !='' && $LaserCode !='') {
                $url = self::$verify_url;
                $url = $url."?CitizenID=".$CitizenID;
                $url = $url."&FirstName=".$FirstName;
                $url = $url."&LastName=".$LastName;
                $url = $url."&BEBirthDate=".$BEBirthDate;
                $url = $url."&LaserCode=".$LaserCode;

                $verify_headers = [
                    'Cache-Control: no-cache',
                    'Content-Type: application/x-www-form-urlencoded',
                    'Consumer-Key: ',
                    'Token: '.$token->key,
                ];

                $handle=curl_init($url);
                curl_setopt($handle, CURLOPT_VERBOSE, true);
                curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($handle, CURLOPT_HTTPHEADER, $verify_headers);
                $response = curl_exec($handle);
                $http_status = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                if($http_status==200 && $response){
                    curl_close($handle);
                    return array('message'=>'พบข้อมูลในทะเบียนราษฎร์','code'=>'200');
                }else if($http_status==200){
                    $msg = array('message'=>'ไม่พบข้อมูลในทะเบียนราษฎร์','code'=>'404');
                    curl_close($handle);
                    return $msg;
                }else if($http_status==500){
                    $msg = array('message'=>$response,'code'=>'500');
                    curl_close($handle);
                    return $msg;
                }            
            }else{
                $msg = array('message'=>'BAD_REQUEST','code'=>'400');
                return $msg;
            }
        }else{
            $msg = array('message'=>'UNAUTHORIZED','code'=>'401');
            return $msg;
        }
    }
}
?>