<?php
DEFINE ('DB_USER', 'dsonay');
DEFINE ('DB_PASSWORD', '5495');
DEFINE ('DB_HOST', 'fsor1.dhcp.bsu.edu');
DEFINE ('DB_NAME', 'dsonay');

// $dbc will contain a resource link to the database
// @ keeps the error from showing in the browser

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL: ' . mysqli_connect_error());


?>
