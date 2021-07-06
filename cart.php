<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
  case "add":
    if(!empty($_POST["quantity"])) {
      $productByCode = $db_handle->runQuery("SELECT * FROM menu WHERE id='" . $_GET["id"] . "'");
      $itemArray = array($productByCode[0]["id"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["id"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["Price"], 'image'=>$productByCode[0]["Picture"]));
      
      if(!empty($_SESSION["cart_item"])) {
        if(in_array($productByCode[0]["id"],array_keys($_SESSION["cart_item"]))) {
          foreach($_SESSION["cart_item"] as $k => $v) {
              if($productByCode[0]["id"] == $k) {
                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                  $_SESSION["cart_item"][$k]["quantity"] = 0;
                }
                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
              }
          }
        } else {
          $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
        }
      } else {
        $_SESSION["cart_item"] = $itemArray;
      }
    }
  break;
  case "remove":
    if(!empty($_SESSION["cart_item"])) {
      foreach($_SESSION["cart_item"] as $k => $v) {
          if($_GET["id"] == $k)
            unset($_SESSION["cart_item"][$k]);        
          if(empty($_SESSION["cart_item"]))
            unset($_SESSION["cart_item"]);
      }
    }
  break;
  case "empty":
    unset($_SESSION["cart_item"]);
  break;  
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="cart.css">
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
    <br/>
    <center>
      <img src="120923136_372577030539011_2673554730304432909_n.gif" height="10%" width="20%" />
    </center>
    <div class="btn-group">
      <button><a href="./main.php">Home</a></button>
      <button><a href="./menu_display_user.php">Menu</a></button>
      <button><a href="./make-your-own.html">Make your own</a></button>
      <div class="dropdown">
        <button class="dropbtn">Profile</button>
        <div class="dropdown-content">
            <a href="#">Profile</a>
            <a href="./cart.php">Cart</a>
            <a href="./index.php">Log out</a>
          </div>
        </div>
    </div>

    <div id="shopping-cart">
    <center><div class="txt-heading"><big><big>Shopping Cart</big></big></div></center>
    <br/>

    <center><a id="btnEmpty" href="./menu_display_user.php">Empty Cart</a></center>
    <?php
    if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
    ?>  
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
    <tbody>
    <tr>
    <th style="text-align:left;">Name</th>
    <th style="text-align:left;">Code</th>
    <th style="text-align:right;" width="5%">Quantity</th>
    <th style="text-align:right;" width="10%">Unit Price</th>
    <th style="text-align:right;" width="10%">Price</th>
    <th style="text-align:center;" width="5%">Remove</th>
    </tr> 
    <?php   
        foreach ($_SESSION["cart_item"] as $item){
            $item_price = $item["quantity"]*$item["price"];
        ?>
            <tr>
            <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
            <td><?php echo $item["code"]; ?></td>
            <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
            <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
            <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
            <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
            </tr>
            <?php
            $total_quantity += $item["quantity"];
            $total_price += ($item["price"]*$item["quantity"]);
        }
        ?>

    <tr>
    <td colspan="2" align="right">Total:</td>
    <td align="right"><?php echo $total_quantity; ?></td>
    <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
    <td></td>
    </tr>
    </tbody>
    </table>    
      <?php
    } else {
    ?>
    <center><div class="no-records">Your Cart is Empty</div></center>
    <?php 
    }
    ?>
    </div>



    <form action="" method="POST" enctype="multipart/form-data">
      <div class="container" style="width:700px;">
        <br/>  
        <?php  
        $link = mysqli_connect("localhost", "root", "", "sushishop");

        if($link === false){
            die("ERROR: Could not connect." . mysqli_connect_error());
        }

        $sql = "SELECT * FROM menu";
        $result = mysqli_query($link, $sql); 
        if(mysqli_num_rows($result) > 0){  
             while($row = mysqli_fetch_array($result)){  
        ?>  
        <div class="col-md-4">  
             <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">  
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
    </form>
</body>
</html>