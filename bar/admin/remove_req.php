<?php 
require("../includes/config.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];

	$del="delete from appoint where id='$id'";
	if(mysqli_query($conn,$del)){
		echo 1;
	}else{
		echo 'error deleting request!';
	}
}

if(isset($_POST["removeid"])){
	$id=$_POST["removeid"];

	$del="delete from timelogs where id='$id'";
	if(mysqli_query($conn,$del)){
		echo 1;
	}else{
		echo 'error deleting request!';
	}
}
?>