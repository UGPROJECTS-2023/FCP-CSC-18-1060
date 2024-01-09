<?php include('header.php'); ?>
<?php include('session.php');
include('../includes/phpmailer/mail.php'); 
//application address
define('SITEEMAIL','example@domain.com');
$cid=$_GET['course']; 
$sid=$_GET['sid']; 
 $course_query = mysqli_query($con, "select * from courses LEFT JOIN surveys ON courses.course_id = surveys.suv_course WHERE course_id = '".$cid."'")or die(mysql_error());
 $row = mysqli_fetch_array($course_query);
 ?>

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
            <div class="well" align="center">  <h4 class="text-success"> <i class="icon-envelope icon-large"></i>&nbsp;Send <span class=" text-error"><?php echo strtoupper($row['course_code']); ?>&nbsp;: <?php echo strtoupper($row['course_name']); ?> </span> Survey Notification To Students Email </h4>
            <h5> survey name : <?php echo strtoupper($row['suv_name']); ?></h5></div>
            <hr>
            
                 <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'sent'){
			
					echo "<div id='successss'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>SURVEY NOTIFICATION WAS SENT TO STUDENTS SUCESSFULLY. </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successss").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
                  <?php //if action is complete show sucess
				if(isset($_GET['action']) && $_GET['action'] == 'Failed'){
			
					echo "<div id='successs'><div class='alert alert-error' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-error'><b>SURVEY  WAS NOT SENT  SUCESSFULLY. TRY AGAIN </b> </h5>"."</strong></div></div>";
			?> 	<script type="text/javascript">
				
				setTimeout(function (){
		$("#successs").fadeOut('slow');
	 }, 5000);
	 
	
		
		 </script>
          
		<?php }
				?>
        <script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script> 
            <form  method="post">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-condensed table-striped alert-success" style="color:#000" id="example">
			<div class="form-group">
		    <label for="questionPos">Write Text Message</label>
		    <textarea class="form-control" id="questionPos" name="msg" rows="5" cols="30" required ></textarea>
		  </div>
  <thead>
                    <tr>
                       
                        <th>Student id</th>
                        <th> Email</th>
                        <th> select all <input type="checkbox"  id="select_all" ></th>                
                        
                    </tr>
                </thead>
                
                <tbody>
				
                    <?php
                    $emails_query = mysqli_query($con, "select * from students WHERE course_code = '".$cid."' AND status = 1" )or die(mysql_error());
                    while ($row_email = mysqli_fetch_array($emails_query)) {
                        $id = $row_email['id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
                           
                            <td><?php echo $row_email['student_id']; ?></td>
                            <td><?php echo $row_email['email']; ?></td> 
                            <?php if($row_email['email'] != ""){ ?>
                            <td><input  type="checkbox" name="check_list[]" class="checkbox" checked value="<?php echo $row_email['email']; ?>"> </td>
                            <?php }else { ?>
                            <td></td>
                           <?php } ?>
                        <?php include('toolttip_edit_delete.php'); ?>
                        </tr>
<?php } ?>

                </tbody>
            </table>
           
            <div align="center" class="well">
             <button type="submit" id="submit" name="send_mail" class='btn btn-success  btn-large'><i class="icon icon-envelope"></i> Send Email</button></div>
</form>

<?php 

if(isset($_POST['send_mail'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
// Loop to store and send email to value of individual checked checkbox.
foreach($_POST['check_list'] as $selected){
	//send email
			$to = $selected;
			$subject = $row['course_code'] .$row['course_name'] . $row['suv_name'] . "survey";
			$body = $_POST['msg']. $row['suv_name'] ."</b> for the course <b>". $row['course_name'] ." </b>. Survey will be availavle from <b>". $row['start'] ."</b> to <b>". $row['end'] ."</b>";
			
			$mail = new Mail();
			$mail->setFrom(SITEEMAIL,'SITENAME');
			$mail->addAddress($to);
			$mail->subject($subject);
			$mail->body($body);
			$mail->send();

			

}

 if( $mail == true )  
   {
    echo "<div id='successss'><div class='alert alert-success' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-success'><b>SURVEY NOTIFICATION WAS SENT TO STUDENTS SUCESSFULLY. </b> </h5>"."</strong></div></div>";
   }
   else
   {
    echo "<div id='successs'><div class='alert alert-error' align='center'> <button type='button' class='close' data-dismiss='alert'>&times;</button><strong><i class='close icon-large'></i>" ."<h5 class='bg-success text-error'><b>SURVEY  WAS NOT SENT  SUCESSFULLY. TRY AGAIN </b> </h5>"."</strong></div></div>";
   }


 //echo "Message sent successfully...";
//header('Location: students_email.php?action=sent&course='.$cid.'&sid='.$sid.'');
/*echo "<script>window.open('students_email.php?action=sent&course=".$cid."&sid=".$sid.",'_self')</script>";
*/}
//else{echo "Message could not be sent...";}
}
?>

        </div>
    </div>
<?php include('footer.php') ?>