<?php
	session_start();
	$db = mysqli_connect("localhost", "root", "", "sushishop");
	$update = false;
	if (isset($_POST['add'])) {
		$text = $_POST['text'];
		if (count($_FILES) > 0) {
		    if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
		        $imgData = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		        $imageProperties = getimageSize($_FILES['picture']['tmp_name']);
		        
		        $sql = "INSERT INTO home (Text, Picture) VALUES('$text', '{$imgData}')";
		        $current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($db));
		        if (isset($current_id)) {
		        	$_SESSION['message'] = "Entry added"; 
		            header("Location: admin.php");
		        }
		    }
		}
	}

	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$text = $_POST['text'];

		if (count($_FILES) > 0) {
		    if (is_uploaded_file($_FILES['picture']['tmp_name'])) {
		        $imgData = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
		        $imageProperties = getimageSize($_FILES['picture']['tmp_name']);
		        
		        $sql = "UPDATE home SET Picture='{$imgData}' WHERE Id=$id";
		        $current_id = mysqli_query($db, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($db));
		        // if (isset($current_id)) {
		        // 	$_SESSION['message'] = "Entry updated"; 
		        //     header("Location: home-admin.php");
		        // }
		    }
		}
		if ($text) {
			mysqli_query($db, "UPDATE home SET Text='$text' WHERE Id=$id");
		}
		$_SESSION['message'] = "Entry updated!"; 
		header('location: admin.php');
	}

	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM home WHERE Id=$id");
		$_SESSION['message'] = "Entry deleted!"; 
		header('location: admin.php');
	}
?>