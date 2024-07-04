<?php
if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();

if (!empty($body['id'])) {
  $groupID = $body['id'];
  $groupRows = getRows("SELECT `id` FROM `groups` WHERE `id`='$groupID'");
  if ($groupRows > 0) {
    //Xử lý xoá
    $deleteSatus = delete('`groups`', "`id`='$groupID'");
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
redirect('?module=groups');
