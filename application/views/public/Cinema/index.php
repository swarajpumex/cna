<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  
  <title>Cinema News Agency | Exclusive Cinema Magazine in Malayalam</title>
  
  
  </head>

  <body>
      
      	 
	<?php include 'logo.php';?>
		 <?php include 'header.php';?>
		  
		
	
        <?php //include 'slider.php';?>
     <div class="carousel-blog">
<?php foreach($sl as $val){ ?>
  <div class="col-md-6 col-sm-4 col-xs-12 nopadding">
    <div class="carousel-cell ">
      <div class="post-image"> 
	  <img src="<?php echo base_url();?>uploads/slide_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> <span></span>
        
      </div>
    </div>
</div><?php } ?></div>
		
		
	<section class="scl-link">
		<div class="container">
			<div class="row justify-content-md-center">
			  <div class="col col-md-12 text-center">
			  <p>LIKE OUR FACEBOOK PAGE&nbsp;&nbsp;&nbsp;<a href="https://www.facebook.com/thecna/" target="_blank"><img class="img-responsive" src="<?php echo base_url();?>images/fblogo.png" alt=""></a>
			  <span><a href="https://www.youtube.com/channel/UCZ4y2Jf7dlwnz2ZzOp0vd5w?view_as=subscriber" target="_blank"><img class="img-responsive" src="<?php echo base_url();?>images/youtube-logo.png" alt=""></a>SUBSCRIBE OUR YOUTUBE CHANNEL</span></p>
			  </div>
			</div>
		</div>	
	</section>
		
	<section class="">
		<div class="container-fluid fl-hedbg">
			<div class="row">
			  <div class="col-md-2 text-center pd0">
			  <p> Flash News  </p>
			  </div> 
			  <div class="col-md-10 text-center mr-bg">
				<marquee behavior="scroll" direction="left" scrollamount="auto">
              <p style="font-size:23px;"><?php foreach($news as $ns){  echo $ns['Flashnews'];?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img alt="" src="<?php echo base_url();?>img/logo2.png" class="img-fluid" style="width: 47px;height: 36px;">&nbsp;&nbsp;&nbsp;&nbsp; <?php } ?></p>
			 
            </marquee>
			  </div>
			</div>
		</div>	
	</section>
	
	
	<!--<section class="main-sctns">-->
	<!--	<div class="container-fluid">-->
	<!--		<div class="row">-->
			   
			  
	<!--			<?Php foreach($add as $val) { ?>-->
				
					
	<!--				<div class="col-lg-6">-->
						
				 
	<!--			   <div class="advtmnt-bx">-->
	<!--					<img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid">-->
	<!--			   </div>				 </div>-->
	<!--			<?php } ?>-->

			
						
	<!--				</div>-->
				
				

			
	<!--		</div>-->
			  
	<!--		</div>-->
		
	<!--</section>-->
	
	
	
	<section class="main-sctn sldr-sectn">
		<div class="container-fluid">
			<div class="row">
			   <div class="col-md-4">
			    <div class="main-hedngs">
				    <h4> LATEST NEWS  </h4>
				</div>
				<?php foreach($film as $val) { ?>
				<div class="trlr-lsts">
					<div class="col-md-12">
					<?php $limited_word = word_limiter($val['Details'],15); ?>
						<a href="<?php echo base_url();?>Site/detail/<?php echo $val['UniqueName'];?>">
						<img src="<?php echo base_url();?>uploads/film_image/<?php echo $val['Photo']; ?>" alt="" class="img-fluid"> 
						<h5><?php echo $val['FilmName'];?></h5>
						<p><?php echo $limited_word;?></p>
						</a>
						
					</div>
				</div>
				<?php } ?>
				<div class="mv-detl"><a href="<?php echo base_url();?>Site/latest">More News</a></div>
				
				<!--<div class="main-lsts">
					<div class="row">
						<div class="col-md-3 pr0">
							<img src="<?php echo base_url();?>img/mammoka.jpg" alt="" class="img-fluid"> 
						</div>
						<div class="col-md-9 mv-detl">
							<h5>Film name</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed dout aliqua.</p>
							<a href="<?php echo base_url();?>Site/detail">More News</a>
						</div>
					</div>
				</div>
				
				<div class="main-lsts">
					<div class="row">
						<div class="col-md-3 pr0">
							<img src="<?php echo base_url();?>img/mammoka.jpg" alt="" class="img-fluid"> 
						</div>
						<div class="col-md-9 mv-detl">
							<h5>Film name</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed dout aliqua.</p>
							<a href="<?php echo base_url();?>Site/detail">More News</a>
						</div>
					</div>
				</div>-->
				
				
			  </div>
			  
			  <div class="col-md-4">
			    <div class="main-hedngs up-mvs">
				    <h4> LOCATION REPORTS  </h4>
				</div>
				<?php foreach($upcoming as $value) { ?>
				<div class="trlr-lsts">
					<div class="co-md-12">
						<?php $limited_words = word_limiter($value['Details'],15); ?>
						 <a href="<?php echo base_url();?>Site/detail/<?php echo $value['UniqueName'];?>">
							<img src="<?php echo base_url();?>uploads/film_image/<?php echo $value['Photo'];?>" alt="" class="img-fluid"> 
						<h5><?php echo $value['FilmName'];?></h5>
							<p><?php echo $limited_words;?></p>
							</a>
							<!-- <a href="<?php echo base_url();?>Site/upcoming">More News</a> -->
					
					</div>
				</div><?php } ?>
				<div class="mv-detl"><a href="<?php echo base_url();?>Site/upcomings">More News</a></div>
				<!--<div class="main-lsts">
					<div class="row">
						<div class="col-md-3 pr0">
							<img src="<?php echo base_url();?>img/mammoka.jpg" alt="" class="img-fluid"> 
						</div>
						<div class="col-md-9 mv-detl">
							<h5>Film name</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed dout aliqua.</p>
							<a href="<?php echo base_url();?>Site/detail">More News</a>
						</div>
					</div>
				</div>
				
				<div class="main-lsts">
					<div class="row">
						<div class="col-md-3 pr0">
							<img src="<?php echo base_url();?>img/mammoka.jpg" alt="" class="img-fluid"> 
						</div>
						<div class="col-md-9 mv-detl">
							<h5>Film name</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed dout aliqua.</p>
							<a href="<?php echo base_url();?>Site/detail">More News</a>
						</div>
					</div>
				</div>-->
				
				
			  </div>
			  
			  <div class="col-md-4">
			    <div class="main-hedngs">
				  <h4>TRAILERS & VIDEOS  </h4>
				</div>
				<?php foreach($trailer as $val){ ?>
				<div class="trlr-lsts">
					<div class="col-md-12">
						<a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>"  target="_blank">
							<img src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> 
							<h5><?php echo $val['FilmName'];?></h5>
							<p><?php echo $val['Details'];?></p>
							</a>
							
					
					</div>
				</div><?php } ?>
				<div class="mv-detl"><a href="<?php echo base_url();?>Site/trailer">More News</a></div>
				<!--<div class="main-lsts">
					<div class="row">
						<div class="col-md-3 pr0">
							<img src="<?php echo base_url();?>img/mammoka.jpg" alt="" class="img-fluid"> 
						</div>
						<div class="col-md-9 mv-detl">
							<h5>Film name</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed dout aliqua.</p>
							<a href="#">More News</a>
						</div>
					</div>
				</div>
				
				<div class="main-lsts">
					<div class="row">
						<div class="col-md-3 pr0">
							<img src="<?php echo base_url();?>img/mammoka.jpg" alt="" class="img-fluid"> 
						</div>
						<div class="col-md-9 mv-detl">
							<h5>Film name</h5>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed dout aliqua.</p>
							<a href="#">More News</a>
						</div>
					</div>
				</div>
				-->
				
			  </div>
			  
			</div>
		</div>	
	</section>

	
	
	
	
	<section class="main-sctn pt0 pb-0">
		<div class="container-fluid">
			<div class="row">
			    <div class="col-md-9">
					<div class="row  mb2">
					    <div class="col-md-12">
							<div class="excl-hed">
							  <h4> INTERVIEWS </h4>
							</div>
						</div>
						<div class="blog1">
							<div class="col-md-12">
								<div id="blogCarousel" class="carousel slide" data-ride="carousel">
								

									<!-- Carousel items -->
									<div class="carousel-inner">

										<div class="carousel-item active">
											<div class="row">
                                            <?php foreach($interview as $val){?>
												<div class="col-md-3">
													<a href="<?php echo base_url();?>Site/interviewdetails/<?php echo $val['Id'];?>">
														<img src="<?php echo base_url();?>uploads/interview/<?php echo $val['CoverImage'];?>" alt="Image" class="img-fluid">
													</a>
													<div class="cht-txt">
														<a href="<?php echo base_url();?>Site/interviewdetails/<?php echo $val['Id'];?>"><?php echo $val['Title'];?></a>
													</div>
											</div><?php } ?>
											
											</div>
											<!--.row-->
										</div>
										<!--.item-->

									
											</div>
										
								</div>
								<!--.Carousel-->

							</div>
						</div>
					</div>
			            
					  <div class="col-md-12 pd0">
							<div class="excl-hed">
							  <h4>VIDEO SONGS </h4>
							</div>
						</div>
					<div class="carousel-gellary mb2">
<?php foreach($songs as $val){ ?>
  <div class="col-md-3 col-sm-4 col-xs-12 nopadding" style="min-height:230px;box-sizing: border-box;" >
    <div class="carousel-cell ">
      <div class="post-image"> <a href="<?php echo "https://youtube.com/embed/".substr($val['Link'],17);?>" target="_blank">
	  <img src="<?php echo base_url();?>uploads/song_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> <span style="background: none;"></span></a>
        <div class="cht-txt">
		<a href="<?php echo "https://youtube.com/embed/".substr($val['Link'],17);?>"><?php echo $val['SongName'];?></a>
	    </div>
      </div>
      	
    </div>
</div><?php } ?>
</div>


<div class="col-md-12 pd0" >
							<div class="excl-hed">
							  <h4>TRAILERS & VIDEOS </h4>
							</div>
						</div>
					<div class="carousel-video mb2">
					    
<?php foreach($trailers as $val){ ?>
  <div class="col-md-3 col-sm-4 col-xs-12 nopadding"  style="min-height:230px;box-sizing: border-box;">
    <div class="carousel-cell ">
      <div class="post-image"> <a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" target="_blank">
	  <img src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> <span style="background: none;"></span></a>
        <div class="cht-txt">
		<a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>"><?php echo $val['FilmName'];?></a>
	    </div>
      </div>
      	
    </div>			
</div><?php } ?></div>			
					
			
	    
		            
				
				</div>
				
			  
				<div class="col-md-3">
					<div class="row">
						<div class="col-md-12 pd0">
							<?php foreach($add_up as $val){?>
							<div class="bk-shw mb33">
							 <?= empty($val['Link'])? "" : "<a href=\"{$val['Link']}\" target=\"_blank\">" ?>
							 <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="Image" class="img-fluid">
							 <?= empty($val['Link'])? "" : "</a>" ?>
							</div>
							<?php } ?>
						</div>
					</div>
					<!--<div class="row">-->
					<!--	<div class="col-md-12">-->
					<!--		<div class="clctn-hed">-->
					<!--			<h4>BOX OFFICE COLLECTION</h4>-->
					<!--		</div>-->
					<!--		<div class="clctn-list">-->
					<!--			<table class="table table-borderless">-->
					<!--				<tbody>-->
					<!--				  <?php foreach($boxoffice as $val){?>-->
					<!--					<tr>-->
										
					<!--					  <td><?php echo $val['FilmName'];?></td> -->
					<!--					  <td>:</td>-->
					<!--					  <td> <?php echo $val['Boxoffice'];?></td>-->
										 
					<!--					</tr>-->
					<!--					 <?php } ?>-->
					<!--				</tbody>-->
					<!--			</table>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
					
					
					<div class="row">
						<div class="col-md-12 pd0">
							<div class="wk-trnd mt-4">
								<h4> TRENDING OF THE WEEK </h4>
							</div>
							<div class="wk-trnd-lst">
								<ul>
								<?php foreach($films as $val){ ?>
									<li>
									 <a href="<?php echo base_url();?>Site/detail/<?php echo $val['UniqueName'];?>"><?php echo $val['FilmName'];?></a>
									 <!--<span> <?php echo $val['Language'];?> </span>-->
								   </li><?php } ?>
									<!--<li>
									 <a href="#">June</a>
									 <span> movies </span>
									</li>
									<li>
									 <a href="#">June</a>
									 <span> movies </span>
									</li>
									<li>
									 <a href="#">June</a>
									 <span> movies </span>
									</li>-->
								</ul>
							</div>
						</div>
					
					</div>
					<div class="row">
						<div class="col-md-12 pd0">
							<div class="wk-trnd" style="background: #fff;margin-top: 0">
								
							</div>
							<?php foreach($add_down as $val){?>
							<div class="bk-shw"> 
							 <?= empty($val['Link'])? "" : "<a href=\"{$val['Link']}\" target=\"_blank\">" ?>
							 <img src="<?php echo base_url();?>uploads/advertise_image/<?php echo $val['Photo'];?>" alt="Image" class="img-fluid">
							 <?= empty($val['Link'])? "" : "</a>" ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</section>

	
	
<?php include 'footer.php';?>
   
<?php include 'bottom-js.php';?>
   
<script>
// optional
		$('#blogCarousel').carousel({
				interval: 5000
		});
		$('#blog02').carousel({
				interval: 3900,
				cycle: true
		});
		$('#blog03').carousel({
				interval: 3000,
				cycle: true
		});
</script>

<script zzazz-t-id="ea40f574-26ce-4f4e-b6fe-8a5b76d554a6" id="kunato_js-js" type="module" src="https://cdn.zzazz.com/widget/signal/widget.js"></script>

  </body>

</html>
