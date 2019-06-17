<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Front_End_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('model_home');

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

        //
        $extra_data = array(
            // 'data_home_page' => $this->_json_decode_homepage_data()
        );

        //
        $this->template->model_template->set_title('Home');
        $this->template->model_template->set_content_view('home/view_home');
        $this->template->model_template->set_other_views(array(
            'topbar' => 'home/view_topbar',
            'header' => 'home/view_header',
            'footer' => 'home/view_footer',
            'bottombar' => 'home/view_bottombar',
        ));
        $this->template->model_template->set_extra_data($extra_data);
        $this->template->template_front_main();
    }

    public function _json_decode_homepage_data() {
        $arrayToCheckForElementName = array('header_slider_trdi', 'company_description', 'service_area', 'our_products', 'our_services', 'counters');

        $data_home_page = $this->model_home->select_home();

        foreach ($data_home_page as $home_page_key => $home_page_row) {
            if ( in_array($home_page_row->element_name, $arrayToCheckForElementName) ) {
                $home_page_row->element_content = json_decode($home_page_row->element_content);
            }
        }

        return $data_home_page;
    }

    public function _homepage_data($row_name) {
        $this->model_home->set_element_name($row_name);
        $data_home_page = $this->model_home->select_home();
        $data_home_page->element_content = json_decode($data_home_page->element_content);

        return $data_home_page;
    }
}
