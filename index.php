<?php
@session_start();
@ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once 'includes/connect.php';
require_once 'config.php';
require_once 'router.php';
// Import Phpmailer
require_once 'includes/phpmailer/PHPMailer.php';
require_once 'includes/phpmailer/SMTP.php';
require_once 'includes/phpmailer/Exception.php';

require_once 'includes/database.php';
require_once 'includes/func.php';
require_once 'includes/permaLink.php';
require_once 'includes/session.php';

$module = _MODULE_DEFAULT;
$action = _ACTION_DEFAULT;

$curentUrl = '' ;
if (empty($_GET['module'])) {
  $curentUrl = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
}

if ($curentUrl != '/') {
  $curentUrl = trim($curentUrl, '/');
}

$tagetUrl = null;

if (!empty($route)) {
  foreach ($route as $key => $item) {
    //So sánh đường dẫn url sau domain với mảng router có key trùng với dữ liệu được GET trên URL
    if (preg_match("~^" . $key . "$~i", $curentUrl)) {
      $tagetUrl = preg_replace("~^" . $key . "$~i", $item, $curentUrl);
      break;
    }
  }
}

$tagetUrlArr = null;
if (!empty($tagetUrl)) {
  $tagetUrlArr = parse_url($tagetUrl);
  if (!empty($tagetUrlArr)) {
    $tagetQuery = $tagetUrlArr['query'];
    $tagetUrlQueryArr = array_filter(explode('&', $tagetQuery));
    if (!empty($tagetUrlQueryArr)) {
      foreach ($tagetUrlQueryArr as $item) {
        $itemArr = array_filter(explode('=', $item));
        $_GET[$itemArr[0]] = $itemArr[1];
      }
    }
  }
}

$body = getBody();

// echo "<pre>";
// print_r($body);
// echo "</pre>";



if (!empty($_GET['module'])) {
  if (is_string($_GET['module'])) {
    $module = trim($_GET['module']);
  }
}

if (!empty($_GET['action'])) {
  if (is_string($_GET['action'])) {
    $action = trim($_GET['action']);
  }
}

$path = "modules/$module/$action.php";
// echo $path;
if (file_exists($path)) {
  require $path;
} else {
  require 'modules/error/404.php';
}
