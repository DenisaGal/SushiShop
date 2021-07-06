<!DOCTYPE html>
<html>
	<head>
		<title>Sushi Shop</title>
		<link rel="stylesheet" type="text/css" href="index.css">
	</head>
	<style>
	body {
	    font-family: pristina;
	}
	</style>
	<body>
		<div id="google_translate_element"></div>
		 <script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script> 
		 <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<center>
			<img src="120923136_372577030539011_2673554730304432909_n.gif" height="10%" width="20%" />
		</center>
		 <div class="btn-group">
		 	<button><a href="./index.php">Home</a></button>
		 	<button><a href="./menu_display.php">Menu</a></button>
		 	<button><a href="./make-your-own.html">Make your own</a></button>
		 	<button><a href="./log-in.html">Log in</a></button>
		</div>
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
            </center>
            <img src="line.png" height="100%" width="100%" />
             <?php  
             }  
        }  
        ?>
	</body>
</html>