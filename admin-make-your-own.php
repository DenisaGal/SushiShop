<?php  include('admin-make.php'); ?>
<?php 
 $connect = mysqli_connect("localhost", "root", "", "sushishop");  
 if(isset($_POST["restock"])){  
    $id = $_GET["id"];
    $sql_restock = "UPDATE Ingredients SET Stock=100 WHERE Id=$id";
    $result_restock =  mysqli_query($connect, $sql_restock);
    $_SESSION['message'] = "Item restocked!"; 
    header('location: admin-make-your-own.php');
} 

 $db = mysqli_connect("localhost", "root", "", "sushishop");
  if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = mysqli_query($db, "SELECT * FROM ingredients WHERE Id='$id'");

    if (mysqli_num_rows($result) == 1) {
      $n = mysqli_fetch_array($result);
      $name = $n['Name'];
      $price = $n['Price'];
    }
  }  
 ?>

 <!DOCTYPE html>
<html>
<head>
    <title>Make your own</title>
    <link rel="stylesheet" type="text/css" href="edit-button.css">
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
      <button><a href="./menu_display_admin.php">Menu</a></button>
      <button><a href="./admin-make-your-own.php">Make your own</a></button>
      <button><a href="./log-out.php">Log out</a></button>
    </div>
      <div class="container" style="width:700px;">
        <div style="clear:both"></div>  
        <br />  
        <?php if (isset($_SESSION['message'])): ?>
          <div class="edit-button"><center><big><big><big>
            <?php 
              echo $_SESSION['message']; 
              unset($_SESSION['message']);
            ?>
          </big></big></big></center></div>
        <?php endif ?>
      <center><form method="post" action="admin-make.php" enctype="multipart/form-data">
      <big><div class="input-group">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Name</label>
        </br>
        <input type="text" name="name" value="<?php if ($update == true){echo $name;} else echo ""?>">
        <label>Price</label>
        </br>
        <input type="text" name="price" value="<?php if ($update == true){echo $price;} else echo ""?>">
      </div>
      <div>
        <label>Picture</label>
        </br>
        <input type="file" name="picture" value="">
      </div></big>
      </br>
        <div class="edit-button">
            <?php if ($update == true): ?>
        <button type="submit" name="update">Update</button>
      <?php else: ?>
        <button type="submit" name="add" >Add</button>
      <?php endif ?>
      </div></center></form>
      <br/>   
        <?php  
        $sql = "SELECT * FROM Ingredients ORDER BY Id";
        $result = mysqli_query($connect, $sql); 
        if(mysqli_num_rows($result) > 0){  
             while($row = mysqli_fetch_array($result)){  
        ?>  
        <div class="col-md-4">  
             <form method="post" action="./admin-make-your-own.php?action=add&id=<?php echo $row['Id']; ?>">  
                  <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
                       <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Picture']).'" class="img-responsive">'; ?> 
                       <h4 class="text-info"><?php echo $row["Name"]; ?></h4>
                       <h4 class="text-danger"><?php echo $row["Price"]; ?></h4>  
                       <!-- <input type="text" name="quantity" class="form-control" value="1" />   -->
                       <input type="hidden" name="hidden_name" value="<?php echo $row["Name"]; ?>" />  
                       <input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />  
                       <input type="submit" name="restock" style="margin-top:5px; background-color: #000000; border-color: #000000;" class="btn btn-success" value="Restock" />
                     </br>
                       <button type="submit" name="edit" style="margin-top:5px; background-color: #000000; border-color: #000000;" class="btn btn-success"><a href="./admin-make-your-own.php?edit=<?php echo $row['Id']; ?>">Edit</a></button>
                       <button type="submit" name="delete" style="margin-top:5px; background-color: #000000; border-color: #000000;" class="btn btn-success"><a href="./admin-make-your-own.php?delete=<?php echo $row['Id']; ?>">Delete</a></button>  
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