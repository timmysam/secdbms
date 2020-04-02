
<?php 

require '../configs/config.php';
//require 'includes/form_handlers/staff_register_handler.php';
//require 'includes/form_handlers/staff_login_handlers.php';
if(isset($_SESSION['user_name'])){
		$username = $_SESSION['user_name'];
		$error_array= array();
	$fname="";
	$mname="";
	$lname="";
	$parent_mobile="";
	$date= "";
	$house_num="";
	$street="";
	$city="";
	$section="";
	$level ="";
	$error_array= array();

	if (isset($_POST['sub_button'])){

		$fname=strip_tags($_POST['reg_fname']);
		$fname=str_replace(' ', '', $fname );
		$fname=ucfirst(strtolower($fname));
		$_SESSION['reg_fname'] = $fname;


		//last name
		$lname=strip_tags($_POST['reg_lname']);
		$lname=str_replace(' ', '', $lname );
		$lname=ucfirst(strtolower($lname));
		$_SESSION['reg_lname'] = $lname;
		
		$term = $_POST['term'];
		if($term =="Term"){
			array_push($error_array, "Kindly select the appropriate term<br>");
		}
		$mname = strip_tags($_POST['mname']);
	    $mname = str_replace( " ", "", "$mname");
	    $mname = ucfirst(strtolower("$mname"));
	    $_SESSION['mname'] = $mname;

	    $parent_mobile = $_POST['parent_mobile'];

	    $section =$_POST['section'];
	    if($section == 'Section'){
	    	array_push($error_array, "Kindly input the appropriate Section<br>");
	    }
	    $level = $_POST['level'];
	    if($level == 'select class'){
	    	array_push($error_array, "Kindly select the appropriate Class/level<br>");
	    }
		
		$house_num=($_POST['house_num']);
		$_SESSION['house_num'] = $house_num;

		$street=($_POST['street']);
		$_SESSION['street'] = $street;

		$city=($_POST['city']);
		$_SESSION['city'] = $city;
		$address = $house_num." ".$street." ".$city;

		$date = date("Y-m-d H:i:s");
		
		$ydob = $_POST['ydob'];
		if($ydob =="Year"){
			array_push($error_array, "Kindly input the value for Year, Month and Day<br>");
		}

	    $mdob = $_POST['mdob'];
	    if($mdob =="month"){
			array_push($error_array, "Kindly input the value for Year, Month and Day<br>");
		}
		$ddob = $_POST['ddob'];
	    	if($ddob =="day"){
				array_push($error_array, "Kindly input the value for Year, Month and Day<br>");
			}
	    $dob = $ydob."-".$mdob."-".$ddob;
	    
	   
	    $username = $ydob."_".$lname."_".$fname."_".$ddob;
	    $user_query = mysqli_query($con, "SELECT * from student_table WHERE username='$username'");
	    $check_username = mysqli_num_rows($user_query);
	    if($check_username !=0){
	    	array_push($error_array, "You have been registered before<br>");
	    }

	    $date = date("Y-m-d H:i:sa");
	  

		$date = date("Y-m-d h:i:sa");
		if ( strlen($fname) > 25 || strlen($fname) < 2 ){
			array_push($error_array, " Your First name should be between 2 to 25 character<br>");

		}
		if ( strlen($lname) > 25 || strlen($lname) < 2 ){
			array_push($error_array, " Your Last name should be between 4 to 25 character<br>");

		}

		if ( strlen($mname) > 25 || strlen($mname) < 2 ){
			array_push($error_array, " Your Middle name should be between 4 to 25 character<br>");

		}

		if(empty($error_array)){
			$query = mysqli_query($con, "INSERT INTO student_table VALUES
				('', '$fname', '$mname','$lname', '$parent_mobile','$address','$dob','$username',
				'$term','$section','$level','$date','','','')");

			array_push($error_array, "<span style='color: #14C800;'>You have been registered as</span><br>");

			//Clear session variables 
		
			$_SESSION['reg_fname'] = "";
		
			$_SESSION['reg_lname'] = "";

			$_SESSION['mname'] = "";

			$_SESSION['reg_email2'] = "";

			$_SESSION['street'] = "";

			$_SESSION['house_num'] = "";

			$_SESSION['city'] = "";


		}
	
	}

	}
	else{
		header("Location:../index.php");
	}

?>

<html>

<head>
	<title>Student Registration</title>
	<link rel="stylesheet" type="text/css" href="../css/stud_registration.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="scripts/register.js"></script> 

</head>
<body>


	<div class="wrapper">
		<div class = "login_box">
			<div class ="login_header">
				<h1> SaMizpah's DBMS 4 Schools </h1>

				Register Your Student !
			</div>
			
			<div id="second">
				<section calss="reg_table">
				
				<form action ="stud_registration.php" method="POST">
					
					<?php
						if(in_array(" Your Firt name should be between 2 to 25 character<br>", $error_array)) echo " Your Firt name should be between 2 to 25 character<br>";
						elseif (in_array("<span style='color: #14C800;'>You have been registered as</span><br>",
						 $error_array)) echo "<span style='color: #14C800;'>You have been registered as " .$username."</span><br>";
						elseif(in_array("You have been registered before<br>", $error_array))
							echo "You have been registered before<br>"; 
						
					?>
					<input type="text" name="reg_fname" placeholder="First name" value="<?php
					if(isset($_SESSION['reg_fname'])){
						echo $_SESSION['reg_fname'];
					}?>" required="" size="20"/>
					<br>
					<?php
						if(in_array(" Your Middle name should be between 4 to 25 character<br>", $error_array)) echo " Your Middle name should be between 4 to 25 character<br>";
					?>
					<input type="text" name="mname" placeholder="Middle name" value="<?php
					if(isset($_SESSION['mname'])){
						echo $_SESSION['mname'];
					}?>" required="" size="20"/>
					<br>
					<?php
						if(in_array(" Your Last name should be between 4 to 25 character<br>", $error_array)) echo " Your Last name should be between 4 to 25 character<br>";
					?>
					<input type="text" name="reg_lname" placeholder="Last name" value="<?php
					if(isset($_SESSION['reg_lname'])){
						echo $_SESSION['reg_lname'];
					}?>"required="" size="20"/>
					<br>
					<?php
						if(in_array("Kindly input the value for Year, Month and Day<br>", $error_array)) 
							echo "Kindly input the value for Year, Month and Day<br>";
							elseif (in_array("kindly input a month<br>", $error_array)) echo"kindly input a month<br>"; 
								elseif (in_array("kindly input a day<br>", $error_array)) echo"kindly input a day<br>";
									elseif (in_array("kindly input a year<br>", $error_array)) echo"kindly input a year<br>";
					?>

					<div class="mydob">
						DOB:
				          <select size="1" name="ydob" value="Year" required="" size="20"/>
				          <option>Year</option>
				          <option>1910</option>
				          <option>1911</option>
				          <option>1912</option>
				          <option>1913</option>
				          <option>1914</option>
				          <option>1915</option>
				          <option>1916</option>
				          <option>1917</option>
				          <option>1918</option>
				          <option>1919</option>
				          <option>1920</option>
				          <option>1921</option>
				          <option>1922</option>
				          <option>1923</option>
				          <option>1924</option>
				          <option>1925</option>
				          <option>1926</option>
				          <option>1927</option>
				          <option>1928</option>
				          <option>1929</option>
				          <option>1930</option>
				          <option>1931</option>
				          <option>1932</option>
				          <option>1933</option>
				          <option>1934</option>
				          <option>1935</option>
				          <option>1936</option>
				          <option>1937</option>
				          <option>1938</option>
				          <option>1939</option>
				          <option>1940</option>
				          <option>1941</option>
				          <option>1942</option>
				          <option>1943</option>
				          <option>1944</option>
				          <option>1945</option>
				          <option>1946</option>
				          <option>1947</option>
				          <option>1948</option>
				          <option>1949</option>
				          <option>1950</option>
				          <option>1951</option>
				          <option>1952</option>
				          <option>1953</option>
				          <option>1954</option>
				          <option>1955</option>
				          <option>1956</option>
				          <option>1957</option>
				          <option>1958</option>
				          <option>1959</option>
				          <option>1960</option>
				          <option>1961</option>
				          <option>1962</option>
				          <option>1963</option>
				          <option>1964</option>
				          <option>1965</option>
				          <option>1966</option>
				          <option>1967</option>
				          <option>1968</option>
				          <option>1969</option>
				          <option>1970</option>
				          <option>1971</option>
				          <option>1972</option>
				          <option>1973</option>
				          <option>1974</option>
				          <option>1975</option>
				          <option>1976</option>
				          <option>1977</option>
				          <option>1978</option>
				          <option>1979</option>
				          <option>1980</option>
				          <option>1981</option>
				          <option>1982</option>
				          <option>1982</option>
				          <option>1983</option>
				          <option>1984</option>
				          <option>1985</option>
				          <option>1986</option>
				          <option>1987</option>
				          <option>1988</option>
				          <option>1989</option>
				          <option>1990</option>
				          <option>1991</option>
				          <option>1992</option>
				          <option>1993</option>
				          <option>1994</option>
				          <option>1995</option>
				          <option>1996</option>
				          <option>1997</option>
				          <option>1998</option>
				          <option>1999</option>
				          <option>2000</option>
				          <option>2001</option>
				          <option>2002</option>
				          <option>2003</option>
				          <option>2004</option>
				          <option>2005</option>
				          <option>2006</option>
				          <option>2007</option>
				          <option>2008</option>
				          <option>2009</option>
				          <option>2010</option>
				          <option>2011</option>
				          <option>2012</option>
				          <option>2013</option>
				          <option>2014</option>
				          <option>2015</option>
				          <option>2016</option>
				          <option>2017</option>
				          <option>2018</option>
				          <option>2019</option>
				          <option>2020</option>
				          </select>
				          <select size="1" name="mdob" value="month">
				          <option>month</option>
				           <option>01</option>
				           <option>02</option>
				           <option>03</option>
				           <option>04</option>
				           <option>05</option>
				           <option>06</option>
				           <option>07</option>
				           <option>08</option>
				           <option>09</option>
				           <option>10</option>
				           <option>11</option>
				           <option>12</option>
				          </select>
				          <select size="1" name="ddob" value="date">
				           <option>day</option>
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
				           <option>16</option>
				           <option>17</option>
				           <option>18</option>
				           <option>19</option>
				           <option>20</option>
				           <option>21</option>
				           <option>22</option>
				           <option>23</option>
				           <option>24</option>
				           <option>25</option>
				           <option>26</option>
				           <option>27</option>
				           <option>28</option>
				           <option>29</option>
				           <option>30</option>
				           <option>31</option>
				         </select>

					</div>
					<input type="text" name ="parent_mobile" placeholder="Parent Mobile Number" >
					
					<br>
					<input type="text" name="house_num" placeholder="House Number" value="<?php
						if(isset($_SESSION['house_name'])){
							echo $_SESSION['house_name'];
						}

					?>"><br>
					<input type="text" name="street" placeholder="street" value="<?php
						if(isset($_SESSION['street'])){
							echo $_SESSION['street'];
						}

					?>"><br>
					<input type="text" name="city" placeholder="City" value="<?php
						if(isset($_SESSION['city'])){
							echo $_SESSION['city'];
						}

					?>"><br>
					<select name="state" class="state">
						  <option value="">State</option>
		                  <option value="Abia">Abia</option>
		                  <option value="Adamawa">Adamawa</option>
		                  <option value="Akwa Ibom">Akwa Ibom</option>
		                  <option value="Anambra">Anambra</option>
		                  <option value="Bauchi">Bauchi</option>
		                  <option value="Bayelsa">Bayelsa</option>
		                  <option value="Benue">Benue</option>
		                  <option value="Borno">Borno</option>
		                  <option value="Cross River">Cross River</option>
		                  <option value="Delta">Delta</option>
		                  <option value="Ebonyi">Ebonyi</option>
		                  <option value="Edo">Edo</option>
		                  <option value="Ekiti">Ekiti</option>
		                  <option value="Enugu">Enugu</option>
		                  <option value="Gombe">Gombe</option>
		                  <option value="Imo">Imo</option>
		                  <option value="Jigawa">Jigawa</option>
		                  <option value="Kaduna">Kaduna</option>
		                  <option value="Kano">Kano</option>
		                  <option value="Katsina">Katsina</option>
		                  <option value="Kebbi">Kebbi</option>
		                  <option value="Kogi">Kogi</option>
		                  <option value="Kwara">Kwara</option>
		                  <option value="Lagos">Lagos</option>
		                  <option value="Nasarawa">Nasarawa</option>
		                  <option value="Niger">Niger</option>
		                  <option value="Ogun">Ogun</option>
		                  <option value="Ondo">Ondo</option>
		                  <option value="Osun">Osun</option>
		                  <option value="Oyo">Oyo</option>
		                  <option value="Plateau">Plateau</option>
		                  <option value="Rivers">Rivers</option>
		                  <option value="Sokoto">Sokoto</option>
		                  <option value="Taraba">Taraba</option>
		                  <option value="Yobe">Yobe</option>
		                  <option value="Zamfara">Zamfara</option>
		                  <option value="Abuja">Abuja</option>
					</select>
					<br>
					<?php
						if(in_array("Kindly input the appropriate Section<br>", $error_array))
							echo "Kindly input the appropriate Section<br>";
						elseif (in_array("Kindly select the appropriate Class/level<br>",$error_array))	
							echo "Kindly select the appropriate Class/level<br>";


					?>
					<?php
						if(in_array("Kindly select the appropriate term<br>", $error_array))
							echo "Kindly select the appropriate term<br>";

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
						</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="term">
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
					<input type ="submit" name="sub_button" value="Register" > 
					<br>
					<?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) 
						echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; 
					?>
			</form>
			</div>
			<a href="../events/profile.php">Back</a>
		</div>
		
	</div>

</body>
</html>