<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

if (!defined('_INCODE')) die('Access Deined...');

$userID = isLogin()['user_id']; //lấy id user đang login

$portfolio_id = getBody('get')['id']; //Id service

$portfolio_detail = firstRaw("SELECT * FROM `portfolios` WHERE `id` = '$portfolio_id'");

// echo "<pre>";
// print_r($portfolio_detail);
// echo "</pre>";

//Kiểm tra id hợp lệ hay ko
if (!empty($portfolio_detail)) {
  unset($portfolio_detail['id']);
  unset($portfolio_detail['update_at']);
  unset($portfolio_detail['create_at']);

  $duplicate = $portfolio_detail['duplicate'];
  $duplicate++;

  $name = $portfolio_detail['name'] . '(' . $duplicate . ')';
  $portfolio_detail['name'] = $name;
  $portfolio_detail['user_id'] = $userID;

  $duplicateStatus = insert("portfolios", $portfolio_detail);
  if ($duplicateStatus) {
    update("portfolios", ['duplicate' => $duplicate], "id=$portfolio_id");
    setFlashData('msg', "Đã nhân bản trang thành công");
    setFlashData('msg_style', "success");
    redirect(getLinkAdmin('portfolios'));
  }
} else {
  redirect(getLinkAdmin('portfolios')); //Không hợp lệ chuyển hướng
}
