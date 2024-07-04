<?php
//Lấy danh sách dịch vụ
$services = getRaw("SELECT * FROM `sevices`");
?>
<!-- Services -->
<section id="services" class="services section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg"><?php echo getOptions('home_service_title_bg') ?></span>
          <?php echo html_entity_decode(getOptions('home_service_title')) ?>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="service-slider">
          <!-- Single Service -->
          <?php
          if (!empty($services)) :
            foreach ($services as $item) : ?>
              <div class="single-service">
                <?php echo html_entity_decode($item['icon']) ?>
                <h2><a href="service-single.html"><?php echo $item['name'] ?></a></h2>
                <p><?php echo $item['dscription'] ?></p>
              </div>
          <?php
            endforeach;
          endif
          ?>
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-lightbulb-o"></i>
            <h2><a href="service-single.html">Creative Idea</a></h2>
            <p>Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-wordpress"></i>
            <h2><a href="service-single.html">Development</a></h2>
            <p>just fine erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-bullhorn "></i>
            <h2><a href="service-single.html">Marketing</a></h2>
            <p>Possible of erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-magic"></i>
            <h2><a href="service-single.html">Consulting</a></h2>
            <p>welcome to our consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-lightbulb-o"></i>
            <h2><a href="service-single.html">Creative Idea</a></h2>
            <p>Creative and erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-wordpress"></i>
            <h2><a href="service-single.html">Development</a></h2>
            <p>just fine erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-bullhorn "></i>
            <h2><a href="service-single.html">Marketing</a></h2>
            <p>Possible of erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service
          <div class="single-service">
            <i class="fa fa-bullseye "></i>
            <h2><a href="service-single.html">Direct Work</a></h2>
            <p>Everything ien erat, porta non porttitor non, dignissim et enim Aenean ac enim feugiat Latin</p>
          </div> -->
          <!-- End Single Service -->
          <!-- Single Service -->
          <!-- <div class="single-service">
            <i class="fa fa-cube"></i>
            <h2><a href="service-single.html">Creative Plan</a></h2>
            <p>Information sapien erat, non porttitor non, dignissim et enim Aenean ac enim feugiat classical Latin</p>
          </div> -->
          <!-- End Single Service -->
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Services -->