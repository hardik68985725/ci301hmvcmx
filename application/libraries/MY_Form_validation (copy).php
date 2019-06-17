<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    public $file_upload_data = array();


    protected $CI;

    /**
    *
    */
    public function __construct() {
        parent::__construct();

        // reference to the CodeIgniter super object
        $this->CI =& get_instance();
    }

    /**
    *
    */
    public function check_file_with_no_required($e, $config) {

        $config = json_decode($config, true);

        $file_element_name = $config['file_element_name'];

        // check $_FILES is exist.
        if ( isset($_FILES) ) {
            // check there is a file in $_FILES.
            if ( $_FILES[$file_element_name]['name'] != '' ) {

                $this->load->library('upload', $config);

                // upload the file and check whether it failed or not.
                if ( !$this->upload->do_upload($file_element_name) ) {
                    $error = $this->upload->display_errors();
                    $this->CI->form_validation->set_message('_check_file_with_no_required', $error);
                    return FALSE;
                } else {
                    // $data = $this->upload->data();
                    array_push($this->file_upload_data, $this->upload->data());

                    data_print($this->file_upload_data);

                    return TRUE;
                }
            }

            //
            array_push($this->file_upload_data, NULL);
        }
        return TRUE;
    }



    /**
    *
    */
    public function run($module = '', $group = '') {
        (is_object($module)) AND $this->CI =& $module;

        return parent::run($group);
    }



    /**
    *
    */
    public function _check_file_with_no_required($e, $config) {

        $config = json_decode($config, true);

        $file_element_name = $config['file_element_name'];

        // check $_FILES is exist.
        if ( isset($_FILES) ) {
            // check there is a file in $_FILES.
            if ( $_FILES[$file_element_name]['name'] != '' ) {

                $this->load->library('upload', $config);

                // upload the file and check whether it failed or not.
                if ( !$this->upload->do_upload($file_element_name) ) {
                    $error = $this->upload->display_errors();
                    $this->form_validation->set_message('_check_file_with_no_required', $error);
                    return FALSE;
                } else {
                    // $data = $this->upload->data();
                    array_push($this->file_upload_data, $this->upload->data());
                    return TRUE;
                }
            }

            //
            array_push($this->file_upload_data, NULL);
        }
        return TRUE;
    }
}
