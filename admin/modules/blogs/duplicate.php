<?php
if (!defined('_INCODE')) die('Access Deined...');

$userID = isLogin()['user_id']; //lấy id user đang login

$blogID = getBody('get')['id']; //Id service

$blog_detail = firstRaw("SELECT * FROM `blog` WHERE `id` = '$blogID'");



//Kiểm tra id hợp lệ hay ko
if (!empty($blog_detail)) {
  unset($blog_detail['id']);
  unset($blog_detail['update_at']);
  unset($blog_detail['create_at']);

  $duplicate = $blog_detail['duplicate'];
  $duplicate++;

  $title = $blog_detail['title'] . '(' . $duplicate . ')';
  $blog_detail['title'] = $title;
  $blog_detail['user_id'] = $userID;

  $duplicateStatus = insert("blog", $blog_detail);
  if ($duplicateStatus) {
    update("blog", ['duplicate' => $duplicate], "id=$blogID");
    setFlashData('msg', "Đã nhân bản trang thành công");
    setFlashData('msg_style', "success");
    redirect(getLinkAdmin('blogs'));
  }
} else {
  redirect(getLinkAdmin('blogs')); //Không hợp lệ chuyển hướng
}
