<?php
if (!defined('_INCODE')) die('Access Deined...');


if (isLogin()){
    $token = getSession('login_token');
    delete('login_token', "token='$token'");
    removeSession('login_token');
    redirect(getLinkAdmin('auth','login'));
}