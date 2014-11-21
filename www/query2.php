<a href='index.php'>Back to Home</a>
<?php
require_once('connect.php');
/*
$studentname = $_POST['q2name'];
$transdateafter = $_POST['q2after'];
$transdatebefore = $_POST['q2before'];
*/
if(isset($_POST['q2name'], $_POST['q2after'], $_POST['q2before'])) {
    
	$studentname = $_POST['q2name'];
	$transdateafter = $_POST['q2after'];
	$transdatebefore = $_POST['q2before'];

    $query = "SELECT T.T_Number, S.FName, S.LName, T.Equip_id, T.Condition_in, T.Condition_out
    FROM TRANSACTIONS T
    Where Transations.Trans_date > 2006-05-21 
	and T.Trans_date < 2014-11-20
    INNER JOIN STUDENT
    ON T.S_SSN = STUDENT.SSN";

	$response = @mysqli_query($dbc, $query);

	// If the query executed properly proceed
	if($response){
		echo "<table>";

		while($rows = mysqli_fetch_array($response, MYSQL_ASSOC)){
			echo "<tr>";
		    
			foreach ($rows as $row) {

				echo '<td>' . $row/*[$studentname]*/ . '</td>';
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