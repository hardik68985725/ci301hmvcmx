<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_admin extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'null' => FALSE,
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'admin_name' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255',
            ),
            'admin_email' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255',
            ),
            'admin_password' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255',
            ),
            // 'admin_created_at' => array(
            //     'type' => 'DATETIME',
            //     'null' => TRUE,
            //     'default' => 'CURRENT_TIMESTAMP'
            // ),
        ));
        $this->dbforge->add_field('admin_created_at DATETIME DEFAULT CURRENT_TIMESTAMP');

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_admin', TRUE);


        // add initial data
        $this->load->module('admin');
        $this->load->model('model_admin');
        $this->model_admin->set_admin_name('admin');
        $this->model_admin->set_admin_email('admin@ci301hmvcmx.com');
        $this->model_admin->set_admin_password('admin');
        $this->model_admin->insert_admin();
    }

    public function down() {
        $this->dbforge->drop_table('tbl_admin');
    }
}

?>
