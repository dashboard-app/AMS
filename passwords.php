<?php
$USERS["username1"] = "password1";
$USERS["admin"] = "admin";
$USERS["username3"] = "password3";
  
function check_logged(){
     global $_SESSION, $USERS, $_COOKIE;
	 
     if (!array_key_exists($_SESSION["logged"],$USERS)) {
          
		  header("Location: login.php");
		  
     };
};
?>