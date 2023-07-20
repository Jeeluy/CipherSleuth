<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="col-lg-12">
      <center>
        <img  class="brand-logo m-t-12" src="../includes/vssfinal.svg" style="max-width: 60px;">
        <h5 style="color:#f3f3f3;">
             <?php echo $_SESSION["user_name"];?> 
           </h5>
      </center>
        
        
    </div>
     
    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           
          <li class="nav-item">
            <a href="tl_view.php" class="nav-link <?php if($pageid==1){ echo 'active';}?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Employees
                
              </p>
            </a>
            
          </li>
           <li class="nav-item">
            <a href="add_to_dept.php" class="nav-link <?php if($pageid==2){ echo 'active';}?>">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Add Employee
                
              </p>
            </a>
            
          </li>
           
         
          
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    
    
    <!-- /.sidebar -->
  </aside>