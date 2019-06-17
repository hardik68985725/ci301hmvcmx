<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * H_Misc Class
 *
 * Provides two-way keyed encryption via PHP's MCrypt and/or OpenSSL extensions.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Andrey Andreev
 * @link        http://codeigniter.com/user_guide/libraries/encryption.html
 */
class MY_Misc {

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * @param   array   $params Configuration parameters
     * @return  void
     */
    public function __construct() {
    }

    // --------------------------------------------------------------------

    public function file_size_convert($bytes) {
        $bytes = floatval($bytes);
        $arBytes = array(
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

        foreach($arBytes as $arItem) {
            if($bytes >= $arItem["VALUE"]) {
                $result = $bytes / $arItem["VALUE"];
                // $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
                $result = strval(round($result, 0) .' '. $arItem["UNIT"];
                break;
            }
        }

        return $result;
    }
}
