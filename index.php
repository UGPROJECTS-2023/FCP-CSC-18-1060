<?php include('header.php');
 include('dbcon.php'); 
 $con = mysqli_connect("localhost","root","","sce_system") or die("conection was not created");

 if(isset($_GET['cid'])){   
$cid=$_GET['cid']; 
$sid=$_GET['sid'];
$uid=$_GET['uid']; 
$today = date('d/m/Y');

 $course_query = mysqli_query($con, "select * from courses LEFT JOIN surveys ON courses.course_id = surveys.suv_course WHERE course_id = '".$cid."'")or die(mysqli_error($con));
 $row = mysqli_fetch_array($course_query);
 
  $user_check = mysqli_query($con, "select * from results  WHERE surveyId = '".$sid."' AND session_token = '".$uid."'")or die(mysqli_error($con));
 $row_check = mysqli_fetch_array($user_check);
 
 
?>

<!-- -->
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container"  >
            
            </div>
    </div>
</div>

<!-- -->

<div class="container">
    <div class="margin-top"> 
        <div class="row" >
								<div class="span3">
						<?php include('instructions.php'); ?>
						</div>

            <div class="span9" >
               <hr>
               <?php if( $today < $row['start'] ){ ?> 
               <div class="well" align="center">  <h4 class="text-success"> <i class="icon-bar-chart icon-large"></i>&nbsp; <span class=" text-error">Sorry this survey is not yet available, check back again.</span>  </h4>
            <h5> Survey name : <?php echo strtoupper($row['suv_name']); ?></h5>
            <h5> Available from : <?php echo $row['start']; ?></h5>
            <h5> To : <?php echo $row['end']; ?></h5>
               </div>
                <?php } else if ($today > $row['end'] ){ ?> 
                <div class="well" align="center">  <h4 class="text-success"> <i class="icon-bar-chart icon-large"></i>&nbsp; <span class=" text-error">This survey has expired </span>  </h4>
            <h5> Survey name : <?php echo strtoupper($row['suv_name']); ?></h5>
            <h5> Available from : <?php echo $row['start']; ?></h5>
            <h5> To : <?php echo $row['end']; ?></h5>
               </div> 
               <?php } else if (mysqli_num_rows($user_check) > 0){ ?> 
                <div class="well" align="center">  <h4 class="text-success"> <i class="icon-bar-chart icon-large"></i>&nbsp; <span class=" text-error">Survey Not Available </span>  </h4>
            <h5>You have already taken this survey</h5>
            
               </div> 
			   <?php } else { ?>
                <div class="well" align="center">  <h4 class="text-success"> <i class="icon-bar-chart icon-large"></i>&nbsp; <span class=" text-error"><?php echo strtoupper($row['course_code']); ?>&nbsp;: <?php echo strtoupper($row['course_name']); ?> </span>  </h4>
            <h5> Survey name : <?php echo strtoupper($row['suv_name']); ?></h5>
            <h5> Available from : <?php echo $row['start']; ?></h5>
            <h5> To : <?php echo $row['end']; ?></h5>
               </div>
               <div class="span2"> </div>
                <div class="span7">
               <div class="well"> 
               <a href="take_survey.php?cid=<?php echo $cid; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" class="btn btn-block btn-large btn-success"><i class="icon-bar-chart icon-large" type="submit"> </i>&nbsp;Start Survey </a>
               </div></div>
               <?php } ?>
            </div>
           
            <div class="clearfix"></div>
           </div>
    </div>
</div>
<?php } else{  ?>

<!-- -->
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container"  >
            
            </div>
    </div>
</div>

<!-- -->

<div class="container">
    <div class="margin-top"> 
        <div class="row" >
								<div class="span3">
						<?php include('instructions.php'); ?>
						</div>

            <div class="span7" >
               <hr>
               
               <div class="well" align="center">  <h3 class="text-success"> <i class="icon-bar-chart icon-large"></i>&nbsp; <span class=" text-error">No survey is availbale ...</span>  </h3>
            <h4> check your email for a link to take survey</h4>
           
               </div>
               
            </div>
           
            <div class="clearfix"></div>
           </div>
    </div>
</div>

<?php include('footer.php')  ; }?>