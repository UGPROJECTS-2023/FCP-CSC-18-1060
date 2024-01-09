<?php include('header.php'); ?>
<?php //include('dbcon.php'); 
  $con = mysqli_connect("localhost","root","","sce_system") or die("conection was not created");
  
$cid =$_GET['cid']; 
$sid = $_GET['sid'];
$uid = $_GET['uid']; 

$course_query = mysqli_query($con, "select * from courses WHERE course_id = '".$cid."'")or die(mysqli_error($con));
 $rowc = mysqli_fetch_array($course_query) ?>
<?php
require('Survey.php');
$survey = new Survey();
?>
<!-- -->
<div class="navbar navbar-fixed-top navbar-inverse">
    <div class="navbar-inner">
        <div class="container"  >
            
            </div>
    </div>
</div>

<!-- -->

<div class="container">
    <div class="margin-top"> 
        <div class="row" >
                <div class="span2">
            
            </div>

            <div class="span8" >
              
  <div class="row">
    <div class="well">
      <h4 class=" text-info text-center"><i class=" icon-book icon-large"></i>&nbsp;<?php echo $rowc['course_code']; ?>&nbsp;:&nbsp;<?php echo $rowc['course_name']; ?> Survey</h4> </div>
      <?php
    if (reset($_POST)) { //If first element in array is true
      
      //Insert Feedback to database
      // foreach($_POST as $var => $val)
      // {
      //    $_POST[$var] = mysqli_real_escape_string($con, $val);
      // }
      $_POST = Survey::escapeInput($_POST);

      $rand = $uid;
      $surveyId = $sid;

      //Prepared statement for DB
      $stmt = mysqli_prepare($con, "INSERT INTO results (question_id,response,session_token,surveyId) VALUES (?,?,'$rand','$surveyId')");
      foreach($_POST as $key=>$response){
        $bind = mysqli_stmt_bind_param($stmt, "is", $key, $response);
        mysqli_stmt_execute($stmt);
      }
      mysqli_stmt_close($stmt);

      

      mysqli_close($con);
      

             echo "<script>window.open('success.php')</script>";
     // header('Location: success.php');
      
    }
    ?>
    </div>
    
     <form method="post" action="">
     <div class="table-responsive">
     <table cellpadding="10" cellspacing="0" border="0" class="table table-striped table-hover table-responsive" id="example">

                <thead>
                    <tr>
                        <th> &nbsp; # &nbsp;</th>
                        <th>QUESTION</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
   

<?php 
  $con = mysqli_connect("localhost","root","","sce_system") or die("conection was not created");
              //Connect to DB and get questions
             $x = 0;
              $result = mysqli_query($con, "SELECT * FROM questions WHERE course = '".$cid."' AND survey_id = '".$sid."' ORDER BY pos ASC");
              while($row = mysqli_fetch_array($result)){
                $choices = json_decode($row['choices']);
        $id = $row['id'];
                //print_r($choices);
        ?>
                <tr class="del<?php echo $id ?>">
                <td><?php echo $x+=1 ?> </td> <td>
                 <?php
                switch($row['type']){
                  case 'text':
                    echo "<div class='form-group col-sm-12'>

                              <label for='{$row['id']}'><h5>{$row['question']} <hr> <small>Description: {$row['description']}</small></h5></label>

                              <input type='text' class='form-control' name='{$row['id']}' required placeholder='Enter response' />

                          </div>";
                          break;
                  case 'paragraph':
                    echo "<div class='form-group col-sm-12'>

                              <label for='{$row['id']}'><h5>{$row['question']}<br> <small>Description: {$row['description']}</small></h5></label>

                              <textarea class='form-control' rows='5' maxlength='5000' name='{$row['id']}' required></textarea>

                          </div>";
                          break;
                  case 'yn':
                    echo "<div class='col-sm-12'>

                        <h5>{$row['question']}<br> <small>Description: {$row['description']}</small></h5><br>

                        <div class='btn-group' data-toggle='buttons'>

                          <label class='btn  btn-lg'>

                            <input type='radio' name='{$row['id']}' id='option2' selected= autocomplete='off' value='Yes'> Yes

                          </label>

                          <label class='btn btn-danger btn-lg'>

                            <input type='radio' name='{$row['id']}' id='option3' autocomplete='off' value='No'> No

                          </label>

                        </div>

                     </div>";
                     break;
                  case 'option':
                  case 'expanded_option':
                    echo "<div class='form-group col-sm-12' style='margin-top:13px'>

                         <label for='{$row['id']}'><h5>{$row['question']}<br> <small>Description: {$row['description']}</small></h5></label>
              <br>

                        <select name='{$row['id']}' "; if($row['type']=='expanded_option'){echo "multiple";} echo" class='form-control'>";

                          foreach($choices as $choice){
                            echo "<option>{$choice}</option>";
                          }

                        echo "</select>

                    </div>";
                    break;
                  case 'response':
                    echo "<div class='form-group col-sm-12'>

                        <label for='{$row['id']}'><h5>{$row['question']}<br> <small>Description: {$row['description']}</small></h5></label>

                        <textarea rows='5' class='form-control' name='{$row['id']}'></textarea>

                    </div>";
                    break;
                  case 'slider':
                    echo "<script>
                      $(document).ready(function(){
                      $('#{$row['id']}slider')
                          .slider({
                              min: {$choices[0]},
                              max: {$choices[1]},
                              change: function(event, ui) {
                                $('#{$row['id']}').attr('value', ui.value);
                              }
                          })
                          .slider('pips', {
                              rest: 'label'
                          })
                      });
                      </script>";
                    echo "<div class='form-group col-sm-12'><label><h5>{$row['question']} <br> <small>Description:{$row['description']}</small></h5></label><div id='{$row['id']}slider'></div></div>";
                    echo "<input type='hidden' name='{$row['id']}' id='{$row['id']}'/>";
                    break;
                  default:
                    echo "<h5>unknown question type</h5>";?>
                </td></tr> <?php }
              }
            ?>
           
     
    
    </tbody>
            </table>
            </div>
            <button type="submit" id="submit" class='btn btn-success btn-block btn-large'>Submit Survey</button>
    </form>
    
</div>
               </div>
            </div>
           
            <div class="clearfix"></div>
           </div>
    </div>
</div>
<?php include('footer.php') ?>