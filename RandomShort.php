<?php

class RandomShort
{
// Add Shortcode
    function rand_meal_shortcode()
    {
        $RecipeBrowser = new RecipeBrowser();

        echo'<form action="" method="post">
      <input type="text" name="ingredient" title="ingredient" id="ingredient">
        <input type="submit" name="submit" id="submit"> 
        
        
</form>';

        if (isset($_POST['submit'])) {
            $ingredient = $_POST['ingredient'];
            $meal_number = mt_rand(1, 10);

            $data = $RecipeBrowser->data($ingredient, 'high-protein');
            echo ($data['hits'][$meal_number]['recipe']['label']);
        }
    }

    function register()
    {
        add_shortcode('randmeal', 'rand_meal_shortcode');
    }
}

