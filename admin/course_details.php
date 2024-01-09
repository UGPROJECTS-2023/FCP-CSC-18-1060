<?php include('header.php'); ?>
<?php include('session.php');
$id=$_GET['id']; 
 $course_query = mysqli_query($con, "select * from courses WHERE course_id = '".$id."'")or die(mysql_error());
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
            <hr>
            <div class="alert alert-info">
                
                <h4><i class=" icon-book icon-large"></i>&nbsp;<?php echo $row['course_code']; ?>&nbsp;:&nbsp;<?php echo $row['course_name']; ?> </h4>
            </div>

              
           <div class="span12">
           <div class=" span2 well">
           <a href="course_students.php?id=<?php echo $id ?>" class="btn btn-large btn-block btn-primary"><i class=" icon-group icon-large"></i>&nbsp;Course Students</a>
           </div>
           <div class=" span2 well">
           <a href="surveys_course.php?id=<?php echo $id ?>" class="btn btn-block btn-large btn-success"><i class="icon-bar-chart icon-large"></i>&nbsp;Course Surveys </a>
           </div>
           
           <div class=" span2 well">
           <a href="course_lecturer.php?id=<?php echo $id ?>" class="btn btn-block btn-large btn-danger"><i class=" icon-male icon-large"></i>&nbsp;Course Lecturers </a>
           </div>
</div>
        </div>
    </div>
<?php include('footer.php') ?>