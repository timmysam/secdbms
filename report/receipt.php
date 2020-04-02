<?php
	require '../configs/config.php';
	include"../fpdf181/fpdf.php";

if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];

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
						$this->Cell(0,10, 'School Fess Receipt', 0, 1,'0');
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
					WHERE username='$username' AND date ='$date'");

				$sch_report_check = mysqli_num_rows($sch_report);
				
				if($sch_report_check !=0){
					$sch_report_row = mysqli_fetch_array($sch_report);
					$f_name = $sch_report_row['first_name'];
					$l_name = $sch_report_row['last_name'];
					$username = $sch_report_row['username'];
					$amount = $sch_report_row['amount'];
					$id = $sch_report_row['id'];
					$level = $sch_report_row['level'];
					$paid_date = $sch_report_row['date'];
					$username = $sch_report_row['username'];
					$my_name =$sch_report_row['last_name']." ".$sch_report_row['first_name'];
						$pdf->Cell(50,10,'',0,1,0);
						$pdf->Cell(78,10,'Student ID: '.$username,0,0,'C');
						$pdf->Cell(40,10,'CLASS: '.$level,0,1,'R');
						$pdf->Cell(40,10,'Receipt Num: '.$id,0,1,'R');
						$pdf->Cell(30,10,'First Name',1,0,'C');
						$pdf->Cell(30,10,'Last Name',1,0,'C');
						$pdf->Cell(19,10,'Level',1,0,'C');
						$pdf->Cell(20,10,'Amount',1,0,'C');	
						$pdf->Cell(52,10,'Date Paid',1,1,'C');		
						}
						else {
					$pdf->Cell(52,10,'nothing dey',1,1,'C');
					}
					$pdf->Cell(30,10,$sch_report_row['first_name'],1,0,'C');
					$pdf->Cell(30,10,$sch_report_row['last_name'],1,0,'C');
					$pdf->Cell(19,10,$sch_report_row['level'],1,0,'C');
					$pdf->Cell(20,10,$sch_report_row['amount'],1,0,'C');
					$pdf->Cell(52,10,$sch_report_row['date'],1,1,'C');
					$pdf-> Output();
					unset($_SESSION['username']);
						
				}

				
else  {
	header("Location: ../events/pay_fess.php");
}


?>
<!DOCTYPE html>
	<html>
	<head>
		<title></title>
	</head>
	<body>
	
	</body>
	</html>	