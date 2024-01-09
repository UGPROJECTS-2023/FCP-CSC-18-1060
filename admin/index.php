<?php include('header.php');
session_start();

 ?>
<?php include('navbar.php'); ?>
<?php
                            if (isset($_POST['submit'])) {
                                session_start();
                                $username = $_POST['username'];
                                $password = $_POST['password'];
                                $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                                $result = mysqli_query($con,$query)or die(mysqli_error());
                                $num_row = mysqli_num_rows($result);
                                $row = mysqli_fetch_array($result);
                                if ($num_row > 0) {
                                    header('location:dasboard.php');
                                    $_SESSION['id'] = $row['id'];
                                } else {
                                    ?>
                                    <br />
                                    <br />
                                    <div class="alert alert-danger"><button type='button' class='close' data-dismiss='alert'>&times;</button>Access Denied!!! Wrong Login Details</div> 
                                <?php
                                }
                            }
                            ?>
<style type="text/css">
 .tittle{
  margin-top:  10px;
  text-align:  center;
  font-style: oblique ;
   font-size: 25px;
   
 } 
</style>
<div class="container">
    <div class="margin-top">
        <div class="row">	
           <div class="span12" align="center">
           
                <?php //include('banner.php'); ?>
                 <div class="well well-lg tittle">ONLINE STUDENTS COURSE EVALUATION SYSTEM</div>
                <?php //include('slider.php'); ?>
                
               </div>
          </div>
            <hr />
                <div class="well lgoin_terry">
                    <div class="alert alert-info"><strong>Enter Login Details Below..</strong></div>
                    <form class="form-horizontal" method="post">
                        <div class="control-group">
                            <label class="control-label" for="inputEmail"><strong>Username</strong></label>
                            <div class="controls">
                                <input type="text" name="username" id="username" placeholder="Username" required="required" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword"><strong>Password</strong></label>
                            <div class="controls">
                                <input type="password" name="password" id="password" placeholder="Password" required="required" />
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button id="login" name="submit" type="submit" class="btn"><i class="icon-signin icon-large"></i>&nbsp;Login</button>
                            </div>
                            
                        </div>
                    </form>

                </div>
      </div>		
  </div>
</div>
</div>

<?php include('footer.php') ?>