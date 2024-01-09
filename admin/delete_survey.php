<?php
include('dbcon.php');
$id=$_GET['id'];
$cid=$_GET['cid'];

 mysqli_query($con, "update surveys  set suv_status=0 where suv_id='".$id."'")or die(mysql_error());
    header('Location: surveys_course.php?id='.$cid.'&action=deleted');

?>
