<?php 
require("../includes/config.php");

if(isset($_POST['attID'])){
	$d=$_POST['attID'];
	$password=$_POST['pass'];
	$pass="Kk9566678910@";

	if($pass==$password){
		$delete="delete from attendance where id='$d'";
		if(mysqli_query($conn,$delete)){
			echo "1";
		}
	}else{
		echo "Password Incorrect";
	}

}
	
?>