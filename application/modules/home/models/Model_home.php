<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_home extends MY_Model {

    private $tbl_name = 'tbl_page_home';

    protected $id;
    protected $element_name;
    protected $element_label;
    protected $element_content;


    public function __construct() {
        // Call the MY_Model constructor
        parent::__construct();

        $this->load->database();
    }

    // CRUD Methods
    public function insert_home() {
        if ( !empty($this->id) ) {
            // Do not insert

            echo 'Do not insert';
        } else {
            // Insert task here

            $this->db->set( $this->get_object_in_array($this) )
                ->insert($this->tbl_name);
        }
    }

    public function select_home($array_select = array('*')) {

        $this->db
            ->select( $array_select )
            ->where( $this->get_object_in_array($this) );

        $query = $this->db->get($this->tbl_name);

        // return $query->result_array();
        return $query->result_object();
    }

    public function select_home_data($row_name) {

        $this->set_element_name($row_name);
        $data_home_page = $this->select_home();
        $data_home_page = $data_home_page[0];

        // data_print($data_home_page);
        // data_print($data_home_page->element_content);
        $data_home_page->element_content = json_decode($data_home_page->element_content);

        return $data_home_page;
    }

    public function update_home() {
        if ( empty($this->id) ) {
            // Do not update

            echo 'Do not update';
        } else {
            // Update task here

            data_print($this->id);

            $this->db->where(array('id' => $this->id));
            $this->db->set($this->get_object_in_array($this))
                ->update($this->tbl_name);
        }
    }
    // Other Methods
}
