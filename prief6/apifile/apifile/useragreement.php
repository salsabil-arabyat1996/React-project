<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Connect to your database
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'contract-system';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $contract_id = $_POST['contract_id'];
    $status = $_POST['status'];

    // Prepare the SQL statement
    $sql = "INSERT INTO agreement (user_id, contract_id, status) VALUES ('$user_id', '$contract_id', $status)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Insertion successful
        echo "Agreement inserted successfully!";
    } else {
        // Error in insertion
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $user_id = 15; // Get the user_id from the request

    // Select records from the agreement table based on user_id
    $sql = "SELECT * FROM agreement WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    // Fetch the records as an associative array
    if ($result) {
        if ($result->num_rows > 0) {
            $records = [];
            while ($row = $result->fetch_assoc()) {
                // Get contract data based on contract_id
                $contractId = $row['contract_id'];
                $contractSql = "SELECT * FROM contracts WHERE id = $contractId";
                $contractResult = $conn->query($contractSql);
                if ($contractResult) {
                    $contractData = $contractResult->fetch_assoc();
                } else {
                    echo "Contract query error: " . $conn->error;
                    continue; // Skip to the next iteration
                }

                // Get user data based on user_id
                $userId = 15;
                $userSql = "SELECT * FROM users WHERE id = $userId";
                $userResult = $conn->query($userSql);
                if ($userResult) {
                    $userData = $userResult->fetch_assoc();
                } else {
                    echo "User query error: " . $conn->error;
                    continue; // Skip to the next iteration
                }

                // Combine agreement, contract, and user data
                $row['contract'] = $contractData;
                $row['user'] = $userData;

                $records[] = $row;
            }
            // Set the proper headers and encode as JSON
            header('Content-Type: application/json');
            echo json_encode($records);
        } else {
            echo "No records found";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();

?>
