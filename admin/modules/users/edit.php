<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Danh sách người dùng'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Lấy danh sách nhóm người dùng
$listGroups = getRaw("SELECT `id`, `name` FROM `groups`");


$userID = getBody('get')['id'];
$queryUser = firstRaw("SELECT * FROM `users` WHERE `id` = '$userID'");
if (!empty($queryUser)) {
  //Tồn tại
  // setFlashData('old_data', $queryUser);
} else {
  redirect(getLinkAdmin('users'));
}

//Xử lý cập nhật
if (isPost()) {
  $body = getBody();
  $errors = array();
  //Validation fullname
  if (empty(trim($body['fullname']))) {
    $errors['fullname']['required'] = "Họ tên bắt buộc phải nhập!";
  } else {
    if (strlen(trim($body['fullname'])) < 5) {
      $errors['fullname']['min'] = "Họ tên phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  // --Validate email
  if (empty(trim($body['email']))) {
    $errors['email']['required'] = "Email bắt buộc nhập!";
  } else {
    $email = trim($body['email']);
    $sql = "SELECT `id` FROM `users` WHERE `email`='$email' AND `id`<>$userID";
    if (getRows($sql) > 0) {
      $errors['email']['unique'] = "Email đã tồn tại trong hệ thống!";
    }
  }

  // //Validate password 
  if (!empty(trim($body['password']))) {
    if (empty(trim($body['password_cf']))) {
      $errors['password_cf']['required'] = "Xác nhận mật khẩu bắt buộc nhập!";
    } else {
      if (trim($body['password']) != trim($body['password_cf'])) {
        $errors['password_cf']['match'] = "Mật khẩu không trùng nhau";
      }
    }
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataUpdate = [
      'fullname' => $body['fullname'],
      'email' => $body['email'],
      'status' => $body['status'],
      'about_content' => $body['about_content']
    ];
    if (!empty(trim($body['password']))) {
      $dataUpdate['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
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
    setFlashData('old_data', $body);
  }
  redirect(getLinkAdmin('users', 'edit', ['id' => $userID]));
}
$error = getFlashData('errors');
$oldData = getFlashData('old_data');
if (empty($oldData) && !empty($queryUser)) {
  $oldData = $queryUser;
}
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>
<section class="content">
  <div class="container-fluid">
    <?php
    getMsg($msg, $msg_style);
    ?>
    <div class="card">
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" value="<?php echo old('fullname', $oldData) ?>" name="fullname" placeholder="Nhập họ và tên....">
                <?php echo form_error('fullname', $error); ?>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" value="<?php echo old('email', $oldData) ?>" name="email" placeholder="Nhập email....">
                <?php echo form_error('email', $error); ?>
              </div>
            </div>
            
            <div class="col-6">
              <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="passwrod" class="form-control" name="password" placeholder="Nhập mật khẩu....">
                <?php echo form_error('password', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input type="passwrod" class="form-control" name="password_cf" placeholder="Nhập lại mật khẩu....">
                <?php echo form_error('password_cf', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" id="" class="form-control">
                  <option <?php echo (!empty($oldData) && $oldData['status'] == 0) ? 'selected' : '' ?> value="0">Chưa kích hoạt</option>
                  <option <?php echo (!empty($oldData) && $oldData['status'] == 1) ? 'selected' : '' ?> value="1">Kích hoạt</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Nhóm người dùng</label>
                <select name="group_id" id="" class="form-control">
                  <!-- <option value="0">--Chọn nhóm người dùng--</option> -->
                  <?php
                  if (!empty($listGroups)) {
                    foreach ($listGroups as $group) {
                  ?>
                      <option <?php echo !empty($body['group_id']) && !empty($group['id']) && $group['id'] == $body['group_id'] ? "selected" : false ?> value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Giời thiệu</label>
                <textarea name="about_content" class="form-control" id=""><?php echo old('about_content', $oldData) ?></textarea>
                <?php echo form_error('about_content', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Cập nhật người dùng</button>
          <a href="<?php echo getLinkAdmin('users') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
