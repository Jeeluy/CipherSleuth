<?php 
session_start();

require("../includes/config.php");

$officeID=$_SESSION["user_officeID"];
	$cnt=0;
	$id="";	
	$name="";	
	$stat="";	 
	$sel="select * from appoint where status!='scheduled' and status!='Declined' and appoffice_ID='$officeID'";
	$res=mysqli_query($conn,$sel);
	while($row=mysqli_fetch_assoc($res)){ 
			$cnt+=1;
		
		 }

	$sel="select * from appoint where status='request' and appoffice_ID='$officeID' LIMIT 1";
	$res=mysqli_query($conn,$sel);
	while($row=mysqli_fetch_assoc($res)){ 
		$id=$row['id'];
		$name=$row['app_name'];
		$stat=$row['status'];
		
		
		 }

	$update="update appoint set status='requesting' where id='$id'";
	if(mysqli_query($conn,$update)){

	}

	echo $id.','.$name.','.$stat.','.$cnt;
?>