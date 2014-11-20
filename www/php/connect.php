<?php

	$link = mysql_connect('fsor1.dhcp.bsu.edu:3306','smith','0000'); 
	if (!$link)
	{ 
		die('Could not connect to MySQL: ' . mysql_error()); 
	}


	mysql_select_db("cs436spring2013",$link);

	$sql = "SELECT * FROM employee ORDER BY Lname";

	$result = mysql_query($sql, $link) or die(mysql_error());

	while (($resultArray = mysql_fetch_array($result)))
	{
		echo $resultArray['Fname'] . " " . $resultArray['Minit'] . " " .$resultArray['Lname'] . " " . $resultArray['Ssn'] . " " . $resultArray['Address'] ;
	}
	mysql_close($link); 

?> 