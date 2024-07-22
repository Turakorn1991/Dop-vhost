<?php

class Migration_volt_info extends CI_Migration {

    public function up() {
        $this->dbforge->add_column( 'volt_info' ,array(
            'date_of_resign' => array(
                'type' => 'DATE',
                'null' => TRUE
            )
        ));

        $this->dbforge->add_column( 'volt_info' ,array(
            'resign_reason' => array(
                'type' => 'VARCHAR',
                'constraint' => '256',
                'null' => TRUE
            )
        ));
    }

    public function down() {
        $this->dbforge->drop_column('volt_info', 'date_of_resign');
        $this->dbforge->drop_column('volt_info', 'resign_reason');
    }

}