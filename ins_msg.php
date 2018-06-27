<?php
session_start();
if(isset($_SESSION['msg_id']))
{
    $id=$_SESSION['msg_id'];
    if(isset($_REQUEST['data']))
{
    $data=$_REQUEST['data'];
    $mysqli=new mysqli("localhost","root","","sec_message");
if($mysqli->connect_errno)
{
    echo "failed to connect".$mysqli->connect_error;
}
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
	{
		$stmt=$mysqli->prepare("INSERT INTO `messages`(user_id,message) VALUES(?,?)");
	}
$stmt=$mysqli->prepare("INSERT INTO `messages`(user_id,message) VALUES(?,?)");
$stmt->bind_param("is",$id,$data);
$stmt->execute();


$stmt->close();
echo "data inserted";
}
else
{
    header("Location:../index.php");
}

}

?>