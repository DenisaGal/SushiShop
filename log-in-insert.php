<?php
$link = mysqli_connect("localhost", "root", "", "sushishop");

if($link === false){
    die("ERROR: Could not connect." . mysqli_connect_error());
}

$username = mysqli_real_escape_string($link, $_REQUEST['username']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);

$query = "SELECT Username, Password FROM users WHERE Username='$username' AND Password=SHA('$password')";
$result = mysqli_query($link, $query);

if(mysqli_num_rows($result) == 1){
	if($username === "admin"){
		echo '<script>alert("Log in successful."); location="./admin.php";</script>';
	}
	else{
		echo '<script>alert("Log in successful."); location="./main.php";</script>';
	}
}
else{
	echo '<script>alert("Log in failed. Username or password wrong or account does not exist."); location="./log-in.html";</script>';
}

mysqli_close($link);
?>