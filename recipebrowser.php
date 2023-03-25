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
	public Admin $adminPanel;
	function __construct() {
		require_once("admin-panel.php");
		$this->adminPanel = new Admin();
		include_once 'shortcodeyanni.php';
		$this->shortcodeyanni = new shortcodeyanni();
	}

	function register() {
		add_action('admin_init', array($this->adminPanel, 'adminPanelSettingFields'));
		add_action("admin_menu", array($this->adminPanel, "createAdminPanel"));
		add_shortcode( 'testShortcode', array( $this->shortcodeyanni, 'testShortcode' ) );
	}
}
class Api
{
    public static array $apiargs = array();
    private static array $apiarglimits = array("diet","health","cuisineType","mealType","dishType","calories","glycemicIndex","excluded");
    public function data(string $q, ?array $args)
    {
        $url = "https://edamam-recipe-search.p.rapidapi.com/search?q=$q";
        $append = "";
        if (isset($args)) {
            foreach ($args as $key => $val) {
                if (!in_array($key,self::$apiarglimits))
                {
                    return 'a wrong api parameter was inserted';
                }
                $append .= "&" . $key . "=" . $val;
            }
        }
        if (!array_key_exists("q=$q$append", self::$apiargs)) {
            $url .= $append;
            $response = wp_remote_get($url, array(
                'timeout' => 300,
                'httpversion' => '1.1',
                'headers' => array(
                    'X-RapidAPI-Key' => 'cafa3125b2msh6787cd3e1a59ffdp137c38jsnaf2104651e12',
                    'X-RapidAPI-Host' => 'edamam-recipe-search.p.rapidapi.com'
                )));
            if (is_wp_error($response)) {
                return 'something went wrong while getting data';
            } else {
                $response_data = wp_remote_retrieve_body($response);
                $decoded_data = json_decode($response_data, true);
                self::$apiargs["q=$q$append"] = $decoded_data;
                return $decoded_data;
            }
        } else {
            return self::$apiargs["q=$q$append"];
        }
    }
}


if (class_exists('RecipeBrowser')){
    $RecipeBrowser = new RecipeBrowser();
	$RecipeBrowser->register();
}