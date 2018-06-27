<?php
session_start();
$user_id="";
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['name']) && !empty($_POST['pass']) &&!empty($_POST['repass']))
        {
            if($_POST['pass']!=$_POST['repass'])
            {
                $pass_err="password did't matched";
            }
            else
            {
                $email=$_POST['email'];
                $username=$_POST['username'];
                $name=$_POST['name'];
                $pass=$_POST['pass'];
                $pass_hash=password_hash($pass,PASSWORD_DEFAULT);
                require ("../connection.php");
                
 
            
                //user data insertion code
                $sql="INSERT INTO `users`( `name`,`username`,`email`,`password`) VALUES('$name','$username','$email','$pass_hash')";
                $res=mysqli_query($conn,$sql);
                if($res==true)
                {
                    //inserting data in mysqli usernames table
                    $user_id=mysqli_insert_id($conn);
                    $new_sql="INSERT INTO `usernames`VALUES('$user_id','$username')";
                    if(mysqli_query($conn,$new_sql))
                    {
                        echo "record created";
                        
                    $rand=rand(10000,1000000);
                    $_SESSION['rand']=$rand;
                    $_SESSION['username']=$username;
                    $_SESSION['email']=$email;
                    echo "please wait redirecting to confirmation page";
                    
                        //redirect to email confirmation page
                    //header("location:../confirm.php");   
                    }
                    else
                    {
                        echo "error in second query";
                        echo mysqli_error($conn);
                    }
                }
                else
                {
                   echo   mysqli_error($conn);
                }
                
                               //image uploadin code
                    function GetImageExtension($imagetype)
   	 {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }
     }
	 
	 
	 
if (!empty($_FILES["uploadedimage"]["name"])) {

	$file_name=$_FILES["uploadedimage"]["name"];
	$temp_name=$_FILES["uploadedimage"]["tmp_name"];
	$imgtype=$_FILES["uploadedimage"]["type"];
	$ext= GetImageExtension($imgtype);
	$imagename=date("d-m-Y")."-".time().$ext;
	$target_path = "uploads/".$imagename;
	

if(move_uploaded_file($temp_name, $target_path)) {

 	$query_upload="INSERT into    `images` VALUES 

('$user_id','".$target_path."','".date("Y-m-d")."')";
	mysqli_query($conn,$query_upload) or die("error in $query_upload == ----> ".mysqli_error());  
	
}else{

   exit("Error While uploading image on the server");
} 

}
                else
                {
                    echo "error at here";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/index.css">
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
          <h5><b>Register</b></h5>
      </div>
      
      
       <div class="panel panel-default col-xs-12">
           <div id="signupform" class="panel-body">
               
                <form  enctype="multipart/form-data"  name="signup" onsubmit="return validate();" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-horizontal">
        
            <div class="form-group">
                     <label class="control-label col-sm-2" for="email">Email</label>
                     <div class="col-sm-10">
                         
                     <input id="email" type="email" name="email" class="form-control">
                     <div class="err_red" id="email_err"></div>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="control-label col-sm-2" for="username">Username</label>
                     <div class="col-sm-10">
                         
                     <input onkeyup="return username_validate(this.value);" id="username" type="text" name="username" class="form-control">
                     <div id="user_err" class="err_red"></div>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="control-label col-sm-2" for="name">Name</label>
                     <div class="col-sm-10">
                         
                     <input id="name" type="text" name="name" class="form-control">
                     <div id="name_err" class="err_red"></div>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="control-label col-sm-2" for="passowrd">Password</label>
                     <div class="col-sm-10">
                         
                     <input id="pass" type="password" name="pass" class="form-control">
                     <div id="pass_err" class="err_red"></div>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="control-label col-sm-2" for="pass-confirm">Password Confirmation</label>
                     <div class="col-sm-10">
                         
                     <input id="repass" type="password" name="repass" class="form-control">
                     <div id="repass_err" class="err_red"></div>
                     </div>
                 </div>
                 <div class="form-group">
                     <label class="control-label col-sm-2" for="profile-pid">Photo(Optional)</label>
                     <div class="col-sm-10">
                         
                     <input id="file" type="file" name="uploadedimage" class="form-control">
                     </div>
                 </div>
                 <div class="form-group">
                     <div class="col-sm-offset-2 col-sm-10">
                         <input id="submit" type="submit" value="SUBMIT" name="submit" class="btn btn-default">
                     </div>
                 </div>
                 <div style="color:red;" id="demo" class="col-sm-12">
                     
                 </div>
                 </form> 
                     
                 </div>
                         
           </div>
       </div>
           
</body>

     <footer class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-offset-2 col-md-10">
                 <h4><small>ChatShaT 2017 &copy; <span class="btn btn-facebook"></span> <a href="#">Privacy</a> - <a href="#">Terms</a></small></h4>
                        
                </div>
            </div>
             
         </footer>
</html>