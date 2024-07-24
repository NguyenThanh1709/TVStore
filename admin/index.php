<?php
@session_start();
@ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

require_once '../includes/connect.php';
require_once '../config.php';
// Import Phpmailer
require_once '../includes/phpmailer/PHPMailer.php';
require_once '../includes/phpmailer/SMTP.php';
require_once '../includes/phpmailer/Exception.php';
require_once '../includes/permaLink.php';
require_once '../includes/database.php';
require_once '../includes/func.php';
require_once '../includes/permission.php';
require_once '../includes/session.php';

$module = _MODULE_DEFAULT_ADMIN;
$action = _ACTION_DEFAULT;

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
