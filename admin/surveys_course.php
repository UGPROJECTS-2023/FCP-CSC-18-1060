<?php include('header.php'); ?>
<?php include('session.php'); 
$cid=$_GET['id']; 
 $course_query = mysqli_query($con, "select * from courses WHERE course_id = '".$cid."'")or die(mysql_error());
 $row = mysqli_fetch_array($course_query)?>

 <div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container"  >
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <ul class="nav">

                </ul>
                

            </div>
        </div>
    </div>
</div>
<div class="container">
<div class="margin-top">
	<div class="row">	
        <div class="span3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="span9">
        <br>
            <div class="well" align="center">  <h3 class="text-success"><i class=" icon-book icon-large"></i>&nbsp;<?php echo strtoupper($row['course_code']); ?>&nbsp;:&nbsp;<?php echo strtoupper($row['course_name']); ?> </h3></div>
            <hr>
            
                 <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'edit'){
			
					echo "<div id='successss'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>SURVEY WAS EDITED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successss").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
                  <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'deleted'){
			
					echo "<div id='successs'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>SURVEY  WAS DELETED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successs").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
             
            <?php include('add_survey.php'); ?>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-condensed" id="example">
  <thead>
                    <tr>
                       
                        <th></th>
                        <th></th>                
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>

                    <?php
                    $course_query = mysqli_query($con, "select * from surveys WHERE suv_course = '".$cid."' AND suv_status = 1")or die(mysql_error());
                    while ($row = mysqli_fetch_array($course_query)) {
                        $id = $row['suv_id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
                           
                            <td><div class="well-small"><?php echo $row['suv_name']; ?></div></td> 
                            <td> <a rel="tooltip"  class="btn   btn-primary" title= 'view survey questions and details'  href="course_survey.php?course=<?php echo $cid; ?>&sid=<?php echo $id; ?>">Questions &amp; Details</a></td>
                            <td> <a rel="tooltip"  class="btn " title= 'view survey result'  href="survey_result.php?course=<?php echo $cid; ?>&sid=<?php echo $id; ?>">Survey Result</a></td>
							 <td> <a rel="tooltip"  class="btn  btn-success" title= 'send Email Notification to students'  href="students_email.php?course=<?php echo $cid; ?>&sid=<?php echo $id; ?>"> Send Email Notification</a></td>

                            <td> <a rel="tooltip"  class="btn  btn-success" title= 'send survey to students'  href="survey_email.php?course=<?php echo $cid; ?>&sid=<?php echo $id; ?>"> Send Email</a></td>
                            <td width="100">
                           
                            
                            <a rel="tooltip"   title= 'edit' id="e<?php echo $id; ?>" href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-warning"><i class="icon-pencil icon-large"></i></a>
                                    	<?php include('modal_edit_survey.php'); ?>
                                								<a href="delete_survey.php?id=<?php echo $id; ?>&cid=<?php echo $cid; ?>" rel="tooltip" title="Delete" id="e<?php echo $id; ?>" onclick="return confirm('Do you want to delete this survey?');"  class = 'btn btn-danger' ><i class='icon-trash icon-large'></i></a>
                           
                            </td>
                        <?php include('toolttip_edit_delete.php'); ?>
                        </tr>
<?php } ?>

                </tbody>
            </table>

        </div>
    </div>
<?php include('footer.php') ?>