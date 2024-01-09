<p><a  href="#adduser" data-toggle="modal" class="btn btn-info" ><i class="icon-plus"></i>&nbsp;Add New Course</a></p>
<div id="adduser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Add New Course</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Course Code</label>
                <div class="controls">
                    <input type="text" id="inputEmail" name="cc" placeholder="csc 1010" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Course name</label>
                <div class="controls">
                    <input type="text" name="cn" id="inputPassword" placeholder="e.g intro to computer science" required>
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
    $cc = $_POST['cc'];
    $cn = $_POST['cn'];
	$select = "select * from courses  where course_code = '$cc'";
	$run = mysqli_query($con,$select);
	$row = mysqli_fetch_array($run);
	$check = mysqli_num_rows($run);
	if($check == 1 ) {
	 ?>
	<div class="alert alert-danger"><button type='button' class='close' data-dismiss='alert'>&times;</button>This Course Code <?php  echo   $row['course_code'] ;?> is already been registered </div>
	<?php
		} 
		else 
		{
    mysqli_query($con, "insert into courses (course_code, course_name, course_status) values('$cc','$cn', '1')")or die(mysql_error());
	
	echo "<div id='success'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>NEW COURSE ADDED SUCCESFULLY. </b> </h5>"."</strong></div></div>";
			?> 
	<script type="text/javascript">
				
				setTimeout(function (){
		$("#success").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
<?php }?>
	
	  
  
<?php }
?>
