<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
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

   
    public function personal() 
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
                $this->db->where(array('pers_id'=>$token->pers_id));
                $pers_info = $this->db->get('pers_info')->row();
                if($pers_info != null){
                    $addr_home_no = "";
                    $laser_id = "";
                    $addr_moo = "";
                    $addr_alley = "";
                    $addr_lane = "";
                    $addr_road = "";
                    $addr_sub_district = "";
                    $addr_district = "";
                    $province = "";
                    $addr_sub_district_code = "";
                    $addr_district_code = "";
                    $province_code = "";
                    $postal_code = "";
                    if(isset($pers_info->pre_addr_id)){
                        $addr_info =$this->db->query(
                        "SELECT pa.addr_home_no, pa.addr_moo,pa.addr_gps,pa.addr_sub_district,pa.addr_district,pa.addr_province, pa.addr_alley,pa.addr_lane, pa.addr_road, sd.area_name_th sub_district, dt.area_name_th district, pv.area_name_th province, pa.addr_zipcode
                            FROM pers_addr as pa
                            LEFT JOIN std_area as sd ON sd.area_code = pa.addr_sub_district
                            LEFT JOIN std_area as dt ON dt.area_code = pa.addr_district
                            LEFT JOIN std_area as pv ON pv.area_code = pa.addr_province
                            WHERE addr_id={$pers_info->pre_addr_id}")->row(); 
                        $addr_home_no = isset($addr_info->addr_home_no)?$addr_info->addr_home_no:"";
                        $addr_moo = isset($addr_info->addr_moo)?$addr_info->addr_moo:"";
                        $addr_alley = isset($addr_info->addr_alley)?$addr_info->addr_alley:"";
                        $addr_lane = isset($addr_info->addr_lane)?$addr_info->addr_lane:"";
                        $addr_road = isset($addr_info->addr_road)?$addr_info->addr_road:"";
                        $addr_sub_district = isset($addr_info->sub_district)?$addr_info->sub_district:"";
                        $addr_sub_district_code = $addr_info->addr_sub_district;
                        $addr_district = isset($addr_info->district)?$addr_info->district:"";
                        $addr_district_code = $addr_info->addr_district;
                        $province_code = $addr_info->addr_province;
                        $province = isset($addr_info->province)?$addr_info->province:"";
                        $postal_code = isset($addr_info->addr_zipcode)?$addr_info->addr_zipcode:"";
                    }
                    $latitude = "";
                    $longitude = "";
                    if(isset($addr_info->addr_gps))
                        list($latitude, $longitude) = explode(",", $addr_info->addr_gps);
                    $this->db->where(array('pren_code'=>$pers_info->pren_code));
                    $prefix = $this->db->get('std_prename')->row();
                    $personal_profile = array(
                        'success'=>true,
                        'message'=>"",
                        'id'=>$pers_info->pid,
                        'laser_id' => empty($pers_info->laser_id)?"" : $pers_info->laser_id,
                        'prefix'=>isset($prefix->prename_th)?$prefix->prename_th:"",
                        'name'=>$pers_info->pers_firstname_th,
                        'lastname'=>$pers_info->pers_lastname_th,
                        'birth_date'=>$this->time_format($pers_info->date_of_birth),
                        'tel'=>$pers_info->tel_no,
                        'pre_addr_id'=>$pers_info->pre_addr_id,
                        'address_no'=>$addr_home_no,
                        'moo'=>$addr_moo,
                        'alley' =>$addr_alley,
                        'soi'=>$addr_lane,
                        'road'=>$addr_road,
                        'tambol'=>$addr_sub_district,
                        'tambol_code'=>$addr_sub_district_code,
                        'ampur'=>$addr_district,
                        'ampur_code'=>$addr_district_code,
                        'province'=>$province,
                        'province_code'=>$province_code,
                        'postal_code'=>$postal_code,
                        'latitude'=>$latitude,
                        'longitude'=>$longitude                          
                    );
                    echo json_encode($personal_profile);
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

     public function personal_update()
    {
        // The request is using the POST method
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $headers = apache_request_headers();
            if(!isset($headers["Authorization"])){
                $token = $this->input->post("token");
            }else{
                list($type, $token) = explode(" ",$headers["Authorization"]);
            }
            if(isset($token)){
                $tel_no = $this->input->post("tel");
                $addr_home_no = $this->input->post("address_no");
                $addr_moo = $this->input->post("moo");
                $addr_alley = $this->input->post("alley");
                $addr_lane = $this->input->post("soi");
                $addr_road = $this->input->post("road");
                $addr_province_code = $this->input->post("province");
                $addr_amphur_code = $this->input->post("ampur");
                $addr_tambon_code = $this->input->post("tambol");
                $addr_postcode = $this->input->post("postal_code");
                $addr_latitude = $this->input->post("latitude");
                $addr_longitude = $this->input->post("longitude");
                // ตรวจสอบการส่ง field ข้อมูลตามกำหนด
                if(isset($tel_no) && isset($addr_home_no) && isset($addr_moo) && isset($addr_alley)
                && isset($addr_lane) && isset($addr_road) && isset($addr_province_code) && isset($addr_amphur_code)
                && isset($addr_tambon_code) && isset($addr_postcode) && isset($addr_latitude) && isset($addr_longitude)){
                    // ตรวจสอบค่าว่างข้อมูล
                    if(!empty($tel_no) && !empty($addr_province_code)){
                        try{
                            $token = JWT::decode($token, ReadTxt::readkey());
                            $this->db->where(array('pers_id'=>$token->pers_id));
                            $pers_info = $this->db->get('pers_info')->row();
                            $pre_addr_id = $pers_info->pre_addr_id;
                            if($pers_info != null){
                                $addr_gps =  (empty($addr_latitude) && empty($addr_longitude))? "" : ($addr_latitude.",".$addr_longitude);  
                                //update or insert into pers_addr
                                if(isset($pre_addr_id)){
                                    //update into pers_addr
                                    $pers_addr_update = array(
                                        'addr_home_no' => $addr_home_no,
                                        'addr_moo' => $addr_moo,
                                        'addr_alley' => $addr_alley,
                                        'addr_lane' => $addr_lane,
                                        'addr_road' => $addr_road,
                                        'addr_sub_district' => $addr_tambon_code,
                                        'addr_district' => $addr_amphur_code,
                                        'addr_province' => $addr_province_code,
                                        'addr_zipcode' => $addr_postcode,
                                        'addr_gps' => $addr_gps,
                                        'update_datetime' => date_format(new DateTime(),'Y-m-d H:i:s')
                                    );
                                    $this->db->update('pers_addr', $pers_addr_update,array('addr_id'=>$pre_addr_id));
                                }else{
                                    //insert into pers_addr
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
                                        'addr_gps' => $addr_gps,
                                        'insert_datetime' => date_format(new DateTime(),'Y-m-d H:i:s')
                                    );
                                    $this->db->insert('pers_addr', $pers_addr);
                                    $pre_addr_id = $this->db->insert_id();
                                }
                                //update into pers_info
                                $pers_info_update = array('tel_no'=> $tel_no ,'pre_addr_id'=>$pre_addr_id);
                                $this->db->update('pers_info',$pers_info_update,array('pers_id'=>$pers_info->pers_id));
                                echo json_encode(array('success'=>true,'message'=>'บันทึกข้อมูลเรียบร้อย'));
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
            }else{
                echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
            }
        }
    }

    private function time_format($date){
        list($year,$month,$day) = split("-",$date);
        
        switch($month){
            case "01":
                $month = "มกราคม";
                break;
            case "02":
                $month = "กุมภาพันธ์";
                break;
            case "03":
                $month = "มีนาคม";
                break;
            case "04":
                $month = "เมษายน";
                break;
            case "05":
                $month = "พฤษภาคม";
                break;
            case "06":
                $month = "มิถุนายน";
                break;
            case "07":
                $month = "กรกฎาคม";
                break;
            case "08":
                $month = "สิงหาคม";
                break;
            case "09":
                $month = "กันยายน";
                break;
            case "10":
                $month = "ตุลาคม";
                break;
            case "11":
                $month = "พฤศจิกายน";
                break;
            case "12":
                $month = "ธันวาคม";
                break;
        }
        return str_replace('0', '', $day)." ".$month." ".((int)$year+543);
    }

   
}
?>