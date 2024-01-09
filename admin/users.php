<?php include('header.php'); ?>
<?php include('session.php'); ?>
<?php include('navbar_dasboard.php'); ?>
<div class="container">
    <div class="margin-top">
        <div class="row">	
            <div class="span3">			     
                <ul class="nav nav-tabs nav-stacked">
                    <li class="active">
                        <a href="#"><i class="icon-plus icon-large"></i>&nbsp;Add Administrator</a>
                    </li>
                    <li><a href="#">...</a></li>
                    <li><a href="#">...</a></li>
                </ul>
            </div>
            <div class="span9">



                <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">
                    <div class="alert alert-info">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="icon-user icon-large"></i>&nbsp;Administrators Table</strong>
                    </div>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>                                 
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $user_query = mysql_query("select * from users")or die(mysql_error());
                        while ($row = mysql_fetch_array($user_query)) {
                            $id = $row['user_id'];
                            ?>
                            <tr class="del<?php echo $id ?>">
                                <td><?php echo $row['username']; ?></td> 
                                <td><?php echo $row['password']; ?></td> 
                                <td width="100">
                                    <a rel="tooltip"  title="Delete" id="<?php echo $id; ?>" class="btn btn-danger"><i class="icon-trash icon-large"></i></a>
                                    <a rel="tooltip"  title="Edit" id="e<?php echo $id; ?>" href="#course_id<?php echo $id; ?>" data-toggle="modal" class="btn btn-success"><i class="icon-pencil icon-large"></i></a>
                                </td>
    <?php include('toolttip_edit_delete.php'); ?>
                                <!-- Modal logout login -->
                        <div id="course_id<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-body">
                                <div class="alert alert-error">Are you sure you want to Logout?</div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i>&nbsp;NO</button>
                                <a href="logout.php" class="btn btn-danger"><i class="icon-check icon-large"></i>&nbsp;Yes</a>
                            </div>
                        </div>
                        </tr>
<?php } ?>

                    </tbody>
                </table>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.btn-danger').click(function() {
                            var id = $(this).attr("id");
                            if (confirm("Are you sure you want to delete this user ?")) {
                                $.ajax({
                                    type: "POST",
                                    url: "delete_user.php",
                                    data: ({id: id}),
                                    cache: false,
                                    success: function(html) {
                                        $(".del" + id).fadeOut('slow');
                                    }
                                });
                            } else {
                                return false;
                            }
                        });
                    });
                </script>


            </div>		
        </div>
    </div>
</div>
<?php include('footer.php') ?>