<html>
<head>
	<meta charset="UTF-8">
	<title>答题记录Get√</title>
</head>
<body>
<?php
	error_reporting(0);

	date_default_timezone_set("Asia/Shanghai");

	session_start();

	$_SESSION['TIME']=date('Y-m-d H:i:s');
	$UID=$_SESSION['UID'];
	$USERNAME=$_SESSION['USERNAME'];
	$T1=$_SESSION['T1'];
	$T2=$_SESSION['T2'];
	$T3=$_SESSION['T3'];
	$T4=$_SESSION['T4'];
	$T5=$_SESSION['T5'];
	$T6=$_SESSION['T6'];
	$T7=$_SESSION['T7'];
	$T8=$_SESSION['T8'];
	$T9=$_SESSION['T9'];
	$T10=$_SESSION['T10'];
	$T11=$_SESSION['T11'];
	$T12=$_SESSION['T12'];
	$T13=$_SESSION['T13'];
	$T14=$_SESSION['T14'];
	$T15=$_SESSION['T15'];
	$T16=$_SESSION['T16'];
	$T17=$_SESSION['T17'];
	$T18=$_SESSION['T18'];
	$T19=$_SESSION['T19'];
	$T20=$_SESSION['T20'];
	$TS=$_SESSION['TS'];
	$TI=$_SESSION['TI'];
	$TU=$_SESSION['TU'];
	$TN=$_SESSION['TN'];
	$TD=$_SESSION['TD'];
	$TIME=$_SESSION['TIME'];

	echo "最后提交时间：".$TIME;

		$score=0;
		if($_SESSION['T1']==$_SESSION['T1_ANS']) $score=$score+10;
		if($_SESSION['T2']==$_SESSION['T2_ANS']) $score=$score+10;
		if($_SESSION['T3']==$_SESSION['T3_ANS']) $score=$score+10;
		if($_SESSION['T4']==$_SESSION['T4_ANS']) $score=$score+10;
		if($_SESSION['T5']==$_SESSION['T5_ANS']) $score=$score+10;
		if($_SESSION['T6']==$_SESSION['T6_ANS']) $score=$score+10;
		if($_SESSION['T7']==$_SESSION['T7_ANS']) $score=$score+10;
		if($_SESSION['T8']==$_SESSION['T8_ANS']) $score=$score+10;
		if($_SESSION['T9']==$_SESSION['T9_ANS']) $score=$score+10;
		if($_SESSION['T10']==$_SESSION['T10_ANS']) $score=$score+10;
		if($_SESSION['T11']==$_SESSION['T11_ANS']) $score=$score+10;
		if($_SESSION['T12']==$_SESSION['T12_ANS']) $score=$score+10;
		if($_SESSION['T13']==$_SESSION['T13_ANS']) $score=$score+10;
		if($_SESSION['T14']==$_SESSION['T14_ANS']) $score=$score+10;
		if($_SESSION['T15']==$_SESSION['T15_ANS']) $score=$score+10;
		if($_SESSION['T16']==$_SESSION['T16_ANS']) $score=$score+10;
		if($_SESSION['T17']==$_SESSION['T17_ANS']) $score=$score+10;
		if($_SESSION['T18']==$_SESSION['T18_ANS']) $score=$score+10;
		if($_SESSION['T19']==$_SESSION['T19_ANS']) $score=$score+10;
		if($_SESSION['T20']==$_SESSION['T20_ANS']) $score=$score+10;
		if($_SESSION['TN']==$_SESSION['TN_ANS']) $score=$score+50;
		if($_SESSION['TS']==$_SESSION['TS_ANS']) $score=$score+50;
		if($_SESSION['TI']==$_SESSION['TI_ANS']) $score=$score+50;
		if($_SESSION['TU']==$_SESSION['TU_ANS']) $score=$score+50;
		if($_SESSION['TD']==$_SESSION['TD_ANS']) $score=$score+80;
		//echo "当前积分为：".$score."分<br><br>";
	include 'conn.php';
	$query = mysql_query("SELECT * FROM ANS_RECORD WHERE uid=$UID",$con);
	if(mysql_num_rows($query) > 0)
		{	
			mysql_query("UPDATE ANS_RECORD SET t1='$T1',t2='$T2',t3='$T3',t4='$T4',t5='$T5',t6='$T6',t7='$T7',t8='$T8',t9='$T9',t10='$T10',t11='$T11',t12='$T12',t13='$T13',t14='$T14',t15='$T15',t16='$T16',t17='$T17',t18='$T18',t19='$T19',t20='$T20',ts='$TS',ti='$TI',tu='$TU',tn='$TN',td='$TD',score='$score',time='$TIME'
	WHERE uid = '$UID' AND username = '$USERNAME'",$con);
	echo "<br/><br/>更新答案成功！";
		}
	else{
		mysql_query("INSERT INTO ANS_RECORD VALUES('$UID','$USERNAME','$T1','$T2','$T3','$T4','$T5','$T6','$T7','$T8','$T9','$T10','$T11','$T12','$T13','$T14','$T15','$T16','$T17','$T18','$T19','$T20','$TS','$TI','$TU','$TN','$TD','$score','$TIME')",$con);

		echo "<br/><br/>提交答案成功";
		}

	mysql_close($con);

	echo "<br><br>参赛者信息：".$USERNAME."<BR><br>你提交的答案为:<BR><br>".$T1."|".$T2."|".$T3."|".$T4."|".$T5."|".$T6."|".$T7."|".$T8."|".$T9."|".$T10."|".$T11."|".$T12."|".$T13."|".$T14."|".$T15."|".$T16."|".$T17."|".$T18."|".$T19."|".$T20."|".$TS."|".$TI."|".$TU."|".$TN."|".$TD;
?>
</body>
</html>