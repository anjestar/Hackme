<?php  
/*
 *保存答题情况到session
 *
 */
$T = $_POST['T'];
@$answer = $_POST['ANS'];
session_start();
$_SESSION[$T]=$answer;
if(!isset($_SESSION['UID'])) {echo "骚年，答题以前先登录一下呗！";exit();}
if($T=='TS'|$T=='TI'|$T=='TU'|$T=='TN'|$T=='TD'){
	if($_SESSION[$T]==$_SESSION[$T."_ANS"])
		echo "Congratulations!	-回答正确！最后一定记得提交答案哦！^_^";
	else
		echo "Wrong!	-回答错误！^_^";
}
else echo "你选择的答案为：".$_SESSION[$T]."<br>答题成功！<br>等所有题目都答完后记得提交！";


?>  