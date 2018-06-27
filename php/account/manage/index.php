<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    
}
else
{
    header("../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../../css/index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../../../js/index.js"></script>
</head>
<body>
   <nav class="navbar navbar-default blue">
    <div class="container-fluid">
          <div class="navbar-header">
           
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button> 
            
            <a href="../../index.php" class="navbar-brand">
            <img style="float:left; margin-top:-10px;"  src="../../../img/logo.png"  alt="logo" width="40px;"> 
              &nbsp;&nbsp;ChatShat</a>
        </div>
        
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../../../index.php"> <span class="glyphicon glyphicon-home"></span> Home </a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="../login.php">Login</a></li>
            <li><a href="../signup.php">Register</a></li>
        </ul>
    </div>
    </div>
</nav>
    <div class="container-fluid grey">
        <div class="row">
            <div class="col-md-offset-1 col-md-3">
                <div class="panel panel-default panel-profile">
                    <ul class="list-group">
                        <ul class="list-group">
                            <p style="margin-left:14px;">Settings</p>
  <li class="list-group-item active">First item</li>
  <li class="list-group-item">Second item</li>
  <li class="list-group-item">Third item</li>
</ul>
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default panel-profile">
                    <ul class="list-group">
                        <ul class="list-group">
  <li class="list-group-item">First item</li>
  <li class="list-group-item">Second item</li>
  <li class="list-group-item">Third item</li>
</ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>