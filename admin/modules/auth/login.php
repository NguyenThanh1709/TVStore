<?php
if (!defined('_INCODE')) die('Access Deined...');

$data = [
  'titlePage' => 'Đăng nhập'
];

layout('header-login', 'admin', $data);

//Kiểm tra trạng thái đăng nhập
if (isLogin()) {
  redirect('?module=users&action=list');
}
 
if (isPost()) {
  $errors = array();
  $data = getBody();

  //Validate email and passwrod
  if (!empty(trim($data['email'])) && !empty(trim($data['password']))) {
    $email = $data['email'];
    $password = $data['password'];
    // echo password_hash($password, PASSWORD_DEFAULT) . "<br>";
    //Lấy thông tin user theo Email và Pass
    $userQuery = firstRaw("SELECT `id` , `password` FROM `users` WHERE `email`='$email' AND `status`=1");
    //Nếu có dữ liệu trả về
    if (!empty($userQuery)) {
      $passwordHash = $userQuery['password'];
      // echo $passwordHash . "<br>";
      $user_id = $userQuery['id'];
      $group_id = $userQuery['group_id'];
      // echo $user_id;
      if (password_verify($password, $passwordHash)) {  //kiểm tra $password (lấy ở form), $passwordHash (CSDL)
        //Tạo token login
        $tokenLogin = sha1(uniqid() . time());
        //Insert dữ liệu vào bảng login_token
        $dataToken = [
          'user_id' => $user_id,
          'group_id' => $group_id,
          'token' => $tokenLogin
        ];
        $insertTokenStatus = insert('login_token', $dataToken);
        if ($insertTokenStatus) {
          //Insert token thành công, set token
          setSession('loginToken', $tokenLogin);
          //chuyển hướng 
          redirect('?module=dashboarh&action=list');
        } else {
          setFlashData('msg', "Lỗi hệ thống, bạn không thể đăng nhập vào lúc này!");
          setFlashData('msg_style', "danger");
        }
      } else {
        setFlashData('msg', "Email hoặc Mật khẩu không đúng!");
        setFlashData('msg_style', "danger");
      }
    } else {
      setFlashData('msg', "Email hoặc Mật khẩu không đúng!");
      setFlashData('msg_style', "danger");
    }
  } else {
    setFlashData('msg', "Vui lòng nhập Email và Mật khẩu!");
    setFlashData('msg_style', "danger");
  }

  //chuyển hướng 
  // redirect('?module=auth&action=login');
}

$msg = getFlashData('msg'); //Thông báo
$msg_style = getFlashData('msg_style'); //Trạng thái thông báo

?>
<div class="row" style="min-height: 90vh;">
  <div class="col-4" style="margin: 50px auto;">
    <h3 class="text-center text-uppercase">Đăng nhập hệ thống</h3>
    <?php
    getMsg($msg, $msg_style);
    ?>
    <form method="post">
      <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" required name="email" placeholder="Nhập email của bạn!">
      </div>
      <!-- <input type="text" name="username" placeholder="Username" pattern="[a-z]{1,15}"> -->
      <div class="form-group">
        <label for="">Mật khẩu</label>
        <input type="text" class="form-control" required name="password" placeholder="Nhập mật khẩu của bạn!">
      </div>
      <div class="form-group">
        <button class="btn btn-success w-100">Đăng nhập</button>
      </div>
    </form>
    <hr>
    <p class="text-center"><a href="?module=auth&action=forgot">Quên mật khẩu</a></p>
  </div>
</div>
<?php
layout('footer-login', 'admin', $data);
?>