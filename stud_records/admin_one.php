<?php
require '../configs/config.php';
if(isset($_SESSION['user_name'])){
	$username = $_SESSION['user_name'];
	

	if(isset($_POST['n_test'])){
		$_SESSION['user_name'] = $username;
		header("Location: ../events/stud_pins.php");
	}
	if(isset($_POST['n_exam'])){
		$_SESSION['user_name'] = $username;
		header("Location: ../events/super_admin1.php");
		
	}
	if(isset($_POST['set_term'])){
		$_SESSION['user_name'] = $username;
		header("Location: ../report/set_term.php");
		
	}


}
else{
		header("Location: ../index.php");
		$_SESSION['user_name'] ="../index.php";
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
	          <h4>Admin Task Bar!</h4>
	    </div>
	    <div id="first">
	
		<form action="admin_one.php" method="POST">
			<div class="option">
				<a href="../stud_records/stud_registration.php" class="acc" style=" width: 20em;  height: 2em;">
					<input type="submit" name="n_test" class="acc" value ="Set_Pins"
					style="position:relative; left: -21%;" >
					
				</a>
				<a href="stud_scores.php">
					<input type="submit" name="n_exam" class="acc" value ="Set_Admin"
					style="position:relative; left: 19.7%;" >

				</a>
				<div class="option">
				<a href="../moreinfor/house_mates.php">
					<input type="submit" name="set_term" class="acc" value ="Set_Term"
					style="position:relative; top: -12px; left: -1%;" >
				</a>
			</div>
				<div class="option">
				<a href="../events/profile.php" style="position:relative; top: -20px; left: -44%;">
					Back
				</a>
			</div>
			</div>

		</form>
	</dv>
      </div>
  </div>
</div >
</body>
</html>