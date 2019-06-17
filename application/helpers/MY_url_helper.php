<?php
/**
 * CodeIgniter URL Helpers (H_url_helper)
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter URL Helpers (H_url_helper)
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Hardik Kathiriya
 * @link
 */

// ------------------------------------------------------------------------

if ( !function_exists('my_base_url') ) {
    /**
     * Assets URL
     *
     * Return URL For Traling /.
     *
     * @param   string  $uri
     * @param   string  $protocol
     * @return  string
     */
    function my_base_url($uri = '', $protocol = NULL) {
        return base_url($uri, $protocol);
        // return base_url($uri, $protocol) .'/';
        // return get_instance()->config->base_url('assets/'. $uri, $protocol). '/';
    }
}

if ( !function_exists('assets_url') ) {
    /**
     * Assets URL
     *
     * Return URL For Assets Directory.
     *
     * @param   string  $uri
     * @param   string  $protocol
     * @return  string
     */
    function assets_url($uri = '', $protocol = NULL) {
        return base_url('assets/'. $uri, $protocol);
        // return get_instance()->config->base_url('assets/'. $uri, $protocol). '/';
    }
}

if ( !function_exists('temp_gd_download_url') ) {
    /**
     * temp_gd_download_url URL
     *
     * Return URL For temp_files/temp_gd_downloads Directory.
     *
     * @param   string  $uri
     * @param   string  $protocol
     * @return  string
     */
    function temp_gd_download_url($uri = '', $protocol = NULL) {
        return base_url('temp_files/temp_gd_downloads/'. $uri, $protocol);
    }
}

if ( !function_exists('temp_gd_download_path') ) {
    /**
     * temp_gd_download_path PATH
     *
     * Return PATH For temp_files/temp_gd_downloads Directory.
     *
     * @param   string  $file_name
     * @return  string
     */
    function temp_gd_download_path($file_name = '') {
        return './temp_files/temp_gd_downloads/'. $file_name;
    }
}

// ------------------------------------------------------------------------

if ( !function_exists('redirect_to_admin_login') ) {
    /**
     * redirect_to_admin_login
     *
     * Return No Return.
     *
     * @param   -
     * @return  -
     */
    function redirect_to_admin_login() {
        redirect('admin/login/');
    }
}

// ------------------------------------------------------------------------

if ( !function_exists('redirect_to_admin_main') ) {
    /**
     * redirect_to_admin_main
     *
     * Return No Return.
     *
     * @param   -
     * @return  -
     */
    function redirect_to_admin_main() {
        redirect('admin/');
    }
}

// ------------------------------------------------------------------------
