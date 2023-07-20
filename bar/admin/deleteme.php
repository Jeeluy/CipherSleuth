<?php 
require("../includes/config.php");
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$del="delete from orders where id='$id'";
	if(mysqli_query($conn,$del)){
		echo 1;
	}else{
		echo mysqli_error($conn);
	}
}
?>