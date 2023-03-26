<?php
/**
 * @package recipebrowser
 */
/*
Plugin Name: recipebrowser
Plugin URI:
Description: -
Version: 1.0.0
Author: Michael Galambos
Author URI:
License: GPLv2 or later
Text Domain: yibist-plugin
*/

defined('ABSPATH') or die('no');
class RecipeBrowser {
    public shortcodeyanni $shortcodeyanni;
    public randomshort $randomshort;

    function __construct() {
        include_once 'shortcodeyanni.php';
        include_once 'randomshort.php';
        $this->shortcodeyanni = new shortcodeyanni();
        $this->randomshort = new randomshort();
    }



    function register() {
        add_shortcode( 'testShortcode', array( $this->shortcodeyanni, 'testShortcode' ) );
        add_shortcode( 'rand_meal_shortcode', array( $this->randomshort, 'rand_meal_shortcode' ) );
    }


}


if (class_exists('RecipeBrowser')) {
    $RecipeBrowser = new RecipeBrowser();
	$RecipeBrowser->register();
}