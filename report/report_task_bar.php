<?php
require '../configs/config.php';

	if(isset($_SESSION['user_name'])){
		$error_array = array();

		$username = $_SESSION['user_name'];
		$_SESSION['user_name']= $username;
		
		$sis_report = "";
		if(isset($_POST['i_report'])){
			//$_SESSION['user_name']= $username;
			$set_type =$_POST['set_type'];

			if($set_type =="Select"){
				array_push($error_array, "Kindly Select the appropriate <br>");
			}

			if($set_type =="List of Student"){
				$_SESSION['user_name']= $username;
				//echo "<br>".$username." this is it<br>";
				header("Location: student_list.php");
			}
			if($set_type =="Report card"){
				$_SESSION['user_name']= $username;
				header("Location: report_card.php");
			}
			if($set_type =="School Fees"){
				$_SESSION['user_name']= $username;
				header("Location: sch_fees_report.php");
			}
			if($set_type =="Report Task Bar"){
				$_SESSION['user_name']= $username;
				header("Location: staff_list.php");
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
	
		<form action="report_task_bar.php" method="POST">
			<div class="my_form" style="position:relative; top: 47px;">
			<?php
				if(in_array("Kindly Select the appropriate <br>", $error_array))
					echo "Kindly Select the Appropriate to be Generated<br>";
			?>
			<select name ="set_type" style="width: 110px; height: 35px; top: 100px;">
    			<option>Select</option>
				<option>List of Student</option>
				<option>Report card</option>
				<option>School Fees</option>
				<option>Report Task Bar</option>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="i_report" value="Enter">

			</div>
			
		</form>
	</dv>

      </div>
      <a href="/secdbms/events/profile.php">Back</a>
       

  </div>
</div >
</body>
</html>