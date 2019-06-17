<?php
/**
 * CodeIgniter Model Helpers (H_model_helper)
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Model Helpers (H_model_helper)
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Hardik Kathiriya
 * @link
 */

// ------------------------------------------------------------------------

if ( !function_exists('model_exists') ) {
    /**
     * Model Exists
     *
     * Return TRUE If Model Is Exists Otherwise False.
     *
     * @param   string  $model_name
     * @return  boolean
     */
    function is_model_exists($model_name){
        $model_name = strtolower(get_class($model_name));

        $CI = &get_instance();
        foreach($CI->config->_config_paths as $config_path){
            if(file_exists($config_path . 'models\\' . $model_name . '.php')) {
            // if(file_exists(FCPATH . $config_path . 'models/' . $model_name . '.php')) {
                return true;
            }
        }
        return false;
    }
}

// ------------------------------------------------------------------------
