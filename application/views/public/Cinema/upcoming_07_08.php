<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>

  <body>
	
		 <?php include 'header.php';?>
		
	
	
	
	
	
	
	
	<section class="main-sctn">
		<div class="container-fluid">
			
			 <div class="row justify-content-md-center"> 
			  <div class="container-fluid">
			    <div class="col-md-12 text-center">
					<ul class="nav nav-pills mb-3 mx-auto" id="pills-tab" role="tablist">
					  <li>
						<a class="nav-link active" id="showall-tab" data-toggle="pill" href="#showall" role="tab" aria-controls="showall" aria-selected="true">Show All</a>
					  </li>
					  
					  
					  <?php 
    
                   $current_tab = $lan[0]['Language'];
				   
              ?>
					  
					  
					  <?php 
        foreach ($lan as $row):
        //set the class to "active" for the active tab.
        $tab_class = ($row['Language']==$current_tab) ? 'active' : '' ;
        echo '<li class="'.$tab_class.'"><a class="nav-link" data-toggle="pill" role="tab"  aria-selected="false" href="#' . urlencode($row['Language']) .  '" data-toggle="tab">' .           
        $row['Language'] .  ' </a></li>';
        endforeach;
         ?>
					  
					  <!--<li>
						<a class="nav-link" id="Cars-tab" data-toggle="pill" href="#Cars" role="tab" aria-controls="Cars" aria-selected="false">Cars</a>
					  </li>
					  
					  
					  
					  
					  <li>
						<a class="nav-link" id="City-tab" data-toggle="pill" href="#City" role="tab" aria-controls="City" aria-selected="false">City</a>
					  </li>
					  <li>
						<a class="nav-link" id="Forest-tab" data-toggle="pill" href="#Forest" role="tab" aria-controls="Forest" aria-selected="false">Forest</a>
					  </li>-->
					</ul>
				</div>
				</div>	
			



<hr noshade style="margin-top:-20px;">
<div class="container">
<div class="tab-content" id="pills-tabContent">
	       <div class="tab-pane fade show active" id="showall" role="tabpanel" aria-labelledby="showall-tab">
		    <div class="row justify-content-md-center"> 
			<?php  foreach( $film as $val ){ ?>
				<div class="Portfolio col-md-3">
					<a href="<?php echo base_url();?>Site/detail/<?php echo $val['Id'];?>">
						<img class="card-img" src="<?php echo base_url();?>uploads/film_image/<?php echo $val['Photo'];?>" alt="">
					</a>
				<div class="desc"><a href="<?php echo base_url();?>Site/detail/<?php echo $val['Id'];?>"><?php echo $val['FilmName'];?><span><?php echo $val['Language'];?></span></a></div>
			</div><?php } ?>
				
			</div>
		</div>
		
		
	<?php foreach ($film as $row2) 
        $tab = $row2['Language'];
        //set the class to "active" for the active content.
        $content_class = ($tab==$current_tab) ? 'active' : '' ;
	
        ?>
		
	<div class="tab-pane<?php echo $content_class;?> " id="<?php echo $tab; ?>">
		<div class="row justify-content-md-center">
		<?php  foreach($film as $fl) 
					{ 
					 if($fl['Language'] == $tab)
			            {
					
					?>
			<div class="Portfolio col-md-3">
				<a href="<?php echo base_url();?>Site/detail/<?php echo $fl['Id'];?>"">
				<img class="card-img" src="<?php echo base_url();?>uploads/film_image/<?php echo $fl['Photo'];?>" alt="">
				</a>
				<div class="desc"><a href="<?php echo base_url();?>Site/detail/<?php echo $fl['Id'];?>"><?php echo $fl['FilmName'];?><span><?php echo $fl['Language'];?></span></a></div>
			</div>
			<?php  }
                    }
                    ?>
			
			</div>	
	</div>
			
			<!--<div class="Portfolio col-md-3">
				<a href="#!">
				<img class="card-img" src="img/latest-release/04.jpg" alt="">
				</a>
				<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
			</div>
			<div class="Portfolio col-md-3">
				<a href="#!">
				<img class="card-img" src="img/latest-release/01.jpg" alt="">
				</a>
				<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
			</div>-->
		
	
	
</div>
</div>
</div>
		</div>	
	</section>

	<div class="space"></div>
	
<?php include 'footer.php';?>
   
<?php include 'bottom-js.php';?>
 
  </body>

</html>
