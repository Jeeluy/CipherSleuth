<?php 
require("../includes/config.php");
// if(isset($_POST['empID'])){


$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = json_decode($json);


$today=$data[0];

 $count=count($data);
for($i=1;$i<$count;$i++){
    $c=0;

    $empinfo=explode(";", $data[$i]);

     $empID=$empinfo[0];
     $stat=$empinfo[1]; 
     $in=$empinfo[2]; 
     $out=$empinfo[3]; 
     $late=$empinfo[4]; 
     $undertime=$empinfo[5]; 
     $overtime=$empinfo[6];
     $sh_hr=$empinfo[7];
     $rh_hr=$empinfo[8]; 
     $day_type=$empinfo[9];   
     $departmentID=$empinfo[10];

    $sql= "INSERT INTO attendance(
            agent_id,
            login,
            logout,
            late,
            undertime,
            overtime,
            sh_hr,
            rh_hr,
            present,
            day,
            dtype_id,
            departmentID)
          VALUES(
            '$empID',
            '$in',
            '$out',
            '$late',
            '$undertime',
            '$overtime',
            '$sh_hr',
            '$rh_hr',
            '$stat',
            '$today',
            '$day_type',
            '$departmentID')";
    if (mysqli_query($conn,$sql)) {
      echo "data inserted!";
    }else{
      echo mysqli_error($conn);
      }
}
