<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataService = firstRaw("select opt_value from options where opt_key = 'general_service'");
$dataService = reset($dataService);
$dataService = json_decode($dataService, true);

// echo "<pre>";
// print_r($dataService);
// echo "</pre>";
$pageService = true;
$data = [
    "pageTitle" =>  !empty($dataService['title_service']) ? $dataService['title_service']: "Dịch vụ" ,
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);

require_once _WEB_PATH_ROOT.'/modules/home/service.php';
require_once _WEB_PATH_ROOT.'/modules/home/partner.php';

layout("footer", "client", $data);

?>