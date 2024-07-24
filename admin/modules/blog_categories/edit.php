<?php
//Kiểm tra quyền 
$groupID = getGroupID();
$permissionData = getPermissionData($groupID);

$checkPermission = checkPermission($permissionData, 'blog_categories', 'edit', 'edit');

if (!$checkPermission) {
  setFlashData('msg', 'Bạn không có quyền truy cập vào module này!');
  setFlashData('msg_style', 'danger');
  redirect(getLinkAdmin('dashboarh'));
}


$catBlogID = getBody('get')['id']; //Id service

$cat_blog_detail = firstRaw("SELECT `blog_categories`.*, `users`.fullname FROM `blog_categories` INNER JOIN `users` ON `blog_categories`.user_id = `users`.id WHERE `blog_categories`.id = '$catBlogID'");
//Kiểm tra id hợp lệ hay ko
if (!empty($cat_blog_detail)) {
} else {
  redirect(getLinkAdmin('blog_categories', '', '')); //Không hợp lệ chuyển hướng
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
      'slug' => $body['slug']
    ];

    $updateStatus = update('blog_categories', $dataUpdate, "`id`='$catBlogID'");

    //Kiểm tra insert 
    if ($updateStatus) { //Mặc định là true
      setFlashData('msg', "Đã thêm dữ liệu mới thành công!");
      setFlashData('msg_style', "success");
      redirect(getLinkAdmin('blog_categories', '', ['id' => $catBlogID, 'view' => 'edit']));
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
if (empty($old_data) && !empty($cat_blog_detail)) {
  $old_data = $cat_blog_detail;
}
$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');
?>

<!-- Giao diện form sửa -->
<div class="card-header">
  <h3 class="card-title font-weight-light">Thông tin danh mục bài viết</h3>
</div>
<form method="post">
  <div class="card-body">
    <div class="form-group">
      <label for="name">Tên danh mục (*)</label>
      <input type="text" class="form-control" value="<?php echo old('name', $old_data) ?>" name="name" id="name" placeholder="Nhập tên danh mục bài viết...">
      <?php echo form_error('name', $error); ?>
    </div>
    <div class="form-group">
      <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
      <input type="text" class="form-control" value="<?php echo old('slug', $old_data) ?>" name="slug" placeholder="Nhập slug bài viết....">
      <span>Link: <a target="_blank" href="<?php echo getLinkModule('blog_categories', old('slug', $old_data))  ?>" class="text-url"><?php echo getLinkModule('blog_categories', old('slug', $old_data))  ?></a></span>
      <?php echo form_error('slug', $error); ?>
    </div>
    <div class="form-group">
      <label for="fullname">Người khởi tạo</label>
      <input type="text" readonly class="form-control" value="<?php echo old('fullname', $old_data) ?>" fullname="fullname" id="fullname" placeholder="Nhập tên danh mục bài viết...">
    </div>
    <div class="form-group">
      <label for="create_at">Ngày khởi tạo</label>
      <input type="text" readonly class="form-control" value="<?php echo old('create_at', $old_data) ?>" name="create_at" id="create_at" placeholder="Nhập tên danh mục bài viết...">
    </div>
    <div class="form-group">
      <label for="update_at">Cập nhật gần nhất</label>
      <input type="text" readonly class="form-control" value="<?php echo old('update_at', $old_data) ?>" name="update_at" id="update_at" placeholder="Nhập tên danh mục bài viết...">
    </div>
  </div>
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập nhật</button>
    <a href="<?php echo getLinkAdmin('blog_categories', '', '') ?>" class="btn btn-warning">Quay lạit</a>
  </div>
</form>