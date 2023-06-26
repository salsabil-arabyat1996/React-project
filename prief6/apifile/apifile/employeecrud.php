<?php
header("Access-Control-Allow-Origin: http://localhost:3001");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");


$host = 'localhost';
$db = 'contract-system';
$user = 'root';
$pass = '';

$connection = new mysqli($host, $user, $pass, $db);

if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Create employee
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $phone = $_POST['phone'];
    
    // Insert into employee table
    $sql = "INSERT INTO employee (name, email, department,phone) VALUES ('$name', '$email', '$department', '$phone')";
    
    if ($connection->query($sql) === TRUE) {
        $response = ['success' => true, 'message' => 'Employee created successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Error creating employee: ' . $connection->error];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

// Read employees
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve all employees from the table
    $sql = "SELECT * FROM employee";
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        header('Content-Type: application/json');
        echo json_encode($employees);
    } else {
        $response = ['success' => false, 'message' => 'No employees found'];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents('php://input'), $_REQUEST);
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $department = $_REQUEST['department'];
    $phone = $_REQUEST['phone'];

    // Update the employee record
    $sql = "UPDATE employee SET name = '$name', email = '$email', department = '$department', phone = '$phone' WHERE id = '$id'";

    // Perform your database connection here (assuming you have a variable named $connection)
    // ...

    if ($connection->query($sql) === TRUE) {
        $response = ['success' => true, 'message' => 'Employee updated successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Error updating employee: ' . $connection->error];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
// Delete employee
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    $id = $_DELETE['id'];
    
    // Delete the employee record
    $sql = "DELETE FROM employee WHERE id = '$id'";
    
    if ($connection->query($sql) === TRUE) {
        $response = ['success' => true, 'message' => 'Employee deleted successfully'];
    } else {
        $response = ['success' => false, 'message' => 'Error deleting employee: ' . $connection->error];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$connection->close();
?>
