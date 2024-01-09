<?php
include('dbcon.php');
$id=$_GET['id'];
$cid=$_GET['cid'];
mysqli_query($con, "delete from staff where staff_id='$id'") or die(mysql_error());
header('location:staffs.php?action=deleted&id='.$cid.'');
?>