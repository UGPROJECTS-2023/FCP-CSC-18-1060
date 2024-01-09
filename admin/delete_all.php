<?php
include('dbcon.php');

$cid=$_GET['cid'];
mysqli_query($con, "delete from students where course_code='$cid'") or die(mysql_error());
header('location:course_students.php?action=delete&id='.$cid.'');
?>