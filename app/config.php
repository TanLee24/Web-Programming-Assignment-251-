<?php
// DB
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'web_asgmt_database');

// Đường dẫn tới thư mục app
define('APPROOT', dirname(__DIR__) . '/app');

// Tự tính URLROOT = http://localhost/BTL_Web   (KHÔNG có /public)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "https://" : "http://";
$host     = $_SERVER['HTTP_HOST'];

$scriptName  = dirname($_SERVER['SCRIPT_NAME']);   // /BTL_Web/public
$projectRoot = str_replace('/public', '', $scriptName); // /BTL_Web

define('URLROOT', $protocol . $host . $projectRoot);
define("URLPUBLIC", URLROOT . "/public");
