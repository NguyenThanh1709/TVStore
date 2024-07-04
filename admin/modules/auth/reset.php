<?php
if (!defined('_INCODE')) die('Access Deined...');

$data = [
  'titlePage' => 'Đặt lại mặt khẩu'
];

layout('header-login', 'admin', $data);

echo "<div class='container'></br>";

$token = getBody()['token'];

if (!empty($token)) {
  //Truy vấn token trong database
  $tokenQuery = firstRaw("SELECT id, email, fullname FROM users WHERE `forgot_token` = '$token'");
  if (!empty($tokenQuery)) {
    $userID = $tokenQuery['id'];
    if (isPost()) {
      //Lấy dữ liệu submit
      $data = getBody();

      //Tạo mảng chứa lỗi
      $error = array();

      //Validate password - kiểm tra dữ liệu submit
      if (empty(trim($data['password']))) {
        $error['password']['required'] = "Mật khẩu bắt buộc nhập!";
      } else {
        if (strlen(trim($data['password'])) < 8) {
          $error['password']['min'] = "Mật khẩu ít nhất 8 ký tự!";
        }
      }

      if (empty(trim($data['password_cf']))) {
        $error['password_cf']['required'] = "Xác nhận mật khẩu bắt buộc nhập!";
      } else {
        if (trim($data['password']) != trim($data['password_cf'])) {
          $error['password_cf']['match'] = "Mật khẩu không trùng nhau";
        }
      }

      if (empty($error)) {
        $dataUpdate = array(
          'password' => password_hash($data['password'], PASSWORD_DEFAULT),
          'forgot_token' => null,
        );
        $condition = "id='$userID'";
        $updatePassword = update('users', $dataUpdate, $condition);
        if ($updatePassword) {

          //Gửi email thông báo
          $linkLogin = _WEB_HOST_ROOT . "?module=auth&action=login";
          $content = "Bạn vừa đổi mật khẩu thành công. Vui lòng đăng nhập <br/>";
          $content .= "Truy cập đường dẫn để đăng nhập: $linkLogin";
          sendMail($tokenQuery['email'], 'Đổi mật khẩu thành công', $content);

          //Set thôg báo
          setFlashData('msg', 'Mật khẩu của bạn đã được thay đổi. Có thể đăng nhập ngay bây giờ !');
          setFlashData('msg_style', 'success');
          redirect('?module=auth&action=login');
        }
      } else {
        setFlashData('msg', 'Kiểm tra dữ liệu đầu vào');
        setFlashData('errors', $error);
        setFlashData('msg_style', 'danger');
        redirect('?module=auth&action=reset&token=' . $token);
      }
    } //End post

    $errors = getFlashData('errors'); //Lỗi
    $msg = getFlashData('msg'); //Thông báo
    $msg_style = getFlashData('msg_style'); //Trạng thái thông báo
?>
    <div class="row" style="min-height: 90vh;">
      <div class="col-4" style="margin: 50px auto;">
        <h3 class="text-center text-uppercase">Đặt lại mật khẩu</h3>
        <?php
        getMsg($msg, $msg_style);
        ?>
        <form method="post">
          <div class="form-group">
            <label for="">Mật khẩu</label>
            <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới...">
            <?php echo form_error('password', $errors); ?>
          </div>

          <div class="form-group">
            <label for="">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" name="password_cf" placeholder="Nhập lại mật khẩu mới...">
            <?php echo form_error('password_cf', $errors); ?>
          </div>
          <input type="hidden" name="token" value="<?php echo $token; ?>">
          <div class="form-group">
            <button class="btn btn-success w-100">Đổi mật khẩu</button>
          </div>
          <hr>
          <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
        </form>
      </div>
    </div>
<?php
  } else {
    getMsg('Liên kết không tồn tại 1', 'danger');
  }
}


echo "</div>";
layout('footer-login', 'admin', $data);
