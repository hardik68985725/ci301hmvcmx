<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blank extends MY_Back_End_Controller {

    public function __construct() {
        parent::__construct();

        is_admin_loggedin_for_admin();
        // is_admin_loggedin_for_login();
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
    public function index() {
        // $this->load->view('index');
    }
}
