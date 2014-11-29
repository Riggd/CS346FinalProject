<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['r_equip_id'])) {
    
	$equip_id = $_POST['r_equip_id'];

    $query = "DELETE FROM EQUIPMENT
    		  WHERE equip_id = '$equip_id'";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		echo "Equipment Removed";
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>