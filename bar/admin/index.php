<?php 
session_start();
$pageid=3;
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
    $m.="<option value=".$row['id'].">".$row['Name']."</option>";
  }

  return $m;
}   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Canteen Reocords</title>
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

  <style type="text/css">
  .image-cover {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  object-fit: cover;
  object-position: center right;
  }
 </style>
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
          <!-- <label>Menu</label>
          <select name="menu" id="menuName_edit" class="form-control">
            <option value="">Select Menu</option>
            <?php echo menu($conn);?>
          </select> -->
          <label>Amount</label>
          <input type="text" name="Amount" id="amount_edit" required class="form-control">
          <label>Quantity</label>
          <input type="text" name="qnty_edit" id="qnty_edit" required class="form-control">
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
          <label>Quantity</label>
          <input type="text" name="qnty" id="qnty" required class="form-control">
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
              <h1>Records</h1>
            </div>
            <div class="d-flex p-1">
             <div class="col-lg-4">
                  <button class="btn btn-primary" onclick="showme()">Add Sale</button>
                </div>
                <div class="col-lg-4">
                  <?php 
                  if(isset($_POST['add'])){
                    $mname=$_POST['menuname'];
                    $counter=0;
                    $sl="select * from menu where Name like '%$mname%'";
                    $res=mysqli_query($conn,$sl);
                    while($row=mysqli_fetch_assoc($res)){ 
                      $counter=1;
                    }
                    if($counter==1){ ?>
                      <div id="alertid" class="alert alert-danger"> Menu Already Exist! <span onclick="hidealert()" class="fa fa-times" style="float:right;" ></span></div>
                   <?php }else{

                    
                    $insert="insert into menu(Name) values('$mname')";
                    if(mysqli_query($conn,$insert)){ ?>

                      <div class="alert alert-success">Data Added!</div>
                    <meta http-equiv='refresh' content='0;url=index.php'>
                   <?php }else{ ?>

                     <div class="alert alert-danger">Failed to Add Data! contact the developer.</div>
                   <?php } 
                    }
                  }
                  ?>
                <form action="" method="post">
                  <label>Menu Name</label>
                  <input type="text" name="menuname" required class="form-control">
                  
                  <button class="btn btn-primary" name="add">Add Menu</button>
                </form>

                </div>
              
            </div>
             
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Employee Record</li>
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
              		
              	
                 <table id="tbl1" class="table table-hover table-bordered">
                    <thead>
                      <tr>
                          <th>Employee ID</th>
                          <th>Employee Name</th>
                          <th>Menu Name</th>
                           <th>Quantity</th>
                           <th>Amount</th>
                          <th>Date Created</th>
                          <th>Action</th>
                      </tr>
                     
                    </thead>
                    <tbody>
                      <?php 
                      
                      $am=0;
                        $sel="select * from orders order by id desc LIMIT 400";
                        $res=mysqli_query($conn,$sel);
                        while($rt=mysqli_fetch_assoc($res)){ 

                          

                    				if(is_numeric($rt['amount'])){
                    					$am+=$rt['amount'];
                    				}
                            $mID=$rt['menu_id'];
                        	$sm="select * from menu where id='$mID'";
					               $sres=mysqli_query($conn,$sm);
                         $fres=mysqli_fetch_assoc($sres);
                          $menu_name="";
                         if(!empty($fres['Name'])){
                          $menu_name=$fres['Name'];
                         }
                         
                        	?>
                          <tr id="r<?php echo $rt['id'];?>">
                            <td>
                              
                              <?php echo $rt['Customer_ID'];?></td>
                            <td><?php echo $rt['Customer_Name'];?></td>
                            <td><?php echo $menu_name;?></td>
                             <td><?php echo $rt['quantity'];?></td>
                            <td>&#8369 <?php 
                        					if(is_numeric($rt['amount'])){
                        					echo number_format($rt['amount'],2);
                        					}
					
					

            				?>
            			</td>
                            <td><?php echo $rt['date_created'];?></td>
                            <td>
                              <button class="btn btn-primary" onclick="editme('<?php echo $rt['id'];?>,<?php echo $rt['Customer_ID'];?>,<?php echo $rt['Customer_Name'];?>,<?php echo $rt['menu_name'];?>,<?php echo $rt['amount'];?>,<?php echo $rt['date_created'];?>,<?php echo $rt['quantity'];?>')"><i class="fa fa-pencil-alt"></i> Edit</button>
                              <a href="agent_sales.php?aID=<?php echo $rt['Customer_ID'];?>" class="btn btn-success"><i class="fa fa-eye"></i> View More</a>
                               <button class="btn btn-danger" onclick="deleteme('<?php echo $rt['id'];?>')"><i class="fa fa-times"></i></button>
                           </td>
                          </tr>
                       <?php }
                      ?>
                   </tbody>
                  </table>

                  <strong><span >Total Amount : </span><span>&#8369 <?php echo number_format($am,'2');?></span></strong>
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
  function save(){
    var cid=$("#customer_id").val();
    var cname=$("#customer_name").val();
    var menuName=$("#menuName").val();
    var amount=$("#amount").val();
    var datec=$("#datec").val();
    var qnty=$("#qnty").val();
if(qnty=="" || qnty==null){
  alert("Please Enter Quantity");
  return;
}else if(menuName=="" || menuName==null){
	alert("Please Enter Menu Name!");
  return;

}else if(cid=="" || cid==null){
  alert("Please Retype the name of employee and click on the suggested name within the blue box!");
return;
}else if(datec=="" || datec==null){
alert("Please select date!");
return;
}else if(amount=="" || amount==null){
alert("Please Enter Amount!");
return;
}else{
	 $.ajax({
      url:'insertorder.php',
      method:'post',
      data:{cid:cid, cname:cname, menuName: menuName, amount:amount,datec:datec,qnty:qnty},
      success: function(response){
        if(response==1){
         alert("Data Inserted!");		
          location.href="";
        }else{
          alert(response);
        }
        
      }
    });
}
   
  }

  
  function showme(){
    $('#modalsale').fadeIn();
  }
  function hidesale(){
    $('#modalsale').fadeOut();
    
  }
  function hideedit(){
     $('#modaledit').fadeOut();
   }

  function editme(val){
    var exp=val.split(",");
    var id=exp[0];
    var cid=exp[1];
    var cname=exp[2];
    var menuname=exp[3];
    var amount=exp[4];
    var datec=exp[5]; 
    var qnty=exp[6];

     $("#modaledit").fadeIn();
     $("#orderid").val(id);
     $("#customer_id_edit").val(cid);
    $("#customer_name_edit").val(cname);
    $("#menuName_edit").val(menuname);
    $("#amount_edit").val(amount);
    $("#datec_edit").val(datec);
    $("#qnty_edit").val(qnty);

  }
  function update(){
    var orderID=$("#orderid").val();
     var cid=$("#customer_id_edit").val();
    var cname=$("#customer_name_edit").val();
    //var menuName=$("#menuName_edit").val();
    var amount=$("#amount_edit").val();
    var datec=$("#datec_edit").val();
     var qnty=$("#qnty_edit").val();

    $.ajax({
      url:'updateorder.php',
      method:'post',
      data:{cid:cid, cname:cname, amount:amount, datec:datec, orderID:orderID,qnty:qnty},
      success: function(response){
        if(response==1){
          location.href="";
        }else{
          alert(response);
        }
        location.href="";
      }
    });

  }

  function searchme(val){
    $("#ccontainer").show();
    if(val==""){

    }else{
      $.ajax({
      url:'searchme.php',
      method:'GET',
      data:{val: val},
      success: function(html){
          $("#ccontainer").html(html);
      }
    });
    }
    
  }

  function addto(va){
    var exp=va.split(",");
    var id=exp[0];
    var name=exp[1];
    $("#ccontainer").hide();
    $("#customer_id").val(id);
    $("#customer_name").val(name);
  }

  function findme(){
  	var from=$("#fromd").val();
  	var to=$("#tod").val();

  	if(from=="" || to==null){
  		alert("Please select start date!");
  	}else{
  		 $.ajax({
		      url:'result.php',
		      method:'POST',
		      data:{from: from, to:to},
		      success: function(html){
		      	 $("#tblcontainer").fadeIn();
		          $("#tblcontainer").html(html);
		          $("#tbl1").DataTable({
				      "responsive": true,
				      "autoWidth": false,
				    });
		      }
		    });	
  	}
  }
  function deleteme(rt){
  	if(confirm("Are you sure you want to delete this item?")){
  		 $.ajax({
		      url:'deleteme.php',
		      method:'POST',
		      data:{id: rt},
		      success: function(html){
		      	if(html==1){
		      		alert("Item has been deleted!");
		      		$('#r'+rt).fadeOut();
		      	}else{
		      		alert(html);
		      	}
		      }
		    });	
  	}
  }
</script>
<script type="text/javascript">
  var am=document.querySelector("#amount");
  var cm=document.querySelector("#amount_edit");
  var qnty=document.querySelector("#qnty");
  var qnty_edit=document.querySelector("#qnty_edit");

    am.addEventListener("input",restrict);

    function restrict(e){
      var newValue = this.value.replace(/[^0-9\.]/g,'');
        if(newValue.split('.').length>2) {
                newValue =newValue.replace(/\.+$/,"");
        }
          this.value = newValue;
         
    }
    cm.addEventListener("input",restrict);

    function restrict(e){
      var newValue = this.value.replace(/[^0-9\.]/g,'');
        if(newValue.split('.').length>2) {
                newValue =newValue.replace(/\.+$/,"");
        }
          this.value = newValue;
         
    }

    qnty.addEventListener("input",restrict);
    function restrict(e){
      var newValue = this.value.replace(/[^0-9\.]/g,'');
        if(newValue.split('.').length>2) {
                newValue =newValue.replace(/\.+$/,"");
        }
          this.value = newValue;
         
    }

     qnty_edit.addEventListener("input",restrict);
    function restrict(e){
      var newValue = this.value.replace(/[^0-9\.]/g,'');
        if(newValue.split('.').length>2) {
                newValue =newValue.replace(/\.+$/,"");
        }
          this.value = newValue;
         
    }

  function hidealert(){
    $('#alertid').hide();
  }  
</script>

</body>
</html>
