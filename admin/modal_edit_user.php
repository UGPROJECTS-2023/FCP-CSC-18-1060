<div id="edit<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-body">
	       <div class="alert alert-info"><strong>Edit User</strong></div>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Username</label>
                <div class="controls">
                    <input type="hidden" id="inputEmail" name="id" value="<?php echo $row['id']; ?>" required>
                    <input type="text" id="inputEmail" name="username" value="<?php echo $row['username']; ?>" required>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Password</label>
                <div class="controls">
                    <input type="text" name="password" id="inputPassword" value="<?php echo $row['password']; ?>" required>
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
    $username = $_POST['username'];
    $password = $_POST['password'];

    mysqli_query($con, "update users set username='$username', password='$password' where id='$id'")or die(mysql_error());
    ?>
    <script>
        window.location = "user.php?action=edited";
    </script>
    <?php
}
?>