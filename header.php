<!DOCTYPE html>
<html>
<head>
	 <title>SCE System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        
<!-- Needed for slider -->
<script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
<script src="bootstrap/slider/jquery-ui.min.js"></script>
<link href="bootstrap/slider/jquery-ui.min.css" rel="stylesheet" type="text/css">
<script src="bootstrap/slider/jquery-ui-slider-pips.js"></script>
<link href="bootstrap/slider/jquery-ui-slider-pips.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="http://bootswatch.com/yeti/bootstrap.min.css">
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

<style type="text/css">
/*#submit {
	border: 0;
	background-color: rgba(237,89,35,1.00);
	color: #FFFFFF;
	font-weight: bold;
	width: 100px;
	height: 40px;
	margin-bottom: 20px;
}*/
label {
	margin-top: 10px;
}
.container p {
	margin-top: 20px;
}
</style>

	<!-- Bootstrap -->
			<link href="css/bootstrap.css" rel="stylesheet" media="screen">
			<link href="css/bootstrap-responsive.css" rel="stylesheet" media="screen">
			<link href="css/docs.css" rel="stylesheet" media="screen">
			<link href="css/diapo.css" rel="stylesheet" media="screen">
			<link href="css/font-awesome.css" rel="stylesheet" media="screen">
	<!-- js -->			
   
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.hoverdir.js"></script>
	<script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
			<script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>
			
		<?php// session_start(); ?>	
			        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<noscript>
			<style>
				.da-thumbs li a div {
					top: 0px;
					left: -100%;
					-webkit-transition: all 0.3s ease;
					-moz-transition: all 0.3s ease-in-out;
					-o-transition: all 0.3s ease-in-out;
					-ms-transition: all 0.3s ease-in-out;
					transition: all 0.3s ease-in-out;
				}
				.da-thumbs li a:hover div{
					left: 0px;
				}
			</style>
		</noscript>
         <!--slider -->
    <link rel="stylesheet" href="themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" /> 

    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            $(window).load(function() {
                $('#slider').nivoSlider();
            });
        });
    </script>
    <!--end slider -->
		
		<!--sa calendar-->	
		<script type="text/javascript" src="js/datepicker.js"></script>
        <link href="css/datepicker.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript">
		//<![CDATA[

		/*
				A "Reservation Date" example using two datePickers
				--------------------------------------------------

				* Functionality

				1. When the page loads:
						- We clear the value of the two inputs (to clear any values cached by the browser)
						- We set an "onchange" event handler on the startDate input to call the setReservationDates function
				2. When a start date is selected
						- We set the low range of the endDate datePicker to be the start date the user has just selected
						- If the endDate input already has a date stipulated and the date falls before the new start date then we clear the input's value

				* Caveats (aren't there always)

				- This demo has been written for dates that have NOT been split across three inputs

		*/

		function makeTwoChars(inp) {
				return String(inp).length < 2 ? "0" + inp : inp;
		}

		function initialiseInputs() {
				// Clear any old values from the inputs (that might be cached by the browser after a page reload)
				document.getElementById("sd").value = "";
				document.getElementById("ed").value = "";

				// Add the onchange event handler to the start date input
				datePickerController.addEvent(document.getElementById("sd"), "change", setReservationDates);
		}

		var initAttempts = 0;

		function setReservationDates(e) {
				// Internet Explorer will not have created the datePickers yet so we poll the datePickerController Object using a setTimeout
				// until they become available (a maximum of ten times in case something has gone horribly wrong)

				try {
						var sd = datePickerController.getDatePicker("sd");
						var ed = datePickerController.getDatePicker("ed");
				} catch (err) {
						if(initAttempts++ < 10) setTimeout("setReservationDates()", 50);
						return;
				}

				// Check the value of the input is a date of the correct format
				var dt = datePickerController.dateFormat(this.value, sd.format.charAt(0) == "m");

				// If the input's value cannot be parsed as a valid date then return
				if(dt == 0) return;

				// At this stage we have a valid YYYYMMDD date

				// Grab the value set within the endDate input and parse it using the dateFormat method
				// N.B: The second parameter to the dateFormat function, if TRUE, tells the function to favour the m-d-y date format
				var edv = datePickerController.dateFormat(document.getElementById("ed").value, ed.format.charAt(0) == "m");

				// Set the low range of the second datePicker to be the date parsed from the first
				ed.setRangeLow( dt );
				
				// If theres a value already present within the end date input and it's smaller than the start date
				// then clear the end date value
				if(edv < dt) {
						document.getElementById("ed").value = "";
				}
		}

		function removeInputEvents() {
				// Remove the onchange event handler set within the function initialiseInputs
				datePickerController.removeEvent(document.getElementById("sd"), "change", setReservationDates);
		}

		datePickerController.addEvent(window, 'load', initialiseInputs);
		datePickerController.addEvent(window, 'unload', removeInputEvents);

		//]]>
		</script>
</head>
<body>