<div class="side_dental">
   
<div class="alert alert-info">
    <i class="icon-calendar icon-large"></i>
    <?php
    $Today = date('y:m:d');
    $new = date(' d/m/Y', strtotime($Today));
    echo $new;
    ?>
</div>

<div class="navbar">
    <div class="navbar-inner">
        <div class="pull-left">
        <div class="navbar">
    <div class="">
        <div class="pull-right">
            <ul class="nav">
               
                
                <li>

                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="icon-user icon-large"></i>&nbsp;<i class="icon-cog icon-large"></i>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#myModal" data-toggle="modal"><i class="icon-signout icon-large"></i>&nbsp;Logout</a></li>


                        </ul>
                        </div>
                        </li>
                        </ul>
                   
                    </div>
                    </div> 

                    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                            <h3 id="myModalLabel">Logout</h3>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to logout?</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
                            <a href="logout.php" class="btn btn-primary">Yes</a>
                        </div>
                    </div>


                    </div>							
        </div>
    </div>
</div>
<ul class="nav nav-tabs nav-stacked">
    <li class="active">
        <a href="dasboard.php"><i class="icon-home icon-large"></i>&nbsp;Home</i></a>
    </li>
	<li><a href="user.php"><i class="icon-user icon-large"></i>&nbsp;Administrators Accounts</a></li>
	<li><a href="courses.php"><i class="icon-tasks icon-large"></i>&nbsp;Courses </a></li>
	<li><a href="staffs.php"><i class="icon-group icon-large"></i>&nbsp;Hod's and Dean</a></li>

	
   
 
 
 </ul>
</div>