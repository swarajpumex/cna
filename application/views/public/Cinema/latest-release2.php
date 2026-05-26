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
					  <?php foreach($lan as $value) { ?>
					  <li>
						<a class="nav-link" id="Cars-tab" data-toggle="pill" href="#<?php echo $value['Language'];?>" role="tab" aria-controls="Cars" aria-selected="false"><?php echo $value['Language'];?></a>
					  </li><?php } ?>
					  <li>
						<a class="nav-link" id="City-tab" data-toggle="pill" href="#City1" role="tab" aria-controls="City" aria-selected="false">City</a>
					  </li>
					  <!--<li>
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
		
	<div class="tab-pane fade" id="" role="tabpanel" aria-labelledby="Cars-tab">
		<div class="row justify-content-md-center"> 
			<div class="Portfolio col-md-3">
				<a href="#!">
				<img class="card-img" src="<?php echo base_url();?>img/latest-release/03.jpg" alt="">
				</a>
				<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
			</div>
			<div class="Portfolio col-md-3">
				<a href="#!">
				<img class="card-img" src="<?php echo base_url();?>img/latest-release/04.jpg" alt="">
				</a>
				<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
			</div>
			<div class="Portfolio col-md-3">
				<a href="#!">
				<img class="card-img" src="<?php echo base_url();?>img/latest-release/01.jpg" alt="">
				</a>
				<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
			</div>
		</div>	
	</div>
	<div class="tab-pane fade" id="City1" role="tabpanel" aria-labelledby="City-tab">
	    <div class="row justify-content-md-center"> 
			
			 <div class="Portfolio col-md-3">
				<a href="#!">
				<img class="card-img" src="<?php echo base_url();?>img/latest-release/03.jpg" alt="">
				</a>
				<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
			</div>
			 <div class="Portfolio col-md-3">
				<a href="#!">
				<img class="card-img" src="<?php echo base_url();?>img/latest-release/04.jpg" alt=""></a>
				<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="Forest" role="tabpanel" aria-labelledby="Forest-tab">
	 <div class="row justify-content-md-center"> 
		 <div class="Portfolio col-md-3">
		   <a href="#!">
		   <img class="card-img" src="<?php echo base_url();?>img/latest-release/01.jpg" alt="">
		   </a>
		 <div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
		</div>
		<div class="Portfolio col-md-3">
			<a href="#!"><img class="card-img" src="<?php echo base_url();?>img/latest-release/02.jpg" alt=""></a>
			<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
		</div>
		<div class="Portfolio col-md-3">
			<a href="#!">
			<img class="card-img" src="<?php echo base_url();?>img/latest-release/03.jpg" alt="">
			</a>
			<div class="desc"><a href="#">Kumbalangi Nights<span>Malayalam</span></a></div>
		</div>
	</div>	
	</div>
</div>
</div>
</div>
		</div>	
	</section>

	
	
<?php include 'footer.php';?>
   
<?php include 'bottom-js.php';?>
 
  </body>

</html>
