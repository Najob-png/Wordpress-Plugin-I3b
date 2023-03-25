<?php
include_once 'Api.php';
class randomshort
{
// Add Shortcode
    public function __construct()
    {
    }
        function rand_meal_shortcode(): string
        {


            if (isset($_POST['ingredient'])) {
                $ingredient = $_POST['ingredient'];
                $meal_number = mt_rand(1, 10);

                $data = Api::data($ingredient, array('high-protein'));
                $field = '<form action="" method="post">
      <input type="text" name="ingredient" title="ingredient" id="ingredient" placeholder="Search...">
        <input type="submit" name="submit" id="submit"> 
        
        
</form>';

                $label = $data['hits'][$meal_number]['recipe']['label'];
                $url = $data['hits'][$meal_number]['recipe']['url'];
                $image = $data['hits'][$meal_number]['recipe']['image'];


                $field .= "<br> <p>$label</p> <br>
                        <a href=$url>$url</a><br>
                         <img src='$image' width='250' height='300'> 
                        ";
                foreach ($data['hits'][$meal_number]['recipe']['ingredientLines'] as $item => $value) {

                    $field .= "<br> <p>$value</p> <br>";
                }

            } else {
                $field = '<form action="" method="post">
      <input type="text" name="ingredient" title="ingredient" id="ingredient" placeholder="Search...">
        <input type="submit" name="submit" id="submit"> 
        
        
</form>';

            }

            return $field;

        }

    }

