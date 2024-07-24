<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

$portfolio_category_id = getBody('get')['id']; //Id service

$portfolio_category_detail = firstRaw("SELECT `portfolio_categories`.*, `users`.fullname FROM `portfolio_categories` INNER JOIN `users` ON `portfolio_categories`.user_id = `users`.id WHERE `portfolio_categories`.id = '$portfolio_category_id'");
//Kiểm tra id hợp lệ hay ko
if (!empty($portfolio_category_detail)) {
} else {
  redirect(getLinkAdmin('portfolio_categories', '', '')); //Không hợp lệ chuyển hướng
}

//Xử lý thêm
if (isPost()) {
  $body = getBody();

  $errors = array();

  if (empty(trim($body['name']))) {
    $errors['name']['required'] = "Trường tên danh mục bắt buộc nhập!";
  } else {
    if (strlen(trim($body['name'])) <= 3) {
      $errors['name']['min'] = "Tên danh mục phải lớp hơn 3 ký tự!";
    }
  }
  // print_r($errors);
  if (empty($errors)) {

    //Dữ liệu insert
    $dataUpdate = [
      'name' => $body['name'],
    ];

    $updateStatus = update('portfolio_categories', $dataUpdate, "`id`='$portfolio_category_id'");

    //Kiểm tra insert 
    if ($updateStatus) { //Mặc định là true
      setFlashData('msg', "Đã thêm dữ liệu mới thành công!");
      setFlashData('msg_style', "success");
      redirect(getLinkAdmin('portfolio_categories', '', ['id' => $portfolio_category_id, 'view' => 'edit']));
    } else {
      setFlashData('msg', "Lỗi hệ thống. Vui lòng thử lại sau!");
      setFlashData('msg_style', "danger");
      redirect(getLinkAdmin('portfolio_categories'));
    }
  } else {
    setFlashData('msg', "Vui lòng kiểm tra dữ liệu đầu vào!");
    setFlashData('msg_style', "danger");
    setFlashData('error', $errors);
    setFlashData('old_data', $body);
    redirect(getLinkAdmin('portfolio_categories'));
  }
}
$error = getFlashData('error');
$old_data = getFlashData('old_data');
if (empty($old_data) && !empty($portfolio_category_detail)) {
  $old_data = $portfolio_category_detail;
}
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>

<!-- Giao diện form sửa -->
<div class="card-header">
  <h3 class="card-title font-weight-light">Thông tin danh mục dự án</h3>
</div>
<form method="post">
  <div class="card-body">
    <div class="form-group">
      <label for="name">Tên danh mục (*)</label>
      <input type="text" class="form-control" value="<?php echo old('name', $old_data) ?>" name="name" id="name" placeholder="Nhập tên danh mục dự án...">
      <?php echo form_error('name', $error); ?>
    </div>
    <div class="form-group">
      <label for="fullname">Người khởi tạo</label>
      <input type="text" readonly class="form-control" value="<?php echo old('fullname', $old_data) ?>" fullname="fullname" id="fullname" placeholder="Nhập tên danh mục dự án...">
    </div>
    <div class="form-group">
      <label for="create_at">Ngày khởi tạo</label>
      <input type="text" readonly class="form-control" value="<?php echo old('create_at', $old_data) ?>" name="create_at" id="create_at" placeholder="Nhập tên danh mục dự án...">
    </div>
    <div class="form-group">
      <label for="update_at">Cập nhật gần nhất</label>
      <input type="text" readonly class="form-control" value="<?php echo old('update_at', $old_data) ?>" name="update_at" id="update_at" placeholder="Nhập tên danh mục dự án...">
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('portfolio_categories', '', '') ?>" class="btn btn-warning">Quay lạit</a>
  </div>
</form>