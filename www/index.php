<html>
<head>
	<title>CS346 - Cameron Beasley, Derek Onay</title>
</head>
	
<body>
	<?php require_once('connect.php');?>
	<h1>Welcome to our final project!</h1>

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
</body>

</html>