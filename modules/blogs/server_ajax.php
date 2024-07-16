<?php
// Xử lý bình luận
$csrf_token = $_POST['csrf_token'];

if ($csrf_token !== $_SESSION['csrf_token']) {
  echo json_encode(['success' => false, 'message' => 'Invalid CSRF token.']);
  exit;
}

if (isPost()) {
  $body = getBody();
  $errors = [];

  $status = 0;
  if (isLogin()) {
    $userID = isLogin()['user_id'];
    $userDetail = userDetail($userID);
    $status = 1;
  }

  // Validate name
  if (empty(trim($body['name']))) {
    $errors['name']['required'] = "Tên không được để trống!";
  } else {
    if (strlen(trim($body['name'])) < 5) {
      $errors['name']['min'] = "Tên phải lớn hơn hoặc bằng 5 ký tự!";
    }
  }
  // // Validate name
  if (empty(trim($body['name']))) {
    $errors['name']['required'] = "Tên không được để trống!";
  } else {
    if (strlen(trim($body['name'])) < 5) {
      $errors['name']['min'] = "Tên phải lớn hơn hoặc bằng 5 ký tự!";
    }
  }

  //Validate content
  if (empty(trim($body['content']))) {
    $errors['content']['required'] = "Tên không được để trống!";
  }

  $dataInsert = array(
    'parent_id' => $body['parent_id'],
    'blog_id' => trim(strip_tags($body['blog_id'])),
    'user_id' => !empty($userID) ? $userID : NULL,
    'content' => trim(strip_tags($body['content'])),
    'status' => $status
  );

  if (empty($userID)) {
    $dataInsert['name'] = trim(strip_tags($body['name']));
    $dataInsert['email'] = trim(strip_tags($body['email']));
  }

  $insertStatus = insert('comment', $dataInsert);

  $str = "";
  $commentID = 0;
  if (!empty($userID)) {
    $id = insertID();
    $commentID = $id;

    $comment = firstRaw("SELECT * FROM `comment` WHERE `id` = '$id'");
    $dmy = formatDate($comment['create_at'], 'dmy');
    $his = formatDate($comment['create_at'], '', 'his');
    $img_avt = _WEB_HOST_TEMPLATE . '/images/avt-123.jpg';
    $str .= "<div class='main'>
                <div class='head'>
                    <img src='$img_avt' alt='#'>
                </div>
                <div class='body body-comment'>
                    <h4 class='name-$comment[id]'>$userDetail[fullname] <span class='badge badge-warning'>(Quản trị viên)</span></h4>
                    <div class='comment-info'>
                        <p><span>$dmy<i class='fa fa-clock-o'></i> vào lúc $his</span><a href='#' class='reply' data-id='$comment[id]'><i class='fa fa-comment-o'></i>Trả lời</a></p>
                    </div>
                    <p>$comment[content]</p>
                    <i class='fa fa-ellipsis-h custom-icon'></i>
                    <ul class='list-menu'>
                        <li class='reply' data-id='$comment[id]'><a href='#'><i class='fa fa-comment-o'></i> Trả lời</a></li>
                        <li><a href='#'><i class='fa fa-trash'></i> Xoá</a></li>
                    </ul>
                </div>
            </div>
            <div class='reply-comment-form-$comment[id]' data-id='$comment[id]'></div>";
  }

  if ($insertStatus) {
    echo json_encode(['status' => 200, 'str' => $str, 'parent_id' => $body['parent_id'], 'comment_id' => $commentID]);
  } else {
    echo json_encode(['status' => false]);
  }
}

