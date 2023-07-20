<?php 
session_start();
$pageid=2;
require("../includes/config.php");
if(empty($_SESSION['user_email'])){
   echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}else{
 
}    

function dept($conn){
  $r="";
  $seldept="select * from department";
  $resdept=mysqli_query($conn,$seldept);
  while($rt=mysqli_fetch_assoc($resdept)){
    $r.="<option value=".$rt['id'].">".$rt['department']."</option>";
  }
  return $r;
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Users</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
   <link rel="stylesheet" href="dist/css/uname.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include("includes/header.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  
  <?php include("includes/aside.php");?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active"></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
          <div class="col-12">
            <div class="row">
            <div class="col-lg-4">
              <?php 
              if(isset($_POST["create"])){
                $name=$_POST['fname'];
                $email=$_POST['email'];
                $dept=$_POST['dept'];
                $pass=md5($_POST['pass']);
                $level=$_POST['level'];
                $cnt=0;
                

                $ins="insert into users(user_email,user_password,user_name,departmentID,user_level) values('$email','$pass','$name','$dept','$level')";
                  if(mysqli_query($conn,$ins)){ ?>

                    <div class="alert alert-success"> New user added</div>

          <?php  }
              }
              ?>
               
              <form action="" method="POST">
                <label>User Name</label>
              <input type="text" name="fname" placeholder="Enter Name" required class="form-control">
              <label>Email</label>
               <input type="email" name="email" placeholder="Enter Email" required class="form-control">
               <label>Password</label>
              <input type="text" name="pass" placeholder="Enter Password" required class="form-control">
              <label>Department</label>
              <select name="dept" class="form-control" required>
                <option value="" selected disabled>Select Department</option>
                <?php echo dept($conn);?>
              </select>
              <select name="level" class="form-control" required>
                <option value="" selected disabled>User Level</option>
                <option value="1">Administrator</option>
                <option value="2">Team Leader</option>
              </select>
              <button class="btn btn-primary mt-3" name="create"> Create User <i class="fa fa-plus"></i></button>
            </form>
            </div>
            
            <!-- /.card -->
             <div class="col-lg-8">
            <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="tbl1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $deptname='';
                    $sl="select * from users";
                    $res=mysqli_query($conn,$sl);
                    while($row=mysqli_fetch_assoc($res)){
                      $name=$row["user_name"];
                       $email=$row["user_email"];
                       $deptID=$row["departmentID"];
                       
                       $d="select * from department where id='$deptID'";
                       $se=mysqli_query($conn,$d);
                       $dp=mysqli_fetch_assoc($se);
                       $deptname=$dp['department'];

                         ?>



                         <tr>
                           <td><?php echo $name;?></td>
                           <td><?php echo $email;?></td>
                           <td><?php echo $deptname;?></td>
                           
                           <td>
                           
                              <button onclick="deleteuser(<?php echo $row["id"];?>)" class="btn btn-danger" title="Delete"><i class="fa fa-times"></i> </button>
                           </td>
                         
                            

                         </tr>     

                  <?php   }
                    ?>
                  </tbody>
                 
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   <?php include("includes/footer.php");?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#tbl1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    
  });
</script>
<script type="text/javascript">
  function deleteuser(val){
    if(confirm("Are you sure do you want to delete this user?")){
      $.ajax({
        url:"deleteuser.php",
        method:"post",
        data:{id:val},
        success: function(html){
          if(html==1){
            alert("User has been deleted.");
            location.href="";
          }else{
            alert(html);
          }
        }

      });
    }
  }
</script>
<script type="text/javascript">
  function setsound(){
    document.getElementById("soundme").play();
  }
  /**function notify(){
    $.ajax({
      url:"notify.php",
      cache:false,
      success: function(html){
       
        if(html!=null){
           var arr=html.split(",");
        var id=arr[0];
        var name=arr[1];
        var stat="New "+arr[2];
        var count=arr[3];
        if(id!=""){
            $("#reqcnt").append('<a href="request.php?rid='+id+'" class="dropdown-item"><i class="fas fa-envelope mr-2"></i>'+name+'<span class="float-right text-muted text-sm">'+stat+' <i class="fa fa-circle" style="color:orange;"></i> </span></a>');
            setsound();
        }
         $("#numreq").html(count);
          $("#numreq2").html(count);
        }
       

      }
    });
  }
  setInterval(notify,10000);**/
</script>
</body>
</html>
