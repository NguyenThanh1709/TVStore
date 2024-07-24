<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}
$data = [
  'pageTitle' => 'Thiết lập header'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

updateOptions('header');

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
    <form action="" method="post">
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập logo</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group ">
                <label for=""><?php echo getOptions('general_logo_favicon', 'label') ?></label>
                <div class="row">
                  <div class="col-10">
                    <input type="text" class="form-control thumbnail" value="<?php echo getOptions('general_logo_favicon') ?>" name="general_logo_favicon" placeholder="Nhập logo favicon....">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-outline-success choose-image w-100"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>
                <?php echo form_error('general_logo_favicon', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for=""><?php echo getOptions('general_logo_header', 'label') ?></label>
                <div class="row">
                  <div class="col-10">
                    <input type="text" class="form-control thumbnail" value="<?php echo getOptions('general_logo_header') ?>" name="general_logo_header" placeholder="Nhập logo favicon....">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-outline-success choose-image w-100"><i class="fa fa-image"></i> Chọn hình ảnh</button>
                  </div>
                </div>
                <?php echo form_error('general_logo_header', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập tìm kiếm</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Placeholder tìm kiếm</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_search_placeholder') ?>" name="general_search_placeholder" placeholder="Từ khoá tìm kiếm... ">
                <?php echo form_error('general_search_placeholder', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold p-0 m-0">Thiết lập khác</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('general_quote_text', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_quote_text') ?>" name="general_quote_text" placeholder="Link báo giá... ">
                <?php echo form_error('general_quote_text', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('general_quote_link', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_quote_link') ?>" name="general_quote_link" placeholder="Link báo giá... ">
                <?php echo form_error('general_quote_link', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-1">Lưu thay đổi</button>
        <a href="<?php echo getLinkAdmin('blogs') ?>" class="btn btn-warning">Quay lại</a>
      </div>
    </form>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
