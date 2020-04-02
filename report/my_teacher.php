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
						$this->Cell(0,10, 'Staff Data ', 0, 1,'C');
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
				$sch_report = mysqli_query($con, "SELECT * FROM staff_table WHERE user_name = '$username'");
				$sch_report_check = mysqli_num_rows($sch_report);

				$pdf->Cell(50,10,'',0,1,0);;
						$pdf->Cell(150,10,'    '.$date,0,1,'0');
						$pdf->Cell(50,10,'',0,1,0);
						//$pdf->Cell(11,10,'S/N',1,0,'C');
						$pdf->Cell(34,10,'First Name',1,0,'C');
						$pdf->Cell(30,10,'Last Name',1,0,'C');
						$pdf->Cell(53,10,'Username',1,0,'C');
						$pdf->Cell(46,10,'email',1,0,'C');
						//$pdf->Cell(60,10,'Address',1,0,'C');
						//$pdf->Cell(30,10,'qualification',1,0,'C');
						$pdf->Cell(55,10,'status',1,0,'C');	
						$pdf->Cell(52,10,'Date REG',1,1,'C');
				
					$sch_report_row = mysqli_fetch_array($sch_report);
					$f_name = $sch_report_row['first_name'];
					$l_name = $sch_report_row['last_name'];
					$username = $sch_report_row['user_name'];
					$p_num = $sch_report_row['email'];
					//$address = $sch_report_row['address'];
					//$dob = $sch_report_row['qualification'];
					$dob = $sch_report_row['status'];
					$date_registered = $sch_report_row['date'];	
					//$pdf->Cell(11,10,$s,1,0,'C');	
					$pdf->Cell(34,10,$sch_report_row['first_name'],1,0,'C');
					$pdf->Cell(30,10,$sch_report_row['last_name'],1,0,'C');
					$pdf->Cell(53,10,$sch_report_row['user_name'],1,0,'C');
					$pdf->Cell(46,10,$sch_report_row['email'],1,0,'C');
					//$pdf->Cell(60,10,$sch_report_row['address'],1,0,'C');
					//$pdf->Cell(30,10,$sch_report_row['qualification'],1,0,'C');
					$pdf->Cell(55,10,'Kindly meet with the admin',1,0,'C');
					$pdf->Cell(52,10,$sch_report_row['date'],1,1,'C');
				$pdf-> Output();
				unset($_SESSION['user_name']);

	
}
else{
	
	header("Location: ../index.php");
}

?>