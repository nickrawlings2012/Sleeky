<?php $title = "Sleeky--Settings";?>
<?php include ("inc/incfiles/header.inc.php"); 
include("inc/incfiles/footer.inc.php");
if($user){

}
else
{
die("<div class='notification'>You must login to view this page</div>");
}

?>
<?php
$sendata = @$_POST['sendata'];
//password variables
$old_password = strip_tags(@$_POST['oldpassword']);
$new_password = strip_tags(@$_POST['newpassword']);
$repeat_password = strip_tags(@$_POST['newpassword2']);
if($sendata){
//if the form is submitted
$password_query = mysql_query("SELECT * FROM users WHERE username='$user'");
 while($row = mysql_fetch_assoc($password_query)){
		$db_password = $row['password'];
		//md5 the old password before we check if it matches
		$old_password_md5 = md5($old_password);
		
		// check whether old password equals $db_password
		if ($old_password_md5 == $db_password) {
		//continue changing the user password ...
		//check whether the 2 new passwords match
		if($new_password == $repeat_password){
			if(strlen($new_password) <= 4){
				echo "<div class='error2'>Your password must not be less than 6 characters long!</div>";
		}
		else
		
         {
		//md5 the new password before we add to the database
		    $new_password_md5 = md5($new_password);
		
		    //update  the users passwords
			$password_update_query = mysql_query("UPDATE users SET password ='$new_password_md5' WHERE username ='$user'");
			echo "<div class='notification'>Your password Update has been succesfull</div><br /><br />";
			}
		}
		else
		{
		echo "<div class='error2'>Your new passwords don't match!</div>";
		}
		
		
		}
		  else
		{
		echo "<div class='error2'>Your old password is incorrect!</div>";
		}
 }
}
else
{
echo"";
}

$updateinfo = @$_POST['updateinfo'];

// First Name, Last Name and About the user queries
$get_info = mysql_query("SELECT first_name, last_name, bio, skill, achieve, goal FROM users WHERE username ='$user'");
$get_row = mysql_fetch_assoc($get_info);
$db_firstname = $get_row['first_name'];
$db_last_name = $get_row['last_name'];
$db_bio = $get_row['bio'];
$db_skill = $get_row['skill'];
$db_achieve = $get_row['achieve'];
$db_goal = $get_row['goal'];

//Submit what the user types into the database
	
	if($updateinfo){
	// if the form is submitted
	$firstname = strip_tags(@$_POST['fname']);
	$lastname = strip_tags(@$_POST['lname']);
	$bio = (@$_POST['bio']);
	$skill = (@$_POST['skill']);
	$achieve = (@$_POST['achieve']);
	$goal = (@$_POST['goal']);
	$website = (@$_POST['website']);
	
	if (strlen($firstname) < 3){ 
	echo "<div class='error2'>Your first name must be three or more characters long!</div>";
	}
	else
	if (strlen($lastname) < 3){ 
	echo "<div class='error2'>Your last name must be three or more characters long!</div>";
	}
    else
	{
	// submit the form to the database
	$info_submit_query = mysql_query("UPDATE  users SET first_name = '$firstname', last_name = '$lastname', bio = '$bio', skill = '$skill', achieve = '$achieve', goal = '$goal', website = '$website'  WHERE username = '$user'");
	echo "<div class='notification'>Your Profile information has been successfully updated</div><br /><br /><br /><br />";
	
	}
	}
    else
  {
  // Do nothing
}	
//check whether the user has uploaded the profile pic
$check_pic = mysql_query("SELECT profile_pic FROM users WHERE username = '$user'");
$get_pic_row = mysql_fetch_assoc($check_pic);
$profile_pic_db = $get_pic_row['profile_pic'];
//checks if the profilepic db is empty or not
	if ($profile_pic_db == "") {
	$profile_pic = "img/default_pic.jpg";
	
	}
	else
	{
	$profile_pic = "userdata/profile_pics/".$profile_pic_db;
	
	}
//profile image upload scripts
if (isset($_FILES['profilepic'])){
	if(((@$_FILES["profilepic"]["type"] == "image/jpeg") || (@$_FILES["profilepic"]["type"] == "image/png") || (@$_FILES["profilepic"]["type"] == "image/gif")) && (@$_FILES["profilepic"]["size"] < 1048576)) //1 megabyte
 { 
 //names the profile pics folder could possibly be called
 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 // re-arranges the characters within 15 characters  long
 $rand_dir_name = substr(str_shuffle($chars),0, 15);
 mkdir("userdata/profile_pics/$rand_dir_name");
             //gets the name of the image
 if (file_exists("userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"]))
 {
    echo @$_FILES["profilepic"]["name"]." Already exists";
	

 }
 else
 {
    move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"]);
	//echo "Uploaded and stored in:userdata/profile_pics/$rand_dir_name/ ".@$_FILES["profilepic"]["name"];
		$profile_pic_name = @$_FILES["profilepic"]["name"];
	$profile_pic_query = mysql_query("UPDATE users SET profile_pic = '$rand_dir_name/$profile_pic_name' WHERE username = '$user'");
	
 }
 }
 else
 {
      echo "<div class='error2'>Invalid file!</div>";
 }
}
?>
<h2>Edit your Account</h2>
<hr style="width:575px; float:left; color:Lavender;"/><br /><br />
<div class="settings">
<div id="myway"><p>UPLOAD YOUR SLEEKY PICTURE</p></div><br />
<form action="" method="POST" enctype="multipart/form-data">
<img src="<?php echo $profile_pic; ?>" width="70">
<input type="file" name ="profilepic" /><br />
<input type="submit" name="uploadpic" value="Upload">
</form><br />
<hr style="width:500px; float:left;"/><br /><br /><br />
<form action="account_settings.php" method="post">

<div id="myway"><p><b>CHANGE YOUR PASSWORD</div></b></p>
<table>
<tr><td>Enter Your Old Password :</td><td><input type="password" name="oldpassword" id="oldpassword" size="30"></td></tr><br />
<tr><td>Enter Your New Password :</td><td><input type="password" name="newpassword" id="newpassword" size="30"></td></tr><br />
<tr><td>Repeat Your New Password:</td><td><input type="password" name="newpassword2" id="newpassword2" size="30"></td></tr><br />
<tr><td><input type="submit" name="sendata" id="sendata" value="Update"></td><tr>
</table>
</form><br />
<hr style="width:500px; float:left;"/><br /><br />
<form action="account_settings.php" method="post">
<div id="myway"><p><b>UPDATE YOUR PROFILE</div></b></p>
<table>
<tr><td>Enter Your First name:</td><td><input type="text" name="fname" id="fname" size="30" value="<?php echo $db_firstname; ?>"></td></tr><br />
<tr><td>Enter Your Last name:</td><td><input type="text" name="lname" id="lname" size="30" value="<?php  echo $db_last_name; ?>"></td></tr><br />
<tr><td><div id="repute">Please enter your real name</div></td></tr>
<tr><td><input type="submit" name="updateinfo" id="updateinfo" value="Update"><br /></td></tr>
</table>
<hr style="width:500px; float:left;"/><br /><br />
<div id="myway">What's your Reputation?</div>
<table>
<tr><td><textarea name="bio" id="bio" cols="30" rows="3" maxlength="150"><?php echo $db_bio; ?></textarea></td></tr><br />
<tr><td><div id="repute">What people say about you in no more than 150 characters</div></td></tr><br /><br />
</table><br /><br />
<div id="myway">Enter your skills</div>
<table>
<tr><td><textarea name="skill" id="skill" cols="30" rows="3" maxlength="150"><?php echo $db_skill; ?></textarea></td></tr><br />
<tr><td><div id="repute">What you can do in no more than 150 characters</div></td></tr>
</table><br /><br />
<div id="myway">Enter your Achievement</div>
<table>
<tr><td><textarea name="achieve" id="achieve" cols="30" rows="3" maxlength="150"><?php echo $db_achieve; ?></textarea></td></tr><br />
<tr><td><div id="repute">Your major Achievement in no more than 150 characters</div></td></tr>
</table><br /><br />
<div id="myway">Enter your Ambition/Goal</div>
<table>
<tr><td><textarea name="goal" id="goal" cols="30" rows="3" maxlength="150"><?php echo $db_goal; ?></textarea></td></tr><br />
<tr><td><div id="repute">Your major Ambition/Goal in no more than 150 characters</div></td></tr>
</table>
</table>
<tr><td><input type="submit" name="updateinfo" id="updateinfo" value="Update"><br /></td></tr>
</table>
</form>
<br />
<hr style="width:500px; float:left;"/><br /><br />
<br />
<br />
<br />
</div>
