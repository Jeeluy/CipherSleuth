<?php
session_start();
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';
require('../includes/config.php');
if(isset($_POST['email'])){

	$loading=0;

	$email=$_POST['email'];
	$id=$_POST['id'];
	$comm=$_POST['comm'];
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
			if (isset($_FILES['files'])) {
					$count = count($_FILES['files']['tmp_name']);
			   		
					for ($i = 0; $i < $count; $i++) {  
						$tmpFile = $_FILES['files']['tmp_name'][$i]; 
						if ($tmpFile != ""){ 
							$newFilePath = "../img/" . $_FILES['files']['name'][$i]; 
						} 
						 $name = $_FILES['files']['name'][$i];
   						
						if(move_uploaded_file($tmpFile, $newFilePath)){
							if(!$mail->addAttachment($newFilePath,$name)){
								echo "failed to attache file";
							}else{
								 
							}	
						}
					}
				}else{
					 
				}
			
			$bodyContent ="<!DOCTYPE html>";
			$bodyContent .="<html>";
			$bodyContent .="<head>";
			$bodyContent .="<meta charset='utf-8'>";
			$bodyContent .="</head>";
			$bodyContent .="<body>";
			$bodyContent .="<h2>Welcome to EVSU-OCC Appointment System</h2>";
			$bodyContent .="<h3>".$comm."</h3>";
			$bodyContent .="<h3>Transaction ID: <strong>".$id." </strong></h3>";
			$bodyContent .="<h3>Processed by: ".$username."</h3>";
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
							$loading=100;
							
						echo $loading;
						
						
					}
				
				
						
			} catch (Exception $e) {
				echo $e;

						
			}

	
			
}else{
	echo "<meta http-equiv='refresh' content='0;url=request.php'>";
	
}
?>