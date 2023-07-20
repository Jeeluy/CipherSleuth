<?php
require("../includes/config.php");
// from view-attendance.php with js onchange="date_picker(this.value);
if (isset($_POST['date_picker'])) {
 $var=$_POST['date_picker'];

}
?>

<table id="tbl1" class="table">
                  <thead>
                  <tr>
                    <th>ID#</th>
                    <th>Day</th>
                    <th>Full Name</th>
                    <th>Department / L.O.B.</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Login</th>
                    <th>Log-out</th>
                    <th>Day Type</th>
                    <th></th>
                    
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                   $dtype="";
                   $agent_id="";
                   $present="";
                   $d_type="";
                    $att="select * from attendance where day='$var'";
                    
                    $res=mysqli_query($conn,$att);
                    while($row=mysqli_fetch_assoc($res)){
                      $id=$row['id'];
                      $agent_id=$row['agent_id'];
                      $dtype_id=$row['dtype_id'];
                      $present=$row['present'];

                      $date_complete=$row['day'];
                      $day_c = new DateTime($date_complete);
                      $date = date_format($day_c, 'F j, Y - l ');

                      $log_in=$row['login'];
                      $date_in = new DateTime($log_in);
                      $rowDate_in = date_format($date_in, 'h:i A');

                      $log_out=$row['logout'];
                      $date_out = new DateTime($log_out);
                      $rowDate_out = date_format($date_out, 'h:i A');

                      $dtype_id=$row['dtype_id'];

                      $que="select * from employee_profile where id='$agent_id'";
                      $ress=mysqli_query($conn,$que);
                      $fetch = mysqli_fetch_assoc($ress);
                      $emp=$fetch['fName']." ".$fetch['lName'];
                      $depart=$fetch['departmentID'];
                      $e_id=$fetch['id'];

                      $d="select * from department where id='$depart'";
                      $dd=mysqli_query($conn,$d);
                      $ddd=mysqli_fetch_assoc($dd);
                      $deptt=$ddd['department'];
                      
                      $e="select * from employee_profile_standing where id='$e_id'";
                      $ee=mysqli_query($conn,$e);
                      $eee=mysqli_fetch_assoc($ee);
                      $position=$eee['job_title'];

                      $f="select * from attendance_status where id='$present'";
                      $ff=mysqli_query($conn,$f);
                      $fff=mysqli_fetch_assoc($ff);
                      $pres=$fff['status'];

                      $g="select * from day_type where id='$dtype_id'";
                      $gg=mysqli_query($conn,$g);
                      $ggg=mysqli_fetch_assoc($gg);
                      if (!empty($ggg['abbr'])){
                         $d_type=$ggg['abbr'];
                      }

                      ?>      
                    <tr>
                        <td><?php echo $agent_id;?></td>
                        <td><?php echo $date;?></td>
                        <td><?php echo $emp;?></td>
                        <td><?php echo $deptt;?></td>
                        <td><?php echo $position;?></td>
                        <td><?php echo $pres;?></td>
                        <td><?php echo $rowDate_in;?></td>      
                        <td><?php echo $rowDate_out;?></td>
                        <td><?php echo $d_type?></td>
                        <td><button onclick="clearme(<?php echo $row['id'];?>)" class="btn btn-primary"> Clear</button></td>
                    </tr>
                   

                     <?php }

                    ?>
                  </tbody>
                 
</table>