<?php   
 session_start();  
 $connect = mysqli_connect("localhost", "root", "", "sushishop");  
 if(isset($_POST["add_to_cart"]))  
 {  
      if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;
                $id = $_GET["id"];
                $quantity = $_POST["quantity"];
                $sql_stock = "SELECT Stock FROM Ingredients WHERE Id=$id";
                $result_stock =  mysqli_query($connect, $sql_stock); 
                if(mysqli_num_rows($result_stock) == 1){
                  $row = mysqli_fetch_array($result_stock);
                  $new_stock = $row["Stock"]-$quantity;
                  $sql_update = "UPDATE Ingredients SET Stock='$new_stock' WHERE Id=$id";
                  $result_update =  mysqli_query($connect, $sql_update);
                }  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added"); location="./make-your-own.php";</script>';
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"]  
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
 }  
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "delete")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);
                     echo '<script>alert("Item Removed"); location="./make-your-own.php";</script>'; 
                }  
           }  
      }  
 }  
 ?>

 <!DOCTYPE html>
<html>
<head>
    <title>Make your own</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <style>
  body {
      font-family: pristina;
      font-size: 20px; 
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
      <button><a href="./main.php">Home</a></button>
      <button><a href="./menu_display_user.php">Menu</a></button>
      <button><a href="./make-your-own.php">Make your own</a></button>
      <button><a href="./log-out.php">Log out</a></button>
    </div>
      <div class="container" style="width:700px;">
        <div style="clear:both"></div>  
        <br />  
        <center><h3>Order Details</h3></center>  
        <div class="table-responsive">  
             <table class="table table-bordered">  
                  <tr>  
                       <th width="40%">Item Name</th>  
                       <th width="10%">Quantity</th>  
                       <th width="20%">Price</th>  
                       <th width="15%">Total</th>  
                       <th width="5%">Action</th>  
                  </tr>  
                  <?php   
                  if(!empty($_SESSION["shopping_cart"]))  
                  {  
                       $total = 0;  
                       foreach($_SESSION["shopping_cart"] as $keys => $values)  
                       {  
                  ?>  
                  <tr>  
                       <td><?php echo $values["item_name"]; ?></td>  
                       <td><?php echo $values["item_quantity"]; ?></td>  
                       <td> <?php echo $values["item_price"]; ?></td>  
                       <td> <?php echo (int)((int)$values["item_quantity"] * (int)$values["item_price"]); ?> ron</td>  
                       <td><a href="make-your-own.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>  
                  </tr>  
                  <?php  
                            $total += (int)((int)$values["item_quantity"] * (int)$values["item_price"]);  
                       }  
                  ?>  
                  <tr>  
                       <td colspan="3" align="right">Total</td>  
                       <td align="right"><?php echo $total; ?> ron </td>  
                       <td></td>  
                  </tr>
                  <tr>
                    <td colspan="2" align="right">Delivery Address</td>
                    <td colspan="2" align="center"><input type="text" name="address" placeholder="Enter your address..." required></td>
                    <td><a href="checkout_user.php"><span class="text-danger">Checkout</span></a></td>
                  </tr>  
                  <?php  
                  }  
                  ?>  
             </table>  
        </div>  
      </div>
        <br/>
        <center><p>
		Please select category
		<select name="formCategory">
			<?php 
		  	$sql1 = "SELECT DISTINCT Category FROM menu";
        	$result1 = mysqli_query($connect, $sql1); 
        	if(mysqli_num_rows($result1) > 0){  
            	while($row = mysqli_fetch_array($result1)){
            	?>  
				  	<?php echo "<option>" . $row["Category"] . "</option>"; ?>
		<?php 
            }  
        }  
        ?>
        </select></p></center>
        <br/>  
        <?php  
        $sql = "SELECT * FROM Ingredients ORDER BY Id";
        $result = mysqli_query($connect, $sql); 
        if(mysqli_num_rows($result) > 0){  
             while($row = mysqli_fetch_array($result)){  
        ?>  
        <div class="col-md-4">  
             <form method="post" action="./make-your-own.php?action=add&id=<?php echo $row['Id']; ?>">  
                  <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                       <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Picture']).'" class="img-responsive">'; ?> 
                       <h4 class="text-info"><?php echo $row["Name"]; ?></h4>
                       <h4 class="text-danger"><?php echo $row["Price"]; ?></h4>  
                       <input type="text" name="quantity" class="form-control" value="1" />  
                       <input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />  
                       <input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />  
                       <input type="submit" name="add_to_cart" style="margin-top:5px; background-color: #000000; border-color: #000000;" class="btn btn-success" value="Add to Cart" />  
                  </div>
                  <br/>  
             </form>  
        </div>  
        <?php  
             }  
        }  
        ?> 
        
</body>
</html>