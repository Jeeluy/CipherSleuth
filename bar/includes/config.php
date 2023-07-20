<?php 

$host="192.168.11.195";
$user="vssadmin";
$pass="Kk9566678@!";
$dbase="bar";

if($conn=mysqli_connect($host,$user,$pass,$dbase)){
	
}else{
	echo "Not connected to database";
}

$host="192.168.11.16";
$user="vssadmin";
$pass="Kk9566678@!";
$dbase="vss_db";

if($connvss=mysqli_connect($host,$user,$pass,$dbase)){
	
}else{
	echo "Not connected to database";
}

?>
