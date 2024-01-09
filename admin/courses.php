<?php include('header.php'); ?>
<?php include('session.php'); ?>
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
            <hr>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-tasks icon-large"></i>&nbsp;Courses</strong>
            </div>
<?php //if action is complete show sucess
				/*if(isset($_GET['action']) && $_GET['action'] == 'added'){
			
					echo "<div id='success'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>NEW COURSE ADDED SUCCESFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#success").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
                
                <?php //if action is complete show sucess
				*/
				
				if(isset($_GET['action']) && $_GET['action'] == 'deleted'){
				$cnamee  = ($_GET['cnamee']);
			    $ccodee  = ($_GET['ccodee']);
				    ?> 
					 
					 <div class="alert alert-success"><button type='button' class='close' data-dismiss='alert'>&times;</button> THE COURSE <?php echo strtoupper($ccodee)." ". strtoupper($cnamee) ?> WAS DELETED SUCESSFULLY </div>
	
					 <?php } ?>  
					   
                <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'edited'){
			
					echo "<div id='successss'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>COURSE WAS EDITED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successss").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
            <?php include('add_course.php'); ?>
            <table cellpadding="0" cellspacing="0" border="0" class="table table-condensed" id="example">

                <thead>
                    <tr>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th></th>                
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $course_query = mysqli_query($con, "select * from courses WHERE course_status = 1")or die(mysql_error());
                    while ($row = mysqli_fetch_array($course_query)) {
                        $id = $row['course_id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
                            <td><a rel="tooltip"  class="btn " title= 'view course'  href="course_details.php?id=<?php echo $id; ?>"><?php echo $row['course_code']; ?></a></td> 
                            <td><div class="well-small"><?php echo $row['course_name']; ?></div></td> 
                            <td> <a rel="tooltip"  class="btn   btn-primary" title= 'view course'  href="course_details.php?id=<?php echo $id; ?>"> Details</a></td>
                            <td width="100">
                           
                            
                            <a rel="tooltip"   title= 'edit' id="e<?php echo $id; ?>" href="#edit<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
                                    	<?php include('modal_edit_course.php'); ?>
                                <a href= delete_course.php?id=<?php echo $id; ?>&ccode=<?php echo $row['course_code']; ?>&cname=<?php echo $row['course_name']; ?>  rel="tooltip" title="Delete" id="e<?php echo $id; ?>" onclick="return confirm('Do you want to delete this course?');"  class = 'btn btn-danger' ><i class='icon-trash icon-large'></i></a>

                           
                            </td>
                        <?php include('toolttip_edit_delete.php'); ?>
                        </tr>
<?php } ?>

                </tbody>
            </table>

        </div>
    </div>
<?php include('footer.php') ?>