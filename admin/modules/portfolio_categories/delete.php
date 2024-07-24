<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();
if (!empty($body['id'])) {
  $portfolio_categories_id = $body['id'];
  $pageRow = getRows("SELECT `id` FROM `portfolio_categories` WHERE `id`='$portfolio_categories_id'");
  if ($pageRow > 0) {
    //Kiểm tra xem trong danh mục còn dự án hay ko
    $portfolioNum = getRows("SELECT id FROM `portfolios` WHERE `portfolio_categories_id` = '$portfolio_categories_id'");
    if ($portfolioNum > 0) {
      setFlashData('msg', "Vẫn còn " . $portfolioNum . " dự án thuộc danh mục này!");
      setFlashData('msg_style', "danger");
    } else {
      //Xử lý xoá
      $deleteSatus = delete('`portfolio_categories`', "`id`='$portfolio_categories_id'");
      if ($deleteSatus) {
        setFlashData('msg', "Đã xoá dữ liệu thành công!");
        setFlashData('msg_style', "success");
      } else {
        setFlashData('msg', "Lỗi hệ thống. Vui lòng thao tác lại sau!");
        setFlashData('msg_style', "danger");
      }
    }
  } else {
    setFlashData('msg', "Liên kết không tồn tại trong hệ thống!");
    setFlashData('msg_style', "danger");
  }
} else {
  setFlashData('msg', "Liên kết không tồn tại trong hệ thống!");
  setFlashData('msg_style', "danger");
}
redirect('?module=portfolio_categories');
