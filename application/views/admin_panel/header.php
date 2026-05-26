  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url("$adminController/adminHome");?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      
	  <span class="logo-mini">Cinema News Agency</span> <!-- otherwise put a mini logo -->
	  
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $headTitle; ?></span>
      
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
		  
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url(); ?>uploads/profile_image/<?php echo $_SESSION['PROFILE_PHOTO'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION["ADMIN_ID"];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url(); ?>uploads/profile_image/<?php echo $_SESSION['PROFILE_PHOTO'];?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION["ADMIN_ID"];?>
                </p>
              </li>
              <!-- Menu Body -->
	      
	       <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div style="padding:15px;" class="fa fa-key">
                    <a style="cursor:pointer;" onclick="$('#changePasswordForm').modal('hide');$('#modal_form_chpass').modal('show');" id="changePassword">Change Password</a>
                  </div>
                 
                <!-- /.row -->
              </li>
			  
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="<?php echo base_url("$adminController/adminLogOut");?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        
		  <!-- Control Sidebar Toggle Button 
          
		  <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
         -->
		</ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url(); ?>/uploads/profile_image/<?php echo $_SESSION['PROFILE_PHOTO'];?>" class="img-circle" alt="User Image">
		 
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION["ADMIN_ID"];?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
			
			
	</ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="modal fade" id="modal_form_chpass" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Change Password</h3>
		<small>* indicates required field.</small>
            </div>
            <div class="modal-body form">
                <form action="#" id="form_chpass" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body">
                        
                        <div class="form-group">
                            <label for="Current_Password" class="control-label col-md-3">Current Password*</label>
                            <div class="col-md-9">
                                <input name="Current_Password" id="Current_Password" placeholder="Enter Your Current Password" class="form-control required" required type="Password">
                                <span class="help-block"></span>
                            </div>
                        </div>
						
						<div class="form-group">
                            <label for="New_Password" class="control-label col-md-3">New Password*</label>
                            <div class="col-md-9">
                                <input name="New_Password" id="New_Password" placeholder="Enter Your New Password" class="form-control required" required type="Password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
						<div class="form-group">
                            <label for="Confirm_Pass" class="control-label col-md-3">Confirm Password*</label>
                            <div class="col-md-9">
                                <input name="Confirm_Pass" id="Confirm_Pass" placeholder="Enter Your New Password" class="form-control required" required type="Password">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        
             
             
                
                </form>
            </div>
			
            <div class="modal-footer">
                
                <button type="button" id="btnChangePass" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            <div class="alert alert-danger alert-dismissable divError" style="margin-top:5px; text-align:left; display:none; color:red!important;" id="divErrorChPass" name="divErrorChPass"></div>
<div class="alert alert-success divMessage" style="margin-top:5px; text-align:left; display:none; color:green!important;" id="divMessageChPass" name="divMessageChPass"></div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</div>
