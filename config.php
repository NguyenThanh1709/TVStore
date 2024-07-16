<?php
const _INCODE = true;
//Thiết lặp hằng số mặc định
const _MODULE_DEFAULT = 'home';
const _ACTION_DEFAULT = 'list';
const _MODULE_DEFAULT_ADMIN = 'dashboarh';

//Thiết lập tên dự án
const _NAME_PROJECT = 'TVStore Amin';

// Thiết lập HOST
define('_WEB_HOST_ROOT', 'http://' . $_SERVER['HTTP_HOST'] . '/tvstore'); //Địa chỉ trang chủ

define('_WEB_HOST_TEMPLATE', _WEB_HOST_ROOT . '/template/client');

define('_WEB_HOST_ROOT_ADMIN', _WEB_HOST_ROOT . '/admin'); //Địa chỉ trang chủ admin

define('_WEB_HOST_TEMPLATE_ADMIN', _WEB_HOST_ROOT . '/template/admin');

// echo _WEB_HOST_TEMPLATE_ADMIN;
//Thiết lập Path
define('_WEB_PATH_ROOT', __DIR__);
define('_WEB_PATH_TEMPLATE', _WEB_PATH_ROOT . '/template');

//Thiết lập chế độ debug
const _DEBUG = true;

//Thiết lập số bản ghi trên trang
const _PER_PAGE = 5;
