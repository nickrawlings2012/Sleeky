<?php
if (isset($_SESSION['user_login'])){
$user = $_SESSION["user_login"];
}
else{
$user = "";

}
?>

<style>
*{
font-size:12px;
font-family:Arial;
}
hr{
color:Lavender;
height:0px;
border:opx;

}
</style>
	
<?php

include ("inc/scripts/mysql_connect.inc.php");

$getid = $_GET['id'];

?>
<script language="javascript">
                          function toggle(){
	                      var ele = document.getElementById("toggleComment");
	                      var text = document.getElementById("displayComment");
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
if (isset($_POST['postComment' . $getid . ''])) {
	$post_body = $_POST['post_body'];
	$posted_to = "fisherman";
	$innerPost = mysql_query("INSERT INTO post_comments VALUES ('','$post_body','$user','$posted_to','0','$getid')");
	

}

?>
<a href='javascript:;' onClick="javascript:toggle()"><div style='float: right; display: inline;'>Comment</div></a>
<div id='toggleComment'  style='display:none;'>
<form action="comment_frame.php?id=<?php echo $getid; ?>" method="POST" name="postComment<?php echo $getid; ?>">

<textarea rols="50" cols="50" name="post_body" placeholder="Enter your comment here" style="height: 30px; width: 300px;"></textarea>
         <input type="submit"  name="postComment<?php echo $getid; ?>"  value="Comment">
</form>
</div>
<?php

$get_comments = mysql_query("SELECT * FROM post_comments WHERE post_id = '$getid'");
//Get important comments
$get_comments = mysql_query("SELECT * FROM post_comments WHERE post_id='$getid' ORDER BY id DESC");
$count = mysql_num_rows($get_comments);
if ($count != 0) {
while ($comment = mysql_fetch_assoc($get_comments)) {
$comment_body = $comment['post_body'];	
$posted_to = $comment['posted_to'];
$posted_by = $comment['posted_by'];
$remove = $comment['post_removed'];
						
echo "<b>$posted_by: </b>".$comment_body."<hr /><br />";
						
}
}
else
{
echo"<center>No comments to this post</center>";
}
?>