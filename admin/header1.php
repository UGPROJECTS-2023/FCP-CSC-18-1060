<!DOCTYPE html>
<html>
    <head>
        <title>SCE System</title>
       <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">


		<script src="../includes/jquery.min.js"></script>
		<script src="../bootstrap/js/bootstrap.min.js"></script>
		
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="http://bootswatch.com/yeti/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://bootswatch.com/sandstone/bootstrap.min.css"> -->
		<style>
		/* Bellow is the styling for the title of the page. This is not required...*/
		.title{
			font-weight: bolder;
			font-size: 500%;
			margin-bottom: 30px;
		}
		.containter-fluid{
			margin-top:20px;
		}
		h4 a{
			text-decoration: none;
			font-size:15px;
		}
		span {
			font-size: 18px;
			word-spacing: -12;
			text-transform: none;
		}
		/*Prevents the horizontal scroll bar (this is a bootstrap bug)*/
		html, body {
			overflow-x: hidden;
		}
		#new_question{
			display:none;
		}
		.questionOption{
			margin-bottom:10px;
		}
		.showMore, .showLess{
			cursor: pointer;
		}
		#new_choice{
			cursor: pointer;
		}
		</style>

		<!-- Styles for "NEW" button -->
	    <script src="../new_button/js/prefixfree.min.js"></script>
	    <script src="../new_button/js/modernizr.js"></script>
		<link type="text/css" rel="stylesheet" href="../new_button/css/normalize.css" />
		<link type="text/css" rel="stylesheet" href="../new_button/css/style.css" />

<script>
$(document).ready(function(){
			var choices = $("#choices");
			var sliderChoices = $("#sliderChoices");

			$('#new_choice').click(function(){
				$(this).before('<div class="form-group"> <input type="text" name="choices[]" class="form-control" placeholder="Enter a Choice" /> </div>');
			});

			$("#choices").detach();
			$("#sliderChoices").detach();

		$( "select" )
		  .change(function () {
		    var str = "";
		    if ($("select option:selected").hasClass('nochoice')){
		    	$("#choices").detach();
		    	$("#sliderChoices").detach();
		    }else if ($("select option:selected").hasClass('slider')){
		    	$("#allChoices").append(sliderChoices);
		    	$("#choices").detach();
		    }else if ($("select option:selected").hasClass('choices')){
		    	$("#sliderChoices").detach();
		    	$("#allChoices").append(choices);
		    }
		  })
		  .change();
		});
</script>

  <script>
  $(document).ready(function() {
    $( ".panel" ).each(function( index ) {
	  $(this).find('.level').html(index+1);
	});

	$('.edit').click(function(){
		var editId = this.id;
		$.post('load_question.php', {"questionId": editId}, function(data){
			$('#options').empty();
			// alert(data);
			data = JSON.parse(data);
			// alert(data.options);
			data.options = JSON.parse(data.options);
			// alert(typeof(data.options));
			// alert(data);
			$('#questionName').val(data.name);
			$('#questionDescription').val(data.description);
			$('#myModalLabel').text(data.name);
			$('#questionPos').val(data.pos);
			$('#editQuestionId').val(data.id);
			for (var i = 0; i < data.options.length; i++) {
				$('#options').append('<input type="text" class="form-control questionOption" name="questionOption[]" value="' + data.options[i] +'">');
			}
			// $.each(data.options, function( i, l ){
			//   $('#options').append('<input type="text" class="form-control" id="questionOption" name="questionOption[]" value="' + l +'">');
			// });
			// location.reload();
		});
		var updateQuestion = true;
		$('#editQuestion').modal();
	});

	$('#saveEdit').click(function(){
		$.post('save_question.php', $('#editQuestionForm').serialize(), function(data){
			//alert(data);
			location.reload();
		});
	});
  });
</script>
	
        <!-- Bootstrap -->
        <link href="../css/bootstrap.css" rel="stylesheet" media="screen">
        <link href="../css/bootstrap-responsive.css" rel="stylesheet" media="screen">
        <link href="../css/docs.css" rel="stylesheet" media="screen">
        <link href="../css/font-awesome.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" type="text/css" href="../css/DT_bootstrap.css">
        <!-- js -->			
       
   <script src="js/jquery.hoverdir.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="../js/jquery.dataTables.js"></script>
			<script type="text/javascript" charset="utf-8" language="javascript" src="../js/DT_bootstrap.js"></script>
			    		
        


    </head>
    <?php include('dbcon.php'); ?>
    <body>