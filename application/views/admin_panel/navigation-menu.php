
<!----- If usergroup table authority field is ADMIN this should come first at menu navigation--->
<?php if($_SESSION['ADMIN_USER_TYPE'] !="SUPER_ADMIN"): ?>	 
	 <?php 

	 		$mainMenuId =0;
			$isSub =FALSE;
			$isSubAdded =FALSE;
		                        
			foreach($admin_navigation  as $row):
				
				if($mainMenuId!=$row["Id"]):
				 $mainMenuId=$row["Id"]	;
                                 
                                 if($row["SubMenuItem"]=="NULL"):
                                     $db = new Database();
                                     $where = "MenuItemId='{$mainMenuId}' AND UserGroup='" . $_SESSION['ADMIN_USER_TYPE'] . "'";
                                     $rStatus  = $db->getFieldValueById("sys_user_group_menu", "Status", $where); // getting menu right status
	?>
			<?php if($row["MainStatus"]=="Showing"):?>  <!-- Main Status start -->
                                <?php if($rStatus=="1"):?>  <!-- Right status start  -->
				<li>
          		<a href="<?php echo base_url() .$row["linkPage"];?>">
				<i class="<?php echo $row["MainIcon"];?>"></i> <span><?php echo $row["MainMenu"];?></span>
				<?php if(!empty($row["countTitle"])):
                                   $count =0; 
                                   if(!empty($row["countTable"]))
                                   {       
										$db = new Database();
										$countWhere =$row["countWhereClause"];
										$count = $db->totalCount("Id", $row["countTable"], $countWhere);
										$db = NULL;
                                   }         
                                ?>
				<small class="label pull-right bg-green" title="<?php echo $row["countTitle"];?>"><?php echo $count; ?></small>
				<?php endif;?>
				
          		</a>
        		</li>
			 <?php endif;?> <!-- Main Status ends -->
                         <?php endif;?> <!-- Right Status ends -->
                         
    		 <?php endif; // if SubMenuItem ending ?>
	
	<?php
			if($row["SubMenuItem"]!="NULL"): // if submenu item not null
                                $db = new Database();
                                $where = "MenuItemId='{$mainMenuId}' AND UserGroup='" . $_SESSION['ADMIN_USER_TYPE'] . "'";
                                $rStatus  = $db->getFieldValueById("sys_user_group_menu", "Status", $where); // getting menu right status
                                
				$CI =& get_instance();
				$CI->load->model('AdminModel');
				$result = $CI->AdminModel->getSubMenuItem($row["Id"]);
				
				$total = $result->num_rows();
				$subMenu = $result->result_array();
				
    ?>
		<?php if($row["MainStatus"]=="Showing"):?>  <!-- Main Status start -->
                <?php if($rStatus=="1"):?>  <!-- Right status start  -->
			<li class="treeview">
          		<a href="#">
            		<i class="<?php echo $row["MainIcon"];?>">
					</i> <span><?php echo $row["MainMenu"];?></span> 
					<?php if(!empty($row["countTitle"])):
                                         $count =0; 
                                            if(!empty($row["countTable"]))
                                            {       
                                            $db = new Database();
                                            $countWhere =$row["countWhereClause"];
					    $count = $db->totalCount("Id", $row["countTable"], $countWhere);
                                            $db = NULL;
                                            }  
                                            
                                        ?>
					<small class="label pull-right bg-green" title="<?php echo $row["countTitle"];?>"><?php echo $count;?></small>
					<?php endif;?>
					<i class="fa fa-angle-left pull-right"></i>
          		</a>
				<ul class="treeview-menu">
				<?php 
					$countMenu=0;
					foreach($subMenu  as $subRow): // sub menu loop starts
					 $countMenu++;
					  if($subRow["SubStatus"]==1): // sub status start 
                                            
			     ?>		  
						<li class="active">
							<a href="<?php echo base_url(). $adminController . "/" . $subRow["SubPageLink"]; ?>">
								<i class="<?php echo $subRow["SubIcon"];?>"></i>
								<?php echo $subRow["SubMenuItem"];?>
				
							</a>
						</li>
					<?php if($countMenu==$total):?>
							</ul></li>
					<?php endif;?>	
				<?php endif;?>	<!-- sub status ends -->
					
				<?php endforeach;?><!-- sub menu loop ends -->
			<?php endif;?><!-- Right status ends -->		
			<?php endif;?><!-- main status ends -->	
			
			 		
	<?php	
			endif; // if SubMenuItem not null ending
			endif;
			endforeach;
			
	?>
                       
	
	<!----- If login table usertype field is SUPER_ADMIN : this should come last at menu navigation-->
	<?php elseif($_SESSION['ADMIN_USER_TYPE'] =="SUPER_ADMIN"): ?>
	
        <!----- all menus ------------------------------------------------------->
        <?php 

	 		$mainMenuId =0;
			$isSub =FALSE;
			$isSubAdded =FALSE;
                        
			foreach($admin_navigation  as $row):
				
				if($mainMenuId!=$row["Id"]):
				 $mainMenuId=$row["Id"]	;
                                 
                                 if($row["SubMenuItem"]=="NULL"):
                                     
	?>
			<?php if($row["MainStatus"]=="Showing"):?>  <!-- Main Status start -->
                                
				<li>
          		<a href="<?php echo base_url() . $row["linkPage"];?>">
				<i class="<?php echo $row["MainIcon"];?>"></i> <span><?php echo $row["MainMenu"];?></span>
				<?php if(!empty($row["countTitle"])):
                                   $count =0; 
                                   if(!empty($row["countTable"]))
                                   {       
                                    $db = new Database();
                                    $countWhere =$row["countWhereClause"];
				    $count = $db->totalCount("Id", $row["countTable"], $countWhere);
                                    $db = NULL;
                                   }         
                                ?>
				<small class="label pull-right bg-green" title="<?php echo $row["countTitle"];?>"><?php echo $count; ?></small>
				<?php endif;?>
				
          		</a>
        		</li>
			 <?php endif;?> <!-- Main Status ends -->
                         
                         
    		 <?php endif; // if SubMenuItem ending ?>
	
	<?php
			if($row["SubMenuItem"]!="NULL"): // if submenu item not null
                                
				$CI =& get_instance();
				$CI->load->model('AdminModel');
				$result = $CI->AdminModel->getSubMenuItem($row["Id"]);
				
				$total = $result->num_rows();
				$subMenu = $result->result_array();
				
    ?>
		<?php if($row["MainStatus"]=="Showing"):?>  <!-- Main Status start -->
                
			<li class="treeview">
          		<a href="#">
            		<i class="<?php echo $row["MainIcon"];?>">
					</i> <span><?php echo $row["MainMenu"];?></span> 
					<?php if(!empty($row["countTitle"])):
                                         $count =0; 
                                            if(!empty($row["countTable"]))
                                            {       
                                            $db = new Database();
                                            $countWhere =$row["countWhereClause"];
					    $count = $db->totalCount("Id", $row["countTable"], $countWhere);
                                            $db = NULL;
                                            }  
                                            
                                        ?>
					<small class="label pull-right bg-green" title="<?php echo $row["countTitle"];?>"><?php echo $count;?></small>
					<?php endif;?>
					<i class="fa fa-angle-left pull-right"></i>
          		</a>
				<ul class="treeview-menu">
				<?php 
					$countMenu=0;
					foreach($subMenu  as $subRow): // sub menu loop starts
					 $countMenu++;
					  if($subRow["SubStatus"]==1): // sub status start 
			     ?>		  
						<li class="active">
							<a href="<?php echo base_url(). $adminController . "/" . $subRow["SubPageLink"]; ?>">
								<i class="<?php echo $subRow["SubIcon"];?>"></i>
								<?php echo $subRow["SubMenuItem"];?>
							</a>
						</li>
					<?php if($countMenu==$total):?>
							</ul></li>
					<?php endif;?>	
				<?php endif;?>	<!-- sub status ends -->
					
				<?php endforeach;?><!-- sub menu loop ends -->
					
			<?php endif;?><!-- main status ends -->	
			
			 		
	<?php	
			endif; // if SubMenuItem not null ending
			endif;
			endforeach;
			
	?>
        
        
        <!----- all menus ending --------------------------------------------------->
        
        
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bug"></i>
            <span>Super Admin</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
         <ul class="treeview-menu">
            <li><a href="<?php echo base_url(). $adminController; ?>/adminMainMenu" title="Add or edit new admin main navigation menu item"><i class="fa fa-circle-o"></i>Admin Main menu item</a></li>
            <li><a href="<?php echo base_url(). $adminController; ?>/adminSubMenu" title="Add or edit new admin main navigation sub menu item"><i class="fa fa-circle-o"></i>Admin Sub menu item</a></li>
	    <li><a href="#" title="Add or edit new site main navigation menu item"><i class="fa fa-circle-o"></i>Site Main menu item</a></li>
            <li><a href="#" title="Add or edit new site main navigation sub menu item"><i class="fa fa-circle-o"></i>Site Sub menu item</a></li>
	    <li><a href="#" title="Change the log of the site"><i class="fa fa-circle-o"></i>Upload site menu logo</a></li>
	    <li><a href="#" title="Add or edit user group and rights"><i class="fa fa-circle-o"></i>User group</a></li>
	    <li><a href="<?php echo base_url(). $adminController; ?>/userLog" title="Shows the site user log"><i class="fa fa-circle-o"></i>User log</a></li>
	     <li><a href="#" title="Shows the site user log details"><i class="fa fa-circle-o"></i>User log details</a></li>
	    <li><a href="#" title="Shows the site error log and download the errorlog.txt file"><i class="fa fa-circle-o"></i>Error log</a></li>
	     <li><a href="#" title="Change the images in pages"><i class="fa fa-circle-o"></i>Site image upload</a></li>
	     <li><a href="#" title="Add or edit site gallery images"><i class="fa fa-circle-o"></i>Gallery</a></li>
	    <li><a href="#" title="Shows the complaints and suggessions"><i class="fa fa-circle-o"></i>Complaints & Suggessions</a></li>	
          </ul>
        </li>
        <?php endif; ?>
	
