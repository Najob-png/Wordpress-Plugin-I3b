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
	public Adminpanel $adminpanel;
    public shortcode $shortcode;

    function __construct() {
		include_once 'Classes/Adminpanel.php';
        include_once 'Classes/shortcode.php';
		$this->adminpanel = new Adminpanel();
        $this->shortcode = new shortcode();
    }

    function register(): void {
        add_shortcode( 'shotrecipesearch', array( $this->shortcode, 'shotrecipesearch' ));
        add_shortcode( 'rand_meal_shortcode', array( $this->shortcode, 'rand_meal_shortcode' ));
        add_action('wp_enqueue_scripts', array($this->shortcode, 'enqueue'));
	    add_action('admin_init', array($this->adminpanel, 'adminPanelSettingFields'));
	    add_action("admin_menu", array($this->adminpanel, "createAdminPanel"));
    }
}

if (class_exists('RecipeBrowser')) {
    $RecipeBrowser = new RecipeBrowser();
	$RecipeBrowser->register();
}