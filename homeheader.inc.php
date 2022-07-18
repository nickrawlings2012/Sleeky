<?php
include ("inc/scripts/mysql_connect.inc.php");
session_start();
if (isset($_SESSION['user_login'])){
$user = $_SESSION["user_login"];
}
else{
$user = "";

}

   $get_unread_query = mysql_query("SELECT opened FROM pvt_messages WHERE user_to = '$user' && opened='no'");
   $get_unread = mysql_fetch_assoc($get_unread_query);
   $unread_numrows = mysql_num_rows($get_unread_query);
   $unread_numrows = "(".$unread_numrows.")";
   
  

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">

<head>
<meta charset="utf-8"> 
	<link rel="stylesheet" type="text/css" href="css/ui-lightness/jquery-ui-1.8.23.custom.css" media="screen">
	<link rel="stylesheet" href="css/site_style.css" media="screen">
	<link rel="stylesheet" href="css/reset.css" media="screen">
	<link rel="stylesheet" href="css/master.css" media="screen">
	<link rel="stylesheet" href="css/blue.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
	<link rel="stylesheet" href="css/title_style.css" media="screen">
	<script src="js/jquery.color.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
    <script src="js/placeholder-js.js" type="text/javascript"></script>
	<script src="js/main.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/fadein.js"></script>
	<script type="text/javascript" src="js/swagga.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	<script type="text/javascript" src="js/slidein.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="js/username_check.js"></script>
	

<title><?php  echo "$title";   ?></title>
</head>

<body>
  <div class="mashmenu">
    <div id="whole_wrapper">
	  <div class="logo">
	    <img src="img/sleekys.png">
	   </div>
	   <div id="menu">
	   <div class="fnav">
			
				<a href="#" class="flink" ><span>My Sleeky</span></a>

				<div class="allContent">

					<div class="snav" >
						<a href="#" class="slink" >About Sleeky</a>

						<div class="insideContent">

							<span class="featured" >What is Sleeky?<br />
     "Finally you can...chat online with an expert, enjoy educative video tutorials, and get Sleeky answers to all your questions.
	 Why is there not a top tips dairy when you need one? ...well now its all here. Sign Up into this social/professional networking website to ample your opportunities
	,explore the pleasure of your profesional perspectives and learn how to reach goals, with people who have, people who share, people like you.
							</a>
                            </span>
						</div><!-- end insideContent -->
					</div><!-- end snav -->
					<div class="snav" >
						<a href="#" class="slink" >Meet the C.E.O</a>
						<div class="insideContent">
							<span class="featured" ></span>
							something here later
                          </div><!-- end insideContent -->
					</div><!-- end snav -->

					<div class="snav" >
						<a href="#" class="slink" >Sleeky Channel</a>
					
						<div class="insideContent">
						       watch your favorite educative videos here
							<span class="featured" ></span>
					<!-- end fnav -->
					</div><!-- end snav -->
						
                    </div>
					<?php
					if (isset($_SESSION["user_login"])) {
			echo '
					<div class="snav">

				<a href="logout.php" class="slink" >Logout</a>

			</div>
			';}
			?>
				</div><!-- end allContent -->

			</div><!-- end fnav -->

			<?php
			
			
				echo '
				
				<div class="fnav">

				<a href="signUp.php" class="flink" >Sign Up </a>

			    </div>
				
                <div class="fnav">

				<a href="index.php" class="flink" >Login </a>

			</div><!-- end fnav -->
				
				';
			
			?>
            </div><!--ends menu div-->
     	  </div>
		</div><br /><br />
     <!--end mashmenu -->
<!---begins the wrapper div for the homeMenu--->
<div class="wrapper">	 
   <br />
   <br />
   <br />
   