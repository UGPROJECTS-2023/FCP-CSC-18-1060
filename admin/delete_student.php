<?php
include('dbcon.php');
$id=$_GET['id'];
$cid=$_GET['cid'];
mysqli_query($con, "delete from students where id='$id'") or die(mysql_error());
header('location:course_students.php?action=deleted&id='.$cid.'');
?>