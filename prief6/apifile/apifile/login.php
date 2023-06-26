<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST");
    header("Access-Control-Allow-Headers: Content-Type");

    $conn = new mysqli("localhost", "root", "", "contract-system");
    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit();
    }
    else{
        $eData = file_get_contents("php://input");
        $dData = json_decode($eData, true);

        $email = $dData['email'];
        $pass = $dData['pass'];
        $result = "";

        if($email != "" and $pass != ""){
            $sql = "SELECT * FROM users WHERE email='$email';";
            $res = mysqli_query($conn, $sql);

            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_array($res);
                if($pass != $row['password']){
                    $result = "Invalid password!";
                }
                else{
                    $result = $row['id'];
                }
            }
            else{
                $result = "Invalid username!";
            }
        }
        else{
            $result = "";
        }

        $conn -> close();
        $response[] = array("result" => $result);
        echo json_encode($response);
    }

?>