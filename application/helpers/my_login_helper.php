<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Login helper (H_login_helper)
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Hardik Kathiriya
 * @link
 */

// ------------------------------------------------------------------------

if ( !function_exists('is_admin_loggedin_for_admin') ) {
    /**
     * is_admin_loggedin_for_admin
     *
     * To check that any user is loggedin or not.
     *
     * @param   void
     * @return  boolean
     */
    function is_admin_loggedin_for_admin($is_redirect = TRUE) {
        $CI =& get_instance();

        $is_admin_loggedin = $CI->session->userdata('is_admin_loggedin');
        if($is_admin_loggedin == FALSE) {
            if($is_redirect != FALSE) {
                // redirect('admin/login/');
                redirect_to_admin_login();
            }
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

// ------------------------------------------------------------------------

if ( !function_exists('is_admin_loggedin_for_login') ) {
    /**
     * is_admin_loggedin_for_login
     *
     * To check that any user is loggedin or not.
     *
     * @param   void
     * @return  boolean
     */
    function is_admin_loggedin_for_login($is_redirect = TRUE) {
        $CI =& get_instance();

        $is_admin_loggedin = $CI->session->userdata('is_admin_loggedin');
        if($is_admin_loggedin == FALSE) {
            return FALSE;
        } else {
            if($is_redirect != FALSE) {
                redirect('admin/');
            }
            return TRUE;
        }
    }
}

// ------------------------------------------------------------------------
