<?php
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
							  <option value='gluten-free'>gluten-free</option>
							  <option value='low-sugar'>low-sugar</option>
							</select>
							<button type='submit'><i class='fa fa-search'></i></button>
						</form>
					</div>
				</div>
				</body>";
		}
		if ( isset( $_POST['q'] ) ) {
			$Api = new Api();
			$data = $Api->data($_POST['q'],array('diet'=>$_POST['diet'],'health'=>$_POST['health']));
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