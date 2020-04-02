<?php
require '../configs/config.php';
include"../fpdf181/fpdf.php";

	$error_array = array();
	$pdf_button ="";
	$term ="";
	$level="";
	$section= "";
	if(isset($_SESSION['user_name'])){
	$username = $_SESSION['user_name'];
		$date = date("Y-M-D h:i:s");
	if(isset($_POST['pdf_button'])){

	$level = $_POST['level'];
	$term = $_POST['term'];

	$section = $_POST['section'];

	$picktype = $_POST['picktype'];

	if($picktype =="pick"){
		array_push($error_array, "Kindly input the appropriate term<br>");
	}

	IF($section =='Section'){
		array_push($error_array, "Kindly input the right section<br>");
	}
	if($level=='Select class'){
		array_push($error_array, "Kindly input the appropriate Class<br>");
	}
	if($term=='Term'){
		array_push($error_array, "Kindly input the appropriate term<br>");
	}

	if	($term=="First term" AND $picktype=="Test") {
		$my_CA1 = "first_test_first_term";
		$my_CA2 = "second_test_first_term";
		$my_hwork = "assignment_first_term";
		$my_total = "first_term_ca_total";
	}

	elseif ($term=="Second term" AND $picktype=="Test") {
		$my_CA1 = "first_test_second_term";
		$my_CA2 = "second_test_second_term";
		$my_hwork = "assignment_second_term";
		$my_total = "second_term_ca_total";
	}
	elseif ($term=="Third term" AND $picktype=="Test") {
					$my_CA1 = "first_test_third_term";
					$my_CA2 = "second_test_third_term";
					$my_hwork = "assignment_third_term";
					$my_total = "third_term_ca_total";
					$theterm="third_term_total";
				}

	if($term=="First term" AND $picktype=="Exam"){
		$my_CA1 = "first_test_first_term";
		$my_CA2 = "second_test_first_term";
		$my_hwork = "assignment_first_term";
		$my_total = "first_term_ca_total";
		$theterm="first_term_total";
	}

	elseif ($term=="Second term" AND $picktype=="Exam") {
		$my_CA1 = "first_test_second_term";
		$my_CA2 = "second_test_second_term";
		$my_hwork = "assignment_second_term";
		$my_total = "second_term_ca_total";
		$theterm="second_term_total";
	}

	elseif ($term=="Third term" AND $picktype=="Exam") {
		$my_CA1 = "first_test_third_term";
		$my_CA2 = "second_test_third_term";
		$my_hwork = "assignment_third_term";
		$my_total = "third_term_ca_total";
		$theterm="third_term_total";
	}

	switch ($level) 
	{
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

			if($picktype=="Test"){

				class myPDF extends FPDF{

					function header(){
						//$this->SetY(5);
						$this->Image('../images/Samizpah ENT.png',-35,-45,'C');
						$this->Ln(5);
						$this->SetFont('Arial','B',16);
						$this->SetTextColor(0, 51, 0);
						$this->cell(0,5,'Samizpah Enterprice DBMS',0,0,'C');
						$this->Ln();
						$this->SetFont('Times', '', 10);
						$this->Cell(0,10, 'no 3, Maryl Land cresenct, Mary Land-Lagos',0,1,'C');
						$this->cell(0,10, 'email: samizpahenterprice@gmail.com  mobile: 08100002989',0,0,'C');
						$this->Ln(30);
						$this->SetFont('Arial', '', 14);
						$this->SetTextColor(0, 0, 0);
						$this->Cell(0,10, 'Report Card', 0, 1,'C');
						$this->SetDrawColor(0,51,0);
						$this->SetLineWidth(1);
						$this->Line(10, 52, 200, 52);
						$this->Cell(10);
					}

					function footer(){
						$this->SetY(-15);
						$this->SetFont('Arial','', 8);
						$this->Cell(10,10,'Page '.$this->PageNo().'{/nb}', 0,0,'c');
					}	

				}
				
				
				$pdf = new myPDF();
				$pdf-> AliasNbPages();
				$pdf-> AddPage();
				$pdf->SetFont('Times','B',12);
					$user_query = mysqli_query($con, "SELECT first_name,last_name,user_name,section, term, subject,$my_CA1,$my_CA2,$my_hwork,$my_total  from $leveldb order by user_name");
				    $check_username = mysqli_num_rows($user_query);

					    $s=0;
					    $stud_name = NULL;
					    WHILE( $s < $check_username){
							$view_row = mysqli_fetch_array($user_query);
							$first_name = $view_row['first_name'];
							$last_name = $view_row['last_name'];
							$user_name = $view_row['user_name'];
							$ca_total = $view_row[$my_total];
							$my_name =$view_row['last_name']." ".$view_row['first_name'];
							if($stud_name!=$my_name){
								$pdf->Cell(50,10,'',0,1,0);
								$pdf->Cell(50,10,'Name of Student: '.$my_name,0,0,'L');
								$pdf->Cell(120,10,'Student ID: '.$user_name,0,1,0);
								$pdf->Cell(50,10,'CLASS: '.$level,0,0,'L');
								$pdf->Cell(60,10,'Number in Class: '.$check_username,0,0,'C');
								$pdf->Cell(150,10,'    '.$date,0,1,'0');
								$pdf->Cell(57,10,'SUBJECTS',1,0,'C');
								$pdf->Cell(25,10,'H.Work(10)',1,0,'C');
								$pdf->Cell(20,10,'CA1(15)',1,0,'C');
								$pdf->Cell(20,10,'CA1(15)',1,0,'C');
								$pdf->Cell(25,10,'TOTAL(40)',1,0,'C');
								$pdf->Cell(39,10,'Remark',1,1,'C');	
							}
							$subject = $view_row['subject'];
							$section = $view_row['section'];
							$term = $view_row['term'];
							$CA1 = $view_row[$my_CA1];
							$CA2 = $view_row[$my_CA2];
							$h_work = $view_row[$my_hwork];
							$ca_total = $view_row[$my_total];
							$ca_total = $CA1 + $CA2 + $h_work;
							$scores_pecent = $ca_total/40;
							$my_scores_pecent = $scores_pecent * 100;
							if($my_scores_pecent >= 75){
								$remark = "DISTINCTION";
							}
							elseif($my_scores_pecent >= 65){
								$remark = "EXCELLENT";
							}
							elseif($my_scores_pecent >= 55){
								$remark = "GOOD";
							}
							elseif($my_scores_pecent >= 40){
								$remark = "FAIR";
							}
							else{
								$remark = "FAIL";
							}
								$pdf->Cell(57,10,$view_row['subject'],1,0,'C');
								$pdf->Cell(25,10,$view_row[$my_hwork],1,0,'C');
								$pdf->Cell(20,10,$view_row[$my_CA1],1,0,'C');
								$pdf->Cell(20,10,$view_row[$my_CA2],1,0,'C');
								$pdf->Cell(25,10,$ca_total,1,0,'C');
								$pdf->Cell(39,10,$remark,1,1,'C');
								

							$s++;
							$stud_name = $my_name;
						}
				$pdf-> Output();

			
			}
			elseif($picktype=="Exam" AND  $term =="First term") {
				$exam1 ="first_term_exam";
				$f_ca_exam ="first_term_total";
				class myPDF extends FPDF{

					function header(){
						$this->SetY(5);
						$this->Image('../images/Samizpah ENT.png',-35,-45,'C');
						$this->Ln(5);
						$this->SetTextColor(0, 51, 0);
						$this->SetFont('Arial','B',16);
						$this->cell(0,5,'Samizpah Enterprice DBMS',0,0,'C');
						$this->Ln();
						$this->SetFont('Times', '', 10);
						$this->Cell(0,10, 'no 3, Maryl Land cresenct, Mary Land-Lagos',0,1,'C');
						$this->cell(0,10, 'email: samizpahenterprice@gmail.com  mobile: 08100002989',0,0,'C');
						$this->Ln(30);
						$this->SetFont('Arial', '', 14);
						$this->SetTextColor(0, 0, 0);
						$this->Cell(0,10, 'FIRST TERM REPORT', 0, 1,'C');
						$this->SetDrawColor(0,51,0);
						$this->SetLineWidth(1);
						$this->Line(10, 52, 200, 52);
						$this->Cell(10);

					}

					function footer(){
						$this->SetY(-15);
						$this->SetFont('Arial','', 8);
						$this->Cell(0,10,'Page '.$this->PageNo().'{/nb}', 0,0,'c');
					}	

				}
				$pdf = new myPDF('L');
				$pdf-> AliasNbPages();
				$pdf-> AddPage();
				$pdf->SetFont('Times','B',12);
				$get_total = mysqli_query($con, "SELECT count(Distinct user_name) as pos From $leveldb");
				$get_total_rows = mysqli_fetch_array($get_total);
				$pos = $get_total_rows['pos'];
					$user_query = mysqli_query($con, "SELECT first_name,last_name,user_name,section,position, term, subject,$my_CA1,$my_CA2,$my_hwork,$my_total,$exam1,$f_ca_exam   
						from $leveldb order by user_name");
				    $check_username = mysqli_num_rows($user_query);

					    $s=0;
					    $stud_name = NULL;
					    WHILE( $s < $check_username){
							$view_row = mysqli_fetch_array($user_query);
							$first_name = $view_row['first_name'];
							$last_name = $view_row['last_name'];
							$user_name = $view_row['user_name'];
							$position = $view_row['position'];
							$ca_total = $view_row[$my_total];
							$my_name =$view_row['last_name']." ".$view_row['first_name'];
							if($stud_name!=$my_name){
								$pdf->Cell(50,10,'',0,1,0);
								$pdf->Cell(55,10,'Name of Student: '.$my_name,0,0,'L');
								$pdf->Cell(120,10,'Student ID: '.$user_name,0,1,0);
								$pdf->Cell(50,10,'CLASS: '.$level,0,0,'L');
								$pdf->Cell(60,10,'Number in Class: '.$pos,0,0,'C');
								$pdf->Cell(150,10,'    '.$date,0,1,'0');
								$pdf->Cell(37,10,'SUBJECTS',1,0,'C');
								$pdf->Cell(25,10,'H.Work(10)',1,0,'C');
								$pdf->Cell(20,10,'CA1(15)',1,0,'C');
								$pdf->Cell(20,10,'CA1(15)',1,0,'C');
								$pdf->Cell(25,10,'T.CA(40)',1,0,'C');
								$pdf->Cell(20,10,'Exam(60)',1,0,'C');
								$pdf->Cell(14,10,'Total',1,0,'C');
								$pdf->Cell(23,10,'POSITION',1,0,'C');
								$pdf->Cell(39,10,'Remark',1,1,'C');		
							}
							$subject = $view_row['subject'];
							$section = $view_row['section'];
							$term = $view_row['term'];
							$CA1 = $view_row[$my_CA1];
							$CA2 = $view_row[$my_CA2];
							$h_work = $view_row[$my_hwork];
							$ca_total = $view_row[$my_total];
							$my_exam1 = $view_row[$exam1];
							$f_tt = $ca_total +$my_exam1;
							$f_ca_exam1 = $view_row[$f_ca_exam];

							if($f_ca_exam1 >= 75){
								$remark = "DISTINCTION";
							}
							elseif($f_ca_exam1 >= 65){
								$remark = "EXCELLENT";
							}
							elseif($f_ca_exam1 >= 55){
								$remark = "GOOD";
							}
							elseif($f_ca_exam1 >= 40){
								$remark = "FAIR";
							}
							elseif($f_ca_exam1 >= 0){
								$remark = "FAIL";
							}
								$pdf->Cell(37,10,$view_row['subject'],1,0,'C');
								$pdf->Cell(25,10,$view_row[$my_hwork],1,0,'C');
								$pdf->Cell(20,10,$view_row[$my_CA1],1,0,'C');
								$pdf->Cell(20,10,$view_row[$my_CA2],1,0,'C');
								$pdf->Cell(25,10,$ca_total,1,0,'C');
								$pdf->Cell(20,10,$my_exam1,1,0,'C');
								$pdf->Cell(14,10,$f_tt,1,0,'C');
								$pdf->Cell(23,10,$position."/".$pos,1,0,'C');
								$pdf->Cell(39,10,$remark,1,1,'C');
								$stud_name = $my_name;

							$s++;

						}
				$pdf-> Output();

			}
			elseif($picktype=="Exam" AND  $term =="Second term"){
				$exam1 ="second_term_exam";
				$f_ca_exam ="second_term_total";
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
						$this->Cell(0,10, 'no 3, Maryl Land cresenct, Mary Land-Lagos',0,1,'C');
						$this->cell(0,10, 'email: samizpahenterprice@gmail.com  mobile: 08100002989',0,0,'C');
						$this->Ln(30);
						$this->SetFont('Arial', '', 14);
						$this->SetTextColor(0, 0, 0);
						$this->Cell(0,10, 'SECOND TERM REPORT', 0, 1,'C');
						$this->SetDrawColor(0,51,0);
						$this->SetLineWidth(1);
						$this->Line(10, 52, 200, 52);
						$this->Cell(10);
					}

					function footer(){
						$this->SetY(-15);
						$this->SetFont('Arial','', 8);
						$this->Cell(0,10,'Page '.$this->PageNo().'{/nb}', 0,0,'c');
					}	

				}
				$pdf = new myPDF('L');
				$pdf-> AliasNbPages();
				$pdf-> AddPage();
				$pdf->SetFont('Times','B',12);
				$get_total = mysqli_query($con, "SELECT count(Distinct user_name) as pos From $leveldb");
				$get_total_rows = mysqli_fetch_array($get_total);
				$pos = $get_total_rows['pos'];

					$user_query = mysqli_query($con, "SELECT first_name,last_name,user_name,section, position, term, subject,$my_CA1,$my_CA2,$my_hwork,$my_total,$exam1,$f_ca_exam,first_term_total,
					      second_term_ave_scores 
					      from $leveldb order by user_name");
				    $check_username = mysqli_num_rows($user_query);

					    $s=0;
					    $stud_name = NULL;
					    WHILE( $s < $check_username){
							$view_row = mysqli_fetch_array($user_query);
							$first_name = $view_row['first_name'];
							$f_t_t= $view_row['first_term_total'];
							$position = $view_row['position'];
							$last_name = $view_row['last_name'];
							$user_name = $view_row['user_name'];
							//$pos = $view_row['pos'];
							$ca_total = $view_row[$my_total];
							$my_name =$view_row['last_name']." ".$view_row['first_name'];
							if($stud_name!=$my_name){
								$pdf->Cell(50,10,'',0,1,0);
								$pdf->Cell(55,10,'Name of Student: '.$my_name,0,0,'L');
								$pdf->Cell(120,10,'Student ID: '.$user_name,0,1,0);
								$pdf->Cell(50,10,'CLASS: '.$level,0,0,'L');
								$pdf->Cell(60,10,'Number in Class: '.$pos,0,0,'C');
								$pdf->Cell(150,10,'    '.$date,0,1,'0');
								$pdf->Cell(40,10,'SUBJECTS',1,0,'C');
								$pdf->Cell(13,10,'F.T.T',1,0,'C');
								$pdf->Cell(16,10,'H.W(10)',1,0,'C');
								$pdf->Cell(19,10,'CA1(15)',1,0,'C');
								$pdf->Cell(19,10,'CA2(15)',1,0,'C');
								$pdf->Cell(20,10,'T.CA(40)',1,0,'C');
								$pdf->Cell(17,10,'Exam(60)',1,0,'C');
								$pdf->Cell(12,10,'Total',1,0,'C');
								$pdf->Cell(12,10,'AVE',1,0,'C');
								$pdf->Cell(23,10,'POSITION',1,0,'C');
								$pdf->Cell(30 ,10,'Remark',1,1,'C');		
							}
							$subject = $view_row['subject'];
							$section = $view_row['section'];
							$s_av_scores = $view_row['second_term_ave_scores'];
							$term = $view_row['term'];
							$CA1 = $view_row[$my_CA1];
							$CA2 = $view_row[$my_CA2];
							$h_work = $view_row[$my_hwork];
							$ca_total = $view_row[$my_total];
							$my_exam1 = $view_row[$exam1];
							$f_ca_exam2 =$view_row[$f_ca_exam];
							$f_ca_exam1 = $view_row['first_term_total'];

							if($f_ca_exam1 >= 75){
								$remark = "DISTINCTION";
							}
							elseif($f_ca_exam1 >= 65){
								$remark = "EXCELLENT";
							}
							elseif($f_ca_exam1 >= 55){
								$remark = "GOOD";
							}
							elseif($f_ca_exam1 >= 40){
								$remark = "FAIR";
							}
							elseif($f_ca_exam1 >= 0){
								$remark = "FAIL";
							}
								$pdf->Cell(40,10,$view_row['subject'],1,0,'C');
								$pdf->Cell(13,10,$view_row['first_term_total'],1,0,'C');
								$pdf->Cell(16,10,$view_row[$my_hwork],1,0,'C');
								$pdf->Cell(19,10,$view_row[$my_CA1],1,0,'C');
								$pdf->Cell(19,10,$view_row[$my_CA2],1,0,'C');
								$pdf->Cell(20,10,$view_row[$my_total],1,0,'C');
								$pdf->Cell(17,10,$view_row[$exam1],1,0,'C');
								$pdf->Cell(12,10,$view_row[$f_ca_exam],1,0,'C');
								$pdf->Cell(12,10,$s_av_scores,1,0,'C');
								$pdf->Cell(23,10,$position."/".$pos,1,0,'C');
								$pdf->Cell(30,10,$remark,1,1,'C');
								$stud_name = $my_name;

							$s++;

						}
				$pdf-> Output();

			}


			elseif($picktype=="Exam" AND  $term =="Third term"){
				$exam1 ="third_term_exam";
				$f_ca_exam ="third_term_total";
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
						$this->Cell(0,10, 'no 3, Maryl Land cresenct, Mary Land-Lagos',0,1,'C');
						$this->cell(0,10, 'email: samizpahenterprice@gmail.com  mobile: 08100002989',0,0,'C');
						$this->Ln(30);
						$this->SetFont('Arial', '', 14);
						$this->SetTextColor(0, 0, 0);
						$this->Cell(0,10, 'THIRD TERM REPORT', 0, 1,'C');
						$this->SetDrawColor(0,51,0);
						$this->SetLineWidth(1);
						$this->Line(10, 52, 200, 52);
						$this->Cell(10);
					}

					function footer(){
						$this->SetY(-15);
						$this->SetFont('Arial','', 8);
						$this->Cell(0,10,'Page '.$this->PageNo().'{/nb}', 0,0,'c');
					}	

				}
				$pdf = new myPDF('L');
				$pdf-> AliasNbPages();
				$pdf-> AddPage();
				$pdf->SetFont('Times','B',12);
				$get_total = mysqli_query($con, "SELECT count(Distinct user_name) as pos From $leveldb");
				$get_total_rows = mysqli_fetch_array($get_total);
				$pos = $get_total_rows['pos'];

					$user_query = mysqli_query($con, "SELECT first_name,last_name,user_name,section, position, term, subject,$my_CA1,$my_CA2,$my_hwork,$my_total,$exam1,$f_ca_exam,second_term_total,	first_term_total,third_term_ave_scores  
					      from $leveldb order by user_name");
				    $check_username = mysqli_num_rows($user_query);

					    $s=0;
					    $stud_name = NULL;
					    WHILE( $s < $check_username){
							$view_row = mysqli_fetch_array($user_query);
							$first_name = $view_row['first_name'];
							$f_t_t= $view_row['first_term_total'];
							$last_name = $view_row['last_name'];
							$user_name = $view_row['user_name'];
							$ca_total = $view_row[$my_total];
							$my_name =$view_row['last_name']." ".$view_row['first_name'];
							if($stud_name!=$my_name){
								$pdf->Cell(50,10,'',0,1,0);
								$pdf->Cell(55,10,'Name of Student: '.$my_name,0,0,'L');
								$pdf->Cell(120,10,'Student ID: '.$user_name,0,1,0);
								$pdf->Cell(50,10,'CLASS: '.$level,0,0,'L');
								$pdf->Cell(60,10,'Number in Class: '.$pos,0,0,'C');
								$pdf->Cell(150,10,'    '.$date,0,1,'0');
								$pdf->Cell(37,10,'SUBJECTS',1,0,'C');
								$pdf->Cell(13,10,'F.T.T',1,0,'C');
								$pdf->Cell(13,10,'S.T.T',1,0,'C');
								$pdf->Cell(16,10,'H.W(10)',1,0,'C');
								$pdf->Cell(19,10,'CA1(15)',1,0,'C');
								$pdf->Cell(19,10,'CA2(15)',1,0,'C');
								$pdf->Cell(20,10,'T.CA(40)',1,0,'C');
								$pdf->Cell(17,10,'Exam(60)',1,0,'C');
								$pdf->Cell(12,10,'Total',1,0,'C');
								$pdf->Cell(12,10,'AVE',1,0,'C');
								$pdf->Cell(23,10,'POSITION',1,0,'C');
								$pdf->Cell(30 ,10,'Remark',1,1,'C');		
							}
							$subject = $view_row['subject'];
							$section = $view_row['section'];
							$position = $view_row['position'];
							$s_av_scores = $view_row['third_term_ave_scores'];
							$term = $view_row['term'];
							$CA1 = $view_row[$my_CA1];
							$CA2 = $view_row[$my_CA2];
							$h_work = $view_row[$my_hwork];
							$ca_total = $view_row[$my_total];
							$my_exam1 = $view_row[$exam1];
							$second_term_total=$view_row['first_term_total'];
							$f_ca_exam2 =$view_row[$f_ca_exam];
							$f_ca_exam1 = $view_row['second_term_total'];

							if($f_ca_exam1 >= 75){
								$remark = "DISTINCTION";
							}
							elseif($f_ca_exam1 >= 65){
								$remark = "EXCELLENT";
							}
							elseif($f_ca_exam1 >= 55){
								$remark = "GOOD";
							}
							elseif($f_ca_exam1 >= 40){
								$remark = "FAIR";
							}
							elseif($f_ca_exam1 >= 0){
								$remark = "FAIL";
							}
								$pdf->Cell(37,10,$view_row['subject'],1,0,'C');
								$pdf->Cell(13,10,$view_row['first_term_total'],1,0,'C');
								$pdf->Cell(13,10,$view_row['second_term_total'],1,0,'C');
								$pdf->Cell(16,10,$view_row[$my_hwork],1,0,'C');
								$pdf->Cell(19,10,$view_row[$my_CA1],1,0,'C');
								$pdf->Cell(19,10,$view_row[$my_CA2],1,0,'C');
								$pdf->Cell(20,10,$view_row[$my_total],1,0,'C');
								$pdf->Cell(17,10,$view_row[$exam1],1,0,'C');
								$pdf->Cell(12,10,$view_row[$f_ca_exam],1,0,'C');
								$pdf->Cell(12,10,$s_av_scores,1,0,'C');
								$pdf->Cell(23,10,$position."/".$pos,1,0,'C');

								$pdf->Cell(30,10,$remark,1,1,'C');
								$stud_name = $my_name;

							$s++;

						}
				$pdf-> Output();

			}
}
}
else{
	header("Location:../index.php");
}


//}

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
				Generate Report Card!
			</div>
				<div id="first">
					<form action ="report_card.php" method="POST">
						<?php
							if(in_array("Kindly input the right section<br>", $error_array)) 
								echo "Kindly input the right section<br>";
							elseif (in_array("Kindly input the appropriate Class<br>", $error_array)) 
								echo "Kindly input the appropriate Class<br>";
							elseif (in_array("Kindly input the appropriate term<br>", $error_array)) 
								echo "Kindly input the appropriate term<br>";
							elseif (in_array("Kindly input the appropriate term<br>", $error_array)) 
								echo "Kindly input the appropriate term<br>";
						?>
						<select name ="picktype">
							<option>pick</option>
							<option>Test</option>
							<option>Exam</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name ="term">
							<option>Term</option>
							<option>First term</option>
							<option>Second term</option>
							<option>Third term</option>
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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