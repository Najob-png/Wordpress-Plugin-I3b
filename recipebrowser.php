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
	public Adminpanel $adminPanel;
	function __construct() {
		include_once( "adminpanel.php" );
		$this->adminPanel = new Adminpanel();
		include_once 'shortcodeyanni.php';
		$this->shortcodeyanni = new shortcodeyanni();
	}

	function register() {
		add_action('admin_init', array($this->adminPanel, 'adminPanelSettingFields'));
		add_action("admin_menu", array($this->adminPanel, "createAdminPanel"));
		add_shortcode( 'testShortcode', array( $this->shortcodeyanni, 'testShortcode') );
		add_action( 'wp_enqueue_scripts', array($this->adminPanel, 'enqeueStyle') );
	}
}

if (class_exists('RecipeBrowser')){
    $RecipeBrowser = new RecipeBrowser();
	$RecipeBrowser->register();
}