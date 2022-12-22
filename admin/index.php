<?php
ob_start();
session_start();
require_once '../config.php';

//Import phpmailer lib
require_once '../includes/phpmailer/PHPMailer.php';
require_once '../includes/phpmailer/SMTP.php';
require_once '../includes/phpmailer/Exception.php';

require_once '../includes/functions.php';
require_once '../includes/connect.php';
require_once '../includes/database.php';
require_once '../includes/session.php';

// Xử lý hiển thị thông báo lỗi
// $debugStatus = _DEBUG;

// if($debugStatus){
//     ini_set('display_errors',1);
//     error_reporting(E_ALL);
// }else {
//     ini_set('display_errors',0);
//     error_reporting(0);
// }

// set_exception_handler('showExceptionError');
// set_error_handler('showErrorHandler');

$module = _MODULE_DEFAULT_ADMIN;
$action = _ACTION_DEFAULT;

if (!empty($_GET['module'])){
    if (is_string($_GET['module'])){
        $module = trim($_GET['module']);
    }
}

if (!empty($_GET['action'])){
    if (is_string($_GET['action'])){
        $action = trim($_GET['action']);
    }
}

$path = 'modules/'.$module.'/'.$action.'.php';

if (file_exists($path)){
    require_once $path;
}else{
    require_once 'modules/errors/404.php';
}