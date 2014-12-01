<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['r_trans_id'])) {
    
	$t_number = $_POST['r_trans_id'];

    $query = "DELETE FROM TRANSACTIONS
    		  WHERE t_number = '$t_number'";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		echo "Transaction Removed";
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>