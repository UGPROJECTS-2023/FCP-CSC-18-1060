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
                <strong><i class="icon-group icon-large"></i>&nbsp;HODs and Dean</strong>
            </div>
            <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'edited'){
			
					echo "<div id='successss'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>STAFF INFO WAS EDITED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successss").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
                
                 <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'deleted'){
			
					echo "<div id='successs'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>STAFF WAS DELETED SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successs").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
                
                 <?php //if action is complete show sucess
				/*if(isset($_GET['action']) && $_GET['action'] == 'added'){
			
					echo "<div id='succe'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>STAFF ADDED SUCCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#succe").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }*/
		
				?>
			
		  <?php include('add_staff.php'); ?>
    
<hr>
		<table cellpadding="0" cellspacing="0" border="0" class="table table-condensed" id="example">

                <thead>
                    <tr>
						<th>Name</th>
                        <th>email</th>
                        <th>Position</th>
					
						<th>Action</th>
						 </tr>
                </thead>
                <tbody>

                    <?php
				
                    $user_query = mysqli_query($con, "select * from staff WHERE status = 1 ")or die(mysql_error());
                    while ($row = mysqli_fetch_array($user_query)) {
                        $id = $row['staff_id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
						<td><?php echo $row['staff_name']; ?></td> 
						<td><?php echo $row['staff_email']; ?></td> 
                        <td><?php echo $row['staff_pos']; ?></td> 
                        
						
                         
                        
                                     <td width="100">
                           
                            
                            <a rel="tooltip"  title= 'edit' id="e<?php echo $id; ?>" href="#<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
                                    	<?php include('modal_edit_staff.php'); ?>
                                								<a href="delete_staff.php?id=<?php echo $id; ?>" rel="tooltip" title="Delete" id="e<?php echo $id; ?>" onclick="return confirm('Do you want to delete this person?');"  class = 'btn btn-danger' ><i class='icon-trash icon-large'></i></a>
                           
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