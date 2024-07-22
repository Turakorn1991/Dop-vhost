<?php

class Migration_edoe_job_survey extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'job_sur_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'job_sur_title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'job_sur_url' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
            ),
            'job_sur_slug' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'job_sur_status' => array(
                    'type' => "ENUM('Active', 'Inactive')",
                    'default' => 'Inactive',
                    'null' => FALSE
            ),'job_sur_insert_user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_insert_org_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_update_user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_update_org_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'job_sur_insert_datetime' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
            ),
            'job_sur_update_datetime' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
            )
        ));
        $this->dbforge->add_key('job_sur_id', TRUE);
        $this->dbforge->create_table('edoe_job_survey');
    }

    public function down() {
        $this->dbforge->drop_table('edoe_job_survey');
    }

}