<?php
//Kiểm tra quyền 
$groupID = getGroupID();
$permissionData = getPermissionData($groupID);

$checkPermission = checkPermission($permissionData, 'blog_categories', 'duplicate', 'duplicate');

if (!$checkPermission) {
  setFlashData('msg', 'Bạn không có quyền truy cập vào module này!');
  setFlashData('msg_style', 'danger');
  redirect(getLinkAdmin('dashboarh'));
}


if (!defined('_INCODE')) die('Access Deined...');

$userID = isLogin()['user_id']; //lấy id user đang login

$catBlogID = getBody('get')['id']; //Id service

$catBlogDetail = firstRaw("SELECT * FROM `blog_categories` WHERE `id` = '$catBlogID'");

// echo "<pre>";
// print_r($catBlogDetail);
// echo "</pre>";

//Kiểm tra id hợp lệ hay ko
if (!empty($catBlogDetail)) {
  unset($catBlogDetail['id']);
  unset($catBlogDetail['update_at']);
  unset($catBlogDetail['create_at']);

  $duplicate = $catBlogDetail['duplicate'];
  $duplicate++;

  $name = $catBlogDetail['name'] . '(' . $duplicate . ')';
  $catBlogDetail['name'] = $name;
  $catBlogDetail['user_id'] = $userID;

  $duplicateStatus = insert("blog_categories", $catBlogDetail);
  if ($duplicateStatus) {
    update("blog_categories", ['duplicate' => $duplicate], "id=$catBlogID");
    setFlashData('msg', "Đã nhân bản danh mục bài viết thành công");
    setFlashData('msg_style', "success");
    redirect(getLinkAdmin('blog_categories'));
  }
} else {
  redirect(getLinkAdmin('blog_categories')); //Không hợp lệ chuyển hướng
}
