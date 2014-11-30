<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['employee'], $_POST['s_ssn'], $_POST['equip_id'], $_POST['condition_in'])) {
    
	$employee = $_POST['employee'];
	$s_ssn = $_POST['s_ssn'];
	$equip_id = $_POST['equip_id'];
	$condition_in_name = $_POST['condition_in'];

	$employeefullname = explode(" ", $employee);

	$employeefname = $employeefullname[0];
	$employeemi = $employeefullname[1];
	$employeelname = $employeefullname[2];

	$employeequery = "SELECT ssn FROM EMPLOYEE WHERE fname = '$employeefname' AND mi = '$employeemi' AND lname = '$employeelname'";

	$employeeresponse = @mysqli_query($dbc, $employeequery);
	while($employeessnarray = mysqli_fetch_array($employeeresponse, MYSQL_ASSOC)) {
		$employeessn = $employeessnarray[0];
	}
	
	// If the query executed properly proceed
	if($employeeresponse) {
		echo "Success";

		$conditionquery = "SELECT id FROM CONDITIONS WHERE condition_name = '$condition_in_name'";

		$conditionnumberresponse = @mysqli_query($dbc, $conditionquery);

		while($conditionidarray = mysqli_fetch_array($conditionnumberresponse, MYSQL_ASSOC)) {
			$conditioninid = $conditionidarray[0];
		}
		
		// If the query executed properly proceed
		if($conditionnumberresponse) {
			echo "Success";

			$conditionoutquery = "SELECT condition_level FROM EQUIPMENT WHERE equip_id = '$equip_id'";

			$conditionoutresponse = @mysqli_query($dbc, $conditionoutquery);

			while($conditionoutarray = mysqli_fetch_array($conditionoutresponse, MYSQL_ASSOC)) {
				$conditionoutid = $conditionoutarray[0];
			}

			if($conditionoutresponse) {
				echo "Success";

				$date = date('Y-m-d');

				$query = "INSERT INTO TRANSACTIONS (e_ssn, s_ssn, equip_id, trans_date, condition_out, condition_in)
	    			VALUES ('$employeessn', '$s_ssn', '$equip_id', '$date', '$conditionoutid', '$conditioninid')";

				$response = @mysqli_query($dbc, $query);

				if($response) {
					echo "Success";
				} else {
					echo "Couldn't issue database query<br />";
					echo mysqli_error($dbc);
				}
			} else {
				echo "Couldn't issue database query<br />";
				echo mysqli_error($dbc);
			}
		} else {
			echo "Couldn't issue database query<br />";
			echo mysqli_error($dbc);
		}

	} else {
		echo "Couldn't issue database query<br />";
		echo mysqli_error($dbc);

	}
	mysqli_close($dbc);
}
?>