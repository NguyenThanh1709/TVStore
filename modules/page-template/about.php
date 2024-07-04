<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => getOptions('about_title')
];
layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);

require_once _WEB_PATH_ROOT . '/modules/home/contents/about.php';

require_once _WEB_PATH_ROOT . '/modules/home/contents/partners.php';

?>

<?php
layout('footer', 'client', $data);
?>