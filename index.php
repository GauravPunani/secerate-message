<?php
session_start();
$img_path="./img/logo.png";
$login_status=0;

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
  if($login_status=1);
  if(isset($_SESSION['user_img']))
{
  $img_path="http://localhost:8080/sec_message/".$_SESSION['user_img'];
}
else
{
  $img_path="./default_img/user.jpg";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./css/index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="./js/index.js"></script>
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
            
            <a href="./index.php" class="navbar-brand">
            <img style="float:left; margin-top:-10px;"  src="<?php echo $img_path; ?>" class="img-responsive img-rounded"  alt="logo" width="40px;"> 
              &nbsp;ChatShat</a>
        </div>
        
    <div  class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right " id="ul">
            <li><a id="home"  href="./index.php"> <span class="glyphicon glyphicon-home"></span> Home </a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li>
            <a id="login" href="./php/account/login.php"><spam class="glyphicon glyphicon-log-in"></spam> Login</a></li>
            <li><a id="signup" href="./php/account/signup.php">Register</a></li>
        </ul>
        
    </div>
    </div>
</nav>
<!--message sending form --> 
<div   class="container grey" id="msg_box" style="display:none";>
             <div class="form-group text-center">
             
  <label class="col-xs-12 col-sm-12"  for="comment">Message</label>
  <textarea 
   class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4" class="form-control" rows="5" cols="10" id="comment" ></textarea>
    <div class="col-xs-12 col-sm-12">
      <input id="submit_msg" type="submit" class="btn btn-default">
  </div>
  
</div>    
   
    </div>
    
    <div style="display:none;" id="mainpage" class="container grey">
        <h4><small>Get honest feedback from your coworkers and friends</small></h4><br>
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <dl>
                    <dt>At work</dt>
                    <dd><small>- Enhance your areas of strength</small></dd>
                    <dd><small>- Strengthen Areas for Improvement</small></dd>
                </dl>
            </div>
            <div class="col-xs-12 col-md-6">
                <dl>
                    <dt>With your friends</dt>
                        <dd><small>- 
                            Improve your friendship by discovering your strengths and areas for improvement</small></dd>
                <dd><small>- Let your friends be honest with you</small></dd>
                    
                </dl>
            </div>
        </div>
        <div class="row">
            <div>
               <a id="login_show" href="php/message.php" style="display:none;"><span class="glyphicon glyphicon-envelope"></span> Messages</a>
               <p id="login_hide">
                   
                    <a class="login_hide " href="./php/account/login.php">Login</a> |
                <a class="login_hide" href="./php/account/signup.php">Register</a>     
               </p>
              
            </div>
        </div>
    </div>
         <footer class="container-fluid">
            <div class="row">
                <div class="col-xs-offset-2 col-xs-10">
                 <h4><small>ChatShaT 2017 &copy; <span class="btn btn-facebook"></span> <a href="#">Privacy</a> - <a href="#">Terms</a></small></h4>
                        
                </div>
            </div>
             
         </footer>
</body>
</html>
<?php
//check wether login session is created or not
if($login_status==1)
{

  echo "
<script>
$('#signup').text('Logout');
$('#signup').attr('href','php/account/logout.php');
$('#login').text('Settings');
$('#login').attr('href','php/account/manage/setting.php');
$('#login_hide').hide();
$('#login_show').show();
$('#home').text('My Messages');
$('#home').attr('href','php/message.php');
</script>";  
}

?>
  <?php
if(isset($_GET['data']))
{
     function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
    }
    include('php/connection.php');
    $user=test_input($_GET['data']);
   
    $sql="SELECT `id`,`username` FROM `users` WHERE `username`='$user'";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0)
    {
        while($row=mysqli_fetch_assoc($res))
        {
            $_SESSION['msg_id']=$row['id'];
        }
        echo "<script>$('#msg_box').show();</script>";
    }
    else
    {
        echo "<script>$('#mainpage').show();</script>";    
    }
}
else
{
    echo "<script>$('#mainpage').show();</script>";
}
?>