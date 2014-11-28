<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['r_ssn'], $_POST['r_fname'], $_POST['r_mi'], $_POST['r_lname'])) {
    
	$ssn = $_POST['r_ssn'];
	$firstname = $_POST['r_fname'];
	$mi = $_POST['r_mi'];
	$lname = $_POST['r_lname'];

    $query = "DELETE FROM EMPLOYEE
    		  WHERE ssn = '$ssn' AND fname = '$firstname' AND mi = '$mi' AND lname = '$lname'";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		echo "Record Removed";
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>