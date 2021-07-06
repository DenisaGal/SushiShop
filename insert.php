<?php
$link = mysqli_connect("localhost", "root", "", "sushishop");

if($link === false){
    die("ERROR: Could not connect." . mysqli_connect_error());
}

$username = mysqli_real_escape_string($link, $_REQUEST['username']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);

$query = "SELECT Username, Email FROM users";
$result = mysqli_query($link, $query);

while($row = mysqli_fetch_array($result)){
	if($row['Username'] === $username){
		echo '<script>alert("Username already used. Please use another one."); location="./sign-in.html";</script>';
	}
	if($row['Email'] === $email){
		echo '<script>alert("Email address already used. Please use another one."); location="./sign-in.html";</script>';
	}
}

$query2 = "SELECT Username, Email FROM users WHERE Username='$username' AND Email='$email'";
$result2 = mysqli_query($link, $query2);

if (mysqli_num_rows($result2) == 0){

	$sql = "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', SHA('$password'))";
	if(mysqli_query($link, $sql)){
		echo '<script>alert("Sign in successful."); location="./log-in.html";</script>';
	} else{
	    echo "ERROR: Was not able to add user." . mysqli_error($link);
	}
}

mysqli_close($link);
?>