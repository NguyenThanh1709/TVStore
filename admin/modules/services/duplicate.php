<?php
if (!defined('_INCODE')) die('Access Deined...');

$userID = isLogin()['user_id']; //lấy id user đang login

$serviceID = getBody('get')['id']; //Id service

$serviceDetail = firstRaw("SELECT * FROM `sevices` WHERE `id` = '$serviceID'");



//Kiểm tra id hợp lệ hay ko
if (!empty($serviceDetail)) {
  unset($serviceDetail['id']);
  unset($serviceDetail['update_at']);
  unset($serviceDetail['create_at']);

  $duplicate = $serviceDetail['duplicate'];
  $duplicate++;

  $name = $serviceDetail['name'] . '(' . $duplicate . ')';
  $serviceDetail['name'] = $name;
  $serviceDetail['user_id'] = $userID;

  $duplicateStatus = insert("sevices", $serviceDetail);
  if ($duplicateStatus) {
    update("sevices", ['duplicate' => $duplicate], "id=$serviceID");
    setFlashData('msg', "Đã nhân bản dịch vụ thành công");
    setFlashData('msg_style', "success");
    redirect(getLinkAdmin('services'));
  }
} else {
  redirect(getLinkAdmin('services')); //Không hợp lệ chuyển hướng
}
