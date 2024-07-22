<?php

class Migration_add_survey_list_menu_of_usrm_application_table extends CI_Migration {

    public function up() {
        
        //Fix app_id 174 for menu list
        $this->db->insert('usrm_application', array(
            // 'app_id' => 174,
            'app_parent_id' => 63,
            'app_name' => 'แบบสำรวจการจ้างงานผู้สูงอายุ',
            'app_sort' => 22.5,
            'app_status' => 'Active',
            'app_link' => 'https://center.dop.go.th/jobs/survey_list',
            'app_code' => '090300'
        ));
    }

    public function down() {
        $this->db->delete('usrm_application', array('app_sort' => '22.5')); 
    }

}