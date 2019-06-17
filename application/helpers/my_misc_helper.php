<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( !function_exists('read_file') ) {
    /**
     * File
     *
     * Opens the file specified in the path and returns it as a string.
     *
     * @todo    Remove in version 3.1+.
     * @deprecated  3.0.0   It is now just an alias for PHP's native file_get_contents().
     * @param   string  $file   Path to file
     * @return  string  File contents
     */
    function read_file($file) {
        return @file_get_contents($file);
    }
}

// ------------------------------------------------------------------------

