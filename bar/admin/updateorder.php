<?php 
require('../includes/config.php');
if(isset($_POST['cid'])){
		$orderID=$_POST['orderID'];
		$cid=$_POST['cid'];
		$cname=$_POST['cname'];
		
		$amount=$_POST['amount'];
		$datec=$_POST['datec'];
		$qnty=$_POST['qnty'];

		$ins="update orders  set Customer_Name='$cname', Customer_ID='$cid', amount='$amount', date_created='$datec', quantity='$qnty' where id='$orderID'";
		if(mysqli_query($conn,$ins)){
			echo 1;
		}else{
			echo mysqli_error($conn);
		}
}
?>