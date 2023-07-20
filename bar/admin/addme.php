<?php 
require("../includes/config.php");
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$did=$_POST['dept'];

	$up="update employee_profile set departmentID='$did' where id='$id'";
	if(mysqli_query($conn,$up)){
		echo 1;
	}else{
		echo 0;
	}
}
?>