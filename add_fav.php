<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    if(isset($_REQUEST['data']))
    {
        $id=$_REQUEST['data'];
        // Create connection
$conn = new mysqli("localhost", "root","","sec_message");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("UPDATE `messages` SET `fav`=0 WHERE id=?");
$stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
        echo "done";
    }
}
?>