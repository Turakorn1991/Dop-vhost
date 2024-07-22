<?php

class Migration_update_elderly_care_module_of_volt_info_elderly_care_table extends CI_Migration {

    public function up() {

        $this->dbforge->add_column( 'volt_info_elderly_care' , array(
            'care_talent' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_src_of_income' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_src_of_income_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_relationship' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_relationship_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_community_activity' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_community_activity_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_health_issues' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_health_issues_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_mental_health_issues' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_mental_health_issues_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_social_issues' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_social_issues_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_economy_issues' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_economy_issues_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_elderly_requirement' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_elderly_requirement_specify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),

            'care_assistance_opinion_set' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        ));
    }

    public function down() {

        $this->dbforge->drop_column('volt_info_elderly_care', 'care_talent');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_src_of_income');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_src_of_income_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_relationship');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_relationship_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_community_activity');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_community_activity_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_health_issues');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_health_issues_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_mental_health_issues');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_mental_health_issues_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_social_issues');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_social_issues_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_economy_issues');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_economy_issues_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_elderly_requirement');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_elderly_requirement_specify');
        $this->dbforge->drop_column('volt_info_elderly_care', 'care_assistance_opinion_set');
    }

}