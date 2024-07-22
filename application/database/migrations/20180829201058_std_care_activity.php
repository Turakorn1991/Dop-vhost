<?php

class Migration_std_care_activity extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'care_acti_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'care_acti_code' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'care_acti_title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'care_acti_status' => array(
                    'type' => "ENUM('Active', 'Inactive')",
                    'default' => 'Inactive',
                    'null' => FALSE
            ),
            'care_acti_insert_datetime' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
            ),
            'care_acti_update_datetime' => array(
                    'type' => 'DATETIME',
                    'null' => TRUE
            )
        ));
        $this->dbforge->add_key('care_acti_id', TRUE);
        $this->dbforge->create_table('std_care_activity');
    }

    public function down() {
        $this->dbforge->drop_table('std_care_activity');
    }

}