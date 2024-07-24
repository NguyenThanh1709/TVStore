<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thêm mới dự án'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}

$userID = isLogin()['user_id']; //lấy id user đang login

// Lấy danh sách danh mục
$listPortfliosCategories = getRaw("SELECT `id`, `name` FROM `portfolio_categories`");

//Xử lý thêm
if (isPost()) {

  $body = getBody(); //lấy dữ liệu từ form

  $errors = array();

  //Validation fullname
  if (empty(trim($body['name']))) {
    $errors['name']['required'] = "Tên dự án bắt buộc phải nhập!";
  } else {
    if (strlen(trim($body['name'])) < 5) {
      $errors['name']['min'] = "Tên dự án phải lớn hơn hoặc bằng 5 ký tự !";
    }
  }

  if (empty(trim($body['dscription']))) {
    $errors['dscription']['required'] = "Mô tả ngắn dự án bắt buộc phải nhập!";
  }

  if (empty(trim($body['content']))) {
    $errors['content']['required'] = "Nội dung dự án bắt buộc phải nhập!";
  }


  //validation gallery
  $galleryyArr = $body['gallery'];
  if (!empty($galleryyArr)) {
    foreach ($galleryyArr as $key => $item) {
      if (empty(trim($item))) {
        $errors['gallery'][$key] = "Vui lòng chọn hình ảnh dự án";
      }
    }
  }

  // echo "<pre>";
  // print_r($errors);
  // echo "</pre>";

  //Nếu dữ liệu đầu vào đúng
  if (empty($errors)) {
    $dataInsert = [
      "name" => $body['name'],
      "slug" => $body['slug'],
      "portfolio_categories_id" => $body['portfolio_categories_id'],
      "video" => $body['video'],
      "dscription" => $body['dscription'],
      "content" => $body['content'],
      "thumbnail" => $body['thumbnail'],
      "user_id" => $userID
    ];

    $queryInsertStatus = insert('portfolios', $dataInsert);
    if ($queryInsertStatus) {

      //Xử lý thêm ảnh dự án
      $currentID = insertID(); //lấy id vừa insert

      //Duyệt mảng insert image
      if (!empty($galleryyArr)) {
        foreach ($galleryyArr as $item) {
          $dataImages = [
            'portfolio_id' => $currentID,
            'images' => $item
          ];
          insert('portfolio_images', $dataImages);
        }
      }
      setFlashData('msg', 'Thêm dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('portfolios'));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('portfolios', 'add'));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $body);
    redirect(getLinkAdmin('portfolios', 'add'));
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
                <label for="">Tên dự án</label>
                <input type="text" class="form-control name" value="<?php echo old('name', $oldData) ?>" name="name" placeholder="Nhập tên dự án....">
                <?php echo form_error('name', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug dự án....">
                <span>Link: <a href="" class="text-url"><?php echo _WEB_HOST_ROOT  ?></a></span>
                <?php echo form_error('slug', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Danh mục</label>
                <select name="portfolio_categories_id" id="" class="form-control">
                  <?php
                  if (!empty($listPortfliosCategories)) {
                    foreach ($listPortfliosCategories as $item) {
                  ?>
                      <option <?php echo old('portfolio_categories_id', $oldData) == $item['id'] ? "selected" : false;  ?> value="<?php echo $item['id'] ?>"><?php echo $item['name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Link video</label>
                <input type="text" class="form-control name" value="<?php echo old('name', $oldData) ?>" name="video" placeholder="Nhập tên dự án....">
                <?php echo form_error('video', $error); ?>
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
                <textarea name="content" class="form-control editor" placeholder="Nhập nội dung dự án..."><?php echo old('content', $oldData) ?></textarea>
                <?php echo form_error('content', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for="">Hình ảnh đại diện</label>
                <div class="row">
                  <div class="col-10">
                    <input type="text" readonly class="form-control thumbnail" value="<?php echo old('thumbnail', $oldData) ?>" name="thumbnail" placeholder="Nhập hình ảnh dự án....">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>
                <?php echo form_error('thumbnail', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for="">Ảnh dự án</label>
                <div class="wp-items">
                  <?php
                  $gallery = old('gallery', $oldData);
                  // print_r($gallery);
                  if (!empty($gallery)) :
                    foreach ($gallery as $key => $item) :
                      $galleryError = $error['gallery'] ?? ""; ?>
                      <div class="row mb-2">
                        <div class="col-9">
                          <input type="text" readonly class="form-control thumbnail" value="<?php echo (!empty($item)) ? $item : false; ?>" name="gallery[]" placeholder="Nhập hình ảnh dự án....">
                        </div>
                        <div class="col-2">
                          <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                        </div>
                        <div class="col-1">
                          <button type="button" class="btn btn-delete-items btn-danger w-100"><i class="fa fa-times"></i></button>
                        </div>
                        <small class="ml-2 text-danger"><?php echo !empty($galleryError[$key]) ? $galleryError[$key] : false; ?></small>
                      </div>
                  <?php
                    endforeach;
                  endif;
                  ?>
                </div>
                <button type="button" class="btn btn-sm btn-warning btn-add--items"><i class="fa fa-image"></i> Thêm ảnh mới</button>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mr-1">Thêm mới dự án</button>
          <a href="<?php echo getLinkAdmin('portfolios') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
