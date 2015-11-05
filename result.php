<html>
<head>
	<meta charset="UTF-8">
	<title>排行榜</title>
	<link rel="stylesheet" href="Public/static/bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php
	error_reporting(0);
	if($_GET['pwd']=='hackme'){
		include "conn.php";
		$result=mysql_query("SELECT * FROM ans_record ORDER BY score DESC LIMIT 50");
		echo "<br/><center><h1>JustHackMe实时排行榜</h1></center>";
		echo "<br/><div class='row-fluid'>
		<div class='span2'></div>
		<div class='span8'>
		<table border=1 class='table'><tr><td>最终名次：</td><td>参赛者ID：</td><td>参赛者信息：</td><td>获得积分：</td><td>最后提交时间：</td></tr>";
		$count=1;
		while($row=mysql_fetch_row($result)) 
		{ 
		echo "<tr>
		  <td><span class='badge badge-default'>".$count."</span></td>
		  <td>".$row[0]."</td>
		  <td><span class='badge badge-success'>".$row[1]."</span></td>
		  <td>".$row[27]."分</td>
		  <td>".$row[28]."</td>
		  </tr>";
		  $count++;
		}
		echo "</table></div><div class='span2'></div></div>";
	}
	else
		echo "<br/><center>请等待主办方告知查看密码，使用方式为:<code>http://www.mydomain.com/result.php?pwd=mima</code>，请使用密码查看实时排行榜！</center>";
?>
</body>
</html>