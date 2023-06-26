<?php
// Allow requests from any origin
header("Access-Control-Allow-Origin: *");

// Allow specific HTTP methods
header("Access-Control-Allow-Methods: GET");

// Set the Content-Type header to JSON
header("Content-Type: application/json");

// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contract-system";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the ID parameter from the URL
$id = $_GET['id'];

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM contracts WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();

// Fetch the result
$result = $stmt->get_result();

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Fetch the data as an associative array
    $data = $result->fetch_assoc();

    // Convert the data to JSON and send the response
    echo json_encode($data);
} else {
    // No data found for the given ID
    echo json_encode(array('error' => 'No contract found.'));
}

// Close the database connection
$stmt->close();
$conn->close();
?>
