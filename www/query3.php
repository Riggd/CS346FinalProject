<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['brand'])) {
    
	$brand = $_POST['brand'];

    $query = "SELECT
				SUM(
					CASE condition_level 
						WHEN '1' THEN price * .90
						WHEN '2' THEN price * .75
						WHEN '3' THEN price * .50
						WHEN '4' THEN price * .20
						ELSE price
					END)
				FROM equipment WHERE brand LIKE '$brand';";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		if ($brand == '%') {
			echo "<p>Total Inventory Value:</p>";
		} else {
			echo "<p>Total Value of " . $brand . " Inventory:</p>";
		}

		while($rows = mysqli_fetch_array($response, MYSQL_ASSOC)){
		    
			foreach ($rows as $row) {
				echo '<p>' . $row . '</p>';
			}	
		}
	} else {

		echo "Couldn't issue database query<br />";
		echo mysqli_error($dbc);

	}
	mysqli_close($dbc);
}
?>