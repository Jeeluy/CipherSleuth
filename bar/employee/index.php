<?php 
session_start();
require("../includes/config.php");

if(isset($_COOKIE["admin_user"])){
  $_SESSION['user_email']=$_COOKIE["admin_user"];
}

if(isset($_SESSION['user_email'])){
  echo "<meta http-equiv='refresh' content='0;url=request.php'>";
} 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EVSU-OCC LOG IN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
   <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: url('../img/123.png'); background-repeat: no-repeat; background-size: cover;">
<div class="login-box">
  <?php 
  if(isset($_POST["submit"])){
      $email=$_POST["email"];
     $pass=md5($_POST["password"]);
      $cnt=0;

      $sl="select * from users where user_email='$email' and user_pass='$pass'";
      $res=mysqli_query($conn,$sl);
      while($row=mysqli_fetch_assoc($res)){
        $cnt=1;
        $_SESSION['user_officeID']=$row['useroffice_ID'];
        $_SESSION['user_email']=$row['user_email'];
        $_SESSION['user_name']=$row['user_name'];

      }
      
      if($cnt==1){
          if(isset($_POST["remember"])){
            $val=$_SESSION['user_email'];
           setcookie("admin_user", $val, time() + (86400 * 30), "/");
          }

        echo "<meta http-equiv='refresh' content='0;url=request.php'>";
      }else{ ?>

         <div id="alert" class="alert alert-danger">Error Logging In <i class="fa fa-times" style="float:right;" onclick="closeme()"></i> </div>
   <?php   }

  }
  ?>
      
       
      
  <!-- /.login-logo -->
  <div class="card" >
    <div class="card-body login-card-body" style="border-radius: 5px; box-shadow: 1px 2px 1px #000000;">
      <h2 class="login-box-msg"><strong>  Payroll System</strong></h2>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember" value="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

      <p class="mb-1">
       <!-- <a href="forgot-password.php">I forgot my password</a> -->
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript">
  function closeme(){
    document.getElementById("alert").style.display="none";
  }
</script>
</body>
</html>
