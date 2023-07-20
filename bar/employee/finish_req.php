<?php 
require("../includes/config.php");
if(isset($_POST["id"])){
	$id=$_POST["id"];

	$del="update requests set status='Finished' where id='$id'";
	if(mysqli_query($conn,$del)){
		echo 1;
	}else{
		echo 'error finishing request!';
	}
}
?>