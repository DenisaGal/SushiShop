<?php  include('admin-add.php'); ?>
<?php 
	$db = mysqli_connect("localhost", "root", "", "sushishop");
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$result = mysqli_query($db, "SELECT * FROM home WHERE Id='$id'");

		if (mysqli_num_rows($result) == 1) {
			$n = mysqli_fetch_assoc($result);
			$text = $n['Text'];
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Sushi Shop</title>
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="edit-button.css">
	</head>
	<style>
	body {
	    font-family: pristina;
	}
	</style>
	<body>
		<br/>
		<center>
			<img src="120923136_372577030539011_2673554730304432909_n.gif" height="10%" width="20%" />
		</center>
		<div id="google_translate_element"></div>
		 <script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script> 
		 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> 
		 <div class="btn-group">
		 	<button><a href="./home-admin.php">Home</a></button>
		 	<button><a href="./menu_display.php">Menu</a></button>
		 	<button><a href="./inventory.html">Make your own</a></button>
			<button class="dropbtn">Profile</button>		
		</div>
		<?php if (isset($_SESSION['message'])): ?>
			<div class="edit-button"><center><big><big><big>
				<?php 
					echo $_SESSION['message']; 
					unset($_SESSION['message']);
				?>
			</big></big></big></center></div>
		<?php endif ?>
		<img src="line.png" height="100%" width="100%" />
		<?php  
        $link = mysqli_connect("localhost", "root", "", "sushishop");

        if($link === false){
            die("ERROR: Could not connect." . mysqli_connect_error());
        }

        $sql = "SELECT * FROM home";
        $result = mysqli_query($link, $sql); 
        if(mysqli_num_rows($result) > 0){  
            while($row = mysqli_fetch_array($result)){
            ?>
            <center>
             	<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Picture']).'" height="5%" width="50%">'; ?>
                       <p><?php echo $row["Text"]; ?></p>                       
                       <div class="edit-button">
                       		<button type="submit" name="edit"><a href="home-admin.php?edit=<?php echo $row['Id']; ?>">Edit</a></button>
	                        <button type="submit" name="delete"><a href="home-admin.php?del=<?php echo $row['Id']; ?>">Delete</a></button>
	                    </div>
            </center>
            <img src="line.png" height="100%" width="100%" />
             <?php  
             }  
        }  
        ?>
        </br>
        <center><form method="post" action="admin-add.php" enctype="multipart/form-data">
		<big><big><big><div class="input-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<label>Text</label>
			</br>
			<input type="text" name="text" value="<?php echo $text; ?>">
		</div>
		<div>
			<label>Picture</label>
			</br>
			<input type="file" name="picture" value="">
		</div>
		</br>
       	<div class="edit-button">
            <!-- <button type="submit" name="add">Add</button> -->
            <?php if ($update == true): ?>
				<button type="submit" name="update">Update</button>
			<?php else: ?>
				<button type="submit" name="add" >Add</button>
			<?php endif ?>
        </div></center></big></big></big>
        </br>
	</body>
</html>