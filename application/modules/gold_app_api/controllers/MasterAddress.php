<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterAddress extends CI_Controller
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

    public function provice(){
        try{
            $mysql_query = "select area_code,area_name_th 
                            from std_area 
                            where area_type = 'province' 
                            and area_name_th NOT LIKE '%*' 
                            order by area_name_th asc " ;
            $query = $this->db->query($mysql_query);
            $data = $query->result_array();
            echo json_encode(array('success'=>true,'message'=>'' ,'result' => $data));
        }catch (Exception $e){
            echo json_encode(array('success'=>false,'message'=>$e ,'result' => array()));
        }
    }
    
    public function amphur(){
        $province_code = $this->input->get("code");
        if(isset($province_code)){
            if(!empty($province_code)){
                try{
                    $mysql_query = "select area_code,area_name_th 
                                    from std_area 
                                    where area_type = 'Amphur'
                                    and area_name_th NOT LIKE '%*'
                                    and SUBSTR(area_code,1,2) = SUBSTR('{$province_code}',1,2) 
                                    order by area_name_th asc " ;
                    $query = $this->db->query($mysql_query);
                    $data = $query->result_array();
                    echo json_encode(array('success'=>true,'message'=>'' ,'result' => $data));
                }catch (Exception $e){
                    echo json_encode(array('success'=>false,'message'=>$e));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน'));
        }
    }

    public function tambon(){
        $amphur_code = $this->input->get("code");
        if(isset($amphur_code)){
            if(!empty($amphur_code)){
                try{
                    $mysql_query = "select area_code,area_name_th 
                                    from std_area 
                                    where area_type = 'Tambon'
                                    and area_name_th NOT LIKE '%*'
                                    and SUBSTR(area_code,1,4) = SUBSTR('{$amphur_code}',1,4) 
                                    order by area_name_th asc " ;
                    $query = $this->db->query($mysql_query);
                    $data = $query->result_array();
                    echo json_encode(array('success'=>true,'message'=>'' ,'result' => $data));
                }catch (Exception $e){
                    echo json_encode(array('success'=>false,'message'=>$e));
                }
            }else{
                echo json_encode(array('success'=>false,'message'=>'ข้อมูลที่จำเป็นไม่ครบถ้วน'));
            }
        }else{
            echo json_encode(array('success'=>false,'message'=>'ฟิลด์ข้อมูลส่งมาไม่ครบถ้วน'));
        }
    }
}
?>