<?php $title = "Welcome to Sleeky--Activate your Sleeky account";?>
<?php include("inc/incfiles/homeheader.inc.php");
include("inc/incfiles/footer.inc.php"); ?>

<div id="welcome">
Welcome, you are just <span style="color:DarkGreen;">one</span> click away ...
</div>
<div class="fullbox">
<div id="full">

<?php

 $getcode = $_GET['code'];
   $form = "<form action='activate.php' method='post'>
               <table>
			      <tr>
				      <td>Activation code: </td>
				      <td><input type='text' name='code' value='$getcode'></td>
				  
				  </tr>
			      <tr>
				      <td>Username: </td>
				      <td><input type='text' name='username'></td>
				      
				  </tr>
			      <tr>
				      <td>Password: </td>
				      <td><input type='password' name='password'></td>
				  </tr>
			       <tr>
				      <td></td>
				     <td><input type='submit' name='reg'  value='Activate your account'></td>
				  
				  </tr>
			       
			       
			   </table>
            </form>";
			
               //this scripts executes if the user clicks the 'activate your account button' 
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
			
			$reg = @$_POST['reg'];
					if ($reg) {
			$code = strip_tags($_POST['code']);
		    $un = strip_tags($_POST['username']);
		    $pswd = strip_tags($_POST['password']);
			
			if($code && $un && $pswd){
			    if(strlen($code) == 25){
				$pswd = md5($pswd);
				include("inc/scripts/mysql_connect.inc.php");

				$query = mysql_query("SELECT * FROM users WHERE username = '$un' AND password = '$pswd'");
				$numrows = mysql_num_rows($query);
				if($numrows == 1 ){
				//this uses the mysql fetch associative array to get the code that is in the database
				   $row = mysql_fetch_assoc($query);
				   $dbcode =  $row['code'];
				   
				   if($code == $dbcode){
				      mysql_query("UPDATE users SET active = '1' WHERE username = '$un'");
					  
					   echo "<div class='success_msg'><div class='success_header'>Congrats Your Account has been activated!!!<br /><br /></div> Thank you for Joining Sleeky, Please login to get Started<a href='index.php'> Login</a></div>";
				   }
				   else
				   echo "<div class='error3'>Your activation code is incorrect</div>";
				}
				else
				   "<div class='error3'>Username and Password is invalid</div>";
				}
				
				else
				     echo "<div class='error3'>The code you supplied is invalid</div>";
				
			
			}
			else
			  echo "<div class='error3'>Please fill in all the required fields.</div>";
			
			}
			
			
          
                  echo "$form";			
			
			
?>
</div>
</div><!---------ends fullbox class--->