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
    <br/>
    <center>
      <img src="120923136_372577030539011_2673554730304432909_n.gif" height="10%" width="20%" />
    </center>
    <div class="btn-group">
      <button><a href="./main.php">Home</a></button>
      <button><a href="./menu_display_user.php">Menu</a></button>
      <button><a href="./make-your-own.php">Make your own</a></button>
      <div class="dropdown">
        <button class="dropbtn">Profile</button>
        <div class="dropdown-content">
            <a href="#">Profile</a>
            <a href="./index.php">Log out</a>
        </div>
      </div>
    </div>
</body>