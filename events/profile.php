<?php
require '../configs/config.php';
if(isset($_SESSION['user_name'])) {
	$username = $_SESSION['user_name'];
	if(isset($_SESSION['user_name'])){

		$username = $_SESSION['user_name'];
		$_SESSION['user_name']= $username;

		if (isset($_POST['n_student'])){
			
			$_SESSION['user_name'] = $username;
			header("Location: ../stud_records/stud_registration.php");
		}
		if(isset($_POST['n_scores'])){
			$_SESSION['user_name'] = $username;
			header("Location: ../stud_records/stud_scores.php");
		}

		if(isset($_POST['Stud_reg'])){
			$_SESSION['user_name'] = $username;
			header("Location: ../report/report_task_bar.php");
		}
		if(isset($_POST['sub_update'])){
			$_SESSION['user_name'] = $username;
			header("Location: ../stud_records/admin_one.php");

		}
		if(isset($_POST['d_scores'])){
			$_SESSION['user_name'] = $username;
			header("Location: position.php");

		}
	}

	else{
		header("Location: ../index.php");
		$_SESSION['user_name'] ="../index.php";
	}

}
else{
	header("Location:../index.php");
}

?>

<html>
<head>
	<title>Task Bar</title>
	<link rel="stylesheet" type="text/css" href="../css/profile.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="../scripts/register.js"></script> 
</head>
<body>
	<div class="wrapper">
	  <div class = "login_box">
	    <div class ="login_header">
	          <h1> SaMizpah's DBMS 4 Schools</h1>
	          <h4>Staff Task Bar!</h4>
	    </div>
	    <div id="first">
	
		<form action="profile.php" method="POST">
			<div class="option">
				<a href="../stud_records/stud_registration.php" class="acc" style=" width: 20em;  height: 2em;">
					<input type="submit" name="n_student" class="acc" value ="Reg.Stud"
					style="position:relative; left: -16%;" >
					
				</a>
				<a href="../stud_records/stud_scores.php">
					<input type="submit" name="n_scores" class="acc" value ="Reg.Scores"
					style="position:relative; left: 15%;" >

				</a>
			</div>
			<div class="option">
				<a href="../moreinfor/house_mates.php">
					<input type="submit" name="sub_update" class="acc" value ="Update"
					style="position:relative; top: -12px; left: 2%;" >
				</a>
			</div>
			<div class="option2">
				<a href="../moreinfor/house_mates.php">
					<input type="submit" name="Stud_reg" value ="Report"
					style="position:relative; left: -16%;"> 
				</a>
				<input type="submit" name="d_scores" class="acc" value ="Cal.Position"
					style="position:relative; left: 15%;" >
				</a>
			</div>
			<div class="option">
				<a href="../login.php" style="position:relative; top: 7px; left: -44%;">
					Back
				</a>
			</div>
			

		</form>
	</dv>
      </div>
  </div>
</div >
</body>
</html>