<!DOCTYPE html>
<html lang="en">

  <head>
  <?php include 'top-css.php';?>
  </head>
  
  <body>
  
	<?php include 'header.php';?>
	<section id="video" class="video clearfix" style="background: url(<?php echo base_url();?>uploads/film_image/<?php echo $film['Image']; ?>) center; background-repeat: no-repeat;">
        <div class="container reveal-bottom-fade">
            <div class="row">
                <div class="col-md-12">
                    <div class="video-inner">
					    <a data-toggle="modal" data-target="#modal1">
                            <i class="fa fa-play" aria-hidden="true"></i>
                        </a>
                        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">

								<!--Content-->
								<div class="modal-content">

								  <!--Body-->
								  <div class="modal-body mb-0 p-0">

									<div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
									<?php foreach($trailers as $val) { ?>
									  <iframe class="embed-responsive-item" src="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>"
									allowfullscreen></iframe>
									<?php } ?>
									</div>

								  </div>

								  <!--Footer-->
								  <div class="modal-footer justify-content-center">
									<span class="mr-4">Spread the word!</span>
									<a class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
									<!--Twitter-->
									<a  class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
									
									<!--Linkedin-->
									<a class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

									<button class="btn ml-4" data-dismiss="modal">Close</button>

								  </div>

								</div>
								<!--/.Content-->

							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	
	<section class="detl-sec">
		<div class="container">
		    <div class="row">
				<div class="col-12 col-md-12">
				    <nav>
					  <div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-storyline-tab" data-toggle="tab" href="#nav-storyline" role="tab" aria-controls="nav-storyline" aria-selected="true">Storyline</a>
						<a class="nav-item nav-link" id="nav-castcrew-tab" data-toggle="tab" href="#nav-castcrew" role="tab" aria-controls="nav-castcrew" aria-selected="false">Cast & Crew</a>
						
						<a class="nav-item nav-link" id="nav-trailer-tab" data-toggle="tab" href="#nav-trailer" role="tab" aria-controls="nav-trailer" aria-selected="false">Trailer</a>
						
						<a class="nav-item nav-link" id="nav-songs-tab" data-toggle="tab" href="#nav-songs" role="tab" aria-controls="nav-songs" aria-selected="false">Songs</a>
						
						<a class="nav-item nav-link" id="nav-theaterlist-tab" data-toggle="tab" href="#nav-theaterlist" role="tab" aria-controls="nav-theaterlist" aria-selected="false">Theaterlist</a>
					  </div>
                    </nav>
					
    <div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-storyline" role="tabpanel" aria-labelledby="nav-storyline-tab">
		    <div class="stry-lne">
				<div class="row"> 
					<p><?php echo $details['Story'];?></p> 
				</div>  
			</div>  
		</div>
        <div class="tab-pane fade" id="nav-castcrew" role="tabpanel" aria-labelledby="nav-castcrew-tab">
			<div class="mv-pics">
				<div class="row">
				<?php foreach($cast as $val) { ?>
					<div class="col-md-2 flm-pcs">
						<img src="<?php echo base_url();?>uploads/Crew_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"> 
						<div class="actr-detl">
							<h4><?php echo $val['Name']; ?></hh4>
							<h5> <?php echo $val['Details']; ?> </h5>
						</div>
				</div><?php } ?>
					
				</div>
			</div> 
		</div>
        <div class="tab-pane fade" id="nav-trailer" role="tabpanel" aria-labelledby="nav-trailer-tab">
			<div class="mv-trlrs">
				<div class="row">
				<?php //foreach($trailer as $val) { ?>
					<!--<div class="col-md-4">
						<div class="embed-responsive embed-responsive-21by9">
							<iframe class="embed-responsive-item" src="<?php echo $val['TrailerLink'];?>"  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					    </div>
				</div>--><?php // } ?>
					<?php foreach($trailer as $val){?>
                        <div class="col-md-4">
                            <div class="revw-bx">
                                <div class="rvws-img"><a href="#">
								<img src="<?php echo base_url();?>uploads/trailer_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"></a>
                                </div>
                                <div class="rvws-content">
                                    <a href="#"><h4><?php echo $val['FilmName'];?> </h4></a>
                                    <p></p>
                                    <a href="<?php echo "https://youtube.com/embed/".substr($val['TrailerLink'],17);?>" class="inte-btn">Watch Video</a>
                                </div>
                            </div>
                        </div><?php } ?>
				</div>
			</div>  
		</div>
		<div class="tab-pane fade" id="nav-songs" role="tabpanel" aria-labelledby="nav-songs-tab">
			<div class="mv-sngs">
				<div class="row">
				<?php // foreach($song as $val){ ?>
					<!--<div class="col-md-4">
						<div class="embed-responsive embed-responsive-21by9">
							<iframe class="embed-responsive-item" src="<?php echo $val['Link'];?>"  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
				</div>--><?php //} ?>
				<?php foreach($song as $val){?>
                        <div class="col-md-4">
                            <div class="revw-bx">
                                <div class="rvws-img"><a href="#">
								<img src="<?php echo base_url();?>uploads/song_image/<?php echo $val['Photo'];?>" alt="" class="img-fluid"></a>
                                </div>
                                <div class="rvws-content">
                                    <a href="#"><h4><?php echo $val['SongName'];?> </h4></a>
                                    <p></p>
                                    <a href="<?php echo "https://youtube.com/embed/".substr($val['Link'],17);?>" class="inte-btn">Watch Video</a>
                                </div>
                            </div>
                        </div><?php } ?>
					
				</div>
			</div>   
		</div>
	    <div class="tab-pane fade" id="nav-theaterlist" role="tabpanel" aria-labelledby="nav-theaterlist-tab">
		
		
		
		<div class="mv-pics">
				<div class="row">
				
				
				
				<div class="container">
  <h2>Theater List</h2>
           
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>TheaterName</th>
        <th>Place</th>
        <th>ShowTime</th>
      </tr>
    </thead>
    <tbody>
	<?php foreach($theater as $val){?>
      <tr>
        <td><?php echo $val['TheaterName'];?></td>
        <td><?php echo $val['Place'];?></td>
        <td><?php echo $val['ShowDate'];?>&nbsp;&nbsp;<?php echo $val['ShowTime'];?></td>
      </tr><?php } ?>
	  
     
    </tbody>
  </table>
</div>

					
				</div>
			</div>
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
<script>
 $('#modal1').on('hidden.bs.modal', function (e) {
  // do something...
  $('#modal1 iframe').attr("src", $("#modal1 iframe").attr("src"));
});


</script>
  </body>

</html>
