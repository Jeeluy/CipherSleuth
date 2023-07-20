<?php 
require('../includes/config.php');
if(isset($_POST['cid'])){
		$cid=$_POST['cid'];
		$cname=$_POST['cname'];
		$menuID=$_POST['menuName'];
		$amount=$_POST['amount'];
		$datec=$_POST['datec'];
		$qnty=$_POST['qnty'];
		$sm="select * from orders where Customer_Name='$cname' and amount='$amount' and date_created='$datec' and menu_id='$menuID' and quantity='$qnty'";
		$count=0;
		$res=mysqli_query($conn,$sm);
		while($row=mysqli_fetch_assoc($res)){
			$count=1;
		}

		if($count==1){
			echo "Duplicate Entry Please check your list!";
		}else{
			$ins="insert into orders(Customer_ID,Customer_Name,amount,menu_id,date_created,quantity) values('$cid','$cname','$amount','$menuID','$datec','$qnty')";
				if(mysqli_query($conn,$ins)){
					echo 1;
				}else{
					echo mysqli_error($conn);
				}
		}
		
}
?>