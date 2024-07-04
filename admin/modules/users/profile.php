<?php
$data = [
  'pageTitle' => 'Cập nhật thông tin tài khoản'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login
$userDetail = userDetail($userID);
setFlashData('userDetail', $userDetail);

// Xứ lý cập nhật
if (isPost()) {
  $body = getBody();
  //Validation fullname
  if (empty(trim($body['fullname']))) {
    $errors['fullname']['required'] = "Họ tên bắt buộc phải nhập!";
  } else {
    if (strlen(trim($body['fullname'])) < 5) {
      $errors['fullname']['min'] = "Họ tên phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  //Kiểm tra mảng $error
  if (empty($errors)) {
    // Xử lý
    $dataUpdate = [
      'fullname' => $body['fullname'],
      'email' => $body['email'],
      'about_content' => $body['about_content'],
      'contact_facebook' => $body['contact_facebook'],
      'contact_x'  => $body['contact_x'],
      'contact_linkedin'  => $body['contact_linkedin'],
      'contact_pinterest'  => $body['contact_pinterest']
    ];

    $updateStatus = update('users', $dataUpdate, "id=$userID");
    if ($updateStatus) {
      setFlashData('msg', 'Đã cập nhật dữ liệu!');
      setFlashData('msg_style', 'success');
    } else {
      setFlashData('msg', 'Lỗi hệ thông vui lòng thử lại sau!');
      setFlashData('msg_style', 'error');
    }
  } else {
    // Trả ra lỗi
    setFlashData('old_data', $body);
    setFlashData('errors', $errors);
  }
  redirect('?module=users&action=profile');
}

$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
$errors = getFlashData('errors');
$old_data = getFlashData('old_data');
$userDetail = getFlashData('userDetail');
if (!empty($userDetail)) {
  $old_data = $userDetail;
}
?>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- <div class="row justify-content-between">
      <div class="col-10">
      </div>
      <div class="col-2">
        <a href="" class="btn ml-auto">Đổi mật khẩu</a>
      </div>
    </div> -->
    <?php
    getMsg($msg, $msg_style);
    ?>
    <div class="card">
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">Họ và tên (*)</label>
                <input type="text" class="form-control" name="fullname" value="<?php echo old('fullname', $old_data) ?>" placeholder="Nhập họ và tên...">
                <?php echo form_error('fullname', $errors); ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo old('email', $old_data) ?>" placeholder="Nhập địa chỉ email...">
                <?php echo form_error('Email', $errors); ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">Facebook</label>
                <input type="text" class="form-control" name="contact_facebook" value="<?php echo old('contact_facebook', $old_data) ?>" placeholder="Mạng xã hội facebook...">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">X</label>
                <input type="text" class="form-control" name="contact_x" value="<?php echo old('contact_x', $old_data) ?>" placeholder="Mạng xã hội  x...">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">LinkedIn</label>
                <input type="text" class="form-control" name="contact_linkedin" value="<?php echo old('contact_linkedin', $old_data) ?>" placeholder="Mạng xã hội   linkedin...">
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">Pinterest</label>
                <input type="text" class="form-control" name="contact_pinterest" value="<?php echo old('contact_pinterest', $old_data) ?>" placeholder="Mạng xã hội  pinterest...">
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label for="" class="form-label">Nội dung giới thiệu</label>
                <textarea name="about_content" id="" class="form-control" placeholder="Nhập thông tin giới thiệu"><?php echo old('about_content', $old_data) ?></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Cập nhật">
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