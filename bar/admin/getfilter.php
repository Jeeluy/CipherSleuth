<?php 
require("../includes/config.php");

if(isset($_POST['deptid'])){ 

	$deptid=$_POST['deptid'];?>
	

<table id="tbl1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                   
                    <th>ID#</th>
                    <th>Full Name</th>
                    
                     <th>Department</th>
                     <th>Role</th>
                     
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $phone="";
                      $email="";
                      $tin="";
                      $sss="";
                      $hdmf="";
                      $philhealth="";
                     $sle="select * from employee_profile where departmentID='$deptid'";

                     $rese=mysqli_query($conn,$sle);
                     while($row=mysqli_fetch_assoc($rese)){ 
                      $id=$row['id'];
                      
                        // $scon="select * from employee_profile_contact where id='$id'";
                        // $rescon=mysqli_query($conn,$scon);
                        // while($rcon=mysqli_fetch_assoc($rescon)){
                        //    $phone=$rcon['mobile']; 
                        //    $email=$rcon['email']; 
                        // } 

                        $sben="select * from employee_profile_standing where id='$id'";
                        $resben=mysqli_query($conn,$sben);
                        while($rben=mysqli_fetch_assoc($resben)){
                           
                           $role=$rben['job_title'];
                           
                        } 

                        $sbe="select * from department where id='$deptid'";
                        $resb=mysqli_query($conn,$sbe);
                        $rb=mysqli_fetch_assoc($resb);
                           
                           $department=$rb['department'];
                           
                        
                      ?>
                        <tr>
                              <td><?php echo $row['id'];?></td>
                              <td><?php echo $row['fName']." ".$row['mName']." ".$row['lName'];?></td>
                              <td><?php echo $department;?></td>
                              <td><?php echo $role;?></td>
                              
                             <td><button  class="btn btn-primary" onclick="open_new(<?php echo $id;?>)"> More details </button></td>
                        </tr>


                   <?php  } 

                    ?>
                  </tbody>
                 
                </table>
<?php }	
?>
