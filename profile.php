<?php $title = "Sleeky--Briefcase";?>
<?php include("inc/incfiles/header.inc.php");
include("inc/incfiles/footer.inc.php"); ?>
<?php
if(isset($_GET['u'])) {
   $username = mysql_real_escape_string($_GET['u']);
   if (ctype_alnum($username)){
  //checks if user exists
  $check = mysql_query("SELECT username, first_name, last_name FROM users WHERE username='$username'");
  if (mysql_num_rows($check)==1){
  $get = mysql_fetch_assoc($check);
  $username = $get['username'];
  $firstname = $get['first_name'];
  $lastname = $get['last_name'];
  }
  else
  {
  echo "<meta http-equiv=\"refresh\" content=\"0; url=http://www.sleeky.net/index.php\">";
  exit();
  }
  }
}
$post = @$_POST['post'];
if ($post != "") {
$date_added = date("Y-m-d");
$added_by = $user;
$user_posted_to = $username;

$sqlCommand = "INSERT INTO posts VALUES('', '$post','$date_added','$added_by','$user_posted_to')";  
$query = mysql_query($sqlCommand) or die (mysql_error()); 

}
//check whether the user has uploaded the profile pic
$check_pic = mysql_query("SELECT profile_pic FROM users WHERE username = '$username'");
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
?>
<div id="status">
<form action="<?php echo $firstname." ".$lastname; ?>" method="POST"> 
<div id="realname"><?php echo $firstname." ".$lastname; ?><a href="editbriefcase.php"><input type="button" name="edit" id="briefButton" value="Edit your sleeky briefcase">
</a></div>
<div id="realProfile">
<?php
   $work = mysql_query("SELECT work_goals FROM users WHERE username='$username'");
   $get_work = mysql_fetch_assoc($work);
   $work_user =$get_work['work_goals'];
    if($work_user)
   echo "<div id='repute2'>Work:</div><div id='innerstatus'>$work_user</div>";
?>


</div> <!--ends realProfile  div-->
<div id="realProfile">
<?php
   $educate = mysql_query("SELECT educate FROM users WHERE username='$username'");
   $get_educate = mysql_fetch_assoc($educate);
   $educate_user =$get_educate['educate'];
   
    if($educate_user)
   echo "<div id='repute2'>Degree:</div><div id='innerstatus'>$educate_user</div>";
?>


</div> <!--ends realProfile  div-->
<div id="realProfile">
<?php
   $locate = mysql_query("SELECT locate FROM users WHERE username='$username'");
   $get_locate = mysql_fetch_assoc($locate);
   $locate_user =$get_locate['locate'];
   
    if($locate_user)
   echo "<div id='repute2'>Lives in:</div><div id='innerstatus'>$locate_user</div>";
?>


</div> <!--ends realProfile  div-->
<div id="realProfile">
<?php
   $website = mysql_query("SELECT website FROM users WHERE username='$username'");
   $get_web = mysql_fetch_assoc($website);
   $web_user =$get_web['website'];
   
    if($web_user)
   echo "<div id='repute2'>Website:</div><div id='innerstatus'><a href ='$web_user'>$web_user</a></div>";
?>


</div> <!--ends realProfile  div-->
<div id="realProfile">
<?php
   $career_field = mysql_query("SELECT career_field FROM users WHERE username='$username'");
   $get_field = mysql_fetch_assoc($career_field);
   $career_field_user =$get_field['career_field'];
   
    if($career_field_user)
   echo "<div id='repute2'>Career:</div><div id='innerstatus'>$career_field_user</a></div>";
?>


</div> <!--ends realProfile  div-->
</form>
</div> <!--ends status div-->
<div class="ideasform">
<form action="<?php echo $username; ?>" method="POST">
<textarea id="post" name="post" placeholder="Share an idea or start a debate ..." rows="2" cols="50" maxlength="200"  ></textarea>
<input type="submit" name="send" id="postme" value="Post"/>
</form>
<div id="textarea_count"></div>
</div> <!--ends ideasform div-->

<div class="ideasposts">
<?php
$getposts = mysql_query("SELECT * FROM posts WHERE user_posted_to='$username' ORDER BY id DESC") or die(mysql_error());

while ($row = mysql_fetch_assoc($getposts)) {
						$id = $row['id'];
						$body = $row['body'];	
						$date_added = $row['date_added'];
						$added_by = $row['added_by'];
						$user_posted_to = $row['user_posted_to'];
						
						$get_user_info = mysql_query("SELECT * FROM users WHERE username='$added_by'");
						$get_info = mysql_fetch_assoc($get_user_info);
						$profilepic_info = $get_info['profile_pic'];
						if ($profilepic_info == "") {
						$profilepic_info = "./img/default_pic.jpg";
						}
						else
						{
						 $profilepic_info = "./userdata/profile_pics/".$profilepic_info;
						}
					?>	
						<script language="javascript">
                          function toggle<?php echo $id; ?>(){
	                      var ele = document.getElementById("toggleComment<?php echo $id; ?>");
	                      var text = document.getElementById("displayComment<?php echo $id; ?>");
	                      if (ele.style.display == "block"){
	                       ele.style.display = "none";
	                     }
	                      else
	                     {
	                      ele.style.display = "block";
	                     }
	                     }
						 
                        </script>
						<?php
					    echo "
						<div class='ideasUpdatePosts'>
						<div class='briefCaseOptions'>
						<a href='javascript:;' onClick='javascript:toggle$id()'>Show Comments</a>
						</div>
						<div style='float: left;'>
						<img src='$profilepic_info' height='50' width='45'>
						</div>
						<div class='posted_by' style='padding-left:5px;'><a href='$added_by'> $firstname $lastname</a> on $date_added  </div><br />
						<div style='max-width: 600px; padding-top: 5px; padding-left:50px; '>
						$body<br /><br /><br /><br />
					    </div>
						<div id='toggleComment$id' style='display: none;'>
	                   <br />
					   <iframe src='./comment_frame.php?id=$id' frameborder='0' style='max-height: 150px; auto; width: 100%; min-height: 10px;'></iframe>
					   
	                    </div>
						</div>";
}
if (isset($_POST['sendmsg'])) {
   echo "<meta http-equiv=\"refresh\" content=\"0; url=send_msg.php?u=$username\">";
}

$errorMsg = "";
if (isset($_POST['addally'])) {
   $ally_request = $_POST['addally'];
   
   $user_to = $user;
   $user_from = $username;
   
   if($user_to == $username){
   $errorMsg =  "<div class='notification'>You can't send an ally request to yourself!</div>";
   
   }
   else
   
   {
     $create_request = mysql_query("INSERT INTO ally_request VALUES ('','$user_to','$user_from')");
	 $errorMsg ="<div class='notification'>Your ally request has been sent!</div>";
   }
}
else
{
		//do nothing
}
?>
</div>
<div id="profilePicture">
<img src="<?php echo $profile_pic; ?>" height="200" width="200"  alt="<?php echo $username; ?>'s Profile" title="<?php echo $username; ?>'s Profile"/></div><br />

<form action="<?php echo $username; ?>" method="POST">
<?php
  $allysArray ="";
  $countAllys ="";
  $allysArray12 ="";
  $addAsAlly ="";
  $removeally="";
  $selectAllysQuery = mysql_query("SELECT ally_array FROM users WHERE username ='$username'");
  $allyRow = mysql_fetch_assoc($selectAllysQuery);
  $allyArray =$allyRow['ally_array'];
  
  if  ($allyArray != ""){
  $allyArray = explode(",",$allyArray);
  $countAllys = count($allyArray);
   $allysArray12 = array_slice($allyArray, 0, 12);
  
  
  $i = 0;
	
	
  if (in_array($user,$allyArray)){
  $addAsAlly = '<input type ="submit" name ="removeally" value="Remove Ally">';
  }
  else
  {
 $addAsAlly = '<input type ="submit" name ="addally" value="Add Ally">';
  }
  echo $addAsAlly;
  }
  else
 {
  $addAsAlly = '<input type ="submit" name ="addally" value="Add Ally">';
  
  echo $addAsAlly;
 } 


 //$user = logged in user
  //$username = user who owns the profile
  
  if(@$_POST['removeally']){
  //Ally array for logged in user
     $add_ally_check = mysql_query("SELECT ally_array FROM users WHERE username= '$user'");
	 $get_ally_row = mysql_fetch_assoc($add_ally_check);
	 $ally_array = $get_ally_row['ally_array'];
	 $ally_array_explode = explode(",",$ally_array);
	 $ally_array_count = count($ally_array_explode);
	 
	 //Ally array for user who has the profile
     $add_ally_check_username = mysql_query("SELECT ally_array FROM users WHERE username= '$username'");
	 $get_ally_row_username = mysql_fetch_assoc($add_ally_check_username);
	 $ally_array_username = $get_ally_row_username['ally_array'];
	 $ally_array_explode_username = explode(",",$ally_array_username);
	 $ally_array_count_username = count($ally_array_explode_username);
	 
	 $usernameComma = ",".$username;
	 $usernameComma2 = $username.",";
	 
	 $userComma = ",".$user;
	  $userComma2 = $user.",";
	  //this removes the ally of the looged in user from the looged in user ally array
	  if(strstr($ally_array,$usernameComma)) {
	   $ally1 = str_replace("$usernameComma","",$ally_array);
	  }
	  else
	   if(strstr($ally_array,$usernameComma2)) {
	   $ally1 = str_replace("$usernameComma2","",$ally_array);
	  }
	  else
	   if(strstr($ally_array,$username)) {
	   $ally1 = str_replace("$username","",$ally_array);
	  }
	  //this removes logged in user from another persons ally array
	  if(strstr($ally_array,$userComma)) {
	   $ally2 = str_replace("$userComma","",$ally_array);
	  }
	  else
	   if(strstr($ally_array,$userComma2)) {
	   $ally2 = str_replace("$userComma2","",$ally_array);
	  }
	  else
	   if(strstr($ally_array,$user)) {
	   $ally2 = str_replace("$user","",$ally_array);
	}
	
	  
	  $ally2 = "";
	  $removeAllyQuery = mysql_query("UPDATE users SET ally_array='$ally1' WHERE username = '$user'");
	  $removeAllyQuery_username = mysql_query("UPDATE users SET ally_array='$ally2' WHERE username = '$username'");
	  echo "<div class='notification'>$username has be removed!</div>";
	  
	  
}
//Pat code for allies
if (@$_POST['pat']){
   $check_if_pat = mysql_query("SELECT * FROM pats WHERE user_to='$username' && user_from='$user'");
   $num_pat_found = mysql_num_rows ($check_if_pat);
   if ($num_pat_found == 1) {
     echo "<div class='notification'>$username has not replied your pat</div>";
   }
   else
 if($username == $user){
    echo "<div class='notification'>You can't give yourself a pat</div>";
  }
  else
  {
  $pat_user = mysql_query("INSERT INTO pats VALUES ('','$user','$username')");
  echo "<div class='notification'>You just gave $username a pat.</div>"; 
  
  }
  
}  
?>

<input type="submit" name="pat" value="Pat" />
<input type="submit" name="sendmsg" value="Message" /><br />
<?php echo $errorMsg ?>
</form>
<br />
<br />
<br />
<br />
<div id="textHeader">
<h3><a href="#"><?php echo $firstname." ".$lastname; ?>'s Reputation</a><h3>
<div>
<?php

   $about_query = mysql_query("SELECT bio FROM users WHERE username='$username'");
   $get_result = mysql_fetch_assoc($about_query);
   $about_the_user =$get_result['bio'];
   
   
   echo $about_the_user;
?>
</div><br />
<h3><a href="#">skills</a><h3>
<div>
<?php

   $skill_query = mysql_query("SELECT skill FROM users WHERE username='$username'");
   $get_skill = mysql_fetch_assoc($skill_query);
   $skill_of_user =$get_skill['skill'];
   
   
   echo $skill_of_user;
?>
</div><br />
<h3><a href="#">Achievement</a><h3>
<div id="textHeader">
<?php

   $achieve_query = mysql_query("SELECT achieve FROM users WHERE username='$username'");
   $get_achieve = mysql_fetch_assoc($achieve_query);
   $achieve_of_user =$get_achieve['achieve'];
   
   
   echo $achieve_of_user;
?>
</div>
<h3><a href="#">Ambition/Goal</a><h3>
<div id="textHeader">
<?php

   $goal_query = mysql_query("SELECT goal FROM users WHERE username='$username'");
   $get_goal = mysql_fetch_assoc($goal_query);
   $goal_of_user =$get_goal['goal'];
   
   
   echo $goal_of_user;
?>
</div><br />

<h3><a href="#">Allies</a><h3>

<div>
<?php
	
	 if ($countAllys !=0){
	 foreach ($allysArray12 as $key => $value){
	 $i++;
	 $getAllyQuery = mysql_query("SELECT * FROM users WHERE username ='$value' LIMIT 1");
	 $getAllyRow = mysql_fetch_assoc($getAllyQuery);
	 $allyUsername = $getAllyRow['username'];
	 $allyProfilePic = $getAllyRow['profile_pic'];
	 
	 if ($allyProfilePic == ""){
	    echo  "<a href='$allyUsername'><img src='img/default_pic.jpg' alt=\"$allyUsername's Profile\" title=\"$allyUsername's Profile\" height='50' width ='40'
		style='padding-right:6px;'></a>";
	 }
	 else
	 {
	    echo "<a href='$allyUsername'><img src='userdata/profile_pics/$allyProfilePic' alt=\"$allyUsername's Profile\" title=\"$allyUsername's Profile\" height='50' width ='40'
		style='padding-right:6px;'></a>";
	 }
	 }
	 }
	 
	 else
	 {
	 echo  $username. " has no Allies";
	}
	
?>
</div>

</div><!--ends the texheader div-->
</div>
<script type="text/javascript" src="js/ui.js"></script>

