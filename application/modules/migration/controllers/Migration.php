<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends MY_Back_End_Controller {

    protected $is_admin_logged_in = FALSE;


    public function __construct() {
        parent::__construct();

        // is_admin_loggedin_for_admin();

        $this->is_admin_logged_in = is_admin_loggedin_for_admin(FALSE);

    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/Main
     *  - or -
     *      http://example.com/index.php/Main/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/Main/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    /*public function _index() {

        if ( $this->is_admin_logged_in == FALSE ) {
            echo 'You are not loggedin. Please, login to <a href="'. my_base_url('admin/') .'">admin</a>.';
        } else {

            $this->load->library('Migration');

            if ( $this->migration->current() === FALSE ) {
                show_error($this->migration->error_string());
            } else {

                // $this->load->module('admin');
                // $this->load->model('model_admin');
                // $this->model_admin->set_admin_name('admin');
                // $this->model_admin->set_admin_email('admin@ci301hmvcmx.com');
                // $this->model_admin->set_admin_password('admin');
                // $this->model_admin->insert_admin();

                echo 'DB Migration process has been done. <a href="'. my_base_url('admin/') .'">Click here</a> to goto admin.';
            }
        }
    }*/


    /**
    *
    */
    function _remap($method, $parameters = array()) {

        if ( !method_exists($this, $method) ) {
            if ( $method == 'index' ) {
                $method = '';
            }
            $this->_index($method);
        } else {
            $this->$method($parameters);
        }
    }



    /**
    *
    */
    public function _index($password = '') {

        if ( $password == '' ) {
            echo 'Error: DB Migration Error.';
        } else {

            $this->load->library('Migration');

            if ( $this->migration->current() === FALSE ) {
                show_error($this->migration->error_string());
            } else {

                // $this->load->module('admin');
                // $this->load->model('model_admin');
                // $this->model_admin->set_admin_name('admin');
                // $this->model_admin->set_admin_email('admin@ci301hmvcmx.com');
                // $this->model_admin->set_admin_password('admin');
                // $this->model_admin->insert_admin();

                echo 'DB Migration process has been done. <a href="'. my_base_url('admin/') .'">Click here</a> to goto admin.';
            }
        }
    }
}
