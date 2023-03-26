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
    public shortcode $shortcode;

    function __construct() {
        include_once 'shortcode.php';
        $this->shortcode = new shortcode();
    }

    function register(): void {
        add_shortcode( 'testShortcode', array( $this->shortcode, 'testShortcode' ) );
        add_shortcode( 'rand_meal_shortcode', array( $this->shortcode, 'rand_meal_shortcode' ) );
        add_action('wp_enqueue_scripts', array($this->shortcode, 'enqueue'));
    }
}

if (class_exists('RecipeBrowser')) {
    $RecipeBrowser = new RecipeBrowser();
	$RecipeBrowser->register();
}