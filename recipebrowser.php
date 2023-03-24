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
class recipebrowser
{

}
class Api
{
    //, "health", "cuisineType", "mealType", "dishType", "calories", "glycemicIndex", "excluded"
    public static array $apiargs = array();
    public static array $apiarglimits = array( 'diet' => array(
                                                    "balanced",
                                                    "high-protein",
                                                    "low-carb",
                                                    "low-fat"),
                                                'health' => array(
                                                    "alcohol-cocktail",
                                                    "alcohol-free",
                                                    "DASH",
                                                    "fodmap-free",
                                                    "immuno-supportive",
                                                    "keto-friendly",
                                                    "low-sugar",
                                                    "Mediterranean",
                                                    "peanut-free",
                                                    "pescatarian",
                                                    "sugar-conscious",
                                                    "sulfite-free",
                                                    "tree-nut-free",
                                                    "vegan",
                                                    "vegetarian",
                                                    "wheat-free"),
                                                'cuisineType' => array(
                                                    "American",
                                                    "Asian",
                                                    "British",
                                                    "Caribbean",
                                                    "Central Europe",
                                                    "Chinese",
                                                    "Eastern Europe",
                                                    "French",
                                                    "Indian",
                                                    "Italian",
                                                    "Japanese",
                                                    "Kosher",
                                                    "Mediterranean",
                                                    "Mexican",
                                                    "Middle Eastern",
                                                    "Nordic",
                                                    "South American",
                                                    "South East Asian"
                                                ),
                                                'mealType' => array(
                                                    "Breakfast",
                                                    "Dinner",
                                                    "Lunch",
                                                    "Snack",
                                                    "Teatime"),
                                                'dishType' => array(
                                                    "Biscuits and cookies",
                                                    "Bread",
                                                    "Cereals",
                                                    "Condiments and sauces",
                                                    "Desserts",
                                                    "Drinks",
                                                    "Main course",
                                                    "Pancake",
                                                    "Preps",
                                                    "Preserve",
                                                    "Salad",
                                                    "Sandwiches",
                                                    "Side dish",
                                                    "Soup",
                                                    "Starter",
                                                    "Sweets"));
    public static function data(string $q, ?array $args)
    {
        $url = "https://edamam-recipe-search.p.rapidapi.com/search?q=$q";
        $append = "";
        if (isset($args)) {
            foreach ($args as $key => $val) {
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
echo
"
<form action='' method='post'>
  <input type='submit' name='submit' value='Submit'>
    <input type='submit' name='submit2' value='Submit2'>
</form>
";
if (isset($_POST['submit'])) {
    foreach (Api::$apiarglimits as $key => $value) {
        foreach ($value as $key2 => $value2) {
            echo $key . " + " . $value2;
            echo "<br>";
            $result = Api::data('chicken', array($key => $value2));
            if (is_string($result)) {
                echo $result;
                echo "<br>";
                echo "<br>";
            }

        }
    }
}
if (isset($_POST['submit2'])) {
            $result = Api::data('chicken', array('diet' => 'gluten-free'));
            if (is_string($result)) {
                echo $result;
            }
}
