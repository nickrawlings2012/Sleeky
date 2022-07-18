<!--begins the title php variable assignment--->
<?php $title = "Sleeky--Meet Allies | Ample your opportunities";?>
<!---begins the php include or require script for the homeheader and footer menu-->
<?php include("inc/incfiles/homeheader.inc.php");
include("inc/incfiles/footer.inc.php");
?>

<?php
if(!isset($_SESSION["user_login"])) {
// checks if the user is not logged in
    echo "";
}
else
{
//logs in the user to the home page if the login details are correct
echo "<meta http-equiv=\"refresh\" content=\"0; url=home.php\">";
}
?>

<?php
$reg = @$_POST['reg'];
//declaring variables to prevent errors
$fn = ""; //First Name
$ln = ""; //Last Name
$un = ""; //Username
$em = ""; //Email
$em2 = ""; //Email 2
$pswd = ""; //Password
$pswd2 = ""; // Password 2
$d = ""; // Sign up Date
$u_check = ""; // Check if username exists
$e_check ="";//check if email exists
//registration form
$fn = strip_tags(@$_POST['fname']);
$ln = strip_tags(@$_POST['lname']);
$un = strip_tags(@$_POST['username']);
$em = strip_tags(@$_POST['email']);
$em2 = strip_tags(@$_POST['email2']);
$pswd = strip_tags(@$_POST['password']);
$pswd2 = strip_tags(@$_POST['password2']);
$d = date("D-M-Y"); // Year - Month - Day

if ($reg) {
if ($em==$em2) {
// Check if user already exists
$u_check = mysql_query("SELECT username FROM users WHERE username='$un'");
// Count the amount of rows where username = $un
$check = mysql_num_rows($u_check);
//check if email has been used
$e_check = mysql_query("SELECT email FROM users WHERE email='$em'");
//count the number of rows returned
$email_check = mysql_num_rows($e_check);
if ($check == 0) {
if ($email_check == 0){
//check all of the fields have been filed in
if ($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) {
// check that passwords match
if ($pswd==$pswd2) {
// check the maximum length of username/first name/last name does not exceed 25 characters
if (strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
echo "<div class='error3'>The maximum limit for username/first name/last name is 25 characters</div>";
}
else
{
// check the maximum length of password does not exceed 25 characters and is not less than 5 characters
if (strlen($pswd)>30||strlen($pswd)<5) {
echo "<div class='error3'>Your password must be between 5 and 30 characters long</div>";
}
else
{
//encrypt password and password 2 using md5 before sending to database
$pswd = md5($pswd);
$pswd2 = md5($pswd2);
$query = mysql_query("INSERT INTO users VALUES ('','','','','','$un','','$fn','$ln','$em','$pswd','$d','0','','','','','0','','0','','','','','','','','')");
die("<h2>Welcome to Sleeky</h2>Login to your account to get started ...");
} 
}
}
//error handling for user registration
else 
{
echo "<div class='error3'>Your passwords don't match!</div>";
}
}
else
{
echo "<meta http-equiv=\"refresh\" content=\"0; url=signUp.php\">";
}
}
else
{
echo "<div class='error3'>Sorry this Email is already taken</div>";
}
}
else
{

echo "<div class='error3'>Username already taken ...</div>";
}
}

else 
{
echo "<div class='error3'>Your E-mails don't match!</div>";
}
}

?>

<?php


//login script
if (isset($_POST["user_login"]) && isset($_POST["password_login"])) {
//the php pregfeplace function filters out unwanted characters
	$user_login = preg_replace('#[^A-Za-z0-9]#i','',$_POST["user_login"]); //filters everything in this field
	$password_login = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password_login"]); //filters everything in this field
	$md5password_login = md5($password_login);
	$sql = mysql_query("SELECT id FROM users WHERE username='$user_login' AND password= '$md5password_login' LIMIT 1"); //query the user
	
	
	//check if they really exist
	$userCount = mysql_num_rows($sql); //this counts the number of rows in the database
	if ($userCount == 1) {
		while ($row = mysql_fetch_array($sql)){
			$id = $row["id"];

}
			$_SESSION["id"] =$id;
			$_SESSION["user_login"] = $user_login;
			$_SESSION["password_login"] = $password_login;
			exit("<meta http-equiv=\"refresh\" content=\"0\">");
			} 
			else 
			{
			echo "<div class='error3'>Incorrect entries, please try again</div>";
			
		}
			
	}
?>
<!---begins the welcome div--->	 
<div id="welcome">
Welcome to Sleeky, <a href="signUp.php"><span style="color:green;">Join today...</span></a> Meet Allies, Ample your Opportunities
</div><!----ends the welcome div--->

<!---begins the welcome div--->	 
<div id="userlogin">
		<table>
			<tr>
				<td>
				<h2 style="color:#2F4444; font-size:22px">Already on Sleeky?</h2><hr /><br />
					<form action="index.php" method="post" name="form1" id="form1">
						<input type="text" size="25" title="Enter your username"  name="user_login" id="user_login" class="auto-clear" placeholder="Username"  /><br />
						<input type="password" size="25" name="password_login" id="password_login" placeholder="Password"  title="Enter your password" /><br />
						   <label id="remember">
						      <input type="checkbox"  value="1"  name="remember_me">
						         <span>Remember me</span><br />
						      </label>
						<input type="submit"  name="button" id="login" value="Login">
						
						
					</form>
				</td>
			
			</tr>
		</table>

</div><!---ends the userlogin div--->
<!--begins the sleeky_news div --->
<div class="sleeky_news">
<div id="news">
Sleeky News</div>
<div id="main_content"><br />
<a href="http://www.imafidons.com">WHY EVERY ONE IS A GENIUS<br />
by Dr. Chris Imafidon</a><br /><br />
<a href="http://www.imafidons.com"><img src="img/chris.jpg" width="100px" height="100px"></a>
</div><!---ends main_content div--->
</div><!---ends sleeky_news div--->
<!---begins the hometable div --->
<div id="hometable"> 
<table>
		<tr>
			<td>
			<h2 style="color:#2F4444;text-align:center; font-size:22px;"><b>Meet fantastic people in your field...</b></h2>
			<div id="slider">
			<img id="1" src="img/happy.png" alt="happy"/>
			<img id="2" src="img/MH900443443.png" alt="MH900443443"/>
			<img id="3" src="img/lawyers.png"  alt="work"/>
			<img id="5" src="img/happyblack1.jpg"  alt="happyblack1"/>
			<img id="6" src="img/enginers.png" alt="enginers"/>
			<img id="7" src="img/dancers.png" alt="dancers"/>
			</div>
			
			</td>
		</tr>
</table>
</div><!---ends hometable div --->

<div id="centertable">
<table>
        <tr>			
			<td>
			<h2 style="color:#2F4444; font-size:22px"><span style="color:green; font-weight:bold;">Sign Up Now</span>..it's FREE!</h2><hr /><br />
			<form action="index.php" method="post">
					<input type="text" size="25" name="fname" class="auto-clear" placeholder="First Name" > <br />
					<input type="text" size="25" name="lname" class="auto-clear" placeholder="Last Name" ><br />
					<input type="text" size="25" name="username" id="username" onblur="checkusername()" class="auto-clear" placeholder="Username" > <br />
					<span id="username_status"></span>
					<input type="text" id="email" size="25" name="email" class="auto-clear"  placeholder="Email" ><br />
					<div id="alert"><span id="email_feedback" ></span></div>
				     <input type="text" size="25" name="email2"  class="auto-clear"  placeholder="Repeat Email" ><br />
					<input type="password" size="25" name="password" placeholder="Password"  ><br />
					<input type="password" size="25" name="password2" placeholder="Repeat Password" ><br />
					<input type="submit"  name="reg" id="signup" value="Sign Up">
			</form>
			
			</td>
			
		</tr>

</table>
</div><!----ends centertable div--->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script type="text/javascript" src="js/slidein.js"></script>
<script type="text/javascript" src="js/swagga.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ui.js"></script>
<script type="text/javascript" src="js/fadein.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/username_check.js"></script>
</div><!--end mainWrapper-->
</div>
</body>
</html>
