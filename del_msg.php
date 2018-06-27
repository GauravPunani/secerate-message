<?php
session_start();
if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{
    if(isset($_REQUEST['data']))
    {
        $id=$_REQUEST['data'];
        echo "data recived";
        include("php/connection.php");
        $sql="DELETE FROM `messages` WHERE `id`='$id'";
        $res=mysqli_query($conn,$sql);
        if($res==true)
        {
            echo "record deleted";
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
    else
    {
        echo "data not set";
    }
}
else
{
    echo "session not set";
}
?>