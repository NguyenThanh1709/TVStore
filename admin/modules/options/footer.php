<?php
if (!defined('_INCODE')) die('Access Deined...');
// var_dump(_INCODE);
$data = [
  'pageTitle' => 'Thiết lập footer'
];

layout('header', 'admin', $data); //Requide footer, sidabar, breadcrumb
layout('sidebar', 'admin', $data);
layout('breadcrumb', 'admin', $data);

$userID = isLogin()['user_id']; //lấy id user đang login

updateOptions('', 'footer');

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
        <div class="card-footer">
          <h4 class="text-bold p-0 m-0">Thiết lập cột 1</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Tiêu đề cột 1</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('footer_title_1') ?>" name="footer_title_1" placeholder="Tiêu đề cột 1... ">
                <?php echo form_error('footer_title_1', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nội dung giới thiệu</label>
                <textarea name="footer_content_1" class="form-control editor" id="">
                    <?php echo !empty(getOptions('footer_content_1')) ? getOptions('footer_content_1') : '' ?>
                    </textarea>
                <?php echo form_error('content', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-secondary">
        <div class="card-footer">
          <h4 class="text-bold p-0 m-0">Thiết lập cột 2</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Tiêu đề cột 2</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('footer_title_2') ?>" name="footer_title_2" placeholder="Tiêu đề cột 2... ">
                <?php echo form_error('footer_title_2', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nội dung giới thiệu</label>
                <textarea name="footer_content_2" class="form-control editor" id="">
                    <?php echo !empty(getOptions('footer_content_2')) ? getOptions('footer_content_2') : '' ?>
                </textarea>
                <?php echo form_error('footer_content_2', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-secondary">
        <div class="card-footer">
          <h4 class="text-bold p-0 m-0">Thiết lập cột 3</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Tiêu đề cột 3</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('footer_title_3') ?>" name="footer_title_3" placeholder="Tiêu đề cột 3... ">
                <?php echo form_error('footer_title_3', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nội dung giới thiệu</label>
                <textarea name="footer_content_3" class="form-control editor" id="">
                    <?php echo !empty(getOptions('footer_content_3')) ? getOptions('footer_content_3') : '' ?>
                </textarea>
                <?php echo form_error('footer_content_3', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group ">
                <label for="">QR Code</label>
                <div class="row">
                  <div class="card ml-2" style="width: 18rem;">
                    <img src="<?php echo getOptions('footer_qrcode_3') ?>" title="Ảnh đã tải lên" alt="Ảnh tải lên" class="img-thumbnail">
                  </div>
                  <div class="col-10">
                    <input type="text" readonly class="form-control thumbnail" value="<?php echo getOptions('footer_qrcode_3') ?>" name="footer_qrcode_3" placeholder="Nhập ảnh nền....">
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-success choose-image w-100"><i class="fa fa-upload"></i> Tải ảnh</button>
                  </div>
                </div>
                <?php echo form_error('footer_qrcode_3', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card card-secondary">
        <div class="card-footer">
          <h4 class="text-bold p-0 m-0">Thiết lập cột 4</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Tiêu đề cột 4</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('footer_title_4') ?>" name="footer_title_4" placeholder="Tiêu đề cột 4... ">
                <?php echo form_error('footer_title_4', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nội dung nút</label>
                <input type="text" class="form-control name" value="<?php echo getOptions('footer_text_button_4') ?>" name="footer_text_button_4" placeholder="Nội dung nút... ">
                <?php echo form_error('footer_text_button_4', $error); ?>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="">Nội dung giới thiệu</label>
                <textarea name="footer_content_4" class="form-control editor" id="">
                    <?php echo !empty(getOptions('footer_content_4')) ? getOptions('footer_content_4') : '' ?>
                </textarea>
                <?php echo form_error('footer_content_4', $error); ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-secondary">
        <div class="card-footer">
          <h4 class="text-bold p-0 m-0">Thiết lập bản quyền</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="">Nội dung</label>
                <textarea name="footer_copy" class="form-control editor" id=""><?php echo getOptions('footer_copy') ?></textarea>
                <?php echo form_error('footer_copy', $error); ?>
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
