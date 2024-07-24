<?php
if (!defined('_INCODE')) die('Access Deined...');

$slug = getBody('get')['slug'];
$infoPortfolio = firstRaw("SELECT `portfolios`.*, `portfolio_categories`.`name` as nameCat FROM `portfolios` INNER JOIN `portfolio_categories` ON `portfolios`.`portfolio_categories_id`=`portfolio_categories`.`id` WHERE `portfolios`.`slug`='$slug'");

//Lấy danh sách ảnh dự án
$listImage = getRaw("SELECT * FROM `portfolio_images` WHERE `portfolio_id`='$infoPortfolio[id]'");

$data = [
  'titlePage' => $infoPortfolio['name']
];
layout('header', 'client', $data);
$data['itemParent'] = "<li><a href='" . _WEB_HOST_ROOT . "/du-an'><i class='fa fa-clone'></i>Dự án</a></li>";
layout('breadcrumbs', 'client', $data);
?>
<!-- portfolio -->
<section class="blogs-main archives single section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-12">
        <div class="row">
          <div class="col-12">
            <!-- Single Blog -->
            <div class="single-blog">
              <div class="blog-inner">
                <div class="blog-top">
                  <div class="meta">
                    <span><i class="fa fa-bolt"></i><a href=""><?php echo !empty($infoPortfolio['nameCat']) ? 'Chuyên mục: ' . $infoPortfolio['nameCat'] : false;  ?></a></span>
                    <span><i class="fa fa-calendar"></i><?php echo !empty($infoPortfolio['create_at']) ? 'Ngày đăng: ' . formatDate($infoPortfolio['create_at'], 'dmy') : false;  ?></span>
                  </div>
                </div>
                <h1 class="text-center"><?php echo $infoPortfolio['name'] ?></h1>
                <hr>
                <?php
                echo html_entity_decode($infoPortfolio['content']);
                ?>
                <div class="bottom-area row">
                  <!-- Next Prev -->
                  <?php
                  if (!empty($infoPortfolio['video'])) :
                    $videoID = getYoutobeID($infoPortfolio['video']);
                    if (!empty($listImage)) : ?>
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

                      <?php
                      if (!empty($listImage)) :
                        if (!empty(!empty($infoPortfolio['video']))) {
                          echo "<div class='col-6'>";
                        } else {
                          echo "<div class='col-12'>";
                        }
                      ?>

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
                <!--/ End Next Prev -->
              </div>
            </div>
          </div>
          <!-- End Single Blog -->
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!--/ End portfolio -->
<?php
layout('footer', 'client', $data);
?>
<!-- <div class="row">