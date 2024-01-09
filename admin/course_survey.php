 <?php include('header1.php'); ?>
<?php //include('session.php');
$cid=$_GET['course']; 
$sid=$_GET['sid']; 
 $survey_query = mysqli_query($con, "select * from surveys WHERE suv_id = '".$sid."'")or die(mysql_error());
 $row = mysqli_fetch_array($survey_query)?>
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
        <div class=" col-md-3">
            <?php include('sidebar.php'); ?>
        </div>
        <div class=" col-md-9">
           <?php 
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1); 

require('../Survey.php');



$survey = new Survey();

function fullType($input){
	switch($input){
		case 'yn':
		 	$type = 'Yes or No';
			break;
		case 'option':
			$type = "Multiple Choice";
			break;
		case 'expanded_option':
			$type = 'Multiple Choice (expanded)';
			break;
		case 'slider':
			$type = 'Slider';
			break;
		case 'text':
			$type = 'Text Box';
			break;
		case 'paragraph':
			$type = 'Paragraph';
			break;
		default:
			$type='unknown question type';
	}
	return $type;
}
?>


		
		
		
		

		

		<!-- Small modal -->
		<div class="containter-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-10">
					<div class="well"><h4><?php echo $row['suv_name'];?> &nbsp; <span class="pull-right"><a href="../view_survey.php?cid=<?php echo $cid ?> &sid=<?php echo $sid?>" target="_blank">View Survey</a></span></h4> <hr>
                    </div>
<div class="table-responsive">
     <table cellpadding="10" cellspacing="0" border="0" class="table  table-hover table-responsive" id="example">

                <thead>
                    <tr>
                        <th> </th>
                        
                        
                        
                    </tr>
                </thead>
                <tbody>
					<?php
					$question_query = mysqli_query($con, "SELECT * FROM questions WHERE course = '".$cid."' AND survey_id = '".$sid."' ORDER BY pos ASC");
					while($row = mysqli_fetch_array($question_query)){?>
                    <tr >
               <td>
						<div class="col-xs-12 col-md-12 ">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  	<div class="panel panel-default">
							    	<div class="panel-heading" role="tab" id="headingOne">
							      		<h5 class="panel-title">
                                        
							        		<a class="collapsed" data-toggle="collapse"   data-parent="#accordion" href='<?php echo "#collapse{$row['id']}"; ?>' aria-expanded="false" aria-controls=<?php echo "collapse{$row['id']}"; ?>>
							          			<span class="glyphicon glyphicon-chevron-down" aria-hidden="false">&nbsp;&nbsp; <?php $type = fullType($row['type']); echo "{$row['question']} <hr><small><i>{$type}</i></small>"; ?></span>
							        			
							        		</a> <span class="divider-vertical"> </span>

							        		<a><span class="glyphicon glyphicon-remove remove" style="float:right;" id='<?php echo "{$row['id']}"; ?>'></span></a>
							        		
							        		<span class="level" style="float:right">Rank</span>
							      		</h5>
							    	</div>
									
									<?php
									//Calculate % for each question
									
									$results=mysqli_query($con, "SELECT * FROM results WHERE question_id='".$row['id']."' ORDER BY id DESC");
									
									$result_array = array();
									$count=0;
									while($result = mysqli_fetch_array($results)){
										$response = $result['response'];
										//echo $response;
										
										if (!array_key_exists(strtoupper($response), $result_array)) {
											$result_array[strtoupper($response)] = 1;
										}else{
											$result_array[strtoupper($response)] = $result_array[strtoupper($response)]+1;
										}
										//echo " | ";
										$count++;
									}
									//print_r($result_array);
									?>
							    	<div id=<?php echo "collapse{$row['id']}"; ?> class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							    		<?php 
							    		if($count==0){
							    			echo "<div class='panel-body'><h4 class='text-danger'>No Responses Recorded</h4></div>";
							    		} 

							    		$hideCount = 0;

							    		foreach($result_array as $response=>$number){?>
								    		<?php 
								      			if($hideCount == 5){
								      				echo "<div class='panel-body showMore'><span class='glyphicon glyphicon-chevron-down'></span></div>";
								      			}
								      		?>
								      		<div class="panel-body" <?php if($hideCount >= 5){ echo 'style="display:none"';} ?> >
								      			<h5>
								      				<?php 
								      					echo stripslashes($response);
								      					$hideCount++; 
								      				?>
								      			</h5>
								      			<?php if ($row['type'] != 'paragraph' and $row['type'] != 'text'){?>
								      				
								        		<div class="progress">
					  								<div class="progress-bar progress-bar-<?php if(strtolower($response) == "no"){echo "danger";}else{echo "success";}?> progress-bar-striped" role="progressbar" aria-valuenow='<?php echo ($number/$count)*100 ."%" ?>' aria-valuemin="0" aria-valuemax="100" style='width: <?php echo ($number/$count)*100 ."%" ?>'>
					    								<?php echo round(($number/$count)*100) ."%  ({$number} response)" ?>
					  								</div>
												</div>
												<?php }?>
											</div>
										<?php } ?>
										<div class='panel-body showLess' style="display:none"><span class='glyphicon glyphicon-chevron-up'></span></div>
							    	</div>
							    	
							  	</div>
							</div>
						</div></td> </tr>
					<?php } ?></tbody></table>
						<div class="col-xs-12 col-md-12">
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  	<div class="panel panel-default">
							    	
							    	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
							      		<div class="panel-body">
							      			<span class="add-new" id="add_question_plus" style="width:55px;height:55px;"></span>
							      			<div id="new_question">
							      				<h3>Create Question</h3>
							      				<form>
                                                <input type="hidden" name="course"  value="<?php echo $cid ?>" />
                                                <input type="hidden" name="survey"  value="<?php echo $sid ?>" />
								      				<div class="form-group">
										      			<input type="text" name="name" id="name" class="form-control" placeholder="Question Name" />
									      			</div>

									      			<div class="form-group">
										      			<input type="text" name="description" id="description" class="form-control" placeholder="Question Description" />
									      			</div>

									      			<div class="form-group">
										      			<select class="form-control" name="type">
										      				<option disabled selected="selected">Question Type</option>
										      				<option id="yn" class="nochoice">Yes or No</option>
										      				<option class='nochoice'>Text Box</option>
										      				<option class='nochoice'>Paragraph</option>
										      				<option class='choices'>Multiple Choice</option>
										      				<option class='choices'>Multiple Choice (expanded)</option>
										      				<option class="slider">Slider</option>
										      			</select>
										      		</div>
										      		<hr>
										      		<div id="allChoices">
											      		<div id="choices">
											      			<h4>Choices</h4>
												      		<div class="form-group">
												      			<input type="text" name="choices[]" class="form-control" placeholder='Enter a Choice' />
											      			</div>
											      			<div id='new_choice'> <span class='add-new'></span> Add New Choice</div>
											      		</div>

											      		<div id="sliderChoices">
											      			<h4>Slider Values</h4>
											      			<div class="form-group">
												      			<input type="number" name="choices[]" class="form-control" placeholder='Min Value' />
												      			<input type="number" name="choices[]" class="form-control" placeholder='Max Value' />
											      			</div>
											      		</div>
										      		</div>
									      			<button type="button" class="btn btn-primary" id="new_submit">Add Question</button>
									      		</form>
								      		</div>
										</div>
							    	</div>
							  	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<script>
		//
		//Make the questions uncollapsed when the page is loaded.
		//
		$(document).ready(function(){
			$(".collapse").collapse("show");
			$(".collapse").click(function(){
				$(this).collapse('toggle');
			});

			$('.remove').click(function(){
				if(confirm("Are you sure you want to delete this question? All responses will be deleted as well!")){
					$(this).parent().parent().parent().slideUp();
					$.post('remove_question.php', {id:$(this).attr('id')}, function(data){

					});
				}
			});
			$("#add_question_plus").click(function(){
				$('#new_question').slideToggle();
			});

			$('#new_choice').click(function(){
				$('#choices').append('<div class="form-group"> <input type="text" name="choices[]" class="form-control" placeholder="Enter a Choice" /> </div>');
			});

			$('#new_submit').click(function(){
				$.post('create_question.php', $('form').serialize(), function(data){
					// alert(data);
					location.reload();
				});
				
			});

			$('.showMore').click(function(){
				//alert('success');
				$(this).siblings().slideDown();
				$(this).hide();
				$(this).siblings('.showLess').show();
			});

			$('.showLess').click(function(){
				//$(this).siblings().slideUp();
				$(this).siblings('.showMore').show();
				$(this).siblings().slice(6,$(this).siblings().length).slideUp();
				$(this).hide();
			});
		});
		</script>
        </div>
    </div>
<?php include('footer.php') ?>