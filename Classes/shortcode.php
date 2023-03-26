<?php
include "Api.php";
class shortcode
{
    function enqueue(): void{
        wp_enqueue_style('recipe_plugin_style', plugins_url('../assets/style.css', __FILE__));
    }


	function shotrecipesearch(): string {
		if (!isset( $_POST['q'] ) ) {
			$string =
				"<body>
				<div class='topnav'>
					<div class='search-container'>
						<form action='' method='post'>
							<input type='text' placeholder='Search..' name='q'>
							<label for='diet'>diet:</label>

							<select name='diet'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['diet'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='health'>health:</label>
							<select name='health'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['health'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='cuisineType'>cuisinetype:</label>
							<select name='cuisineType'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['cuisineType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='mealType'>mealtype:</label>
							<select name='mealType'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['mealType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='dishType'>dishtype:</label>
							<select name='dishType'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['dishType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br><br>
							<button type='submit'>Submit</button>
						</form>
					</div>
				</div>
				<table>
				  <tr>
				    <th>Name</th>
				    <th>Picture</th>
				  </tr>
				</body>";
		}
		if ( isset( $_POST['q'] ) ) {

			$data = Api::data(array($_POST['q'],$_POST['diet'],$_POST['health'],$_POST['cuisineType'],$_POST['mealType'],$_POST['dishType']));
			if(is_string($data)){
				return "<body>
				<a>$data</a>
				</body>";

			}
			$string =
				"<body>

				<div class='topnav'>
					
					<div class='search-container'>
						<form action='' method='post'>
							<input type='text' placeholder='Search..' name='q'>
							<label for='diet'>diet:</label>

							<select name='diet'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['diet'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='health'>health:</label>
							<select name='health'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['health'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='cuisineType'>cuisinetype:</label>
							<select name='cuisineType'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['cuisineType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='mealType'>mealtype:</label>
							<select name='mealType'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['mealType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='dishType'>dishtype:</label>
							<select name='dishType'>";
							$string.="<option value=''></option>";
							foreach (Api::$apiarglimits['dishType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br><br>
							<button type='submit'>Submit</button>
						</form>
					</div>
				</div>
				<table>
				  <tr>
				    <th>Name</th>
				    <th>Picture</th>
				    <th>Ingredients</th>
				  </tr>
				</body>";

			foreach ($data['hits'] as $key => $value) {
				$url = $value['recipe']['url'];
				$image = $value['recipe']['image'];
				$lable = $value['recipe']['label'];
				$string .="	  
				  
				  <tr>
				    <td>$lable</td>
                    <td><a href='$url ' target='_blank'><img src='$image'width='125' height='150' alt='no image found'></a> </td>
                    <td>
                    <table>
                    ";



                foreach ($value['recipe']['ingredientLines'] as $value2) {
                    $string .= "<td>$value2</td>";
                };
                $string .="
                </table>
                </td>
				  </tr>
				  ";
			}

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

			$data = Api::data(array($ingredient, 'Breakfast'));
			$data1 = Api::data(array($ingredient, 'Lunch'));
			$data2 = Api::data(array($ingredient, 'Dinner'));

			$field = '<form action="" method="post">
      <input type="text" name="ingredient" title="ingredient" id="ingredient" placeholder="Search...">
        <input type="submit" name="submit" id="submit"> 
        
        
</form>';

			$label = $data['hits'][$meal_number]['recipe']['label'];
			$url = $data['hits'][$meal_number]['recipe']['url'];
			$image = $data['hits'][$meal_number]['recipe']['image'];

			$label1 = $data1['hits'][$meal_number]['recipe']['label'];
			$url1 = $data1['hits'][$meal_number]['recipe']['url'];
			$image1 = $data1['hits'][$meal_number]['recipe']['image'];

			$label2 = $data2['hits'][$meal_number]['recipe']['label'];
			$url2 = $data2['hits'][$meal_number]['recipe']['url'];
			$image2 = $data2['hits'][$meal_number]['recipe']['image'];



			$field .= "<br> <p>Breackfast</p><br><p>$label</p> <br>
                         <a href=$url><img src='$image' width='250' height='300' alt='img was not found'></a>
                        ";
			foreach ($data['hits'][$meal_number]['recipe']['ingredientLines'] as $item => $value) {

				$field .= " <p>$value</p>";
			}
			$field .= "<br> <p>Lunch</p><br><p>$label1</p> <br>
                        <a href=$url1><img src='$image1' width='250' height='300' alt='img was not found'> </a>
                        ";
			foreach ($data1['hits'][$meal_number]['recipe']['ingredientLines'] as $item => $value) {

				$field .= "<p>$value</p> ";
			}

			$field .= "<br><p>Dinner</p><br><br> <p>$label2</p> <br>
                        <a href=$url2><img src='$image2' width='250' height='300' alt='img was not found'></a>
                        ";
			foreach ($data2['hits'][$meal_number]['recipe']['ingredientLines'] as $item => $value) {

				$field .= " <p>$value</p> ";
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