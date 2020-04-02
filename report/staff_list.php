<?php
	require '../configs/config.php';
	include"../fpdf181/fpdf.php";
	$error_array= array();

if(isset($_SESSION['user_name'])) {

	$username = $_SESSION['user_name'];
		$date =date("Y-m-d");
				

		class myPDF extends FPDF{

					function header(){
						$this->SetY(5);
						$this->Image('../images/Samizpah ENT.png',-35,-45,'C');
						$this->Ln(5);
						$this->SetFont('Arial','B',16);
						$this->SetTextColor(0, 51, 0);
						$this->cell(0,5,'Samizpah Enterprice DBMS',0,0,'C');
						$this->Ln();
						$this->SetFont('Times', '', 10);
						//$this->SetTextColor(0, 128, 255);
						$this->Cell(0,10, 'no 3, Maryl Land cresenct, Mary Land-Lagos',0,1,'C');
						$this->cell(0,10, 'email: samizpahenterprice@gmail.com  mobile: 08100002989',0,0,'C');
						$this->Ln(30);
						$this->SetTextColor(0, 0, 0);
						$this->SetFont('Arial', '', 14);
						$this->Cell(0,10, 'LIST OF STAFF ', 0, 1,'C');
						$this->SetDrawColor(0,51,0);
						$this->SetLineWidth(1);
						$this->Line(7, 52, 290, 52);
						$this->Cell(1);
					}

					function footer(){
						$this->SetY(-15);
						$this->SetFont('Arial','', 8);
						$this->Cell(0,10,'Page '.$this->PageNo(), 0,0,'c');
					}	

				}
				$pdf = new myPDF('L');
				$pdf-> AliasNbPages();
				$pdf-> AddPage();
				$pdf->SetFont('Courier','B',9);
				$sch_report = mysqli_query($con, "SELECT * FROM staff_table");
				$sch_report_check = mysqli_num_rows($sch_report);

				$pdf->Cell(50,10,'',0,1,0);;
						$pdf->Cell(150,10,'    '.$date,0,1,'0');
						$pdf->Cell(50,10,'',0,1,0);
						$pdf->Cell(11,10,'S/N',1,0,'C');
						$pdf->Cell(34,10,'First Name',1,0,'C');
						$pdf->Cell(30,10,'Last Name',1,0,'C');
						$pdf->Cell(53,10,'Username',1,0,'C');
						$pdf->Cell(46,10,'email',1,0,'C');
						//$pdf->Cell(60,10,'Address',1,0,'C');
						$pdf->Cell(30,10,'qualification',1,0,'C');
						$pdf->Cell(18,10,'status',1,0,'C');	
						$pdf->Cell(40,10,'Date REG',1,1,'C');
				 $s=0;
				 $my_name = NULL;
			  		WHILE( $s < $sch_report_check){
			  			$s++;
					$sch_report_row = mysqli_fetch_array($sch_report);
					$f_name = $sch_report_row['first_name'];
					$l_name = $sch_report_row['last_name'];
					$username = $sch_report_row['user_name'];
					$p_num = $sch_report_row['email'];
					//$address = $sch_report_row['address'];
					$dob = $sch_report_row['qualification'];
					$dob = $sch_report_row['status'];
					$date_registered = $sch_report_row['date'];	
					$pdf->Cell(11,10,$s,1,0,'C');	
					$pdf->Cell(34,10,$sch_report_row['first_name'],1,0,'C');
					$pdf->Cell(30,10,$sch_report_row['last_name'],1,0,'C');
					$pdf->Cell(53,10,$sch_report_row['user_name'],1,0,'C');
					$pdf->Cell(46,10,$sch_report_row['email'],1,0,'C');
					//$pdf->Cell(60,10,$sch_report_row['address'],1,0,'C');
					$pdf->Cell(30,10,$sch_report_row['qualification'],1,0,'C');
					$pdf->Cell(18,10,$sch_report_row['status'],1,0,'C');
					$pdf->Cell(40,10,$sch_report_row['date'],1,1,'C');
					
					$my_name = $username;
				}
				$pdf-> Output();
				unset($_SESSION['user_name']);

	
}
else{
	
	header("Location: ../index.php");
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
				List of Students in the School!
			</div>
				<div id="first">
					<form action ="student_list.php" method="POST">
						<?php
							if(in_array("Kindly select the appropriate Level<br>", $error_array))
							echo "Kindly select the appropriate Level<br>";
						?>
		
						<select name="level" class="myLevel" >
							<option>Select class</option>
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
							<option>All Clases</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
						<input type ="submit" name="pdf_button" value ="Submit"><br>

					</form>
				</div>
			
			<a href="report_task_bar.php">Home</a>
		</div>
		
	</div>
</body>
</html>