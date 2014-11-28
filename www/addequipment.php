<a href='index.php'>Back to Home</a>
<style>
table, th, td {
	border: 1px solid black;
}
</style>
<?php
require_once('connect.php');

if(isset($_POST['equip_id'], $_POST['brand'], $_POST['product'], $_POST['purchase_date'], $_POST['price'], 
	$_POST['condition_level'])) {
    
	$equip_id = $_POST['equip_id'];
	$brand = $_POST['brand'];
	$product = $_POST['product'];
	$purchase_date = $_POST['purchase_date'];
	$price = $_POST['price'];
	$condition_level = $_POST['condition_level'];

	if($condition_level == "New") {
		$condition_level = 1;
	}
	else if($condition_level == "Good") {
		$condition_level = 2;
	}
	else if($condition_level == "Warn") {
		$condition_level = 3;
	}
	else {
		$condition_level = 4;
	}

    $query = "INSERT INTO EQUIPMENT (equip_id, brand, product, purchase_date, price, condition_level)
    		  VALUES ('$equip_id', '$brand', '$product', '$purchase_date', '$price', '$condition_level')";

	$response = @mysqli_query($dbc, $query);
	
	// If the query executed properly proceed
	if($response){
		echo "Success";
	} 
	else {

	echo "Couldn't issue database query<br />";
	echo mysqli_error($dbc);

	}

	mysqli_close($dbc);

	}
?>