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
                <?php echo html_entity_decode($item['icon']); ?>
                <h2><a href="<?php echo getLinkModule('services', $item['slug']) ?>"><?php echo $item['name'] ?></a></h2>
                <p><?php echo $item['dscription'] ?></p>
              </div>
          <?php
            endforeach;
          endif
          ?>

        </div>
      </div>
    </div>
  </div>
</section>
<!--/ End Services -->