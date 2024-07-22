<?php

class Migration_update_care_prog_acti_id_of_volt_info_care_progress_table extends CI_Migration {

    public function up() {
        $this->dbforge->drop_column('volt_info_care_progress', 'care_prog_acti_id');

        $this->dbforge->add_column( 'volt_info_care_progress' , array(
            'care_prog_acti_id_set' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            )
        ));
    }

    public function down() {
        $this->dbforge->drop_column('volt_info_care_progress', 'care_prog_acti_id_set');

        $this->dbforge->add_column( 'volt_info_care_progress' , array(
            'care_prog_acti_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));

    }

}