<?php // model_template.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_template extends MY_Model {

    /**
    * @property string title.
    * It is a string for <title>_____</title>.
    */
    protected $title = NULL;

    /**
    * @property array custom_styles.
    * It is a collection of the <link ..... />.
    * Use for add your own customized style sheets.
    */
    protected $custom_styles = array();

    /**
    * @property array custom_scripts.
    * It is a collection of the <script ..... ></script>.
    * Use for add your own customized scripts.
    */
    protected $custom_scripts = array();

    /**
    * @property string content_view.
    * It is a view file name of the main content of the template.
    */
    protected $content_view = NULL;

    /**
    * @property string content_view.
    * It is a view file name of the main content of the template.
    */
    protected $other_views = array();

    /**
    * @property array data.
    * It is a view data of the main content of the template.
    */
    protected $extra_data = array();

    public function __construct() {
        // Call the H_Model constructor
        parent::__construct();
    }

    // Other Methods

    public function set_custom_styles($custom_styles = NULL) {
        if( $custom_styles != NULL ) {
            foreach ($custom_styles as $key_cs => $value_cs) {
                $value_cs = strtolower(trim($value_cs));
                if( strpos($value_cs, '<link') > -1){
                    array_push($this->custom_styles, $value_cs);
                }
            }
        }
    }
    public function get_custom_styles() {
        $str_custom_styles = '';
        if( $this->custom_styles != NULL ) {
            foreach ($this->custom_styles as $key_cs => $value_cs) {
                $value_cs = strtolower(trim($value_cs));
                if( strpos($value_cs, '<link') > -1){
                    // echo trim($value_cs);
                    $str_custom_styles .= $value_cs;
                }
            }
        }

        return $str_custom_styles;
    }


    public function set_custom_scripts($custom_scripts = NULL) {

        if( $custom_scripts != NULL ) {
            foreach ($custom_scripts as $key_cs => $value_cs) {
                // $value_cs = strtolower(trim($value_cs));
                $value_cs = trim($value_cs);
                if( strpos($value_cs, '<script') > -1){
                    array_push($this->custom_scripts, $value_cs);
                }
            }
        }
    }
    public function get_custom_scripts() {

        $str_custom_scripts = '';
        if( $this->custom_scripts != NULL ) {
            foreach ($this->custom_scripts as $key_cs => $value_cs) {
                // $value_cs = strtolower(trim($value_cs));
                $value_cs = trim($value_cs);
                if( strpos($value_cs, '<script') > -1){
                    $str_custom_scripts .= $value_cs;
                }
            }
        }

        return $str_custom_scripts;
    }


    public function set_other_views($other_views = NULL) {
        if ( $other_views != NULL ) {
            $this->other_views = $other_views;
        }
    }
    public function get_other_view($view_index = NULL) {
        if ($view_index != NULL) {
            return $this->other_views[$view_index];
        }
            return $this->other_views;
    }



    public function set_extra_data($extra_data = NULL) {
        if ( $extra_data != NULL ) {
            $this->extra_data = $extra_data;
        }
    }
    public function get_extra_data() {
        return $this->extra_data;
    }

    // Other Methods
}
