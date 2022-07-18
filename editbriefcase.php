<?php $title = "Sleeky--Briefcase";?>
<?php include("inc/incfiles/header.inc.php");
include("inc/incfiles/footer.inc.php"); ?>
<?php
$save = @$_POST['save'];

// First Name, Last Name and About the user query
$get_info = mysql_query("SELECT work_goals, educate, locate, website, career_field FROM users WHERE username ='$user'");
$get_row = mysql_fetch_assoc($get_info);
$db_work_goals = $get_row['work_goals'];
$db_educate = $get_row['educate'];
$db_locate = $get_row['locate'];
$db_website = $get_row['website'];
$db_career_field = $get_row['career_field'];





//Submit what the user types into the database
	
	if($save){
	// if the form is submitted
	$work_goals = (@$_POST['work_goals']);
	$educate = (@$_POST['educate']);
	$locate = (@$_POST['locate']);
	$website = (@$_POST['website']);
	$career_field = (@$_POST['career_field']);
	

	// submit the form to the database
	$info_submit_query = mysql_query("UPDATE  users SET  work_goals = '$work_goals', educate = '$educate', locate = '$locate', website = '$website', career_field = '$career_field' WHERE username = '$user'");
	echo "<div class='notification'>Your Briefcase has been successfully updated</div><br /><br /><br /><br />";
	
	}
	
    else
  {
  // Do nothing
}	
?>
<div class="edit">Edit Your Briefcase</div>
<hr style="width:570px; float:left; height:1px;"/>
<br />
<form action="editbriefcase.php" method="post">
<div class="briefcase">
<div id="myway"><p><b>UPDATE YOUR BRIEFCASE</div></b></p>
<table>
<tr><td><br /><br /><div id="myway">Work</div></td></tr><br /> 
<td><br /><textarea name="work_goals" id="work_goals" cols="40" rows="2" maxlength="80"><?php echo $db_work_goals; ?></textarea></td></tr>
<tr><td><div id="repute">What you do in no more than 80 characters</div></td></tr>
</table><br />
<table>
<tr><td><div id="myway">Educational Qualification</div></td></tr><br />
<td><br /><textarea name="educate" id="educate" cols="40" rows="2" maxlength="60"><?php echo $db_educate; ?></textarea></td></tr>
<tr><td><div id="repute">Your Qualification in no more than 80 characters e.g BSC Economics</div></td></tr>
</table>
<table>
<tr><td><div id="myway">Your Location</div></td></tr><br />
<td><br /><textarea name="locate" id="locate" cols="40" rows="2" maxlength="60"><?php echo $db_locate; ?></textarea></td></tr>
<tr><td><div id="repute">Where you live in no more than 80 characters e.g London, United Kingdom</div></td></tr>
</table><br />
<div id="myway">Enter your website</div>
<table>
<tr><td><textarea name="website" id="website" cols="40" rows="2" maxlength="100"><?php echo $db_website; ?></textarea></td></tr><br />
<tr><td><div id="repute">Your url in no more than 100 characters e.g http://www.sleeky.net/</div></td></tr>

</table><br />

<div id="myway">Select your field</div>
<table>
<tr>

<td>
<select name="career_field" id="career_field">
<option>Please select your field</option>
<option> ABLE SEAMAN</option>
<option> ABRASIVE GRADER</option>
<option>ABRASIVE GRINDER</option>
<option>ABRASIVE MIXER</option>
<option>ABRASIVE SAWYER</option>
<option>ABRASIVE-BAND WINDER</option>
<option>ABRASIVE-COATING-MACHINE OPERATOR</option>
</select>
</td>
</tr><br />
<tr><td><div id="repute">Please choose the career field you belong e.g Music</div></td></tr>
<tr><td><input type="submit" name="save" id="save" value="Save"><br /></td></tr>
</table>

</form></div><br />