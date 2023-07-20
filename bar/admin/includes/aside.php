<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
     <div class="col-lg-12">
      <center>
        <img style="width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    border:solid #8706c7;
                    object-fit: cover;
                    margin-top: 15px;
                    object-position: center right;" src="<?php echo $_SESSION["photo"];?>">
        <h5 style="color:#f3f3f3;">
             <?php echo $_SESSION["un"];?> 
           </h5>
      </center>
        
        
    </div>
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item">
            <a href="index.php" class="nav-link <?php if($pageid==3){ echo 'active';}?>">
              <i class="nav-icon fas fa-palette"></i>
              <p>
               Records
                
              </p>
            </a>
            
          </li> 
           <li class="nav-item">
            <a href="sales.php" class="nav-link <?php if($pageid==2){ echo 'active';}?>">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
               Sales per Item
                
              </p>
            </a>
            
          </li>    
          
         
          
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    
    
    <!-- /.sidebar -->
  </aside>