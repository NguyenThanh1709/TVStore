<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();
if (!empty($body['id'])) {
  $pageID = $body['id'];
  $pageRow = getRows("SELECT `id` FROM `pages` WHERE `id`='$pageID'");
  if ($pageRow > 0) {
    //Xử lý xoá
    $deleteSatus = delete('`pages`', "`id`='$pageID'");
    if ($deleteSatus) {
      setFlashData('msg', "Đã xoá dữ liệu trang thành công!");
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
redirect('?module=pages');
