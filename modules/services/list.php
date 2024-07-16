<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => 'Dịch vụ'
];
layout('header', 'client', $data);
layout('breadcrumbs', 'client', $data);

//Lấy danh sách dịch vụ
$services = getRaw("SELECT * FROM `sevices`");
?>
<!-- Services -->
<section id="services" class="services archives section">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <span class="title-bg"><?php echo getOptions('home_service_title_bg') ?></span>
          <?php echo html_entity_decode(getOptions('home_service_title')) ?>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      if (!empty($services)) :
        foreach ($services as $item) :
      ?>
          <div class="col-lg-4 col-md-6 col-12">
            <!-- Single Service -->
            <div class="single-service">
              <?php echo html_entity_decode($item['icon']) ?>
              <h2><a href="?module=services&action=detail&id=<?php echo $item['id']; ?>"><?php echo $item['name'] ?></a></h2>
              <p><?php echo $item['dscription'] ?></p>
            </div>
            <!-- End Single Service -->
          </div>
        <?php
        endforeach;
      else : ?>
        <div class="alert alert-info text-center">Không có dịch vụ nào !</div>
      <?php
      endif
      ?>
    </div>
  </div>
</section>
<!--/ End Services -->

<?php
require_once _WEB_PATH_ROOT . '/modules/home/contents/partners.php';

layout('footer', 'client', $data);
?>