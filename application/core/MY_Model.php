<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

    // --------------------------------------------------------------------

    /**
     * Class constructor
     *
     * Sets component load paths, gets the initial output buffering level.
     *
     * @return  void
     */
    public function __construct($config = array()) {
        // Call the CI_Model constructor
        parent::__construct($config);
    }


    public function __call($methodName, $args) {
        // if (preg_match('~^(set|get)([A-Z])(.*)$~', $methodName, $matches)) {
        if (preg_match('~^(set|get)_([a-z])(.*)$~', $methodName, $matches)) {
            $property = strtolower($matches[2]) . $matches[3];
            if (!property_exists($this, $property)) {
                throw new Exception('Property ' . $property . ' not exists');
            }
            switch($matches[1]) {
                case 'set':
                    $this->checkArguments($args, 1, 1, $methodName);
                    return $this->set($property, $args[0]);
                case 'get':
                    $this->checkArguments($args, 0, 0, $methodName);
                    return $this->get($property);
                case 'default':
                    throw new Exception('Method ' . $methodName . ' not exists');
            }
        } else {
            // echo '.....';
        }
    }

    private function get($property) {
        return $this->$property;
    }

    private function set($property, $value) {
        $this->$property = $value;
        return $this;
    }

    private function checkArguments(array $args, $min, $max, $methodName) {
        $argc = count($args);
        if ($argc < $min || $argc > $max) {
            throw new Exception('Method ' . $methodName . ' needs minimaly ' . $min . ' and maximaly ' . $max . ' arguments. ' . $argc . ' arguments given.');
        }
    }

    public function get_object_in_array($object) {
        $array = get_object_vars($object);
        foreach ($array as $key => $value) {
            if($value === null){
                unset($array[$key]);
            }
        }
        return $array;
    }

    public function get_object_from_array($array) {
        $array = get_object_vars($array);
        foreach ($array as $key => $value) {
            if($value === null){
                unset($array[$key]);
            }
        }
        return $array;
    }

    public function set_object_with_json_string($json_string, $model_object, $model_set_method_prifix) {
        $this->load->helper('MY_model');

        $json_object = json_decode($json_string);

        if(json_last_error() !== JSON_ERROR_NONE){
            if ($json_error = json_last_error_msg()) {
                // throw new Exception(sprintf("Failed to parse json string '%s', error: '%s'", $json_string, $json_error));
                throw new Exception(sprintf("Failed to parse json string, error: '%s'", $json_error));
                exit(0);
            }
        } elseif (is_object($model_object) == FALSE){
            throw new Exception(sprintf("Second argument should be an object."));
            exit(0);
        } elseif (is_model_exists($model_object) == FALSE){
            throw new Exception(sprintf("Model is not exist."));
            exit(0);
        } else {
            foreach ($json_object as $json_key => $json_value) {
                foreach ($json_value as $key => $value) {
                    if(is_array($value)){
                        $value = json_encode($value);
                    }
                    $set_method = $model_set_method_prifix . $key;
                    $model_object->$set_method($value);
                }
            }
        }
    }
}
