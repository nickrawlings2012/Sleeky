<?php $title = "Sleeky--Home";?>
<?php include("inc/incfiles/header.inc.php");
include("inc/incfiles/footer.inc.php"); ?>


<?php
if(!isset($_SESSION["user_login"]))
 {
 
    
}
else
{
?>

<?php
$date = date("F d, Y");
mysql_query("UPDATE users SET last_login = '$date' WHERE  username = '$user'");
    echo "<div id='last_login'>Welcome $firstname, </div><div id='date'> today is $date</div>";
?>
<div class="sleeks"><br />
<h2><a href='#'>Briefcase Updates</a> | <a href='#'> Blog</a> | <a href='#'> Create a Page</a> | <a href='#'> Showcase a brand</a> | <a href='#'> Knowlegde buffet</a></h2><br /><br />
</div>
<?php
// if the user logs in successfully
$getposts = mysql_query("SELECT * FROM posts WHERE user_posted_to='$user' ORDER BY id DESC") or die(mysql_error());

while ($row = mysql_fetch_assoc($getposts)) {
						$id = $row['id'];
						$body = $row['body'];	
						$date_added = $row['date_added'];
						$added_by = $row['added_by'];
						$user_posted_to = $row['user_posted_to'];
						
						
$getnames = mysql_query("SELECT first_name, last_name FROM users WHERE username='$user' ") or die(mysql_error());

while ($row = mysql_fetch_assoc($getnames)) {
						$firstname = $row['first_name'];
						$lastname = $row['last_name'];	

						
						
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
						<div class='sleekyUpdatePosts'>
						<div class='briefCaseOptions'>
						<a href='javascript:;' onClick='javascript:toggle$id()'>Show Comments</a>
						</div>
						
						<div style='float: left;'>
						<img src='$profilepic_info' height='50' width='45'>
						</div>
						<div class='posted_by' style='padding-left:5px;'><a href='$added_by'>$firstname $lastname</a> on $date_added  </div>
						<br />
						<div style='max-width: 600px; padding-top:5px; padding-left:50px; '>
					     $body<br /><br /><br />
						</div>
						<div id='toggleComment$id' style='display: none;'>
	                   <br />
					   <iframe src='./comment_frame.php?id=$id' frameborder='0' style='max-height: 150px; auto; width: 100%; min-height: 10px;'></iframe>
					   
	                    </div>
						</div>
						";
						
}
}	
}				
?>
