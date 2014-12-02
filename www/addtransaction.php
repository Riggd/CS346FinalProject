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
		foreach($employeessnarray as $rowvalues){

			$employeessn = $rowvalues;
		}
	}
	
	// If the query executed properly proceed
	if($employeeresponse) {

		$conditionquery = "SELECT id FROM CONDITIONS WHERE condition_name = '$condition_in_name'";

		$conditionnumberresponse = @mysqli_query($dbc, $conditionquery);

		while($conditionidarray = mysqli_fetch_array($conditionnumberresponse, MYSQL_ASSOC)) {
			foreach($conditionidarray as $cond){
				$conditioninid = $cond;
			}
		}
		
		// If the query executed properly proceed
		if($conditionnumberresponse) {
			$conditionoutquery = "SELECT condition_level FROM EQUIPMENT WHERE equip_id = '$equip_id'";

			$conditionoutresponse = @mysqli_query($dbc, $conditionoutquery);

			while($conditionoutarray = mysqli_fetch_array($conditionoutresponse, MYSQL_ASSOC)) {
				foreach($conditionoutarray as $cond){
					$conditionoutid = $cond;
				}
			}

			if($conditionoutresponse) {
				$date = date('Y-m-d');

				$query = "INSERT INTO TRANSACTIONS (e_ssn, s_ssn, equip_id, trans_date, condition_out, condition_in)
	    			VALUES ('$employeessn', '$s_ssn', '$equip_id', '$date', '$conditionoutid', '$conditioninid')";

				$response = @mysqli_query($dbc, $query);

				if($response) {
					echo "Successfully added a new transaction.";

					$query2 = "UPDATE EQUIPMENT SET condition_level = '$conditioninid' WHERE equip_id = '$equip_id'";

					$response2 = @mysqli_query($dbc, $query2);

					if($response2) {
						echo "Successfully updated equipment.";
						
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

	} else {
		echo "Couldn't issue database query<br />";
		echo mysqli_error($dbc);

	}
	mysqli_close($dbc);
}
?>