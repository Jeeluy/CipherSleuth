<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <?php echo $_SESSION["user_name"];?> 
    </a>

    

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="request.php" class="nav-link <?php if($pageid==1){ echo 'active';}?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Appointment Requests
                <span class="badge badge-danger" id="numreq2"><?php echo $cnt;?></span>
              </p>
            </a>
            
          </li>
           <li class="nav-item">
            <a href="scheduled.php" class="nav-link <?php if($pageid==4){ echo 'active';}?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Scheduled Appointments
                <span class="badge badge-danger" id="schedcnt"><?php echo $sc;?></span>
              </p>
            </a>
            
          </li>
           <li class="nav-item">
            <a href="declined.php" class="nav-link <?php if($pageid==5){ echo 'active';}?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Declined Requests
                
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="users.php" class="nav-link <?php if($pageid==2){ echo 'active';}?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="offices.php" class="nav-link <?php if($pageid==3){ echo 'active';}?>">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Offices
                
              </p>
            </a>
          </li>
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>