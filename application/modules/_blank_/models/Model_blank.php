<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_blank extends MY_Model {

    protected $id;
    protected $user_name;
    protected $user_email;
    protected $user_password;

    public function __construct() {
        // Call the H_Model constructor
        parent::__construct();

        $this->load->database();
    }

    // CRUD Methods
    public function insert_admin() {
        if ( empty($this->file_gd_id) ) {
            // Do not insert

            echo 'Do not insert';
        } else {
            // Insert task here

            $this->db->set( $this->get_object_in_array($this) )
                ->insert('tbl_admin');
        }
    }

    public function select_admin($array_select = array('*')) {
        // echo $this->db->select( $this->get_object_in_array($this) )->get_compiled_select('tbl_gd_file');

        // echo $this->db->select( $array_select )
        //     ->where( $this->get_object_in_array($this) )
        //     ->get_compiled_select('tbl_gd_file');

        $this->db->select( $array_select )
            ->where( $this->get_object_in_array($this) );

        $query = $this->db->get('tbl_admin');
        // return $query->result_array();
        return $query->result_object();
    }

    public function update_admin() {
        // if ( empty($this->file_gd_id) ) {
        if ( empty($this->file_id) ) {
            // Do not update

            echo 'Do not update';
        } else {
            // Update task here

            $this->db->where(array('file_id'=>$this->file_id));
            $this->db->set( $this->get_object_in_array($this) )
                ->update('tbl_admin');
        }
    }

    public function delete_admin() {
        if ( empty($this->file_id) ) {
            // Do not delete

            echo 'Do not delete';
        } else {
            // Delete task here

            $this->db->where(array('file_id'=>$this->file_id));
            $this->db->set( $this->get_object_in_array($this) )
                ->delete('tbl_admin');

        }
    }
    // CRUD Methods


    // Other Methods

    public function select_admin_login() {
        $this->db->select( '*' )
            ->where( $this->get_object_in_array($this) );

        $query = $this->db->get('tbl_admin');
        return $query->result_object();
    }

    // Other Methods
}
