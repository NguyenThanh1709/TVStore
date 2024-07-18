<?php
if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();
if (!empty($body['id'])) {
  $subscribeID = $body['id'];
  $subscribeRow = getRows("SELECT `id` FROM `subscibe` WHERE `id`='$subscribeID'");
  if ($subscribeRow > 0) {
    //Xử lý xoá
    $deleteSatus = delete('subscibe', "id='$subscribeID'");
    if ($deleteSatus) {
      setFlashData('msg', "Đã xoá dữ liệu đăng ký thành công!");
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
redirect('?module=subscribes');
