<html>
<head>
	<title>CS346 - Cameron Beasley, Derek Onay</title>
    <style>
    html {
        background-color: #D1F0FF;
        margin: 2rem;
    }
    </style>
</head>	
<body>
	<?php require_once('connect.php');?>
	<h1>Beasley-Onay Rentals&copy;</h1>

    <h2>P.O.S. Tools</h2>	

    <h4>New Transaction</h4>
    <form action="addtransaction.php" method="POST">
        <label>Employee:</label>
            <select required name="employee">                 
                <?php
                    $cemployee_query = "SELECT CONCAT(fname, ' ', mi, ' ', lname) FROM employee ORDER BY lname";
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
    <h2>Admin Tools</h2>

    <p><h4>Query 1:</h4>
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

    <p><h4>Query 2:</h4>
       Transaction Lookup
    </p>
    <form action="query2.php" method="POST">
        Enter a student name:<input type="text" name="q2name" value=""><br/><br/>
        Enter date range:<br/>
            After: <input type="date" name="q2after">
            Before: <input type="date" name="q2before"><br/><br/>
        <input type="submit" value="Find Table">
    </form>

    <p><h4>Query 3:</h4>
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
                    $brandsquery = "SELECT DISTINCT brand FROM EQUIPMENT";
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