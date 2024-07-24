<?php
$data = [
  'pageTitle' => 'Thêm nhóm người dùng mới'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}



$userID = isLogin()['user_id']; //lấy id user đang login
$userDetail = userDetail($userID);
setFlashData('userDetail', $userDetail);

// Xứ lý cập nhật
if (isPost()) {
  $body = getBody(); //lấy dữ liệu từ form
  $errors = array();

  //Validation mật khẩu
  if (empty(trim($body['name']))) {
    $errors['name']['required'] = "Trường tên nhóm người dùng bắt buộc nhập";
  } else {
    if (strlen(trim($body['name'])) <= 3) {
      $errors['name']['min'] = "Tên nhóm phải từ 3 ký tự trở lên";
    }
  }

  if (empty($errors)) {
    $dataInsert = array(
      'name' => $body['name']
    );

    $insertStatus = insert('groups', $dataInsert);
    if ($insertStatus) {
      setFlashData('msg', 'Đã thêm mới nhóm người dùng thành công!');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('groups'));
    } else {
      setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sao!');
      setFlashData('msg_style', 'danger');
    }
  } else {
    setFlashData('msg', 'Cảnh báo: Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('old_data', $body);
    setFlashData('errors', $errors);
  }
  redirect(getLinkAdmin('groups', 'add'));
}
$old_data = getFlashData('old_data');
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
                <label for="" class="form-label">Tên nhóm người dùng</label>
                <input type="text" class="form-control" name="name" value="<?php echo old('name', $old_data) ?>" placeholder="Tên nhóm người dùng...">
                <?php echo form_error('name', $errors); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Thêm mới người dùng">
            <a href="<?php echo getLinkAdmin('groups', 'list') ?>" class="btn btn-warning">Quay về</a>
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