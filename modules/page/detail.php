<?php
if (!defined('_INCODE')) die('Access Deined...');

$slug = getBody()['slug'];

$sql = "SELECT * FROM `pages` WHERE  `slug` = '$slug'";

$info = firstRaw($sql);

$data = [
  'titlePage' => $info['title']
];

layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);
?>
<!-- Blogs Area -->
<section class="blogs-main archives single section">
  <div class="container">
    <?php if (!empty($info['content'])) :
      echo html_entity_decode($info['content']);
    endif; ?>
  </div>
</section>
<!--/ End Blogs Area -->
<?php
layout('footer', 'client', $data);
?>