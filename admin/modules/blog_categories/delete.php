<?php
if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();
if (!empty($body['id'])) {
  $catBlogID = $body['id'];
  $catBlogRow = getRows("SELECT `id` FROM `blog_categories` WHERE `id`='$catBlogID'");
  if ($catBlogRow > 0) {
    //Kiểm tra xem trong danh mục còn dự án hay ko
    $catBlogNum = getRows("SELECT `id` FROM `blog` WHERE `category_id` = '$catBlogID'");
    if ($catBlogNum > 0) {
      setFlashData('msg', "Vẫn còn " . $catBlogNum . " dự án thuộc danh mục này!");
      setFlashData('msg_style', "danger");
    } else {
      //Xử lý xoá
      $deleteSatus = delete('blog_categories', "id='$catBlogID'");
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
redirect('?module=blog_categories');
