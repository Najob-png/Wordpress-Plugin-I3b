<?php

class Api
{
    public static array $apiarglimits = array('diet' => array(
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

    public static function data(?array $args)
    {
        //var_dump($args);
        $url = "https://edamam-recipe-search.p.rapidapi.com/search?";
        $append = "";
        $qset = false;
        $fset = false;
        if (isset($args)) {
            if (array_key_exists('q', $args)) {
                $q = $args['q'];
                $append .= "q=$q";
            }
            if (is_int(array_key_first($args))) {
                $used = array();
                foreach ($args as $val) {
                    if (!isset($val) or strlen($val) < 1) {
                        continue;
                    }
                    $found = false;
                    foreach (Api::$apiarglimits as $key2 => $val2) {
                        if (in_array($val, $val2)) {
                            $append .= "&$key2=$val";

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
                        $append .= "&q=$val";
                        if ($qset) {
                            return "wrong parameters were set";
                        }
                        $qset = true;
                    }
                    if (!$fset) {
                        $append = substr($append, 1);
                        $fset = true;
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
                    if (!isset($val) or strlen($val) < 1) {
                        continue;
                    }
                    if (!array_key_exists($key, self::$apiarglimits)) {
                        return 'a wrong api parameter was inserted';
                    }
                    $append .= "&" . $key . "=" . $val;
                }
            }
            $url .= $append;
        }

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
            echo $url;
            return $decoded_data;
        }
    }
}