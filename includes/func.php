<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function is_phoneVN($phone)
{
  $pattern = "/^(032|033|034|035|036|037|038|039|096|097|098|086|083|084|085|081|082|088
                |091|094|070|079|077|076|078|090|093|089|056|058|092|059|099)[0-9]{7}$/";
  if (!preg_match($pattern, $phone, $matchs))
    return FALSE;
  return TRUE;
}


function layout($layout, $dir = '', $data = [])
{
  if (!empty($dir)) {
    $dir = '/' . $dir;
  }
  if (file_exists(_WEB_PATH_TEMPLATE . $dir . "/layouts/$layout.php")) {

    require_once _WEB_PATH_TEMPLATE . $dir . "/layouts/$layout.php";
  }
}


function sendMail($to, $subject, $content)
{
  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'ssl://smtp.googlemail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nvothanh00@gmail.com';                     //SMTP username
    $mail->Password   = 'mipavjyahtjdpxww';                               //SMTP password
    $mail->SMTPSecure = 'tsl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;
    $mail->CharSet = 'UTF-8';                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nvothanh00@gmail.com', 'SystemPHP');
    $mail->addAddress($to);     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // $mail->SMTPOptions = array(
    //   'ssl' => array(
    //     'verify_peer' => false,
    //     'verify_peer_name' => false,
    //     'allow_self_signed' => true
    //   )
    // );

    return  $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}


//Kiểm tra phương thức Post
function isPost()
{
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    return true;
  }
  return false;
}

//Kiểm tra phương thức GET
function isGET()
{
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    return true;
  }
  return false;
}

//Lấy giá trị phương thức Post và Get

//Lấy giá trị phương thức POST, GET
function getBody($method = '')
{

  $bodyArr = [];

  if (empty($method)) {
    if (isGet()) {
      //Xử lý chuỗi trước khi hiển thị ra
      //return $_GET;
      /*
         * Đọc key của mảng $_GET
         *
         * */
      if (!empty($_GET)) {
        foreach ($_GET as $key => $value) {
          $key = strip_tags($key);
          if (is_array($value)) {
            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
          } else {
            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
          }
        }
      }
    }

    if (isPost()) {
      if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
          $key = strip_tags($key);
          if (is_array($value)) {
            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
          } else {
            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
          }
        }
      }
    }
  } else {
    if ($method == 'get') {
      if (!empty($_GET)) {
        foreach ($_GET as $key => $value) {
          $key = strip_tags($key);
          if (is_array($value)) {
            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
          } else {
            $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
          }
        }
      }
    } elseif ($method == 'post') {
      if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
          $key = strip_tags($key);
          if (is_array($value)) {
            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
          } else {
            $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
          }
        }
      }
    }
  }



  return $bodyArr;
}

// Hàm thông báo
function getMsg($msg, $style = 'success')
{
  if (!empty($msg)) {
    echo "<div class='alert alert-$style alert-dismissible fade show' role='alert'>";
    echo $msg;
    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
  }
}

//hàm kiểm tra
function is_username($username)
{
  $pattern = "/^[A-Za-z0-9_\.]{6,32}$/";
  if (!preg_match($pattern, $username, $matchs))
    return FALSE;
  return TRUE;
}

// Kiểm tra email
function isEmail($email)
{
  $regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i";
  if (!preg_match($regex, $email)) {
    return true;
  } else {
    return false;
  }
}

//Hàm chuyển hướng
function redirect($path = 'index.php')
{
  header("Location: $path");
  exit;
}

// Hàm xuất lỗi
function form_error($fieldName, $errors)
{
  return (!empty($errors[$fieldName])) ? "<small class='text text-danger'>" . reset($errors[$fieldName]) . "</small>" : null;
}

// Hàm set value
function old($fieldName, $odlData)
{
  return (!empty($odlData[$fieldName])) ? $odlData[$fieldName] : null;
}

//Kiểm tra login
function isLogin()
{
  //Kiểm tra trạng thái đăng nhập
  $checkLogin = false;
  if (getSession('loginToken')) {
    $loginToken = getSession('loginToken');
    $queryToken = firstRaw("SELECT `user_id` FROM `login_token` WHERE `token` = '$loginToken'");
    if (!empty($queryToken)) {
      $checkLogin = $queryToken;
    } else {
      removeSession('loginToken');
    }
  }
  return $checkLogin;
}

// Tự động logout sau 15 phút
function autoRomoveTokenLogin()
{
  $allUsers = getRaw("SELECT * FROM `users` WHERE `status`=1");
  if (!empty($allUsers)) {
    foreach ($allUsers as $item) {
      $now = date('Y-m-d H:i:s');
      // echo $now . "<br />";
      $before = $item['last_activity'] ?? '';
      // echo $before . "<br />";
      $diff =  strtotime($now) - strtotime($before);

      $diff = floor($diff / 60);
      // echo $diff . "<br />";
      if ($diff >= 15) {
        delete("login_token", "user_id=" . $item['id']);
      }
    }
  }
}

// Lưu lại thời gian cuối cùng hoạt động
function saveActivity()
{
  $user_id = isLogin()["user_id"];
  update('users', ['last_activity' => date("Y-m-d H:i:s")], "id=$user_id");
}

//Lấy thông tin user Đăng nhập
function userDetail($user_id)
{
  $userDetail = firstRaw("SELECT * FROM `users` WHERE `id`='$user_id'");
  return $userDetail;
}

//Action menu sidebar
function activeMenuSidebar($module)
{
  if (!empty(getBody()['module']) && getBody()['module'] == $module) {
    return true;
  }

  return false;
}

// getlink
function getLinkAdmin($mod, $act = '', $par = [])
{
  $url = _WEB_HOST_ROOT_ADMIN;
  $url = $url . '?module=' . $mod;

  if (!empty($act)) {
    $url = $url . '&action=' . $act;
  }

  // params ['id'=>1, 'keyword'='oke']
  if (!empty($par)) {
    $paramsString = http_build_query($par);
    $url = $url . '&' . $paramsString;
  }

  return $url;
}

function getPaging($page, $module, $queryString, $maxPage)
{
  $web_host_rooot_admin = _WEB_HOST_ROOT_ADMIN; //Lấy đường dẫn web root
  // Chuổi html
  $str = "<nav aria-label='Page navigation example'> 
          <ul class='pagination pagination-sm m-0 p-0'>";
  // Kiểm tra lớn hơn 1 mới hiển thị
  if ($page > 1) {
    $prevPage = $page - 1;
    $str .= "<li class='page-item'><a class='page-link' href='$web_host_rooot_admin?module=$module" . "$queryString" . "&page=$prevPage''>Trước</a></li>";
  }
  $begin = $page - 4;
  if ($begin < 1) {
    $begin = 1;
  }
  $end = $page + 4;
  if ($end > $maxPage) {
    $end = $maxPage;
  }
  //Lập lấy thanh phân trang 
  for ($index = $begin; $index <= $end; $index++) {
    $active = $index == $page ? 'active' : '';
    $str .= "<li class='page-item $active'><a class='page-link' href='$web_host_rooot_admin?module=$module" . "$queryString" . "&page=$index''>$index</a></li>";
  }
  // Nếu page bằng tổng số trang 
  if ($page < $maxPage) {
    $nextPage = $page + 1;
    if ($page > $maxPage) {
      $page = 1;
    }

    $str .= "<li class='page-item'><a class='page-link' href='$web_host_rooot_admin?module=$module" . "$queryString" . "&page=$nextPage''>Sau</a></li>";
  }
  $str .= "</ul></nav>";

  return $str;
}

function getName($id, $table, $fieldName)
{
  $name = firstRaw("SELECT `$fieldName` FROM `$table` WHERE `id` = '$id'");

  if (!empty($name)) {
    return $name['name'];
  }
  return false;
}

function isFrontIcon($input)
{
  $input = html_entity_decode($input);
  if (strpos($input, '<i class="') !== false) {
    return true;
  }
  return false;
}


function updateQueryString($queryString, $key, $value)
{
  $queryArr = explode('&', $queryString);
  $queryArr = array_filter($queryArr);
  $queryFinal = '';
  if (!empty($queryArr)) {
    foreach ($queryArr as $item) {
      $itemArr = explode('=', $item);
      if ($itemArr[0] == $key) {
        $itemArr[1] = $value;
      }
      $item = implode('=', $itemArr);

      $queryFinal .= $item . '&';
    }
  }
  if (!empty($queryFinal)) {
    $queryFinal = rtrim($queryFinal, '&');
  } else {
    $queryFinal = $queryString;
  }

  return "module=services&" . $queryFinal;
}
function getOptions($key, $type = '')
{
  $sql = "SELECT * FROM `options` WHERE opt_key='$key'";
  $option = firstRaw($sql);
  // var_dump($option);
  if (!empty($option)) {
    if ($type == 'label') {
      return $option['name'];
    }
    return $option['opt_value'];
  }
  return false;
}

function getCountContact($status)
{
  $sql = "SELECT `id` FROM `contacts` WHERE `status` = '$status'";
  $count = getRows($sql);
  return $count;
}

function formatDate($date, $dmy = '', $him = '')
{
  $dateTime = new DateTime($date);
  if (empty($him)) {
    return $dateTime->format('d/m/Y');
  }
  return $dateTime->format('d/m/Y H:i:s');
}
