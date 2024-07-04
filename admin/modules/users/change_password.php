<?php
$data = [
  'pageTitle' => 'Đổi mật khẩu'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login
$userDetail = userDetail($userID);
setFlashData('userDetail', $userDetail);

// Xứ lý cập nhật
if (isPost()) {
  $body = getBody(); //lấy dữ liệu từ form
  $errors = array();
  
  //Validation mật khẩu
  if (empty(trim($body['old_password']))) {
    $errors['old_password']['required'] = "Trường mật khẩu cũ bắt buộc nhập";
  } else {
    $old_password = trim($body['old_password']);
    $hash_password = $userDetail['password'];
    if (!password_verify($old_password, $hash_password)) {
      $errors['old_password']['match'] = "Mật khẩu cũ không đúng. Vui lòng nhập lại";
    }
  }

  if (empty(trim($body['new_password']))) {
    $errors['new_password']['required'] = "Vui lòng nhập mật khẩu mới";
  } else {
    if (strlen(trim($body['new_password'])) < 8) {
      $errors['new_password']['min'] = "Mật khẩu phải lớn hơn 8 ký tự!";
    }
    if (trim($body['new_password']) != trim($body['confrim_new_password'])) {
      $errors['confrim_new_password']['match'] = "Nhập lại mật khẩu không đúng!";
    }
  }

  if (empty($errors)) {
    $dataUpdate = array(
      'password' => password_hash($body['new_password'], PASSWORD_DEFAULT),
    );
    $condition = "id='$userID'";
    $updatePassword = update('users', $dataUpdate, $condition);
    if ($updatePassword) {
      setFlashData('msg', 'Mật khẩu đã được thay đổi thành công!');
      setFlashData('msg_style', 'success');
      //Xử lý gửi gmail
      $subject = "Thông báo: Đổi mật khẩu thành công!"; //Thiết lập tiêu đề
      $content = "Chào mừng bạn: $userDetail[fullname]" . "<br />"; //Thiết lập nội dung gmail
      $content .= "Bạn vừa thay đổi mật khẩu thành công. Hiện tại bạn có thể đăng nhập với mật khẩu mới" . "<br />";
      $content .= "Nếu không phải bạn vui lòng liên hệ ngay với chúng tôi" . "<br />";
      //Tiến hành gửi gmail
      $send_mail = sendMail($userDetail['email'], $subject, $content);
    } else {
      setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sao!');
      setFlashData('msg_style', 'danger');
    }
    redirect(getLinkAdmin('users', 'change_password'));
  } else {
    setFlashData('msg', 'Cảnh báo: Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
  }
}
$errors = getFlashData('errors');
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">

    <?php
    getMsg($msg, $msg_style);
    ?>
    <div class="card">
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label for="" class="form-label">Nhập mật khẩu cũ</label>
                <input type="text" class="form-control" name="old_password" value="" placeholder="Nhập mật khẩu cũ...">
                <?php echo form_error('old_password', $errors); ?>
              </div>
              <div class="form-group">
                <label for="" class="form-label">Mật khẩu mới</label>
                <input type="text" class="form-control" name="new_password" value="" placeholder="Nhập mật khẩu mới...">
                <?php echo form_error('new_password', $errors); ?>
              </div>
              <div class="form-group">
                <label for="" class="form-label">Nhập lại mật khẩu mới</label>
                <input type="text" class="form-control" name="confrim_new_password" value="" placeholder="Nhập lại mật khẩu mới...">
                <?php echo form_error('confrim_new_password', $errors); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Đổi mật khẩu">
            <a href="<?php echo getLinkAdmin('dashboarh', 'list') ?>" class="btn btn-warning">Quay về</a>
          </div>
        </div>
    </div>
    </form>
  </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<?php
layout('footer', 'admin', $data);
?>