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

				$m_name = $user_row['middle_name'];
				$_SESSION['middle_name'] = $m_name;

				$l_name = $user_row['last_name'];
				$_SESSION['last_name'] = $l_name;

				$user_name = $user_row['username'];
				$_SESSION['username'] = $user_name;
			}

		}

		if(isset($_POST['sub_button'])){

			$user_name = $_POST['user_name'];
			$user_query = mysqli_query($con, "SELECT * FROM student_table WHERE username ='$user_name'");
			$user_check = mysqli_num_rows($user_query);
			if($user_check !=0){
				$user_row = mysqli_fetch_array($user_query);
				$f_name = $user_row['first_name'];
				$_SESSION['first_name'] = $f_name;


				$user_name = $user_row['username'];
				$_SESSION['user_name'] = $user_name;

				$m_name = $user_row['middle_name'];
				$_SESSION['middle_name'] = $m_name;

				$l_name = $user_row['last_name'];
				$_SESSION['last_name'] = $l_name;

				$section = $user_row['section'];
				$_SESSION['section'] = $section;

				$level = $user_row['level'];
				$_SESSION['class'] = $level;
			}

			switch ($level) {
				case 'JSS1':
					$leveldb="jss1_scores_sheet";
					break;
				case 'JSS2':
					$leveldb="jss2_scores_sheet";
					break;
				case 'JSS3':
					$leveldb="jss3_scores1_sheet";
					break;
				case 'SSS1 Science':
					$leveldb="ss1_science_scores_sheet";
					break;
				case 'SSS1 Science':
					$leveldb="ss1_science_scores_sheet";
					break;
				case 'SSS1 Commercial':
					$leveldb="ss1_commercial_scores_sheet";
					break;
				case 'SSS1 Art':
					$leveldb="ss1_art_science_scores_sheet";
					break;
				case 'SSS2 Science':
					$leveldb="ss2_science_scores_sheet";
					break;
				case 'SSS2 Commercial':
					$leveldb="ss2_commercial_scores_sheet";
					break;
				case 'SSS2 Art':
					$leveldb="ss2_art_scores_sheet";
					break;
				case 'SSS3 Science':
					$leveldb="ss3_science_scores_sheet";
					break;
				case 'SSS3 Commercial':
					$leveldb="ss3_commercial_scores_sheet";
					break;
				case 'SSS3 Art':
					$leveldb="ss3_art_scores_sheet";
					break;
			}

			$term = $_POST['term'];
			//check if the term: note the term must be set by the admin

			$test_check_query = mysqli_query($con,"SELECT * FROM term_section 
				WHERE term='$term' AND section ='$section'" );
			$test_check = mysqli_num_rows($test_check_query);
			
			if($test_check !=0 ){
				$test_check_na = mysqli_fetch_array($test_check_query);
					$my_section = $test_check_na['section'];
					$my_term = $test_check_na['term'];
			}

			else{
				array_push($error_array, "Kindly pick the accurate term and section<br>");
			}

			$home_work = $_POST['home_work'];
			$home_work_second = $_POST['home_work'];
			$home_work_third = $_POST['home_work'];

			$subject = $_POST['subjects'];

			$ca1 = $_POST['ca1'];
			$second_ca1 = $_POST['ca1'];
			$third_ca1 = $_POST['ca1'];

			$ca2 = $_POST['ca2'];
			$second_ca2 = $_POST['ca2'];
			$third_ca2 = $_POST['ca2'];

			$first_total = $home_work + $ca1 + $ca2;
			$second_total_ca = $home_work_second + $second_ca1 + $third_ca2;
			$third_total_ca = $home_work_third + $third_ca1 + $third_ca2;

			$_SESSION['last_name'] = $l_name;

			if($first_total >= 35){
				$remark ="Exellent";
			}
			elseif ($first_total >= 30) {
				$remark ="Very Good";
			}
			elseif ($first_total >= 25) {
				$remark ="Good";
			}
			elseif ($first_total >= 20) {
				$remark ="Average";
			}
			elseif ($first_total >= 15) {
				$remark ="Fair";
			}
			else{
				$first_total ="Fail";
			}

			if($term =="term"){
				array_push($error_array, "Kindly input the accurate term<br>");
			}

			$date = date("Y-m-d h:i:s");
			if($term =="First term"){
				$first_term_query = mysqli_query($con, "SELECT * FROM $leveldb WHERE user_name='$user_name'
				AND term='$term' AND subject='$subject'");
				$first_term_query_check = mysqli_num_rows($first_term_query);
				if($first_term_query_check !=0){
				array_push($error_array, "Kindly note that the record exit already for first term<br>");
				}
			}

			if ($term == "Second term"){
				$second_term_query = mysqli_query($con, "SELECT * FROM  $leveldb WHERE user_name= '$user_name'
				AND second_term = '$term' AND subject='$subject'");
			$second_term_query_check = mysqli_num_rows($second_term_query);
			if($second_term_query_check !=0){
				array_push($error_array, "Kindly note that the record exit already for second term<br>");
			}
			}

			if ($term == "Third term"){
				$third_term_query = mysqli_query($con, "SELECT * FROM  $leveldb WHERE user_name= '$user_name'
				AND third_term = '$term' AND subject='$subject'");
				$third_term_query_check = mysqli_num_rows($third_term_query);
				if($third_term_query_check !=0){
				array_push($error_array, "Kindly note that the record exit already for third term<br>");
			}	
			}
			

			if(empty($error_array)){
				if($term =="First term"){
					$first_term_ca_scores = mysqli_query($con, "INSERT INTO $leveldb
					 VALUES('','$f_name','$m_name','$l_name','$user_name','$section','$term','$subject',
					 '$ca1','$ca2','$home_work','$first_total',
					 '','','','','','','','','','','',
					 '','','','','','','','','','','','','','')");
					array_push($error_array, "You have successfully input first term scores<br>");
				}
				elseif ($term == "Second term") {

					$second_term_ca_scores = mysqli_query($con, "UPDATE $leveldb SET 
					first_test_second_term='$second_ca1', second_test_second_term ='$second_ca2',
					assignment_second_term='$home_work_second', 
					second_term_ca_total='$second_total_ca', second_term='$term' 
					WHERE user_name ='$user_name' AND subject ='$subject'");
					array_push($error_array, "You have successfully input second term scores<br>");
				}

				elseif ($term == "Third term") {
					$third_term_ca_scores = mysqli_query($con, "UPDATE $leveldb SET
						third_term='$term',first_test_third_term='$third_ca1',
						second_test_third_term='$third_ca2',
						assignment_third_term='$home_work_third',
						third_term_ca_total='$third_total_ca'
						WHERE user_name ='$user_name' AND subject ='$subject'");

					$second_term_ca_scores = mysqli_query($con, "UPDATE $leveldb SET 
					first_test_third_term='$third_ca1', second_test_third_term ='$third_ca2',
					assignment_third_term='$home_work_third', 
					third_term_ca_total='$third_total_ca', third_term='$term' 
					WHERE user_name ='$user_name' AND subject ='$subject'");
					array_push($error_array, "You have successfully input third term scores<br>");
				}
				
				$_SESSION['first_name'] = "";
				$_SESSION['user_name'] = "";
				$_SESSION['middle_name'] = "";
				$_SESSION['last_name'] = "";
				$_SESSION['level'] = "";
				$_SESSION['section'] = "";

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
				Kindly Input Tests Scores!
			</div>
				<div id="first">
					<form action ="test_scores.php" method="POST">
						
						<input type ="text" name="user_name" placeholder=" Enter User Name" value="<?php
							if(isset($_SESSION['username'])){ 
								echo $_SESSION['username'];
							}

						?>" required="">
						<br>
						<input type ="submit" name="check_user_name" value ="Confirm"><br>
						<?php
							if(in_array("You have successfully input second term scores<br>", $error_array))
								echo "You have successfully input second term scores<br>";
							elseif (in_array("You have successfully input first term scores<br>", $error_array)) {
								echo "You have successfully input first term scores<br>";
							}
							elseif (in_array("You have successfully input third term scores<br>", $error_array)) {
								echo "You have successfully input third term scores<br>";
							}
							elseif (in_array("Kindly pick the accurate term and section<br>", $error_array)) {
								echo "Kindly pick the accurate term and section<br>";
							}
							
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
						
						<label name"section"><?php
							if(isset($_SESSION['section'])){
								echo $_SESSION['section'];
							}

						?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

						<label name="level"><?php
							if(isset($_SESSION['level'])){
								echo $_SESSION['level'];
							}

						?></label>
						<br>
						<br>
						<?php
							if(in_array("Kindly input the accurate term<br>", $error_array))
								echo "Kindly input the accurate term<br>";
							elseif (in_array("Kindly note that the record exit already for first term<br>", $error_array))
							echo "Kindly note that the record exit already for first term<br>";
							elseif (in_array("Kindly note that the record exit already for second term<br>", $error_array))
							echo "Kindly note that the record exit already for second term<br>";
							elseif (in_array("Kindly note that the record exit already for third term<br>", $error_array))
							echo "Kindly note that the record exit already for third term<br>";
						?>
						<select name ="term">
							<option>term</option>
							<option>First term</option>
							<option>Second term</option>
							<option>Third term</option>
						</select>

	
						<select name ="subjects">
							<option>Select subject</option>
							<option>Agricultural science</option>
							<option>Biology</option>
							<option>Basic Science</option>
							<option>Basic Technology</option>
							<option>business Studies</option>
							<option>Chemistry</option>
							<option>Christian Religious Studies</option>
							<option>Civic Education</option>
							<option>Computer Studies</option>
							<option>Cultutral & Creative Art</option>
							<option>Economics</option>
							<option>English language</option>
							<option>French language</option>
							<option>Further mathematics</option>
							<option>Geography</option>
							<option>Government</option>
							<option>Hausa Language</option>
							<option>Home Economics</option>
							<option>Igbo Language</option>
							<option>Literature in English</option>
							<option>Mathematics</option>
							<option>Music</option>
							<option>Physical & Health Education</option>
							<option>Social Studies</option>
							<option>Physics</option>
							<option>Yoruba Language</option>
							
							<option>Islamic Religious Studies</option>
						</select>

						<br>
						Home Work:
						<select name="home_work">
							<option>seclect</option>
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>

						</select><br>
						Test1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="ca1">
							<option>seclect</option>
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
						</select>
						<br>
						Test2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="ca2">
							<option>seclect</option>
							<option>0</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
							<option>11</option>
							<option>12</option>
							<option>13</option>
							<option>14</option>
							<option>15</option>
						</select>
						
						<br>
						<input type ="submit" name="sub_button" value ="Submit"><br>

					</form>
				</div>
			
			<a href="../events/profile.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>