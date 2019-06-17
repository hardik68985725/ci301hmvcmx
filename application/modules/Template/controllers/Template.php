<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('model_template');
    }

    // public function add_custom_styles($custom_styles = NULL) {
    //     if( isset($custom_styles) && is_array($custom_styles) ) {
    //         foreach ($custom_styles as $key_cs => $value_cs) {
    //             $value_cs = strtolower(trim($value_cs));
    //             if( strpos($value_cs, '<link') > -1){
    //                 echo trim($value_cs);
    //             }
    //         }
    //     }
    // }
    // public function add_custom_scripts($custom_scripts = NULL) {
    //     if( isset($custom_scripts) && is_array($custom_scripts) ) {
    //         foreach ($custom_scripts as $key_cs => $value_cs) {
    //             $value_cs = strtolower(trim($value_cs));
    //             if( strpos($value_cs, '<script') > -1){
    //                 echo trim($value_cs);
    //             }
    //         }
    //     }
    // }


    // Template Methods

    public function template_login() {
        $this->load->view('Template/backend/admin/template_login', $this->template->model_template->get_extra_data());
    }

    public function template_admin() {
        // $this->load->view('Template/template_admin', $data);
        // $this->load->view('Template/template_admin', $data);
        $this->load->view('Template/backend/admin/template_admin', $this->template->model_template->get_extra_data());
    }

    // public function template_main($data = NULL) {
    //     $this->load->view('Template/template_main', $data);
    // }

    // public function template_basic($data = NULL) {
    //     $this->load->view('Template/template_basic', $data);
    // }

    public function template_front_main() {
        // var_dump($this->template->model_template->get_extra_data());
        $this->load->view('Template/frontend/front_template_main', $this->template->model_template->get_extra_data());
    }

    // Template Methods
}
