<?php
require '../configs/config.php';

	if(isset($_SESSION['user_name'])){
	$username = $_SESSION['user_name'];
		$error_array = array();

		

		$term ="";
		$section ="";
		$sis_report = "";

			if(isset($_POST['ch_report'])){
				$term = $_POST['term'];
				$section =$_POST['section'];
				$date = date('Y-M-D h:i:s');

				if($term == 'Term'){
					array_push($error_array, "Kindly Input the accurate Term<br>");
				}
				if($section == 'Section'){
					array_push($error_array, "Kindly Input the accurate Section<br>");
				}
				$username = $_SESSION['user_name'];

				if(empty($error_array)){
					//echo $username;
					$set_query = mysqli_query($con,"UPDATE term_section SET term='$term', section='$section',
						updated_by='$username', date='$date'");
					array_push($error_array, "PERFECTLY DONE<br>");

				}
			}
			
			
		
}
else{
	header("Location:..index.php");
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
	
		<form action="set_term.php" method="POST">
			<div class="my_form" style="position:relative; top: 47px;">
				<?php
					if(in_array("Kindly Input the accurate Term<br>", $error_array))
						echo "Kindly Input the accurate Term<br>";
					elseif (in_array("Kindly Input the accurate Section<br>", $error_array))
						echo "Kindly Input the accurate Section<br>";
						elseif (in_array("PERFECTLY DONE<br>", $error_array))
						echo "PERFECTLY DONE<br>";

				?>
					<select name="term">
							<option>Term</option>
							<option>First term</option>
							<option>Second term</option>
							<option>Third term</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="section">
							<option>Section</option>
							<option>2019/2020</option>
							<option>2020/2021</option>
							<option>2021/2022</option>
							<option>2022/2023</option>
							<option>2023/2024</option>
							<option>2024/2025</option>
						</select>
					<Br>
					<br>
			<input type="submit" name="ch_report" value="Enter">
			

			</div>
			
		</form>
	</dv>

      </div>
      <a href="report_task_bar.php">Home</a>
  </div>
</div >
</body>
</html>