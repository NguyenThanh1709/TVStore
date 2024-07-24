<?php

//Kiểm tra quyền 
$groupID = getGroupID();
$permissionData = getPermissionData($groupID);

$checkPermission = checkPermission($permissionData, 'blog_categories', 'add', 'add');

if (!$checkPermission) {
  setFlashData('msg', 'Bạn không có quyền truy cập vào module này!');
  setFlashData('msg_style', 'danger');
  redirect(getLinkAdmin('dashboarh'));
}

$userID = isLogin()['user_id']; //lấy id user đang login
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
    $dataInsert = [
      'name' => $body['name'],
      'user_id' => $userID
    ];

    $insertStatus = insert('blog_categories', $dataInsert);

    //Kiểm tra insert 
    if ($insertStatus) { //Mặc định là true
      setFlashData('msg', "Đã thêm dữ liệu mới thành công!");
      setFlashData('msg_style', "success");
      redirect(getLinkAdmin('blog_categories'));
    } else {
      setFlashData('msg', "Lỗi hệ thống. Vui lòng thử lại sau!");
      setFlashData('msg_style', "danger");
      redirect(getLinkAdmin('blog_categories'));
    }
  } else {
    setFlashData('msg', "Vui lòng kiểm tra dữ liệu đầu vào!");
    setFlashData('msg_style', "danger");
    setFlashData('error', $errors);
    setFlashData('old_data', $body);
    redirect(getLinkAdmin('blog_categories'));
  }
}
$error = getFlashData('error');
$old_data = getFlashData('old_data');
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>
<!-- Giao diện -->
<div class="card-header">
  <h3 class="card-title font-weight-light">Thêm danh mục bài viết</h3>
</div>
<form role="form" method="post">
  <div class="card-body">
    <div class="form-group">
      <label for="name">Tên danh mục (*)</label>
      <input type="text" class="form-control" value="<?php echo old('name', $old_data) ?>" name="name" id="name" placeholder="Nhập tên danh mục dự án...">
      <?php echo form_error('name', $error); ?>
    </div>
    <div class="form-group">
      <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
      <input type="text" class="form-control" value="<?php echo old('slug', $old_data) ?>" name="slug" placeholder="Nhập slug bài viết....">
      <span>Link: <a href="" class="text-url"><?php echo _WEB_HOST_ROOT ?></a></span>
      <?php echo form_error('slug', $error); ?>
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Thêm mới</button>
  </div>
</form>