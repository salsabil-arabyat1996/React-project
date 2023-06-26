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

// Retrieve the user_id from the request body
$user_id = $_POST['user_id'];

// Fetch user data from the database
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $connection->query($sql);

if ($result && $result->num_rows > 0) {
    $userData = $result->fetch_assoc();

    // Return user data as JSON response
    echo json_encode($userData);
} else {
    // If user not found, return an empty JSON object
    echo json_encode([]);
}

// Close the database connection
$connection->close();

?>
