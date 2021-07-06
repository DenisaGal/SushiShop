<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "sushishop");
	$update = false;
	if (isset($_POST['add'])) {
		$name = $_POST['name'];
		$price = $_POST['price'];
		if (count($_FILES) > 0) {
		    if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
		        $imgData = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		        $imageProperties = getimageSize($_FILES['picture']['tmp_name']);
		        
		        $sql = "INSERT INTO ingredients (Name, Price, Picture) VALUES('$name', '$price', '{$imgData}')";
		        $current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($db));
		        if (isset($current_id)) {
		        	$_SESSION['message'] = "Entry added"; 
		            header("Location: admin-make-your-own.php");
		        }
		    }
		}
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$price = $_POST['price'];

		if (count($_FILES) > 0) {
		    if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
		        $imgData = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		        $imageProperties = getimageSize($_FILES['picture']['tmp_name']);
		        
		        $sql = "UPDATE ingredients SET Picture='{$imgData}' WHERE Id=$id";
		        $current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Image Update<br/>" . mysqli_error($db));
		        // if (isset($current_id)) {
		        // 	$_SESSION['message'] = "Entry updated"; 
		        //     header("Location: home-admin.php");
		        // }
		    }
		}
		if ($name) {
			mysqli_query($db, "UPDATE ingredients SET Name='$name', Price='$price' WHERE Id=$id");
		}
		$_SESSION['message'] = "Entry updated!"; 
		header('location: admin-make-your-own.php');
	}

	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		mysqli_query($db, "DELETE FROM ingredients WHERE Id=$id");
		$_SESSION['message'] = "Entry deleted!"; 
		header('location: admin-make-your-own.php');
	}
?>