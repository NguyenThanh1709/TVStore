<?php
if (!defined('_INCODE')) die('Access Deined...');

$data = [
  'titlePage' => 'Quên mật khẩu'
];

layout('header-login', 'admin', $data);

if (isPost()) {
  $data = getBody();
  if (!empty($data['email'])) {
    $email = $data['email'];
    $queryEmail = firstRaw("SELECT id FROM users WHERE email='$email'");
    if ($queryEmail) {
      $userID = $queryEmail['id'];

      //Tạo token
      $token = sha1(uniqid() . time());

      //DataUpdate
      $dataUpdate = array(
        'forgot_token' => $token
      );
      $condition = "id='$userID'";

      //Update forgot
      $updateStatus = update('users', $dataUpdate, $condition);

      if ($updateStatus) {
        // Tạo link reset
        $urlReset = _WEB_HOST_ROOT_ADMIN . '/?module=auth&action=reset&token=' . $token;

        //Thiết lập nội dung email
        $subject = "Yêu cầu đổi mật khẩu";
        $content = "Chào bạn $email. Bạn vừa yêu cầu đổi mật khẩu <br/>";
        $content .= "Để đổi mật khẩu vui lòng click vào link này: $urlReset <br/>";
        $content .= "Nếu không phải vui lòng bỏ qua Email này!";

        //Tiến hành gửi email
        $sendMail = sendMail($email, $subject, $content);

        if ($sendMail) {
          setFlashData('msg', 'Đã gửi yêu cầu đến Email của bạn bạn! Hãy kiểm tra Email');
          setFlashData('msg_style', 'success');
        } else {
          setFlashData('msg', 'Lỗi hệ thống. Tạm thời chưa gửi được Mail');
          setFlashData('msg_style', 'danger');
        }
      }
    } else {
      setFlashData('msg', 'Không tồn tại Email trong hệ thống');
      setFlashData('msg_style', 'danger');
    }
  } else {
    setFlashData('msg', 'Vui lòng điền email của bạn');
    setFlashData('msg_style', 'danger');
  }
}

$msg = getFlashData('msg'); //Thông báo
$msg_style = getFlashData('msg_style'); //Trạng thái thông báo

?>
<div class="row" style="min-height: 90vh;">
  <div class="col-4" style="margin: 50px auto;">
    <h3 class="text-center text-uppercase">Nhập email của bạn</h3>
    <?php
    getMsg($msg, $msg_style);
    ?>
    <form method="post">
      <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" required name="email" placeholder="Nhập email của bạn!">
      </div>
      <div class="form-group">
        <button class="btn btn-success w-100">Gửi yêu cầu</button>
      </div>
    </form>
    <hr>
    <p class="text-center"><a href="?module=auth&action=login">Đăng nhập</a></p>
  </div>
</div>
<?php
layout('footer-login', 'admin', $data)
?>