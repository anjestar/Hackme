<html>
<head>
	<meta charset="UTF-8">
	<title>百度相册</title>
</head>
<body>
<center><img src="photo.jpg"/><br>
<form action="" method = "post" name = "pswForm">
<input id="password" name="password" type="password"/><br>
<button class="btn hk_base_submit" type="button" onclick="return check()">登录</button>
</form>
</center>
<SCRIPT language=javascript>
<!--
if (window.Event)
document.captureEvents(Event.MOUSEUP);
function nocontextmenu(){
event.cancelBubble = true
event.returnValue = false;
return false;
}
function norightclick(e){
if (window.Event){
if (e.which == 2 || e.which == 3)
return false;
}
else
if (event.button == 2 || event.button == 3){
event.cancelBubble = true
event.returnValue = false;
return false;
}
}
document.oncontextmenu = nocontextmenu; // for IE5+
document.onmousedown = norightclick; // for all others
//-->
function check(){ 
var f = document.pswForm; 
var Psw = f.password.value; 
if(Psw ==""){ 
alert("密码框不能为空!"); 
return false; 
} 
if(Psw == "xiaohuagogo!"){ 
alert("密码正确，登录成功!"); 
return true;  
} 
alert("密码错误!");
return false; 
} 
</SCRIPT>
</body>
</html>