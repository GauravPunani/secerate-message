<?php
//start the session first
session_start();
//setting up variables
$msg="";
$data="";
$fav="";
//check wether user is logged in or not ?
// if not redirect to login page
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
   {
    include("connection.php");
    $id=$_SESSION['id'];
    $sql="SELECT * FROM `messages` WHERE user_id='$id'";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        if(mysqli_num_rows($res)>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                $data.="
                 <div id='message".$row['id']."'style='margin:0;' class='media message'>
            <div class='media-body '>
                <p  class='media-heading form-padding'>".
                    $row['message']
                    ."
                 <button  type='button' onclick='deleting(".$row['id'].")' class='pull-right close' data-toggle='modal' data-target='#myModal'>&times;</button></p>
                <p class='text-muted'>
                <small>
                ".$row['datetime']."
                </small><button id='msg_id_".$row['id']."' onclick='favourite(".$row['id'].",this.id)'  type='button'   class='pull-right   heart_button fav_show_hide_".$row['fav']."'><span class='glyphicon glyphicon-heart'></span></button></p>
                
            </div>
        </div>
                ";
            }
        }
      
        else
        {
            $data="<div class='media message'>
              <h3 class='text-center text-danger'>Sorry you don't have any messages</h3>
              <p class='text-center '>Share your link <a href='http://localhost:8080/sec_message/?data=".$_SESSION['user_name']."' >http://localhost:8080/sec_message/?data=".$_SESSION['user_name']."</a> to social media to get feedbacks</p>
            </div>";
        }
        
    }
    
   }
else 
   {
       //redirect to login page
       header("Location:./account/login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Messages</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/index.js"></script>
   

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
        <ul  class="nav navbar-nav navbar-right ">
            <li><a id="index" href="../index.php"> <span class="glyphicon glyphicon-home"></span> Home </a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a id="login" href="./account/login.php">Login</a></li>
            <li><a id="signup" href="./account/signup.php">Register</a></li>
        </ul>
    </div>
    </div>
</nav>
<div style="padding-top:20px;" class="container grey ">
      <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-sm">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-">Remove Message</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure that you want to remove the message?</p>
        </div>
        <div class="modal-footer">
               <div class="btn-group btn-group-justified ">
               <div class="btn-group">
    <button  style="text-decoration:none;" type="button" data-dismiss="modal" onclick="deleteConfirm()" class="btn btn-link modal-action">Confirm</button>
  </div>
  <div class="btn-group">
    <button  style="text-decoration:none;" type="button" class="btn btn-link modal-action" data-dismiss="modal">Cancel</button>
  </div>
               </div>
                
            </div>
      </div>
      
    </div>
  </div>
            
 <div style="border:1px solid blue;background-color:white;" class=" text-center">
        <span  style="font-size:x-large">Messages</span>
  <ul  style="padding:4px;" class="nav nav-pills nav-justified small">
    <li class="active "><a data-toggle="tab" href="#home">Recieved</a></li>
    <li><a data-toggle="tab" href="#menu1">Favourite</a></li>
    <li ><a data-toggle="tab" href="#menu2">Sent</a></li>
  </ul>  
    
 </div>
        

  <div class="tab-content ">
    <div id="home" class="tab-pane fade in active">
       
       <?php echo $data; ?>
       
    </div>
    <div id="menu1" class="tab-pane fade">
        <?php echo $fav; ?>
      </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
  
  </div>
</div>
    </div>

</body>
<footer class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-offset-2 col-sm-10">
                 <h4><small>ChatShaT 2017 &copy; <span class="btn btn-facebook"></span> <a href="#">Privacy</a> - <a href="#">Terms</a></small></h4>
                        
                </div>
            </div>
             
         </footer>
</html>
<?php
//check wether login session is created or not
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
  echo "
<script>
$('#signup').text('Logout');
$('#signup').attr('href','account/logout.php');
$('#login').text('Settings');
$('#login').attr('href','account/manage/setting.php');
$('#index').text('My Messages');
$('#index').attr('href','message.php');
</script>";  
}
?>
