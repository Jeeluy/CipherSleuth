<?php 
session_start();
$pageid=5;
require("../includes/config.php");
if(empty($_SESSION['user_email'])){
   echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}else{
 
}
$officeID=$_SESSION["user_officeID"];
  $cnt=0;  
  $sel="select * from appoint where status='Declined'  and appoffice_ID='$officeID' ";
  $res=mysqli_query($conn,$sel);
  while($row=mysqli_fetch_assoc($res)){ 
      $cnt+=1;
    
     }
    $sc=0;  
  $sel="select * from appoint where status='scheduled' and appoffice_ID='$officeID'";
  $res=mysqli_query($conn,$sel);
  while($row=mysqli_fetch_assoc($res)){ 
      $sc+=1;
    
     }    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Declined Requests</title>
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
   <link rel="stylesheet" href="../css/sent.css">
   <script type="text/javascript" src="../qr/qrcode.js"></script>
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
 <div class="modal" id="modalsending" style="display:none;">
    <div class="modal-content">
      
      <div class="modal-body" style="padding-top:30px;">
        <center>
          <div id="sendingid">
            <div class="loader"></div>
            <p>Please Wait....</p>
          </div> 
         
        
        </center>
        <br>
      </div>
      
    </div>
    
  </div>
  <div class="modal" id="modalsending2" style="display:none; z-index: 100;">
    <div class="modal-content">
      
      <div class="modal-body" style="padding-top:30px;">
        <center>
          <div id="sendingid">
            <div class="loader"></div>
            <p>Please Wait....</p>
          </div> 
         
        
        </center>
        <br>
      </div>
      
    </div>
    
  </div>

  <div class="modal" id="modalsent" style="display: none;">
    <div class="modal-content">
     
      <div class="modal-body">
        <center>
          
         <div id="sentid">
           <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
        
          <span> Email Sent </span><br>
          <button class="btnclose" onclick="closending()" id="btnclose" >&nbsp Dismiss <i class="fa fa-times"></i>&nbsp </button>
         </div> 
         </center> 
        
         <div class="modal-footer">
          <center> 

          </center>
          
           </div>
         
      </div>
      
    </div>
    
  </div>

  <div class="modal" id="modalprocess" style="display: none;">
    <div class="modal-content" style="width: 20%;">
     
      <div class="modal-body">
        <center>
          
         <div id="sentid">
           <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
        
          <span><i class="fa fa-user"></i> Requestor has been notified </span><br>
          <button class="btnclose" onclick="closending()" id="btnclose" >&nbsp Dismiss <i class="fa fa-times"></i>&nbsp </button>
         </div> 
         </center> 
        
         <div class="modal-footer">
          <center> 

          </center>
          
           </div>
         
      </div>
      
    </div>
    
  </div>

  <div class="modal" id="modalsched" style="display: none;">
    <div class="modal-content" style="width: 30%;">
     <div class="modal-header" style="width: 100%;background-color: #f3f3f3; text-align: right;">
        <button class="btn btn-danger" style="float:right; " onclick="hidesched()"><i class="fa fa-times"></i></button>
     </div>
      <div class="modal-body">
        <center>
      
             <div id="qrcode" style="width:200px; height:200px;"></div>
             <input style="display:none;" id="qrtext" type="text"  style="width:80%" />
  
          <label>Requestor Email</label>
          <input type="text" name="rqemail" id="rqemail" readonly required class="form-control">
          <label>Request ID</label>
          <input type="text" name="rqid" id="rqid" readonly required class="form-control">
          <label>Set schedule for Appointment</label>
          <input type="date" name="rqsched" id="rqsched" required class="form-control" min="<?php echo date('Y-m-d');?>">
           <br> 
          <button class="btn btn-primary form-control" onclick="sendfinish()" >Send <i class="fa fa-check"></i> </button>
         
         </center> 
        
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
            <h1>Declined Requests</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
              <li class="breadcrumb-item active">Declined</li>
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
             
              <!-- /.card-header -->
              <div class="card-body" style="overflow-x: scroll;">
                <table id="tbl1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Code</th>
                    <th>ID#</th>
                    <th>Requestor</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    
                     <th>Purpose</th>
                      
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(isset($_GET["rid"])){
                        $id=$_GET["rid"]; 
                           $sl="select * from appoint where id='$id'";
                    $res=mysqli_query($conn,$sl);
                    while($row=mysqli_fetch_assoc($res)){
                      $name=$row["app_name"];
                       $email=$row["app_email"];
                        $idnum=$row["app_IDNUMBER"];
                         $phone=$row["app_phone"];
                          
                            $purp=$row["purpose"];
                             $stat=$row["status"];
                              $stamp=$row["stamp"]; 
                              
                              $code=$row["id"];
                              ?>



                         <tr>
                          <td><?php echo $code;?></td>
                           <td><?php echo $idnum;?></td>
                           <td><?php echo $name;?></td>
                           <td><?php echo $email;?></td>
                           <td><?php echo $phone;?></td>
                           
                           <td><?php echo $purp;?></td>

                          
                           <td>
                            <?php 
                            if($stat=="Ready to claim"){ ?>
                             
                               <span style="color:green;"><strong> <?php echo $stat;?> </strong> </span><br> 
                         


                           <?php  }else if($stat=="Processing"){ ?>

                                 <span style="color:orange;"><strong> <?php echo $stat;?> </strong> </span><br> 

                          <?php  }else{ ?>

                                 <span style="color:red;"><strong> <?php echo $stat;?> </strong> </span><br> 


                          <?php  }
                        
                          ?>
                            



                            <span>date: <?php echo $stamp;?></span> 
                           </td>
                           <td>
                            <button onclick="sendme('<?php echo $id?>,<?php echo $email?>')" class="btn btn-success" title="Appoint Schedule Now?"><i class="fa fa-reply"></i></button>

                            

                            <button onclick="removeme('<?php echo $id?>')" class="btn btn-danger" title="Delete"><i class="fa fa-times"></i> </button>
                            <button onclick="commentme('<?php echo $id?>,<?php echo $email?>')" class="btn btn-warning" title="Comment"><i class="fa fa-comment"></i> </button>
                           </td>

                         </tr>     

                  <?php   }






                    }else{

              $sl="select * from appoint where status='Declined' and appoffice_ID='$officeID' ";
                    $res=mysqli_query($conn,$sl);
                    while($row=mysqli_fetch_assoc($res)){
                       $id=$row["id"];
                      $name=$row["app_name"];
                       $email=$row["app_email"];
                        $idnum=$row["app_IDNUMBER"];
                         $phone=$row["app_phone"];
                          
                            $purp=$row["purpose"];
                             $stat=$row["status"];
                              $stamp=$row["stamp"]; 
                              
                              $code=$row["id"];
                              ?>



                         <tr>
                          <td><?php echo $code;?></td>
                           <td><?php echo $idnum;?></td>
                           <td><?php echo $name;?></td>
                           <td><?php echo $email;?></td>
                           <td><?php echo $phone;?></td>
                           
                           <td><?php echo $purp;?></td>
                           
                           <td>
                            <?php 
                            if($stat=="Ready to claim"){ ?>
                              <span style="color:green;"><strong> <?php echo $stat;?> </strong> </span>

                          <?php  }else if($stat=="Processing") { ?>
                                  <span style="color:orange;"><strong> <?php echo $stat;?> </strong> </span>
                            
                          <?php  }else{ ?>
                                <span style="color:red;"><strong> <?php echo $stat;?> </strong> </span>

                         <?php }
                              ?>
                            
                            



                            <br> 
                            <span>date: <?php echo $stamp;?></span> 
                           </td>
                           <td>
                             
                           

                            <button onclick="removeme('<?php echo $id?>')" class="btn btn-danger" title="Decline"><i class="fa fa-times"></i> </button>
                            

                         </tr>     

                  <?php   }



                      }


                    




                    ?>
                  </tbody>
                 
                </table>
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
  function setsound(){
    
    var x = document.getElementById("soundme");
    x.autoplay = true;
    x.load();
  }
  function notify(){
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
            $("#reqcnt").append('<a href="request.php?rid='+id+'" class="dropdown-item"> <div class="uname"><i class="fas fa-envelope mr-2"></i> '+name+'</div> <span class="float-right text-muted text-sm">'+stat+' <i class="fa fa-circle" style="color:red;"></i> </span></a>');
            setsound();
        }
         $("#numreq").html(count);
          $("#numreq2").html(count);
        }
       

      }
    });
  }
  setInterval(notify,10000);
</script>
<script type="text/javascript">
  function sendme(valid){
    var val= valid.split(",");
    var valid=val[0];
    var emailid=val[1];
    
      
    
    $.ajax({
         url:"encrypt.php",
         method:"post",
          data:{id:valid},
          success: function(html){
            if(html!=0){
              
               $("#modalsched").fadeIn();
               $("#rqemail").val(emailid);
                $("#rqid").val(valid);
                 $("#qrtext").val(html);

                 var qrcode = new QRCode(document.getElementById("qrcode"), {
                  width : 200,
                  height : 200
                });

                function makeCode () {    
                  var elText = document.getElementById("qrtext");
                  
                  if (!elText.value) {
                    
                    elText.focus();
                    return;
                  }
                  
                  qrcode.makeCode(elText.value);
                }

                makeCode();

            }else{
              alert(html);
              location.href="";
            }
        }
    });    
   
    
  }
  function sendfinish(){
    var email=$("#rqemail").val();
   var rid=$("#rqid").val();
   var sched=$("#rqsched").val();
   
   var bimg=$("#qrid").attr("src");

  
   
    if(sched != ""){

       $("#modalsched").fadeOut();
      $("#modalsending").fadeIn();
        $.ajax({
         url:"sendemail.php",
         method:"post",
          data:{email:email, id:rid, sched:sched,img:bimg},
          success: function(html){
            if(html==1){
               $("#modalsending").fadeOut();
               $("#modalsent").fadeIn();
            }else{
              alert(html);
              location.href="";
            }
        }
    });
    }else{
      alert("Please Enter Amount and Schedule so that the requestor will be notified.");
    }
   
  }   
  
  function removeme(val){
    if(confirm("Are you sure do you want to remove this request?")){
      
              $.ajax({
              url:"remove_req.php",
              method:"post",
              data:{id:val},
              success: function(html){
                if(html==1){
                  alert("Request has been removed.");
                  location.href="";
                }else{
                  alert(html);
                }
              }

            });
          }
  }
  function declineme(val){

    if(confirm("Are you sure do you want to Decline this request?")){
      var r;
      var fil=val.split(",");
      var id=fil[0];
      var email=fil[1];

      

      if(r=prompt("What is your reason for declining this request?")){
 $("#modalsending").fadeIn();
              $.ajax({
              url:"sendprocess.php",
              method:"post",
              data:{id:id,rid:r,email:email},
              success: function(html){
                if(html==1){
                   $("#modalsending").fadeOut();
                    $("#modalprocess").fadeIn();
                }else{
                  alert(html);
                }
              }

            });
          }

      }else{
        alert("Give a reason for declining request.");
        location.href="";

      }
      

  }
  function claimme(val){
    if(confirm("Mark as Finished to this request?")){
      $.ajax({
        url:"finish_req.php",
        method:"post",
        data:{id:val},
        success: function(html){
          if(html==1){
            alert("Request finished.");
            location.href="";
          }else{
            alert(html);
          }
        }

      });
    }
  }
 function commentme(val){
  var fil=val.split(",");
  var id=fil[0];
  var email=fil[1];
   $("#modalcomment").fadeIn();
   $("#trs").html(id);
   $("#trnum").val(id);
   $("#tremail").val(email);
   
  }
  function closending(){
   $("#modalsent").fadeOut();
   $("#modalprocess").fadeOut();
   location.href="";
  }
   function hidesched(){
   $("#modalsched").fadeOut();
   $("#modalcomment").fadeOut();
  location.href="";
  }

   function processme(valid){
    var val= valid.split(",");
    var valid=val[0];
    var emailid=val[1];
    
    if(confirm("Process documents now?")){
      $("#modalsending").fadeIn();
        $.ajax({
         url:"sendprocess.php",
         method:"post",
          data:{email:emailid, id:valid},
          success: function(html){
            if(html==1){
               $("#modalsending").fadeOut();
               $("#modalprocess").fadeIn();
            }else{
              alert(html);
              location.href="";
            }
        }
    });
    }
   
    
  }
   function sendcomment(){
    /*var id=  $("#trnum").val();
    var email=$("#tremail").val();
    var comm=$("#trcomment").val();
    
    
    if(comm!=""){
      $("#modalsending").fadeIn();
      $("#modalcomment").fadeOut();
        $.ajax({
         url:"sendcomment.php",
         method:"post",
          data:{email:email, id:id, comm:comm},
          success: function(html){
            if(html==1){
               $("#modalsending").fadeOut();
               $("#modalprocess").fadeIn();
            }else{
              alert(html);
              location.href="";
            }
        }
    });
    }else{
      alert("You should enter your comment.");
    }*/   
   

               
  }
</script>
<script type="text/javascript">
  var am=document.querySelector("#amount");

    am.addEventListener("input",restrict);

    function restrict(e){
      var newValue = this.value.replace(/[^0-9\.]/g,'');
        if(newValue.split('.').length>2) {
                newValue =newValue.replace(/\.+$/,"");
        }
          

          this.value = newValue;

           
         
    }
</script>
<script type="text/javascript">
    const url='sendcomment.php';
    var form=document.getElementById('formcomm');
     form.addEventListener('submit', e => {
    e.preventDefault();
      $("#modalsending2").fadeIn();
    const files = document.querySelector('[type=file]').files;
    var id=document.getElementById('trnum').value;
    var email=document.getElementById('tremail').value;
     var comm=$("#trcomment").val();
    const formData = new FormData();

    for (let i = 0; i < files.length; i++) {
        let file = files[i];

        formData.append('files[]', file);
    }

    formData.append('id', id);
    formData.append('email', email);
    formData.append('comm', comm);
    fetch(url, {
        method: 'POST',
        body: formData
    }).then(response => {
        return response.text();
    }).then(data => {
         if(data==100){
          $("#modalsending2").hide();
           $("#modalprocess").fadeIn();
            $("#modalcomment").fadeOut();
            console.log(data);
        
         } else{
          console.log(data);
         }     
       
    });
});
</script>
</body>
</html>
