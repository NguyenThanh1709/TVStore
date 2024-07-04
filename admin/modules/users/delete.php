<?php
if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();

if (!empty($body['id'])) {
  $userID = $body['id'];
  $userDetailRow = getRows("SELECT `id` FROM `users` WHERE `id`='$userID'");
  if ($userDetailRow > 0) {
    //Xử lý xoá
    $deleteSatus = delete('users', "id='$userID'");
    if ($deleteSatus) {
      setFlashData('msg', "Đã xoá dữ liệu người dùng thành công!");
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
redirect(getLinkAdmin('users'));
