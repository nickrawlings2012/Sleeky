<?php 
$title = "Sleeky--Sign Up for Free";?>
<?php include("inc/incfiles/homeheader.inc.php");
include("inc/incfiles/footer.inc.php"); 
?>

<div id="welcome">
<span style="color:green;">Sign Up</span> today and meet people who know, people who share, people like you ...
</div>

<div class="fullbox">
<div id="full">

<?php
/*
$form =  "<form action='reg_msg.php' method='post'>
             <table>
			  <tr>
				<td></td>
				<td>Fields marked <font color='red' size='3'>[*]</font> are required</td>
			 </tr>
			 <tr>
				<td>First Name:</td>
				<td><input type='text' name='fname'><font color='red' size='3'>*</font></td>
			 </tr>	
			 <tr>
				<td>Last Name:</td>
				<td><input type='text' name='lname'><font color='red' size='3'>*</font></td>
			 </tr>
			 <tr>
				<td>Username:</td>
				<td><input type='text' name='username'><font color='red' size='3'>*</font></td>
			 </tr>
			 <tr>
				<td>Email:</td>
				<td><input type='text' name='email'><font color='red' size='3'>*</font></td>
			 </tr>
			 <tr>
			    <td>Repeat Email:</td>
				<td><input type='text' name='email2'><font color='red' size='3'>*</font></td>
			</tr>
			<tr>
			    <td>Password:</td>
				<td><input type='password' name='password'><font color='red' size='3'>*</font></td>
			</tr>	
			<tr>
			    <td>Repeat Password:</td>
				<td><input type='password' name='password2'><font color='red' size='3'>*</font></td>
			</tr>
			
			<tr>
			    <td></td>
				<td><input type='submit' name='reg' id='signup' value='Sign Up'></td>
			</tr>
			 
			 </table>
         			 

					</form>";
					
					
					$reg = @$_POST['reg'];
					if ($reg) {
					//the foloowing scripts inserts the respective values from the fields into the variables created
					//the strip_tags function ensures that users can't insert their own html or php codes into the form and hack the website or destroy it.
					//the post method gets the respective values 
					  $fn = strip_tags(@$_POST['fname']);
                       $ln = strip_tags(@$_POST['lname']);
                       $un = strip_tags(@$_POST['username']);
                       $em = strip_tags(@$_POST['email']);
                       $em2 = strip_tags(@$_POST['email2']);
                       $pswd = strip_tags(@$_POST['password']);
                       $pswd2 = strip_tags(@$_POST['password2']);
					 
					   $d = ""; // Sign up Date
                        $u_check = ""; // Check if username exists
                          $e_check ="";//check if email exists
					   
					   //the following if statements ensures that all the respective registration conditions are met
					   //to do this effectively we use the php if statements
					   if ($fn && $ln && $un && $em && $em2 && $pswd && $pswd2) {
					      if ($pswd == $pswd2) {
						    if ($em==$em2) {
							//this code checks if the email entered is valid
							  if (strstr($em, "@") && strstr($em, ".") && strlen($em) >= 6) {
							      include("inc/scripts/mysql_connect.inc.php");
								  //this code makes sure that the username created has not be taken and is not in the database
								  //this is done by creating a simple sql query
								  $u_check = mysql_query("SELECT username FROM users WHERE username='$un'");
                                // Count the amount of rows where username = $un
                                 $check = mysql_num_rows($u_check);
								  if ($check == 0) {
								  
								  
								   $required_query = mysql_query("SELECT * FROM users WHERE email='$em'");
								   $numrows = mysql_num_rows ($required_query);
								  if ($numrows == 0) {
								  $pswd = md5($pswd);
								  $pswd2 = md5($pswd2);
								  $date = date("F d, Y");
								  $d = date("Y-m-d");
								  //this generates a random code to activate the users' account in sleeky
								  $code = substr(md5(rand(1111111111, 99999999999999)), 2, 25);
								   //this mysql query inserts all the users' information into the database in the same order they were created in the database
								   // but to do this we need to make reference to the variables we created earlier on
								   $query = mysql_query("INSERT INTO users VALUES ('','','','','','$un','','$fn','$ln','$em','$pswd','$d','0','','','','','0','$code','0','','','','','','','','')");
								 
								 
								 
								          $webmaster = "admin@sleeky.net";
								          $subject = "Activate your sleeky account";
									      $message = "From: Sleeky<$webmaster>";
									      $headers = "Hello $fn. Welcome to Sleeky. Below is a link for your to activate your account
									       on Sleeky.net\n\n Click here to acvtivate your account:
									       http://www.sleeky.net/activate.php?code=$code";
									 
									       mail($email, $subject, $message, $headers);
										   
*/
<?php	
<div class='fullbox'>
<div id='full'>


								 
									 echo "<div class='success_msg'><div class='success_header'>Congrats Your Registration is Successfull!!!<br /><br /></div>Thank you for Joining Sleeky, Please go to your email and activate your account to complete
									 your registration through the activate email that has been sent to <b style='font-weight:bold;'>$email</b>. If you are having troubles activating your account Pls contact
									 <a href='mailto:admin@sleeky.net'>admin@sleeky.net</a></div>" ;

</div>
</div>
									 
										
?>										 
										 
									   
/**								   
								  }
								  
								  else "<div class='error3'>This Email is already taken. Please choose another. </div>";
								  }
								  else "<div class='error3'>Username already taken. Please choose another.</div>";
							  }
							  else"<div class='error3'>Your Email is invalid. Please try again. </div>";
							 
							}
							else
							echo"<div class='error3'>Your Emails did not match. Please try again.</div>";
						  }
						  else
						  echo "<div class='error3'>Your passwords did not match. Please try again.</div>";
					     
					   }
					   else
					   echo "<div class='error3'>Please fill in all the required fields.</div>";
					}
					
					
				echo "$form";
?>					
*/
					
