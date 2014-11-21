<a href='index.php'>Back to Home</a></br>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['table'])) {
   
 	$tablename = $_POST['table'];

    
    $query1 = "SELECT column_name FROM information_schema.columns 
    where table_name='".$tablename."'";
    $table_headers = @mysqli_query($dbc, $query1);

    $query2 = "SELECT * FROM ".$tablename."";
	$table_data = @mysqli_query($dbc, $query2);

	if($table_headers && $table_data){
		echo "<table>";
		echo '<tr>';
		while($rows = mysqli_fetch_array($table_headers, MYSQL_ASSOC)){	    
			
			foreach ($rows as $row) {
				echo '<th>' . $row . '</th>';
			}	
			
		}	
		echo '</tr>';
		while($rows2 = mysqli_fetch_array($table_data, MYSQL_ASSOC)){
			echo '<tr>';
			foreach ($rows2 as $row) {
				echo '<td>' . $row . '</td>';
			}
			echo '</tr>';
		}
		echo "</table>";
	}
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

}	
?>