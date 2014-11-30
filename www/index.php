<html>
<head>
	<title>CS346 - Cameron Beasley, Derek Onay</title>
</head>	
<body>
	<?php require_once('connect.php');?>
	<h1>Welcome to our final project!</h1>

    <h3>P.O.S. Tools</h3>	

    <p>New Transaction</p>
    <form action="addtransaction.php" method="POST">
        <label>Employee:</label>
            <select required name="employee">                 
                <?php
                    $cemployee_query = "SELECT fname, mi, lname FROM employee ORDER BY lname";
                    $employee_names = @mysqli_query($dbc, $cemployee_query);

                    while($names = mysqli_fetch_array($employee_names, MYSQL_ASSOC)) {
                        foreach ($names as $name): ?>
                          <option value="<?php echo $name; ?>"><?php echo $name ?></option> 
                    <?php endforeach;
                }?>
            </select>
        </br></br>
        <label>Student ID:</label>
        <input required  title="Expected pattern: '#########'" name="s_ssn" />
        </br></br>
        <label>Equipment ID:</label>
        <input required  title="Expected pattern: 'BSU-###'" name="equip_id" />
        </br></br>
        <label>Condition Level On Return:</label>
            <select required name="condition_in">                 
                <?php
                    $condition_level_query = "SELECT condition_name FROM conditions";
                    $condition_names = @mysqli_query($dbc, $condition_level_query);
                    
                    while($names = mysqli_fetch_array($condition_names, MYSQL_ASSOC)) {
                        foreach ($names as $name): ?>
                          <option value="<?php echo $name; ?>"><?php echo $name ?></option> 
                    <?php endforeach;
                }?>
            </select>
        </br></br>
        <input type="submit" value="New Transaction">
    </form>

    <hr />
    <h3>Admin Tools</h3>

    <p>Query 1:</br>
       Choose which table you would like to see all records from:
    </p>
    <form action="query1.php" method="POST">
        <select name="table">
            <option value='employee'>Employees</option>
            <option value='student'>Student</option>
            <option value='student_workers'>Student_Workers</option>
            <option value='equipment'>Equipment</option>
            <option value='transactions'>Transactions</option>
        </select>
        <input type="submit" value="Find Table">
    </form>

    <p>Query 2:</br>
       Transaction Lookup
    </p>
    <form action="query2.php" method="POST">
        Enter a student name:<input type="text" name="q2name" value="">
        Enter date range:<br/><br/>
            After: <input type="date" name="q2after">
            Before: <input type="date" name="q2before">
        <input type="submit" value="Find Table">
    </form>

    <p>Query 3:</br>
       Current Value of Inventory
        <ul>
            <li>New - 90% of list price</li>
            <li>Good - 75%</li>
            <li>Worn - 50%</li>
            <li>Replace - 20%</li>
        </ul>
    </p>
    <form action="query3.php" method="POST">
        <label>Select All or Specific Brand to value:</label>
            <select required name="brand">
                <option value="%">All Inventory Items</option>
                <?php
                    $brandsquery = "SELECT brand FROM EQUIPMENT";
                    $brands = @mysqli_query($dbc, $brandsquery);
                    
                    while($names = mysqli_fetch_array($brands, MYSQL_ASSOC)) {
                        foreach ($names as $name): ?>
                          <option value="<?php echo $name; ?>"><?php echo $name ?></option> 
                    <?php endforeach;
                }?>
            </select>
        </br></br>
        <input type="submit" value="Value Inventory">
    </form>

</body>

</html>