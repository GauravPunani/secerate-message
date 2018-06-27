<?php
session_start();
$img_path="./img/logo.png";
$login_status=0;
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
  if($login_status=1);
  if(isset($_SESSION['user_img']))
{
      echo $_SESSION['user_img'];
  $img_path=$_SESSION['user_img'];
}
else
{
  $img_path="../../../default_img/user.jpg";
}
}
$email=$username=$name="";
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    $id=$_SESSION['id'];

    include("../../connection.php");
    $sql="SELECT * FROM `users` WHERE id='$id'";
    $res=mysqli_query($conn,$sql);
    if($res)
    {
        $row=mysqli_fetch_assoc($res);
        $email=$row['email'];
        $username=$row['username'];
        $name=$row['name'];
    }
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
            
            <a href="../../../index.php" class="navbar-brand">
            <img class="img-circle" style="float:left; margin-top:-10px;"  src="<?php echo $img_path; ?>"  alt="logo" width="40px;"> 
              &nbsp;&nbsp;ChatShat</a>
        </div>
        
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a id="home" href="../../../index.php"> <span class="glyphicon glyphicon-home"></span> Home </a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a id="login" href="../login.php">Login</a></li>
            <li><a id="signup" href="../signup.php">Register</a></li>
        </ul>
    </div>
    </div>
</nav>
    <div style="padding:10px;" class="container-fluid grey">
        <div class="row">
            <div class="col-md-offset-1 col-md-3">
                <div class="panel panel-default panel-profile">
                    
                        <ul class="list-group">
                            <p style="margin-left:14px;">Settings</p>
                            <a class="list-group-item " href="setting.php">General</a>
  <a class="list-group-item active" href="pass.php">Password</a>
  <a class="list-group-item " href="setting.php">Delete Account</a>
</ul>
                    
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default panel-profile">
                     <h3 style="margin-left:20px;" class="text-info">General</h3>
                     <hr>
                     <div class="row">
                         <div class="col-sm-12">
                              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                              <label class="form-padding" for="oldpass">Enter old password</label>
                              <div class="form-padding">
                                 
                                  <input class="form-control" type="password" name="pass">
                              </div>
                              <label class="form-padding" for="newpass">New Password</label>
                                  <div class="form-padding">
                                      <input  type="password" class="form-control" name="newpass">
                                  </div>
                                   <label class="form-padding" for="newpass">Re-Enter new Password</label>
                                  <div class="form-padding">
                                      <input type="password" class="form-control" name="repass">
                                  </div>
                         <div style="padding:10px;">
                             
                         <input  type="submit" name="submit" value="SUBMIT" class="btn btn-default">
                         </div>
                     </form>
                         </div>
                     </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
//check wether login session is created or not
if($login_status==1)
{

  echo "
<script>
$('#signup').text('Logout');
$('#signup').attr('href','../logout.php');
$('#login').text('Settings');
$('#login').attr('href','./setting.php');
$('#login_hide').hide();
$('#login_show').show();
$('#home').text('My Messages');
$('#home').attr('href','../../message.php');
</script>";  
}

?>