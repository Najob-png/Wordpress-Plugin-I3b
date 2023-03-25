<?php
include_once "Api.php";
class shortcodeyanni {
	public function __construct() {

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

							<select name='cuisineType'>";
							foreach (Api::$apiarglimits['cuisineType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>

							<select name='mealType'>";
							foreach (Api::$apiarglimits['mealType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>

							<select name='dishType'>";
							foreach (Api::$apiarglimits['dishType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<button type='submit'><i class='fa fa-search'></i></button>
						</form>
					</div>
				</div>
				<table>
				  <tr>
				    <th>Name</th>
				    
				  </tr>
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

							<select name='cuisineType'>";
			foreach (Api::$apiarglimits['cuisineType'] as $value){
				$string.="<option value='$value'>$value</option>";
			}


			$string.="</select>

							<select name='mealType'>";
			foreach (Api::$apiarglimits['mealType'] as $value){
				$string.="<option value='$value'>$value</option>";
			}


			$string.="</select>

							<select name='dishType'>";
			foreach (Api::$apiarglimits['dishType'] as $value){
				$string.="<option value='$value'>$value</option>";
			}


			$string.="</select>
							<button type='submit'><i class='fa fa-search'></i></button>
						</form>
					</div>
				</div>
				<table>
				  <tr>
				    <th>Name</th>
				    
				  </tr>
				</body>";

				foreach ($data['hits'] as $key => $value) {
					$lable = $value['recipe']['label'];
					$string .="	  
				  <tr>
				    <td>$lable</td>

				  </tr>
				  ";
				}

				echo "
				</table>
				</body>";
		}
		return $string;
	}
}
/*
 * This gives you all values out of the array with key and value. to access the array write Api::$apiarglimits
foreach (Api::$apiarglimits as $key => $value) {
    foreach ($value as $key2 => $value2) {
        echo $key . " + " . $value2;
        echo "<br>";
    }
}
*/