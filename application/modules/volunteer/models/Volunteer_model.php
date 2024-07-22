<?php
	class Volunteer_model extends CI_Model {

        function __construct() {
            parent::__construct();
        }

        public function get_id($id){
            return $this->common_model->from('volt_info')
                                        ->where('volt_id', $id)
                                        ->get()
                                        ->row_array();
        }

        public function get_pers_id($id){
            return $this->common_model->from('volt_info')
                                        ->where('pers_id', $id)
                                        ->get()
                                        ->row_array();
        }

        public function get_village_position($id){
            return $this->common_model->from('volt_info_village_position')
                                        ->where('volt_id', $id)
                                        ->get()
                                        ->result_array(); 
        }

        public function get_training($id){
            return $this->common_model->from('volt_info_training')
                                        ->where('volt_id', $id)
                                        ->get()
                                        ->result_array(); 
        }

        public function elderly_care($id){
            return $this->common_model->from('volt_info_elderly_care')
                                        ->join('pers_info', 'volt_info_elderly_care.pers_id = pers_info.pers_id', 'left')
                                        ->join('std_prename', 'pers_info.pren_code = std_prename.pren_code', 'left')
                                        ->where('volt_id', $id)
                                        ->get()
                                        ->result_array(); 
        }
        
        public function care_progress($id){
            return $this->common_model->from('volt_info_care_progress')
                                        ->join('pers_info', 'volt_info_care_progress.care_prog_pers_id = pers_info.pers_id', 'left')
                                        ->where('care_prog_volt_id', $id)
                                        ->where('care_prog_status', "Active")
                                        ->get()
                                        ->result_array(); 
        }

        public function get_cause_of_care(){
            return $this->common_model->from('std_cause_of_care')
                                        ->get()
                                        ->result_array(); 
        }

        public function get_care_activity(){
            return $this->common_model->from('std_care_activity')
                                        ->get()
                                        ->result_array(); 
        }

        public function get_edu_level(){
            return $this->common_model->from('std_edu_level')
                                        ->get()
                                        ->result_array(); 
        }

        



        public function getAll_diffInfo() {
/*            return $this->common_model->custom_query("select A.*,B.*,C.*,D.*,E.*,F.*,G.*,CONCAT(B.pers_firstname_th, ' ', B.pers_lastname_th) as name 
                from diff_info as A 
                                    left join pers_info as B       on A.pers_id=B.pers_id 
                                    left join std_prename as C     on B.pren_code=C.pren_code 
                                    left join std_gender as D      on B.gender_code=D.gender_code 
                                    left join std_nationality as E on B.nation_code=E.nation_code 
                                    left join std_religion as F    on B.relg_code=F.relg_code 
                                    left join std_edu_level as G    on B.edu_code=G.edu_code 
                                     
                where (A.delete_user_id IS NULL && A.delete_datetime IS NULL) and
                      (B.delete_user_id IS NULL && B.delete_datetime IS NULL) 
                order by A.insert_datetime DESC,
                         A.update_datetime DESC");*/
            return $this->common_model->custom_query("select A.*,B.*,C.*,D.*,E.*,G.*,CONCAT(B.pers_firstname_th, ' ', B.pers_lastname_th) as name 
                from diff_info as A 
                                    left join pers_info as B       on A.pers_id=B.pers_id 
                                    left join std_prename as C     on B.pren_code=C.pren_code 
                                    left join std_gender as D      on B.gender_code=D.gender_code 
                                    left join std_nationality as E on B.nation_code=E.nation_code 
                                    left join std_edu_level as G    on B.edu_code=G.edu_code 
                                     
                where (A.delete_user_id IS NULL && A.delete_datetime IS NULL) and
                      (B.delete_user_id IS NULL && B.delete_datetime IS NULL) 
                order by A.insert_datetime DESC,
                         A.update_datetime DESC");

        }

        /*
        public function getAll_diffInfo_forSumary() {
            return $this->common_model->custom_query("select diff_id,pers_id,CONCAT(elder_firstname, ' ', elder_lastname) as name, date_of_visit,visitor_name,consi_result,req_pers_id,req_trouble,CONCAT(req_firstname, ' ', elder_lastname) as req_name,date_of_req,visit_alm_trouble,visit_alm_help from diff_info where (delete_user_id IS NULL && delete_datetime IS NULL) order by insert_datetime DESC,update_datetime DESC");
        }
        */

        public function getOnce_diffInfo($diff_id=0) {
/*            return rowArray($this->common_model->custom_query("select A.*,B.*,C.*,D.*,E.*,F.*,G.*,CONCAT(B.pers_firstname_th, ' ', B.pers_lastname_th) as name 
                from diff_info as A 
                                    left join pers_info as B       on A.pers_id=B.pers_id 
                                    left join std_prename as C     on B.pren_code=C.pren_code 
                                    left join std_gender as D      on B.gender_code=D.gender_code 
                                    left join std_nationality as E on B.nation_code=E.nation_code 
                                    left join std_religion as F    on B.relg_code=F.relg_code 
                                    left join std_edu_level as G    on B.edu_code=G.edu_code 
                                     
                where (A.delete_user_id IS NULL && A.delete_datetime IS NULL) and
                      (B.delete_user_id IS NULL && B.delete_datetime IS NULL) 
                      and diff_id={$diff_id}
                "));*/
            return rowArray($this->common_model->custom_query("select A.*,B.*,C.*,D.*,E.*,G.*,CONCAT(B.pers_firstname_th, ' ', B.pers_lastname_th) as name 
                from diff_info as A 
                                    left join pers_info as B       on A.pers_id=B.pers_id 
                                    left join std_prename as C     on B.pren_code=C.pren_code 
                                    left join std_gender as D      on B.gender_code=D.gender_code 
                                    left join std_nationality as E on B.nation_code=E.nation_code 
                                    left join std_edu_level as G    on B.edu_code=G.edu_code 
                                     
                where (A.delete_user_id IS NULL && A.delete_datetime IS NULL) and
                      (B.delete_user_id IS NULL && B.delete_datetime IS NULL) 
                      and diff_id={$diff_id}
                "));

        }

        public function get_diffTrouble($diff_id='') {
            $tmp = array();
            $tmp = $this->common_model->get_where_custom('diff_trouble', 'diff_id', $diff_id);
            $tmp = sort_array_with($tmp,'trb_code');
            return $tmp;
        }
        public function get_diffHelp($diff_id='') {
            $tmp = array();
            $tmp = $this->common_model->get_where_custom('diff_help', 'diff_id', $diff_id);
            $tmp = sort_array_with($tmp,'help_code');
            return $tmp;
        }
        public function get_diffHelpGuide($diff_id='') {
            $tmp = array();
            $tmp = $this->common_model->get_where_custom('diff_help_guide', 'diff_id', $diff_id);
            $tmp = sort_array_with($tmp,'help_guide_code');
            return $tmp;
        }

/*        public function getOnce_diffInfo($diff_id=0) {
            return rowArray($this->common_model->get_where_custom('diff_info', 'diff_id', $diff_id));
        }
*/

        public function getAll_reqChanel() {
            return $this->common_model->getTableOrder('std_req_channel', 'chn_id', 'ASC');
        }        

        public function getOnce_reqChanel($chn_code='') {
            return rowArray($this->common_model->get_where_custom('std_edu_level', 'chn_code', $chn_code));
        }

        public function getone_elderly_care($pers_id=0){
            return rowArray($this->common_model->query("SELECT * FROM pers_info WHERE pers_id = {$pers_id}"));
            //return $pers_id;
        }

		public function get_cachedLAOrg() {
			$this->db->cache_on();
			$query = $this->db->query("SELECT * FROM std_local_admin_org");
			$this->db->cache_off();
			return $query->result_array();
		}

		public function clear_cache() {
			$this->db->cache_delete_all();
		}

    }
?>