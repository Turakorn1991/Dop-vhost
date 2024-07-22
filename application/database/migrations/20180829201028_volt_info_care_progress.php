<?php

class Migration_volt_info_care_progress extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'care_prog_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'care_prog_acti_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'care_prog_volt_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'care_prog_pers_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'care_prog_care_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
            'care_prog_specify' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'care_prog_status' => array(
                    'type' => "ENUM('Active', 'Inactive')",
                    'default' => 'Inactive',
                    'null' => FALSE
            ),
            'care_prog_insert_user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'care_prog_insert_org_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'care_prog_update_user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'care_prog_update_org_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ),
            'care_prog_insert_datetime' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
            ),
            'care_prog_update_datetime' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
            )
        ));
        $this->dbforge->add_key('care_prog_id', TRUE);
        $this->dbforge->create_table('volt_info_care_progress');
    }

    public function down() {
        $this->dbforge->drop_table('volt_info_care_progress');
    }

}