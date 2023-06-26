<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Max-Age: 86400');
header('Content-Type: application/json');

$connection = mysqli_connect('localhost', 'root', '', 'contract-system');

if (!$connection) {
    die('Database connection failed: ' . mysqli_connect_error());
}
echo $_POST['id'];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['id'])) {
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $status = 1;
        $status = mysqli_real_escape_string($connection, $status);
        
        // Get the current date
        $currentDate = date('Y-m-d');

        // Calculate the end date by adding 2 years to the current date
        $endDate = date('Y-m-d', strtotime('+2 years', strtotime($currentDate)));
        
        $sql = "UPDATE agreement SET status = $status, strat_date = '$currentDate', end_date = '$endDate' WHERE id = $id";
        $result = mysqli_query($connection, $sql);

        if (!$result) {
            die('Update failed: ' . mysqli_error($connection));
        }

        // Close the database connection
        mysqli_close($connection);

        // Prepare the response
        $response = array(
            'success' => true,
            'message' => 'Status and dates updated successfully.',
        );

        // Send the response as JSON
        echo json_encode($response);
    } else {
        // "id" key is not set
        // Prepare the response for the error case
        $response = array(
            'success' => false,
            'message' => 'Invalid request. "id" parameter is missing.',
        );

        // Send the response as JSON
        echo json_encode($response);
    }
}

?>
