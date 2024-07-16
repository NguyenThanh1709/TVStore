<?php
if (isset($_POST['data_id'])) {
  $id = getBody()['data_id'];
  if (getBody()['action'] != 'hide') {
    $update = update('comment', ['status' => 1], "id='$id'");
  } else {
    $update = update('comment', ['status' => 0], "id='$id'");
  }
  if ($update) {
    $commentStatus = getCommentCountStatus();
    echo json_encode(['status' => 200, 'data_id' => $id, 'countStatus' => $commentStatus]);
  } else {
    echo json_encode(['status' => false]);
  }
}

if (isGET()) {
  $commentStatus = getCommentCountStatus();
  echo json_encode(['status' => 200, 'countStatus' => $commentStatus]);
}
