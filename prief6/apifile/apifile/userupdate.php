<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contract-system";

// Create a new connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

// Extract the values
$email = $data['email'];
$password = $data['password'];
$image = $data['image'];
$name = $data['name'];

// Perform the update operation using the retrieved values
$sql = "UPDATE users SET password = '$password', image = '$image', name = '$name' WHERE email = '$email'";

if ($connection->query($sql) === TRUE) {
    // Return a success message
    $response = ['message' => 'User data updated successfully'];
    echo json_encode($response);
} else {
    // Return an error message
    $response = ['message' => 'Error updating user data: ' . $connection->error];
    echo json_encode($response);
}

// Close the connection
$connection->close();

?>
