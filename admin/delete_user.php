<?php
include('dbcon.php');
$id=$_GET['id'];
mysqli_query($con, "delete from users where id='$id'") or die(mysql_error());
header('location:user.php?action=deleted');
?>