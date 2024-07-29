<?php  
	$db = @mysql_connect('localhost','u172977508_ns','Sang@123')or die("Database không kết nối được");
	@mysql_select_db("u172977508_ns")or die("Không tìm thấy table");
	@mysql_set_charset('utf8', $db);
?>
