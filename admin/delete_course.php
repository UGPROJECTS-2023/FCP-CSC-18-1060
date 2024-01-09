<?php
include('dbcon.php');
$id=$_GET['id'];
$cname=$_GET['cname'];
$ccode=$_GET['ccode'];
mysqli_query($con, "update courses set course_status= 0 where course_id='$id'")or die(mysql_error());
header('location:courses.php?action=deleted&cnamee='.$cname.'&ccodee='.$ccode.'');
?>
				