<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// -----------------------------------------------------------------------------

if ( function_exists('data_print') == FALSE ) {
    function data_print($data, $is_exit = FALSE) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if($is_exit == TRUE) {
            exit(0);
        }
    }
}

// -----------------------------------------------------------------------------

if ( function_exists('data_dump') == FALSE ) {
    function data_dump($data, $is_exit = FALSE) {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        if($is_exit == TRUE) {
            exit(0);
        }
    }
}

// -----------------------------------------------------------------------------
