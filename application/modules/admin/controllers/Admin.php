<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Back_End_Controller {

    protected $is_admin_logged_in = FALSE;

    public function __construct() {
        parent::__construct();

        $this->is_admin_logged_in = is_admin_loggedin_for_admin(FALSE);
        // $this->is_admin_logged_in = TRUE;
        // is_admin_loggedin_for_login();

        $this->load->helper('form');

        $this->load->module('Template');
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
        if ( $this->is_admin_logged_in == FALSE ) {
            redirect_to_admin_login();
        }

        // echo "Admin";
        $extra_data = array(
            'admin_login_details' => $this->_get_loggedin_admin_details()
        );

        //
        $this->template->model_template->set_title('Dashboard');
        $this->template->model_template->set_content_view('admin/view_admin');
        $this->template->model_template->set_other_views(array(
            'navigation_admin' => 'backend/admin/navigation_admin',
        ));
        $this->template->model_template->set_extra_data($extra_data);
        $this->template->template_admin();
    }

    /**
    *
    */
    public function login() {
        if ( $this->is_admin_logged_in == TRUE ) {
            redirect_to_admin_main();
        }

        // echo "Login";

        //
        $this->template->model_template->set_title('Admin Login');
        $this->template->template_login();
    }

    /**
    *
    */
    public function login_process() {
        if ( $this->is_admin_logged_in == TRUE ) {
            redirect_to_admin_main();
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|callback__check_admin_login' );

        if ( $this->form_validation->run($this) == TRUE ) {
            redirect_to_admin_main();
        } else {
            $this->session->set_flashdata('fd_msg_login_error', validation_errors());

            $this->template->model_template->set_title('Admin Login');
            $this->template->template_login();
        }
    }
    public function _check_admin_login() {
        $this->load->model('model_admin');
        $this->model_admin->set_admin_email($this->input->post('email'));
        $this->model_admin->set_admin_password($this->input->post('password'));
        $admin_login = $this->model_admin->select_admin_login();

        if ( empty($admin_login) ) {
            $this->form_validation->set_message('_check_admin_login', 'Email Or Password is invalid.');

            return FALSE;
        } else {
            $array_admin_login_details = array(
                'admin_login_details' => $admin_login
                ,'is_admin_loggedin' => TRUE
            );
            $this->session->set_userdata($array_admin_login_details);
            return TRUE;
        }
    }

    /**
    *
    */
    public function logout_process() {
        $this->session->sess_destroy();
        redirect_to_admin_login();
    }

    /**
    *
    */
    public function admin_profile() {
        if ( $this->is_admin_logged_in == FALSE ) {
            redirect_to_admin_login();
        }

        $this->template->model_template->set_title('profile');
        // $this->template->model_template->set_custom_styles(array('style_profile' => '<link rel="stylesheet" type="text/css" href="'. assets_url('admin/css/style_profile.css') .'" />'));
        $this->template->model_template->set_content_view('admin/view_admin_profile');
        $this->template->model_template->set_other_views(array(
            'navigation_admin' => 'backend/admin/navigation_admin',
        ));
        $extra_data = array(
            'admin_login_details' => $this->_get_loggedin_admin_details(),
            'admin_action' => 'profile'
        );
        $this->template->model_template->set_extra_data($extra_data);
        $this->template->template_admin();
    }

    /**
    *
    */
    public function admin_profile_process() {
        if ( $this->is_admin_logged_in == FALSE ) {
            redirect_to_admin_login();
        }

        $this->template->model_template->set_title('profile');
        $this->template->model_template->set_custom_styles(array('style_profile' => '<link rel="stylesheet" type="text/css" href="'. assets_url('admin/css/style_profile.css') .'" />'));
        $this->template->model_template->set_content_view('admin/view_admin_profile');
        $this->template->model_template->set_other_views(array(
            'navigation_admin' => 'backend/admin/navigation_admin',
        ));


        $this->load->library('form_validation');
        $this->form_validation->set_rules('admin_name', 'Admin Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback__check_password');
        $this->form_validation->set_rules('new_password', 'New Password', 'trim|matches[confirm_new_password]');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'trim|matches[new_password]');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ( $this->form_validation->run($this) == FALSE ) {

            $extra_data = array(
                'admin_login_details' => $this->_get_loggedin_admin_details(),
                'admin_action' => 'profile'
            );
            $this->template->model_template->set_extra_data($extra_data);
            $this->template->template_admin();

        } else {

            if( empty($this->input->post('new_password')) ){
                $admin_password = trim( $this->input->post('password') );
            } else {
                $admin_password = trim( $this->input->post('new_password') );
            }

            $this->load->model('model_admin');
            $this->model_admin
                ->set_id($this->_get_loggedin_admin_details()->id)
                ->set_admin_name($this->input->post('admin_name'))
                ->set_admin_email($this->input->post('email'))
                ->set_admin_password($admin_password)
                ->update_admin();

            $this->session->set_flashdata('admin_profile_process_success', 'user profile is updated successfully.');

            redirect('admin/admin_profile');
        }
    }
    public function _check_password() {
        $this->load->model('model_admin');
        $this->model_admin->set_id($this->_get_loggedin_admin_details()->id);
        $this->model_admin->set_admin_password($this->input->post('password'));
        $is_password_right = $this->model_admin->select_admin(array('id'));

        $this->form_validation->set_message('_check_password', 'Password is invalid.');

        return !empty($is_password_right);
    }




    /**
    *
    */
    public function _get_loggedin_admin_details(){
        $admin_login_details = $this->session->userdata('admin_login_details');
        // $admin_login_details = array('admin_login_details' => $admin_login_details);
        $admin_login_details = ( count($admin_login_details) > 0) ? $admin_login_details[0] : [];

        return $admin_login_details;
    }
}
