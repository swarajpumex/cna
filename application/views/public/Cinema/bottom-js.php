<!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url();?>js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.bundle.min.js"></script>
<!--ticker js--> 
<script src="<?php echo base_url();?>js/breakingNews.js"></script> 

<!-- owl carousel--> 
<script src="<?php echo base_url();?>js/owl.carousel.min.js"></script> 

<!-- flickity carousel--> 
<script src="<?php echo base_url();?>js/flickity.pkgd.min.js"></script> 

<!--custom js--> 
<script src="<?php echo base_url();?>js/custom.js"></script>

 <script type="text/javascript">
        $(function () {
            var str = location.href.toLowerCase();
            $(".navbar-nav > li > a").each(function () {
                if (str.indexOf(this.href.toLowerCase()) > -1) {
                    $("li.active").removeClass("active");
                    $(this).parent().addClass("active");
                }
            });
        });
    </script>
    
    <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>