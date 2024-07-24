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


$userID = isLogin()['user_id']; //lấy id user đang login

$serviceID = getBody('get')['id']; //Id service

$serviceDetail = firstRaw("SELECT * FROM `sevices` WHERE `id` = '$serviceID'");
//Kiểm tra id hợp lệ hay ko
if (!empty($serviceDetail)) {
  // echo "<pre>";
  // print_r($serviceDetail);
  // echo "</pre>";
} else {
  redirect(getLinkAdmin('services')); //Không hợp lệ chuyển hướng
}


//Xử lý cập nhật
if (isPost()) {

  $dataForm = getBody(); //lấy dữ liệu từ form

  $errors = array();

  //Validation fullname
  if (empty(trim($dataForm['name']))) {
    $errors['name']['required'] = "Tên dịch vụ bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['name'])) < 5) {
      $errors['name']['min'] = "Tên dịch vụ phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  // --Validate email
  if (empty(trim($dataForm['slug']))) {
    $errors['slug']['required'] = "Tên dịch vụ bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['slug'])) < 5) {
      $errors['slug']['min'] = "Tên dịch vụ phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataUpdate = [
      'name' => $dataForm['name'],
      'slug' => $dataForm['slug'],
      'icon' => $dataForm['icon'],
      'dscription' => $dataForm['dscription'],
      'content' => trim($dataForm['content']),
    ];
    $queryUpdateStatus = update('`sevices`', $dataUpdate, "id='$serviceID'");
    if ($queryUpdateStatus) {
      setFlashData('msg', 'Cập nhật dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('services'));
      redirect(getLinkAdmin('services', 'edit', ['id' => $serviceID]));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi cập nhật dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('services', 'edit', ['id' => $serviceID]));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $dataForm);
    redirect(getLinkAdmin('services', 'edit', ['id' => $serviceID]));
  }
}
$error = getFlashData('errors');

$oldData = getFlashData('old_data');
if (empty($oldData) && !empty($serviceDetail)) {
  $oldData = $serviceDetail;
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
                <label for="">Tên dịch vụ</label>
                <input type="text" class="form-control name" value="<?php echo old('name', $oldData) ?>" name="name" placeholder="Nhập tên dịch vụ....">
                <?php echo form_error('name', $error); ?>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug dịch vụ....">
                <span>Link: <a target="_blank" href="<?php echo getLinkModule('services', old('slug', $oldData))  ?>" class="text-url"><?php echo getLinkModule('services', old('slug', $oldData))  ?></a></span>
                <?php echo form_error('slug', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for="">Icon/Hình ảnh</label>
                <div class="row">
                  <div class="col-12">
                    <?php if (!isFrontIcon($oldData['icon'])) : ?>
                      <img src="<?php echo $oldData['icon'] ?>" title="Ảnh đã tải lên" width="20%" alt="Ảnh tải lên" class="img-thumbnail mb-2">
                    <?php else : ?>
                      <span class="img-thumbnailm mb-2 d-block">Icon: <strong><?php echo old('icon', $oldData) ?></strong></span>
                    <?php endif ?>
                  </div>

                  <div class="col-10">
                    <input type="text" class="form-control" name="icon" placeholder="Nhập icon dịch vụ...." value="<?php echo old('icon', $oldData); ?>">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-primary choose-image"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>
                <?php echo form_error('icon', $error); ?>
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
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Mô tả ngắn</label>
                <textarea name="dscription" id="" class="form-control" placeholder="Nhập mô tả ngắn..."><?php echo old('dscription', $oldData) ?></textarea>
                <?php echo form_error('dscription', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Nội dung</label>
                <textarea name="content" class="form-control editor" placeholder="Nhập nội dung dịch vụ..."><?php echo old('content', $oldData) ?></textarea>
                <?php echo form_error('content', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Cập nhật dịch vụ</button>
          <a href="<?php echo getLinkAdmin('services') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
