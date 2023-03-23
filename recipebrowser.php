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

require_once("admin-panel.php");
$adminPanel = new Admin();

class RecipeBrowser
{

    public function data(string $q, string $d)
    {
        $response = wp_remote_get("https://edamam-recipe-search.p.rapidapi.com/search?q=$q&diet=$d",array(
            'timeout' => 300,
            'httpversion' => '1.1',
            'headers' => array(
            'X-RapidAPI-Key' => 'cafa3125b2msh6787cd3e1a59ffdp137c38jsnaf2104651e12',
            'X-RapidAPI-Host' => 'edamam-recipe-search.p.rapidapi.com'
            )));
        if ( is_wp_error( $response ) )
        {
            return 'something went wrong while getting data';
        } else 
        {
            $response_data = wp_remote_retrieve_body( $response );
            $decoded_data = json_decode( $response_data, true );
            return $decoded_data;
        }
    }
}