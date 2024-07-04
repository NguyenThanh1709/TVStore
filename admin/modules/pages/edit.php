<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Cập nhật trang'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

$pageID = getBody('get')['id']; //Id service

$pageDetail = firstRaw("SELECT * FROM `pages` WHERE `id` = '$pageID'");
//Kiểm tra id hợp lệ hay ko
if (!empty($pageDetail)) {
  // echo "<pre>";
  // print_r($pageDetail);
  // echo "</pre>";
} else {
  redirect(getLinkAdmin('pages')); //Không hợp lệ chuyển hướng
}


//Xử lý thêm
if (isPost()) {

  $dataForm = getBody(); //lấy dữ liệu từ form

  $errors = array();

  //Validation fullname
  if (empty(trim($dataForm['title']))) {
    $errors['title']['required'] = "Tên dịch vụ bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['title'])) < 5) {
      $errors['title']['min'] = "Tên dịch vụ phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  // --Validate slug
  if (empty(trim($dataForm['slug']))) {
    $errors['slug']['required'] = "Tên dịch vụ bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['slug'])) < 5) {
      $errors['slug']['min'] = "Tên dịch vụ phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  // --Validate slug
  if (empty(trim($dataForm['content']))) {
    $errors['content']['required'] = "Nội dung dịch vụ bắt buộc phải nhập!";
  } else {
    if (strlen(trim($dataForm['content'])) < 15) {
      $errors['content']['min'] = "Nội dung dịch vụ phải lớn hơn hoặc bằng 15 ký tự !";
    }
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataUpdate = [
      'title' => $dataForm['title'],
      'slug' => $dataForm['slug'],
      'content' => trim($dataForm['content']),
    ];
    $queryUpdateStatus = update('`pages`', $dataUpdate, "id='$pageID'");
    if ($queryUpdateStatus) {
      setFlashData('msg', 'Cập nhật dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('pages'));
      redirect(getLinkAdmin('pages', 'edit'));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi cập nhật dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('pages', 'edit'));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $dataForm);
    redirect(getLinkAdmin('pages', 'edit'));
  }
}
$error = getFlashData('errors');

$oldData = getFlashData('old_data');
if (empty($oldData) && !empty($pageDetail)) {
  $oldData = $pageDetail;
}

$msg = getFlashData('msg');
$msg_style = getFlashData('msg_style');

$linkUrl = _WEB_HOST_ROOT . '/' . getPremaLink(getBody()['module']) . '/' . old('slug', $oldData) . ".html";
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
                <input type="text" class="form-control name" value="<?php echo old('title', $oldData) ?>" name="title" placeholder="Nhập tên dịch vụ....">
                <?php echo form_error('title', $error); ?>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug dịch vụ....">
                <span>Link: <a href="<?php echo $linkUrl  ?>" class="text-url"><?php echo $linkUrl  ?></a></span>
                <?php echo form_error('slug', $error); ?>
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
                <label for="" class="form-label">Nội dung</label>
                <textarea name="content" class="form-control editor" placeholder="Nhập nội dung dịch vụ..."><?php echo old('content', $oldData) ?></textarea>
                <?php echo form_error('content', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Cập nhật trang</button>
          <a href="<?php echo getLinkAdmin('pages') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
