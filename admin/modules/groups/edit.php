<?php
$data = [
  'pageTitle' => 'Cập nhật nhóm người dùng'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);


$groupID = getBody('get')['id'];
$groupsDetail = firstRaw("SELECT * FROM `groups` WHERE `id`='$groupID'");
if (!empty($groupsDetail)) {
  // //Tồn tại
  // setFlashData('groupsDetail', $groupsDetail);
} else {
  redirect(getLinkAdmin('groups'));
}


// Xứ lý cập nhật
if (isPost()) {
  $body = getBody(); //lấy dữ liệu từ form
  $id = $body['id']; //lấy dữ liệu từ form
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
    $dataUpdate = array(
      'name' => $body['name']
    );

    $updateStatus = update('`groups`', $dataUpdate, "`id`=$groupID");

    if ($updateStatus) {
      setFlashData('msg', 'Đã cập nhật dữ liệu mới thành công!');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('groups', 'edit', ['id' => $id]));
    } else {
      setFlashData('msg', 'Lỗi hệ thống vui lòng thử lại sao!');
      setFlashData('msg_style', 'danger');
    }
  } else {
    setFlashData('msg', 'Cảnh báo: Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $body);
    redirect(getLinkAdmin('groups', 'edit', ['id' => $id]));
  }

  redirect(getLinkAdmin('groups', 'edit', ['id' => $id]));
}
$old_data = getFlashData('old_data');

if (empty($old_data) && !empty($groupsDetail)) {
  $old_data = $groupsDetail;
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
                <label for="" class="form-label">Tên nhóm người dùng</label>
                <input type="text" class="form-control" name="name" value="<?php echo old('name', $old_data)  ?>" placeholder="Tên nhóm người dùng...">
                <?php echo form_error('name', $errors); ?>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">Ngày khởi tạo</label>
                <input type="text" class="form-control" disabled name="create_at" value="<?php echo old('create_at', $old_data)  ?>" placeholder="Ngày khởi tạo...">

              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="" class="form-label">Ngày cập nhật</label>
                <input type="text" class="form-control" disabled name="update_at" value="<?php echo old('update_at', $old_data)  ?>" placeholder="Ngày cập nhật...">
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Cập nhật nhóm người dùng">
            <a href="<?php echo getLinkAdmin('groups') ?>" class="btn btn-warning">Quay về</a>
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