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
        list($type, $token) = explode(" ",$headers["Authorization"]);
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
                    $pers_info = $this->db->get('pers_info')->row();

                    $addr_home_no = "";
                    $addr_moo = "";
                    $addr_alley = "";
                    $addr_road = "";
                    $addr_sub_district = "";
                    $addr_district = "";
                    $province = "";
                    $postal_code = "";

                    if(isset($pers_info->pre_addr_id)){
           
                        $addr_info =$this->db->query(
                        "SELECT pa.addr_home_no, pa.addr_moo, pa.addr_alley, pa.addr_road, sd.area_name_th sub_district, dt.area_name_th district, pv.area_name_th province, pa.addr_zipcode
                            FROM pers_addr as pa
                            LEFT JOIN std_area as sd ON sd.area_code = pa.addr_sub_district
                            LEFT JOIN std_area as dt ON dt.area_code = pa.addr_district
                            LEFT JOIN std_area as pv ON pv.area_code = pa.addr_province
                            WHERE addr_id={$pers_info->pre_addr_id}")->row(); 

                        $addr_home_no = isset($addr_info->addr_home_no)?$addr_info->addr_home_no:"";
                        $addr_moo = isset($addr_info->addr_moo)?$addr_info->addr_moo:"";
                        $addr_alley = isset($addr_info->addr_alley)?$addr_info->addr_alley:"";
                        $addr_road = isset($addr_info->addr_road)?$addr_info->addr_road:"";
                        $addr_sub_district = isset($addr_info->sub_district)?$addr_info->sub_district:"";
                        $addr_district = isset($addr_info->district)?$addr_info->district:"";
                        $province = isset($addr_info->province)?$addr_info->province:"";
                        $postal_code = isset($addr_info->addr_zipcode)?$addr_info->addr_zipcode:"";
                    }

                    if(isset($addr_info->addr_gps))
                        list($latitude, $longitude) = split(".", $addr_info->addr_gps);
                    else{
                        $latitude = "";
                        $longitude = "";
                    }

                    $this->db->where(array('pren_code'=>$pers_info->pren_code));
                    $prefix = $this->db->get('std_prename')->row();

                    $personal_profile = array(
                        'success'=>true,
                        'message'=>"",
                        'id'=>$pers_info->pid,
                        'prefix'=>isset($prefix->prename_th)?$prefix->prename_th:"",
                        'name'=>$pers_info->pers_firstname_th,
                        'lastname'=>$pers_info->pers_lastname_th,
                        'birth_date'=>$this->time_format($pers_info->date_of_birth),
                        'tel'=>$pers_info->tel_no,
                        'pre_addr_id'=>$pers_info->pre_addr_id,
                        'address_no'=>$addr_home_no,
                        'moo'=>$addr_moo,
                        'soi'=>$addr_alley,
                        'road'=>$addr_road,
                        'tambol'=>$addr_sub_district,
                        'ampur'=>$addr_district,
                        'province'=>$province,
                        'postal_code'=>$postal_code,
                        'latitude'=>$latitude,
                        'longitude'=>$longitude                          
                    );
                    echo json_encode($personal_profile);
                }
            }catch (Exception $e){
                echo json_encode(array('success'=>false,'message'=>$e));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ไม่พบการการยืนยันตัวตน กรุณายืนยันตัวตน'));
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

    public function personal_update() //Temp 
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
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // The request is using the POST method
                    $this->db->where(array('pers_id'=>$token->pers_id));
                    $pers_info = $this->db->get('pers_info')->row();
                    
                    //$input = json_decode($this->security->xss_clean($this->input->raw_input_stream));
                    
                    /*Temp*/    
                    $this->db->where(array('area_name_th'=>$this->input->post("province")));
                    $province = $this->db->get('std_area')->row();
                    
                    $this->db->where(array('area_name_th'=>$this->input->post("ampur")));
                    $addr_district = $this->db->get('std_area')->row();

                    $this->db->where(array('area_name_th'=>$this->input->post("tambol")));
                    $addr_sub_district = $this->db->get('std_area')->row();
                    /*Temp*/ 

                    if(isset($pers_info->pre_addr_id)){
                        $pers_addr = array(
                            'addr_home_no'=>$this->input->post("address_no"),
                            'addr_moo'=>$this->input->post("moo"),
                            'addr_alley'=>$this->input->post("soi"),
                            'addr_road'=>$this->input->post("road"),
                            'addr_zipcode'=>$this->input->post("postal_code"),
                            'addr_gps'=>$latitude.".".$longitude,          
                            'addr_sub_district'=>$addr_sub_district->area_code,
                            'addr_district'=>$addr_district->area_code,
                            'addr_province'=>$province->area_code   
                        );
                        //update into pers_addr
                        $this->common_model->update('pers_addr',$pers_addr,array('addr_id'=>$pers_info->pre_addr_id));
                        //update into pers_info
                        $pers_info = array('tel_no'=>$this->input->post("tel"));
                        $this->common_model->update('pers_info',$pers_info,array('pers_id'=>$token->pers_id));

                    }else{
                        if(!isset($pers_info->pre_addr_id)){
                            $pers_addr = array(
                                'addr_home_no'      =>$this->input->post("address_no"),
                                'addr_moo'          =>$this->input->post("moo"),
                                'addr_alley'        =>$this->input->post("soi"),
                                'addr_road'         =>$this->input->post("road"),
                                'addr_sub_district' =>$addr_sub_district->area_code,
                                'addr_district'     =>$addr_district->area_code,
                                'addr_province'     =>$province->area_code,
                                'addr_zipcode'      =>$this->input->post("postal_code"),
                                'addr_gps'          =>$latitude.".".$longitude                          
                            );
                            $this->db->insert('pers_addr', $pers_addr);
                            $addr_id = $this->db->insert_id();

                            $pers_info = array(
                                'pre_addr_id'       =>$addr_id,
                                'tel_no'            =>$this->input->post("tel"),    
                            );
                            $this->common_model->update('pers_info',$pers_info,array('pers_id'=>$token->pers_id));
                            // $this->db->set('pre_addr_id',$addr_id,false);
                            // $this->db->where('pers_id', $pers_info->pers_id);
                            // $this->db->update('pers_info');
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