<?php
include "Api.php";
class shortcode
{
    function enqueue(){
        wp_enqueue_style('recipe_plugin_style', plugins_url('/assets/style.css', __FILE__));
    }


    function testShortcode(): string {
        if (!isset( $_POST['q'] ) ) {
            $string =
                "<body>

				<div class='topnav'>
				    
					<div class='search-container'>
						<form action='' method='post'>
							<input type='text' placeholder='Search..' name='q'>
							<label for='diet'>Choose a diet:</label>

							<select name='diet'>";
            foreach (Api::$apiarglimits['diet'] as $value){
                $string.="<option value='$value'>$value</option>";
            }


            $string.="</select>
							
							<select name='health'>";
            foreach (Api::$apiarglimits['health'] as $value){
                $string.="<option value='$value'>$value</option>";
            }


            $string.="</select>
							<button type='submit'><i class='fa fa-search'></i></button>
						</form>
					</div>
				</div>
				</body>";
        }
        if ( isset( $_POST['q'] ) ) {

            $data = Api::data($_POST['q'],array('diet'=>$_POST['diet'],'health'=>$_POST['health']));
            $string =
                "<body>

				<div class='topnav'>
					
					<div class='search-container'>
						<form action='' method='post'>
							<input type='text' placeholder='Search..' name='q'>
							<label for='diet'>Choose a diet:</label>

							<select name='diet'>
							  <option value='balanced'>balanced</option>
							  <option value='high-fiber'>high-fiber</option>
							  <option value='high-protein'>high-protein</option>
							  <option value='low-carb'>low-carb</option>
							  <option value='low-fat'>low-fat</option>
							  <option value='low-sodium'>low-sodium</option>
							</select>
							
							<label for='health'>Choose health:</label>

							<select name='health'>
							  <option value='vegan'>vegan</option>
							  <option value='vegetarian'>vegetarian</option>
							  <option value='low-sugar'>low-sugar</option>
							</select>
							<button type='submit'><i class='fa fa-search'></i></button>
						</form>
					</div>
				</div>
				<table>
				  <tr>
				    <th>Name</th>
				    
				  </tr>
				  ";
            var_dump($data);
            /*foreach ($data['hits'] as $key => $value) {
                $lable = $value['recipe']['label'];
                $string .="
              <tr>
                <td>$lable</td>

              </tr>
              ";
            }*/

            echo "
				</table>
				</body>";
        }
        return $string;
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
            $field .= "<br> <p>$label</p>";

        } else {
            $field = '<form action="" method="post">
      <input type="text" name="ingredient" title="ingredient" id="ingredient" placeholder="Search...">
        <input type="submit" name="submit" id="submit"> 
        
        
</form>';

        }

        return $field;

    }
}