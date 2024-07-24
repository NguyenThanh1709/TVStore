<?php
if (!defined('_INCODE')) die('Access Deined...');

$data = [
  'pageTitle' => 'Thêm mới người dùng'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

// Lấy danh sách nhóm người dùng
$listGroups = getRaw("SELECT `id`, `name` FROM `groups`");

//Xử lý thêm
if (isPost()) {

  $dataForm = getBody();

  echo "<pre>";
  print_r($dataForm);
  echo "</pre>";


  $errors = array();

  //Validation fullname
  if (empty(trim($dataForm['fullname']))) {
    $errors['fullname']['required'] = "Họ tên bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['fullname'])) < 5) {
      $errors['fullname']['min'] = "Họ tên phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  // --Validate email
  if (empty(trim($dataForm['email']))) {
    $errors['email']['required'] = "Email bắt buộc nhập!";
  } else {
    $email = trim($dataForm['email']);
    $sql = "SELECT `id` FROM `users` WHERE `email`='$email'";
    if (getRows($sql) > 0) {
      $errors['email']['unique'] = "Email đã tồn tại trong hệ thống!";
    }
  }

  //Validate password 
  if (empty(trim($dataForm['password']))) {
    $errors['password']['required'] = "Mật khẩu bắt buộc nhập!";
  } else {
    if (strlen(trim($dataForm['password'])) < 8) {
      $errors['password']['min'] = "Mật khẩu ít nhất 8 ký tự!";
    }
  }

  if (empty(trim($dataForm['password_cf']))) {
    $errors['password_cf']['required'] = "Xác nhận mật khẩu bắt buộc nhập!";
  } else {
    if (trim($dataForm['password']) != trim($dataForm['password_cf'])) {
      $errors['password_cf']['match'] = "Mật khẩu không trùng nhau";
    }
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataInsert = [
      'fullname' => $dataForm['fullname'],
      'email' => $dataForm['email'],
      'status' => $dataForm['status'],
      'group_id' => $dataForm['group_id'],
      'about_content' => $dataForm['about_content'],
      'password' => password_hash($dataForm['password'], PASSWORD_DEFAULT)
    ];
    $queryInsertStatus = insert('users', $dataInsert);
    if ($queryInsertStatus) {
      setFlashData('msg', 'Thêm dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('users'));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('users', 'add'));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $dataForm);
    redirect(getLinkAdmin('users', 'add'));
  }
}
$error = getFlashData('errors');
$oldData = getFlashData('old_data');
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
                <input type="text" class="form-control" value="<?php echo old('email', $oldData) ?>" name="email" placeholder="Nhập email....">
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
                      <option <?php echo !empty($group_id) && !empty($group['id']) && $group['id'] == $group_id ? "selected" : false ?> value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
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
                <textarea name="about_content" class="form-control" id=""></textarea>
                <?php echo form_error('about_content', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Thêm mới người dùng</button>
          <a href="<?php getLinkAdmin('users') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
