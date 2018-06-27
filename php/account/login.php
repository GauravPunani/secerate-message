<?php
session_start();
$user_err=$pass_err="";
$user_pass="";
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		if(isset($_POST['submit']))
		{
			if(!empty($_POST['username']) && !empty($_POST['password']))
			{
				include("../connection.php");
				$user=$_POST['username'];
				$pass=$_POST['password'];
				$sql="SELECT * FROM `users` where `username`='$user'";
				$res=mysqli_query($conn,$sql);
				if($res==true)
				{
                  
					while($row=mysqli_fetch_assoc($res))
					{
						$user_id=$row['id'];
						$user_pass=$row['password'];
						$user_name=$row['username'];
					}
					if(password_verify($pass,$user_pass))
					{
                          $select_query = "SELECT `img_path` FROM  `images` WHERE img_id='$user_id'";
                    $new_query=mysqli_query($conn,$select_query);
                        if($new_query)
                        {
                            if(mysqli_num_rows($new_query)>0)
                            {

                                $row=mysqli_fetch_assoc($new_query);
                                $_SESSION['user_img']=$row['img_path']; 
                            }
                        }
						$_SESSION['id']=$user_id;
						$_SESSION['user_name']=$user_name;
							header("Location:../../index.php");
					}
					
					else{
						$pass_err="Username and password did't matched";
					}
				}
				else
				{
					echo mysqli_error($conn);
				}
			}
            else
            {
                $pass_err="Please fill the required field";
            }
		}	
	}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ChatShat Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/index.css">
  <link rel="stylesheet" href="../../css/other.css">
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
            
            <a href="../../index.php" class="navbar-brand">
            <img style="float:left; margin-top:-10px;"  src="../../img/logo.png"  alt="logo" width="40px;"> 
              &nbsp;&nbsp;ChatShat</a>
        </div>
        
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../../index.php"> <span class="glyphicon glyphicon-home"></span> Home </a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="./login.php">Login</a></li>
            <li><a href="./signup.php">Register</a></li>
        </ul>
    </div>
    </div>
</nav>

 <div class="container grey">
    
<div class="text-center">
    <h3>Login</h3>
</div>
    
         <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-offset-4 col-md-4 ">
            <div class="panel panel-default">
                 <form onsubmit="return login_val();" style="padding:20px;" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
                 <div class="form-group">
                     <label for="username">Username</label>
                     <input id="username" type="text" name="username" class="form-control">
                 </div>
                  <div class="form-group">
    <label for="pwd">Password:</label>
    <input id="pass" name="password" type="password" class="form-control" id="pwd">
  </div>
  <div class="checkbox">
    <label><input type="checkbox" name="remember"> Remember me</label>
  </div>
  <span id="user_err" class="user_err"><?php echo $pass_err; ?></span><br>
  <input style="margin-left:10px;" type="submit" name="submit" value="SUBMIT" class="btn btn-default">
                      
             </form>
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