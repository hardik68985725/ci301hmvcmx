<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends MY_Back_End_Controller {

    protected $is_admin_logged_in = FALSE;
    protected $file_upload_data = array();

    public function __construct() {
        parent::__construct();

        $this->is_admin_logged_in = is_admin_loggedin_for_admin(FALSE);
        // $this->is_admin_logged_in = TRUE;
        // is_admin_loggedin_for_login();

        $this->load->helper('form');

        $this->load->module('Template');
    }



    // public function _remap($method, $params = array()) {
    //     if ( method_exists($this, $method) ) {
    //         return call_user_func_array(array($this, $method), $params);
    //     } else {
    //         $this->index($method);
    //     }
    // }



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
    // public function index($page_name = '') {
    public function index() {

        if ( $this->is_admin_logged_in == FALSE ) {
            redirect_to_admin_login();
        }

        //
        $page_name = 'home';
        $page_data = NULL;

        //
        $this->template->model_template->set_title('Pages - '. $page_name);
        $this->template->model_template->set_content_view('admin/pages/view_admin_'. $page_name);
        $this->template->model_template->set_other_views(array(
            'navigation_admin' => 'backend/admin/navigation_admin',
        ));

            //
            $this->load->module('admin/admin');

            //
            $this->load->module('home');
            // $page_data = $this->home->model_home->select_home();
            $page_data = $this->home->_json_decode_homepage_data();

            //
            // data_print($page_data, TRUE);

            //
            $extra_data = array(
                'admin_login_details' => $this->admin->_get_loggedin_admin_details(),
                'page_action' => 'page_home_edit',
                'page_name' => $page_name,
                'page_data' => $page_data
            );
            $this->template->model_template->set_extra_data($extra_data);

        $this->template->template_admin();
    }




    /**
     *
     */
    public function edit($param = '') {

        if ( $this->is_admin_logged_in == FALSE ) {
            redirect_to_admin_login();
        }

        if ( $param == 'headerslider' ) {

            data_print($_POST);

            //
            $upload_config = json_encode(array(
                'upload_path' => './assets/backend/admin/pages/home/upload/',
                'allowed_types' => array('jpg', 'png'),
                'max_size' => 1024,
                'max_width' => 1600,
                'max_height' => 1600,
                'file_element_name' => 'upload_header_slider_image_path'
            ));

            //
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('text_header_title', 'Title', 'trim|required');
            $this->form_validation->set_rules('text_header_description', 'Description', 'trim|required');
            $this->form_validation->set_rules('text_header_read_more_link', 'Read More Button link', 'trim|required');
            $this->form_validation->set_rules('upload_header_slider_image_path', 'Slider Image', 'trim|callback__check_file_with_no_required['. $upload_config .']');

            if ( $this->form_validation->run($this) == FALSE ) {
                $this->index();
            } else {

                if ( $this->upload ) {
                    $upload_header_slider_image_data = $this->upload->data();
                } else {
                    $upload_header_slider_image_data = NULL;
                }

                // data_print($_POST);
                // data_print($_FILES);

                //
                $this->load->module('home');
                $page_data = $this->home->_json_decode_homepage_data();

                foreach ( $page_data[0]->element_content as $pgelcon_key => $pgelcon_value ) {
                    if ( $pgelcon_key == $this->input->post('hidden_setup_no') ) {
                        $page_data[0]->element_content[$pgelcon_key]->title = $this->input->post('text_header_title');
                        $page_data[0]->element_content[$pgelcon_key]->description = $this->input->post('text_header_description');
                        $page_data[0]->element_content[$pgelcon_key]->read_more_link = $this->input->post('text_header_read_more_link');
                        // $page_data[0]->element_content[$pgelcon_key]->slider_image_path = (isset($upload_header_slider_image_data['file_name'])) ? $upload_header_slider_image_data['file_name'] : $page_data[0]->element_content->slider_image_path;
                        $page_data[0]->element_content[$pgelcon_key]->slider_image_path = (isset($upload_header_slider_image_data['file_name'])) ? $upload_header_slider_image_data['file_name'] : $page_data[0]->element_content[$pgelcon_key]->slider_image_path;
                    }
                }

                // data_print($page_data);

                $header_slider_element_content = json_encode($page_data[0]->element_content);

                // $counters_element_content = json_encode($page_data[5]->element_content);
                // data_print($headr_slider_element_content, TRUE);

                $this->home->model_home
                    ->set_id($page_data[0]->id)
                    ->set_element_content($header_slider_element_content)
                    ->update_home();

                $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                redirect('admin/pages/homepage');
            }
        } elseif ( $param == 'compdesc' ) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('text_company_title', 'Title', 'trim|required');
            $this->form_validation->set_rules('text_company_description', 'Description', 'trim|required');

            if ( $this->form_validation->run($this) == FALSE ) {
                $this->index();
            } else {

                //
                $this->load->module('home');
                $page_data = $this->home->_json_decode_homepage_data();

                // data_print($page_data[1]);
                $page_data[1]->element_content->title = $this->input->post('text_company_title');
                $page_data[1]->element_content->description = $this->input->post('text_company_description');
                $compdesc_element_content = json_encode($page_data[1]->element_content);

                $this->home->model_home
                    ->set_id($page_data[1]->id)
                    ->set_element_content($compdesc_element_content)
                    ->update_home();

                $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                redirect('admin/pages/homepage');
            }
        /*} elseif ( $param == 'servicearea' ) {

            //
            $upload_config = json_encode(array(
                'upload_path' => './assets/backend/admin/pages/home/upload/',
                'allowed_types' => array('jpg', 'png'),
                'max_size' => 1024,
                'max_width' => 1600,
                'max_height' => 1600,
                'file_element_name' => 'upload_sa_image_path'
            ));

            //
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('text_sa_title', 'Title', 'trim|required');
            $this->form_validation->set_rules('text_sa_description', 'Description', 'trim|required');
            $this->form_validation->set_rules('text_sa_redirect_link', 'Redirect link', 'trim|required');
            $this->form_validation->set_rules('upload_sa_image_path', 'Image', 'trim|callback__check_file_with_no_required['. $upload_config .']');

            if ( $this->form_validation->run($this) == FALSE ) {
                $this->index();
            } else {

                //
                if ( $this->upload ) {
                    $upload_sa_image_path_data = $this->upload->data();
                } else {
                    $upload_sa_image_path_data = NULL;
                }

                //
                $this->load->module('home');
                $page_data = $this->home->_json_decode_homepage_data();

                //
                foreach ( $page_data[2]->element_content as $sacon_key => $sacon_value ) {
                    if ( $sacon_key == $this->input->post('hidden_setup_no_sa') ) {
                        $page_data[2]->element_content[$sacon_key]->title = $this->input->post('text_sa_title');
                        $page_data[2]->element_content[$sacon_key]->description = $this->input->post('text_sa_description');
                        $page_data[2]->element_content[$sacon_key]->redirect_link = $this->input->post('text_sa_redirect_link');
                        $page_data[2]->element_content[$sacon_key]->image_path = (isset($upload_sa_image_path_data['file_name'])) ? $upload_sa_image_path_data['file_name'] : $page_data[2]->element_content[$sacon_key]->image_path;
                    }
                }

                //
                $sa_element_content = json_encode($page_data[2]->element_content);

                //
                $this->home->model_home
                    ->set_id($page_data[2]->id)
                    ->set_element_content($sa_element_content)
                    ->update_home();

                //
                $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                //
                redirect('admin/pages/homepage');
            }
        */} elseif ( $param == 'ourproducts' ) {

            $hidden_op = $this->input->post('hidden_op');

            //
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ( $hidden_op == 'non_img' ) {
                $this->form_validation->set_rules('text_ourproducts_title', 'Title', 'trim|required');
                $this->form_validation->set_rules('text_ourproducts_description', 'Description', 'trim|required');

                if ( $this->form_validation->run($this) == FALSE ) {
                    $this->index();
                } else {
                    $this->load->module('home');
                    $page_data = $this->home->_json_decode_homepage_data();

                    // $upload_ourproducts_image_path_0 = $page_data[3]->element_content->image_paths[0];
                    // $upload_ourproducts_image_path_1 = $page_data[3]->element_content->image_paths[1];
                    // $upload_ourproducts_image_path_2 = $page_data[3]->element_content->image_paths[2];

                    $page_data[3]->element_content->title = $this->input->post('text_ourproducts_title');
                    $page_data[3]->element_content->description = $this->input->post('text_ourproducts_description');
                    // $page_data[3]->element_content->image_paths = array($upload_ourproducts_image_path_0, $upload_ourproducts_image_path_1, $upload_ourproducts_image_path_2);

                    $ourproducts_element_content = json_encode($page_data[3]->element_content);

                    $this->home->model_home
                        ->set_id($page_data[3]->id)
                        ->set_element_content($ourproducts_element_content)
                        ->update_home();

                    $this->home->model_home->set_id(NULL);
                    $page_data = $this->home->_json_decode_homepage_data();

                    $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                    redirect('admin/pages/homepage');
                }
            } else if ( $hidden_op == 'img' ) {
                // data_print($_FILES);

                //
                $hidden_op_id = $this->input->post('hidden_op_id');


                //
                $upload_config = array(
                    json_encode(array(
                        'upload_path' => './assets/backend/admin/pages/home/upload/',
                        'allowed_types' => array('jpg', 'png'),
                        'max_size' => 1024,
                        'max_width' => 1600,
                        'max_height' => 1600,
                        'file_element_name' => 'upload_ourproducts_image_path_0'
                    )),
                    json_encode(array(
                        'upload_path' => './assets/backend/admin/pages/home/upload/',
                        'allowed_types' => array('jpg', 'png'),
                        'max_size' => 1024,
                        'max_width' => 1600,
                        'max_height' => 1600,
                        'file_element_name' => 'upload_ourproducts_image_path_1'
                    )),
                    json_encode(array(
                        'upload_path' => './assets/backend/admin/pages/home/upload/',
                        'allowed_types' => array('jpg', 'png'),
                        'max_size' => 1024,
                        'max_width' => 1600,
                        'max_height' => 1600,
                        'file_element_name' => 'upload_ourproducts_image_path_2'
                    ))
                );

                $this->form_validation->set_rules('upload_ourproducts_image_path_'. $hidden_op_id, 'Image', 'trim|callback__check_file_with_no_required['. $upload_config[$hidden_op_id] .']');
                // $this->form_validation->set_rules('upload_ourproducts_image_path_1', 'Image', 'trim|callback__check_file_with_no_required['. $upload_config[1] .']');
                // $this->form_validation->set_rules('upload_ourproducts_image_path_2', 'Image', 'trim|callback__check_file_with_no_required['. $upload_config[2] .']');

                if ( $this->form_validation->run($this) == FALSE ) {
                    $this->index();
                } else {
                    $this->load->module('home');
                    $page_data = $this->home->_json_decode_homepage_data();

                    //
                    // if ( $this->upload ) {
                    //     $upload_ourproducts_image_path_0 = (isset($this->file_upload_data[0]['file_name'])) ? $this->file_upload_data[0]['file_name'] : $page_data[3]->element_content->image_paths[0];
                    //     $upload_ourproducts_image_path_1 = (isset($this->file_upload_data[1]['file_name'])) ? $this->file_upload_data[1]['file_name'] : $page_data[3]->element_content->image_paths[1];
                    //     $upload_ourproducts_image_path_2 = (isset($this->file_upload_data[2]['file_name'])) ? $this->file_upload_data[2]['file_name'] : $page_data[3]->element_content->image_paths[2];
                    // } else {
                    //     $upload_ourproducts_image_path_0 = $page_data[3]->element_content->image_paths[0];
                    //     $upload_ourproducts_image_path_1 = $page_data[3]->element_content->image_paths[1];
                    //     $upload_ourproducts_image_path_2 = $page_data[3]->element_content->image_paths[2];
                    // }
                    // $page_data[3]->element_content->image_paths = array($upload_ourproducts_image_path_0, $upload_ourproducts_image_path_1, $upload_ourproducts_image_path_2);


                    // data_print($this->file_upload_data);


                    $page_data[3]->element_content->image_paths[$hidden_op_id] = (isset($this->file_upload_data[0]['file_name'])) ? $this->file_upload_data[0]['file_name'] : $page_data[3]->element_content->image_paths[$hidden_op_id];
                    $ourproducts_element_content = json_encode($page_data[3]->element_content);


                    // data_print($ourproducts_element_content);


                    // exit();

                    $this->home->model_home
                        ->set_id($page_data[3]->id)
                        ->set_element_content($ourproducts_element_content)
                        ->update_home();

                    $this->home->model_home->set_id(NULL);
                    $page_data = $this->home->_json_decode_homepage_data();

                    $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                    redirect('admin/pages/homepage');
                }
            } else {
                data_print('ERROR: edit > ourproducts > else');
            }
        } elseif ( $param == 'ourproducts2' ) {

            // data_print($_FILES);

            $this->file_upload_data = array();

            //
            $upload_config = array(
                json_encode(array(
                    'upload_path' => './assets/backend/admin/pages/home/upload/',
                    'allowed_types' => array('jpg', 'png'),
                    'max_size' => 1024,
                    'max_width' => 1600,
                    'max_height' => 1600,
                    'file_element_name' => 'upload_ourproducts_image_path_0'
                )),
                json_encode(array(
                    'upload_path' => './assets/backend/admin/pages/home/upload/',
                    'allowed_types' => array('jpg', 'png'),
                    'max_size' => 1024,
                    'max_width' => 1600,
                    'max_height' => 1600,
                    'file_element_name' => 'upload_ourproducts_image_path_1'
                )),
                json_encode(array(
                    'upload_path' => './assets/backend/admin/pages/home/upload/',
                    'allowed_types' => array('jpg', 'png'),
                    'max_size' => 1024,
                    'max_width' => 1600,
                    'max_height' => 1600,
                    'file_element_name' => 'upload_ourproducts_image_path_2'
                ))
            );

            //
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            $this->form_validation->set_rules('text_ourproducts_title', 'Title', 'trim|required');
            $this->form_validation->set_rules('text_ourproducts_description', 'Description', 'trim|required');
            $this->form_validation->set_rules('upload_ourproducts_image_path_0', 'Image', 'trim|callback__check_file_with_no_required['. $upload_config[0] .']');
            $this->form_validation->set_rules('upload_ourproducts_image_path_1', 'Image', 'trim|callback__check_file_with_no_required['. $upload_config[1] .']');
            $this->form_validation->set_rules('upload_ourproducts_image_path_2', 'Image', 'trim|callback__check_file_with_no_required['. $upload_config[2] .']');


            if ( $this->form_validation->run($this) == FALSE ) {
                // data_print($this->file_upload_data, TRUE);
                $this->index();
            } else {

                //
                $this->load->module('home');
                $page_data = $this->home->_json_decode_homepage_data();

                data_print($this->file_upload_data, TRUE);

                //
                if ( $this->upload ) {
                    $upload_ourproducts_image_path_0 = (isset($this->file_upload_data[0]['file_name'])) ? $this->file_upload_data[0]['file_name'] : $page_data[3]->element_content->image_paths[0];
                    $upload_ourproducts_image_path_1 = (isset($this->file_upload_data[1]['file_name'])) ? $this->file_upload_data[1]['file_name'] : $page_data[3]->element_content->image_paths[1];
                    $upload_ourproducts_image_path_2 = (isset($this->file_upload_data[2]['file_name'])) ? $this->file_upload_data[2]['file_name'] : $page_data[3]->element_content->image_paths[2];
                } else {
                    $upload_ourproducts_image_path_0 = $page_data[3]->element_content->image_paths[0];
                    $upload_ourproducts_image_path_1 = $page_data[3]->element_content->image_paths[1];
                    $upload_ourproducts_image_path_2 = $page_data[3]->element_content->image_paths[2];
                }
                $page_data[3]->element_content->title = $this->input->post('text_ourproducts_title');
                $page_data[3]->element_content->description = $this->input->post('text_ourproducts_description');
                $page_data[3]->element_content->image_paths = array($upload_ourproducts_image_path_0, $upload_ourproducts_image_path_1, $upload_ourproducts_image_path_2);
                $ourproducts_element_content = json_encode($page_data[3]->element_content);

                $this->home->model_home
                    ->set_id($page_data[3]->id)
                    ->set_element_content($ourproducts_element_content)
                    ->update_home();

                $this->home->model_home->set_id(NULL);
                $page_data = $this->home->_json_decode_homepage_data();

                $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                $this->file_upload_data = array();

                redirect('admin/pages/homepage');
            }
        } elseif ( $param == 'ourservices' ) {
            //
            $hidden_os = $this->input->post('hidden_os');

            //
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            if ( $hidden_os == 'non_img' ) {
                $this->form_validation->set_rules('text_ourservices_title', 'Title', 'trim|required');
                $this->form_validation->set_rules('text_ourservices_description', 'Description', 'trim|required');

                if ( $this->form_validation->run($this) == FALSE ) {
                    $this->index();
                } else {
                    $this->load->module('home');
                    $page_data = $this->home->_json_decode_homepage_data();

                    $page_data[4]->element_content->title = $this->input->post('text_ourservices_title');
                    $page_data[4]->element_content->description = $this->input->post('text_ourservices_description');

                    $ourservices_element_content = json_encode($page_data[4]->element_content);

                    $this->home->model_home
                        ->set_id($page_data[4]->id)
                        ->set_element_content($ourservices_element_content)
                        ->update_home();

                    $this->home->model_home->set_id(NULL);
                    $page_data = $this->home->_json_decode_homepage_data();

                    $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                    redirect('admin/pages/homepage');
                }
            } else if ( $hidden_os == 'img' ) {
                //
                $hidden_os_id = $this->input->post('hidden_os_id');

                //
                $upload_config = array(
                    json_encode(array(
                        'upload_path' => './assets/backend/admin/pages/home/upload/',
                        'allowed_types' => array('jpg', 'png'),
                        'max_size' => 1024,
                        'max_width' => 1600,
                        'max_height' => 1600,
                        'file_element_name' => 'upload_ourservices_image_path_0'
                    )),
                    json_encode(array(
                        'upload_path' => './assets/backend/admin/pages/home/upload/',
                        'allowed_types' => array('jpg', 'png'),
                        'max_size' => 1024,
                        'max_width' => 1600,
                        'max_height' => 1600,
                        'file_element_name' => 'upload_ourservices_image_path_1'
                    )),
                    json_encode(array(
                        'upload_path' => './assets/backend/admin/pages/home/upload/',
                        'allowed_types' => array('jpg', 'png'),
                        'max_size' => 1024,
                        'max_width' => 1600,
                        'max_height' => 1600,
                        'file_element_name' => 'upload_ourservices_image_path_2'
                    ))
                );

                $this->form_validation->set_rules('upload_ourservices_image_path_'. $hidden_os_id, 'Image', 'trim|callback__check_file_with_no_required['. $upload_config[$hidden_os_id] .']');

                if ( $this->form_validation->run($this) == FALSE ) {
                    $this->index();
                } else {
                    $this->load->module('home');
                    $page_data = $this->home->_json_decode_homepage_data();

                    $page_data[4]->element_content->image_paths[$hidden_os_id] = (isset($this->file_upload_data[0]['file_name'])) ? $this->file_upload_data[0]['file_name'] : $page_data[4]->element_content->image_paths[$hidden_os_id];
                    $ourservices_element_content = json_encode($page_data[4]->element_content);

                    $this->home->model_home
                        ->set_id($page_data[4]->id)
                        ->set_element_content($ourservices_element_content)
                        ->update_home();

                    $this->home->model_home->set_id(NULL);
                    $page_data = $this->home->_json_decode_homepage_data();

                    $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                    redirect('admin/pages/homepage');
                }
            } else {
                data_print('ERROR: edit > ourservices > else');
            }
        } elseif ( $param == 'counters' ) {

            // data_print($_POST, TRUE);

            //
            $this->load->module('home');
            $page_data = $this->home->_json_decode_homepage_data();

            //
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            foreach ( $page_data[5]->element_content as $pgcount_key => $pgcount_value ) {

                $this->form_validation->set_rules('text_counter_title_'. $pgcount_key, 'Title '. ($pgcount_key + 1), 'trim|required');
                $this->form_validation->set_rules('text_counter_count_'. $pgcount_key, 'Count '. ($pgcount_key + 1), 'trim|required');
            }

            if ( $this->form_validation->run($this) == FALSE ) {
                $this->index();
            } else {
                foreach ( $page_data[5]->element_content as $pgcount_key => $pgcount_value ) {
                    $page_data[5]->element_content[$pgcount_key]->title = $this->input->post('text_counter_title_'. $pgcount_key);
                    $page_data[5]->element_content[$pgcount_key]->count = $this->input->post('text_counter_count_'. $pgcount_key);
                }
                $counters_element_content = json_encode($page_data[5]->element_content);

                $this->home->model_home
                    ->set_id($page_data[5]->id)
                    ->set_element_content($counters_element_content)
                    ->update_home();

                $this->session->set_flashdata('suc_msg_page_home_edit', 'Homepage data has been updated successfully.');

                redirect('admin/pages/homepage');
            }
        } else {
            redirect('admin/pages/homepage');
        }
    }
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
