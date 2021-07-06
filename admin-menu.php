<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "sushishop");
	$update = false;
	if (isset($_POST['add'])) {
		$category = $_POST['category'];
		$name = $_POST['name'];
		$ingredients = $_POST['ingredients'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
		if (count($_FILES) > 0) {
		    if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
		        $imgData = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		        $imageProperties = getimageSize($_FILES['picture']['tmp_name']);
		        
		        $sql = "INSERT INTO menu (Category, Name, Ingredients, Quantity, Price, Picture) VALUES('$category', '$name', '$ingredients', '$quantity', '$price', '{$imgData}')";
		        $current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($db));
		        if (isset($current_id)) {
		        	$_SESSION['message'] = "Entry added"; 
		            header("Location: menu_display_admin.php");
		        }
		    }
		}
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$category = $_POST['category'];
		$name = $_POST['name'];
		$ingredients = $_POST['ingredients'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];

		if (count($_FILES) > 0) {
		    if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
		        $imgData = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		        $imageProperties = getimageSize($_FILES['picture']['tmp_name']);
		        
		        $sql = "UPDATE menu SET Picture='{$imgData}' WHERE Id=$id";
		        $current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($db));
		        // if (isset($current_id)) {
		        // 	$_SESSION['message'] = "Entry updated"; 
		        //     header("Location: home-admin.php");
		        // }
		    }
		}
		if ($category) {
			mysqli_query($db, "UPDATE menu SET Category='$category', Name='$name', Ingredients='$ingredients', Quantity='$quantity', Price='$price' WHERE Id=$id");
		}
		$_SESSION['message'] = "Entry updated!"; 
		header('location: menu_display_admin.php');
	}

	if (isset($_GET['delete'])) {
		$id = $_GET['delete'];
		mysqli_query($db, "DELETE FROM menu WHERE Id=$id");
		$_SESSION['message'] = "Entry deleted!"; 
		header('location: menu_display_admin.php');
	}
?>