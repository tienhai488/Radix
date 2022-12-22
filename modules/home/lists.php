<?php
if (!defined('_INCODE')) die('Access Deined...');
$data = [
    "pageTitle" => "Trang chủ",
];
layout("header", "client", $data);


require_once 'slide.php';
require_once 'about.php';
require_once 'service.php';
require_once 'fact.php';
require_once 'portfolio.php';
require_once 'action.php';
require_once 'blog.php';
require_once 'partner.php';



?>

<?php
layout("footer", "client", $data);
?>