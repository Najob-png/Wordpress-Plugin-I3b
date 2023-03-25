<?php

class Api
{
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
        // args = array of string
        if (isset($args)) {
            if (count($args) != count($args, COUNT_RECURSIVE)) {
                $used = array();
                foreach ($args as $val) {
                    $found = false;
                    foreach (Api::$apiarglimits /* array(argLim) of arrays ($val2) */ as $key2 => $val2) {
                        if (in_array($val, $val2)) {
                            $append .= "&" . $key2 . "=" . $val;
                            if (isset($used[$key2])) {
                                $used[$key2] += 1;
                            } else {
                                $used[$key2] = 1;
                            }
                            if ($used[$key2] > 1) {
                                return "too many parameters were set";
                            }
                            $found = true;
                        }
                    }
                    if (!$found) {
                        return "wrong parameters were set";
                    }
                }
                /*
                 * this is a different way to do the code above but I don't now which is faster and I haven't had the chance to check which one is faster.
                $used = false;
                foreach (Api::$apiarglimits as $key => $val) {
                    $val2 = array_intersect($args, $val);
                    if (count($val2)==1) {
                        $append .= "&" . $key . "=" . $val2['0'];
                        $used = true;
                    } else {
                            return "to many parameters where set";
                      }
                }
                if (!$used) {
                    return "wrong parameters where set";
                }
                */
            } else {
                foreach ($args as $key => $val) {
                    if (!in_array($key,self::$apiarglimits))
                    {
                        return 'a wrong api parameter was inserted';
                    }
                    $append .= "&" . $key . "=" . $val;
                }
            }
            $url .= $append;
        }

        if (!array_key_exists("q=$q$append", self::$apiargs)) {
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