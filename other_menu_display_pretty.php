<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="cart.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
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
            <a href="#">Cart</a>
            <a href="./index.php">Log out</a>
          </div>
        </div>
    </div>
    <div id="product-grid">
      <div class="txt-heading">Products</div>
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
        <!-- <div class="col-md-4">  
             <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">   -->
                  <div class="product-item">
                    <form method="post" action="index.php?action=add&code=<?php echo $row["Id"]; ?>">
                    <!-- <div class="product-image"><img src="<?php echo $row["Picture"]; ?>"></div> -->
                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Picture']).'" class="product-image">'; ?>
                    <div class="product-tile-footer">
                    <div class="product-title"><?php echo $row["Name"]; ?></div>
                    <div class="product-price"><?php echo "$".$row["Price"]; ?></div>
                    <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </div>
                    </form>
                  </div>
                  <!-- <br/> --> 
             <!-- </form>  
        </div> -->  
        <?php  
             }  
        }  
        ?> 
    </div>
</body>
</html>