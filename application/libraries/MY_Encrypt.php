<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * H_Encryption Class
 *
 * Provides two-way keyed encryption via PHP's MCrypt and/or OpenSSL extensions.
 *
 * @package     CodeIgniter
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Andrey Andreev
 * @link        http://codeigniter.com/user_guide/libraries/encryption.html
 */
class MY_Encrypt extends CI_Encrypt {

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * @param   array   $params Configuration parameters
     * @return  void
     */
    public function __construct(array $params = array()) {
        // $this->set_key('1');

        parent::__construct($params);
    }

    // --------------------------------------------------------------------

    function encode($string, $key = '', $url_safe = true) {
        $string_encode = parent::encode($string, $key);

        if ($url_safe)
        {
            $string_encode = strtr(
                $string_encode,
                array(
                    '+' => '.',
                    '=' => '-',
                    '/' => '~'
                )
            );
        }

        return $string_encode;
    }

    function decode($string, $key = '') {
        $string = strtr(
            $string,
            array(
                '.' => '+',
                '-' => '=',
                '~' => '/'
            )
        );

        return parent::decode($string, $key);
    }
}
