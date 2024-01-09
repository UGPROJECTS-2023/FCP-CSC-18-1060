<p><a  href="#adduser" data-toggle="modal" class="btn btn-info" ><i class="icon-plus"></i>&nbsp;Add New Survey</a></p>
<div id="adduser" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
        <div class="alert alert-info"><strong>Add New Survey </strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Survey Name</label>
                <div class="controls">
                    <input type="text" id="inputEmail" name="sn" placeholder="survey name" required>
                </div>
            </div>
            <div class="control-group">
				<label class="control-label" for="inputEmail">Start Date</label>
				<div class="controls">
				<input type="text"  class="w8em format-d-m-y  highlight-days-67 " name="sd" placeholder="e.g 01/02/2021" id="sd" maxlength="20" style="border: 3px double #CCCCCC;" required/>
				</div>
			</div>
          
            <div class="control-group">
                <label class="control-label" for="inputPassword">End Date</label>
                <div class="controls">
                   <input type="text"  class="w8em format-d-m-y  highlight-days-67 " name="ed" placeholder="e.g 01/02/2021"  maxlength="20" style="border: 3px double #CCCCCC;" required/>
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
        <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove  icon-large"></i>&nbsp;Close</button>
    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $sn = $_POST['sn'];
    $sc = $cid;
	$sd = $_POST['sd'];
    $ed = $_POST['ed'];

    mysqli_query($con, "insert into surveys (suv_name, suv_course, start, end) values('$sn','$sc', '$sd', '$ed')")or die(mysql_error());
	$sid = mysqli_insert_id($con);
     echo "<script>window.open('Location: course_survey.php?course='.$cid.'&sid='.$sid.'')</script>";
          
	//header('Location: course_survey.php?course='.$cid.'&sid='.$sid.'');?>
	  
<?php }
?>
