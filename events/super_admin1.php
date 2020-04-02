<?php
	require '../configs/config.php';
	if(isset($_SESSION['user_name'])) {
	$username = $_SESSION['user_name'];
	$error_array= array();

	if(isset($_POST['bag_update'])){
		$u_name = $_POST['u_name'];

		$status_me = $_POST['status_me'];
		
		if($u_name ==''){
			array_push($error_array, "Kindly input the appropriate User Name<br>");
		}
		if($status_me =="Select"){
			array_push($error_array, "Please Select the right status<br>");
		}
		if($status_me =="admin"){
			$status ='admin1';
		}
		if($status_me =="no_admin"){
			$status = '';
		}
		if($status_me =="resigned"){
			$status = 'resigned';
		}

		$user_name_query = mysqli_query($con, "SELECT * FROM staff_table WHERE user_name ='$u_name'");
		$user_check = mysqli_num_rows($user_name_query);
		if($user_check !=0){
			$user_row = mysqli_fetch_array($user_name_query);
			$my_name = $user_row['user_name'];
			$f_name = $user_row['first_name'];

		}
		
		else{
			array_push($error_array, "Kindly note that this user name does not exist<br>");
		}

		if(empty($eror_array)){

			$admin_set_query = mysqli_query($con,"UPDATE  staff_table SET status='$status' WHERE user_name='$my_name'");

			array_push($error_array, "The User has been updated to become an Admin<br>");
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
	<link rel="stylesheet" href="../css/pay_fess.css">
</head>
<body>


	<div class="wrapper">
		<div class = "login_box">
			<div class ="login_header">
				<h1> Welcome to SaMizpah</h1>
				Set Admin!
			</div>
				<div id="first">
					<form action ="super_admin1.php" method="POST">
						<?php
							if(in_array("Kindly input the appropriate User Name<br>", $error_array))
								"Kindly input the appropriate User Name<br>";
							elseif(in_array("Kindly note that this user name does not exist<br>", $error_array))
								echo "Kindly note that this user name does not exist<br>";
							elseif(in_array("The User has been updated to become an Admin<br>", $error_array))
								echo "The User has been updated to become an Admin<br>";

							elseif(in_array("Please Select the right status<br>", $error_array))
								echo "Please Select the right status<br>";

						?>
		
						<input type="text" name="u_name" placeholder="User Name" required="">
					
						<br>
						<select name="status_me">
							<option>Select</option>
							<option>admin</option>
							<option>no_admin</option>
							<option>resigned</option>
						</select>
						<input type ="submit" name="bag_update" value ="Submit"><br>

					</form>
				</div>
			
			<a href="/secdbms/index.php">Home</a>

		</div>
		
	</div>
</body>
</html>