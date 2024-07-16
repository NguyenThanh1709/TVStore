<?php
$phone = getOptions('general_hotline');
$email = getOptions('general_email');
$address = getOptions('general_address');

$titleCol_1 = getOptions('footer_title_1');
$contentCol_1 = getOptions('footer_content_1');

$titleCol_2 = getOptions('footer_title_2');
$contentCol_2 = getOptions('footer_content_2');

$titleCol_3 = getOptions('footer_title_3');
$contentCol_3 = getOptions('footer_content_3');
?>
<!-- Footer -->
<footer id="footer" class="footer wow fadeIn">
  <!-- Top Arrow -->
  <div class="top-arrow">
    <a href="#header" class="btn"><i class="fa fa-angle-up"></i></a>
  </div>
  <!--/ End Top Arrow -->
  <!-- Footer Top -->
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-12">

          <!-- About Widget -->
          <div class="single-widget about">
            <h2><?php echo !empty($titleCol_1) ? $titleCol_1 : false ?></h2>
            <p><?php echo !empty($contentCol_1) ? html_entity_decode($contentCol_1) : false ?></p>
            <ul class="list">
              <li><i class="fa fa-map-marker"></i>Address: <?php echo !empty($address) ? $address : 'Chưa thiết lập' ?></li>
              <li><i class="fa fa-headphones"></i>Phone: <?php echo !empty($phone) ? $phone : 'Chưa thiết lập' ?></li>
              <li><i class="fa fa-envelope"></i>Email:<a href=" <?php echo !empty($email) ? $email : false ?>"> <?php echo !empty($email) ? $email : 'Chưa thiết lập' ?></a></li>
            </ul>
          </div>
          <!--/ End About Widget -->
        </div>
        <div class="col-lg-3 col-md-6 col-12">
          <!-- Links Widget -->
          <div class="single-widget links">
            <h2><?php echo !empty($titleCol_2) ? $titleCol_2 : false ?></h2>
            <?php
            $footerLink = html_entity_decode($contentCol_2);
            $footerLink = str_replace('<ul>', '', $footerLink);
            $footerLink = str_replace('</ul>', '', $footerLink);
            echo "<ul class='list'>" . $footerLink . "</ul>";
            ?>
          </div>
          <!--/ End Links Widget -->
        </div>
        <div class="col-lg-3 col-md-6 col-12">
          <!-- Twitter Widget -->
          <div class="single-widget about">
            <h2><?php echo !empty($titleCol_3) ? $titleCol_3 : false; ?></h2>
            <span class="about"><?php echo !empty($contentCol_3) ? html_entity_decode($contentCol_3) : false; ?>s</span>
            <div class="qrcode-wp w-75">
              <img src="<?php echo getOptions('footer_qrcode_3') ?>" alt="">
            </div>
          </div>
          <!--/ End Twitter Widget -->
        </div>
        <div class="col-lg-3 col-md-6 col-12">
          <!-- Newsletter Widget -->
          <div class="single-widget newsletter">
            <h2><?php echo getOptions('footer_title_4') ?></h2>
            <?php
            echo html_entity_decode(getOptions('footer_content_4'));
            ?>
            <form>
              <input placeholder="Your Name" type="text" name="name">
              <input placeholder="your email" type="email" name="email">
              <button type="submit" class="button primary"><?php echo getOptions('footer_text_button_4') ?></button>
            </form>
          </div>
          <!--/ End Newsletter Widget -->
        </div>
      </div>
    </div>
  </div>
  <!--/ End Footer Top -->
  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="bottom-top">
            <!-- Social -->
            <ul class="social">
              <li><a href="<?php echo getOptions('general_x') ?>"><i class="fa fa-times"></i></a></li>
              <li><a href="<?php echo getOptions('general_facebook') ?>"><i class="fa fa-facebook"></i></a></li>
              <li><a href="<?php echo getOptions('general_linkedin') ?>"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="<?php echo getOptions('general_behance') ?>"><i class="fa fa-behance"></i></a></li>
              <li><a href="<?php echo getOptions('general_youtube') ?>"><i class="fa fa-youtube"></i></a></li>
            </ul>
            <!--/ End Social -->
            <!-- Copyright -->
            <div class="copyright">
              <p><?php echo html_entity_decode(getOptions('footer_copy')) ?></p>
            </div>
            <!--/ End Copyright -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ End Footer Bottom -->
</footer>
<!--/ End footer -->

<!-- Jquery -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.min.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery-migrate.min.js"></script>
<!-- Popper JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/bootstrap.min.js"></script>
<!-- Colors JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/colors.js"></script>
<!-- Modernizer JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/modernizr.min.js"></script>
<!-- Nice select JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/niceselect.js"></script>
<!-- Tilt Jquery JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/tilt.jquery.min.js"></script>
<!-- Fancybox  -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.fancybox.min.js"></script>
<!-- Jquery Nav -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.nav.js"></script>
<!-- Owl Carousel JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/owl.carousel.min.js"></script>
<!-- Slick Slider JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/slickslider.min.js"></script>
<!-- Cube Portfolio JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/cubeportfolio.min.js"></script>
<!-- Slicknav JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.slicknav.min.js"></script>
<!-- Jquery Steller JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.stellar.min.js"></script>
<!-- Magnific Popup JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/magnific-popup.min.js"></script>
<!-- Wow JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/wow.min.js"></script>
<!-- CounterUp JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/jquery.counterup.min.js"></script>
<!-- Waypoint JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/waypoints.min.js"></script>
<!-- Jquery Easing JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/easing.min.js"></script>
<!-- Google Map JS -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnhgNBg6jrSuqhTeKKEFDWI0_5fZLx0vM"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/gmap.min.js"></script>
<!-- Main JS -->
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/main.js"></script>
<script src="<?php echo _WEB_HOST_TEMPLATE ?>/js/custom.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Toast Jquery CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.2/dist/sweetalert2.all.min.js"></script>


</body>

</html>