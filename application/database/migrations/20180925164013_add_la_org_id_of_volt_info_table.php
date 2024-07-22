<?php

class Migration_add_la_org_id_of_volt_info_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_column( 'volt_info' , array(
            'la_org_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            )
        ));
    }

    public function down() {
        $this->dbforge->drop_column('volt_info', 'la_org_id');
    }

}