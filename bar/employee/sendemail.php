<?php
session_start();
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
require('../includes/config.php');
if(isset($_POST['email'])){
	
	$email=$_POST['email'];
	$sched=$_POST['sched'];
	$id=$_POST['id'];
	$sched=date_create($sched);
	$sched=date_format($sched,'F d,Y');
	
	$off="select appoffice_ID from appoint  where id='$id'";
	$r=mysqli_query($conn,$off);
	$ro=mysqli_fetch_assoc($r);
	$offid=$ro["appoffice_ID"];

	$on="select office_name from offices  where id='$offid'";
	$rn=mysqli_query($conn,$on);
	$ron=mysqli_fetch_assoc($rn);
   $offname=$ron["office_name"];
	
	$upload_dir = "../img/";
	$img = $_POST['img'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $upload_dir . mktime().".png";

	if(file_put_contents($file, $data)){
			$insimg="update appoint set qr_img='$file' where id='$id'";
			if(mysqli_query($conn,$insimg)){

			$username=$_SESSION['user_name'];
			$developmentMode = false;
			
			$mail = new PHPMailer($developmentMode);
			try {
			 
			$mail->isSMTP();                            // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                     // Enable SMTP authentication
			$mail->Username = 'evsuoccregistrar@gmail.com';          // SMTP username
			$mail->Password = 'evsuoccregistrar2000!'; // SMTP password
			$mail->Debug=1;
							  // Enable TLS encryption, `ssl` also accepted
			 $mail->SMTPSecure = 'tls';
				$mail->Port = 587;                        // TCP port to connect to
					
			$mail->setFrom('evsuoccregistrar@gmail.com','EVSU-OCC');
			$mail->addAddress($email);   // Add a recipient


			$mail->isHTML(true);  // Set email format to HTML
			$mail->AddEmbeddedImage($file, 'qrimg', $file);
			
			$bodyContent ="<!DOCTYPE html>";
			$bodyContent .="<html>";
			$bodyContent .="<head>";
			$bodyContent .="<meta charset='utf-8'>";
			$bodyContent .="</head>";
			$bodyContent .="<body>";
			$bodyContent .="<h2>EVSU-OCC Appointment System</h2>";
			$bodyContent .="<h3>Your Appointment will be on ".$sched." </h3>";
			$bodyContent .="<h3>At ".$offname." Office</h3>";
			$bodyContent .="<h3>Transaction ID: <strong>".$id." </strong></h3>";
			$bodyContent .="<h3>Processed by: ".$username."</h3>";
			$bodyContent .="<br>";
			$bodyContent .="<h3>Present this QR Code at EVSU-OCC </h3>";
			$bodyContent .="<br>";
			$bodyContent .="<img src=\"cid:qrimg\" style='width:200px;height:200px;'/>";
			
			$bodyContent .="<br>";
			$bodyContent .="<br>";
			$bodyContent .="<h4>Thank you, Mabuhay!</h4>";
			$mail->Subject = 'EVSU-OCC TEAM';
			$bodyContent .="</body>";
			$bodyContent .="</html>";
			$mail->Body    = $bodyContent;

				
				if(!$mail->send()) 
					{
						echo "Error Sending Email!";

						
					} 
					else 
					{
						$up="update appoint set status='scheduled', date_of_appointment='$sched', processed_by='$username' where id='$id'";
						if(mysqli_query($conn,$up)){
							echo "1";
						}else{
							echo "error Settings Status!";
						}
						
						
					}
				
				
						
				} catch (Exception $e) {
					echo $e;

							
				}

			}
	}

	
			
}else{
	echo "<meta http-equiv='refresh' content='0;url=request.php'>";
	
}
?>