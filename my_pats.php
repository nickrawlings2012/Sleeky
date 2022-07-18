<?php $title = "Sleeky--Pats";?>
<?php include("inc/incfiles/header.inc.php");
include("inc/incfiles/footer.inc.php");?>
<?php
//checks if there are pats

$check_for_pats = mysql_query("SELECT * FROM pats WHERE user_to = '$user'");
$pat = mysql_fetch_assoc($check_for_pats);
$pat_num = mysql_num_rows($check_for_pats );
  $user_to = $pat['user_to'];
    $user_from = $pat['user_from'];
	
	
	if(@$_POST['pat_' . $user_from . '']){
	  $delete_pat = mysql_query("DELETE FROM pats WHERE user_from ='$user_from' && user_to ='$user_to'");
	  $create_new_pat = mysql_query("INSERT INTO pats VALUES ('','$user','$user_from'");
	
     echo "You just gave $user_from a Pat";
}
	if ($pat_num ==0){
	echo "$user, you have no pats yet.";
	
	}
    else
	{
	 
	 echo "
	 <form action='my_pats.php' method='POST'>
	 $user_from gave you a Pat&nbsp;
	 <input type='submit' name='pat_$user_from' value=\"Pat Back\">
	 </form>
	"."<br>";
}
?>