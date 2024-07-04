<?php
if (!defined('_INCODE')) die('Access Deined...');

$data = [
  'titlePage' => 'Thông tin người dùng'
];

layout('header', $data);


if (!empty(getBody()['id'])) {
  $userID = getBody()['id'];
  $queryUser = firstRaw("SELECT * FROM `users` WHERE `id` = '$userID'");
  if (!empty($queryUser)) {
    //Tồn tại
    setFlashData('old_data', $queryUser);
  } else {
    redirect('?module=users');
  }
}

//Xử lý cập nhật
if (isPost()) {
  $dataForm = getBody();
  $errors = array();
  //Validation fullname
  if (empty(trim($dataForm['fullname']))) {
    $errors['fullname']['required'] = "Họ tên bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['fullname'])) < 5) {
      $errors['fullname']['min'] = "Họ tên phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  // --Validate số điện thoại
  if (empty(trim($dataForm['phone']))) {
    $errors['phone']['required'] = "Số điện thoại bắt buộc nhập!";
  }

  // --Validate email
  if (empty(trim($dataForm['email']))) {
    $errors['email']['required'] = "Email bắt buộc nhập!";
  } else {
    $email = trim($dataForm['email']);
    $sql = "SELECT `id` FROM `users` WHERE `email`='$email' AND `id`<>$userID";
    if (getRows($sql) > 0) {
      $errors['email']['unique'] = "Email đã tồn tại trong hệ thống!";
    }
  }

  // //Validate password 
  if (!empty(trim($dataForm['password']))) {
    if (empty(trim($dataForm['password_cf']))) {
      $errors['password_cf']['required'] = "Xác nhận mật khẩu bắt buộc nhập!";
    } else {
      if (trim($dataForm['password']) != trim($dataForm['password_cf'])) {
        $errors['password_cf']['match'] = "Mật khẩu không trùng nhau";
      }
    }
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataUpdate = [
      'fullname' => $dataForm['fullname'],
      'phone' => $dataForm['phone'],
      'email' => $dataForm['email'],
      'status' => $dataForm['status'],
    ];
    if (!empty(trim($dataForm['password']))) {
      $dataUpdate['password'] = password_hash($dataForm['password'], PASSWORD_DEFAULT);
    }
    $queryUpdateStatus = update('users', $dataUpdate, "id='$userID'");
    if ($queryUpdateStatus) {
      setFlashData('msg', 'Đã cập nhật dữ liệu thành công !');
      setFlashData('msg_style', 'success');
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $dataForm);
  }
  redirect('?module=users&action=edit&id=' . $userID);
}
$error = getFlashData('errors');
$oldData = getFlashData('old_data');
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>
<div class="container-fluid">
  <hr>
  <h3>Thông tin người dùng</h3>
  <?php
  getMsg($msg, $msg_style);
  ?>
  <form action="" method="post">
    <div class="row">
      <div class="col-6">
        <div class="form-group">
          <label for="">Họ và tên</label>
          <input type="text" class="form-control" value="<?php echo old('fullname', $oldData) ?>" name="fullname" placeholder="Nhập họ và tên....">
          <?php echo form_error('fullname', $error); ?>
        </div>
        <div class="form-group">
          <label for="">Số điện thoại</label>
          <input type="text" class="form-control" value="<?php echo old('phone', $oldData) ?>" name="phone" placeholder="Nhập só điện thoại....">
          <?php echo form_error('phone', $error); ?>
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" value="<?php echo old('email', $oldData) ?>" name="email" placeholder="Nhập email....">
          <?php echo form_error('email', $error); ?>
        </div>
      </div>
      <div class="col-6">
        <div class="form-group">
          <label for="">Mật khẩu</label>
          <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu (Nhập khi thay đổi mật khẩu)....">
          <?php echo form_error('password', $error); ?>
        </div>
        <div class="form-group">
          <label for="">Nhập lại mật khẩu</label>
          <input type="password" class="form-control" name="password_cf" placeholder="Nhập lại mật khẩu (Nhập khi thay đổi mật khẩu)....">
          <?php echo form_error('password_cf', $error); ?>
        </div>
        <div class="form-group">
          <label for="">Trạng thái</label>
          <select name="status" id="" class="form-control">
            <option <?php echo (!empty($oldData) && $oldData['status'] == 0) ? 'selected' : '' ?> value="0">Chưa kích hoạt</option>
            <option <?php echo (!empty($oldData) && $oldData['status'] == 1) ? 'selected' : '' ?> value="1">Kích hoạt</option>
          </select>
        </div>
        <input type="hidden" name="id" value="<?php echo $userID ?>">
      </div>
    </div>
    <hr />
    <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
    <a href="?module=users" class="btn btn-danger">Quay lại</a>
  </form>
</div>
<?php
layout('footer');
