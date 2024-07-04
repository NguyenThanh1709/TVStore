<?php
if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();
if (!empty($body['id'])) {
  $servicesID = $body['id'];
  $serviceRow = getRows("SELECT `id` FROM `sevices` WHERE `id`='$servicesID'");
  if ($serviceRow > 0) {
    //Xử lý xoá
    $deleteSatus = delete('`sevices`', "`id`='$servicesID'");
    if ($deleteSatus) {
      setFlashData('msg', "Đã xoá dữ liệu dịch vụ thành công!");
      setFlashData('msg_style', "success");
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
redirect('?module=services');
