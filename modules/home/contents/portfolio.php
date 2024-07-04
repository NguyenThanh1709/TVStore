<?php
$homePortTitleBg = getOptions('home_portfolio_title_bg');
$homePortTitle = getOptions('home_portfolio_title');
$homePortButton = getOptions('home_portfolio_button');
$homePortButtonLink = getOptions('home_portfolio_button_link');

// Lấy danh sách danh mục dự án 
$portfolioCats = getRaw("SELECT * FROM `portfolio_categories` ORDER BY `name`");

// Lấy danh sách dự án
$portfolios = getRaw("SELECT * FROM `portfolios` ORDER BY `create_at`");
// echo "<pre>";
// print_r($portfolioCats);
// echo "</pre>";
?>
<!-- Portfolio -->
<section id="portfolio" class="portfolio section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg"><?php echo !empty($homePortTitleBg) ? $homePortTitleBg : false; ?></span>
          <?php echo !empty($homePortTitle) ? html_entity_decode($homePortTitle) : false; ?>
        </div>
      </div>
    </div>
    <?php if (!empty($portfolioCats)) : ?>
      <div class="row">
        <div class="col-12">
          <!-- portfolio Nav -->
          <div class="portfolio-nav">
            <ul class="tr-list list-inline" id="portfolio-menu">
              <li data-filter="*" class="cbp-filter-item active">Tất cả<div class="cbp-filter-counter"></div>
              </li>
              <?php foreach ($portfolioCats as $item) : ?>
                <li data-filter=".category_<?php echo $item['id']; ?>" class="cbp-filter-item"><?php echo $item['name'] ?><div class="cbp-filter-counter"></div>
                </li>
              <?php endforeach ?>
            </ul>
          </div>
          <!--/ End portfolio Nav -->
        </div>
      </div>
    <?php endif; ?>
    <?php if (!empty($portfolios)) : ?>
      <div class="portfolio-inner">
        <div class="row">
          <div class="col-12">
            <div id="portfolio-item">
              <?php foreach ($portfolios as $item) : ?>
                <!-- Single portfolio -->
                <div class="cbp-item website <?php echo 'category_' . $item['portfolio_categories_id'] ?>">
                  <div class="portfolio-single">
                    <div class="portfolio-head">
                      <img src="<?php echo $item['thumbnail'] ?>" alt="#" />
                    </div>
                    <div class="portfolio-hover">
                      <h4><a href="portfolio-single.html"><?php echo $item['name'] ?></a></h4>
                      <p><?php echo $item['dscription'] ?></p>
                      <div class="button">
                        <a class="primary" data-fancybox="gallery" href="<?php echo $item['thumbnail'] ?>"><i class="fa fa-search"></i></a>
                        <a href=""><i class="fa fa-link"></i></a>
                        <a href="<?php echo $item['video'] ?>" class="primary cbp-lightbox"><i class="fa fa-play"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ End portfolio -->
              <?php endforeach; ?>
            </div>
          </div>
          <div class="col-12">
            <div class="button">
              <a class="btn primary" href="<?php echo !empty($homePortButtonLink) ? $homePortButtonLink : false; ?>"><?php echo !empty($homePortButton) ? $homePortButton : false; ?></a>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>
<!--/ End portfolio -->