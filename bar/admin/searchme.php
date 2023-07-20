<?php 
require('../includes/config.php');
if(isset($_GET['val'])){
		$name=$_GET['val'];
		if(empty($name)){
			echo "no records.";
		}else{

		

		$ins="SELECT employee_profile.id, employee_profile.fName, employee_profile.mName, employee_profile.lName,
					 employee_profile_benifits.employee_status AS status, employee_profile_benifits.id
			  FROM employee_profile 
			  LEFT JOIN employee_profile_benifits ON employee_profile.id = employee_profile_benifits.id
			  WHERE employee_profile.fName like '%$name%' or employee_profile.lName like '%$name%' or employee_profile.mName like '%$name%'";
		$res= mysqli_query($connvss,$ins);
		while($row=mysqli_fetch_assoc($res)){ 
			$id=$row['id'];
			$name=$row['fName']." ".$row['lName'];
			
			if ($row["status"] == "Active") { ?>
			 	<button class="btn btn-primary" onclick="addto('<?php echo $id;?>,<?php echo $name;?>')"><?php echo $name;?></button>
	    <?php }
			else{ ?>
				<button class="btn btn-danger" title="<?php echo $row["status"]?>" onclick="addto('<?php echo $id;?>,<?php echo $name;?>')" disabled><?php echo $name;?></button>
		<?php
			} 
	   }
	}
}
?>