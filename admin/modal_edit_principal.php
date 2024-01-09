<div id="<?php echo $id ; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
	       <div class="alert alert-info"><strong>Edit Staff</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Name</label>
                <div class="controls">
                    <input type="hidden" id="inputEmail" name="id" value="<?php echo $row['staff_id']; ?>" required>
                    <input type="text" id="inputEmail" readonly="readonly" name="name" value="<?php echo $row['staff_name']; ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Position</label>
                <div class="controls">
                   <select name="pos" id="list_type" class="form-control " required data-validation-required-message="Please select listing type.">
                                   <option value="<?php echo $row['staff_pos']; ?>" selected="selected">- <?php echo $row['staff_pos']; ?> -</option>
                                        <option value="Dean" >Dean</option>
                                        <option value="HOD">HOD</option>
                                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Email</label>
                <div class="controls">
                    <input type="email" name="email" id="inputPassword" value="<?php echo $row['staff_email']; ?>" required>
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

    $id = $_POST['id'];
    $email = $_POST['email'];
	$pos = $_POST['pos'];

    mysqli_query($con, "update staff set staff_email ='$email',staff_pos ='$pos' where staff_id='$id'")or die(mysql_error());
    ?>
    <script>
        window.location = "staffs.php?action=edited";
    </script>
    <?php
}
?>