<?php 
require('../includes/config.php');
if(isset($_POST['paramID'])){
		$paramID=$_POST['paramID'];
		$del="delete from checklist_parameters where id='$paramID'";
		
		if(mysqli_query($conn_qa,$del)){
			echo 1;
		}else{
			echo mysqli_error($conn_qa);
		}	
}
?>