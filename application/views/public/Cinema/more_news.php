<!DOCTYPE html>
<html lang="en">

<head>
   <?php include 'top-css.php'; ?>
</head>

<body>
   <?php include 'logo.php'; ?>
   <?php include 'header.php'; ?>
   <section class="main-sctn">
      <div class="container">
         <!-- <hr noshade style="margin-top:-20px;"> -->
         <div class="row">
            <!--<div class="tab-content" id="pills-tabContent">-->
            <!--   <div class="tab-pane fade show active" id="showall" role="tabpanel" aria-labelledby="showall-tab">-->
            <div class="col-md-9">
               <div class="row justify-content-md-center">
                  <?php
                  foreach ($film as $val) { ?>
                     <div class="Portfolio col-md-3 new_class">
                        <a href="<?php echo base_url(); ?>Site/detail/<?php echo $val['UniqueName']; ?>">
                           <img class="card-img" src="<?php echo base_url(); ?>uploads/film_image/<?php echo $val['Image']; ?>" alt="" loading="lazy" decoding="async">
                        </a>
                        <div class="desc"><a href="<?php echo base_url(); ?>Site/detail/<?php echo $val['UniqueName']; ?>"><?php echo $val['FilmName']; ?></a></div>
                        <!--  <div class="mv-detl d-flex justify-content-center"> <a href="<?php echo base_url(); ?>Site/detail/<?php echo $val['UniqueName']; ?>">MORE</a></div>!-->
                     </div>
                  <?php } ?>
               </div>
               <?php if (isset($total_pages) && $total_pages > 1) { ?>
                  <nav aria-label="Latest news pages">
                     <ul class="pagination justify-content-center">
                        <li class="page-item<?php echo $current_page <= 1 ? ' disabled' : ''; ?>">
                           <a class="page-link" href="<?php echo $pagination_url . '?page=' . max(1, $current_page - 1); ?>" aria-label="Previous">&laquo;</a>
                        </li>
                        <?php
                        $first_page = max(1, $current_page - 2);
                        $last_page = min($total_pages, $current_page + 2);
                        for ($page_number = $first_page; $page_number <= $last_page; $page_number++) { ?>
                           <li class="page-item<?php echo $page_number === $current_page ? ' active' : ''; ?>">
                              <a class="page-link" href="<?php echo $pagination_url . '?page=' . $page_number; ?>"><?php echo $page_number; ?></a>
                           </li>
                        <?php } ?>
                        <li class="page-item<?php echo $current_page >= $total_pages ? ' disabled' : ''; ?>">
                           <a class="page-link" href="<?php echo $pagination_url . '?page=' . min($total_pages, $current_page + 1); ?>" aria-label="Next">&raquo;</a>
                        </li>
                     </ul>
                  </nav>
               <?php } ?>
            </div>
            <div class="col-md-3">
               <div class="row">
                  <?php foreach ($add_news_list as $val) { ?>
                     <div class="bk-shw" style="margin-bottom: 1em;">
                        <?= empty($val['Link']) ? "" : "<a href=\"{$val['Link']}\" target=\"_blank\">" ?>
                        <img src="<?php echo base_url(); ?>uploads/advertise_image/<?php echo $val['Photo']; ?>" alt="Image" class="img-fluid">
                        <?= empty($val['Link']) ? "" : "</a>" ?>
                     </div>
                  <?php } ?>
               </div>
               <!--<div class="row">-->
               <!--   <div class="wk-trnd" style="background: #fff;margin-top: 0"></div>-->
               <!--   <?php foreach ($side_add as $val) { ?>-->
               <!--   <div class="bk-shw"> -->
               <!--      <img src="<?php echo base_url(); ?>uploads/advertise_image/<?php echo $val['Photo']; ?>" alt="Image" class="img-fluid" style="height: 250px">-->
               <!--   </div>-->
               <!--   <?php } ?>-->
               <!--</div>-->
            </div>

         </div>

         <!--    </div>-->
         <!--</div>-->

         <!--</div>-->
         <!--</div>-->
         <!--</div>-->
      </div>
   </section>
   <div class="space"></div>
   <?php include 'footer.php'; ?>
   <?php include 'bottom-js.php'; ?>
</body>

</html>