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
<section id="services" class="services archives section">
  <div class="container">
    <div class="row">
      <div class="col-12 wow fadeInUp">
        <div class="section-title">
          <h2><?php echo $infoService['name'] ?></h2>
        </div>
      </div>
    </div>
    <div class="col-12 p-0">
      <div class="">
        <?php echo html_entity_decode($infoService['content']); ?>
      </div>
    </div>
  </div>
</section>
<!--/ End Services -->
<?php
layout('footer', 'client', $data);
?>