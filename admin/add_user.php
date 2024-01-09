<p><a  href="#adduser" data-toggle="modal" class="btn btn-info" ><i class="icon-plus"></i>&nbsp;Add Administrator</a></p>
<div id="adduser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Add Administrator</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Username</label>
                <div class="controls">
                    <input type="text" id="inputEmail" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Password</label>
                <div class="controls">
                    <input type="password" name="password" id="inputPassword" placeholder="Password" required>
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
    $username = $_POST['username'];
    $password = $_POST['password'];

	$select = "select * from users where username = '$username'";
	$run = mysqli_query($con,$select);
	$row = mysqli_fetch_array($run);
	$check = mysqli_num_rows($run);
	if($check == 1 ) { 
	 ?>
	  <div class="alert alert-danger"><button type='button' class='close' data-dismiss='alert'>&times;</button> This Username <?php  echo   $row['username'] ;?> is already been registered</div>
	<?php
		} 
		
		else 
		{
   
      mysqli_query($con, "insert into users (username,password) values('$username','$password')")or die(mysql_error());
	
	echo "<div id='success'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>ADMIN  WAS DELETED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 
	<script type="text/javascript">
				
				setTimeout(function (){
		$("#success").fadeOut('slow');
	 }, 5000);

		 </script>
 
	  <script>
        window.location = "user.php?action=added";
    </script>
  
<?php }
}
?>
