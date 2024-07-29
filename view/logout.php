<?php
session_start();
unset($_SESSION["username"]);
unset($_SESSION["roleid"]);
unset($_SESSION["uid"]);
unset($_SESSION["accountant_key"]);
session_destroy(); 

header("Location:login.php");
?>