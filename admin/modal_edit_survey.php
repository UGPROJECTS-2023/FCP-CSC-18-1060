<div id="edit<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
	       <div class="alert alert-info"><strong>Edit Course</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Survey Name</label>
                <div class="controls">
                 
                    <input type="hidden" name="esid"  value="<?php echo $row['suv_id']; ?>" />
                    <input type="text" id="inputEmail" name="esn"  value="<?php echo $row['suv_name']; ?>" required>
                </div>
            </div>
            <div class="control-group">
				<label class="control-label" for="inputEmail">Start Date</label>
				<div class="controls">
				<input type="text"  class="w8em format-d-m-y  highlight-days-67 " name="esd" value="<?php echo $row['start']; ?>"  maxlength="20" style="border: 3px double #CCCCCC;" required/>
				</div>
			</div>
          
            <div class="control-group">
                <label class="control-label" for="inputPassword">End Date</label>
                <div class="controls">
                   <input type="text"  class="w8em format-d-m-y  highlight-days-67 " name="eed" value="<?php echo $row['end']; ?>"  maxlength="20" style="border: 3px double #CCCCCC;" required/>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button name="edit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Update</button>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;Close</button>
    </div>
</div>

<?php
if (isset($_POST['edit'])) {

    $esid = $_POST['esid'];
    $esn = $_POST['esn'];
    $esd = $_POST['esd'];
	$eed = $_POST['eed'];
 
	
    mysqli_query($con, "update surveys  set suv_name='$esn', start='$esd', end='$eed' where suv_id='".$id."'")or die(mysql_error());
    //header('Location: surveys_course.php?id='.$cid.'&action=edit');
}
?>