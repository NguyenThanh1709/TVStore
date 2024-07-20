<?php
// Xây dựng định tuyến url 
// Module blog
$route['bai-viet/danh-muc/(.+).html'] = "index.php?module=blogs&action=category&slug=$1";
$route['bai-viet'] = "index.php?module=blogs";
$route['bai-viet/trang-(.+)'] = "index.php?module=blogs&page=$1";
$route['bai-viet/danh-muc/(.+)/trang-(.+)'] = "index.php?module=blogs&action=category&slug=$1&page=$2";
$route['bai-viet/(.+).html'] = "index.php?module=blogs&action=detail&slug=$1";

// Module dịch vụ
$route['dich-vu'] = "index.php?module=services";
$route['dich-vu/(.+).html'] = "index.php?module=services&action=detail&slug=$1";

//Module dự án
$route['du-an'] = "index.php?module=portfolios";
$route['du-an/(.+).html'] = "index.php?module=portfolios&action=detail&slug=$1";

//Tìm kiếm
$route['tim-kiem.html'] = "index.php?module=search";

//Trang tĩnh
$route['trang/(.+).html'] = "index.php?module=page&action=detail&slug=$1";

//Giới thiệu
$route['gioi-thieu.html'] = "index.php?module=page-template&action=about";

//Đội ngũ
$route['doi-ngu.html'] = "index.php?module=page-template&action=team";

//Liên hệ
$route['lien-he.html'] = "index.php?module=page-template&action=contact";

//Liên hệ
$route['ajax/comment'] = "index.php?module=blogs&action=server_ajax";
