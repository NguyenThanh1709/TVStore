<?php
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}


if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thêm mới trang'
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
  if (empty(trim($dataForm['title']))) {
    $errors['title']['required'] = "Tên trang bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['title'])) < 5) {
      $errors['title']['min'] = "Tên trang phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  if (empty(trim($dataForm['content']))) {
    $errors['content']['required'] = "Nội dung trang bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['content'])) < 5) {
      $errors['content']['min'] = "Nội dung trang phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataInsert = [
      'title' => $dataForm['title'],
      'slug' => $dataForm['slug'],
      'content' => trim($dataForm['content']),
      'user_id' => $userID,
    ];
    $queryInsertStatus = insert('pages', $dataInsert);
    if ($queryInsertStatus) {
      setFlashData('msg', 'Thêm dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('pages'));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('pages', 'add'));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $dataForm);
    redirect(getLinkAdmin('pages', 'add'));
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
                <label for="">Tên trang</label>
                <input type="text" class="form-control name" value="<?php echo old('title', $oldData) ?>" name="title" placeholder="Nhập tên dịch vụ....">
                <?php echo form_error('title', $error); ?>
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
              <div class="form-group">
                <label for="" class="form-label">Nội dung</label>
                <textarea name="content" class="form-control editor" placeholder="Nhập nội dung trang..."></textarea>
                <?php echo form_error('content', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Thêm mới trang</button>
          <a href="<?php echo getLinkAdmin('pages') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
