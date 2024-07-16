<?php
if (!defined('_INCODE')) die('Access Deined...');

if (isLogin()) {
  $token = getSession('loginToken');
  delete('login_token', "token='$token'");
  removeSession('loginToken');
  if (!empty($_SERVER['HTTP_REFERER'])) {
    redirect($_SERVER['HTTP_REFERER']);
  }
  redirect('?module=auth&action=login');
}
