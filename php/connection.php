<?php
$conn=mysqli_connect("localhost","root","") or die(mysqli_connect_error());
mysqli_select_db($conn,"sec_message") or die(mysqli_error($conn));

?>