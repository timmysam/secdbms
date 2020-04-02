<?php
	require '../configs/config.php';
	if(isset($_SESSION['user_name'])) {
	$username = $_SESSION['user_name'];
	$error_array = array();
		$term="";
		$section="";
		$amount="";
		$level ="";

		if(isset($_POST['sub_button'])){
			$level = $_POST['level'];
			$_SESSION['level']=$level;

			if($level=="select class"){
				array_push($error_array, "Kindly input the accurate level<br>");
			}

			$term= $_POST['term'];
			$_SESSION['term']=$term;
			if($term =="term"){
				array_push($error_array, "Kindly input the accurate term<br>");
			}

			$section = $_POST['section'];
			$_SESSION['section']=$section;
			if($section =="section"){
				array_push($error_array, "Kindly input the accurate section<br>");
			}

			$amount = $_POST['amount'];
			$_SESSION['amount']=$amount;
			if($amount =="amount"){
				array_push($error_array, "Kindly input the accurate amount<br>");
			}
			$date = date("Y-M-D h:i:s");

			$payable_chec_query= mysqli_query($con, "SELECT * FROM payables WHERE level='$level'AND section='$section'AND term='$term'");
			$payable_check = mysqli_num_rows($payable_chec_query);
				if ($payable_check !=0){
					array_push($error_array, "Kindly note that a value exist for this class already<br>");
				}
			
		}
		if(empty($error_array)){

			$payable_query = mysqli_query($con, "INSERT INTO payables values('','$level',
				'$amount','$term','$section','time','Admin')");
				array_push($error_array, "Completed<br>");	
			
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
	<link rel="stylesheet" href="../css/pay_fess.css">
</head>
<body>


	<div class="wrapper">
		<div class = "login_box">
			<div class ="login_header">
				<h1> Welcome to SaMizpah</h1>
				Input School Fees For Each Class!
			</div>
				<div id="first">
					<form action ="payable.php" method="POST">
						<?php
							if(in_array("Kindly input the accurate term<br>", $error_array))
								echo "Kindly input the accurate term<br>";
							elseif(in_array("Kindly input the accurate section<br>", $error_array))
								echo "Kindly input the accurate section<br>";
							elseif(in_array("Kindly input the accurate level<br>", $error_array))
								echo "Kindly input the accurate level<br>";
							elseif(in_array("Kindly input the accurate amount<br>", $error_array))
								echo "Kindly input the accurate amount<br>";
							elseif(in_array("Completed<br>", $error_array))
								echo "You have succefully Enter #".$_SESSION['amount']. " to be paid by ".$_SESSION['level']. " Students<br>" ;
							elseif(in_array("Kindly note that a value exist for this class already<br>", $error_array))
								echo "Kindly note that a value exist for this class already<br>";
						?>
						
						<select name="level" class="myLevel" >
							<option>select class</option>
							<option>JSS1</option>
							<option>JSS2</option>
							<option>JSS3</option>
							<option>SSS1 Science</option>
							<OPTION>SSS1 Commercial</OPTION>
							<option>SSS1 Art</option>
							<option>SSS2 Science</option>
							<OPTION>SSS2 Commercial</OPTION>
							<option>SSS2 Art</option>
							<option>SSS3 Science</option>
							<OPTION>SSS3 Commercial</OPTION>
							<option>SSS3 Art</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="section">
							<option>Section</option>
							<option>2019/2020</option>
							<option>2020/2021</option>
							<option>2021/2022</option>
							<option>2022/2023</option>
							<option>2023/2024</option>
							<option>2024/2025</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name ="term">
							<option>term</option>
							<option>First term</option>
							<option>Second term</option>
							<option>Third term</option>
						</select>
						<input type="text" name="amount" placeholder="School Fess for Each Class">
						<br>
						<input type ="submit" name="sub_button" value ="Submit"><br>

					</form>
				</div>
			
			<a href="index.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>