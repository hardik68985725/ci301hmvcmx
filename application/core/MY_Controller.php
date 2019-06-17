<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
*   MY_Controller is extended controller.
*/

class MY_Controller extends MX_Controller {

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * Sets component load paths, gets the initial output buffering level.
     *
     * @return  void
     */
    public function __construct() {
        parent::__construct();

        $this->load->helper('my_cache_helper');
        cache_clean($this);
    }
}


/**
*   MY_Back_End_Controller for the backend (admin panel).
*/
class MY_Back_End_Controller extends MY_Controller {

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * Sets component load paths, gets the initial output buffering level.
     *
     * @return  void
     */
    public function __construct() {
        parent::__construct();

        $this->load->helper('my_debug_helper');
        $this->load->helper('url');
        $this->load->helper('my_login_helper');

        $this->load->library('session');
    }
}

/**
*   MY_Front_End_Controller for the backend (admin panel).
*/
class MY_Front_End_Controller extends MY_Controller {

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * Sets component load paths, gets the initial output buffering level.
     *
     * @return  void
     */
    public function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('my_debug_helper');

        // $this->load->helper('my_login_helper');

        // $this->load->library('session');
    }
}
