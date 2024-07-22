<?php

class Migration_std_local_admin_org extends CI_Migration {

    public function up() {

        $this->dbforge->add_field(array(
            'la_org_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'la_org_title' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'la_org_district' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'la_org_city' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            ),
            'la_org_province' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '256',
                    'null' => TRUE
            )
        ));
        $this->dbforge->add_key('la_org_id', TRUE);
        $this->dbforge->create_table('std_local_admin_org');

        //Not insert data because large data 7,852.
        //Step Export data std_local_admin_org to PHP array
    }

    public function down() {
        // $this->dbforge->drop_table('std_local_admin_org');
    }

}