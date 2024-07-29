<?php  
	//$db = @mysql_connect('localhost','u172977508_ns','Sang@123')or die("Database không kết nối được");
	 //@mysql_select_db("u172977508_ns")or die("Không tìm thấy table");
	//@mysql_set_charset('utf8', $db);
date_default_timezone_set('Asia/Ho_Chi_Minh');
	
$servername = "localhost";
$db_username = "root";
$db_password = "";
$db_dbname = "shibavn";
$string_code_bag = 'GPE';

	
	$conn = new mysqli($servername, $db_username, $db_password, $db_dbname);

	$conn -> set_charset("utf8");
?>
