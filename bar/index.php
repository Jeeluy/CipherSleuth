<?php 
session_start();
require('includes/config.php');
if(isset($_SESSION['un'])){

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>vss | Bar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="includes/vssfinal.svg"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('');">
			<div class="wrap-login100">
				<?php 
				if(isset($_POST['login'])){
					$id=$_POST['id'];
					$pass=md5($_POST['pass']);
					$count=0;
					$sl="select * from users where id='$id' and password='$pass'";
					$res=mysqli_query($conn,$sl);
					while($row=mysqli_fetch_assoc($res)){
						$count=1;
						$_SESSION['un']=$row['Name'];

					}
					if($count==1){
						 echo "<meta http-equiv='refresh' content='0;url=admin/index.php'>";
					}else{ ?>
						<div class="alert alert-danger">UserID or Password Incorrect!</div>
				<?php	}
				}
				?>
				<form class="login100-form validate-form" action="" method="post">
					<span class="login100-form-logo">
						<img src="includes/vssfinal.svg" style="width:100%;">
					</span>
					<span class="login100-form-title p-b-20 p-t-20">
						VSS BAR
					</span>
					<div class="wrap-input100 validate-input" data-validate = "Enter ID number">
						<input class="input100" type="text" name="id" placeholder="ID number">
						<span class="focus-input100" 	data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login">
							Login
						</button>
					</div>

					
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>