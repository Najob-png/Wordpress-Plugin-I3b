<?php
include_once "Api.php";
class shortcodeyanni {
	public function __construct() {

	}

	function shortcodeyanni(): string {
		if (!isset( $_POST['q'] ) ) {
			$string =
				"<body>

				<div class='topnav'>
					
					<div class='search-container'>
						<form action='' method='post'>
							<input type='text' placeholder='Search..' name='q'>
							<label for='diet'>diet:</label>

							<select name='diet'>";
							foreach (Api::$apiarglimits['diet'] as $value){
								$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='health'>health:</label>
							<select name='health'>";
							foreach (Api::$apiarglimits['health'] as $value){
								$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='cuisineType'>cuisinetype:</label>
							<select name='cuisineType'>";
							foreach (Api::$apiarglimits['cuisineType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='mealType'>mealtype:</label>
							<select name='mealType'>";
							foreach (Api::$apiarglimits['mealType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='dishType'>dishtype:</label>
							<select name='dishType'>";
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
							<label for='diet'>diet:</label>

							<select name='diet'>";
							foreach (Api::$apiarglimits['diet'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='health'>health:</label>
							<select name='health'>";
							foreach (Api::$apiarglimits['health'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='cuisineType'>cuisinetype:</label>
							<select name='cuisineType'>";
							foreach (Api::$apiarglimits['cuisineType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select>
							<label for='mealType'>mealtype:</label>
							<select name='mealType'>";
							foreach (Api::$apiarglimits['mealType'] as $value){
							$string.="<option value='$value'>$value</option>";
							}


							$string.="</select><br>
							<label for='dishType'>dishtype:</label>
							<select name='dishType'>";
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
				    
				  </tr>
				</body>";

				foreach ($data['hits'] as $key => $value) {
					$url = $value['recipe']['url'];
					$image = $value['recipe']['image'];
					$lable = $value['recipe']['label'];
					$string .="	  
				  
				  <tr>
				    <td>$lable</td>
                    <td><a href='$url ' target='_blank'><img src='$image'width='125' height='150'></a> </td>
                    

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
