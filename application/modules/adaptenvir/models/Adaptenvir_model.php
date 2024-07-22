<?php
	class Adaptenvir_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function getAll_impvHome(){
            return $this->common_model->custom_query("
                SELECT * FROM impv_home_info 
                WHERE delete_user_id IS NULL 
                AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
                ORDER BY update_datetime DESC,insert_datetime DESC
                -- LIMIT 0,100
            ");
        }

        public function getOnce_impvHome($imp_home_id = 0){
            if($imp_home_id == 0){
                return array();
            }
            return rowArray($this->common_model->custom_query("
                SELECT * FROM impv_home_info 
                WHERE imp_home_id = {$imp_home_id} 
                AND delete_user_id IS NULL 
                AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
            "));
        }

        public function get_homeCondition($imp_home_id = 0){
            if($imp_home_id == 0){
                return array();
            }
            $trm_condi = $this->common_model->custom_query("
                SELECT * FROM impv_home_condition 
                WHERE impv_home_id = {$imp_home_id}
            ");
            return sort_array_with($trm_condi,"hcond_code");
        }
        public function get_impvInfo($imp_home_id){
            return rowArray($this->common_model->get_where_custom('impv_home_info', 'imp_home_id', $imp_home_id));
        }
        public function get_img($imp_home_id = 0){
            return $this->common_model->custom_query("SELECT * FROM impv_home_info_photo WHERE impv_home_id = {$imp_home_id}");

        }
        public function getOrg($id=''){
            return rowArray($this->common_model->get_where_custom('usrm_org', 'org_id', $id));
        
        }
        public function getUsrm($id=''){
            return rowArray($this->common_model->get_where_custom('usrm_user', 'user_id', $id));
        
        }
        public function getAll_reqChanel() {
            return $this->common_model->getTableOrder('std_req_channel', 'chn_id', 'ASC');
        }        

        public function getOnce_reqChanel($chn_code='') {
            return rowArray($this->common_model->get_where_custom('std_req_channel', 'chn_code', $chn_code));
        } 

        public function get_img_place($imp_home_id = 0){
            return $this->common_model->custom_query("SELECT * FROM impv_place_info_photo WHERE impv_place_id = {$imp_home_id}");

        }

        public function getAll_impvPlace(){
            return $this->common_model->custom_query("
                SELECT * FROM impv_place_info AS A 
                LEFT JOIN std_place_type AS B ON A.ptype_code = B.ptype_code
                WHERE delete_user_id IS NULL 
                AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
                ORDER BY update_datetime DESC,insert_datetime DESC
                -- LIMIT 0,100
            ");
        }

        public function getOnce_impvPlace($impv_place_id = 0){
            if($impv_place_id == 0){
                return array();
            }
            return rowArray($this->common_model->custom_query("
                SELECT * FROM impv_place_info 
                WHERE impv_place_id = {$impv_place_id} 
                AND delete_user_id IS NULL 
                AND (delete_datetime IS NULL || delete_datetime = '0000-00-00 00:00:00')
            "));
        }

        public function get_placeCondition($impv_place_id = 0){
            if($impv_place_id == 0){
                return array();
            }
            $trm_condi = $this->common_model->custom_query("
                SELECT * FROM impv_place_condition 
                WHERE impv_place_id = {$impv_place_id}
            ");
            return sort_array_with($trm_condi,"hcond_code");
        }

        public function getAreaID($type , $name){
        
            return rowArray($this->common_model->custom_query("SELECT * FROM std_area 
                WHERE area_type = '$type'
                AND area_name_th = '$name' "
                )
            );
            
        }

        


    }
?>