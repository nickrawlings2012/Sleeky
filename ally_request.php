<?php include("inc/incfiles/header.inc.php");
include("inc/incfiles/footer.inc.php");?>
<?php
// find ally requests

$allyRequests = mysql_query("SELECT * FROM ally_request WHERE user_to = '$user'");
$numrows = mysql_num_rows($allyRequests);

if ($numrows == 0){

echo "<div class='notification'>You currently have no ally Requests</div>";
$user_from = "";
}
else

{
  while($get_row = mysql_fetch_assoc($allyRequests)) {
     $id = $get_row['id'];
	 $user_to = $get_row['user_to'];
	 $user_from = $get_row['user_from'];
	 
	 echo'' . $user_from . ' wants to be your ally'.'<br />';
  

?>
<?php

if (isset($_POST['acceptrequest'.$user_from])){
//select the ally_array row from the logged in user
//select the ally_array row from the user who sent the friend request
// if the user has no allies we just concat the allies username

//get ally array for logged in user
 $get_ally_check = mysql_query("SELECT ally_array FROM users WHERE username ='$user'");
 $get_ally_row = mysql_fetch_assoc ($get_ally_check);
 $ally_array = $get_ally_row['ally_array'];
 $allyArray_explode = explode (",",$ally_array);
 $allyArray_count = count ($allyArray_explode);
 
 
 //get ally array for person who sent the request
 $get_ally_check_ally = mysql_query("SELECT ally_array FROM users WHERE username ='$user_from'");
 $get_ally_row_ally = mysql_fetch_assoc ($get_ally_check_ally);
 $ally_array_ally = $get_ally_row_ally['ally_array'];
 $allyArray_explode_ally = explode (",",$ally_array_ally);
 $allyArray_count_ally = count ($allyArray_explode_ally);
 
 if ($ally_array == ""){
     $allyArray_count = count(NULL);
 }
 if ($ally_array_ally == ""){
     $allyArray_count_ally = count(NULL);
 }
 if($allyArray_count == NULL){
   $add_ally_query = mysql_query("UPDATE users SET ally_array = CONCAT(ally_array, '$user_from') WHERE username = '$user'");
 }
 if($allyArray_count_ally == NULL){
   $add_ally_query = mysql_query("UPDATE users SET ally_array = CONCAT(ally_array, '$user_to') WHERE username = '$user_from'");
 }
 if($allyArray_count >= 1){
   $add_ally_query = mysql_query("UPDATE users SET ally_array = CONCAT(ally_array, ',$user_from') WHERE username = '$user'");
 }
 if($allyArray_count_ally >= 1){
   $add_ally_query = mysql_query("UPDATE users SET ally_array = CONCAT(ally_array, ' ,$user_from') WHERE username = '$user_from'");
 }
 $delete_request = mysql_query("DELETE FROM ally_request WHERE user_to ='$user_to' &&user_from='$user_from'");
 
    echo "<div class='notification'>You are now allies</div>";
	echo "<meta http-equiv=\"refresh\" content=\"0; url=ally_request.php\">";
}
if(isset($_POST['ignorerequest' . $user_from])){
$ignore_request = mysql_query("DELETE FROM ally_request WHERE user_to ='$user_to' &&user_from='$user_from'");
 
    echo "<div class='notification'>Request Ignored</div>";
	
}
?>
 <form action="ally_request.php" method="POST">
<input type="submit" name="acceptrequest<?php echo $user_from; ?>" value="Accept">
<input type="submit" name="ignorerequest<?php echo $user_from; ?>" value="Ignore">
</form>
<?php
}
}
?>
