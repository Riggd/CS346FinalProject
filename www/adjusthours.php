<a href='index.php'>Back to Home</a></br></br>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['worker_id'])) {
    
	$worker_id = $_POST['worker_id'];
	$new_hours = $_POST['new_hours'];

    $query = "UPDATE STUDENT_WORKERS
    		  SET hours_alloted = '$new_hours'
    		  WHERE s_ssn = '$worker_id'";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		echo "Query to adjust the hours was successful.";
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>