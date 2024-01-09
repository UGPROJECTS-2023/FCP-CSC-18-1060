<?php include('header.php'); ?>
<?php include('session.php'); 
$sql2 = "SELECT * FROM departments";
$qry2 = mysql_query($sql2) or die(mysql_error());

?>
<div class="container">

    <div class="row">	
        <div class="span3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class="span9">
            <img src="../img/dr.jpg" class="img-rounded">
            <?php include('navbar_dasboard.php') ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><i class="icon-user icon-large"></i>&nbsp;Clearance Students Table</strong>
				
            </div>
			<form method = "POST">
	<?php
$select = '<select name="dept" style="width: 190px; height: 35px; margin-left: 15px; border: 3px double #CCCCCC; padding:5px 10px;" >';
$select.='<option value="">Select Department</option>';
while($row2=mysql_fetch_array($qry2)){
    $select.='<option value="'.$row2['department'].'">'.$row2['department'].'</option>';
  }
$select.='</select>';
echo $select; 
?>
        <button name="submit" type="submit" class="btn" style=" height: 35px;" >&nbsp;View by Department</button>
		</form>

            <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example">

                <thead>
                    <tr>
						<th>Regno</th>
                        <th>Surname</th>
						<th>Other names</th>
						<th>Department</th>
						 </tr>
                </thead>
                <tbody>

                    <?php
										if (isset($_POST['submit'])){
						$dept = $_POST['dept'];

                    $user_query = mysql_query("select * from students WHERE department_study = '$dept'")or die(mysql_error());
                    while ($row = mysql_fetch_array($user_query)) {
                        $id = $row['id'];
                        ?>
                        <tr class="del<?php echo $id ?>">
						<td><?php echo $row['regno']; ?></td> 
						<td><?php echo $row['surname']; ?></td> 
						<td><?php echo $row['names']; ?></td> 
                            <td><?php echo $row['department_study']; ?></td> 
                        
                        </tr>
<?php } 
										}
?>

                </tbody>
            </table>

            
        </div>
    </div>
<?php include('footer.php') ?>