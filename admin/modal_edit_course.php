<div id="edit<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
	       <div class="alert alert-info"><strong>Edit Course</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Course Code</label>
                <div class="controls">
                    <input type="hidden" id="inputEmail" name="id" value="<?php echo $row['course_id']; ?>" required>
                    <input type="text" id="inputEmail" name="cc" value="<?php echo $row['course_code']; ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Course name</label>
                <div class="controls">
                    <input type="text" name="cn" id="inputPassword" value="<?php echo $row['course_name']; ?>" required>
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
    $cc = $_POST['cc'];
    $cn = $_POST['cn'];

    mysqli_query($con, "update courses set course_code='$cc', course_name='$cn' where course_id='$id'")or die(mysql_error());
    ?>
    <script>
        window.location = "courses.php?action=edited";
    </script>
    <?php
}
?>