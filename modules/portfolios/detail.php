<?php
if (!defined('_INCODE')) die('Access Deined...');

$slug = getBody('get')['slug'];
$infoPortfolio = firstRaw("SELECT `portfolios`.*, `portfolio_categories`.`name` as nameCat FROM `portfolios` INNER JOIN `portfolio_categories` ON `portfolios`.`portfolio_categories_id`=`portfolio_categories`.`id` WHERE `portfolios`.`slug`='$slug'");

//Lấy danh sách ảnh dự án
$listImage = getRaw("SELECT * FROM `portfolio_images` WHERE `id`='$infoPortfolio[id]'");

// var_dump($listImage);

$data = [
  'titlePage' => $infoPortfolio['name']
];
layout('header', 'client', $data);
$data['itemParent'] = "<li><a href='" . _WEB_HOST_ROOT . "?module=portfolios&action=list'><i class='fa fa-clone'></i>Dự án</a></li>";
layout('breadcrumbs', 'client', $data);

?>
<!-- portfolio -->
<section id="portfolio" class="portfolio archives section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <h2><?php echo $infoPortfolio['name'] ?></h2>
          <hr>
          <div class="meta mt-1 text-16">
            <span class="text-dark mr-2"><i class="fa fa-bolt mr-1"></i><a href="#" class="text-dark">Chuyên mục: <strong><?php echo $infoPortfolio['nameCat'] ?></strong></a></span>
            <span class=""><i class="fa fa-calendar mr-1"></i>Thời gian: <strong><?php echo formatDate($infoPortfolio['create_at'], 'Y/m/d') ?></strong></span>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="">
          <?php echo html_entity_decode($infoPortfolio['content']); ?>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      if (!empty($infoPortfolio['video'])) :
        $videoID = getYoutobeID($infoPortfolio['video']);
        if (!empty($listImage) > 0) : ?>
          <div class="col-6">
          <?php
        else :
          ?>
            <div class="col-12">
            <?php
          endif;
            ?>
            <hr>
            <h4 class="">Video liên quan</h4>
            <hr>
            <?php if (!empty($videoID)) : ?>
              <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $videoID; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <?php endif; ?>
            </div>
          <?php endif; ?>
          <!-- Danh sách ảnh dự án -->
          <?php
          if (!empty($listImage) > 0) : ?>
            <div class="col-6">
              <hr>
              <h4 class="">Ảnh dự án</h4>
              <hr>
              <div class="row">
                <?php foreach ($listImage as $item) : ?>
                  <div class="col-4 mb-2">
                    <a href="<?php echo $item['images'] ?>" data-fancybox="gallery">
                      <img src="<?php echo $item['images'] ?>" alt="">
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>
          </div>
    </div>
</section>
<!--/ End portfolio -->
<?php
layout('footer', 'client', $data);
?>