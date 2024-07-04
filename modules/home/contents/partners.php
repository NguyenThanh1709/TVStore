<?php
$content = getOptions('home_partner_content');
$titleBG = getOptions('home_partner_title_bg');

$partners = getOptions('home_partner_list');
$partners = json_decode($partners, true);

?>
<!-- Partners -->
<section id="partners" class="partners section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg"><?php echo !empty($titleBG) ? $titleBG : false; ?></span>
          <?php echo !empty($content) ? html_entity_decode($content) : false; ?>
        </div>
      </div>
    </div>
    <?php if (!empty($partners)) : ?>
      <div class="row">
        <div class="col-12">
          <div class="partners-inner">
            <div class="row no-gutters">
              <?php foreach ($partners as $item) : ?>
                <!-- Single Partner -->
                <div class="col-lg-2 col-md-3 col-12">
                  <div class="single-partner">
                    <a href="<?php echo $item['link'] ?>" title="<?php echo $item['name'] ?>" target="_blank"><img src="<?php echo $item['image'] ?>" alt="#"></a>
                  </div>
                </div>
                <!--/ End Single Partner -->
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif ?>
  </div>
</section>
<!--/ End Partners -->