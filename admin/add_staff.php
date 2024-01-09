<p><a  href="#adduser" data-toggle="modal" class="btn btn-info" ><i class="icon-plus"></i>&nbsp;Add Hod or dean</a></p>
<div id="adduser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Add staff</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Name</label>
                <div class="controls">
                    <input type="text" id="inputEmail" name="name" placeholder="Name" required>
                </div>
            </div>
             <div class="control-group">
                <label class="control-label" for="inputEmail">Position</label>
                <div class="controls">
                   <select name="pos" id="list_type" class="form-control " required data-validation-required-message="Please select listing type.">
                                   
                                        <option value="Dean"selected="selected">Dean</option>
                                        <option value="HOD">HOD</option>
                                    </select>
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
	$pos = $_POST['pos'];
    $select = "select * from staff where staff_email = '$email'";
	$run = mysqli_query($con,$select);
	$row = mysqli_fetch_array($run);
	$check = mysqli_num_rows($run);
	if($check == 1 ) {
	 ?>
	  <div class="alert alert-danger"><button type='button' class='close' data-dismiss='alert'>&times;</button> This Email <?php  echo   $row['staff_email'] ;?> is already been registered</div>
	<?php
		} 
		else 
		{
   
    mysqli_query($con, "insert into staff (staff_name,staff_email,staff_pos) values('$name','$email','$pos')")or die(mysql_error());
	
	echo "<div id='success'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>STAFF ADDED SUCCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 
	<script type="text/javascript">
				
				setTimeout(function (){
		$("#success").fadeOut('slow');
	 }, 5000);

		 </script>
 
	  <script>
        window.location = "staffs.php?action=added";
    </script>
  
<?php }
}
?>
