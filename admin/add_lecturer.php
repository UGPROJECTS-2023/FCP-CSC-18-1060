<p><a  href="#adduser" data-toggle="modal" class="btn btn-info" ><i class="icon-plus"></i>&nbsp;Add Course Lecturer</a></p>
<div id="adduser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Add Course Lecturer</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Lecturer Name</label>
                <div class="controls">
                <input type="hidden" id="inputEmail" name="course" value="<?php echo $uid ; ?>" required>
                    <input type="text" id="inputEmail" name="name" placeholder="Name" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Email</label>
                <div class="controls">
                    <input type="email" name="email" id="inputPassword" placeholder="email" required>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button name="submit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
	$cid = $_POST['course'];
	$select = "select * from lecturers where lec_course= '$uid' and lec_email = '$email'";
	$run = mysqli_query($con,$select);
	$row2 = mysqli_fetch_array($run);
	$check = mysqli_num_rows($run);
	if($check == 1 ) {
	 ?>
	 <div class="alert alert-danger"><button type='button' class='close' data-dismiss='alert'>&times;</button> This Email <?php  echo   $row2['lec_email'] ;?> is already been registered</div>
	<?php
		} 
		else 
		{
    mysqli_query($con, "insert into lecturers (lec_name,lec_email,lec_course) values('$name','$email','".$cid."')")or die(mysql_error());
	?>
	  
  
<?php }
}
?>
