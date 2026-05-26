  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(). "uploads/profile_image/" . $_SESSION['PROFILE_PHOTO'];?>" class="img-circle changeImage" alt="User Image">
		 
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["ADMIN_ID"];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
	  
      
	  <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
	
	<?php require_once("navigation-menu.php"); ?>	
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>