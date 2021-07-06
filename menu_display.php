<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
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
      <button><a href="./index.php">Home</a></button>
      <button><a href="./menu_display.php">Menu</a></button>
      <button><a href="./make-your-own.html">Make your own</a></button>
      <button><a href="./log-in.html">Log in</a></button>
    </div>
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
                       <h4 class="text-info"><?php echo 'Ingredients: ' . $row["Ingredients"]; ?></h4>  
                       <h4 class="text-danger"><?php echo $row["Price"]; ?></h4>
                  </div>
                  <br/>  
             </form>  
        </div>  
        <?php  
             }  
        }  
        ?>
      </table></center>
    </form>
</body>
</html>