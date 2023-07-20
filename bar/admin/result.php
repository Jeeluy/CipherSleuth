<?php 
require("../includes/config.php");
if(isset($_POST["from"])){
	$from=$_POST["from"];
	$to=$_POST["to"]; ?>

<table id="tbl1" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                          <th>Employee ID</th>
                          <th>Employee Name</th>
                          <th>Menu Name</th>
                           <th>Amount</th>
                          <th>Date Created</th>
                          <th>Action</th>
                      </tr>
                     
                    </thead>
                    <tbody>
                      <?php 
                       $am=0;
                        $sel="select * from orders where date_created>='$from' and date_created<='$to'";
                        $res=mysqli_query($conn,$sel);
                        while($rt=mysqli_fetch_assoc($res)){ 
                        	$am+=$rt['amount'];
                          $mid = $rt['menu_id'];
                            $menu = "SELECT * FROM menu where id = '$mid'";
                            $mquery = mysqli_query($conn,$menu);
                            $fetch = mysqli_fetch_assoc($mquery);

                        	?>
                          <tr>
                            <td><?php echo $rt['Customer_ID'];?></td>
                            <td><?php echo $rt['Customer_Name'];?></td>
                            <td><?php echo $fetch['Name'];?></td>
                            <td>&#8369 <?php echo $rt['amount'];?></td>
                            <td><?php echo $rt['date_created'];?></td>
                            <td>
                              <button class="btn btn-primary" onclick="editme('<?php echo $rt['id'];?>,<?php echo $rt['Customer_ID'];?>,<?php echo $rt['Customer_Name'];?>,<?php echo $fetch['Name'];?>,<?php echo $rt['amount'];?>,<?php echo $rt['date_created'];?>')"> Edit</button>
                               <a href="agent_sales.php?aID=<?php echo $rt['Customer_ID'];?>" class="btn btn-success"><i class="fa fa-eye"></i> View More</a>
                              
                           </td>
                          </tr>
                       <?php }
                      ?>
                   </tbody>
</table>
<strong><span >Total Amount : </span><span>&#8369 <?php echo number_format($am,'2');?></span></strong>

<?php }

?>

