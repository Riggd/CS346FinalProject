<?php
require_once('connect.php');

if(isset($_POST['table'])) {
    
    $query = "SELECT DISTINCT * FROM ".$_POST['table']."";
	$response = @mysqli_query($dbc, $query);

	// If the query executed properly proceed
	if($response){
		while($rows = mysqli_fetch_array($response, MYSQL_ASSOC)){
			foreach ($rows as $row) {
				echo $row . '</br>';
			}	
		}
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>