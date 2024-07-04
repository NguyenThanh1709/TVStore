<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Cập nhật liên hệ'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

// Lấy danh sách phòng ban
$listType = getRaw("SELECT `id`, `name` FROM `contact_type`");

// Lấy danh sách thông tin liên hệ
$contactID = getBody('get')['id'];
$contactDetail = firstRaw("SELECT * FROM `contacts` WHERE `id` ='$contactID'");

// echo "<pre>";
// print_r($contactDetail);
// echo "</pre>";

//Xử lý thêm
if (isPost()) {

  $body = getBody(); //lấy dữ liệu từ form

  $errors = array();



  //Validation fullname
  if (empty(trim($body['fullname']))) {
    $errors['fullname']['required'] = "Họ tên bắt buộc phải nhập!";
  } else {
    if (strlen(trim($body['fullname'])) < 5) {
      $errors['fullname']['min'] = "Họ tên phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  if (empty(trim($body['message']))) {
    $errors['message']['required'] = "tin nhắn bắt buộc bắt buộc phải nhập!";
  }

  if (empty(trim($body['email']))) {
    $errors['email']['required'] = "Email bắt buộc nhập!";
  } else {
    $email = trim($body['email']);
    if (isEmail($email)) {
      $errors['email']['type'] = "Email không đúng định dạng";
    }
  }
  // echo "<pre>";
  // print_r($errors);
  // echo "</pre>";

  // die();
  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataUpdate = [
      "fullname" => $body['fullname'],
      "email" => $body['email'],
      "type_id" => $body['type_id'],
      "note" => $body['note'],
      "message" => $body['message'],
      "status" => $body['status'],
    ];
    $condition = "id='$contactID'";
    $updateStatus = update('contacts', $dataUpdate, $condition);
    if ($updateStatus) {
      setFlashData('msg', 'Cập nhật dữ liệu thành công');
      setFlashData('msg_style', 'success');
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
    }
    redirect(getLinkAdmin('contacts', 'edit', ['id' => $contactID]));
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $body);

    redirect(getLinkAdmin('contacts', 'edit', ['id' => $contactID]));
  }
}
$error = getFlashData('errors');
$oldData = getFlashData('old_data');
if (!empty($contactDetail)) {
  $oldData = $contactDetail;
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
                <label for="">Họ tên</label>
                <input type="text" class="form-control name" value="<?php echo old('fullname', $oldData) ?>" name="fullname" placeholder="Nhập tên bài viết....">
                <?php echo form_error('fullname', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" value="<?php echo old('email', $oldData) ?>" name="email" placeholder="Nhập email bài viết....">
                <?php echo form_error('email', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Phòng ban</label>
                <select name="type_id" id="" class="form-control">
                  <?php
                  if (!empty($listType)) {
                    foreach ($listType as $item) {
                  ?>
                      <option <?php echo old('type_id', $oldData) == $item['id'] ? "selected" : false;  ?> value="<?php echo $item['id'] ?>"><?php echo $item['name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Trạng thái</label>
                <select name="status" id="" class="form-control">
                  <option value="0" <?php echo (!empty(old('status', $oldData)) && old('status', $oldData) == 0) ? "Selected" : false ?>>Chưa xử lý</option>
                  <option value="1" <?php echo (!empty(old('status', $oldData)) && old('status', $oldData) == 1) ? "Selected" : false ?>>Đang xử lý</option>
                  <option value="2" <?php echo (!empty(old('status', $oldData)) && old('status', $oldData) == 2) ? "Selected" : false ?>>Đã xử lý</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Tin nhắn</label>
                <textarea name="message" id="" class="form-control" placeholder="Tin nhắn liên hệ..."><?php echo old('message', $oldData) ?></textarea>
                <?php echo form_error('message', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Ghi chú</label>
                <textarea name="note" id="" class="form-control" placeholder="Ghi chú liên hệ..."><?php echo old('note', $oldData) ?></textarea>
                <?php echo form_error('note', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Cập nhật liên hệ</button>
          <a href="<?php echo getLinkAdmin('contacts') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
