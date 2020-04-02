
<?php  
require 'configs/config.php';

//require 'includes/form_handlers/staff_register_handler.php';
//require 'includes/form_handlers/staff_login_handlers.php';
	
	$error_array= array();
	$my_username="";
	$fname="";
	$lname="";
	$email="";
	$email2="";
	$pword="";
	$pword2="";
	$date= "";
	$house_num="";
	$street="";
	$city="";
	$user_name="";
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
		

		$mname = strip_tags($_POST['mname']);
	    $mname = str_replace( " ", "", "$mname");
	    $mname = ucfirst(strtolower("$mname"));
	    $_SESSION['mname'] = $mname;
	    
		$email=strip_tags($_POST['reg_email']);
		$email=str_replace(' ', '', $email);
		$email=ucfirst(strtolower($email));
		$_SESSION['reg_email'] = $email;
		//email2
		$email2=strip_tags($_POST['reg_email2']);
		$email2=str_replace(' ', '', $email2);
		$email2=ucfirst(strtolower($email2));
		$_SESSION['reg_email2'] = $email2;

		$house_num=($_POST['house_num']);
		$_SESSION['house_num'] = $house_num;

		$street=($_POST['street']);
		$_SESSION['street'] = $street;

		$city=($_POST['city']);
		$_SESSION['city'] = $city;

		$qualification = $_POST['qualification'];
		if($qualification =="select"){
			array_push($error_array, "Select your highest qualification<br>");
		}
		
		
		$address = $house_num." ".$street." ".$city;
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
	   

	    $user_query = mysqli_query($con, "SELECT user_name from staff_table WHERE user_name='$username'");
	    $check_username = mysqli_num_rows($user_query);
	    if($check_username !=0){
	    	array_push($error_array, "You have been registered before<br>");
	    }

	    $date = date("Y-m-d H:i:sa");
	   

		//password
		$pword=strip_tags($_POST['rpword']);
		$pword=ucfirst(strtolower($pword));
		//password
		$pword2=strip_tags($_POST['pword2']);

		$pword2=ucfirst(strtolower($pword2));

		$date = date("Y-m-d h:i:sa");
	if($email==$email2){

			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$email = filter_var($email, FILTER_VALIDATE_EMAIL);
				$check_email_query = mysqli_query($con, "SELECT email FROM staff_table WHERE email='$email'");
				$email_check= mysqli_num_rows($check_email_query);
				If ($email_check !=0 ){
					array_push($error_array, "Kindly note that this email exist already<br>");
				}
						
			}

			else{
				array_push($error_array, "Enter a Valid Email<br>");
			}

		}
		
		else{
				array_push($error_array, "Email does not matche<br>");
			} 
		if ( strlen($fname) > 25 || strlen($fname) < 2 ){
			array_push($error_array, " Your Firt name should be between 2 to 25 character<br>");

		}
		if ( strlen($lname) > 25 || strlen($lname) < 2 ){
			array_push($error_array, " Your Last name should be between 4 to 25 character<br>");

		}

		if ( strlen($mname) > 25 || strlen($mname) < 2 ){
			array_push($error_array, " Your Middle name should be between 4 to 25 character<br>");

		}

		if ($pword!==$pword2){
			array_push($error_array, "Your password do not match<br>");
		}
		else {
			if(preg_match('/[^A-Za-z0-9]/', $pword)){
				array_push($error_array, 
					"Your password can only contain English character or numbers<br>");	
			}
		}
		if(strlen($pword) > 25 || strlen($pword) < 5 ){
			array_push($error_array, "Your password should between 5 and 25 character<br>");
										
		}
		if(empty($error_array)){
			$pword = md5 ($pword);
			$query = mysqli_query($con, "INSERT INTO staff_table VALUES 
				('', '$fname','$mname','$lname','$dob', '$username', '$address','$email', 
					 '$qualification','$pword', '$date','','')");
			

			//Clear session variables 
			$_SESSION['reg_fname'] = "";
		
			$_SESSION['reg_lname'] = "";

			$_SESSION['mname'] = "";
		
			$_SESSION['reg_email'] = "";
		
			$_SESSION['reg_email2'] = "";

			$_SESSION['street'] = "";

			$_SESSION['house_num'] = "";

			$_SESSION['city'] = "";

			//array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");
			$done_query = mysqli_query($con,"SELECT * FROM staff_table WHERE user_name='$username'");
			$done_no = mysqli_fetch_array($done_query);
			$user_name = $done_no['user_name'];
			
		
			// LINK TO PDF PAGE CONTAINING YOUR USER NAME

			$_SESSION['user_name'] = $user_name;
			header("Location: report/my_teacher.php");
			exit();

			

		}
	
	}

	
?>

<html>

<head>
	<title>Samizpah</title>
	<link rel="stylesheet" type="text/css" href="css/staff_registration.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="scripts/register.js"></script> 

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
				Kindly register!
			</div>
			
			<div id="second">
				<section calss="reg_table">
				
				<form action ="staff_registration.php" method="POST">
					<?php
						if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>",
						 $error_array)) echo "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>";

					?>
					
					<?php
						if(in_array(" Your Firt name should be between 2 to 25 character<br>", $error_array)) echo " Your Firt name should be between 2 to 25 character<br>";
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
					<?php
						if(in_array("You have been registered before<br>", $error_array)) echo"You have been registered before<br>";
							elseif (in_array("Enter a Valid Email<br>", $error_array)) echo"Enter a Valid Email<br>"; 
								elseif (in_array("Kindly note that this email exist already<br>", $error_array)) 
									echo"Kindly note that this email exist already<br>";
									elseif (in_array("Email does not matche<br>", $error_array)) echo"Email does not matche<br>";
					?>
					<input type="email" name="reg_email" placeholder="Enter email" value="<?php
					if(isset($_SESSION['reg_email'])){
						echo $_SESSION['reg_email'];
					}?>"required ="" size="20"/>
					<br>
					
					<input type="email" name="reg_email2" placeholder="Confirm email" value ="<?php
					if(isset($_SESSION['reg_email2'])){
						echo $_SESSION['reg_email2'];
					}?>"required ="" size="20"/>
					
					<br>
					
					<input type="text" name="house_num" placeholder="House Number" value="<?php
						if(isset($_SESSION['house_num'])){
							echo $_SESSION['house_num'];
						}

					?>" required=""><br>
					
					<input type="text" name="street" placeholder="street" value="<?php
						if(isset($_SESSION['street'])){
							echo $_SESSION['street'];
						}
					?>" required=""><br>
					<?php
						if(in_array("Kindly input a valid city name<br>", $error_array))
							echo "Kindly input a valid city name<br>";
					?>
					<input type="text" name="city" placeholder="City" value="<?php
						if(isset($_SESSION['city'])){
							echo $_SESSION['city'];
						}

					?>" required=""><br>
					<select name="state">
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
					<?php
						if(in_array("Select your highest qualification<br>", $error_array)){
							echo "Select your highest qualification<br>";

						}
					?>
					Qualification:<select name="qualification">
						<option>select</option>
						<option>ND</option>
						<option>HND</option>
						<option>BSc</option>
						<option>PGD</option>
						<option>MSc</option>
						<option>PHD</option>
					</select><br>
					<?php
						if(in_array("Your password do not match<br>", $error_array)) echo"Your password do not match<br>";
							elseif (in_array("Your password can only contain English character or numbers<br>", $error_array)) echo"Your password can only contain English character or numbers<br>"; 
								elseif (in_array("Your password should between 5 and 25 character<br>", 
									$error_array)) echo"Your password should between 5 and 25 character<br>";
					?>
					<input type="password" name="rpword" placeholder="Enter password" required ="" size="20"/>
					<br>
					<input type="password" name="pword2" placeholder="Confirm password" required >

					<br>
					<input type ="submit" name="sub_button" value="Register" > 
					<br>
					<?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) 
						echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; 
					?>
					<a href="login.php" id="signin" class"signin"> Already have an account? Login here!</a>
			</form>
			</div>
			<a href="index.php">Back to Home</a>
		</div>
		
	</div>

</body>
</html>