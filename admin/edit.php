<?php include('header.php'); ?>
<?php include('session.php'); 
?>
<div class="container">

    <div class="row">	
        <div class="span3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="span9">
            <img src="../img/dr.jpg" class="img-rounded">
            <?php include('navbar_dasboard.php') ?>
            <br>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-user icon-large"></i>&nbsp;Re-Allocation</strong>
				
            </div>
		<?php $id = $_GET['id']; ?>		
		<?php $std = mysqli_query($con, "select * from tbl_students WHERE student_id = '$id'")or die(mysql_error());
					$std_row = mysqli_fetch_array($std);

	$sup_query="SELECT * FROM tbl_supervisors WHERE supervisor_id ='".$std_row['supervisor_id']."'";
			$sup_result=mysqli_query($con, $sup_query); 
			$sup_row=mysqli_fetch_array($sup_result);

?>
        <form class="form-horizontal" method="post">
            <div class="control-group">
                <label class="control-label" for="inputEmail">New Supervisor <?php echo $std_row['supervisor_id']; ?></label>
                <div class="controls">
                    <?php 
$all_sup="SELECT * FROM tbl_supervisors WHERE names !='' ";
$all_sup_res = mysqli_query($con, $all_sup);

?>
<select class="form-control" name="supervisor">
<option value="<?php echo $sup_row['supervisor_id'];?>" selected = selected><?php echo $sup_row['names'];?></option>
<?php while ($all_sup_row = mysqli_fetch_array($all_sup_res)) { ?>
<option value="<?php echo $all_sup_row['supervisor_id'];?>"><?php echo $all_sup_row['names'];?></option>
<?php } ?>
</select>
             </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">New Project</label>
                <div class="controls">
                    <?php 
$all_proj="SELECT * FROM tbl_project WHERE status = '0' ";
$all_proj_res = mysqli_query($con, $all_proj);

$my_proj="SELECT * FROM tbl_project WHERE project_id = '".$std_row['project_id']."' ";
$my_proj_res = mysqli_query($con, $my_proj);
$my_proj_row = mysqli_fetch_array($my_proj_res);
?>
<select class="form-control" name="project">
<option value="<?php echo $my_proj_row['project_id'];?>" selected = selected><?php echo $my_proj_row['name'];?></option>
<?php while ($all_proj_row = mysqli_fetch_array($all_proj_res)) { ?>
<option value="<?php echo $all_proj_row['project_id'];?>"><?php echo $all_proj_row['name'];?></option>
<?php } ?>
</select>
                </div>
            </div>
			
            
            <div class="control-group">
                <div class="controls">
                    <button name="edit" type="submit" class="btn btn-success"><i class="icon-save icon-large"></i>&nbsp;Re-allocate</button>
                </div>
            </div>
        </form>
		<?php
if (isset($_POST['edit'])) {

    $supervisor = $_POST['supervisor'];
    $project = $_POST['project'];
	

    mysqli_query($con, "update tbl_students set project_id='$project', supervisor_id='$supervisor'  where student_id='$id'")or die(mysql_error());
    ?>
    <script>
        window.location = "reallocate.php";
    </script>
    <?php
}
?>
    </div>

</div>

            
        </div>
    </div>
<?php include('footer.php') ?>