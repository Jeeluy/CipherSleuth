<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
     
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge" id="numreq"><?php echo $cnt;?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="reqnotifi">
          <span class="dropdown-item dropdown-header">Notifications</span>
          <div class="dropdown-divider"></div>
          <div id="reqcnt">
           </div> 
          <div style="font-family: arial;">
            <?php 
            $sel="select * from appoint where status!='scheduled' and status!='Declined' and appoffice_ID='$officeID'   order by id desc";
          $res=mysqli_query($conn,$sel);
          while($row=mysqli_fetch_assoc($res)){ 
            $id=$row['id'];
             $name=$row['app_name'];
             $stat=$row['status']; ?>
                <a href="request.php?rid=<?php echo $id;?>" class="dropdown-item"><div class="uname"><i class="fas fa-envelope mr-2"></i> <?php echo $name;?></div>  
                  <span class="float-right text-muted text-sm"> <?php echo $stat;?> 
                    <i class="fa fa-circle" style="color:red;"></i>
                </span></a> 
    
          <?php  }?>
            
          
          </div>
          
          <div class="dropdown-divider"></div>
          <a href="request.php" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

  <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="reqnotifi">
          <span class="dropdown-item dropdown-header">Settings</span>
          <div class="dropdown-divider"></div>
          <!--<a href="settings.php" class="dropdown-item">
            <i class="fas fa-cog mr-2"></i> Change password
            
          </a>-->
          <div class="dropdown-divider"></div>
           <a href="logout.php" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i>Log Out
           
          </a>
         
          
      </li>

      
    </ul>
  </nav>