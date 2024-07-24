<?php

//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Cập nhật bài viết'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

if (!empty(getBody('get')['id'])) {
  $blog_id = getBody('get')['id'];

  $blogRow = firstRaw("SELECT * FROM `blog` WHERE `id`='$blog_id'");
  if (empty($blogRow)) {
    redirect(getLinkAdmin('blogs'));
  } else {
  }
} else {
  redirect(getLinkAdmin('blogs'));
}

// Lấy danh sách danh mục
$listCatBogs = getRaw("SELECT `id`, `name` FROM `blog_categories`");

//Xử lý cập nhật
if (isPost()) {

  $body = getBody(); //lấy dữ liệu từ form

  $errors = array();

  //Validation fullname
  if (empty(trim($body['title']))) {
    $errors['title']['required'] = "Tên bài viết bắt buộc phải nhập!";
  } else {
    if (strlen(trim($body['title'])) < 5) {
      $errors['title']['min'] = "Tên bài viết phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  if (empty(trim($body['dscription']))) {
    $errors['dscription']['required'] = "Mô tả ngắn bài viết bắt buộc phải nhập!";
  }

  if (empty(trim($body['content']))) {
    $errors['content']['required'] = "Nội dung bài viết bắt buộc phải nhập!";
  }

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataInsert = [
      "title" => $body['title'],
      "slug" => $body['slug'],
      "category_id" => $body['category_id'],
      "dscription" => $body['dscription'],
      "content" => $body['content'],
      "thumbnail" => $body['thumbnail'],
    ];

    $updateStatus = update('blog', $dataInsert, "id='$blog_id'");
    if ($updateStatus) {
      setFlashData('msg', 'Cập nhật dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('blogs'));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('blogs', 'edit',['id'=>$blog_id]));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $body);

    redirect(getLinkAdmin('blogs', 'edit',['id'=>$blog_id]));
  }
}
$error = getFlashData('errors');
$oldData = getFlashData('old_data');
if (empty($oldData) && !empty($blogRow)) {
  $oldData = $blogRow;
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
                <label for="">Tiêu đề</label>
                <input type="text" class="form-control name" value="<?php echo old('title', $oldData) ?>" name="title" placeholder="Nhập tên bài viết....">
                <?php echo form_error('title', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug bài viết....">
                <span>Link: <a href="<?php echo $linkUrl  ?>" class="text-url"><?php echo $linkUrl  ?></a></span>
                <?php echo form_error('slug', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Ngày khởi tạo</label>
                <input type="text" readonly class="form-control" value="<?php echo old('create_at', $oldData) ?>" name="create_at" placeholder="Nhập link video dự án....">
                <?php echo form_error('create_at', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Ngày cập nhật</label>
                <input type="text" readonly class="form-control" value="<?php echo old('update_at', $oldData) ?>" name="update_at" placeholder="Nhập link video dự án....">
                <?php echo form_error('update_at', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Danh mục</label>
                <select name="category_id" id="" class="form-control">
                  <?php
                  if (!empty($listCatBogs)) {
                    foreach ($listCatBogs as $item) {
                  ?>
                      <option <?php echo old('category_id', $oldData) == $item['id'] ? "selected" : false;  ?> value="<?php echo $item['id'] ?>"><?php echo $item['name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
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
                <textarea name="content" class="form-control editor" placeholder="Nhập nội dung bài viết..."><?php echo old('content', $oldData) ?></textarea>
                <?php echo form_error('content', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for="">Hình ảnh đại diện</label>
                <div class="row">
                  <div class="card ml-2" style="width: 18rem;">
                    <img src="<?php echo $oldData['thumbnail'] ?>" title="Ảnh đã tải lên" alt="Ảnh tải lên" class="img-thumbnail">
                  </div>
                  <div class="col-10">
                    <input type="text" readonly class="form-control thumbnail" value="<?php echo old('thumbnail', $oldData) ?>" name="thumbnail" placeholder="Nhập hình ảnh bài viết....">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>
                <?php echo form_error('thumbnail', $error); ?>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Cập nhật bài viết</button>
          <a href="<?php echo getLinkAdmin('blogs') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
