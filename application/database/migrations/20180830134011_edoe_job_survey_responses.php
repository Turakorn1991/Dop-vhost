<?php

class Migration_edoe_job_survey_responses extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'job_sur_res_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'job_sur_res_organization_type' => array(
                    'type' => "ENUM('เอกชน', 'รัฐบาล')",
                    'null' => TRUE
            ),
            'job_sur_res_organization_name' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'job_sur_res_already_employed' => array(
                    'type' => "ENUM('Yes', 'No')",
                    'null' => TRUE
            ),
            'job_sur_res_employed_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_male_employed_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_female_employed_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_age_60_to_65_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_age_66_to_70_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_age_71_to_75_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_age_greater_than_76_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_not_educated_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_primary_school_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_secondary_school_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_vocational_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_bachelor_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_master_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_phd_num' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_res_education_spicify' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_work_hours' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_work_description' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_employment_payment_type_set' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_employment_policy' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_employment_purpose' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_suggestion' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_prename' => array(
                'type' => "ENUM('นาย', 'นาง','นางสาว')",
                'null' => TRUE
            ),
            'job_sur_res_firstname' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_lastname' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_tel' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_mobile_tel' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_email' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            ),
            'job_sur_res_insert_datetime' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
            )

        ));
        $this->dbforge->add_key('job_sur_res_id', TRUE);
        $this->dbforge->create_table('edoe_job_survey_responses');
    }

    public function down() {
        $this->dbforge->drop_table('edoe_job_survey_responses');
    }

}