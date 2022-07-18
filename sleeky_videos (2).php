<?php 
$title = "Sleeky Channel--See, Learn and get Inspired";?>
<?php include("inc/incfiles/header.inc.php");
include("inc/incfiles/footer.inc.php"); ?>
<!---begins the welcome div--->	 
<div id="welcome">
Welcome to your Sleeky Channel --- <span style="color:green;">See</span>,<span style="color:blue;"> Learn</span>,<span style="color:red;"> Get Inspired</span>.
</div><!----ends the welcome div--->
<?php
$save = @$_POST['save'];

// First Name, Last Name and About the user query
$get_info = mysql_query("SELECT work_goals, educate, locate, website FROM users WHERE username ='$user'");
$get_row = mysql_fetch_assoc($get_info);
$db_work_goals = $get_row['work_goals'];
$db_educate = $get_row['educate'];
$db_locate = $get_row['locate'];
$db_website = $get_row['website'];

//Submit what the user types into the database
	
	if($save){
	// if the form is submitted
	$work_goals = (@$_POST['work_goals']);
	$educate = (@$_POST['educate']);
	$locate = (@$_POST['locate']);
	$website = (@$_POST['website']);
	

	// submit the form to the database
	$info_submit_query = mysql_query("UPDATE  users SET  work_goals = '$work_goals', educate = '$educate', locate = '$locate', website = '$website' WHERE username = '$user'");
	echo "<div class='notification'>Your Briefcase has been successfully updated</div><br /><br /><br /><br />";
	
	}
	
    else
  {
  // Do nothing
}	
?>
<!---starts the videos div--->
<div class="videos">

<?php
$username = "";
if(isset($_GET['u'])) {
   $username = mysql_real_escape_string($_GET['u']);
   if (ctype_alnum($username)){
  //checks if user exists
  $check = mysql_query("SELECT username, first_name, last_name FROM users WHERE username='$username'");
  if (mysql_num_rows($check)==5){
  $get = mysql_fetch_assoc($check);
  $username = $get['username'];
  $firstname = $get['first_name'];
  $lastname = $get['last_name'];
  }
  else
  {
  echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/mysuccess/mysleeky/index.php\">";
  exit();
  }
  }
}
?>
<div id='inner_videos'>
<?php

echo "<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/SM04smi3-8k' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/pAElNUgJFfE' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/VBaH_9vJETg' frameborder='0' allowfullscreen></iframe></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/oOdnhcyNXIk' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/GULAb4JvRwo?list=PLBD27F8618678C215&amp;hl=en_US' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/88KmvrGQrcI' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/8EAUB156N00' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/nGKtdYQ_hjQ' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/MPS2eS3s-7I' frameborder='0' allowfullscreen></iframe></div>
<div id='single_videos'><iframe width='150' height='100' src='http://www.youtube.com/embed/Lcmb4RplClQ' frameborder='0' allowfullscreen></iframe></div>";

?>
</div>
</div><!----ends the videos div--->