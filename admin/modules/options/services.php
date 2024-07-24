<?php
if (!defined('_INCODE')) die('Access Deined...');
//Kiểm tra phân quyền

$checkPermission = checkCurrentPermission();

if (!$checkPermission) {
  redirectPermission();
}
$data = [
  'pageTitle' => 'Thiết lập giới thiệu'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

updateOptions('', 'services');

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
          <h4 class="text-bold p-0 m-0">Thiết lập tiêu đề</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('service_title', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('service_title') ?>" name="service_title" placeholder="Thiết lập tiêu đề dịch vụ... ">
                <?php echo form_error('service_title', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-1">Lưu thay đổi</button>
        <a href="<?php echo getLinkAdmin('dashboarh') ?>" class="btn btn-warning">Quay lại</a>
      </div>
    </form>
  </div>
</section>
<?php
layout('footer', 'admin', $data);
