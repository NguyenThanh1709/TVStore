<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => getOptions('about_title')
];
layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);

?>
<!-- Start Team -->
<section id="team" class="team section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <span class="title-bg">Team</span>
          <h1>Our Leaders</h1>
          <p>Sed lorem enim, faucibus at erat eget, laoreet tincidunt tortor. Ut sed mi nec ligula bibendum aliquam. Sed scelerisque maximus magna, a vehicula turpis Proin
          <p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-12">
        <!-- Single Team -->
        <div class="single-team">
          <div class="t-head">
            <img src="images/t2.jpg" alt="#">
            <div class="t-icon">
              <a href="team-single.html"><i class="fa fa-plus"></i></a>
            </div>
          </div>
          <div class="t-bottom">
            <p>Founder</p>
            <h2>Collis Molate</h2>
            <ul class="t-social">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
          </div>
        </div>
        <!-- End Single Team -->
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <!-- Single Team -->
        <div class="single-team">
          <!-- Team Head -->
          <div class="t-head">
            <img src="images/t1.jpg" alt="#">
            <div class="t-icon">
              <a href="team-single.html"><i class="fa fa-plus"></i></a>
            </div>
          </div>
          <!-- Team Bottom -->
          <div class="t-bottom">
            <p>Co-Founder</p>
            <h2>Domani Plavon</h2>
            <ul class="t-social">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
          </div>
          <!--/ End Team Bottom -->
        </div>
        <!-- End Single Team -->
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <!-- Single Team -->
        <div class="single-team">
          <!-- Team Head -->
          <div class="t-head">
            <img src="images/t3.jpg" alt="#">
            <div class="t-icon">
              <a href="team-single.html"><i class="fa fa-plus"></i></a>
            </div>
          </div>
          <!-- Team Bottom -->
          <div class="t-bottom">
            <p>Developer</p>
            <h2>John Mard</h2>
            <ul class="t-social">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
          </div>
          <!--/ End Team Bottom -->
        </div>
        <!-- End Single Team -->
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <!-- Single Team -->
        <div class="single-team">
          <!-- Team Head -->
          <div class="t-head">
            <img src="images/t4.jpg" alt="#">
            <div class="t-icon">
              <a href="team-single.html"><i class="fa fa-plus"></i></a>
            </div>
          </div>
          <!-- Team Bottom -->
          <div class="t-bottom">
            <p>Marketer</p>
            <h2>Amanal Frond</h2>
            <ul class="t-social">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li>
            </ul>
          </div>
          <!--/ End Team Bottom -->
        </div>
        <!-- End Single Team -->
      </div>
    </div>
  </div>
</section>
<!--/ End Team -->
<?php
layout('footer', 'client', $data);
?>