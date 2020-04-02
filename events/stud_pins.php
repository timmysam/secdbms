<?php
	require '../configs/config.php';
	if(isset($_SESSION['user_name'])) {
	$username = $_SESSION['user_name'];
	$error_array = array();
		$stud_pin1 = "";
		$stud_pin2 = "";
		$sub_pin_tab = "";
		$user_name = "";
		$date = "";

		if(isset($_POST['sub_pin_tab'])){
			
			$stud_pin1=$_POST['stud_pin1'];
			$_SESSION['stud_pin1'] = $stud_pin1;

			$stud_pin2 = $_POST['stud_pin2'];
			$_SESSION['stud_pin2'] = $stud_pin2;

			$section =$_POST['section'];
			if($section == "Section"){
				array_push($error_array, "Kindly input the appropriate section<br>");
				
			}
			$amount = $_POST['amount'];
			if($amount == "Select Amount ON Card"){
				array_push($error_array, "Kindly Input The Right Amount<br>");
			}

			$term =$_POST['term'];

			$date = date("Y-m-d h:i:s");
			if($term == "term"){
				array_push($error_array, "Kindly input the appropriate term<br>");
				}

			if($stud_pin1 == $stud_pin2){
				$stud_pin1 = md5($stud_pin1);
				$pin_query = mysqli_query($con, "SELECT * FROM pin_table WHERE stud_pin ='$stud_pin1'");
				$pin_check = mysqli_num_rows($pin_query);
				if($pin_check !=0){
					array_push($error_array, "Kindly note that this pin exist already<br>");
				}
			}
			else{
				array_push($error_array, "these pins do not match<br>");
			}


			if(empty($error_array)){
				
				$send = mysqli_query($con, "INSERT INTO pin_table values(' ','$stud_pin1', '$date', 
				'$term', '$section','$user_name', '$amount', '','free')");
				echo $stud_pin1;
				array_push($error_array, "You have successfully login a pin");
				$_SESSION['stud_pin1']="";
				$_SESSION['stud_pin1']="";
			}
	
}
}
else{
	header("Location:../index.php");
}


?>



<html>
<head>
	<title></title>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--<meta property="og:title" content="" />-->
    <!--<meta property="og:url" content="" />-->
    <!--<meta property="og:image" content="" />-->
    <!--<meta property="og:site_name" content="" />-->
    <!--<meta property="og:description" content="" />-->
    <title>Course Project</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
	<link rel="stylesheet" href="../css/stud_pin.css">
</head>
<body>


	<div class="wrapper">
		<div class = "login_box">
			<div class ="login_header">
				<h1> Welcome to SaMizpah</h1>
				Kindly Enter Pin
			</div>
				<div id="first">
					<form action ="stud_pins.php" method="POST">
						<?php
							if(in_array("Kindly note that this pin exist already<br>", $error_array))
								echo "Kindly note that this pin exist already<br>";
							elseif (in_array("these pins do not match<br>", $error_array))
								echo "these pins do not match<br>";

						?>	
						<input type = "text" name ="stud_pin1" placeholder="Enter Pin" value="<?php
							if(isset($_SESSION['stud_pin1'])){
								echo $_SESSION['stud_pin1'];
							}

						?>" required=""><br>
						<input type = "text" name ="stud_pin2" placeholder="Confirm Pin" value="<?php
							if(isset($_SESSION['stud_pin2'])){
								echo $_SESSION['stud_pin2'];
							}

						?>" required=""><br>
						<?php
							if(in_array("Kindly Input The Right Amount<br>", $error_array)){
								echo "Kindly Input The Right Amount<br>";
							}
						?>
						<select name = "amount">
							<option>Select Amount ON Card</option>
							<option>50,000</option>
							<option>100,000</option>
							<option>150,000</option>
							<option>200,000</option>

						</select><br>
						<?php
							if(in_array("Kindly input the appropriate term<br>", $error_array))
								echo "Kindly input the appropriate term<br>";
						?>
						<select name ="term">
							<option>term</option>
							<option>First term</option>
							<option>Second term</option>
							<option>Third term</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						
						
						<?php
							if(in_array("Kindly input the appropriate section<br>", $error_array))
								echo "Kindly input the appropriate section<br>";
						?>
						<select name="section">
							<option>Section</option>
							<option>2019/2020</option>
							<option>2020/2021</option>
							<option>2021/2022</option>
							<option>2022/2023</option>
							<option>2023/2024</option>
							<option>2024/2025</option>
						</select>
						<br>
						<?php
							if(in_array("You have successfully login a pin", $error_array))
								echo "You have successfully login a pin";
						?>
						<br>
						<input type="submit" name="sub_pin_tab" value="ENTER">
					</form>
				</div>
			
			<a href="index.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>