<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thêm mới dịch vụ'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

//Xử lý thêm
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

  if (empty(trim($dataForm['content']))) {
    $errors['content']['required'] = "Nội dung dịch vụ bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['content'])) < 35) {
      $errors['content']['min'] = "Nội dung dịch vụ phải lớn hơn hoặc bằng 35 ký tự !";
    }
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataInsert = [
      'name' => $dataForm['name'],
      'slug' => $dataForm['slug'],
      'icon' => $dataForm['icon'],
      'dscription' => $dataForm['dscription'],
      'content' => trim($dataForm['content']),
      'user_id' => $userID,
    ];
    $queryInsertStatus = insert('sevices', $dataInsert);
    if ($queryInsertStatus) {
      setFlashData('msg', 'Thêm dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('services'));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('services', 'add'));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $dataForm);
    redirect(getLinkAdmin('services', 'add'));
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
                <label for="">Tên dịch vụ</label>
                <input type="text" class="form-control name" value="<?php echo old('name', $oldData) ?>" name="name" placeholder="Nhập tên dịch vụ....">
                <?php echo form_error('name', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug dịch vụ....">
                <span>Link: <a href="" class="text-url"><?php echo _WEB_HOST_ROOT ?></a></span>
                <?php echo form_error('slug', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for="">Icon/Hình ảnh</label>
                <div class="row">
                  <div class="col-10">
                    <input type="text" class="form-control thumbnail" value="<?php echo old('icon', $oldData) ?>" name="icon" placeholder="Nhập icon dịch vụ....">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-primary choose-image"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>
                <?php echo form_error('icon', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Mô tả ngắn</label>
                <textarea name="dscription" id="" class="form-control" placeholder="Nhập mô tả ngắn..."></textarea>
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
          <button type="submit" class="btn btn-primary mr-1">Thêm mới dịch vụ</button>
          <a href="<?php echo getLinkAdmin('services') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
