<?php
// jSON URL which should be requested
include("../conn/db.php");
  @session_start();
	if (!isset($_SESSION['username']) || $_SESSION['type'] !=1) {
		 header('Location: login.php');
	}

?>

					
					<?php
					
				if(isset($_GET['id']))
				{
									$id = $_GET['id'];
							
									mysqli_query($conn,"UPDATE `ns_user` SET `active`='2' WHERE (`id`='$id')");
								
									header('Location: ' . $_SERVER['HTTP_REFERER']);


				}

					?>