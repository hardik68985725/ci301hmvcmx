<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( !function_exists('file_size_convert') ) {
    /**
     * byte convert
     *
     * Converts the byte to kb, mb, gb, tb.
     *
     * @param   string  bytes string
     * @return  string  memory convered sting
     */
    function file_size_convert($bytes) {
        $bytes = floatval($bytes);

        $array_bytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach($array_bytes as $byte) {
            if($bytes >= $byte["VALUE"]) {
                $result = $bytes / $byte["VALUE"];
                // $result = str_replace(".", "," , strval(round($result, 2)))." ".$byte["UNIT"];
                // $result = strval(round($result, 0)) .' '. $byte["UNIT"];
                // $result = strval(floor($result)) .' '. $byte["UNIT"];
                $result = strval(ceil($result)) .' '. $byte["UNIT"];
                break;
            }
        }

        return $result;
    }
}

// ------------------------------------------------------------------------
