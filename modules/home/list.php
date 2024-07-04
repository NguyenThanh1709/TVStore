<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
	'titlePage' => "Trang chủ"
];
layout('header', 'client', $data);

require_once 'contents/slide.php';
require_once 'contents/about.php';
require_once 'contents/service.php';
require_once 'contents/facts.php';
require_once 'contents/portfolio.php';
require_once 'contents/cta.php';
require_once 'contents/blogs.php';
require_once 'contents/partners.php';
?>

<?php
layout('footer', 'client', $data);
?>