<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thiết lập chung'
];

layout('header', 'admin', $data); //Requide header, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

updateOptions('', 'genergal');

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
          <h4 class="text-bold m-0">Thiết lập chung</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('general_sitename', 'label') ?></label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_sitename') ?>" name="general_sitename" placeholder="Tên website là gì... ">
                <?php echo form_error('hotline', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for=""><?php echo getOptions('general_sitedesc', 'label') ?></label>
                <textarea class="form-control name" rows="1" value="" name="general_sitedesc" placeholder="Mô tả website của bạn... "><?php echo getOptions('general_sitedesc') ?></textarea>
                <?php echo form_error('hotline', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-secondary">
        <div class="card-header">
          <h4 class="text-bold m-0">Thiết lập liên hệ</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_hotline') ?>" name="ganeral_hotline" placeholder="Hotline... ">
                <?php echo form_error('hotline', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Email</label>
                <input type="Email" class="form-control name" value="<?php echo getOptions('general_email') ?>" name="general_email" placeholder="Email... ">
                <?php echo form_error('general_email', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_address') ?>" name="general_address" placeholder="Địa chỉ liên hệ... ">
                <?php echo form_error('general_address', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Thời gian làm việc</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_time') ?>" name="general_time" placeholder="Thời gian làm việc... ">
                <?php echo form_error('general_time', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Facebook</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_facebook') ?>" name="general_facebook" placeholder="Facebook... ">
                <?php echo form_error('general_facebook', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">X</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_x') ?>" name="general_x" placeholder="X... ">
                <?php echo form_error('general_x', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Behance</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_behance') ?>" name="general_behance" placeholder="Behance... ">
                <?php echo form_error('general_behance', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Youtube</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_youtube') ?>" name="general_youtube" placeholder="Youtube... ">
                <?php echo form_error('general_youtube', $error); ?>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label for="">Linkedin</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('general_linkedin') ?>" name="general_linkedin" placeholder="Linkedin... ">
                <?php echo form_error('general_linkedin', $error); ?>
              </div>
            </div>

          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            <a href="<?php echo getLinkAdmin('genergal') ?>" class="btn btn-warning">Quay lại</a>
          </div>
        </div>
      </div>
    </form>
  </div>
  </div>
</section>
<?php
layout('footer', 'admin', $data);

?>