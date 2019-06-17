<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* Load the MX_Loader class */
require_once(APPPATH .'third_party/MX/Loader.php');

class MY_Loader extends MX_Loader {

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * Sets component load paths, gets the initial output buffering level.
     *
     * @return  void
     */
    public function __construct($config = array()) {
        parent::__construct($config);
    }

    // --------------------------------------------------------------------
    /**
     * Add Third Party Package Path
     *
     * Prepends a parent path to the library, model, helper and config
     * path arrays.
     * Both the following statements are equivalent.
     * $this->load->add_package_path(APPPATH .'third_party/Test/');
     * $this->load->add_third_party_package('Test');
     * This method will check in third_party directory only for whatever package name passed as parameter.
     *
     * @see CI_Loader::$_ci_library_paths
     * @see CI_Loader::$_ci_model_paths
     * @see CI_Loader::$_ci_helper_paths
     * @see CI_Config::$_config_paths
     *
     * @param   string  $package_name    Path to add. It can be directory of application/third_party/[$package_name].
     * @param   bool    $view_cascade   (default: TRUE)
     * @return  object
     */
    public function add_third_party_package($package_name, $view_cascade = TRUE) {
        $package_name = rtrim($package_name, '/') .'/';

        // $this->load->add_package_path(APPPATH .'third_party/'. $package_name);
        $this->add_package_path(APPPATH .'third_party/'. $package_name);
        return $this;
    }
}

