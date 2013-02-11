<?php
session_start();
session_unset();
session_destroy();	
setcookie("last_page","", time()-3600, '/');
header("Location: login.php");
?> 