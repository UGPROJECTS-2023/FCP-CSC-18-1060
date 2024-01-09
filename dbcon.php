<?php 
$con = mysqli_connect('localhost','root','');
$db = mysqli_select_db($con,'sce_system') or die(mysqli_error($con));
?>