<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}
$data = [
  'pageTitle' => 'Cập nhật dịch vụ'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$subscribeID = getBody('get')['id']; //Id subscribe

$subscribeDetail = firstRaw("SELECT * FROM `subscibe` WHERE `id` = '$subscribeID'");
//Kiểm tra id hợp lệ hay ko
if (!empty($subscribeDetail)) {
} else {
  redirect(getLinkAdmin('subscribes')); //Không hợp lệ chuyển hướng
}

//Xử lý cập nhật
if (isPost()) {

  $dataForm = getBody(); //lấy dữ liệu từ form

  $errors = array();

  //Validation fullname
  if (empty(trim($dataForm['fullname']))) {
    $errors['fullname']['required'] = "Tên người dùng bắt buộc phải nhập!";
  }

  // --Validate email
  if (empty(trim($dataForm['email']))) {
    $errors['email']['required'] = "Email người dùng bắt buộc phải nhập!";
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataUpdate = [
      'fullname' => $dataForm['fullname'],
      'email' => $dataForm['email'],
      'status' => $dataForm['status'],
    ];
    $queryUpdateStatus = update('subscibe', $dataUpdate, "id='$subscribeID'");
    if ($queryUpdateStatus) {
      setFlashData('msg', 'Cập nhật dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('subscribes', 'edit', ['id' => $subscribeID]));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi cập nhật dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('subscribes', 'edit', ['id' => $subscribeID]));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $dataForm);
    redirect(getLinkAdmin('subscribes', 'edit', ['id' => $subscribeID]));
  }
}
$error = getFlashData('errors');

$oldData = getFlashData('old_data');
if (empty($oldData) && !empty($subscribeDetail)) {
  $oldData = $subscribeDetail;
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
                <label for="">Họ và tên</label>
                <input type="text" class="form-control" value="<?php echo old('fullname', $oldData) ?>" name="fullname" placeholder="Nhập tên dịch vụ....">
                <?php echo form_error('name', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" value="<?php echo old('email', $oldData) ?>" name="email" placeholder="Nhập tên dịch vụ....">
                <?php echo form_error('name', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" id="" class="form-control">
                  <option <?php echo old('status', $oldData) == 0 ? 'selected' : false ?> value="0">Chưa xử lý</option>
                  <option <?php echo old('status', $oldData) == 1 ? 'selected' : false ?> value="1">Đang xử lý</option>
                  <option <?php echo old('status', $oldData) == 2 ? 'selected' : false ?> value="2">Đã xử lý</option>
                </select>
                <?php echo form_error('name', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="" class="form-label">Ngày tạo</label>
                <input type="datetime-local" readonly class="form-control" value="<?php echo old('create_at', $oldData) ?>" name="create_at">
                <?php echo form_error('create_at', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="" class="form-label">Ngày cập nhật</label>
                <input type="datetime-local" readonly class="form-control" value="<?php echo old('update_at', $oldData) ?>" name="update_at">
                <?php echo form_error('update_at', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Cập nhật thông tin đăng ký</button>
          <a href="<?php echo getLinkAdmin('subscribes') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
