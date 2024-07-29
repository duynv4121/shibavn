<?php 
	function getUsers(){
		$query = mysql_query("SELECT * FROM ns_user");
		return $query;
	}

	function getUserDropdownList(){
		$query = mysql_query("SELECT * FROM ns_user ");
		return $query;
	}
?>