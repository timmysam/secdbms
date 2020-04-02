<?php
require '../configs/config.php';
	if(isset($_SESSION['user_name'])){

		$username = $_SESSION['user_name'];
		$_SESSION['user_name']= $username;
		if(isset($_POST['bagus'])){
			$sis_report = $_POST['sis_report']{
				echo "string";
			}
		}

}
else{
	header("Location:../index.php");
}

?>
<html>
<head>
	<title>Stud Scores</title>
	<link rel="stylesheet" type="text/css" href="../css/stud_scores.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../scripts/register.js"></script> 
</head>
<body>
	<div class="wrapper">
	  <div class = "login_box">
	    <div class ="login_header">
	          <h1> SaMizpah's DBMS 4 Schools</h1>
	          <h4>Generate Report</h4>
	    </div>
	    <div id="first">
	
		<form action="report_bar.php" method="POST">
			<?php

				if(in_array("Kindly select the right option<br>", $error_array))
					echo "Kindly select the right option<br>";

			?>
			<div class="my_form" style="position:relative; top: 47px;">
				<select name="sis_report" style="width: 110px;
	    			height: 35px; top: 100px;">
	    			<option>Select</option>
					<option>List of Student</option>
					<option>Report card</option>
					<option>School Fees</option>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="bagus" value="Enter">

			</div>
			
			

		</form>
	</dv>
      </div>
  </div>
</div >
</body>
</html>