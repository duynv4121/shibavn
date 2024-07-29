<?php  
	function setrole1($uid,$roleid,$conn){
		$arr = [];
		$query = mysqli_query($conn,"SELECT * FROM ns_maprole WHERE userid = '$uid' AND roleid='$roleid' ORDER BY subroleid ASC") ;
		while ($result = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
			array_push($arr, $result['subroleid']);
		}
		return $arr;
	}

	function geturlsubrole($subroleid,$conn){
		$result = mysqli_fetch_assoc(mysqli_query($conn,"SELECT url FROM ns_subrole WHERE id = '$subroleid' ORDER BY ord ASC")) or die(mysql_error());
		return $result['url'];
	}

	function getrolename($rid){
		$query = mysqli_fetch_assoc(mysql_query("SELECT * FROM ns_role WHERE id='$rid'")) ;
		return $query['rolename'];
	}

	function getsubrolename($uid, $rid){
		$subroleids = [];
		$querysubroleids = mysql_query("SELECT * FROM ns_maprole WHERE roleid='$rid' AND userid='$uid'");
		while ($subrole = mysql_fetch_array($querysubroleids)) {
			array_push($subroleids, $subrole['subroleid']);
		}
		$namesubroles = [];
		for ($i=0; $i < sizeof($subroleids); $i++) { 
			$querysubrolename = mysql_fetch_assoc(mysql_query("SELECT * FROM ns_subrole WHERE id='$subroleids[$i]'"));
			array_push($namesubroles, $querysubrolename['subrole']);
		}
		return $namesubroles;
	}

	function getsubroles(){
		$query = mysql_query("SELECT * FROM ns_subrole ");
		return $query;
	}

	function deletesubrolelist($rid, $uid){
		$delete_query = mysql_query("DELETE FROM ns_maprole WHERE userid = '$uid' AND roleid = '$rid'");
	}

	function updatesubrolelist($rid, $uid, $chk){
		$insert_query = mysql_query("INSERT INTO ns_maprole (`roleid`,`userid`,`subroleid`) VALUES ('$rid', '$uid', '$chk')");
	}
?>