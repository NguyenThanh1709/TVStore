<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

if (!defined('_INCODE')) die('Access Deined...');

$userID = isLogin()['user_id']; //lấy id user đang login

$portfolio_categories_id = getBody('get')['id']; //Id service

$portfolio_categories_detail = firstRaw("SELECT * FROM `portfolio_categories` WHERE `id` = '$portfolio_categories_id'");

// echo "<pre>";
// print_r($portfolio_categories_detail);
// echo "</pre>";

//Kiểm tra id hợp lệ hay ko
if (!empty($portfolio_categories_detail)) {
  unset($portfolio_categories_detail['id']);
  unset($portfolio_categories_detail['update_at']);
  unset($portfolio_categories_detail['create_at']);

  $duplicate = $portfolio_categories_detail['duplicate'];
  $duplicate++;

  $name = $portfolio_categories_detail['name'] . '(' . $duplicate . ')';
  $portfolio_categories_detail['name'] = $name;
  $portfolio_categories_detail['user_id'] = $userID;

  $duplicateStatus = insert("portfolio_categories", $portfolio_categories_detail);
  if ($duplicateStatus) {
    update("portfolio_categories", ['duplicate' => $duplicate], "id=$portfolio_categories_id");
    setFlashData('msg', "Đã nhân bản trang thành công");
    setFlashData('msg_style', "success");
    redirect(getLinkAdmin('portfolio_categories'));
  }
} else {
  redirect(getLinkAdmin('portfolio_categories')); //Không hợp lệ chuyển hướng
}
