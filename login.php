

<?php
//setcookie("last_page", "", time()+3600, '/');
session_start();

include("passwords.php");
if ($_POST["ac"]=="log") { /// do after login form is submitted 
     if ($USERS[$_POST["username"]]==$_POST["password"]) { /// check if submitted     username and password exist in $USERS array 
          $_SESSION["logged"]=$_POST["username"];
		
	   header("Location: home.php");		
	  // setcookie("last_page", "login.php", time()+3600, '/');
		  
     } else {
          //echo 'Incorrect username/password. Please, try again.';
     };
};  

if (array_key_exists($_SESSION["logged"],$USERS)) { //// check if user is logged or not 
     //echo "You are logged in."; //// if user is logged show a message 
	//var_dump($_COOKIE);
	header("Location: home.php");
} else
 { //// if not logged show login form
    //header("Location: home.php");
};


if(isset($_COOKIE['last_page']))
	{
		//var_dump($_COOKIE);
		header("Location: ".$_COOKIE['last_page']);

};



?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>AppsNA Reporting</title>
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" />
<link rel="stylesheet" href="assets/stylesheets/master.css" />

<!-- startup image for web apps - iPad - landscape (748x1024)    
Note: iPad landscape startup image has to be exactly 748x1024 pixels (portrait, with contents rotated).-->

<link rel="apple-touch-startup-image" href="./assets/images/landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />

<!-- startup image for web apps - iPad - portrait (768x1004) -->

<link rel="apple-touch-startup-image" href="./assets/images/portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" /> 


<link rel="apple-touch-icon" sizes="72x72" href="./assets/images/touch-icon-ipad.png" />


<!--[if IE 8]>
<link rel="stylesheet" href="assets/stylesheets/ie8.css" />
<![endif]-->
<!--[if !IE]><!-->
<!-- <script src="assets/javascripts/iscroll.js"></script> -->
<!--<![endif]-->
<script src="assets/javascripts/jquery.js"></script>
<script src="assets/javascripts/master.js"></script>
<script type="text/javascript">



function clear_username()
{
	document.getElementById('username').value="";
	var pass_word1 = document.getElementById('Passwd').value;
	if(pass_word1=="")
		document.getElementById('Passwd').type="text";
		document.getElementById('Passwd').value="Password";
}

function clear_pass()
{
	document.getElementById('Passwd').value="";
	document.getElementById('Passwd').type="password";
	var user_name1 = document.getElementById('username').value;
	if(user_name1=="")
		document.getElementById('username').value="Username";
	
}

function login()
{	
	var user_name = document.getElementById('username').value;
	var pass_word = document.getElementById('Passwd').value;
	if(user_name=="admin" && pass_word=="admin")
	window.location.href="./home.php";
	else
	alert('Invalid login. Please try again.');
	
}



</script>

</head>
<body>
<div id="main">
	<div class="abs header_upper chrome_dark">
		
		Apps NA Enterprise Reporting
	</div>
	<script>
	alert ($_COOKIE["username"]);
	</script>	
	<div id="main_content" class="abs">
		<div id="main_content_inner">
			<h1 align="center">
				
			</h1>
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
			
			<br/>
			
			<div align="center" style="margin:0 auto;width:30%;border:2px solid #ddd ;" class="header_upper chrome_dark">
		
			<b style="font-size:22px">Login</b>
			</div>
			<div  align="center"  style="margin:0 auto;width:30%;border:2px solid #ddd ;">
			<form action="login.php" method="post"><input type="hidden" name="ac" value="log"> <br/>
			<input type="text" style="font-size:20px;height:30%;width:75%" name="username" value="Username" onfocus="clear_username();" id="username"/><br/><br/>
			<input type="text" style="font-size:20px;height:30%;width:75%" name="password" value="Password" onfocus="clear_pass();" id="Passwd"/>
			<br/><br/> <input type="submit" style="width:50%;font-size:14px" value="Sign in" class="button"/><br/><br/>
			</form>
			
			</div><br/><br/>
			<img src = "./assets/images/login.png" style="margin-left:35%;width:30%; height:7%">
			<br/>
	
	<div class="abs footer_lower chrome_dark"></div>
		
		
		
	</div>
</div>

</body>
</html>


