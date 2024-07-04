<?php
if (isPost()) {
  $body = getBody();
  if (!empty($body)) {
    // Khai báo biến
    $errors = array();

    $oldPassWord = trim($body['oldPassWord']);
    $newPassWord = trim($body['newPassWord']);
    $cfPassWord = trim($body['cfPassWord']);
    $userID = intval($body['userID']);

    // Validate password
    if (empty($oldPassWord)) {
      $errors['oldPassWord'] = "Vui lòng nhập mật khẩu cũ!";
    } elseif (strlen($oldPassWord) < 8) {
      $errors['oldPassWord'] = "Mật khẩu cũ ít nhất 8 ký tự!";
    }

    if (empty($newPassWord)) {
      $errors['newPassWord'] = "Vui lòng nhập mật khẩu mới!";
    } elseif (strlen($newPassWord) < 8) {
      $errors['newPassWord'] = "Mật khẩu mới ít nhất 8 ký tự!";
    }

    if (empty($cfPassWord)) {
      $errors['cfPassWord'] = "Vui lòng nhập mật khẩu mới!";
    } elseif ($newPassWord !== $cfPassWord) {
      $errors['cfPassWord'] = "Mật khẩu không trùng. Vui lòng nhập lại!";
    }

    if (empty($errors)) {
      $passwordHash = firstRaw("SELECT `password` FROM `users` WHERE `id`='$userID'");
      if (password_verify($oldPassWord, $passwordHash['password'])) {
        $dataUpdate = array(
          'password' => password_hash($newPassWord, PASSWORD_DEFAULT)
        );
        $updateStatus = update('users', $dataUpdate, "id=$userID");
        if ($updateStatus) {
          $status = 200;
          $urlListUser = _WEB_HOST_ROOT . "?module=users";
          setFlashData('msg', 'Đã đổi mật khẩu thành công!');
          setFlashData('msg_style', 'success');
        } else {
          $errors['update'] = "Có lỗi xảy ra khi cập nhật mật khẩu!";
        }
      } else {
        $errors['oldPassWord'] = "Mật khẩu cũ không đúng";
      }
    }

    $data = array(
      'url' => $urlListUser ?? '',
      'status' => $status ?? 500,
      'errors' => $errors
    );

    echo json_encode($data);
  }
}
