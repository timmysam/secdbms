	<?php
	require 'configs/config.php';
	$error_array = array();
		$email = "";

		if(isset($_POST['login_button'])) {
			
			$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); 

		//sanitize email	
			$email = strip_tags($_POST['log_email']);
			$email = str_replace(" ", "", $email);
			$email = ucfirst(strtolower($email)); 
		//Store email into session variable 	
		$password = $_POST['log_password'];

		$password=strip_tags($_POST['log_password']);
		$password=ucfirst(strtolower($password));
		$password = md5($password);
		echo $password;
		//Get password
		$check_database_query = mysqli_query($con, "SELECT * FROM staff_table WHERE email='$email'  
			AND password='$password' AND status='admin1'");
		$check_login_query = mysqli_num_rows($check_database_query);

		if($check_login_query != 0) {		
			$row = mysqli_fetch_array($check_database_query);		
			$username = $row['user_name'];
			$_SESSION['user_name'] = $username;

			header("Location: events/profile.php");
					
			exit();
			
		}

		else {		
		array_push($error_array, "Email or password was incorrect<br>");

		}


}


?>



<html>
<head>
	<title>Samizpah</title>
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
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
		
<?php  

	if(isset($_POST['sub_button'])) {
		
		echo '
			<script>
				$(document).ready(function() {

				$("#first").hide();

				$("#second").show();

				});

						
			</script>


		';
	
	}


	
?>

	<div class="wrapper">
		<div class = "login_box">
			<div class ="login_header">
				<h1> Welcome to SaMizpah</h1>
				Kindly Login!
			</div>
				<div id="first">
					<form action ="login.php" method="POST">	
						<tr ><th><input type="email" name="log_email" placeholder="Email Address" value="<?php 
						if(isset($_SESSION['log_email'])) {	
						echo $_SESSION['log_email'];
						} 
						?>" required>
						<br>
						<tr ><th><input type="password" name="log_password" placeholder="Password" required>
						<br>
						<?php
							if(in_array( "Email or password was incorrect<br>", $error_array)) echo  
								"Email or password was incorrect<br>";

						?>
						<input type="submit" name="login_button" value="Login">
						<br>
						<a href="staff_registration.php" id="signup" class"signup"> Need an account, click here!</a>
					</form>
				</div>
			
			<a href="index.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>