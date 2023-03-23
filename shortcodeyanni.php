
<?php
$Api = new Api();
class shortcodeyanni {
public function __construct(){

}
function testShortcode(): String {
$string = '<body>

<div class="topnav">
	
	<div class="search-container">
		<form action="/shortcodeyanni.php">
			<input type="text" placeholder="Search.." name="search">
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>
	</div>
</div>



</body>';
return $string;
}
}