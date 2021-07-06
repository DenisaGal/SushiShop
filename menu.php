<!DOCTYPE html>
<html>
	<head>
		<title>Menu</title>
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
		<h1 style="background-color: black; font-family: pristina;">
			<button style="position: relative; left: 80%; top: 5%; transform: translateY(-20%); border-radius: 4px; font-family: pristina;"><a href="file:///D:/Deni/AC/Year%203/WAD/Lab/home.html">Home</a></button>
			<button style="position: relative; left: 80%; top: 5%; transform: translateY(-20%); border-radius: 4px; font-family: pristina;"><a href="file:///D:/Deni/AC/Year%203/WAD/Lab/menu.html">Menu</a></button>
			<button style="position: relative; left: 80%; top: 5%; transform: translateY(-20%); border-radius: 4px; font-family: pristina;"><a href="file:///D:/Deni/AC/Year%203/WAD/Lab/make-your-own.html">Make your own</a></button>
			<button style="position: relative; left: 80%; top: 5%; transform: translateY(-20%); border-radius: 4px; font-family: pristina;"><a href="file:///D:/Deni/AC/Year%203/WAD/Lab/log-in.html">Log in</a></button>
		</h1>
		<center><h1>Starters</h1></center>
		<div class="menu">
			<?php
				$link = mysqli_connect("localhost", "root", "", "sushishop");

				if($link === false){
				    die("ERROR: Could not connect." . mysqli_connect_error());
				}

				$sql = "SELECT Name, Ingridients, Price, Quantity, Picture FROM Starters";
				$result =  mysqli_query($link, $sql);

				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_assoc($result)){
						#echo .$row["Name"] .$row["Ingridients"] .$row["Price"] .$row["Quantity"] .$row["Picture"];
						$Name = $row["Name"];
				        $Ingridients = $row["Ingridients"];
				        $Price = $row["Price"];
				        $Quantity = $row["Quantity"];
				        $Picture = $row["Picture"];
    					print $Picture;

				        print $Name;
				        print $Ingridients;
				        print $Price;
				        print $Quantity;
					}
				}
				else{
					echo "No results";
				}

				mysqli_close($link);
				?>
		</div>
	</body>
</html>