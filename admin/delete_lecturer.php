<?php
include('dbcon.php');
$id=$_GET['id'];
$cid=$_GET['cid'];
mysqli_query($con, "delete from lecturers where lid='$id'") or die(mysql_error());
header('location:course_lecturer.php?action=deleted&id='.$cid.'');
?>