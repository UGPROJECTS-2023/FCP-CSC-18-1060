<?php include('header.php'); ?>
<?php include('session.php'); 
$uid=$_GET['id']; 
 $course_query = mysqli_query($con, "select * from courses WHERE course_id = '".$uid."'")or die(mysql_error());
 $row1 = mysqli_fetch_array($course_query)?>
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
                <strong><i class="icon-group icon-large"></i>&nbsp;Students : &nbsp;<?php echo $row1['course_code']; ?>&nbsp;<?php echo $row1['course_name']; ?> </strong>
				
            </div>
            <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'edited'){
			
					echo "<div id='successss'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>STUDENT EMAIL WAS EDITED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successss").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
                
                 <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'deleted'){
			
					echo "<div id='successs'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>STUDENT  WAS DELETED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successs").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
                
                 <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'delete'){
			
					echo "<div id='succe'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>ALL STUDENTS HAVE BEEN DELETED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#succe").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
			<form  method = "POST" enctype="multipart/form-data" >
			<div class="control-group">
			<div class="controls">
        <input type = "file" name = "fl" style=" height: 35px;" required ><input type= "submit" name = "up" value="Upload Student Reg Numbers" onclick="return confirm('confirm data upload ?');" >
		 <a href= "delete_all.php?cid=<?php echo $uid ; ?>" onclick="return confirm('confirm information delete');" title= 'Delete' class = 'btn btn-danger pull-right' ><i class='icon-trash icon-large'></i>&nbsp;Delete All</a> </div>
		</div>
		</form>
		  <?php
	
require_once "simplexlsx.class.php";
//process upload
	if (isset($_POST['up'])){
		if ($_FILES['fl']['name']){
			$target_file = basename($_FILES['fl']['name']);
			$ext =  pathinfo($target_file,PATHINFO_EXTENSION); 
			if ($ext == 'xlsx'){

				$xlsx = new SimpleXLSX( $_FILES['fl']['tmp_name'] );
				list($cols, $rows) = $xlsx->dimension();
				$rup=0; $rad=0;
				foreach( $xlsx->rows() as $k ) {
					if ($k == 0) continue; // skip first row
					   $jno=""; 
					   $jno = $k[0];
					   $mail = $k[1];
						
					
					$result = @mysqli_query($con,"select student_id from students where student_id ='".$jno."' AND course_code = '".$uid."'  ");
					if (@mysqli_num_rows($result)>0){
						
						$rup+=1;
					
					}
					else{
						@mysqli_query($con, "insert into students values ('','".strtoupper($jno)."','".$mail."','".$uid."','1')");
						$rad+=1;
					}
				}
				
				echo "<font color = red>$rup Student Record already exist </font><br>
				<font color = green>$rad Student Recorded added successfully</font>";
			}else{ echo "<font color=red>Select an excel file to upload data</font>"; }
		}else{ echo "<font color=red>Select an excel file to upload data</font>"; }
	}

	?>
    
<hr>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-condensed" id="example">

                <thead>
                    <tr>
						<th>Reg No</th>
                        <th>email</th>
					
						<th>Action</th>
						 </tr>
                </thead>
                <tbody>

                    <?php
				
                    $user_query = mysqli_query($con, "select * from students WHERE course_code = '".$uid."' AND status = 1 ORDER BY id ASC")or die(mysql_error());
                    while ($row = mysqli_fetch_array($user_query)) {
                        $id = $row['id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
						<td><?php echo $row['student_id']; ?></td> 
						<td><?php echo $row['email']; ?></td> 
                        
						
                         
                        
                                     <td width="100">
                           
                            
                            <a rel="tooltip"  title= 'edit' id="e<?php echo $id; ?>" href="#<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
                                    	<?php include('modal_edit_student.php'); ?>
                                								<a href="delete_student.php?id=<?php echo $id; ?>&cid=<?php echo $uid; ?>" rel="tooltip" title="Delete" id="e<?php echo $id; ?>" onclick="return confirm('Do you want to delete this admin?');"  class = 'btn btn-danger' ><i class='icon-trash icon-large'></i></a>
                            <?php //include('edit_user.php'); ?>
                            </td>
                        <?php include('toolttip_edit_delete.php'); ?>
                        </tr>
<?php } 

?>

                </tbody>
            </table>

            
        </div>
    </div>
<?php include('footer.php') ?>