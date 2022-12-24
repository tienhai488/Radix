<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataAbout = firstRaw("select opt_value from options where opt_key = 'general_about'");
$dataAbout = reset($dataAbout);
$dataAbout = json_decode($dataAbout, true);

// echo "<pre>";
// print_r($dataAbout);
// echo "</pre>";
$data = [
    "pageTitle" =>  !empty($dataAbout['title_about']) ? $dataAbout['title_about']: "Giới thiệu" ,
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);

require_once _WEB_PATH_ROOT.'/modules/home/about.php';
require_once _WEB_PATH_ROOT.'/modules/home/partner.php';

layout("footer", "client", $data);

?>