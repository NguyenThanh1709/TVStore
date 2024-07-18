<?php
if (isPost()) {
  $body = getBody();
  if (!empty($body)) {
    //Check email đã tồn tại hay chưa
    $check = checkEmailExits('subscibe', $body['email']);
    if ($check) {
      $dataInsert = [
        'fullname' => $body['name'],
        'email' => $body['email'],
      ];
      $insertStatus = insert('subscibe', $dataInsert);
      if ($insertStatus) {
        echo json_encode(['status' => 200]);
      } else {
        echo json_encode(['status' => 500]);
      }
    } else {
      echo json_encode(['status' => 409]);
    }
  }
}
