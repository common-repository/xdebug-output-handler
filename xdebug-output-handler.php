<?php
/*
  Plugin Name: Xdebug Output Handler
  Plugin URI: http://wordpress.zerotop.com/xdebug-output-handler/
  Description: This WordPress Plugin collects the Xdebug output and displays it in the footer. Only use it with Xdebug extension for PHP activated
  Author: Benjamin de Jong
  Version: 1.0
  Author URI: http://wordpress.zerotop.com/
  License: GPLv2 or later
 */
class Xdebug_Output_Handler
{
    var $xdebug_exists = false;

    // as soon as the plugin is loaded, we will try to start collecting errors
    function __construct()
    {
        // check wether the needed functions do exist. If not: we will do nothing!!
        if (function_exists('xdebug_start_error_collection') && function_exists('xdebug_stop_error_collection') && function_exists('xdebug_get_collected_errors'))
        {
            // if the functions do exist, lets remember that for future use
            $this->xdebug_exists = true;
            // of course, make sure we do start collecting
            xdebug_start_error_collection();
            // prohibit the display of errors between the code
            ini_set("display_errors", false);
        }
    }

    // when everything is desctucted, there is a nice moment to display the errors
    function Display()
    {
        $cr="\n";
        // check wether the needed functions do exist. If not: we will do nothing!!
        if (function_exists('xdebug_stop_error_collection') && function_exists('xdebug_get_collected_errors'))
        {
            // just to be nice
            xdebug_stop_error_collection();
            // get the errors that have been collected
            $found_errors = xdebug_get_collected_errors();
            // how many?
            $found_error_count = count($found_errors);
            // only output when errors are found
            if ($found_error_count)
                echo '<!-- Start Xdebug Output Handler output -->'.$cr.'<div class="xdebug-output-handler">';
            // walk over every error
            foreach ($found_errors as $current_error)
            {
                // extract a title
                $current_title = trim(substr($current_error, 0, strpos($current_error, 'Call Stack')));
                // get the left over data
                $current_callstack = trim(substr($current_error, strpos($current_error, 'Call Stack')));
                // display it
                echo $cr.'    <h3 class="xdebug-output-handler">' . $current_title . '</h3>';
                echo $cr.'    <p class="xdebug-output-handler">' . $current_callstack . '</p>';
            }
            // only output when errors are found
            if ($found_error_count)
                echo $cr.'</div><!-- End Xdebug Output Handler output -->'.$cr;
        }
    }

    function Add_Style()
    {
        if ($this->xdebug_exists)
        {
            wp_register_style('xdebug-output-handler-style', plugins_url('css/style.css', __FILE__));
            wp_enqueue_style('xdebug-output-handler-style');
        }
    }

}

/* Create an instance of the class */
$myXdebug_Output_Handler = new Xdebug_Output_Handler();
// if Xdebug works, include the style sheet
add_action('wp_enqueue_scripts', array(&$myXdebug_Output_Handler, 'Add_Style'));
add_action('admin_enqueue_scripts', array(&$myXdebug_Output_Handler, 'Add_Style'));
add_action('wp_print_footer_scripts', array(&$myXdebug_Output_Handler, 'Display'));
add_action('admin_print_footer_scripts', array(&$myXdebug_Output_Handler, 'Display'));
?>