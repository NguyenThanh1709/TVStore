<?php
if (!defined('_INCODE')) die('Access Deined...');

//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

$body = getBody();
if (!empty($body['id'])) {
  $blogID = $body['id'];
  $blogRow = getRows("SELECT `id` FROM `blog` WHERE `id`='$blogID'");
  if ($blogRow > 0) {
    //Xử lý xoá
    $deleteSatus = delete('blog', "`id`='$blogID'");
    if ($deleteSatus) {
      setFlashData('msg', "Đã xoá dữ liệu bài viết thành công!");
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
redirect('?module=blogs');
