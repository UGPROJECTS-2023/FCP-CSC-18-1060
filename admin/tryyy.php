<?php include('header1.php'); ?>
<?php include('dbcon.php'); ?>
<!-- -->
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container"  >
            
            </div>
    </div>
</div>

<!-- -->

<div class="container">
    
        <div class="row">
								<div class="span2">
						
						</div>

            <div class="span9" >
               
	
    <div class="well" >
      <h4><?php echo $survey->name; ?></h4>
    	<?php
		if (reset($_POST)) { //If first element in array is true
			
			//Insert Feedback to database
      // foreach($_POST as $var => $val)
      // {
      //    $_POST[$var] = mysqli_real_escape_string($con, $val);
      // }
      $_POST = Survey::escapeInput($_POST);

			$rand = substr(md5(rand()), 0, 10);

      //Prepared statement for DB
      $stmt = mysqli_prepare($con, "INSERT INTO results (question_id,response,session_token) VALUES (?,?,'$rand')");
			foreach($_POST as $key=>$response){
				$bind = mysqli_stmt_bind_param($stmt, "is", $key, $response);
        mysqli_stmt_execute($stmt);
			}
      mysqli_stmt_close($stmt);

			// //Send email with feedback to admin
			$emailMessage="<h3>Survey Submitted</h3>";
      $result = mysqli_query($con, "SELECT * FROM questions ORDER BY pos ASC");
      while($row = mysqli_fetch_array($result)){
        $num = $row['id'];
        $emailMessage.="<b>{$row['question']}</b><p>" .stripslashes($_POST[$num]) ."</p>";
      }
			$emailMessage.="<hr>";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: no-reply <{$survey->email}>";
			mail($survey->email, $survey->name.' Submission', $emailMessage, $headers);
			// //Log the feedback received

			mysqli_close($con);
			
			echo '<div class="success bg-success" style="height:50px; padding-top:10px; padding-left:30px; font-size:16px">Thank you for your feedback. It is greatly appriciated!</div>';
		  
    }$x = 0;
		?>
    </div>
    <script>
					jQuery(document).ready(function(){	
						jQuery(".questions").each(function(){
							jQuery(this).hide();
						});
						jQuery("#q_1").show();
					});
					</script>
										<script>
										jQuery(document).ready(function(){
										var nq = 0;
										var qn = 0;
											jQuery(".nextq").click(function(){
												qn = jQuery(this).attr('qn');
												nq = parseInt(qn) + 1;
												jQuery('#q_' + qn ).fadeOut();
												jQuery('#q_' + nq ).show();		
											});
										});
										</script>
    <table class="questions-table table">
<tr>
<th>#</th>
<th>Question</th>
</tr>
    <form method="post" action="">

<?php 
             

              $result = mysqli_query($con, "SELECT * FROM questions ORDER BY pos ASC");
			  $qt = mysqli_num_rows($result);
              while($row = mysqli_fetch_array($result)){
                $choices = json_decode($row['choices']);
                
			?> <tr id="q_<?php echo $x=$x+1;?>" class="questions">
				<td width="30" id="qa"><?php echo $x;?></td>
<td id="qa"><?php
				//print_r($choices);
                switch($row['type']){
                  case 'text':
                    echo "<div class='form-group col-sm-12'>

                              <label for='{$row[id]}'><h4>{$row[question]}<small> {$row[description]}</small></h4></label>

                              <input type='text' class='form-control' name='{$row[id]}' required placeholder='Enter response' />

                          </div>";
                          break;
                  case 'paragraph':
                    echo "<div class='form-group col-sm-12'>

                              <label for='{$row[id]}'><h4>{$row[question]}<small> {$row[description]}</small></h4></label>

                              <textarea class='form-control' rows='5' maxlength='5000' name='{$row[id]}' required></textarea>

                          </div>";
                          break;
                  case 'yn':
                    echo "<div class='col-sm-12'>

                        <h4>{$row['question']}<small> {$row['description']}</small></h4><br>

                        <div class='btn-group' data-toggle='buttons'>

                          <label class='btn btn-primary btn-lg'>

                            <input type='radio' name='{$row['id']}' id='option2' autocomplete='off' value='Yes'> Yes

                          </label>

                          <label class='btn btn-primary btn-lg'>

                            <input type='radio' name='{$row['id']}' id='option3' autocomplete='off' value='No'> No

                          </label>

                        </div>

                     </div>";
                     break;
                  case 'option':
                  case 'expanded_option':
                    echo "<div class='form-group col-sm-12' style='margin-top:13px'>

                         <label for='{$row['id']}'><h4>{$row['question']}<small> {$row['description']}</small></h4></label>

                        <select name='{$row['id']}' "; if($row['type']=='expanded_option'){echo "multiple";} echo" class='form-control'>";

                          foreach($choices as $choice){
                            echo "<option>{$choice}</option>";
                          }

                        echo "</select>

                    </div>";
                    break;
                  case 'response':
                    echo "<div class='form-group col-sm-12'>

                        <label for='{$row[id]}'><h4>{$row[question]}<small> {$row[description]}</small></h4></label>

                        <textarea rows='5' class='form-control' name='{$row[id]}'></textarea>

                    </div>";
                    break;
                  case 'slider':
                    echo "<script>
                      $(document).ready(function(){
                      $('#{$row[id]}slider')
                          .slider({
                              min: {$choices[0]},
                              max: {$choices[1]},
                              change: function(event, ui) {
                                $('#{$row[id]}').attr('value', ui.value);
                              }
                          })
                          .slider('pips', {
                              rest: 'label'
                          })
                      });
                      </script>";
                    echo "<div class='form-group col-sm-12'><label><h4>{$row[question]} <small>{$row[description]}</small></h4></label><div id='{$row[id]}slider'></div></div>";
                    echo "<input type='hidden' name='{$row[id]}' id='{$row[id]}'/>";
                    break;
                  default:
                    echo "<h5>unknown question type</h5>";
                } ?>
				<button onClick="return false;" qn="<?php echo $x;?>" class="nextq btn btn-success" id="next_<?php echo $x;?>">NEXT QUESTION <i class="icon-arrow-right"></i> </button>
<input type="hidden" name="x-<?php echo $x;?>" value="<?php echo $row['id'];?>">
</td>
</tr>
             <?php }
            ?>
	<br/>

   <tr>
<td></td>
<td>
<button class="btn btn-info" id="submit-test" name="submit_answer"><i class="icon-check"></i> Submit Answer</button>
<!-- <input type="submit" value="Submit My Answers"  class="btn btn-info" id="submit-test" name="submit_answer"><br /> -->
</td>
</tr>
</table>
<input type="hidden" name="x" value="<?php echo $x;?>">
</form>
</div>
               </div>
            </div>
           </div>
            <div class="clearfix"></div>
           </div>
    </div>
</div>
<?php include('footer.php') ?>