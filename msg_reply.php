<?php $title = "Sleeky--Message Reply";?>
<?php include("inc/incfiles/header.inc.php");
   include("inc/incfiles/footer.inc.php"); ?>
<?php
if(isset($_GET['u'])) {
   $username = mysql_real_escape_string($_GET['u']);
   if (ctype_alnum($username)){
  //checks if user exists
  $check = mysql_query("SELECT username FROM users WHERE username='$username'");
  if (mysql_num_rows($check)===1){
  $get = mysql_fetch_assoc($check);
  $username = $get['username'];
   
   //makes sure the user can't send a message to themselves
   if($username != $user){
     if(isset($_POST['submit'])){
	 $msg_title = strip_tags(@$_POST['msg_title']);
	 $msg_body = strip_tags(@$_POST['msg_body']);
	 $date = date("Y-m-d");
	 $opened = "no";
	 $deleted = "no";
	 
	 if($msg_title == "Enter the message title ..."){
	    echo"Please give your message a title ...";
	 }
	  else
	  if (strlen($msg_title) < 2) {
	     echo "Your message title cannot be less than 2 characters ...";
	  }
	  else
	 if($msg_body == ""){
	    echo"Please write a message ...";
	 }
	  else
	  if (strlen($msg_body) < 2) {
	     echo "Your message cannot be less than 2 characters ...";
	  }
	  else
	  {
	 
	 $send_msg = mysql_query("INSERT INTO pvt_messages VALUES('','$user','$username','$msg_title','$msg_body','$date','$opened','$deleted') ");
	   echo "<div class='notification'>Message Sent</div>";
	 }
	}
   echo"
   <form action='send_msg.php?u=$username' method='POST'>
   <h2>Compose a Message: ($username)</h2>
   <input type='text' name='msg_title' size= '30' onClick=\"value=''\" placeholder='Enter the message title ...'><p />
   <textarea cols='100' rows='12' name='msg_body' placeholder='Enter the message ...'></textarea><p />
   <input type='submit' name='submit' value='Send'>
   </form>
   ";
   
   }
   else
   {
     header ("Location: $user");
   }
  }
}
}
?>