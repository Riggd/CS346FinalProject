<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['q2name'], $_POST['q2after'], $_POST['q2before'])) {
    
	$studentname = $_POST['q2name'];
	$transdateafter = $_POST['q2after'];
	$transdatebefore = $_POST['q2before'];

    $query = "SELECT T.t_number, STUDENT.fname, STUDENT.lname, T.Equip_id, T.condition_out, T.condition_in
    FROM TRANSACTIONS T
    INNER JOIN STUDENT
    ON T.s_ssn = STUDENT.ssn
    Where STUDENT.fname like '%$studentname%' 
    and T.trans_date > '$transdateafter' 
	and T.trans_date < '$transdatebefore'";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		echo "<table>";
		echo "<tr>
				<th>T_Number</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Equip_ID</th>
				<th>Condition Out</th>
				<th>Condition In</th>
			</tr>";
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