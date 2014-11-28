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

	$condition_level_query = "SELECT condition_name FROM conditions";
    $condition_names = @mysqli_query($dbc, $condition_level_query);	

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


	if ($tablename == 'employee') {
	?>
		<p><strong>To add an employee please enter the following data:</strong></p>
		<form action="addemployee.php" method="POST">
        	<label>Social Security Number:</label>
        	<input required  title="Expected pattern: '#########'" name="ssn" />
        	</br></br>
        	<label>First Name:</label>        	
        	<input type="text" name="fname" value="">
        	</br></br>
        	<label>MI:</label>
        	<input type="text" name="mi" value="">
        	</br></br>
        	<label>Last Name:</label>
        	<input type="text" name="lname" value="">
        	</br></br>
        	<label>Date of Birth:</label>
        	<input type="date" name="dob" value="">
        	</br></br>
        	<label>Start Date:</label>
        	<input type="date" name="start_date" value="">
        	</br></br>
        	<label>Supervisor SSN:</label>
        	<input type="text" name="super_ssn" value="">
			</br></br>
        	<input type="submit" value="Add Employee">
    	</form>
	<?php
	}
	if ($tablename == 'equipment') {


    	if($condition_names) {
    		while($names = mysqli_fetch_array($table_headers, MYSQL_ASSOC)){	    
			
					
			
				
	?>
		<p><strong>To add new equipment please enter the following data:</strong></p>
		<form action="addequipment.php" method="POST">
        	<label>Equipment ID:</label>
        	<input type="text" name="equip_id" />
        	</br></br>
        	<label>Brand:</label>        	
        	<input type="text" name="brand" value="">
        	</br></br>
        	<label>Product Name:</label>
        	<input type="text" name="product" value="">
        	</br></br>
        	<label>Purchase Date:</label>
        	<input type="date" name="purchase_date" value="">
        	</br></br>
        	<label>Price:</label>
        	<input type="decimal" name="price" value="">
        	</br></br>
        	<label>Condition Level:</label>
        		<select name="condition_level">
        			
        			<?php foreach ($names as $name): ?>
						 <option value="<?php echo $name; ?>"><?php echo $name ?></option> 
					<?php endforeach;?>
   				</select>
			</br></br>
        	<input type="submit" value="Enter New Equipment">
    	</form>
	<?php
			}
		}
	}
	if ($tablename == 'transaction') {
	?>
		<p><strong>To record a new transaction please enter the following data:</strong></p>
		<form action="addemployee.php" method="POST">
        	<label>Social Security Number:</label>
        	<input required pattern="^d{9}$" title="Expected pattern: '#########'" name="ssn" />
        	</br></br>
        	<label>First Name:</label>        	
        	<input type="text" name="fname" value="">
        	</br></br>
        	<label>MI:</label>
        	<input type="text" name="mi" value="">
        	</br></br>
        	<label>Last Name:</label>
        	<input type="text" name="lname" value="">
        	</br></br>
        	<label>Date of Birth:</label>
        	<input type="date" name="dob" value="">
        	</br></br>
        	<label>Start Date:</label>
        	<input type="date" name="start_date" value="">
        	</br></br>
        	<label>Supervisor SSN:</label>
        	<input type="text" name="super_ssn" value="">
			</br></br>
        	<input type="submit" value="Add Employee">
    	</form>
	<?php
}


	mysqli_close($dbc);

}	
?>