<?php

class Migration_add_relg_code_to_pers_info_table extends CI_Migration {

    public function up() {
        $this->dbforge->add_column( 'pers_info' , array(
            'relg_code' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            )
        ));
        
    }

    public function down() {
        $this->dbforge->drop_column('pers_info', 'relg_code');

    }

}