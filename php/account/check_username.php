<?php
if(isset($_REQUEST['data']))
{
    $data=$_REQUEST['data'];
$mysqli = new mysqli("localhost", "root", "", "sec_message");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* create a prepared statement */
if ($stmt = $mysqli->prepare("SELECT `username` FROM `usernames` WHERE `username`=?")) {

    /* bind parameters for markers */
    $stmt->bind_param("s", $data);

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    $stmt->bind_result($username);
    

    /* fetch value */
    $stmt->fetch();
    if($username!="")
    {
        echo "false";
    }
    else
    {
        echo "true";
    }

    /* close statement */
    $stmt->close();
}

/* close connection */
$mysqli->close();
}
?>