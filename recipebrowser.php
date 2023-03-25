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

	function __construct() {
		include_once 'shortcodeyanni.php';
		$this->shortcodeyanni = new shortcodeyanni();
	}

	function register() {
		add_shortcode( 'testShortcode', array( $this->shortcodeyanni, 'testShortcode' ) );
	}
}

if (class_exists('RecipeBrowser')){
    $RecipeBrowser = new RecipeBrowser();
	$RecipeBrowser->register();
}