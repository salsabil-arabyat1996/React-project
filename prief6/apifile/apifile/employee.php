<?php
header("Access-Control-Allow-Origin: http://localhost:3001");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contract-system";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user inputs
function sanitize_input($input)
{
    global $conn;
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    $input = $conn->real_escape_string($input);
    return $input;
}

// Create a new record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input data
    $name = sanitize_input($_POST["name"]);
    $description = sanitize_input($_POST["description"]);
    $detail = sanitize_input($_POST["detail"]);
    $price = sanitize_input($_POST["price"]);
    $number = sanitize_input($_POST["number"]);

    // Create the "uploads" directory if it doesn't exist
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir);
    }

    // File upload
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

    // Insert the record into the database
    $sql = "INSERT INTO contracts (name, description, detail, price, employee_id, image) VALUES ('$name', '$description', '$detail', '$price', '$number', '$targetFile')";
    if ($conn->query($sql) === TRUE) {
        echo "Record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Update an existing record
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    // Parse the raw data from the request
    $data = json_decode(file_get_contents("php://input"), true);

    // Sanitize the input data
    // ...

    // Extract the values from the data
    $id = $data["id"];
    $name = $data["name"];
    $description = $data["description"];
    $detail = $data["detail"];
    $price = $data["price"];
    $number = $data["number"];
    echo $number;
    // Update the record in the database
    $sql = "UPDATE contracts SET name = '$name', description = '$description', detail = '$detail', price = '$price', employee_id = '$number' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Delete a record
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    // Parse the raw data from the request
    $data = json_decode(file_get_contents("php://input"), true);

    // Sanitize the input data
    $id = sanitize_input($data["id"]);

    // Delete the record from the database
    $sql = "DELETE FROM contracts  WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Retrieve all records
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Select all records from the database
    $sql = "SELECT * FROM contracts";
    $result = $conn->query($sql);

    // Fetch the records as an associative array and encode as JSON
    if ($result) {
        if ($result->num_rows > 0) {
            $records = [];
            while ($row = $result->fetch_assoc()) {
                $records[] = $row;
            }
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
