<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => getOptions('service_title')
];
layout('header', 'client', $data);
$data['itemParent'] = "<li><a href='" . _WEB_HOST_ROOT . "?module=services&action=list'><i class='fa fa-clone'></i>Dịch vụ</a></li>";
layout('breadcrumbs', 'client', $data);

if (isGET()) {
  $slug = getBody()['slug'];
  $infoService = firstRaw("SELECT * FROM `sevices` WHERE `slug` = '$slug'");
}
?>
<!-- Services -->
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
                  <span><i class="fa fa-servicestack"></i>Dịch vụ TVStore</span>
                    <span><i class="fa fa-calendar"></i><?php echo !empty($infoService['create_at']) ? 'Ngày đăng: ' . formatDate($infoService['create_at'], 'dmy') : false;  ?></span>
                  </div>
                </div>
                <h1 class="text-center"><?php echo $infoService['name'] ?></h1>
                <hr>
                <?php
                echo html_entity_decode($infoService['content']);
                ?>
                <div class="bottom-area row">
                </div>

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
<!--/ End Services -->
<?php
layout('footer', 'client', $data);
?>