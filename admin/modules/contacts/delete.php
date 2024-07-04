<?php
if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();
if (!empty($body['id'])) {
  $contactID = $body['id'];
  $blogRow = getRows("SELECT `id` FROM `contacts` WHERE `id`='$contactID'");
  if ($blogRow > 0) {
    //Xử lý xoá
    $deleteSatus = delete('contacts', "`id`='$contactID'");
    if ($deleteSatus) {
      setFlashData('msg', "Đã xoá dữ liệu liên hệ thành công!");
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
redirect('?module=contacts');
