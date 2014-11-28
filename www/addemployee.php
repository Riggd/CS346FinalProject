<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['ssn'], $_POST['fname'], $_POST['mi'], $_POST['lname'], $_POST['dob'], 
	$_POST['start_date'], $_POST['super_ssn'])) {
    
	$ssn = $_POST['ssn'];
	$firstname = $_POST['fname'];
	$mi = $_POST['mi'];
	$lname = $_POST['lname'];
	$dob = $_POST['dob'];
	$start_date = $_POST['start_date'];
	$super_ssn = $_POST['super_ssn'];

    $query = "INSERT INTO EMPLOYEE (ssn, fname, mi, lname, dob, start_date, super_ssn)
    		  VALUES ('$ssn', '$firstname', '$mi', '$lname', '$dob', '$start_date', '$super_ssn')";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		echo "Success";
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>