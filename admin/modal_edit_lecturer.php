<div id="<?php echo $id ; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
	       <div class="alert alert-info"><strong>Edit Lecturer</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Name</label>
                <div class="controls">
                    <input type="hidden" id="inputEmail" name="id" value="<?php echo $row['lid']; ?>" required>
                    <input type="text" id="inputEmail" readonly="readonly" name="name" value="<?php echo $row['lec_name']; ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Email</label>
                <div class="controls">
                    <input type="email" name="email" id="inputPassword" value="<?php echo $row['lec_email']; ?>" required>
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

    mysqli_query($con, "update lecturers set lec_email ='$email' where lid='$id'")or die(mysql_error());
    ?>
    <script>
        window.location = "course_lecturer.php?action=edited&id=<?php echo $uid; ?>";
    </script>
    <?php
}
?>