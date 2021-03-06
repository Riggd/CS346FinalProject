<a href='index.php'>Back to Home</a></br></br>
<style>
html {
    background-color: #D1F0FF;
}
table, th, td {
	border: 1px solid black;
}
body {
    margin-left: 2rem;
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
    <div style="float:left;">
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
    </div>
    <div style="float:left; margin-left: 4em;">
        <p><strong>To delete an employee please enter the following data:</strong></p>
        <form action="removeemployee.php" method="POST">
            <label>Social Security Number:</label>
            <input required  title="Expected pattern: '#########'" name="r_ssn" />
            </br></br>
            <label>First Name:</label>          
            <input type="text" name="r_fname" value="">
            </br></br>
            <label>MI:</label>
            <input type="text" name="r_mi" value="">
            </br></br>
            <label>Last Name:</label>
            <input type="text" name="r_lname" value="">
            </br></br>
            <input type="submit" value="Delete Employee">
        </form>
    </div>
	<?php
	}
	if ($tablename == 'equipment') {
    	if($condition_names) {
    		    
	?>
    <div style="float:left;">
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
                    <?php 
                        while($names = mysqli_fetch_array($condition_names, MYSQL_ASSOC)) {
                            foreach ($names as $name): ?>
    						  <option value="<?php echo $name; ?>"><?php echo $name ?></option> 
					   <?php endforeach;
                        }
                    ?>
   				</select>
			</br></br>
        	<input type="submit" value="Enter New Equipment">
    	</form>
    </div>
    <div style="float:left; margin-left: 4em;">
        <p><strong>To delete equipment please enter the following data:</strong></p>
        <form action="removeequipment.php" method="POST">
            <label>Equip ID:</label>
            <input required name="r_equip_id" />
            </br></br>
            <input type="submit" value="Delete Equipment">
        </form>
    </div>
    <?php
        }
    }
    if ($tablename == 'transactions') {
        if($condition_names) {
                
    ?>
        <p><strong>To delete an incorrect transactions please enter the following data:</strong></p>
        <form action="removetransaction.php" method="POST">
            <label>Transaction ID:</label>
            <input required name="r_trans_id" />
            </br></br>
            <input type="submit" value="Delete Transaction">
        </form>
    <?php
        }
    }
    if($tablename == 'student_workers') {
        if($condition_names) {
    ?>
        <p><strong>To adjust the hours allotted please enter the following data:</strong></p>
        <form action="adjusthours.php" method="POST">
            <label>Student ID:</label>
            <input required name="worker_id" />
            </br></br>
            <label>New hour amount:</label>
            <input required name="new_hours" />
            </br></br>
            <input type="submit" value="Adjust Hours">
        </form>
    <?php
        }
    }

	mysqli_close($dbc);

}	
?>