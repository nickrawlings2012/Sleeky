session_start();
010	  
011	include("config.inc.php");
012	include("functions.php");
013	pageheader("Upload"); ?>
014	 
015	<? navmenu(450); ?>
016	 
017	<!-- 1px BORDER -->
018	<table width="450" align="center">
019	 <td bgcolor="#000000" width="450">
020	<!-- 1px BORDER -->
021	 
022	<!-- MAIN TABLE -->
023	    <table bgcolor="#ffe7c6" width="448">
024	      <tr>
025	        <td>
026	<!-- MAIN TABLE SECTION -->
027	 
028	 
029	<table width="100%" bgcolor="<? echo $config['color_main']; ?>">
030	 
031	  <tr>
032	    <td colspan="2" bgcolor="<? echo $config['color_comment_heading']; ?>">
033	    <b>Upload picture &gt;&gt;</b>
034	    </td>
035	  </tr>
036	  <tr>
037	    <td valign="top">
038	    <form method="post" action="db_input.php" ENCTYPE="multipart/form-data">
039	    Album
040	    </td>
041	    <td valign="top" bgcolor="<?echo $config['color_comment_body']; ?>">
042	      <?
043	        $albums = getAlbumsUploadable();
044	        if(count($albums) > 0){
045	            echo "<select name=\"album\" STYLE=\"FONT-FAMILY:VERDANA, GENEVA, ARIAL, HELVETICA; WIDTH: 120; FONT-SIZE:9px; BORDER-STYLE : groove;\">\n";
046	            foreach($albums as $album)
047	                echo "<option value=\"$album[aid]\">". $album['description'] . "  (id ". $album['aid'] .")</option>\n";
048	            echo "</select>\n";
049	        }
050	        else
051	        {
052	         echo "<font size='1'>No albums with upload permission.</font>";
053	        }
054	      ?>
055	    </td>
056	</tr>
057	<tr>
058	    <td valign="top">
059	    <input type="hidden" name="event" value="picture">
060	    <input type="hidden" name="date" value="<? echo date("Y-m-d H:i:s"); ?>">
061	    Local file<br>
062	    </td>
063	    <td valign="top" bgcolor="<? echo $config['color_comment_body']; ?>">
064	    <input type="file" name="userpicture"  STYLE="FONT-FAMILY:VERDANA, GENEVA, ARIAL, HELVETICA; FONT-SIZE:9px;  BORDER-STYLE : groove;"><br>
065	    </td>
066	  </tr>
067	  <tr>
068	    <td valign="top">
069	    &nbsp;
070	    </td>
071	    <td valign="middle" bgcolor="<? echo $config['color_comment_body']; ?>"><img src="images/spacer.gif" width="1" height="5"><br>
072	    <input type="submit" value="Insert picture" STYLE="width:100; FONT-FAMILY:VERDANA, GENEVA, ARIAL, HELVETICA; FONT-SIZE:9px;">
073	    </form>
074	    </td>
075	  </tr>
076	 
077	 
078	 
079	     
080	</table>
081	 
082	<table width="100%">
083	  <tr>
084	    <td colspan="2">
085	    <hr>
086	    </td>
087	  </tr>
088	  <tr>
089	    <td valign="top" width="50%">
090	    <div class="pictureinfo">
091	    <b>Recent comments</b><br>
092	    <? lastcomments(5); ?>
093	    <br>
094	    <b>Top 5 Pictures</b><br>
095	    <? toplist(5,20) ?>
096	    </div>
097	    </td>
098	    <td valign="top">
099	    <div class="pictureinfo">
100	    <b>Recent uploads</b><br>
101	    <? lastuploads(5); ?>
102	    <br>
103	    <b>Some statistics</b><br>
104	     Number of pictures: <? countpics(); ?><br>
105	     Number of comments: <? countcomments(); ?><br>
106	     Number of picture views: <? countpicviews() ?>
107	    </div>
108	    </td>
109	  </tr>
110	</table>
111	 
112	 
113	     
114	<!-- /MAIN TABLE SECTION -->
115	        </td>
116	      </tr>
117	    </table>
118	<!-- /MAIN TABLE SECTION -->
119	 
120	 
121	<!-- /1px BORDER -->
122	 </td>
123	</table>
124	<!-- /1px BORDER -->
125	 
126	<? pagefooter(450); ?>
