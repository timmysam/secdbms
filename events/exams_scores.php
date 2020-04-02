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
					$next_level ="JSS2";
					break;
				case 'JSS2':
					$leveldb="jss2_scores_sheet";
					$next_level ="JSS3";
					break;
				case 'JSS3':
					$leveldb="jss3_scores1_sheet";
					$next_level ="graduated";
					break;
				case 'SSS1 Science':
					$leveldb="ss1_science_scores_sheet";
					$next_level ="SSS2 Science";
					break;
				case 'SSS1 Commercial':
					$leveldb="ss1_commercial_scores_sheet";
					$next_level ="SSS2 Commercial";
					break;
				case 'SSS1 Art':
					$leveldb="ss1_art_science_scores_sheet";
					$next_level ="SSS2 Art";
					break;
				case 'SSS2 Science':
					$leveldb="ss2_science_scores_sheet";
					$next_level ="SSS3 Science";
					break;
				case 'SSS2 Commercial':
					$leveldb="ss2_commercial_scores_sheet";
					$next_level ="SSS3 Commercial";
					break;
				case 'SSS2 Art':
					$leveldb="ss2_art_scores_sheet";
					$next_level ="SSS3 Art";
					break;
				case 'SSS3 Science':
					$leveldb="ss3_science_scores_sheet";
					$next_level ="graduated";
					break;
				case 'SSS3 Commercial':
					$leveldb="ss3_commercial_scores_sheet";
					$next_level ="graduated";
					break;
				case 'SSS3 Art':
					$leveldb="ss3_art_scores_sheet";
					$next_level ="graduated";
					break;
			}
			$term = $_POST['term'];

			if($term=="First term"){
				$theterm="first_term_total";
				$next_term ="Second_term";
			}
			elseif ($term=="Second term") {
				$theterm="seond_term_total";
				$next_term ="Third_term";
			}
			elseif ($term=="Third term") {
				$theterm="third_term_total";
				$next_term ="last_term";
			}
			
			$term = $_POST['term'];
			$exam_scores = $_POST['exam_scores'];
			if ($exam_scores > 60){
				array_push($error_array, "Exam scores should not be more than 60");
			}

			$subject = $_POST['subjects'];
			$_SESSION['section'] = $section;

			$test_check_query = mysqli_query($con,"SELECT * FROM term_section 
				WHERE term='$term' AND section ='$section'");
			
			//echo $term."<br>";
			$test_check = mysqli_num_rows($test_check_query);

			if($test_check != 0){

				$test_check_na = mysqli_fetch_array($test_check_query);
					$my_section = $test_check_na['section'];
					$my_term = $test_check_na['term'];
					
		
				}

			else{
				array_push($error_array, "Kindly pick the accurate term and section<br>");
			}
		
				$scores_query = mysqli_query($con, "SELECT * FROM $leveldb WHERE user_name='$user_name' AND section='$section'");
				$scores_row = mysqli_num_rows($scores_query); 
				if($scores_row !=0){
					$scores_check = mysqli_fetch_array($scores_query);
					$first_ca =$scores_check['first_term_ca_total'];
					$second_ca =$scores_check['second_term_ca_total'];
					$third_ca =$scores_check['third_term_ca_total'];
					$first_total =$scores_check['first_term_total'];
					$second_total =$scores_check['second_term_total'];
					//$third_total =$scores_check['third_term_total'];

					if ($term =="First term"){
					$sum_all_ave = $first_ca + $exam_scores; 
					}
					if ($term =="Second term") {
					$sum_second = $second_ca + $exam_scores;
					$sum_all = $sum_second + $first_total;
					$sum_all_ave =$sum_all/2;

					}
					if ($term =="Third term") {
					$sum_third = $third_ca + $exam_scores;
					$sum_all = $first_total + $second_total + $sum_third;
					$sum_all_ave =$sum_all/3;

						
					}

							switch ($sum_all_ave) {
							case ($sum_all_ave >= 70):
								$remark= "Distinction";
								break;
							case ($sum_all_ave >= 60):
								$remark ="Very Good";
								break;
							case ($sum_all_ave >= 50):
								$remark = "Good";
								break;
							case ($sum_all_ave >= 40):
								$remark ="Fair";
								break;
							case ($sum_all_ave <= 40):
								$remark ="Fail";
								break;
							}
				}
				else{
					array_push($error_array, "you are expected to input the value for currilum activities first<br>");
				}
			
			$_SESSION['last_name'] = $l_name;

			if($term =="term"){
				array_push($error_array, "Kindly input the accurate term<br>");
			}

			$date = date("Y-m-d h:i:s");

			if($term=="First term"){
				$theterm="first_term_total";
			}
			elseif ($term=="Second term") {
				$theterm="seond_term_total";
			}
			elseif ($term=="Third term") {
				$theterm="third_term_total";
			}

			if($term =="First term"){
				$first_term_query = mysqli_query($con, "SELECT * FROM $leveldb WHERE user_name='$user_name'
				AND term='$term' AND subject='$subject' AND first_com='Second_term'");
				$first_term_query_check = mysqli_num_rows($first_term_query);
					if($first_term_query_check !=0){
					array_push($error_array, "Kindly note that the record exit already for first term<br>");
				}
			}

			if ($term == "Second term"){
				$second_term_query = mysqli_query($con, "SELECT * FROM  $leveldb WHERE user_name= '$user_name'
				AND second_term = '$term' AND second_com='Third_term' AND subject='$subject'");
			$second_term_query_check = mysqli_num_rows($second_term_query);
				if($second_term_query_check !=0){
				array_push($error_array, "Kindly note that the record exit already for second term<br>");
				}
			}

			if ($term == "Third term"){
				$third_term_query = mysqli_query($con, "SELECT * FROM  $leveldb WHERE user_name= '$user_name'
				AND third_term = '$term' AND subject='$subject' AND third_com='last_term'");
				$third_term_query_check = mysqli_num_rows($third_term_query);
				if($third_term_query_check !=0){
				array_push($error_array, "Kindly note that the record exit already for third term<br>");
				}	
			}
			if(empty($error_array)){
				if($term =="First term"){
					$first_exam = mysqli_query($con, "UPDATE $leveldb SET
						first_term_exam ='$exam_scores',
						first_term_total='$sum_all_ave',
						first_com = '$next_term',
						final_remark='$remark' 
						WHERE user_name ='$user_name' 
						AND subject ='$subject'");
						array_push($error_array,"You have successfully input first term scores<br>");

					$my_sum_query = mysqli_query($con, "SELECT user_name, SUM($theterm) AS total FROM $leveldb WHERE user_name ='$user_name'");
					$my_total_check = mysqli_fetch_array($my_sum_query);
					$user_name = $my_total_check['user_name'];
					$my_total_scores = $my_total_check['total'];

					$my_sum_first_query = mysqli_query($con, "UPDATE $leveldb SET ave_total='$my_total_scores' 
						WHERE user_name ='$user_name'");
				}
				elseif ($term == "Second term") {
					$second_exam = mysqli_query($con, "UPDATE $leveldb SET 
						second_term_exam ='$exam_scores',
						second_term_total = '$sum_second',
						second_term_ave_scores='$sum_all_ave', 
						second_com ='$next_term',
						final_remark='$remark'
					WHERE user_name ='$user_name' AND subject ='$subject'");
					array_push($error_array, "You have successfully input second term scores<br>");

					$my_sum_query = mysqli_query($con, "SELECT user_name, SUM(second_term_ave_scores) AS total FROM $leveldb WHERE user_name ='$user_name'");
					$my_total_check = mysqli_fetch_array($my_sum_query);
					$user_name = $my_total_check['user_name'];
					$my_total_scores = $my_total_check['total'];

					$my_sum_first_query = mysqli_query($con, "UPDATE $leveldb SET ave_total='$my_total_scores' 
						WHERE user_name ='$user_name'");
				}

				elseif ($term == "Third term") {
					$third_exam = mysqli_query($con, "UPDATE $leveldb SET 
						third_term_exam ='$exam_scores',
						third_term_total='$sum_third', 
						third_term_ave_scores = '$sum_all_ave',
						third_com='$next_term',
						final_remark='$remark'
					WHERE user_name ='$user_name' AND subject ='$subject'");
					array_push($error_array, "You have successfully input third term scores<br>");

					$my_sum_query = mysqli_query($con, "SELECT user_name, SUM(third_term_ave_scores) AS total FROM $leveldb WHERE user_name ='$user_name'");
					$my_total_check = mysqli_fetch_array($my_sum_query);
					$user_name = $my_total_check['user_name'];
					$my_total_scores = $my_total_check['total'];

					$my_sum_first_query = mysqli_query($con, "UPDATE $leveldb SET ave_total='$my_total_scores' 
						WHERE user_name ='$user_name'");

					//if($sum_all_ave >= 50){
						//$my_promotion = mysqli_query($con, "UPDATE student_table 
							//SET level='$next_level', term='First term'
							//WHERE username='$user_name'");
					//}
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
				Kindly Input Exams Scores!
			</div>
				<div id="first">
					<form action ="exams_scores.php" method="POST">
						<?php
							if(in_array("You have successfully input second term scores<br>", $error_array))
								echo "You have successfully input second term scores<br>";
							elseif (in_array("You have successfully input first term scores<br>", $error_array)) 
								echo "You have successfully input first term scores<br>";
							
							elseif (in_array("You have successfully input third term scores<br>", $error_array))
								echo "You have successfully input third term scores<br>";
							elseif (in_array("you are expected to input the value for currilum activities first<br>", 
								$error_array)) echo "you are expected to input the value for currilum activities first<br>";
								elseif (in_array("Kindly pick the accurate term and section<br>", 
								$error_array)) echo "Kindly pick the accurate term and section<br>";
							
						?>
						<input type ="text" name="user_name" placeholder=" Enter User Name" value="<?php
							if(isset($_SESSION['username'])){ 
								echo $_SESSION['username'];
							}

						?>" required="">
						<br>
						<input type ="submit" name="check_user_name" value ="Confirm"><br>

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
						<?php
							if(in_array("Exam scores should not be more than 60", $error_array))
								echo "Exam scores should not be more than 60";
						?>
						<input type="text" name="exam_scores" placeholder="Enter your exam scores">
						<br>
						<input type ="submit" name="sub_button" value ="Submit"><br>

					</form>
				</div>
			
			<a href="index.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>