<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Cập nhật dự án'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

$portfolio_id = getBody('get')['id']; //Lấy id dự án


$portfolio_detail = firstRaw("SELECT * FROM `portfolios` WHERE `id`='$portfolio_id'"); //Lấy ra thông tin dự án

$galleryArrSQL = getRaw("SELECT * FROM `portfolio_images` WHERE `portfolio_id`='$portfolio_id'"); //Lấy hình ảnh dự án

$gallerryIdsArr = [];
$galleryData = []; //Lưu trữ id portfolio_images trong database
foreach ($galleryArrSQL as $item) {
  $galleryData[] = $item['images'];
  $gallerryIdsArr[] = $item['id'];
}

// echo "<pre>";
// print_r($gallerryIdsArr);
// echo "</pre>";

//Kiểm tra tồn tại id trong hệ thống
if (empty($portfolio_detail)) {
  redirect(getLinkAdmin('portfolios'));
}

// Lấy danh sách danh mục dự án
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

  if (empty(trim($body['video']))) {
    $errors['video']['required'] = "Video dự án bắt buộc phải nhập!";
  }

  //validation gallery
  $galleryArr = isset($body['gallery']) ? $body['gallery'] : [];
  if (!empty($galleryArr)) {
    foreach ($galleryArr as $key => $value) {

      if (empty(trim($value))) {
        $errors['gallery']['required'][$key] = "Vui lòng chọn hình ảnh";
      }
    }
  }

  //Nếu dữ liệu đầu vào đúng - Tiến hành update dữ liệu
  if (empty($errors)) {
    //Nếu thêm mới mảng submit lên server > mảng có trong cơ sở dữ liệu
    if (count($galleryArr) > count($galleryData)) {
      // galleryData là danh sách chứa các hình ảnh cũ 
      // galleryArr là danh sách chứa các hình ảnh submit lên
      if (!empty($galleryData)) { //Kiểm tra trong CSDL có ảnh không nếu có 
        foreach ($galleryData as $key => $item) {  //foreach dữ liệu mảng cũ (CSDL)
          $dataImages = [
            'images' => $galleryArr[$key], //Value sẽ lấy value dữ ảnh mới submit
          ];

          // $condition = "images = '$item'";
          $condition = "id = '$gallerryIdsArr[$key]'";

          update('portfolio_images', $dataImages, $condition); //Cập nhật lại những dữ liệu cũ
        }
      } else {
        $key = -1; //thêm mới khi dữ CSDL chưa có bất khì ảnh nào $key = -1
      }
      //$key + 1 = 1 tiến hành chạy code khổ tạo gán trị mảng dataImages insert
      for ($index = $key + 1; $index < count($galleryArr); $index++) {
        $dataImages = [
          'images' => $galleryArr[$index], //key images lúc này sẽ có giá trị là mảng $gallerry $index chạy từ 0
          'portfolio_id' => $portfolio_id
        ];
        insert('portfolio_images', $dataImages); //Insert dữ liệu 
      }
    } elseif (count($galleryArr) < count($galleryData)) { //Ngược lại xoá ảnh
      foreach ($galleryArr as $key => $item) {
        $dataImages = [
          'images' => $item,
        ];

        // $condition = "images = '$item'";
        $condition = "id = '$gallerryIdsArr[$key]'";

        update('portfolio_images', $dataImages, $condition);
      }

      if (!isset($key)) {
        $key = -1;
      }
      // echo $key;

      for ($index = $key + 1; $index < count($galleryData); $index++) {
        //Xoá dữ liệu
        // $condition = "images = '$galleryData[$index]'";
        $condition = "id = '$gallerryIdsArr[$index]'";
        delete('portfolio_images', $condition);
      }
    } else {
      foreach ($galleryData as $key => $item) {
        $dataImages = [
          'images' => $galleryArr[$key],
        ];
        $condition = "id = '$gallerryIdsArr[$key]'";

        update('portfolio_images', $dataImages, $condition);
      }
    }

    //Khởi tạo gán giá trị mạng $dataUpdate
    $dataUpdate = [
      "name" => $body['name'],
      "slug" => $body['slug'],
      "portfolio_categories_id" => $body['portfolio_categories_id'],
      "video" => $body['video'],
      "dscription" => $body['dscription'],
      "content" => $body['content'],
      "thumbnail" => $body['thumbnail']
    ];

    $updateStatus = update('portfolios', $dataUpdate, "`id`='$portfolio_id'"); //goi hàm update truyền tham số vào

    if ($updateStatus) { //Nếu thành công - dữ liệu được insert
      setFlashData('msg', 'Cập nhật dữ liệu mới thành công !');
      setFlashData('msg_style', 'success');
      redirect(getLinkAdmin('portfolios', 'edit', ['id' => $portfolio_id]));
    } else {
      setFlashData('msg', 'Đã xảy ra lỗi khi thêm dữ liệu!');
      setFlashData('msg_style', 'danger');
      redirect(getLinkAdmin('portfolios', 'edit', ['id' => $portfolio_id]));
    }
  } else {
    setFlashData('msg', 'Vui lòng kiểm tra dữ liệu đầu vào!');
    setFlashData('msg_style', 'danger');
    setFlashData('errors', $errors);
    setFlashData('old_data', $body);
    redirect(getLinkAdmin('portfolios', 'edit', ['id' => $portfolio_id]));
  }
}
$error = getFlashData('errors');
$oldData = getFlashData('old_data');

if (empty($oldData) && !empty($portfolio_detail)) {
  $oldData = $portfolio_detail;
  $oldData['gallery'] = $galleryData;
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
                <label for="">Tên dự án</label>
                <input type="text" class="form-control name" value="<?php echo old('name', $oldData) ?>" name="name" placeholder="Nhập tên dự án....">
                <?php echo form_error('name', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug dự án....">
                <span>Link: <a href="<?php echo $linkUrl  ?>" class="text-url"><?php echo $linkUrl  ?></a></span>
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
                      <option value="<?php echo $item['id'] ?>"><?php echo $item['name']; ?></option>
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
                <input type="text" class="form-control" value="<?php echo old('video', $oldData) ?>" name="video" placeholder="Nhập link video dự án....">
                <?php echo form_error('video', $error); ?>
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
                <label for="" class="form-label">Mô tả ngắn</label>
                <textarea name="dscription" id="" class="form-control" placeholder="Nhập mô tả ngắn..."><?php echo old('dscription', $oldData) ?></textarea>
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
                  <div class="card ml-2" style="width: 18rem;">
                    <img src="<?php echo $oldData['thumbnail'] ?>" title="Ảnh đã tải lên" alt="Ảnh tải lên" class="img-thumbnail">
                  </div>
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
          <button type="submit" class="btn btn-primary mr-1">Cập nhật dự án</button>
          <a href="<?php echo getLinkAdmin('portfolios') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
