<?php defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( !function_exists('input_value_by_action') ) {
    /**
     * input_value_by_action is return old value or new value based on given
     * action compaire string and action string.
     * If given action compaire string and action string both are equals means
     * there is no change in value so it will return the old value otherwise
     * it will return the new value so you can refill it again to control.
     *
     * input_value_by_action
     *
     * @param   string  action_compaire_string
     * @param   string  action
     * @param   string  old_value
     * @param   string  new_value
     * @return  string  input_value_by_action
     */
    function input_value_by_action($action_compaire_string, $action, $old_value, $new_value) {
        // echo '<br />'. $action_compaire_string .','. $action .','. $old_value .','. $new_value;
        $value = ($action_compaire_string == $action) ? $old_value : $new_value;
        return $value;
    }
}

// ------------------------------------------------------------------------

?>
