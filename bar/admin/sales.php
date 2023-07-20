<?php 
session_start();
$pageid=2;
require("../includes/config.php");
if(empty($_SESSION['un'])){
   echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
}else{
 
}
function menu($c){
  $m="";
  $sel="select * from menu";
  $r=mysqli_query($c,$sel);
  while($row=mysqli_fetch_assoc($r)){
    $m.="<option value=".$row['Name'].">".$row['Name']."</option>";
  }

  return $m;
}   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bar Records</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="../includes/vssfinal.svg"/>
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
   <link rel="stylesheet" href="../css/sent.css">
   
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">


  <div class="modal" id="modaledit" style="display: none;">
    <div class="modal-content" style="width: 40%;">
     <div class="modal-header" style="width: 100%;background-color: #f3f3f3; text-align: right;">
        <button class="btn btn-danger" style="float:right; " onclick="hideedit()"><i class="fa fa-times"></i></button>
     </div>
      <div class="modal-body">
        
      
             
             
          <label>Order ID</label>
          <input type="text" name="orderid" id="orderid" readonly  required class="form-control">    
          <label>ID Number</label>
          <input type="text" name="customer_id"  id="customer_id_edit" autocomplete="off" required class="form-control">
          <label>Name</label>
          <input type="text" name="customer_name"  id="customer_name_edit"  autocomplete="off" required class="form-control">
          <label>Menu</label>
          <select name="menu" id="menuName_edit" class="form-control">
            <option value="">Select Menu</option>
            <?php echo menu($conn);?>
          </select>
          <label>Amount</label>
          <input type="text" name="Amount" id="amount_edit" required class="form-control">
           <label>Date Created</label>
          <input type="date" name="datec" id="datec_edit" required class="form-control">
           <br> 
          <button class="btn btn-success form-control" onclick="update()" >Update <i class="fa fa-check"></i> </button>
         
        
        
         <div class="modal-footer">
         
          
           </div>
         
      </div>
      
    </div>
    
  </div>
 

 

  

  <div class="modal" id="modalsale" style="display: none;">
    <div class="modal-content" style="width: 40%;">
     <div class="modal-header" style="width: 100%;background-color: #f3f3f3; text-align: right;">
        <button class="btn btn-danger" style="float:right; " onclick="hidesale()"><i class="fa fa-times"></i></button>
     </div>
      <div class="modal-body">
        
      
             
             
  
          <label>ID Number</label>
          <input type="text" name="customer_id" id="customer_id" autocomplete="none"  readonly required class="form-control">
          <label>Name</label>
          <input type="text" name="customer_name" id="customer_name"  autocomplete="none" onkeyup="searchme(this.value)" required class="form-control">

          <div id="ccontainer">
            
          </div>
          <label>Menu</label>
          <select name="menu" id="menuName"  class="form-control">
            <option value="">Select Menu</option>
            <?php echo menu($conn);?>
          </select>
          <label>Amount</label>
          <input type="text" name="Amount" id="amount" required class="form-control">
           <label>Date Created</label>
          <input type="date" name="datec" id="datec" required class="form-control">
           <br> 
          <button class="btn btn-primary form-control" onclick="save()" >Save<i class="fa fa-check"></i> </button>
         
        
        
         <div class="modal-footer">
         
          
           </div>
         
      </div>
      
    </div>
    
  </div>

  <div class="modal" id="modalcomment" style="display: none;">
    <div class="modal-content" style="width: 30%;">
     <div class="modal-header" style="width: 100%;background-color: #f3f3f3; text-align: right;">
        <button class="btn btn-danger" style="float:right; " onclick="hidesched()"><i class="fa fa-times"></i></button>
     </div>
      <div class="modal-body">
        <center>
          <h3>Comment Section</h3>
            <span>Transaction Number : <span id="trs"></span></span>  
            <form method="post" enctype="multipart/form-data" id="formcomm" name="formcomm">
               
                
            

            <input type="text" name="id" id="trnum" style="display: none;">
            <input type="text" name="email" id="tremail" style="display: none;">   
            <textarea cols="8" rows="8" name="comm" id="trcomment" class="form-control" placeholder="Write here..."></textarea>
          <br> 
          <span style="float:left;">Add Attachement(s)</span><br>
           <input type="file" name="files[]" multiple style="float:left;margin-bottom: 20px;">
           <button class="btn btn-primary form-control">Send <i class="fa fa-check"></i> </button>
         </form>
        
         </center> 
        
         <div class="modal-footer">
          
          
           </div>
         
      </div>
      
    </div>
    
  </div>

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
            <div class="d-flex p-1">
              <h1>Sales</h1>
            </div>
            
             
            
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
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card">
             <div class="card-header">
             	<div class="row">
             	<div class="col-lg-2">
             		<label>From</label><br>
             		<input type="date" name="fromd" id="fromd">
             	</div>
             	<div class="col-lg-2">
             		<label>To</label><br>
             		<input type="date" name="tod" onchange="findme()" id="tod">
             	</div>
             	</div>
             </div>
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
              	<div id="tblcontainer">
              		
                  <table class="table table-hovered" id="tbl1">
                    <thead>
                     <tr>
                       <th>Item Name</th>
                       <th>Amount</th>
                       <th>Quantity</th>
                       
                     </tr> 
                   </thead>
                   <tbody>
                   <?php 
                      $sl="select * from menu order by Name asc";
                      $res=mysqli_query($conn,$sl);
                      $count=0;
                      $total=0;
                      while($row=mysqli_fetch_assoc($res)){
                        $menu=$row['Name'];
                        $mid=$row['id'];  ?>
                        <tr>
                          <?php    
                    $amount=0;
                    $crt=0;
                        $sal="select * from orders where menu_id='$mid'";
                        $ret=mysqli_query($conn,$sal);
                        while($rot=mysqli_fetch_assoc($ret)){
                          $amount+=$rot['amount'];
                          $total+=$amount;
                          $crt+=1;
                        } ?>

                        <td><?php echo $menu;?></td>
                        <td>
                          <?php 
                              if(is_numeric($amount)){

                                echo  number_format($amount);
                              }
                            ?>
                              
                        </td>
                         <td></td>  

                   <?php   }
                    ?>

                        </tr>
                        </tbody>
                        
                  </table>
                  <div class="col-lg-12">
                    <button class="btn btn-success">
&#8369; <?php echo number_format($total,2);?></button>
                  </div>
                  </div>
              </div>
              <!-- /.card-body -->
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
   function findme(){
    var from=$("#fromd").val();
    var to=$("#tod").val();

    if(from=="" || to==null){
      alert("Please select start date!");
    }else{
       $.ajax({
          url:'salesresult.php',
          method:'POST',
          data:{from: from, to:to},
          success: function(html){
             $("#tblcontainer").fadeIn();
              $("#tblcontainer").html(html);
             
          }
        }); 
    }
  }
</script>

</body>
</html>
