<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
  'titlePage' => getOptions('portfolio_title')
];
layout('header', 'client', $data);

layout('breadcrumbs', 'client', $data);

$isPortfolio = true;

require_once _WEB_PATH_ROOT . '/modules/home/contents/portfolio.php';

?>

<?php
layout('footer', 'client', $data);
?>