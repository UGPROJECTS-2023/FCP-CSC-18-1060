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
							 <div class="slider-wrapper theme-default">
                <?php include('slider.php'); ?>
                </div>
						</div>
    </div>
	</div>
	</div>
<?php include('footer.php') ?>