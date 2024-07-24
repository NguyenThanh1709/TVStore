<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();
if (!empty($body['id'])) {
  $portfolio_id = $body['id'];
  $serviceRow = getRows("SELECT `id` FROM `portfolios` WHERE `id`='$portfolio_id'");
  if ($serviceRow > 0) {
    //Xử ảnh phụ thuộc (ảnh dự án)
    $deleteSatusImage = delete('portfolio_images', "portfolio_id='$portfolio_id'");
    if ($deleteSatusImage) {
      //Xử lý xoá
      $deleteSatus = delete('portfolios', "`id`='$portfolio_id'");
      if ($deleteSatus) {
        setFlashData('msg', "Đã xoá dữ liệu dự án thành công!");
        setFlashData('msg_style', "success");
      } else {
        setFlashData('msg', "Lỗi hệ thống. Vui lòng thao tác lại sau!");
        setFlashData('msg_style', "danger");
      }
    } else {
      setFlashData('msg', "Lỗi hệ thống. Vui lòng thao tác lại sau!");
      setFlashData('msg_style', "danger");
    }
  } else {
    setFlashData('msg', "Liên kết không tồn tại trong hệ thống!");
    setFlashData('msg_style', "danger");
  }
} else {
  setFlashData('msg', "Liên kết không tồn tại trong hệ thống!");
  setFlashData('msg_style', "danger");
}
redirect('?module=portfolios');
