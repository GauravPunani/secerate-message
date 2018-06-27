<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    <div style="display:none;" class="first">hello world</div>
    <div style="display:none;" class="second">you come often</div>
</body>
</html>
<?php
if(isset($_GET['data']))
{
    echo "<script>$('.second').show();</script>";
}
else
{
    echo "<script>$('.first').show();</script>";
}
?>