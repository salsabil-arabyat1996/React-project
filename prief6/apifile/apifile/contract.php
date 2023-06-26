<?php


header('Access-Control-Allow-Origin: *');

$conn = new mysqli("localhost","root","","contract-system");

if(mysqli_connect_error()){
	echo mysqli_connect_error();
	exit();
}
$query = "SELECT * FROM contracts";
$result = mysqli_query($conn, $query);

// Store the fetched data in an array
$contracts = array();
while ($row = mysqli_fetch_assoc($result)) {
    $contracts[] = $row;
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($contracts);
?>
