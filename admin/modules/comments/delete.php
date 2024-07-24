<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}


if (!defined('_INCODE')) die('Access Deined...');

$body = getBody();


if (!empty($body['id'])) {
  $commentID = $body['id'];
  $commentRow = getRows("SELECT `id` FROM `comment` WHERE `id`='$commentID'");
  if ($commentRow > 0) {
    //Lấy những id bình luận đa câps
    $commentData = getRaw("SELECT * FROM `comment`");
    $commentIdArr = getCommentReply($commentData, $commentID);
    $commentIdArr[] = $commentID;

    //Tách mảnh thành chuổi
    $commentIdStr = implode(',', $commentIdArr);
    //Xử lý xoá
    $condition = "id IN($commentIdStr)";
    $deleteSatus = delete('comment', "$condition");
    if ($deleteSatus) {
      setFlashData('msg', "Đã xoá dữ liệu bình luận thành công!");
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
redirect('?module=comments');
