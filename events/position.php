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

	
		if(isset($_POST['sub_button'])){

			$level = $_POST['level'];

			$term = $_POST['term'];

	

			$subject = $_POST['subjects'];

			$date = date("Y-m-d h:i:s");

			$myLevel =$level;

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

			if($term=="First term"){
				$theterm="first_term_total";
			}
			elseif ($term=="Second term") {
				$theterm="second_term_total";
			}
			elseif ($term=="Third term") {
				$theterm="third_term_total";
			}

			$ranks_query = mysqli_query($con, "SELECT  DISTINCT $theterm, id FROM $leveldb 
				WHERE subject='$subject' 
				ORDER BY $theterm DESC");
			$ranks_check = mysqli_num_rows($ranks_query);

			
			$ass =0;// current record count
			$rank =0; //rank
			$last_points = NULL; //VARIABLE TO STORE LAST RANKED VALUE
			While ($ass !=$ranks_check){
				$row = mysqli_fetch_array($ranks_query);
				$ass++;
				//check if value changes and reset rank if it does
				if ($row[$theterm] !==$last_points){
					$rank = $ass;
					$last_points =$row[$theterm];
				}
				else{
					$rank =$rank * 1;
					$last_points =$row[$theterm];
				}	
				$id = $row['id'];
				$scores = $row[$theterm];
				//$rank_update = mysqli_query($con, "UPDATE $leveldb SET position='$rank'
			 		//WHERE id ='$id' ORDER BY $theterm");
				//echo $id." is the id number ".$scores." position is ".$rank." <br>";
			}
		array_push($error_array, "You Have Successfully Computed The Position<br>");
			
			if(empty($error_array)){
				
				
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
				Compute Stendent Ranking in Each Subject!
			</div>
				<div id="first">
					<form action ="position.php" method="POST">
				<?php
					if(in_array("You Have Successfully Computed The Position<br>", $error_array))
						echo "You Have Successfully Computed The Position<br>";
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
						</select>

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
						<input type ="submit" name="sub_button" value ="Submit"><br>

					</form>
				</div>
			
			<a href="index.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>