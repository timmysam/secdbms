<?php
	require '../configs/config.php';
	include"../fpdf181/fpdf.php";
	$term ="";
	$section ="";
	$error_array = array();

	if(isset($_POST['pdf_button'])){
		$term = $_POST['term'];
		if($term=='Term'){
		array_push($error_array, "Kindly input the appropriate term<br>");
	}
		$section = $_POST['section'];
		if($section =='Section'){
			array_push($error_array, "Kindly input the appropriate Section<br>");
		}
		$date =date("Y-M-D h:i:s");

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
						$this->Cell(0,10, 'School Fess Statement', 0, 1,'0');
						$this->SetDrawColor(0,51,0);
						$this->SetLineWidth(1);
						$this->Line(10, 52, 200, 52);
						$this->Cell(1);
					}

					function footer(){
						$this->SetY(-15);
						$this->SetFont('Arial','', 8);
						$this->Cell(0,10,'Page '.$this->PageNo().'{/nb}', 0,0,'c');
					}	

				}
				$pdf = new myPDF();
				$pdf-> AliasNbPages();
				$pdf-> AddPage();
				$pdf->SetFont('Courier','B',12);
				$sch_report = mysqli_query($con, "SELECT * FROM school_fess 
					WHERE term='$term' AND section='$section'
					order by level");
				$sch_report_check = mysqli_num_rows($sch_report);
				$K = 0;
				$stud_name = NULL;
				WHILE($K != $sch_report_check){
					$sch_report_row = mysqli_fetch_array($sch_report);
					$f_name = $sch_report_row['first_name'];
					$l_name = $sch_report_row['last_name'];
					$username = $sch_report_row['username'];
					$amount = $sch_report_row['amount'];
					$level = $sch_report_row['level'];
					$paid_date = $sch_report_row['date'];
					$username = $sch_report_row['username'];
					$my_name =$sch_report_row['last_name']." ".$sch_report_row['first_name'];
					if($stud_name!=$my_name){
						$pdf->Cell(50,10,'',0,1,0);
						$pdf->Cell(92,10,'Student ID: '.$username,0,0,'C');
						$pdf->Cell(40,10,'CLASS: '.$level,0,1,'R');
						//$pdf->Cell(150,10,'    '.$date,0,1,'0');
						$pdf->Cell(30,10,'First Name',1,0,'C');
						$pdf->Cell(30,10,'Last Name',1,0,'C');
						$pdf->Cell(19,10,'Level',1,0,'C');
						$pdf->Cell(20,10,'Amount',1,0,'C');	
						$pdf->Cell(52,10,'Date Paid',1,1,'C');		
						}
					$pdf->Cell(30,10,$sch_report_row['first_name'],1,0,'C');
					$pdf->Cell(30,10,$sch_report_row['last_name'],1,0,'C');
					$pdf->Cell(19,10,$sch_report_row['level'],1,0,'C');
					$pdf->Cell(20,10,$sch_report_row['amount'],1,0,'C');
					$pdf->Cell(52,10,$sch_report_row['date'],1,1,'C');
					$stud_name = $my_name;
					$K++;	
				}
				$pdf-> Output();

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
					Finacial Report!
			</div>
				<div id="first">
					<form action ="sch_fees_report.php" method="POST">
						<select name ="term">
							<option>Term</option>
							<option>First term</option>
							<option>Second term</option>
							<option>Third term</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
			
			<a href="index.php">Back to Home</a>
		</div>
		
	</div>
</body>
</html>