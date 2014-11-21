<a href='index.php'>Back to Home</a>
<?php
require_once('connect.php');

if(isset($_POST['table'])) {
    
    $query = "SELECT * FROM ".$_POST['table']."";
	$response = @mysqli_query($dbc, $query);

	// If the query executed properly proceed
	if($response){
		echo "<table>";

		while($rows = mysqli_fetch_array($response, MYSQL_ASSOC)){
			echo "<tr>";
		    
			foreach ($rows as $row) {

				echo '<td>' . $row . '</td>';
			}	

			echo "</tr>";
		}
		echo "</table";
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>