<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thiết lập trang liên hệ'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

updateOptions('', 'contact');

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
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('contact_title_bg', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('contact_title_bg') ?>" name="contact_title_bg" placeholder="Thiết lập tiêu đề liên hệ... ">
                <?php echo form_error('contact_title_bg', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('contact_title', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('contact_title') ?>" name="contact_title" placeholder="Thiết lập tiêu đề liên hệ... ">
                <?php echo form_error('contact_title', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for=""><?php echo getOptions('contact_desc', 'label') ?></label>
                <textarea name="contact_desc" rows="1" id="" class="form-control editor"><?php echo getOptions('contact_desc') ?></textarea>
                <?php echo form_error('contact_desc', $error); ?>
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
