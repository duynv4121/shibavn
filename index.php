<?php  
	@session_start();
	if (!isset($_SESSION['uid'])) {
		header('Location: view/login.php');
	}else{
		header('Location: view/list_package.php');
		
	}
?>