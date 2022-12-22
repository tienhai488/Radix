<?php
if (!defined('_INCODE')) die('Access Deined...');
$dataPortfolio = firstRaw("select opt_value from options where opt_key = 'general_portfolio'");
$dataPortfolio = reset($dataPortfolio);
$dataPortfolio = json_decode($dataPortfolio, true);

// echo "<pre>";
// print_r($dataPortfolio);
// echo "</pre>";
$pagePortfolio = true;
$data = [
    "pageTitle" =>  !empty($dataPortfolio['title_portfolio']) ? $dataPortfolio['title_portfolio']: "Dự án" ,
];
layout("header", "client", $data);
layout("breadcrumb", "client", $data);

require_once _WEB_PATH_ROOT.'/modules/home/portfolio.php';

layout("footer", "client", $data);

?>