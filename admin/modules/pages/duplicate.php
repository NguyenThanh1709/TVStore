<?php
if (!defined('_INCODE')) die('Access Deined...');

$userID = isLogin()['user_id']; //lấy id user đang login

$pageID = getBody('get')['id']; //Id service

$pageDetail = firstRaw("SELECT * FROM `pages` WHERE `id` = '$pageID'");


//Kiểm tra id hợp lệ hay ko
if (!empty($pageDetail)) {
  unset($pageDetail['id']);
  unset($pageDetail['update_at']);
  unset($pageDetail['create_at']);

  $duplicate = $pageDetail['duplicate'];
  $duplicate++;

  $title = $pageDetail['title'] . '(' . $duplicate . ')';
  $pageDetail['title'] = $title;
  $pageDetail['user_id'] = $userID;
  
  $duplicateStatus = insert("pages", $pageDetail);
  if ($duplicateStatus) {
    update("pages", ['duplicate' => $duplicate], "id=$pageID");
    setFlashData('msg', "Đã nhân bản trang thành công");
    setFlashData('msg_style', "success");
    redirect(getLinkAdmin('pages'));
  }
} else {
  redirect(getLinkAdmin('pages')); //Không hợp lệ chuyển hướng
}
