<?php
$titleBg = getOptions('home_blog_title_bg');
$content = getOptions('home_blog_content');

// Lấy danh sách bài viết
$blogs = getRaw("SELECT `blog`.*,`blog_categories`.`name` as nameCat FROM `blog` INNER JOIN `blog_categories` ON `blog`.`category_id` = `blog_categories`.`id`");

?>
<!-- Blogs Area -->
<section class="blogs-main section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <span class="title-bg"><?php echo !empty($titleBg) ? $titleBg : false; ?></span>
          <?php echo !empty($content) ? html_entity_decode($content) : false; ?>
        </div>
      </div>
    </div>
    <?php if (!empty($blogs)) : ?>
      <div class="row">
        <div class="col-12">
          <div class="row blog-slider">
            <?php foreach ($blogs as $item) : ?>
              <div class="col-lg-4 col-12">
                <!-- Single Blog -->
                <div class="single-blog">
                  <div class="blog-head">
                    <img src="<?php echo $item['thumbnail'] ?>" height="" alt="#">
                  </div>
                  <div class="blog-bottom">
                    <div class="blog-inner">
                      <h4><a href="blog-single.html"><?php echo $item['title'] ?></a></h4>
                      <p class="three-lines"><?php echo $item['dscription'] ?></p>
                      <div class="meta">
                        <span><i class="fa fa-bolt"></i><a href="#"><?php echo $item['nameCat'] ?></a></span>
                        <span><i class="fa fa-calendar"></i><?php echo formatDate($item['create_at'], 'Y/m/d') ?></span>
                        <span><i class="fa fa-eye"></i><a href="#"><?php echo $item['view_count'] ?></a></span>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Single Blog -->
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endif ?>
  </div>
</section>
<!--/ End Blogs Area -->