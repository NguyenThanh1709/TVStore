<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thông tin dịch vụ'
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

$oldData = $serviceDetail;

$linkUrl = _WEB_HOST_ROOT . '/' . getPremaLink(getBody()['module']) . '/' . old('slug', $oldData) . ".html";

?>
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <form action="" method="post">
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="">Tên dịch vụ</label>
                <input type="text" readonly class="form-control" value="<?php echo old('name', $oldData) ?>" name="name" placeholder="Nhập tên dịch vụ....">

              </div>
            </div>

            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" readonly class="form-control" value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug dịch vụ....">
                <span>Link: <a href="<?php echo $linkUrl  ?>" class="text-url"><?php echo $linkUrl  ?></a></span>
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
                    <input type="text" readonly class="form-control" name="icon" placeholder="Nhập icon dịch vụ...." value="<?php echo htmlspecialchars(old('icon', $oldData), ENT_QUOTES, 'UTF-8'); ?>">
                  </div>
                  <div class="col-2">
                    <button type="button" disabled class="btn btn-primary choose-image"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>

              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="" class="form-label">Ngày tạo</label>
                <input type="datetime-local" readonly class="form-control" value="<?php echo old('create_at', $oldData) ?>" name="create_at">

              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="" class="form-label">Ngày cập nhật</label>
                <input type="datetime-local" readonly class="form-control" value="<?php echo old('update_at', $oldData) ?>" name="update_at">

              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Mô tả ngắn</label>
                <textarea name="dscription" readonly id="" class="form-control" placeholder="Nhập mô tả ngắn..."><?php echo old('dscription', $oldData) ?></textarea>

              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="" class="form-label">Nội dung</label>
                <textarea name="content" readonly class="form-control editor" placeholder="Nhập nội dung dịch vụ..."><?php echo old('content', $oldData) ?></textarea>

              </div>
            </div>
          </div>
          <a href="<?php echo getLinkAdmin('services', 'edit', ['id' => $oldData['id']]) ?>" class="btn btn-primary mr-1">Chỉnh sửa dịch vụ</a>
          <a href="<?php echo getLinkAdmin('services') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
