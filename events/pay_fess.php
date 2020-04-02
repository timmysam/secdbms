<?php
	require '../configs/config.php';
	$error_array = array();
		$stud_pin1 = "";
		$stud_pin2 = "";
		$sub_pin_tab = "";
		$user_name = "";
		$date = "";

		if(isset($_POST['check_user_name'])){

			$user_name = $_POST['user_name'];
			$user_query = mysqli_query($con, "SELECT * FROM student_table WHERE username ='$user_name'");
			$user_check = mysqli_num_rows($user_query);
			if($user_check !=0){
				$user_row = mysqli_fetch_array($user_query);
				$f_name = $user_row['first_name'];

				$_SESSION['first_name'] = $f_name;

				$level = $user_row['level'];
				$_SESSION['level'] = $level;

				$section = $user_row['section'];
				$_SESSION['section'] = $section;

				$term = $user_row['term'];
				$_SESSION['term'] = $term;

				$user_name = $user_row['username'];
				$_SESSION['username'] = $user_name;

				$m_name = $user_row['middle_name'];
				$_SESSION['middle_name'] = $m_name;

				$l_name = $user_row['last_name'];
				$_SESSION['last_name'] = $l_name;

				// GET MONEY EXPECTED TO BE PAID
				$user_balance = mysqli_query($con, "SELECT amount FROM payables WHERE term='$term' AND section='$section'");
				$user_balance_check = mysqli_num_rows($user_balance);
				if($user_balance_check !=0){
					$user_num = mysqli_fetch_array($user_balance);
					$user_amount= $user_num['amount'];
				}

			// CALCULATE ALL THE MONEY PAID BY STUDENT IN A SECSION
				$amount_paid = mysqli_query($con, "SELECT amount FROM school_fess WHERE username=
					'$user_name' AND term='$term' AND section='$section'");
				$mount_paid_check = mysqli_num_rows($amount_paid);
				$K = 0;
				$total_paid = 0;
				$s_name = Null;
				WHILE ($K != $mount_paid_check){
					$amount_paid_row = mysqli_fetch_array($amount_paid);
					$money_paid = $amount_paid_row['amount'];
					$money_paid = strip_tags($money_paid);
					$total_paid += $money_paid;
					$K++;
				}
			// CALCULATE BALANCE TO BE PAID BY THE STUDENT
				$you_balance = $user_amount-$total_paid;
				$_SESSION[$you_balance]= $you_balance;
				if($you_balance!=0){
					array_push($error_array, "You are expected to pay <br>");
				}
				else{
					array_push($error_array, "You have balanced your school fees <br>");
				}
			}	

		}

		if(isset($_POST['sub_button'])){

			$user_name = $_POST['user_name'];
			$user_query = mysqli_query($con, "SELECT * from student_table WHERE username='$user_name'");
			$user_check = mysqli_num_rows($user_query);
			if($user_check !=0){
				$user_row = mysqli_fetch_array($user_query);
				$f_name = $user_row['first_name'];
				$_SESSION['first_name'] = $f_name;

				$section = $user_row['section'];

				$user_name = $user_row['username'];
				$_SESSION['username'] = $user_name;

				$level = $user_row['level'];

				$m_name = $user_row['middle_name'];
				$_SESSION['middle_name'] = $m_name;

				$l_name = $user_row['last_name'];
				$_SESSION['last_name'] = $l_name;
			}


			$term = $_POST['term'];
			
			$section = $_POST['section'];

			if($term =="term"){
				array_push($error_array, "Kindly input the accurate term<br>");
			}

			if($section =="Section"){
				array_push($error_array, "Kindly input the accurate section<br>");
			}

			$date = date("Y-m-d");

			$pin_number = $_POST['pin_number'];
			

			$pin_number_query = mysqli_query($con, "SELECT * FROM pin_table WHERE stud_pin ='$pin_number' and note='free'");
			$pin_check = mysqli_num_rows($pin_number_query);

			if($pin_check != 0){
				$pin_row = mysqli_fetch_array($pin_number_query);
				$amount = $pin_row['amount'];
			}
			else{
				array_push($error_array, "kindly note that the card num is not valid<br>");
			}

			$pin_used_array = mysqli_query($con, "SELECT * FROM  school_fess WHERE pin_num ='$pin_number'");
			$pin_used_check = mysqli_num_rows($pin_used_array);

			if($pin_used_check != 0){
				$pin_used_rows = mysqli_fetch_array($pin_used_array);
				array_push($error_array, "Kindly note that this pin has been used <br>");
			}

			// Calculate the balance remaining after making this payment.
					// GET MONEY EXPECTED TO BE PAID
					$user_balance = mysqli_query($con, "SELECT amount FROM payables WHERE term='$term' AND section='$section'");
					$user_balance_check = mysqli_num_rows($user_balance);

					if($user_balance_check !=0){
						$users_num = mysqli_fetch_array($user_balance);
						$user_amount = $users_num['amount'];
					}
					else {
						array_push($error_array, "kindly note that the card num is not valid<br>");
					}
						// CALCULATE ALL THE MONEY PAID BY STUDENT IN A SECSSION
					//$amount_paid = mysqli_query($con, "SELECT amount FROM school_fess WHERE username=
						//'$user_name' AND term='$term' AND section='$section'");
					//$mount_paid_check = mysqli_num_rows($amount_paid);
					
						//$K = 0;
						//$total_paid = 0;
						//WHILE ($K != $mount_paid_check){
						//$amount_paid_row = mysqli_fetch_array($amount_paid);
						//$money_paid = $amount_paid_row['amount'];
						//$money_paid = strip_tags($money_paid);
						//$total_paid += $money_paid;
						//$K++;
					//}
//
					//$t_sum = $amount + $total_paid;
					//$your_balance = $user_amount - $t_sum;


			if(empty($error_array)){
				$sch_fess_query = mysqli_query($con,"INSERT INTO school_fess VALUES('','$user_name',
					'$f_name','$m_name','$l_name','$term',
			 '$section','$level','','$pin_number','$amount','$date','PAID')");
				$more_infor = mysqli_query($con, "UPDATE pin_table SET note='USED', used_by='$user_name' 
					WHERE stud_pin='$pin_number'");
				array_push($error_array, "You have successfully paid your school fees<br>");
				$_SESSION['first_name'] = "";
				$_SESSION['user_name'] = "";
				$_SESSION['middle_name'] = "";
				$_SESSION['last_name'] = "";
				$_SESSION['username'] = $user_name;
				echo $user_name;
				header("Location:../report/receipt.php");
				exit;

				
			}
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
				Kindly Pay Your School Fees!
			</div>
				<div id="first">
					<form action ="pay_fess.php" method="POST">
						<input type ="text" name="user_name" placeholder=" Enter User Name" value="<?php
							if(isset($_SESSION['username'])){ 
								echo $_SESSION['username'];
							}
						?>" required="">
						<br>
						<input type ="submit" name="check_user_name" value ="Confirm"><br>
						<?php
							if(in_array("You are expected to pay <br>", $error_array))
								echo "You are expected to pay #".$_SESSION[$you_balance];
							elseif(in_array( "Your Balance is # <br>", $error_array))
								echo "Your Balance is # <br>".$_SESSION[$you_balance];
							elseif(in_array("You have balanced your school fees <br>", $error_array))
								echo "You have balanced your school fees <br>";

						?>
						<input type ="text" name="f_name" placeholder=" first Name" value="<?php
							if(isset($_SESSION['first_name'])){
								echo $_SESSION['first_name'];
							}
						?>">
						<br>
						<input type ="text" name="m_name" placeholder=" Middle Name" value="<?php
							if(isset($_SESSION['middle_name'])){
								echo $_SESSION['middle_name'];
							}
						?>" >
						<br>
						<input type ="text" name="l_name" placeholder=" Last Name" value="<?php
							if(isset($_SESSION['last_name'])){
								echo $_SESSION['last_name'];
							}
						?>" >
						<br>
						<?php
							if(in_array("kindly note that the card num is not valid<br>", $error_array))
								echo "kindly note that the card num is not valid<br>";

							elseif (in_array("Kindly note that this pin has been used <br>", 
								$error_array)) echo "Kindly note that this pin has been used <br>";

							elseif (in_array("You have successfully paid your school fees<br>", $error_array))
								echo "You have successfully paid ".$amount."<br>";

						?>
						<input type ="text" name="pin_number" placeholder="Enter Your Pin Number" value="" >
						<br>
						<?php
							if(in_array("Kindly input the accurate term<br>", $error_array))
								echo "Kindly input the accurate term<br>";
						?>
						<?php
							if(in_array("Kindly input the accurate section<br>", $error_array))
								echo "Kindly input the accurate section<br>" ;
						?>
						<select name ="term">
							<option>term</option>
							<option>First term</option>
							<option>Second term</option>
							<option>Third term</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label>
						<?php
							if(isset($_SESSION['level'])){
								echo $_SESSION['level'];
							}
						?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
						<input type ="submit" name="sub_button" value ="Submit"><br>
					</form>
				</div>
			
			<a href="../index.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>