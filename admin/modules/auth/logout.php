<?php
if (!defined('_INCODE')) die('Access Deined...');

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
// die();

if (isLogin()){
    $token = getSession('login_token');
    delete('login_token', "token='$token'");
    removeSession('login_token');
    if(empty($_SERVER['HTTP_REFERER'])){
        redirect(getLinkAdmin('auth','login'));
    }else {
        redirect($_SERVER['HTTP_REFERER']);
    }
}