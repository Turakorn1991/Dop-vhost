<?php

class Migration_std_kpy_org_province extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            // 'org_province_id' => array(
            //     'type' => 'INT',
            //     'constraint' => 11,
            //     'unsigned' => TRUE,
            //     'auto_increment' => TRUE
            // ),
            'org_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'province' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            )
        ));
        $this->dbforge->add_key('org_id', TRUE);
        $this->dbforge->create_table('std_kpy_org_province');
    }

    public function down() {
        $this->dbforge->drop_table('std_kpy_org_province');
    }

}