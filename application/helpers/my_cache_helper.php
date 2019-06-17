<?php
/**
 * CodeIgniter Cache Helpers (H_cache_helper)
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Cache Helpers (H_cache_helper)
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Hardik Kathiriya
 * @link
 */

// ------------------------------------------------------------------------

if ( !function_exists('cache_clean') ) {
    /**
     * cache_clean
     *
     * It will clean the cache. So, we can get fresh response.
     * This is very usefull when you do not want to get previous result at the back button perssed from browser.
     *
     * @param   object  $this object
     * @return  void
     */
    function cache_clean($object) {
        $object->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $object->output->set_header("Pragma: no-cache");
    }
}

// ------------------------------------------------------------------------
