<?php
// Get a connection for the database
require_once('connect.php');

if(isset($_POST['table'])) {
    
    $query = "SELECT * FROM ".$_POST['table']."";


	// Get a response from the database by sending the connection
	// and the query
	$response = @mysqli_query($dbc, $query);

	// If the query executed properly proceed
	if($response){
	echo '<table align="left"
	cellspacing="5" cellpadding="8">

	<tr><td align="left"><b>First Name</b></td>
	<td align="left"><b>Last Name</b></td>
	<td align="left"><b>Email</b></td>
	<td align="left"><b>Street</b></td>
	<td align="left"><b>City</b></td>
	<td align="left"><b>State</b></td>
	<td align="left"><b>Zip</b></td>
	<td align="left"><b>Phone</b></td>
	<td align="left"><b>Birth Day</b></td></tr>';

	// mysqli_fetch_array will return a row of data from the query
	// until no further data is available
	while($rows = mysqli_fetch_array($response)){

	$rowcount = mysqli_num_rows($response);

	echo '<tr><td align="left">';
	foreach ($rows as $row) {
	 	# code...
	 	echo $row;
	 }
	 /* 
	$row['Ssn'] . '</td><td align="left">' .
	$row['University_ID'] . '</td><td align="left">'. 
	$row['Fname'] . '</td><td align="left">' . 
	$row['MI'] . '</td><td align="left">' .
	$row['Lname'] . '</td><td align="left">' . 
	$row['DOB'] . '</td><td align="left">' .
	$row['Major'] . '</td><td align="left">' . 
	$row['Enrollment_Date'] . '</td><td align="left">' .
	$row['Graduation_Date'] . '</td><td align="left">';
	*/
	echo '</tr>';
	}

	//echo '</table>';

	} else {

	echo "Couldn't issue database query<br />";

	echo mysqli_error($dbc);

	}

	// Close connection to the database
	mysqli_close($dbc);
}
?>