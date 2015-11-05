<?php 

	$con = mysql_connect("localhost","root","root");
	if (!$con)
	  {
		 die('Could not connect: ' . mysql_error());
	  }

	mysql_select_db("ot", $con);
	mysql_query("set charset utf8");
?>