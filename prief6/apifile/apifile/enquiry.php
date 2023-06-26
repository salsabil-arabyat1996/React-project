<?php 

	header('Access-Control-Allow-Origin: *');

	$conn = new mysqli("localhost","root","","contract-system");
	
	if(mysqli_connect_error()){
		echo mysqli_connect_error();
		exit();
	}
	else{
		$name = $_POST['name'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		
		$sql = "INSERT INTO users(name,password,email,role_id) VALUES('$name','$password','$email','2');";
		$res = mysqli_query($conn, $sql);
		
		if($res){
			echo "Success!";
		}
		else{
			echo "Error!";
		}
		$conn->close();
	}

?>
