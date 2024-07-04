<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thông tin trang'
];
layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

$pageID = getBody('get')['id']; //Id service

$serviceDetail = firstRaw("SELECT * FROM `pages` WHERE `id` = '$pageID'");
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
                <label for="">Tên trang</label>
                <input type="text" readonly class="form-control" value="<?php echo old('title', $oldData) ?>" name="name" placeholder="Nhập tên trang...">
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Đường dẫn tĩnh <span id="auto-slug" class="text-info text-13">[Tự động điền]</span></label>
                <input type="text" class="form-control" readonly value="<?php echo old('slug', $oldData) ?>" name="slug" placeholder="Nhập slug trang...">
                <span>Link: <a href="<?php echo $linkUrl  ?>" class="text-url"><?php echo $linkUrl  ?></a></span>
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
                <label for="" class="form-label">Nội dung</label>
                <textarea name="content" readonly class="form-control editor" placeholder="Nhập nội dung trang..."><?php echo old('content', $oldData) ?></textarea>
              </div>
            </div>
          </div>
          <a href="<?php echo getLinkAdmin('pages', 'edit', ['id' => $pageID]) ?>" class="btn btn-primary mr-1">Chỉnh sửa trang</a>
          <a href="<?php echo getLinkAdmin('pages') ?>" class="btn btn-warning">Quay lại</a>
        </div>
      </form>
    </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
