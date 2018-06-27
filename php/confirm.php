<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['rand']))
{
    echo $_SESSION['email'];
	$to=$_SESSION['email'];
	//$headers =  'MIME-Version: 1.0' . "\r\n"; 
$headers = 'From: Gaurav @ChatShat.com' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	$sub="Email Confirmation";
	$message="Your email Confirmation Code is".$_SESSION['rand'];
	mail($to,$sub,$message,$headers);
}
else
{
	$session_err="session is not set";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Email Confirmation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../../js/index.js"></script>
</head>
<body style="background-color:aliceblue;">
    <nav class="navbar navbar-default blue">
    <div class="container-fluid">
          <div class="navbar-header">
           
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button> 
            
            <a href="../index.php" class="navbar-brand">
            <img style="float:left; margin-top:-10px;"  src="../img/logo.png"  alt="logo" width="40px;"> 
              &nbsp;ChatShat</a>
        </div>
        
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../index.php"> <span class="glyphicon glyphicon-home"></span> Home </a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="./account/login.php">Login</a></li>
            <li><a href="./account/signup.php">Register</a></li>
        </ul>
    </div>
    </div>
</nav>
<div class="container">
    <div class="col-xs-12 col-sm-12">
        <div class="panel panel-default panel-profile m-b-md">
                        
            <div class="panel-body text-center">
                <div class="panel-title">
                    <h5>EMAIL CONFIRMATION</h5>
                    <form action="#" class="form-horizontal">
                       
                       <div class="form-group">
                            <label for="code" class="col-md-2">Enter Code</label>
                                      <input type="text" class="col-md-3 " >
                                       
                       </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</div>

</body>
 <footer class="container-fluid">
            <div class="row">
                <div class="col-xs-offset-2 col-xs-10">
                 <h4><small>ChatShaT 2017 &copy; <span class="btn btn-facebook"></span> <a href="#">Privacy</a> - <a href="#">Terms</a></small></h4>
                        
                </div>
            </div>
             
         </footer>
</html>