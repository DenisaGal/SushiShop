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

        echo '<tr> 
                  <td>'.$Name.'</td> 
                  <td>'.$Ingridients.'</td> 
                  <td>'.$Price.'</td> 
                  <td>'.$Quantity.'</td> 
                  <td>'.$Picture.'</td> 
              </tr>';
	}
}
else{
	echo "No results";
}

mysqli_close($link);
?>